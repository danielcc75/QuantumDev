<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Portfolio Digital - @yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .transition-all-soft {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .sidebar-item:hover {
            transform: translateX(5px);
            background: rgba(0,0,0,0.05);
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        html, body {
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .main-container {
            min-height: calc(100vh - 4rem);
        }
    </style>
</head>
<body class="bg-gray-50">

    @php
        $usuarioId = session('usuario_id');
        $usuario = App\Models\Usuario::find($usuarioId);
        $nombreUsuario = trim(($usuario->nombre ?? '') . ' ' . ($usuario->apellido ?? ''));
        $iniciales = strtoupper(substr($usuario->nombre ?? 'U', 0, 1) . substr($usuario->apellido ?? '', 0, 1));
        $fotoPerfilHeader = $usuario->perfil->foto_perfil ?? null;
        $esAdmin = $usuario && $usuario->is_admin;
    @endphp

    <!-- barra superior -->
    <header class="bg-white shadow-md sticky top-0 z-20">
        <div class="flex justify-between items-center px-4 md:px-8 py-3 md:py-4 gap-3 md:gap-6">

            <!-- izquierda: hamburguesa + logo agrupados -->
            <div class="flex items-center gap-3 md:gap-4 flex-shrink-0 min-w-0">
                <button id="btn-menu-mobile"
                    class="lg:hidden text-gray-600 hover:text-[#1e3a5f] focus:outline-none flex-shrink-0">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- logo -->
                <a href="{{ $esAdmin ? url('/') : route('dashboard') }}" class="flex items-center gap-2 md:gap-3 transition-all-soft hover-scale flex-shrink-0">
                    <img src="/logo.png" class="h-8 md:h-11" alt="Logo">
                    <div class="hidden sm:flex flex-col leading-none">
                        <span class="font-bold text-[#1e3a5f] text-base md:text-lg">Portafolio</span>
                        <span class="text-[#e11d48] font-semibold text-sm md:text-base -mt-2">Digital</span>
                    </div>
                </a>
            </div>

            <!-- título del panel para admin -->
            @if($esAdmin)
            <div class="hidden md:block text-center">
                
            </div>
            @endif

            <!-- derecha -->
            <div class="flex items-center space-x-3 md:space-x-6 flex-shrink-0">

                <!-- usuario -->
                <div class="relative dropdown">
                    <button class="flex items-center space-x-2 focus:outline-none">
                        @if($fotoPerfilHeader)
                            <img src="{{ $fotoPerfilHeader }}" alt="Foto perfil" class="w-10 h-10 rounded-full object-cover shadow-md">
                        @else
                            <span class="w-10 h-10 bg-gradient-to-br from-[#1e3a5f] to-indigo-600 rounded-full flex items-center justify-center shadow-md">
                                <span class="text-white text-sm font-bold">{{ $iniciales }}</span>
                            </span>
                        @endif
                        <span class="text-sm font-medium text-gray-700 hidden md:inline">{{ $nombreUsuario }}</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500 hidden md:inline"></i>
                    </button>

                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg border border-gray-100 z-30">
                        @if($esAdmin)
                            <a href="{{ url('/') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-home mr-2"></i> Ir a la home page
                            </a>
                            <div class="border-t border-gray-100"></div>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[#e11d48] hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- overlay para sidebar móvil -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden"></div>

    <!-- contenedor principal -->
    <div class="main-container flex">

        <!-- sidebar izquierdo -->
        <aside id="sidebar-izquierdo"
            class="fixed lg:sticky top-0 lg:top-16 left-0 z-40 lg:z-0 w-72 bg-white shadow-lg border-r border-gray-200
                   h-screen lg:h-[calc(100vh-4rem)] overflow-y-auto flex-shrink-0
                   transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            
            <!-- botón cerrar drawer (móvil) -->
            <button type="button" onclick="cerrarSidebars()"
                class="lg:hidden absolute top-3 right-3 w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center transition">
                <i class="fas fa-times"></i>
            </button>

            <nav class="mt-6 pb-6">
                @if($esAdmin)
                    <!-- Menú para ADMINISTRADOR -->
                    <div class="px-4 mb-2">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.dashboard') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-chart-line w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Resumen general</span>
                    </a>

                    <div class="px-4 mt-4 mb-2">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider"></p>
                    </div>
                    <a href="{{ route('admin.usuarios') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.usuarios*') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-users w-5 h-5 mr-3 {{ request()->routeIs('admin.usuarios*') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Gestionar usuarios</span>
                    </a>
                     
                    <div class="px-4 mt-4 mb-2">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider"></p>
                    </div>
                    <a href="{{ route('admin.proyectos') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.proyectos*') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-folder-open w-5 h-5 mr-3 {{ request()->routeIs('admin.proyectos*') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Gestión de Proyectos</span>
                    </a>
                    <a href="{{ route('admin.habilidades') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.habilidades*') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-code w-5 h-5 mr-3 {{ request()->routeIs('admin.habilidades*') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Habilidades</span>
                    </a>
                    <a href="{{ route('admin.tecnologias') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.tecnologias*') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-microchip w-5 h-5 mr-3 {{ request()->routeIs('admin.tecnologias*') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Tecnologías</span>
                    </a>

                    <div class="px-4 mt-4 mb-2">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider"></p>
                    </div>
                    <a href="{{ route('admin.perfiles') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.perfiles*') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-id-card w-5 h-5 mr-3 {{ request()->routeIs('admin.perfiles*') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Moderar portafolios</span>
                    </a>
                    <a href="{{ route('admin.backup') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.backup*') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-database w-5 h-5 mr-3 {{ request()->routeIs('admin.backup*') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Respaldos</span>
                    </a>

                    <a href="{{ route('admin.logs') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.logs*') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-history w-5 h-5 mr-3 {{ request()->routeIs('admin.logs*') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Bitácora</span>
                    </a>
                    <a href="{{ route('admin.papelera') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.papelera*') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-trash-alt w-5 h-5 mr-3 {{ request()->routeIs('admin.papelera*') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Papelera</span>
                    </a>
                    <a href="{{ route('admin.notifications') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.notifications*') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-bell mr-3 {{ request()->routeIs('admin.notifications*') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Notificaciones</span>
                    </a>
                    <a href="{{ route('admin.configuracion') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item {{ request()->routeIs('admin.configuracion*') ? 'bg-[#1e3a5f] text-white' : '' }}">
                        <i class="fas fa-cog w-5 h-5 mr-3 {{ request()->routeIs('admin.configuracion*') ? 'text-white' : 'text-gray-500' }}"></i>
                        <span class="font-medium">Configuración</span>
                    </a>

                    <hr class="my-4 mx-4 border-gray-200">

                @else
                    <!-- Menú para USUARIO NORMAL -->
                    <div class="px-4 mb-2">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">SUBMENU</p>
                    </div>
                    <a href="#" data-seccion="resumen" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item">
                        <i class="fas fa-chart-pie w-5 h-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Resumen general</span>
                    </a>
                    <a href="#" data-seccion="perfil" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item">
                        <i class="fas fa-user-circle w-5 h-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Mi perfil</span>
                    </a>
                    <a href="#" data-seccion="habilidades" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item">
                        <i class="fas fa-code w-5 h-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Mis Habilidades</span>
                    </a>
                    <a href="#" data-seccion="experiencia" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item">
                        <i class="fas fa-briefcase w-5 h-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Experiencia Laboral</span>
                    </a>
                    <a href="#" data-seccion="formacion" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item">
                        <i class="fas fa-graduation-cap w-5 h-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Formación Académica</span>
                    </a>
                    <a href="#" data-seccion="proyectos" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all sidebar-item">
                        <i class="fas fa-folder-open w-5 h-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Mis Proyectos</span>
                    </a>
                @endif

                <!-- Cerrar sesión para ambos -->
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-6 py-3 text-gray-700 hover:bg-red-50 transition-all sidebar-item">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3 text-red-500"></i>
                        <span class="font-medium text-red-600">Cerrar sesión</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- contenido principal -->
        <main class="flex-1 min-w-0 p-4 md:p-8">
            @yield('content')
        </main>
    </div>

    {{-- Modal global de confirmación (window.confirmar / data-confirm) --}}
    @include('partials._modal-confirmar')

    <script>
        // Dropdowns
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            const button = dropdown.querySelector('button');
            const menu = dropdown.querySelector('.dropdown-menu');

            if (button && menu) {
                button.addEventListener('click', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll('.dropdown-menu').forEach(m => {
                        if (m !== menu) m.classList.add('hidden');
                    });
                    menu.classList.toggle('hidden');
                });
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });

        // Sidebar móvil
        const sidebarIzq = document.getElementById('sidebar-izquierdo');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const btnMenu = document.getElementById('btn-menu-mobile');

        function cerrarSidebars() {
            if (window.innerWidth < 1024) sidebarIzq.classList.add('-translate-x-full');
            if (sidebarOverlay) sidebarOverlay.classList.add('hidden');
        }

        if (btnMenu) {
            btnMenu.addEventListener('click', () => {
                sidebarIzq.classList.remove('-translate-x-full');
                if (sidebarOverlay) sidebarOverlay.classList.remove('hidden');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', cerrarSidebars);
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) sidebarIzq.classList.remove('-translate-x-full');
            if (window.innerWidth >= 1024 && sidebarOverlay) sidebarOverlay.classList.add('hidden');
        });

        // Funcionalidad para usuarios normales (secciones)
        @if(!$esAdmin)
        function resaltarLink(seccionId) {
            document.querySelectorAll('.seccion-link').forEach(link => {
                link.classList.remove('bg-[#1e3a5f]', 'text-white');
                link.classList.add('text-gray-700');
                const icono = link.querySelector('i');
                if (icono) {
                    icono.classList.remove('text-white');
                    icono.classList.add('text-gray-500');
                }
            });

            const linkActivo = document.querySelector(`.seccion-link[data-seccion="${seccionId}"]`);
            if (linkActivo) {
                linkActivo.classList.add('bg-[#1e3a5f]', 'text-white');
                const icono = linkActivo.querySelector('i');
                if (icono) {
                    icono.classList.remove('text-gray-500');
                    icono.classList.add('text-white');
                }
            }
        }

        function cambiarSeccion(seccionId) {
            const seccionActiva = document.getElementById('seccion-' + seccionId);
            if (seccionActiva) {
                seccionActiva.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            resaltarLink(seccionId);
            cerrarSidebars();
        }

        document.querySelectorAll('.seccion-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const seccion = link.getAttribute('data-seccion');
                if (seccion) {
                    cambiarSeccion(seccion);
                }
            });
        });

        // Scroll-spy
        const seccionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id.replace('seccion-', '');
                    resaltarLink(id);
                }
            });
        }, {
            rootMargin: '-30% 0px -60% 0px',
            threshold: 0,
        });

        document.querySelectorAll('.seccion-contenido').forEach(s => seccionObserver.observe(s));

        const seccionInicial = new URLSearchParams(window.location.search).get('seccion') ?? 'resumen';
        const elInicial = document.getElementById('seccion-' + seccionInicial);
        if (elInicial && seccionInicial !== 'resumen') {
            elInicial.scrollIntoView({ behavior: 'auto', block: 'start' });
        }
        resaltarLink(seccionInicial);
        if (window.location.search) {
            history.replaceState(null, '', window.location.pathname);
        }
        @endif
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
    function marcarLeida(id, url) {
        fetch('{{ route("notifications.marcar-leida") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id })
        }).then(() => {
            if (url) {
                window.location.href = url;
            } else {
                location.reload();
            }
        });
    }
