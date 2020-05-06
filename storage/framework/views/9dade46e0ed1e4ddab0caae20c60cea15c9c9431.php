<?php $__env->startSection('title'); ?>
    <?php echo e(__('Games')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($games->isEmpty()): ?>
        <div class="alert alert-info" role="alert">
            <?php echo e(__('There are no games yet.')); ?>

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
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'game', 'sort' => $sort, 'order' => $order]); ?>
                    <?php echo e(__('Game')); ?>

                <?php echo $__env->renderComponent(); ?>
                <th>
                    <a href="#"><?php echo e(__('Result')); ?></a>
                </th>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'bet', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                    <?php echo e(__('Bet')); ?>

                <?php echo $__env->renderComponent(); ?>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'win', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                    <?php echo e(__('Win')); ?>

                <?php echo $__env->renderComponent(); ?>
                <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'played', 'sort' => $sort, 'order' => $order, 'class' => 'text-right']); ?>
                    <?php echo e(__('Played')); ?>

                <?php echo $__env->renderComponent(); ?>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td data-title="<?php echo e(__('ID')); ?>"><?php echo e($game->id); ?></td>
                    <td data-title="<?php echo e(__('User')); ?>">
                        <a href="<?php echo e(route('backend.users.edit', $game->account->user)); ?>">
                            <?php echo e($game->account->user->name); ?>

                        </a>
                        <?php if($game->account->user->role == App\Models\User::ROLE_ADMIN): ?>
                            <span class="badge badge-danger"><?php echo e(__('app.user_role_'.$game->account->user->role)); ?></span>
                        <?php elseif($game->account->user->role == App\Models\User::ROLE_BOT): ?>
                            <span class="badge badge-info text-light"><?php echo e(__('app.user_role_'.$game->account->user->role)); ?></span>
                        <?php endif; ?>
                    </td>
                    <td data-title="<?php echo e(__('Game')); ?>">
                        <?php echo e($game->title); ?>

                    </td>
                    <td data-title="<?php echo e(__('Result')); ?>">
                        <?php echo e($game->gameable->result); ?>

                    </td>
                    <td data-title="<?php echo e(__('Bet')); ?>" class="text-right">
                        <?php echo e($game->_bet); ?>

                    </td>
                    <td data-title="<?php echo e(__('Win')); ?>" class="text-right">
                        <?php echo e($game->_win); ?>

                    </td>
                    <td data-title="<?php echo e(__('Played')); ?>" class="text-right">
                        <?php echo e($game->updated_at->diffForHumans()); ?>

                        <span data-balloon="<?php echo e($game->updated_at); ?>" data-balloon-pos="up">
                            <i class="far fa-clock" ></i>
                        </span>
                    </td>
                    <td class="text-right">
                        <a href="<?php echo e(route('backend.games.show', array_merge(['game' => $game], request()->query()))); ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-eye"></i>
                            <?php echo e(__('View')); ?>

                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <?php echo e($games->appends(['sort' => $sort, 'order' => $order, 'uid' => request()->query('uid')])->links()); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>