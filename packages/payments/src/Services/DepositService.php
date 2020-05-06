<?php

namespace Packages\Payments\Services;

use App\Services\AccountService;
use Packages\Payments\Events\DepositCompleted;
use Packages\Payments\Models\Deposit;

class DepositService
{
    private $deposit;

    public function __construct($externalId)
    {
        $this->deposit = Deposit::where('external_id', $externalId)->firstOrFail();

        return $this;
    }

    /**
     * Mark deposit as completed, increase account balance accordingly
     */
    public function complete()
    {
        if ($this->deposit->status == Deposit::STATUS_PENDING) {
            // create account transaction
            $accountService = new AccountService($this->deposit->account);
            $accountService->transaction($this->deposit, $this->deposit->amount);
            // update deposit model
            $this->deposit->status = Deposit::STATUS_COMPLETED;
            $this->deposit->save();

            event(new DepositCompleted($this->deposit));
        }
    }

    /**
     * Mark deposit as cancelled
     */
    public function cancel()
    {
        if ($this->deposit->status == Deposit::STATUS_PENDING) {
            // update deposit model
            $this->deposit->status = Deposit::STATUS_CANCELLED;
            $this->deposit->save();
        }
    }
}