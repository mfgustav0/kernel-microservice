<?php

namespace Database\Seeders\Kernel;

use Illuminate\Database\Seeder;
use App\Modules\Kernel\Models\Customer;
use App\Modules\Kernel\Enums\Customer\CustomerCreatedBy;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if(!Customer::where('name', 'central')->first()) {
            Customer::create([
                'name' => 'central',
                'created_by' => CustomerCreatedBy::App
            ]);
        }
    }
}