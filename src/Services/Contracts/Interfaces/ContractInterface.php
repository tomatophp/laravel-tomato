<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Interfaces;

use Illuminate\Support\Collection;

interface ContractInterface
{
    public static function make(): static;

    public function interactsWithTranslations(): void;

    public function toArray(): array;

    public function toCollection(): Collection;
}
