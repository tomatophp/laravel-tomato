<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

use TomatoPHP\LaravelTomato\Services\Contracts\Enums\Positions;

trait HasPosition
{
    /**
     * @var ?Positions
     * @example new
     */
    public ?Positions $position = null;


    /**
     * @param Positions $position
     * @return $this
     */
    public function position(Positions $position): static
    {
        $this->position = $position;
        return $this;
    }
}
