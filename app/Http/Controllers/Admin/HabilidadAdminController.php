<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\LogsActivity;
use App\Models\Habilidad;
use App\Models\HabilidadBlanda;
use App\Models\Categoria;
use Illuminate\Http\Request;

class HabilidadAdminController extends Controller
{
    use LogsActivity;
    // Listar todas las habilidades del sistema
    public function index(Request $request)
    {
        $query = Habilidad::with(['categoria', 'perfil.usuario']);
        
        // Búsqueda
        if ($request->search) {
            $query->where('nombre', 'like', "%{$request->search}%");
        }
        
        // Filtro por categoría
        if ($request->categoria) {
            $query->where('id_categoria', $request->categoria);
        }
        
        $habilidades = $query->orderBy('nombre')->paginate(20);
        $categorias = Categoria::withCount('habilidades')->orderBy('nombre')->get();
        
        // Habilidad más popular - versión corregida
        $habilidadPopular = Habilidad::select('nombre')
            ->selectRaw('count(*) as total')
            ->groupBy('nombre')
            ->orderByRaw('count(*) desc')
            ->first();
        
        $habilidadesBlandas = HabilidadBlanda::orderBy('nombre')->get();

        return view('admin.habilidades.index', compact('habilidades', 'categorias', 'habilidadPopular', 'habilidadesBlandas'));
    }
        
    // Desactivar/Activar habilidad globalmente
    public function toggleEstado($id)
    {
        $habilidad = Habilidad::findOrFail($id);
        $habilidad->activa = !$habilidad->activa;
        $habilidad->save();
        
        $estado = $habilidad->activa ? 'activada' : 'desactivada';
        $this->logAdminAction('habilidad_estado_cambiado', "Habilidad «{$habilidad->nombre}» {$estado}");
        return back()->with('success', "Habilidad {$estado} correctamente");
    }
    
    // Eliminar habilidad
    public function destroy($id)
    {
        $habilidad = Habilidad::findOrFail($id);
        $nombre = $habilidad->nombre;
        $habilidad->delete();

        $this->logAdminAction('habilidad_eliminada', "Habilidad técnica: «{$nombre}»");
        return back()->with('success', 'Habilidad eliminada correctamente');
    }
}