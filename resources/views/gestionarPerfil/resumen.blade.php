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
                <div class="text-3xl font-bold text-blue-600">{{ $stats['repos'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Proyectos</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center stat-card">
                <div class="text-3xl font-bold text-green-600">{{ number_format($stats['commits']) }}</div>
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
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <h3 class="font-semibold text-gray-800 mb-4">Proyectos recientes</h3>
            <div class="space-y-4">
                @php
                    $proyectosRecientes = $perfilId ? DB::table('proyectos')
                        ->where('id_perfil', $perfilId)
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
                        ->get() : collect();
                @endphp
                
                @forelse($proyectosRecientes as $proyecto)
                <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                    <div>
                        <p class="font-medium text-gray-800">{{ $proyecto->nombre }}</p>
                        <div class="flex space-x-3 text-xs text-gray-500 mt-1">
                            <span><i class="fas fa-circle mr-1"></i>{{ $proyecto->estado }}</span>
                        </div>
                    </div>
                    <div class="text-right text-sm">
                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($proyecto->fecha_ini)->format('Y') }}</p>
                        <p class="text-gray-400 text-xs">{{ $proyecto->descripcion ? substr($proyecto->descripcion, 0, 50) : 'Sin descripción' }}</p>
                    </div>
                </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-folder-open text-4xl mb-2"></i>
                        <p>No hay proyectos registrados</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Habilidades técnicas -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <h3 class="font-semibold text-gray-800 mb-4">Habilidades técnicas</h3>
            @php
                $habilidades = $perfilId ? DB::table('habilidades')
                    ->join('categoria', 'habilidades.id_categoria', '=', 'categoria.id_categoria')
                    ->where('habilidades.id_perfil', $perfilId)
                    ->select('habilidades.*', 'categoria.nombre as nombre_categoria')
                    ->get()
                    ->groupBy('nombre_categoria') : collect();
            @endphp
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse($habilidades as $categoria => $items)
                <div>
                    <p class="font-medium text-gray-700 mb-2 capitalize">{{ $categoria }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($items as $habilidad)
                        <span class="px-2 py-1 bg-{{ 
                            $categoria == 'frontend' ? 'blue' : 
                            ($categoria == 'backend' ? 'green' : 
                            ($categoria == 'devops' ? 'purple' : 'gray')) 
                        }}-100 text-{{ 
                            $categoria == 'frontend' ? 'blue' : 
                            ($categoria == 'backend' ? 'green' : 
                            ($categoria == 'devops' ? 'purple' : 'gray')) 
                        }}-700 rounded-lg text-xs">
                            {{ $habilidad->nombre }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @empty
                    <div class="col-span-3 text-center py-4 text-gray-500">
                        <i class="fas fa-code text-2xl mb-2"></i>
                        <p class="text-sm">No hay habilidades registradas</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>