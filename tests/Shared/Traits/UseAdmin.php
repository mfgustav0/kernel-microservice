<?php

namespace Tests\Shared\Traits;

use App\Modules\Application\Models\User;

trait UseAdmin
{
    public function getHeaders(): array
    {
        $admin = User::where('is_admin', true)->first();

        return [
            'Authorization' => 'Bearer ' . $admin->token,
            'Accept' => 'application/json'
        ];
    }
}