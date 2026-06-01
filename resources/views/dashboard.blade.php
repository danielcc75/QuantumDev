<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portfolio Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('_dashboard-styles')
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
        if ($perfilIdDash && DB::table('proyectos')->where('id_perfil', $perfilIdDash)->whereNull('deleted_at')->exists())   $progreso += 15; // proyectos
        if ($perfilIdDash && DB::table('habilidades')->where('id_perfil', $perfilIdDash)->whereNull('deleted_at')->exists()) $progreso += 10; // habilidades

        $progresoColor = $progreso < 40 ? '#e11d48' : ($progreso < 75 ? '#f59e0b' : '#1e3a5f');
        $progresoLabel = $progreso < 40 ? 'Perfil incompleto' : ($progreso < 75 ? 'Perfil en progreso' : 'Perfil casi completo');

        $visibilidadDash = $perfilDash->visibilidad ?? 'privado';
    @endphp

    <script>
        // Visibilidad actual del perfil (publico/privado) — usada por los flujos de creación
        window.PERFIL_VISIBILIDAD = @json($visibilidadDash);

        // Cuando se crea un elemento, si el perfil es público actualizamos el banner de
        // "elementos sin publicar" (no muestra popups). El banner vive en la sección
        // de Configuración de cuenta → Visibilidad del perfil.
        window.notificarItemPublicable = function (tipo) {
            if (window.PERFIL_VISIBILIDAD !== 'publico') return;

            const aviso = document.getElementById('aviso-sin-publicar');
            const countEl = document.getElementById('aviso-sin-publicar-count');
            if (!aviso || !countEl) return;

            const actual = parseInt(countEl.textContent || '0', 10) || 0;
            countEl.textContent = actual + 1;
            aviso.classList.remove('hidden');
            aviso.classList.add('flex');
        };
    </script>

    <!-- barra superior -->
    @include('_dashboard-header')

    <!-- overlay para sidebars móviles -->
    <div id="sidebar-overlay"
        class="fixed inset-0 bg-black/50 z-30 hidden"></div>

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

                <a href="#" data-seccion="habilidades" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-code w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mis Habilidades</span>
                </a>

                <a href="#" data-seccion="experiencia" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-briefcase w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Experiencia Laboral</span>
                </a>

                <a href="#" data-seccion="formacion" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-graduation-cap w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Formación Académica</span>
                </a>

                <a href="#" data-seccion="proyectos" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-folder-open w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mis Proyectos</span>
                </a>

                <a href="#" data-seccion="publicar" class="seccion-link flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-globe w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Publicar Portafolio</span>
                </a>

            </nav>
        </aside>

        <!-- contenido central -->
        <div id="contenido-central" class="flex-1 min-w-0 order-2 lg:order-none">
            <section id="seccion-resumen" class="seccion-contenido">
                @include('gestionarPerfil.resumen', [
                    'userId' => $usuario->id_usuario,
                    'nombreUsuario' => $nombreUsuario
                ])
            </section>

            <section id="seccion-perfil" class="seccion-contenido">
                @include('gestionarPerfil.perfil', [
                    'userId' => $usuario->id_usuario,
                    'nombreUsuario' => $nombreUsuario
                ])
            </section>

            <section id="seccion-habilidades" class="seccion-contenido">
                @include('gestionHabilidades.index', ['categorias' => $categorias, 'habilidades' => $habilidades])
            </section>

            <section id="seccion-experiencia" class="seccion-contenido">
                @include('gestionarPerfil.experiencia', [
                    'userId'        => $usuario->id_usuario,
                    'nombreUsuario' => $nombreUsuario
                ])
            </section>

            <section id="seccion-formacion" class="seccion-contenido">
                @include('gestionarPerfil.formacion', [
                    'userId'        => $usuario->id_usuario,
                    'nombreUsuario' => $nombreUsuario
                ])
            </section>

            <section id="seccion-proyectos" class="seccion-contenido">
                @include('gestionarPerfil.proyectos', [
                    'userId' => $usuario->id_usuario,
                    'nombreUsuario' => $nombreUsuario
                ])
            </section>

            <section id="seccion-publicar" class="seccion-contenido">
                @include('gestionarPortafolio.publicar', [
                    'userId' => $usuario->id_usuario
                ])
            </section>

        </div>

        <!-- sidebar derecho -->
        @include('_dashboard-sidebar-derecho')

    </div>

    {{-- Bootstrap de traducciones para JS (debe ir antes de _dashboard-scripts) --}}
    @include('partials._translations-bootstrap')

    @include('_dashboard-scripts')

    {{-- Modal global de confirmación (window.confirmar / data-confirm) --}}
    @include('partials._modal-confirmar')
</body>
</html>