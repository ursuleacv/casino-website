<?php

namespace Packages\Payments\Http\Requests\Frontend;

use App\Rules\BalanceIsSufficient;
use Packages\Payments\Rules\WithdrawalIsAllowed;
use Packages\Payments\Services\CoinpaymentsPaymentService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreWithdrawal extends FormRequest
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
    public function rules(Request $request, CoinpaymentsPaymentService $coinpaymentsPaymentService)
    {
        return [
            'amount' => [
                'required',
                'numeric',
                'min:'.config('payments.withdrawal_min'),
                'max:'.config('payments.withdrawal_max'),
                new WithdrawalIsAllowed($request->user()),
                new BalanceIsSufficient($request->amount)
            ],
            'wallet'            => 'required',
            'payment_currency'  => 'required|in:' . $coinpaymentsPaymentService->getAcceptedCurrencies()->keys()->implode(',')
        ];
    }
}
