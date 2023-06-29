<?php

namespace App\Vendor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(
        protected Auth $auth
    ) { }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string|null $guard = null): mixed
    {
        if ($this->auth->guard($guard)->guest()) {
            return response(['message' => 'Unauthorized.'], 401);
        }

        return $next($request);
    }
}
