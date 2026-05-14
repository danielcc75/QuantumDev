<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habilidad;
use App\Models\Categoria;
use App\Models\Usuario;

class HabilidadController extends Controller
{
    // =========================
    // FORM CREAR
    // =========================
    public function create()
    {
        $categorias = Categoria::all();
        return view('gestionHabilidades.crear', compact('categorias'));
    }

    // =========================
    // GUARDAR NUEVA HABILIDAD
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nombreHabilidad'   => 'required|string|max:100',
            'categoria'         => 'required|exists:categoria,id_categoria',
            'anosExperiencia'   => 'required|integer|min:0',
            'descripcion'       => 'required|string|min:0|max:500',
        ]);

        $usuario = Usuario::with('perfil')->find(session('usuario_id'));

        if (!$usuario || !$usuario->perfil) {
            return back()->with('error', 'Usuario o perfil inválido');
        }

        Habilidad::create([
            'nombre'             => $request->nombreHabilidad,
            'id_categoria'       => $request->categoria,
            'anios_experiencia'  => $request->anosExperiencia,
            'descripcion'        => $request->descripcion,
            'id_perfil'          => $usuario->perfil->id_perfil,
            'publicado'          => false,
        ]);

        return redirect(route('dashboard') . '?seccion=habilidades')
            ->with('success', 'Habilidad creada correctamente');
    }

    // =========================
    // FORM EDITAR (MODAL O VIEW)
    // =========================
    public function edit($id)
    {
        $habilidad = Habilidad::findOrFail($id);
        $categorias = Categoria::all();

        return view('gestionHabilidades.EditHabilidad', compact('habilidad', 'categorias'));
    }

    // =========================
    // ACTUALIZAR HABILIDAD
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreHabilidad'   => 'required|string|max:100',
            'categoria'         => 'required|exists:categoria,id_categoria',
            'anosExperiencia'   => 'required|integer|min:0',
            'descripcion'       => 'required|string|min:0|max:500',
        ]);

        $habilidad = Habilidad::findOrFail($id);

        $habilidad->update([
            'nombre'             => $request->nombreHabilidad,
            'id_categoria'       => $request->categoria,
            'anios_experiencia'  => $request->anosExperiencia,
            'descripcion'        => $request->descripcion,
        ]);

        return redirect(route('dashboard') . '?seccion=habilidades')
            ->with('success', 'Habilidad actualizada correctamente');
    }

    // =========================
    // ELIMINAR HABILIDAD
    // =========================
    public function destroy($id)
    {
        $habilidad = Habilidad::findOrFail($id);
        $habilidad->deleted_by = session('usuario_id');
        $habilidad->delete_reason = 'Eliminada por el usuario';
        $habilidad->delete();

        return redirect(route('dashboard') . '?seccion=habilidades')->with('success', 'Habilidad eliminada correctamente');
    }
}