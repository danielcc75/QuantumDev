<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Usuario;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Ver mis notificaciones (página completa)
    public function index()
    {
        if (!session('usuario_id')) {
            return redirect('/');
        }
        
        $usuario = Usuario::with('perfil')->find(session('usuario_id'));
        
        $notificaciones = Notification::where('id_usuario', session('usuario_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        $noLeidas = Notification::where('id_usuario', session('usuario_id'))
            ->where('leido', false)
            ->count();
        
        // ========================================
        // VARIABLES PARA EL SIDEBAR DERECHO
        // ========================================
        $progreso = 0;
        $progresoLabel = '';
        $progresoColor = '';
        
        if ($usuario && $usuario->perfil) {
            $perfil = $usuario->perfil;
            
            // Calcular progreso del perfil
            if ($perfil) $progreso += 20;
            if (!empty($perfil->foto_perfil)) $progreso += 20;
            if (!empty($perfil->biografia)) $progreso += 20;
            if (!empty($perfil->ubicacion)) $progreso += 15;
            if ($usuario->proyectos()->exists()) $progreso += 15;
            if ($usuario->habilidades()->exists()) $progreso += 10;
            
            $progresoColor = $progreso < 40 ? '#e11d48' : ($progreso < 75 ? '#f59e0b' : '#1e3a5f');
            $progresoLabel = $progreso < 40 ? 'Perfil incompleto' : ($progreso < 75 ? 'Perfil en progreso' : 'Perfil casi completo');
        }
        
        $nombreUsuario = $usuario ? $usuario->nombre . ' ' . $usuario->apellido : '';
        $iniciales = $usuario ? strtoupper(substr($usuario->nombre, 0, 1) . substr($usuario->apellido, 0, 1)) : '';
        
        return view('notifications.index', compact(
            'notificaciones', 
            'noLeidas',
            'usuario',
            'progreso',
            'progresoLabel',
            'progresoColor',
            'nombreUsuario',
            'iniciales'
        ));
    }
    
    // Obtener notificaciones para el dropdown (AJAX)
    public function listarParaDropdown()
    {
        if (!session('usuario_id')) {
            return response()->json(['notificaciones' => [], 'noLeidas' => 0]);
        }
        
        $notificaciones = Notification::where('id_usuario', session('usuario_id'))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function($notif) {
                return [
                    'id' => $notif->id_notification,
                    'titulo' => $notif->titulo,
                    'mensaje' => $notif->mensaje,
                    'tipo' => $notif->tipo,
                    'leido' => $notif->leido,
                    'url' => $notif->url,
                    'hace' => $notif->created_at->diffForHumans()
                ];
            });
        
        $noLeidas = Notification::where('id_usuario', session('usuario_id'))
            ->where('leido', false)
            ->count();
        
        return response()->json([
            'notificaciones' => $notificaciones,
            'noLeidas' => $noLeidas
        ]);
    }
    
    // Marcar como leída desde el dropdown (AJAX)
    public function marcarLeidaAjax(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['error' => 'No autenticado'], 401);
        }
        
        $notificacion = Notification::where('id_usuario', session('usuario_id'))
            ->where('id_notification', $request->id)
            ->firstOrFail();
        
        $notificacion->leido = true;
        $notificacion->leido_at = now();
        $notificacion->save();
        
        return response()->json(['success' => true]);
    }
    
    // Marcar como leída (desde página)
    public function marcarLeida($id)
    {
        if (!session('usuario_id')) {
            if (request()->ajax()) {
                return response()->json(['error' => 'No autenticado'], 401);
            }
            return redirect('/');
        }
        
        $notificacion = Notification::where('id_usuario', session('usuario_id'))
            ->where('id_notification', $id)
            ->firstOrFail();
        
        $notificacion->marcarComoLeido();
        
        // Si la petición es AJAX (la de tu fetch), devolvemos JSON
        if (request()->ajax() || request()->expectsJson()) {
            return response()->json(['success' => true]);
        }
        
        // Si es una petición normal de formulario (sin AJAX), redirigimos
        return back()->with('success', 'Notificación marcada como leída');
    }
        
    // Marcar todas como leídas
    public function marcarTodasLeidas()
    {
        if (!session('usuario_id')) {
            return redirect('/');
        }
        
        Notification::where('id_usuario', session('usuario_id'))
            ->where('leido', false)
            ->update(['leido' => true, 'leido_at' => now()]);
        
        return back()->with('success', 'Todas las notificaciones marcadas como leídas');
    }
    
    // Obtener número de no leídas (para AJAX)
    public function contarNoLeidas()
    {
        if (!session('usuario_id')) {
            return response()->json(['count' => 0]);
        }
        
        $count = Notification::where('id_usuario', session('usuario_id'))
            ->where('leido', false)
            ->count();
        
        return response()->json(['count' => $count]);
    }
    
    public function obtenerNovedades()
    {
        if (!session('usuario_id')) {
            return response()->json(['novedades' => []]);
        }
        
        $usuario = Usuario::with('perfil')->find(session('usuario_id'));
        $perfil = $usuario->perfil;
        
        $novedades = [];
        
        // 1. Portafolio oculto o nota de moderación
        if ($perfil && !$perfil->visible) {
            $novedades[] = [
                'tipo' => 'portafolio_oculto',
                'id_entidad' => $perfil->id_perfil,
                'titulo' => 'Portafolio oculto',
                'detalle' => 'Un administrador ocultó tu portafolio' . ($perfil->moderation_note ? ": {$perfil->moderation_note}" : ''),
                'icono' => 'fas fa-eye-slash',
                'color' => 'text-red-600',
                'created_at' => $perfil->updated_at->toIso8601String()
            ];
        } elseif ($perfil && $perfil->moderation_note) {
            $novedades[] = [
                'tipo' => 'nota_moderacion',
                'id_entidad' => $perfil->id_perfil,
                'titulo' => 'Aviso del administrador',
                'detalle' => $perfil->moderation_note,
                'icono' => 'fas fa-exclamation-triangle',
                'color' => 'text-yellow-600',
                'created_at' => $perfil->updated_at->toIso8601String()
            ];
        }
        
        // 2. Proyectos ocultos (si la tabla proyectos tiene moderation_note)
        if ($perfil) {
            try {
                $proyectosOcultos = Proyecto::where('id_perfil', $perfil->id_perfil)
                    ->where('visible', false)
                    ->whereNotNull('moderation_note')
                    ->get();
                
                foreach ($proyectosOcultos as $proyecto) {
                    $novedades[] = [
                        'tipo' => 'proyecto_oculto',
                        'id_entidad' => $proyecto->id_proyecto,
                        'titulo' => "Proyecto oculto: {$proyecto->nombre}",
                        'detalle' => $proyecto->moderation_note,
                        'icono' => 'fas fa-folder-minus',
                        'color' => 'text-orange-600',
                        'created_at' => $proyecto->updated_at->toIso8601String()
                    ];
                }
            } catch (\Exception $e) {
                // Si la tabla no tiene moderation_note, ignorar
            }
        }
        
        // 3. Notificaciones del sistema (de la tabla notifications)
        $notificaciones = Notification::where('id_usuario', session('usuario_id'))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        foreach ($notificaciones as $notif) {
            $novedades[] = [
                'tipo' => 'notificacion',
                'id_entidad' => $notif->id_notification,
                'titulo' => $notif->titulo,
                'detalle' => $notif->mensaje,
                'icono' => $notif->tipo == 'info' ? 'fas fa-info-circle' : ($notif->tipo == 'success' ? 'fas fa-check-circle' : ($notif->tipo == 'warning' ? 'fas fa-exclamation-triangle' : 'fas fa-times-circle')),
                'color' => $notif->tipo == 'info' ? 'text-blue-600' : ($notif->tipo == 'success' ? 'text-green-600' : ($notif->tipo == 'warning' ? 'text-yellow-600' : 'text-red-600')),
                'created_at' => $notif->created_at->toIso8601String(),
                'url' => $notif->url,
                'leido' => $notif->leido
            ];
        }
        
        // Ordenar por fecha más reciente
        usort($novedades, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        
        return response()->json([
            'novedades' => $novedades,
            'total' => count($novedades)
        ]);
    }

    // Marcar novedad como leída (cuando el usuario hace clic)
    public function marcarNovedadVista(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['error' => 'No autenticado'], 401);
        }
        
        if ($request->todas) {
            // Marcar todas las notificaciones como leídas
            Notification::where('id_usuario', session('usuario_id'))
                ->where('leido', false)
                ->update(['leido' => true, 'leido_at' => now()]);
        } elseif ($request->tipo == 'notificacion' && $request->id) {
            $notificacion = Notification::where('id_usuario', session('usuario_id'))
                ->where('id_notification', $request->id)
                ->first();
            if ($notificacion) {
                $notificacion->marcarComoLeido();
            }
        }
        
        return response()->json(['success' => true]);
    }

    
}