<?php
 
namespace App\Modules\Application\Http\Resources\UploadImage;
 
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
 
class UploadImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'link' => route('application.upload-image.show', ['id' => $this->id]),
            'days_active' => $this->days_active,
            'created_at' => $this->created_at
        ];
    }
}