@extends('frontend.user.dashboard.user-master')
@section('site-title')
    {{ __('User Dashboard') }}
@endsection

@section('section')
    <div class="row">
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01 ">
                <div class="icon slider-thumb"><i class="las la-dollar-sign"></i></div>
                <div class="content">
                    <h4 class="title">{{ __('Total Orders') }}</h4>
                    <span class="number">{{ $product_count }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01 ">
                <div class="icon slider-thumb"><i class="las la-sort-amount-up"></i></div>
                <div class="content">
                    <h4 class="title">{{ __('Support Tickets') }}</h4>
                    <span class="number">{{ $support_ticket_count }}</span>
                </div>
            </div>
        </div>
    </div>


    {{--  --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="form-header-wrap margin-bottom-20 d-flex justify-content-between">
                <h3 class="mb-3">{{ __('My Orders') }}</h3>
            </div>
            <div class="table-wrap table-responsive all-user-campaign-table">
                <div class="order-history-inner text-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    {{ __('Order') }}
                                </th>
                                <th>
                                    {{ __('Date') }}
                                </th>
                                <th>
                                    {{ __('Status') }}
                                </th>
                                <th>
                                    {{ __('Amount') }}
                                </th>
                                <th>
                                    {{ __('Action') }}
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_orders as $order)
                                <tr class="completed">
                                    <td class="order-numb">
                                        #{{ $order->id }}
                                    </td>
                                    <td class="date">
                                        {{ $order->created_at->format('F d, Y') }}
                                    </td>
                                    <td class="status">
                                        @if ($order->status == 'complete')
                                            <span class="badge badge-success px-2 py-1">{{ __('Complete') }}</span>
                                        @elseif ($order->status == 'pending')
                                            <span class="badge badge-warning px-2 py-1">{{ __('Pending') }}</span>
                                        @elseif ($order->status == 'canceling')
                                            <span class="badge badge-danger px-2 py-1">{{ __('Canceling') }}</span>
                                        @elseif ($order->status == 'canceled')
                                            <span class="badge badge-danger px-2 py-1">{{ __('Canceled') }}</span>
                                        @endif
                                    </td>
                                    <td class="amount">
                                        {{ float_amount_with_currency_symbol($order->total_amount) }}
                                    </td>
                                    <td class="table-btn">
                                        <div class="btn-wrapper">
                                            <a href="{{ route('user.product.order.details', $order->id) }}"
                                                class="btn-default rounded-btn"> {{ __('view details') }}</a>
                                            @if ($order->status == 'pending')
                                                <a href="{{ route('user.product.order.cancelOrder', $order->id) }}"
                                                    class="btn-default rounded-btn"> {{ __('cancel order') }}</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination">
                {!! $all_orders->links() !!}
            </div>
        </div>
    </div>
    {{--        </div> --}}
    {{--    </div> --}}
@endsection



{{--  --}}
