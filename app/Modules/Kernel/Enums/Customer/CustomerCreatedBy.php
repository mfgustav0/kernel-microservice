<?php

namespace App\Modules\Kernel\Enums\Customer;

use App\Modules\Shared\Enums\BaseEnum;

enum CustomerCreatedBy: string
{
    use BaseEnum;

    case App = 'app';
    case Api = 'api';
}