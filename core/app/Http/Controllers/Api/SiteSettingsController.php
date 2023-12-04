<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\StaticOption;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    public function payment_gateway_list(Request $request)
    {
        if ($request->header("x-api-key") !== "b8f4a0ba4537ad6c3ee41ec0a43549d1") {
            return response()->json(["error" => "Unauthenticated."], 401);
        }

        $list = [];

        $gateway_list = [
            'cash_on_delivery',
            'paypal',
            'manual_payment',
            'mollie',
            'paytm',
            'stripe',
            'razorpay',
            'flutterwave',
            'paystack',
            'marcadopago',
            'instamojo',
            'cashfree',
            'payfast',
            'midtrans',
            'bank_payment',
            'cheque_payment',
        ];

        // implemented payment gateways in mobile app:  Paypal, cashmere, flutter wave, instamojo, mercado, paystack, razor pay, stripe, bank transfer, cash on delivery


        foreach($gateway_list as $glist ){
            switch($glist){
                case("paypal"):

                    if(!empty(get_static_option('paypal_gateway'))){

                        $paypal_mode = get_static_option('paypal_test_mode');
                        $paypal_img_url = null;
                        $paypal_img_details = get_attachment_image_by_id(get_static_option('paypal_preview_logo'), 'full');
                        $paypal_img_url =  $paypal_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "paypal",
                            "test_mode" => (bool) !empty($paypal_mode),
                            "logo_link" => $paypal_img_url,
                            "app_id" => !empty($paypal_mode) ? get_static_option('paypal_sandbox_app_id') : get_static_option('paypal_live_app_id'),
                            "client_id" => !empty($paypal_mode) ? get_static_option('paypal_sandbox_client_id') : get_static_option('paypal_live_client_id'),
                            "secret_id" => !empty($paypal_mode) ? get_static_option('paypal_sandbox_client_secret') : get_static_option('paypal_live_client_secret')
                        ];
                    }

                    break;
                case("manual_payment"):
                    if(!empty(get_static_option('manual_payment_gateway'))){

                        $manual_payment_url = null;
                        $manual_payment_details = get_attachment_image_by_id(get_static_option('manual_payment_preview_logo'), 'full');
                        $manual_payment_url =  $manual_payment_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "manual_payment",
                            "test_mode" => false,
                            "logo_link" => $manual_payment_url
                        ];
                    }
                    break;
                case("cheque_payment"):

                    if(!empty(get_static_option('cheque_payment_gateway'))){
                        $cheque_payment_url = null;
                        $cheque_payment_details = get_attachment_image_by_id(get_static_option('cheque_payment_preview_logo'), 'full');
                        $cheque_payment_url =  $cheque_payment_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "cheque_payment",
                            "test_mode" => false,
                            "logo_link" => $cheque_payment_url
                        ];
                    }
                    break;
                case("bank_payment"):

                    if(!empty(get_static_option('bank_transfer_gateway'))){

                        $bank_payment_url = null;
                        $bank_payment_details = get_attachment_image_by_id(get_static_option('bank_transfer_preview_logo'), 'full');
                        $bank_payment_url =  $bank_payment_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "bank_transfer",
                            "test_mode" => false,
                            "logo_link" => $bank_payment_url
                        ];
                    }
                    break;
                case("cash_on_delivery"):
                    if(!empty(get_static_option('cash_on_delivery_gateway'))){

                        $cash_on_deliery_payment_url = null;
                        $cash_on_deliery_payment_details = get_attachment_image_by_id(get_static_option('cash_on_delivery_preview_logo'), 'full');
                        $cash_on_deliery_payment_url =  $cash_on_deliery_payment_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "cash_on_delivery",
                            "test_mode" => false,
                            "logo_link" => $cash_on_deliery_payment_url
                        ];
                    }
                    break;
                case("mollie"):
                    if(!empty(get_static_option('mollie_gateway'))){

                        $mollie_mode = get_static_option('mollie_test_mode');
                        $mollie_img_url = null;
                        $mollie_img_details = get_attachment_image_by_id(get_static_option('mollie_preview_logo'), 'full');
                        $mollie_img_url =  $mollie_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "mollie",
                            "test_mode" => (bool) !empty($mollie_mode),
                            "logo_link" => $mollie_img_url,
                            "public_key" => get_static_option('mollie_public_key')
                        ];
                    }
                    break;
                case("paytm"):
                    if(!empty(get_static_option('paytm_gateway'))){

                        $paytm_mode = get_static_option('paytm_test_mode');
                        $paytm_img_url = null;
                        $paytm_img_details = get_attachment_image_by_id(get_static_option('paytm_preview_logo'), 'full');
                        $paytm_img_url =  $paytm_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "paytm",
                            "test_mode" => (bool) !empty($paytm_mode),
                            "logo_link" => $paytm_img_url,
                            "merchant_key" => get_static_option('paytm_merchant_key'),
                            "merchant_mid" => get_static_option('paytm_merchant_mid'),
                            "merchant_website" => get_static_option('paytm_merchant_website'),
                            "channel" =>  get_static_option('paytm_channel'),
                            "industry_type" => get_static_option('paytm_industry_type')
                        ];
                    }
                    break;
                case("stripe"):
                    if(!empty(get_static_option('stripe_gateway'))){

                        $stripe_mode = get_static_option('stripe_test_mode');
                        $stripe_img_url = null;
                        $stripe_img_details = get_attachment_image_by_id(get_static_option('stripe_preview_logo'), 'full');
                        $stripe_img_url =  $stripe_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "stripe",
                            "test_mode" => (bool) !empty($stripe_mode),
                            "logo_link" => $stripe_img_url,
                            "public_key" => get_static_option('stripe_public_key'),
                            "secret_key" => get_static_option('stripe_secret_key')
                        ];
                    }
                    break;
                case("razorpay"):
                    if(!empty(get_static_option('razorpay_gateway'))){

                        $razorpay_mode = get_static_option('razorpay_test_mode');
                        $razorpay_img_url = null;
                        $razorpay_img_details = get_attachment_image_by_id(get_static_option('razorpay_preview_logo'), 'full');
                        $razorpay_img_url =  $razorpay_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "razorpay",
                            "test_mode" => (bool) !empty($razorpay_mode),
                            "logo_link" => $razorpay_img_url,
                            "api_key" => get_static_option('razorpay_api_key'),
                            "api_secret" => get_static_option('razorpay_api_secret')
                        ];
                    }
                    break;
                case("flutterwave"):
                    if(!empty(get_static_option('flutterwave_gateway'))){

                        $flutterwave_mode = get_static_option('flutterwave_test_mode');
                        $flutterwave_img_url = null;
                        $flutterwave_img_details = get_attachment_image_by_id(get_static_option('flutterwave_preview_logo'), 'full');
                        $flutterwave_img_url =  $flutterwave_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "flutterwave",
                            "test_mode" => (bool) !empty($flutterwave_mode),
                            "logo_link" => $flutterwave_img_url,
                            "public_key" => get_static_option('flw_public_key'),
                            "secret_key" => get_static_option('flw_secret_key'),
                            "secret_hash" => get_static_option('flw_secret_hash')
                        ];
                    }
                    break;
                case("paystack"):
                    if(!empty(get_static_option('paystack_gateway'))){

                        $paystack_mode = get_static_option('paystack_test_mode');
                        $paystack_img_url = null;
                        $paystack_img_details = get_attachment_image_by_id(get_static_option('paystack_preview_logo'), 'full');
                        $paystack_img_url =  $paystack_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "paystack",
                            "test_mode" => (bool) !empty($paystack_mode),
                            "logo_link" => $paystack_img_url,
                            "public_key" => get_static_option('paystack_public_key'),
                            "secret_key" => get_static_option('paystack_secret_key'),
                            "merchant_email" => get_static_option('paystack_merchant_email')
                        ];
                    }
                    break;
                case("marcadopago"):
                    if(!empty(get_static_option('marcadopago_gateway'))){

                        $marcadopago_mode = get_static_option('marcadopago_test_mode');
                        $marcadopago_img_url = null;
                        $marcadopago_img_details = get_attachment_image_by_id(get_static_option('marcadopago_preview_logo'), 'full');
                        $marcadopago_img_url =  $marcadopago_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "marcadopago",
                            "test_mode" => (bool) !empty($marcadopago_mode),
                            "logo_link" => $marcadopago_img_url,
                            "client_id" => get_static_option('marcado_pago_client_id'),
                            "client_secret" => get_static_option('marcado_pago_client_secret'),
                        ];
                    }
                    break;
                case("instamojo"):
                    if(!empty(get_static_option('instamojo_gateway'))){

                        $instamojo_mode = get_static_option('instamojo_test_mode');
                        $instamojo_img_url = null;
                        $instamojo_img_details = get_attachment_image_by_id(get_static_option('instamojo_preview_logo'), 'full');
                        $instamojo_img_url =  $instamojo_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "instamojo",
                            "test_mode" => (bool) !empty($instamojo_mode),
                            "logo_link" => $instamojo_img_url,
                            "client_id" => get_static_option('instamojo_client_id'),
                            "client_secret" => get_static_option('instamojo_client_secret'),
                            "username" => get_static_option('instamojo_username'),
                            "password" => get_static_option('instamojo_password'),
                            "auth_token" => get_static_option('instamojo_auth_token'),
                        ];
                    }
                    break;
                case("cashfree"):
                    if(!empty(get_static_option('cashfree_gateway'))){

                        $cashfree_mode = get_static_option('cashfree_test_mode');
                        $cashfree_img_url = null;
                        $cashfree_img_details = get_attachment_image_by_id(get_static_option('cashfree_preview_logo'), 'full');
                        $cashfree_img_url =  $cashfree_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "cashfree",
                            "test_mode" => (bool) !empty($cashfree_mode),
                            "logo_link" => $cashfree_img_url,
                            "app_id" => get_static_option('cashfree_app_id'),
                            "secret_key" => get_static_option('cashfree_secret_key')
                        ];
                    }
                    break;
                case("payfast"):
                    if(!empty(get_static_option('payfast_gateway'))){

                        $payfast_mode = get_static_option('payfast_test_mode');
                        $payfast_img_url = null;
                        $payfast_img_details = get_attachment_image_by_id(get_static_option('payfast_preview_logo'), 'full');
                        $payfast_img_url =  $payfast_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "payfast",
                            "test_mode" => (bool) !empty($payfast_mode),
                            "logo_link" => $payfast_img_url,
                            "merchant_id" => get_static_option('payfast_merchant_id'),
                            "merchant_key" => get_static_option('payfast_merchant_key'),
                            "passphrase" => get_static_option('payfast_passphrase')
                        ];
                    }
                    break;
                case("midtrans"):
                    if(!empty(get_static_option('midtrans_gateway'))){

                        $midtrans_mode = get_static_option('midtrans_test_mode');
                        $midtrans_img_url = null;
                        $midtrans_img_details = get_attachment_image_by_id(get_static_option('midtrans_preview_logo'), 'full');
                        $midtrans_img_url =  $midtrans_img_details['img_url'] ?? null;

                        $list[] = [
                            "name" => "midtrans",
                            "test_mode" => (bool) !empty($midtrans_mode),
                            "logo_link" => $midtrans_img_url,
                            "merchant_id" => get_static_option('midtrans_merchant_id'),
                            "server_key" => get_static_option('midtrans_server_key'),
                            "client_key" => get_static_option('midtrans_client_key')
                        ];
                    }
                    break;
                default:
                    break;
            }

        }

        if(!empty($list)){
            return response()->json([
                'gateway_list'=> $list,
            ]);
        }

        return response()->json([
            'gateway_list'=> [],
        ])->setStatusCode(422);
    }
}
