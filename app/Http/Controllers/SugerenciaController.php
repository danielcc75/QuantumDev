<?php

namespace App\Http\Controllers;

use App\Models\Sugerencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SugerenciaController extends Controller
{
    public function store(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo' => 'required|in:categoria,habilidad_blanda,tecnologia',
        ]);

        try {
            Sugerencia::create([
                'id_usuario' => session('usuario_id'),
                'tipo' => $request->tipo,
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'leida' => false,
            ]);

            return response()->json(['message' => 'Sugerencia enviada correctamente. ¡Gracias!']);
        } catch (\Exception $e) {
            Log::error('Error al guardar sugerencia: ' . $e->getMessage());
            return response()->json(['error' => 'Error al enviar la sugerencia.'], 500);
        }
    }

    public function verSugerenciasAdmin($tipo)
    {
        if (!session('usuario_id')) {
            return redirect('/');
        }
        $usuario = \App\Models\Usuario::find(session('usuario_id'));
        if (!$usuario || !$usuario->is_admin) {
            return redirect('/');
        }

        \App\Models\Sugerencia::where('tipo', $tipo)
            ->where('leida', false)
            ->update(['leida' => true]);

        if ($tipo == 'categoria' || $tipo == 'habilidad_blanda') {
            return redirect()->route('admin.habilidades', ['sugerencia' => $tipo]);
        } elseif ($tipo == 'tecnologia') {
            return redirect()->route('admin.tecnologias', ['sugerencia' => $tipo]);
        }

        return redirect()->back();
    }
}