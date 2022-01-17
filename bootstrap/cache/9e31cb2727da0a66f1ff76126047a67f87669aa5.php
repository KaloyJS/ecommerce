<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - <?php echo $__env->yieldContent('title'); ?></title>

    <link rel="stylesheet" href="/css/all.css">
    <script src="https://kit.fontawesome.com/7c71ae126c.js" crossorigin="anonymous"></script>
</head>

<body data-page-id="<?php echo $__env->yieldContent('data-page-id'); ?>">
    <?php echo $__env->make('includes.admin-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="off-canvas-content admin__title-bar" data-off-canvas-content>
        <!-- Your page content lives here -->
        <div class="title-bar">
            <div class="title-bar-left">
                <button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button>
                <span class="title-bar-title"><?php echo e($_ENV['APP_NAME']); ?></span>
            </div>

        </div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="/js/all.js"></script>
</body>

</html><?php /**PATH /home/kaloy/sites/ecommerce/resources/views/admin/layout/base.blade.php ENDPATH**/ ?>