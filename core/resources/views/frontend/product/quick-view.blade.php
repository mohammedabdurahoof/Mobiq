    @php
        $product_img_url = null;
        $product_image = get_attachment_image_by_id($product->image,"full", false);
        $product_img_url = !empty($product_image) ? $product_image['img_url'] : '';
        $sidebar_status = get_static_option('sidebar_status');
        $sidebar_position = get_static_option('sidebar_position');

        $campaign_product = getCampaignProductById($product->id);
        $sale_price = $campaign_product ? $campaign_product->campaign_price : $product->sale_price;
        $deleted_price = $campaign_product ? $product->sale_price : $product->price;
        $campaign_percentage = $campaign_product ? getPercentage($product->sale_price, $sale_price) : false;
        $campaignSoldCount = \App\Campaign\CampaignSoldProduct::where("product_id",$product->id)->first();
        $stock_count = $campaign_product ?
            $campaign_product->units_for_sale - (optional($campaignSoldCount)->sold_count ?? 0) :
            optional($product->inventory)->stock_count;
        $stock_count = $stock_count > 0 ? $stock_count : 0;

        if($campaign_product){
            $campaign_title = \App\Campaign\Campaign::select('id','title')->where("id",$campaign_product->campaign_id)->first();
        }

        $productImage = render_image_markup_by_attachment_id($product->image,'w-100');

        $randomCountDown = rand(1111111,9999999);
    @endphp
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5">
            <div class="quick-view-close-btn-wrapper quick-view-details">
                <button class="quick-view-close-btn"><i class="las la-times"></i></button>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="product_details">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-view-wrap product-img quick-view-long-img">
                                    <ul class="other-content">
                                        @if(!empty($product->badge))
                                            <li>
                                                <span class="badge-tag"></span>
                                            </li>
                                        @endif
                                        @if(!empty($campaign_percentage))
                                            <li>
                                                <span class="discount-tag"></span>
                                            </li>
                                        @endif
                                    </ul>

                                    {!! $productImage !!}
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-2">
                                    @if(!empty($campaign_product))
                                        <div class="flash-countdown-wrapper">
                                            <div class="flash-countdown-title-single">
                                                <h6 class="flash-countdown-title">{{$campaign_title->title}}</h6>
                                            </div>
                                            <div class="flash-countdown-product flash-countdown-product-quick-view-{{ $randomCountDown }}"
                                                 data-date="{{ optional($campaign_product)->end_date }}">
                                                <div class="single-box">
                                                    <span class="counter-days item"></span>
                                                    <span class="label item">{{ __('D') }}</span>
                                                </div>
                                                <div class="single-box">
                                                    <span class="counter-hours item"></span>
                                                    <span class="label item">{{ __('H') }}</span>
                                                </div>
                                                <div class="single-box">
                                                    <span class="counter-minutes item"></span>
                                                    <span class="label item">{{ __('M') }}</span>
                                                </div>
                                                <div class="single-box">
                                                    <span class="counter-seconds item"></span>
                                                    <span class="label item">{{ __('S') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="product-summery">
                                    <span class="product-meta pricing">
                                         <span id="unit">{{ $product->unit }} </span> <span id="uom">{{ $product->uom }}</span>
                                    </span>
                                    <h3 class="product-title title">{{ $product->title }}</h3>
                                    <div>
                                        <span class="availability is_available">
                                            @if($stock_count > 0)
                                                <span class="availability">{{ filter_static_option_value('product_in_stock_text', $setting_text, __('In stock')) }} ({{ $stock_count }})</span>
                                            @else
                                                <span class="availability text-danger">{{ filter_static_option_value('product_out_of_stock_text', $setting_text, __('Out of stock')) }}</span>
                                            @endif
                                        </span>
                                    </div>

                                    @if($product->ratingCount() > 0)
                                        <div class="rating-wrap">
                                            <div class="ratings">
                                                {!! ratingMarkup($product->ratingAvg(), $product->ratingCount(), false) !!}
                                            </div>
                                            <p class="total-ratings">({{ $product->ratingCount() }})</p>
                                        </div>
                                    @endif

                                    <div class="short-description">
                                        <p class="info">{!! $product->summary !!}</p>
                                    </div>

                                    @if($product->attributes && $product->attributes != 'null')
                                        @php $product_attributes = decodeProductAttributes($product->attributes); @endphp
                                        @foreach ($product_attributes as $attribute)
                                            <div class="size section attribute_row">
                                                <span class="name">{{ $attribute['name'] }}</span>
                                                <div class="checkbox-color ">
                                                    @foreach ($attribute['terms'] as $term)
                                                        <div class="single-checkbox-wrap attribute">
                                                            <label>
                                                                <input type="radio"
                                                                       name="attr_{{ $attribute['name'] }}"
                                                                       data-attr="{{ json_encode($term) }}"
                                                                       class="checkbox">
                                                                <span data-name="{{ $attribute['name'] }}"
                                                                      data-extra="{{ $term['additional_price'] }}"
                                                                      class="size-code">
                                                                {{ $term['name'] }} @if (isset($term['additional_price']) && $term['additional_price'] > 0)
                                                                        (+{{ float_amount_with_currency_symbol($term['additional_price']) }}
                                                                        ) @endif
                                                            </span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="price-wrap">
                                        <span class="price"
                                              data-main-price="{{ $sale_price }}"
                                              data-currency-symbol="{{ site_currency_symbol() }}"
                                              id="quick-view-price"
                                        >
                                            {{ float_amount_with_currency_symbol($sale_price) }}
                                        </span>
                                        @if($deleted_price > $sale_price)
                                            <del class="del-price">{{ float_amount_with_currency_symbol($deleted_price) }}</del>
                                        @endif
                                    </div>

                                    @if($productSizes->count() > 0)
                                        <div class="quick-view-value-input-area margin-top-15 size_list">
                                                    <span class="input-list">
                                                        <strong class="color-light">{{ __('Size:') }}</strong>
                                                        <input class="form--input quick-view-value-size" name="size" type="text" value="">
                                                        <input type="hidden" id="quick_view_selected_size">
                                                    </span>
                                            <ul class="quick-view-size-lists" data-type="Size">
                                                @foreach($productSizes as $product_size)
                                                    @if(!empty($product_size))
                                                        <li class=""
                                                            data-value="{{ optional($product_size)->id }}"
                                                            data-display-value="{{ optional($product_size)->name }}"
                                                        > {{ optional($product_size)->name }} </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if($productColors->count() > 0)
                                        <div class="quick-view-value-input-area margin-top-15 color_list">
                                            <span class="input-list">
                                                <strong class="color-light">{{ __('Color:') }}</strong>
                                                <input class="form--input value-size" name="color" type="text"
                                                       value="">
                                                <input type="hidden" id="quick_view_selected_color">
                                            </span>
                                            <ul class="quick-view-size-lists color-list" data-type="Color">
                                                @foreach($productColors as $product_color)
                                                    @if(!empty($product_color))
                                                        <li
                                                                class="radius-percent-50 {{-- @if($loop->first) active @endif --}} "
                                                                data-value="{{ optional($product_color)->id }}"
                                                                data-display-value="{{ optional($product_color)->name }}"
                                                        >
                                                            <span class="color-list-overlay"></span>
                                                            <span style="background: {{ optional($product_color)->color_code }}"></span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @foreach($available_attributes as $attribute => $options)
                                        <div class="quick-view-value-input-area margin-top-15 attribute_options_list">
                                            <span class="input-list">
                                                <strong class="color-light">{{ $attribute }}</strong>
                                                <input class="form--input value-size" type="text" value="">
                                                <input type="hidden" id="selected_attribute_option"
                                                       name="selected_attribute_option">
                                            </span>
                                            <ul class="quick-view-size-lists" data-type="{{ $attribute }}">
                                                @foreach($options as $option)
                                                    <li
                                                            class=""
                                                            data-value="{{ $option }}"
                                                            data-display-value="{{ $option }}"
                                                    > {{ $option }} </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                    {{--                                    @endif--}}

                                    <div class="user-select-option">
                                        <div class="cart-control">
                                            <div class="value-button minus decrease"><i
                                                        class="las la-minus"></i></div>
                                            <input type="text" name="quantity" id="quick-view-quantity" class="qty_"
                                                   value="1">
                                            <div class="value-button plus increase"><i
                                                        class="las la-plus"></i></div>
                                        </div>
                                        <div class="btn-and-fav">
                                            @if($stock_count)
                                                <div class="btn-wrapper">
                                                    <a href="#"
                                                       class="btn-default rounded-btn add_to_cart_single_page_quick_view"
                                                       data-id="{{ $product->id }}"
                                                    >
                                                        {{ filter_static_option_value('add_to_cart_text', $setting_text, __('add to cart')) }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @if($stock_count)
                                        <div class="btn-wrapper btn-and-fav d-flex flex-wrap mb-4">
                                            <a href="#" data-id="{{ $product->id }}"
                                               class="cart buy_now_single_page_quick_view btn-default rounded-btn">{{ __('Buy Now') }}</a>

                                            <div class="favorite add_to_wishlist_single_page_quick_view"
                                                 data-id="{{ $product->id }}">
                                                <a href="#">
                                                    <i class="lar la-heart icon"></i>
                                                </a>
                                            </div>
                                            <div class="favorite add_to_compare_ajax_single_page_quick_view"
                                                 data-id="{{ $product->id }}">
                                                <a href="#">
                                                    <i class="las la-retweet icon"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="cart-option"></div>
                                    @if ($product->category && $product->category->id)
                                       
                                        <div class="category">
                                            <span class="name">{{ __("Categories:") }}</span>
                                            <a href="{{ route('frontend.products.category', [
                                        'id' => optional($product->category)->id,
                                        'slug' => \Str::slug(optional($product->category)->title ?? '')
                                    ]) }}">
                                                {{ optional($product->category)->title }}
                                            </a>
                                        </div>
                                    @endif
                                    @if (!is_null($product->getSubcategory()))
                                       
                                       <div class="category">
                                           <span class="name">{{ __("Sub Category:") }}</span>
                                           @foreach($product->getSubcategory() as $subcat)
                                           <a href="{{ route('frontend.products.subcategory', [
                                       'id' => $subcat->id,
                                       'any' => \Str::slug($subcat->title ?? '')
                                   ]) }}">
                                               {{ $subcat->title }}
                                           </a>
                                           @endforeach
                                          
                                       </div>
                                   @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- new product modal - end --}}

    <script>
        // check condition if those variable are declared than no need to declare again
        window.quick_view_attribute_store = JSON.parse('{!! json_encode($product_inventory_set) !!}');
        window.quick_view_additional_info_store = JSON.parse('{!! json_encode($additional_info_store) !!}');
        window.quick_view_available_options = $('.quick-view-value-input-area');


        loopcounter('flash-countdown-product-quick-view-{{ $randomCountDown }}');
    </script>
