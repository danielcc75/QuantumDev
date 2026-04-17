{{-- resources/views/gestionHabilidades/index.blade.php
     Punto de entrada de la sección Mis Habilidades.
     Carga datos y orquesta los sub-componentes. --}}

@php
    $totalHab      = $habilidades->count();
    $categoriasHab = $habilidades->pluck('id_categoria')->unique()->count();
    $promedioAnios = $totalHab > 0
        ? round($habilidades->avg('anios_experiencia'), 1)
        : 0;
@endphp

<div class="w-full">
    <main class="p-4 sm:p-6 lg:p-8">

        {{-- Encabezado --}}
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6 md:mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#1e3a5f]">Mis Habilidades</h2>
                <p class="text-sm text-gray-500 mt-1">Administra tus habilidades técnicas y controla lo que muestras al mundo</p>
                <div class="mt-2 h-1 w-16 rounded-full bg-[#e11d48]"></div>
            </div>
            <button id="agregar-habilidad-btn"
                class="inline-flex items-center justify-center gap-2 bg-[#1e3a5f] hover:bg-[#e11d48] text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors duration-200 self-start sm:self-auto">
                <i class="fas fa-plus text-xs"></i> Nueva Habilidad
            </button>
        </div>

        {{-- Estadísticas --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-5 mb-6 md:mb-8">

            {{-- Total --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 border-l-4 border-l-[#1e3a5f]">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-sm text-gray-500 font-medium">Total Habilidades</p>
                    <div class="w-9 h-9 rounded-xl bg-[#1e3a5f]/8 flex items-center justify-center">
                        <i class="fas fa-code text-[#1e3a5f] text-sm"></i>
                    </div>
                </div>
                <p id="stat-hab-total" class="text-4xl font-bold text-[#1e3a5f]">{{ $totalHab }}</p>
                <p class="text-xs text-gray-400 mt-1">Todas las registradas</p>
            </div>

            {{-- Categorías --}}
            <div class="bg-[#1e3a5f]/5 rounded-2xl border border-[#1e3a5f]/15 shadow-sm p-6 border-l-4 border-l-[#1e3a5f]">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-sm text-[#1e3a5f] font-semibold">Categorías</p>
                    <div class="w-9 h-9 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center">
                        <i class="fas fa-layer-group text-[#1e3a5f] text-sm"></i>
                    </div>
                </div>
                <p id="stat-hab-categorias" class="text-4xl font-bold text-[#1e3a5f]">{{ $categoriasHab }}</p>
                <p class="text-xs text-[#1e3a5f]/60 mt-1">Distintas áreas cubiertas</p>
            </div>

            {{-- Promedio --}}
            <div class="bg-red-50 rounded-2xl border border-red-100 shadow-sm p-6 border-l-4 border-l-[#e11d48]">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-sm text-[#e11d48] font-semibold">Promedio Años</p>
                    <div class="w-9 h-9 rounded-xl bg-[#e11d48]/10 flex items-center justify-center">
                        <i class="fas fa-chart-line text-[#e11d48] text-sm"></i>
                    </div>
                </div>
                <p id="stat-hab-promedio" class="text-4xl font-bold text-[#1e3a5f]">{{ $promedioAnios }}</p>
                <p class="text-xs text-[#e11d48]/70 mt-1">Años de experiencia promedio</p>
            </div>

        </div>

        {{-- Estado vacío --}}
        <div id="empty-state-hab" class="{{ $habilidades->isEmpty() ? '' : 'hidden' }} bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
            <div class="w-16 h-16 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-code text-3xl text-[#1e3a5f]/40"></i>
            </div>
            <p class="text-gray-600 font-semibold">No tienes habilidades registradas aún</p>
            <p class="text-xs text-gray-400 mt-1 mb-4">Comienza agregando tu primera habilidad técnica</p>
            <button id="agregar-habilidad-btn-empty"
                class="inline-flex items-center gap-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white px-4 py-2 rounded-lg transition-colors duration-200 font-medium">
                <i class="fas fa-plus text-xs"></i> Agregar primera habilidad
            </button>
        </div>

        {{-- Grid de tarjetas --}}
        <div id="habilidades-lista" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 {{ $habilidades->isEmpty() ? 'hidden' : '' }}">
            @foreach($habilidades as $habilidad)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-md p-5 flex flex-col gap-2
                        border-l-4 border-l-[#1e3a5f] hover:-translate-y-1 hover:shadow-xl transition-all duration-200"
                 data-habilidad-id="{{ $habilidad->id_habilidad }}"
                 data-categoria-id="{{ $habilidad->id_categoria }}">

                {{-- Icono de categoría --}}
                <div class="flex justify-center mb-1">
                    <img src="{{ $habilidad->categoria->imagen ?? 'https://via.placeholder.com/100' }}"
                         alt="{{ $habilidad->categoria->nombre }}"
                         class="h-14 w-14 rounded-full object-cover border-2 border-[#1e3a5f]/10">
                </div>

                {{-- Nombre + categoría --}}
                <div class="text-center">
                    <h3 class="font-semibold text-[#1e3a5f] text-sm leading-snug">{{ $habilidad->nombre }}</h3>
                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-[#1e3a5f]/10 text-[#1e3a5f] whitespace-nowrap">
                        {{ $habilidad->categoria->nombre }}
                    </span>
                </div>

                {{-- Años de experiencia --}}
                <div class="flex items-center justify-center text-xs text-gray-400 gap-1.5">
                    <i class="fas fa-calendar-alt text-[#1e3a5f]/50"></i>
                    <span>{{ $habilidad->anios_experiencia }} {{ $habilidad->anios_experiencia == 1 ? 'año' : 'años' }} de experiencia</span>
                </div>

                {{-- Descripción --}}
                @if($habilidad->descripcion)
                <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 text-center">{{ $habilidad->descripcion }}</p>
                @endif

                {{-- Acciones --}}
                <div class="flex gap-2 pt-2 border-t border-gray-100 mt-auto">
                    <button class="editar-habilidad flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition"
                        data-id="{{ $habilidad->id_habilidad }}"
                        data-nombre="{{ $habilidad->nombre }}"
                        data-categoria="{{ $habilidad->id_categoria }}"
                        data-experiencia="{{ $habilidad->anios_experiencia }}"
                        data-descripcion="{{ $habilidad->descripcion }}">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                    <form id="delete-hab-{{ $habilidad->id_habilidad }}"
                          action="{{ route('habilidades.destroy', $habilidad->id_habilidad) }}"
                          method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            onclick="confirmarEliminarHabilidad({{ $habilidad->id_habilidad }})"
                            class="w-full flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>

            </div>
            @endforeach
        </div>

    </main>
</div>

{{-- Modal crear / editar --}}
<div id="modal-habilidades"
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4"
    onclick="cerrarModalHabilidadFondo(event)">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">

        <div class="bg-[#1e3a5f] text-white px-6 py-4 flex items-center justify-between rounded-t-2xl sticky top-0 z-10">
            <div>
                <h3 id="titulo-modal-habilidad" class="text-lg font-bold">Registrar Habilidad</h3>
                <p class="text-blue-200 text-xs mt-0.5">Completa los detalles de tu habilidad</p>
            </div>
            <button type="button" onclick="confirmarCancelarHabilidad()" class="text-white hover:text-blue-200 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <div class="p-6">
            @include('gestionHabilidades.Habilidades', ['categorias' => $categorias])
        </div>

    </div>
</div>

{{-- Modal de Confirmación --}}
<div id="modalConfirmacionHabilidad" class="fixed inset-0 bg-black bg-opacity-60 z-[60] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
        <div class="p-6 text-center">
            <div id="confirmIconWrapperHabilidad" class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i id="confirmIconHabilidad" class="text-2xl"></i>
            </div>
            <h4 id="confirmTituloHabilidad" class="text-lg font-bold text-gray-800 mb-2"></h4>
            <p id="confirmMensajeHabilidad" class="text-sm text-gray-500 leading-relaxed"></p>
        </div>
        <div class="flex gap-3 px-6 pb-6">
            <button type="button" onclick="cerrarConfirmacionHabilidad()"
                class="flex-1 px-4 py-2.5 text-sm border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition font-medium">
                No, cancelar
            </button>
            <button type="button" id="confirmBtnHabilidad"
                class="flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition">
                Confirmar
            </button>
        </div>
    </div>
</div>

{{-- Scripts de habilidades --}}
<script>
(function () {

    // ============================================================
    // CONFIGURACIÓN DE CONFIRMACIONES
    // ============================================================
    const CONFIRM_CONFIG_HAB = {
        guardar: {
            titulo:    '¿Guardar habilidad?',
            mensaje:   'Se almacenará la información de tu habilidad. Podrás editarla en cualquier momento.',
            icon:      'fas fa-save',
            iconBg:    'bg-blue-50',
            iconColor: 'text-blue-500',
            btnClass:  'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90',
            accion:    () => submitHabilidad(),
        },
        cancelar: {
            titulo:    '¿Descartar cambios?',
            mensaje:   'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.',
            icon:      'fas fa-times-circle',
            iconBg:    'bg-yellow-50',
            iconColor: 'text-yellow-500',
            btnClass:  'bg-yellow-500 hover:bg-yellow-600',
            accion:    () => cerrarModalHabilidad(),
        },
        eliminar: {
            titulo:    '¿Eliminar habilidad?',
            mensaje:   'Esta acción es permanente y no se puede deshacer. La habilidad será eliminada definitivamente.',
            icon:      'fas fa-trash-alt',
            iconBg:    'bg-red-50',
            iconColor: 'text-red-500',
            btnClass:  'bg-[#e11d48] hover:bg-red-600',
            accion:    null,
        },
    };

    // ============================================================
    // MODAL DE CONFIRMACIÓN
    // ============================================================
    function mostrarConfirmacionHabilidad(tipo) {
        const cfg = CONFIRM_CONFIG_HAB[tipo];
        document.getElementById('confirmTituloHabilidad').textContent  = cfg.titulo;
        document.getElementById('confirmMensajeHabilidad').textContent = cfg.mensaje;

        const wrapper = document.getElementById('confirmIconWrapperHabilidad');
        wrapper.className = `w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 ${cfg.iconBg}`;

        const icon = document.getElementById('confirmIconHabilidad');
        icon.className = `${cfg.icon} text-2xl ${cfg.iconColor}`;

        const btn = document.getElementById('confirmBtnHabilidad');
        btn.className = `flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition ${cfg.btnClass}`;
        btn.onclick = () => { cerrarConfirmacionHabilidad(); cfg.accion(); };

        document.getElementById('modalConfirmacionHabilidad').classList.remove('hidden');
        document.getElementById('modalConfirmacionHabilidad').classList.add('flex');
    }

    window.cerrarConfirmacionHabilidad = function () {
        document.getElementById('modalConfirmacionHabilidad').classList.add('hidden');
        document.getElementById('modalConfirmacionHabilidad').classList.remove('flex');
    };

    document.getElementById('modalConfirmacionHabilidad')?.addEventListener('click', function (e) {
        if (e.target === this) cerrarConfirmacionHabilidad();
    });

    // ============================================================
    // RESALTAR ERROR
    // ============================================================
    function resaltarErrorHabilidad(campoId, mensaje) {
        const el = document.getElementById(campoId);
        if (!el) return;
        el.classList.add('border-red-400', 'ring-2', 'ring-red-300');
        el.focus();
        setTimeout(() => el.classList.remove('border-red-400', 'ring-2', 'ring-red-300'), 2500);

        const prev = el.parentElement.querySelector('.error-msg-hab');
        if (prev) prev.remove();

        const msg = document.createElement('p');
        msg.className = 'error-msg-hab text-xs text-red-500 mt-1';
        msg.textContent = mensaje;
        el.parentElement.appendChild(msg);
        setTimeout(() => msg.remove(), 2500);
    }

    // ============================================================
    // RECALCULAR ESTADÍSTICAS
    // ============================================================
    function recalcularStatsHabilidad() {
        const lista = document.getElementById('habilidades-lista');
        if (!lista) return;

        const cards = lista.querySelectorAll('[data-habilidad-id]');
        const total = cards.length;

        const categorias = new Set();
        cards.forEach(c => {
            const catId = c.getAttribute('data-categoria-id');
            if (catId) categorias.add(catId);
        });

        const elTotal     = document.getElementById('stat-hab-total');
        const elCategorias = document.getElementById('stat-hab-categorias');
        if (elTotal)      elTotal.textContent      = total;
        if (elCategorias) elCategorias.textContent = categorias.size;

        const emptyState = document.getElementById('empty-state-hab');
        if (emptyState) emptyState.classList.toggle('hidden', total > 0);
        lista.classList.toggle('hidden', total === 0);
    }

    // ============================================================
    // ABRIR / CERRAR MODAL
    // ============================================================
    function abrirModalHabilidad() {
        const form        = document.getElementById('formHabilidad');
        const tituloModal = document.getElementById('titulo-modal-habilidad');

        tituloModal.textContent = 'Registrar Habilidad';
        form.reset();
        form.querySelector('[name="nombreHabilidad"]').value = '';
        form.querySelector('[name="categoria"]').value       = '';
        form.querySelector('[name="anosExperiencia"]').value = '';
        form.querySelector('[name="descripcion"]').value     = '';

        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();

        form.action = "{{ route('habilidades.store') }}";

        document.getElementById('modal-habilidades').classList.remove('hidden');
        document.getElementById('modal-habilidades').classList.add('flex');
    }

    window.cerrarModalHabilidad = function () {
        document.getElementById('modal-habilidades').classList.add('hidden');
        document.getElementById('modal-habilidades').classList.remove('flex');
    };

    window.cerrarModalHabilidadFondo = function (event) {
        if (event.target.id === 'modal-habilidades') confirmarCancelarHabilidad();
    };

    // ============================================================
    // CONFIRMAR GUARDAR (VALIDACIÓN)
    // ============================================================
    window.confirmarGuardarHabilidad = function () {
        const nombre      = document.getElementById('hab_nombre').value.trim();
        const categoria   = document.getElementById('hab_categoria').value;
        const anios       = document.getElementById('hab_anios').value;
        const descripcion = document.getElementById('hab_descripcion').value.trim();

        if (!nombre)      { resaltarErrorHabilidad('hab_nombre',      'El nombre es obligatorio.');         return; }
        if (!categoria)   { resaltarErrorHabilidad('hab_categoria',   'La categoría es obligatoria.');      return; }
        if (anios === '') { resaltarErrorHabilidad('hab_anios',       'Los años de experiencia son obligatorios.'); return; }
        if (parseInt(anios) < 0) { resaltarErrorHabilidad('hab_anios', 'Los años no pueden ser negativos.'); return; }
        if (!descripcion) { resaltarErrorHabilidad('hab_descripcion', 'La descripción es obligatoria.');    return; }
        if (descripcion.length < 20) { resaltarErrorHabilidad('hab_descripcion', 'La descripción debe tener al menos 20 caracteres.'); return; }

        mostrarConfirmacionHabilidad('guardar');
    };

    // ============================================================
    // CONFIRMAR CANCELAR (DIRTY CHECK)
    // ============================================================
    window.confirmarCancelarHabilidad = function () {
        const nombre      = document.getElementById('hab_nombre')?.value.trim();
        const descripcion = document.getElementById('hab_descripcion')?.value.trim();
        if (nombre || descripcion) {
            mostrarConfirmacionHabilidad('cancelar');
        } else {
            cerrarModalHabilidad();
        }
    };

    // ============================================================
    // SUBMIT FORMULARIO
    // ============================================================
    function submitHabilidad() {
        document.getElementById('formHabilidad').submit();
    }

    // ============================================================
    // CONFIRMAR ELIMINAR
    // ============================================================
    window.confirmarEliminarHabilidad = function (id) {
        CONFIRM_CONFIG_HAB.eliminar.accion = () => {
            document.getElementById(`delete-hab-${id}`).submit();
        };
        mostrarConfirmacionHabilidad('eliminar');
    };

    // ============================================================
    // EDITAR HABILIDAD
    // ============================================================
    document.querySelectorAll('.editar-habilidad').forEach(btn => {
        btn.addEventListener('click', () => {
            const id          = btn.getAttribute('data-id');
            const nombre      = btn.getAttribute('data-nombre');
            const categoria   = btn.getAttribute('data-categoria');
            const experiencia = btn.getAttribute('data-experiencia');
            const descripcion = btn.getAttribute('data-descripcion');

            const form        = document.getElementById('formHabilidad');
            const tituloModal = document.getElementById('titulo-modal-habilidad');

            tituloModal.textContent = 'Editar Habilidad';

            form.querySelector('[name="nombreHabilidad"]').value = nombre;
            form.querySelector('[name="categoria"]').value       = categoria;
            form.querySelector('[name="anosExperiencia"]').value = experiencia;
            form.querySelector('[name="descripcion"]').value     = descripcion;

            form.action = `/habilidades/${id}`;

            let methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.value = 'PUT';
            } else {
                methodInput = document.createElement('input');
                methodInput.setAttribute('type', 'hidden');
                methodInput.setAttribute('name', '_method');
                methodInput.setAttribute('value', 'PUT');
                form.appendChild(methodInput);
            }

            document.getElementById('modal-habilidades').classList.remove('hidden');
            document.getElementById('modal-habilidades').classList.add('flex');
        });
    });

    // ============================================================
    // BOTONES DE APERTURA
    // ============================================================
    const btnAgregar      = document.getElementById('agregar-habilidad-btn');
    const btnAgregarEmpty = document.getElementById('agregar-habilidad-btn-empty');

    if (btnAgregar)      btnAgregar.addEventListener('click', abrirModalHabilidad);
    if (btnAgregarEmpty) btnAgregarEmpty.addEventListener('click', abrirModalHabilidad);

})();
</script>
