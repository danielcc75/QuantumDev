<?php

namespace App\Http\Controllers;

use App\Models\Educacion;
use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EducacionController extends Controller
{
    /**
     * Obtener el ID del perfil del usuario autenticado
     */
    private function getPerfilId()
    {
        $usuario = Usuario::find(Session::get('usuario_id'));
        
        if (!$usuario) {
            return null;
        }
        
        if (!$usuario->perfil) {
            $perfil = Perfil::create(['id_usuario' => $usuario->id_usuario]);
            return $perfil->id_perfil;
        }
        
        return $usuario->perfil->id_perfil;
    }

    /**
     * Verificar que la educación pertenezca al usuario autenticado
     */
    private function verificarPertenencia($educacion)
    {
        $perfilId = $this->getPerfilId();
        return $educacion && $educacion->id_perfil == $perfilId;
    }

    /**
     * Guardar nueva formación académica
     */
    public function store(Request $request)
    {
        if (!Session::get('usuario_id')) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $request->validate([
            'titulo' => 'required|string|max:150',
            'institucion' => 'required|string|max:150',
            'nivel' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_ini',
            'en_curso' => 'boolean'
        ]);

        $perfilId = $this->getPerfilId();
        
        if (!$perfilId) {
            return response()->json(['error' => 'Perfil no encontrado'], 404);
        }

        $educacion = Educacion::create([
            'id_perfil' => $perfilId,
            'titulo' => $request->titulo,
            'institucion' => $request->institucion,
            'nivel' => $request->nivel,
            'descripcion' => $request->descripcion,
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->en_curso ? null : $request->fecha_fin
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Formación académica guardada correctamente',
            'educacion' => $educacion
        ]);
    }

    /**
     * Actualizar formación académica existente
     */
    public function update(Request $request, $id)
    {
        if (!Session::get('usuario_id')) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $request->validate([
            'titulo' => 'required|string|max:150',
            'institucion' => 'required|string|max:150',
            'nivel' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_ini',
            'en_curso' => 'boolean'
        ]);

        $educacion = Educacion::find($id);
        
        if (!$educacion) {
            return response()->json(['error' => 'Formación no encontrada'], 404);
        }
        
        if (!$this->verificarPertenencia($educacion)) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $educacion->update([
            'titulo' => $request->titulo,
            'institucion' => $request->institucion,
            'nivel' => $request->nivel,
            'descripcion' => $request->descripcion,
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->en_curso ? null : $request->fecha_fin
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Formación académica actualizada correctamente',
            'educacion' => $educacion
        ]);
    }

    /**
     * Eliminar formación académica
     */
    public function destroy($id)
    {
        if (!Session::get('usuario_id')) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $educacion = Educacion::find($id);
        
        if (!$educacion) {
            return response()->json(['error' => 'Formación no encontrada'], 404);
        }
        
        if (!$this->verificarPertenencia($educacion)) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $educacion->deleted_by = Session::get('usuario_id');
        $educacion->delete_reason = 'Eliminada por el usuario';
        $educacion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Formación académica eliminada correctamente'
        ]);
    }
        public function show($id)
    {
        // Solo trae lo necesario, sin relaciones innecesarias
        $educacion = Educacion::select('id_formacion', 'titulo', 'institucion', 'nivel', 'fecha_ini', 'fecha_fin', 'descripcion')
            ->findOrFail($id);
        
        return response()->json($educacion);
    }
}