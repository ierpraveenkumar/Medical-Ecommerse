<?php $__env->startSection('content'); ?>
<div style="margin:40px">
<div style="color: rgb(102, 151, 102)">
    <span>Order Id :</span>
    <span><?php echo e($data->id); ?></span>
   
</div>

<div style="color: rgb(100, 139, 100)">
    <span>Shipping  Address :</span>

    <span><?php echo e($data->shipping_address); ?></span>
</div>
<div style="color: rgb(83, 121, 83)">
    <span> Shipping Date  Started On: </span>
    <span><?php echo e($data->created_at->format('d-m-Y')); ?></span>
</div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/CompletedProjectsSPX066/admin_panel/resources/views/Admin/Pages/shippedOrderView.blade.php ENDPATH**/ ?>