

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Deposits')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="text-center mb-3">
        <a href="<?php echo e(route('frontend.deposits.create')); ?>" class="btn btn-primary"><?php echo e(__('Deposit')); ?></a>
    </div>
    <?php if($deposits->isEmpty()): ?>
        <div class="alert alert-info" role="alert">
            <?php echo e(__('There are no deposits yet.')); ?>

        </div>
    <?php else: ?>
        <table class="table table-hover table-stackable">
            <thead>
            <tr>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'status', 'sort' => $sort, 'order' => $order]); ?>
                    <?php echo e(__('Status')); ?>

                <?php echo $__env->renderComponent(); ?>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'amount', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                    <?php echo e(__('Amount')); ?>

                <?php echo $__env->renderComponent(); ?>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'payment_amount', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                    <?php echo e(__('Payment amount')); ?>

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
            <?php $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td data-title="<?php echo e(__('Status')); ?>" class="<?php echo e($deposit->status == \Packages\Payments\Models\Deposit::STATUS_COMPLETED ? 'text-success' : ($deposit->status == \Packages\Payments\Models\Deposit::STATUS_CANCELLED ? 'text-danger' : '')); ?>">
                        <?php echo e(__('app.deposit_status_' . $deposit->status)); ?>

                        <?php if($deposit->status == \Packages\Payments\Models\Deposit::STATUS_PENDING): ?>
                            <a href="<?php echo e(route('frontend.deposits.show', $deposit)); ?>" class="btn btn-sm btn-primary"><i class="fas fa-arrow-right"></i></a>
                        <?php endif; ?>
                    </td>
                    <td data-title="<?php echo e(__('Amount')); ?>" class="text-right">
                        <?php echo e($deposit->_amount); ?>

                    </td>
                    <td data-title="<?php echo e(__('Payment amount')); ?>" class="text-right">
                        <?php echo e($deposit->_payment_amount); ?> <?php echo e($deposit->payment_currency); ?>

                    </td>
                    <td data-title="<?php echo e(__('Created')); ?>" class="text-right">
                        <?php echo e($deposit->created_at->diffForHumans()); ?>

                        <span data-balloon="<?php echo e($deposit->created_at); ?>" data-balloon-pos="up">
                            <i class="far fa-clock" ></i>
                        </span>
                    </td>
                    <td data-title="<?php echo e(__('Updated')); ?>" class="text-right">
                        <?php echo e($deposit->updated_at->diffForHumans()); ?>

                        <span data-balloon="<?php echo e($deposit->updated_at); ?>" data-balloon-pos="up">
                            <i class="far fa-clock" ></i>
                        </span>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <?php echo e($deposits->appends(['sort' => $sort])->appends(['order' => $order])->links()); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>