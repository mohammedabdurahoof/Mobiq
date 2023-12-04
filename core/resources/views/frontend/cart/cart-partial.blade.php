@php
    //ddd($all_cart_items);
@endphp
<div class="cart-area-wrapper">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-md-12">
                @if (isset($quantity_msg) && is_array($quantity_msg))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                @foreach ($quantity_msg as $messege)
                                    <div class="alert alert-warning">{!! $messege !!}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="cart-inner-content">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('product name') }}</th>
                                <th>{{ __('quantity') }}</th>
                                <th>{{ __('unit price') }}</th>
                                <th>{{ __('subtotal') }}</th>
                                <th>{{ __('action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        @foreach ($all_cart_items as $key => $item)
                            @php $product = $products->find($key); @endphp
                            @foreach ($item as $cart_item)
                           @php
                           $image=json_decode($product->product_image_gallery,true);
                           @endphp
                                <tr>
                                    <td class="product-info">
                                        <span class="product-info-wrap">
                                            @php
                                                $color='';
                                                $a=getItemAttributesName($cart_item['attributes']);
                                                
                                                if(isset($cart_item['attributes']['_color']) && $cart_item['attributes']['_color'] !=null){
                                                    $colors=Modules\Product\Entities\ProductColor::where('name',$cart_item['attributes']['_color'])->first();
                                                    
                                                    $product_variant = Modules\Product\Entities\ProductInventoryDetails::where(['product_id'=>$product->id,'color'=>$colors->id])->first();
                                                    
                                                    if($product_variant){
                                                            $color=$product_variant->image;
                                                            
                                                    }else{
                                                        $color=$product->image;
                                                    }

                                                }else{
                                                     if(isset($cart_item['attributes']['Design']) && $cart_item['attributes']['Design'] !=null){
                                                        if($cart_item['attributes']['Design']=="Design1"){
                                                        $color=$image[0];
                                                        
                                                        }elseif($cart_item['attributes']['Design']=="Design2"){
                                                         $color=$image[1];
                                                        }elseif($cart_item['attributes']['Design']=="Design3"){
                                                         $color=$image[2];
                                                        }elseif($cart_item['attributes']['Design']=="Design4"){
                                                         $color=$image[3];
                                                        }elseif($cart_item['attributes']['Design']=="Design5"){
                                                         $color=$image[4];
                                                        }else{
                                                            $color=$product->image;
                                                        }
    
                                                    }else{
                                                        $color=$product->image;
                                                    }
                                                    
                                                }
                                           
                                            
                                            @endphp
                                            {!! render_image_markup_by_attachment_id($color) !!}
                                            <a href="{{ route('frontend.products.single', ['slug' => $product->slug]) }}">
                                                <span class="product-title"> {{ $product->title }} {{ getItemAttributesName($cart_item['attributes']) }}</span>
                                            </a>
                                        </span>
                                    </td>
                                    <td class="quantity">
                                        <div class="cart-control">
                                            <div class="value-button minus decrease"><i class="las la-minus"></i></div>
                                            <input type="number" name="quantity" class="qty_ item_quantity_info" value="{{ $cart_item['quantity'] }}" data-id="{{ $cart_item['id'] }}" data-attr="{{ json_encode($cart_item['attributes']) }}">
                                            <div class="value-button plus increase"><i class="las la-plus"></i></div>
                                        </div>
                                    </td>
                                    @php
                                        $cart_price = $cart_item['attributes']['price'] ?? $product->sale_price;
                                        $total_price = $cart_price * $cart_item['quantity'];

                                        if (count($cart_item['attributes'])) {
                                            foreach ($cart_item['attributes'] as $attribute_name => $attribute_value) {
                                                if (! in_array($attribute_name, ['type', 'price']))
                                                    $pid = $product_stock_attributes->where('id', $key)
                                                                ->where('attribute_name', $attribute_name)
                                                                ->where('attribute_value', $attribute_value);
                                            }

                                            $pid_id = !empty($pid) && $pid->count()
                                                        ? $pid->first()->inventory_details_id
                                                        : null;
                                        }
                                    @endphp
                                    <td class="price">{{ float_amount_with_currency_symbol($cart_price) }}</td>
                                    <td class="sub-total">{{ float_amount_with_currency_symbol($total_price) }}</td>
                                    <td class="remove">
                                        <a href="#" class="remove_cart_item"
                                           data-id="{{ $cart_item['id'] }}"
                                           data-attr="{{ json_encode($cart_item['attributes']) }}"
                                           @if(isset($pid_id) && $pid_id) data-pid_id="{{ $pid_id }}" @endif
                                        >
                                            <i class="las la-trash icon"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                    <div class="coupon-and-btn">
                        <div class="btn-wrapper">
                            <a href="#" class="btn-default rounded-btn disable clear_cart">{{ get_static_option('clear_cart_text', __('Clear Cart')) }}</a>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{ route('frontend.checkout') }}" class="btn-default rounded-btn">{{ get_static_option('cart_proceed_to_checkout_text',__('Proceed to checkout') ) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
