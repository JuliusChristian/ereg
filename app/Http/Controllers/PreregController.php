<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;
use Input;

class PreregController extends Controller {

	public $attempts = 0;

	public function index(){

		$event = \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return view('prereg.noevent')->with(['msg' => $msg]);
		}

		$code = ['serial' => '0000' , 'batch' => '0000']; // VisitorsController::getNewBarcode();
		$batch = str_pad($code['batch'].'',4,'0', STR_PAD_LEFT);
		$serial = str_pad($code['serial'].'',4,'0', STR_PAD_LEFT);

		$barcode = $batch.$serial;
		$msg = Session::pull('errmsg', '');

		$row = new \App\Visitor;
		$row->region_id = 6;
		$row->event_id = $event->event_id;
		$row->vis_code = '';
		$row->vis_batch = $code['batch'];
		$row->vis_serial = $code['serial'];
		return view('prereg.form')->with(['row' => $row, 'msg' => $msg, 'barcode' => $barcode, 'event' => $event]);
	}

	public function save(Request $request){

		$event = \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return view('prereg.noevent')->with(['msg' => $msg]);
		}

		$msg = '';

		/*
		$barcode = Session::pull('barcode','');
        $vis = \App\Visitor::where('vis_code', $barcode)->first();
		if ($vis){
			Session::put('errmsg', 'Barcode already registered.');
			return redirect('register');
		}
		*/

		$input = $request->all();
		$attr = array(
			'vis_fname' => 'First Name',
			'vis_mname' => 'Middle Name',
			'vis_lname' => 'Last Name',
			'vis_email' => 'Email',
			'vis_gsm' => 'Mobile',
			'vis_enabled' => 'Enabled',
			'vis_age' => 'Age',
			'vis_company' => 'Company',
			'gender_id' => 'Gender',
			'civil_id' => 'Civil Status',
		);
		$rules = array(
			'vis_code' => 'required|unique:er_visitors',
			'vis_age' => 'integer',
			'vis_email' => 'email',
			'vis_fname' => 'required|min:1',
		);

		$val = Validator::make($input, $rules);
		$val->setAttributeNames($attr);

		if ($val->fails()){
			return redirect('prereg')->withInput()->withErrors($val);
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
		$row->civil_id = $request->input('civil_id');
		$row->region_id = $request->input('region_id');
		$row->class_id = $request->input('class_id');

		$row->vis_code = $request->input('vis_code');
		$row->vis_batch = $request->input('vis_batch');
		$row->vis_serial = $request->input('vis_serial');
		
		$row->save();


		$gen = new \Picqer\Barcode\BarcodeGeneratorPNG();


		Session::put('errmsg', 'Pre-Registration Complete.');
		Session::put('barcode', '');

		return redirect('prereg/thanks');
	}

	public function cancel(){
		Session::put('barcode', '');
		return redirect('prereg');
	}

	public function finished(){
		Session::put('barcode', '');
		return redirect('prereg');
	}

	public static function randName($p_prefix,$p_ext){
		$s='';
		for ($i = 0; $i < 7; $i++){
			$s .= chr(rand(97,122));
		}
		$s = "$p_prefix-$s-".date('Ymd_His').".$p_ext";
		return $s;
	}


}
