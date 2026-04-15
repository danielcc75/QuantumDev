{{-- resources/views/gestionarPerfil/modal-experiencia.blade.php --}}

<div id="modalExperiencia" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4" onclick="cerrarModalExperienciaFondo(event)">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">

        {{-- Header --}}
        <div class="bg-[#1e3a5f] text-white px-6 py-4 flex items-center justify-between rounded-t-2xl sticky top-0 z-10">
            <div>
                <h3 id="modalExperienciaTitulo" class="text-lg font-bold">Agregar Experiencia Laboral</h3>
                <p class="text-blue-200 text-xs mt-0.5">Completa los detalles de tu experiencia</p>
            </div>
            <button type="button" onclick="confirmarCancelarExperiencia()" class="text-white hover:text-blue-200 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        {{-- Body --}}
        <form id="formExperiencia" class="p-6">
            @csrf
            <input type="hidden" id="exp_id_experiencia" name="id_experiencia">

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Cargo <span class="text-red-500">*</span>
                </label>
                <input type="text" id="exp_cargo" name="cargo"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Ej: Desarrollador Full Stack">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Empresa <span class="text-red-500">*</span>
                </label>
                <input type="text" id="exp_empresa" name="empresa"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Ej: Google, Microsoft, Startup X">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        Fecha Inicio <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="exp_fecha_ini" name="fecha_ini"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div id="exp_fecha_fin_container">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Fecha Fin</label>
                    <input type="date" id="exp_fecha_fin" name="fecha_fin"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div class="mb-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="exp_trabajo_actual" name="trabajo_actual" class="w-4 h-4 text-blue-500 rounded">
                    <span class="text-sm text-gray-700">Trabajo actualmente aquí</span>
                </label>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="exp_descripcion" name="descripcion" rows="4"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                    placeholder="Describe tus responsabilidades y logros..."></textarea>
            </div>

            {{-- Sección obligatoria: agregar proyecto --}}
            <div id="exp_proyecto_wrapper" class="border-t border-gray-100 pt-4 mt-2">
                <p class="text-sm font-medium text-[#1e3a5f] mb-3">
                    <i class="fas fa-folder-plus text-xs mr-1"></i> Proyecto vinculado <span class="text-red-500">*</span>
                </p>

                <div id="exp_proyecto_form" class="bg-[#1e3a5f]/5 border border-[#1e3a5f]/15 rounded-xl p-4 flex flex-col gap-3">
                    <p class="text-xs text-gray-500">El proyecto quedará vinculado a esta experiencia y también aparecerá en <strong>Mis Proyectos</strong>.</p>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Nombre del Proyecto <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="exp_proj_nombre"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Ej: Sistema de Gestión Interna">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea id="exp_proj_descripcion" rows="2"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                            placeholder="Breve descripción del proyecto..."></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">
                                Fecha Inicio <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="exp_proj_fecha_ini"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Fecha Fin</label>
                            <input type="date" id="exp_proj_fecha_fin" onchange="verificarFechaFinProyectoExp()"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>

                    {{-- Enlace obligatorio si el proyecto ya finalizó --}}
                    <div id="exp_proj_url_wrapper" class="hidden">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Enlace del Proyecto <span class="text-red-500">*</span>
                            <span class="text-gray-400 font-normal">(obligatorio porque el proyecto ya finalizó)</span>
                        </label>
                        <input type="url" id="exp_proj_url_link"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="https://proyecto-cliente.com">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Tecnologías</label>

                        {{-- Selector de categoría --}}
                        <div class="relative mb-2">
                            <select id="exp_categoria_select" onchange="filtrarTecnologiasExp()"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 appearance-none bg-white pr-8 text-gray-500">
                                <option value="">Selecciona una categoría</option>
                                <option value="Frontend">Frontend</option>
                                <option value="Backend">Backend</option>
                                <option value="Lenguajes">Lenguajes</option>
                                <option value="Bases de Datos">Bases de Datos</option>
                                <option value="Cloud & DevOps">Cloud &amp; DevOps</option>
                                <option value="Mobile">Mobile</option>
                                <option value="APIs & Real-time">APIs &amp; Real-time</option>
                                <option value="Testing">Testing</option>
                                <option value="Data Science & ML">Data Science &amp; ML</option>
                                <option value="Diseño & Prototipado">Diseño &amp; Prototipado</option>
                                <option value="Gestión de Proyectos">Gestión de Proyectos</option>
                            </select>
                            <i class="fas fa-chevron-down text-gray-400 text-xs absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                        </div>

                        {{-- Chips de tecnologías disponibles --}}
                        <div id="exp_chips_container" class="hidden mb-2">
                            <div id="exp_chips" class="flex flex-wrap gap-1.5 max-h-24 overflow-y-auto p-1"></div>
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-xs text-gray-400">Clic para seleccionar, clic de nuevo para deseleccionar</p>
                                <button type="button" onclick="agregarTecnologiaExp()"
                                    class="flex items-center gap-1 px-2.5 py-1 text-xs bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg transition font-medium">
                                    <i class="fas fa-plus text-xs"></i> Agregar
                                </button>
                            </div>
                        </div>

                        {{-- Tags agregados --}}
                        <div id="exp_proj_tags" class="flex flex-wrap gap-1.5 mt-1"></div>
                        <input type="hidden" id="exp_proj_tecnologias">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Estado</label>
                        <select id="exp_proj_estado"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                            <option value="en_progreso">En Curso</option>
                            <option value="completado">Completado</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-100">
                <button type="button" onclick="confirmarCancelarExperiencia()"
                    class="flex-1 px-4 py-2 text-sm border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </button>
                <button type="button" onclick="confirmarGuardarExperiencia()"
                    class="flex-1 px-4 py-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg font-medium transition">
                    <i class="fas fa-save text-xs mr-1"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal de Confirmación --}}
