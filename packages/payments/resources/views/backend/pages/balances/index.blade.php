@extends('backend.layouts.main')

@section('title')
    {{ __('Balances') }}
@endsection

@section('content')
    @if($balances->isEmpty())
        <div class="alert alert-info" role="alert">
            {{ __('All balances are zero.') }}
        </div>
    @else
        <table class="table table-hover table-stackable">
            <thead>
            <tr>
                <th>{{ __('Coin') }}</th>
                <th>{{ __('Status') }}</th>
                <th class="text-right">{{ __('Balance') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($balances as $coin => $balance)
                <tr>
                    <td data-title="{{ __('Coin') }}">{{ $coin }}</td>
                    <td data-title="{{ __('Status') }}">{{ $balance['status'] . ' / ' . $balance['coin_status'] }}</td>
                    <td data-title="{{ __('Balance') }}" class="text-right">{{ $balance['balancef'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection