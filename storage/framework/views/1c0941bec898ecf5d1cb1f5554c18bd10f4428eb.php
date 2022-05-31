			<tr>
				<?php if(App\Http\Controllers\LoginController::can_access()): ?>
				<td class="nowrap text-left">
					<a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('/sites/'.$row->site_id.'/edit')); ?>" title="Edit" role="button"><span class="fa fa-pencil"></span></a>
					<!-- <a class="btn btn-warning btn-xs" href="javascript:void(0);" onclick="confirmDialog('Delete this item?', 'Confirm Delete', '<?php echo e(URL::to('/sites/'.$row->site_id.'/delete')); ?>');" title="Delete" role="button"><span class="fa fa-minus"></span></a> -->
				</td>
				<?php endif; ?>
				<td class="text-center"><?php echo e($i); ?></td>
				<td><?php echo e($row->site_name); ?></td>

			</tr>
