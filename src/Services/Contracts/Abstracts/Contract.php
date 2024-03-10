<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Abstracts;

use Illuminate\Support\Collection;
use Spatie\Macroable\Macroable;
use TomatoPHP\LaravelTomato\Services\Contracts\Interfaces\ContractInterface;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\InteractsWithTranslations;

abstract class Contract implements ContractInterface
{
    use Macroable;
    use InteractsWithTranslations;

    public function __construct()
    {
        $this->interactsWithTranslations();
    }

    /**
     * @return static
     */
    public static function make(): static
    {
        return (new static);
    }

    public function toArray(): array
    {
        return [];
    }

    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }
}
