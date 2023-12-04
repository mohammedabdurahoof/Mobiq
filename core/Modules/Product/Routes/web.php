<?php

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    /* --------------------------------------------------------
    *                  FRONTEND PRODUCT ROUTES
    *-------------------------------------------------------- */

    Route::post('checkout', 'ProductSellPaymentController@checkout');
    Route::get('checkout/apply/coupon', 'ProductCartController@checkoutPageApplyCouponAjax')->name('frontend.checkout.apply.coupon');
    Route::get('/checkout/calculate', 'ProductCartController@calculateCheckout')->name('frontend.checkout.calculate');

    $product_page_slug = getSlugFromReadingSetting('product_page') ?? 'product';
    Route::group(['prefix' => $product_page_slug, 'as' => 'frontend.products.', 'middleware' => ['setlang:frontend', 'globalVariable', 'maintains_mode']], function () use ($product_page_slug) {

    Route::get("download-invoice/{id}","FrontendProductController@download_invoice")->name("download-invoice");

    Route::get('track-order', 'FrontendProductController@trackOrderPage')->name('track.order');
    Route::post('track-order', 'FrontendProductController@trackOrder');

    Route::get('/', 'FrontendProductController@products')->name('all');
    Route::get('search', 'FrontendProductController@search')->name('search');
    Route::get('/{slug}', 'FrontendProductController@productDetailsPage')->name('single');
    Route::get('/quick-viewpage/{slug}', 'FrontendProductController@productQuickViewPage')->name('single-quick-view');

    Route::get('category/{id}/{any?}', 'FrontendProductController@products_category')->name('category');
    Route::get('subcategory/{id}/{any?}', 'FrontendProductController@products_subcategory')->name('subcategory');

    /**--------------------------------
     *          CART ROUTES
     * ---------------------------------*/
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/all', 'FrontendProductController@cartPage')->name('cart');
        /**--------------------------------
         *          CART AJAX ROUTES
         * ---------------------------------*/
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('details', 'ProductCartController@cartStatus')->name('cart.status.ajax');
            Route::post('remove', 'ProductCartController@removeCartItem')->name('cart.ajax.remove');
            Route::post('clear', 'ProductCartController@clearCart')->name('cart.ajax.clear');
            Route::get('cart-info', 'ProductCartController@getCartInfoAjax')->name('cart.info.ajax');
            Route::post('add-to-cart', 'ProductCartController@addToCartAjax')->name('add.to.cart.ajax');
            Route::post('update', 'ProductCartController@updateCart')->name('cart.update.ajax');
            Route::post('coupon', 'ProductCartController@applyCouponAjax')->name('cart.apply.coupon');
        });
    });
    /**--------------------------------
     *          WISHLIST ROUTES
     * ---------------------------------*/
    Route::group(['prefix' => 'wishlist'], function () {
        Route::get('all', 'FrontendProductController@wishlistPage')->name('wishlist');
        Route::get('total', 'ProductWishlistController@getTotalItem')->name('wishlist.total'); // remove after details page
        Route::post('add', 'ProductWishlistController@addToWishlist')->name('add.to.wishlist');
        Route::post('ajax-add', 'ProductWishlistController@addToWishlistAjax')->name('add.to.wishlist.ajax');
        Route::post('remove', 'ProductWishlistController@removeWishlistItem')->name('wishlist.ajax.remove');
        Route::post('clear', 'ProductWishlistController@clearWishlist')->name('wishlist.ajax.clear');
        Route::post('send-to-cart', 'ProductWishlistController@sendToCartAjax')->name('wishlist.send.to.cart');
        Route::post('send-to-cart-single', 'ProductWishlistController@sendSingleItemToCartAjax')->name('wishlist.send.to.cart.single');
        Route::get('wishlist-info', 'ProductWishlistController@getWishlistInfoAjax')->name('wishlist.info.ajax');
    });
    /**--------------------------------
     *      COMPARE PRODUCT ROUTES
     * ---------------------------------*/
    Route::group(['prefix' => 'compare'], function () {
        Route::get('all', 'FrontendProductController@productsComparePage')->name('compare');
        Route::post('add', 'ProductCompareController@addToCompare')->name('add.to.compare');
        Route::post('remove', 'ProductCompareController@removeFromCompare')->name('compare.ajax.remove');
        Route::post('clear', 'ProductCompareController@clearCompare')->name('ajax.compare.update');
    });
    /**--------------------------------
     *          RATING ROUTES
     * ---------------------------------*/
    Route::post('rate', 'ProductRatingController@store')->name('ratings.store');
    /**--------------------------------
     *          RATING ROUTES
     * ---------------------------------*/
    Route::get('campaign/{id}/{any?}', 'FrontendProductController@campaignPage')->name('campaign');
    /**--------------------------------
     * PAYMENT SUCCESS/CANCEL ROUTES
     * ---------------------------------*/
    Route::get('success/{id}', 'FrontendProductController@product_payment_success')->name('payment.success');
    Route::get('cancel/{id}', 'FrontendProductController@product_payment_cancel')->name('payment.cancel');




    
});
/**----------------------------------------------------------------
PRODUCT PAYMENT ROUTES
-----------------------------------------------------------------*/
Route::group([ 'as' => 'frontend.products.', 'middleware' => ['setlang:frontend', 'globalVariable', 'maintains_mode']],function(){
    /**--------------------------------
    PRODUCT PAYMENT IPN
    ---------------------------------*/
    Route::get('product/stripe-ipn','ProductSellPaymentController@stripe_ipn')->name('stripe.ipn');
    Route::get('/product/paypal-ipn','ProductSellPaymentController@paypal_ipn')->name('paypal.ipn');
    Route::post('/product/paytm-ipn','ProductSellPaymentController@paytm_ipn')->name('paytm.ipn');
    Route::post('/product/razorpay-ipn','ProductSellPaymentController@razorpay_ipn')->name('razorpay.ipn');
    Route::get('/product/flullterwave-ipn','ProductSellPaymentController@flutterwave_ipn')->name('flutterwave.ipn');
    Route::get('/product/mollie-ipn','ProductSellPaymentController@mollie_ipn')->name('mollie.ipn');
    Route::get('/product/midtrans-ipn','ProductSellPaymentController@midtrans_ipn')->name('midtrans.ipn');
    Route::post('/product/payfast-ipn','ProductSellPaymentController@payfast_ipn')->name('payfast.ipn');
    Route::post('/product/cashfree-ipn','ProductSellPaymentController@cashfree_ipn')->name('cashfree.ipn');
    Route::get('/product/paystack-ipn','ProductSellPaymentController@paystack_ipn')->name('paystack.ipn');
    Route::get('/product/instamojo-ipn','ProductSellPaymentController@instamojo_ipn')->name('instamojo.ipn');
    Route::get('/product/marcadopago-ipn','ProductSellPaymentController@marcadopago_ipn')->name('marcadopago.ipn');
});


