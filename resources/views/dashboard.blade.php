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

        .nav-link {
            transition: all 0.3s ease;
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
            min-height: 100vh;
        }

        .seccion-contenido {
            display: none;
        }

        .seccion-contenido.active {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-50">

    @php
        $nombreUsuario = trim(($usuario->nombre ?? '') . ' ' . ($usuario->apellido ?? ''));
        $iniciales     = strtoupper(substr($usuario->nombre ?? 'U', 0, 2));

        // ── Cálculo de progreso del perfil ────────────────────────────────────
        $perfilDash   = DB::table('perfil')->where('id_usuario', $usuario->id_usuario)->first();
        $perfilIdDash = $perfilDash->id_perfil ?? null;

        $progreso = 0;
        if ($perfilDash)                                                              $progreso += 20; // perfil creado
        if (!empty($perfilDash?->foto_perfil))                                        $progreso += 20; // foto
        if (!empty($perfilDash?->biografia))                                          $progreso += 20; // bio
        if (!empty($perfilDash?->ubicacion))                                          $progreso += 15; // ubicación
        if ($perfilIdDash && DB::table('proyectos')->where('id_perfil', $perfilIdDash)->exists())   $progreso += 15; // proyectos
        if ($perfilIdDash && DB::table('habilidades')->where('id_perfil', $perfilIdDash)->exists()) $progreso += 10; // habilidades

        $progresoColor = $progreso < 40 ? '#e11d48' : ($progreso < 75 ? '#f59e0b' : '#1e3a5f');
        $progresoLabel = $progreso < 40 ? 'Perfil incompleto' : ($progreso < 75 ? 'Perfil en progreso' : 'Perfil casi completo');
    @endphp

    <!-- barra superior -->
    <header class="bg-white shadow-md sticky top-0 z-20">
        <div class="flex justify-between items-center px-8 py-4 gap-6">

            <!-- logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 transition-all-soft hover-scale flex-shrink-0">
                <img src="/logo.png" class="h-10 md:h-11" alt="Logo">
                <div class="flex flex-col leading-none">
                    <span class="font-bold text-[#1e3a5f] text-lg">Portafolio</span>
                    <span class="text-[#e11d48] font-semibold text-base -mt-2">Digital</span>
                </div>
            </a>

            <!-- buscador central -->
            <div class="flex-1 max-w-md relative">
                <div class="flex items-center bg-gray-100 rounded-xl px-4 py-2 gap-2 focus-within:ring-2 focus-within:ring-[#1e3a5f]/30 focus-within:bg-white transition-all border border-transparent focus-within:border-[#1e3a5f]/20">
                    <i class="fas fa-search text-gray-400 text-sm flex-shrink-0"></i>
                    <input
                        id="buscador-global"
                        type="text"
                        placeholder="Buscar proyectos..."
                        class="bg-transparent text-sm text-gray-700 placeholder-gray-400 outline-none w-full"
                    >
                    <button id="buscador-clear" onclick="limpiarBusqueda()" class="hidden text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
                <!-- resultados -->
                <div id="buscador-resultados"
                    class="hidden absolute top-full left-0 right-0 mt-1 bg-white rounded-xl shadow-lg border border-gray-100 z-40 overflow-hidden max-h-72 overflow-y-auto">
                </div>
            </div>

            <!-- derecha -->
            <div class="flex items-center space-x-6 flex-shrink-0">

                <!-- campana -->
                <div class="relative dropdown">
                    <button class="text-gray-500 hover:text-[#1e3a5f] focus:outline-none transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-[#e11d48] rounded-full"></span>
                    </button>
                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-100 z-30">
                        <div class="p-3 border-b border-gray-100">
                            <p class="font-semibold text-[#1e3a5f]">Notificaciones</p>
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

                <!-- usuario -->
                <div class="relative dropdown">
                    <button class="flex items-center space-x-2 focus:outline-none">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#1e3a5f] to-indigo-600 rounded-full flex items-center justify-center shadow-md">
                            <span class="text-white text-sm font-bold">{{ $iniciales }}</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 hidden md:inline">{{ $nombreUsuario }}</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500 hidden md:inline"></i>
                    </button>

                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg border border-gray-100 z-30">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user mr-2"></i> Mi perfil
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
            </div>
        </div>

        <!-- barra de progreso del perfil -->
        <div class="px-8 pb-3">
            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-500 flex-shrink-0">{{ $progresoLabel }}</span>
                <div class="flex-1 bg-gray-100 rounded-full h-1.5 overflow-hidden">
                    <div id="barra-progreso"
                        class="h-1.5 rounded-full transition-all duration-1000"
                        style="width: 0%; background-color: {{ $progresoColor }};"
                        data-target="{{ $progreso }}">
                    </div>
                </div>
                <span class="text-xs font-semibold flex-shrink-0" style="color: {{ $progresoColor }};">{{ $progreso }}%</span>
            </div>
        </div>
    </header>

    <!-- contenedor principal -->
    <div class="main-container">

        <!-- sidebar izquierdo -->
        <aside class="w-72 bg-white shadow-lg border-r border-gray-200 sticky top-16 self-start h-[calc(100vh-4rem)] overflow-y-auto float-left">
            <nav class="mt-6 pb-6">
                <div class="px-4 mb-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Submenu</p>
                </div>

                <a href="#" data-seccion="resumen" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-chart-pie w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Resumen general</span>
                </a>

                <a href="#" data-seccion="perfil" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-user-circle w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mi perfil</span>
                </a>

                <a href="#" data-seccion="proyectos" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-folder-open w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mis Proyectos</span>
                </a>

                <a href="#" data-seccion="habilidades" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-code w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mis Habilidades</span>
                </a>
            </nav>
        </aside>

        <!-- sidebar derecho -->
        <aside class="w-80 bg-white shadow-lg border-l border-gray-200 float-right">
            <div class="p-6 space-y-6">

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

        <!-- contenido central -->
        <div id="contenido-central">

            <div id="seccion-resumen" class="seccion-contenido active">
                @include('gestionarPerfil.resumen', [
                    'userId' => $usuario->id_usuario,
                    'nombreUsuario' => $nombreUsuario
                ])
            </div>

            <div id="seccion-perfil" class="seccion-contenido">
                @include('gestionarPerfil.perfil', [
                    'userId' => $usuario->id_usuario,
                    'nombreUsuario' => $nombreUsuario
                ])
            </div>

            <div id="seccion-proyectos" class="seccion-contenido">
                @include('gestionarPerfil.proyectos', [
                    'userId' => $usuario->id_usuario,
                    'nombreUsuario' => $nombreUsuario
                ])
            </div>

            <div id="seccion-habilidades" class="seccion-contenido">
                <div class="ml-80 mr-80">
                    <main class="p-8">

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                            <!-- HEADER DINÁMICO -->
                            @if($habilidades->count() > 0)

                                <!-- TOOLBAR ARRIBA (cuando hay tarjetas) -->
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-semibold text-gray-700">
                                        Mis Habilidades ({{ $habilidades->count() }})
                                    </h3>

                                    <button id="agregar-habilidad-btn"
                                        class="bg-[#1e3a5f] text-white px-5 py-2 rounded-full hover:bg-[#1e3a5f]/80 transition-all">
                                        + Agregar habilidad
                                    </button>
                                </div>

                                <!-- GRID DE TARJETAS -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                                    @foreach($habilidades as $habilidad)
                                        <div class="bg-gray-50 border rounded-xl p-4 shadow-sm hover:shadow-md transition">

                                            <!-- ICONO CATEGORIA -->
                                            <div class="flex justify-center mb-3">
                                                <img src="{{ $habilidad->categoria->imagen ?? 'https://via.placeholder.com/100' }}"
                                                    class="h-14 w-14 rounded-full object-cover">
                                            </div>

                                            <h3 class="text-center font-bold text-[#1e3a5f]">
                                                {{ $habilidad->nombre }}
                                            </h3>

                                            <p class="text-center text-sm text-gray-500">
                                                {{ $habilidad->categoria->nombre }}
                                            </p>

                                            <p class="text-center text-xs mt-2 text-gray-600">
                                                {{ $habilidad->anios_experiencia }} años de experiencia
                                            </p>

                                            <p class="text-center text-sm mt-2 text-gray-500">
                                                {{ $habilidad->descripcion }}
                                            </p>

                                            <!-- BOTONES -->
                                            <div class="flex justify-between mt-4">

                                                <!-- EDITAR -->
                                                <a href="#"
                                                    class="editar-habilidad bg-yellow-500 text-white px-3 py-1 rounded"
                                                    data-id="{{ $habilidad->id_habilidad }}"
                                                    data-nombre="{{ $habilidad->nombre }}"
                                                    data-categoria="{{ $habilidad->id_categoria }}"
                                                    data-experiencia="{{ $habilidad->anios_experiencia }}"
                                                    data-descripcion="{{ $habilidad->descripcion }}">
                                                    Editar
                                                </a>

                                                <form action="{{ route('habilidades.destroy', $habilidad->id_habilidad) }}" method="POST" class="inline">
                                                     @csrf
                                                     @method('DELETE')

                                                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                                                           Eliminar
                                                    </button>
                                                </form>

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                            @else

                                <!-- ESTADO VACÍO -->
                                <div class="text-center py-12">
                                    <i class="fas fa-code text-6xl text-gray-300 mb-4"></i>
                                    <h3 class="text-xl font-semibold text-gray-700 mb-2">
                                        Mis Habilidades
                                    </h3>
                                    <p class="text-gray-500 mb-6">
                                        Comienza agregando tu primera habilidad
                                    </p>

                                    <!-- BOTÓN CENTRADO -->
                                    <button id="agregar-habilidad-btn"
                                        class="bg-[#1e3a5f] text-white px-6 py-3 rounded-full hover:bg-[#1e3a5f]/80 transition-all">
                                        + Agregar habilidad
                                    </button>
                                </div>

                            @endif

                            <!-- MODAL (NO CAMBIA) -->
                            <div id="modal-habilidades"
                                class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

                                <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl relative">

                                    <div class="bg-[#1e3a5f] text-white p-5 rounded-t-xl flex justify-between items-center">
                                        <h2 id="titulo-modal-habilidad" class="text-lg font-semibold">
                                            Registrar Habilidad
                                        </h2>

                                        <button id="cerrar-modal" class="text-white text-xl">✖</button>
                                    </div>

                                    <div class="p-6 max-h-[80vh] overflow-y-auto">
                                        @include('gestionHabilidades.Habilidades', ['categorias' => $categorias])
                                    </div>

                                </div>
                            </div>

                        </div>
                    </main>
                </div>
            </div>
        </div>

        <div class="clear-both"></div>
    </div>

    <script>
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

        function cambiarSeccion(seccionId) {
            document.querySelectorAll('.seccion-contenido').forEach(seccion => {
                seccion.classList.remove('active');
            });

            const seccionActiva = document.getElementById('seccion-' + seccionId);
            if (seccionActiva) {
                seccionActiva.classList.add('active');
            }

            document.querySelectorAll('.seccion-link').forEach(link => {
                link.classList.remove('bg-[#1e3a5f]', 'border-r-4', 'border-[#e11d48]', 'shadow-sm');
                link.classList.add('text-gray-700');
                link.classList.remove('text-white', 'font-semibold');
                const icono = link.querySelector('i');
                if (icono) {
                    icono.classList.remove('text-white');
                    icono.classList.add('text-gray-500');
                }
                const span = link.querySelector('span');
                if (span) span.classList.remove('font-semibold');
            });

            const linkActivo = document.querySelector(`.seccion-link[data-seccion="${seccionId}"]`);
            if (linkActivo) {
                linkActivo.classList.add('bg-[#1e3a5f]', 'border-r-4', 'border-[#e11d48]', 'shadow-sm');
                linkActivo.classList.remove('text-gray-700');
                linkActivo.classList.add('text-white', 'font-semibold');
                const icono = linkActivo.querySelector('i');
                if (icono) {
                    icono.classList.remove('text-gray-500');
                    icono.classList.add('text-white');
                }
                const span = linkActivo.querySelector('span');
                if (span) span.classList.add('font-semibold');
            }
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

        document.querySelectorAll('a[href="#"]').forEach(link => {
            link.addEventListener('click', (e) => {
                if (!link.classList.contains('seccion-link')) {
                    e.preventDefault();
                }
            });
        });

        cambiarSeccion('resumen');

        // ── Animación barra de progreso ───────────────────────────────────────
        window.addEventListener('load', () => {
            const barra = document.getElementById('barra-progreso');
            if (barra) {
                setTimeout(() => {
                    barra.style.width = barra.dataset.target + '%';
                }, 300);
            }
        });

        // ── Buscador de proyectos ─────────────────────────────────────────────
        const inputBusqueda   = document.getElementById('buscador-global');
        const resultadosPanel = document.getElementById('buscador-resultados');
        const clearBtn        = document.getElementById('buscador-clear');

        function obtenerProyectos() {
            return Array.from(document.querySelectorAll('#proyectos-grid [data-proyecto-id]'));
        }

        function limpiarBusqueda() {
            inputBusqueda.value = '';
            resultadosPanel.classList.add('hidden');
            clearBtn.classList.add('hidden');
            obtenerProyectos().forEach(c => c.style.display = '');
        }

        inputBusqueda.addEventListener('input', function () {
            const q = this.value.trim().toLowerCase();

            clearBtn.classList.toggle('hidden', q === '');

            if (!q) {
                resultadosPanel.classList.add('hidden');
                obtenerProyectos().forEach(c => c.style.display = '');
                return;
            }

            const cards   = obtenerProyectos();
            const matches = cards.filter(c => {
                const nombre = c.querySelector('h3')?.textContent.toLowerCase() ?? '';
                const desc   = c.querySelector('p')?.textContent.toLowerCase() ?? '';
                return nombre.includes(q) || desc.includes(q);
            });

            // Mostrar resultados en el panel desplegable
            resultadosPanel.innerHTML = '';

            if (matches.length === 0) {
                resultadosPanel.innerHTML = `
                    <div class="px-4 py-6 text-center text-sm text-gray-400">
                        <i class="fas fa-search mb-2 block text-lg"></i>
                        Sin resultados para "<strong>${q}</strong>"
                    </div>`;
            } else {
                matches.forEach(card => {
                    const nombre = card.querySelector('h3')?.textContent.trim() ?? '';
                    const badge  = card.querySelector('span.rounded-full')?.textContent.trim() ?? '';
                    const item   = document.createElement('div');
                    item.className = 'flex items-center gap-3 px-4 py-3 hover:bg-[#1e3a5f]/5 cursor-pointer border-b border-gray-50 last:border-0 transition-colors';
                    item.innerHTML = `
                        <div class="w-7 h-7 rounded-lg bg-[#1e3a5f] flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-code-branch text-white text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-[#1e3a5f] truncate">${nombre}</p>
                        </div>
                        <span class="text-xs text-gray-400">${badge}</span>`;
                    item.addEventListener('click', () => {
                        cambiarSeccion('proyectos');
                        limpiarBusqueda();
                        setTimeout(() => {
                            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            card.classList.add('ring-2', 'ring-[#1e3a5f]', 'ring-offset-2');
                            setTimeout(() => card.classList.remove('ring-2', 'ring-[#1e3a5f]', 'ring-offset-2'), 1800);
                        }, 150);
                    });
                    resultadosPanel.appendChild(item);
                });
            }

            resultadosPanel.classList.remove('hidden');
        });

        // Cerrar panel al hacer clic fuera
        document.addEventListener('click', e => {
            if (!e.target.closest('#buscador-global') && !e.target.closest('#buscador-resultados')) {
                resultadosPanel.classList.add('hidden');
            }
        });

        inputBusqueda.addEventListener('focus', () => {
            if (inputBusqueda.value.trim()) resultadosPanel.classList.remove('hidden');
        });
        
        const modal = document.getElementById('modal-habilidades');
        const btnAgregar = document.getElementById('agregar-habilidad-btn');
        const btnCerrar = document.getElementById('cerrar-modal');

        // Abrir modal
        btnAgregar.addEventListener('click', () => {
            const modal = document.getElementById('modal-habilidades');
            const form = modal.querySelector('form');
            const tituloModal = document.getElementById('titulo-modal-habilidad');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            tituloModal.textContent = "Registrar Habilidad";

            form.reset();

            // 🔥 LIMPIEZA EXTRA (clave)
            form.querySelector('[name="nombreHabilidad"]').value = '';
            form.querySelector('[name="categoria"]').value = '';
            form.querySelector('[name="anosExperiencia"]').value = '';
            form.querySelector('[name="descripcion"]').value = '';

            // 🔥 ELIMINAR cualquier _method previo
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.remove();
            }

            // ✅ Acción correcta
            form.action = "{{ route('habilidades.store') }}";
        });

        // Cerrar modal
        btnCerrar.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        // Cerrar al hacer clic fuera
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });

        // Obtener todos los enlaces de "Editar"
        document.querySelectorAll('.editar-habilidad').forEach(enlace => {
            enlace.addEventListener('click', (event) => {
                event.preventDefault();
                
                // Obtener los datos de la habilidad
                const id = enlace.getAttribute('data-id');
                const nombre = enlace.getAttribute('data-nombre');
                const categoria = enlace.getAttribute('data-categoria');
                const experiencia = enlace.getAttribute('data-experiencia');
                const descripcion = enlace.getAttribute('data-descripcion');

                const modal = document.getElementById('modal-habilidades');
                const form = modal.querySelector('form');
                const tituloModal = document.getElementById('titulo-modal-habilidad'); // Asegúrate de que exista este elemento en el HTML (lo vamos a definir)

                // Mostrar el modal
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                // Cambiar el título del modal a "Editar Habilidad"
                tituloModal.textContent = "Editar Habilidad";

                // Rellenar el formulario con los datos de la habilidad
                form.querySelector('[name="nombreHabilidad"]').value = nombre;
                form.querySelector('[name="categoria"]').value = categoria;
                form.querySelector('[name="anosExperiencia"]').value = experiencia;
                form.querySelector('[name="descripcion"]').value = descripcion;

                // Configurar la acción del formulario para EDITAR (esto debe ser la ruta para editar una habilidad)
                form.action = `/habilidades/${id}`;  // Asegúrate de que esta URL esté correcta, es la ruta de editar habilidad

                // 🔥 Verificar si ya existe _method
                let methodInput = form.querySelector('input[name="_method"]');

                if (methodInput) {
                    methodInput.value = 'PUT';
                } else {
                    methodInput = document.createElement('input');
                    methodInput.setAttribute('type', 'hidden');
                    methodInput.setAttribute('name', '_method');
                    methodInput.setAttribute('value', 'PUT');
                    form.appendChild(methodInput);
                }
            });
        });
    </script>
</body>
</html>