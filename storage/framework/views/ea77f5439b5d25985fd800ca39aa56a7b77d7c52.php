<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?> :: <?php echo e(__('Games')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('backend.pages.dashboard.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="row text-center mt-3">
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Games played')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($games_count); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Played last 30 days')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($played_last_month); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Played last 7 days')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($played_last_week); ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center mt-3">        
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Avg bet')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($avg_bet); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Max bet')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($max_bet); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Total bet')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($total_bet); ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center mt-3">        
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Avg net win')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($avg_net_win); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Max net win')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($max_net_win); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary"><?php echo e(__('Total net win')); ?></div>
                <div class="card-body">
                    <h4 class="card-title m-0"><?php echo e($total_net_win); ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 mb-4">
            <h2 class="text-center"><?php echo e(__('Games played by day')); ?></h2>
            <time-series-chart :data="<?php echo e(json_encode($played_by_day)); ?>" :scrollbar="true" theme="<?php echo e($settings->theme); ?>" class="time-series-chart"></time-series-chart>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 mb-4">
            <h2 class="text-center"><?php echo e(__('Net win by day')); ?></h2>
            <time-series-chart :data="<?php echo e(json_encode($net_win_by_day)); ?>" :scrollbar="true" type="column" theme="<?php echo e($settings->theme); ?>" class="time-series-chart"></time-series-chart>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center"><?php echo e(__('Games by result')); ?></h2>
            <pie-chart :data="<?php echo e(json_encode($played_by_result)); ?>" theme="<?php echo e($settings->theme); ?>" class="pie-chart"></pie-chart>
        </div>
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center"><?php echo e(__('Games by type')); ?></h2>
            <pie-chart :data="<?php echo e(json_encode($played_by_type)); ?>" theme="<?php echo e($settings->theme); ?>" class="pie-chart"></pie-chart>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <h2 class="text-center mb-4"><?php echo e(__('Extra games stats')); ?></h2>
            <table class="table table-hover table-stackable">
                <thead>
                <tr>
                    <th><?php echo e(__('Game')); ?></th>
                    <th class="text-right"><?php echo e(__('Bet')); ?></th>
                    <th class="text-right"><?php echo e(__('Win')); ?></th>
                    <th class="text-right"><?php echo e(__('Net win')); ?></th>
                    <th class="text-right"><?php echo e(__('Return to player')); ?></th>
                    <th class="text-right"><?php echo e(__('House edge')); ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $played_by_type_ext; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td data-title="<?php echo e(__('Game')); ?>"><?php echo e($item->game); ?></td>
                            <td data-title="<?php echo e(__('Bet')); ?>" class="text-right"><?php echo e($item->_bet); ?></td>
                            <td data-title="<?php echo e(__('Win')); ?>" class="text-right"><?php echo e($item->_win); ?></td>
                            <td data-title="<?php echo e(__('Net win')); ?>" class="text-right"><?php echo e($item->_net_win); ?></td>
                            <td data-title="<?php echo e(__('Return to player')); ?>" class="text-right"><?php echo e($item->_return_to_player); ?></td>
                            <td data-title="<?php echo e(__('House edge')); ?>" class="text-right"><?php echo e($item->_house_edge); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center"><?php echo e(__('Top wins')); ?></h2>
            <?php if($top_wins->isEmpty()): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo e(__('There are no games yet.')); ?>

                </div>
            <?php else: ?>
                <table class="table table-hover table-stackable">
                    <thead>
                    <tr>
                        <th><?php echo e(__('User')); ?></th>
                        <th><?php echo e(__('Game')); ?></th>
                        <th class="text-right"><?php echo e(__('Net win')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $top_wins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td data-title="<?php echo e(__('User')); ?>">
                                <a href="<?php echo e(route('frontend.users.show', $game->account->user)); ?>">
                                    <?php echo e($game->account->user->name); ?>

                                </a>
                            </td>
                            <td data-title="<?php echo e(__('Game')); ?>">
                                <a href="<?php echo e(route('backend.games.show', $game)); ?>">
                                    <?php echo e(__('app.game_' . class_basename(str_replace('GameMultiSlots', 'GameSlots', $game->gameable_type)))); ?>

                                </a>
                            </td>
                            <td data-title="<?php echo e(__('Net win')); ?>" class="text-right"><?php echo e($game->_net_win); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center"><?php echo e(__('Top losses')); ?></h2>
            <?php if($top_losses->isEmpty()): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo e(__('There are no games yet.')); ?>

                </div>
            <?php else: ?>
                <table class="table table-hover table-stackable">
                    <thead>
                    <tr>
                        <th><?php echo e(__('User')); ?></th>
                        <th><?php echo e(__('Game')); ?></th>
                        <th class="text-right"><?php echo e(__('Net loss')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $top_losses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td data-title="<?php echo e(__('User')); ?>">
                                <a href="<?php echo e(route('frontend.users.show', $game->account->user)); ?>">
                                    <?php echo e($game->account->user->name); ?>

                                </a>
                            </td>
                            <td data-title="<?php echo e(__('Game')); ?>">
                                <a href="<?php echo e(route('backend.games.show', $game)); ?>">
                                    <?php echo e(__('app.game_' . class_basename(str_replace('GameMultiSlots', 'GameSlots', $game->gameable_type)))); ?>

                                </a>
                            </td>
                            <td data-title="<?php echo e(__('Net loss')); ?>" class="text-right"><?php echo e($game->_net_win); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>