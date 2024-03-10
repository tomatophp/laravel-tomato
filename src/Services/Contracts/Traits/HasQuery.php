<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

trait HasQuery
{
    public ?array $query=[];

    /**
     * @param array $query
     * @return $this
     */
    public function query(array $query): static
    {
        $this->query = $query;
        return $this;
    }
}
