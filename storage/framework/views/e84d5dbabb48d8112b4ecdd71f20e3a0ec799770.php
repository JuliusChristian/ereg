			<tr>
				<td class="nowrap text-left">

					<?php if(App\Http\Controllers\LoginController::can_access('Users', 'edit')): ?>
					<a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('/users/'.$row->u_id.'/edit')); ?>" title="Edit" role="button"><span class="fa fa-pencil"></span></a>
		        	<?php endif; ?>
					<?php if(App\Http\Controllers\LoginController::can_access('Users', 'delete')): ?>
					<a class="btn btn-warning btn-xs" href="javascript:void(0);" onclick="confirmDialog('Delete this item?', 'Confirm Delete', '<?php echo e(URL::to('/users/'.$row->u_id.'/delete')); ?>');" title="Delete" role="button"><span class="fa fa-minus"></span></a>
		        	<?php endif; ?>

				</td>
				<td class="text-center"><?php echo e($i); ?></td>
				<td><?php echo e($row->u_username); ?></td>
				<td><?php echo e($row->u_name); ?></td>
				<td><?php echo e($row->u_email); ?></td>
				<td><?php echo e($row->u_gsm); ?></td>
				<td><?php echo e($row->ug_name); ?></td>
				<td class="text-center"><?php echo (($row->u_enabled == 0) ? '' : '<span class="fa fa-check"></span>'); ?></td>
			</tr>