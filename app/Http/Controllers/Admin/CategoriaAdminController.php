<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaAdminController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount('habilidades')->paginate(15);
        return view('admin.categorias.index', compact('categorias'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:categoria,nombre',
            'imagen' => 'required|url|max:250',
        ]);

        Categoria::create($validated);

        return back()->with('success', 'Categoría creada correctamente');
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:categoria,nombre,' . $id . ',id_categoria',
            'imagen' => 'required|url|max:250',
        ]);

        $categoria->update($validated);

        return back()->with('success', 'Categoría actualizada correctamente');
    }
    
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        
        if ($categoria->habilidades()->count() > 0) {
            return back()->with('error', 'No se puede eliminar: hay habilidades usando esta categoría');
        }
        
        $categoria->delete();
        
        return back()->with('success', 'Categoría eliminada correctamente');
    }
}