<?php
// app/Http/Controllers/Admin/ModeracionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ModeracionController extends Controller
{
    // Listado de perfiles para moderar
    public function perfiles(Request $request)
    {
        $query = Perfil::with('usuario');
        
        // Búsqueda
        if ($request->search) {
            $query->whereHas('usuario', function($q) use ($request) {
                $q->where('nombre', 'like', "%{$request->search}%")
                  ->orWhere('apellido', 'like', "%{$request->search}%")
                  ->orWhere('correo_electronico', 'like', "%{$request->search}%");
            });
        }
        
        // Filtro por visibilidad
        if ($request->visible && $request->visible != 'todos') {
            $query->where('visible', $request->visible == 'visible');
        }
        
        $perfiles = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.moderacion.perfiles', compact('perfiles'));
    }
    
    // Ver detalle de un perfil
    public function verPerfil($id)
    {
        $perfil = Perfil::with([
            'usuario',
            'experienciasLaborales',
            'formacionAcademica',
            'links'
        ])->findOrFail($id);
        
        return view('admin.moderacion.ver-perfil', compact('perfil'));
    }
    
    // Cambiar visibilidad del perfil (ocultar/mostrar)
    public function toggleVisibilidad($id)
    {
        $perfil = Perfil::findOrFail($id);
        $perfil->visible = !$perfil->visible;
        $perfil->save();
        
        $estado = $perfil->visible ? 'visible' : 'oculto';
        return back()->with('success', "Perfil marcado como {$estado}");
    }
    
    // Agregar nota de moderación
    public function agregarNota(Request $request, $id)
    {
        $perfil = Perfil::findOrFail($id);
        
        $request->validate([
            'moderation_note' => 'nullable|string|max:500'
        ]);
        
        $perfil->moderation_note = $request->moderation_note;
        $perfil->save();
        
        return back()->with('success', 'Nota de moderación guardada');
    }
}