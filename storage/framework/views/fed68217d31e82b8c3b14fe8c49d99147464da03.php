<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-american-bingo" aria-expanded="true">
                <?php echo e(__('Game: :game', ['game' => __('75 Ball Bingo')])); ?>

            </button>
        </h5>
    </div>
    <div id="tab-game-american-bingo" class="collapse">
        <div class="card-body">
            <div class="accordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-american-bingo-options" aria-expanded="true">
                                <?php echo e(__('General')); ?>

                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-american-bingo-options" class="collapse ml-3">
                        <div class="card-body">
                            <div class="form-group">
                                <label><?php echo e(__('Min bet')); ?></label>
                                <input type="number" name="GAME_AMERICAN_BINGO_MIN_BET" class="form-control" value="<?php echo e(config('game-american-bingo.min_bet')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Max bet')); ?></label>
                                <input type="number" name="GAME_AMERICAN_BINGO_MAX_BET" class="form-control" value="<?php echo e(config('game-american-bingo.max_bet')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Bet increment / decrement amount')); ?></label>
                                <input type="number" name="GAME_AMERICAN_BINGO_BET_CHANGE_AMOUNT" class="form-control" value="<?php echo e(config('game-american-bingo.bet_change_amount')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Default bet amount')); ?></label>
                                <input type="number" name="GAME_AMERICAN_BINGO_DEFAULT_BET_AMOUNT" class="form-control" value="<?php echo e(config('game-american-bingo.default_bet_amount')); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-american-bingo-paytable" aria-expanded="true">
                                <?php echo e(__('Paytable')); ?>

                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-american-bingo-paytable" class="collapse ml-3">
                        <div class="card-body">
                            <?php $__currentLoopData = config('game-american-bingo.payouts'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pattern => $payout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group">
                                    <label><?php echo e(__('app.american_bingo_pattern_' . $pattern)); ?> <?php echo e(__('pays')); ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><?php echo e(__('Bet')); ?> x </span>
                                        </div>
                                        <input type="number" name="GAME_AMERICAN_BINGO_PAYOUTS[<?php echo e($pattern); ?>]" class="form-control" value="<?php echo e($payout); ?>" step="1">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>