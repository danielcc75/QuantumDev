<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portafolio Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-900': '#1e3a8a',
                        'pink-400': '#f472b6',
                    }
                }
            }
        }
    </script>

    <style>
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

<body class="bg-gray-100 font-sans min-h-screen flex flex-col">

    <!-- navbar -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- logo -->
            <a href="#" class="flex items-center gap-3 transition-all-soft hover-scale">
                <img src="/logo.png" class="h-10 md:h-11" alt="Logo">

                <div class="flex flex-col leading-none">
                    <span class="font-bold text-blue-900 text-lg">
                        Portafolio
                    </span>
                    <span class="text-pink-400 font-semibold text-base -mt-2">
                        Digital
                    </span>
                </div>
            </a>

            <!-- menu -->
            <nav class="hidden md:flex gap-8 text-gray-600">
                <a href="#" class="nav-link hover:text-blue-900 transition">Inicio</a>
                <a href="#" class="nav-link hover:text-blue-900 transition">Proyectos</a>
                <a href="#" class="nav-link hover:text-blue-900 transition">Habilidades</a>
                <a href="#" class="nav-link hover:text-blue-900 transition">Sobre mi</a>
            </nav>

            <!-- Botones / Usuario -->
            <div class="flex items-center gap-3">
                @if (session('usuario_id'))
                    <div class="relative" id="userDropdown">
                        <button
                            id="userDropdownButton"
                            type="button"
                            class="flex items-center gap-3 px-2 py-1 rounded-lg hover:bg-gray-100 transition-all-soft"
                        >
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center shadow-md">
                                <span class="text-white text-sm font-bold">
                                    {{ strtoupper(substr(session('usuario_nombre'), 0, 2)) }}
                                </span>
                            </div>
                        </button>

                        <div
                            id="userDropdownMenu"
                            class="hidden absolute right-0 mt-2 w-52 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-40"
                        >
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="font-semibold text-sm text-gray-800">{{ session('usuario_nombre') }}</p>
                                <p class="text-xs text-gray-500">{{ session('usuario_email') }}</p>
                            </div>

                            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-all-soft">
                                Dashboard
                            </a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-gray-50 transition-all-soft">
                                    Cerrar sesion
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="javascript:void(0)" onclick="abrirLogin()" class="border px-4 py-2 rounded-md text-blue-900 hover:bg-blue-50 transition-all-soft hover-lift">
                        Iniciar sesion
                    </a>
                    <a href="javascript:void(0)" onclick="abrirRegister()" class="bg-blue-900 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition-all-soft hover-lift">
                        Registrarse
                    </a>
                @endif
            </div>

        </div>
    </header>

    <!-- contenido principal -->
    <main class="flex-grow">

        <!-- hero -->
        <section class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">

            <!-- texto -->
            <div>
                <div class="mb-6 flex items-center gap-4">
                    <img src="/logo.png" class="h-16 md:h-20 transition-all-soft hover-scale" alt="Logo grande">
                    <div>
                        <h1 class="text-5xl font-bold text-blue-900 leading-tight">
                            Portafolio
                        </h1>
                        <h2 class="text-5xl font-bold text-pink-400 leading-tight">
                            Digital
                        </h2>
                    </div>
                </div>

                <p class="text-gray-600 mt-4">
                    Especializado en crear aplicaciones web modernas, escalables y eficientes.
                    Transformo problemas complejos en soluciones tecnologicas elegantes y faciles de usar.
                </p>

                <!-- botones -->
                <div class="mt-6 flex gap-4">
                    <a href="#" class="bg-blue-900 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition-all-soft hover-scale">
                        Explorar Proyectos
                    </a>
                    <a href="#" class="bg-gray-200 px-6 py-3 rounded-md hover:bg-gray-300 transition-all-soft hover-scale">
                        Ver Github
                    </a>
                </div>

                <!-- stats -->
                <div class="flex gap-10 mt-10 text-blue-900 font-bold">
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
                <div class="hero-card absolute bottom-4 left-4 bg-white shadow-md rounded-lg px-4 py-2 flex items-center gap-2 transition-all-soft">
                    <div class="w-3 h-3 bg-pink-400 rounded-full animate-pulse"></div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Arquitectura Escalable</p>
                        <span class="text-xs text-gray-500">React, Node.js y AWS</span>
                    </div>
                </div>
            </div>

        </section>

    </main>

    <!-- footer -->
    <footer class="bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">

            <!-- info -->
            <div>
                <h2 class="font-bold text-lg">Portafolio Digital</h2>
                <p class="text-sm mt-2 text-gray-300">
                    Construyendo el futuro digital con codigo limpio y soluciones elegantes.
                </p>
            </div>

            <!-- enlaces -->
            <div>
                <h3 class="font-semibold mb-2">Enlaces</h3>
                <ul class="text-gray-300 text-sm space-y-1">
                    <li><a href="#" class="hover:text-white transition-all-soft">Proyectos</a></li>
                    <li><a href="#" class="hover:text-white transition-all-soft">Habilidades</a></li>
                    <li><a href="#" class="hover:text-white transition-all-soft">Sobre mi</a></li>
                    <li><a href="#" class="hover:text-white transition-all-soft">Contacto</a></li>
                </ul>
            </div>

            <!-- contacto -->
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

    <script>
        function abrirLogin() {
            const modal = document.getElementById('modalLogin');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function cerrarLogin() {
            const modal = document.getElementById('modalLogin');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function abrirRegister() {
            const modal = document.getElementById('modalRegister');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function cerrarRegister() {
            const modal = document.getElementById('modalRegister');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function irALogin() {
            cerrarRegister();
            abrirLogin();
        }

        function irARegister() {
            cerrarLogin();
            abrirRegister();
        }

        const userDropdownButton = document.getElementById('userDropdownButton');
        const userDropdownMenu = document.getElementById('userDropdownMenu');

        if (userDropdownButton && userDropdownMenu) {
            userDropdownButton.addEventListener('click', function (e) {
                e.stopPropagation();
                userDropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function (e) {
                if (!e.target.closest('#userDropdown')) {
                    userDropdownMenu.classList.add('hidden');
                }
            });
        }

        const flashMessage = document.getElementById('flashMessage');

        if (flashMessage) {
            setTimeout(() => {
                flashMessage.style.opacity = '0';
                flashMessage.style.transform = 'translateY(-10px)';

                setTimeout(() => {
                    flashMessage.remove();
                }, 500);
            }, 3000);
        }
    </script>

    @include('auth.login')
    @include('auth.register')

</body>
</html>