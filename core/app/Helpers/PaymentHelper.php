<?php

namespace App\Helpers;

use App\Action\CheckoutAction;
use App\Events\ProductOrdered;
use Illuminate\Support\Str;
use Modules\Product\Entities\ProductSellInfo;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;
use App\Helpers\PaymentGatewayRequestHelper;

class PaymentHelper
{
    const SUCCESS_ROUTE = 'frontend.products.payment.success';
    const CANCEL_ROUTE = 'frontend.products.payment.cancel';

    private function getTitle($product_payment_info)
    {
        return 'Payment For Event Order Id: #' . $product_payment_info->id;
    }

    private function getDescription($product_payment_info)
    {
        return 'Payment For Order Id: #' . $product_payment_info->id . ' Payer Name: ' . $product_payment_info->name . ' Payer Email:' . $product_payment_info->email;
    }

    private static function formatPaymentInfo($product_payment_info, $ipn) : array
    {
        $description = __('Payment For Order Id: #') . $product_payment_info->id . ' '
            . __('Package Name:') . ' ' . $product_payment_info->package_name . ' '
            . __('Payer Name:') . ' ' . $product_payment_info->name . ' '
            . __('Payer Email:') . ' ' . $product_payment_info->email;

        return [
            'title' => __('Payment for order'),
            'name' => $product_payment_info->name, // user's name
            'email' => $product_payment_info->email, // user's email
            'description' => $description,
            'amount' => $product_payment_info->total_amount,
            'order_id' => $product_payment_info->id,
            'track' => $product_payment_info->payment_track,
            'payment_type' => 'order', // which kind of payment you are receiving
            'ipn_url' => $ipn,
            'success_url' => route(self::SUCCESS_ROUTE, Str::random(6) . $product_payment_info->id . Str::random(6)),
            'cancel_url' => route(self::CANCEL_ROUTE, Str::random(6) . $product_payment_info->id . Str::random(6)),
        ];
    }

    public static function chargeCustomer($product_payment_info, $request)
    {
        $instance = new static();

        $allowed_payment_methods = [
            'paypal',
            'paytm',
            'mollie',
            'stripe',
            'razorpay',
            'flutterwave',
            'paystack',
            'midtrans',
            'payfast',
            'cashfree',
            'instamojo',
            'marcadopago',
        ];

        if (in_array($product_payment_info->payment_gateway, $allowed_payment_methods)) {
            $type = $product_payment_info->payment_gateway;

            if ($type === 'paypal') {
                session()->put('order_id', $product_payment_info->id);
            }
                if($type=='paytm'){
                    
                
                 $data = [
            "merchantId"=> "MOBIQONLINE",
            'order_id'=>$product_payment_info->id,
            "merchantTransactionId"=> \Str::random(10),
            "merchantUserId"=> "MUID54123",
            "amount"=> (int)$product_payment_info->total_amount*100,
            "redirectUrl"=> route("frontend.products.$type.ipn"),
            "redirectMode"=> "POST",
            "callbackUrl"=>route("frontend.products.$type.ipn"),
            "mobileNumber"=> $product_payment_info->phone,
            "paymentInstrument"=> [           
            "type"=> "PAY_PAGE"
                   ]
            ];
          $encode = base64_encode(json_encode($data));
          $saltkey = '90336025-0952-4d3d-acc5-76f95fd665e0';
          $saltindex = 1;
          $string = $encode.'/pg/v1/pay'.$saltkey;
          $sha256 = hash('sha256',$string);
          $finalXHeader = $sha256.'###'.$saltindex;
       
                    $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",// your preferred url
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode(['request'=> $encode]),
                    CURLOPT_HTTPHEADER => array(
                        // Set here requred headers
                        "accept: */*",
                        "accept-language: en-US,en;q=0.8",
                        "Content-Type:application/json",
                        'X-VERIFY:'.$finalXHeader
                    ),
                ));

                    $response = curl_exec($curl);
                    $rData = json_decode($response);
                   \Session::put('order_id',$product_payment_info->id);
                    return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
                }
            return PaymentGatewayRequestHelper::$type()->charge_customer(
                (new self)->formatPaymentInfo($product_payment_info, route("frontend.products.$type.ipn"))
            );
        }elseif ($product_payment_info->payment_gateway === 'cash_on_delivery') {
            event(new ProductOrdered([
                'order_id' => $product_payment_info->id,
            ]));

            $order_id = Str::random(6) . $product_payment_info->id . Str::random(6);

            return redirect()->route(self::SUCCESS_ROUTE, $order_id);
        }elseif ($product_payment_info->payment_gateway === 'manual_payment') {
            event(new ProductOrdered([
                'order_id' => $product_payment_info->id,
                'transaction_id' => $product_payment_info->transaction_id,
            ]));

            $order_id = Str::random(6) . $product_payment_info->id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE, $order_id);
        }elseif ($product_payment_info->payment_gateway == 'bank_transfer') {

            event(new ProductOrdered([
                'order_id' => $product_payment_info->id,
                'transaction_id' => $product_payment_info->transaction_id,
            ]));

            $upload_link = CheckoutAction::uploadCheckoutImage($request, 'bank');

            if ($upload_link) {
                $product_payment_info->checkout_image_path = $upload_link;
                $product_payment_info->save();
            }
            $order_id = Str::random(6) . $product_payment_info->id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE, $order_id);
        } elseif ($product_payment_info->payment_gateway == 'cheque_payment') {
            event(new ProductOrdered([
                'order_id' => $product_payment_info->id,
                'transaction_id' => $product_payment_info->transaction_id,
            ]));
            $upload_link = CheckoutAction::uploadCheckoutImage($request, 'cheque');
            if ($upload_link) {
                $product_payment_info->checkout_image_path = $upload_link;
                $product_payment_info->save();
            }
            $order_id = Str::random(6) . $product_payment_info->id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE, $order_id);
        }

        return redirect()->route('homepage');
    }
}
