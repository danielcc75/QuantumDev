<?php

namespace App\Http\Controllers;

use App\Services\CalendarioService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function eventos(Request $request, CalendarioService $service)
    {
        if (!session('usuario_id')) {
            return response()->json(['success' => false, 'message' => 'No autenticado'], 401);
        }

        $data = $request->validate([
            'desde' => 'required|date_format:Y-m-d',
            'hasta' => 'required|date_format:Y-m-d|after_or_equal:desde',
        ]);

        $desde = Carbon::parse($data['desde']);
        $hasta = Carbon::parse($data['hasta']);

        // Tope de rango para evitar abusos: máximo 92 días (≈ 3 meses)
        if ($desde->diffInDays($hasta) > 92) {
            return response()->json(['success' => false, 'message' => 'Rango demasiado amplio'], 422);
        }

        $eventos = $service->eventosEnRango(session('usuario_id'), $desde, $hasta);

        return response()->json([
            'success' => true,
            'eventos' => $eventos,
        ]);
    }
}
