{{-- resources/views/gestionarPerfil/perfil.blade.php --}}

<!-- Contenido central - Perfil tipo CV -->
<div class="w-full">
    <main class="p-4 sm:p-6 lg:p-8">
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
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6 md:p-8 mb-6">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-4 sm:gap-6">
                    <!-- Foto -->
                    <div id="perfil-foto-container" class="flex-shrink-0">
                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" alt="Foto de perfil" class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-blue-100">
                        @else
                            <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center border-4 border-blue-100">
                                <span class="text-white text-3xl sm:text-4xl font-bold">{{ substr($usuario->nombre ?? 'U', 0, 1) }}{{ substr($usuario->apellido ?? 'S', 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Información principal -->
                    <div class="flex-1 min-w-0 text-center md:text-left">
                        <h1 id="perfil-nombre-header" class="text-2xl sm:text-3xl font-bold text-gray-800 break-words">{{ $nombreCompleto }}</h1>
                        <p id="perfil-titulo-header" class="text-gray-500 mt-1">
                            {{ $usuario->perfil->titulo_profesional ?? 'Desarrollador' }}
                        </p>

                        <div class="flex flex-wrap justify-center md:justify-start gap-x-4 gap-y-1 mt-3 text-sm text-gray-600">
                            <span class="flex items-center min-w-0">
                                <i class="fas fa-map-marker-alt w-4 h-4 mr-1 text-gray-400 flex-shrink-0"></i>
                                <span id="perfil-ubicacion-header" class="truncate">{{ $usuario->perfil->ubicacion ?? 'Ubicación no especificada' }}</span>
                            </span>
                            <span class="flex items-center min-w-0">
                                <i class="fas fa-envelope w-4 h-4 mr-1 text-gray-400 flex-shrink-0"></i>
                                <span id="perfil-correo-header" class="truncate">{{ $usuario->correo_electronico ?? '___' }}</span>
                            </span>
                        </div>

                        <!-- Links / Redes sociales -->
                        <div id="perfil-social-container" class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
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
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6 mb-6">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                    Sobre mí
                </h2>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed break-words" id="perfil_biografia_texto">
                    {{ $usuario->perfil->biografia ?? 'Sin biografía. Haz clic en "Editar Perfil" para agregar una descripción.' }}
                </p>
            </div>

            <!-- Datos del Perfil en formato lista -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6 mb-6">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-5 flex items-center">
                    <i class="fas fa-id-card text-blue-500 mr-2"></i>
                    Mi Perfil
                </h2>

                <!-- Datos Personales -->
                <div class="mb-5">
                    <h3 class="text-sm sm:text-base font-semibold text-blue-600 uppercase tracking-wide mb-3 flex items-center gap-2">
                        <i class="fas fa-user text-blue-400"></i> Datos Personales
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-sm sm:text-base text-gray-700">
                            <span class="flex items-center gap-3 sm:contents">
                                <span class="w-5 text-gray-400 flex-shrink-0"><i class="fas fa-user"></i></span>
                                <span class="font-medium text-gray-500 sm:w-36 sm:flex-shrink-0">Nombre:</span>
                            </span>
                            <span id="perfil-datos-nombre" class="pl-8 sm:pl-0 break-words min-w-0">{{ $usuario->nombre ?? '—' }} {{ $usuario->apellido ?? '' }}</span>
                        </li>
                        <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-sm sm:text-base text-gray-700">
                            <span class="flex items-center gap-3 sm:contents">
                                <span class="w-5 text-gray-400 flex-shrink-0"><i class="fas fa-envelope"></i></span>
                                <span class="font-medium text-gray-500 sm:w-36 sm:flex-shrink-0">Correo:</span>
                            </span>
                            <span id="perfil-datos-correo" class="pl-8 sm:pl-0 break-all min-w-0">{{ $usuario->correo_electronico ?? '—' }}</span>
                        </li>
                        <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-sm sm:text-base text-gray-700">
                            <span class="flex items-center gap-3 sm:contents">
                                <span class="w-5 text-gray-400 flex-shrink-0"><i class="fas fa-phone"></i></span>
                                <span class="font-medium text-gray-500 sm:w-36 sm:flex-shrink-0">Teléfono:</span>
                            </span>
                            <span id="perfil-datos-telefono" class="pl-8 sm:pl-0 break-words min-w-0">{{ $usuario->telefono ?? '—' }}</span>
                        </li>
                    </ul>
                </div>

                <hr class="border-gray-100 mb-5">

                <!-- Información Profesional -->
                <div class="mb-5">
                    <h3 class="text-sm sm:text-base font-semibold text-blue-600 uppercase tracking-wide mb-3 flex items-center gap-2">
                        <i class="fas fa-briefcase text-blue-400"></i> Información Profesional
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-sm sm:text-base text-gray-700">
                            <span class="flex items-center gap-3 sm:contents">
                                <span class="w-5 text-gray-400 flex-shrink-0"><i class="fas fa-briefcase"></i></span>
                                <span class="font-medium text-gray-500 sm:w-36 sm:flex-shrink-0">Título:</span>
                            </span>
                            <span id="perfil-datos-titulo" class="pl-8 sm:pl-0 break-words min-w-0">{{ $usuario->perfil->titulo_profesional ?? '—' }}</span>
                        </li>
                        <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-sm sm:text-base text-gray-700">
                            <span class="flex items-center gap-3 sm:contents">
                                <span class="w-5 text-gray-400 flex-shrink-0"><i class="fas fa-map-marker-alt"></i></span>
                                <span class="font-medium text-gray-500 sm:w-36 sm:flex-shrink-0">Ubicación:</span>
                            </span>
                            <span id="perfil-datos-ubicacion" class="pl-8 sm:pl-0 break-words min-w-0">{{ $usuario->perfil->ubicacion ?? '—' }}</span>
                        </li>
                    </ul>
                </div>

                <hr class="border-gray-100 mb-5">

                <!-- Redes Sociales -->
                <div>
                    <h3 class="text-sm sm:text-base font-semibold text-blue-600 uppercase tracking-wide mb-3 flex items-center gap-2">
                        <i class="fas fa-share-alt text-blue-400"></i> Redes Sociales
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-sm sm:text-base text-gray-700">
                            <span class="flex items-center gap-3 sm:contents">
                                <span class="w-5 text-gray-800 flex-shrink-0"><i class="fab fa-github"></i></span>
                                <span class="font-medium text-gray-500 sm:w-36 sm:flex-shrink-0">GitHub:</span>
                            </span>
                            <span id="perfil-datos-github" class="pl-8 sm:pl-0 flex-1 min-w-0 break-all">
                                @if($links['github'] ?? false)
                                    <a href="{{ $links['github'] }}" target="_blank" class="text-blue-500 hover:underline">{{ $links['github'] }}</a>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </span>
                        </li>
                        <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-sm sm:text-base text-gray-700">
                            <span class="flex items-center gap-3 sm:contents">
                                <span class="w-5 text-blue-700 flex-shrink-0"><i class="fab fa-linkedin"></i></span>
                                <span class="font-medium text-gray-500 sm:w-36 sm:flex-shrink-0">LinkedIn:</span>
                            </span>
                            <span id="perfil-datos-linkedin" class="pl-8 sm:pl-0 flex-1 min-w-0 break-all">
                                @if($links['linkedin'] ?? false)
                                    <a href="{{ $links['linkedin'] }}" target="_blank" class="text-blue-500 hover:underline">{{ $links['linkedin'] }}</a>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </span>
                        </li>
                        <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-sm sm:text-base text-gray-700">
                            <span class="flex items-center gap-3 sm:contents">
                                <span class="w-5 text-blue-400 flex-shrink-0"><i class="fab fa-twitter"></i></span>
                                <span class="font-medium text-gray-500 sm:w-36 sm:flex-shrink-0">Twitter / X:</span>
                            </span>
                            <span id="perfil-datos-twitter" class="pl-8 sm:pl-0 flex-1 min-w-0 break-all">
                                @if($links['twitter'] ?? false)
                                    <a href="{{ $links['twitter'] }}" target="_blank" class="text-blue-500 hover:underline">{{ $links['twitter'] }}</a>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </span>
                        </li>
                        <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-sm sm:text-base text-gray-700">
                            <span class="flex items-center gap-3 sm:contents">
                                <span class="w-5 text-green-600 flex-shrink-0"><i class="fas fa-globe"></i></span>
                                <span class="font-medium text-gray-500 sm:w-36 sm:flex-shrink-0">Portafolio:</span>
                            </span>
                            <span id="perfil-datos-portfolio" class="pl-8 sm:pl-0 flex-1 min-w-0 break-all">
                                @if($links['portfolio'] ?? false)
                                    <a href="{{ $links['portfolio'] }}" target="_blank" class="text-blue-500 hover:underline">{{ $links['portfolio'] }}</a>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </span>
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