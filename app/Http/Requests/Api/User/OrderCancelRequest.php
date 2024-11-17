<?php

namespace App\Http\Requests\Api\User;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class OrderCancelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order_id' => [
                'required',
                Rule::exists('orders', 'id')->where(function ($query) {
                    $query->where('created_by', auth()->user()->id);
                }),
            ],
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
