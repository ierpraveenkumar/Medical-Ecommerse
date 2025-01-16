<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Transactions</div>

                    <div class="card-body">
                        <p>Welcome to the transactions page!</p>
                        
                        <!-- PayPal Transaction Process Button -->
                        <form  method="GET" action="<?php echo e(route('processTransaction')); ?>">
                            <button style="background-color: blue" type="submit" class="btn btn-success">Process Transaction</button>
                        </form>
                        
                        <!-- Success and Error Messages -->
                        <?php if(session()->has('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('success')); ?>

                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->has('email_sent_message')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('email_sent_message')); ?>

                        </div>
                    <?php endif; ?>
                    
                        
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/CompletedProjectsSPX066/admin_panel/resources/views/transactions.blade.php ENDPATH**/ ?>