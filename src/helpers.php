<?php

if(!function_exists('tomato')){
    function tomato(): \TomatoPHP\LaravelTomato\Facade\Tomato
    {
        return (new \TomatoPHP\LaravelTomato\Facade\Tomato());
    }
}
