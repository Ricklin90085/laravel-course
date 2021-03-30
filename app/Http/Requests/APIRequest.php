<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class APIRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        // PHP 的 throw error 要使用 Exception 這個 CLass (或是繼承他的) 才可以
        throw new HttpResponseException(response([
            'errors' => $validator->errors()
        ], 400));
    }
}
