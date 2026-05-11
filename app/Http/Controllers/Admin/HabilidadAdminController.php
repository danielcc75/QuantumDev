<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Habilidad;
use App\Models\HabilidadBlanda;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HabilidadAdminController extends Controller
{
    // Listar todas las habilidades del sistema
    public function index(Request $request)
    {
        $query = Habilidad::with('categoria');
        
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
        
        // Habilidades duplicadas - versión corregida
        $habilidadesDuplicadas = Habilidad::select('nombre')
            ->selectRaw('count(*) as total')
            ->groupBy('nombre')
            ->havingRaw('count(*) > 1')
            ->get();
        
        $habilidadesBlandas = HabilidadBlanda::orderBy('nombre')->get();

        return view('admin.habilidades.index', compact('habilidades', 'categorias', 'habilidadPopular', 'habilidadesDuplicadas', 'habilidadesBlandas'));
    }
        
    // Desactivar/Activar habilidad globalmente
    public function toggleEstado($id)
    {
        $habilidad = Habilidad::findOrFail($id);
        $habilidad->activa = !$habilidad->activa;
        $habilidad->save();
        
        $estado = $habilidad->activa ? 'activada' : 'desactivada';
        return back()->with('success', "Habilidad {$estado} correctamente");
    }
    
    // Fusionar habilidades duplicadas
    public function fusionar(Request $request)
    {
        $request->validate([
            'nombre_original' => 'required|string',
            'nombre_fusion' => 'required|string',
            'categoria_id' => 'required|exists:categoria,id_categoria'
        ]);
        
        // Encontrar habilidades a fusionar
        $habilidadesOriginales = Habilidad::where('nombre', $request->nombre_original)->get();
        $habilidadFusion = Habilidad::where('nombre', $request->nombre_fusion)->first();
        
        if (!$habilidadFusion) {
            // Crear nueva habilidad fusionada
            $habilidadFusion = Habilidad::create([
                'nombre' => $request->nombre_fusion,
                'id_categoria' => $request->categoria_id,
                'activa' => true
            ]);
        }
        
        // Mover todas las referencias a la nueva habilidad
        foreach ($habilidadesOriginales as $original) {
            if ($original->id != $habilidadFusion->id) {
                // Actualizar los perfiles que usan esta habilidad
                DB::table('perfil_habilidad')
                    ->where('id_habilidad', $original->id)
                    ->update(['id_habilidad' => $habilidadFusion->id]);
                
                $original->delete();
            }
        }
        
        return back()->with('success', "Habilidades fusionadas exitosamente en '{$request->nombre_fusion}'");
    }
    
    // Eliminar habilidad
    public function destroy($id)
    {
        $habilidad = Habilidad::findOrFail($id);
        $habilidad->delete();

        return back()->with('success', 'Habilidad eliminada correctamente');
    }
}