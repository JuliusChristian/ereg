<?php $__env->startSection('content'); ?>
<?php

$genders = \App\Gender::lists('gender_name', 'gender_id');
$civil = \App\CivilStatus::lists('civil_name', 'civil_id');
$classes = \App\Classification::lists('class_name', 'class_id');
$regions = \App\Region::lists('region_name', 'region_id');
$province = \App\Province::where('regionId',5)->orderBy('name','ASC')->get();
$municipality = \App\Municipality::orderBy('name','ASC')->get();

?>
<?php echo Form::model($row, ['id' => 'ereg-form', 'name' => 'ereg-form', 'url' => URL::to('register/save'), 'class' => 'form', 'role' => 'form', 'autocomplete' => 'off']); ?>

<div class="row">
	<div class="col-sm-6">
		<!--
		***************************************************************************************************************************
		-->
		<div class="row">
			<!-- <div class="row">
				<h4 class="alert alert-info text-left">Registration.</h4>
			</div>	 -->
			<br>
			<?php if(strlen($msg) > 0): ?>
			<div class="row">
				<div class="alert alert-success"><?php echo e($msg); ?></div>
			</div>
			<?php endif; ?>

			<div class="row text-left">

				<!-- <div class="form-group">
				<label for="vis_code" class="control-label">Code</label>
				<?php echo Form::text('vis_code', NULL, ['id' => 'vis_code', 'class'=>'form-control input-sm', 'required', 'maxlength'=>255]); ?>

				</div> -->
				<div class="row">

					<div class="form-group col-sm-4">
						<label for="vis_lname" class="control-label">Last Name</label>
						<?php echo Form::text('vis_lname', NULL, ['id' => 'vis_lname', 'class'=>'form-control input-sm', 'required', 'maxlength'=>255, 'autofocus'=>'autofocus' ]); ?>

					</div>

					<div class="form-group col-sm-4">
						<label for="vis_fname" class="control-label">First Name</label>
						<?php echo Form::text('vis_fname', NULL, ['id' => 'vis_fname', 'class'=>'form-control input-sm', 'required', 'maxlength'=>255]); ?>

					</div>

					<div class="form-group col-sm-4">
						<label for="vis_mname" class="control-label">Middle Name</label>
						<?php echo Form::text('vis_mname', NULL, ['id' => 'vis_mname', 'class'=>'form-control input-sm', 'maxlength'=>255]); ?>

					</div>

				</div>

				<div class="row">
					<div class="form-group col-sm-6">
					<label for="vis_email" class="control-label">Email</label>
					<?php echo Form::email('vis_email', NULL, ['id' => 'vis_email', 'class'=>'form-control input-sm', 'maxlength'=>255]); ?>

					</div>

					<div class="form-group col-sm-6">
					<label for="vis_gsm" class="control-label">Mobile</label>
					<?php echo Form::text('vis_gsm', NULL, ['id' => 'vis_gsm', 'class'=>'form-control input-sm', 'maxlength'=>255]); ?>

					</div>
				</div>

				<div class="row">
					<div class="form-group col-sm-6">
						<?php echo Form::label('vis_age', 'Age', array('class' => 'control-label')); ?>

				        <?php echo Form::number('vis_age', NULL, ['class'=>'form-control input-sm', 'placeholder'=>'Age', 'maxlength'=>'3', 'min'=>'1', 'max'=>'200', 'required']); ?>

					</div>

					<div class="form-group col-sm-6">
						<?php echo Form::label('gender_id', 'Sex', array('class' => 'control-label')); ?>

						<?php echo Form::select('gender_id', $genders, NULL, ['class'=>'form-control input-sm']); ?>

					</div>
				</div>

				<div class="row">
					<div class="form-group col-sm-6">
						<?php echo Form::label('vis_fname', 'Company / Institution', array('class' => 'control-label')); ?>

						<?php echo Form::text('vis_company', NULL, ['id' => 'vis_company', 'class'=>'form-control input-sm', 'maxlength'=>255]); ?>

					</div>
					<div class="form-group col-sm-6">
						<?php echo Form::label('class_id', 'Classification', array('class' => 'control-label')); ?>

						<?php echo Form::select('class_id', $classes, NULL, ['class'=>'form-control input-sm']); ?>

					</div>
				</div>
			
				<div class="row">
					<div class="form-group col-sm-12">
						<?php echo Form::label('region_id', 'Region', array('class' => 'control-label')); ?>

						<?php echo Form::select('region_id', $regions, NULL, ['class'=>'form-control input-sm']); ?>

					</div>	
					
				</div>
				
				<div class="row">
					<div class="form-group col-sm-6">
						<?php echo Form::label('vis_province', 'Province', array('class' => 'control-label')); ?>

						<select name="vis_province" id="vis_province" class="form-control input-sm">
						  <option value="">Please Select</option>	
						  <?php foreach($province as $prov): ?>
						    <option value="<?php echo e($prov->id); ?>"><?php echo e($prov->name); ?></option>
						  <?php endforeach; ?>
						</select>
					</div>	
					<div class="form-group col-sm-6">
						<?php echo Form::label('vis_municipality', 'Municipality / City', array('class' => 'control-label')); ?>

						<select name="vis_municipality" id="vis_municipality" class="form-control input-sm">
						  <option value="">Please Select</option>	
						  <?php foreach($municipality as $mun): ?>
						    <option value="<?php echo e($mun->id); ?>"><?php echo e($mun->name); ?></option>
						  <?php endforeach; ?>
						</select>
					</div>	
				</div>
				<div class="row">
					<div class="form-group col-sm-12">
						<?php echo Form::label('vis_address', 'Address', array('class' => 'control-label')); ?>

						<?php echo Form::text('vis_address', NULL, ['id' => 'vis_address', 'class'=>'form-control input-sm', 'maxlength'=>255]); ?>

					</div>	
				</div>
					<?php echo e(csrf_field()); ?>

				<div class="form-group">
					<?php echo Form::submit('Continue' , ['class'=>'btn btn-primary btn-block']); ?>

				</div>

			</div>
		</div>


	</div>
	<div class="col-sm-1">
	</div>
	<div class="col-sm-5">
		<?php if(strlen($event->event_image) > 0): ?>
		<img class="img-responsive" src="<?php echo e(asset('uploads/'.$event->event_image)); ?>">
		<?php endif; ?>
	</div>
</div>

	<?php echo Form::hidden('vis_batch', NULL); ?>

	<?php echo Form::hidden('vis_serial', NULL); ?>

	<?php echo Form::hidden('event_id', NULL); ?>


<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ereg_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>