<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-video-poker" aria-expanded="true">
                <?php echo e(__('Game: :game', ['game' => __('Video Poker')])); ?>

            </button>
        </h5>
    </div>
    <div id="tab-game-video-poker" class="collapse">
        <div class="card-body">
            <div class="accordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-video-poker-options" aria-expanded="true">
                                <?php echo e(__('General')); ?>

                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-video-poker-options" class="collapse ml-3">
                        <div class="card-body">
                            <div class="form-group">
                                <label><?php echo e(__('Min bet')); ?></label>
                                <input type="number" name="GAME_VIDEO_POKER_MIN_BET" class="form-control" value="<?php echo e(config('game-video-poker.min_bet')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Max bet')); ?></label>
                                <input type="number" name="GAME_VIDEO_POKER_MAX_BET" class="form-control" value="<?php echo e(config('game-video-poker.max_bet')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Bet increment / decrement amount')); ?></label>
                                <input type="number" name="GAME_VIDEO_POKER_BET_CHANGE_AMOUNT" class="form-control" value="<?php echo e(config('game-video-poker.bet_change_amount')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Default bet amount')); ?></label>
                                <input type="number" name="GAME_VIDEO_POKER_DEFAULT_BET_AMOUNT" class="form-control" value="<?php echo e(config('game-video-poker.default_bet_amount')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Default bet coins')); ?></label>
                                <select name="GAME_VIDEO_POKER_DEFAULT_BET_COINS" class="custom-select">
                                    <option value="1" <?php echo e(config('game-video-poker.default_bet_coins')==1?'selected':''); ?>>1</option>
                                    <option value="2" <?php echo e(config('game-video-poker.default_bet_coins')==2?'selected':''); ?>>2</option>
                                    <option value="3" <?php echo e(config('game-video-poker.default_bet_coins')==3?'selected':''); ?>>3</option>
                                    <option value="4" <?php echo e(config('game-video-poker.default_bet_coins')==4?'selected':''); ?>>4</option>
                                    <option value="5" <?php echo e(config('game-video-poker.default_bet_coins')==5?'selected':''); ?>>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-video-poker-paytable" aria-expanded="true">
                                <?php echo e(__('Paytable')); ?>

                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-video-poker-paytable" class="collapse ml-3">
                        <input type="hidden" name="GAME_VIDEO_POKER_PAYTABLE" class="form-control" value="<?php echo e(config('game-video-poker.paytable')); ?>">
                        <div class="table-responsive">
                            <table class="game-video-poker-paytable table table-striped">
                                <tr>
                                    <td></td>
                                    <?php for($i=1;$i<6;$i++): ?>
                                        <td class="text-center"><?php echo e($i); ?></td>
                                    <?php endfor; ?>
                                </tr>

                                <?php $__currentLoopData = array_reverse(Packages\GameVideoPoker\Models\GameVideoPoker::combinations(), TRUE); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comb_id => $comb_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr data-combination="0">
                                        <td><?php echo e($comb_name); ?></td>
                                        <?php for($j=0;$j<5;$j++): ?>
                                            <td><input id="game_video_poker_paytable_input_<?php echo e($comb_id); ?>_<?php echo e($j); ?>" type="number" step="1" value="0" data-idx="<?php echo e($comb_id); ?>,<?php echo e($j); ?>"></td>
                                        <?php endfor; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(mix('css/games/video-poker/' . $settings->theme . '.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(mix('js/games/video-poker/admin.js')); ?>"></script>
<?php $__env->stopPush(); ?>