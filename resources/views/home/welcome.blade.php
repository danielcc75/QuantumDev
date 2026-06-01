<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portafolio Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@10.2.0/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js@10.2.0/public/assets/scripts/choices.min.js" defer></script>

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

        /* Choices.js: armonizar con Tailwind del buscador */
        .choices { margin-bottom: 0; font-size: 0.875rem; }
        .choices__inner.buscador-choice {
            min-height: 38px;
            padding: 4px 6px;
            border-radius: 0.5rem;
            border-color: #d1d5db;
            background: #fff;
        }
        .choices[data-type*="select-multiple"] .choices__button { margin-left: 6px; }
        .choices__list--multiple .choices__item {
            border-radius: 9999px;
            padding: 2px 10px;
            font-weight: 500;
        }
        /* Pills de TECNOLOGÍAS — azul oscuro corporativo */
        .buscador-multi-tecnologias .choices__list--multiple .choices__item {
            background-color: #1e3a5f;
            border-color: #1e3a5f;
        }
        .buscador-multi-tecnologias .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #1e3a5f;
            color: #fff;
        }
        /* Pills de CATEGORÍAS — rojo coral del sistema */
        .buscador-multi-categorias .choices__list--multiple .choices__item {
            background-color: #e11d48;
            border-color: #e11d48;
        }
        .buscador-multi-categorias .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #e11d48;
            color: #fff;
        }
        /* Single de CATEGORÍA DE TECNOLOGÍA — verde esmeralda en hover/highlight */
        .buscador-single-categoriatec .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #10b981;
            color: #fff;
        }
        .buscador-single-categoriatec.is-focused .choices__inner.buscador-choice {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
        }
        .choices.is-focused .choices__inner.buscador-choice {
            border-color: #1e3a5f;
            box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.15);
        }
        /* Encabezados de grupo (optgroup) dentro del dropdown */
        .choices__list--dropdown .choices__group {
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }
        .choices__list--dropdown .choices__group .choices__heading {
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.04em;
            color: #6b7280;
            font-weight: 700;
            padding: 6px 10px;
            border: none;
        }
        .choices__list--dropdown .choices__item--choice {
            padding-left: 18px;
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
                    {{ __('general.home.hero.descripcion') }}
                </p>

                <!-- botones -->
                <div class="mt-6 flex gap-4 flex-wrap">
                    @if (session('usuario_id'))
                        <a href="{{ route('dashboard') }}"
                        class="bg-[#1e3a5f] text-white px-6 py-3 rounded-md hover:bg-[#16304d] transition-all-soft hover-scale">
                            {{ __('general.home.hero.cta_ir_portafolio') }}
                        </a>
                    @else
                        <a href="javascript:void(0)" onclick="abrirRegister()"
                        class="bg-[#1e3a5f] text-white px-6 py-3 rounded-md hover:bg-[#16304d] transition-all-soft hover-scale">
                            {{ __('general.home.hero.cta_crear_portafolio') }}
                        </a>
                    @endif

                    <a href="#explorar"
                       class="bg-gray-200 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-300 transition-all-soft hover-scale">
                        {{ __('general.home.hero.cta_explorar') }}
                    </a>
                </div>

                <!-- stats -->
                <div class="flex gap-10 mt-10 text-[#1e3a5f] font-bold flex-wrap">
                    <div class="transition-all-soft hover-scale">
                        <p class="text-2xl">+5</p>
                        <span class="text-gray-500 text-sm font-normal">{{ __('general.home.hero.stats_anios') }}</span>
                    </div>
                    <div class="transition-all-soft hover-scale">
                        <p class="text-2xl">+40</p>
                        <span class="text-gray-500 text-sm font-normal">{{ __('general.home.hero.stats_proyectos') }}</span>
                    </div>
                    <div class="transition-all-soft hover-scale">
                        <p class="text-2xl">100%</p>
                        <span class="text-gray-500 text-sm font-normal">{{ __('general.home.hero.stats_satisfaccion') }}</span>
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
                            {{ __('general.home.hero.badge_titulo') }}
                        </p>
                        <span class="text-xs text-gray-500">
                            {{ __('general.home.hero.badge_subtitulo') }}
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
                    {{ __('general.home.footer.descripcion_default') }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">{{ __('general.home.footer.enlaces') }}</h3>
                <ul class="text-gray-300 text-sm space-y-1">
                    <li><a href="#inicio" class="hover:text-white transition-all-soft">{{ __('general.nav.inicio') }}</a></li>
                    <li><a href="#explorar" class="hover:text-white transition-all-soft">{{ __('general.nav.explorar') }}</a></li>
                    <li><a href="#como-funciona" class="hover:text-white transition-all-soft">{{ __('general.nav.como_funciona') }}</a></li>
                    <li><a href="#sobre-nosotros" class="hover:text-white transition-all-soft">{{ __('general.nav.sobre_nosotros') }}</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-2">{{ __('general.home.footer.contacto') }}</h3>
                <p class="text-gray-300 text-sm">{{ $configSitio?->nombre_empresa ?? 'QuantumDev' }}</p>
                <p class="text-gray-300 text-sm">{{ __('general.home.footer.email_label') }}: {{ $configSitio?->email_contacto ?? 'contacto@quantumdev.dev' }}</p>
                <p class="text-gray-300 text-sm">{{ __('general.home.footer.tel_label') }}: {{ $configSitio?->telefono ?? '+591 700 123 456' }}</p>
            </div>

        </div>

        <div class="text-center text-gray-300 text-sm pb-4">
            {{ __('general.home.footer.copyright', ['year' => date('Y')]) }}
        </div>
    </footer>

    @include('auth.login')
    @include('auth.register')

    {{-- Bootstrap de traducciones para JS (debe ir antes de scripts-home) --}}
    @include('partials._translations-bootstrap')

    @include('home.scripts-home')

    {{-- Modal global de confirmación (window.confirmar / data-confirm) --}}
    @include('partials._modal-confirmar')

</body>
</html>