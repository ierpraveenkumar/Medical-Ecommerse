<?php $__env->startSection('head'); ?>
    <!-- Additional head content goes here -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content flex flex-col flex-grow p-4">
        <h1 class="font-bold text-2xl text-gray-700">Dashboard</h1>
        <div class="grid grid-cols-2 gap-4 p-8">
            <a href="#">
                <div class="bg-gray-500 text-white py-12 text-center rounded-3xl">
                    <h1 class="text-7xl font-bold"><?php echo e($todaysOrdersCount); ?></h1>
                    <h2 class="text-3xl font-medium">Today's Orders</h2>
                </div>
            </a>
            <a href="#">
                <div class="bg-gray-500 text-white py-12 text-center rounded-3xl">
                    <h1 class="text-7xl font-bold"><?php echo e($pendingOrdersCount); ?></h1>
                    <h2 class="text-3xl font-medium">Pending Orders</h2>
                </div>
            </a>
            <a href="#">
                <div class="bg-gray-500 text-white py-12 text-center rounded-3xl">
                    <h1 class="text-7xl font-bold"><?php echo e($openLeadsCount); ?></h1>
                    <h2 class="text-3xl font-medium">Open Leads</h2>
                </div>
            </a>
            <a href="#">
                <div class="bg-gray-500 text-white py-12 text-center rounded-3xl">
                    <h1 class="text-7xl font-bold"><?php echo e($completedOrdersCount); ?></h1>
                    <h2 class="text-3xl font-medium">Completed Orders</h2>
                </div>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <!-- Additional footer content goes here -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/CompletedProjectsSPX066/admin_panel/resources/views/Admin/Pages/dashboard.blade.php ENDPATH**/ ?>