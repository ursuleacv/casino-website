<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-multi-slots" aria-expanded="true">
                <?php echo e(__('Game: :game', ['game' => __('Multi Slots')])); ?>

            </button>
        </h5>
    </div>
    <div id="tab-game-multi-slots" class="collapse">
        <div class="card-body">
        
            <div class="accordion">
                <?php $__currentLoopData = config('game-multi-slots.titles'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($title): ?>
                        <h5>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-multi-slots-container-<?php echo e($index); ?>" aria-expanded="true">
                                <?php echo e(__($title)); ?>

                            </button>
                            <button class="btn btn-primary btn-sm" onclick="cloneGameSettings(event, <?php echo e($index); ?>)"><?php echo e(__('Clone')); ?></button>
                            <?php if($index > 0): ?>
                                <button class="btn btn-danger btn-sm" onclick="deleteGameSettings(event, <?php echo e($index); ?>)"><?php echo e(__('Delete')); ?></button>
                            <?php endif; ?>
                        </h5>
                        <div id="tab-game-multi-slots-container-<?php echo e($index); ?>" class="collapse ml-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-multi-slots-options-<?php echo e($index); ?>" aria-expanded="true">
                                            <?php echo e(__('General')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="tab-game-multi-slots-options-<?php echo e($index); ?>" class="collapse ml-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label><?php echo e(__('Title')); ?></label>
                                            <input type="text" name="GAME_MULTI_SLOTS_TITLES[<?php echo e($index); ?>]" class="form-control" value="<?php echo e(config('game-multi-slots.titles')[$index]); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Min bet')); ?></label>
                                            <input type="text" name="GAME_MULTI_SLOTS_MIN_BET[<?php echo e($index); ?>]" class="form-control" value="<?php echo e(config('game-multi-slots.min_bet')[$index]); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Max bet')); ?></label>
                                            <input type="text" name="GAME_MULTI_SLOTS_MAX_BET[<?php echo e($index); ?>]" class="form-control" value="<?php echo e(config('game-multi-slots.max_bet')[$index]); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Bet increment / decrement amount')); ?></label>
                                            <input type="number" name="GAME_MULTI_SLOTS_BET_CHANGE_AMOUNT[<?php echo e($index); ?>]" class="form-control" value="<?php echo e(config('game-multi-slots.bet_change_amount')[$index]); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Default bet')); ?></label>
                                            <input type="text" name="GAME_MULTI_SLOTS_DEFAULT_BET[<?php echo e($index); ?>]" class="form-control" value="<?php echo e(config('game-multi-slots.default_bet')[$index]); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Default lines count')); ?></label>
                                            <input type="text" name="GAME_MULTI_SLOTS_DEFAULT_LINES[<?php echo e($index); ?>]" class="form-control" value="<?php echo e(config('game-multi-slots.default_lines')[$index]); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Max lines count')); ?></label>
                                            <input type="text" name="GAME_MULTI_SLOTS_MAX_LINES[<?php echo e($index); ?>]" class="form-control" value="<?php echo e(config('game-multi-slots.max_lines')[$index]); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-multi-slots-symbols-<?php echo e($index); ?>" aria-expanded="true">
                                            <?php echo e(__('Symbols')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="tab-game-multi-slots-symbols-<?php echo e($index); ?>" class="collapse ml-3">
                                    <div class="card-body">
                                        <div class="form-group">

                                            <div id="game_multi_slots_symbols_<?php echo e($index); ?>" data-url="<?php echo e(route('backend.games.multi-slots.files', ['id' => $index])); ?>" data-token="<?php echo e(csrf_token()); ?>" data-storage="<?php echo e(asset('storage') . '/games/multi-slots/' . $index . '/'); ?>" class="slots-symbols">
                                                <input id="game_multi_slots_symbols_input_<?php echo e($index); ?>" type="hidden" name="GAME_MULTI_SLOTS_SYMBOLS[<?php echo e($index); ?>]" value="<?php echo e(json_encode(config('game-multi-slots.symbols')[$index], JSON_FORCE_OBJECT)); ?>">
                                                <div id="game_multi_slots_symbols_items_<?php echo e($index); ?>" class="items"></div>
                                                <div id="game_multi_slots_symbols_place_<?php echo e($index); ?>" class="place-area">
                                                    <i class="fa fa-spinner fa-spin"></i>
                                                    <i class="fa fa-times-circle"></i>
                                                    <input type="file" multiple>
                                                    <div class="error text"><?php echo e(__('Only png can be used')); ?></div>
                                                    <?php echo e(__('Drag and drop or upload a symbol image here')); ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-multi-slots-reels-<?php echo e($index); ?>" aria-expanded="true">
                                            <?php echo e(__('Reels')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="tab-game-multi-slots-reels-<?php echo e($index); ?>" class="collapse ml-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <p><?php echo e(__('Drag and drop availale symbols on the reels. You can also adjust the order of each symbol in the reel if necessary.')); ?></p>
                                            <input id="game_multi_slots_reel_input_<?php echo e($index); ?>" type="hidden" name="GAME_MULTI_SLOTS_REELS[<?php echo e($index); ?>]" value="<?php echo e(json_encode(config('game-multi-slots.reels')[$index], JSON_FORCE_OBJECT)); ?>">
                                            <div id="game_multi_slots_reel_symbols_<?php echo e($index); ?>" class="reel-symbols"></div>
                                            <div id="game_multi_slots_reels_<?php echo e($index); ?>" class="reels">
                                                <div class="reel" data-idx="0"></div>
                                                <div class="reel" data-idx="1"></div>
                                                <div class="reel" data-idx="2"></div>
                                                <div class="reel" data-idx="3"></div>
                                                <div class="reel" data-idx="4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(mix('css/games/slots/' . $settings->theme . '.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(mix('js/games/multi-slots/admin.js')); ?>"></script>
    <script>
        <?php $__currentLoopData = config('game-multi-slots.titles'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($title): ?>
                window.addEventListener('DOMContentLoaded', function () {
                    window.game_multi_slots_config('<?php echo e($index); ?>');
                });
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        function createForm(url) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var element = document.createElement('input');
            element.type = 'hidden';
            element.name = '_token';
            element.value = '<?php echo e(@csrf_token()); ?>';
            form.appendChild(element);

            return form;
        }

        function cloneGameSettings(event, index) {
            event.preventDefault();
            var form = createForm('/admin/games/multi-slots/' + index + '/clone');
            document.body.appendChild(form);
            form.submit();
        }

        function deleteGameSettings(event, index) {
            event.preventDefault();
            var form = createForm('/admin/games/multi-slots/' + index + '/delete');
            document.body.appendChild(form);
            form.submit();
        }
    </script>
<?php $__env->stopPush(); ?>