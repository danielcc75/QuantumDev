<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portfolio Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .transition-all {
            transition: all 0.3s ease;
        }
        .sidebar-item:hover {
            transform: translateX(5px);
            background: rgba(0,0,0,0.05);
        }
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }
        .right-sidebar-item:hover {
            background: #f3f4f6;
            transform: translateX(-3px);
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        
        /* Scroll unificado para toda la página */
        html, body {
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        /* Contenedor principal sin scroll propio */
        .main-container {
            min-height: 100vh;
        }
        
        /* Ocultar contenido por defecto */
        .seccion-contenido {
            display: none;
        }
        
        .seccion-contenido.active {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Barra de navegación superior fija -->
    <header class="bg-white shadow-md sticky top-0 z-20">
        <div class="flex justify-between items-center px-8 py-4">
            <!-- Logo y nombre -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                    <i class="fas fa-layer-group text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Portafolio</h1>
                    <p class="text-xs text-gray-500">Digital</p>
                </div>
            </div>

            <!-- Elementos del lado derecho: Notificaciones y Usuario -->
            <div class="flex items-center space-x-6">
                <!-- Campana de notificaciones -->
                <div class="relative dropdown">
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                    </button>
                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-100 z-30">
                        <div class="p-3 border-b border-gray-100">
                            <p class="font-semibold text-gray-800">Notificaciones</p>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <div class="p-3 hover:bg-gray-50 border-b border-gray-100">
                                <p class="text-sm text-gray-800">Actualizaste tu portafolio</p>
                                <p class="text-xs text-gray-500">Hace 2 horas</p>
                            </div>
                            <div class="p-3 hover:bg-gray-50 border-b border-gray-100">
                                <p class="text-sm text-gray-800">Nuevo artículo disponible</p>
                                <p class="text-xs text-gray-500">Hace 1 día</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Usuario -->
                @php
                    $userId = request('user_id', 3);
                    use Illuminate\Support\Facades\DB;
                    $usuario = DB::table('usuarios')->where('id', $userId)->first();
                    $nombreUsuario = $usuario->nombre ?? $usuario->name ?? 'Usuario';
                    $perfil = DB::table('perfiles')->where('user_id', $userId)->first();
                    $avatar = $perfil && $perfil->foto ? $perfil->foto : substr($nombreUsuario, 0, 2);
                @endphp
                
                <div class="relative dropdown">
                    <button class="flex items-center space-x-2 focus:outline-none">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center shadow-md">
                            <span class="text-white text-sm font-bold">{{ is_string($avatar) ? substr($avatar, 0, 2) : 'U' }}</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 hidden md:inline">{{ $nombreUsuario }}</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500 hidden md:inline"></i>
                    </button>
                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 z-30">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user mr-2"></i> Mi perfil
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-cog mr-2"></i> Configuración
                        </a>
                        <div class="border-t border-gray-100"></div>
                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenedor principal sin scroll propio -->
    <div class="main-container">
        <!-- Sidebar izquierdo - Fijo (sticky) -->
        <aside class="w-72 bg-white shadow-lg border-r border-gray-200 sticky top-16 self-start h-[calc(100vh-4rem)] overflow-y-auto float-left">
            <nav class="mt-6 pb-6">
                <div class="px-4 mb-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Submenu</p>
                </div>
                
                <!-- Resumen general -->
                <a href="#" data-seccion="resumen" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-chart-pie w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Resumen general</span>
                </a>
                
                <!-- Mi perfil -->
                <a href="#" data-seccion="perfil" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-user-circle w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mi perfil</span>
                </a>
                
                <!-- Mis Proyectos -->
                <a href="#" data-seccion="proyectos" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-folder-open w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mis Proyectos</span>
                </a>
                
                <!-- Mis Habilidades -->
                <a href="#" data-seccion="habilidades" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-code w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mis Habilidades</span>
                </a>
            </nav>
        </aside>

        <!-- Sidebar derecho - No fijo, fluye con el contenido -->
        <aside class="w-80 bg-white shadow-lg border-l border-gray-200 float-right">
            <div class="p-6 space-y-6">
                <!-- Calendario -->
                <div class="bg-gray-50 rounded-xl p-4 right-sidebar-item">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-800">Calendario</h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Ver agenda →</a>
                    </div>
                    <div class="text-center mb-4">
                        <p class="text-lg font-medium text-gray-700">Octubre 2026</p>
                    </div>
                    <div class="grid grid-cols-7 gap-1 text-center text-sm">
                        @php
                            $days = ['L', 'M', 'J', 'V', 'S', 'D'];
                        @endphp
                        @foreach($days as $day)
                            <div class="text-gray-500 font-medium py-1">{{ $day }}</div>
                        @endforeach
                        @for($i = 1; $i <= 31; $i++)
                            @if($i >= 5 && $i <= 26)
                                <div class="py-1 {{ $i == 15 ? 'bg-blue-600 text-white rounded-full w-7 h-7 flex items-center justify-center mx-auto' : 'text-gray-700' }}">
                                    {{ $i }}
                                </div>
                            @elseif($i < 5)
                                <div class="py-1 text-gray-300">{{ $i }}</div>
                            @endif
                        @endfor
                    </div>
                </div>

                <!-- Notificaciones y novedades -->
                <div class="bg-gray-50 rounded-xl p-4 right-sidebar-item">
                    <h3 class="font-semibold text-gray-800 mb-4">Notificaciones y novedades</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3 pb-3 border-b border-gray-200">
                            <i class="fas fa-folder-open text-blue-500 mt-1 text-sm"></i>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Actualizaste tu portafolio principal</p>
                                <p class="text-xs text-gray-500">Hace 2 horas - Agregaste 3 nuevos proyectos</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 pb-3 border-b border-gray-200">
                            <i class="fas fa-newspaper text-green-500 mt-1 text-sm"></i>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Nuevo artículo disponible</p>
                                <p class="text-xs text-gray-500">Diseño de dashboards - Lectura recomendada</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fab fa-github text-gray-700 mt-1 text-sm"></i>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Repositorio conectado</p>
                                <p class="text-xs text-gray-500">Sincronización activa con GitHub</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enlaces rápidos -->
                <div class="bg-gray-50 rounded-xl p-4 right-sidebar-item">
                    <h3 class="font-semibold text-gray-800 mb-3">Enlaces rápidos</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="#" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-external-link-alt mr-2 text-xs"></i>
                                Mi portafolio público
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-bookmark mr-2 text-xs"></i>
                                Artículos guardados
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-bullhorn mr-2 text-xs"></i>
                                Novedades del sistema
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Contenido central - Contenedor de secciones -->
        <div id="contenido-central">
            <!-- Resumen -->
            <div id="seccion-resumen" class="seccion-contenido active">
                @include('gestionarPerfil.resumen', [
                    'userId' => $userId, 
                    'nombreUsuario' => $nombreUsuario
                ])
            </div>

            <!-- Perfil -->
            <div id="seccion-perfil" class="seccion-contenido">
                @include('gestionarPerfil.perfil', [
                    'userId' => $userId, 
                    'nombreUsuario' => $nombreUsuario
                ])
            </div>

            <!-- Proyectos (temporalmente igual al perfil mientras lo creas) -->
            <div id="seccion-proyectos" class="seccion-contenido">
                <div class="ml-80 mr-80">
                    <main class="p-8">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <div class="text-center py-12">
                                <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Mis Proyectos</h3>
                                <p class="text-gray-500">Vista de proyectos - En construcción</p>
                            </div>
                        </div>
                    </main>
                </div>
            </div>

            <!-- Habilidades (temporalmente igual al perfil mientras las creas) -->
            <div id="seccion-habilidades" class="seccion-contenido">
                <div class="ml-80 mr-80">
                    <main class="p-8">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <div class="text-center py-12">
                                <i class="fas fa-code text-6xl text-gray-300 mb-4"></i>
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Mis Habilidades</h3>
                                <p class="text-gray-500">Vista de habilidades - En construcción</p>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <!-- Clearfix para limpiar los floats -->
        <div class="clear-both"></div>
    </div>

    <script>
        // Funcionalidad de dropdowns
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
        
        // Funcionalidad de cambio de sección
        function cambiarSeccion(seccionId) {
            // Ocultar todas las secciones
            document.querySelectorAll('.seccion-contenido').forEach(seccion => {
                seccion.classList.remove('active');
            });
            
            // Mostrar la sección seleccionada
            const seccionActiva = document.getElementById('seccion-' + seccionId);
            if (seccionActiva) {
                seccionActiva.classList.add('active');
            }
            
            // Actualizar estilos del sidebar
            document.querySelectorAll('.seccion-link').forEach(link => {
                link.classList.remove('bg-blue-50', 'border-r-4', 'border-blue-600');
                const icono = link.querySelector('i');
                if (icono) {
                    icono.classList.remove('text-blue-600');
                    icono.classList.add('text-gray-500');
                }
            });
            
            // Resaltar el link activo
            const linkActivo = document.querySelector(`.seccion-link[data-seccion="${seccionId}"]`);
            if (linkActivo) {
                linkActivo.classList.add('bg-blue-50', 'border-r-4', 'border-blue-600');
                const icono = linkActivo.querySelector('i');
                if (icono) {
                    icono.classList.remove('text-gray-500');
                    icono.classList.add('text-blue-600');
                }
            }
        }
        
        // Agregar event listeners a los links del sidebar
        document.querySelectorAll('.seccion-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const seccion = link.getAttribute('data-seccion');
                if (seccion) {
                    cambiarSeccion(seccion);
                }
            });
        });
        
        // Prevenir comportamiento por defecto de todos los links con #
        document.querySelectorAll('a[href="#"]').forEach(link => {
            link.addEventListener('click', (e) => {
                if (!link.classList.contains('seccion-link')) {
                    e.preventDefault();
                }
            });
        });
        
        // Inicializar: mostrar resumen por defecto
        cambiarSeccion('resumen');
    </script>
</body>
</html>