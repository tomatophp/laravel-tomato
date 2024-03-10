<?php

namespace Tomatophp\LaravelTomato;

use Illuminate\Support\ServiceProvider;


class LaravelTomatoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-tomato.php', 'laravel-tomato');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/laravel-tomato.php' => config_path('laravel-tomato.php'),
        ], 'laravel-tomato-config');
    }

    public function boot(): void
    {
        //you boot methods here
    }
}
