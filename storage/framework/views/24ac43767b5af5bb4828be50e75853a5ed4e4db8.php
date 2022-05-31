			<tr>
				<td class="nowrap text-left">
					<?php if(App\Http\Controllers\LoginController::can_access('UserGroups', 'edit')): ?>
					<a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('/usergroups/'.$row->ug_id.'/edit')); ?>" title="Edit" role="button"><span class="fa fa-pencil"></span></a>
		        	<?php endif; ?>
					<?php if(App\Http\Controllers\LoginController::can_access('UserGroups', 'delete')): ?>
					<a class="btn btn-warning btn-xs" href="javascript:void(0);" onclick="confirmDialog('Delete this item?', 'Confirm Delete', '<?php echo e(URL::to('/usergroups/'.$row->ug_id.'/delete')); ?>');" title="Delete" role="button"><span class="fa fa-minus"></span></a>
		        	<?php endif; ?>
				</td>
				<td class="text-center"><?php echo e($i); ?></td>
				<td><?php echo e($row->ug_name); ?></td>
			</tr>
