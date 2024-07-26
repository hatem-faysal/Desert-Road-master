<div class="panel">
    <div class="panel-body">
        <form action="" class="bravo-form-item">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60px">#</th>
                            <th width="60"> Tour</th>
                            <th width="130px"> Location</th>
                            <th width="100px"> Address</th>
                            <th width="100px"> Map Lat</th>
                            <th width="100px"> Map Lng</th>
                            <th width="100px"> Map Zoom</th>
                            <th width="100px"> Date</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $travelLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$travelLocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="publish">
                            <td class="title"><?php echo e(++$key); ?></td>
                            <td class="title"><?php echo e($travelLocation->Tour->title??''); ?></td>
                            <td><?php echo e($travelLocation->Location->name??''); ?></td>
                            <td><?php echo e($travelLocation->address??''); ?></td>
                            <td><?php echo e($travelLocation->map_lat??''); ?></td>
                            <td><?php echo e($travelLocation->map_lng??''); ?></td>
                            <td><?php echo e($travelLocation->map_zoom??''); ?></td>
                            <td><?php echo e(isset($travelLocation->created_at)?$travelLocation->created_at->toFormattedDateString('Y-m-d'):''); ?><td>
                                <a href="<?php echo e(route('multilocation.admin.destroy',$travelLocation->id)); ?>"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </form>

    </div>
</div><?php /**PATH /home/hatem/Desktop/desertroad/modules/Tour/Views/admin/tour/index-multilocation.blade.php ENDPATH**/ ?>