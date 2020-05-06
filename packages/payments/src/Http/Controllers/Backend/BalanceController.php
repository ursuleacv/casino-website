<?php

namespace Packages\Payments\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Packages\Payments\Services\CoinpaymentsPaymentService;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Deposits listing
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, CoinpaymentsPaymentService $coinpaymentsPaymentService)
    {
        $balances = $coinpaymentsPaymentService->getBalances();

        /*"LTCT" => array:4 [▼
            "balance" => 9155202
            "balancef" => "0.09155202"
            "status" => "available"
            "coin_status" => "online"
          ]*/

        return view('payments::backend.pages.balances.index', [
            'balances' => $balances,
        ]);
    }
}
