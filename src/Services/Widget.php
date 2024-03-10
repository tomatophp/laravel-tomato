<?php

namespace TomatoPHP\LaravelTomato\Services;
use Illuminate\Support\Collection;
use TomatoPHP\LaravelTomato\Services\Interfaces\ServiceInterface;

class Widget implements ServiceInterface
{
    private Collection $widgets;

    public function __construct(array $widgets = [])
    {
        $this->widgets = collect($widgets);
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
        return $this->widgets;
    }

    /**
     * @return $this
     */
    public function build(): static
    {
        $this->widgets = $this->widgets->groupBy('group');
        return $this;
    }
}
