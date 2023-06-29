<?php
 
namespace App\Vendor\Http\Resources\Log;
 
use Illuminate\Http\Request;
use App\Vendor\Models\LogModel;
use Illuminate\Http\Resources\Json\ResourceCollection;
 
class LogCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(
                fn(LogModel $log) => [
                    'message' => $log->message,
                    'context' => $log->context,
                    'level' => $log->level_name,
                    'record_datetime' => $log->record_datetime,
                    'extra' => $log->extra,
                    'ip' => $log->remote_addr,
                    'date' => $log->created_at
                ]
            ),
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage()
        ];
    }
}