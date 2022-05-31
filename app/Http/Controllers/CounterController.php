<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Visitor;
use DB;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CounterController extends Controller {

	public function index() {
		$msg 	= '';

		$event 	= \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg= 'No active events are taking place.';
			Session::put('errmsg', $msg);			
		}

		$msg 	= Session::pull('errmsg', '');

		return view('counter.index')->with(['msg' => $msg, 'event' => $event]);
	}

	public function add(Request $request){
		$id 	= Input::get('barcode-eval');

		$event 	= \App\Event::where('event_active', 1)->first();
		$msg 	= '';
		if (!$event){
			$msg= 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return redirect('/counterv');
		}

		$input 	= $request->all();
		$attr 	= array(
			'barcode-eval' => 'Barcode'
		);
		$rules 	= array(
			'barcode-eval' => 'required'
		);

		$val 	= Validator::make($input, $rules);
		$val->setAttributeNames($attr);

		if ($val->fails()){
			$msg= 'Barcode is required.';
  			Session::put('errmsg', $msg);
			return redirect('/counter')->withInput()->withErrors($val);
		}



		//barcode scanning processing.
		$barcodeNum = $request->input('barcode-eval');
	    // $vis = \App\Visitor::where('vis_code', $barcodeNum)->first();
	    // $vis = Visitor::where('vis_code', $barcodeNum)->first();
		$vis = DB::table('er_visitors')->where('vis_code', $barcodeNum)->first();
		if (!$vis){
			$msg= 'Barcode unregistered.';
			Session::put('errmsg', $msg);
			return redirect('/counter');
		}
		$today = date('Y-m-d');
		$id = $vis->vis_id;
		$rows 	= \App\CounterVisitor::where([['created_at', 'LIKE', "$today%"],['vis_id','=',"$id"]])->count();
		// print_r($rows);
		if ($rows > 0){
			$msg= 'Barcode already registered.';
			Session::put('errmsg', $msg);
			return redirect('/counter');
		}

		$row 			= new \App\CounterVisitor;
		$row->vis_id 	= $vis->vis_id;
		$row->counter_id= $id;
		$row->save();

		$msg 			= 'Barcode Registered!';
		Session::put('errmsg', $msg);
		return redirect('/counter');
	}
}