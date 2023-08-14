<?php

namespace App\Modules\Application\Services\UploadImage;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Modules\Application\Models\UploadImage;
use App\Modules\Application\Http\Resources\UploadImage\UploadImageResource;
use App\Modules\Application\Http\Requests\UploadImage\UploadImageStoreRequest;

class UploadImageStoreService
{
    public function handle(UploadImageStoreRequest $request): UploadImageResource
    {
        $upload = UploadImage::create([
            'path' => $this->createImage($request->validated('image')),
            'days_active' => $request->validated('days_active') ?: 1,
            'customer_id' => auth('customer')->user()->id
        ]);

        return new UploadImageResource($upload);
    }

    private function createImage(UploadedFile $file): string
    {
        $name = str()->random(10) . '-' . time();

        $path = Storage::disk(config('upload-file.image.storage'))->putFileAs(
            'images/' . date('Y-m-d'), $file, "{$name}.{$file->extension()}"
        );
        return $path;
    }
}