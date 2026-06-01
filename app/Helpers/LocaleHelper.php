<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class LocaleHelper
{
    /**
     * Get the current locale
     */
    public static function getCurrentLocale(): string
    {
        return session('locale') ?? App::getLocale();
    }

    /**
     * Get all available locales
     */
    public static function getAvailableLocales(): array
    {
        return config('app.locales', ['en', 'es', 'pt']);
    }

    /**
     * Get locale names
     */
    public static function getLocaleNames(): array
    {
        return [
            'en' => 'English',
            'es' => 'Español',
            'pt' => 'Português',
        ];
    }

    /**
     * Get the name of a specific locale
     */
    public static function getLocaleName(string $locale): string
    {
        $names = self::getLocaleNames();
        return $names[$locale] ?? $locale;
    }

    /**
     * Check if a locale is available
     */
    public static function isAvailable(string $locale): bool
    {
        return in_array($locale, self::getAvailableLocales());
    }

    /**
     * Get the flag emoji for a locale
     */
    public static function getLocaleFlagEmoji(string $locale): string
    {
        $flags = [
            'en' => '🇬🇧',
            'es' => '🇪🇸',
            'pt' => '🇵🇹',
        ];

        return $flags[$locale] ?? '';
    }
}
