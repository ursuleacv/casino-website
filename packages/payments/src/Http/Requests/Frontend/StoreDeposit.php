<?php

namespace Packages\Payments\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Packages\Payments\Services\CoinpaymentsPaymentService;

class StoreDeposit extends FormRequest
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
    public function rules(CoinpaymentsPaymentService $coinpaymentsPaymentService)
    {
        return [
            'amount'            => 'required|numeric|min:'.config('payments.deposit_min').'|max:'.config('payments.deposit_max'),
            'payment_currency'  => 'required|in:' . $coinpaymentsPaymentService->getAcceptedCurrencies()->keys()->implode(',')
        ];
    }
}
