<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\PerfilLink;
use App\Models\Educacion;
use App\Models\ExperienciaLaboral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PerfilWebController extends Controller
{
    public function ver()
    {
        if (!session('usuario_id')) {
            return redirect('/');
        }

        $usuario = Usuario::with([
            'perfil.experienciasLaborales',
            'perfil.formacionAcademica',
            'perfil.links'
        ])->find(session('usuario_id'));

        return view('gestionarPerfil.perfil', compact('usuario'));
    }

    public function editar()
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

    public function actualizar(Request $request)
    {
        if (!session('usuario_id')) {
            return redirect('/');
        }

        $usuario = Usuario::find(session('usuario_id'));
        $perfil = $usuario->perfil;

        if (!$perfil) {
            $perfil = Perfil::create(['id_usuario' => $usuario->id_usuario]);
        }

        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'telefono' => 'nullable|string|max:50',
            'correo_electronico' => 'required|email|unique:usuario,correo_electronico,' . $usuario->id_usuario . ',id_usuario',

            'biografia' => 'nullable|string',
            'ubicacion' => 'nullable|string|max:100',
            'foto_perfil' => 'nullable|string|max:255',

            'link_github' => 'nullable|url',
            'link_linkedin' => 'nullable|url',
            'link_twitter' => 'nullable|url',
            'link_portfolio' => 'nullable|url',

            'experiencias' => 'nullable|array',
            'experiencias.*.id_experiencia' => 'nullable|exists:experiencia_laboral,id_experiencia',
            'experiencias.*.empresa' => 'required|string|max:150',
            'experiencias.*.cargo' => 'required|string|max:100',
            'experiencias.*.descripcion' => 'nullable|string',
            'experiencias.*.fecha_ini' => 'required|date',
            'experiencias.*.fecha_fin' => 'nullable|date|after_or_equal:fecha_ini',
            'experiencias.*.trabajo_actual' => 'boolean',

            'educaciones' => 'nullable|array',
            'educaciones.*.id_formacion' => 'nullable|exists:formacion_academica,id_formacion',
            'educaciones.*.titulo' => 'required|string|max:150',
            'educaciones.*.institucion' => 'required|string|max:150',
            'educaciones.*.nivel' => 'required|string|max:50',
            'educaciones.*.descripcion' => 'nullable|string',
            'educaciones.*.fecha_ini' => 'required|date',
            'educaciones.*.fecha_fin' => 'nullable|date|after_or_equal:fecha_ini',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->telefono = $request->telefono;
        $usuario->correo_electronico = $request->correo_electronico;
        $usuario->save();

        $perfil->biografia = $request->biografia;
        $perfil->ubicacion = $request->ubicacion;
        $perfil->foto_perfil = $request->foto_perfil;
        $perfil->save();

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

        if ($request->has('experiencias')) {
            $idsRecibidos = collect($request->experiencias)->pluck('id_experiencia')->filter();
            $perfil->experienciasLaborales()->whereNotIn('id_experiencia', $idsRecibidos)->delete();

            foreach ($request->experiencias as $expData) {
                if (isset($expData['id_experiencia']) && $expData['id_experiencia']) {
                    $experiencia = ExperienciaLaboral::find($expData['id_experiencia']);
                    if ($experiencia && $experiencia->id_perfil == $perfil->id_perfil) {
                        $experiencia->update($expData);
                    }
                } else {
                    $expData['id_perfil'] = $perfil->id_perfil;
                    ExperienciaLaboral::create($expData);
                }
            }
        } else {
            $perfil->experienciasLaborales()->delete();
        }

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

        session([
            'usuario_nombre' => $usuario->nombre . ' ' . $usuario->apellido,
            'usuario_email' => $usuario->correo_electronico
        ]);

        return response()->json(['success' => true, 'message' => 'Perfil actualizado correctamente']);
    }
    public function actualizarFoto(Request $request)
    {
        try {
            if (!session('usuario_id')) {
                return response()->json(['success' => false, 'message' => 'No autenticado'], 401);
            }

            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            
            $usuario = Usuario::find(session('usuario_id'));
            $perfil = $usuario->perfil;
            
            if (!$perfil) {
                $perfil = Perfil::create(['id_usuario' => $usuario->id_usuario]);
            }
            
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Guardar directamente en public/perfil-fotos
                $destinationPath = public_path('perfil-fotos');
                
                // Crear carpeta si no existe
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                
                $file->move($destinationPath, $filename);
                
                // Eliminar foto anterior si existe
                if ($perfil->foto_perfil) {
                    $oldPath = public_path(str_replace('/storage/', '', str_replace('/perfil-fotos/', 'perfil-fotos/', $perfil->foto_perfil)));
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                
                $perfil->foto_perfil = asset('perfil-fotos/' . $filename);
                $perfil->save();
                
                return response()->json([
                    'success' => true,
                    'foto_url' => $perfil->foto_perfil,
                    'message' => 'Foto actualizada correctamente'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'No se recibió ninguna imagen'
            ], 400);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
