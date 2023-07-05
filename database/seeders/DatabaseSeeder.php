<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Kernel\UserSeeder;
use Database\Seeders\Kernel\CustomerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // CustomerSeeder::class,
            UserSeeder::class
        ]);
    }
}
