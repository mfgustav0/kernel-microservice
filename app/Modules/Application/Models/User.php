<?php

namespace App\Modules\Application\Models;

use App\Modules\Shared\Models\BaseModel;
use Illuminate\Contracts\Auth\Authenticatable;
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
}