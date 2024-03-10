<?php

namespace TomatoPHP\LaravelTomato\Services\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait HasFilters
{
    public function hasFilters(array $filters, Request $request, Builder &$query): void
    {
        if(count($filters)){
            foreach ($filters as $key){
                if($request->has($key) && $request->get($key) !== null) {
                    $query->where($key, $request->get($key));
                }
            }
        }
    }
}
