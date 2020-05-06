<?php

namespace Packages\Payments\Rules;

use Packages\Payments\Models\Withdrawal;
use Illuminate\Contracts\Validation\Rule;

class WithdrawalIsEditable implements Rule
{
    private $withdrawal;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Withdrawal $withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute = NULL, $value = NULL)
    {
        return $this->withdrawal->status == Withdrawal::STATUS_CREATED;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Processed withdrawals can not be edited.');
    }
}
