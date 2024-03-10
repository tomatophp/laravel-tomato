<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Traits;

use Illuminate\Support\Facades\Cookie;

trait InteractsWithTranslations
{
    public function interactsWithTranslations(): void
    {
        // decrypt
        try {
            $decryptedString = \Crypt::decrypt(Cookie::get('lang'), false);
            $lang = json_decode(explode('|', $decryptedString)[1]);
            app()->setLocale($lang->id ?? config('app.locale'));
        }catch (\Exception $exception) {}
    }
}
