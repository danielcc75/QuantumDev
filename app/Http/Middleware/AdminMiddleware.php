<?php
// app/Http/Middleware/AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
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
        
        return $next($request);
    }
}