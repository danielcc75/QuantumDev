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

            <!-- Datos del Perfil en formato lista -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-5 flex items-center">
                    <i class="fas fa-id-card text-blue-500 mr-2"></i>
                    Mi Perfil
                </h2>

                <!-- Datos Personales -->
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-blue-600 uppercase tracking-wide mb-3 flex items-center gap-2">
                        <i class="fas fa-user text-blue-400"></i> Datos Personales
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-base text-gray-700">
                            <span class="w-5 text-gray-400 flex-shrink-0"><i class="fas fa-user"></i></span>
                            <span class="font-medium text-gray-500 w-36 flex-shrink-0">Nombre:</span>
                            <span>{{ $usuario->nombre ?? '—' }} {{ $usuario->apellido ?? '' }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-base text-gray-700">
                            <span class="w-5 text-gray-400 flex-shrink-0"><i class="fas fa-envelope"></i></span>
                            <span class="font-medium text-gray-500 w-36 flex-shrink-0">Correo:</span>
                            <span>{{ $usuario->correo_electronico ?? '—' }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-base text-gray-700">
                            <span class="w-5 text-gray-400 flex-shrink-0"><i class="fas fa-phone"></i></span>
                            <span class="font-medium text-gray-500 w-36 flex-shrink-0">Teléfono:</span>
                            <span>{{ $usuario->telefono ?? '—' }}</span>
                        </li>
                    </ul>
                </div>

                <hr class="border-gray-100 mb-5">

                <!-- Información Profesional -->
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-blue-600 uppercase tracking-wide mb-3 flex items-center gap-2">
                        <i class="fas fa-briefcase text-blue-400"></i> Información Profesional
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-base text-gray-700">
                            <span class="w-5 text-gray-400 flex-shrink-0"><i class="fas fa-briefcase"></i></span>
                            <span class="font-medium text-gray-500 w-36 flex-shrink-0">Título:</span>
                            <span>{{ $usuario->perfil->titulo_profesional ?? '—' }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-base text-gray-700">
                            <span class="w-5 text-gray-400 flex-shrink-0"><i class="fas fa-map-marker-alt"></i></span>
                            <span class="font-medium text-gray-500 w-36 flex-shrink-0">Ubicación:</span>
                            <span>{{ $usuario->perfil->ubicacion ?? '—' }}</span>
                        </li>
                    </ul>
                </div>

                <hr class="border-gray-100 mb-5">

                <!-- Redes Sociales -->
                <div>
                    <h3 class="text-base font-semibold text-blue-600 uppercase tracking-wide mb-3 flex items-center gap-2">
                        <i class="fas fa-share-alt text-blue-400"></i> Redes Sociales
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-base text-gray-700">
                            <span class="w-5 text-gray-800 flex-shrink-0"><i class="fab fa-github"></i></span>
                            <span class="font-medium text-gray-500 w-36 flex-shrink-0">GitHub:</span>
                            @if($links['github'] ?? false)
                                <a href="{{ $links['github'] }}" target="_blank" class="text-blue-500 hover:underline truncate">{{ $links['github'] }}</a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </li>
                        <li class="flex items-center gap-3 text-base text-gray-700">
                            <span class="w-5 text-blue-700 flex-shrink-0"><i class="fab fa-linkedin"></i></span>
                            <span class="font-medium text-gray-500 w-36 flex-shrink-0">LinkedIn:</span>
                            @if($links['linkedin'] ?? false)
                                <a href="{{ $links['linkedin'] }}" target="_blank" class="text-blue-500 hover:underline truncate">{{ $links['linkedin'] }}</a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </li>
                        <li class="flex items-center gap-3 text-base text-gray-700">
                            <span class="w-5 text-blue-400 flex-shrink-0"><i class="fab fa-twitter"></i></span>
                            <span class="font-medium text-gray-500 w-36 flex-shrink-0">Twitter / X:</span>
                            @if($links['twitter'] ?? false)
                                <a href="{{ $links['twitter'] }}" target="_blank" class="text-blue-500 hover:underline truncate">{{ $links['twitter'] }}</a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </li>
                        <li class="flex items-center gap-3 text-base text-gray-700">
                            <span class="w-5 text-green-600 flex-shrink-0"><i class="fas fa-globe"></i></span>
                            <span class="font-medium text-gray-500 w-36 flex-shrink-0">Portafolio:</span>
                            @if($links['portfolio'] ?? false)
                                <a href="{{ $links['portfolio'] }}" target="_blank" class="text-blue-500 hover:underline truncate">{{ $links['portfolio'] }}</a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </main>
</div>

{{-- Modals --}}
@include('gestionarPerfil.modal-editar')
@include('gestionarPerfil.scripts')