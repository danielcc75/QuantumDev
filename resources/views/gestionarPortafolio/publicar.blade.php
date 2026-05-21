{{-- resources/views/gestionarPortafolio/publicar.blade.php
     Flujo completo de publicación del portafolio (migrado desde gestionarCuenta). --}}

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
@endphp

<div class="w-full">
    <main class="p-4 sm:p-6 lg:p-8">

        {{-- Encabezado --}}
        <div class="mb-6 md:mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-[#1e3a5f]">Publicar Portafolio</h2>
            <p class="text-sm text-gray-500 mt-1">Controla la visibilidad de tu portafolio y publica el contenido que quieres mostrar</p>
            <div class="mt-2 h-1 w-16 rounded-full bg-[#e11d48]"></div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6">

            {{-- ── Visibilidad del perfil ───────────────────────────────────── --}}
            <div class="border border-gray-100 rounded-xl p-5">
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-lg bg-[#1e3a5f]/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-eye text-[#1e3a5f] text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 text-sm">Visibilidad del perfil</h3>
                        <p class="text-xs text-gray-400">Controla quién puede ver tu portafolio</p>
                    </div>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-700" id="label-visibilidad">
                            {{ $visibilidad === 'publico' ? 'Perfil público' : 'Perfil privado' }}
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5" id="desc-visibilidad">
                            {{ $visibilidad === 'publico'
                                ? 'Cualquier persona puede ver tu portafolio'
                                : 'Solo tú puedes ver tu portafolio' }}
                        </p>
                    </div>
                    <button type="button" id="btn-visibilidad"
                        onclick="confirmarCambiarVisibilidad()"
                        data-actual="{{ $visibilidad }}"
                        class="relative inline-flex h-7 w-14 flex-shrink-0 items-center rounded-full transition-colors duration-300
                               {{ $visibilidad === 'publico' ? 'bg-[#1e3a5f]' : 'bg-gray-300' }}">
                        <span id="toggle-dot"
                            class="inline-block h-5 w-5 transform rounded-full bg-white shadow transition-transform duration-300
                                   {{ $visibilidad === 'publico' ? 'translate-x-8' : 'translate-x-1' }}">
                        </span>
                    </button>
                </div>
                <div class="mt-3">
                    <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full
                        {{ $visibilidad === 'publico' ? 'bg-[#1e3a5f]/10 text-[#1e3a5f]' : 'bg-gray-100 text-gray-500' }}"
                        id="badge-visibilidad">
                        <i class="fas {{ $visibilidad === 'publico' ? 'fa-globe' : 'fa-lock' }} text-[10px]"></i>
                        {{ $visibilidad === 'publico' ? 'Público' : 'Privado' }}
                    </span>
                </div>

                {{-- Aviso de elementos sin publicar --}}
                <div id="aviso-sin-publicar"
                     class="{{ ($visibilidad === 'publico' && $itemsSinPublicar > 0) ? 'flex' : 'hidden' }} mt-4 items-center gap-3 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-circle-info text-amber-600 text-sm"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-amber-900">
                            Tienes <span id="aviso-sin-publicar-count">{{ $itemsSinPublicar }}</span> elemento(s) sin publicar
                        </p>
                        <p class="text-xs text-amber-700 mt-0.5">Actualiza tu publicación para mostrarlos en tu portafolio público.</p>
                    </div>
                    <button type="button" onclick="editarPublicacion()"
                        class="text-xs font-semibold text-amber-900 hover:text-amber-700 underline flex-shrink-0">
                        Actualizar publicación
                    </button>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
(function () {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    // ── Aplicar UI público ─────────────────────────────────────────────────
    window.aplicarVisibilidadPublica = function () {
        const btn   = document.getElementById('btn-visibilidad');
        const dot   = document.getElementById('toggle-dot');
        const label = document.getElementById('label-visibilidad');
        const desc  = document.getElementById('desc-visibilidad');
        const badge = document.getElementById('badge-visibilidad');
        btn.dataset.actual = 'publico';
        btn.classList.replace('bg-gray-300', 'bg-[#1e3a5f]');
        dot.classList.replace('translate-x-1', 'translate-x-8');
        label.textContent = 'Perfil público';
        desc.textContent  = 'Cualquier persona puede ver tu portafolio';
        badge.className   = 'inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-[#1e3a5f]/10 text-[#1e3a5f]';
        badge.innerHTML   = '<i class="fas fa-globe text-[10px]"></i> Público';
        window.PERFIL_VISIBILIDAD = 'publico';
    };

    // ── Editar publicación (re-abrir modal cuando ya está público) ─────────
    window.editarPublicacion = function () {
        if (typeof window.abrirModalPublicar === 'function') {
            window.abrirModalPublicar();
        }
    };

    // ── Visibilidad ────────────────────────────────────────────────────────
    window.confirmarCambiarVisibilidad = function () {
        const btn    = document.getElementById('btn-visibilidad');
        const actual = btn.dataset.actual;

        if (actual === 'publico') {
            Swal.fire({
                title: 'Tu portafolio está público',
                text:  '¿Qué deseas hacer?',
                icon:  'question',
                showCancelButton: true,
                showDenyButton:   true,
                confirmButtonColor: '#1e3a5f',
                denyButtonColor:    '#e11d48',
                cancelButtonColor:  '#6b7280',
                confirmButtonText:  'Editar publicación',
                denyButtonText:     'Hacer privado',
                cancelButtonText:   'Cancelar'
            }).then(result => {
                if (result.isConfirmed) {
                    window.editarPublicacion();
                } else if (result.isDenied) {
                    cambiarVisibilidadAPrivado();
                }
            });
            return;
        }

        if (typeof window.abrirModalPublicar === 'function') {
            window.abrirModalPublicar();
        }
    };

    function cambiarVisibilidadAPrivado() {
        const btn = document.getElementById('btn-visibilidad');
        Swal.fire({
            title: '¿Hacer perfil privado?',
            text: 'Solo tú podrás ver tu portafolio.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3a5f',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, hacer privado',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch('{{ route("cuenta.visibilidad") }}', {
                method: 'PUT',
                headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ visibilidad: 'privado' })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    const dot   = document.getElementById('toggle-dot');
                    const label = document.getElementById('label-visibilidad');
                    const desc  = document.getElementById('desc-visibilidad');
                    const badge = document.getElementById('badge-visibilidad');
                    btn.dataset.actual = 'privado';
                    btn.classList.replace('bg-[#1e3a5f]', 'bg-gray-300');
                    dot.classList.replace('translate-x-8', 'translate-x-1');
                    label.textContent = 'Perfil privado';
                    desc.textContent  = 'Solo tú puedes ver tu portafolio';
                    badge.className   = 'inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-500';
                    badge.innerHTML   = '<i class="fas fa-lock text-[10px]"></i> Privado';
                    window.PERFIL_VISIBILIDAD = 'privado';

                    Swal.fire({ icon: 'success', title: '¡Listo!', text: 'Tu perfil ahora es privado.', confirmButtonColor: '#1e3a5f', timer: 2000, showConfirmButton: false });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: res.message ?? 'No se pudo cambiar la visibilidad.', confirmButtonColor: '#1e3a5f' });
                }
            })
            .catch(() => Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar al servidor.', confirmButtonColor: '#1e3a5f' }));
        });
    }
})();
</script>

@include('gestionarCuenta._modal_publicar')
@include('home._modal_portafolio_publico')
