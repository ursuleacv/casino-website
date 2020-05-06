<?php

namespace Packages\Payments\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Packages\Payments\Http\Requests\Frontend\StoreDeposit;
use Packages\Payments\Models\Deposit;
use Packages\Payments\Models\Sort\Frontend\DepositSort;
use Packages\Payments\Services\CoinpaymentsPaymentService;
use Packages\Payments\Services\DepositService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepositController extends Controller
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
        $sort = new DepositSort($request);

        $deposits = $user->account->related(Deposit::class)
            ->orderBy($sort->getSortColumn(), $sort->getOrder())
            ->paginate($this->rowsPerPage);

        return view('payments::frontend.pages.deposits.index', [
            'deposits'      => $deposits,
            'sort'          => $sort->getSort(),
            'order'         => $sort->getOrder(),
        ]);
    }

    public function show(Request $request, Deposit $deposit, CoinpaymentsPaymentService $coinpaymentsPaymentService)
    {
        $user = $request->user();

        if ($deposit->account->id != $user->account->id || $deposit->status != Deposit::STATUS_PENDING)
            abort(404);

        $payment = $coinpaymentsPaymentService->getPaymentInfo($deposit->external_id);

        return view('payments::frontend.pages.deposits.show', [
            'deposit' => $deposit,
            'payment' => $payment,
        ]);
    }


    /**
     * Display deposit form
     *
     * @param Request $request
     * @param CoinpaymentsPaymentService $coinpaymentsPaymentService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request, CoinpaymentsPaymentService $coinpaymentsPaymentService) {
        return view('payments::frontend.pages.deposits.create', [
            'account'       => $request->user()->account,
            'currencies'    => $coinpaymentsPaymentService->getAcceptedCurrencies()
        ]);
    }

    /**
     * Handle deposit form submission
     *
     * @param StoreDeposit $request
     * @param CoinpaymentsPaymentService $coinpaymentsPaymentService
     * @return $this
     */
    public function store(StoreDeposit $request, CoinpaymentsPaymentService $coinpaymentsPaymentService)
    {
        $user = $request->user();
        $currency = config('payments.currency');
        $rate = config('payments.rate');
        $amount = $rate != 0 ? $request->amount / $rate : 1;

        // init payment
        try {
            $coinpaymentsPaymentService->initializePayment(
                $amount,
                $currency,
                $request->payment_currency,
                __('Virtual credits purchase'),
                $user->name,
                $user->email
            );
        // catch any exceptions
        } catch (\Exception $exception) {
            return back()->withInput()->withErrors(
                ['method' => $exception->getMessage()]
            );
        }

        // save deposit record to the DB
        $deposit = new Deposit();
        $deposit->account()->associate($user->account);
        $deposit->amount = $request->amount;
        $deposit->payment_amount = $coinpaymentsPaymentService->getPaymentAmount();
        $deposit->payment_currency = $request->payment_currency;
        $deposit->status = Deposit::STATUS_PENDING;
        $deposit->external_id = $coinpaymentsPaymentService->getPaymentId();

        // if deposit is saved successfully in the local DB open the deposit page
        if ($deposit->save())
            return redirect()->route('frontend.deposits.show', $deposit);
    }

    /**
     * Handle async events (webhooks setup is required)
     *
     * @param Request $request
     */
    public function ipn(Request $request, CoinpaymentsPaymentService $coinpaymentsPaymentService)
    {
        $payload = $request->getContent();
        Log::info($payload);

        // HMAC header should always be set
        if ($request->header('HMAC')) {
            if ($request->ipn_mode == 'hmac' && $request->merchant == config('payments.coinpayments.merchant_id')) {
                // verify stripe signature to ensure the request is authentic
                if ($coinpaymentsPaymentService->signatureIsValid($payload, $request->header('HMAC'))) {
                    /*Payments will post with a 'status' field, here are the currently defined values:
                    -2 = PayPal Refund or Reversal
                    -1 = Cancelled / Timed Out
                    0 = Waiting for buyer funds
                    1 = We have confirmed coin reception from the buyer
                    2 = Queued for nightly payout (if you have the Payout Mode for this coin set to Nightly)
                    3 = PayPal Pending (eChecks or other types of holds)
                    100 = Payment Complete. We have sent your coins to your payment address or 3rd party payment system reports the payment complete
                    For future-proofing your IPN handler you can use the following rules:
                    <0 = Failures/Errors
                    0-99 = Payment is Pending in some way
                    >=100 = Payment completed successfully*/
                    if ($request->status >= 100 || $request->status == 2) {
                        $depositService = new DepositService($request->txn_id);
                        $depositService->complete();
                    }

                    return response()->make('OK', 200);
                }
            }
        }

        // report an error
        return response()->make('ERROR', 400);
    }
}