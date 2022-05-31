<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;
use Input;

class EvalController extends Controller {

	public $attempts = 0;

	private static $debug = 1;

	public function index()
	{
		$barcode = '';
		$msg = '';

		$event = \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return redirect('evaluate');
		}

		$msg = Session::pull('errmsg', '');
		$row = new \App\Evaluation;
		return view('eval.form')->with(['row' => $row, 'msg' => $msg, 'barcode' => $barcode, 'event' => $event]);
	}


	public function show_form(){
		
		$barcode = '';
		$msg = '';

		$event = \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return redirect('evaluate');
		}

		$msg = Session::pull('errmsg', '');

		$row = new \App\Evaluation;
		return view('eval.form')->with(['row' => $row, 'msg' => $msg, 'barcode' => $barcode, 'event' => $event]);
	}

	public function save(Request $request){

		$barcode = uniqid('NONE', true);
		$msg = '';

		$event = \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return redirect('evaluate');
		}

		$input = $request->all();
		$attr = array(
			'eval_rating_overall' => 'Overall rating.'
		);
		$rules = array(
			'eval_rating_overall' => 'required'
		);

		$val = Validator::make($input, $rules);
		$val->setAttributeNames($attr);

		if ($val->fails()){
			return redirect('evaluate')->withInput()->withErrors($val);
		}

		$row = new \App\Evaluation;

		$row->event_id = $event->event_id;

		$row->eval_firsttime = $request->input('eval_firsttime');
		$row->eval_rating_overall = $request->input('eval_rating_overall');

		$referer = $request->input('eval-ref');

		if (in_array('1', $referer)){
			$row->eval_ref_1 = 1;
		} else {
			$row->eval_ref_1 = 0;
		}

		if (in_array('2', $referer)){
			$row->eval_ref_2 = 1;
		} else {
			$row->eval_ref_2 = 0;
		}

		if (in_array('3', $referer)){
			$row->eval_ref_3 = 1;
		} else {
			$row->eval_ref_3 = 0;
		}

		if (in_array('4', $referer)){
			$row->eval_ref_4 = 1;
		} else {
			$row->eval_ref_4 = 0;
		}

		if (in_array('5', $referer)){
			$row->eval_ref_5 = 1;
		} else {
			$row->eval_ref_5 = 0;
		}

		if (in_array('6', $referer)){
			$row->eval_ref_6 = 1;
		} else {
			$row->eval_ref_6 = 0;
		}

		if (in_array('7', $referer)){
			$row->eval_ref_7 = 1;
		} else {
			$row->eval_ref_7 = 0;
		}

		if (in_array('8', $referer)){
			$row->eval_ref_8 = 1;
		} else {
			$row->eval_ref_8 = 0;
		}

		$row->save();

		Session::put('eval_id', $row->eval_id);

		return redirect('evaluate/selfie_form');
	}

	public function selfie_form(){
		$event = \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return redirect('evaluate');
		}

		$msg = Session::pull('errmsg', '');

		$eval_id = Session::get('eval_id', '');
		$msg = '';
		if (strlen($eval_id) == 0){
			$msg = 'Evaluation required.';
			Session::put('errmsg', $msg);
			return redirect('evaluate');
		}

		return view('eval.selfie_form')->with(['msg' => $msg, 'eval_id' => $eval_id, 'event' => $event]);
	}

	public function selfie_save(Request $request){

		$event = \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return redirect('evaluate');
		}
		
		$eval_id = Session::get('eval_id', '');
		$msg = '';
		if (strlen($eval_id) == 0){
			$msg = 'Evaluation required.';
			Session::put('errmsg', $msg);
			return redirect('evaluate');
		}

		$row = \App\Evaluation::where('eval_id', $eval_id)->first();
		if (!$row){
			$msg = 'Evaluation not found.';
			Session::put('errmsg', $msg);
			return redirect('evaluate');
		}

		$dest_path = realpath('./uploads');

		if (!$request->hasFile('eval_file')) {
			return redirect('evaluate/thanks');
		}
			
		$src = $request->file('eval_file')->getRealPath();
		$orig_fn = $request->file('eval_file')->getClientOriginalName();
		$orig_ext = $request->file('eval_file')->getClientOriginalExtension();

		$ext = pathinfo($orig_fn, PATHINFO_EXTENSION);
		$filename = basename($orig_fn, '.'.$ext);

		$dest_fn = EvalController::randName($filename, $ext);
		//$new_path = $dest_path.DIRECTORY_SEPARATOR.$dest_fn;

		$request->file('eval_file')->move($dest_path, $dest_fn);

		$row->eval_file = $dest_fn;
		//$row->re_pdf = $orig_fn;

		$row->save();

		Session::put('eval_file', $row->eval_file);

		return redirect('evaluate/thanks');

	}

	public function show_thanks(){
		
		$msg = Session::pull('errmsg', '');
		$eval_file = Session::get('eval_file', '');

		return view('eval.thanks')->with(['msg' => $msg, 'eval_file' => $eval_file]);
	}

	public function cancel(){
		Session::put('barcode', '');
		return redirect('evaluate');
	}

	public function finished(){
		Session::put('barcode', '');
		return redirect('evaluate');
	}

	public static function randName($p_prefix,$p_ext){
		$s='';
		for ($i = 0; $i < 7; $i++){
			$s .= chr(rand(97,122));
		}
		$s = "$p_prefix-$s-".date('Ymd_His').".$p_ext";
		return $s;
	}


	public function eval_print(){
		$rows = \App\VWEvaluation::all();
		return view('eval.eval_print', compact('rows'));
	}


}
