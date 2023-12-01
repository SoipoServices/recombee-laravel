<?php

namespace Soiposervices\RecombeeLaravel;

use Illuminate\Support\ServiceProvider;
use Soiposervices\RecombeeLaravel\Commands\RecombeeLaravelResedDatabase;
use Soiposervices\RecombeeLaravel\Commands\RecombeeLaravelSyncProperties;

class RecombeeLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'recombee-laravel');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'recombee-laravel');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('recombee.php'),
            ], 'recombee');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/recombee-laravel'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/recombee-laravel'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/recombee-laravel'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([RecombeeLaravelResedDatabase::class,RecombeeLaravelSyncProperties::class]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'recombee');

        // Register the main class to use with the facade
        $this->app->singleton('recombee', function () {
            return new RecombeeLaravel(config('recombee.database.id'),config('recombee.database.token'),config('recombee.database.region'));
        });
    }
}
