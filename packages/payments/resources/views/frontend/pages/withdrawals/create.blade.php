@extends('frontend.layouts.main')

@section('title')
    {{ __('Withdrawal') }}
@endsection

@section('content')
    <form method="POST" action="{{ route('frontend.withdrawals.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col">
                <label>{{ __('Withdrawal amount') }}</label>
                <div class="input-group">
                    <input type="text" name="amount" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" placeholder="1000" value="{{ old('amount') }}" required>
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('credits') }}</span>
                    </div>
                </div>
                <small class="form-text text-muted">{{ trans_choice(':rate credit = 1 :ccy|:rate credits = 1 :ccy', config('payments.rate'), ['rate' => config('payments.rate'), 'ccy' => config('payments.currency')]) }}</small>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-12 col-md-8">
                <label>{{ __('Wallet') }}</label>
                <input type="text" name="wallet" class="form-control {{ $errors->has('wallet') ? 'is-invalid' : '' }}" placeholder="" value="{{ old('wallet') }}" required>
            </div>
            <div class="form-group col-sm-12 col-md-4">
                <label>{{ __('Payment currency') }}</label>
                <select name="payment_currency" class="custom-select {{ $errors->has('payment_currency') ? 'is-invalid' : '' }}">
                    @foreach($currencies as $symbol => $currency)
                        <option value="{{ $symbol }}" {{ old('details.payment_currency')==$symbol ? 'selected="selected"' : '' }}>
                            {{ $currency['name'] }} ({{ $symbol }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label>{{ __('Comment') }}</label>
                <textarea name="comment" class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" rows="3">{{ old('comment') }}</textarea>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">{{ __('Proceed') }}</button>
        </div>
    </form>
@endsection