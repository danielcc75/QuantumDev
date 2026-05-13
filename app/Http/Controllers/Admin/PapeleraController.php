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
        return back()->with('error', 'La eliminación permanente de cuentas está deshabilitada. Solo se pueden restaurar.');
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
        return back()->with('error', 'La eliminación permanente de proyectos está deshabilitada. Solo se pueden restaurar.');
    }
    
    // ========== VACIAR TODO ==========
    
    public function vaciarPapelera()
    {
        return back()->with('error', 'La eliminación permanente está deshabilitada. Los elementos de la papelera solo pueden restaurarse.');
    }
}