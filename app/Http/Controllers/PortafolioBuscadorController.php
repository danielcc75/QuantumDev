<?php

namespace App\Http\Controllers;

use App\Services\PortafolioBuscadorService;
use Illuminate\Http\Request;

class PortafolioBuscadorController extends Controller
{
    public function buscar(Request $request, PortafolioBuscadorService $service)
    {
        $data = $request->validate([
            'q'                 => 'nullable|string|max:150',
            'tecnologias'       => 'nullable|array|max:20',
            'tecnologias.*'     => 'string|max:80',
            'categoria_tec'     => 'nullable|string|max:80',
            'categorias'        => 'nullable|array|max:20',
            'categorias.*'      => 'integer|min:1',
            'anios_min'         => 'nullable|integer|min:0|max:60',
            'ubicacion'         => 'nullable|string|max:120',
            'con_proyectos'     => 'nullable|boolean',
            'offset'            => 'nullable|integer|min:0|max:5000',
            'limit'             => 'nullable|integer|min:1|max:24',
        ]);

        $offset = (int) ($data['offset'] ?? 0);
        $limit  = (int) ($data['limit']  ?? PortafolioBuscadorService::LIMITE_DEFECTO);

        $resultado = $service->buscar($data, $offset, $limit);

        return response()->json([
            'success' => true,
            'items'   => $resultado['items'],
            'total'   => $resultado['total'],
            'hay_mas' => $resultado['hay_mas'],
            'offset'  => $offset,
            'limit'   => $limit,
        ]);
    }
}
