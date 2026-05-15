<?php

namespace App\Http\Controllers;

use App\Services\NovedadesService;
use Illuminate\Http\Request;

class NovedadesController extends Controller
{
    public function marcarVistas(Request $request, NovedadesService $service)
    {
        if (!session('usuario_id')) {
            return response()->json(['success' => false, 'message' => 'No autenticado'], 401);
        }

        $idUsuario = session('usuario_id');

        // Si se piden todas, ignoramos items y marcamos toda la ventana de novedades.
        if ($request->boolean('todas')) {
            $insertados = $service->marcarTodasComoVistas($idUsuario);
            return response()->json(['success' => true, 'marcadas' => $insertados]);
        }

        $data = $request->validate([
            'items'              => 'required|array|max:200',
            'items.*.tipo'       => 'required|string|in:tecnologia,categoria,habilidad_blanda',
            'items.*.id_entidad' => 'required|integer|min:1',
        ]);

        $insertados = $service->marcarComoVistas($idUsuario, $data['items']);

        return response()->json(['success' => true, 'marcadas' => $insertados]);
    }
}
