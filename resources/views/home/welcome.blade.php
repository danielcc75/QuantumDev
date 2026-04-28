<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portafolio Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        html {
            scroll-behavior: smooth;
        }

        .transition-all-soft {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        .hero-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hero-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12);
        }
    </style>
</head>

<body class="bg-gray-50 font-sans min-h-screen flex flex-col">

    <!-- navbar -->
    <header class="bg-white shadow-md sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- logo -->
            <a href="#inicio" class="flex items-center gap-3 transition-all-soft hover-scale">
                <img src="/logo.png" class="h-10 md:h-11" alt="Logo">

                <div class="flex flex-col leading-none">
                    <span class="font-bold text-[#1e3a5f] text-lg">
                        Portafolio
                    </span>
                    <span class="text-[#e11d48] font-semibold text-base -mt-2">
                        Digital
                    </span>
                </div>
            </a>

            <!-- menu -->
            <nav class="hidden md:flex gap-8 text-gray-600">
                <a href="#inicio" class="nav-link menu-link text-[#e11d48] font-bold transition">Inicio</a>
                <a href="#como-funciona" class="nav-link menu-link hover:text-[#1e3a5f] transition">Como funciona</a>
                <a href="#sobre-nosotros" class="nav-link menu-link hover:text-[#1e3a5f] transition">Sobre nosotros</a>
                <a href="#explorar" class="nav-link menu-link hover:text-[#1e3a5f] transition">Explorar</a>
            </nav>

            <!-- botones / usuario -->
            <div class="flex items-center gap-3">
                @if (session('usuario_id'))

                    @php
                        $nombreUsuario = session('usuario_nombre');
                        $iniciales = strtoupper(substr($nombreUsuario, 0, 2));
                    @endphp

                    <div class="relative dropdown">
                        <button class="flex items-center space-x-2 focus:outline-none hover:bg-gray-100 px-2 py-1 rounded-lg transition-all-soft">

                            <!-- avatar -->
                            <div class="w-10 h-10 bg-gradient-to-br from-[#1e3a5f] to-indigo-600 rounded-full flex items-center justify-center shadow-md">
                                <span class="text-white text-sm font-bold">{{ $iniciales }}</span>
                            </div>

                            <!-- nombre -->
                            <span class="text-sm font-medium text-gray-700 hidden md:inline">
                                {{ $nombreUsuario }}
                            </span>

                            <!-- flecha -->
                            <i class="fas fa-chevron-down text-xs text-gray-500 hidden md:inline"></i>
                        </button>

                        <!-- dropdown -->
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg border border-gray-100 z-40">

                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Mi dashboard
                            </a>

                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i> Configuracion
                            </a>

                            <div class="border-t border-gray-100"></div>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[#e11d48] hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesion
                                </button>
                            </form>

                        </div>
                    </div>

                @else
                    <a href="javascript:void(0)" onclick="abrirLogin()" class="border border-[#1e3a5f]/20 px-4 py-2 rounded-md text-[#1e3a5f] hover:bg-[#1e3a5f]/5 transition-all-soft hover-lift">
                        Iniciar sesion
                    </a>
                    <a href="javascript:void(0)" onclick="abrirRegister()" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-md hover:bg-[#16304d] transition-all-soft hover-lift">
                        Registrarse
                    </a>
                @endif
            </div>

        </div>
    </header>

    <!-- contenido principal -->
    <main class="flex-grow">

        <!-- hero -->
        <section id="inicio" class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center scroll-mt-28">

            <!-- texto -->
            <div>
                <div class="mb-6 flex items-center gap-4">
                    <img src="/logo.png" class="h-16 md:h-20 transition-all-soft hover-scale" alt="Logo grande">
                    <div>
                        <h1 class="text-5xl font-bold text-[#1e3a5f] leading-tight">
                            Portafolio
                        </h1>
                        <h2 class="text-5xl font-bold text-[#e11d48] leading-tight">
                            Digital
                        </h2>
                    </div>
                </div>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    Una plataforma pensada para que estudiantes y desarrolladores puedan
                    crear, organizar y compartir sus proyectos en un espacio profesional,
                    claro y accesible.
                </p>

                <!-- botones -->
                <div class="mt-6 flex gap-4 flex-wrap">
                    @if (session('usuario_id'))
                        <a href="{{ route('dashboard') }}"
                        class="bg-[#1e3a5f] text-white px-6 py-3 rounded-md hover:bg-[#16304d] transition-all-soft hover-scale">
                            Ir a mi portafolio
                        </a>
                    @else
                        <a href="javascript:void(0)" onclick="abrirRegister()"
                        class="bg-[#1e3a5f] text-white px-6 py-3 rounded-md hover:bg-[#16304d] transition-all-soft hover-scale">
                            Crea tu portafolio
                        </a>
                    @endif

                    <a href="#explorar"
                       class="bg-gray-200 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-300 transition-all-soft hover-scale">
                        Explorar proyectos
                    </a>
                </div>

                <!-- stats -->
                <div class="flex gap-10 mt-10 text-[#1e3a5f] font-bold flex-wrap">
                    <div class="transition-all-soft hover-scale">
                        <p class="text-2xl">+5</p>
                        <span class="text-gray-500 text-sm font-normal">Años de Experiencia</span>
                    </div>
                    <div class="transition-all-soft hover-scale">
                        <p class="text-2xl">+40</p>
                        <span class="text-gray-500 text-sm font-normal">Proyectos Entregados</span>
                    </div>
                    <div class="transition-all-soft hover-scale">
                        <p class="text-2xl">100%</p>
                        <span class="text-gray-500 text-sm font-normal">Satisfaccion</span>
                    </div>
                </div>
            </div>

            <!-- imagen -->
            <div class="relative">
                <img src="/hero.jpg" class="rounded-xl shadow-lg transition-all-soft hover:scale-105" alt="Hero">

                <!-- badge -->
                <div class="hero-card absolute bottom-4 left-4 bg-white shadow-md rounded-lg px-4 py-2 flex items-center gap-2 transition-all-soft border border-gray-100">
                    <div class="w-3 h-3 bg-[#e11d48] rounded-full animate-pulse"></div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">
                            Crea tu presencia profesional
                        </p>
                        <span class="text-xs text-gray-500">
                            Proyectos, habilidades y perfil en un solo lugar
                        </span>
                    </div>
                </div>
            </div>

        </section>

        @include('home.sections.como-funciona')
        @include('home.sections.sobre-nosotros')

        <!-- explorar -->
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
                        ['from' => '#1e3a5f', 'to' => '#3b5a82'],
                        ['from' => '#0f1f3a', 'to' => '#1e3a5f'],
                        ['from' => '#1e3a5f', 'to' => '#e11d48'],
                        ['from' => '#1e293b', 'to' => '#1e3a5f'],
                        ['from' => '#e11d48', 'to' => '#1e3a5f'],
                        ['from' => '#374151', 'to' => '#1e3a5f'],
                    ];

                    // Portafolios públicos: usuarios con perfil que tengan biografía o algún proyecto/experiencia
                    $portafoliosBase = DB::table('usuario as u')
                        ->join('perfil as p', 'u.id_usuario', '=', 'p.id_usuario')
                        ->select('u.id_usuario', 'u.nombre', 'u.apellido', 'p.id_perfil', 'p.biografia', 'p.ubicacion', 'p.foto_perfil')
                        ->where(function ($q) {
                            $q->whereNotNull('p.biografia')
                              ->orWhereExists(function ($sub) {
                                  $sub->select(DB::raw(1))->from('proyectos')->whereColumn('proyectos.id_perfil', 'p.id_perfil');
                              })
                              ->orWhereExists(function ($sub) {
                                  $sub->select(DB::raw(1))->from('experiencia_laboral')->whereColumn('experiencia_laboral.id_perfil', 'p.id_perfil');
                              });
                        })
                        ->orderByDesc('p.id_perfil')
                        ->limit(6)
                        ->get();

                    $portafolios = $portafoliosBase->values()->map(function ($p, $idx) use ($gradPairs) {
                        $usuarioRow = DB::table('usuario')->where('id_usuario', $p->id_usuario)->first();

                        $cargo = DB::table('experiencia_laboral')
                            ->where('id_perfil', $p->id_perfil)
                            ->orderByDesc('fecha_ini')
                            ->value('cargo') ?? 'Desarrollador';

                        $tags = DB::table('habilidades')
                            ->where('id_perfil', $p->id_perfil)
                            ->orderByDesc('id_habilidad')
                            ->limit(3)
                            ->pluck('nombre')
                            ->all();
                        $totalHabs = DB::table('habilidades')->where('id_perfil', $p->id_perfil)->count();
                        $extraTags = max(0, $totalHabs - count($tags));

                        $exps  = DB::table('experiencia_laboral')->where('id_perfil', $p->id_perfil)->get();
                        $meses = 0;
                        foreach ($exps as $e) {
                            $ini = \Carbon\Carbon::parse($e->fecha_ini);
                            $fin = ($e->trabajo_actual || !$e->fecha_fin) ? \Carbon\Carbon::now() : \Carbon\Carbon::parse($e->fecha_fin);
                            $meses += max(0, $ini->diffInMonths($fin));
                        }
                        $anios   = (int) floor($meses / 12);
                        $anioStr = $anios > 0 ? ($anios . ' año' . ($anios === 1 ? '' : 's'))
                                              : ($meses > 0 ? 'Menos de 1 año' : 'Sin experiencia registrada');

                        $cntProy = DB::table('proyectos')->where('id_perfil', $p->id_perfil)->count();

                        // Links sociales (tipo => url)
                        $linksRows = DB::table('perfil_links')->where('id_perfil', $p->id_perfil)->get();
                        $links = [];
                        foreach ($linksRows as $l) { $links[strtolower($l->tipo)] = $l->url; }

                        // Habilidades agrupadas por categoría
                        $habGrupos = DB::table('habilidades as h')
                            ->leftJoin('categoria as c', 'h.id_categoria', '=', 'c.id_categoria')
                            ->where('h.id_perfil', $p->id_perfil)
                            ->select('h.nombre', 'c.nombre as categoria')
                            ->get()
                            ->groupBy(fn($r) => $r->categoria ?? 'Otras')
                            ->map(fn($g) => $g->pluck('nombre')->all());

                        // Proyectos vinculados a experiencias (id_experiencia => [proyectos])
                        $proyectosPorExp = DB::table('proyectos')
                            ->where('id_perfil', $p->id_perfil)
                            ->whereNotNull('id_experiencia')
                            ->get()
                            ->groupBy('id_experiencia');

                        // Experiencias (todas) con sus proyectos vinculados
                        $experiencias = DB::table('experiencia_laboral')
                            ->where('id_perfil', $p->id_perfil)
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
                            ->orderByDesc('fecha_ini')
                            ->get()
                            ->map(fn($pr) => [
                                'nombre'      => $pr->nombre,
                                'descripcion' => $pr->descripcion,
                                'url_link'    => $pr->url_link,
                                'fecha_ini'   => $pr->fecha_ini,
                                'fecha_fin'   => $pr->fecha_fin,
                                'estado'      => $pr->estado,
                                'tecnologias' => $pr->tecnologias,
                            ])->all();

                        // Formación académica
                        $formacion = DB::table('formacion_academica')
                            ->where('id_perfil', $p->id_perfil)
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
                            'descripcion' => $p->biografia ?: 'Profesional construyendo su portafolio digital.',
                            'tags'        => $tags,
                            'tags_extra'  => $extraTags,
                            'anios'       => $anioStr,
                            'anios_num'   => $anios,
                            'proyectos'   => $cntProy . ' proyecto' . ($cntProy === 1 ? '' : 's'),
                            'cnt_proy'    => $cntProy,
                            'cnt_habs'    => $totalHabs,
                            'ubicacion'   => $p->ubicacion ?: 'Sin ubicación',
                            'email'       => $usuarioRow->correo_electronico ?? null,
                            'telefono'    => $usuarioRow->telefono ?? null,
                            'links'       => $links,
                            'habilidades_grupos' => $habGrupos,
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
                                <div class="absolute -bottom-6 left-5 w-14 h-14 rounded-full bg-[#1e3a5f] text-white flex items-center justify-center font-bold text-base ring-4 ring-white shadow-md">
                                    {{ $p->iniciales }}
                                </div>
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

    </main>

    {{-- ===== Modal Portafolio ===== --}}
    <div id="modalPortafolio"
         class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm overflow-y-auto"
         onclick="cerrarModalPortafolioFondo(event)">
        <div class="min-h-full flex items-start justify-center p-4 py-8">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl overflow-hidden" onclick="event.stopPropagation()">

                {{-- Hero --}}
                <div id="mp_hero" class="relative px-6 sm:px-10 pt-10 pb-12 text-white"
                     style="background-image: linear-gradient(135deg, #1e3a5f 0%, #e11d48 100%);">
                    <button type="button" onclick="cerrarModalPortafolio()"
                            class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/15 hover:bg-white/30 transition flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>

                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-start">
                        {{-- Identidad --}}
                        <div class="lg:col-span-3">
                            <div class="flex items-start gap-4">
                                <div id="mp_avatar"
                                     class="w-20 h-20 rounded-full bg-white/95 text-[#1e3a5f] flex items-center justify-center font-extrabold text-2xl ring-4 ring-white/30 shadow-lg flex-shrink-0">
                                    JP
                                </div>
                                <div class="min-w-0">
                                    <h2 id="mp_nombre" class="text-2xl sm:text-3xl font-extrabold leading-tight"></h2>
                                    <p id="mp_rol" class="text-white/90 font-semibold mt-0.5"></p>
                                    <p id="mp_bio_corta" class="text-sm text-white/80 mt-2 max-w-xl leading-relaxed"></p>
                                </div>
                            </div>

                            <div id="mp_links" class="flex flex-wrap gap-2 mt-5"></div>
                        </div>

                        {{-- Contacto --}}
                        <div class="lg:col-span-2 flex flex-col gap-2">
                            <div id="mp_contact_email" class="flex items-center gap-3 bg-white/12 border border-white/20 rounded-xl px-4 py-3 hidden">
                                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center"><i class="fas fa-envelope"></i></div>
                                <div class="min-w-0">
                                    <p class="text-[11px] uppercase tracking-wider text-white/70">Email</p>
                                    <p class="text-sm font-medium truncate"></p>
                                </div>
                            </div>
                            <div id="mp_contact_tel" class="flex items-center gap-3 bg-white/12 border border-white/20 rounded-xl px-4 py-3 hidden">
                                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center"><i class="fas fa-phone"></i></div>
                                <div>
                                    <p class="text-[11px] uppercase tracking-wider text-white/70">Teléfono</p>
                                    <p class="text-sm font-medium"></p>
                                </div>
                            </div>
                            <div id="mp_contact_loc" class="flex items-center gap-3 bg-white/12 border border-white/20 rounded-xl px-4 py-3 hidden">
                                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center"><i class="fas fa-map-marker-alt"></i></div>
                                <div>
                                    <p class="text-[11px] uppercase tracking-wider text-white/70">Ubicación</p>
                                    <p class="text-sm font-medium"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sobre mí --}}
                <section class="px-6 sm:px-10 py-8 bg-gray-50">
                    <h3 class="text-center text-lg font-bold text-[#1e3a5f] mb-5">
                        <span class="inline-block border-b-2 border-[#e11d48] pb-1">Sobre mí</span>
                    </h3>
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <p id="mp_bio" class="text-sm text-gray-700 leading-relaxed text-center"></p>

                        <div class="grid grid-cols-3 gap-3 mt-6">
                            <div class="bg-gradient-to-br from-[#1e3a5f]/5 to-[#1e3a5f]/10 border border-[#1e3a5f]/15 rounded-xl p-4 text-center">
                                <div class="w-10 h-10 rounded-lg bg-[#1e3a5f] text-white flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <p id="mp_stat_anios" class="text-2xl font-extrabold text-[#1e3a5f]">0</p>
                                <p class="text-xs text-gray-600 mt-0.5">Años de experiencia</p>
                            </div>
                            <div class="bg-gradient-to-br from-[#e11d48]/5 to-[#e11d48]/10 border border-[#e11d48]/15 rounded-xl p-4 text-center">
                                <div class="w-10 h-10 rounded-lg bg-[#e11d48] text-white flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <p id="mp_stat_proy" class="text-2xl font-extrabold text-[#1e3a5f]">0</p>
                                <p class="text-xs text-gray-600 mt-0.5">Proyectos</p>
                            </div>
                            <div class="bg-gradient-to-br from-[#1e3a5f]/5 to-[#e11d48]/10 border border-gray-200 rounded-xl p-4 text-center">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#1e3a5f] to-[#e11d48] text-white flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-award"></i>
                                </div>
                                <p id="mp_stat_habs" class="text-2xl font-extrabold text-[#1e3a5f]">0</p>
                                <p class="text-xs text-gray-600 mt-0.5">Habilidades</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Habilidades --}}
                <section class="px-6 sm:px-10 py-8">
                    <h3 class="text-center text-lg font-bold text-[#1e3a5f] mb-5">
                        <span class="inline-block border-b-2 border-[#e11d48] pb-1">Habilidades</span>
                    </h3>
                    <div id="mp_habilidades_grupos" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                    <p id="mp_habilidades_empty" class="text-sm text-gray-400 italic text-center hidden">No hay habilidades registradas todavía.</p>
                </section>

                {{-- Experiencia laboral --}}
                <section class="px-6 sm:px-10 py-8 bg-gray-50">
                    <h3 class="text-center text-lg font-bold text-[#1e3a5f] mb-5">
                        <span class="inline-block border-b-2 border-[#e11d48] pb-1">Experiencia laboral</span>
                    </h3>
                    <div id="mp_experiencias" class="flex flex-col gap-3"></div>
                    <p id="mp_experiencias_empty" class="text-sm text-gray-400 italic text-center hidden">No hay experiencia laboral registrada.</p>
                </section>

                {{-- Formación académica --}}
                <section class="px-6 sm:px-10 py-8">
                    <h3 class="text-center text-lg font-bold text-[#1e3a5f] mb-5">
                        <span class="inline-block border-b-2 border-[#e11d48] pb-1">Formación académica</span>
                    </h3>
                    <div id="mp_formacion" class="flex flex-col gap-3"></div>
                    <p id="mp_formacion_empty" class="text-sm text-gray-400 italic text-center hidden">No hay formación académica registrada.</p>
                </section>

                {{-- Proyectos --}}
                <section class="px-6 sm:px-10 py-8 bg-gray-50">
                    <h3 class="text-center text-lg font-bold text-[#1e3a5f] mb-5">
                        <span class="inline-block border-b-2 border-[#e11d48] pb-1">Proyectos</span>
                    </h3>
                    <div id="mp_proyectos" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                    <p id="mp_proyectos_empty" class="text-sm text-gray-400 italic text-center hidden">No hay proyectos publicados.</p>
                </section>

            </div>
        </div>
    </div>

    <script>
    (function () {
        const modal = document.getElementById('modalPortafolio');

        const ICONS_LINK = {
            github:    'fab fa-github',
            linkedin:  'fab fa-linkedin',
            twitter:   'fab fa-twitter',
            x:         'fab fa-x-twitter',
            facebook:  'fab fa-facebook',
            instagram: 'fab fa-instagram',
            youtube:   'fab fa-youtube',
            website:   'fas fa-globe',
            web:       'fas fa-globe',
            sitio:     'fas fa-globe',
            portfolio: 'fas fa-globe',
            email:     'fas fa-envelope',
        };

        function setText(id, value) {
            const el = document.getElementById(id);
            if (el) el.textContent = value ?? '';
        }

        function escapeHtml(s) {
            const d = document.createElement('div');
            d.textContent = s ?? '';
            return d.innerHTML;
        }

        window.abrirModalPortafolio = function (btn) {
            let data;
            try { data = JSON.parse(btn.dataset.portafolio); } catch (e) { return; }

            // Hero
            const hero = document.getElementById('mp_hero');
            hero.style.backgroundImage = `linear-gradient(135deg, ${data.cover_from || '#1e3a5f'} 0%, ${data.cover_to || '#e11d48'} 100%)`;

            document.getElementById('mp_avatar').textContent = data.iniciales || '??';
            setText('mp_nombre', data.nombre);
            setText('mp_rol', data.rol);
            setText('mp_bio_corta', data.descripcion);
            setText('mp_bio', data.descripcion);
            setText('mp_stat_anios', data.anios_num ?? 0);
            setText('mp_stat_proy', data.cnt_proy ?? 0);
            setText('mp_stat_habs', data.cnt_habs ?? 0);

            // Contacto
            const setContact = (wrapperId, value) => {
                const wrap = document.getElementById(wrapperId);
                const p = wrap.querySelector('p:last-child');
                if (value) {
                    p.textContent = value;
                    wrap.classList.remove('hidden');
                } else {
                    wrap.classList.add('hidden');
                }
            };
            setContact('mp_contact_email', data.email);
            setContact('mp_contact_tel',   data.telefono);
            setContact('mp_contact_loc',   data.ubicacion);

            // Links sociales
            const linksWrap = document.getElementById('mp_links');
            linksWrap.innerHTML = '';
            const links = data.links || {};
            Object.keys(links).forEach(tipo => {
                const url  = links[tipo];
                if (!url) return;
                const icon = ICONS_LINK[tipo] || 'fas fa-link';
                const label = tipo.charAt(0).toUpperCase() + tipo.slice(1);
                const a = document.createElement('a');
                a.href = url;
                a.target = '_blank';
                a.rel = 'noopener noreferrer';
                a.className = 'inline-flex items-center gap-2 bg-white/15 hover:bg-white/25 border border-white/25 text-white text-xs font-medium px-3 py-1.5 rounded-full transition';
                a.innerHTML = `<i class="${icon}"></i> ${escapeHtml(label)}`;
                linksWrap.appendChild(a);
            });

            // Habilidades por categoría
            const grupos = data.habilidades_grupos || {};
            const cont   = document.getElementById('mp_habilidades_grupos');
            const empty  = document.getElementById('mp_habilidades_empty');
            cont.innerHTML = '';
            const nombresCats = Object.keys(grupos);
            if (nombresCats.length === 0) {
                empty.classList.remove('hidden');
            } else {
                empty.classList.add('hidden');
                nombresCats.forEach((cat, i) => {
                    const items = grupos[cat] || [];
                    const accent = i % 2 === 0 ? '#1e3a5f' : '#e11d48';
                    const card = document.createElement('div');
                    card.className = 'bg-white border border-gray-100 rounded-2xl p-5 shadow-sm';
                    card.innerHTML = `
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white" style="background:${accent}">
                                <i class="fas fa-code text-xs"></i>
                            </div>
                            <h4 class="font-bold text-[#1e3a5f] text-sm">${escapeHtml(cat)}</h4>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            ${items.map(it => `<span class="text-xs font-medium px-2.5 py-0.5 rounded-full border" style="color:${accent};border-color:${accent}33;background:${accent}14">${escapeHtml(it)}</span>`).join('')}
                        </div>`;
                    cont.appendChild(card);
                });
            }

            // Experiencias
            renderTimeline(
                'mp_experiencias', 'mp_experiencias_empty',
                data.experiencias || [],
                (e) => {
                    const proys = e.proyectos || [];
                    const proysHtml = proys.length ? `
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <p class="text-[11px] font-semibold uppercase tracking-wider text-gray-500 mb-2">
                                <i class="fas fa-folder text-[#1e3a5f]/60 mr-1"></i> Proyectos relacionados
                            </p>
                            <div class="flex flex-wrap gap-1.5">
                                ${proys.map(pr => pr.url_link
                                    ? `<a href="${pr.url_link}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-medium bg-[#1e3a5f]/8 hover:bg-[#1e3a5f]/15 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2.5 py-1 rounded-full transition"><i class="fas fa-code-branch text-[10px]"></i>${escapeHtml(pr.nombre)}<i class="fas fa-external-link-alt text-[9px] opacity-70"></i></a>`
                                    : `<span class="inline-flex items-center gap-1.5 text-xs font-medium bg-[#1e3a5f]/8 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2.5 py-1 rounded-full"><i class="fas fa-code-branch text-[10px]"></i>${escapeHtml(pr.nombre)}</span>`
                                ).join('')}
                            </div>
                        </div>` : '';
                    return `
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm border-l-4 border-l-[#1e3a5f]">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <h4 class="font-bold text-[#1e3a5f] text-sm">${escapeHtml(e.cargo)}</h4>
                                <p class="text-xs font-semibold text-[#e11d48] mt-0.5">${escapeHtml(e.empresa)}</p>
                            </div>
                            ${e.trabajo_actual
                                ? '<span class="text-[10px] font-semibold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-100 px-2 py-0.5 rounded-full whitespace-nowrap">Actual</span>'
                                : ''}
                        </div>
                        <p class="text-xs text-gray-500 mt-1.5 flex items-center gap-1.5">
                            <i class="far fa-calendar"></i>
                            ${formatRangoFecha(e.fecha_ini, e.fecha_fin, e.trabajo_actual)}
                        </p>
                        ${e.descripcion ? `<p class="text-sm text-gray-600 leading-relaxed mt-2">${escapeHtml(e.descripcion)}</p>` : ''}
                        ${proysHtml}
                    </div>`;
                }
            );

            // Formación
            renderTimeline(
                'mp_formacion', 'mp_formacion_empty',
                data.formacion || [],
                (f) => `
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm border-l-4 border-l-[#e11d48]">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <h4 class="font-bold text-[#1e3a5f] text-sm">${escapeHtml(f.titulo)}</h4>
                                <p class="text-xs font-semibold text-[#e11d48] mt-0.5">${escapeHtml(f.institucion)}</p>
                            </div>
                            ${f.nivel ? `<span class="text-[10px] font-semibold uppercase tracking-wider bg-[#1e3a5f]/8 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2 py-0.5 rounded-full whitespace-nowrap">${escapeHtml(f.nivel)}</span>` : ''}
                        </div>
                        <p class="text-xs text-gray-500 mt-1.5 flex items-center gap-1.5">
                            <i class="far fa-calendar"></i>
                            ${formatRangoFecha(f.fecha_ini, f.fecha_fin, false)}
                        </p>
                        ${f.descripcion ? `<p class="text-sm text-gray-600 leading-relaxed mt-2">${escapeHtml(f.descripcion)}</p>` : ''}
                    </div>`
            );

            // Proyectos
            const ESTADO_LABELS = {
                en_progreso: { label: 'En curso',     bg: 'bg-[#1e3a5f]/10', text: 'text-[#1e3a5f]' },
                completado:  { label: 'Completado',   bg: 'bg-emerald-50',   text: 'text-emerald-700' },
                pendiente:   { label: 'Pendiente',    bg: 'bg-gray-100',     text: 'text-gray-600' },
                cancelado:   { label: 'Cancelado',    bg: 'bg-red-50',       text: 'text-[#e11d48]' },
            };
            renderTimeline(
                'mp_proyectos', 'mp_proyectos_empty',
                data.proyectos_lista || [],
                (pr) => {
                    const estado = ESTADO_LABELS[pr.estado] || ESTADO_LABELS.pendiente;
                    const tags = (pr.tecnologias || '').split(',').map(t => t.trim()).filter(Boolean);
                    return `
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex flex-col gap-2">
                        <div class="flex items-start justify-between gap-2">
                            <h4 class="font-bold text-[#1e3a5f] text-sm leading-tight">${escapeHtml(pr.nombre)}</h4>
                            <span class="text-[10px] font-semibold uppercase tracking-wider ${estado.bg} ${estado.text} px-2 py-0.5 rounded-full whitespace-nowrap">${estado.label}</span>
                        </div>
                        ${pr.descripcion ? `<p class="text-xs text-gray-600 leading-relaxed">${escapeHtml(pr.descripcion)}</p>` : ''}
                        <p class="text-xs text-gray-500 flex items-center gap-1.5">
                            <i class="far fa-calendar"></i>
                            ${formatRangoFecha(pr.fecha_ini, pr.fecha_fin, false)}
                        </p>
                        ${tags.length ? `<div class="flex flex-wrap gap-1.5">${tags.slice(0, 6).map(t => `<span class="text-[11px] font-medium bg-[#1e3a5f]/8 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2 py-0.5 rounded-full">${escapeHtml(t)}</span>`).join('')}${tags.length > 6 ? `<span class="text-[11px] font-medium bg-[#e11d48]/8 text-[#e11d48] border border-[#e11d48]/15 px-2 py-0.5 rounded-full">+${tags.length - 6}</span>` : ''}</div>` : ''}
                        ${pr.url_link ? `<a href="${pr.url_link}" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-[#e11d48] hover:text-[#1e3a5f] transition mt-1 inline-flex items-center gap-1"><i class="fas fa-external-link-alt text-[10px]"></i> Ver proyecto</a>` : ''}
                    </div>`;
                }
            );

            modal.classList.remove('hidden');
            modal.scrollTop = 0;
            document.body.style.overflow = 'hidden';
        };

        function renderTimeline(contId, emptyId, items, builder) {
            const cont  = document.getElementById(contId);
            const empty = document.getElementById(emptyId);
            cont.innerHTML = '';
            if (!items || items.length === 0) {
                empty.classList.remove('hidden');
                return;
            }
            empty.classList.add('hidden');
            cont.innerHTML = items.map(builder).join('');
        }

        function formatRangoFecha(ini, fin, actual) {
            if (!ini) return '';
            const f = (s) => {
                const d = new Date(s + 'T12:00:00');
                if (isNaN(d.getTime())) return '';
                const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
                return `${meses[d.getMonth()]} ${d.getFullYear()}`;
            };
            const ini2 = f(ini);
            const fin2 = actual ? 'Actualidad' : (fin ? f(fin) : '—');
            return `${ini2} – ${fin2}`;
        }

        window.cerrarModalPortafolio = function () {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        };

        window.cerrarModalPortafolioFondo = function (e) {
            if (e.target === modal) cerrarModalPortafolio();
        };

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) cerrarModalPortafolio();
        });
    })();
    </script>

    <!-- footer -->
    <footer class="bg-[#1e3a5f] text-white">
        <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">

            <div>
                <h2 class="font-bold text-lg">Portafolio Digital</h2>
                <p class="text-sm mt-2 text-gray-300">
                    Construyendo espacios digitales donde estudiantes y desarrolladores puedan mostrar su talento de forma clara y profesional.
                </p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">Enlaces</h3>
                <ul class="text-gray-300 text-sm space-y-1">
                    <li><a href="#inicio" class="hover:text-white transition-all-soft">Inicio</a></li>
                    <li><a href="#explorar" class="hover:text-white transition-all-soft">Explorar</a></li>
                    <li><a href="#como-funciona" class="hover:text-white transition-all-soft">Como funciona</a></li>
                    <li><a href="#sobre-nosotros" class="hover:text-white transition-all-soft">Sobre nosotros</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-2">Contacto</h3>
                <p class="text-gray-300 text-sm">QuantumDev</p>
                <p class="text-gray-300 text-sm">Email: contacto@quantumdev.dev</p>
                <p class="text-gray-300 text-sm">Tel: +591 700 123 456</p>
            </div>

        </div>

        <div class="text-center text-gray-300 text-sm pb-4">
            © 2026 Portafolio Digital. Todos los derechos reservados.
        </div>
    </footer>

    @include('auth.login')
    @include('auth.register')
    @include('home.scripts-home')

</body>
</html>