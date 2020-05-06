@extends('frontend.layouts.main')

@section('title')
    {{ __('Deposits') }}
@endsection

@section('content')
    <div class="text-center mb-3">
        <a href="{{ route('frontend.deposits.create') }}" class="btn btn-primary">{{ __('Deposit') }}</a>
    </div>
    @if($deposits->isEmpty())
        <div class="alert alert-info" role="alert">
            {{ __('There are no deposits yet.') }}
        </div>
    @else
        <table class="table table-hover table-stackable">
            <thead>
            <tr>
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
                    <td data-title="{{ __('Status') }}" class="{{ $deposit->status == \Packages\Payments\Models\Deposit::STATUS_COMPLETED ? 'text-success' : ($deposit->status == \Packages\Payments\Models\Deposit::STATUS_CANCELLED ? 'text-danger' : '') }}">
                        {{ __('app.deposit_status_' . $deposit->status) }}
                        @if ($deposit->status == \Packages\Payments\Models\Deposit::STATUS_PENDING)
                            <a href="{{ route('frontend.deposits.show', $deposit) }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-right"></i></a>
                        @endif
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
            {{ $deposits->appends(['sort' => $sort])->appends(['order' => $order])->links() }}
        </div>
    @endif
@endsection