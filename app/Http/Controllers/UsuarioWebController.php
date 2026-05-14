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
use App\Models\HabilidadBlanda;
use App\Models\PerfilHabilidadBlanda;
use App\Traits\LogsActivity;


class UsuarioWebController extends Controller
{
    use LogsActivity;
    
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

        session([
            'usuario_id' => $usuario->id_usuario,
            'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido,
            'usuario_email' => $usuario->correo_electronico
        ]);

        //Redirigir según el rol
        $redirectRoute = $usuario->is_admin ? route('admin.dashboard') : route('dashboard');

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'redirect' => $redirectRoute
            ]);
        }

        return redirect($redirectRoute);
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
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function show($id)
    {
        $usuario = Usuario::with('perfil')->findOrFail($id);

        // Bloquea la vista pública si el perfil es privado y el visitante no es el dueño
        $esDueno = session('usuario_id') == $usuario->id_usuario;
        if ($usuario->perfil && ($usuario->perfil->visibilidad ?? 'publico') === 'privado' && !$esDueno) {
            abort(404);
        }

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

        return view('admin.usuarios.show', compact('usuario', 'perfilLinks', 'experiencias'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
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

    // =========================
    // CONFIGURACIÓN DE CUENTA
    // =========================

    public function actualizarDatosCuenta(Request $request)
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

    // =========================
    // PUBLICACIÓN DE PORTAFOLIO
    // =========================
    public function datosPortafolio()
    {
        if (!session('usuario_id')) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $perfil = Perfil::where('id_usuario', session('usuario_id'))->first();
        if (!$perfil) {
            return response()->json(['ok' => false, 'message' => 'Perfil no encontrado'], 404);
        }

        $tecnicas = DB::table('habilidades')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->get(['id_habilidad', 'nombre', 'anios_experiencia', 'publicado'])
            ->map(function ($h) {
                return [
                    'id'         => $h->id_habilidad,
                    'nombre'     => $h->nombre,
                    'nivel'      => $this->nivelDesdeAnios($h->anios_experiencia),
                    'publicado'  => (bool) $h->publicado,
                ];
            });

        $blandas = DB::table('perfil_habilidad_blanda as phb')
            ->join('habilidades_blandas as hb', 'hb.id_habilidad_blanda', '=', 'phb.id_habilidad_blanda')
            ->where('phb.id_perfil', $perfil->id_perfil)
            ->get(['phb.id_perfil_habilidad_blanda', 'hb.nombre', 'phb.publicado'])
            ->map(function ($b) {
                return [
                    'id'        => $b->id_perfil_habilidad_blanda,
                    'nombre'    => $b->nombre,
                    'publicado' => (bool) $b->publicado,
                ];
            });

        $experiencia = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->get(['id_experiencia', 'empresa', 'cargo', 'fecha_ini', 'fecha_fin', 'trabajo_actual', 'publicado'])
            ->map(function ($e) {
                $ini = $e->fecha_ini ? \Carbon\Carbon::parse($e->fecha_ini)->format('M Y') : '';
                $fin = $e->trabajo_actual ? 'Actualidad' : ($e->fecha_fin ? \Carbon\Carbon::parse($e->fecha_fin)->format('M Y') : '');
                return [
                    'id'        => $e->id_experiencia,
                    'nombre'    => $e->cargo,
                    'detalle'   => trim($e->empresa . ($ini ? ' · ' . $ini . ($fin ? ' - ' . $fin : '') : '')),
                    'publicado' => (bool) $e->publicado,
                ];
            });

        $educacion = DB::table('formacion_academica')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->get(['id_formacion', 'titulo', 'institucion', 'nivel', 'publicado'])
            ->map(function ($f) {
                return [
                    'id'        => $f->id_formacion,
                    'nombre'    => $f->titulo,
                    'detalle'   => trim($f->institucion . ($f->nivel ? ' · ' . $f->nivel : '')),
                    'publicado' => (bool) $f->publicado,
                ];
            });

        $proyectos = DB::table('proyectos')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->get(['id_proyecto', 'nombre', 'descripcion', 'visible'])
            ->map(function ($p) {
                return [
                    'id'        => $p->id_proyecto,
                    'nombre'    => $p->nombre,
                    'detalle'   => \Illuminate\Support\Str::limit($p->descripcion ?? '', 80),
                    'publicado' => (bool) $p->visible,
                ];
            });

        return response()->json([
            'ok'           => true,
            'visibilidad'  => $perfil->visibilidad ?? 'privado',
            'slug'         => 'mi-perfil',
            'tecnicas'     => $tecnicas,
            'blandas'      => $blandas,
            'experiencia'  => $experiencia,
            'educacion'    => $educacion,
            'proyectos'    => $proyectos,
        ]);
    }

    public function publicarPortafolio(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $request->validate([
            'tecnicas'    => 'array',
            'tecnicas.*'  => 'integer',
            'blandas'     => 'array',
            'blandas.*'   => 'integer',
            'experiencia' => 'array',
            'experiencia.*' => 'integer',
            'educacion'   => 'array',
            'educacion.*' => 'integer',
            'proyectos'   => 'array',
            'proyectos.*' => 'integer',
        ]);

        $perfil = Perfil::where('id_usuario', session('usuario_id'))->firstOrFail();

        $tieneBiografia  = !empty($perfil->biografia);
        $tieneProyecto   = DB::table('proyectos')->where('id_perfil', $perfil->id_perfil)->whereNull('deleted_at')->exists();
        $tieneExperiencia = DB::table('experiencia_laboral')->where('id_perfil', $perfil->id_perfil)->whereNull('deleted_at')->exists();

        if (!$tieneBiografia && !$tieneProyecto && !$tieneExperiencia) {
            return response()->json([
                'ok' => false,
                'code' => 'perfil_incompleto',
                'message' => 'Para publicar tu portafolio necesitas al menos una biografía, un proyecto o una experiencia laboral.',
            ], 422);
        }

        try {
            DB::transaction(function () use ($request, $perfil) {
                $tecnicas    = $request->input('tecnicas', []);
                $blandas     = $request->input('blandas', []);
                $experiencia = $request->input('experiencia', []);
                $educacion   = $request->input('educacion', []);
                $proyectos   = $request->input('proyectos', []);

                DB::table('habilidades')->where('id_perfil', $perfil->id_perfil)
                    ->whereNull('deleted_at')
                    ->update(['publicado' => DB::raw('false')]);
                if (!empty($tecnicas)) {
                    DB::table('habilidades')->where('id_perfil', $perfil->id_perfil)
                        ->whereNull('deleted_at')
                        ->whereIn('id_habilidad', $tecnicas)
                        ->update(['publicado' => DB::raw('true')]);
                }

                DB::table('perfil_habilidad_blanda')->where('id_perfil', $perfil->id_perfil)
                    ->update(['publicado' => DB::raw('false')]);
                if (!empty($blandas)) {
                    DB::table('perfil_habilidad_blanda')->where('id_perfil', $perfil->id_perfil)
                        ->whereIn('id_perfil_habilidad_blanda', $blandas)
                        ->update(['publicado' => DB::raw('true')]);
                }

                DB::table('experiencia_laboral')->where('id_perfil', $perfil->id_perfil)
                    ->whereNull('deleted_at')
                    ->update(['publicado' => DB::raw('false')]);
                if (!empty($experiencia)) {
                    DB::table('experiencia_laboral')->where('id_perfil', $perfil->id_perfil)
                        ->whereNull('deleted_at')
                        ->whereIn('id_experiencia', $experiencia)
                        ->update(['publicado' => DB::raw('true')]);
                }

                DB::table('formacion_academica')->where('id_perfil', $perfil->id_perfil)
                    ->whereNull('deleted_at')
                    ->update(['publicado' => DB::raw('false')]);
                if (!empty($educacion)) {
                    DB::table('formacion_academica')->where('id_perfil', $perfil->id_perfil)
                        ->whereNull('deleted_at')
                        ->whereIn('id_formacion', $educacion)
                        ->update(['publicado' => DB::raw('true')]);
                }

                DB::table('proyectos')->where('id_perfil', $perfil->id_perfil)
                    ->whereNull('deleted_at')
                    ->update(['visible' => DB::raw('false')]);
                if (!empty($proyectos)) {
                    DB::table('proyectos')->where('id_perfil', $perfil->id_perfil)
                        ->whereNull('deleted_at')
                        ->whereIn('id_proyecto', $proyectos)
                        ->update(['visible' => DB::raw('true')]);
                }

                $perfil->visibilidad = 'publico';
                $perfil->save();
            });

            return response()->json(['ok' => true, 'visibilidad' => 'publico']);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'No se pudo publicar: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Devuelve el portafolio del usuario en el mismo formato que consume el
     * modal público (welcome.blade.php), filtrado por la selección actual
     * que el usuario tiene en el modal "Publicar". Sirve para Vista previa.
     */
    public function previewPortafolio(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $perfil = Perfil::where('id_usuario', session('usuario_id'))->first();
        if (!$perfil) {
            return response()->json(['ok' => false, 'message' => 'Perfil no encontrado'], 404);
        }

        $sel = [
            'tecnicas'    => array_map('intval', (array) $request->input('tecnicas', [])),
            'blandas'     => array_map('intval', (array) $request->input('blandas', [])),
            'experiencia' => array_map('intval', (array) $request->input('experiencia', [])),
            'educacion'   => array_map('intval', (array) $request->input('educacion', [])),
            'proyectos'   => array_map('intval', (array) $request->input('proyectos', [])),
        ];

        $usuario = DB::table('usuario')->where('id_usuario', session('usuario_id'))->first();
        $nombre  = trim(($usuario->nombre ?? '') . ' ' . ($usuario->apellido ?? ''));

        // Cargo más reciente
        $cargo = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->value('cargo') ?? 'Desarrollador';

        // Links sociales
        $linksRows = DB::table('perfil_links')->where('id_perfil', $perfil->id_perfil)->get();
        $links = [];
        foreach ($linksRows as $l) { $links[strtolower($l->tipo)] = $l->url; }

        // Habilidades técnicas agrupadas por categoría (filtradas por selección)
        $habGrupos = DB::table('habilidades as h')
            ->leftJoin('categoria as c', 'h.id_categoria', '=', 'c.id_categoria')
            ->where('h.id_perfil', $perfil->id_perfil)
            ->whereNull('h.deleted_at')
            ->whereIn('h.id_habilidad', $sel['tecnicas'] ?: [0])
            ->select('h.nombre', 'c.nombre as categoria')
            ->get()
            ->groupBy(fn($r) => $r->categoria ?? 'Otras')
            ->map(fn($g) => $g->pluck('nombre')->all());

        // Habilidades blandas (filtradas)
        $habBlandas = DB::table('perfil_habilidad_blanda as phb')
            ->join('habilidades_blandas as hb', 'phb.id_habilidad_blanda', '=', 'hb.id_habilidad_blanda')
            ->where('phb.id_perfil', $perfil->id_perfil)
            ->whereIn('phb.id_perfil_habilidad_blanda', $sel['blandas'] ?: [0])
            ->pluck('hb.nombre')
            ->all();

        // Proyectos seleccionados por experiencia (para "Proyectos relacionados")
        $proyectosPorExp = DB::table('proyectos')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->whereIn('id_proyecto', $sel['proyectos'] ?: [0])
            ->whereNotNull('id_experiencia')
            ->get()
            ->groupBy('id_experiencia');

        // Experiencias filtradas
        $experiencias = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->whereIn('id_experiencia', $sel['experiencia'] ?: [0])
            ->orderByDesc('fecha_ini')
            ->get()
            ->map(function ($e) use ($proyectosPorExp) {
                $vinculados = ($proyectosPorExp->get($e->id_experiencia) ?? collect())
                    ->map(fn($pr) => [
                        'id_proyecto' => $pr->id_proyecto,
                        'nombre'      => $pr->nombre,
                        'url_link'    => $pr->url_link ?? null,
                    ])->values()->all();
                return [
                    'cargo'          => $e->cargo,
                    'empresa'        => $e->empresa,
                    'descripcion'    => $e->descripcion,
                    'fecha_ini'      => $e->fecha_ini,
                    'fecha_fin'      => $e->fecha_fin,
                    'trabajo_actual' => (bool) $e->trabajo_actual,
                    'proyectos'      => $vinculados,
                ];
            })->all();

        // Proyectos seleccionados
        $proyectosLista = DB::table('proyectos')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->whereIn('id_proyecto', $sel['proyectos'] ?: [0])
            ->orderByDesc('fecha_ini')
            ->get()
            ->map(fn($pr) => [
                'id_proyecto' => $pr->id_proyecto,
                'nombre'      => $pr->nombre,
                'descripcion' => $pr->descripcion,
                'url_link'    => $pr->url_link,
                'fecha_ini'   => $pr->fecha_ini,
                'fecha_fin'   => $pr->fecha_fin,
                'estado'      => $pr->estado,
                'tecnologias' => $pr->tecnologias,
            ])->all();

        // Formación filtrada
        $formacion = DB::table('formacion_academica')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->whereIn('id_formacion', $sel['educacion'] ?: [0])
            ->orderByDesc('fecha_ini')
            ->get()
            ->map(fn($f) => [
                'titulo'      => $f->titulo,
                'institucion' => $f->institucion,
                'nivel'       => $f->nivel,
                'descripcion' => $f->descripcion,
                'fecha_ini'   => $f->fecha_ini,
                'fecha_fin'   => $f->fecha_fin,
            ])->all();

        // Cálculo de años de experiencia (sólo seleccionadas)
        $meses = 0;
        $exps  = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereIn('id_experiencia', $sel['experiencia'] ?: [0])
            ->whereNull('deleted_at')->get();
        foreach ($exps as $e) {
            $ini = \Carbon\Carbon::parse($e->fecha_ini);
            $fin = ($e->trabajo_actual || !$e->fecha_fin) ? \Carbon\Carbon::now() : \Carbon\Carbon::parse($e->fecha_fin);
            $meses += max(0, $ini->diffInMonths($fin));
        }
        $aniosNum = (int) floor($meses / 12);

        $cntEmpresas = collect($exps)->pluck('empresa')->unique()->count();
        $cntProy = count($proyectosLista);
        $cntHabs = collect($habGrupos)->flatten()->count();

        $usuarioNombre = $usuario->nombre ?? 'U';
        $usuarioApellido = $usuario->apellido ?? '';

        $portafolio = [
            'id_perfil'           => $perfil->id_perfil,
            'nombre'              => $nombre ?: 'Mi perfil',
            'iniciales'           => strtoupper(substr($usuarioNombre, 0, 1) . substr($usuarioApellido, 0, 1)),
            'rol'                 => $cargo,
            'descripcion'         => $perfil->biografia ?: '',
            'tags'                => [],
            'tags_extra'          => 0,
            'anios'               => $aniosNum > 0 ? ($aniosNum . ' año' . ($aniosNum === 1 ? '' : 's')) : ($meses > 0 ? 'Menos de 1 año' : 'Sin experiencia registrada'),
            'anios_num'           => $aniosNum,
            'proyectos'           => $cntProy . ' proyecto' . ($cntProy === 1 ? '' : 's'),
            'cnt_proy'            => $cntProy,
            'cnt_habs'            => $cntHabs,
            'cnt_empresas'        => $cntEmpresas,
            'ubicacion'           => $perfil->ubicacion ?: 'Sin ubicación',
            'email'               => $usuario->correo_electronico ?? null,
            'telefono'            => $usuario->telefono ?? null,
            'links'               => $links,
            'habilidades_grupos'  => $habGrupos,
            'habilidades_blandas' => $habBlandas,
            'experiencias'        => $experiencias,
            'proyectos_lista'     => $proyectosLista,
            'formacion'           => $formacion,
            'foto'                => $perfil->foto_perfil,
            'cover_from'          => '#1e3a5f',
            'cover_to'            => '#e11d48',
        ];

        return response()->json(['ok' => true, 'portafolio' => $portafolio]);
    }

    private function nivelDesdeAnios(?int $anios): string
    {
        $a = (int) $anios;
        if ($a >= 8) return 'Experto';
        if ($a >= 5) return 'Avanzado';
        if ($a >= 3) return 'Intermedio';
        return 'Básico';
    }

    public function desactivarCuenta(Request $request)
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

    public function guardarHabilidadesBlandas(Request $request)
    {
        $request->validate([
            'habilidades' => 'nullable|array|max:6'
        ]);

        $usuario = Usuario::with('perfil')->find(session('usuario_id'));

        if (!$usuario || !$usuario->perfil) {
            return response()->json(['ok' => false], 400);
        }

        $perfilId = $usuario->perfil->id_perfil;

        // eliminar anteriores
        PerfilHabilidadBlanda::where('id_perfil', $perfilId)->delete();

        // guardar nuevas
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