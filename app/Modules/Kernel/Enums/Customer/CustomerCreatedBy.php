<?php

namespace App\Modules\Kernel\Enums\Customer;

enum CustomerCreatedBy: string
{
    case App = 'app';
    case Api = 'api';
}