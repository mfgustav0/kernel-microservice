<?php

namespace App\Modules\Kernel\Models;

use App\Modules\Shared\Models\BaseModel;
use Database\Factories\Kernel\CustomerFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\Kernel\Models\Concerns\GenerateSecret;
use App\Modules\Kernel\Enums\Customer\CustomerCreatedBy;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Customer extends BaseModel implements Authenticatable
{
    use AuthenticableTrait;
    use GenerateSecret;

    protected $fillable = [
        'id',
        'name',
        'secret',
        'created_by'
    ];

    protected $casts = [
        'created_by' => CustomerCreatedBy::class
    ];

    protected static function newFactory(): Factory
    {
        return CustomerFactory::new();
    }
}