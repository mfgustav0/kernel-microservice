<?php

namespace App\Modules\Application\Services\UploadImage;

use App\Modules\Application\Models\UploadImage;
use App\Modules\Shared\Exceptions\ResourceNotFound;

class UploadImageShowService
{
    public function handle(string $id): string
    {
        $upload = UploadImage::find($id);
        if(!$upload || !$upload->isActive) {
            throw new ResourceNotFound;
        }

        return $upload->realPath;
    }
}