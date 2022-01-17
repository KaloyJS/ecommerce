<div class="row extended column">
    
    <?php if(isset($errors) && count($errors)): ?>
        <div class="callout alert" data-closable>
            <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_array): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $error_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($error_item); ?> <br/>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
                <span arial-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if(isset($success) || \App\Classes\Session::has('success')): ?>
        <div class="callout success" data-closable>
            <?php if(isset($success)): ?>
                <?php echo e($success); ?>

            <?php elseif(\App\Classes\Session::has('success')): ?>
                <?php echo e(\App\Classes\Session::flash('success')); ?>

            <?php endif; ?>

            <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
                <span arial-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

</div><?php /**PATH /home/kaloy/sites/ecommerce/resources/views/includes/message.blade.php ENDPATH**/ ?>