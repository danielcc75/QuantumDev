<script>
// ============================================================
// VARIABLES GLOBALES
// ============================================================
let educacionEditandoId = null;

// ============================================================
// CONFIGURACIÓN DE CONFIRMACIÓN
// ============================================================
const CONFIRM_CONFIG_EDUCACION = {
    guardar: {
        titulo:    '¿Guardar formación?',
        mensaje:   'Se almacenará la información de tu formación académica. Podrás editarla en cualquier momento.',
        icon:      'fas fa-save',
        iconBg:    'bg-blue-50',
        iconColor: 'text-blue-500',
        btnClass:  'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90',
        accion:    () => submitEducacion(),
    },
    cancelar: {
        titulo:    '¿Descartar cambios?',
        mensaje:   'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.',
        icon:      'fas fa-times-circle',
        iconBg:    'bg-yellow-50',
        iconColor: 'text-yellow-500',
        btnClass:  'bg-yellow-500 hover:bg-yellow-600',
        accion:    () => cerrarModalEducacion(),
    },
    eliminar: {
        titulo:    '¿Eliminar formación?',
        mensaje:   'Esta acción es permanente y no se puede deshacer. La formación será eliminada definitivamente.',
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
function mostrarConfirmacionEducacion(tipo) {
    const cfg = CONFIRM_CONFIG_EDUCACION[tipo];
    document.getElementById('confirmTituloEducacion').textContent  = cfg.titulo;
    document.getElementById('confirmMensajeEducacion').textContent = cfg.mensaje;

    const wrapper = document.getElementById('confirmIconWrapperEducacion');
    wrapper.className = `w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 ${cfg.iconBg}`;

    const icon = document.getElementById('confirmIconEducacion');
    icon.className = `${cfg.icon} text-2xl ${cfg.iconColor}`;

    const btn = document.getElementById('confirmBtnEducacion');
    btn.className = `flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition ${cfg.btnClass}`;
    btn.onclick = () => { cerrarConfirmacionEducacion(); cfg.accion(); };

    document.getElementById('modalConfirmacionEducacion').classList.remove('hidden');
    document.getElementById('modalConfirmacionEducacion').classList.add('flex');
}

function cerrarConfirmacionEducacion() {
    document.getElementById('modalConfirmacionEducacion').classList.add('hidden');
    document.getElementById('modalConfirmacionEducacion').classList.remove('flex');
}

document.getElementById('modalConfirmacionEducacion')?.addEventListener('click', function(e) {
    if (e.target === this) cerrarConfirmacionEducacion();
});

// ============================================================
// HELPER: RESALTAR ERROR
// ============================================================
function resaltarErrorEducacion(campoId, mensaje) {
    const el = document.getElementById(campoId);
    if (!el) return;
    el.classList.add('border-red-400', 'ring-2', 'ring-red-300');
    el.focus();
    setTimeout(() => el.classList.remove('border-red-400', 'ring-2', 'ring-red-300'), 2500);

    const prev = el.parentElement.querySelector('.error-msg-edu');
    if (prev) prev.remove();

    const msg = document.createElement('p');
    msg.className = 'error-msg-edu text-xs text-red-500 mt-1';
    msg.textContent = mensaje;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ============================================================
// RECALCULAR ESTADÍSTICAS Y ESTADO VACÍO
// ============================================================
function recalcularStatsEducacion() {
    const lista = document.getElementById('educaciones-lista');
    if (!lista) return;

    const cards      = lista.querySelectorAll('[data-formacion-id]');
    const total      = cards.length;
    const enCurso    = lista.querySelectorAll('[data-en-curso="1"]').length;
    const completadas = total - enCurso;

    const elTotal      = document.getElementById('stat-edu-total');
    const elEnCurso    = document.getElementById('stat-edu-en-curso');
    const elCompletada = document.getElementById('stat-edu-completada');
    if (elTotal)      elTotal.textContent      = total;
    if (elEnCurso)    elEnCurso.textContent    = enCurso;
    if (elCompletada) elCompletada.textContent = completadas;

    const emptyState = document.getElementById('empty-state-edu');
    if (emptyState) emptyState.classList.toggle('hidden', total > 0);
    lista.classList.toggle('hidden', total === 0);
}

// ============================================================
// CONFIRMAR GUARDAR (VALIDACIONES)
// ============================================================
function confirmarGuardarEducacion() {
    const titulo      = document.getElementById('edu_titulo').value.trim();
    const institucion = document.getElementById('edu_institucion').value.trim();
    const nivel       = document.getElementById('edu_nivel').value;
    const fechaIni    = document.getElementById('edu_fecha_ini').value;
    const fechaFin    = document.getElementById('edu_fecha_fin').value;
    const enCurso     = document.getElementById('edu_en_curso').checked;

    if (!titulo)      { resaltarErrorEducacion('edu_titulo',      'El título es obligatorio.');       return; }
    if (!institucion) { resaltarErrorEducacion('edu_institucion', 'La institución es obligatoria.');  return; }
    if (!nivel)       { resaltarErrorEducacion('edu_nivel',       'El nivel es obligatorio.');        return; }
    if (!fechaIni)    { resaltarErrorEducacion('edu_fecha_ini',   'La fecha de inicio es obligatoria.'); return; }

    if (!enCurso && !fechaFin) {
        resaltarErrorEducacion('edu_fecha_fin', 'Si no está en curso, indica la fecha de finalización.');
        return;
    }
    if (!enCurso && fechaFin && fechaFin < fechaIni) {
        resaltarErrorEducacion('edu_fecha_fin', 'La fecha de fin no puede ser anterior al inicio.');
        return;
    }

    mostrarConfirmacionEducacion('guardar');
}

function confirmarCancelarEducacion() {
    const titulo      = document.getElementById('edu_titulo').value.trim();
    const institucion = document.getElementById('edu_institucion').value.trim();
    if (titulo || institucion) {
        mostrarConfirmacionEducacion('cancelar');
    } else {
        cerrarModalEducacion();
    }
}

// ============================================================
// ABRIR MODAL CREAR
// ============================================================
function abrirModalEducacion() {
    document.getElementById('modalEducacionTitulo').textContent = 'Agregar Formación Académica';
    document.getElementById('formEducacion').reset();
    document.getElementById('edu_id_formacion').value = '';
    educacionEditandoId = null;

    document.getElementById('edu_fecha_fin_container').style.opacity = '1';
    document.getElementById('edu_fecha_fin').disabled = false;
    document.getElementById('edu_en_curso').checked   = false;

    document.getElementById('modalEducacion').classList.remove('hidden');
    document.getElementById('modalEducacion').classList.add('flex');
}

// ============================================================
// ABRIR MODAL EDITAR
// ============================================================
function abrirModalEditarEducacion(edu) {
    document.getElementById('modalEducacionTitulo').textContent  = 'Editar Formación Académica';
    document.getElementById('edu_id_formacion').value = edu.id_formacion;
    document.getElementById('edu_titulo').value       = edu.titulo       ?? '';
    document.getElementById('edu_institucion').value  = edu.institucion  ?? '';
    document.getElementById('edu_nivel').value        = edu.nivel        ?? '';
    document.getElementById('edu_fecha_ini').value    = edu.fecha_ini    ? edu.fecha_ini.substring(0, 10) : '';
    document.getElementById('edu_fecha_fin').value    = edu.fecha_fin    ? edu.fecha_fin.substring(0, 10) : '';
    document.getElementById('edu_descripcion').value  = edu.descripcion  ?? '';

    const enCurso = !edu.fecha_fin || edu.fecha_fin === null;
    document.getElementById('edu_en_curso').checked = enCurso;
    educacionEditandoId = edu.id_formacion;

    if (enCurso) {
        document.getElementById('edu_fecha_fin_container').style.opacity = '0.5';
        document.getElementById('edu_fecha_fin').disabled = true;
        document.getElementById('edu_fecha_fin').value    = '';
    } else {
        document.getElementById('edu_fecha_fin_container').style.opacity = '1';
        document.getElementById('edu_fecha_fin').disabled = false;
    }

    document.getElementById('modalEducacion').classList.remove('hidden');
    document.getElementById('modalEducacion').classList.add('flex');
}

// ============================================================
// CERRAR MODAL
// ============================================================
function cerrarModalEducacion() {
    document.getElementById('modalEducacion').classList.add('hidden');
    document.getElementById('modalEducacion').classList.remove('flex');
    educacionEditandoId = null;
}

function cerrarModalEducacionFondo(event) {
    if (event.target.id === 'modalEducacion') confirmarCancelarEducacion();
}

// ============================================================
// CHECKBOX en curso
// ============================================================
document.getElementById('edu_en_curso')?.addEventListener('change', function(e) {
    const container = document.getElementById('edu_fecha_fin_container');
    const input     = document.getElementById('edu_fecha_fin');
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
function escapeHtmlEdu(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function buildCardHTMLEducacion(educacion) {
    const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

    let fechaInicioStr = '';
    if (educacion.fecha_ini) {
        const d = new Date(educacion.fecha_ini + 'T12:00:00');
        fechaInicioStr = `${meses[d.getMonth()]} ${d.getFullYear()}`;
    }

    const enCurso = !educacion.fecha_fin || educacion.fecha_fin === null;
    let fechaFinStr = '';
    if (enCurso) {
        fechaFinStr = '<span class="text-green-600 font-medium">En curso</span>';
    } else {
        const d = new Date(educacion.fecha_fin + 'T12:00:00');
        fechaFinStr = `${meses[d.getMonth()]} ${d.getFullYear()}`;
    }

    const nivelColors = {
        'Técnico':   'bg-orange-100 text-orange-700',
        'Tecnólogo': 'bg-yellow-100 text-yellow-700',
        'Pregrado':  'bg-blue-100 text-blue-700',
        'Posgrado':  'bg-indigo-100 text-indigo-700',
        'Maestría':  'bg-purple-100 text-purple-700',
        'Doctorado': 'bg-pink-100 text-pink-700',
        'Diplomado': 'bg-teal-100 text-teal-700',
        'Curso':     'bg-gray-100 text-gray-600',
    };
    const nivelClass = nivelColors[educacion.nivel] ?? 'bg-blue-100 text-blue-700';

    const titulo      = escapeHtmlEdu(educacion.titulo      || '');
    const institucion = escapeHtmlEdu(educacion.institucion || '');
    const nivel       = escapeHtmlEdu(educacion.nivel       || '');
    const descripcion = escapeHtmlEdu(educacion.descripcion || '');

    const eduJson = JSON.stringify(educacion).replace(/\\/g, '\\\\').replace(/'/g, "\\'");

    return `
<div class="bg-white rounded-2xl border border-gray-200 shadow-md p-5 flex flex-col gap-2
            border-l-4 border-l-[#1e3a5f] hover:-translate-y-1 hover:shadow-xl transition-all duration-200"
     data-formacion-id="${educacion.id_formacion}"
     data-en-curso="${enCurso ? '1' : '0'}">

    <div class="flex items-start justify-between gap-2">
        <h3 class="font-semibold text-[#1e3a5f] text-sm leading-snug line-clamp-1">${titulo}</h3>
        <span class="text-xs font-medium px-2 py-0.5 rounded-full whitespace-nowrap ${nivelClass}">${nivel}</span>
    </div>

    <p class="text-xs font-medium text-indigo-600">${institucion}</p>

    <div class="flex items-center text-xs text-gray-400 gap-1.5">
        <i class="fas fa-calendar-alt text-[#1e3a5f]/50"></i>
        <span>${fechaInicioStr} – ${fechaFinStr}</span>
    </div>

    ${descripcion ? `<p class="text-xs text-gray-500 leading-relaxed line-clamp-2">${descripcion}</p>` : ''}

    <div class="flex gap-2 pt-2 border-t border-gray-100 mt-auto">
        <button onclick='abrirModalEditarEducacion(${eduJson})'
            class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-pencil-alt"></i> Editar
        </button>
        <button onclick="confirmarEliminarEducacion(${educacion.id_formacion})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-trash"></i> Eliminar
        </button>
    </div>
</div>`;
}

// ============================================================
// TOAST
// ============================================================
function mostrarToastEdu(mensaje, tipo = 'success') {
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
        toast.style.opacity    = '0';
        toast.style.transform  = 'translateX(100%)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => { toast.remove(); if (!container.children.length) container.remove(); }, 300);
    }, 3000);
}

// ============================================================
// SUBMIT FORMULARIO (GUARDAR)
// ============================================================
function submitEducacion() {
    const btnGuardar = document.querySelector('#modalEducacion button[onclick="confirmarGuardarEducacion()"]');
    const textoOriginal = btnGuardar.innerHTML;
    btnGuardar.disabled = true;
    btnGuardar.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...';

    const enCurso = document.getElementById('edu_en_curso').checked;
    const data = {
        titulo:      document.getElementById('edu_titulo').value,
        institucion: document.getElementById('edu_institucion').value,
        nivel:       document.getElementById('edu_nivel').value,
        fecha_ini:   document.getElementById('edu_fecha_ini').value,
        fecha_fin:   enCurso ? null : document.getElementById('edu_fecha_fin').value,
        descripcion: document.getElementById('edu_descripcion').value,
        en_curso:    enCurso ? 1 : 0,
    };

    const url    = educacionEditandoId ? `/perfil/educacion/${educacionEditandoId}` : '/perfil/educacion';
    const method = educacionEditandoId ? 'PUT' : 'POST';

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
                resaltarErrorEducacion('edu_titulo', msgs[0]);
                throw new Error('validation');
            });
        }
        return r.json();
    })
    .then(res => {
        if (res.success) {
            const edu      = res.educacion;
            const lista    = document.getElementById('educaciones-lista');
            const cardHTML = buildCardHTMLEducacion(edu);

            if (educacionEditandoId) {
                const existing = lista?.querySelector(`[data-formacion-id="${edu.id_formacion}"]`);
                if (existing) existing.outerHTML = cardHTML;
            } else {
                lista?.insertAdjacentHTML('afterbegin', cardHTML);
                if (typeof window.notificarItemPublicable === 'function') {
                    window.notificarItemPublicable('educacion');
                }
            }

            recalcularStatsEducacion();
            cerrarModalEducacion();
            mostrarToastEdu('Formación guardada correctamente', 'success');
        } else {
            mostrarToastEdu(res.error || 'Error al guardar', 'error');
        }
    })
    .catch(err => {
        if (err.message !== 'validation') {
            console.error(err);
            mostrarToastEdu('Hubo un problema al guardar', 'error');
        }
    })
    .finally(() => {
        btnGuardar.disabled  = false;
        btnGuardar.innerHTML = textoOriginal;
    });
}

// ============================================================
// ELIMINAR
// ============================================================
function confirmarEliminarEducacion(id) {
    CONFIRM_CONFIG_EDUCACION.eliminar.accion = () => ejecutarEliminarEducacion(id);
    mostrarConfirmacionEducacion('eliminar');
}

function ejecutarEliminarEducacion(id) {
    fetch(`/perfil/educacion/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const card = document.querySelector(`[data-formacion-id="${id}"]`);
            if (card) card.remove();
            recalcularStatsEducacion();
            mostrarToastEdu('Formación eliminada correctamente', 'success');
        } else {
            mostrarToastEdu(res.error || 'Error al eliminar', 'error');
        }
    });
}
</script>
