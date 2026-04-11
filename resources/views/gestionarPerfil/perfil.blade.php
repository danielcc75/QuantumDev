{{-- resources/views/gestionarPerfil/perfil.blade.php --}}

<!-- Contenido central - Perfil tipo CV -->
<div class="ml-80 mr-80">
    <main class="p-8">
        @php
            $nombreCompleto = trim(($usuario->nombre ?? '') . ' ' . ($usuario->apellido ?? ''));
            if (empty($nombreCompleto)) {
                $nombreCompleto = 'Usuario';
            }

            $fotoUrl = $usuario->perfil->foto_perfil ?? null;
            
            $links = [];
            if ($usuario->perfil && $usuario->perfil->links) {
                foreach ($usuario->perfil->links as $link) {
                    $links[$link->tipo] = $link->url;
                }
            }
            
            $experiencias = $usuario->perfil->experienciasLaborales ?? collect();
            $educaciones = $usuario->perfil->formacionAcademica ?? collect();
        @endphp

        <div class="max-w-4xl mx-auto">
           
            <!-- Cabecera del perfil -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <!-- Foto -->
                    <div class="flex-shrink-0">
                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" alt="Foto de perfil" class="w-32 h-32 rounded-full object-cover border-4 border-blue-100">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center border-4 border-blue-100">
                                <span class="text-white text-4xl font-bold">{{ substr($usuario->nombre ?? 'U', 0, 1) }}{{ substr($usuario->apellido ?? 'S', 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Información principal -->
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-3xl font-bold text-gray-800">{{ $nombreCompleto }}</h1>
                        <p class="text-gray-500 mt-1">
                            {{ $usuario->perfil->titulo_profesional ?? 'Desarrollador' }}
                        </p>
                        
                        <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-3 text-sm text-gray-600">
                            <span class="flex items-center">
                                <i class="fas fa-map-marker-alt w-4 h-4 mr-1 text-gray-400"></i>
                                {{ $usuario->perfil->ubicacion ?? 'Ubicación no especificada' }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-envelope w-4 h-4 mr-1 text-gray-400"></i>
                                {{ $usuario->correo_electronico ?? '___' }}
                            </span>
                        </div>
                        
                        <!-- Links / Redes sociales -->
                        <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
                            @if($links['github'] ?? false)
                                <a href="{{ $links['github'] }}" target="_blank" class="text-gray-600 hover:text-gray-900 transition-colors">
                                    <i class="fab fa-github text-xl"></i>
                                </a>
                            @else
                                <span class="text-gray-300"><i class="fab fa-github text-xl"></i></span>
                            @endif
                            
                            @if($links['linkedin'] ?? false)
                                <a href="{{ $links['linkedin'] }}" target="_blank" class="text-gray-600 hover:text-blue-700 transition-colors">
                                    <i class="fab fa-linkedin text-xl"></i>
                                </a>
                            @else
                                <span class="text-gray-300"><i class="fab fa-linkedin text-xl"></i></span>
                            @endif
                            
                            @if($links['twitter'] ?? false)
                                <a href="{{ $links['twitter'] }}" target="_blank" class="text-gray-600 hover:text-blue-400 transition-colors">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            @else
                                <span class="text-gray-300"><i class="fab fa-twitter text-xl"></i></span>
                            @endif
                            
                            @if($links['portfolio'] ?? false)
                                <a href="{{ $links['portfolio'] }}" target="_blank" class="text-gray-600 hover:text-green-600 transition-colors">
                                    <i class="fas fa-globe text-xl"></i>
                                </a>
                            @else
                                <span class="text-gray-300"><i class="fas fa-globe text-xl"></i></span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Botón Editar Perfil -->
                <div class="flex justify-end mt-6 pt-4 border-t border-gray-100">
                    <button onclick="abrirModalPerfil()" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg shadow hover:shadow-lg transition-all flex items-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Editar Perfil</span>
                    </button>
                </div>
            </div>

            <!-- Sobre mí / Biografía -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                    Sobre mí
                </h2>
                <p class="text-gray-600 leading-relaxed" id="perfil_biografia_texto">
                    {{ $usuario->perfil->biografia ?? 'Sin biografía. Haz clic en "Editar Perfil" para agregar una descripción.' }}
                </p>
            </div>

            <!-- Experiencia Laboral -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-blue-500 mr-2"></i>
                    Experiencia Laboral
                </h2>
                
                <div id="experiencias-container">
                    @if($experiencias->count() > 0)
                        @foreach($experiencias as $exp)
                        <div class="mb-6 last:mb-0 border-b border-gray-100 pb-4 last:border-0">
                            <div class="flex justify-between items-start flex-wrap gap-2">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $exp->cargo }}</h3>
                                    <p class="text-blue-600 font-medium">{{ $exp->empresa }}</p>
                                </div>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($exp->fecha_ini)->format('M Y') }} - 
                                    @if($exp->trabajo_actual)
                                        <span class="text-green-600 font-medium">Actualidad</span>
                                    @else
                                        {{ \Carbon\Carbon::parse($exp->fecha_fin)->format('M Y') }}
                                    @endif
                                </p>
                            </div>
                            <p class="text-gray-600 text-sm mt-2">{{ $exp->descripcion ?? 'Sin descripción' }}</p>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 text-gray-400">
                            <i class="fas fa-plus-circle text-3xl mb-2"></i>
                            <p>No hay experiencia laboral registrada</p>
                            <p class="text-sm">Usa el botón "Editar Perfil" para agregar</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Formación Académica -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-graduation-cap text-blue-500 mr-2"></i>
                    Formación Académica
                </h2>
                
                <div id="educaciones-container">
                    @if($educaciones->count() > 0)
                        @foreach($educaciones as $edu)
                        <div class="mb-6 last:mb-0 border-b border-gray-100 pb-4 last:border-0">
                            <div class="flex justify-between items-start flex-wrap gap-2">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $edu->titulo }}</h3>
                                    <p class="text-blue-600 font-medium">{{ $edu->institucion }}</p>
                                    <span class="inline-block px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded mt-1">
                                        {{ $edu->nivel }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($edu->fecha_ini)->format('M Y') }} - 
                                    @if($edu->fecha_fin)
                                        {{ \Carbon\Carbon::parse($edu->fecha_fin)->format('M Y') }}
                                    @else
                                        <span class="text-green-600 font-medium">En curso</span>
                                    @endif
                                </p>
                            </div>
                            <p class="text-gray-600 text-sm mt-2">{{ $edu->descripcion ?? 'Sin descripción' }}</p>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 text-gray-400">
                            <i class="fas fa-plus-circle text-3xl mb-2"></i>
                            <p>No hay formación académica registrada</p>
                            <p class="text-sm">Usa el botón "Editar Perfil" para agregar</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>

{{-- Modal y scripts --}}
@include('gestionarPerfil.modal-editar')
@include('gestionarPerfil.scripts')