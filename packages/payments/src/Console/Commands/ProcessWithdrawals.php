<?php

namespace Packages\Payments\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Packages\Payments\Models\Withdrawal;
use Packages\Payments\Services\CoinpaymentsPaymentService;
use Packages\Payments\Services\WithdrawalService;

class ProcessWithdrawals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:withdrawals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto approve and process withdrawals';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(CoinpaymentsPaymentService $coinpaymentsPaymentService)
    {
        $maxWithdrawalAmount = config('payments.withdrawal_auto_max');

        $withdrawals = Withdrawal::where('status', Withdrawal::STATUS_CREATED)
            ->where('amount', '<=', $maxWithdrawalAmount)->get();

        foreach ($withdrawals as $withdrawal) {
            $user = $withdrawal->account->user;
            $rate = config('payments.rate');
            $currency = config('payments.currency');
            $amount = $rate != 0 ? $withdrawal->amount / $rate : 0;

            try {
                Log::info(sprintf('Auto withdrawal - id:%d, amount:%s', $withdrawal->id, $withdrawal->amount . ' credits (' . $amount . ' ' . $currency . ', paid in ' . $withdrawal->payment_currency . ')'));
                $coinpaymentsPaymentService->initializeWithdrawal(
                    $amount,
                    $currency,
                    $withdrawal->payment_currency,
                    $withdrawal->wallet,
                    __('Withdrawal for user :name (:email)', ['name' => $user->name, 'email' => $user->email])
                );

                // process withdrawal
                $withdrawalService = WithdrawalService::fromModelInstance($withdrawal);
                $withdrawalService->process($coinpaymentsPaymentService->getWithdrawalId());
            } catch (\Exception $e) {
                Log::error(sprintf('Auto withdrawal processing error for id %d: %s', $withdrawal->id, $e->getMessage()));
            }
        }
    }
}
