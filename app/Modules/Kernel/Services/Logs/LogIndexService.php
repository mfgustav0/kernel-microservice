<?php

namespace App\Modules\Kernel\Services\Logs;

use App\Modules\Kernel\Models\Log AS LogModel;
use App\Modules\Kernel\Http\Resources\Log\LogCollection;
use App\Modules\Kernel\Http\Requests\Log\LogIndexRequest;

class LogIndexService
{
    public function handle(LogIndexRequest $request): LogCollection
    {
        $model = LogModel::query()
            ->when($request->validated('initial_date'),
                fn($db, string $initial_date) => $db->where('created_at', '>=', $initial_date)
            )
            ->when($request->validated('final_date'),
                fn($db, string $final_date) => $db->where('created_at', '<=', $final_date)
            )
            ->when($request->validated('level'),
                fn($db, string $level) => $db->where('level_name', $level)
            );

        $per_page = $request->validated('per_page') > 0 ? $request->validated('per_page') : 15;
        
        return new LogCollection($model->paginate($per_page));
    }
}