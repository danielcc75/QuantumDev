        <section id="explorar" class="py-20 bg-white scroll-mt-28">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <span class="inline-block text-sm font-semibold tracking-wide uppercase text-[#e11d48] bg-red-50 px-4 py-1 rounded-full mb-4">
                    Explorar
                </span>

                <h2 class="text-3xl md:text-4xl font-bold text-[#1e3a5f] mb-4">
                    Proyectos y portafolios publicos
                </h2>

                <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Aqui podras descubrir proyectos compartidos por otros usuarios y explorar
                    distintos perfiles dentro de la plataforma de una forma clara y accesible.
                </p>
           
           
           
           
                @php
                    use Illuminate\Support\Facades\DB;

                    $gradPairs = [
                        ['from' => '#1e3a5f', 'to' => '#e11d48'],
                    ];

                    // Portafolios públicos: usuarios con perfil PÚBLICO que tengan biografía o algún proyecto/experiencia
                    $portafoliosBase = DB::table('usuario as u')
                        ->join('perfil as p', 'u.id_usuario', '=', 'p.id_usuario')
                        ->select('u.id_usuario', 'u.nombre', 'u.apellido', 'p.id_perfil', 'p.biografia', 'p.ubicacion', 'p.foto_perfil')
                        ->where('p.visibilidad', 'publico')
                        ->where('p.visible', true)
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
                        })
                        ->orderByDesc('p.id_perfil')
                        ->limit(6)
                        ->get();

                    $portafolios = $portafoliosBase->values()->map(function ($p, $idx) use ($gradPairs) {
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
                        $totalHabs = DB::table('habilidades')->where('id_perfil', $p->id_perfil)->where('publicado', true)->whereNull('deleted_at')->count();
                        $extraTags = max(0, $totalHabs - count($tags));

                        $exps  = DB::table('experiencia_laboral')->where('id_perfil', $p->id_perfil)->where('publicado', true)->whereNull('deleted_at')->get();
                        $meses = 0;
                        foreach ($exps as $e) {
                            $ini = \Carbon\Carbon::parse($e->fecha_ini);
                            $fin = ($e->trabajo_actual || !$e->fecha_fin) ? \Carbon\Carbon::now() : \Carbon\Carbon::parse($e->fecha_fin);
                            $meses += max(0, $ini->diffInMonths($fin));
                        }
                        $anios   = (int) floor($meses / 12);
                        $anioStr = $anios > 0 ? ($anios . ' año' . ($anios === 1 ? '' : 's'))
                                              : ($meses > 0 ? 'Menos de 1 año' : 'Sin experiencia registrada');

                        $cntProy = DB::table('proyectos')->where('id_perfil', $p->id_perfil)->where('visible', true)->whereNull('deleted_at')->count();

                        $cntEmpresas = DB::table('experiencia_laboral')
                            ->where('id_perfil', $p->id_perfil)
                            ->where('publicado', true)
                            ->whereNull('deleted_at')
                            ->distinct()
                            ->count('empresa');

                        // Links sociales (tipo => url)
                        $linksRows = DB::table('perfil_links')->where('id_perfil', $p->id_perfil)->get();
                        $links = [];
                        foreach ($linksRows as $l) { $links[strtolower($l->tipo)] = $l->url; }

                        // Habilidades agrupadas por categoría
                        $habGrupos = DB::table('habilidades as h')
                            ->leftJoin('categoria as c', 'h.id_categoria', '=', 'c.id_categoria')
                            ->where('h.id_perfil', $p->id_perfil)
                            ->where('h.publicado', true)
                            ->whereNull('h.deleted_at')
                            ->select('h.nombre', 'c.nombre as categoria')
                            ->get()
                            ->groupBy(fn($r) => $r->categoria ?? 'Otras')
                            ->map(fn($g) => $g->pluck('nombre')->all());

                        // Proyectos vinculados a experiencias (id_experiencia => [proyectos])
                        $proyectosPorExp = DB::table('proyectos')
                            ->where('id_perfil', $p->id_perfil)
                            ->where('visible', true)
                            ->whereNotNull('id_experiencia')
                            ->whereNull('deleted_at')
                            ->get()
                            ->groupBy('id_experiencia');

                        // Experiencias (todas) con sus proyectos vinculados
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

                        // Proyectos (visibles)
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

                        // Habilidades blandas del perfil
                        $habBlandas = DB::table('perfil_habilidad_blanda as phb')
                            ->join('habilidades_blandas as hb', 'phb.id_habilidad_blanda', '=', 'hb.id_habilidad_blanda')
                            ->where('phb.id_perfil', $p->id_perfil)
                            ->where('phb.publicado', true)
                            ->pluck('hb.nombre')
                            ->all();

                        // Formación académica
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

                        $grad = $gradPairs[$idx % count($gradPairs)];

                        return (object) [
                            'id_perfil'   => $p->id_perfil,
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
                    });
                @endphp

                @if($portafolios->isEmpty())
                    <div class="mt-10 bg-gray-50 border border-dashed border-gray-200 rounded-2xl p-12 text-center">
                        <div class="w-16 h-16 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-2xl text-[#1e3a5f]/50"></i>
                        </div>
                        <p class="text-gray-700 font-semibold">Aún no hay portafolios públicos</p>
                        <p class="text-sm text-gray-500 mt-1">Sé el primero en compartir tu perfil con la comunidad.</p>
                    </div>
                @else
                <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
                    @foreach($portafolios as $p)
                        <article class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all-soft overflow-hidden flex flex-col">
                            {{-- Cover --}}
                            <div class="relative h-28"
                                 style="background-image: linear-gradient(135deg, {{ $p->cover_from }} 0%, {{ $p->cover_to }} 100%);">
                                <div class="absolute inset-0 opacity-20"
                                     style="background-image: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.4) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255,255,255,0.3) 0%, transparent 50%);"></div>

                                {{-- Avatar --}}
                                @if(!empty($p->foto))
                                    <img src="{{ $p->foto }}" alt="{{ $p->nombre }}"
                                        class="absolute -bottom-6 left-5 w-14 h-14 rounded-full object-cover ring-4 ring-white shadow-md bg-white">
                                @else
                                    <div class="absolute -bottom-6 left-5 w-14 h-14 rounded-full bg-[#1e3a5f] text-white flex items-center justify-center font-bold text-base ring-4 ring-white shadow-md">
                                        {{ $p->iniciales }}
                                    </div>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="px-5 pt-9 pb-5 flex flex-col gap-3 flex-1">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-base leading-tight">{{ $p->nombre }}</h3>
                                    <p class="text-sm font-semibold text-[#e11d48] mt-0.5">{{ $p->rol }}</p>
                                </div>

                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-2">{{ $p->descripcion }}</p>

                                {{-- Tags --}}
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($p->tags as $tag)
                                        <span class="text-xs font-medium bg-[#1e3a5f]/8 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2.5 py-0.5 rounded-full">{{ $tag }}</span>
                                    @endforeach
                                    @if(($p->tags_extra ?? 0) > 0)
                                        <span class="text-xs font-medium bg-[#e11d48]/8 text-[#e11d48] border border-[#e11d48]/15 px-2.5 py-0.5 rounded-full">+{{ $p->tags_extra }}</span>
                                    @endif
                                </div>

                                {{-- Métricas --}}
                                <div class="flex items-center justify-between text-xs text-gray-600 pt-3 mt-auto border-t border-gray-100">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-briefcase text-[#1e3a5f]"></i>
                                        {{ $p->anios }}
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-code text-[#1e3a5f]"></i>
                                        {{ $p->proyectos }}
                                    </span>
                                </div>

                                {{-- Pie --}}
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-500 flex items-center gap-1.5">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        {{ $p->ubicacion }}
                                    </span>
                                    <button type="button"
                                            data-portafolio='@json($p)'
                                            onclick="abrirModalPortafolio(this)"
                                            class="font-semibold text-[#e11d48] hover:text-[#1e3a5f] transition-colors flex items-center gap-1">
                                        Ver portafolio
                                        <i class="fas fa-external-link-alt text-[10px]"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                @endif
            </div>
        </section>

