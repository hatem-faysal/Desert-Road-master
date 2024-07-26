<div class="panel">
    <div class="panel-body">
        <form action="" class="bravo-form-item">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60px">#</th>
                            <th width="60"> Name</th>
                            <th width="130px"> Price</th>
                            <th width="100px"> Package</th>
                            <th width="100px"> Date</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $travelLocations??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$travelLocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="publish">
                            <td class="title"><?php echo e(++$key); ?></td>
                            <td class="title"><?php echo e($travelLocation->name); ?></td>
                            <td><?php echo e($travelLocation->price); ?></td>
                            <td><?php echo e($travelLocation->Tour->title??''); ?></td>
                            <td><?php echo e(isset($travelLocation->created_at)?$travelLocation->created_at->toFormattedDateString('Y-m-d'):''); ?><td>
                                <a href="<?php echo e(route('multiroom.admin.destroy',$travelLocation->id)); ?>"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </form>

    </div>
</div><?php /**PATH /home/hatem/Desktop/desertroad/modules/Tour/Views/admin/multiroom/index-multiroom.blade.php ENDPATH**/ ?>