<?php $__env->startSection('head'); ?>
    <!-- Add your stylesheets or head content here -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mx-auto my-10 p-6 bg-white rounded-md shadow-md">
        <h1 class="text-2xl font-semibold mb-6">Manage Lead</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-800 text-white border-b">
                    <tr>
                        <th class="py-3 px-6 text-left">S.No</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Lead Generation Date</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Payment Sent</th>
                        <th class="py-3 px-6 text-left">Prescription Link</th>
                        <th class="py-3 px-6 text-left">Converted to Order</th>
                        <th class="py-3 px-6 text-left">View Form Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e($index % 2 == 0 ? 'bg-gray-50' : 'bg-white'); ?> hover:bg-gray-50">
                            <td class="py-4 px-6 border-b border-gray-300"><?php echo e($index + 1); ?></td>
                            <td class="py-4 px-6 border-b border-gray-300"><?php echo e($lead->first_name); ?> <?php echo e($lead->last_name); ?></td>
                            <td class="py-4 px-6 border-b border-gray-300"><?php echo e($lead->generated_on); ?></td>
                            <td class="py-4 px-6 border-b border-gray-300"><?php echo e($lead->email); ?></td>
                            <td class="py-4 px-6 border-b border-gray-300"><?php echo e($lead->payment_link ? 'Yes' : 'No'); ?></td>
                            <td class="py-4 px-6 border-b border-gray-300"><?php echo e($lead->prescription_link ? 'Yes' : 'No'); ?></td>
                            <td class="py-4 px-6 border-b border-gray-300"><?php echo e($lead->converted_to_order ? 'Yes' : 'No'); ?></td>
                            <td class="py-4 px-6 border-b border-gray-300">
    <a href="<?php echo e(route('leads.show', $lead->id)); ?>" class="text-blue-500 hover:underline">View</a>
</td>
 </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
            <div class="pagination">
                <?php echo e($leads->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <!-- Add your footer content here -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/CompletedProjectsSPX066/MedicalEcommerse/resources/views/Admin/Pages/manage-lead.blade.php ENDPATH**/ ?>