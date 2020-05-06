<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?> :: <?php echo e(__('Users')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('backend.pages.dashboard.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="row text-center mt-3">
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Users count')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($users_count); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Signed up last 7 days')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($signed_up_last_week); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Last signed up')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($last_signed_up_at); ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 mb-4">
            <h2 class="text-center"><?php echo e(__('Sign-ups by date')); ?></h2>
            <time-series-chart :data="<?php echo e(json_encode($sign_ups_by_day)); ?>" :scrollbar="true" theme="<?php echo e($settings->theme); ?>" class="time-series-chart"></time-series-chart>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center"><?php echo e(__('Direct vs referral sign-ups')); ?></h2>
            <pie-chart :data="<?php echo e(json_encode($sign_ups_by_source)); ?>" theme="<?php echo e($settings->theme); ?>" class="pie-chart"></pie-chart>
        </div>
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center"><?php echo e(__('Users by role')); ?></h2>
            <pie-chart :data="<?php echo e(json_encode($users_by_role)); ?>" theme="<?php echo e($settings->theme); ?>" class="pie-chart"></pie-chart>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>