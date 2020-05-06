<?php $__env->startSection('title'); ?>
    <?php echo e($user->name); ?> :: <?php echo e(__('Edit')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('backend.users.update', $user)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label><?php echo e(__('Name')); ?></label>
            <input type="text" name="name" class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" placeholder="<?php echo e(__('Name')); ?>" value="<?php echo e(old('name', $user->name)); ?>" required>
        </div>

        <div class="form-group">
            <label><?php echo e(__('Email')); ?></label>
            <input type="text" name="email" class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>" placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e(old('email', $user->email)); ?>" required>
        </div>

        <div class="form-group">
            <label><?php echo e(__('Role')); ?></label>
            <select name="role" class="custom-select <?php echo e($errors->has('role') ? 'is-invalid' : ''); ?>">
                <option value="<?php echo e(App\Models\User::ROLE_BOT); ?>" <?php echo e($user->role == App\Models\User::ROLE_BOT ? 'selected' : ''); ?>><?php echo e(__('app.user_role_'.App\Models\User::ROLE_BOT)); ?></option>
                <option value="<?php echo e(App\Models\User::ROLE_USER); ?>" <?php echo e($user->role == App\Models\User::ROLE_USER ? 'selected' : ''); ?>><?php echo e(__('app.user_role_'.App\Models\User::ROLE_USER)); ?></option>
                <option value="<?php echo e(App\Models\User::ROLE_ADMIN); ?>" <?php echo e($user->role == App\Models\User::ROLE_ADMIN ? 'selected' : ''); ?>><?php echo e(__('app.user_role_'.App\Models\User::ROLE_ADMIN)); ?></option>
            </select>
        </div>

        <div class="form-group">
            <label><?php echo e(__('Status')); ?></label>
            <select name="status" class="custom-select <?php echo e($errors->has('status') ? 'is-invalid' : ''); ?>">
                <option value="<?php echo e(App\Models\User::STATUS_ACTIVE); ?>" <?php echo e($user->status == App\Models\User::STATUS_ACTIVE ? 'selected' : ''); ?>><?php echo e(__('app.user_status_'.App\Models\User::STATUS_ACTIVE)); ?></option>
                <option value="<?php echo e(App\Models\User::STATUS_BLOCKED); ?>" <?php echo e($user->status == App\Models\User::STATUS_BLOCKED ? 'selected' : ''); ?>><?php echo e(__('app.user_status_'.App\Models\User::STATUS_BLOCKED)); ?></option>
            </select>
        </div>

        <div class="form-group">
            <label><?php echo e(__('Password')); ?></label>
            <input type="password" name="password" class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>" placeholder="<?php echo e(__('Password')); ?>">
            <small class="form-text text-muted"><?php echo e(__('Leave empty to preserve current user password.')); ?></small>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" <?php echo e($user->totp_secret ? 'checked="checked"' : ''); ?> disabled>
                <label class="form-check-label">
                    <?php echo e(__('2FA enabled')); ?>

                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input id="individual-referral-bonuses" type="checkbox" name="individual_referral_bonuses" class="form-check-input" <?php echo e(old('individual_referral_bonuses', $user->has_individual_referral_bonuses) ? 'checked="checked"' : ''); ?>>
                <label class="form-check-label" for="individual-referral-bonuses">
                    <?php echo e(__('Override site-wide referral bonuses')); ?>

                </label>
            </div>
        </div>

        <div class="form-group referral-bonus-field <?php echo e(old('individual_referral_bonuses', $user->has_individual_referral_bonuses) ? '' : 'hidden'); ?>">
            <label><?php echo e(__('Referee sign up bonus')); ?></label>
            <div class="input-group">
                <input type="text" name="referee_sign_up_credits" class="form-control <?php echo e($errors->has('referee_sign_up_credits') ? 'is-invalid' : ''); ?>" placeholder="<?php echo e(config('settings.referral.referee_sign_up_credits')); ?>" value="<?php echo e(old('referee_sign_up_credits', $user->referee_sign_up_credits)); ?>">
                <div class="input-group-append">
                    <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                </div>
            </div>
        </div>

        <div class="form-group referral-bonus-field <?php echo e(old('individual_referral_bonuses', $user->has_individual_referral_bonuses) ? '' : 'hidden'); ?>">
            <label><?php echo e(__('Referee sign up bonus')); ?></label>
            <div class="input-group">
                <input type="text" name="referrer_sign_up_credits" class="form-control <?php echo e($errors->has('referrer_sign_up_credits') ? 'is-invalid' : ''); ?>" placeholder="<?php echo e(config('settings.referral.referrer_sign_up_credits')); ?>" value="<?php echo e(old('referrer_sign_up_credits', $user->referrer_sign_up_credits)); ?>">
                <div class="input-group-append">
                    <span class="input-group-text"><?php echo e(__('credits')); ?></span>
                </div>
            </div>
        </div>

        <div class="form-group referral-bonus-field <?php echo e(old('individual_referral_bonuses', $user->has_individual_referral_bonuses) ? '' : 'hidden'); ?>">
            <label><?php echo e(__('Referrer game bonus')); ?></label>
            <div class="input-group">
                <input type="text" name="referrer_game_bet_pct" class="form-control <?php echo e($errors->has('referrer_game_bet_pct') ? 'is-invalid' : ''); ?>" placeholder="<?php echo e(config('settings.referral.referrer_game_bet_pct')); ?>" value="<?php echo e(old('referrer_game_bet_pct', $user->referrer_game_bet_pct)); ?>">
                <div class="input-group-append">
                    <span class="input-group-text">%</span>
                </div>
            </div>
        </div>

        <div class="form-group referral-bonus-field <?php echo e(old('individual_referral_bonuses', $user->has_individual_referral_bonuses) ? '' : 'hidden'); ?>">
            <label><?php echo e(__('Referrer deposit bonus')); ?></label>
            <div class="input-group">
                <input type="text" name="referrer_deposit_pct" class="form-control <?php echo e($errors->has('referrer_deposit_pct') ? 'is-invalid' : ''); ?>" placeholder="<?php echo e(config('settings.referral.referrer_deposit_pct')); ?>" value="<?php echo e(old('referrer_deposit_pct', $user->referrer_deposit_pct)); ?>">
                <div class="input-group-append">
                    <span class="input-group-text">%</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label><?php echo e(__('Referred by')); ?></label>
            <input class="form-control text-muted" value="<?php echo e($user->referrer_id ? $user->referrer->name . ' (' . $user->referrer->email . ')' : ''); ?>" readonly>
        </div>

        <div class="form-group">
            <label><?php echo e(__('Last login at')); ?></label>
            <input class="form-control text-muted" value="<?php echo e($user->last_login_at); ?> (<?php echo e($user->last_login_at->diffForHumans()); ?>)" readonly>
        </div>

        <div class="form-group">
            <label><?php echo e(__('Last login from')); ?></label>
            <input class="form-control text-muted" value="<?php echo e($user->last_login_from); ?>" readonly>
        </div>

        <div class="form-group">
            <label><?php echo e(__('Created at')); ?></label>
            <input class="form-control text-muted" value="<?php echo e($user->created_at); ?> (<?php echo e($user->created_at->diffForHumans()); ?>)" readonly>
        </div>

        <div class="form-group">
            <label><?php echo e(__('Updated at')); ?></label>
            <input class="form-control text-muted" value="<?php echo e($user->updated_at); ?> (<?php echo e($user->updated_at->diffForHumans()); ?>)" readonly>
        </div>

        <div class="form-group">
            <label><?php echo e(__('Email verified at')); ?></label>
            <input class="form-control text-muted" value="<?php echo e($user->email_verified_at ? $user->email_verified_at . ' (' . $user->email_verified_at->diffForHumans() . ')' : __('never')); ?>" readonly>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            <?php echo e(__('Save')); ?>

        </button>
        <a href="<?php echo e(route('backend.users.delete', $user)); ?>" class="btn btn-danger float-right">
            <i class="far fa-trash-alt"></i>
            <?php echo e(__('Delete')); ?>

        </a>
    </form>
    <div class="mt-3">
        <a href="<?php echo e(route('backend.users.index', request()->query())); ?>"><i class="fas fa-long-arrow-alt-left"></i> <?php echo e(__('Back to all users')); ?></a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    var checkbox = document.getElementById('individual-referral-bonuses');
    var fields = document.querySelectorAll('.referral-bonus-field');

    checkbox.addEventListener('change', function() {
        showHideFields(fields, this.checked);
    });

    function showHideFields(fields, display) {
        for (var i = 0; i < fields.length; ++i) {
            fields[i].style.display = display ? 'block' : 'none';
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>