<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasCounter
{
    public ?string $counter=null;

    /**
     * @param string $counter
     * @return $this
     */
    public function counter(string $counter): static
    {
        $this->counter = $counter;
        return $this;
    }
}
