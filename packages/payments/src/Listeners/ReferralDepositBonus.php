<?php

namespace Packages\Payments\Listeners;

use Packages\Payments\Events\DepositCompleted;
use App\Models\ReferralBonus;
use App\Services\AccountService;
use App\Services\ReferralBonusService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReferralDepositBonus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DepositCompleted  $event
     * @return void
     */
    public function handle(DepositCompleted $event)
    {
        $user = $event->user;

        // check if user has referrer
        if ($user->referrer) {
            $deposit = $event->deposit;
            $bonusPct = $user->referrer->referrer_deposit_pct ?: config('settings.referral.referrer_deposit_pct');
            if ($bonusAmount = $deposit->amount * $bonusPct / 100) {
                $referralBonus = (new ReferralBonusService())::create($user->referrer, ReferralBonus::TYPE_REFERRER_DEPOSIT, $bonusAmount);
                $accountService = new AccountService($user->referrer->account);
                $accountService->transaction($referralBonus, $bonusAmount);
            }
        }
    }
}
