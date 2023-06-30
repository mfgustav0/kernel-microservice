<?php

namespace App\Modules\Kernel\Models\Concerns;

use Illuminate\Support\Str;

trait GenerateSecret
{
    protected static function boot() {
        parent::boot();
    
        static::creating(function($model) {
            $model->secret = (string) Str::ulid();
        });
    }
}
