<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    public function index()
    {
        return Perfil::with('usuario')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario'  => 'required|exists:usuario,id_usuario',
            'foto_perfil' => 'nullable|string|max:255',
            'biografia'   => 'nullable|string',
            'ubicacion'   => 'nullable|string|max:100',
        ]);

        return Perfil::create($request->only([
            'id_usuario', 'foto_perfil', 'biografia', 'ubicacion'
        ]));
    }

    public function show($id)
    {
        return Perfil::with('usuario')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $perfil = Perfil::findOrFail($id);

        $request->validate([
            'foto_perfil' => 'nullable|string|max:255',
            'biografia'   => 'nullable|string',
            'ubicacion'   => 'nullable|string|max:100',
        ]);

        $perfil->update($request->only([
            'foto_perfil', 'biografia', 'ubicacion'
        ]));

        return $perfil;
    }

    public function destroy($id)
    {
        Perfil::destroy($id);

        return response()->json(['mensaje' => 'Perfil eliminado']);
    }
}
