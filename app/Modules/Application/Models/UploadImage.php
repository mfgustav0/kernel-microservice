<?php

namespace App\Modules\Application\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Modules\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class UploadImage extends BaseModel
{
    protected $fillable = [
        'id',
        'path',
        'days_active',
        'customer_id'
    ];

    protected function realPath(): Attribute
    {
        return Attribute::make(
            get: function($value, array $attributes): string {
                $storage = Storage::disk(config('upload-file.image.storage'));

                return $storage->path($attributes['path']);
            }
        );
    }

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: function($value, array $attributes): bool {
                if($attributes['days_active'] == -999) {
                    return true;
                }

                $created = Carbon::create($attributes['created_at']);
                $cur_date = $created->diff(Carbon::now())->days;

                return $attributes['days_active'] > $cur_date;
            }
        );
    }

    protected static function newFactory(): Factory
    {
        return ImageFactory::new();
    }
}