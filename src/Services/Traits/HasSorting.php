<?php

namespace TomatoPHP\LaravelTomato\Services\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSorting
{
    public function hasSorting(string $sorting, Builder &$query)
    {
        if($sorting && !request()->has('sort')){
            $query->orderBy('id', $sorting);
        }
    }
}
