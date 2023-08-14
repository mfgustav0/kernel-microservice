<?php

namespace App\Modules\Application\Http\Requests\UploadImage;

use App\Modules\Shared\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\File;

class UploadImageStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'days_active' => [
                'nullable',
                'integer'
            ],
            'image' => [
                'required',
                File::image()->max(50000)
            ],
        ];
    }
}