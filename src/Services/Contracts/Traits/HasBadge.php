<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasBadge
{
    /**
     * @var ?string
     * @example new
     */
    public ?string $badge = "";

    /**
     * @param string $badge
     * @return $this
     */
    public function badge(string $badge): static
    {
        $this->badge = $badge;
        return $this;
    }
}
