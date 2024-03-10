<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasGroup
{
    /**
     * @var string|array|null
     */
    public string|array|null $group = "resources";

    /**
     * @param string|array $group
     * @return $this
     */
    public function group(string|array $group): static
    {
        $this->group = $group;
        return $this;
    }
}
