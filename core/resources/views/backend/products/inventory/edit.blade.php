@extends('backend.admin-master')
@section('site-title')
    {{__('Product Inventory')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <x-media.css />
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
            @can('product-category-edit')
            <div class="col-lg-12 mt-5">
                <form action="{{ route('admin.products.inventory.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $inventory->id }}">
                    <div class="card my-5">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Edit Product Inventory')}}</h4>
                            <div class="text-right">
                                <a href="{{ route('admin.products.inventory.all') }}" type="button" class="btn btn-primary">{{ __('All Product Stock') }}</a>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="product_id">{{ __('Product') }}</label>
                                        <select name="product_id" id="product_id" class="form-control nice-select wide">
                                            @foreach ($all_products as $product)
                                                <option value="{{ $product->id }}" @if($inventory->product_id == $product->id) selected @endif>{{ $product->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="sku">{{ __('SKU') }}</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{ __('SKU -') }}</div>
                                            </div>
                                            <input type="text" class="form-control" id="sku" name="sku" placeholder="{{ __('SKU Text') }}" value="{{ str_replace('SKU-', '', $inventory->sku) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-group">
                                        <label for="stock_count">{{ __('Stock Count') }}</label>
                                        <input type="number" id="stock_count" name="stock_count" class="form-control" placeholder="{{ __('Stock Count') }}" value="{{ $inventory->stock_count }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card my-5">
                        <div class="card-body">
                            @if(!is_null($inventory_details))
                                <h5 class="mb-5">{{ __('product Variants') }}</h5>
                                @foreach($inventory->details as $inventory_details)
                                    <div class="form-row my-3 p-4 border border-info rounded">
                                        <input type="hidden" name="inventory_details_id[]" value="{{ $inventory_details->id }}">
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="size" id="size">{{ __('Size') }}</label>
                                                        <select name="inventory_details_size[]" id="size" class="form-control">
                                                            @foreach($product_sizes as $product_size)
                                                                <option
                                                                        value="{{ $product_size->id }}"
                                                                        @if($inventory_details->size == $product_size->id)
                                                                        selected
                                                                        @endif
                                                                >{{ $product_size->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="color" id="color">{{ __('Color') }}</label>
                                                        <select name="inventory_details_color[]" id="color" class="form-control">
                                                            @foreach($product_colors as $product_color)
                                                                <option
                                                                        value="{{ $product_color->id }}"
                                                                        @if($inventory_details->color == $product_color->id)
                                                                        selected
                                                                        @endif
                                                                >{{ $product_color->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="additional_price">{{ __('Additional Price') }}</label>
                                                        <input type="number" class="form-control" name="inventory_details_additional_price[]"
                                                               id="additional_price" step="0.01"
                                                               value="{{ $inventory_details->additional_price }}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="stock_count">{{ __('Stock Count') }}</label>
                                                        <input type="number" class="form-control" name="inventory_details_stock_count[]"
                                                               id="stock_count" value="{{ $inventory_details->stock_count }}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="sold_count">{{ __('Sold Count') }}</label>
                                                        <input type="number" class="form-control" name="inventory_details_sold_count[]"
                                                               id="sold_count" value="{{ $inventory_details->sold_count }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $present_inventory_attributes = $inventory_details_attributes->where('inventory_details_id', $inventory_details->id);
                                            @endphp
                                            @if(!is_null($present_inventory_attributes) && $present_inventory_attributes->count())
                                                <h6 class="mt-4 mb-3">{{ __('Attributes') }}</h6>
                                                @foreach($present_inventory_attributes as $key => $present_inventory_attribute)
                                                    <div class="form-row">
                                                        <input type="hidden"
                                                               {{-- name="item_attribute_id[{{ $key }}][]" --}}
                                                               value="{{ $present_inventory_attribute->id }}">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input type="text"
                                                                       class="form-control"
                                                                       {{-- name="item_attribute_name[{{ $key }}][]" --}}
                                                                       value="{{ $present_inventory_attribute->attribute_name }}"
                                                                       readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control"
                                                                       {{-- name="item_attribute_value[{{ $key }}][]" --}}
                                                                       value="{{ $present_inventory_attribute->attribute_value }}"
                                                                       readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="col-auto">
                                            <x-media-upload
                                                    :title="'Image'"
                                                    :name="'inventory_details_image[]'"
                                                    :id="$inventory_details->image"
                                                    :dimentions="'1920x1280'"
                                            />
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-primary">
                            <i class="ti-check-box submit-btn"></i>
                            {{ __('Update Inventory Details') }}
                        </button>
                    </div>
                </form>
            </div>
            @endcan
        </div>
    </div>
    <x-media.markup />
@endsection
@section('script')
    <x-datatable.js />
    <x-table.btn.swal.js />
    <script src="{{ asset('assets/backend/js/jquery.nice-select.min.js') }}"></script>
    <x-media.js />
    <script>
        (function ($) {
            'use script'
            $(document).ready(function () {
                let nice_select_el = $('.nice-select');
                if (nice_select_el.length > 0) {
                    nice_select_el.niceSelect();
                }
            });
        })(jQuery)
    </script>

@endsection
