<?php

namespace Tests\Shared\Traits;

use App\Modules\Application\Models\User;

trait UseAdmin
{    
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function getHeaders(bool $is_admin=false): array
    {
        $admin = User::factory()->create(compact('is_admin'));

        return [
            'Authorization' => 'Bearer ' . $admin->token,
            'Accept' => 'application/json'
        ];
    }
}