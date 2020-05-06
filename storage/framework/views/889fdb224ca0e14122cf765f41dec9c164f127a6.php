<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-deposits-withdrawals" aria-expanded="true">
                <?php echo e(__('Deposits & Withdrawals')); ?>

            </button>
        </h5>
    </div>
    <div id="tab-deposits-withdrawals" class="collapse">
        <div class="card-body text-body">
            <div class="form-group">
                <label><?php echo e(__('Credits nominal currency')); ?></label>
                <input type="text" name="CREDITS_CURRENCY" class="form-control" value="<?php echo e(config('payments.currency')); ?>">
                <small><?php echo e(__('Input a coin or fiat currency code, which virtual credits are linked to.')); ?></small>
            </div>
            <div class="form-group">
                <label><?php echo e(__('Credits conversion rate')); ?></label>
                <input type="text" name="CREDITS_RATE" class="form-control" value="<?php echo e(config('payments.rate')); ?>">
                <small><?php echo e(__('Amount of credits per 1 unit of the credits nominal currency (by default 100 credits = 1 USD).')); ?></small>
            </div>
            <div class="form-group">
                <label><?php echo e(__('Min deposit amount')); ?></label>
                <div class="input-group">
                    <input type="text" name="CREDITS_DEPOSIT_MIN" class="form-control" value="<?php echo e(config('payments.deposit_min')); ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><?php echo e(__('Max deposit amount')); ?></label>
                <div class="input-group">
                    <input type="text" name="CREDITS_DEPOSIT_MAX" class="form-control" value="<?php echo e(config('payments.deposit_max')); ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><?php echo e(__('Min withdrawal amount')); ?></label>
                <div class="input-group">
                    <input type="text" name="CREDITS_WITHDRAWAL_MIN" class="form-control" value="<?php echo e(config('payments.withdrawal_min')); ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><?php echo e(__('Max withdrawal amount')); ?></label>
                <div class="input-group">
                    <input type="text" name="CREDITS_WITHDRAWAL_MAX" class="form-control" value="<?php echo e(config('payments.withdrawal_max')); ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><?php echo e(__('Min total deposit amount to allow withdrawal')); ?></label>
                <div class="input-group">
                    <input type="text" name="CREDITS_MIN_TOTAL_DEPOSIT_TO_WITHDRAW" class="form-control" value="<?php echo e(config('payments.min_total_deposit_to_withdraw')); ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                    </div>
                </div>
                <small>
                    <?php echo e(__('User will need to deposit at least that amount before being able to withdraw funds.')); ?>

                    <?php echo e(__('Set the value to 0 if you do not want to limit withdrawals.')); ?>

                </small>
            </div>
            <div class="form-group">
                <label><?php echo e(__('Auto approve and process withdrawals less than or equal to')); ?></label>
                <div class="input-group">
                    <input type="text" name="CREDITS_WITHDRAWAL_AUTO_MAX" class="form-control" value="<?php echo e(config('payments.withdrawal_auto_max')); ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                    </div>
                </div>
                <small>
                    <?php echo e(__('Please note that even though such withdrawals will be processed automatically on the application side an extra email confirmation might be required on the payments provider side (see coinpayments.net settings).')); ?>

                    <?php echo e(__('Leave zero if you like to manually approve all withdrawals.')); ?>

                </small>
            </div>
        </div>
    </div>
</div>
<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-coinpayments" aria-expanded="true">
                <?php echo e(__('Coinpayments.net API')); ?>

            </button>
        </h5>
    </div>
    <div id="tab-coinpayments" class="collapse">
        <div class="card-body text-body">
            <div class="form-group">
                <label><?php echo e(__('Merchant ID')); ?></label>
                <input type="text" name="COINPAYMENTS_MERCHANT_ID" class="form-control" value="<?php echo e(config('payments.coinpayments.merchant_id')); ?>">
            </div>
            <div class="form-group">
                <label><?php echo e(__('Public key')); ?></label>
                <input type="text" name="COINPAYMENTS_PUBLIC_KEY" class="form-control" value="<?php echo e(config('payments.coinpayments.public_key')); ?>">
            </div>
            <div class="form-group">
                <label><?php echo e(__('Private key')); ?></label>
                <input type="text" name="COINPAYMENTS_PRIVATE_KEY" class="form-control" value="<?php echo e(config('payments.coinpayments.private_key')); ?>">
            </div>
            <div class="form-group">
                <label><?php echo e(__('Secret key')); ?></label>
                <input type="text" name="COINPAYMENTS_SECRET_KEY" class="form-control" value="<?php echo e(config('payments.coinpayments.secret_key')); ?>">
                <small>
                    <?php echo e(__('Please input any random string nobody can guess (example: :string). This should be the same as IPN secret field in your coinpayments.net account (Account Settings -> Merchant Settings).', ['string' => str_random(20)])); ?>

                </small>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="hidden" name="COINPAYMENTS_WITHDRAWALS_AUTO_CONFIRM" value="false">
                    <input id="withdrawals_auto_confirm" type="checkbox" name="COINPAYMENTS_WITHDRAWALS_AUTO_CONFIRM" value="true" class="form-check-input" <?php echo e(config('payments.coinpayments.withdrawals_auto_confirm') ? 'checked="checked"' : ''); ?>>
                    <label for="withdrawals_auto_confirm" class="form-check-label">
                        <?php echo e(__('Auto confirm all withdrawals (do not require email confirmation)')); ?>

                    </label>
                    <div>
                        <small>
                            <?php echo e(__('Please note that this setting only affects whether an extra email confirmation is required for all withdrawals from your coinpayments.net account.')); ?>

                            <?php echo e(__('You also need to set "Allow auto_confirm = 1 in create_withdrawal" permission in your coinpayments.net account for the given API key.')); ?>

                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>