<div id="modalConfirmacionExperiencia" class="fixed inset-0 bg-black bg-opacity-60 z-[60] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">

        {{-- Franja superior de color --}}
        <div id="confirmHeaderExperiencia" class="h-1.5 w-full"></div>

        {{-- Icono + contenido --}}
        <div class="px-6 pt-6 pb-4 text-center">
            <div id="confirmIconWrapperExperiencia" class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i id="confirmIconExperiencia" class="text-2xl"></i>
            </div>
            <h4 id="confirmTituloExperiencia" class="text-base font-bold text-[#1e3a5f] mb-1.5"></h4>
            <p id="confirmMensajeExperiencia" class="text-xs text-gray-500 leading-relaxed"></p>
        </div>

        <div class="flex gap-3 px-6 pb-6">
            <button type="button" onclick="cerrarConfirmacionExperiencia()"
                class="flex-1 px-4 py-2.5 text-sm border border-gray-200 text-gray-500 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition font-medium">
                No, cancelar
            </button>
            <button type="button" id="confirmBtnExperiencia"
                class="flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition">
                Confirmar
            </button>
        </div>
    </div>
</div>

<script>
// ============================================================
// VARIABLES GLOBALES
// ============================================================
let experienciaEditandoId = null;
const EXP_USER_ID = {{ $userId ?? 'null' }};


// ============================================================
// CONFIGURACIÓN DE CONFIRMACIÓN
// ============================================================
const CONFIRM_CONFIG_EXPERIENCIA = {
    guardar: {
        titulo:      '¿Guardar experiencia?',
        mensaje:     'Se almacenará la información de tu experiencia laboral. Podrás editarla en cualquier momento.',
        icon:        'fas fa-save',
        iconBg:      'bg-[#1e3a5f]/10',
        iconColor:   'text-[#1e3a5f]',
        headerColor: 'bg-[#1e3a5f]',
        btnClass:    'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80',
        accion:      () => submitExperiencia(),
    },
    cancelar: {
        titulo:      '¿Descartar cambios?',
        mensaje:     'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.',
        icon:        'fas fa-times-circle',
        iconBg:      'bg-gray-100',
        iconColor:   'text-gray-500',
        headerColor: 'bg-gray-400',
        btnClass:    'bg-gray-500 hover:bg-gray-600',
        accion:      () => cerrarModalExperiencia(),
    },
    eliminar: {
        titulo:      '¿Eliminar experiencia?',
        mensaje:     'Esta acción es permanente y no se puede deshacer. La experiencia será eliminada definitivamente.',
        icon:        'fas fa-trash-alt',
        iconBg:      'bg-[#e11d48]/10',
        iconColor:   'text-[#e11d48]',
        headerColor: 'bg-[#e11d48]',
        btnClass:    'bg-[#e11d48] hover:bg-[#e11d48]/80',
        accion:      null,
    },
};

