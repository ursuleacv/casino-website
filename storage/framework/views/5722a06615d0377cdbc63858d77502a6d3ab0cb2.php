

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Withdrawals')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="text-center mb-3">
        <a href="<?php echo e(route('frontend.withdrawals.create')); ?>" class="btn btn-primary"><?php echo e(__('Withdraw')); ?></a>
    </div>
    <?php if($withdrawals->isEmpty()): ?>
        <div class="alert alert-info" role="alert">
            <?php echo e(__('There are no withdrawals yet.')); ?>

        </div>
    <?php else: ?>
        <table class="table table-hover table-stackable">
            <thead>
            <tr>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'wallet', 'sort' => $sort, 'order' => $order]); ?>
                    <?php echo e(__('Wallet')); ?>

                <?php echo $__env->renderComponent(); ?>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'status', 'sort' => $sort, 'order' => $order]); ?>
                    <?php echo e(__('Status')); ?>

                <?php echo $__env->renderComponent(); ?>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'amount', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                    <?php echo e(__('Amount')); ?>

                <?php echo $__env->renderComponent(); ?>                
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'payment_currency', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                    <?php echo e(__('Payment currency')); ?>

                <?php echo $__env->renderComponent(); ?>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'created', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                    <?php echo e(__('Created')); ?>

                <?php echo $__env->renderComponent(); ?>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'updated', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                    <?php echo e(__('Updated')); ?>

                <?php echo $__env->renderComponent(); ?>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td data-title="<?php echo e(__('Wallet')); ?>">
                        <?php echo e($withdrawal->wallet); ?>

                    </td>
                    <td data-title="<?php echo e(__('Status')); ?>" class="<?php echo e($withdrawal->status == \Packages\Payments\Models\Withdrawal::STATUS_COMPLETED ? 'text-success' : (in_array($withdrawal->status, [\Packages\Payments\Models\Withdrawal::STATUS_CANCELLED, \Packages\Payments\Models\Withdrawal::STATUS_REJECTED]) ? 'text-danger' : '')); ?>">
                        <?php echo e(__('app.withdrawal_status_' . $withdrawal->status)); ?>

                    </td>
                    <td data-title="<?php echo e(__('Amount')); ?>" class="text-right">
                        <?php echo e($withdrawal->_amount); ?>

                    </td>
                    <td data-title="<?php echo e(__('Payment currency')); ?>" class="text-right">
                        <?php echo e($withdrawal->_payment_currency); ?>

                    </td>
                    <td data-title="<?php echo e(__('Created')); ?>" class="text-right">
                        <?php echo e($withdrawal->created_at->diffForHumans()); ?>

                        <span data-balloon="<?php echo e($withdrawal->created_at); ?>" data-balloon-pos="up">
                            <i class="far fa-clock" ></i>
                        </span>
                    </td>
                    <td data-title="<?php echo e(__('Updated')); ?>" class="text-right">
                        <?php echo e($withdrawal->updated_at->diffForHumans()); ?>

                        <span data-balloon="<?php echo e($withdrawal->updated_at); ?>" data-balloon-pos="up">
                            <i class="far fa-clock" ></i>
                        </span>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <?php echo e($withdrawals->appends(['sort' => $sort])->appends(['order' => $order])->links()); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>