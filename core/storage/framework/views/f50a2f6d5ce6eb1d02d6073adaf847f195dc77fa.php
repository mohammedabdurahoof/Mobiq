<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo e(__('Order Invoice')); ?> </title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
</head>
<body>
<style>
    * {
        font-family: 'Roboto', sans-serif;
        line-height: 26px;
        font-size: 15px;
    }

    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    /*=========================================================
      [ Table ]
    =========================================================*/

    .custom--table {
        width: 100%;
        color: inherit;
        vertical-align: top;
        font-weight: 400;
        border-collapse: collapse;
        border-bottom: 2px solid #ddd;
        margin-top: 0;
    }
    .table-title{
        font-size: 24px;
        font-weight: 600;
        line-height: 32px;
        margin-bottom: 10px;
    }
    .custom--table thead {
        font-weight: 700;
        background: inherit;
        color: inherit;
        font-size: 16px;
        font-weight: 500;
    }

    .custom--table tbody {
        border-top: 0;
        overflow: hidden;
        border-radius: 10px;
    }
    .custom--table thead tr {
        border-top: 2px solid #ddd;
        border-bottom: 2px solid #ddd;
        text-align: left;
    }
    .custom--table thead tr th {
        border-top: 2px solid #ddd;
        border-bottom: 2px solid #ddd;
        text-align: left;
        font-size: 16px;
        padding: 10px 0;
        width: 150px;
    }
    .custom--table tbody tr {
        vertical-align: top;
    }
    .custom--table tbody tr td {
        font-size: 14px;
        line-height: 18px;
        vertical-align: top;
        padding: 10px 5px;
    }
    .custom--table tbody tr td .data-span {
        font-size: 14px;
        font-weight: 500;
        line-height: 24px;
    }
    .custom--table tbody .table_footer_row {
        border-top: 2px solid #ddd;
        margin-bottom: 10px !important;
        padding-bottom: 10px !important;

    }
    /* invoice area */
    .custom-containers{
        max-width: 800px;
        margin: 0 auto;
    }
    .invoice-area {
        padding: 10px 0;
    }

    .invoice-wrapper {
        max-width: 800px;
        margin: 0 auto;
        padding: 70px 70px;
    }

    .invoice-header {
        margin-bottom: 40px;
    }

    .invoice-flex-contents {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }

    .invoice-logo {}

    .invoice-logo img {}

    .invoice-header-contents {
        float: right;
    }

    .invoice-header-contents .invoice-title {
        font-size: 40px;
        font-weight: 700;
    }

    .invoice-details {
        margin-top: 20px;
    }

    .invoice-details-flex {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }

    .invoice-details-title {
        font-size: 24px;
        font-weight: 700;
        line-height: 32px;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .invoice-single-details {}

    .details-list {
        margin: 0;
        padding: 0;
        list-style: none;
        margin-top: 10px;
    }

    .details-list .list {
        font-size: 14px;
        font-weight: 400;
        line-height: 22px;
        color: #666;
        margin: 0;
        padding: 0;
        transition: all .3s;
    }
    .details-list .list strong {
        font-size: 14px;
        font-weight: 500;
        line-height: 18px;
        color: #666;
        margin: 0;
        padding: 0;
        transition: all .3s;
    }

    .details-list .list a {
        display: inline-block;
        color: #666;
        transition: all .3s;
        text-decoration: none;
        margin: 0;
        line-height: 18px
    }

    .item-description {
        margin-top: 30px;
    }

    .products-item {
        text-align: left;
    }

    .invoice-total-count {}

    .invoice-total-count .list-single {
        display: flex;
        align-items: center;
        gap: 30px;
        font-size: 16px;
        line-height: 28px;
    }

    .invoice-total-count .list-single strong {}

    .invoice-subtotal {
        border-bottom: 2px solid #ddd;
        padding-bottom: 15px;
    }

    .invoice-total {
        padding-top: 10px;
    }

    .terms-condition-content {
        margin-top: 30px;
    }

    .terms-flex-contents {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .terms-left-contents {
        flex-basis: 50%;
    }

    .terms-title {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }

    .terms-para {
        margin-top: 10px;
    }

    .invoice-footer {}

    .invoice-flex-footer {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 30px;
    }

    .single-footer-item {
        flex: 1;
    }

    .single-footer {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .single-footer .icon {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 30px;
        width: 30px;
        font-size: 16px;
        background-color: #000e8f;
        color: #fff;
    }

    .icon-details {
        flex: 1;
    }

    .icon-details .list {
        display: block;
        text-decoration: none;
        color: #666;
        transition: all .3s;
        line-height: 24px;
    }

    .icon-details .list:hover {
        color: #000e8f;
    }

    @media (min-width: 300px) and (max-width: 991px) {
        .single-footer-item {
            flex-basis: 45%;
        }
        .custom--table tr th {
            font-size: 16px;
        }
    }

    @media (min-width: 300px) and (max-width: 575px) {
        .products-item {
            text-align: right;
            width: 260px;
            margin-left: auto;
        }
    }

    @media (min-width: 300px) and (max-width: 520px) {
        .item-description-list .list:first-child {
            width: 160px;
        }
        .item-products-list .list:first-child {
            width: 160px;
        }
        .single-footer-item {
            flex-basis: 45%;
        }
    }

    @media (min-width: 300px) and (max-width: 500px) {
        .payment-flex-contents {
            flex-direction: column-reverse;
        }
        .invoice-total-count {
            margin-left: auto;
        }
    }

    @media (min-width: 300px) and (max-width: 420px) {
        .invoice-wrapper {
            box-shadow: none;
        }
        .terms-left-contents {
            flex-basis: 100%;
        }
        .products-item {
            width: 170px;
        }
    }
</style>
<div class="invoice-area">
    <div class="invoice-wrapper bg-white my-5">
        <div class="invoice-header">
            <div class="invoice-flex-contents">
                <div class="invoice-logo">
                    <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                </div>
                <div class="invoice-header-contents">
                    <h2 class="invoice-title"><?php echo e(__('INVOICE')); ?></h2>
                </div>
            </div>
        </div>
        <div class="invoice-details">
            <div class="invoice-details-flex">
                <div class="invoice-single-details">
                    <h4 class="invoice-details-title"><?php echo e(__('Bill To:')); ?></h4>
                    <ul class="details-list">
                        <li class="list"> <?php echo e($order_details->name); ?> </li>
                        <li class="list"> <a href="#"> <?php echo e($order_details->email); ?> </a> </li>
                        <li class="list"> <a href="#"> <?php echo e($order_details->phone); ?></a> </li>
                    </ul>
                </div>
                <?php if($user_shipping_address): ?>
                <div class="invoice-single-details" style="float:right">
                    <h4 class="invoice-details-title"><?php echo e(__('Ship To:')); ?></h4>
                    <ul class="details-list">
                        <li class="list"> <strong><?php echo e(__('Country')); ?>: </strong> <?php echo e(optional($user_shipping_address->country)->name); ?> </li>
                        <li class="list"> <strong><?php echo e(__('State')); ?>: </strong> <?php echo e(optional($user_shipping_address->state)->name); ?> </li>
                        <li class="list"> <strong><?php echo e(__('City')); ?>: </strong> <?php echo e(optional($user_shipping_address)->city); ?> </li>
                        <li class="list"> <strong><?php echo e(__('Zipcode')); ?>: </strong><?php echo e(optional($user_shipping_address)->zip_code); ?> </li>
                        <li class="list"> <strong><?php echo e(__('Address')); ?>: </strong> <?php echo e(optional($user_shipping_address)->address); ?> </li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="item-description">
            <h5 class="table-title"> <?php echo e(__('Order Details')); ?> </h5>
            <table class="custom--table">
                <thead>
                    <tr>
                        <th><?php echo e(__('Title')); ?></th>
                        <th><?php echo e(__('Unit Price')); ?></th>
                        <th><?php echo e(__('Quantity')); ?></th>
                        <th><?php echo e(__('Total')); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php $order_subtotal = 0; ?>
                <?php $__currentLoopData = $order_details->sale_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(!empty($products) ? optional($products->where("id",$sale->item_id)->first())->title
                            : optional($all_products->where("id",$sale->item_id)->first())->title); ?>

                            
                            <?php echo e(getItemAttributesName($sale->attributes)); ?>

                        </td>
                        <td><?php echo e(float_amount_with_currency_symbol(optional($sale)->price)); ?></td>
                        <td><?php echo e(optional($sale)->quantity); ?></td>
                        <td><?php echo e(float_amount_with_currency_symbol(optional($sale)->price * optional($sale)->quantity)); ?></td>
                        <?php $order_subtotal += optional($sale)->price * optional($sale)->quantity; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="table_footer_row">
                    <td colspan="3"><strong><?php echo e(__('Subtotal')); ?></strong></td>
                    <td><strong><?php echo e(float_amount_with_currency_symbol($order_subtotal)); ?></strong></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="item-description">
            <div class="table-responsive">
                <h5 class="table-title"><?php echo e(__('Orders Details')); ?></h5>
                <table class="custom--table">
                    <thead class="head-bg">
                        <tr>
                            <th><?php echo e(__('Buyer Details')); ?></th>
                            <th><?php echo e(__('Date & Schedule')); ?></th>
                            <th><?php echo e(__('Amount Details')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="data-span"> <?php echo e(__('Name: ')); ?></span><?php echo e($order_details->name); ?> <br>
                                <?php if(!empty($order_details->email)): ?>
                                <span class="data-span"> <?php echo e(__('Email: ')); ?></span><?php echo e($order_details->email); ?> <br>
                                <?php endif; ?>
                                <?php if(!empty($order_details->phone)): ?>
                                <span class="data-span"> <?php echo e(__('Phone: ')); ?></span><?php echo e($order_details->phone); ?> <br>
                                <?php endif; ?>
                                <?php if(!empty($order_details->address)): ?>
                                <span class="data-span"> <?php echo e(__('Address: ')); ?></span><?php echo e($order_details->address); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e($order_details->created_at->format('d/m/Y')); ?>

                            </td>
                            <td>
                                <?php $payment_details = json_decode($order_details->payment_meta, true); ?>

                                <span class="data-span"> <?php echo e(__('Sub Total:')); ?> </span><?php echo e(float_amount_with_currency_symbol($payment_details['subtotal'])); ?> <br>
                                <span class="data-span"> <?php echo e(__('Tax:')); ?> </span><?php echo e(float_amount_with_currency_symbol($payment_details['tax_amount'])); ?> <br>
                                <?php if(!empty($order_details->coupon)): ?>
                                    <span class="data-span"> <?php echo e(__('Coupon Amount:')); ?> </span><?php echo e(float_amount_with_currency_symbol($order_details->coupon_discounted, false)); ?>

                                    <br>
                                <?php endif; ?>
                                <?php if(!empty($payment_details['shipping_cost'])): ?>
                                    <span class="data-span"> <?php echo e(__('Shipping Cost:')); ?> </span><?php echo e(float_amount_with_currency_symbol($payment_details['shipping_cost'], false)); ?>

                                    <br>
                                <?php endif; ?>
                                <?php if(!empty($payment_details['total'])): ?>
                                    <span class="data-span"> <?php echo e(__('Total:')); ?> </span><?php echo e(float_amount_with_currency_symbol($payment_details['total'])); ?>

                                    <br>
                                <?php endif; ?>
                                <?php if($order_details->status): ?>
                                    <span class="data-span"> <?php echo e(__('Order Status:')); ?> </span><?php echo e(ucfirst($order_details->status)); ?>

                                    <br>
                                <?php endif; ?>
                                <?php if(!empty($order_details->payment_status)): ?>
                                    <span class="data-span"> <?php echo e(__('Payment Status:')); ?> </span><?php echo e(ucfirst($order_details->payment_status)); ?>

                                    <br>
                                <?php endif; ?>
                                <?php if(!empty($order_details->payment_gateway)): ?>
                                    <span class="data-span"> <?php echo e(__('Payment Gateway:')); ?> </span> <?php echo e(ucwords(str_replace("_", " ", render_payment_gateway_name($order_details->payment_gateway)))); ?>

                                    <br>
                                <?php endif; ?>
                                <?php if(!empty($order_details->transaction_id)): ?>
                                    <span class="data-span"> <?php echo e(__('Transaction ID:')); ?> </span><?php echo e(ucfirst($order_details->transaction_id)); ?>

                                    <br>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <footer class="mt-3">
            <?php echo get_footer_copyright_text(); ?>

        </footer>
    </div>
</div>
</body>
</html>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/products/order/invoice-partial.blade.php ENDPATH**/ ?>