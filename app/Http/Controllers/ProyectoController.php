<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    public function index()
    {
        return Proyecto::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:100',
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_ini',
            'estado'    => 'in:pendiente,en_progreso,completado,cancelado',
        ]);

        // Resolver id_perfil a partir de user_id
        $perfil = Perfil::where('id_usuario', $request->user_id)->first();
        if (!$perfil) {
            return response()->json(['success' => false, 'message' => 'Perfil no encontrado'], 404);
        }

        $proyecto = Proyecto::create([
            'id_perfil'      => $perfil->id_perfil,
            'id_experiencia' => $request->id_experiencia ?: null,
            'nombre'         => $request->nombre,
            'descripcion'    => $request->descripcion,
            'url_link'       => $request->url_link,
            'referencias'    => $request->referencias,
            'tecnologias'    => $request->tecnologias,
            'fecha_ini'      => $request->fecha_ini,
            'fecha_fin'      => $request->fecha_fin ?: null,
            'estado'         => $request->estado ?? 'pendiente',
            'visible'        => $request->visible ?? 1,
        ]);

        return response()->json(['success' => true, 'proyecto' => $proyecto]);
    }

    public function show($id)
    {
        return Proyecto::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        $request->validate([
            'nombre'         => 'sometimes|string|max:100',
            'descripcion'    => 'nullable|string',
            'url_link'       => 'nullable|url',
            'referencias'    => 'nullable|string',
            'tecnologias'    => 'nullable|string',
            'fecha_ini'      => 'nullable|date',
            'fecha_fin'      => 'nullable|date|after_or_equal:fecha_ini',
            'estado'         => 'nullable|in:pendiente,en_progreso,completado,cancelado',
            'visible'        => 'nullable|boolean',
            'id_experiencia' => 'nullable|integer|exists:experiencia_laboral,id_experiencia',
        ]);

        $data = $request->only([
            'nombre', 'descripcion', 'url_link', 'referencias',
            'tecnologias', 'fecha_ini', 'fecha_fin', 'estado', 'visible',
            'id_experiencia'
        ]);

        // Limpiar fecha_fin vacía
        if (array_key_exists('fecha_fin', $data) && empty($data['fecha_fin'])) {
            $data['fecha_fin'] = null;
        }

        $proyecto->update($data);

        return response()->json(['success' => true, 'proyecto' => $proyecto]);
    }

    public function destroy($id)
    {
        Proyecto::destroy($id);
        return response()->json(['success' => true]);
    }
}
