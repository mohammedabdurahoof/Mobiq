@extends('frontend.user.dashboard.user-master')
@section('section')
    @if($all_shipping_address && $all_shipping_address->count())
        <h4 class="mb-5">{{ __('My Shipping Address') }}</h4>
        <div class="text-right mb-3 btn-wrapper">
            <a href="{{ route('user.shipping.address.new') }}" class="btn-default rounded-btn semi-bold">{{ __('Add Shipping Address') }}</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Address') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($all_shipping_address as $address)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $address->name }}</td>
                        <td>{{ $address->address }}</td>
                        <td>
                            <x-table.btn.swal.delete :route="route('shipping.address.delete', $address->id)" :class="'las la-trash'" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination">
            {!! $all_shipping_address->links() !!}
        </div>
    @else
        <div class="alert alert-warning">
            {{__('No Shipping Address Found. ')}}
            <a class="btn btn-link" href="{{ route('user.shipping.address.new') }}">{{ __('Create New?') }}</a>
        </div>
    @endif
@endsection
@section('scripts')
    <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
    <x-table.btn.swal.js />
@endsection
