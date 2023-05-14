<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Application\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if(!User::where('is_admin', true)->first()) {
            User::create([
            	'id' => Uuid::uuid4()->toString(),
                'name' => 'admin',
                'is_admin' => true,
                'token' => Crypt::encrypt('admin-secrect')
            ]);
        }

        if(!User::where('is_admin', false)->first()) {
            User::create([
            	'id' => Uuid::uuid4()->toString(),
                'name' => 'client',
                'is_admin' => false,
                'token' => Crypt::encrypt('client-secrect')
            ]);
        }
    }
}