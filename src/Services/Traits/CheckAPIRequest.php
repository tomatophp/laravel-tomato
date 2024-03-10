<?php

namespace TomatoPHP\LaravelTomato\Services\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait CheckAPIRequest
{
    public function checkAPIRequest(): bool
    {
        $isAPIRequest = Str::contains('auth:sanctum', Route::current()->gatherMiddleware());
        if($isAPIRequest){
            return true;
        }

        return false;
    }
}
