<?php

namespace App\Modules\Kernel\Models;

use App\Modules\Shared\Models\BaseModel;
use Database\Factories\Kernel\UserFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends BaseModel implements Authenticatable
{
    use AuthenticableTrait;

    protected $fillable = [
        'id',
        'name',
        'is_admin',
        'token',
    ];

    protected $casts = [
        'is_admin' => 'boolean'
    ];

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}