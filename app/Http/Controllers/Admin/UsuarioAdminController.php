<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioAdminController extends Controller
{
    // Listado de usuarios
    public function index(Request $request)
    {
        $query = Usuario::with('perfil');
        
        // Búsqueda
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nombre', 'like', "%{$request->search}%")
                  ->orWhere('apellido', 'like', "%{$request->search}%")
                  ->orWhere('correo_electronico', 'like', "%{$request->search}%");
            });
        }
        
        // Filtro por estado
        if ($request->estado && $request->estado != 'todos') {
            $query->where('estado', $request->estado);
        }
        
        // Filtro por rol
        if ($request->rol && $request->rol != 'todos') {
            $isAdmin = $request->rol == 'admin';
            $query->where('is_admin', $isAdmin);
        }
        
        $usuarios = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.usuarios.index', compact('usuarios'));
    }
    
    // Formulario crear usuario
    public function create()
    {
        return view('admin.usuarios.create');
    }
    
    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'correo_electronico' => 'required|email|unique:usuario,correo_electronico',
            'telefono' => 'nullable|string|max:50',
            'contrasenia' => 'required|min:6',
            'is_admin' => 'boolean'
        ]);
        
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo_electronico' => $request->correo_electronico,
            'telefono' => $request->telefono,
            'contrasenia' => Hash::make($request->contrasenia),
            'estado' => 'activo',
            'is_admin' => $request->is_admin ?? false
        ]);
        
        // Crear perfil automáticamente
        Perfil::create(['id_usuario' => $usuario->id_usuario]);
        
        return redirect()->route('admin.usuarios')
            ->with('success', 'Usuario creado correctamente');
    }
    
    public function show($id)
    {
        $usuario = Usuario::with([
            'perfil.experienciasLaborales',
            'perfil.formacionAcademica',
            'perfil.links',
            'perfil.habilidades', 
            'perfil.proyectos'   
        ])->findOrFail($id);
        
        return view('admin.usuarios.show', compact('usuario'));
    }
    
    // Formulario editar usuario
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }
    
    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'correo_electronico' => 'required|email|unique:usuario,correo_electronico,' . $id . ',id_usuario',
            'telefono' => 'nullable|string|max:50',
            'is_admin' => 'boolean'
        ]);
        
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->correo_electronico = $request->correo_electronico;
        $usuario->telefono = $request->telefono;
        $usuario->is_admin = $request->is_admin ?? false;
        
        if ($request->filled('contrasenia')) {
            $usuario->contrasenia = Hash::make($request->contrasenia);
        }
        
        $usuario->save();
        
        return redirect()->route('admin.usuarios')
            ->with('success', 'Usuario actualizado correctamente');
    }
    
    // Cambiar estado (activar/suspender)
    public function toggleEstado($id)
    {
        $usuario = Usuario::findOrFail($id);
        
        // No permitir cambiarse a sí mismo
        if ($usuario->id_usuario == session('usuario_id')) {
            return back()->with('error', 'No puedes cambiar tu propio estado');
        }
        
        $usuario->estado = $usuario->estado == 'activo' ? 'suspendido' : 'activo';
        $usuario->save();
        
        $mensaje = $usuario->estado == 'activo' ? 'activado' : 'suspendido';
        return back()->with('success', "Usuario {$mensaje} correctamente");
    }
    
    // Cambiar rol (usuario ↔ admin)
    public function toggleRol($id)
    {
        $usuario = Usuario::findOrFail($id);
        
        // No permitir cambiarse a sí mismo
        if ($usuario->id_usuario == session('usuario_id')) {
            return back()->with('error', 'No puedes cambiar tu propio rol');
        }
        
        $usuario->is_admin = !$usuario->is_admin;
        $usuario->save();
        
        $rol = $usuario->is_admin ? 'administrador' : 'usuario';
        return back()->with('success', "Rol cambiado a {$rol}");
    }
    
    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        
        // No permitir eliminarse a sí mismo
        if ($usuario->id_usuario == session('usuario_id')) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta');
        }
        
        $usuario->delete();
        
        return redirect()->route('admin.usuarios')
            ->with('success', 'Usuario eliminado correctamente');
    }
}