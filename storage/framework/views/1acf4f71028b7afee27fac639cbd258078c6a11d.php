<form method="GET" action="<?php echo e(route($route)); ?>">
    <div class="input-group">
        <input name="search" type="text" class="form-control" placeholder="<?php echo e(__('Search...')); ?>" value="<?php echo e($search); ?>">
        <div class="input-group-append">
            <?php if($search): ?>
                <a class="btn btn-info" href="<?php echo e(route($route)); ?>">
                    <i class="fa fa-times"></i>
                </a>
            <?php endif; ?>
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>