// ============================================================
// MODAL DE CONFIRMACIÓN
// ============================================================
function mostrarConfirmacionExperiencia(tipo) {
    const cfg = CONFIRM_CONFIG_EXPERIENCIA[tipo];
    document.getElementById('confirmTituloExperiencia').textContent  = cfg.titulo;
    document.getElementById('confirmMensajeExperiencia').textContent = cfg.mensaje;
    document.getElementById('confirmHeaderExperiencia').className    = `h-1.5 w-full ${cfg.headerColor}`;

    const wrapper = document.getElementById('confirmIconWrapperExperiencia');
    wrapper.className = `w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 ${cfg.iconBg}`;

    const icon = document.getElementById('confirmIconExperiencia');
    icon.className = `${cfg.icon} text-2xl ${cfg.iconColor}`;

    const btn = document.getElementById('confirmBtnExperiencia');
    btn.className = `flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition ${cfg.btnClass}`;
    btn.onclick = () => { cerrarConfirmacionExperiencia(); cfg.accion(); };

    document.getElementById('modalConfirmacionExperiencia').classList.remove('hidden');
    document.getElementById('modalConfirmacionExperiencia').classList.add('flex');
}

function cerrarConfirmacionExperiencia() {
    document.getElementById('modalConfirmacionExperiencia').classList.add('hidden');
    document.getElementById('modalConfirmacionExperiencia').classList.remove('flex');
}

document.getElementById('modalConfirmacionExperiencia')?.addEventListener('click', function(e) {
    if (e.target === this) cerrarConfirmacionExperiencia();
});

