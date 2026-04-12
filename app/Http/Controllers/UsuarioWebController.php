<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\ExperienciaLaboral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UsuarioWebController extends Controller
{
    // =========================
    // REGISTER (MODIFICADO)
    // =========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'              => 'required|string|max:50',
            'apellido'            => 'required|string|max:50',
            'correo_electronico'  => 'required|email|unique:usuario,correo_electronico',
            'telefono'            => 'nullable|string|max:50',
            'contrasenia'         => 'required|min:6|confirmed'
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
            'estado'             => 'activo'
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

    // =========================
    // LOGIN (NUEVO)
    // =========================
    public function login(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email',
            'contrasenia' => 'required'
        ]);

        $usuario = Usuario::where('correo_electronico', $request->correo_electronico)
            ->where('estado', 'activo')
            ->first();

        if (!$usuario || !Hash::check($request->contrasenia, $usuario->contrasenia)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'message' => 'El correo o la contraseña no son correctos.'
                ], 422);
            }

            return redirect('/')->with('error_login', 'El correo o la contraseña no son correctos.');
        }

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

    // =========================
    // DASHBOARD (NUEVO)
    // =========================
    public function dashboard()
    {
        if (!session('usuario_id')) {
            return redirect('/');
        }

        $usuario = Usuario::with('perfil')->find(session('usuario_id'));

        return view('dashboard', compact('usuario'));
    }

    // =========================
    // LOGOUT (NUEVO)
    // =========================
    public function logout(Request $request)
    {
        $request->session()->forget(['usuario_id', 'usuario_nombre', 'usuario_email']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // =========================
    // LO DEMÁS NO LO TOQUÉ
    // =========================

    public function index()
    {
        $usuarios = Usuario::with('perfil')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function show($id)
    {
        $usuario = Usuario::with('perfil')->findOrFail($id);

        $perfilLinks = [];
        $experiencias = collect();
        if ($usuario->perfil) {
            $linksRows = DB::table('perfil_links')
                ->where('id_perfil', $usuario->perfil->id_perfil)
                ->get();
            foreach ($linksRows as $link) {
                $perfilLinks[$link->tipo] = $link->url;
            }
            $experiencias = ExperienciaLaboral::where('id_perfil', $usuario->perfil->id_perfil)->get();
        }

        return view('usuarios.show', compact('usuario', 'perfilLinks', 'experiencias'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre'             => 'required|string|max:50',
            'apellido'           => 'required|string|max:50',
            'correo_electronico' => 'required|email|unique:usuario,correo_electronico,' . $id . ',id_usuario',
            'telefono'           => 'nullable|string|max:50',
            'contrasenia'        => 'nullable|min:6'
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->correo_electronico = $request->correo_electronico;
        $usuario->telefono = $request->telefono;

        if ($request->filled('contrasenia')) {
            $usuario->contrasenia = Hash::make($request->contrasenia);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy($id)
    {
        Usuario::findOrFail($id)->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente');
    }
}