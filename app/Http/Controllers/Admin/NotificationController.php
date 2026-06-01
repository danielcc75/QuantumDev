<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Usuario;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use LogsActivity;
    
    // Listar todas las notificaciones enviadas
    public function index(Request $request)
    {
        $query = Notification::with('usuario')->orderBy('created_at', 'desc');
        
        if ($request->tipo && $request->tipo != 'todos') {
            $query->where('tipo', $request->tipo);
        }
        
        if ($request->leido && $request->leido != 'todos') {
            $query->where('leido', $request->leido == 'si');
        }
        
        $notificaciones = $query->paginate(20);
        
        $estadisticas = [
            'total' => Notification::count(),
            'leidas' => Notification::where('leido', true)->count(),
            'no_leidas' => Notification::where('leido', false)->count(),
            'por_tipo' => [
                'info' => Notification::where('tipo', 'info')->count(),
                'success' => Notification::where('tipo', 'success')->count(),
                'warning' => Notification::where('tipo', 'warning')->count(),
                'error' => Notification::where('tipo', 'error')->count(),
            ]
        ];
        
        // Usuarios para el modal de crear notificación
        $usuarios = Usuario::orderBy('nombre')->get();
        
        return view('admin.notifications.index', compact('notificaciones', 'estadisticas', 'usuarios'));
    }
    
    // Formulario crear notificación (ya no se usa, es modal)
    public function create()
    {
        $usuarios = Usuario::orderBy('nombre')->get();
        return view('admin.notifications.create', compact('usuarios'));
    }
    
    // Enviar notificación
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:info,success,warning,error',
            'titulo' => 'required|string|max:200',
            'mensaje' => 'required|string',
            'url' => 'nullable|url',
            'destinatario' => 'required|in:todos,individual'
        ]);
        
        $iconos = [
            'info' => 'fa-info-circle',
            'success' => 'fa-check-circle',
            'warning' => 'fa-exclamation-triangle',
            'error' => 'fa-times-circle'
        ];
        
        if ($request->destinatario == 'todos') {
            $usuarios = Usuario::all();
            foreach ($usuarios as $usuario) {
                Notification::create([
                    'id_usuario' => $usuario->id_usuario,
                    'titulo' => $request->titulo,
                    'mensaje' => $request->mensaje,
                    'tipo' => $request->tipo,
                    'icono' => $iconos[$request->tipo],
                    'url' => $request->url,
                ]);
            }
            $mensaje = "Notificación enviada a {$usuarios->count()} usuarios";
        } else {
            $request->validate(['usuario_id' => 'required|exists:usuario,id_usuario']);
            
            Notification::create([
                'id_usuario' => $request->usuario_id,
                'titulo' => $request->titulo,
                'mensaje' => $request->mensaje,
                'tipo' => $request->tipo,
                'icono' => $iconos[$request->tipo],
                'url' => $request->url,
            ]);
            $usuario = Usuario::find($request->usuario_id);
            $mensaje = "Notificación enviada a {$usuario->nombre} {$usuario->apellido}";
        }
        
        $this->logAdminAction('enviar_notificacion', $mensaje);
        
        // Respuesta para AJAX (modal)
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $mensaje]);
        }
        
        return redirect()->route('admin.notifications')->with('success', $mensaje);
    }
    
    // Ver detalle de notificación
    public function show($id)
    {
        $notificacion = Notification::with('usuario')->findOrFail($id);
        return view('admin.notifications.show', compact('notificacion'));
    }
    
    // Eliminar notificación
    public function destroy($id)
    {
        $notificacion = Notification::findOrFail($id);
        $notificacion->delete();
        
        $this->logAdminAction('eliminar_notificacion', "Notificación ID {$id} eliminada");
        
        return back()->with('success', 'Notificación eliminada');
    }
    
    // Eliminar notificaciones antiguas (más de 30 días)
    public function limpiar()
    {
        $fechaLimite = now()->subDays(30);
        $eliminadas = Notification::where('created_at', '<', $fechaLimite)->delete();
        
        $this->logAdminAction('limpiar_notificaciones', "Se eliminaron {$eliminadas} notificaciones antiguas");
        
        return back()->with('success', "Se eliminaron {$eliminadas} notificaciones antiguas");
    }
}