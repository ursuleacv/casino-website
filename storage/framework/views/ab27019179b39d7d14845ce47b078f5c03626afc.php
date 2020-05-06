<li class="nav-item">
    <a class="nav-link <?php echo e(Route::currentRouteName() == 'backend.dashboard.payments' ? 'active' : ''); ?>" href="<?php echo e(route('backend.dashboard.payments')); ?>"><?php echo e(__('Payments')); ?></a>
</li>