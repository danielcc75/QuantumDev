<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Proyecto;
use App\Models\Habilidad;
use App\Models\ExperienciaLaboral;
use App\Models\Educacion;
use Illuminate\Http\Request;

class PapeleraController extends Controller
{
    // Panel principal de papelera
    public function index()
    {
        $usuariosEliminados = Usuario::onlyTrashed()
            ->with('deletedBy')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10, ['*'], 'usuarios_page');

        $proyectosEliminados = Proyecto::onlyTrashed()
            ->with('perfil.usuario', 'deletedBy')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10, ['*'], 'proyectos_page');

        $habilidadesEliminadas = Habilidad::onlyTrashed()
            ->with('perfil.usuario', 'categoria', 'deletedBy')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10, ['*'], 'habilidades_page');

        $experienciasEliminadas = ExperienciaLaboral::onlyTrashed()
            ->with('perfil.usuario', 'deletedBy')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10, ['*'], 'experiencias_page');

        $educacionesEliminadas = Educacion::onlyTrashed()
            ->with('perfil.usuario', 'deletedBy')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10, ['*'], 'educaciones_page');

        $totalUsuarios = Usuario::onlyTrashed()->count();
        $totalProyectos = Proyecto::onlyTrashed()->count();
        $totalHabilidades = Habilidad::onlyTrashed()->count();
        $totalExperiencias = ExperienciaLaboral::onlyTrashed()->count();
        $totalEducaciones = Educacion::onlyTrashed()->count();

        return view('admin.papelera.index', compact(
            'usuariosEliminados',
            'proyectosEliminados',
            'habilidadesEliminadas',
            'experienciasEliminadas',
            'educacionesEliminadas',
            'totalUsuarios',
            'totalProyectos',
            'totalHabilidades',
            'totalExperiencias',
            'totalEducaciones'
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

    // ========== HABILIDADES TÉCNICAS ==========

    public function restaurarHabilidad($id)
    {
        $habilidad = Habilidad::onlyTrashed()->findOrFail($id);
        $habilidad->restore();
        $habilidad->deleted_by = null;
        $habilidad->delete_reason = null;
        $habilidad->save();

        return back()->with('success', "Habilidad '{$habilidad->nombre}' restaurada");
    }

    // ========== EXPERIENCIA LABORAL ==========

    public function restaurarExperiencia($id)
    {
        $experiencia = ExperienciaLaboral::onlyTrashed()->findOrFail($id);
        $experiencia->restore();
        $experiencia->deleted_by = null;
        $experiencia->delete_reason = null;
        $experiencia->save();

        return back()->with('success', "Experiencia en '{$experiencia->empresa}' restaurada");
    }

    // ========== FORMACIÓN ACADÉMICA ==========

    public function restaurarEducacion($id)
    {
        $educacion = Educacion::onlyTrashed()->findOrFail($id);
        $educacion->restore();
        $educacion->deleted_by = null;
        $educacion->delete_reason = null;
        $educacion->save();

        return back()->with('success', "Formación '{$educacion->titulo}' restaurada");
    }

    // ========== VACIAR TODO ==========
    
    public function vaciarPapelera()
    {
        return back()->with('error', 'La eliminación permanente está deshabilitada. Los elementos de la papelera solo pueden restaurarse.');
    }
}