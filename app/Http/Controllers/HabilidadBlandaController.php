<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\HabilidadBlanda;
use App\Models\PerfilHabilidadBlanda;
use App\Models\Usuario;

class HabilidadBlandaController extends Controller
{
    public function store(Request $request)
    {
        $nombre = trim($request->nombre ?? '');

        $request->merge(['nombre' => $nombre]);

        $validator = Validator::make($request->all(), [
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('habilidades_blandas', 'nombre')->where(
                    fn($q) => $q->whereRaw('LOWER(nombre) = ?', [mb_strtolower($nombre)])
                ),
            ],
            'descripcion' => 'nullable|string|max:500',
        ], [
            'nombre.unique' => 'ya existe una habilidad blanda con ese nombre',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('active_tab', 'blandas');
        }

        HabilidadBlanda::create([
            'nombre' => $nombre,
            'descripcion' => $request->descripcion,
            'estado' => 'activo',
        ]);

        return redirect()
            ->back()
            ->with('active_tab', 'blandas')
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
            ->back()
            ->with('active_tab', 'blandas')
            ->with('success', $mensaje);
    }

    public function update(Request $request, $id)
    {
        $nombre = trim($request->nombre ?? '');

        $request->merge(['nombre' => $nombre]);

        $validator = Validator::make($request->all(), [
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('habilidades_blandas', 'nombre')
                    ->ignore($id, 'id_habilidad_blanda')
                    ->where(fn($q) => $q->whereRaw('LOWER(nombre) = ?', [mb_strtolower($nombre)])),
            ],
            'descripcion' => 'nullable|string|max:500',
        ], [
            'nombre.unique' => 'ya existe una habilidad blanda con ese nombre',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('active_tab', 'blandas');
        }

        $habilidad = HabilidadBlanda::findOrFail($id);

        $habilidad->update([
            'nombre' => $nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->back()
            ->with('active_tab', 'blandas')
            ->with('success', 'habilidad blanda actualizada correctamente');
    }

    public function destroy($id)
    {
        $habilidad = HabilidadBlanda::findOrFail($id);

        $estaUsada = PerfilHabilidadBlanda::where('id_habilidad_blanda', $id)->exists();

        if ($estaUsada) {
            return redirect()
                ->back()
            ->with('active_tab', 'blandas')
                ->with('error', 'no se puede eliminar porque esta habilidad ya fue seleccionada por usuarios. puedes desactivarla.');
        }

        $habilidad->delete();

        return redirect()
            ->back()
            ->with('active_tab', 'blandas')
            ->with('success', 'habilidad blanda eliminada correctamente');
    }

    public function guardarSeleccionUsuario(Request $request)
    {
        $request->validate([
            'habilidades' => 'nullable|array|max:6'
        ]);

        $usuario = Usuario::with('perfil')->find(session('usuario_id'));

        if (!$usuario || !$usuario->perfil) {
            return response()->json(['ok' => false], 400);
        }

        $perfilId = $usuario->perfil->id_perfil;

        PerfilHabilidadBlanda::where('id_perfil', $perfilId)->delete();

        foreach ($request->habilidades ?? [] as $idHabilidad) {
            PerfilHabilidadBlanda::create([
                'id_perfil' => $perfilId,
                'id_habilidad_blanda' => $idHabilidad,
                'publicado' => false,
            ]);
        }

        return response()->json(['ok' => true]);
    }
}