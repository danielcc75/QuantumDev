<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    protected array $locales = ['es', 'en', 'pt'];

    /**
     * Cambia el locale activo guardándolo en la sesión.
     */
    public function switch($locale)
    {
        if (in_array($locale, $this->locales, true)) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        }

        return redirect()->back();
    }

    /**
     * Devuelve el `general.php` del locale como JSON, con la versión (filemtime)
     * para que el cliente cachee en localStorage y revalide cuando cambie.
     */
    public function translations($locale)
    {
        if (!in_array($locale, $this->locales, true)) {
            abort(404);
        }

        $path = lang_path("{$locale}/general.php");
        if (!file_exists($path)) {
            return response()->json([
                'locale'  => $locale,
                'version' => 0,
                'data'    => (object) [],
            ]);
        }

        return response()
            ->json([
                'locale'  => $locale,
                'version' => (string) filemtime($path),
                'data'    => require $path,
            ])
            ->header('Cache-Control', 'public, max-age=300');
    }
}
