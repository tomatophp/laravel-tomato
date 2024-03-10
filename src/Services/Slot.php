<?php

namespace TomatoPHP\LaravelTomato\Services;

use Illuminate\Support\Collection;
use TomatoPHP\LaravelTomato\Services\Interfaces\ServiceInterface;

class Slot Implements ServiceInterface
{
    private Collection $slots;

    public function __construct(array $slots = [])
    {
        $this->slots = collect($slots);
    }

    public function get(): Collection
    {
        return $this->build()->load();
    }

    public function load(): Collection
    {
        return $this->slots;
    }

    public function build(): static
    {
        $this->slots = $this->slots->groupBy('position');
        return $this;
    }
}
