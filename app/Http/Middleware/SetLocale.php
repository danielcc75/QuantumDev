<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * The application's locale options.
     */
    protected array $locales = ['en', 'es', 'pt'];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the locale from the route parameter or session
        $locale = $request->route('locale') ?? session('locale');

        // Check if the locale is valid
        if (in_array($locale, $this->locales)) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        } else {
            // Use default locale from config or session
            $defaultLocale = session('locale') ?? config('app.locale', 'en');
            if (in_array($defaultLocale, $this->locales)) {
                App::setLocale($defaultLocale);
            } else {
                App::setLocale('en');
            }
        }

        return $next($request);
    }
}
