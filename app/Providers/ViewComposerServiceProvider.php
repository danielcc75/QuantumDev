<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Usuario;
use App\Models\ConfiguracionSitio;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $esAdmin = false;
            $usuarioId = session('usuario_id');

            if ($usuarioId) {
                $usuario = Usuario::find($usuarioId);
                $esAdmin = $usuario && $usuario->is_admin;
            }

            $view->with('esAdmin', $esAdmin);

            $configSitio = null;
            if (Schema::hasTable('configuracion_sitio')) {
                $configSitio = ConfiguracionSitio::actual();
            }
            $view->with('configSitio', $configSitio);
        });
    }

    public function register(): void
    {
        //
    }
}