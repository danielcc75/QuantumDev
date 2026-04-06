<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portafolio Digital</title>

    <!-- Tailwind CSS CDN - No necesita npm -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Configuración personalizada de Tailwind -->
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
</head>

<body class="bg-gray-100 font-sans">

    <!-- NAVBAR -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <!-- Logo temporal (texto) mientras no tengas la imagen -->
                <div class="w-8 h-8 bg-blue-900 rounded-lg flex items-center justify-center text-white font-bold">
                    PD
                </div>
                <div>
                    <span class="font-bold text-blue-900">Portafolio</span>
                    <span class="text-pink-400 font-semibold">Digital</span>
                </div>
            </div>

            <!-- Menu -->
            <nav class="hidden md:flex gap-8 text-gray-600">
                <a href="#" class="hover:text-blue-900 transition">Inicio</a>
                <a href="#" class="hover:text-blue-900 transition">Proyectos</a>
                <a href="#" class="hover:text-blue-900 transition">Habilidades</a>
                <a href="#" class="hover:text-blue-900 transition">Sobre mi</a>
            </nav>

            <!-- Botones -->
            <div class="flex gap-3">
                <a href="#" class="border border-blue-900 px-4 py-2 rounded-md text-blue-900 hover:bg-blue-50 transition">Iniciar sesión</a>
                <a href="#" class="bg-blue-900 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">Registrarse</a>
            </div>

        </div>
    </header>

    <!-- HERO -->
    <section class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">

        <!-- Texto -->
        <div>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-blue-900 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                    PD
                </div>
                <h1 class="text-5xl font-bold text-blue-900">
                    Portafolio <span class="text-pink-400">Digital</span>
                </h1>
            </div>

            <p class="text-gray-600 mt-4 text-lg leading-relaxed">
                Especializado en crear aplicaciones web modernas, escalables y eficientes.
                Transformo problemas complejos en soluciones tecnológicas elegantes y fáciles de usar.
            </p>

            <!-- Botones -->
            <div class="mt-8 flex gap-4">
                <a href="#" class="bg-blue-900 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition">
                    Explorar Proyectos
                </a>
                <a href="#" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-300 transition">
                    Ver GitHub
                </a>
            </div>

            <!-- Stats -->
            <div class="flex gap-10 mt-12 text-blue-900 font-bold">
                <div>
                    <p class="text-3xl">+5</p>
                    <span class="text-gray-500 text-sm font-normal">Años de Experiencia</span>
                </div>
                <div>
                    <p class="text-3xl">+40</p>
                    <span class="text-gray-500 text-sm font-normal">Proyectos Entregados</span>
                </div>
                <div>
                    <p class="text-3xl">100%</p>
                    <span class="text-gray-500 text-sm font-normal">Satisfacción</span>
                </div>
            </div>
        </div>

        <!-- Imagen / Tarjeta decorativa -->
        <div class="relative">
            <!-- Tarjeta decorativa en lugar de imagen -->
            <div class="bg-gradient-to-br from-blue-900 to-pink-400 rounded-xl shadow-lg p-8 text-white">
                <div class="text-center">
                    <div class="text-6xl mb-4">💻</div>
                    <h3 class="text-2xl font-bold mb-2">Desarrollador Full Stack</h3>
                    <p class="text-blue-100">Especializado en soluciones escalables</p>
                </div>
            </div>

            <!-- Badge -->
            <div class="absolute -bottom-4 -left-4 bg-white shadow-lg rounded-lg px-4 py-2 flex items-center gap-2">
                <div class="w-3 h-3 bg-pink-400 rounded-full animate-pulse"></div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Arquitectura Escalable</p>
                    <span class="text-xs text-gray-500">React, Node.js & AWS</span>
                </div>
            </div>
        </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-blue-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-3 gap-8">

            <!-- Info -->
            <div>
                <h2 class="font-bold text-xl mb-3">Portafolio Digital</h2>
                <p class="text-sm text-gray-300 leading-relaxed">
                    Construyendo el futuro digital con código limpio y soluciones elegantes.
                </p>
            </div>

            <!-- Enlaces -->
            <div>
                <h3 class="font-semibold text-lg mb-3">Enlaces</h3>
                <ul class="text-gray-300 text-sm space-y-2">
                    <li><a href="#" class="hover:text-white transition">Proyectos</a></li>
                    <li><a href="#" class="hover:text-white transition">Habilidades</a></li>
                    <li><a href="#" class="hover:text-white transition">Sobre mí</a></li>
                    <li><a href="#" class="hover:text-white transition">Contacto</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div>
                <h3 class="font-semibold text-lg mb-3">Contacto</h3>
                <p class="text-gray-300 text-sm">QuantumDev</p>
                <p class="text-gray-300 text-sm">Email: contacto@quantumdev.dev</p>
                <p class="text-gray-300 text-sm">Tel: +591 700 123 456</p>
            </div>

        </div>

        <div class="text-center text-gray-400 text-sm pb-6">
            © 2026 Portafolio Digital. Todos los derechos reservados.
        </div>
    </footer>

</body>
</html>