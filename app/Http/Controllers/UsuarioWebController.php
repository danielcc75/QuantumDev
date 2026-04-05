<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioWebController extends Controller
{
    // Mostrar lista de usuarios (VISTA)
    public function index()
    {
        $usuarios = Usuario::with('perfil')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('usuarios.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'telefono' => 'nullable|string|max:20',
            'password' => 'required|min:6'
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password)
        ]);

        // Crear perfil automáticamente
        Perfil::create([
            'user_id' => $usuario->id
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente');
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $usuario = Usuario::with('perfil')->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'telefono' => 'nullable|string|max:20',
            'password' => 'nullable|min:6'
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente');
    }

    // Editar perfil
    public function editPerfil($id)
    {
        $usuario = Usuario::with('perfil')->findOrFail($id);
        return view('perfiles.edit', compact('usuario'));
    }

    // Actualizar perfil
    public function updatePerfil(Request $request, $id)
    {
        $perfil = Perfil::where('user_id', $id)->firstOrFail();

        $request->validate([
            'foto' => 'nullable|url|max:255',
            'biografia' => 'nullable|string|max:1000',
            'links' => 'nullable|json'
        ]);

        $perfil->foto = $request->foto;
        $perfil->biografia = $request->biografia;
        $perfil->links = $request->links;
        $perfil->save();

        return redirect()->route('usuarios.show', $id)
            ->with('success', 'Perfil actualizado exitosamente');
    }
}