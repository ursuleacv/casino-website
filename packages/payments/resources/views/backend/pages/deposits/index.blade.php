@extends('backend.layouts.main')

@section('title')
    {{ __('Deposits') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 offset-lg-9 mb-3">
            @search(['route' => 'backend.deposits.index', 'search' => $search])
            @endsearch
        </div>
    </div>
    @if($deposits->isEmpty())
        <div class="alert alert-info" role="alert">
            {{ __('No deposits found.') }}
        </div>
    @else
        <table class="table table-hover table-stackable">
            <thead>
            <tr>
                @component('components.tables.sortable-column', ['id' => 'id', 'sort' => $sort, 'order' => $order])
                    {{ __('ID') }}
                @endcomponent
                <th>
                    <a href="#">{{ __('User') }}</a>
                </th>
                @component('components.tables.sortable-column', ['id' => 'status', 'sort' => $sort, 'order' => $order])
                    {{ __('Status') }}
                @endcomponent
                @component('components.tables.sortable-column', ['id' => 'amount', 'sort' => $sort, 'order' => $order, 'class' => 'text-right'])
                    {{ __('Amount') }}
                @endcomponent
                @component('components.tables.sortable-column', ['id' => 'payment_amount', 'sort' => $sort, 'order' => $order, 'class' => 'text-right'])
                    {{ __('Payment amount') }}
                @endcomponent
                @component('components.tables.sortable-column', ['id' => 'created', 'sort' => $sort, 'order' => $order, 'class' => 'text-right'])
                    {{ __('Created') }}
                @endcomponent
                @component('components.tables.sortable-column', ['id' => 'updated', 'sort' => $sort, 'order' => $order, 'class' => 'text-right'])
                    {{ __('Updated') }}
                @endcomponent
            </tr>
            </thead>
            <tbody>
            @foreach ($deposits as $deposit)
                <tr>
                    <td data-title="{{ __('ID') }}">{{ $deposit->id }}</td>
                    <td data-title="{{ __('User') }}">
                        <a href="{{ route('backend.users.edit', $deposit->account->user) }}">
                            {{ $deposit->account->user->name }}
                        </a>
                    </td>
                    <td data-title="{{ __('Status') }}" class="{{ $deposit->status == \Packages\Payments\Models\Deposit::STATUS_COMPLETED ? 'text-success' : ($deposit->status == \Packages\Payments\Models\Deposit::STATUS_CANCELLED ? 'text-danger' : '') }}">
                        {{ __('app.deposit_status_' . $deposit->status) }}
                    </td>
                    <td data-title="{{ __('Amount') }}" class="text-right">
                        {{ $deposit->_amount }}
                    </td>
                    <td data-title="{{ __('Payment amount') }}" class="text-right">
                        {{ $deposit->_payment_amount }} {{ $deposit->payment_currency }}
                    </td>
                    <td data-title="{{ __('Created') }}" class="text-right">
                        {{ $deposit->created_at->diffForHumans() }}
                        <span data-balloon="{{ $deposit->created_at }}" data-balloon-pos="up">
                            <i class="far fa-clock" ></i>
                        </span>
                    </td>
                    <td data-title="{{ __('Updated') }}" class="text-right">
                        {{ $deposit->updated_at->diffForHumans() }}
                        <span data-balloon="{{ $deposit->updated_at }}" data-balloon-pos="up">
                            <i class="far fa-clock" ></i>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $deposits->appends(['search' => $search])->appends(['sort' => $sort])->appends(['order' => $order])->links() }}
        </div>
    @endif
@endsection