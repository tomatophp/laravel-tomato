<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasModel
{
    public ?string $model=null;

    /**
     * @param string $model
     * @return $this
     */
    public function model(string $model): static
    {
        $this->model = $model;
        return $this;
    }

}
