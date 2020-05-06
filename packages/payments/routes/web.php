<?php

// frontend
Route::name('frontend.')
    ->namespace('Packages\Payments\Http\Controllers\Frontend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa']) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // deposits
        Route::get('user/deposits', 'DepositController@index')->name('deposits.index');
        Route::get('user/deposits/{deposit}/show', 'DepositController@show')->name('deposits.show');
        Route::get('user/deposits/create', 'DepositController@create')->name('deposits.create');
        Route::post('user/deposits/create', 'DepositController@store')->name('deposits.store');
        // withdrawals
        Route::get('user/withdrawals', 'WithdrawalController@index')->name('withdrawals.index');
        Route::get('user/withdrawals/create', 'WithdrawalController@create')->name('withdrawals.create');
        Route::post('user/withdrawals/create', 'WithdrawalController@store')->name('withdrawals.store');
    });

// backend
Route::prefix('admin')
    ->name('backend.')
    ->namespace('Packages\Payments\Http\Controllers\Backend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa', 'role:' . App\Models\User::ROLE_ADMIN]) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // dashboard
        Route::get('dashboard/payments', 'DashboardController@payments')->name('dashboard.payments');
        // deposits
        Route::resource('deposits', 'DepositController',  ['only' => ['index']]);
        // withdrawals
        Route::resource('withdrawals', 'WithdrawalController',  ['only' => ['index','edit','update']]);
        Route::post('withdrawals/{withdrawal}/reject', 'WithdrawalController@reject')->name('withdrawals.reject');
        Route::post('withdrawals/{withdrawal}/approve', 'WithdrawalController@approve')->name('withdrawals.approve');
        Route::post('withdrawals/{withdrawal}/complete', 'WithdrawalController@complete')->name('withdrawals.complete');
        Route::get('withdrawals/{withdrawal}/track', 'WithdrawalController@track')->name('withdrawals.track');
        // coins balances
        Route::resource('balances', 'BalanceController',  ['only' => ['index']]);
    });

// Web hooks
Route::name('webhook.')
    ->namespace('Packages\Payments\Http\Controllers\Frontend')
    ->middleware('web') // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // these URIs should also be added to exceptions in VerifyCsrfToken class, so that CSRF validations are not run
        Route::post('deposits/ipn', 'DepositController@ipn')->name('deposits.ipn');
        Route::post('withdrawals/ipn', 'WithdrawalController@ipn')->name('withdrawals.ipn');
    });