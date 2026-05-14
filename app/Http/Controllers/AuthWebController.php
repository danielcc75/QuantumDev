<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\Categoria;
use App\Models\Habilidad;
use App\Models\HabilidadBlanda;
use App\Models\PerfilHabilidadBlanda;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthWebController extends Controller
{
    use LogsActivity;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'              => 'required|string|max:50',
            'apellido'            => 'required|string|max:50',
            'correo_electronico'  => 'required|email|unique:usuario,correo_electronico',
            'telefono'            => 'nullable|string|max:50',
            'contrasenia' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ]
        ], [
            'contrasenia.confirmed' => 'Las contraseñas no coinciden.',
            'correo_electronico.unique' => 'Ese correo electrónico ya está registrado.'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        $usuario = Usuario::create([
            'nombre'             => $request->nombre,
            'apellido'           => $request->apellido,
            'correo_electronico' => $request->correo_electronico,
            'telefono'           => $request->telefono,
            'contrasenia'        => Hash::make($request->contrasenia),
            'estado'             => 'activo',
            'ultimo_acceso'      => now(),
        ]);

        Perfil::create([
            'id_usuario' => $usuario->id_usuario
        ]);

        session([
            'usuario_id' => $usuario->id_usuario,
            'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido,
            'usuario_email' => $usuario->correo_electronico
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'redirect' => route('dashboard')
            ]);
        }

        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email',
            'contrasenia' => 'required'
        ]);

        $usuario = Usuario::where('correo_electronico', $request->correo_electronico)->first();

        if (!$usuario || !Hash::check($request->contrasenia, $usuario->contrasenia)) {
            if ($request->expectsJson()) {
                $this->logSecurity(
                    'login_fallido',
                    "Intento de login fallido con email: {$request->correo_electronico}"
                );
                return response()->json([
                    'ok' => false,
                    'message' => 'El correo o la contraseña no son correctos.'
                ], 422);
            }
            return redirect('/')->with('error_login', 'El correo o la contraseña no son correctos.');
        }

        if ($usuario->estado !== 'activo') {
            $mensaje = 'Tu cuenta ha sido suspendida. Ponte en contacto con el administrador para más información.';
            $this->logSecurity(
                'login_suspendido',
                "Intento de login de cuenta suspendida: {$usuario->correo_electronico}"
            );
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'message' => $mensaje
                ], 403);
            }
            return redirect('/')->with('error_login', $mensaje);
        }

        $usuario->ultimo_acceso = now();
        $usuario->save();

        session([
            'usuario_id' => $usuario->id_usuario,
            'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido,
            'usuario_email' => $usuario->correo_electronico
        ]);

        $redirectRoute = $usuario->is_admin ? route('admin.dashboard') : route('dashboard');

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'redirect' => $redirectRoute
            ]);
        }

        return redirect($redirectRoute);
    }

    public function dashboard()
    {
        if (!session('usuario_id')) {
            return redirect('/');
        }

        $usuario = Usuario::with('perfil')->find(session('usuario_id'));

        if ($usuario && $usuario->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        $categorias = Categoria::all();

        $habilidades = Habilidad::with('categoria')
            ->where('id_perfil', $usuario->perfil->id_perfil)
            ->get();

        $habilidadesBlandasActivas = HabilidadBlanda::where('estado', 'activo')
            ->orderBy('nombre', 'asc')
            ->get();

        $habilidadesBlandasSeleccionadas = PerfilHabilidadBlanda::where('id_perfil', $usuario->perfil->id_perfil)
            ->pluck('id_habilidad_blanda')
            ->toArray();

        return view('dashboard', compact(
            'usuario',
            'categorias',
            'habilidades',
            'habilidadesBlandasActivas',
            'habilidadesBlandasSeleccionadas'
        ));
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['usuario_id', 'usuario_nombre', 'usuario_email']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
