<?php

namespace App\Vendor\Providers;

use App\Modules\Kernel\Models\User;
use App\Modules\Kernel\Models\Customer;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app['auth']->viaRequest('api', function ($request, $guard) {
            $token = '';
            if ($request->hasHeader('Authorization')) {
                $bearer = str($request->header('Authorization'));

                if($bearer->startsWith('Bearer ')) {
                    $bearer = $bearer->substr(7);
                }

                $token = (string)$bearer;
            }

            return User::where('token', $token)->first();
        });

        $this->app['auth']->viaRequest('token', function ($request) {
            $token = '';
            if ($request->hasHeader('Authorization')) {
                $bearer = str($request->header('Authorization'));

                if($bearer->startsWith('Bearer ')) {
                    $bearer = $bearer->substr(7);
                }

                $token = (string)$bearer;
            }

            return Customer::where('secret', $token)->first();
        });
    }
}