<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HabilidadBlanda;
use App\Models\PerfilHabilidadBlanda;

class HabilidadBlandaController extends Controller
{
    public function index()
    {
        $habilidadesBlandas = HabilidadBlanda::orderBy('id_habilidad_blanda', 'desc')->get();

        return view('gestionHabilidadesBlandas.admin', compact('habilidadesBlandas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
        ]);

        HabilidadBlanda::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => 'activo',
        ]);

        return redirect()
            ->route('habilidades-blandas.index')
            ->with('success', 'habilidad blanda registrada correctamente');
    }

    public function toggleEstado($id)
    {
        $habilidad = HabilidadBlanda::findOrFail($id);

        if ($habilidad->estado === 'activo') {
            $habilidad->estado = 'inactivo';
            $mensaje = 'habilidad blanda desactivada correctamente';
        } else {
            $habilidad->estado = 'activo';
            $mensaje = 'habilidad blanda activada correctamente';
        }

        $habilidad->save();

        return redirect()
            ->route('habilidades-blandas.index')
            ->with('success', $mensaje);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $habilidad = HabilidadBlanda::findOrFail($id);

        $habilidad->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('habilidades-blandas.index')
            ->with('success', 'habilidad blanda actualizada correctamente');
    }

    public function destroy($id)
    {
        $habilidad = HabilidadBlanda::findOrFail($id);

        $estaUsada = PerfilHabilidadBlanda::where('id_habilidad_blanda', $id)->exists();

        if ($estaUsada) {
            return redirect()
                ->route('habilidades-blandas.index')
                ->with('error', 'no se puede eliminar porque esta habilidad ya fue seleccionada por usuarios. puedes desactivarla.');
        }

        $habilidad->delete();

        return redirect()
            ->route('habilidades-blandas.index')
            ->with('success', 'habilidad blanda eliminada correctamente');
    }
}