<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Dates")); ?></strong></div>
    <div class="panel-body">
        <h3 class="panel-body-title"><?php echo e(__('Start Date')); ?></h3>
        <div class="form-group">
            <label>
                <input type="datetime-local" class="form-control" name="start_date" value="<?php echo e($row->start_date); ?>">
            </label>
        </div>
        <h3 class="panel-body-title"><?php echo e(__('End Date')); ?></h3>
        <div class="form-group">
            <label>
                <input type="datetime-local" class="form-control" name="end_date" value="<?php echo e($row->end_date); ?>">
            </label>
        </div>
    </div>
</div><?php /**PATH /home/hatem/Desktop/desertroad/modules/Tour/Views/admin/tour/date.blade.php ENDPATH**/ ?>