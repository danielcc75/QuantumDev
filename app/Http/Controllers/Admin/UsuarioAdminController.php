<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\LogsActivity;
use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioAdminController extends Controller
{
    use LogsActivity; 

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
        
        // Registrar en bitácora
        $this->logAdminAction(
            'crear_usuario',
            "Usuario creado: {$usuario->nombre} {$usuario->apellido} | Email: {$usuario->correo_electronico}"
        );
        
        return redirect()->route('admin.usuarios')
            ->with('success', 'Usuario creado correctamente');
    }
    
    // Ver detalle de usuario
    public function show($id)
    {
        $usuario = Usuario::with([
            'perfil.experienciasLaborales',
            'perfil.formacionAcademica',
            'perfil.links',
            'perfil.habilidades.categoria',
            'perfil.habilidadesBlandas',
            'perfil.proyectos',
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
        
        $datosAntiguos = "Nombre: {$usuario->nombre} {$usuario->apellido} | Rol: " . ($usuario->is_admin ? 'admin' : 'usuario');
        
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->correo_electronico = $request->correo_electronico;
        $usuario->telefono = $request->telefono;
        $usuario->is_admin = $request->is_admin ?? false;
        
        // Actualizar estado si viene en la solicitud
        if ($request->has('estado')) {
            $usuario->estado = $request->estado;
        }
        
        if ($request->filled('contrasenia')) {
            $usuario->contrasenia = Hash::make($request->contrasenia);
        }
        
        $usuario->save();
        
        $datosNuevos = "Nombre: {$usuario->nombre} {$usuario->apellido} | Rol: " . ($usuario->is_admin ? 'admin' : 'usuario');
        
        // Registrar en bitácora
        $this->logAdminAction(
            'editar_usuario',
            "Usuario ID {$usuario->id_usuario} | Antes: {$datosAntiguos} | Después: {$datosNuevos}"
        );
        
        // Verificar si es una petición AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Usuario actualizado correctamente',
                'usuario' => $usuario
            ]);
        }
        
        return redirect()->route('admin.usuarios')
            ->with('success', 'Usuario actualizado correctamente');
    }
    public function showJson($id)
    {
        try {
            $usuario = User::with([
                'perfil.experienciasLaborales',
                'perfil.proyectos',
                'perfil.habilidades.categoria',
                'perfil.habilidadesBlandas',
                'perfil.formacionAcademica',
                'perfil.links'
            ])->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'usuario' => $usuario
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
    }
    
    // Cambiar estado (activar/suspender)
    public function toggleEstado(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        
        // No permitir cambiarse a sí mismo
        if ($usuario->id_usuario == session('usuario_id')) {
            return back()->with('error', 'No puedes cambiar tu propio estado');
        }
        
        $estadoAnterior = $usuario->estado;
        
        if ($usuario->estado == 'activo') {
            // Motivo opcional (ya no es requerido)
            $motivo = $request->motivo ?? 'Sin motivo especificado';
            $usuario->estado = 'suspendido';
            $usuario->motivo_suspension = $motivo;
            $mensaje = "Usuario suspendido correctamente";
        } else {
            $usuario->estado = 'activo';
            $usuario->motivo_suspension = null;
            $mensaje = "Usuario activado correctamente";
        }
        
        $usuario->save();
        
        // Registrar en bitácora
        $this->logAdminAction(
            'cambio_estado_usuario',
            "Usuario ID {$usuario->id_usuario} ({$usuario->nombre} {$usuario->apellido}) | Estado: {$estadoAnterior} → {$usuario->estado}" . 
            ($usuario->estado == 'suspendido' ? " | Motivo: {$usuario->motivo_suspension}" : '')
        );
        
        return back()->with('success', $mensaje);
    }
        
    // Cambiar rol (usuario ↔ admin)
    public function toggleRol($id)
    {
        $usuario = Usuario::findOrFail($id);
        
        // No permitir cambiarse a sí mismo
        if ($usuario->id_usuario == session('usuario_id')) {
            return back()->with('error', 'No puedes cambiar tu propio rol');
        }
        
        $rolAnterior = $usuario->is_admin ? 'administrador' : 'usuario';
        $usuario->is_admin = !$usuario->is_admin;
        $usuario->save();
        $rolNuevo = $usuario->is_admin ? 'administrador' : 'usuario';
        
        // Registrar en bitácora
        $this->logAdminAction(
            'cambio_rol_usuario',
            "Usuario ID {$usuario->id_usuario} ({$usuario->nombre} {$usuario->apellido}) | Rol: {$rolAnterior} → {$rolNuevo}"
        );
        
        return back()->with('success', "Rol cambiado a {$rolNuevo}");
    }
    
    // Eliminar usuario (deshabilitado)
    public function destroy(Request $request, $id)
    {
        return back()->with('error', 'La eliminación de cuentas está deshabilitada. Usa "Suspender" para bloquear el acceso del usuario.');
    }
    
    public function listadoSimple()
    {
        $usuarios = \App\Models\Usuario::all(['id_usuario', 'nombre', 'apellido', 'correo_electronico']);
        
        return response()->json([
            'success' => true,
            'usuarios' => $usuarios
        ]);
    }

}