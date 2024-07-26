<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Multi Room Package")); ?></strong></div>
    <div class="panel-body">
    
        <input type="hidden"  name="tour_id" value="<?php echo e($id); ?>">
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Name")); ?></label>
            <input type="text" required name="name" id="name" class="form-control" placeholder="<?php echo e(__("name")); ?>" value="<?php echo e($translation->name??''); ?>">
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Price")); ?></label>
            <input type="text" required name="price" id="price" class="form-control" placeholder="<?php echo e(__("price")); ?>" value="<?php echo e($translation->price??''); ?>">
        </div>
    </div>
</div>
<?php /**PATH /home/hatem/Desktop/desertroad/modules/Tour/Views/admin/multiroom/tour-multiroom.blade.php ENDPATH**/ ?>