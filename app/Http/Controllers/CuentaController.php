<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CuentaController extends Controller
{
    public function actualizarDatos(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $id = session('usuario_id');

        $validator = Validator::make($request->all(), [
            'nombre'             => 'required|string|max:50',
            'apellido'           => 'required|string|max:50',
            'correo_electronico' => 'required|email|unique:usuario,correo_electronico,' . $id . ',id_usuario',
            'telefono'           => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['ok' => false, 'errors' => $validator->errors()], 422);
        }

        $usuario = Usuario::findOrFail($id);
        $usuario->nombre             = $request->nombre;
        $usuario->apellido           = $request->apellido;
        $usuario->correo_electronico = $request->correo_electronico;
        $usuario->telefono           = $request->telefono;
        $usuario->save();

        session([
            'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido,
            'usuario_email'  => $usuario->correo_electronico,
        ]);

        return response()->json([
            'ok'     => true,
            'nombre' => $usuario->nombre . ' ' . $usuario->apellido,
        ]);
    }

    public function cambiarContrasenia(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $validator = Validator::make($request->all(), [
            'contrasenia_actual'           => 'required',
            'nueva_contrasenia'            => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ], [
            'nueva_contrasenia.confirmed' => 'Las contraseñas nuevas no coinciden.',
        ]);

        if ($validator->fails()) {
            return response()->json(['ok' => false, 'errors' => $validator->errors()], 422);
        }

        $usuario = Usuario::findOrFail(session('usuario_id'));

        if (!Hash::check($request->contrasenia_actual, $usuario->contrasenia)) {
            return response()->json(['ok' => false, 'message' => 'La contraseña actual es incorrecta.'], 422);
        }

        $usuario->contrasenia = Hash::make($request->nueva_contrasenia);
        $usuario->save();

        return response()->json(['ok' => true]);
    }

    public function cambiarVisibilidad(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $request->validate([
            'visibilidad' => 'required|in:publico,privado',
        ]);

        try {
            $perfil = Perfil::where('id_usuario', session('usuario_id'))->firstOrFail();

            if ($request->visibilidad === 'publico') {
                $tieneBiografia  = !empty($perfil->biografia);
                $tieneProyecto   = DB::table('proyectos')->where('id_perfil', $perfil->id_perfil)->whereNull('deleted_at')->exists();
                $tieneExperiencia = DB::table('experiencia_laboral')->where('id_perfil', $perfil->id_perfil)->whereNull('deleted_at')->exists();

                if (!$tieneBiografia && !$tieneProyecto && !$tieneExperiencia) {
                    return response()->json([
                        'ok' => false,
                        'code' => 'perfil_incompleto',
                        'message' => 'Para hacer tu perfil público, primero debes registrar al menos una biografía, un proyecto o una experiencia laboral.',
                    ], 422);
                }
            }

            $perfil->visibilidad = $request->visibilidad;
            $perfil->save();

            return response()->json(['ok' => true, 'visibilidad' => $perfil->visibilidad]);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'No se pudo actualizar la visibilidad: ' . $e->getMessage()], 500);
        }
    }

    public function desactivar(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $request->validate([
            'contrasenia' => 'required|string',
        ]);

        $usuario = Usuario::findOrFail(session('usuario_id'));

        if (!Hash::check($request->contrasenia, $usuario->contrasenia)) {
            return response()->json(['ok' => false, 'message' => 'La contraseña es incorrecta.'], 422);
        }

        try {
            $usuario->estado = 'inactivo';
            $usuario->save();
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'No se pudo desactivar la cuenta: ' . $e->getMessage()], 500);
        }

        $request->session()->flush();

        return response()->json(['ok' => true, 'redirect' => '/']);
    }
}
