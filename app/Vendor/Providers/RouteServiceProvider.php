<?php

namespace App\Vendor\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureRateLimiting();
        $this->configureRoutes();
    }

    /**
     * Configure the routes for the application.
     *
     * @return void
     */
    protected function configureRoutes(): void
    {
        $this->app->router->group([
            'namespace' => 'App\Vendor\Http\Controllers',
        ], function ($router) {
            require base_path('/routes/kernel.php');
        });

        $this->app->router->group([
            'namespace' => 'App\Modules\Application\Http\Controllers',
        ], function ($router) {
            require base_path('/routes/application.php');
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(config('ratelimit.api'))->by($request->user()?->id ?: $request->ip());
        });
    }
}
