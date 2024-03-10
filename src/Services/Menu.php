<?php

namespace TomatoPHP\LaravelTomato\Services;

use Illuminate\Support\Collection;
use TomatoPHP\LaravelTomato\Services\Interfaces\ServiceInterface;

class Menu implements ServiceInterface
{
    private Collection $menus;

    public function __construct(array $menus = [])
    {
        $this->menus = collect($menus);
    }

    public function get(): Collection
    {
        return $this->build()->load();
    }

    /**
     * @return Collection
     */
    public function load(): Collection
    {
        return $this->menus;
    }

    /**
     * @return $this
     */
    public function build(): static
    {
        $this->menus = $this->menus->groupBy("group");
        return $this;
    }
}
