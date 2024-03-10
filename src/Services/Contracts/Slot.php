<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts;

use TomatoPHP\LaravelTomato\Services\Contracts\Abstracts\Contract;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasPosition;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasView;

class Slot extends Contract
{
    use HasPosition;
    use HasView;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array([
           "position" => $this->position ?? null,
           "view" => $this->view ?? null,
        ]);
    }
}