// ============================================================
// HELPER: RESALTAR ERROR
// ============================================================
function resaltarErrorExperiencia(campoId, mensaje) {
    const el = document.getElementById(campoId);
    if (!el) return;
    el.classList.add('border-red-400', 'ring-2', 'ring-red-300');
    el.focus();
    setTimeout(() => el.classList.remove('border-red-400', 'ring-2', 'ring-red-300'), 2500);

    const prev = el.parentElement.querySelector('.error-msg-exp');
    if (prev) prev.remove();

    const msg = document.createElement('p');
    msg.className = 'error-msg-exp text-xs text-red-500 mt-1';
    msg.textContent = mensaje;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ============================================================
// RECALCULAR ESTADÍSTICAS Y ESTADO VACÍO
// ============================================================
function recalcularStatsExperiencia() {
    const lista = document.getElementById('experiencias-lista');
    if (!lista) return;

    const cards       = lista.querySelectorAll('[data-experiencia-id]');
    const total       = cards.length;
    const actuales    = lista.querySelectorAll('[data-trabajo-actual="1"]').length;
    const finalizadas = total - actuales;

    const elTotal      = document.getElementById('stat-exp-total');
    const elActual     = document.getElementById('stat-exp-actual');
    const elFinalizada = document.getElementById('stat-exp-finalizada');
    if (elTotal)      elTotal.textContent      = total;
    if (elActual)     elActual.textContent     = actuales;
    if (elFinalizada) elFinalizada.textContent = finalizadas;

    const emptyState = document.getElementById('empty-state-exp');
    if (emptyState) emptyState.classList.toggle('hidden', total > 0);
    lista.classList.toggle('hidden', total === 0);
}

// ============================================================
// CONFIRMAR GUARDAR (VALIDACIONES)
// ============================================================
function confirmarGuardarExperiencia() {
    const cargo       = document.getElementById('exp_cargo').value.trim();
    const empresa     = document.getElementById('exp_empresa').value.trim();
    const fechaIni    = document.getElementById('exp_fecha_ini').value;
    const fechaFin    = document.getElementById('exp_fecha_fin').value;
    const trabajoActual = document.getElementById('exp_trabajo_actual').checked;

    if (!cargo)   { resaltarErrorExperiencia('exp_cargo',    'El cargo es obligatorio.');    return; }
    if (!empresa) { resaltarErrorExperiencia('exp_empresa',  'La empresa es obligatoria.');  return; }
    if (!fechaIni){ resaltarErrorExperiencia('exp_fecha_ini','La fecha de inicio es obligatoria.'); return; }

    if (!trabajoActual && !fechaFin) {
        resaltarErrorExperiencia('exp_fecha_fin', 'Si no es tu trabajo actual, indica la fecha de finalización.');
        return;
    }
    if (!trabajoActual && fechaFin && fechaFin < fechaIni) {
        resaltarErrorExperiencia('exp_fecha_fin', 'La fecha de fin no puede ser anterior al inicio.');
        return;
    }

    // Validar campos obligatorios del proyecto (solo al crear)
    if (!experienciaEditandoId) {
        const projNombre   = document.getElementById('exp_proj_nombre').value.trim();
        const projFechaIni = document.getElementById('exp_proj_fecha_ini').value;
        const projFechaFin = document.getElementById('exp_proj_fecha_fin').value;
        const projUrlLink  = document.getElementById('exp_proj_url_link').value.trim();
        const hoy          = new Date().toISOString().split('T')[0];

        if (!projNombre)   { resaltarErrorExperiencia('exp_proj_nombre',   'El nombre del proyecto es obligatorio.');          return; }
        if (!projFechaIni) { resaltarErrorExperiencia('exp_proj_fecha_ini','La fecha de inicio del proyecto es obligatoria.'); return; }

        if (projFechaFin && projFechaFin < hoy) {
            if (!projUrlLink) {
                resaltarErrorExperiencia('exp_proj_url_link', 'El proyecto ya finalizó. El enlace es obligatorio.');
                return;
            }
            try { new URL(projUrlLink); } catch (_) {
                resaltarErrorExperiencia('exp_proj_url_link', 'Ingresa una URL válida (ej: https://miproyecto.com).');
                return;
            }
        }
    }

    mostrarConfirmacionExperiencia('guardar');
}

function confirmarCancelarExperiencia() {
    const cargo   = document.getElementById('exp_cargo').value.trim();
    const empresa = document.getElementById('exp_empresa').value.trim();
    if (cargo || empresa) {
        mostrarConfirmacionExperiencia('cancelar');
    } else {
        cerrarModalExperiencia();
    }
}

// ============================================================
// RESET FORMULARIO DE PROYECTO
// ============================================================
function resetProyectoForm() {
    document.getElementById('exp_proj_nombre').value      = '';
    document.getElementById('exp_proj_descripcion').value = '';
    document.getElementById('exp_proj_fecha_ini').value   = '';
    document.getElementById('exp_proj_fecha_fin').value   = '';
    document.getElementById('exp_proj_tecnologias').value = '';
    document.getElementById('exp_proj_estado').value      = 'en_progreso';
    document.getElementById('exp_proj_url_link').value    = '';
    document.getElementById('exp_proj_url_wrapper').classList.add('hidden');
    document.getElementById('exp_categoria_select').value = '';
    document.getElementById('exp_chips').innerHTML        = '';
    document.getElementById('exp_chips_container').classList.add('hidden');
    document.getElementById('exp_proj_tags').innerHTML    = '';
}

// ============================================================
// ABRIR MODAL CREAR
// ============================================================
function abrirModalExperiencia() {
    document.getElementById('modalExperienciaTitulo').textContent = 'Agregar Experiencia Laboral';
    document.getElementById('formExperiencia').reset();
    document.getElementById('exp_id_experiencia').value = '';
    experienciaEditandoId = null;

    document.getElementById('exp_fecha_fin_container').style.opacity = '1';
    document.getElementById('exp_fecha_fin').disabled = false;
    document.getElementById('exp_trabajo_actual').checked = false;

    // Mostrar sección de proyecto (solo al crear)
    document.getElementById('exp_proyecto_wrapper').classList.remove('hidden');
    resetProyectoForm();

    document.getElementById('modalExperiencia').classList.remove('hidden');
    document.getElementById('modalExperiencia').classList.add('flex');
}

// ============================================================
// ABRIR MODAL EDITAR
// ============================================================
function abrirModalEditarExperiencia(exp) {
    document.getElementById('modalExperienciaTitulo').textContent = 'Editar Experiencia Laboral';
    // Ocultar sección de proyecto al editar (solo aplica al crear)
    document.getElementById('exp_proyecto_wrapper').classList.add('hidden');
    document.getElementById('exp_id_experiencia').value = exp.id_experiencia;
    document.getElementById('exp_cargo').value          = exp.cargo       ?? '';
    document.getElementById('exp_empresa').value        = exp.empresa     ?? '';
    document.getElementById('exp_fecha_ini').value      = exp.fecha_ini   ? exp.fecha_ini.substring(0, 10) : '';
    document.getElementById('exp_fecha_fin').value      = exp.fecha_fin   ? exp.fecha_fin.substring(0, 10) : '';
    document.getElementById('exp_descripcion').value    = exp.descripcion ?? '';

    const trabajoActual = (exp.trabajo_actual === 1 || exp.trabajo_actual === true);
    document.getElementById('exp_trabajo_actual').checked = trabajoActual;
    experienciaEditandoId = exp.id_experiencia;

    if (trabajoActual) {
        document.getElementById('exp_fecha_fin_container').style.opacity = '0.5';
        document.getElementById('exp_fecha_fin').disabled = true;
        document.getElementById('exp_fecha_fin').value    = '';
    } else {
        document.getElementById('exp_fecha_fin_container').style.opacity = '1';
        document.getElementById('exp_fecha_fin').disabled = false;
    }

    document.getElementById('modalExperiencia').classList.remove('hidden');
    document.getElementById('modalExperiencia').classList.add('flex');
}

// ============================================================
// CERRAR MODAL
// ============================================================
function cerrarModalExperiencia() {
    document.getElementById('modalExperiencia').classList.add('hidden');
    document.getElementById('modalExperiencia').classList.remove('flex');
    experienciaEditandoId = null;
    resetProyectoForm();
}

function cerrarModalExperienciaFondo(event) {
    if (event.target.id === 'modalExperiencia') confirmarCancelarExperiencia();
}

// ============================================================
// CHECKBOX trabajo actual
// ============================================================
document.getElementById('exp_trabajo_actual')?.addEventListener('change', function(e) {
    const container = document.getElementById('exp_fecha_fin_container');
    const input     = document.getElementById('exp_fecha_fin');
    if (e.target.checked) {
        container.style.opacity = '0.5';
        input.disabled = true;
        input.value    = '';
    } else {
        container.style.opacity = '1';
        input.disabled = false;
    }
});

// ============================================================
// CONSTRUIR TARJETA HTML (estilo card igual que gestionarProyectos)
// ============================================================
function escapeHtmlExp(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Navega a la sección proyectos y resalta el proyecto indicado
function verProyectoDesdeExp(idProyecto) {
    if (typeof cambiarSeccion === 'function') cambiarSeccion('proyectos');
    setTimeout(() => {
        const card = document.querySelector(`[data-proyecto-id="${idProyecto}"]`);
        if (card) {
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
            card.classList.add('ring-2', 'ring-[#1e3a5f]', 'ring-offset-2');
            setTimeout(() => card.classList.remove('ring-2', 'ring-[#1e3a5f]', 'ring-offset-2'), 1800);
        }
    }, 150);
}

function buildCardHTMLExperiencia(experiencia, proyectos = []) {
    const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

    let fechaInicioStr = '';
    if (experiencia.fecha_ini) {
        const d = new Date(experiencia.fecha_ini + 'T12:00:00');
        fechaInicioStr = `${meses[d.getMonth()]} ${d.getFullYear()}`;
    }

    const esActual = (experiencia.trabajo_actual === 1 || experiencia.trabajo_actual === true);
    let fechaFinStr = '';
    if (esActual) {
        fechaFinStr = '<span class="text-green-600 font-medium">Actualidad</span>';
    } else if (experiencia.fecha_fin) {
        const d = new Date(experiencia.fecha_fin + 'T12:00:00');
        fechaFinStr = `${meses[d.getMonth()]} ${d.getFullYear()}`;
    }

    const badgeClass = esActual ? 'bg-[#1e3a5f]/10 text-[#1e3a5f]' : 'bg-gray-100 text-gray-600';
    const badgeLabel = esActual ? 'actual' : 'finalizada';

    const cargo      = escapeHtmlExp(experiencia.cargo      || '');
    const empresa    = escapeHtmlExp(experiencia.empresa    || '');
    const descripcion = escapeHtmlExp(experiencia.descripcion || '');

    const expJson = JSON.stringify(experiencia).replace(/\\/g, '\\\\').replace(/'/g, "\\'");

    return `
<div class="bg-white rounded-2xl border border-gray-200 shadow-md p-5 flex flex-col gap-2
            border-l-4 border-l-[#1e3a5f] hover:-translate-y-1 hover:shadow-xl transition-all duration-200"
     data-experiencia-id="${experiencia.id_experiencia}"
     data-trabajo-actual="${esActual ? '1' : '0'}">

    <div class="flex items-start justify-between gap-2">
        <h3 class="font-semibold text-[#1e3a5f] text-sm leading-snug line-clamp-1">${cargo}</h3>
        <span class="text-xs font-medium px-2 py-0.5 rounded-full whitespace-nowrap ${badgeClass}">${badgeLabel}</span>
    </div>

    <p class="text-xs font-medium text-indigo-600">${empresa}</p>

    <div class="flex items-center text-xs text-gray-400 gap-1.5">
        <i class="fas fa-calendar-alt text-[#1e3a5f]/50"></i>
        <span>${fechaInicioStr} – ${fechaFinStr}</span>
    </div>

    ${descripcion ? `<p class="text-xs text-gray-500 leading-relaxed line-clamp-2">${descripcion}</p>` : ''}

    <div class="pt-2 border-t border-gray-100" id="exp-proyectos-${experiencia.id_experiencia}">
        ${proyectos.length ? `
        <p class="text-xs font-medium text-gray-400 mb-1.5">
            <i class="fas fa-folder text-[#1e3a5f]/50 mr-1"></i> Proyectos relacionados
        </p>
        <div class="flex flex-col gap-1">
            ${proyectos.map(p => `
            <a href="#" onclick="verProyectoDesdeExp(${p.id_proyecto}); return false;"
               class="flex items-center gap-1.5 text-xs text-[#1e3a5f] hover:text-[#e11d48] transition-colors group">
                <i class="fas fa-code-branch text-[#1e3a5f]/40 group-hover:text-[#e11d48]/60 text-[10px]"></i>
                <span class="truncate">${escapeHtmlExp(p.nombre)}</span>
            </a>`).join('')}
        </div>` : ''}
    </div>

    <div class="flex gap-2 pt-2 border-t border-gray-100 mt-auto">
        <button onclick='abrirModalEditarExperiencia(${expJson})'
            class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-pencil-alt"></i> Editar
        </button>
        <button onclick="confirmarEliminarExperiencia(${experiencia.id_experiencia})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-trash"></i> Eliminar
        </button>
    </div>
</div>`;
}

// ============================================================
// TOAST
// ============================================================
function mostrarToastExp(mensaje, tipo = 'success') {
    let container = document.getElementById('toastContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toastContainer';
        container.className = 'fixed bottom-4 right-4 z-[70] space-y-2';
        document.body.appendChild(container);
    }
    const toast = document.createElement('div');
    const bg    = tipo === 'success' ? 'bg-green-500' : 'bg-red-500';
    const ico   = tipo === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    toast.className = `${bg} text-white px-6 py-3 rounded-lg shadow-lg text-sm flex items-center gap-2`;
    toast.innerHTML = `<i class="fas ${ico}"></i><span>${mensaje}</span>`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity   = '0';
        toast.style.transform = 'translateX(100%)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => { toast.remove(); if (!container.children.length) container.remove(); }, 300);
    }, 3000);
}

// ============================================================
// SUBMIT FORMULARIO (GUARDAR)
// ============================================================
function submitExperiencia() {
    const btnGuardar = document.querySelector('#modalExperiencia button[onclick="confirmarGuardarExperiencia()"]');
    const textoOriginal = btnGuardar.innerHTML;
    btnGuardar.disabled = true;
    btnGuardar.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...';

    const trabajoActual = document.getElementById('exp_trabajo_actual').checked;
    const data = {
        cargo:          document.getElementById('exp_cargo').value,
        empresa:        document.getElementById('exp_empresa').value,
        fecha_ini:      document.getElementById('exp_fecha_ini').value,
        fecha_fin:      trabajoActual ? null : document.getElementById('exp_fecha_fin').value,
        descripcion:    document.getElementById('exp_descripcion').value,
        trabajo_actual: trabajoActual ? 1 : 0,
    };

    const url    = experienciaEditandoId ? `/perfil/experiencia/${experienciaEditandoId}` : '/perfil/experiencia';
    const method = experienciaEditandoId ? 'PUT' : 'POST';

    fetch(url, {
        method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify(data),
    })
    .then(r => {
        if (r.status === 422) {
            return r.json().then(err => {
                const msgs = err.errors ? Object.values(err.errors).flat() : [err.message ?? 'Error de validación'];
                resaltarErrorExperiencia('exp_cargo', msgs[0]);
                throw new Error('validation');
            });
        }
        return r.json();
    })
    .then(res => {
        if (!res.success) {
            mostrarToastExp(res.error || 'Error al guardar', 'error');
            return;
        }

        const exp      = res.experiencia;
        const lista    = document.getElementById('experiencias-lista');
        const cardHTML = buildCardHTMLExperiencia(exp);

        if (experienciaEditandoId) {
            const existing = lista?.querySelector(`[data-experiencia-id="${exp.id_experiencia}"]`);
            if (existing) existing.outerHTML = cardHTML;
        } else {
            lista?.insertAdjacentHTML('afterbegin', cardHTML);
        }

        recalcularStatsExperiencia();

        // Crear proyecto asociado (obligatorio al crear experiencia)
        if (!experienciaEditandoId) {
            const idExpRecienCreada = exp.id_experiencia;
            const projNombre   = document.getElementById('exp_proj_nombre').value.trim();
            const projFechaIni = document.getElementById('exp_proj_fecha_ini').value;

            fetch('/proyectos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    user_id:        EXP_USER_ID,
                    id_experiencia: exp.id_experiencia,
                    nombre:         projNombre,
                    descripcion:    document.getElementById('exp_proj_descripcion').value,
                    fecha_ini:      projFechaIni,
                    fecha_fin:      document.getElementById('exp_proj_fecha_fin').value || null,
                    tecnologias:    document.getElementById('exp_proj_tecnologias').value,
                    url_link:       document.getElementById('exp_proj_url_link').value.trim() || null,
                    estado:         document.getElementById('exp_proj_estado').value,
                    visible:        1,
                }),
            })
            .then(r => r.json())
            .then(projRes => {
                if (projRes.success) {
                    const proyecto = projRes.proyecto;

                    // Inyectar en grid de Mis Proyectos
                    if (typeof buildCardHTML === 'function') {
                        const grid = document.getElementById('proyectos-grid');
                        if (grid) {
                            grid.insertAdjacentHTML('afterbegin', buildCardHTML(proyecto));
                            if (typeof recalcularStats === 'function') recalcularStats();
                        }
                    }

                    // Actualizar la tarjeta de experiencia recién creada para mostrar el proyecto
                    const contenedorProyectos = document.getElementById(`exp-proyectos-${idExpRecienCreada}`);
                    if (contenedorProyectos) {
                        contenedorProyectos.innerHTML = `
                            <p class="text-xs font-medium text-gray-400 mb-1.5">
                                <i class="fas fa-folder text-[#1e3a5f]/50 mr-1"></i> Proyectos relacionados
                            </p>
                            <div class="flex flex-col gap-1">
                                <a href="#" onclick="verProyectoDesdeExp(${proyecto.id_proyecto}); return false;"
                                   class="flex items-center gap-1.5 text-xs text-[#1e3a5f] hover:text-[#e11d48] transition-colors group">
                                    <i class="fas fa-code-branch text-[#1e3a5f]/40 group-hover:text-[#e11d48]/60 text-[10px]"></i>
                                    <span class="truncate">${escapeHtmlExp(proyecto.nombre)}</span>
                                </a>
                            </div>`;
                    }
                }
                cerrarModalExperiencia();
                mostrarToastExp(
                    projRes.success
                        ? 'Experiencia y proyecto guardados correctamente'
                        : 'Experiencia guardada, pero el proyecto no pudo crearse',
                    projRes.success ? 'success' : 'error'
                );
            })
            .catch(() => {
                cerrarModalExperiencia();
                mostrarToastExp('Experiencia guardada, pero hubo un problema al crear el proyecto', 'error');
            });
        } else {
            cerrarModalExperiencia();
            mostrarToastExp('Experiencia guardada correctamente', 'success');
        }
    })
    .catch(err => {
        if (err.message !== 'validation') {
            console.error(err);
            mostrarToastExp('Hubo un problema al guardar', 'error');
        }
    })
    .finally(() => {
        btnGuardar.disabled  = false;
        btnGuardar.innerHTML = textoOriginal;
    });
}

