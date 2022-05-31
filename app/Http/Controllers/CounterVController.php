<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;
use Input;

class CounterVController extends Controller {

	public $attempts = 0;

	public function index($id)
	{
		$msg = '';

		$event = \App\Event::where('event_active', 1)->first();
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			//return redirect('register');
		}

		$msg = Session::pull('errmsg', '');

		return view('counterv.index')->with(['msg' => $msg, 'id' => $id, 'event' => $event]);
	}

	public function add(Request $request, $id){

		$event = \App\Event::where('event_active', 1)->first();
		$msg = '';
		if (!$event){
			$msg = 'No active events are taking place.';
			Session::put('errmsg', $msg);
			return redirect('/counterv/'.$id);
		}

		$input = $request->all();
		$attr = array(
			'barcode-eval' => 'Barcode'
		);
		$rules = array(
			'barcode-eval' => 'required'
		);

		$val = Validator::make($input, $rules);
		$val->setAttributeNames($attr);

		if ($val->fails()){
			$msg = 'Barcode is required.';
  			Session::put('errmsg', $msg);
			return redirect('/counterv/'.$id)->withInput()->withErrors($val);
		} 

	    $vis = \App\Visitor::where('vis_code', $request->input('barcode-eval'))->first();
		if (!$vis){
			$msg = 'Barcode unregistered.';
			Session::put('errmsg', $msg);
			return redirect('/counterv/'.$id);
		}

		$row = new \App\CounterVisitor;

		$row->vis_id = $vis->vis_id;
		$row->counter_id = $id;
		$row->save();

		$msg = 'Barcode Registered!';
		Session::put('errmsg', $msg);
		return redirect('/counterv/'.$id);
	}

}
