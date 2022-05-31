<?php $__env->startSection('content'); ?>
<?php

	$regions = \App\Region::lists('region_name', 'region_id');
	$events = \App\Event::lists('event_title', 'event_id');
	$sites = \App\Site::lists('site_name', 'site_id');
	$classifications = \App\Classification::lists('class_name', 'class_id');
	$genders = \App\Gender::lists('gender_name', 'gender_id');
	$status = \App\Status::lists('civil_name', 'civil_id');

?>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="clearfix">
			<h3 class="panel-title pull-left">Visitors <small>(<?php echo e(($id == 0) ? 'Add' : 'Edit'); ?>)</small></h3>
			<div class="pull-right">
				<a class="btn btn-success btn-xm" href="<?php echo e(URL::to('visitors')); ?>" title="Add" role="button"><span class="fa fa-arrow-left"></span> Back</a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<?php echo Form::model($row, array('name' => 'input_form', 'url' => URL::to('visitors/'.$id.'/save'), 'class' => 'form', 'role' => 'form', 'files' => true)); ?>


			<div class="form-group">
				<?php echo Form::label('vis_code', 'Barcode', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('vis_code')); ?></small></span>
				<?php echo Form::text('vis_code', NULL, array('class' => 'form-control', 'placeholder' => 'Barcode', 'maxlength' => '255')); ?>

			</div>

			<div class="form-group">
				<?php echo Form::label('region_id', 'Region', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('region_id')); ?></small></span>
				<?php echo Form::select('region_id', $regions, NULL, array('class' => 'form-control input-sm')); ?>

			</div>

			<div class="form-group">
				<?php echo Form::label('event_id', 'Event', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('event_id')); ?></small></span>
				<?php echo Form::select('event_id', $events, NULL, array('class' => 'form-control input-sm')); ?>

			</div>
			<!--
			<div class="form-group">
				<?php echo Form::label('site_id', 'Site', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('site_id')); ?></small></span>
				<?php echo Form::select('site_id', $sites, NULL, array('class' => 'form-control input-sm')); ?>

			</div>
			-->
			<div class="form-group">
				<?php echo Form::label('vis_company', 'Company', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('vis_company')); ?></small></span>
				<?php echo Form::text('vis_company', NULL, array('class' => 'form-control', 'placeholder' => 'Company', 'maxlength' => '255')); ?>

			</div>

			<div class="form-group">
				<?php echo Form::label('class_id', 'Classification', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('class_id')); ?></small></span>
				<?php echo Form::select('class_id', $classifications, NULL, array('class' => 'form-control input-sm')); ?>

			</div>

			<div class="form-group">
				<?php echo Form::label('vis_fname', 'First Name *', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('vis_fname')); ?></small></span>
				<?php echo Form::text('vis_fname', NULL, array('class' => 'form-control', 'placeholder' => 'First Name', 'maxlength' => '255', 'required')); ?>

			</div>

			<div class="form-group">
				<?php echo Form::label('vis_mname', 'Middle Name', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('vis_mname')); ?></small></span>
				<?php echo Form::text('vis_mname', NULL, array('class' => 'form-control', 'placeholder' => 'Middle Name', 'maxlength' => '255')); ?>

			</div>

			<div class="form-group">
				<?php echo Form::label('vis_lname', 'Last Name *', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('vis_lname')); ?></small></span>
				<?php echo Form::text('vis_lname', NULL, array('class' => 'form-control', 'placeholder' => 'Last Name', 'maxlength' => '255', 'required')); ?>

			</div>

			<div class="form-group">
				<?php echo Form::label('vis_age', 'Age', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('vis_age')); ?></small></span>
				<?php echo Form::number('vis_age', NULL, array('class' => 'form-control', 'placeholder' => 'Age', 'maxlength' => '3', 'min' => 0, 'step' => 1)); ?>

			</div>

			<div class="form-group">
				<?php echo Form::label('gender_id', 'Gender', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('gender_id')); ?></small></span>
				<?php echo Form::select('gender_id', $genders, NULL, array('class' => 'form-control input-sm')); ?>

			</div>

			<div class="form-group">
				<?php echo Form::label('civil_id', 'Civil Status', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('civil_id')); ?></small></span>
				<?php echo Form::select('civil_id', $status, NULL, array('class' => 'form-control input-sm')); ?>

			</div>

			<div class="form-group">
				<?php echo Form::label('vis_email', 'Email', array('class' => 'control-label')); ?>

				&nbsp;&nbsp;<span class="text-danger"><small><?php echo e($errors->first('vis_email')); ?></small></span>
				<?php echo Form::email('vis_email', NULL, array('class' => 'form-control', 'placeholder' => 'Email', 'maxlength' => '255')); ?>

			</div>


		<?php echo Form::submit('Save' , ['class'=>'btn btn-primary btn-block']); ?>


		<?php echo Form::hidden('vis_batch', NULL); ?>

		<?php echo Form::hidden('vis_serial', NULL); ?>

		<?php echo Form::close(); ?>

	</div>
	<div class="panel-footer">
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>