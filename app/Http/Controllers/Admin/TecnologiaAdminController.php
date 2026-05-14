<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tecnologia;
use Illuminate\Http\Request;

class TecnologiaAdminController extends Controller
{
    public function index(Request $request)
    {
        $search    = trim((string) $request->input('search', ''));
        $categoria = (string) $request->input('categoria', '');
        $sort      = in_array($request->input('sort'), ['nombre', 'categoria', 'id_tecnologia', 'created_at']) ? $request->input('sort') : 'nombre';
        $dir       = strtolower($request->input('dir')) === 'desc' ? 'desc' : 'asc';
        $periodo   = in_array($request->input('periodo'), ['24h', '7d', '30d']) ? $request->input('periodo') : '';

        $query = Tecnologia::query();

        if ($search !== '') {
            $query->where('nombre', 'like', "%{$search}%");
        }

        if ($categoria !== '') {
            $query->where('categoria', $categoria);
        }

        if ($periodo !== '') {
            $desde = match ($periodo) {
                '24h' => now()->subDay(),
                '7d'  => now()->subDays(7),
                '30d' => now()->subDays(30),
            };
            $query->where('created_at', '>=', $desde);
        }

        $tecnologias = $query->orderBy($sort, $dir)
            ->paginate(15)
            ->appends($request->only('search', 'categoria', 'sort', 'dir', 'periodo'));

        $categorias = Tecnologia::query()
            ->whereNotNull('categoria')
            ->where('categoria', '!=', '')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        return view('admin.tecnologias.index', compact(
            'tecnologias', 'categorias', 'search', 'categoria', 'sort', 'dir', 'periodo'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'categoria' => 'required|string|max:100',
        ]);

        Tecnologia::create([
            'nombre' => $request->nombre,
            'categoria' => trim($request->categoria),
        ]);

        return back()->with('success', 'Tecnología creada correctamente');
    }

    public function update(Request $request, $id)
    {
        $tecnologia = Tecnologia::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'categoria' => 'required|string|max:100',
        ]);

        $tecnologia->update([
            'nombre' => $request->nombre,
            'categoria' => trim($request->categoria),
        ]);

        return back()->with('success', 'Tecnología actualizada correctamente');
    }
    
    public function destroy($id)
    {
        $tecnologia = Tecnologia::findOrFail($id);
        
        // Verificar si está en uso en proyectos
        if ($tecnologia->proyectos()->count() > 0) {
            return back()->with('error', 'No se puede eliminar: hay proyectos usando esta tecnología');
        }
        
        $tecnologia->delete();
        
        return back()->with('success', 'Tecnología eliminada correctamente');
    }
}