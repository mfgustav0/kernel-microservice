<?php

namespace App\Modules\Vendor\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Application\Models\User;

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

            $found = User::where('token', $token)->first();
            if ($found) {
                return $found;
            }
        });
    }
}