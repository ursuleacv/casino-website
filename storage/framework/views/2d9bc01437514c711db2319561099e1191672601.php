<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-keno" aria-expanded="true">
                <?php echo e(__('Game: :game', ['game' => __('Keno')])); ?>

            </button>
        </h5>
    </div>
    <div id="tab-game-keno" class="collapse">
        <div class="card-body">
            <div class="accordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-keno-options" aria-expanded="true">
                                <?php echo e(__('General')); ?>

                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-keno-options" class="collapse ml-3">
                        <div class="card-body">
                            <div class="form-group">
                                <label><?php echo e(__('Min bet')); ?></label>
                                <input type="number" name="GAME_KENO_MIN_BET" class="form-control" value="<?php echo e(config('game-keno.min_bet')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Max bet')); ?></label>
                                <input type="number" name="GAME_KENO_MAX_BET" class="form-control" value="<?php echo e(config('game-keno.max_bet')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Bet increment / decrement amount')); ?></label>
                                <input type="number" name="GAME_KENO_BET_CHANGE_AMOUNT" class="form-control" value="<?php echo e(config('game-keno.bet_change_amount')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Default bet amount')); ?></label>
                                <input type="number" name="GAME_KENO_DEFAULT_BET_AMOUNT" class="form-control" value="<?php echo e(config('game-keno.default_bet_amount')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Draw count')); ?></label>
                                <input type="number" name="GAME_KENO_DRAW_COUNT" class="form-control" value="<?php echo e(config('game-keno.draw_count')); ?>">
                                <small>
                                    <?php echo e(__('How many random numbers will be drawn in each game.')); ?>

                                    <?php echo e(__('The higher this number is the more likely a user to win.')); ?>

                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-keno-paytable" aria-expanded="true">
                                <?php echo e(__('Paytable')); ?>

                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-keno-paytable" class="collapse ml-3">
                        <div class="card-body">
                            <?php $__currentLoopData = config('game-keno.payouts'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hits => $payout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group">
                                    <label><?php echo e(trans_choice('1 hit|:n hits', $hits, ['n' => $hits])); ?> <?php echo e(__('pays')); ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><?php echo e(__('Bet')); ?> x </span>
                                        </div>
                                        <input type="number" name="GAME_KENO_PAYOUTS[<?php echo e($hits); ?>]" class="form-control" value="<?php echo e($payout); ?>" step="1">
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