// ============================================================
// TECNOLOGÍAS (chips) — PROYECTO EN EXPERIENCIA
// ============================================================

// Reutiliza TECNOLOGIAS_POR_CATEGORIA definido en _scripts.blade.php
// Si no está disponible en esta página, se define localmente
window.TECNOLOGIAS_POR_CATEGORIA = window.TECNOLOGIAS_POR_CATEGORIA || {
    'Frontend':             ['React', 'Vue.js', 'Angular', 'Svelte', 'Next.js', 'Nuxt.js', 'HTML', 'CSS', 'Tailwind CSS', 'Bootstrap', 'jQuery', 'TypeScript'],
    'Backend':              ['Node.js', 'Express', 'Django', 'FastAPI', 'Spring Boot', 'Laravel', 'Ruby on Rails', 'ASP.NET', 'Flask', 'NestJS', 'Phoenix'],
    'Lenguajes':            ['JavaScript', 'TypeScript', 'Python', 'Java', 'C#', 'C++', 'C', 'PHP', 'Ruby', 'Go', 'Rust', 'Swift', 'Kotlin', 'Dart', 'R'],
    'Bases de Datos':       ['MySQL', 'PostgreSQL', 'MongoDB', 'SQLite', 'Redis', 'MariaDB', 'Oracle', 'SQL Server', 'Cassandra', 'Firebase', 'Supabase'],
    'Cloud & DevOps':       ['AWS', 'Google Cloud', 'Azure', 'Docker', 'Kubernetes', 'GitHub Actions', 'GitLab CI', 'Terraform', 'Ansible', 'Jenkins', 'Nginx'],
    'Mobile':               ['React Native', 'Flutter', 'Android', 'iOS', 'Ionic', 'Xamarin', 'Expo'],
    'APIs & Real-time':     ['REST API', 'GraphQL', 'WebSockets', 'gRPC', 'Swagger', 'Postman', 'Socket.io'],
    'Testing':              ['Jest', 'PHPUnit', 'Cypress', 'Selenium', 'Pytest', 'JUnit', 'Mocha', 'Vitest'],
    'Data Science & ML':    ['TensorFlow', 'PyTorch', 'Scikit-learn', 'Pandas', 'NumPy', 'Keras', 'OpenCV', 'Jupyter'],
    'Diseño & Prototipado': ['Figma', 'Adobe XD', 'Sketch', 'InVision', 'Canva'],
    'Gestión de Proyectos': ['Git', 'GitHub', 'GitLab', 'Jira', 'Trello', 'Notion', 'Slack', 'Linear'],
};

