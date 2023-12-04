<!doctype html>
<html lang="en">
<?php
    $default_lang = get_default_language();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(get_static_option('site_title').' '. __('Mail')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Open Sans', sans-serif;
        }
        .mail-container {
            max-width: 650px;
            margin: 0 auto;
            text-align: center;
            background-color: #f2f2f2;
            padding: 40px 0;
        }
        .inner-wrap {
            background-color: #fff;
            margin: 40px;
            padding: 30px 20px;
            text-align: left;
            box-shadow: 0 0 20px 0 rgba(0,0,0,0.01);
        }
        .inner-wrap p {
        font-size: 16px;
            line-height: 26px;
            color: #656565;
            margin: 0;
        }
        .message-wrap {
            background-color: #f2f2f2;
            padding: 30px;
            margin-top: 40px;
        }

        .message-wrap p {
            font-size: 14px;
            line-height: 26px;
        }
        .btn-wrap {
            text-align: center;
        }

        .btn-wrap .anchor-btn {
            background-color: <?php echo e(get_static_option('site_color')); ?>;
            color: #fff;
            font-size: 14px;
            line-height: 26px;
            font-weight: 500;
            text-transform: capitalize;
            text-decoration: none;
            padding: 8px 20px;
            display: inline-block;
            margin-top: 40px;
            border-radius: 5px;
            transition: all 300ms;
        }

        .btn-wrap .anchor-btn:hover {
            opacity: .8;
        }
        .verify-code{
            background-color:#f2f2f2;
            color:#333;
            padding: 10px 15px;
            border-radius: 3px;
            display: inline-block;
            margin: 20px;
        }
        table {
            margin: 0 auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #111d5c;
            color: white;
        }
        .logo-wrapper img{
            max-width: 200px;
        }
    </style>
</head>
<body>
    <div class="mail-container">
        <div class="logo-wrapper">
            <a href="<?php echo e(url('/')); ?>">
                <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

            </a>
        </div>
        <div class="inner-wrap">
            <?php echo $mail_message; ?>

            
            <div class="product-table-wrap">
                <h3 class="mb-3"><?php echo e(__('Ordered Products')); ?></h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo e(__('Name')); ?></th>
                            <th><?php echo e(__('Quantity')); ?></th>
                            <th><?php echo e(__('Price')); ?></th>
                            <th><?php echo e(__('Total')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php $__currentLoopData = $order_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e($cart_item['name'] ?? __('untitled')); ?> <?php echo e(getItemAttributesName($cart_item['attributes'])); ?>

                                </td>
                                <td><?php echo e($cart_item['quantity'] ?? 0); ?></td>
                                <?php
                                    $price = $cart_item['attributes']['price'] ?? 0;
                                ?>
                                <td><?php echo e(float_amount_with_currency_symbol($price)); ?></td>
                                <td>
                                    <?php echo e(float_amount_with_currency_symbol($cart_item['quantity'] * $price)); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="table-wrap">
                <h3 class="mb-3"><?php echo e(__('Order Summary')); ?></h3>
                <?php
                    $payment_meta = json_decode($data->payment_meta,true);
                ?>
                <table class="table table-bordered">
                    <tbody>
                        <?php if($data->coupon): ?>
                            <tr>
                                <th><?php echo e(__('Coupon')); ?></th>
                                <td><?php echo e(float_amount_with_currency_symbol($data->coupon)); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if($data->coupon_discounted): ?>
                            <tr>
                                <th><?php echo e(__('Coupon Discount')); ?></th>
                                <td><?php echo e(float_amount_with_currency_symbol($data->coupon_discounted)); ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th><?php echo e(__('Tax')); ?></th>
                            <td>(+) <?php echo e(float_amount_with_currency_symbol($payment_meta['tax_amount'])); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('Shipping cost')); ?></th>
                            <td>(+) <?php echo e(float_amount_with_currency_symbol($payment_meta['shipping_cost'])); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('Total Amount')); ?></th>
                            <td><?php echo e(float_amount_with_currency_symbol($data->total_amount)); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <footer>
            <?php echo get_footer_copyright_text(); ?>

        </footer>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\mobiq\core\resources\views/mail/order.blade.php ENDPATH**/ ?>