<?php

namespace Packages\Payments\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use CoinpaymentsAPI;

/**
 * CoinpaymentsPayment.net API implementation
 *
 * Class CoinpaymentsPaymentService
 */
class CoinpaymentsPaymentService
{
    private $api;
    private $response;
    private $config;

    /**
     * CoinpaymentsPaymentService constructor.
     */
    public function __construct()
    {
        $this->config = config('payments.coinpayments');
        $this->api = new CoinpaymentsAPI($this->config['private_key'], $this->config['public_key'], 'json');
    }

    /**
     * Get coins balances
     *
     * @return mixed
     */
    public function getBalances()
    {
        // cache balances for 5 mins
        return Cache::remember('balances', 5, function() {
            $this->response = $this->api->GetCoinBalances();
            $result = $this->requestIsSuccessful() ? $this->response['result'] : [];
            return collect($result);
        });
    }

    /**
     * Get withdrawal info
     *
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getWithdrawalInfo($id)
    {
        return Cache::remember('widthdrawal_info_' . $id, 1, function() use($id) {
            $this->response = $this->api->GetWithdrawalInformation($id);
            $result = $this->requestIsSuccessful() ? $this->response['result'] : [];
            return collect($result);
        });
    }

    /**
     * Get payment (deposit) info
     *
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getPaymentInfo($id)
    {
        return Cache::remember('payment_info_' . $id, 0.5, function() use($id) {
            $result = [];
            $this->response = $this->api->GetTxInfoSingle($id);
            if ($this->requestIsSuccessful()) {
                $result = $this->response['result'];
            } else {
                Log::error('GetTxInfoSingle: ' . $this->response['error']);
            }

            return collect($result);
        });
    }

    /**
     * Initialize payment
     *
     * @param $amount
     * @param $currency
     * @param $paymentCurrency
     * @param $description
     * @param $userName
     * @param $userEmail
     */
    public function initializePayment($amount, $currency, $paymentCurrency, $description, $userName, $userEmail)
    {
        $this->response = $this->api->CreateComplexTransaction(
            $amount,
            $currency,
            $paymentCurrency,
            $userEmail,
            '', // forward to address
            $userName,
            $description,
            '', // item number
            '', // invoice
            '', // custom
            route('webhook.deposits.ipn')
        );

        Log::info($this->response);

        if (!$this->requestIsSuccessful())
            throw new \Exception($this->response['error']);
    }

    public function initializeWithdrawal($amount, $currency, $paymentCurrency, $address, $note)
    {
        $this->response = $this->api->CreateWithdrawal([
            'amount'        => $amount,
            'currency'      => $paymentCurrency,
            'currency2'     => $currency,
            'address'       => $address,
            'auto_confirm'  => (int) $this->config['withdrawals_auto_confirm'], // If set to 1, withdrawal will complete without email confirmation.
            'note'          => $note,
            'ipn_url'       => route('webhook.withdrawals.ipn'),
        ]);

        Log::info($this->response);

        if (!$this->requestIsSuccessful())
            throw new \Exception($this->response['error']);
    }

    private function requestIsSuccessful() {
        return $this->response && isset($this->response['error']) && $this->response['error'] == 'ok' && isset($this->response['result']);
    }

    /**
     * Get accepted coins symbols (they are set up in the coinpayments account)
     *
     * @return Collection
     */
    public function getAcceptedCurrencies() {
        $currencies = Cache::get('coinpayments-accepted-currencies');

        // if cached values don't exist
        if (!$currencies || empty($currencies)) {
            $this->response = $this->api->GetRatesWithAccepted();

            // currencies retrieved
            if ($this->requestIsSuccessful()) {
                // get accepted currencies symbols
                $currencies = collect($this->response['result'])
                    ->filter(function ($currency, $symbol) {
                        return $currency['is_fiat'] == 0 && $currency['status'] == 'online' && $currency['accepted'] == 1;
                    })
                    ->sortBy('name');

                // store them in cache
                if (!$currencies->isEmpty()) {
                    Cache::put('coinpayments-accepted-currencies', $currencies, 1440/* 24 hours */);
                }
            }
        }

        return $currencies ?: collect();
    }

    /**
     * Get payment amount
     *
     * @return number
     */
    public function getPaymentAmount()
    {
        return $this->requestIsSuccessful() ? $this->response['result']['amount'] : NULL;
    }


    public function redirectToGateway()
    {
        if ($this->requestIsSuccessful()) {
            header('Location: ' . $this->response['result']['status_url']);
            exit;
        }
    }

    public function getPaymentId()
    {
        return $this->requestIsSuccessful() ? $this->response['result']['txn_id'] : NULL;
    }

    public function getWithdrawalId()
    {
        return $this->requestIsSuccessful() ? $this->response['result']['id'] : NULL;
    }

    /**
     * Check whether IPN callback has a valid signature
     *
     * @param $content
     * @param $header
     * @return bool
     */
    public function signatureIsValid($content, $header)
    {
        $hmac = hash_hmac('sha512', $content, $this->config['secret_key']);
        return hash_equals($hmac, $header);
    }
}