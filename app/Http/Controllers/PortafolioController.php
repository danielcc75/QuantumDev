<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortafolioController extends Controller
{
    public function datos()
    {
        if (!session('usuario_id')) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $perfil = Perfil::where('id_usuario', session('usuario_id'))->first();
        if (!$perfil) {
            return response()->json(['ok' => false, 'message' => 'Perfil no encontrado'], 404);
        }

        $tecnicas = DB::table('habilidades')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->get(['id_habilidad', 'nombre', 'anios_experiencia', 'publicado'])
            ->map(function ($h) {
                return [
                    'id'         => $h->id_habilidad,
                    'nombre'     => $h->nombre,
                    'nivel'      => $this->nivelDesdeAnios($h->anios_experiencia),
                    'publicado'  => (bool) $h->publicado,
                ];
            });

        $blandas = DB::table('perfil_habilidad_blanda as phb')
            ->join('habilidades_blandas as hb', 'hb.id_habilidad_blanda', '=', 'phb.id_habilidad_blanda')
            ->where('phb.id_perfil', $perfil->id_perfil)
            ->get(['phb.id_perfil_habilidad_blanda', 'hb.nombre', 'phb.publicado'])
            ->map(function ($b) {
                return [
                    'id'        => $b->id_perfil_habilidad_blanda,
                    'nombre'    => $b->nombre,
                    'publicado' => (bool) $b->publicado,
                ];
            });

        $experiencia = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->get(['id_experiencia', 'empresa', 'cargo', 'fecha_ini', 'fecha_fin', 'trabajo_actual', 'publicado'])
            ->map(function ($e) {
                $ini = $e->fecha_ini ? \Carbon\Carbon::parse($e->fecha_ini)->format('M Y') : '';
                $fin = $e->trabajo_actual ? 'Actualidad' : ($e->fecha_fin ? \Carbon\Carbon::parse($e->fecha_fin)->format('M Y') : '');
                return [
                    'id'        => $e->id_experiencia,
                    'nombre'    => $e->cargo,
                    'detalle'   => trim($e->empresa . ($ini ? ' · ' . $ini . ($fin ? ' - ' . $fin : '') : '')),
                    'publicado' => (bool) $e->publicado,
                ];
            });

        $educacion = DB::table('formacion_academica')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->get(['id_formacion', 'titulo', 'institucion', 'nivel', 'publicado'])
            ->map(function ($f) {
                return [
                    'id'        => $f->id_formacion,
                    'nombre'    => $f->titulo,
                    'detalle'   => trim($f->institucion . ($f->nivel ? ' · ' . $f->nivel : '')),
                    'publicado' => (bool) $f->publicado,
                ];
            });

        $proyectos = DB::table('proyectos')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->get(['id_proyecto', 'nombre', 'descripcion', 'visible'])
            ->map(function ($p) {
                return [
                    'id'        => $p->id_proyecto,
                    'nombre'    => $p->nombre,
                    'detalle'   => \Illuminate\Support\Str::limit($p->descripcion ?? '', 80),
                    'publicado' => (bool) $p->visible,
                ];
            });

        return response()->json([
            'ok'           => true,
            'visibilidad'  => $perfil->visibilidad ?? 'privado',
            'slug'         => 'mi-perfil',
            'tecnicas'     => $tecnicas,
            'blandas'      => $blandas,
            'experiencia'  => $experiencia,
            'educacion'    => $educacion,
            'proyectos'    => $proyectos,
        ]);
    }

    public function publicar(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $request->validate([
            'tecnicas'    => 'array',
            'tecnicas.*'  => 'integer',
            'blandas'     => 'array',
            'blandas.*'   => 'integer',
            'experiencia' => 'array',
            'experiencia.*' => 'integer',
            'educacion'   => 'array',
            'educacion.*' => 'integer',
            'proyectos'   => 'array',
            'proyectos.*' => 'integer',
        ]);

        $perfil = Perfil::where('id_usuario', session('usuario_id'))->firstOrFail();

        $tieneBiografia  = !empty($perfil->biografia);
        $tieneProyecto   = DB::table('proyectos')->where('id_perfil', $perfil->id_perfil)->whereNull('deleted_at')->exists();
        $tieneExperiencia = DB::table('experiencia_laboral')->where('id_perfil', $perfil->id_perfil)->whereNull('deleted_at')->exists();

        if (!$tieneBiografia && !$tieneProyecto && !$tieneExperiencia) {
            return response()->json([
                'ok' => false,
                'code' => 'perfil_incompleto',
                'message' => 'Para publicar tu portafolio necesitas al menos una biografía, un proyecto o una experiencia laboral.',
            ], 422);
        }

        try {
            DB::transaction(function () use ($request, $perfil) {
                $tecnicas    = $request->input('tecnicas', []);
                $blandas     = $request->input('blandas', []);
                $experiencia = $request->input('experiencia', []);
                $educacion   = $request->input('educacion', []);
                $proyectos   = $request->input('proyectos', []);

                DB::table('habilidades')->where('id_perfil', $perfil->id_perfil)
                    ->whereNull('deleted_at')
                    ->update(['publicado' => DB::raw('false')]);
                if (!empty($tecnicas)) {
                    DB::table('habilidades')->where('id_perfil', $perfil->id_perfil)
                        ->whereNull('deleted_at')
                        ->whereIn('id_habilidad', $tecnicas)
                        ->update(['publicado' => DB::raw('true')]);
                }

                DB::table('perfil_habilidad_blanda')->where('id_perfil', $perfil->id_perfil)
                    ->update(['publicado' => DB::raw('false')]);
                if (!empty($blandas)) {
                    DB::table('perfil_habilidad_blanda')->where('id_perfil', $perfil->id_perfil)
                        ->whereIn('id_perfil_habilidad_blanda', $blandas)
                        ->update(['publicado' => DB::raw('true')]);
                }

                DB::table('experiencia_laboral')->where('id_perfil', $perfil->id_perfil)
                    ->whereNull('deleted_at')
                    ->update(['publicado' => DB::raw('false')]);
                if (!empty($experiencia)) {
                    DB::table('experiencia_laboral')->where('id_perfil', $perfil->id_perfil)
                        ->whereNull('deleted_at')
                        ->whereIn('id_experiencia', $experiencia)
                        ->update(['publicado' => DB::raw('true')]);
                }

                DB::table('formacion_academica')->where('id_perfil', $perfil->id_perfil)
                    ->whereNull('deleted_at')
                    ->update(['publicado' => DB::raw('false')]);
                if (!empty($educacion)) {
                    DB::table('formacion_academica')->where('id_perfil', $perfil->id_perfil)
                        ->whereNull('deleted_at')
                        ->whereIn('id_formacion', $educacion)
                        ->update(['publicado' => DB::raw('true')]);
                }

                DB::table('proyectos')->where('id_perfil', $perfil->id_perfil)
                    ->whereNull('deleted_at')
                    ->update(['visible' => DB::raw('false')]);
                if (!empty($proyectos)) {
                    DB::table('proyectos')->where('id_perfil', $perfil->id_perfil)
                        ->whereNull('deleted_at')
                        ->whereIn('id_proyecto', $proyectos)
                        ->update(['visible' => DB::raw('true')]);
                }

                $perfil->visibilidad = 'publico';
                $perfil->save();
            });

            return response()->json(['ok' => true, 'visibilidad' => 'publico']);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'No se pudo publicar: ' . $e->getMessage()], 500);
        }
    }

    public function preview(Request $request)
    {
        if (!session('usuario_id')) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $perfil = Perfil::where('id_usuario', session('usuario_id'))->first();
        if (!$perfil) {
            return response()->json(['ok' => false, 'message' => 'Perfil no encontrado'], 404);
        }

        $sel = [
            'tecnicas'    => array_map('intval', (array) $request->input('tecnicas', [])),
            'blandas'     => array_map('intval', (array) $request->input('blandas', [])),
            'experiencia' => array_map('intval', (array) $request->input('experiencia', [])),
            'educacion'   => array_map('intval', (array) $request->input('educacion', [])),
            'proyectos'   => array_map('intval', (array) $request->input('proyectos', [])),
        ];

        $usuario = DB::table('usuario')->where('id_usuario', session('usuario_id'))->first();
        $nombre  = trim(($usuario->nombre ?? '') . ' ' . ($usuario->apellido ?? ''));

        $cargo = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->value('cargo') ?? 'Desarrollador';

        $linksRows = DB::table('perfil_links')->where('id_perfil', $perfil->id_perfil)->get();
        $links = [];
        foreach ($linksRows as $l) { $links[strtolower($l->tipo)] = $l->url; }

        $habGrupos = DB::table('habilidades as h')
            ->leftJoin('categoria as c', 'h.id_categoria', '=', 'c.id_categoria')
            ->where('h.id_perfil', $perfil->id_perfil)
            ->whereNull('h.deleted_at')
            ->whereIn('h.id_habilidad', $sel['tecnicas'] ?: [0])
            ->select(
                'h.nombre',
                'h.anios_experiencia',
                'h.descripcion',
                'c.nombre as categoria',
                'c.imagen as categoria_imagen'
            )
            ->get()
            ->groupBy(fn($r) => $r->categoria ?? 'Otras')
            ->map(function ($g, $cat) {
                return [
                    'categoria' => $cat,
                    'imagen'    => optional($g->first())->categoria_imagen,
                    'items'     => $g->map(fn($r) => [
                        'nombre'             => $r->nombre,
                        'anios_experiencia'  => (int) $r->anios_experiencia,
                        'nivel'              => $this->nivelDesdeAnios($r->anios_experiencia),
                        'descripcion'        => $r->descripcion,
                    ])->values()->all(),
                ];
            })->values()->all();

        $habBlandas = DB::table('perfil_habilidad_blanda as phb')
            ->join('habilidades_blandas as hb', 'phb.id_habilidad_blanda', '=', 'hb.id_habilidad_blanda')
            ->where('phb.id_perfil', $perfil->id_perfil)
            ->whereIn('phb.id_perfil_habilidad_blanda', $sel['blandas'] ?: [0])
            ->pluck('hb.nombre')
            ->all();

        $proyectosPorExp = DB::table('proyectos')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->whereIn('id_proyecto', $sel['proyectos'] ?: [0])
            ->whereNotNull('id_experiencia')
            ->get()
            ->groupBy('id_experiencia');

        $experiencias = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->whereIn('id_experiencia', $sel['experiencia'] ?: [0])
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
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->whereIn('id_proyecto', $sel['proyectos'] ?: [0])
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

        $formacion = DB::table('formacion_academica')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereNull('deleted_at')
            ->whereIn('id_formacion', $sel['educacion'] ?: [0])
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

        $meses = 0;
        $exps  = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
            ->whereIn('id_experiencia', $sel['experiencia'] ?: [0])
            ->whereNull('deleted_at')->get();
        foreach ($exps as $e) {
            $ini = \Carbon\Carbon::parse($e->fecha_ini);
            $fin = ($e->trabajo_actual || !$e->fecha_fin) ? \Carbon\Carbon::now() : \Carbon\Carbon::parse($e->fecha_fin);
            $meses += max(0, $ini->diffInMonths($fin));
        }
        $aniosNum = (int) floor($meses / 12);

        $cntEmpresas = collect($exps)->pluck('empresa')->unique()->count();
        $cntProy = count($proyectosLista);
        $cntHabs = collect($habGrupos)->sum(fn($g) => count($g['items'] ?? []));

        $usuarioNombre = $usuario->nombre ?? 'U';
        $usuarioApellido = $usuario->apellido ?? '';

        $portafolio = [
            'id_perfil'           => $perfil->id_perfil,
            'nombre'              => $nombre ?: 'Mi perfil',
            'iniciales'           => strtoupper(substr($usuarioNombre, 0, 1) . substr($usuarioApellido, 0, 1)),
            'rol'                 => $cargo,
            'descripcion'         => $perfil->biografia ?: '',
            'tags'                => [],
            'tags_extra'          => 0,
            'anios'               => $aniosNum > 0 ? ($aniosNum . ' año' . ($aniosNum === 1 ? '' : 's')) : ($meses > 0 ? 'Menos de 1 año' : 'Sin experiencia registrada'),
            'anios_num'           => $aniosNum,
            'proyectos'           => $cntProy . ' proyecto' . ($cntProy === 1 ? '' : 's'),
            'cnt_proy'            => $cntProy,
            'cnt_habs'            => $cntHabs,
            'cnt_empresas'        => $cntEmpresas,
            'ubicacion'           => $perfil->ubicacion ?: 'Sin ubicación',
            'email'               => $usuario->correo_electronico ?? null,
            'telefono'            => $usuario->telefono ?? null,
            'links'               => $links,
            'habilidades_grupos'  => $habGrupos,
            'habilidades_blandas' => $habBlandas,
            'experiencias'        => $experiencias,
            'proyectos_lista'     => $proyectosLista,
            'formacion'           => $formacion,
            'foto'                => $perfil->foto_perfil,
            'cover_from'          => '#1e3a5f',
            'cover_to'            => '#e11d48',
        ];

        return response()->json(['ok' => true, 'portafolio' => $portafolio]);
    }

    private function nivelDesdeAnios(?int $anios): string
    {
        $a = (int) $anios;
        if ($a >= 8) return 'Experto';
        if ($a >= 5) return 'Avanzado';
        if ($a >= 3) return 'Intermedio';
        return 'Básico';
    }
}
