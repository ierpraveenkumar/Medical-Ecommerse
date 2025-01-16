<?php $__env->startSection('content'); ?>
    <div style="background-color: rgb(190, 196, 105); padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);">
        <h1 style="font-size: 24px; color: rgb(90, 33, 37);">Notifications</h1>
        <br><br><br>

        <?php $__currentLoopData = $admin->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="margin-bottom: 20px; padding: 10px; border: 1px solid rgba(8, 186, 209, 0.918); border-radius: 5px; transition: all 0.3s;">
                <p style="color: rgba(9, 24, 235, 0.918); font-weight: bold; margin-bottom: 5px;">New Product Created:</p>
                <?php $__currentLoopData = $notification->data['product_data']['product_name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p style="margin-bottom: 5px;">Product Name: <?php echo e($product_name); ?></p>
                    <p style="margin-bottom: 5px;">Batch No: <?php echo e($notification->data['product_data']['batch_no'][$key] ?? 'N/A'); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <p style="margin-bottom: 5px;">Created At: <?php echo e($notification->created_at->format('d-m-Y')); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/CompletedProjectsSPX066/MedicalEcommerse/resources/views/Admin/Pages/notification.blade.php ENDPATH**/ ?>