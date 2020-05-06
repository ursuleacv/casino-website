<th class="<?php echo e($id == $sort ? ($order == 'asc' ? 'sort-asc' : 'sort-desc') : ''); ?> <?php echo e(isset($class) ? $class : ''); ?>">
    <?php if($id == $sort): ?>
        <?php if($order == 'asc'): ?>
            <i class="fas fa-arrow-up"></i>
        <?php else: ?>
            <i class="fas fa-arrow-down"></i>
        <?php endif; ?>
    <?php endif; ?>
    <a href="<?php echo e(route(Route::currentRouteName(), array_merge(request()->query(), ['sort' => $id, 'order' => $id != $sort ? 'asc' : ($order == 'asc'  ? 'desc' : 'asc')]))); ?>"><?php echo e($slot); ?></a>
</th>