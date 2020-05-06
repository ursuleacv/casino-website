@extends('backend.layouts.main')

@section('title')
    {{ __('Withdrawal') }} {{ $withdrawal->id }} :: {{ __('Edit') }}
@endsection

@section('content')
    <form method="POST" action="{{ route('backend.withdrawals.update', $withdrawal) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>{{ __('Amount') }}</label>
            <div class="input-group">
                <input type="text" name="amount" class="form-control {{ !$editable ? 'text-muted' : '' }} {{ $errors->has('amount') ? 'is-invalid' : '' }}" placeholder="{{ __('Amount') }}" value="{{ old('amount', $withdrawal->amount) }}" required {{ !$editable ? 'readonly' : '' }}>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">
                        {{ __('credits') }}
                        @if($editable)
                            ({{ __('balance') }}: {{ $withdrawal->account->_balance }})
                        @endif
                    </span>
                </div>
            </div>
            <small class="form-text text-muted">
                {{ trans_choice(':rate credit = 1 :ccy|:rate credits = 1 :ccy', config('payments.rate'), ['rate' => config('payments.rate'), 'ccy' => config('payments.currency')]) }}
            </small>
        </div>

        <div class="form-group">
            <label>{{ __('Status') }}</label>
            <input type="text" class="form-control text-muted" value="{{ __('app.withdrawal_status_'.$withdrawal->status) }}" readonly>
        </div>

        <div class="form-group">
            <label>{{ __('Comment') }}</label>
            <textarea name="comment" class="form-control {{ !$editable ? 'text-muted' : '' }}" rows="3"  {{ !$editable ? 'readonly' : '' }}>{{ $withdrawal->comment }}</textarea>
        </div>

        <div class="form-group">
            <label>{{ __('Wallet') }}</label>
            <input type="text" class="form-control text-muted" value="{{ $withdrawal->wallet }}" readonly>
        </div>

        <div class="form-group">
            <label>{{ __('Payment currency') }}</label>
            <input type="text" class="form-control text-muted" value="{{ $withdrawal->payment_currency }}" readonly>
        </div>

        <div class="form-group">
            <label>{{ __('External ID') }}</label>
            <div class="input-group">
                <input class="form-control text-muted" value="{{ $withdrawal->external_id }}" readonly>
                @if($withdrawal->external_id)
                    <div class="input-group-append">
                        <a href="{{ route('backend.withdrawals.track', $withdrawal) }}" class="btn btn-primary" type="button" >{{ __('Check status') }}</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label>{{ __('Created at') }}</label>
            <input class="form-control text-muted" value="{{ $withdrawal->created_at }} ({{ $withdrawal->created_at->diffForHumans() }})" readonly>
        </div>

        <div class="form-group">
            <label>{{ __('Updated at') }}</label>
            <input class="form-control text-muted" value="{{ $withdrawal->updated_at }} ({{ $withdrawal->updated_at->diffForHumans() }})" readonly>
        </div>

        @if($editable)
            <button type="submit" class="btn btn-primary float-left" {{ !$editable ? 'disabled' : '' }}>
                <i class="fas fa-save"></i>
                {{ __('Save') }}
            </button>
        @endif
    </form>
    @if($editable)
        <form class="float-left ml-2 mr-2" method="POST" action="{{ route('backend.withdrawals.reject', $withdrawal) }}">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-times"></i>
                {{ __('Reject') }}
            </button>
        </form>
        <form class="float-left mr-2" method="POST" action="{{ route('backend.withdrawals.approve', $withdrawal) }}">
            @csrf
            <button type="submit" class="btn btn-outline-success">
                <i class="fas fa-arrow-right"></i>
                {{ __('Approve') }}
            </button>
        </form>
        <form method="POST" action="{{ route('backend.withdrawals.complete', $withdrawal) }}">
            @csrf
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i>
                {{ __('Complete') }}
            </button>
        </form>
        <div class="mt-3">
            <small class="form-text text-muted">
                {{ __('Reject - set withdrawal status to "Rejected". Withdrawal amount will be returned to user account.') }}
            </small>
            <small class="form-text text-muted">
                {{ __('Approve - set withdrawal status to "In progress" and initiate an automatic coins transfer transaction. Withdrawal request will be automatically marked as "Completed" upon receiving a confirmation from the API.') }}
            </small>
            <small class="form-text text-muted">
                {{ __('Complete - set withdrawal status to "Completed". Coins are supposed to be sent manually.') }}
            </small>
        </div>
    @endif
    <div class="mt-3">
        <a href="{{ route('backend.withdrawals.index', request()->query()) }}"><i class="fas fa-long-arrow-alt-left"></i> {{ __('Back to all withdrawals') }}</a>
    </div>
@endsection