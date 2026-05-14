    <header class="bg-white shadow-md sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- logo -->
            <a href="#inicio" class="flex items-center gap-3 transition-all-soft hover-scale">
                <img src="/logo.png" class="h-10 md:h-11" alt="Logo">

                <div class="flex flex-col leading-none">
                    <span class="font-bold text-[#1e3a5f] text-lg">
                        Portafolio
                    </span>
                    <span class="text-[#e11d48] font-semibold text-base -mt-2">
                        Digital
                    </span>
                </div>
            </a>

            <!-- menu -->
            <nav class="hidden md:flex gap-8 text-gray-600">
                <a href="#inicio" class="nav-link menu-link text-[#e11d48] font-bold transition">Inicio</a>
                <a href="#como-funciona" class="nav-link menu-link hover:text-[#1e3a5f] transition">Como funciona</a>
                <a href="#sobre-nosotros" class="nav-link menu-link hover:text-[#1e3a5f] transition">Sobre nosotros</a>
                <a href="#explorar" class="nav-link menu-link hover:text-[#1e3a5f] transition">Explorar</a>
            </nav>

            <!-- botones / usuario -->
            <div class="flex items-center gap-3">
                @if (session('usuario_id'))

                    @php
                        $nombreUsuario = session('usuario_nombre');
                        $iniciales = strtoupper(substr($nombreUsuario, 0, 2));
                        $fotoPerfilHeader = DB::table('perfil')
                            ->where('id_usuario', session('usuario_id'))
                            ->value('foto_perfil');
                    @endphp

                    <div class="relative dropdown">
                        <button class="flex items-center space-x-2 focus:outline-none hover:bg-gray-100 px-2 py-1 rounded-lg transition-all-soft">

                            <!-- avatar -->
                            @if(!empty($fotoPerfilHeader))
                                <img src="{{ $fotoPerfilHeader }}" alt="{{ $nombreUsuario }}"
                                    class="w-10 h-10 rounded-full object-cover shadow-md">
                            @else
                                <div class="w-10 h-10 bg-gradient-to-br from-[#1e3a5f] to-indigo-600 rounded-full flex items-center justify-center shadow-md">
                                    <span class="text-white text-sm font-bold">{{ $iniciales }}</span>
                                </div>
                            @endif

                            <!-- nombre -->
                            <span class="text-sm font-medium text-gray-700 hidden md:inline">
                                {{ $nombreUsuario }}
                            </span>

                            <!-- flecha -->
                            <i class="fas fa-chevron-down text-xs text-gray-500 hidden md:inline"></i>
                        </button>

                        <!-- dropdown -->
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg border border-gray-100 z-40">

                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Mi dashboard
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

                @else
                    <a href="javascript:void(0)" onclick="abrirLogin()" class="border border-[#1e3a5f]/20 px-4 py-2 rounded-md text-[#1e3a5f] hover:bg-[#1e3a5f]/5 transition-all-soft hover-lift">
                        Iniciar sesion
                    </a>
                    <a href="javascript:void(0)" onclick="abrirRegister()" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-md hover:bg-[#16304d] transition-all-soft hover-lift">
                        Registrarse
                    </a>
                @endif
            </div>

        </div>
    </header>
