<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="<?php echo e(route('backend.dashboard.index')); ?>">
            <img src="<?php echo e(asset('images/logo.png')); ?>" class="d-inline-block align-top" alt="<?php echo e(__('Crypto Casino')); ?>">
            <?php echo e(__('Crypto Casino')); ?>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <div class="navbar-nav dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo e(__('Navigation')); ?>

                </a>
                <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
                    <span class="dropdown-header"><strong><?php echo e(__('Frontend')); ?></strong></span>
                    <a class="dropdown-item" href="<?php echo e(route('frontend.index')); ?>"><?php echo e(__('Home')); ?></a>
                    <div class="dropdown-divider"></div>
                    <span class="dropdown-header"><strong><?php echo e(__('Backend')); ?></strong></span>
                    <a class="dropdown-item" href="<?php echo e(route('backend.dashboard.index')); ?>"><?php echo e(__('Dashboard')); ?></a>
                    <a class="dropdown-item" href="<?php echo e(route('backend.users.index')); ?>"><?php echo e(__('Users')); ?></a>
                    <a class="dropdown-item" href="<?php echo e(route('backend.accounts.index')); ?>"><?php echo e(__('Accounts')); ?></a>
                    <a class="dropdown-item" href="<?php echo e(route('backend.games.index')); ?>"><?php echo e(__('Games')); ?></a>

                    <?php echo $__env->make("payments::backend.includes.menu", array_except(get_defined_vars(), array("__data", "__path")))->render();?>

                    <a class="dropdown-item" href="<?php echo e(route('backend.addons.index')); ?>"><?php echo e(__('Add-ons')); ?></a>
                    <a class="dropdown-item" href="<?php echo e(route('backend.settings.index')); ?>"><?php echo e(__('Settings')); ?></a>
                    <a class="dropdown-item" href="<?php echo e(route('backend.maintenance.index')); ?>"><?php echo e(__('Maintenance')); ?></a>
                    <a class="dropdown-item" href="<?php echo e(route('backend.license.index')); ?>"><?php echo e(__('License registration')); ?></a>

                    <div class="dropdown-divider"></div>
                    <form method="post" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn dropdown-item"><?php echo e(__('Log out')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>
