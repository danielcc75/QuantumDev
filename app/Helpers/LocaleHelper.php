<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class LocaleHelper
{
    public static function getCurrentLocale(): string
    {
        return session('locale') ?? App::getLocale();
    }

    public static function getAvailableLocales(): array
    {
        return config('app.locales', ['es', 'en', 'pt']);
    }
}
