

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Blackjack')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title_extra'); ?>
    <button class="btn btn-sm btn-primary float-right mt-2" type="button" data-toggle="collapse" data-target="#provably-fair-form" aria-expanded="false" aria-controls="provably-fair-form">
        <?php echo e(__('Provably fair')); ?>

    </button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('frontend.includes.provably-fair-form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
	<div id="game_blackjack_container" class="gbj-container <?php echo e(config('settings.theme')); ?>">
		<div class="inner">
			<img id="game_blackjack_bg" class="bg" src="/images/games/blackjack/<?php echo e(config('settings.theme')); ?>/bg.png">
			<div class="gbj-btns-group-settings">
				<button id="gbj_btn_mute" type="button" class="gbj-btn-control gbj-btn-mute">
					<object>
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
							<path fill="#fff" stroke="#fff" d="M7.6 20.9l-.1-.1H.7v-9.5h6.8l.1-.2 7.9-7.9v25.6l-7.9-7.9zM28.8 16c0-5.6-3.7-10.4-8.8-12.1V1.3a15.3 15.3 0 0 1 0 29.4v-2.6c5-1.7 8.8-6.5 8.8-12.1zM20 9.8c2 1.3 3.4 3.6 3.4 6.2S22 20.9 20 22.2V9.8z"/>
							<path class="mute" fill="#fff" stroke="#fff" d="M0 0L32 32" stroke-width="4"></path>
						</svg>
					</object>
				</button>
				<button id="gbj_btn_fulls" type="button" class="gbj-btn-control gbj-btn-fullscreen">
					<object>
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
							<path class="fullscreen-enter" fill="#fff" stroke="#fff" d="M6 29h6v2H1V20h2v7l1-1 8-7 1 1-7 8-1 1h1zm7-17l-1 1-8-7-1-1v7H1V1h11v2H5l1 1 7 8zm16 14v-6h2v11H20v-2h7l-1-1-7-8 1-1 8 7 1 1v-1zM28 6l-8 7-1-1 7-8 1-1h-7V1h11v11h-2V5l-1 1z"/>
							<path class="fullscreen-exit" fill="#fff" stroke="#fff" d="M8 21H2v-2h11v11h-2v-7l-1 1-8 7-1-1 7-8 1-1zM22 8l8-7 1 1-7 8-1 1h7v2H19V2h2v7zM8 10L1 2l1-1 8 7 1 1V2h2v11H2v-2h7zM21 24v6h-2V19h11v2h-7l1 1 7 8-1 1-8-7-1-1z"/>
						</svg>
					</object>
				</button>
			</div>
            
			<div id="gbj_text_message" class="gbj-game-message"><?php echo e(__('Select cards to hold them')); ?></div>
            
            <div id="gbj_deck" class="deck"></div>
            
            
            <div id="gbj_boss_cards" class="boss-cards"><span id="gbj_boss_cards_score" class="score"></span></div>
            
            <div id="gbj_my_cards" class="my-cards"><span id="gbj_hand1_score" class="score hand-1"></span><span id="gbj_hand2_score" class="score hand-2"></span></div>
            
			<div class="gbj-game-panel">
				<div class="gbj-bet-size">
					<div class="label text-uppercase"><?php echo e(__('Bet size')); ?></div>
					<button id="gbj_bet_btn_minus" class="gbj-bet-btn minus" type="button"><span></span></button>
					<span id="gbj_bet_text" class="value"><?php echo e(config('game-blackjack.default_bet_amount')); ?></span>
					<button id="gbj_bet_btn_plus" class="gbj-bet-btn plus" type="button"><span></span></button>
				</div>
				<button id="gbj_btn_hit" class="gbj-btn-hit gbj-btn-simple" type="button"><span class="text-uppercase"><?php echo e(__('Hit')); ?></span></button>
				<button id="gbj_btn_stand" class="gbj-btn-stand gbj-btn-simple" type="button"><span class="text-uppercase"><?php echo e(__('Stand')); ?></span></button>
				<button id="gbj_btn_deal" class="gbj-btn-deal" type="button"><span></span></button>
				<button id="gbj_btn_double" class="gbj-btn-double gbj-btn-simple" type="button"><span class="text-uppercase"><?php echo e(__('Double')); ?></span></button>
				<button id="gbj_btn_split" class="gbj-btn-split gbj-btn-simple" type="button"><span class="text-uppercase"><?php echo e(__('Split')); ?></span></button>
				<button id="gbj_btn_insurance" class="gbj-btn-insurance" type="button"><span class="text-uppercase"><?php echo e(__('Insurance')); ?></span></button>
				<span class="insurance-shadow"></span>
				<div class="gbj-text balance">
					<span class="name"><?php echo e(__('Balance')); ?></span>
					<span id="gbj_balance_text" class="value"><?php echo e($game->account->balance); ?></span>
				</div>
				
			</div>
		</div>
		<div id="gbj_preloader" class="preloader">
			<div>
				<img src="<?php echo e(asset('images/games/blackjack/' . $settings->theme . '/loader.svg')); ?>" alt="">
				<span><?php echo e(__('Loading...')); ?><span id="gbj_preloader_text" class="value">0%</span></span>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(mix('css/games/blackjack/' . $settings->theme . '.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/preloadjs.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/soundjs.min.js')); ?>"></script>
    <script src="<?php echo e(mix('js/games/blackjack/game.js')); ?>"></script>
    <script>
        new CGameBlackjack({
            game_id: <?php echo e($game->id); ?>,
            min_bet: <?php echo e(config('game-blackjack.min_bet')); ?>,
            max_bet: <?php echo e(config('game-blackjack.max_bet')); ?>,
			bet_change_amount: <?php echo e(config('game-blackjack.bet_change_amount')); ?>,
            default_bet_amount: <?php echo e(config('game-blackjack.default_bet_amount')); ?>,
            balance: <?php echo e($game->account->balance); ?>,
            routes: {
                deal: '<?php echo e(route('games.blackjack.deal')); ?>',
                insurance: '<?php echo e(route('games.blackjack.insurance')); ?>',
                hit: '<?php echo e(route('games.blackjack.hit')); ?>',
                double: '<?php echo e(route('games.blackjack.double')); ?>',
                stand: '<?php echo e(route('games.blackjack.stand')); ?>',
                split: '<?php echo e(route('games.blackjack.split')); ?>',
                splitHit: '<?php echo e(route('games.blackjack.split-hit')); ?>',
                splitStand: '<?php echo e(route('games.blackjack.split-stand')); ?>'
            },
            statuses: {
                completed: <?php echo e(\App\Models\Game::STATUS_COMPLETED); ?>

            },
            game_theme: '<?php echo e(config('settings.theme')); ?>'
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>