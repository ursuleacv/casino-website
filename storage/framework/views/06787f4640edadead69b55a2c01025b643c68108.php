

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Deposit')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('frontend.deposits.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-row">
            <div class="form-group col-sm-12 col-md-8">
                <label><?php echo e(__('Deposit amount')); ?></label>
                <div class="input-group">
                    <input type="text" name="amount" class="form-control <?php echo e($errors->has('amount') ? 'is-invalid' : ''); ?>" placeholder="1000" value="<?php echo e(old('amount')); ?>" required>
                    <div class="input-group-append">
                        <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                    </div>
                </div>
                <small class="form-text text-muted"><?php echo e(trans_choice(':rate credit = 1 :ccy|:rate credits = 1 :ccy', config('payments.rate'), ['rate' => config('payments.rate'), 'ccy' => config('payments.currency')])); ?></small>
            </div>
            <div class="form-group col-sm-12 col-md-4">
                <label><?php echo e(__('Payment currency')); ?></label>
                <select name="payment_currency" class="custom-select <?php echo e($errors->has('payment_currency') ? 'is-invalid' : ''); ?>">
                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symbol => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($symbol); ?>" <?php echo e(old('payment_currency')==$symbol ? 'selected="selected"' : ''); ?>>
                            <?php echo e($currency['name']); ?> (<?php echo e($symbol); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary"><?php echo e(__('Proceed')); ?></button>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>