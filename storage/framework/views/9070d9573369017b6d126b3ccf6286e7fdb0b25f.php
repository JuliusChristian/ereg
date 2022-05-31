<?php $__env->startSection('content'); ?>
<?php if(strlen($msg) > 0): ?>
<div class="alert alert-danger text-center big">
	<?php echo e($msg); ?>

</div>
<?php endif; ?>

<div class="text-center">
	<h3>Scan barcode to register...</h3>
</div>
<?php echo Form::open(['id' => 'barcode-form', 'name' => 'barcode-form', 'url' => URL::to('/counter/add'), 'class' => 'form', 'role' => 'form', 'autocomplete' => 'off']); ?>

	<div class="form-group"> 
		<input id="barcode-eval" name="barcode-eval" class="barcode-input" type="text" maxlength="255">
	</div>
<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ereg_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>