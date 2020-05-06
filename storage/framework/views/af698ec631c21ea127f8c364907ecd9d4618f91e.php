<?php $__env->startSection('title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('backend.settings.update')); ?>">
        <?php echo csrf_field(); ?>
        <div class="accordion">
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-main" aria-expanded="true">
                            <?php echo e(__('Main')); ?>

                        </button>
                    </h5>
                </div>
                <div id="tab-main" class="collapse">
                    <div class="card-body text-body">
                        <div class="form-group">
                            <label><?php echo e(__('Theme')); ?></label>
                            <select name="THEME" class="custom-select">
                                <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($theme); ?>" <?php echo e($theme==config('settings.theme') ? 'selected' : ''); ?>><?php echo e(__('app.theme_' . $theme)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Language')); ?></label>
                            <select name="LOCALE" class="custom-select">
                                <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code); ?>" <?php echo e($code==config('app.locale') ? 'selected' : ''); ?>><?php echo e($locale->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-users" aria-expanded="true">
                            <?php echo e(__('Users')); ?>

                        </button>
                    </h5>
                </div>
                <div id="tab-users" class="collapse">
                    <div class="card-body text-body">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="hidden" name="USERS_EMAIL_VERIFICATION" value="false">
                                <input type="checkbox" name="USERS_EMAIL_VERIFICATION" value="true" class="form-check-input" <?php echo e(config('settings.users.email_verification') ? 'checked="checked"' : ''); ?>>
                                <label class="form-check-label">
                                    <?php echo e(__('Require email verification')); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Session lifetime')); ?></label>
                            <select name="SESSION_LIFETIME" class="custom-select">
                                <option value="120" <?php echo e(config('session.lifetime')==120 ? 'selected' : ''); ?>><?php echo e(__('2 hours')); ?></option>
                                <option value="720" <?php echo e(config('session.lifetime')==720 ? 'selected' : ''); ?>><?php echo e(__('12 hours')); ?></option>
                                <option value="1440" <?php echo e(config('session.lifetime')==1440 ? 'selected' : ''); ?>><?php echo e(__('24 hours')); ?></option>
                                <option value="10080" <?php echo e(config('session.lifetime')==10080 ? 'selected' : ''); ?>><?php echo e(__('1 week')); ?></option>
                                <option value="10080" <?php echo e(config('session.lifetime')==10080 ? 'selected' : ''); ?>><?php echo e(__('1 week')); ?></option>
                                <option value="43200" <?php echo e(config('session.lifetime')==43200 ? 'selected' : ''); ?>><?php echo e(__('1 month')); ?></option>
                                <option value="525600" <?php echo e(config('session.lifetime')==525600 ? 'selected' : ''); ?>><?php echo e(__('1 year')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-accounts" aria-expanded="true">
                            <?php echo e(__('Accounts')); ?>

                        </button>
                    </h5>
                </div>
                <div id="tab-accounts" class="collapse">
                    <div class="card-body text-body">
                        <div class="form-group">
                            <label><?php echo e(__('Initial account balance')); ?></label>
                            <input type="text" name="ACCOUNTS_INITIAL_BALANCE" class="form-control" value="<?php echo e(config('settings.accounts.initial_balance')); ?>">
                            <small><?php echo e(__('Number of credits assigned to user on sign up.')); ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-referral-program" aria-expanded="true">
                            <?php echo e(__('Referral program')); ?>

                        </button>
                    </h5>
                </div>
                <div id="tab-referral-program" class="collapse">
                    <div class="card-body text-body">
                        <div class="form-group">
                            <label><?php echo e(__('Referee sign up bonus')); ?></label>
                            <div class="input-group">
                                <input type="text" name="REFERRAL_REFEREE_SIGN_UP_CREDITS" class="form-control" value="<?php echo e(config('settings.referral.referee_sign_up_credits')); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                                </div>
                            </div>
                            <small><?php echo e(__('How much will the referred user get when signing up using a referral link.')); ?></small>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Referrer sign up bonus')); ?></label>
                            <div class="input-group">
                                <input type="text" name="REFERRAL_REFERRER_SIGN_UP_CREDITS" class="form-control" value="<?php echo e(config('settings.referral.referrer_sign_up_credits')); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                                </div>
                            </div>
                            <small><?php echo e(__('How much will the referrer user get when anyone signs up using their referral link.')); ?></small>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Referrer game bonus')); ?></label>
                            <div class="input-group">
                                <input type="text" name="REFERRAL_REFERRER_GAME_BET_PCT" class="form-control" value="<?php echo e(config('settings.referral.referrer_game_bet_pct')); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <small><?php echo e(__('How much (% from the bet amount) will the referrer user get when any of the referred users plays a game.')); ?></small>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Referrer deposit bonus')); ?></label>
                            <div class="input-group">
                                <input type="text" name="REFERRAL_REFERRER_DEPOSIT_PCT" class="form-control" value="<?php echo e(config('settings.referral.referrer_deposit_pct')); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <small><?php echo e(__('How much (% from the deposit amount) will the referrer user get when any of the referred users completes a deposit.')); ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-bots" aria-expanded="true">
                            <?php echo e(__('Bots')); ?>

                        </button>
                    </h5>
                </div>
                <div id="tab-bots" class="collapse">
                    <div class="card-body text-body">
                        <p>
                            <?php echo e(__('Bots can be automatically generated on the Users page.')); ?>

                            <?php echo e(__('Periodically (depending on the frequency setting) a random number of bots will be selected (according to min and max bots settings).')); ?>

                            <?php echo e(__('Then every selected bot will play exactly one game with random parameters.')); ?>

                        </p>
                        <div class="form-group">
                            <label><?php echo e(__('Frequency')); ?></label>
                            <select name="BOTS_PLAY_FREQUENCY" class="custom-select">
                                <option value="1" <?php echo e(config('settings.bots.play_frequency')==1 ? 'selected' : ''); ?>><?php echo e(__('Every minute')); ?></option>
                                <option value="5" <?php echo e(config('settings.bots.play_frequency')==5 ? 'selected' : ''); ?>><?php echo e(__('Every 5 minutes')); ?></option>
                                <option value="10" <?php echo e(config('settings.bots.play_frequency')==10 ? 'selected' : ''); ?>><?php echo e(__('Every 10 minutes')); ?></option>
                                <option value="15" <?php echo e(config('settings.bots.play_frequency')==15 ? 'selected' : ''); ?>><?php echo e(__('Every 15 minutes')); ?></option>
                                <option value="30" <?php echo e(config('settings.bots.play_frequency')==30 ? 'selected' : ''); ?>><?php echo e(__('Every 30 minutes')); ?></option>
                            </select>
                            <small><?php echo e(__('Choose how often bots will play games.')); ?></small>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Min bots')); ?></label>
                            <input type="text" name="BOTS_SELECT_COUNT_MIN" class="form-control" value="<?php echo e(config('settings.bots.select_count_min')); ?>">
                            <small><?php echo e(__('Minimum number of bots to play a game during each cycle.')); ?></small>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Max bots')); ?></label>
                            <input type="text" name="BOTS_SELECT_COUNT_MAX" class="form-control" value="<?php echo e(config('settings.bots.select_count_max')); ?>">
                            <small><?php echo e(__('Maximum number of bots to play a game during each cycle.')); ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-numbers" aria-expanded="true">
                            <?php echo e(__('Number formatting')); ?>

                        </button>
                    </h5>
                </div>
                <div id="tab-numbers" class="collapse">
                    <div class="card-body text-body">
                        <div class="form-group">
                            <label><?php echo e(__('Decimal point')); ?></label>
                            <select name="FORMAT_NUMBER_DECIMAL_POINT" class="custom-select">
                                <?php $__currentLoopData = $separators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $separator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code); ?>" <?php echo e($code==config('settings.format.number.decimal_point') ? 'selected' : ''); ?>><?php echo e($separator); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Thousands separator')); ?></label>
                            <select name="FORMAT_NUMBER_THOUSANDS_SEPARATOR" class="custom-select">
                                <?php $__currentLoopData = $separators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $separator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code); ?>" <?php echo e($code==config('settings.format.number.thousands_separator') ? 'selected' : ''); ?>><?php echo e($separator); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-mail" aria-expanded="true">
                            <?php echo e(__('Mail')); ?>

                        </button>
                    </h5>
                </div>
                <div id="tab-mail" class="collapse">
                    <div class="card-body">
                        <div class="form-group">
                            <label><?php echo e(__('Mail driver')); ?></label>
                            <select name="MAIL_DRIVER" class="custom-select">
                                <option value="sendmail" <?php echo e(config('mail.driver')=='sendmail' ? 'selected' : ''); ?>><?php echo e(__('SendMail')); ?></option>
                                <option value="smtp" <?php echo e(config('mail.driver')=='smtp' ? 'selected' : ''); ?>><?php echo e(__('SMTP')); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('SMTP host')); ?></label>
                            <input type="text" name="MAIL_HOST" class="form-control" value="<?php echo e(config('mail.host')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('SMTP port')); ?></label>
                            <input type="text" name="MAIL_PORT" class="form-control" value="<?php echo e(config('mail.port')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('SMTP email from address')); ?></label>
                            <input type="text" name="MAIL_FROM_ADDRESS" class="form-control" value="<?php echo e(config('mail.from.address')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('SMTP email from name')); ?></label>
                            <input type="text" name="MAIL_FROM_NAME" class="form-control" value="<?php echo e(config('mail.from.name')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('SMTP user')); ?></label>
                            <input type="text" name="MAIL_USERNAME" class="form-control" value="<?php echo e(config('mail.username')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('SMTP password')); ?></label>
                            <input type="password" name="MAIL_PASSWORD" class="form-control" value="<?php echo e(config('mail.password')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Mail encryption')); ?></label>
                            <select name="MAIL_ENCRYPTION" class="custom-select">
                                <option value="" <?php echo e(!config('mail.encryption') ? 'selected' : ''); ?>><?php echo e(__('None')); ?></option>
                                <option value="tls" <?php echo e(config('mail.encryption')=='tls' ? 'selected' : ''); ?>><?php echo e(__('TLS')); ?></option>
                                <option value="ssl" <?php echo e(config('mail.encryption')=='ssl' ? 'selected' : ''); ?>><?php echo e(__('SSL')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-integration" aria-expanded="true">
                            <?php echo e(__('Integration')); ?>

                        </button>
                    </h5>
                </div>
                <div id="tab-integration" class="collapse">
                    <div class="card-body">
                        <div class="form-group">
                            <label><?php echo e(__('Google Tag Manager container ID')); ?></label>
                            <input type="text" name="GTM_CONTAINER_ID" class="form-control" value="<?php echo e(config('settings.gtm_container_id')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('reCaptcha public key')); ?></label>
                            <input type="text" name="RECAPTCHA_PUBLIC_KEY" class="form-control" value="<?php echo e(config('settings.recaptcha.public_key')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('reCaptcha private key')); ?></label>
                            <input type="text" name="RECAPTCHA_SECRET_KEY" class="form-control" value="<?php echo e(config('settings.recaptcha.secret_key')); ?>">
                            <small>
                                <?php echo e(__('Leave empty if you do not want to use reCaptcha validation. Public and private keys can be obtained at :url', ['url' => 'https://www.google.com/recaptcha'])); ?>

                            </small>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="BROADCAST_DRIVER" value="pusher">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Pusher App ID')); ?></label>
                            <input type="text" name="PUSHER_APP_ID" class="form-control" value="<?php echo e(config('broadcasting.connections.pusher.app_id')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Pusher App key')); ?></label>
                            <input type="text" name="PUSHER_APP_KEY" class="form-control" value="<?php echo e(config('broadcasting.connections.pusher.key')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Pusher App secret')); ?></label>
                            <input type="text" name="PUSHER_APP_SECRET" class="form-control" value="<?php echo e(config('broadcasting.connections.pusher.secret')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Pusher cluster')); ?></label>
                            <input type="text" name="PUSHER_APP_CLUSTER" class="form-control" value="<?php echo e(config('broadcasting.connections.pusher.options.cluster')); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-developer" aria-expanded="true">
                            <?php echo e(__('Developer')); ?>

                        </button>
                    </h5>
                </div>
                <div id="tab-developer" class="collapse">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="hidden" name="APP_DEBUG" value="false">
                                <input type="checkbox" name="APP_DEBUG" value="true" class="form-check-input" <?php echo e(config('app.debug') ? 'checked="checked"' : ''); ?>>
                                <label class="form-check-label">
                                    <?php echo e(__('Debug mode')); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Log level')); ?></label>
                            <select name="APP_LOG_LEVEL" class="custom-select">
                                <?php $__currentLoopData = $log_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log_level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($log_level); ?>" <?php echo e($log_level==env('APP_LOG_LEVEL', 'emergency') ? 'selected' : ''); ?>><?php echo e(__(ucfirst($log_level))); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo $__env->make("game-american-bingo::backend.pages.settings", array_except(get_defined_vars(), array("__data", "__path")))->render();echo $__env->make("game-blackjack::backend.pages.settings", array_except(get_defined_vars(), array("__data", "__path")))->render();echo $__env->make("game-dice::backend.pages.settings", array_except(get_defined_vars(), array("__data", "__path")))->render();echo $__env->make("game-keno::backend.pages.settings", array_except(get_defined_vars(), array("__data", "__path")))->render();echo $__env->make("game-multi-slots::backend.pages.settings", array_except(get_defined_vars(), array("__data", "__path")))->render();echo $__env->make("game-roulette::backend.pages.settings", array_except(get_defined_vars(), array("__data", "__path")))->render();echo $__env->make("game-slots::backend.pages.settings", array_except(get_defined_vars(), array("__data", "__path")))->render();echo $__env->make("game-video-poker::backend.pages.settings", array_except(get_defined_vars(), array("__data", "__path")))->render();echo $__env->make("payments::backend.pages.settings", array_except(get_defined_vars(), array("__data", "__path")))->render();?>

        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>