<?php

declare(strict_types=1);

namespace App\Modules\Shared\Http\Requests;

use Illuminate\Http\JsonResponse;
use App\Vendor\Http\Requests\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator,
            response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()->messages(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
    
    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedAuthorization()
    {        
        throw new HttpResponseException(
            response()->json(['message' => 'This action is unauthorized.'], JsonResponse::HTTP_UNAUTHORIZED)
        );
    }

}