function getTagsExp() {
    const val = document.getElementById('exp_proj_tecnologias').value;
    return val ? val.split(',').map(t => t.trim()).filter(Boolean) : [];
}

function setTagsExp(tags) {
    document.getElementById('exp_proj_tecnologias').value = tags.join(', ');
    renderizarTagsExp(tags);
}

function renderizarTagsExp(tags) {
    const container = document.getElementById('exp_proj_tags');
    container.innerHTML = '';
    tags.forEach((tag, i) => {
        const span = document.createElement('span');
        span.className = 'flex items-center gap-1 text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/20 px-2.5 py-1 rounded-full';
        span.innerHTML = `${tag} <button type="button" onclick="eliminarTagExp(${i})" class="text-blue-400 hover:text-red-500 ml-1"><i class="fas fa-times text-xs"></i></button>`;
        container.appendChild(span);
    });
}

function eliminarTagExp(index) {
    const tags = getTagsExp();
    tags.splice(index, 1);
    setTagsExp(tags);
}

function verificarFechaFinProyectoExp() {
    const fechaFin = document.getElementById('exp_proj_fecha_fin').value;
    const wrapper  = document.getElementById('exp_proj_url_wrapper');
    const hoy      = new Date().toISOString().split('T')[0];
    const pasado   = fechaFin && fechaFin < hoy;

    if (pasado) {
        wrapper.classList.remove('hidden');
        document.getElementById('exp_proj_estado').value = 'completado';
    } else {
        wrapper.classList.add('hidden');
        document.getElementById('exp_proj_url_link').value = '';
        document.getElementById('exp_proj_estado').value = 'en_progreso';
    }
}

