<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    // 🔹 LISTAR PERFILES
    public function index()
    {
        return Perfil::with('usuario')->get();
    }

    // 🔹 CREAR PERFIL
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:usuarios,id',  // ✅ Cambiado a 'user_id'
            'foto' => 'nullable|string|max:255',
            'biografia' => 'nullable|string',
            'links' => 'nullable|array'  // Para JSON
        ]);

        // ✅ Crear solo los campos permitidos
        return Perfil::create($request->only([
            'user_id', 'foto', 'biografia', 'links'
        ]));
    }

    // 🔹 VER PERFIL
    public function show($id)
    {
        return Perfil::with('usuario')->findOrFail($id);
    }

    // 🔹 ACTUALIZAR PERFIL
    public function update(Request $request, $id)
    {
        $perfil = Perfil::findOrFail($id);
        
        $request->validate([
            'foto' => 'nullable|string|max:255',
            'biografia' => 'nullable|string',
            'links' => 'nullable|array'
        ]);
        
        $perfil->update($request->only([
            'foto', 'biografia', 'links'
        ]));

        return $perfil;
    }

    // 🔹 ELIMINAR PERFIL
    public function destroy($id)
    {
        Perfil::destroy($id);

        return response()->json([
            'mensaje' => 'Perfil eliminado'
        ]);
    }
}