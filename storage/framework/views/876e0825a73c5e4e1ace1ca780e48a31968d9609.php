<?php $__env->startSection('title'); ?>
    <?php echo e(__('Credit account')); ?> :: <?php echo e($account->id); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('backend.accounts.credit', $account)); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label><?php echo e(__('Amount')); ?></label>
            <input name="amount" type="number" class="form-control" placeholder="100" value="<?php echo e(old('amount')); ?>">
        </div>
        <button class="btn btn-primary" type="submit">
            <?php echo e(__('Credit')); ?>

        </button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>