function filtrarTecnologiasExp() {
    const categoria = document.getElementById('exp_categoria_select').value;
    const container = document.getElementById('exp_chips_container');
    const chipsDiv  = document.getElementById('exp_chips');

    chipsDiv.innerHTML = '';

    if (!categoria || !TECNOLOGIAS_POR_CATEGORIA[categoria]) {
        container.classList.add('hidden');
        return;
    }

    const yaAgregadas = getTagsExp();

    TECNOLOGIAS_POR_CATEGORIA[categoria].forEach(tec => {
        const chip = document.createElement('button');
        chip.type        = 'button';
        chip.dataset.tec = tec;
        chip.textContent = tec;

        if (yaAgregadas.includes(tec)) {
            chip.className = 'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed';
            chip.disabled  = true;
        } else {
            chip.className = 'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none';
            chip.addEventListener('click', () => toggleChipExp(chip));
        }

        chipsDiv.appendChild(chip);
    });

    container.classList.remove('hidden');
}

function toggleChipExp(chip) {
    const activo = chip.dataset.activo === '1';
    if (activo) {
        chip.dataset.activo = '0';
        chip.className = 'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none';
    } else {
        chip.dataset.activo = '1';
        chip.className = 'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f] bg-[#1e3a5f] text-white transition cursor-pointer select-none';
    }
}

function agregarTecnologiaExp() {
    const seleccionados = document.querySelectorAll('#exp_chips [data-activo="1"]');
    if (!seleccionados.length) return;

    const tags = getTagsExp();
    seleccionados.forEach(chip => {
        const tec = chip.dataset.tec;
        if (!tags.includes(tec)) tags.push(tec);
    });
    setTagsExp(tags);

    seleccionados.forEach(chip => {
        chip.dataset.activo = '0';
        chip.className = 'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed';
        chip.disabled  = true;
    });
}

// ============================================================
// ELIMINAR
// ============================================================
function confirmarEliminarExperiencia(id) {
    CONFIRM_CONFIG_EXPERIENCIA.eliminar.accion = () => ejecutarEliminarExperiencia(id);
    mostrarConfirmacionExperiencia('eliminar');
}

function ejecutarEliminarExperiencia(id) {
    fetch(`/perfil/experiencia/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const card = document.querySelector(`[data-experiencia-id="${id}"]`);
            if (card) card.remove();
            recalcularStatsExperiencia();
            mostrarToastExp('Experiencia eliminada correctamente', 'success');
        } else {
            mostrarToastExp(res.error || 'Error al eliminar', 'error');
        }
    });
}
</script>
