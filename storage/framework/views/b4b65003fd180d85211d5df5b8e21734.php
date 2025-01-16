<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1><?php echo e($mailData['title']); ?></h1>
    <h3>Dear user, <b><?php echo e($mailData['body']); ?></b></h3>
    <p>Thank You</p>

</body>

</html>
<?php /**PATH /var/www/html/CompletedProjectsSPX066/admin_panel/resources/views/emails/demoMail.blade.php ENDPATH**/ ?>