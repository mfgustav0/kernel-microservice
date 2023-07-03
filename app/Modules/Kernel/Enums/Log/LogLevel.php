<?php

namespace App\Modules\Kernel\Enums\Log;

use App\Modules\Shared\Enums\BaseEnum;

enum LogLevel: string
{
    use BaseEnum;

    case Debug = 'debug';
    case Info = 'info';
    case Notice = 'notice';
    case Warning = 'warning';
    case Error = 'error';
    case Critical = 'critical';
    case Alert = 'alert';
    case Emergency = 'emergency';
}