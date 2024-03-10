<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasDescription
{
    public ?string $description=null;

    /**
     * @param string $description
     * @return $this
     */
    public function description(string $description): static
    {
        $this->description = $description;
        return $this;
    }
}
