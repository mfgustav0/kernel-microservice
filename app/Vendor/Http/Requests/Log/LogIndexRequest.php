<?php

namespace App\Vendor\Http\Requests\Log;

use Illuminate\Validation\Rule;
use App\Modules\Shared\Http\Requests\BaseRequest;

class LogIndexRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'integer'],
            'initial_date' => ['nullable', 'date'],
            'final_date' => ['nullable', 'date'],
            'level' => [
                'nullable',
                Rule::in([
                    'debug',
                    'info',
                    'notice',
                    'warning',
                    'error',
                    'critical',
                    'alert',
                    'emergency',
                ])
            ],
        ];
    }
}