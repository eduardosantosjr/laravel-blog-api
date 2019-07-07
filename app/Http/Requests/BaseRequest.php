<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(
            [
                'status' => 'fail',
                'data'   => $validator->errors()
            ],
            422
        );

        throw new ValidationException($validator, $response);
    }
}
