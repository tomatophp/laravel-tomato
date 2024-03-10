<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts;

use TomatoPHP\LaravelTomato\Services\Contracts\Abstracts\Contract;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasColor;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasCounter;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasDescription;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasGroup;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasIcon;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasLabel;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasModel;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasQuery;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasRoute;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasTarget;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasUrl;

class Widget extends Contract
{
    use HasLabel;
    use HasModel;
    use HasCounter;
    use HasQuery;
    use HasDescription;
    use HasIcon;
    use HasGroup;
    use HasRoute;
    use HasUrl;
    use HasTarget;
    use HasColor;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array([
           "label" => $this->label ?? null,
           "model" => $this->model ?? null,
           "counter" => $this->counter ?? null,
           "query" => $this->query ?? null,
           "description" => $this->description ?? null,
           "icon" => $this->icon ?? null,
           "group" => $this->group ?? null,
           "route" => $this->route ?? null,
           "url" => $this->url ?? null,
           "target" => $this->target ?? null,
           "color" => $this->color ?? null,
        ]);
    }
}
