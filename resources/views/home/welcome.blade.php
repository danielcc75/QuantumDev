<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portafolio Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        html {
            scroll-behavior: smooth;
        }

        .transition-all-soft {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        .hero-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hero-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12);
        }
    </style>
</head>

<body class="bg-gray-50 font-sans min-h-screen flex flex-col">

    <!-- navbar -->
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
                    @endphp

                    <div class="relative dropdown">
                        <button class="flex items-center space-x-2 focus:outline-none hover:bg-gray-100 px-2 py-1 rounded-lg transition-all-soft">

                            <!-- avatar -->
                            <div class="w-10 h-10 bg-gradient-to-br from-[#1e3a5f] to-indigo-600 rounded-full flex items-center justify-center shadow-md">
                                <span class="text-white text-sm font-bold">{{ $iniciales }}</span>
                            </div>

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

    <!-- contenido principal -->
    <main class="flex-grow">

        <!-- hero -->
        <section id="inicio" class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center scroll-mt-28">

            <!-- texto -->
            <div>
                <div class="mb-6 flex items-center gap-4">
                    <img src="/logo.png" class="h-16 md:h-20 transition-all-soft hover-scale" alt="Logo grande">
                    <div>
                        <h1 class="text-5xl font-bold text-[#1e3a5f] leading-tight">
                            Portafolio
                        </h1>
                        <h2 class="text-5xl font-bold text-[#e11d48] leading-tight">
                            Digital
                        </h2>
                    </div>
                </div>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    Una plataforma pensada para que estudiantes y desarrolladores puedan
                    crear, organizar y compartir sus proyectos en un espacio profesional,
                    claro y accesible.
                </p>

                <!-- botones -->
                <div class="mt-6 flex gap-4 flex-wrap">
                    @if (session('usuario_id'))
                        <a href="{{ route('dashboard') }}"
                        class="bg-[#1e3a5f] text-white px-6 py-3 rounded-md hover:bg-[#16304d] transition-all-soft hover-scale">
                            Ir a mi portafolio
                        </a>
                    @else
                        <a href="javascript:void(0)" onclick="abrirRegister()"
                        class="bg-[#1e3a5f] text-white px-6 py-3 rounded-md hover:bg-[#16304d] transition-all-soft hover-scale">
                            Crea tu portafolio
                        </a>
                    @endif

                    <a href="#explorar"
                       class="bg-gray-200 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-300 transition-all-soft hover-scale">
                        Explorar proyectos
                    </a>
                </div>

                <!-- stats -->
                <div class="flex gap-10 mt-10 text-[#1e3a5f] font-bold flex-wrap">
                    <div class="transition-all-soft hover-scale">
                        <p class="text-2xl">+5</p>
                        <span class="text-gray-500 text-sm font-normal">Años de Experiencia</span>
                    </div>
                    <div class="transition-all-soft hover-scale">
                        <p class="text-2xl">+40</p>
                        <span class="text-gray-500 text-sm font-normal">Proyectos Entregados</span>
                    </div>
                    <div class="transition-all-soft hover-scale">
                        <p class="text-2xl">100%</p>
                        <span class="text-gray-500 text-sm font-normal">Satisfaccion</span>
                    </div>
                </div>
            </div>

            <!-- imagen -->
            <div class="relative">
                <img src="/hero.jpg" class="rounded-xl shadow-lg transition-all-soft hover:scale-105" alt="Hero">

                <!-- badge -->
                <div class="hero-card absolute bottom-4 left-4 bg-white shadow-md rounded-lg px-4 py-2 flex items-center gap-2 transition-all-soft border border-gray-100">
                    <div class="w-3 h-3 bg-[#e11d48] rounded-full animate-pulse"></div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">
                            Crea tu presencia profesional
                        </p>
                        <span class="text-xs text-gray-500">
                            Proyectos, habilidades y perfil en un solo lugar
                        </span>
                    </div>
                </div>
            </div>

        </section>

        @include('home.sections.como-funciona')
        @include('home.sections.sobre-nosotros')

        <!-- explorar -->
        <section id="explorar" class="py-20 bg-white scroll-mt-28">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <span class="inline-block text-sm font-semibold tracking-wide uppercase text-[#e11d48] bg-red-50 px-4 py-1 rounded-full mb-4">
                    Explorar
                </span>

                <h2 class="text-3xl md:text-4xl font-bold text-[#1e3a5f] mb-4">
                    Proyectos y portafolios publicos
                </h2>

                <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Aqui podras descubrir proyectos compartidos por otros usuarios y explorar
                    distintos perfiles dentro de la plataforma de una forma clara y accesible.
                </p>

                <div class="mt-10 grid md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all-soft hover:-translate-y-1 text-left">
                        <div class="w-12 h-12 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center mb-4">
                            <i class="fas fa-laptop-code text-[#1e3a5f] text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Portafolios destacados</h3>
                        <p class="text-gray-600">
                            Visualiza perfiles con proyectos y experiencia publicados por la comunidad.
                        </p>
                    </div>

                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all-soft hover:-translate-y-1 text-left">
                        <div class="w-12 h-12 rounded-xl bg-[#e11d48]/10 flex items-center justify-center mb-4">
                            <i class="fas fa-folder-open text-[#e11d48] text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Proyectos visibles</h3>
                        <p class="text-gray-600">
                            Encuentra trabajos publicados y conoce distintas areas, tecnologias y enfoques.
                        </p>
                    </div>

                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all-soft hover:-translate-y-1 text-left">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center mb-4">
                            <i class="fas fa-users text-[#f59e0b] text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Comunidad en crecimiento</h3>
                        <p class="text-gray-600">
                            Conecta con el trabajo de otros usuarios y descubre nuevas ideas e inspiracion.
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- footer -->
    <footer class="bg-[#1e3a5f] text-white">
        <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">

            <div>
                <h2 class="font-bold text-lg">Portafolio Digital</h2>
                <p class="text-sm mt-2 text-gray-300">
                    Construyendo espacios digitales donde estudiantes y desarrolladores puedan mostrar su talento de forma clara y profesional.
                </p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">Enlaces</h3>
                <ul class="text-gray-300 text-sm space-y-1">
                    <li><a href="#inicio" class="hover:text-white transition-all-soft">Inicio</a></li>
                    <li><a href="#explorar" class="hover:text-white transition-all-soft">Explorar</a></li>
                    <li><a href="#como-funciona" class="hover:text-white transition-all-soft">Como funciona</a></li>
                    <li><a href="#sobre-nosotros" class="hover:text-white transition-all-soft">Sobre nosotros</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-2">Contacto</h3>
                <p class="text-gray-300 text-sm">QuantumDev</p>
                <p class="text-gray-300 text-sm">Email: contacto@quantumdev.dev</p>
                <p class="text-gray-300 text-sm">Tel: +591 700 123 456</p>
            </div>

        </div>

        <div class="text-center text-gray-300 text-sm pb-4">
            © 2026 Portafolio Digital. Todos los derechos reservados.
        </div>
    </footer>

    @include('auth.login')
    @include('auth.register')
    @include('home.scripts-home')

</body>
</html>