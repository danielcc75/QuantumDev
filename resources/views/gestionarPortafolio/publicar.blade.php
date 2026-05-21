{{-- resources/views/gestionarPortafolio/publicar.blade.php
     Flujo completo de publicación del portafolio. --}}

@php
    use Illuminate\Support\Facades\DB;
    $perfilPub = DB::table('perfil')->where('id_usuario', $userId)->first();
    $visibilidad = $perfilPub->visibilidad ?? 'publico';

    $perfilIdPub = $perfilPub->id_perfil ?? null;
    $itemsSinPublicar = 0;
    if ($perfilIdPub) {
        $itemsSinPublicar += DB::table('proyectos')->where('id_perfil', $perfilIdPub)->where('visible', false)->whereNull('deleted_at')->count();
        $itemsSinPublicar += DB::table('habilidades')->where('id_perfil', $perfilIdPub)->where('publicado', false)->whereNull('deleted_at')->count();
        $itemsSinPublicar += DB::table('experiencia_laboral')->where('id_perfil', $perfilIdPub)->where('publicado', false)->whereNull('deleted_at')->count();
        $itemsSinPublicar += DB::table('formacion_academica')->where('id_perfil', $perfilIdPub)->where('publicado', false)->whereNull('deleted_at')->count();
        $itemsSinPublicar += DB::table('perfil_habilidad_blanda')->where('id_perfil', $perfilIdPub)->where('publicado', false)->count();
    }
    $esPublico = $visibilidad === 'publico';
@endphp

