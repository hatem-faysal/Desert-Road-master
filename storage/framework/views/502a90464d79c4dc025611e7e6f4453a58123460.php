<?php
    /**
    * @var $row \Modules\Location\Models\Location
    * @var $to_location_detail bool
    * @var $service_type string
    */
    $translation = $row->translate();
    $link_location = false;
    if(is_string($service_type)){
        $link_location = $row->getLinkForPageSearch($service_type);
    }
    if(is_array($service_type) and count($service_type) == 1){
        $link_location = $row->getLinkForPageSearch($service_type[0] ?? "");
    }
    if($to_location_detail){
        $link_location = $row->getDetailUrl();
    }
 $countNew = Modules\Tour\Models\TravelLocation::where('location_id',$row->id)->count();
?>
<div class="destination-item <?php if(!$row->image_id): ?> no-image  <?php endif; ?>">
    <?php if(!empty($link_location)): ?> <a href="<?php echo e($link_location); ?>">  <?php endif; ?>
        <div class="image" <?php if($row->image_id): ?> style="background: url(<?php echo e($row->getImageUrl()); ?>)" <?php endif; ?> >
            <div class="effect"></div>
            <div class="content">
                <h4 class="title"><?php echo e($translation->name); ?></h4>
                <?php if( Request::segment(2)=='' OR Request::segment(3)=='ht'): ?>
                    <?php if($countNew != 0): ?>
                    <a class="btn btn-primary" href="<?php echo e(url('travel?location_id='.$row->id)); ?>" target="_blank">Read More</a>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if( !empty($layout) and ($layout == "style_1" or $layout == "style_3" or $layout == "style_4")): ?>
                    <?php if(is_array($service_type)): ?>
                        <div class="desc">
                            <?php $__currentLoopData = $service_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $count = $row->getDisplayNumberServiceInLocation($type) ?>
                                <?php if(!empty($count)): ?>
                                    <?php if($countNew != 0): ?>
                                        <?php if(empty($link_location)): ?>
                                            <a href="<?php echo e($row->getLinkForPageSearch( $type )); ?>" target="_blank">
                                                <?php echo e($countNew.' Package'); ?>

                                            </a>
                                        <?php else: ?>
                                            <span><?php echo e($countNew.' Package'); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if($loop->first): ?>
                                        <?php if($countNew != 0): ?>
                                            <a href="<?php echo e(url('travel?location_id='.$row->id)); ?>" style="color: white" target="_blank">
                                                <?php echo e($countNew.' Package'); ?>

                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <?php if(!empty($text_service = $row->getDisplayNumberServiceInLocation($service_type))): ?>
                            <div class="desc"><?php echo e($text_service); ?></div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php if(!empty($link_location)): ?> </a> <?php endif; ?>
</div>
<?php /**PATH /home/hatem/Desktop/desertroad/themes/BC/Location/Views/frontend/blocks/list-locations/loop.blade.php ENDPATH**/ ?>