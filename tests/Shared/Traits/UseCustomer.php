<?php

namespace Tests\Shared\Traits;

use App\Modules\Kernel\Models\Customer;

trait UseCustomer
{
    public function getHeadersCustomer(): array
    {
        $customer = Customer::factory()->create();

        return [
            'Authorization' => 'Bearer ' . $customer->secret,
            'Accept' => 'application/json'
        ];
    }
}