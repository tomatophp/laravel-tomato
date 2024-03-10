<?php

namespace TomatoPHP\LaravelTomato;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\LaravelTomato\TomatoServices;

include __DIR__.'/helpers.php';


class LaravelTomatoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('tomato',function(){
            return new TomatoServices();
        });
    }

    public function boot(): void
    {
        //you boot methods here
    }
}
