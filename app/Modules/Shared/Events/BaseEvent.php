<?php

namespace App\Modules\Shared\Events;

use Illuminate\Queue\SerializesModels;

abstract class BaseEvent
{
    use SerializesModels;
}
