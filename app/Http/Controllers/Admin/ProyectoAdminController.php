<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Http\Request;

class ProyectoAdminController extends Controller
{
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
        
        // Filtro por destacado
        if ($request->destacado && $request->destacado != 'todos') {
            $query->where('destacado', $request->destacado == 'si');
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
            'destacados' => Proyecto::where('destacado', true)->count(),
        ];
        
        return view('admin.proyectos.index', compact('proyectos', 'estadisticas'));
    }
    
    // Ver detalle de un proyecto
    public function show($id)
    {
        $proyecto = Proyecto::with('perfil.usuario', 'experienciaLaboral')->findOrFail($id);
        return view('admin.proyectos.show', compact('proyecto'));
    }
    
    // Cambiar visibilidad (ocultar/mostrar)
    public function toggleVisibilidad($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->visible = !$proyecto->visible;
        $proyecto->save();
        
        $estado = $proyecto->visible ? 'visible al público' : 'oculto';
        return back()->with('success', "Proyecto ahora está {$estado}");
    }
    
    // Marcar/Desmarcar como destacado
    public function toggleDestacado($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->destacado = !$proyecto->destacado;
        $proyecto->save();
        
        $estado = $proyecto->destacado ? 'destacado' : 'ya no está destacado';
        return back()->with('success', "Proyecto marcado como {$estado}");
    }
    
    // Eliminar proyecto (deshabilitado)
    public function destroy($id)
    {
        return back()->with('error', 'La eliminación de proyectos está deshabilitada. Usa "Ocultar" para retirarlo del portafolio público.');
    }
}