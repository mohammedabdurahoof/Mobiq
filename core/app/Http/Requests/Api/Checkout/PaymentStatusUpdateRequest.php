<?php

namespace App\Http\Requests\Api\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStatusUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
//            "transaction_id" => "required",
            "order_id" => "required",
            "payment_status" => "sometimes"
        ];
    }
}
