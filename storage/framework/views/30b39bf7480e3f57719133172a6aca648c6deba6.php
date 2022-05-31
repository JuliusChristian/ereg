<?php $__env->startSection('content'); ?>
<?php

?>
<div class="panel panel-default">
    <div class="panel-heading hidden-print">
        <?php if(strlen($msg) > 0): ?>
        <div class="alert alert-info">
            <?php echo e($msg); ?>

        </div>
        <?php endif; ?>

        <div class="clearfix hidden-print">
            <h3 class="panel-title pull-left">Generate Barcode</h3>
            <div class="pull-right">
            </div>
        </div>
    </div>
    <div class="panel-body hidden-print">
        <?php echo Form::open(array('name' => 'search_form', 'url' => URL::to('barcode'), 'class'=>'form-inline', 'role' => 'form')); ?>

            <div class="form-group">

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Batch</span>
                    <input class="form-control inpu-sm" type="number" maxlength="4" name="batch" id="batch" value="<?php echo e($batch); ?>" min="0" step="1">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Serial</span>
                    <input class="form-control inpu-sm" type="number" maxlength="4" name="serial" id="serial" value="<?php echo e($serial); ?>" min="0" step="1">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Count</span>
                    <input class="form-control inpu-sm" type="number" maxlength="5" name="count" id="count" value="<?php echo e($count); ?>" min="0" step="1">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-btn">
                        <input class="btn btn-default btn-sm" type="submit" value="Generate" name="search-btn" id="search-btn">
                    </span>
                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
    <div>
    <?php 
        $b = $batch;
        $s = $serial;

        for ($i = 0; $i < $count; $i++){


            $s++;
            if ($s >= 1000){
                $b++;
                $s = 1;
            }

            $zb = str_pad($b.'',4,'0', STR_PAD_LEFT);
            $zs = str_pad($s.'',4,'0', STR_PAD_LEFT);
            $zcode = $zb.$zs;

    ?>
        <div class="barcode-wrapper" class="text-center">
            <div class="barcode-center">
                <div class="barcode-vcenter">
                    <div class="barcode-header"><?php echo e($event->event_title); ?></div>
                    <div class="barcode-subtitle">
                        <?php echo e($event->event_desc); ?>

                    </div>
                    <div class="barcode-code"><?php echo '<img src="data:image/png;base64,'.base64_encode($gen->getBarcode($zcode, $gen::TYPE_CODE_128)).'">'; ?></div>
                    <div class="barcode-number"><?php echo e($zcode); ?></div>
                </div>
            </div>
        </div>

    <?php
        }
    ?>
    </div>
    <div class="panel-footer hidden-print">
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>