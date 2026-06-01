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
                    
                    <!-- Foto con botón de cambio (como Facebook) -->
                    <div class="flex-shrink-0 relative group">
                    <!-- Foto -->
                        <div id="perfil-foto-container">
                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" alt="Foto de perfil" class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-blue-100">
                        @else
                            <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center border-4 border-blue-100">
                                <span class="text-white text-3xl sm:text-4xl font-bold">{{ substr($usuario->nombre ?? 'U', 0, 1) }}{{ substr($usuario->apellido ?? 'S', 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                        <!-- Botón de cámara que aparece al hacer hover (como Facebook) -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <button type="button" onclick="document.getElementById('input-foto-perfil').click()" 
                                class="bg-black/60 hover:bg-black/80 text-white rounded-full p-2 sm:p-3 transition-colors backdrop-blur-sm">
                                <i class="fas fa-camera text-sm sm:text-base"></i>
                            </button>
                        </div>
                        
                        <!-- Input oculto para seleccionar archivo -->
                        <input type="file" id="input-foto-perfil" accept="image/*" class="hidden" onchange="subirFotoPerfil(this)">
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
                
                <!-- Barra de progreso para la foto -->
                <div id="progress-foto-container" class="hidden mt-4">
                    <div class="bg-gray-200 rounded-full h-1.5 w-full max-w-md mx-auto">
                        <div id="progress-foto-bar" class="bg-[#1e3a5f] h-1.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 text-center mt-1">Subiendo foto...</p>
                </div>
                
                <!-- Botón Editar Perfil -->
                <div class="flex justify-end mt-6 pt-4 border-t border-gray-100">
                    <button onclick="abrirModalPerfil()" class="px-4 py-2 bg-[#1e3a5f] text-white rounded-lg hover:bg-[#152c47] transition-colors">
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

            {{-- Botón para desplegar configuración --}}
            <div class="flex justify-center mb-4">
                <button id="btn-abrir-configuracion" onclick="toggleConfiguracionCuenta()"
                    class="inline-flex items-center gap-2 bg-[#e11d48] hover:bg-red-700 text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-all duration-200 shadow-sm hover:shadow">
                    <i class="fas fa-cog text-xs transition-transform duration-300" id="icono-config"></i>
                    <span id="texto-btn-config">Configurar cuenta</span>
                </button>
            </div>

            {{-- Sección de configuración (oculta por defecto) --}}
            <div id="seccion-configuracion" class="hidden">
                @include('gestionarCuenta.index', ['userId' => $userId])
            </div>

        </div>

        <script>
        function toggleConfiguracionCuenta() {
            const seccion = document.getElementById('seccion-configuracion');
            const icono   = document.getElementById('icono-config');
            const texto   = document.getElementById('texto-btn-config');
            const abierto = !seccion.classList.contains('hidden');

            if (abierto) {
                seccion.classList.add('hidden');
                icono.classList.remove('rotate-90');
                texto.textContent = 'Configurar cuenta';
            } else {
                seccion.classList.remove('hidden');
                icono.classList.add('rotate-90');
                texto.textContent = 'Ocultar configuración';
                seccion.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
        
        // Función para subir foto de perfil (como Facebook)
        function subirFotoPerfil(input) {
        if (!input.files || !input.files[0]) return;
        
        const file = input.files[0];
        
        // Validar tipo de archivo
        if (!file.type.startsWith('image/')) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, selecciona una imagen válida (JPG, PNG, GIF)',
                confirmButtonColor: '#1e3a5f'
            });
            input.value = '';
            return;
        }
        
        // Validar tamaño (máximo 2MB)
        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La imagen no debe superar los 2MB',
                confirmButtonColor: '#1e3a5f'
            });
            input.value = '';
            return;
        }
        
        // Mostrar preview temporal
        const reader = new FileReader();
        reader.onload = function(e) {
            const fotoContainer = document.getElementById('perfil-foto-container');
            fotoContainer.innerHTML = `<img src="${e.target.result}" alt="Foto de perfil" class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-blue-100">`;
        };
        reader.readAsDataURL(file);
        
        // Mostrar barra de progreso
        const progressContainer = document.getElementById('progress-foto-container');
        const progressBar = document.getElementById('progress-foto-bar');
        progressContainer.classList.remove('hidden');
        progressBar.style.width = '0%';
        
        // Simular progreso
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            if (progress <= 90) {
                progressBar.style.width = progress + '%';
            }
        }, 100);
        
        // Subir al servidor
        const formData = new FormData();
        formData.append('foto', file);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        fetch('/perfil/actualizar-foto', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            clearInterval(interval);
            progressBar.style.width = '100%';
            
            if (data.success) {
                // 1. Actualizar foto en el contenido principal (perfil)
                const fotoContainer = document.getElementById('perfil-foto-container');
                fotoContainer.innerHTML = `<img src="${data.foto_url}?t=${Date.now()}" alt="Foto de perfil" class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-blue-100">`;
                
                // 2. Actualizar avatar en el HEADER (nuevo)
                const headerAvatar = document.getElementById('header-avatar');
                if (headerAvatar) {
                    let img = headerAvatar.querySelector('img');
                    if (img) {
                        // Ya existe imagen, solo cambiar src
                        img.src = data.foto_url + '?t=' + Date.now();
                    } else {
                        // Era el span con iniciales, reemplazar por imagen
                        headerAvatar.innerHTML = `<img src="${data.foto_url}?t=${Date.now()}" alt="Foto perfil" class="w-10 h-10 rounded-full object-cover shadow-md">`;
                    }
                }
                
                // 3. Actualizar foto en el modal de edición si existe
                const modalFoto = document.querySelector('#modal-editar-perfil #foto-perfil-actual');
                if (modalFoto) {
                    modalFoto.innerHTML = `<img src="${data.foto_url}?t=${Date.now()}" alt="Foto de perfil" class="w-full h-full object-cover">`;
                }
                
                setTimeout(() => {
                    progressContainer.classList.add('hidden');
                }, 1000);
                
                Swal.fire({
                    icon: 'success',
                    title: '¡Foto actualizada!',
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                throw new Error(data.message || 'Error al subir la foto');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            clearInterval(interval);
            progressContainer.classList.add('hidden');
            
            // Recargar la foto original
            location.reload();
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo subir la imagen. Intenta nuevamente.',
                confirmButtonColor: '#d33'
            });
        });
    }
        </script>
    </main>
</div>

{{-- Modals --}}
@include('gestionarPerfil.modal-editar')
@include('gestionarPerfil.scripts')