<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasUrl
{
    /**
     * @var ?string
     * @example /admin
     */
    public ?string $url = "#";

    /**
     * @param string $url
     * @return $this
     */
    public function url(string $url): static
    {
        $this->url = $url;
        return $this;
    }
}
