<?php

namespace App\Modules\Application\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Modules\Shared\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index(): JsonResponse
    {
        return response()->json([
            'version' => app()->version(),
            'today' => Carbon::today()->format('Y-m-d')
        ], 200);
    }
}