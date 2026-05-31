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

        $sugerenciasCategoria = \App\Models\Sugerencia::with('usuario')->where('tipo', 'categoria')->orderBy('created_at', 'desc')->get();
        $sugerenciasHabilidadBlanda = \App\Models\Sugerencia::with('usuario')->where('tipo', 'habilidad_blanda')->orderBy('created_at', 'desc')->get();

        return view('admin.habilidades.index', compact('habilidades', 'categorias', 'habilidadPopular', 'habilidadesBlandas', 'sugerenciasCategoria', 'sugerenciasHabilidadBlanda'));
    }
        
    // Ver detalle de una habilidad técnica
    public function show($id)
    {
        $habilidad = Habilidad::with(['categoria', 'perfil.usuario'])->findOrFail($id);
        return view('admin.habilidades.show', compact('habilidad'));
    }

    // Desactivar/Activar habilidad globalmente
    public function toggleEstado(Request $request, $id)
    {
        $habilidad = Habilidad::findOrFail($id);

        // Si va a ocultar (desactivar), exige un motivo y lo guarda
        if ($habilidad->activa) {
            $request->validate([
                'motivo' => 'required|string|max:500',
            ], [
                'motivo.required' => 'Debes indicar el motivo para ocultar la habilidad.',
            ]);
            $habilidad->moderation_note = $request->motivo;
        } else {
            $habilidad->moderation_note = null;
        }

        $habilidad->activa = !$habilidad->activa;
        $habilidad->save();

        $estado = $habilidad->activa ? 'activada' : 'desactivada';
        $this->logAdminAction('habilidad_estado_cambiado', "Habilidad «{$habilidad->nombre}» {$estado}" . (!$habilidad->activa && $habilidad->moderation_note ? " | Motivo: {$habilidad->moderation_note}" : ''));
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