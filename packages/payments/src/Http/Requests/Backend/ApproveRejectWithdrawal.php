<?php

namespace Packages\Payments\Http\Requests\Backend;

use Packages\Payments\Models\Withdrawal;
use Packages\Payments\Rules\WithdrawalIsEditable;
use Illuminate\Foundation\Http\FormRequest;

class ApproveRejectWithdrawal extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Withdrawal $withdrawal)
    {
        return [
            '*' => new WithdrawalIsEditable($this->withdrawal)
        ];
    }
}
