<?php

namespace App\Vendor\Logging\MySQL;

use Monolog\LogRecord;
use App\Vendor\Models\LogModel;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\AbstractProcessingHandler;

class MySQLLoggingHandler extends AbstractProcessingHandler
{
    protected function write(LogRecord $record): void
    {
        LogModel::create([
            'message'         => $record->message,
            'context'         => $record->context,
            'level'           => $record->level->value,
            'level_name'      => str($record->level->name)->lower(),
            'channel'         => $record->channel,
            'record_datetime' => $record->datetime->format('Y-m-d H:i:s'),
            'extra'           => $record->extra,
            'formatted'       => $record->formatted,
            'remote_addr'     => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent'      => $_SERVER['HTTP_USER_AGENT'] ?? null,
            'created_at'      => date('Y-m-d H:i:s'),
        ]);
    }
}