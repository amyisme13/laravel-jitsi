<?php

namespace Amyisme13\LaravelJitsi;

use Amyisme13\LaravelJitsi\Http\Controllers\ViewRoomController;
use Illuminate\Support\ServiceProvider;

class LaravelJitsiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-jitsi');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-jitsi');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-jitsi.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-jitsi'),
            ], 'views');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-jitsi'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-jitsi'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-jitsi');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-jitsi', function () {
            return new LaravelJitsi;
        });

        $this->registerRoutesMacro();
    }

    /**
     * Register routes macro.
     *
     * @param void
     * @return  void
     */
    protected function registerRoutesMacro()
    {
        $router = $this->app['router'];

        $router->macro('jitsi', function () use ($router) {
            $router
                ->get('/jitsi/{room?}', ViewRoomController::class)
                ->name('jitsi.view-room');
        });
    }
}
