<?php

namespace Packages\Payments\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Packages\Payments\Http\Requests\Frontend\StoreWithdrawal;
use Packages\Payments\Models\Sort\Frontend\WithdrawalSort;
use Packages\Payments\Models\Withdrawal;
use App\Services\AccountService;
use Packages\Payments\Services\CoinpaymentsPaymentService;
use Packages\Payments\Services\WithdrawalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WithdrawalController extends Controller
{
    /**
     * Deposits listing
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $sort = new WithdrawalSort($request);

        $withdrawals = $user->account->related(Withdrawal::class)
            ->orderBy($sort->getSortColumn(), $sort->getOrder())
            ->paginate($this->rowsPerPage);

        return view('payments::frontend.pages.withdrawals.index', [
            'withdrawals'   => $withdrawals,
            'sort'          => $sort->getSort(),
            'order'         => $sort->getOrder(),
        ]);
    }

    /**
     * Display withdrawal form
     *
     * @param Request $request
     * @param CoinpaymentsPaymentService $coinpaymentsPaymentService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request, CoinpaymentsPaymentService $coinpaymentsPaymentService) {
        return view('payments::frontend.pages.withdrawals.create', [
            'account'       => $request->user()->account,
            'currencies'    => $coinpaymentsPaymentService->getAcceptedCurrencies()
        ]);
    }

    /**
     * Handle withdrawals form submission
     *
     * @param StoreWithdrawal $request
     */
    public function store(StoreWithdrawal $request) {
        $user = $request->user();
        $withdrawal = new Withdrawal();
        $withdrawal->account()->associate($user->account);
        $withdrawal->status = Withdrawal::STATUS_CREATED;
        $withdrawal->amount = $request->amount;
        $withdrawal->wallet = $request->wallet;
        $withdrawal->payment_currency = $request->payment_currency;
        $withdrawal->comment = $request->comment;
        $withdrawal->save();

        // create a debit transaction on user account
        $accountService = new AccountService($user->account);
        $accountService->transaction($withdrawal, -$withdrawal->amount);

        return redirect()
            ->route('frontend.withdrawals.index')
            ->with('success', __('Withdrawal request is successfully submitted.'));
    }

    public function ipn(Request $request, CoinpaymentsPaymentService $coinpaymentsPaymentService)
    {
        $payload = $request->getContent();
        Log::info($payload);

        // HMAC header should always be set
        if ($request->header('HMAC')) {
            if ($request->ipn_mode == 'hmac' && $request->ipn_type == 'withdrawal' && $request->merchant == config('payments.coinpayments.merchant_id')) {
                // verify coinpayments signature to ensure the request is authentic
                if ($coinpaymentsPaymentService->signatureIsValid($payload, $request->header('HMAC'))) {
                    if ($request->status == 2) {
                        $withdrawalService = WithdrawalService::fromExternalId($request->id);
                        $withdrawalService->complete();
                    }

                    return response()->make('OK', 200);
                }
            }
        }

        // report an error
        return response()->make('ERROR', 400);
    }
}