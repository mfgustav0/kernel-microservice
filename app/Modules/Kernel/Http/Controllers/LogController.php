<?php

namespace App\Modules\Kernel\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Modules\Kernel\Services\Logs\LogIndexService;
use App\Modules\Shared\Http\Controllers\BaseController;
use App\Modules\Kernel\Http\Requests\Log\LogIndexRequest;

class LogController extends BaseController
{
    public function __invoke(LogIndexRequest $request): JsonResponse
    {
        $service = new LogIndexService;

        $result = $service->handle($request);

        return response()->json($result, JsonResponse::HTTP_OK);
    }
}