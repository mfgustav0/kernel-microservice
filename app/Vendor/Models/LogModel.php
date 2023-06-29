<?php

namespace App\Vendor\Models;

use App\Shared\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    protected $table = 'logs';

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
        'context' => 'object',
        'extra' => 'object',
    ];
}