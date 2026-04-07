<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\ExperienciaLaboral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsuarioWebController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('perfil')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'              => 'required|string|max:50',
            'apellido'            => 'required|string|max:50',
            'correo_electronico'  => 'required|email|unique:usuario,correo_electronico',
            'telefono'            => 'nullable|string|max:50',
            'contrasenia'         => 'required|min:6'
        ]);

        $usuario = Usuario::create([
            'nombre'             => $request->nombre,
            'apellido'           => $request->apellido,
            'correo_electronico' => $request->correo_electronico,
            'telefono'           => $request->telefono,
            'contrasenia'        => Hash::make($request->contrasenia)
        ]);

        Perfil::create([
            'id_usuario' => $usuario->id_usuario
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente');
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

        $usuario->nombre             = $request->nombre;
        $usuario->apellido           = $request->apellido;
        $usuario->correo_electronico = $request->correo_electronico;
        $usuario->telefono           = $request->telefono;

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

    public function editPerfil($id)
    {
        $usuario = Usuario::with('perfil')->findOrFail($id);

        $perfilLinks = [];
        if ($usuario->perfil) {
            $linksRows = DB::table('perfil_links')
                ->where('id_perfil', $usuario->perfil->id_perfil)
                ->get();
            foreach ($linksRows as $link) {
                $perfilLinks[$link->tipo] = $link->url;
            }
        }

        return view('perfiles.edit', compact('usuario', 'perfilLinks'));
    }

    public function updatePerfil(Request $request, $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);

            if ($request->filled('nombre'))   $usuario->nombre   = $request->nombre;
            if ($request->filled('apellido')) $usuario->apellido = $request->apellido;
            if ($request->filled('correo_electronico')) {
                $usuario->correo_electronico = $request->correo_electronico;
            }
            $usuario->save();

            $perfil = Perfil::where('id_usuario', $id)->first();

            if (!$perfil) {
                return response()->json(['success' => false, 'message' => 'Perfil no encontrado'], 404);
            }

            if ($request->filled('foto_perfil')) $perfil->foto_perfil = $request->foto_perfil;
            if ($request->filled('biografia'))   $perfil->biografia   = $request->biografia;
            if ($request->filled('ubicacion'))   $perfil->ubicacion   = $request->ubicacion;
            $perfil->save();

            // Sincronizar links en perfil_links
            // Acepta array PHP (formulario web: links[github]=...) o JSON (AJAX: links="{...}")
            $linksData = [];
            if ($request->has('links')) {
                $raw = $request->input('links');
                $linksData = is_array($raw) ? $raw : (json_decode($raw, true) ?? []);
            }
            foreach (['github', 'linkedin', 'twitter', 'portfolio'] as $tipo) {
                if (!empty($linksData[$tipo])) {
                    DB::table('perfil_links')->updateOrInsert(
                        ['id_perfil' => $perfil->id_perfil, 'tipo' => $tipo],
                        ['url' => $linksData[$tipo]]
                    );
                } else {
                    DB::table('perfil_links')
                        ->where('id_perfil', $perfil->id_perfil)
                        ->where('tipo', $tipo)
                        ->delete();
                }
            }

            return response()->json(['success' => true, 'message' => 'Perfil actualizado correctamente']);

        } catch (\Exception $e) {
            Log::error('Error en updatePerfil: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
