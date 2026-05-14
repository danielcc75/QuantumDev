<?php

namespace App\Http\Controllers;

use App\Models\ExperienciaLaboral;
use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExperienciaController extends Controller
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
     * Verificar que la experiencia pertenezca al usuario autenticado
     */
    private function verificarPertenencia($experiencia)
    {
        $perfilId = $this->getPerfilId();
        return $experiencia && $experiencia->id_perfil == $perfilId;
    }

    /**
     * Guardar nueva experiencia laboral
     */
    public function store(Request $request)
    {
        if (!Session::get('usuario_id')) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $request->validate([
            'empresa' => 'required|string|max:150',
            'cargo' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'referencias' => 'nullable|string',
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_ini',
            'trabajo_actual' => 'boolean'
        ]);

        $perfilId = $this->getPerfilId();
        
        if (!$perfilId) {
            return response()->json(['error' => 'Perfil no encontrado'], 404);
        }

        $experiencia = ExperienciaLaboral::create([
            'id_perfil' => $perfilId,
            'empresa' => $request->empresa,
            'cargo' => $request->cargo,
            'descripcion' => $request->descripcion,
            'referencias' => $request->referencias,
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->trabajo_actual ? null : $request->fecha_fin,
            'trabajo_actual' => $request->trabajo_actual ?? false,
            'publicado' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Experiencia laboral guardada correctamente',
            'experiencia' => $experiencia
        ]);
    }

    /**
     * Actualizar experiencia laboral existente
     */
    public function update(Request $request, $id)
    {
        if (!Session::get('usuario_id')) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $request->validate([
            'empresa' => 'required|string|max:150',
            'cargo' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'referencias' => 'nullable|string',
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_ini',
            'trabajo_actual' => 'boolean'
        ]);

        $experiencia = ExperienciaLaboral::find($id);
        
        if (!$experiencia) {
            return response()->json(['error' => 'Experiencia no encontrada'], 404);
        }
        
        if (!$this->verificarPertenencia($experiencia)) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $experiencia->update([
            'empresa' => $request->empresa,
            'cargo' => $request->cargo,
            'descripcion' => $request->descripcion,
            'referencias' => $request->referencias,
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->trabajo_actual ? null : $request->fecha_fin,
            'trabajo_actual' => $request->trabajo_actual ?? false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Experiencia laboral actualizada correctamente',
            'experiencia' => $experiencia
        ]);
    }

    /**
     * Eliminar experiencia laboral
     */
    public function destroy($id)
    {
        if (!Session::get('usuario_id')) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $experiencia = ExperienciaLaboral::find($id);
        
        if (!$experiencia) {
            return response()->json(['error' => 'Experiencia no encontrada'], 404);
        }
        
        if (!$this->verificarPertenencia($experiencia)) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $experiencia->deleted_by = Session::get('usuario_id');
        $experiencia->delete_reason = 'Eliminada por el usuario';
        $experiencia->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experiencia laboral eliminada correctamente'
        ]);
    }
        public function show($id)
    {
        $experiencia = ExperienciaLaboral::findOrFail($id);
        return response()->json($experiencia);
    }
}