@extends('backend.layouts.main')

@section('title')
    {{ __('Withdrawals') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 offset-lg-9 mb-3">
            @search(['route' => 'backend.withdrawals.index', 'search' => $search])
            @endsearch
        </div>
    </div>
    @if($withdrawals->isEmpty())
        <div class="alert alert-info" role="alert">
            {{ __('No withdrawals found.') }}
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
                @component('components.tables.sortable-column', ['id' => 'amount', 'sort' => $sort, 'order' => $order, 'class' => 'text-right'])
                    {{ __('Amount') }}
                @endcomponent                
                @component('components.tables.sortable-column', ['id' => 'payment_currency', 'sort' => $sort, 'order' => $order, 'class' => 'text-right'])
                    {{ __('Payment currency') }}
                @endcomponent
                @component('components.tables.sortable-column', ['id' => 'status', 'sort' => $sort, 'order' => $order])
                    {{ __('Status') }}
                @endcomponent
                @component('components.tables.sortable-column', ['id' => 'created', 'sort' => $sort, 'order' => $order, 'class' => 'text-right'])
                    {{ __('Created') }}
                @endcomponent
                @component('components.tables.sortable-column', ['id' => 'updated', 'sort' => $sort, 'order' => $order, 'class' => 'text-right'])
                    {{ __('Updated') }}
                @endcomponent
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($withdrawals as $withdrawal)
                <tr>
                    <td data-title="{{ __('ID') }}">{{ $withdrawal->id }}</td>
                    <td data-title="{{ __('User') }}">
                        <a href="{{ route('backend.users.edit', $withdrawal->account->user) }}">
                            {{ $withdrawal->account->user->name }}
                        </a>
                    </td>
                    <td data-title="{{ __('Amount') }}" class="text-right">
                        {{ $withdrawal->_amount }}
                    </td>
                    <td data-title="{{ __('Payment currency') }}" class="text-right">
                        {{ $withdrawal->_payment_currency }}
                    </td>
                    <td data-title="{{ __('Status') }}" class="{{ $withdrawal->status == \Packages\Payments\Models\Withdrawal::STATUS_COMPLETED ? 'text-success' : (in_array($withdrawal->status, [\Packages\Payments\Models\Withdrawal::STATUS_CANCELLED, \Packages\Payments\Models\Withdrawal::STATUS_REJECTED]) ? 'text-danger' : '') }}">
                        {{ __('app.withdrawal_status_' . $withdrawal->status) }}
                    </td>
                    <td data-title="{{ __('Created') }}" class="text-right">
                        {{ $withdrawal->created_at->diffForHumans() }}
                        <span data-balloon="{{ $withdrawal->created_at }}" data-balloon-pos="up">
                            <i class="far fa-clock" ></i>
                        </span>
                    </td>
                    <td data-title="{{ __('Updated') }}" class="text-right">
                        {{ $withdrawal->updated_at->diffForHumans() }}
                        <span data-balloon="{{ $withdrawal->updated_at }}" data-balloon-pos="up">
                            <i class="far fa-clock" ></i>
                        </span>
                    </td>
                    <td class="text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('backend.withdrawals.edit', array_merge(['withdrawal' => $withdrawal], request()->query())) }}">
                            <i class="fas fa-pen fa-sm"></i>
                            {{ __('Edit') }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $withdrawals->appends(['search' => $search])->appends(['sort' => $sort])->appends(['order' => $order])->links() }}
        </div>
    @endif
@endsection