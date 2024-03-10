<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts;

use TomatoPHP\LaravelTomato\Services\Contracts\Abstracts\Contract;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasBadge;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasColor;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasGroup;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasIcon;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasLabel;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasRoute;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasTarget;
use TomatoPHP\LaravelTomato\Services\Contracts\Traits\HasUrl;

class Menu extends Contract
{
    use HasLabel;
    use HasBadge;
    use HasColor;
    use HasRoute;
    use HasUrl;
    use HasTarget;
    use HasGroup;
    use HasIcon;


    /**
     * @return array
     */
    public function toArray(): array
    {
        return array([
           "label" => $this->label ?? null,
           "icon" => $this->icon ?? null,
           "target" => $this->target ?? null,
           "url" => $this->url ?? null,
           "route" => $this->route ?? null,
           "badge" => $this->badge ?? null,
           "color" => $this->color ?? null,
           "group" => $this->group ?? null,
        ]);
    }
}
