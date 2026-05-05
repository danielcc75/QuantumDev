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
        $request->validate([
            'nombre' => 'required|string|max:100|unique:categoria,nombre',
        ]);
        
        Categoria::create([
            'nombre' => $request->nombre
        ]);
        
        return redirect()->route('admin.categorias')->with('success', 'Categoría creada correctamente');
    }
    
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:100|unique:categoria,nombre,' . $id . ',id_categoria',
        ]);
        
        $categoria->update([
            'nombre' => $request->nombre
        ]);
        
        return redirect()->route('admin.categorias')->with('success', 'Categoría actualizada correctamente');
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