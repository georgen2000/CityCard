<?php

namespace App\Helpers;

class Common
{
    public static function getLocale(): string
    {
        $locale = explode('/', request()->path())[0];
        if (strlen($locale) == 2 && in_array($locale, array_keys(config('app.available_locales')))) {
            return $locale;
        }
        return "";

    }

    public static function getLocalUrl($locale): string
    {
        if (self::getLocale()) {
            $path = str_replace(app()->currentLocale(), $locale, request()->path());
        } else {
            $path = $locale . '/' . request()->path();
        }
        return url($path);
    }
}
