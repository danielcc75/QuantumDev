<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\PerfilLink;
use App\Models\Educacion;
use App\Models\ExperienciaLaboral;
use App\Models\Categoria;
use App\Models\Habilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


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
        $categorias = Categoria::all();

        // 🔥 TRAER habilidades del usuario con su categoría
        $habilidades = Habilidad::with('categoria')  
            ->where('id_perfil', $usuario->perfil->id_perfil)
            ->get();
 
        return view('dashboard', compact('usuario', 'categorias', 'habilidades'));
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

    // PERFIL
    public function verPerfil()
    {
        if (!session('usuario_id')) {
            return redirect('/');
        }

        // Cargar usuario con todas sus relaciones usando MODELOS
        $usuario = Usuario::with([
            'perfil.experienciasLaborales',
            'perfil.formacionAcademica', 
            'perfil.links'
        ])->find(session('usuario_id'));

        return view('gestionarPerfil.perfil', compact('usuario'));
    }

    // =========================
    // FORMULARIO EDITAR PERFIL (devuelve datos JSON para el modal)
    // =========================
    public function editarPerfil()
    {
        if (!session('usuario_id')) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $usuario = Usuario::with([
            'perfil.experienciasLaborales',
            'perfil.formacionAcademica',
            'perfil.links'
        ])->find(session('usuario_id'));

        return response()->json([
            'usuario' => $usuario,
            'perfil' => $usuario->perfil,
            'experiencias' => $usuario->perfil->experienciasLaborales ?? [],
            'educaciones' => $usuario->perfil->formacionAcademica ?? [],
            'links' => $usuario->perfil->links ?? []
        ]);
    }

    // =========================
    // ACTUALIZAR PERFIL COMPLETO
    // =========================
    public function actualizarPerfil(Request $request)
    {
        if (!session('usuario_id')) {
            return redirect('/');
        }

        $usuario = Usuario::find(session('usuario_id'));
        $perfil = $usuario->perfil;

        // Si no existe perfil, crearlo
        if (!$perfil) {
            $perfil = Perfil::create(['id_usuario' => $usuario->id_usuario]);
        }

        // Validar datos
        $request->validate([
            // Datos de usuario
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'telefono' => 'nullable|string|max:50',
            'correo_electronico' => 'required|email|unique:usuario,correo_electronico,' . $usuario->id_usuario . ',id_usuario',
            
            // Datos de perfil
            'biografia' => 'nullable|string',
            'ubicacion' => 'nullable|string|max:100',
            'foto_perfil' => 'nullable|string|max:255',
            //'titulo_profesional' => 'nullable|string|max:100',
            
            // Links
            'link_github' => 'nullable|url',
            'link_linkedin' => 'nullable|url',
            'link_twitter' => 'nullable|url',
            'link_portfolio' => 'nullable|url',
            
            // Experiencias (array)
            'experiencias' => 'nullable|array',
            'experiencias.*.id_experiencia' => 'nullable|exists:experiencia_laboral,id_experiencia',
            'experiencias.*.empresa' => 'required|string|max:150',
            'experiencias.*.cargo' => 'required|string|max:100',
            'experiencias.*.descripcion' => 'nullable|string',
            'experiencias.*.fecha_ini' => 'required|date',
            'experiencias.*.fecha_fin' => 'nullable|date|after_or_equal:fecha_ini',
            'experiencias.*.trabajo_actual' => 'boolean',
            
            // Educación (array)
            'educaciones' => 'nullable|array',
            'educaciones.*.id_formacion' => 'nullable|exists:formacion_academica,id_formacion',
            'educaciones.*.titulo' => 'required|string|max:150',
            'educaciones.*.institucion' => 'required|string|max:150',
            'educaciones.*.nivel' => 'required|string|max:50',
            'educaciones.*.descripcion' => 'nullable|string',
            'educaciones.*.fecha_ini' => 'required|date',
            'educaciones.*.fecha_fin' => 'nullable|date|after_or_equal:fecha_ini',
        ]);

        // Actualizar datos de usuario
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->telefono = $request->telefono;
        $usuario->correo_electronico = $request->correo_electronico;
        $usuario->save();

        // Actualizar perfil
        $perfil->biografia = $request->biografia;
        $perfil->ubicacion = $request->ubicacion;
        $perfil->foto_perfil = $request->foto_perfil;
        //$perfil->titulo_profesional = $request->titulo_profesional;
        $perfil->save();

        // Actualizar links (eliminar viejos y crear nuevos)
        if ($perfil->links) {
            foreach ($perfil->links as $link) {
                $link->delete();
            }
        }
        
        $linkTypes = ['github', 'linkedin', 'twitter', 'portfolio'];
        foreach ($linkTypes as $type) {
            $linkUrl = $request->input('link_' . $type);
            if ($linkUrl) {
                PerfilLink::create([
                    'id_perfil' => $perfil->id_perfil,
                    'tipo' => $type,
                    'url' => $linkUrl
                ]);
            }
        }

        // Actualizar experiencias laborales
        if ($request->has('experiencias')) {
            // Eliminar experiencias que no vienen en el request
            $idsRecibidos = collect($request->experiencias)->pluck('id_experiencia')->filter();
            $perfil->experienciasLaborales()->whereNotIn('id_experiencia', $idsRecibidos)->delete();
            
            // Crear o actualizar experiencias
            foreach ($request->experiencias as $expData) {
                if (isset($expData['id_experiencia']) && $expData['id_experiencia']) {
                    // Actualizar existente
                    $experiencia = ExperienciaLaboral::find($expData['id_experiencia']);
                    if ($experiencia && $experiencia->id_perfil == $perfil->id_perfil) {
                        $experiencia->update($expData);
                    }
                } else {
                    // Crear nueva
                    $expData['id_perfil'] = $perfil->id_perfil;
                    ExperienciaLaboral::create($expData);
                }
            }
        } else {
            // Si no vienen experiencias, eliminar todas
            $perfil->experienciasLaborales()->delete();
        }

        // Actualizar formación académica
        if ($request->has('educaciones')) {
            $idsRecibidos = collect($request->educaciones)->pluck('id_formacion')->filter();
            $perfil->formacionAcademica()->whereNotIn('id_formacion', $idsRecibidos)->delete();
            
            foreach ($request->educaciones as $eduData) {
                if (isset($eduData['id_formacion']) && $eduData['id_formacion']) {
                    $educacion = Educacion::find($eduData['id_formacion']);
                    if ($educacion && $educacion->id_perfil == $perfil->id_perfil) {
                        $educacion->update($eduData);
                    }
                } else {
                    $eduData['id_perfil'] = $perfil->id_perfil;
                    Educacion::create($eduData);
                }
            }
        } else {
            $perfil->formacionAcademica()->delete();
        }

        // Actualizar sesión
        session([
            'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido,
            'usuario_email' => $usuario->correo_electronico
        ]);

        return response()->json(['success' => true, 'message' => 'Perfil actualizado correctamente']);

    }
}