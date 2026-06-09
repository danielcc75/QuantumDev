<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $usuario = Usuario::with('perfil')->find(session('usuario_id'));

        if (!$usuario || !$usuario->perfil) {
            return back()->with('error', 'Usuario o perfil inválido');
        }

        $idPerfil = $usuario->perfil->id_perfil;
        $nombre   = trim($request->nombreHabilidad ?? '');
        $request->merge(['nombreHabilidad' => $nombre]);

        $request->validate([
            'nombreHabilidad'   => [
                'required', 'string', 'max:100',
                Rule::unique('habilidades', 'nombre')
                    ->where(fn($q) => $q->where('id_perfil', $idPerfil)
                        ->whereNull('deleted_at')
                        ->whereRaw('LOWER(nombre) = ?', [mb_strtolower($nombre)])),
            ],
            'categoria'         => 'required|exists:categoria,id_categoria',
            'anosExperiencia'   => 'required|integer|min:0',
            'descripcion'       => 'required|string|min:0|max:500',
        ], [
            'nombreHabilidad.unique' => __('general.habilidades.duplicado'),
        ]);

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
        $habilidad = Habilidad::findOrFail($id);

        $nombre = trim($request->nombreHabilidad ?? '');
        $request->merge(['nombreHabilidad' => $nombre]);

        $request->validate([
            'nombreHabilidad'   => [
                'required', 'string', 'max:100',
                Rule::unique('habilidades', 'nombre')
                    ->ignore($id, 'id_habilidad')
                    ->where(fn($q) => $q->where('id_perfil', $habilidad->id_perfil)
                        ->whereNull('deleted_at')
                        ->whereRaw('LOWER(nombre) = ?', [mb_strtolower($nombre)])),
            ],
            'categoria'         => 'required|exists:categoria,id_categoria',
            'anosExperiencia'   => 'required|integer|min:0',
            'descripcion'       => 'required|string|min:0|max:500',
        ], [
            'nombreHabilidad.unique' => __('general.habilidades.duplicado'),
        ]);

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