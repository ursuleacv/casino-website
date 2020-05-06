<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?php echo e(Route::currentRouteName() == 'backend.dashboard.index' ? 'active' : ''); ?>" href="<?php echo e(route('backend.dashboard.index')); ?>"><?php echo e(__('Users')); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Route::currentRouteName() == 'backend.dashboard.games' ? 'active' : ''); ?>" href="<?php echo e(route('backend.dashboard.games')); ?>"><?php echo e(__('Games')); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Route::currentRouteName() == 'backend.dashboard.accounts' ? 'active' : ''); ?>" href="<?php echo e(route('backend.dashboard.accounts')); ?>"><?php echo e(__('Accounts')); ?></a>
    </li>

    <?php echo $__env->make("payments::backend.pages.dashboard.tabs", array_except(get_defined_vars(), array("__data", "__path")))->render();?>
</ul>