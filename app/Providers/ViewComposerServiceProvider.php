<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Usuario;

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
        });
    }

    public function register(): void
    {
        //
    }
}