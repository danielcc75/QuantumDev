<script>
(function () {

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
            iconBg:    'bg-red-50',
            iconColor: 'text-red-500',
            btnClass:  'bg-red-500 hover:bg-red-600',
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

    function mostrarConfirmacionHabilidad(tipo) {
        const cfg = CONFIRM_CONFIG_HAB[tipo];
        if (!cfg) return;
        window.confirmar({
            titulo:    cfg.titulo,
            mensaje:   cfg.mensaje,
            icon:      cfg.icon,
            iconBg:    cfg.iconBg,
            iconColor: cfg.iconColor,
            btnClass:  cfg.btnClass,
            onConfirm: cfg.accion,
        });
    }
    window.mostrarConfirmacionHabilidad = mostrarConfirmacionHabilidad;

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

        const elTotal      = document.getElementById('stat-hab-total');
        const elCategorias = document.getElementById('stat-hab-categorias');
        if (elTotal)      elTotal.textContent      = total;
        if (elCategorias) elCategorias.textContent = categorias.size;

        const emptyState = document.getElementById('empty-state-hab');
        if (emptyState) emptyState.classList.toggle('hidden', total > 0);
        lista.classList.toggle('hidden', total === 0);
    }

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

    window.confirmarCancelarHabilidad = function () {
        const nombre      = document.getElementById('hab_nombre')?.value.trim();
        const descripcion = document.getElementById('hab_descripcion')?.value.trim();
        if (nombre || descripcion) {
            mostrarConfirmacionHabilidad('cancelar');
        } else {
            cerrarModalHabilidad();
        }
    };

    function submitHabilidad() {
        document.getElementById('formHabilidad').submit();
    }

    window.confirmarEliminarHabilidad = function (id) {
        CONFIRM_CONFIG_HAB.eliminar.accion = () => {
            document.getElementById(`delete-hab-${id}`).submit();
        };
        mostrarConfirmacionHabilidad('eliminar');
    };

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

    const btnAgregar      = document.getElementById('agregar-habilidad-btn');
    const btnAgregarEmpty = document.getElementById('agregar-habilidad-btn-empty');

    if (btnAgregar)      btnAgregar.addEventListener('click', abrirModalHabilidad);
    if (btnAgregarEmpty) btnAgregarEmpty.addEventListener('click', abrirModalHabilidad);

})();
</script>
