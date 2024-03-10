<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasRoute
{
    /**
     * @var ?string
     * @example admin.home
     */
    public ?string $route = "";

    /**
     * @param string $route
     * @return $this
     */
    public function route(string $route): static
    {
        $this->route = $route;
        return $this;
    }
}
