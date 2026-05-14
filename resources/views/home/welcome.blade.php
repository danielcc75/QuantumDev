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
    @include('home._header')

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
        @include('home._section-explorar')
    </main>

    @include('home._modal_portafolio_publico')


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

    {{-- Modal global de confirmación (window.confirmar / data-confirm) --}}
    @include('partials._modal-confirmar')

</body>
</html>