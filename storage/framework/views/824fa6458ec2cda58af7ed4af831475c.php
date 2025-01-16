<!DOCTYPE html>
<html>
<head>
    <title>How To Integrate Razorpay Payment Gateway In Laravel - websolutionstuff.com</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>    
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if($message = Session::get('error')): ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error!</strong> <?php echo e($message); ?>

                </div>
            <?php endif; ?>
            <?php echo Session::forget('error'); ?>

            <?php if($message = Session::get('success')): ?>
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> <?php echo e($message); ?>

                </div>
            <?php endif; ?>
            <?php echo Session::forget('success'); ?>

            <div class="panel panel-default">
                <div class="panel-heading">Pay With Razorpay</div>

                <div class="panel-body text-center">
                    <form action="<?php echo route('payment'); ?>" method="POST" >                        
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="<?php echo e(env('RAZORPAY_KEY')); ?>"
                                data-amount="1000"
                                data-buttontext="Pay 10 INR"
                                data-name="Websolutionstuff"
                                data-description="Payment"
                                data-image="https://websolutionstuff.com/frontTheme/assets/images/logo.png"
                                data-prefill.name="name"
                                data-prefill.email="email"
                                data-theme.color="#ff7529">
                        </script>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php /**PATH /var/www/html/CompletedProjectsSPX066/admin_panel/resources/views/index.blade.php ENDPATH**/ ?>