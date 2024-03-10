<?php

namespace TomatoPHP\LaravelTomato;

use TomatoPHP\LaravelTomato\Services\Handler;
use TomatoPHP\LaravelTomato\Services\Menu;
use TomatoPHP\LaravelTomato\Services\Requests;
use TomatoPHP\LaravelTomato\Services\Response;
use TomatoPHP\LaravelTomato\Services\Slot;
use TomatoPHP\LaravelTomato\Services\Widget;

class TomatoServices
{

    private array $menus = [];
    private array $widgets = [];
    private array $slots = [];
    public function register(string|array $item): void
    {
        if(is_array($item)){
            foreach ($item as $getItem){
               if(get_class($getItem) === "TomatoPHP\LaravelTomato\Services\Contracts\Menu"){
                   $this->menus[] = $getItem;
               }
                if(get_class($getItem) === "TomatoPHP\LaravelTomato\Services\Contracts\Widget"){
                    $this->widgets[] = $getItem;
                }
                if(get_class($getItem) === "TomatoPHP\LaravelTomato\Services\Contracts\Slot"){
                    $this->slots[] = $getItem;
                }
            }
        }
        else {
            if(get_class($item) === "TomatoPHP\LaravelTomato\Services\Contracts\Menu"){
                $this->menus[] = $item;
            }
            if(get_class($item) === "TomatoPHP\LaravelTomato\Services\Contracts\Widget"){
                $this->widgets[] = $item;
            }
            if(get_class($item) === "TomatoPHP\LaravelTomato\Services\Contracts\Slot"){
                $this->slots[] = $item;
            }
        }
    }

    public function menus(): array
    {
        return (new static())->menus;
    }

    public function widgets(): array
    {
        return (new static())->widgets;
    }

    /**
     * @return Menu
     */
    public function menu(): Menu
    {
        return new Menu($this->menus);
    }

    /**
     * @return Widget
     */
    public function widget(): Widget
    {
        return new Widget($this->widgets);
    }

    /**
     * @return Slot
     */
    public function slot(): Slot
    {
        return new Slot($this->slots);
    }

    /**
     * @return Requests
     */
    public function request(): Requests
    {
        return new Requests();
    }

    /**
     * @return Response
     */
    public function response(): Response
    {
        return new Response();
    }
}
