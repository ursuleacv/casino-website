

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?> :: <?php echo e(__('Payments')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('backend.pages.dashboard.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="row text-center mt-3">
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Deposits count')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($deposits['count']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Max deposit')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($deposits['max']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Total deposited')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($deposits['total']); ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center mt-3">
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Withdrawals count')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($withdrawals['count']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Max withdrawal')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($withdrawals['max']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Total withdrawn')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($withdrawals['total']); ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 mb-4">
            <h2 class="text-center"><?php echo e(__('Deposits by day')); ?></h2>
            <time-series-chart :data="<?php echo e(json_encode($deposits_by_day)); ?>" :scrollbar="true" theme="<?php echo e($settings->theme); ?>" class="time-series-chart"></time-series-chart>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 mb-4">
            <h2 class="text-center"><?php echo e(__('Withdrawals by day')); ?></h2>
            <time-series-chart :data="<?php echo e(json_encode($withdrawals_by_day)); ?>" :scrollbar="true" theme="<?php echo e($settings->theme); ?>" class="time-series-chart"></time-series-chart>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center"><?php echo e(__('Deposits by currency')); ?></h2>
            <pie-chart :data="<?php echo e(json_encode($deposits_by_ccy)); ?>" theme="<?php echo e($settings->theme); ?>" class="pie-chart"></pie-chart>
        </div>
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center"><?php echo e(__('Withdrawals by currency')); ?></h2>
            <pie-chart :data="<?php echo e(json_encode($withdrawals_by_ccy)); ?>" theme="<?php echo e($settings->theme); ?>" class="pie-chart"></pie-chart>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center"><?php echo e(__('Top deposits')); ?></h2>
            <?php if($top_deposits->isEmpty()): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo e(__('There are no deposits yet.')); ?>

                </div>
            <?php else: ?>
                <table class="table table-hover table-stackable">
                    <thead>
                    <tr>
                        <th><?php echo e(__('User')); ?></th>
                        <th class="text-right"><?php echo e(__('Amount')); ?></th>
                        <th class="text-right"><?php echo e(__('Created')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $top_deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td data-title="<?php echo e(__('User')); ?>">
                                <a href="<?php echo e(route('frontend.users.show', $deposit->account->user)); ?>">
                                    <?php echo e($deposit->account->user->name); ?>

                                </a>
                            </td>
                            <td data-title="<?php echo e(__('Amount')); ?>" class="text-right"><?php echo e($deposit->_amount); ?></td>
                            <td data-title="<?php echo e(__('Created')); ?>" class="text-right"><?php echo e($deposit->updated_at->diffForHumans()); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center"><?php echo e(__('Top withdrawals')); ?></h2>
            <?php if($top_withdrawals->isEmpty()): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo e(__('There are no withdrawals yet.')); ?>

                </div>
            <?php else: ?>
                <table class="table table-hover table-stackable">
                    <thead>
                    <tr>
                        <th><?php echo e(__('User')); ?></th>
                        <th class="text-right"><?php echo e(__('Amount')); ?></th>
                        <th class="text-right"><?php echo e(__('Created')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $top_withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td data-title="<?php echo e(__('User')); ?>">
                                <a href="<?php echo e(route('frontend.users.show', $withdrawal->account->user)); ?>">
                                    <?php echo e($withdrawal->account->user->name); ?>

                                </a>
                            </td>
                            <td data-title="<?php echo e(__('Amount')); ?>" class="text-right"><?php echo e($withdrawal->_amount); ?></td>
                            <td data-title="<?php echo e(__('Created')); ?>" class="text-right"><?php echo e($withdrawal->updated_at->diffForHumans()); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>