<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portfolio Digital - Mis Notificaciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('_dashboard-styles')
</head>
<body class="bg-gray-50">

    @php
        $nombreUsuario = trim(($usuario->nombre ?? '') . ' ' . ($usuario->apellido ?? ''));
        $iniciales     = strtoupper(substr($usuario->nombre ?? 'U', 0, 2));

        // Cálculo de progreso del perfil
        $perfilDash   = DB::table('perfil')->where('id_usuario', $usuario->id_usuario)->first();
        $perfilIdDash = $perfilDash->id_perfil ?? null;

        $progreso = 0;
        if ($perfilDash) $progreso += 20;
        if (!empty($perfilDash?->foto_perfil)) $progreso += 20;
        if (!empty($perfilDash?->biografia)) $progreso += 20;
        if (!empty($perfilDash?->ubicacion)) $progreso += 15;
        if ($perfilIdDash && DB::table('proyectos')->where('id_perfil', $perfilIdDash)->whereNull('deleted_at')->exists()) $progreso += 15;
        if ($perfilIdDash && DB::table('habilidades')->where('id_perfil', $perfilIdDash)->whereNull('deleted_at')->exists()) $progreso += 10;

        $progresoColor = $progreso < 40 ? '#e11d48' : ($progreso < 75 ? '#f59e0b' : '#1e3a5f');
        $progresoLabel = $progreso < 40 ? 'Perfil incompleto' : ($progreso < 75 ? 'Perfil en progreso' : 'Perfil casi completo');

        $visibilidadDash = $perfilDash->visibilidad ?? 'privado';
    @endphp

    <!-- barra superior -->
    @include('_dashboard-header')

    <!-- overlay para sidebars móviles -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden"></div>

    <!-- contenedor principal -->
    <div class="main-container flex">

        <!-- sidebar izquierdo -->
        <aside id="sidebar-izquierdo"
            class="fixed lg:sticky top-0 lg:top-16 left-0 z-40 lg:z-0 w-72 bg-white shadow-lg border-r border-gray-200
                   h-screen lg:h-[calc(100vh-4rem)] overflow-y-auto flex-shrink-0
                   transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <button type="button" onclick="cerrarSidebars()"
                class="lg:hidden absolute top-3 right-3 w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center transition">
                <i class="fas fa-times"></i>
            </button>
            <nav class="mt-6 pb-6">
                <div class="px-4 mb-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Submenu</p>
                </div>

                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-chart-pie w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Resumen general</span>
                </a>

                <a href="{{ route('dashboard') }}?seccion=perfil" class="flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-user-circle w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mi perfil</span>
                </a>

                <a href="{{ route('dashboard') }}?seccion=habilidades" class="flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-code w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mis Habilidades</span>
                </a>

                <a href="{{ route('dashboard') }}?seccion=experiencia" class="flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-briefcase w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Experiencia Laboral</span>
                </a>

                <a href="{{ route('dashboard') }}?seccion=formacion" class="flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-graduation-cap w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Formación Académica</span>
                </a>

                <a href="{{ route('dashboard') }}?seccion=proyectos" class="flex items-center px-6 py-3 text-gray-700 transition-all">
                    <i class="fas fa-folder-open w-5 h-5 mr-3 text-gray-500"></i>
                    <span class="font-medium">Mis Proyectos</span>
                </a>
            </nav>
        </aside>

        <!-- contenido central -->
        <div class="flex-1 min-w-0 order-2 lg:order-none p-6">
            <div class="max-w-3xl mx-auto">
                
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">
                                <i class="fas fa-bell text-[#1e3a5f] mr-2"></i>
                                Mis Notificaciones
                            </h1>
                            <p class="text-gray-500 text-sm mt-1">
                                @if($noLeidas > 0)
                                    Tienes <strong class="text-red-500">{{ $noLeidas }}</strong> notificaciones no leídas
                                @else
                                    No tienes notificaciones pendientes
                                @endif
                            </p>
                        </div>
                        @if($noLeidas > 0)
                            <form action="{{ route('notifications.marcar-todas') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm bg-gray-100 px-3 py-1 rounded-lg hover:bg-gray-200">
                                    Marcar todas como leídas
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                
                @forelse($notificaciones as $notif)
                    <div class="bg-white rounded-xl shadow-md p-4 mb-3 border-l-4 
                        @if($notif->tipo == 'info') border-blue-500
                        @elseif($notif->tipo == 'success') border-green-500
                        @elseif($notif->tipo == 'warning') border-yellow-500
                        @else border-red-500 @endif
                        {{ !$notif->leido ? 'bg-blue-50' : '' }}">
                        
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    @if($notif->tipo == 'info')
                                        <i class="fas fa-info-circle text-blue-500"></i>
                                    @elseif($notif->tipo == 'success')
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    @elseif($notif->tipo == 'warning')
                                        <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                                    @else
                                        <i class="fas fa-times-circle text-red-500"></i>
                                    @endif
                                    <h3 class="font-bold text-gray-800">{{ $notif->titulo }}</h3>
                                    @if(!$notif->leido)
                                        <span class="text-xs bg-red-500 text-white px-2 py-0.5 rounded-full">Nueva</span>
                                    @endif
                                </div>
                                <p class="text-gray-600 text-sm mb-2">{{ $notif->mensaje }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-400">{{ $notif->created_at->diffForHumans() }}</span>
                                    @if(!$notif->leido)
                                        <form action="{{ route('notifications.marcar', $notif->id_notification) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-xs text-blue-500 hover:underline">
                                                Marcar como leída
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            @if($notif->url)
                                <a href="{{ $notif->url }}" class="ml-3 text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-md p-12 text-center">
                        <i class="fas fa-bell-slash text-gray-300 text-5xl mb-3"></i>
                        <p class="text-gray-500 text-lg">No tienes notificaciones</p>
                        <p class="text-gray-400 text-sm">Cuando recibas notificaciones aparecerán aquí</p>
                    </div>
                @endforelse
                
                <div class="mt-4">
                    {{ $notificaciones->links() }}
                </div>
            </div>
        </div>

        <!-- sidebar derecho -->
        @include('_dashboard-sidebar-derecho')

    </div>

    @include('_dashboard-scripts')

    {{-- Modal global de confirmación --}}
    @include('partials._modal-confirmar')
</body>
</html>