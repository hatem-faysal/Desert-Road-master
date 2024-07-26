<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Pricing")); ?></strong></div>
    <div class="panel-body">
        <?php if(is_default_lang()): ?>
            <h3 class="panel-body-title"><?php echo e(__("Package Price")); ?></h3>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo e(__("Price")); ?></label>
                        <input type="text" name="price" class="form-control" value="<?php echo e($row->price); ?>" placeholder="<?php echo e(__("Package Price")); ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo e(__("Sale Price")); ?></label>
                        <input type="text" name="sale_price" class="form-control" value="<?php echo e($row->sale_price); ?>" placeholder="<?php echo e(__("Package Sale Price")); ?>">
                    </div>
                </div>
                <div class="col-lg-12">
                    <span>
                        <?php echo e(__("If the regular price is less than the discount , it will show the regular price")); ?>

                    </span>
                </div>
            </div>
            <hr>
        <?php endif; ?>
        

        

        
    </div>
</div>
<?php /**PATH /home/hatem/Desktop/desertroad/modules/Tour/Views/admin/tour/pricing.blade.php ENDPATH**/ ?>