<?php
// app/Http/Controllers/Admin/ModeracionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModeracionController extends Controller
{
    // Listado de perfiles para moderar
    public function perfiles(Request $request)
    {
        $query = Perfil::with('usuario');
        
        // Búsqueda
        if ($request->search) {
            $query->whereHas('usuario', function($q) use ($request) {
                $q->where('nombre', 'like', "%{$request->search}%")
                  ->orWhere('apellido', 'like', "%{$request->search}%")
                  ->orWhere('correo_electronico', 'like', "%{$request->search}%");
            });
        }
        
        // Filtro por visibilidad
        if ($request->visible && $request->visible != 'todos') {
            $query->where('visible', $request->visible == 'visible');
        }
        
        $perfiles = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.moderacion.perfiles', compact('perfiles'));
    }
    
    // Ver detalle de un perfil (visualiza el portafolio publicado, como lo verían los usuarios públicos)
    public function verPerfil($id)
    {
        $perfil = Perfil::with(['usuario'])->findOrFail($id);
        $portafolio = $this->construirPortafolioPublicado($perfil);

        return view('admin.moderacion.ver-perfil', compact('perfil', 'portafolio'));
    }

    // Devuelve el portafolio publicado como JSON (para abrir el modal desde el listado sin navegar)
    public function portafolioJson($id)
    {
        $perfil = Perfil::with(['usuario'])->findOrFail($id);
        $portafolio = $this->construirPortafolioPublicado($perfil);

        return response()->json(['ok' => true, 'portafolio' => $portafolio]);
    }

    /**
     * Construye el mismo objeto $portafolio que consume el modal público
     * (home._modal_portafolio_publico), filtrando solo lo marcado como
     * "publicado" / "visible" — esto es lo que los visitantes ven.
     */
    private function construirPortafolioPublicado(Perfil $perfil): array
    {
        $usuarioRow = DB::table('usuario')->where('id_usuario', $perfil->id_usuario)->first();
        $nombre = trim(($usuarioRow->nombre ?? '') . ' ' . ($usuarioRow->apellido ?? ''));

        $cargo = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
            ->where('publicado', true)
            ->whereNull('deleted_at')
            ->orderByDesc('fecha_ini')
            ->value('cargo') ?? 'Desarrollador';

        $linksRows = DB::table('perfil_links')->where('id_perfil', $perfil->id_perfil)->get();
        $links = [];
        foreach ($linksRows as $l) { $links[strtolower($l->tipo)] = $l->url; }

        $habGrupos = DB::table('habilidades as h')
            ->leftJoin('categoria as c', 'h.id_categoria', '=', 'c.id_categoria')
            ->where('h.id_perfil', $perfil->id_perfil)
            ->where('h.publicado', true)
            ->whereNull('h.deleted_at')
            ->select('h.nombre', 'c.nombre as categoria')
            ->get()
            ->groupBy(fn($r) => $r->categoria ?? 'Otras')
            ->map(fn($g) => $g->pluck('nombre')->all());

        $proyectosPorExp = DB::table('proyectos')
            ->where('id_perfil', $perfil->id_perfil)
            ->where('visible', true)
            ->whereNotNull('id_experiencia')
            ->whereNull('deleted_at')
            ->get()
            ->groupBy('id_experiencia');

        $experiencias = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
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
            ->where('id_perfil', $perfil->id_perfil)
            ->where('visible', true)
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
            ->where('phb.id_perfil', $perfil->id_perfil)
            ->where('phb.publicado', true)
            ->pluck('hb.nombre')
            ->all();

        $formacion = DB::table('formacion_academica')
            ->where('id_perfil', $perfil->id_perfil)
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

        $exps = DB::table('experiencia_laboral')
            ->where('id_perfil', $perfil->id_perfil)
            ->where('publicado', true)
            ->whereNull('deleted_at')
            ->get();
        $meses = 0;
        foreach ($exps as $e) {
            $ini = Carbon::parse($e->fecha_ini);
            $fin = ($e->trabajo_actual || !$e->fecha_fin) ? Carbon::now() : Carbon::parse($e->fecha_fin);
            $meses += max(0, $ini->diffInMonths($fin));
        }
        $anios = (int) floor($meses / 12);
        $anioStr = $anios > 0
            ? ($anios . ' año' . ($anios === 1 ? '' : 's'))
            : ($meses > 0 ? 'Menos de 1 año' : 'Sin experiencia registrada');

        $cntProy = count($proyectosLista);
        $cntEmpresas = $exps->pluck('empresa')->unique()->count();
        $totalHabs = collect($habGrupos)->flatten()->count();

        $usuarioNombre = $usuarioRow->nombre ?? 'U';
        $usuarioApellido = $usuarioRow->apellido ?? '';

        return [
            'id_perfil'           => $perfil->id_perfil,
            'nombre'              => $nombre ?: 'Sin nombre',
            'iniciales'           => strtoupper(substr($usuarioNombre, 0, 1) . substr($usuarioApellido, 0, 1)),
            'rol'                 => $cargo,
            'descripcion'         => $perfil->biografia ?: '',
            'tags'                => [],
            'tags_extra'          => 0,
            'anios'               => $anioStr,
            'anios_num'           => $anios,
            'proyectos'           => $cntProy . ' proyecto' . ($cntProy === 1 ? '' : 's'),
            'cnt_proy'            => $cntProy,
            'cnt_habs'            => $totalHabs,
            'cnt_empresas'        => $cntEmpresas,
            'ubicacion'           => $perfil->ubicacion ?: 'Sin ubicación',
            'email'               => $usuarioRow->correo_electronico ?? null,
            'telefono'            => $usuarioRow->telefono ?? null,
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
    }
    
    // Cambiar visibilidad del perfil (ocultar/mostrar)
    public function toggleVisibilidad(Request $request, $id)
    {
        $perfil = Perfil::findOrFail($id);

        // Si va a ocultar, exige un motivo y lo guarda en moderation_note
        if ($perfil->visible) {
            $request->validate([
                'motivo' => 'required|string|max:500',
            ], [
                'motivo.required' => 'Debes indicar el motivo para ocultar el portafolio.',
            ]);
            $perfil->moderation_note = $request->motivo;
        }

        $perfil->visible = !$perfil->visible;
        $perfil->save();

        $estado = $perfil->visible ? 'visible' : 'oculto';
        return back()->with('success', "Perfil marcado como {$estado}");
    }
    
    // Agregar nota de moderación
    public function agregarNota(Request $request, $id)
    {
        $perfil = Perfil::findOrFail($id);
        
        $request->validate([
            'moderation_note' => 'nullable|string|max:500'
        ]);
        
        $perfil->moderation_note = $request->moderation_note;
        $perfil->save();
        
        return back()->with('success', 'Nota de moderación guardada');
    }
}