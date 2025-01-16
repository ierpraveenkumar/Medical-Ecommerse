<!-- resources/views/leads/show.blade.php -->



<?php $__env->startSection('content'); ?>
    <div class="container mx-auto my-10 p-6 bg-white rounded-md shadow-md">
        <h1 class="text-3xl font-semibold mb-6 text-center text-indigo-700">Lead Details</h1>

        <!-- Display lead details here -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <p class="text-lg font-semibold mb-2 text-gray-700">Name:</p>
                <p class="text-base text-gray-900"><?php echo e($lead->first_name); ?> <?php echo e($lead->last_name); ?></p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold mb-2 text-gray-700">Email:</p>
                <p class="text-base text-gray-900"><?php echo e($lead->email); ?></p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold mb-2 text-gray-700">Payment Link:</p>
                <p class="text-base text-gray-900"><?php echo e($lead->payment_link ? 'Yes' : 'No'); ?></p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold mb-2 text-gray-700">Generated On:</p>
                <p class="text-base text-gray-900"><?php echo e($lead->generated_on); ?></p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold mb-2 text-gray-700">Converted To Orders Or Not?:</p>
                <p class="text-base text-gray-900"><?php echo e($lead->converted_to_order ? 'Yes' : 'No'); ?></p>
            </div>
        </div>

        <!-- Add other lead details as needed -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/CompletedProjectsSPX066/MedicalEcommerse/resources/views/Admin/Pages/lead-view.blade.php ENDPATH**/ ?>