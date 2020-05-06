@extends('frontend.layouts.main')

@section('title')
    {{ __('Deposit') }}
@endsection

@section('content')
    <form method="POST" action="{{ route('frontend.deposits.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-sm-12 col-md-8">
                <label>{{ __('Deposit amount') }}</label>
                <div class="input-group">
                    <input type="text" name="amount" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" placeholder="1000" value="{{ old('amount') }}" required>
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('credits') }}</span>
                    </div>
                </div>
                <small class="form-text text-muted">{{ trans_choice(':rate credit = 1 :ccy|:rate credits = 1 :ccy', config('payments.rate'), ['rate' => config('payments.rate'), 'ccy' => config('payments.currency')]) }}</small>
            </div>
            <div class="form-group col-sm-12 col-md-4">
                <label>{{ __('Payment currency') }}</label>
                <select name="payment_currency" class="custom-select {{ $errors->has('payment_currency') ? 'is-invalid' : '' }}">
                    @foreach($currencies as $symbol => $currency)
                        <option value="{{ $symbol }}" {{ old('payment_currency')==$symbol ? 'selected="selected"' : '' }}>
                            {{ $currency['name'] }} ({{ $symbol }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">{{ __('Proceed') }}</button>
        </div>
    </form>
@endsection