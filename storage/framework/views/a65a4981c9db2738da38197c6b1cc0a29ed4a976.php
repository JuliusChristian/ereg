<?php $__env->startSection('content'); ?>
<?php

$genders = \App\Gender::lists('gender_name', 'gender_id');
$status = \App\Status::lists('civil_name', 'civil_id');

$regions[0] = 'All';
foreach (\App\Region::orderBy('region_name', 'ASC')->lists('region_name', 'region_id') as $key => $val){
	$regions[$key] = $val;
}

$events[0] = 'All';
foreach (\App\Event::orderBy('event_title', 'ASC')->lists('event_title', 'event_id') as $key => $val){
	$events[$key] = $val;
}

$classes[0] = 'All';
foreach (\App\Classification::orderBy('class_name', 'ASC')->lists('class_name', 'class_id') as $key => $val){
	$classes[$key] = $val;
}

?>
<div class="panel panel-default">
	<div class="panel-heading">
		<?php if(strlen($msg) > 0): ?>
		<div class="alert alert-info">
			<?php echo e($msg); ?>

		</div>
		<?php endif; ?>

		<div class="clearfix">
			<h3 class="panel-title pull-left">Visitors</h3>
			<div class="pull-right">
				<a class="btn btn-success btn-xs" href="<?php echo e(URL::to('/visitors/print')); ?>" target="_blank" title="Print" role="button"><span class="fa fa-print"></span> Print</a>
				<a class="btn btn-success btn-xs" href="<?php echo e(URL::to('/visitors/download')); ?>" target="_blank" title="Print" role="button"><span class="fa fa-download"></span> Download</a>
				<a class="btn btn-success btn-xs" href="<?php echo e(URL::to('/visitors/add')); ?>" title="Add Item" role="button"><span class="fa fa-plus"></span> Add Item</a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<?php echo Form::open(array('name' => 'search_form', 'url' => URL::to('visitors'), 'class'=>'form-inline', 'role' => 'form')); ?>

			<div class="form-group">

				<div class="input-group input-group-sm">
					<span class="input-group-addon">Region</span>
					<?php echo Form::select('qt', $regions, $qt, ['class'=>'form-control input-sm']); ?>

				</div>

				<div class="input-group input-group-sm">
					<span class="input-group-addon">Event</span>
					<?php echo Form::select('qt1', $events, $qt1, ['class'=>'form-control input-sm']); ?>

				</div>

				<div class="input-group input-group-sm">
					<span class="input-group-addon">Class</span>
					<?php echo Form::select('qt2', $classes, $qt2, ['class'=>'form-control input-sm']); ?>

				</div>

				<div class="input-group input-group-sm">
					<input class="form-control" type="text" maxlength="255" name="q" id="q" value="<?php echo e($q); ?>">
					<span class="input-group-btn">
						<input class="btn btn-default btn-sm" type="submit" value="Search" name="search-btn" id="search-btn">
					</span>
				</div>
			</div>
		<?php echo Form::close(); ?>

	</div>
	<div class="panel-body pagination-links">
		<?php echo e($rows->links()); ?>

	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-condensed table-striped table-hover">
		<thead>
			<tr>
				<?php if(App\Http\Controllers\LoginController::can_access()): ?>
				<th>&nbsp;</th>
				<?php endif; ?>
				<th class="text-center">#</th>
				<th class="text-center">Code</th>
				<th class="text-center">Name</th>
				<th class="text-center">Gender</th>
				<th class="text-center">Company</th>
				<th class="text-center">Mobile</th>

				<th class="text-center">Email</th>
				<th class="text-center">Region</th>
				<th class="text-center">Class</th>
				<th class="text-center">Event</th>
				<th class="text-center">Timestamp</th>
				<th class="text-center nowrap">To Attend On</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$perPage = $rows->perPage();
				$currentPage = $rows->currentPage();
				if($currentPage > 1){
					$i = $currentPage * $perPage - $perPage;
				}else{
					$i = 0; 
				} 
			?>
		    <?php foreach($rows as $row): ?>
		    <?php $i++; ?>
		    <?php echo $__env->make('visitors.index_row', ['row' => $row, 'i' => $i], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		    <?php endforeach; ?>
		</tbody>
		</table>
	</div>
	<div class="panel-footer pagination-links">
		<?php echo e($rows->links()); ?>

	</div>
</div>
<script type="text/javascript">
var _tsOptions = {
	headers:{
		0: { sorter: false}
		}
	};
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>