</script>
<script>
    // Función para subir foto de perfil 
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
            if (fotoContainer) {
                fotoContainer.innerHTML = `<img src="${e.target.result}" alt="Foto de perfil" class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-blue-100">`;
            }
        };
        reader.readAsDataURL(file);
        
        // Mostrar barra de progreso
        const progressContainer = document.getElementById('progress-foto-container');
        const progressBar = document.getElementById('progress-foto-bar');
        if (progressContainer) {
            progressContainer.classList.remove('hidden');
        }
        if (progressBar) {
            progressBar.style.width = '0%';
        }
        
        // Simular progreso
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            if (progress <= 90 && progressBar) {
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
            if (progressBar) {
                progressBar.style.width = '100%';
            }
            
            if (data.success) {
                // Actualizar con la foto real del servidor
                const fotoContainer = document.getElementById('perfil-foto-container');
                if (fotoContainer) {
                    fotoContainer.innerHTML = `<img src="${data.foto_url}" alt="Foto de perfil" class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-blue-100">`;
                }
                setTimeout(() => {
                    if (progressContainer) {
                        progressContainer.classList.add('hidden');
                    }
                }, 1000);
                
                // También actualizar en el modal de edición si existe
                const modalFoto = document.querySelector('#modal-editar-perfil #foto-perfil-actual');
                if (modalFoto) {
                    modalFoto.innerHTML = `<img src="${data.foto_url}?t=${Date.now()}" alt="Foto de perfil" class="w-full h-full object-cover">`;
                }
                
                // Actualizar foto en el header
                const headerFoto = document.querySelector('header .dropdown button img');
                if (headerFoto) {
                    headerFoto.src = data.foto_url + '?t=' + Date.now();
                } else {
                    const headerSpan = document.querySelector('header .dropdown button span.w-10.h-10');
                    if (headerSpan && headerSpan.classList.contains('bg-gradient-to-br')) {
                        headerSpan.outerHTML = `<img src="${data.foto_url}?t=${Date.now()}" alt="Foto perfil" class="w-10 h-10 rounded-full object-cover shadow-md">`;
                    }
                }
                
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
            if (progressContainer) {
                progressContainer.classList.add('hidden');
            }
            
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
</body>
</html>