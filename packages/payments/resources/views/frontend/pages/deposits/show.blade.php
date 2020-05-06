@extends('frontend.layouts.main')

@section('title')
    {{ __('Deposit') }} {{ $deposit->id }}
@endsection

@section('content')
    @if(isset($payment['status']) && $payment['status'] >= 100 && $deposit->status == \Packages\Payments\Models\Deposit::STATUS_COMPLETED)
        <p>
            {{ __('Deposit is successfully completed.') }}
        </p>
    @elseif(isset($payment['status']) && $payment['status'] == 1 && $deposit->payment_amount == $payment['receivedf'])
        <p>
            {{ __('Your payment is received and being processed.') }}
        </p>
    @elseif(isset($payment['time_created']) && isset($payment['time_expires']) && isset($payment['payment_address']))
        @if($payment['time_expires'] > time())
            <p>
                {{ __('To complete deposit please transfer :amount :ccy to the following address', ['amount' => $payment['amountf'], 'ccy' => $payment['coin']]) }}
            </p>
            <div class="input-group">
                <input id="payment-address-input" type="text" class="form-control text-muted" value="{{ $payment['payment_address'] }}" readonly>
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" onclick="copyToClipboard(document.getElementById('payment-address-input'))"><i class="far fa-copy"></i> {{ __('Copy') }}</button>
                </div>
            </div>
            <p class="mt-3">{{ __('Time left') }}:</p>
            <div class="progress">
                <div id="progress-bar" class="progress-bar bg-info" role="progressbar" style="width: {{ round(100*($payment['time_expires']-time())/($payment['time_expires']-$payment['time_created'])) }}%"></div>
            </div>
        @else
            <p>{{ __('This deposit has expired.') }}</p>
        @endif
    @else
        <p>{{ __('There is something wrong with this deposit.') }}</p>
    @endif
    <div class="mt-3">
        <a href="{{ route('frontend.deposits.index') }}"><i class="fas fa-long-arrow-alt-left"></i> {{ __('Back to all deposits') }}</a>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/payments/deposit.js') }}"></script>
    @if(isset($payment['status']) && isset($payment['time_created']) && isset($payment['time_expires']) && $payment['status']==0)
        <script>
            updateProgressBar(
                    parseInt('{{ $payment['time_created'] }}', 10),
                    parseInt('{{ $payment['time_expires'] }}', 10)
            );
        </script>
    @endif
@endpush