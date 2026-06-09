<?php
// app/Http/Middleware/AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use App\Models\Usuario;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $usuarioId = session('usuario_id');

        if (!$usuarioId) {
            return redirect('/');
        }

        $usuario = Usuario::find($usuarioId);

        if (!$usuario || !$usuario->is_admin) {
            abort(403, 'No tienes permisos de administrador.');
        }

        // El panel de administración es siempre en español, independientemente
        // del idioma que el usuario haya elegido en el sitio público.
        App::setLocale('es');

        return $next($request);
    }
}