<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasLabel
{
    /**
     * @var string
     * @example home
     */
    public string $label;

    /**
     * @param string $label
     * @return $this
     */
    public function label(string $label): static
    {
        $this->label = $label;
        return $this;
    }
}
