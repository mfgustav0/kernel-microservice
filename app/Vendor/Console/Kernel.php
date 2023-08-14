<?php

namespace App\Vendor\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;
use App\Vendor\Console\Commands\KeyGenerateCommand;
use App\Modules\Kernel\Commands\CreateCustomerCommand;
use App\Modules\Application\Commands\ClearUploadImageCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        KeyGenerateCommand::class,
        ClearUploadImageCommand::class,
        CreateCustomerCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
