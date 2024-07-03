<?php

namespace App\Traits\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;

trait HasRouteProvider
{

      /**
     * Load API and Web routes based on configuration.
     *
     * @return void
     */
    private function loadAllRoutes()
    {
        $this->routes(function () {
            // Load route configurations
            $routeConfigs = config('routes');

            // Load API routes
            foreach ($routeConfigs['api'] as $route) {
                Route::middleware($route['middleware'])
                    ->prefix($route['prefix'] ?? '')
                    ->group(base_path($route['path']));
            }

            // Load Web routes
            foreach ($routeConfigs['web'] as $route) {
                Route::middleware($route['middleware'])
                    ->group(base_path($route['path']));
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

        /**
     * Register dynamic route model bindings based on configuration.
     *
     * @return void
     */
    protected function registerRouteModelBindings()
    {
        $bindings = config('routeBindings');

        foreach ($bindings as $param => $options) {
            Route::bind($param, function ($value, $route) use ($options) {
                $modelClass = $options['model'];
                $column = $options['column'];
                return $modelClass::where($column, $value)->firstOrFail();
            });
        }
    }
}