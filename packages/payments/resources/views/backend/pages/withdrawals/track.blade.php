@extends('backend.layouts.main')

@section('title')
    {{ __('Widthdrawal') }} {{ $withdrawal->id }} :: {{ __('Info') }}
@endsection

@section('content')
    <table class="table table-hover table-stackable">
        <tbody>
            <tr>
                <td>{{ __('ID') }}</td>
                <td class="text-right">{{ $withdrawal->external_id }}</td>
            </tr>
            <tr>
                <td>{{ __('Status') }}</td>
                <td class="text-right">{{ $info->get('status') }} - {{ $info->get('status_text') }}</td>
            </tr>
            <tr>
                <td>{{ __('Amount') }}</td>
                <td class="text-right">{{ $info->get('amountf') }} {{ $info->get('coin') }}</td>
            </tr>
            <tr>
                <td>{{ __('Sent to') }}</td>
                <td class="text-right">{{ $info->get('send_address') }}</td>
            </tr>
            <tr>
                <td>{{ __('Transaction ID') }}</td>
                <td class="text-right">{{ $info->get('send_txid') }}</td>
            </tr>
        </tbody>
    </table>
    <div class="mt-3">
        <a href="{{ route('backend.withdrawals.edit', $withdrawal) }}"><i class="fas fa-long-arrow-alt-left"></i> {{ __('Back to withdrawal') }}</a>
    </div>
@endsection