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

        </div>
    </main>
</div>

{{-- Modals --}}
@include('gestionarPerfil.modal-editar')
@include('gestionarPerfil.scripts')