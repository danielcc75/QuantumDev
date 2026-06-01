<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    /**
     * Available locales
     */
    protected array $locales = ['en', 'es', 'pt'];

    /**
     * Locale names
     */
    protected array $localeNames = [
        'en' => 'English',
        'es' => 'Español',
        'pt' => 'Português',
    ];

    /**
     * Switch to a specific locale
     */
    public function switch($locale)
    {
        if (in_array($locale, $this->locales)) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        }

        return redirect()->back();
    }

    /**
     * Get all available locales
     */
    public function getAvailableLocales()
    {
        return response()->json([
            'locales' => $this->locales,
            'current' => app()->getLocale(),
            'names' => $this->localeNames,
        ]);
    }
}
