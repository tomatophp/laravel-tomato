<?php

namespace TomatoPHP\LaravelTomato\Facade;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use TomatoPHP\LaravelTomato\Services\Handler;
use TomatoPHP\LaravelTomato\Services\Menu;
use TomatoPHP\LaravelTomato\Services\Requests;
use TomatoPHP\LaravelTomato\Services\Slot;
use TomatoPHP\LaravelTomato\Services\Widget;

/**
 * @method static Menu menu()
 * @method static Collection menus()
 * @method static Slot slot()
 * @method static Widget widget()
 * @method static Requests request()
 * @method static void register(string|array $item)
 */

class Tomato extends  Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'tomato';
    }
}
