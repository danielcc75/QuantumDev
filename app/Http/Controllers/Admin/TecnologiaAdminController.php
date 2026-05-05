<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tecnologia;
use Illuminate\Http\Request;

class TecnologiaAdminController extends Controller
{
    public function index()
    {
        $tecnologias = Tecnologia::paginate(15);
        return view('admin.tecnologias.index', compact('tecnologias'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'categoria' => 'required|string|max:100'
        ]);
        
        Tecnologia::create($request->only(['nombre', 'categoria']));
        
        return back()->with('success', 'Tecnología creada correctamente');
    }
    
    public function update(Request $request, $id)
    {
        $tecnologia = Tecnologia::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:100',
            'categoria' => 'required|string|max:100'
        ]);
        
        $tecnologia->update($request->only(['nombre', 'categoria']));
        
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