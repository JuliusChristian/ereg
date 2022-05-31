<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<?php if(strlen($msg) > 0): ?>
		<div class="alert alert-info">
			<?php echo e($msg); ?>

		</div>
		<?php endif; ?>

		<div class="clearfix">
			<h3 class="panel-title pull-left"><?php echo e($rows->total()); ?> Attendees</h3>
			<div class="pull-right">
				<a class="btn btn-success btn-xs" href="<?php echo e(URL::to('/attendees/print/'.$day)); ?>" target="_blank" title="Print" role="button"><span class="fa fa-print"></span> Print</a>
				<!-- <a class="btn btn-success btn-xs" href="<?php echo e(URL::to('/attendees/download/'.$day)); ?>" target="_blank" title="Print" role="button"><span class="fa fa-download"></span> Download</a> -->
			</div>
		</div>
	</div>
	<div class="panel-body">
		<?php echo Form::open(array('name' => 'search_form', 'url' => URL::to('attendees'), 'class'=>'form-inline', 'role' => 'form')); ?>

			<div class="form-group">

				<div class="input-group input-group-sm">
					<span class="input-group-addon">Select Day</span>
					<?php echo Form::select('qt', [
						'2019-07-30' => '1st Day',
					   	'2019-07-31' => '2nd Day',
					   	'2019-08-01' => '3rd Day'],
					   	$day, ['class' => 'form-control input-sm']); ?>

				</div>

				<div class="input-group input-group-sm">					
					<span class="input-group-btn">
						<input class="btn btn-default btn-sm" type="submit" value="Search" name="search-btn" id="search-btn">
					</span>
				</div>
			</div>
		<?php echo Form::close(); ?>

	</div>
	<div class="panel-footer pagination-links">
		<?php echo e($rows->links()); ?>

	</div>
	<div class="row">
		
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-condensed table-striped table-hover">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Code</th>
					<th class="text-center">Name</th>
					<th class="text-center">Gender</th>
					<th class="text-center">Company</th>
					<th class="text-center">Mobile</th>
					<th class="text-center">Email</th>
					<th class="text-center">Region</th>
					<th class="text-center">Class</th>					
					<th class="text-center">Timestamp</th>
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
			    <tr>
					<td class="text-center"><?php echo e($i); ?></td>
					<td><?php echo e($row->visitor->vis_code); ?></td>
					<td><?php echo e($row->visitor->vis_fname); ?> <?php echo e($row->visitor->vis_mname); ?> <?php echo e($row->visitor->vis_lname); ?></td>
					<td><?php echo e(App\Gender::where('gender_id', $row->visitor->gender_id)->value('gender_name')); ?></td>
					<td><?php echo e($row->visitor->vis_company); ?></td>
					<td><?php echo e($row->visitor->vis_gsm); ?></td>
					<td><?php echo e($row->visitor->vis_email); ?></td>
					<td><?php echo e(App\Region::where('region_id', $row->visitor->region_id)->value('region_name')); ?></td>
					<td><?php echo e(App\Classification::where('class_id', $row->visitor->class_id)->value('class_name')); ?></td>					
					<td><?php echo e($row->created_at); ?></td>
				</tr>
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
		0: { sorter: true}
		}
	};
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>