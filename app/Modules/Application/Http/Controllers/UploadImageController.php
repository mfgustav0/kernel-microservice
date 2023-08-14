<?php

namespace App\Modules\Application\Http\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Modules\Shared\Http\Controllers\BaseController;
use App\Modules\Application\Services\UploadImage\UploadImageShowService;
use App\Modules\Application\Services\UploadImage\UploadImageStoreService;
use App\Modules\Application\Http\Requests\UploadImage\UploadImageStoreRequest;

class UploadImageController extends BaseController
{
    public function store(UploadImageStoreRequest $request): JsonResponse
    {
        try {
            $service = new UploadImageStoreService;

            $response = $service->handle($request);

            return response()->json($response, JsonResponse::HTTP_CREATED);
        } catch(Throwable $e) {
            $htpp_code = $e->getCode() ?: JsonResponse::HTTP_INTERNAL_SERVER_ERROR;

            return response()->json(['message' => $e->getMessage()], $htpp_code);
        }
    }

    public function show(string $id): Response
    {
        $service = new UploadImageShowService;

        $response = $service->handle($id);

        return response()->file($response);
    }
}