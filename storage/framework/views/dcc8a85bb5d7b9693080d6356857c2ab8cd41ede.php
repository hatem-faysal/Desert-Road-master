<?php $__env->startSection('content'); ?>
<?php if($row->template_id): ?>
<div class="page-template-content">
    <?php echo $row->getProcessedContent(); ?>

</div>
<?php else: ?>
<div class="container " style="padding-top: 40px;padding-bottom: 40px;">
    <h1><?php echo clean($translation->title); ?></h1>
    <div class="blog-content">
        <?php echo $translation->content; ?>

    </div>
</div>
<?php endif; ?>
<?php if(Request::segment(2)=='about-us' OR Request::segment(3)=='about-us'): ?>
<div class="container " style="padding-top: 40px;padding-bottom: 40px;">
    <h1><?php echo clean($translation->title); ?></h1>
    <div class="blog-content">
        <?php echo $translation->content; ?>

    </div>
</div>
<?php endif; ?>               

<?php if(Request::segment(2)=='customize' OR Request::segment(3)=='customize'): ?>
    <?php if (isset($component)) { $__componentOriginalc45be675196ec4d22581eae585ec5f1372395a43 = $component; } ?>
<?php $component = App\View\Components\Frontend\Customize::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('Frontend.Customize'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Frontend\Customize::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc45be675196ec4d22581eae585ec5f1372395a43)): ?>
<?php $component = $__componentOriginalc45be675196ec4d22581eae585ec5f1372395a43; ?>
<?php unset($__componentOriginalc45be675196ec4d22581eae585ec5f1372395a43); ?>
<?php endif; ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hatem/Desktop/desertroad/themes/Base/Page/Views/frontend/detail.blade.php ENDPATH**/ ?>