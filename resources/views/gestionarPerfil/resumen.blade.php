{{-- resources/views/gestionarPerfil/resumen.blade.php --}}

<!-- Contenido central - Fluye naturalmente -->
<div class="ml-80 mr-80">
    <main class="p-8">
        <!-- Saludo -->
        <div class="mb-8">
            <div class="px-1 py-2 text-xs text-gray-400">Dashboard / Mi Perfil / Proyectos</div>
            <h2 class="text-3xl font-bold text-gray-800 mt-2">Hola, {{ $nombreUsuario ?? 'Usuario' }}</h2>
            <p class="text-sm text-gray-500 mt-1">Resumen de tu actividad, proyectos y rendimiento reciente en el sistema.</p>
        </div>

        <!-- Stats Grid -->
        @php
            $perfilResumen = isset($userId) ? DB::table('perfil')->where('id_usuario', $userId)->first() : null;
            $perfilId = $perfilResumen->id_perfil ?? null;
            $totalProyectos = $perfilId ? DB::table('proyectos')->where('id_perfil', $perfilId)->count() : 0;
            $stats = [
                'repos' => $totalProyectos,
                'commits' => $totalProyectos * 45,
                'estudios' => $perfilId ? DB::table('formacion_academica')->where('id_perfil', $perfilId)->count() : 0,
                'codigo_limpio' => 95
            ];
        @endphp
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center stat-card">
                <div id="resumen-stat-repos" class="text-3xl font-bold text-blue-600">{{ $stats['repos'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Proyectos</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center stat-card">
                <div id="resumen-stat-actividades" class="text-3xl font-bold text-green-600">{{ number_format($stats['commits']) }}</div>
                <div class="text-sm text-gray-500 mt-1">Actividades</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center stat-card">
                <div class="text-3xl font-bold text-purple-600">{{ $stats['estudios'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Estudios</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center stat-card">
                <div class="text-3xl font-bold text-orange-600">{{ $stats['codigo_limpio'] }}%</div>
                <div class="text-sm text-gray-500 mt-1">Completado</div>
            </div>
        </div>

        <!-- Proyectos recientes -->
        @php
            $proyectosRecientes = $perfilId ? DB::table('proyectos')
                ->where('id_perfil', $perfilId)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get() : collect();

            $estadoConfig = [
                'en_progreso' => ['label' => 'En curso',   'icon' => 'fa-spinner',      'bg' => 'bg-[#1e3a5f]/10', 'text' => 'text-[#1e3a5f]'],
                'completado'  => ['label' => 'Finalizado', 'icon' => 'fa-check-circle', 'bg' => 'bg-indigo-100',   'text' => 'text-indigo-700'],
                'pendiente'   => ['label' => 'Pendiente',  'icon' => 'fa-clock',        'bg' => 'bg-gray-100',     'text' => 'text-gray-600'],
                'cancelado'   => ['label' => 'Cancelado',  'icon' => 'fa-times-circle', 'bg' => 'bg-red-100',      'text' => 'text-[#e11d48]'],
            ];

            $accentColors = [
                'bg-[#1e3a5f]',
                'bg-[#e11d48]',
                'bg-indigo-600',
            ];
        @endphp

        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-bold text-[#1e3a5f]">Proyectos recientes</h3>
                    <div class="h-0.5 w-10 bg-[#e11d48] rounded-full mt-1"></div>
                </div>
                <span id="resumen-proyectos-count" class="text-xs text-gray-400">Últimos {{ $proyectosRecientes->count() }} registros</span>
            </div>

            @if($proyectosRecientes->isEmpty())
                <div id="resumen-proyectos-empty" class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
                    <div class="w-14 h-14 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-folder-open text-2xl text-[#1e3a5f]/40"></i>
                    </div>
                    <p class="text-gray-500 font-medium text-sm">No hay proyectos registrados</p>
                </div>
                <div id="resumen-proyectos-grid" class="grid grid-cols-1 md:grid-cols-3 gap-4 hidden"></div>
            @else
                <div id="resumen-proyectos-empty" class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center hidden">
                    <div class="w-14 h-14 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-folder-open text-2xl text-[#1e3a5f]/40"></i>
                    </div>
                    <p class="text-gray-500 font-medium text-sm">No hay proyectos registrados</p>
                </div>
                <div id="resumen-proyectos-grid" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($proyectosRecientes as $i => $proyecto)
                    @php
                        $cfg    = $estadoConfig[$proyecto->estado] ?? $estadoConfig['pendiente'];
                        $accent = $accentColors[$i % count($accentColors)];
                        $tags   = $proyecto->tecnologias
                            ? array_slice(array_filter(array_map('trim', explode(',', $proyecto->tecnologias))), 0, 3)
                            : [];
                    @endphp
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-md hover:-translate-y-1 hover:shadow-xl transition-all duration-200 overflow-hidden flex flex-col">

                        {{-- Franja de color superior --}}
                        <div class="h-1.5 w-full {{ $accent }}"></div>

                        <div class="p-5 flex flex-col gap-3 flex-1">

                            {{-- Ícono + nombre --}}
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-xl {{ $accent }} flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-code-branch text-white text-sm"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-[#1e3a5f] text-sm leading-snug line-clamp-1">{{ $proyecto->nombre }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        {{ \Carbon\Carbon::parse($proyecto->fecha_ini)->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Descripción --}}
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
                                {{ $proyecto->descripcion ?? 'Sin descripción' }}
                            </p>

                            {{-- Tags tecnologías --}}
                            @if(count($tags))
                            <div class="flex flex-wrap gap-1">
                                @foreach($tags as $tag)
                                <span class="text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2 py-0.5 rounded-md font-medium">{{ $tag }}</span>
                                @endforeach
                            </div>
                            @endif

                            {{-- Badge estado --}}
                            <div class="mt-auto pt-3 border-t border-gray-100">
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full {{ $cfg['bg'] }} {{ $cfg['text'] }}">
                                    <i class="fas {{ $cfg['icon'] }} text-xs"></i>
                                    {{ $cfg['label'] }}
                                </span>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
        <script>window._resumenProyectosIniciales = {{ $proyectosRecientes->count() }};</script>

        <!-- Habilidades técnicas -->
        @php
            $habilidadesResumen = $perfilId ? DB::table('habilidades')
                ->join('categoria', 'habilidades.id_categoria', '=', 'categoria.id_categoria')
                ->where('habilidades.id_perfil', $perfilId)
                ->select('habilidades.*', 'categoria.nombre as nombre_categoria')
                ->orderBy('habilidades.anios_experiencia', 'desc')
                ->get() : collect();

            $catColors = [
                0 => ['border' => 'border-l-[#1e3a5f]', 'icon_bg' => 'bg-[#1e3a5f]',   'badge_bg' => 'bg-[#1e3a5f]/10',  'badge_text' => 'text-[#1e3a5f]'],
                1 => ['border' => 'border-l-[#e11d48]', 'icon_bg' => 'bg-[#e11d48]',   'badge_bg' => 'bg-red-50',        'badge_text' => 'text-[#e11d48]'],
                2 => ['border' => 'border-l-indigo-500','icon_bg' => 'bg-indigo-500',   'badge_bg' => 'bg-indigo-50',     'badge_text' => 'text-indigo-600'],
                3 => ['border' => 'border-l-emerald-500','icon_bg'=> 'bg-emerald-500',  'badge_bg' => 'bg-emerald-50',    'badge_text' => 'text-emerald-600'],
                4 => ['border' => 'border-l-amber-500', 'icon_bg' => 'bg-amber-500',    'badge_bg' => 'bg-amber-50',      'badge_text' => 'text-amber-600'],
            ];

            $catIndex = [];
            $colorIdx = 0;
        @endphp

        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-bold text-[#1e3a5f]">Habilidades técnicas</h3>
                    <div class="h-0.5 w-10 bg-[#e11d48] rounded-full mt-1"></div>
                </div>
                <span class="text-xs text-gray-400">{{ $habilidadesResumen->count() }} registradas</span>
            </div>

            @if($habilidadesResumen->isEmpty())
                <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
                    <div class="w-14 h-14 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-code text-2xl text-[#1e3a5f]/40"></i>
                    </div>
                    <p class="text-gray-500 font-medium text-sm">No hay habilidades registradas</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($habilidadesResumen as $hab)
                        @php
                            $cat = $hab->nombre_categoria ?? 'Otra';
                            if (!isset($catIndex[$cat])) {
                                $catIndex[$cat] = $colorIdx % count($catColors);
                                $colorIdx++;
                            }
                            $c = $catColors[$catIndex[$cat]];
                        @endphp
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-md border-l-4 {{ $c['border'] }} p-5 flex flex-col gap-2 hover:-translate-y-1 hover:shadow-xl transition-all duration-200">

                            {{-- Encabezado: ícono + nombre --}}
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-xl {{ $c['icon_bg'] }} flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-code text-white text-sm"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="font-semibold text-[#1e3a5f] text-sm leading-snug truncate">{{ $hab->nombre }}</p>
                                    <span class="inline-flex items-center gap-1 text-xs font-medium px-2 py-0.5 rounded-full {{ $c['badge_bg'] }} {{ $c['badge_text'] }} mt-0.5">
                                        <i class="fas fa-tag text-[10px]"></i>
                                        {{ $cat }}
                                    </span>
                                </div>
                            </div>

                            {{-- Descripción --}}
                            @if(!empty($hab->descripcion))
                                <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $hab->descripcion }}</p>
                            @endif

                            {{-- Años de experiencia --}}
                            <div class="mt-auto pt-2 border-t border-gray-100 flex items-center gap-1.5 text-xs text-gray-500">
                                <i class="fas fa-clock text-gray-400 text-[11px]"></i>
                                <span>{{ $hab->anios_experiencia }} {{ $hab->anios_experiencia == 1 ? 'año' : 'años' }} de experiencia</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
</div>