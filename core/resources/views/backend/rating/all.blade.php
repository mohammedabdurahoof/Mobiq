@extends('backend.admin-master')
@section('site-title')
    {{__('All Product Ratings')}}
@endsection
@section('style')
    <x-datatable.css />
    <x-bulk-action.css />
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40">
                    <x-msg.error />
                    <x-msg.flash />
                </div>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Product Ratings')}}</h4>
                        @can('product-rating-delete')
                        <x-bulk-action.dropdown />
                        @endcan
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                    <x-bulk-action.th />
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Product') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Message') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach($all_ratings as $rating)
                                    <tr>
                                        <x-bulk-action.td :id="$rating->id" />
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional($rating->product)->title }}</td>
                                        <td>{{ optional($rating->user)->name }}</td>
                                        <td>{{ Str::limit(strip_tags($rating->review_msg), 20) }}</td>
                                        <td>
                                            @can('product-rating-delete')
                                            <x-table.btn.swal.delete :route="route('admin.products.ratings.delete', $rating->id)" />
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <x-datatable.js />
    <x-table.btn.swal.js />
    @can('product-rating-delete')
    <x-bulk-action.js :route="route('admin.products.ratings.bulk.action')" />
    @endcan
@endsection
