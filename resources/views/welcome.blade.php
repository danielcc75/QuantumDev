<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portafolio Digital</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">

    <!-- NAVBAR -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <img src="/logo.png" class="h-8">
                <div>
                    <span class="font-bold text-blue-900">Portafolio</span>
                    <span class="text-pink-400 font-semibold">Digital</span>
                </div>
            </div>

            <!-- Menu -->
            <nav class="hidden md:flex gap-8 text-gray-600">
                <a href="#">Inicio</a>
                <a href="#">Proyectos</a>
                <a href="#">Habilidades</a>
                <a href="#">Sobre mi</a>
            </nav>

            <!-- Botones -->
            <div class="flex gap-3">
                <a href="#" class="border px-4 py-2 rounded-md text-blue-900">Iniciar sesion</a>
                <a href="#" class="bg-blue-900 text-white px-4 py-2 rounded-md">Registrarse</a>
            </div>

        </div>
    </header>

    <!-- HERO -->
    <section class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">

        <!-- Texto -->
        <div>
            <div class="flex items-center gap-3 mb-4">
                <img src="/logo.png" class="h-10">
                <h1 class="text-5xl font-bold text-blue-900">
                    Portafolio <span class="text-pink-400">Digital</span>
                </h1>
            </div>

            <p class="text-gray-600 mt-4">
                Especializado en crear aplicaciones web modernas, escalables y eficientes.
                Transformo problemas complejos en soluciones tecnologicas elegantes y faciles de usar.
            </p>

            <!-- Botones -->
            <div class="mt-6 flex gap-4">
                <a href="#" class="bg-blue-900 text-white px-6 py-3 rounded-md">
                    Explorar Proyectos
                </a>
                <a href="#" class="bg-gray-200 px-6 py-3 rounded-md">
                    Ver Github
                </a>
            </div>

            <!-- Stats -->
            <div class="flex gap-10 mt-10 text-blue-900 font-bold">
                <div>
                    <p class="text-2xl">+5</p>
                    <span class="text-gray-500 text-sm font-normal">Años de Experiencia</span>
                </div>
                <div>
                    <p class="text-2xl">+40</p>
                    <span class="text-gray-500 text-sm font-normal">Proyectos Entregados</span>
                </div>
                <div>
                    <p class="text-2xl">100%</p>
                    <span class="text-gray-500 text-sm font-normal">Satisfaccion</span>
                </div>
            </div>
        </div>

        <!-- Imagen -->
        <div class="relative">
            <img src="/hero.jpg" class="rounded-xl shadow-lg">

            <!-- Badge -->
            <div class="absolute bottom-4 left-4 bg-white shadow-md rounded-lg px-4 py-2 flex items-center gap-2">
                <div class="w-3 h-3 bg-pink-400 rounded-full"></div>
                <div>
                    <p class="text-sm font-semibold">Arquitectura Escalable</p>
                    <span class="text-xs text-gray-500">React, Node.js & AWS</span>
                </div>
            </div>
        </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-blue-900 text-white mt-10">
        <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">

            <!-- Info -->
            <div>
                <h2 class="font-bold text-lg">Portafolio Digital</h2>
                <p class="text-sm mt-2 text-gray-300">
                    Construyendo el futuro digital con codigo limpio y soluciones elegantes.
                </p>
            </div>

            <!-- Enlaces -->
            <div>
                <h3 class="font-semibold mb-2">Enlaces</h3>
                <ul class="text-gray-300 text-sm space-y-1">
                    <li>Proyectos</li>
                    <li>Habilidades</li>
                    <li>Sobre mi</li>
                    <li>Contacto</li>
                </ul>
            </div>

            <!-- Contacto -->
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

</body>
</html>