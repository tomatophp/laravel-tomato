<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasColor
{
    /**
     * @var ?string
     * @example #fefefe
     */
    public ?string $color = "#000";

    /**
     * @param string $color
     * @return $this
     */
    public function color(string $color): static
    {
        $this->color = $color;
        return $this;
    }

}
