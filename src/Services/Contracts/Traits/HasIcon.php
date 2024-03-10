<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasIcon
{
    /**
     * @var ?string
     * @example bx bx-home
     */
    public ?string $icon = "bx bx-circle";

    /**
     * @param string $icon
     * @return $this
     */
    public function icon(string $icon): static
    {
        $this->icon = $icon;
        return $this;
    }
}
