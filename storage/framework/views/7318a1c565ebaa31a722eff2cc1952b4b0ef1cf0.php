<?php $__env->startSection('title'); ?>
    <?php echo e(__('Users')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-3 offset-lg-9 mb-3">
            <?php $__env->startComponent('components.tables.search', ['route' => 'backend.users.index', 'search' => $search]); ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <?php if($users->isEmpty()): ?>
        <div class="alert alert-info" role="alert">
            <?php echo e(__('No users found.')); ?>

        </div>
    <?php else: ?>
        <table class="table table-hover table-stackable">
        <thead>
        <tr>
            <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'id', 'sort' => $sort, 'order' => $order]); ?>
                <?php echo e(__('ID')); ?>

            <?php echo $__env->renderComponent(); ?>
            <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'name', 'sort' => $sort, 'order' => $order]); ?>
                <?php echo e(__('Name')); ?>

            <?php echo $__env->renderComponent(); ?>
            <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'email', 'sort' => $sort, 'order' => $order]); ?>
                <?php echo e(__('Email')); ?>

            <?php echo $__env->renderComponent(); ?>
            <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'games', 'sort' => $sort, 'order' => $order]); ?>
                <?php echo e(__('Games')); ?>

            <?php echo $__env->renderComponent(); ?>
            <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'status', 'sort' => $sort, 'order' => $order]); ?>
                <?php echo e(__('Status')); ?>

            <?php echo $__env->renderComponent(); ?>
            <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'last_login_at', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned']); ?>
                <?php echo e(__('Last login at')); ?>

            <?php echo $__env->renderComponent(); ?>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td data-title="<?php echo e(__('ID')); ?>"><?php echo e($user->id); ?></td>
                <td data-title="<?php echo e(__('Name')); ?>">
                    <a href="<?php echo e(route('backend.users.edit', $user)); ?>">
                        <?php echo e($user->name); ?>

                    </a>
                    <?php if($user->totp_secret): ?>
                        <i class="fas fa-shield-alt text-info"></i>
                    <?php endif; ?>
                    <?php if($user->role == App\Models\User::ROLE_ADMIN): ?>
                        <span class="badge badge-danger"><?php echo e(__('app.user_role_'.$user->role)); ?></span>
                    <?php elseif($user->role == App\Models\User::ROLE_BOT): ?>
                        <span class="badge badge-info text-light"><?php echo e(__('app.user_role_'.$user->role)); ?></span>
                    <?php endif; ?>
                    <?php if($user->referrer): ?>
                        <span data-balloon="<?php echo e(__('Referred by :user', ['user' => $user->referrer->name . ' (' . $user->referrer->email . ')'])); ?>" data-balloon-pos="up">
                            <i class="fas fa-retweet fa-sm" ></i>
                        </span>
                    <?php endif; ?>
                </td>
                <td data-title="<?php echo e(__('Email')); ?>">
                    <a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></td>
                <td data-title="<?php echo e(__('Games')); ?>"><?php echo e($user->games_count); ?></td>
                <td data-title="<?php echo e(__('Status')); ?>"><?php echo e(__('app.user_status_' . $user->status)); ?></td>
                <td data-title="<?php echo e(__('Last login at')); ?>">
                    <?php echo e($user->last_login_at->diffForHumans()); ?>

                    <span data-balloon="<?php echo e($user->last_login_at); ?>" data-balloon-pos="up">
                        <i class="far fa-clock" ></i>
                    </span>
                </td>
                <td class="text-right">
                    <div class="btn-group" role="group" aria-label="<?php echo e(__('Edit')); ?>">
                        <a href="<?php echo e(route('backend.users.edit', array_merge(['user' => $user], request()->query()))); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-pen fa-sm"></i>
                            <?php echo e(__('Edit')); ?>

                        </a>
                        <div class="btn-group" role="group">
                            <button id="users-action-button" type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu" aria-labelledby="users-action-button">
                                <a class="dropdown-item" href="<?php echo e(route('frontend.users.show', $user)); ?>">
                                    <i class="far fa-eye fa-sm"></i>
                                    <?php echo e(__('Profile')); ?>

                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('backend.games.index', ['uid' => $user->id])); ?>">
                                    <i class="fas fa-dice fa-sm"></i>
                                    <?php echo e(__('Games')); ?>

                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('backend.users.edit', array_merge(['user' => $user], request()->query()))); ?>">
                                    <i class="fas fa-pen fa-sm"></i>
                                    <?php echo e(__('Edit')); ?>

                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('backend.users.delete', $user)); ?>">
                                    <i class="fas fa-trash fa-sm"></i>
                                    <?php echo e(__('Delete')); ?>

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
            <?php echo e($users->appends(['search' => $search])->appends(['sort' => $sort])->appends(['order' => $order])->links()); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>