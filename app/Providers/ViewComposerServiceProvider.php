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
            $sugerenciasSinLeer = collect();

            if ($usuarioId) {
                $usuario = Usuario::find($usuarioId);
                $esAdmin = $usuario && $usuario->is_admin;
                
                if ($esAdmin && Schema::hasTable('sugerencias')) {
                    $sugerenciasSinLeer = \App\Models\Sugerencia::with('usuario')->where('leida', false)->orderBy('created_at', 'desc')->get();
                }
            }

            $view->with('esAdmin', $esAdmin);
            $view->with('sugerenciasSinLeer', $sugerenciasSinLeer);

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