@extends('layouts.master_layout')
@section('content')
<div class="text-center">
@if (strlen($msg) > 0)
	<div class="row">
		<div class="alert alert-success">{{ $msg }}</div>
	</div>
@endif
	<h3>
		There are no active events taking place at this time.
		<br>
		Please try again later...
	</h3>
</div>

@endsection
