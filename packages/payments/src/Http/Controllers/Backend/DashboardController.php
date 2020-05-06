<?php

namespace Packages\Payments\Http\Controllers\Backend;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Formatters\Formatter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Packages\Payments\Models\Deposit;
use Packages\Payments\Models\Withdrawal;

class DashboardController extends Controller
{
    use Formatter;

    private $min = 5;
    private $max = 90;
    private $cacheTime;

    public function __construct()
    {
        $this->cacheTime = config('backend.dashboard.cache_time');
    }

    public function payments()
    {
        $deposits = Cache::remember('deposits.stats', $this->cacheTime, function() {
            return Deposit::where('status', Deposit::STATUS_COMPLETED)
                ->selectRaw('DATEDIFF(now(),MIN(created_at)) AS days_since_first_deposit,
                    AVG(amount) AS avg_amount,
                    MAX(amount) AS max_amount,
                    SUM(amount) AS total_amount,
                    COUNT(*) AS count')
                ->first();
        });

        $withdrawals = Cache::remember('withdrawals.stats', $this->cacheTime, function() {
            return Withdrawal::where('status', Withdrawal::STATUS_COMPLETED)
                ->selectRaw('DATEDIFF(now(),MIN(created_at)) AS days_since_first_withdrawal,
                    AVG(amount) AS avg_amount,
                    MAX(amount) AS max_amount,
                    SUM(amount) AS total_amount,
                    COUNT(*) AS count')
                ->first();
        });

        $timeSeries = Utils::timeSeries(min($this->max, max($this->min, $deposits['days_since_first_deposit'])));

        $depositsByDay = Cache::remember('deposits.by_day', $this->cacheTime, function() use($timeSeries) {
            return $timeSeries->merge(Deposit::selectRaw('CAST(updated_at AS DATE) AS date, COUNT(*) AS value')
                ->where('created_at', '>', Carbon::now()->subDays($timeSeries->count()-1))
                ->where('status', Deposit::STATUS_COMPLETED)
                ->groupBy('date')
                ->get()
                ->keyBy('date'))
                ->values();
        });

        $timeSeries = Utils::timeSeries(min($this->max, max($this->min, $withdrawals['days_since_first_withdrawal'])));

        $withdrawalsByDay = Cache::remember('withdrawals.by_day', $this->cacheTime, function() use($timeSeries) {
            return $timeSeries->merge(Withdrawal::selectRaw('CAST(updated_at AS DATE) AS date, COUNT(*) AS value')
                ->where('created_at', '>', Carbon::now()->subDays($timeSeries->count()-1))
                ->where('status', Withdrawal::STATUS_COMPLETED)
                ->groupBy('date')
                ->get()
                ->keyBy('date'))
                ->values();
        });

        $depositsByCurrency = Cache::remember('deposits.by_currency', $this->cacheTime, function() {
            return Deposit::selectRaw('payment_currency as category, COUNT(*) AS value')
                ->where('status', Deposit::STATUS_COMPLETED)
                ->groupBy('category')
                ->orderBy('value', 'desc')
                ->get();
        });

        $withdrawalsByCurrency = Cache::remember('withdrawals.by_currency', $this->cacheTime, function() {
            return Withdrawal::selectRaw('payment_currency as category, COUNT(*) AS value')
                ->where('status', Withdrawal::STATUS_COMPLETED)
                ->groupBy('category')
                ->orderBy('value', 'desc')
                ->get();
        });

        $topDeposits = Cache::remember('deposits.top', $this->cacheTime, function() {
            return Deposit::where('status', Deposit::STATUS_COMPLETED)
                ->orderBy('amount', 'desc')
                ->with('account.user')->limit(5)->get();
        });

        $topWithdrawals = Cache::remember('withdrawals.top', $this->cacheTime, function() {
            return Withdrawal::where('status', withdrawal::STATUS_COMPLETED)
                ->orderBy('amount', 'desc')
                ->with('account.user')->limit(5)->get();
        });

        return view('payments::backend.pages.dashboard.payments', [
            'deposits' => [
                'count'     => $this->integer($deposits['count']),
                'avg'       => $this->integer($deposits['avg_amount']),
                'max'       => $this->integer($deposits['max_amount']),
                'total'     => $this->integer($deposits['total_amount']),
            ],

            'withdrawals' => [
                'count'     => $this->integer($withdrawals['count']),
                'avg'       => $this->integer($withdrawals['avg_amount']),
                'max'       => $this->integer($withdrawals['max_amount']),
                'total'     => $this->integer($withdrawals['total_amount']),
            ],

            'deposits_by_day'       => $depositsByDay,
            'withdrawals_by_day'    => $withdrawalsByDay,
            'deposits_by_ccy'       => $depositsByCurrency,
            'withdrawals_by_ccy'    => $withdrawalsByCurrency,
            'top_deposits'          => $topDeposits,
            'top_withdrawals'       => $topWithdrawals,
        ]);
    }
}
