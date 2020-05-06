<?php $__env->startSection('title'); ?>
    <?php echo e(__('Accounts')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-3 offset-lg-9 mb-3">
            <?php $__env->startComponent('components.tables.search', ['route' => 'backend.accounts.index', 'search' => $search]); ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <?php if($accounts->isEmpty()): ?>
        <div class="alert alert-info" role="alert">
            <?php echo e(__('No accounts found.')); ?>

        </div>
    <?php else: ?>
        <table class="table table-hover table-stackable">
            <thead>
                <tr>
                    <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'id', 'sort' => $sort, 'order' => $order]); ?>
                        <?php echo e(__('ID')); ?>

                    <?php echo $__env->renderComponent(); ?>
                    <th>
                        <a href="#"><?php echo e(__('User')); ?></a>
                    </th>
                    <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'balance', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                        <?php echo e(__('Balance')); ?>

                    <?php echo $__env->renderComponent(); ?>
                    <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'created', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                        <?php echo e(__('Created')); ?>

                    <?php echo $__env->renderComponent(); ?>
                    <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'updated', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                        <?php echo e(__('Updated')); ?>

                    <?php echo $__env->renderComponent(); ?>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td data-title="<?php echo e(__('ID')); ?>"><?php echo e($account->id); ?></td>
                        <td data-title="<?php echo e(__('User')); ?>">
                            <a href="<?php echo e(route('backend.users.edit', $account->user)); ?>">
                                <?php echo e($account->user->name); ?>

                            </a>
                            <?php if($account->user->role == App\Models\User::ROLE_ADMIN): ?>
                                <span class="badge badge-danger"><?php echo e(__('app.user_role_'.$account->user->role)); ?></span>
                            <?php elseif($account->user->role == App\Models\User::ROLE_BOT): ?>
                                <span class="badge badge-info text-light"><?php echo e(__('app.user_role_'.$account->user->role)); ?></span>
                            <?php endif; ?>
                        </td>
                        <td data-title="<?php echo e(__('Balance')); ?>" class="text-right"><?php echo e($account->_balance); ?></td>
                        <td data-title="<?php echo e(__('Created')); ?>" class="text-right">
                            <?php echo e($account->created_at->diffForHumans()); ?>

                            <span data-balloon="<?php echo e($account->created_at); ?>" data-balloon-pos="up">
                                <i class="far fa-clock"></i>
                            </span>
                        </td>
                        <td data-title="<?php echo e(__('Updated')); ?>" class="text-right">
                            <?php echo e($account->updated_at->diffForHumans()); ?>

                            <span data-balloon="<?php echo e($account->updated_at); ?>" data-balloon-pos="up">
                                <i class="far fa-clock"></i>
                            </span>
                        </td>
                        <td class="text-right">
                            <div class="btn-group" role="group" aria-label="<?php echo e(__('Actions')); ?>">
                                <a class="btn btn-primary btn-sm">
                                    <?php echo e(__('Actions')); ?>

                                </a>
                                <div class="btn-group" role="group">
                                    <button id="accounts-action-button" type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="dropdown-menu" aria-labelledby="accounts-action-button">
                                        <a class="dropdown-item" href="<?php echo e(route('backend.accounts.debit', $account)); ?>">
                                            <i class="fas fa-minus fa-sm"></i>
                                            <?php echo e(__('Debit')); ?>

                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('backend.accounts.credit', $account)); ?>">
                                            <i class="fas fa-plus fa-sm"></i>
                                            <?php echo e(__('Credit')); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <?php echo e($accounts->appends(['search' => $search])->appends(['sort' => $sort])->appends(['order' => $order])->links()); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>