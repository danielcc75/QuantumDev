<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PortafolioBuscadorService
{
    public const LIMITE_DEFECTO = 12;
    public const LIMITE_MAXIMO  = 24;

    private const GRADS = [['from' => '#1e3a5f', 'to' => '#e11d48']];

    /**
     * Busca portafolios públicos aplicando filtros.
     * Retorna ['items' => [...$p], 'total' => int, 'hay_mas' => bool].
     */
    public function buscar(array $filtros, int $offset = 0, int $limit = self::LIMITE_DEFECTO): array
    {
        $limit  = max(1, min($limit, self::LIMITE_MAXIMO));
        $offset = max(0, $offset);

        $base = $this->queryBase($filtros);

        $total = (clone $base)->count('p.id_perfil');

        // Score de completitud del perfil (0..8): suma una unidad por cada sección llena.
        // Define el orden principal — los perfiles más completos aparecen primero.
        $subCompletitud = "(
            (CASE WHEN p.biografia IS NOT NULL AND p.biografia <> '' THEN 1 ELSE 0 END) +
            (CASE WHEN p.foto_perfil IS NOT NULL AND p.foto_perfil <> '' THEN 1 ELSE 0 END) +
            (CASE WHEN p.ubicacion IS NOT NULL AND p.ubicacion <> '' THEN 1 ELSE 0 END) +
            (CASE WHEN EXISTS(SELECT 1 FROM experiencia_laboral e
                WHERE e.id_perfil = p.id_perfil AND e.publicado = true AND e.deleted_at IS NULL) THEN 1 ELSE 0 END) +
            (CASE WHEN EXISTS(SELECT 1 FROM habilidades h
                WHERE h.id_perfil = p.id_perfil AND h.publicado = true AND h.deleted_at IS NULL) THEN 1 ELSE 0 END) +
            (CASE WHEN EXISTS(SELECT 1 FROM formacion_academica fa
                WHERE fa.id_perfil = p.id_perfil AND fa.publicado = true AND fa.deleted_at IS NULL) THEN 1 ELSE 0 END) +
            (CASE WHEN EXISTS(SELECT 1 FROM perfil_links pl
                WHERE pl.id_perfil = p.id_perfil) THEN 1 ELSE 0 END) +
            (CASE WHEN EXISTS(SELECT 1 FROM proyectos pr
                WHERE pr.id_perfil = p.id_perfil AND pr.visible = true AND pr.deleted_at IS NULL) THEN 1 ELSE 0 END)
        )";

        // Desempate: cantidad de proyectos completados y publicados por perfil.
        $subProyCompletados = "(SELECT COUNT(*) FROM proyectos pc
            WHERE pc.id_perfil = p.id_perfil
              AND pc.estado = 'completado'
              AND pc.visible = true
              AND pc.deleted_at IS NULL)";

        $filas = $base
            ->addSelect(DB::raw($subCompletitud . ' AS completitud'))
            ->addSelect(DB::raw($subProyCompletados . ' AS proy_completados'))
            ->orderByDesc('completitud')
            ->orderByDesc('proy_completados')
            ->orderByDesc('p.updated_at')
            ->orderByDesc('p.id_perfil')
            ->offset($offset)
            ->limit($limit)
            ->get();

        $items = $filas->values()->map(fn ($p, $i) => $this->construirItem($p, $offset + $i))->all();

        return [
            'items'   => $items,
            'total'   => $total,
            'hay_mas' => ($offset + count($items)) < $total,
        ];
    }

    private function queryBase(array $filtros)
    {
        $query = DB::table('usuario as u')
            ->join('perfil as p', 'u.id_usuario', '=', 'p.id_usuario')
            ->select('u.id_usuario', 'u.nombre', 'u.apellido', 'p.id_perfil', 'p.biografia', 'p.ubicacion', 'p.foto_perfil')
            ->where('p.visibilidad', 'publico')
            ->where('p.visible', true)
            ->whereNull('u.deleted_at')
            ->where(function ($q) {
                $q->whereNotNull('p.biografia')
                  ->orWhereExists(function ($sub) {
                      $sub->select(DB::raw(1))->from('proyectos')
                          ->whereColumn('proyectos.id_perfil', 'p.id_perfil')
                          ->whereNull('proyectos.deleted_at');
                  })
                  ->orWhereExists(function ($sub) {
                      $sub->select(DB::raw(1))->from('experiencia_laboral')
                          ->whereColumn('experiencia_laboral.id_perfil', 'p.id_perfil')
                          ->whereNull('experiencia_laboral.deleted_at');
                  });
            });

        // 1. Texto libre: nombre, apellido, biografía, cargo de alguna experiencia publicada
        $q = trim((string) ($filtros['q'] ?? ''));
        if ($q !== '') {
            $like = '%' . str_replace(['%', '_'], ['\%', '\_'], $q) . '%';
            $query->where(function ($w) use ($like) {
                $w->whereRaw('LOWER(u.nombre) LIKE ?', [mb_strtolower($like)])
                  ->orWhereRaw('LOWER(u.apellido) LIKE ?', [mb_strtolower($like)])
                  ->orWhereRaw('LOWER(p.biografia) LIKE ?', [mb_strtolower($like)])
                  ->orWhereExists(function ($sub) use ($like) {
                      $sub->select(DB::raw(1))->from('experiencia_laboral as e')
                          ->whereColumn('e.id_perfil', 'p.id_perfil')
                          ->where('e.publicado', true)
                          ->whereNull('e.deleted_at')
                          ->whereRaw('LOWER(e.cargo) LIKE ?', [mb_strtolower($like)]);
                  });
            });
        }

        // 2. Tecnologías (por nombre, tal como están en proyectos.tecnologias o habilidades.nombre)
        $tecnologias = array_filter(array_map('trim', (array) ($filtros['tecnologias'] ?? [])));

        // Si hay categoría de tecnología, expandirla a sus nombres y fusionarlos con la lista de tecnologías
        $categoriaTec = trim((string) ($filtros['categoria_tec'] ?? ''));
        if ($categoriaTec !== '') {
            $nombresDeCat = DB::table('tecnologias')
                ->where('categoria', $categoriaTec)
                ->pluck('nombre')
                ->all();
            $tecnologias = array_values(array_unique(array_merge($tecnologias, $nombresDeCat)));
        }

        if (!empty($tecnologias)) {
            $tecLower = array_map('mb_strtolower', $tecnologias);
            $query->where(function ($w) use ($tecLower) {
                foreach ($tecLower as $t) {
                    $w->orWhereExists(function ($sub) use ($t) {
                        $sub->select(DB::raw(1))->from('habilidades as h')
                            ->whereColumn('h.id_perfil', 'p.id_perfil')
                            ->where('h.publicado', true)
                            ->whereNull('h.deleted_at')
                            ->whereRaw('LOWER(h.nombre) = ?', [$t]);
                    });
                    $w->orWhereExists(function ($sub) use ($t) {
                        $sub->select(DB::raw(1))->from('proyectos as pr')
                            ->whereColumn('pr.id_perfil', 'p.id_perfil')
                            ->where('pr.visible', true)
                            ->whereNull('pr.deleted_at')
                            ->whereRaw('LOWER(pr.tecnologias) LIKE ?', ['%' . $t . '%']);
                    });
                }
            });
        }

        // 3. Categorías de habilidades
        $categorias = array_filter(array_map('intval', (array) ($filtros['categorias'] ?? [])));
        if (!empty($categorias)) {
            $query->whereExists(function ($sub) use ($categorias) {
                $sub->select(DB::raw(1))->from('habilidades as h')
                    ->whereColumn('h.id_perfil', 'p.id_perfil')
                    ->where('h.publicado', true)
                    ->whereNull('h.deleted_at')
                    ->whereIn('h.id_categoria', $categorias);
            });
        }

        // 4. Años mínimos de experiencia (sumando meses de todas las experiencias publicadas)
        $aniosMin = (int) ($filtros['anios_min'] ?? 0);
        if ($aniosMin > 0) {
            $query->whereExists(function ($sub) use ($aniosMin) {
                $sub->select(DB::raw(1))->from('experiencia_laboral as e')
                    ->whereColumn('e.id_perfil', 'p.id_perfil')
                    ->where('e.publicado', true)
                    ->whereNull('e.deleted_at')
                    ->havingRaw('
                        SUM(
                            EXTRACT(EPOCH FROM (
                                COALESCE(CASE WHEN e.trabajo_actual THEN NOW() ELSE e.fecha_fin::timestamp END, NOW()) - e.fecha_ini::timestamp
                            )) / (60*60*24*365)
                        ) >= ?
                    ', [$aniosMin]);
            });
        }

        // 5. Ubicación (texto LIKE)
        $ubicacion = trim((string) ($filtros['ubicacion'] ?? ''));
        if ($ubicacion !== '') {
            $likeUbi = '%' . str_replace(['%', '_'], ['\%', '\_'], mb_strtolower($ubicacion)) . '%';
            $query->whereRaw('LOWER(COALESCE(p.ubicacion, \'\')) LIKE ?', [$likeUbi]);
        }

        // 6. Solo con al menos un proyecto publicado
        if (!empty($filtros['con_proyectos'])) {
            $query->whereExists(function ($sub) {
                $sub->select(DB::raw(1))->from('proyectos as pr')
                    ->whereColumn('pr.id_perfil', 'p.id_perfil')
                    ->where('pr.visible', true)
                    ->whereNull('pr.deleted_at');
            });
        }

        return $query;
    }

    /**
     * Construye el objeto enriquecido del portafolio (mismo formato que el blade usaba como $p).
     */
    public function construirItem(object $p, int $idx): array
    {
        $usuarioRow = DB::table('usuario')->where('id_usuario', $p->id_usuario)->first();

        $cargo = DB::table('experiencia_laboral')
            ->where('id_perfil', $p->id_perfil)
            ->where('publicado', true)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->value('cargo') ?? 'Desarrollador';

        $tags = DB::table('habilidades')
            ->where('id_perfil', $p->id_perfil)
            ->where('publicado', true)
            ->whereNull('deleted_at')
            ->orderByDesc('id_habilidad')
            ->limit(3)
            ->pluck('nombre')
            ->all();
        $totalHabs = DB::table('habilidades')
            ->where('id_perfil', $p->id_perfil)->where('publicado', true)->whereNull('deleted_at')->count();
        $extraTags = max(0, $totalHabs - count($tags));

        $exps = DB::table('experiencia_laboral')
            ->where('id_perfil', $p->id_perfil)->where('publicado', true)->whereNull('deleted_at')->get();
        $meses = 0;
        foreach ($exps as $e) {
            $ini = Carbon::parse($e->fecha_ini);
            $fin = ($e->trabajo_actual || !$e->fecha_fin) ? Carbon::now() : Carbon::parse($e->fecha_fin);
            $meses += max(0, $ini->diffInMonths($fin));
        }
        $anios   = (int) floor($meses / 12);
        $anioStr = $anios > 0 ? ($anios . ' año' . ($anios === 1 ? '' : 's'))
                              : ($meses > 0 ? 'Menos de 1 año' : 'Sin experiencia registrada');

        $cntProy = DB::table('proyectos')
            ->where('id_perfil', $p->id_perfil)->where('visible', true)->whereNull('deleted_at')->count();

        $cntEmpresas = DB::table('experiencia_laboral')
            ->where('id_perfil', $p->id_perfil)
            ->where('publicado', true)
            ->whereNull('deleted_at')
            ->distinct()
            ->count('empresa');

        $linksRows = DB::table('perfil_links')->where('id_perfil', $p->id_perfil)->get();
        $links = [];
        foreach ($linksRows as $l) { $links[strtolower($l->tipo)] = $l->url; }

        $habGrupos = DB::table('habilidades as h')
            ->leftJoin('categoria as c', 'h.id_categoria', '=', 'c.id_categoria')
            ->where('h.id_perfil', $p->id_perfil)
            ->where('h.publicado', true)
            ->whereNull('h.deleted_at')
            ->select('h.nombre', 'h.anios_experiencia', 'h.descripcion', 'c.nombre as categoria', 'c.imagen as categoria_imagen')
            ->get()
            ->groupBy(fn($r) => $r->categoria ?? 'Otras')
            ->map(function ($g, $cat) {
                return [
                    'categoria' => $cat,
                    'imagen'    => optional($g->first())->categoria_imagen,
                    'items'     => $g->map(function ($r) {
                        $a = (int) $r->anios_experiencia;
                        $nivel = $a >= 8 ? 'Experto' : ($a >= 5 ? 'Avanzado' : ($a >= 3 ? 'Intermedio' : 'Básico'));
                        return [
                            'nombre'             => $r->nombre,
                            'anios_experiencia'  => $a,
                            'nivel'              => $nivel,
                            'descripcion'        => $r->descripcion,
                        ];
                    })->values()->all(),
                ];
            })->values()->all();

        $proyectosPorExp = DB::table('proyectos')
            ->where('id_perfil', $p->id_perfil)
            ->where('visible', true)
            ->whereNotNull('id_experiencia')
            ->whereNull('deleted_at')
            ->get()
            ->groupBy('id_experiencia');

        $experiencias = DB::table('experiencia_laboral')
            ->where('id_perfil', $p->id_perfil)
            ->where('publicado', true)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->get()
            ->map(function ($e) use ($proyectosPorExp) {
                $vinculados = ($proyectosPorExp->get($e->id_experiencia) ?? collect())
                    ->map(fn($pr) => [
                        'id_proyecto' => $pr->id_proyecto,
                        'nombre'      => $pr->nombre,
                        'url_link'    => $pr->url_link ?? null,
                    ])->values()->all();
                return [
                    'cargo'          => $e->cargo,
                    'empresa'        => $e->empresa,
                    'descripcion'    => $e->descripcion,
                    'fecha_ini'      => $e->fecha_ini,
                    'fecha_fin'      => $e->fecha_fin,
                    'trabajo_actual' => (bool) $e->trabajo_actual,
                    'proyectos'      => $vinculados,
                ];
            })->all();

        $proyectosLista = DB::table('proyectos')
            ->where('id_perfil', $p->id_perfil)
            ->where('visible', 1)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->get()
            ->map(fn($pr) => [
                'id_proyecto' => $pr->id_proyecto,
                'nombre'      => $pr->nombre,
                'descripcion' => $pr->descripcion,
                'url_link'    => $pr->url_link,
                'fecha_ini'   => $pr->fecha_ini,
                'fecha_fin'   => $pr->fecha_fin,
                'estado'      => $pr->estado,
                'tecnologias' => $pr->tecnologias,
            ])->all();

        $habBlandas = DB::table('perfil_habilidad_blanda as phb')
            ->join('habilidades_blandas as hb', 'phb.id_habilidad_blanda', '=', 'hb.id_habilidad_blanda')
            ->where('phb.id_perfil', $p->id_perfil)
            ->where('phb.publicado', true)
            ->pluck('hb.nombre')
            ->all();

        $formacion = DB::table('formacion_academica')
            ->where('id_perfil', $p->id_perfil)
            ->where('publicado', true)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->get()
            ->map(fn($f) => [
                'titulo'      => $f->titulo,
                'institucion' => $f->institucion,
                'nivel'       => $f->nivel,
                'descripcion' => $f->descripcion,
                'fecha_ini'   => $f->fecha_ini,
                'fecha_fin'   => $f->fecha_fin,
            ])->all();

        $grad = self::GRADS[$idx % count(self::GRADS)];

        return [
            'id_perfil'   => $p->id_perfil,
            'id_usuario'  => $p->id_usuario,
            'nombre'      => trim(($p->nombre ?? '') . ' ' . ($p->apellido ?? '')),
            'iniciales'   => strtoupper(substr($p->nombre ?? 'U', 0, 1) . substr($p->apellido ?? '', 0, 1)),
            'rol'         => $cargo,
            'descripcion' => $p->biografia ?: '',
            'tags'        => $tags,
            'tags_extra'  => $extraTags,
            'anios'       => $anioStr,
            'anios_num'   => $anios,
            'proyectos'   => $cntProy . ' proyecto' . ($cntProy === 1 ? '' : 's'),
            'cnt_proy'    => $cntProy,
            'cnt_habs'    => $totalHabs,
            'cnt_empresas'=> $cntEmpresas,
            'ubicacion'   => $p->ubicacion ?: 'Sin ubicación',
            'email'       => $usuarioRow->correo_electronico ?? null,
            'telefono'    => $usuarioRow->telefono ?? null,
            'links'       => $links,
            'habilidades_grupos'  => $habGrupos,
            'habilidades_blandas' => $habBlandas,
            'experiencias' => $experiencias,
            'proyectos_lista' => $proyectosLista,
            'formacion'   => $formacion,
            'foto'        => $p->foto_perfil,
            'cover_from'  => $grad['from'],
            'cover_to'    => $grad['to'],
        ];
    }
}
