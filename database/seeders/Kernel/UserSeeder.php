<?php

namespace Database\Seeders\Kernel;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use App\Modules\Kernel\Models\User;
use Illuminate\Support\Facades\Crypt;

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