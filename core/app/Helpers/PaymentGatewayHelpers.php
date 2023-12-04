<?php

namespace App\Helpers;

use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class PaymentGatewayHelpers
{
    public static function renderFrontendFormContent($cash_on_delivery = false)
    {
        $output = '<div class="payment-gateway-wrapper">';
        if (empty(get_static_option('site_payment_gateway'))) {
            return;
        }

        $all_gateway = array_merge( XgPaymentGateway::all_payment_gateway_list(),['cash_on_delivery','manual_payment','bank_transfer','cheque_payment']);

        $output .= '<input type="hidden" name="selected_payment_gateway" value="' . get_static_option('site_default_payment_gateway') . '">';
        $output .= '<ul>';

        // if (!empty(get_static_option('cash_on_delivery_gateway'))) {
        //     $output .= '<li data-gateway="cash_on_delivery" ><div class="img-select">';
        //     $output .= render_image_markup_by_attachment_id(get_static_option('cash_on_delivery_preview_logo'));
        //     $output .= '</div></li>';
        // }

        foreach ($all_gateway as $gateway) {
            if (!empty(get_static_option($gateway . '_gateway'))) :
                $class = (get_static_option('site_default_payment_gateway') == $gateway) ? 'class="selected"' : '';

                $output .= '<li data-gateway="' . $gateway . '" ' . $class . '><div class="img-select">';
                $output .= render_image_markup_by_attachment_id(get_static_option($gateway . '_preview_logo'));
                $output .= '</div></li>';
            endif;
        }

        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }
}