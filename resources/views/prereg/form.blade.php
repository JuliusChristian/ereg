@extends('layouts.ereg_layout')
@section('content')
<?php

$genders = \App\Gender::lists('gender_name', 'gender_id');
$civil = \App\CivilStatus::lists('civil_name', 'civil_id');
$classes = \App\Classification::lists('class_name', 'class_id');
$regions = \App\Region::lists('region_name', 'region_id');

?>
@if (strlen($msg) > 0)
<div class="alert alert-info">{{ $msg }}</div>
@endif

{!! Form::model($row, ['id' => 'ereg-form', 'name' => 'ereg-form', 'url' => URL::to('register/save'), 'class' => 'form', 'role' => 'form', 'autocomplete' => 'off']) !!}
<div class="row">
	<div class="col-sm-6">

		<!--
		***************************************************************************************************************************
		-->
		<div class="row">
			<div class="row q-item">
				<h4 class="q-question">Registration.</h4>
			</div>

			<div class="row text-left" style="padding:20px;">

				<div class="form-group">
				<label for="vis_code" class="control-label">Code</label>
				{!! Form::text('vis_code', NULL, ['id' => 'vis_code', 'class'=>'form-control input-sm', 'required', 'maxlength'=>255]) !!}
				</div>


				<div class="form-group">
				<label for="vis_fname" class="control-label">First Name</label>
				{!! Form::text('vis_fname', NULL, ['id' => 'vis_fname', 'class'=>'form-control input-sm', 'required', 'maxlength'=>255]) !!}
				</div>

				<div class="form-group">
				<label for="vis_mname" class="control-label">Middle Name</label>
				{!! Form::text('vis_mname', NULL, ['id' => 'vis_mname', 'class'=>'form-control input-sm', 'maxlength'=>255]) !!}
				</div>

				<div class="form-group">
				<label for="vis_lname" class="control-label">Last Name</label>
				{!! Form::text('vis_lname', NULL, ['id' => 'vis_lname', 'class'=>'form-control input-sm', 'required', 'maxlength'=>255]) !!}
				</div>

				<div class="form-group">
				<label for="vis_email" class="control-label">Email</label>
				{!! Form::email('vis_email', NULL, ['id' => 'vis_email', 'class'=>'form-control input-sm', 'maxlength'=>255]) !!}
				</div>

				<div class="form-group">
				<label for="vis_gsm" class="control-label">Mobile</label>
				{!! Form::text('vis_gsm', NULL, ['id' => 'vis_gsm', 'class'=>'form-control input-sm', 'maxlength'=>255]) !!}
				</div>

				<div class="form-group">
					{!! Form::label('vis_age', 'Age', array('class' => 'control-label')) !!}
			        {!! Form::number('vis_age', NULL, ['class'=>'form-control input-sm', 'placeholder'=>'Age', 'maxlength'=>'3', 'min'=>'1', 'max'=>'200', 'required']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('gender_id', 'Gender', array('class' => 'control-label')) !!}
					{!! Form::select('gender_id', $genders, NULL, ['class'=>'form-control input-sm']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('civil_id', 'Civil Status', array('class' => 'control-label')) !!}
					{!! Form::select('civil_id', $civil, NULL, ['class'=>'form-control input-sm']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('region_id', 'Regions', array('class' => 'control-label')) !!}
					{!! Form::select('region_id', $regions, NULL, ['class'=>'form-control input-sm']) !!}
				</div>


				<div class="form-group">
				<label for="vis_fname" class="control-label">Company</label>
				{!! Form::text('vis_company', NULL, ['id' => 'vis_company', 'class'=>'form-control input-sm', 'maxlength'=>255]) !!}
				</div>


				<div class="form-group">
					{!! Form::label('class_id', 'Classification', array('class' => 'control-label')) !!}
					{!! Form::select('class_id', $classes, NULL, ['class'=>'form-control input-sm']) !!}
				</div>

			</div>
		</div>


	</div>

	<div class="col-sm-6">
		<img class="img-responsive" src="{{ asset('uploads/'.$event->event_image) }}">
	</div>
</div>

<div class="row">

	<div class="col-sm-6">
		{!! Form::submit('Continue' , ['class'=>'btn btn-default btn-block']) !!}
	</div>
	<div class="col-sm-6">
		
	</div>
</div>
	{!! Form::hidden('vis_batch', NULL) !!}
	{!! Form::hidden('vis_serial', NULL) !!}
	{!! Form::hidden('event_id', NULL) !!}

{!! Form::close() !!}
@endsection
