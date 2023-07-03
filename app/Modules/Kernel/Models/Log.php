<?php

namespace App\Modules\Kernel\Models;

use App\Modules\Shared\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'message',
        'context',
        'level',
        'level_name',
        'channel',
        'record_datetime',
        'extra',
        'formatted',
        'remote_addr',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'record_datetime' => 'datetime',
        'created_at' => 'datetime',
        'context' => Json::class,
        'extra' => Json::class,
    ];
}