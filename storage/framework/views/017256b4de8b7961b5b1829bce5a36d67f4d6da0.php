<?php $__env->startSection('content'); ?>
<?php
$ctr = 0;
?>
<h3>Visitors</h3>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>Barcode</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Age</th>
			<th>Civil Status</th>
			<th>Company</th>
			<th>Mobile</th>
			<th>Email</th>
			<th>Region</th>
			<th>Classification</th>
			<th>Event</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($rows as $row): ?>
		<?php $ctr++; ?>
		<tr>
			<td><?php echo e($ctr); ?></td>
			<td><?php echo e($row->vis_code); ?></td>
			<td><?php echo e($row->vis_lname); ?>, <?php echo e($row->vis_fname); ?> <?php echo e($row->vis_mname); ?></td>
			<td><?php echo e($row->gender_name); ?></td>
			<td><?php echo e($row->vis_age); ?></td>
			<td><?php echo e($row->civil_name); ?></td>
			<td><?php echo e($row->vis_company); ?></td>
			<td><?php echo e($row->vis_gsm); ?></td>
			<td><?php echo e($row->vis_email); ?></td>
			<td><?php echo e($row->region_name); ?></td>
			<td><?php echo e($row->class_name); ?></td>
			<td><?php echo e($row->event_title); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.excel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>