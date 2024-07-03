<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Traits\Providers\HasRouteProvider;

class RouteServiceProvider extends ServiceProvider
{
     use HasRouteProvider;
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->loadAllRoutes();

        $this->registerRouteModelBindings();
    }

}