<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasTarget
{
    /**
     * @var ?string
     * @example _blank
     */
    public ?string $target = null;

    /**
     * @param string $target
     * @return $this
     */
    public function target(string $target): static
    {
        $this->target = $target;
        return $this;
    }
}
