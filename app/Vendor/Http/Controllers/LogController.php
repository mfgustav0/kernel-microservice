<?php

namespace App\Vendor\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Vendor\Services\Logs\LogIndexService;
use App\Vendor\Http\Requests\Log\LogIndexRequest;
use App\Modules\Shared\Http\Controllers\BaseController;

class LogController extends BaseController
{
    public function __invoke(LogIndexRequest $request): JsonResponse
    {
        $service = new LogIndexService;

        $result = $service->handle($request);

        return response()->json($result, JsonResponse::HTTP_OK);
    }
}