/* --------------------------------------------------------
 *                  BACKEND PRODUCT ROUTES
 *-------------------------------------------------------- */
Route::prefix('admin-home/products')->middleware(['setlang:backend', 'adminglobalVariable'])->group(function () {
    Route::post('remove-variant', 'ProductController@removeInventoryVariant')->name('admin.remove.inventory.variant');

    /*-----------------------------------
        PRODUCTS ROUTES
    ------------------------------------*/
    Route::group(['as' => 'admin.products.'], function () {
        Route::get('/all', 'ProductController@index')->name('all');
        Route::get('/new', 'ProductController@create')->name('new');
        Route::post('/new', 'ProductController@store');
        Route::get('edit/{item}', 'ProductController@edit')->name('edit');
        Route::post('update/{item}', 'ProductController@update')->name('update');
        Route::post('delete/{item}', 'ProductController@destroy')->name('delete');
        Route::post('clone/{item}', 'ProductController@clone')->name('clone');
        Route::post('/bulk-action', 'ProductController@bulk_action')->name('bulk.action');
    });

    /*-----------------------------------
        PRODUCTS COLOR ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'colors', 'as' => 'admin.products.color.'], function () {
        Route::get('/', 'ProductColorController@index')->name('all');
        Route::get('new', 'ProductColorController@store')->name('new');
        Route::post('update', 'ProductColorController@update')->name('update');
        Route::post('delete', 'ProductColorController@destroy')->name('delete');
        Route::post('bulk-action', 'ProductColorController@bulk_action')->name('bulk.action');
    });

    /*-----------------------------------
        PRODUCTS Size ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'sizes', 'as' => 'admin.products.size.'], function () {
        Route::get('/', 'ProductSizeController@index')->name('all');
        Route::get('new', 'ProductSizeController@store')->name('new');
        Route::post('update', 'ProductSizeController@update')->name('update');
        Route::post('delete', 'ProductSizeController@destroy')->name('delete');
        Route::post('bulk-action', 'ProductSizeController@bulk_action')->name('bulk.action');
    });

    /*-----------------------------------
        DELETED PRODUCTS ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'deleted', 'as' => 'admin.products.deleted.'], function () {
        Route::get('/', 'DeletedProductsController@index')->name('all');
        Route::post('restore/{item}', 'DeletedProductsController@restore')->name('restore');
        Route::post('delete/{item}', 'DeletedProductsController@destroy')->name('permanent.delete');
        Route::post('/bulk-action', 'DeletedProductsController@bulk_action')->name('bulk.action');
    });

    /*-----------------------------------
        PRODUCTS RATINGS ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'ratings', 'as' => 'admin.products.ratings.'], function () {
        Route::get('/', 'ProductRatingController@index')->name('all');
        Route::post('/delete/{rating}', 'ProductRatingController@destroy')->name('delete');
        Route::post('/bulk-action', 'ProductRatingController@bulk_action')->name('bulk.action');
    });

    /*-----------------------------------
        PRODUCTS UNIT ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'units', 'as' => 'admin.products.units.'], function () {
        Route::get('/', 'ProductUnitController@index')->name('all');
        Route::post('new', 'ProductUnitController@store')->name('store');
        Route::post('update', 'ProductUnitController@update')->name('update');
        Route::post('delete/{item}', 'ProductUnitController@destroy')->name('delete');
        Route::post('bulk-action', 'ProductUnitController@bulk_action')->name('bulk.action');
    });

    /*--------------------------
          * variant
    --------------------------*/
    Route::group(['prefix' => 'attributes', 'as' => 'admin.products.attributes.'], function () {
        Route::get('/', 'ProductAttributeController@index')->name('all');
        Route::get('/new', 'ProductAttributeController@create')->name('store');
        Route::post('/new', 'ProductAttributeController@store');
        Route::get('/edit/{item}', 'ProductAttributeController@edit')->name('edit');
        Route::post('/update', 'ProductAttributeController@update')->name('update');
        Route::post('/delete/{item}', 'ProductAttributeController@destroy')->name('delete');
        Route::post('/bulk-action', 'ProductAttributeController@bulk_action')->name('bulk.action');
        Route::post('/details', 'ProductAttributeController@get_details')->name('details');
        Route::post('/by-lang', 'ProductAttributeController@get_all_variant_by_lang')->name('admin.products.variant.by.lang');
    });

    /*-----------------------------------
        PRODUCTS  ORDERS ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'product-order', 'as' => 'admin.product.order.'], function () {
        Route::get('/', 'ProductOrderController@orderLogs')->name('logs');
        Route::get('new-order', 'ProductOrderController@create')->name('new');
        Route::post('new-order', 'ProductOrderController@store');
        Route::get('view/{id}', 'ProductOrderController@show')->name('view');
        Route::post('delete/{id}', 'ProductOrderController@delete')->name('payment.delete');

        Route::post('filter-order', 'ProductOrderController@filterOrders')->name('filter'); // === later ===

        Route::post('/approve', 'ProductOrderController@product_order_payment_approve')->name('payment.approve');
        Route::post('/status-change', 'ProductOrderController@product_order_status_change')->name('status.change');
        Route::post('/bulk-action', 'ProductOrderController@product_order_bulk_action')->name('bulk.action');
        Route::post('/order-reminder', 'ProductOrderController@order_reminder')->name('reminder');

        Route::get('get-product-row', 'ProductOrderController@getProductRow')->name('product.row');
    });

    Route::get('generate-products-invoice', 'ProductOrderController@generateInvoice')->name('frontend.product.invoice.generate');

    Route::group(['prefix' => 'import', 'as' => 'admin.products.import.'], function () {
        Route::get('/', 'ProductImportController@import_settings')->name('all');
        Route::post('update-settings', 'ProductImportController@update_import_settings')->name('settings.update');
        Route::post('/', 'ProductImportController@import_to_database_settings')->name('to.database');
    });

    /*-----------------------------------
        PRODUCT CATEGORY  ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'categories', 'as' => 'admin.products.category.'], function () {
        Route::get('/', 'ProductCategoryController@index')->name('all');
        Route::post('new', 'ProductCategoryController@store')->name('new');
        Route::post('update', 'ProductCategoryController@update')->name('update');
        Route::post('delete/{item}', 'ProductCategoryController@destroy')->name('delete');
        Route::post('bulk-action', 'ProductCategoryController@bulk_action')->name('bulk.action');
    });

    /*-----------------------------------
        PRODUCT SUB-CATEGORY  ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'sub-categories', 'as' => 'admin.products.subcategory.'], function () {
        Route::get('/', 'ProductSubCategoryController@index')->name('all');
        Route::post('new', 'ProductSubCategoryController@store')->name('new');
        Route::post('update', 'ProductSubCategoryController@update')->name('update');
        Route::post('delete/{item}', 'ProductSubCategoryController@destroy')->name('delete');
        Route::post('bulk-action', 'ProductSubCategoryController@bulk_action')->name('bulk.action');

        Route::get('of-category/{id}', 'ProductSubCategoryController@getSubcategoriesOfCategory')->name('of.category');
    });

    /*-----------------------------------
        COUPON ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'coupons', 'as' => 'admin.products.coupon.'], function () {
        Route::get('/', 'ProductCouponController@index')->name('all');
        Route::post('new', 'ProductCouponController@store')->name('new');
        Route::post('update', 'ProductCouponController@update')->name('update');
        Route::post('delete/{item}', 'ProductCouponController@destroy')->name('delete');
        Route::post('bulk-action', 'ProductCouponController@bulk_action')->name('bulk.action');
        Route::get('check', 'ProductCouponController@check')->name('check');
        Route::get('get-products', 'ProductCouponController@allProductsAjax')->name('products');
    });

    /*-----------------------------------
        TAG ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'tags', 'as' => 'admin.products.tag.'], function () {
        Route::get('/', 'TagController@index')->name('all');
        Route::post('new', 'TagController@store')->name('new');
        Route::post('update', 'TagController@update')->name('update');
        Route::post('delete/{item}', 'TagController@destroy')->name('delete');
        Route::post('bulk-action', 'TagController@bulk_action')->name('bulk.action');
        Route::get('check', 'TagController@check')->name('check');
        Route::get('get-tags', 'TagController@getTagsAjax')->name('get.ajax');
    });

    /*-----------------------------------
        PRODUCT TAG ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'product-tags', 'as' => 'admin.products.product.tag.'], function () {
        Route::get('/', 'ProductTagController@index')->name('all');
        Route::post('new', 'ProductTagController@store')->name('new');
        Route::post('update', 'ProductTagController@update')->name('update');
        Route::post('delete/{item}', 'ProductTagController@destroy')->name('delete');
        Route::post('bulk-action', 'ProductTagController@bulk_action')->name('bulk.action');
        Route::get('check', 'ProductTagController@check')->name('check');
    });

    /*-----------------------------------
        INVENTORY ROUTES
    ------------------------------------*/
    Route::group(['prefix' => 'product-inventory', 'as' => 'admin.products.inventory.'], function () {
        Route::get('/', 'ProductInventoryController@index')->name('all');
        Route::get('edit/{item}', 'ProductInventoryController@edit')->name('edit');
        Route::post('update', 'ProductInventoryController@update')->name('update'); // [===== ??? =====]
        Route::post('delete', 'ProductInventoryController@destroy')->name('delete');
        Route::post('bulk-action', 'ProductInventoryController@bulk_action')->name('bulk.action');
        Route::post('attribute-delete', 'ProductInventoryController@removeProductInventory')->name('attribute.delete');
        Route::post('details-attribute-delete', 'ProductInventoryController@removeInventoryDetailsAttribute')->name('details.attribute.delete');
    });
});

require_once __DIR__ .'/admin.php';
