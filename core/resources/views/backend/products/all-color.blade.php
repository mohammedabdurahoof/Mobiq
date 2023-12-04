@extends('backend.admin-master')
@section('site-title')
    {{__('All Product Color')}}
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
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Product Colors')}}</h4>
                        @can('product-color-delete')
                            <x-bulk-action.dropdown />
                        @endcan
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <x-bulk-action.th />
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Color Code')}}</th>
                                <th>{{__('Slug')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($product_colors as $product_color)
                                        <tr>
                                            <x-bulk-action.td :id="$product_color->id" />
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product_color->name }}</td>
                                            <td>{{ $product_color->color_code }}</td>
                                            <td>{{ $product_color->slug }}</td>
                                            <td>
                                                @can('product-color-delete')
                                                    <x-table.btn.swal.delete :route="route('admin.products.color.delete', $product_color->id)" />
                                                @endcan
                                                @can('product-color-edit')
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#color_edit_modal"
                                                       class="btn btn-primary btn-xs mb-3 mr-1 color_edit_btn"
                                                       data-id="{{ $product_color->id }}"
                                                       data-name="{{ $product_color->name }}"
                                                       data-color_code="{{ $product_color->color_code }}"
                                                       data-slug="{{ $product_color->slug }}"
                                                    >
                                                        <i class="ti-pencil"></i>
                                                    </a>
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
            @can('product-color-create')
            <div class="col-md-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('New Color')}}</h4>
                        <form action="{{ route('admin.products.color.new') }}">
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="{{__('Name')}}">
                            </div>
                            <div class="form-group">
                                <label for="color_code">{{__('Color Code')}}</label>
                                <input type="color" class="form-control w-25 p-1"  id="color_code" name="color_code" placeholder="{{__('Color Code')}}">
                            </div>
                            <div class="form-group">
                                <label for="slug">{{__('Slug')}}</label>
                                <input type="text" class="form-control"  id="slug" name="slug" placeholder="{{__('Slug')}}">
                            </div>
                            <button class="btn btn-primary px-5 my-3">{{ __('Save Color') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
    @can('product-color-edit')
        <div class="modal fade" id="color_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Edit Product Color')}}</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{route('admin.products.color.update')}}"  method="post">
                        <input type="hidden" name="id" id="color_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  id="edit_name" name="name" placeholder="{{__('Name')}}">
                            </div>
                            <div class="form-group">
                                <label for="color_code">{{__('color_code')}}</label>
                                <input type="color" class="form-control w-25 p-1"  id="edit_color_code" name="color_code" placeholder="{{__('Color Code')}}">
                            </div>
                            <div class="form-group">
                                <label for="slug">{{__('Slug')}}</label>
                                <input type="text" class="form-control"  id="edit_slug" name="slug" placeholder="{{__('Slug')}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('Save Change')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('script')
    <x-datatable.js />
    @can('product-color-delete')
        <x-bulk-action.js :route="route('admin.products.color.bulk.action')" />
    @endcan
    <script>
        $(document).ready(function () {
            $(document).on('click','.color_edit_btn',function(){
                let el = $(this);
                let modal = $('#color_edit_modal');

                modal.find('#color_id').val(el.data('id'));
                modal.find('#edit_name').val(el.data('name'));
                modal.find('#edit_color_code').val(el.data('color_code'));
                modal.find('#edit_slug').val(el.data('slug'));

                modal.show();
            });
        });
    </script>
@endsection