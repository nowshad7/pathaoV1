<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OrderCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'merchant_order_id'  => 'nullable|string|max:10',
            'recipient_name'     => 'required|string|min:5|max:15',
            'recipient_phone'    => [
                'required',
                'string',
                'min:11',
                'max:13',
                'regex:/^(01)[3-9]{1}[0-9]{8}$/'
            ],
            'recipient_address'  => 'required|string|min:3|max:20',
            'item_quantity'      => 'required|integer|max:20',
            'item_weight'        => 'required|numeric',
            'amount_to_collect'  => 'required|integer',
            'item_descriptions'  => 'required|string|max:100',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation errors',
            'errors'  => $validator->errors(),
            'data'    => null,
            'code'    => 422,
        ]));
    }
}