<div class="w-full">
    <main class="p-4 sm:p-6 lg:p-8">

        {{-- Encabezado --}}
        <div class="mb-6 md:mb-8">
            <h2 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-[#1e3a5f] to-[#e11d48] bg-clip-text text-transparent">
                Publicar Portafolio
            </h2>
            <p class="text-sm text-gray-500 mt-2">Controla la visibilidad de tu portafolio y publica el contenido que quieres mostrar</p>
            <div class="mt-3 h-1 w-20 rounded-full bg-gradient-to-r from-[#1e3a5f] to-[#e11d48]"></div>
        </div>

        {{-- Aviso de elementos sin publicar --}}
        <div id="aviso-sin-publicar"
             class="{{ ($esPublico && $itemsSinPublicar > 0) ? 'flex' : 'hidden' }} items-center gap-4 bg-white border-2 border-amber-300 rounded-2xl px-5 py-4 mb-5 shadow-sm">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#e11d48] to-[#1e3a5f] flex items-center justify-center flex-shrink-0 shadow-md">
                <i class="fas fa-bolt text-white text-sm"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-gray-800">
                    Tienes <span id="aviso-sin-publicar-count">{{ $itemsSinPublicar }}</span> elemento(s) sin publicar
                </p>
                <p class="text-xs text-gray-500 mt-0.5">Actualiza tu publicación para mostrarlos en tu portafolio público.</p>
                <button type="button" onclick="editarPublicacion()"
                    class="mt-2 inline-flex items-center gap-2 bg-gradient-to-r from-[#1e3a5f] to-[#e11d48] hover:opacity-90 text-white text-xs font-semibold px-4 py-2 rounded-lg transition shadow">
                    Actualizar ahora
                </button>
            </div>
        </div>

        {{-- Tarjeta principal --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sm:p-6">

            {{-- Encabezado de la tarjeta --}}
            <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-eye text-[#1e3a5f]"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-base">Visibilidad del perfil</h3>
                    <p class="text-xs text-gray-500">Controla quién puede ver tu portafolio</p>
                </div>
            </div>

            {{-- Estado actual --}}
            <div id="estado-visibilidad"
                 class="flex items-center gap-4 rounded-xl px-4 py-4 mb-5 border
                        {{ $esPublico ? 'bg-[#1e3a5f]/5 border-[#1e3a5f]/20' : 'bg-gray-50 border-gray-200' }}">
                <div id="estado-icono-wrap"
                     class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0
                            {{ $esPublico ? 'bg-[#1e3a5f]' : 'bg-gray-400' }}">
                    <i id="estado-icono" class="fas {{ $esPublico ? 'fa-globe' : 'fa-lock' }} text-white"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p id="label-visibilidad" class="text-sm font-bold text-gray-800">
                        {{ $esPublico ? 'Perfil público' : 'Perfil privado' }}
                    </p>
                    <p id="desc-visibilidad" class="text-xs text-gray-500 mt-0.5">
                        {{ $esPublico ? 'Cualquier persona puede ver tu portafolio' : 'Solo tú puedes ver tu portafolio' }}
                    </p>
                    <span id="badge-visibilidad"
                          class="inline-flex items-center gap-1.5 mt-2 text-xs font-semibold px-2.5 py-1 rounded-full
                                 {{ $esPublico ? 'bg-[#1e3a5f]/10 text-[#1e3a5f]' : 'bg-gray-200 text-gray-600' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $esPublico ? 'bg-[#1e3a5f]' : 'bg-gray-500' }}"></span>
                        {{ $esPublico ? 'Público' : 'Privado' }}
                    </span>
                </div>
            </div>

            {{-- Acciones: Publicar / Actualizar / Ocultar --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">

                {{-- Publicar (privado → público) --}}
                <button type="button" id="card-publicar" onclick="accionPublicar()"
                        data-disabled="{{ $esPublico ? '1' : '0' }}"
                        class="group relative overflow-hidden rounded-2xl p-5 text-center text-white transition-all duration-200
                               bg-[#1e3a5f] hover:bg-[#16314f] shadow-md hover:shadow-lg
                               {{ $esPublico ? 'opacity-40 cursor-not-allowed pointer-events-none' : '' }}">
                    <div class="w-11 h-11 mx-auto rounded-xl bg-white/15 flex items-center justify-center mb-3">
                        <i class="fas fa-upload"></i>
                    </div>
                    <p class="font-bold text-sm">Publicar</p>
                    <p class="text-[11px] text-white/70 mt-0.5">Hacer visible</p>
                </button>

                {{-- Actualizar (re-abrir modal) --}}
                <button type="button" id="card-actualizar" onclick="accionActualizar()"
                        data-disabled="{{ $esPublico ? '0' : '1' }}"
                        class="group relative overflow-hidden rounded-2xl p-5 text-center text-white transition-all duration-200
                               bg-gradient-to-br from-[#1e3a5f] to-[#e11d48] hover:opacity-95 shadow-md hover:shadow-lg
                               {{ !$esPublico ? 'opacity-40 cursor-not-allowed pointer-events-none' : '' }}">
                    <div class="w-11 h-11 mx-auto rounded-xl bg-white/20 flex items-center justify-center mb-3">
                        <i class="fas fa-arrows-rotate"></i>
                    </div>
                    <p class="font-bold text-sm">Actualizar</p>
                    <p class="text-[11px] text-white/80 mt-0.5">Sincronizar</p>
                </button>

                {{-- Ocultar (público → privado) --}}
                <button type="button" id="card-ocultar" onclick="accionOcultar()"
                        data-disabled="{{ $esPublico ? '0' : '1' }}"
                        class="group relative overflow-hidden rounded-2xl p-5 text-center text-white transition-all duration-200
                               bg-gray-800 hover:bg-gray-900 shadow-md hover:shadow-lg
                               {{ !$esPublico ? 'opacity-40 cursor-not-allowed pointer-events-none' : '' }}">
                    <div class="w-11 h-11 mx-auto rounded-xl bg-white/15 flex items-center justify-center mb-3">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    <p class="font-bold text-sm">Ocultar</p>
                    <p class="text-[11px] text-white/70 mt-0.5">Privado</p>
                </button>

            </div>

        </div>
    </main>
</div>

<script>
(function () {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    // ── Refrescar UI de estado y acciones según visibilidad ────────────────
    function actualizarUIVisibilidad(estado) {
        const esPublico = estado === 'publico';
        const wrap   = document.getElementById('estado-visibilidad');
        const iconWrap = document.getElementById('estado-icono-wrap');
        const icon   = document.getElementById('estado-icono');
        const label  = document.getElementById('label-visibilidad');
        const desc   = document.getElementById('desc-visibilidad');
        const badge  = document.getElementById('badge-visibilidad');
        const publi  = document.getElementById('card-publicar');
        const actu   = document.getElementById('card-actualizar');
        const ocul   = document.getElementById('card-ocultar');

        if (wrap) {
            wrap.className = 'flex items-center gap-4 rounded-xl px-4 py-4 mb-5 border ' +
                (esPublico ? 'bg-[#1e3a5f]/5 border-[#1e3a5f]/20' : 'bg-gray-50 border-gray-200');
        }
        if (iconWrap) {
            iconWrap.className = 'w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 ' +
                (esPublico ? 'bg-[#1e3a5f]' : 'bg-gray-400');
        }
        if (icon) {
            icon.className = 'fas text-white ' + (esPublico ? 'fa-globe' : 'fa-lock');
        }
        if (label) label.textContent = esPublico ? 'Perfil público' : 'Perfil privado';
        if (desc)  desc.textContent  = esPublico ? 'Cualquier persona puede ver tu portafolio' : 'Solo tú puedes ver tu portafolio';
        if (badge) {
            badge.className = 'inline-flex items-center gap-1.5 mt-2 text-xs font-semibold px-2.5 py-1 rounded-full ' +
                (esPublico ? 'bg-[#1e3a5f]/10 text-[#1e3a5f]' : 'bg-gray-200 text-gray-600');
            badge.innerHTML =
                '<span class="w-1.5 h-1.5 rounded-full ' + (esPublico ? 'bg-[#1e3a5f]' : 'bg-gray-500') + '"></span>' +
                (esPublico ? 'Público' : 'Privado');
        }

        const setEnabled = (btn, enabled) => {
            if (!btn) return;
            btn.dataset.disabled = enabled ? '0' : '1';
            btn.classList.toggle('opacity-40', !enabled);
            btn.classList.toggle('cursor-not-allowed', !enabled);
            btn.classList.toggle('pointer-events-none', !enabled);
        };
        setEnabled(publi, !esPublico);
        setEnabled(actu,   esPublico);
        setEnabled(ocul,   esPublico);

        // El aviso de "elementos sin publicar" solo tiene sentido en público.
        // (En público, modal_publicar_scripts decide si mostrarlo según el conteo.)
        if (!esPublico) {
            const aviso = document.getElementById('aviso-sin-publicar');
            if (aviso) {
                aviso.classList.add('hidden');
                aviso.classList.remove('flex');
            }
        }

        window.PERFIL_VISIBILIDAD = estado;
    }

    // ── Mantener compatibilidad con _modal_publicar_scripts ───────────────
    window.aplicarVisibilidadPublica = function () {
        actualizarUIVisibilidad('publico');
    };

    // ── Acciones ──────────────────────────────────────────────────────────
    window.editarPublicacion = function () {
        if (typeof window.abrirModalPublicar === 'function') window.abrirModalPublicar();
    };

    window.accionPublicar = function () {
        if (typeof window.abrirModalPublicar === 'function') window.abrirModalPublicar();
    };

    window.accionActualizar = function () {
        if (typeof window.abrirModalPublicar === 'function') window.abrirModalPublicar();
    };

    window.accionOcultar = function () {
        window.confirmar({
            tipo: 'primary',
            titulo: '¿Ocultar tu portafolio?',
            mensaje: 'Tu portafolio dejará de ser visible para otros usuarios.',
            textoConfirmar: 'Sí, ocultar',
            textoCancelar: 'Cancelar',
            onConfirm: function () {
                fetch('{{ route("cuenta.visibilidad") }}', {
                    method: 'PUT',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ visibilidad: 'privado' })
                })
                .then(r => r.json())
                .then(res => {
                    if (res.ok) {
                        actualizarUIVisibilidad('privado');
                        window.confirmar({
                            tipo: 'success',
                            titulo: '¡Listo!',
                            mensaje: 'Tu portafolio ahora es privado.',
                            ocultarBotones: true,
                            autoCerrarMs: 2000
                        });
                    } else {
                        window.confirmar({
                            tipo: 'danger',
                            titulo: 'Error',
                            mensaje: res.message ?? 'No se pudo cambiar la visibilidad.',
                            soloConfirmar: true,
                            textoConfirmar: 'Entendido'
                        });
                    }
                })
                .catch(() => window.confirmar({
                    tipo: 'danger',
                    titulo: 'Error de conexión',
                    mensaje: 'No se pudo conectar al servidor.',
                    soloConfirmar: true,
                    textoConfirmar: 'Entendido'
                }));
            }
        });
    };
})();
</script>

@include('gestionarCuenta._modal_publicar')
@include('home._modal_portafolio_publico')
