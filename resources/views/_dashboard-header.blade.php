    <header class="bg-white shadow-md sticky top-0 z-20">
        <div class="flex justify-between items-center px-4 md:px-8 py-3 md:py-4 gap-3 md:gap-6">

            <!-- izquierda: hamburguesa + logo agrupados -->
            <div class="flex items-center gap-3 md:gap-4 flex-shrink-0 min-w-0">
                <button id="btn-menu-mobile"
                    class="lg:hidden text-gray-600 hover:text-[#1e3a5f] focus:outline-none flex-shrink-0">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-2 md:gap-3 transition-all-soft hover-scale flex-shrink-0">
                    <img src="/logo.png" class="h-8 md:h-11" alt="Logo">
                    <div class="hidden sm:flex flex-col leading-none">
                        <span class="font-bold text-[#1e3a5f] text-base md:text-lg">Portafolio</span>
                        <span class="text-[#e11d48] font-semibold text-sm md:text-base -mt-2">Digital</span>
                    </div>
                </a>
            </div>

            <!-- buscador central -->
            <div class="flex-1 max-w-md relative hidden md:block">
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
            <div class="flex items-center space-x-3 md:space-x-6 flex-shrink-0">

                <!-- icono buscador móvil -->
                <button id="btn-buscador-mobile" class="md:hidden text-gray-500 hover:text-[#1e3a5f]">
                    <i class="fas fa-search text-lg"></i>
                </button>

                <!-- toggle sidebar derecho (tablet) -->
                <button id="btn-sidebar-derecho" class="xl:hidden text-gray-500 hover:text-[#1e3a5f]">
                    <i class="fas fa-calendar-alt text-lg"></i>
                </button>


                <!-- campana -->
                @php
                    $novedadesHeader        = $novedades ?? collect();
                    $perfilHeader           = $usuario->perfil ?? null;
                    $portafolioOcultoHdr    = $perfilHeader && !$perfilHeader->visible;
                    $notaModeracionHdr      = $perfilHeader->moderation_note ?? null;
                    $proyectosOcultosModHdr = $proyectosOcultosMod ?? collect();
                    $habilidadesOcultasModHdr = $habilidadesOcultasMod ?? collect();
                    $avisoModeracionHdr     = $portafolioOcultoHdr || $notaModeracionHdr;
                    $hayAvisosHdr           = $avisoModeracionHdr || $proyectosOcultosModHdr->isNotEmpty() || $habilidadesOcultasModHdr->isNotEmpty();
                    $totalNotificaciones    = $novedadesHeader->count()
                                            + ($avisoModeracionHdr ? 1 : 0)
                                            + $proyectosOcultosModHdr->count()
                                            + $habilidadesOcultasModHdr->count();
                @endphp
                <div class="relative dropdown">
                    <button class="text-gray-500 hover:text-[#1e3a5f] focus:outline-none transition-colors relative">
                        <i class="fas fa-bell text-xl"></i>
                        @if($totalNotificaciones > 0)
                            <span id="badge-notificaciones"
                                  class="absolute -top-1 -right-1 min-w-[1.1rem] h-[1.1rem] px-1 bg-[#e11d48] text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                                {{ $totalNotificaciones > 9 ? '9+' : $totalNotificaciones }}
                            </span>
                        @else
                            <span id="badge-notificaciones" class="hidden"></span>
                        @endif
                    </button>
                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-100 z-30">
                        <div class="p-3 border-b border-gray-100 flex items-center justify-between">
                            <p class="font-semibold text-[#1e3a5f]">Notificaciones</p>
                            @if($novedadesHeader->isNotEmpty())
                                <button type="button"
                                        id="btn-marcar-novedades-vistas-header"
                                        class="text-xs text-blue-600 hover:underline">
                                    Marcar leídas
                                </button>
                            @endif
                        </div>
                        <div class="max-h-96 overflow-y-auto" id="contenedor-notificaciones-header">
                            @if($portafolioOcultoHdr)
                                <div class="p-3 bg-red-50 border-b border-gray-100">
                                    <p class="text-sm font-medium text-red-800">
                                        <i class="fas fa-eye-slash mr-1"></i> Tu portafolio fue ocultado
                                    </p>
                                    @if($notaModeracionHdr)
                                        <p class="text-xs text-red-700 mt-1">{{ $notaModeracionHdr }}</p>
                                    @endif
                                </div>
                            @elseif($notaModeracionHdr)
                                <div class="p-3 bg-yellow-50 border-b border-gray-100">
                                    <p class="text-sm font-medium text-yellow-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Aviso del administrador
                                    </p>
                                    <p class="text-xs text-yellow-700 mt-1">{{ $notaModeracionHdr }}</p>
                                </div>
                            @endif

                            @foreach($proyectosOcultosModHdr as $proyOcultoH)
                                <div class="p-3 bg-orange-50 border-b border-gray-100">
                                    <p class="text-sm font-medium text-orange-800">
                                        <i class="fas fa-folder-minus mr-1"></i> Proyecto oculto: «{{ $proyOcultoH->nombre }}»
                                    </p>
                                    <p class="text-xs text-orange-700 mt-1"><span class="font-semibold">Motivo:</span> {{ $proyOcultoH->moderation_note }}</p>
                                </div>
                            @endforeach

                            @foreach($habilidadesOcultasModHdr as $habOcultaH)
                                <div class="p-3 bg-orange-50 border-b border-gray-100">
                                    <p class="text-sm font-medium text-orange-800">
                                        <i class="fas fa-code mr-1"></i> Habilidad oculta: «{{ $habOcultaH->nombre }}»
                                    </p>
                                    <p class="text-xs text-orange-700 mt-1"><span class="font-semibold">Motivo:</span> {{ $habOcultaH->moderation_note }}</p>
                                </div>
                            @endforeach

                            @forelse($novedadesHeader as $novedad)
                                <div class="p-3 hover:bg-gray-50 border-b border-gray-100 novedad-item-header"
                                     data-tipo="{{ $novedad['tipo'] }}"
                                     data-id="{{ $novedad['id_entidad'] }}">
                                    <p class="text-sm text-gray-800">
                                        <i class="{{ $novedad['icono'] }} {{ $novedad['color'] }} mr-1 text-xs"></i>
                                        {{ $novedad['titulo'] }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($novedad['created_at'])->diffForHumans() }}</p>
                                </div>
                            @empty
                                @unless($hayAvisosHdr)
                                    <p class="p-4 text-xs text-gray-500 italic text-center">Sin notificaciones</p>
                                @endunless
                            @endforelse
                        </div>
                    </div>
                </div>

                     <!-- usuario -->
                <div class="relative dropdown">
                    <button class="flex items-center space-x-2 focus:outline-none">
                        @php
                            $fotoPerfilHeader = $usuario->perfil->foto_perfil ?? null;
                        @endphp

                        <span id="header-avatar" class="block">
                            @if($fotoPerfilHeader)
                                <img src="{{ $fotoPerfilHeader }}" alt="Foto perfil" class="w-10 h-10 rounded-full object-cover shadow-md">
                            @else
                                <span class="w-10 h-10 bg-gradient-to-br from-[#1e3a5f] to-indigo-600 rounded-full flex items-center justify-center shadow-md">
                                    <span class="text-white text-sm font-bold">{{ $iniciales }}</span>
                                </span>
                            @endif
                        </span>
                        <span id="header-nombre-usuario" class="text-sm font-medium text-gray-700 hidden md:inline">{{ $nombreUsuario }}</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500 hidden md:inline"></i>
                    </button>
                    <!-- resto del dropdown -->

                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg border border-gray-100 z-30">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user mr-2"></i> Mi perfil
                        </a>
                        <a href="#" onclick="irAConfiguracionCuenta(); return false;" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-cog mr-2"></i> Configuración
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
        <div class="px-4 md:px-8 pb-3">
            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-500 flex-shrink-0 hidden sm:inline">{{ $progresoLabel }}</span>
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

        <!-- buscador móvil expandible -->
        <div id="buscador-mobile-wrapper" class="md:hidden hidden px-4 pb-3">
            <div class="flex items-center bg-gray-100 rounded-xl px-4 py-2 gap-2">
                <i class="fas fa-search text-gray-400 text-sm"></i>
                <input id="buscador-global-mobile" type="text" placeholder="Buscar proyectos..."
                    class="bg-transparent text-sm text-gray-700 placeholder-gray-400 outline-none w-full">
            </div>
        </div>
    </header>
