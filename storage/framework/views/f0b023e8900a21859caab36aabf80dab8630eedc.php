<?php $__env->startSection('content'); ?>
	<div class="container">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<h4 class="panel-title">Please Sign-In</h4>
					</div>
					<div class="panel-body">
						<?php if(strlen($msg) > 0): ?>
						<div class="alert alert-danger text-center">
							<?php echo e($msg); ?>

						</div>
						<?php endif; ?>

						<?php echo Form::open(array('name' => 'input_form', 'url' => URL::to('/login'), 'class' => 'form', 'role' => 'form')); ?>


						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">Username</span>
								<?php echo Form::text('username', NULL, array('class' => 'form-control', 'placeholder' => 'Username', 'maxlength' => '255', 'required')); ?>

							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">Password</span>
								<?php echo Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'maxlength' => '255', 'required')); ?>

							</div>
						</div>

						<?php echo Form::submit('Sign In' , ['class'=>'btn btn-primary btn-block']); ?>

						<?php echo Form::close(); ?>

						
					</div>
					<div class="panel-footer"></div>
				</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ereg_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>