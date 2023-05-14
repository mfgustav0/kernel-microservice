<?php

namespace App\Modules\Vendor\Providers;

use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // $this->app->make(\Illuminate\Contracts\Console\Kernel::class)
        //     ->loadAliasCommands([
        //         'path' => base_path('app/Modules/Application/Console')
        //     ]);
    }
}