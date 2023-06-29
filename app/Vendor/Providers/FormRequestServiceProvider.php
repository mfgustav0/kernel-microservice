<?php

declare(strict_types=1);

namespace App\Vendor\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use App\Vendor\Http\Requests\FormRequest;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

class FormRequestServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->resolving(FormRequest::class, function(Request $request, $app) {
            $request = FormRequest::createFrom($app['request'], $request);

            $request->setContainer($app);
        });

        $this->app->afterResolving(ValidatesWhenResolved::class, function($resolved) {
            $resolved->validateResolved();
        });
    }
}