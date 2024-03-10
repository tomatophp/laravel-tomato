<?php

namespace TomatoPHP\LaravelTomato\Services\Interfaces;

use Illuminate\Support\Collection;

interface ServiceInterface
{
    /**
     * @return Collection
     */
    public function get(): Collection;

    /**
     * @return Collection
     */
    public function load(): Collection;

    /**
     * @return $this
     */
    public function build(): static;
}
