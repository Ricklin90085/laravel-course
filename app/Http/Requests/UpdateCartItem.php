<?php

namespace App\Http\Requests;

use App\Http\Requests\APIRequest;

class UpdateCartItem extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|integer|between:1,10'
        ];
    }

    public function messages()
    {
        return [
            'quantity.between' => '數量必須介於 :min 和 :max 之間'
        ];
    }
}
