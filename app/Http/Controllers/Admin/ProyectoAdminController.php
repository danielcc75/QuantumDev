<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\LogsActivity;
use App\Models\Proyecto;
use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\Notification; // Agrega esta línea
use Illuminate\Http\Request;

class ProyectoAdminController extends Controller
{
    use LogsActivity;
    
    // Listar todos los proyectos del sistema
    public function index(Request $request)
    {
        $query = Proyecto::with('perfil.usuario');
        
        // Búsqueda por nombre o descripción
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nombre', 'like', "%{$request->search}%")
                  ->orWhere('descripcion', 'like', "%{$request->search}%");
            });
        }
        
        // Filtro por estado
        if ($request->estado && $request->estado != 'todos') {
            $query->where('estado', $request->estado);
        }
        
        // Filtro por visibilidad
        if ($request->visibilidad && $request->visibilidad != 'todos') {
            $query->where('visible', $request->visibilidad == 'publico');
        }
        
        // Filtro por fecha
        if ($request->fecha) {
            $query->whereDate('created_at', $request->fecha);
        }
        
        $proyectos = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Estadísticas
        $estadisticas = [
            'total' => Proyecto::count(),
            'publicos' => Proyecto::where('visible', true)->count(),
            'privados' => Proyecto::where('visible', false)->count(),
            'completados' => Proyecto::where('estado', 'completado')->count(),
            'en_progreso' => Proyecto::where('estado', 'en_progreso')->count(),
            'pendientes' => Proyecto::where('estado', 'pendiente')->count(),
        ];
        
        return view('admin.proyectos.index', compact('proyectos', 'estadisticas'));
    }
    
    // Ver detalle de un proyecto
    public function show($id)
    {
        $proyecto = Proyecto::with('perfil.usuario', 'experienciaLaboral')->findOrFail($id);
        return view('admin.proyectos.show', compact('proyecto'));
    }
    
    public function toggleVisibilidad(Request $request, $id)
    {
        $proyecto = Proyecto::with('perfil.usuario')->findOrFail($id);
        
        // Ocultar proyecto (si está visible)
        if ($proyecto->visible) {
            // Validar motivo
            $request->validate([
                'motivo' => 'required|string|max:500',
            ], [
                'motivo.required' => 'Debes indicar el motivo para ocultar el proyecto.',
            ]);
            
            // Guardar motivo y ocultar
            $proyecto->moderation_note = $request->motivo;
            $proyecto->visible = false;
            $proyecto->save();
            
            // Enviar notificación al usuario dueño del proyecto
            $usuario = $proyecto->perfil->usuario;
            if ($usuario) {
                Notification::create([
                    'id_usuario' => $usuario->id_usuario,  // ← CORREGIDO
                    'tipo' => 'warning',
                    'titulo' => 'Tu proyecto ha sido ocultado',
                    'mensaje' => "Tu proyecto \"{$proyecto->nombre}\" ha sido ocultado por el administrador.\n\nMotivo: {$request->motivo}\n\nPor favor, revisa el contenido y realiza los ajustes necesarios para que pueda ser visible nuevamente.",
                    'url' => route('proyectos.show', $proyecto->id_proyecto),
                    'leido' => false
                ]);
            }
            
            $this->logAdminAction('proyecto_visibilidad_cambiada', "Proyecto «{$proyecto->nombre}» (ID {$proyecto->id_proyecto}) ocultado | Motivo: {$proyecto->moderation_note}");
            
            $mensaje = 'Proyecto ocultado correctamente. El usuario ha sido notificado.';
        } 
        // Mostrar proyecto (si está oculto)
        else {
            $proyecto->moderation_note = null;
            $proyecto->visible = true;
            $proyecto->save();
            
            // Enviar notificación al usuario dueño del proyecto
            $usuario = $proyecto->perfil->usuario;
            if ($usuario) {
                Notification::create([
                    'id_usuario' => $usuario->id_usuario,  // ← CORREGIDO
                    'tipo' => 'success',
                    'titulo' => 'Tu proyecto ha sido restaurado',
                    'mensaje' => "Tu proyecto \"{$proyecto->nombre}\" ha sido restaurado y ahora es visible públicamente nuevamente.",
                    'url' => route('proyectos.show', $proyecto->id_proyecto),
                    'leido' => false
                ]);
            }
            
            $this->logAdminAction('proyecto_visibilidad_cambiada', "Proyecto «{$proyecto->nombre}» (ID {$proyecto->id_proyecto}) visible nuevamente");
            
            $mensaje = 'Proyecto visible nuevamente. El usuario ha sido notificado.';
        }
        
        // Si es una petición AJAX (desde el modal)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $mensaje,
                'visible' => $proyecto->visible
            ]);
        }
        
        return redirect()->route('admin.proyectos')->with('success', $mensaje);
    }
        
    // Eliminar proyecto (deshabilitado)
    public function destroy($id)
    {
        return back()->with('error', 'La eliminación de proyectos está deshabilitada. Usa "Ocultar" para retirarlo del portafolio público.');
    }
}