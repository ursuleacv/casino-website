@extends('backend.layouts.main')

@section('title')
    {{ __('Dashboard') }} :: {{ __('Payments') }}
@endsection

@section('content')
    @include('backend.pages.dashboard.tabs')

    <div class="row text-center mt-3">
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary">{{ __('Deposits count') }}</div>
                <div class="card-body">
                    <h4 class="card-title m-0">{{ $deposits['count'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary">{{ __('Max deposit') }}</div>
                <div class="card-body">
                    <h4 class="card-title m-0">{{ $deposits['max'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary">{{ __('Total deposited') }}</div>
                <div class="card-body">
                    <h4 class="card-title m-0">{{ $deposits['total'] }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center mt-3">
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary">{{ __('Withdrawals count') }}</div>
                <div class="card-body">
                    <h4 class="card-title m-0">{{ $withdrawals['count'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary">{{ __('Max withdrawal') }}</div>
                <div class="card-body">
                    <h4 class="card-title m-0">{{ $withdrawals['max'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4 mb-4">
            <div class="card border-primary">
                <div class="card-header border-primary bg-primary">{{ __('Total withdrawn') }}</div>
                <div class="card-body">
                    <h4 class="card-title m-0">{{ $withdrawals['total'] }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 mb-4">
            <h2 class="text-center">{{ __('Deposits by day') }}</h2>
            <time-series-chart :data="{{ json_encode($deposits_by_day) }}" :scrollbar="true" theme="{{ $settings->theme }}" class="time-series-chart"></time-series-chart>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 mb-4">
            <h2 class="text-center">{{ __('Withdrawals by day') }}</h2>
            <time-series-chart :data="{{ json_encode($withdrawals_by_day) }}" :scrollbar="true" theme="{{ $settings->theme }}" class="time-series-chart"></time-series-chart>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center">{{ __('Deposits by currency') }}</h2>
            <pie-chart :data="{{ json_encode($deposits_by_ccy) }}" theme="{{ $settings->theme }}" class="pie-chart"></pie-chart>
        </div>
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center">{{ __('Withdrawals by currency') }}</h2>
            <pie-chart :data="{{ json_encode($withdrawals_by_ccy) }}" theme="{{ $settings->theme }}" class="pie-chart"></pie-chart>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center">{{ __('Top deposits') }}</h2>
            @if($top_deposits->isEmpty())
                <div class="alert alert-info" role="alert">
                    {{ __('There are no deposits yet.') }}
                </div>
            @else
                <table class="table table-hover table-stackable">
                    <thead>
                    <tr>
                        <th>{{ __('User') }}</th>
                        <th class="text-right">{{ __('Amount') }}</th>
                        <th class="text-right">{{ __('Created') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($top_deposits as $deposit)
                        <tr>
                            <td data-title="{{ __('User') }}">
                                <a href="{{ route('frontend.users.show', $deposit->account->user) }}">
                                    {{ $deposit->account->user->name }}
                                </a>
                            </td>
                            <td data-title="{{ __('Amount') }}" class="text-right">{{ $deposit->_amount }}</td>
                            <td data-title="{{ __('Created') }}" class="text-right">{{ $deposit->updated_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="col-sm-12 col-lg-6 mb-4">
            <h2 class="text-center">{{ __('Top withdrawals') }}</h2>
            @if($top_withdrawals->isEmpty())
                <div class="alert alert-info" role="alert">
                    {{ __('There are no withdrawals yet.') }}
                </div>
            @else
                <table class="table table-hover table-stackable">
                    <thead>
                    <tr>
                        <th>{{ __('User') }}</th>
                        <th class="text-right">{{ __('Amount') }}</th>
                        <th class="text-right">{{ __('Created') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($top_withdrawals as $withdrawal)
                        <tr>
                            <td data-title="{{ __('User') }}">
                                <a href="{{ route('frontend.users.show', $withdrawal->account->user) }}">
                                    {{ $withdrawal->account->user->name }}
                                </a>
                            </td>
                            <td data-title="{{ __('Amount') }}" class="text-right">{{ $withdrawal->_amount }}</td>
                            <td data-title="{{ __('Created') }}" class="text-right">{{ $withdrawal->updated_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection