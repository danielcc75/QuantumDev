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

   public function updatePerfil(Request $request, $id)
{
    try {
        // Actualizar nombre y apellido en la tabla usuarios
        $usuario = Usuario::findOrFail($id);
        
        if ($request->filled('nombre')) {
            $usuario->nombre = $request->nombre;
        }
        if ($request->filled('apellido')) {
            $usuario->apellido = $request->apellido;
        }
        $usuario->save();

        if ($request->filled('email')) {
            $usuario->email = $request->email;
        }
        $usuario->save();
        
        // Actualizar perfil (biografia y links)
        $perfil = Perfil::where('user_id', $id)->first();
        
        if (!$perfil) {
            return response()->json([
                'success' => false,
                'message' => 'Perfil no encontrado'
            ], 404);
        }
        
        if ($request->filled('biografia')) {
            $perfil->biografia = $request->biografia;
        }
        
        if ($request->filled('links')) {
            $perfil->links = $request->links;
        }
        
        $perfil->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Perfil actualizado correctamente'
        ]);
        
    } catch (\Exception $e) {
        Log::error('Error en updatePerfil: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

}