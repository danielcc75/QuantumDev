<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class PapeleraController extends Controller
{
    // Panel principal de papelera
    public function index()
    {
        // Usuarios eliminados
        $usuariosEliminados = Usuario::onlyTrashed()
            ->with('deletedBy')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10, ['*'], 'usuarios_page');
        
        // Proyectos eliminados
        $proyectosEliminados = Proyecto::onlyTrashed()
            ->with('perfil.usuario', 'deletedBy')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10, ['*'], 'proyectos_page');
        
        $totalUsuarios = Usuario::onlyTrashed()->count();
        $totalProyectos = Proyecto::onlyTrashed()->count();
        
        return view('admin.papelera.index', compact(
            'usuariosEliminados',
            'proyectosEliminados',
            'totalUsuarios',
            'totalProyectos'
        ));
    }
    
    // ========== USUARIOS ==========
    
    public function restaurarUsuario($id)
    {
        $usuario = Usuario::onlyTrashed()->findOrFail($id);
        $usuario->restore();
        $usuario->deleted_by = null;
        $usuario->delete_reason = null;
        $usuario->save();
        
        return back()->with('success', "Usuario '{$usuario->nombre} {$usuario->apellido}' restaurado");
    }
    
    public function eliminarUsuarioPermanente($id)
    {
        $usuario = Usuario::onlyTrashed()->findOrFail($id);
        $nombre = $usuario->nombre . ' ' . $usuario->apellido;
        $usuario->forceDelete();
        
        return back()->with('success', "Usuario '{$nombre}' eliminado permanentemente");
    }
    
    // ========== PROYECTOS ==========
    
    public function restaurarProyecto($id)
    {
        $proyecto = Proyecto::onlyTrashed()->findOrFail($id);
        $proyecto->restore();
        $proyecto->deleted_by = null;
        $proyecto->delete_reason = null;
        $proyecto->save();
        
        return back()->with('success', "Proyecto '{$proyecto->nombre}' restaurado");
    }
    
    public function eliminarProyectoPermanente($id)
    {
        $proyecto = Proyecto::onlyTrashed()->findOrFail($id);
        $nombre = $proyecto->nombre;
        $proyecto->forceDelete();
        
        return back()->with('success', "Proyecto '{$nombre}' eliminado permanentemente");
    }
    
    // ========== VACIAR TODO ==========
    
    public function vaciarPapelera()
    {
        $totalUsuarios = Usuario::onlyTrashed()->count();
        $totalProyectos = Proyecto::onlyTrashed()->count();
        
        Usuario::onlyTrashed()->forceDelete();
        Proyecto::onlyTrashed()->forceDelete();
        
        return back()->with('success', "Papelera vaciada: {$totalUsuarios} usuarios y {$totalProyectos} proyectos eliminados permanentemente");
    }
}