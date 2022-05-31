<?php namespace App\Http\Controllers;

use Session;
use Validator;
use App\Visitor;
use App\VWVisitor;
use App\CounterVisitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AttendeeController extends Controller {

	public function index(Request $request)
	{
		$qt = '';
		if(Input::get('qt')){
			$day 	= Input::get('qt');	
			Session::put($qt, $day);
		}elseif(Session::has($qt)){
			$day = Session::get($qt);
		}else{
			$day = date('Y-m-d');
		}
		
		$msg 	= Session::pull('errmsg', '');
		$rows 	= \App\CounterVisitor::where('created_at', 'LIKE', "$day%")->orderBy('counterv_id', 'ASC')->paginate(100);
		
		return view('attendees.index', compact('rows', 'msg', 'day','qt'));
	}

	public function print_list(Request $request, $id)
	{		
		$day 	= Input::get('qt');
		$rows 	= \App\CounterVisitor::where('created_at', 'LIKE', "$id%")->orderBy('counterv_id', 'ASC')->get();		

		return view('attendees.print', compact('rows', 'id'));
	}

	public function download_list(Request $request, $id)
	{
		$day 	= Input::get('qt');	
		$msg 	= Session::pull('errmsg', '');
		$rows 	= \App\CounterVisitor::where('created_at', 'LIKE', "$id%")->orderBy('counterv_id', 'ASC')->paginate(100);		

		$filename = "attendees_" . date('Y_m_d') . ".xls";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		return view('visitors.download', compact('rows', 'msg', 'day'));
	}
}