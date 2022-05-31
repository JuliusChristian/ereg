			<tr>
				<?php if(App\Http\Controllers\LoginController::can_access()): ?>
				<td class="nowrap text-left">
					<a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('/events/'.$row->event_id.'/edit')); ?>" title="Edit" role="button"><span class="fa fa-pencil"></span></a>
					<a class="btn btn-warning btn-xs" href="javascript:void(0);" onclick="confirmDialog('Delete this item?', 'Confirm Delete', '<?php echo e(URL::to('/events/'.$row->event_id.'/delete')); ?>');" title="Delete" role="button"><span class="fa fa-minus"></span></a>
				</td>
				<?php endif; ?>
				<td class="text-center"><?php echo e($i); ?></td>
				<td class="text-center">
					<?php if($row->event_active == 1): ?>
					<span class="fa fa-thumbs-up text-success">&nbsp;</span>
					<?php endif; ?>
				</td>
				<td><?php echo e($row->event_title); ?></td>

				<td><?php echo nl2br($row->event_desc.''); ?></td>
				<td><?php echo e($row->event_from); ?></td>
				<td><?php echo e($row->event_to); ?></td>
				<td><?php echo e($row->vis_count); ?></td>
			</tr>
