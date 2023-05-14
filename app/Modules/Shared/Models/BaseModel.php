<?php

namespace App\Modules\Shared\Models;

use App\Modules\Shared\Traits\UuidIdentifier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use HasFactory, UuidIdentifier, SoftDeletes;
}