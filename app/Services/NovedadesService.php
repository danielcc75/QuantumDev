<?php

namespace App\Services;

use App\Models\Categoria;
use App\Models\HabilidadBlanda;
use App\Models\NovedadVista;
use App\Models\Tecnologia;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class NovedadesService
{
    private const VENTANA_DIAS = 30;
    private const LIMITE = 6;

    public function paraUsuario(int $idUsuario): Collection
    {
        $desde = Carbon::now()->subDays(self::VENTANA_DIAS);

        $vistas = NovedadVista::where('id_usuario', $idUsuario)
            ->get()
            ->groupBy('tipo')
            ->map(fn ($g) => $g->pluck('id_entidad')->all());

        $tecnologias = Tecnologia::where('created_at', '>=', $desde)
            ->when(isset($vistas[NovedadVista::TIPO_TECNOLOGIA]),
                fn ($q) => $q->whereNotIn('id_tecnologia', $vistas[NovedadVista::TIPO_TECNOLOGIA]))
            ->get()
            ->map(fn ($t) => [
                'tipo'        => NovedadVista::TIPO_TECNOLOGIA,
                'id_entidad'  => $t->id_tecnologia,
                'titulo'      => "Nueva tecnología: {$t->nombre}",
                'detalle'     => $t->categoria,
                'icono'       => 'fa-solid fa-microchip',
                'color'       => 'text-indigo-500',
                'created_at'  => $t->created_at,
            ]);

        $categorias = Categoria::where('created_at', '>=', $desde)
            ->when(isset($vistas[NovedadVista::TIPO_CATEGORIA]),
                fn ($q) => $q->whereNotIn('id_categoria', $vistas[NovedadVista::TIPO_CATEGORIA]))
            ->get()
            ->map(fn ($c) => [
                'tipo'        => NovedadVista::TIPO_CATEGORIA,
                'id_entidad'  => $c->id_categoria,
                'titulo'      => "Nueva categoría: {$c->nombre}",
                'detalle'     => 'Ya disponible para tus habilidades',
                'icono'       => 'fa-solid fa-folder-plus',
                'color'       => 'text-blue-500',
                'created_at'  => $c->created_at,
            ]);

        $blandas = HabilidadBlanda::where('created_at', '>=', $desde)
            ->where('estado', 'activo')
            ->when(isset($vistas[NovedadVista::TIPO_HABILIDAD_BLANDA]),
                fn ($q) => $q->whereNotIn('id_habilidad_blanda', $vistas[NovedadVista::TIPO_HABILIDAD_BLANDA]))
            ->get()
            ->map(fn ($h) => [
                'tipo'        => NovedadVista::TIPO_HABILIDAD_BLANDA,
                'id_entidad'  => $h->id_habilidad_blanda,
                'titulo'      => "Nueva habilidad blanda: {$h->nombre}",
                'detalle'     => 'Puedes añadirla a tu perfil',
                'icono'       => 'fa-solid fa-handshake',
                'color'       => 'text-emerald-500',
                'created_at'  => $h->created_at,
            ]);

        return collect()
            ->merge($tecnologias)
            ->merge($categorias)
            ->merge($blandas)
            ->sortByDesc('created_at')
            ->take(self::LIMITE)
            ->values();
    }

    public function marcarComoVistas(int $idUsuario, array $items): int
    {
        $tiposValidos = [
            NovedadVista::TIPO_TECNOLOGIA,
            NovedadVista::TIPO_CATEGORIA,
            NovedadVista::TIPO_HABILIDAD_BLANDA,
        ];

        $insertados = 0;
        foreach ($items as $item) {
            $tipo = $item['tipo'] ?? null;
            $idEntidad = (int) ($item['id_entidad'] ?? 0);

            if (!in_array($tipo, $tiposValidos, true) || $idEntidad <= 0) {
                continue;
            }

            NovedadVista::firstOrCreate([
                'id_usuario' => $idUsuario,
                'tipo'       => $tipo,
                'id_entidad' => $idEntidad,
            ]);
            $insertados++;
        }

        return $insertados;
    }
}
