<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmRegistration;
use Illuminate\Http\Request;
use App\Http\Controllers\Visitors;

use Validator;
use Auth;
use Session;
use Input;

class EregController extends Controller {

	public $attempts = 0;

	public function index(){

		$event = \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return view('ereg.noevent')->with(['msg' => $msg]);
		}

		$code = $this->getNewBarcode();
		$batch = str_pad($code['batch'].'',4,'0', STR_PAD_LEFT);
		$serial = str_pad($code['serial'].'',4,'0', STR_PAD_LEFT);

		$barcode = $batch.$serial;
		$msg = Session::pull('errmsg', '');

		$row = new \App\Visitor;
		$row->region_id = 5;
		$row->event_id = $event->event_id;

		// $row->vis_code = addZero($endCode,6);
		$row->vis_batch = $code['batch'];
		$row->vis_serial = $code['serial'];
		return view('ereg.form')->with(['row' => $row, 'msg' => $msg, 'barcode' => $barcode, 'event' => $event]);
	}

	public function save(Request $request){
		$errmsg = '';
		$event = \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return view('ereg.noevent')->with(['msg' => $msg]);
		}

		$msg = '';

		$input = $request->all();
		$attr = array(
			'vis_code' => 'Barcode',
			'vis_fname' => 'First Name',
			'vis_mname' => 'Middle Name',
			'vis_lname' => 'Last Name',
			'vis_email' => 'Email',
			'vis_gsm' => 'Mobile',
			'vis_enabled' => 'Enabled',
			'vis_age' => 'Age',
			'vis_address' => 'Address',
			'vis_barangay' => 'Barangay',
			'vis_province' => 'Province',
			'vis_municipality' => 'Municipality',
			'vis_company' => 'Company',
			'gender_id' => 'Gender',
			'region_id' => 'Region',
			// 'civil_id' => 'Civil Status',
		);
		$rules = array(
			'vis_age' => 'integer',
			'vis_email' => 'email',
			'vis_fname' => 'required|min:1',
		);

		$val = Validator::make($input, $rules);
		$val->setAttributeNames($attr);

		if ($val->fails()){
			return redirect('register')->withInput()->withErrors($val);
		}

		$row = new \App\Visitor;
		
		$row->event_id = $event->event_id;
		$row->vis_fname = $request->input('vis_fname');
		$row->vis_mname = $request->input('vis_mname');
		$row->vis_lname = $request->input('vis_lname');
		$row->vis_gsm = $request->input('vis_gsm');
		$row->vis_age = $request->input('vis_age');
		$row->vis_company = $request->input('vis_company');
		$row->gender_id = $request->input('gender_id');
		// $row->civil_id = $request->input('civil_id');
		$row->region_id = $request->input('region_id');
		$row->class_id = $request->input('class_id');
		$row->vis_municipality = $request->input('vis_municipality');
		$row->vis_province = $request->input('vis_province');
		$row->vis_address = $request->input('vis_address');
		$row->vis_email = $request->input('vis_email');
				
		$code = $this->getNewBarcode();
		$batch = str_pad($code['batch'].'',4,'0', STR_PAD_LEFT);
		$serial = str_pad($code['serial'].'',4,'0', STR_PAD_LEFT);

		$barcode = $batch.$serial;

		$row->vis_code = $barcode;
		$row->vis_batch = $batch;
		$row->vis_serial = $serial;
		// $row->vis_day = $request->input('vis_day');
		$row->save();

		$today = strtotime(date('Y-m-d'));
		$eventFrom = strtotime($event->event_from);
		$eventTo = strtotime($event->event_to);

		if($today >= $eventFrom){
			if($today <= $eventTo){
				$countVis = new \App\CounterVisitor;
				$visitor = \App\VWVisitor::where('vis_code', $barcode)->first();
				$countVis->vis_id = $visitor->vis_id;
				$countVis->counter_id= $visitor->vis_id;
				$countVis->save();
				if($request->input('vis_email') != ""){
					$visitor = \App\VWVisitor::where('vis_id', $row->vis_id)->first();
					try{
						//Mail::to($row->vis_email)->bcc('rstw.dost3@gmail.com')->send(new ConfirmRegistration($visitor, $event));
						$errmsg = 'Registration complete and you are now Sign IN. Please check your email. '.$request->input('vis_fname');
					} catch(Exception $e){
						$errmsg = 'Registration complete and you are now Sign IN '.$request->input('vis_fname');
					}
				}else{
					$errmsg = 'Registration complete. '.$request->input('vis_fname');
				}
						
			}else{
				if($request->input('vis_email') != ""){
					$visitor = \App\VWVisitor::where('vis_id', $row->vis_id)->first();
					try{
						//Mail::to($row->vis_email)->bcc('rstw.dost3@gmail.com')->send(new ConfirmRegistration($visitor, $event));
						$errmsg = 'Registration complete. Please check your email. '.$request->input('vis_fname');
					} catch(Exception $e){
						$errmsg = 'Registration complete. '.$request->input('vis_fname');
					}
				}else{
					$errmsg = 'Registration complete. '.$request->input('vis_fname');
				}
			}
		}else{
			$errmsg = 'Registration complete. '.$request->input('vis_fname');
		}
		
		Session::put('errmsg', $errmsg);
		Session::put('barcode', '');

		return redirect('register');
	}

	public function cancel(){
		Session::put('barcode', '');
		return redirect('register');
	}

	public function finished(){
		Session::put('barcode', '');
		return redirect('register');
	}

	public static function randName($p_prefix,$p_ext){
		$s='';
		for ($i = 0; $i < 7; $i++){
			$s .= chr(rand(97,122));
		}
		$s = "$p_prefix-$s-".date('Ymd_His').".$p_ext";
		return $s;
	}

	public function getprovinces(){
		$province = \App\Province::orderBy('name','ASC')->lists('name', 'id')->toArray();
		$provlist = array_merge([''=>'Please Select'],$province);
		echo '<table>';
		foreach ($provlist as $id => $value) {
			echo '<tr><td>';
			echo $id.'</td><td>'.$value;
			echo '</td></tr>';
		}
		echo '</table>';
	}
	public function get_provinces(Request $request){
		$id = $request->get('id');
		$provinces = \App\Province::where('regionId', $id)
				->orderBy('name','ASC')
				->get();
		$output='<option value>Please Select</option>';
		foreach ($provinces as $prov) {
			$output .= '<option value="'.$prov->id.'">'.$prov->name.'</option>';
		}
		return $output;
	}
	public function get_municipality(Request $request){
		$id = $request->get('id');
		$municipality = \App\Municipality::where('provinceId', $id)
				->orderBy('name','ASC')
				->get();
		$output='<option value>Please Select</option>';
		foreach ($municipality as $mun) {
			$output .= '<option value="'.$mun->id.'">'.$mun->name.'</option>';
		}
		return $output;
	}
	public function get_mun($id){
		// $id = $request->get('id');
		$municipality = \App\Municipality::where('provinceId', $id)
				->orderBy('name','ASC')
				->get();
		$output='<option value>Please Select</option>';
		foreach ($municipality as $mun) {
			$output .= '<option value="'.$mun->id.'">'.$mun->name.'</option>';
		}
		return $output;
	}
	public function getmunicipality(){
		$municipality = \App\Municipality::orderBy('name','ASC')->lists('name', 'id')->toArray();
		$list = array_merge([''=>'Please Select'],$municipality);
		$arr = [];
		echo '<table>';
		foreach ($list as $id => $value) {
			echo '<tr><td>';
			echo $id.'</td><td>'.$value;
			echo '</td></tr>';
			if($id!=""){
				array_push($arr, [
					'id'=>$id,
					'name'=>$value
				]);
			}
			
		}
		echo '</table>';
		\App\Munlist::insert($arr);
	}
	public function getNewBarcode(){

		$eid = 0;
		$event = \App\Event::where('event_active', 1)->first();

		if ($event){
			$eid = $event->event_id;
		}

		$codes = \App\Barcode::where('event_id', $eid)->orderBy('barcode_batch', 'DESC')->orderBy('barcode_serial', 'DESC')->first();
		
		$batch = 0;
		$serial = 0;

		if ($codes){
			$batch = $codes->barcode_batch;
			$serial = $codes->barcode_serial;
		}

		$serial++;
		if ($serial > 9999){
			$batch++;
			$serial = 0;
		}
		$batched = str_pad($batch.'',4,'0', STR_PAD_LEFT);
		$serialed = str_pad($serial.'',4,'0', STR_PAD_LEFT);

		$bar = new \App\Barcode;
		$bar->barcode_code = $batched.$serialed;
		$bar->event_id = $eid;
		$bar->barcode_batch = $batch;
		$bar->barcode_serial = $serial;
		
		$res = array();
		$res['batch'] = $batch;
		$res['serial'] = $serial;

		$bar->save();
		return $res;
	}

}
