{{-- resources/views/gestionarPerfil/modal-educacion.blade.php --}}

<div id="modalEducacion" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4" onclick="cerrarModalEducacionFondo(event)">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        
        {{-- Header --}}
        <div class="bg-[#1e3a5f] text-white px-6 py-4 flex items-center justify-between rounded-t-2xl sticky top-0 z-10">
            <div>
                <h3 id="modalEducacionTitulo" class="text-lg font-bold">Agregar Formación Académica</h3>
                <p class="text-blue-200 text-xs mt-0.5">Completa los detalles de tu formación</p>
            </div>
            <button type="button" onclick="confirmarCancelarEducacion()" class="text-white hover:text-blue-200 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        {{-- Body --}}
        <form id="formEducacion" class="p-6">
            @csrf
            <input type="hidden" id="edu_id_formacion" name="id_formacion">
            
            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Título <span class="text-red-500">*</span>
                </label>
                <input type="text" id="edu_titulo" name="titulo"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Ej: Ingeniería Informática">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Institución <span class="text-red-500">*</span>
                </label>
                <input type="text" id="edu_institucion" name="institucion"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Ej: Universidad Nacional">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Nivel <span class="text-red-500">*</span>
                </label>
                <select id="edu_nivel" name="nivel"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Selecciona un nivel</option>
                    <option value="Técnico">Técnico</option>
                    <option value="Tecnólogo">Tecnólogo</option>
                    <option value="Pregrado">Pregrado</option>
                    <option value="Posgrado">Posgrado</option>
                    <option value="Maestría">Maestría</option>
                    <option value="Doctorado">Doctorado</option>
                    <option value="Diplomado">Diplomado</option>
                    <option value="Curso">Curso</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        Fecha Inicio <span class="text-red-500">*</span>
                    </label>
                    <input type="month" id="edu_fecha_ini" name="fecha_ini"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div id="edu_fecha_fin_container">
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        Fecha Fin
                    </label>
                    <input type="month" id="edu_fecha_fin" name="fecha_fin"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div class="mb-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="edu_en_curso" name="en_curso" class="w-4 h-4 text-blue-500 rounded">
                    <span class="text-sm text-gray-700">Actualmente estudiando aquí</span>
                </label>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="edu_descripcion" name="descripcion" rows="3"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                    placeholder="Describe lo que aprendiste o destacaste..."></textarea>
            </div>

            {{-- Botones --}}
            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-100">
                <button type="button" onclick="confirmarCancelarEducacion()"
                    class="flex-1 px-4 py-2 text-sm border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </button>
                <button type="button" onclick="confirmarGuardarEducacion()"
                    class="flex-1 px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition">
                    <i class="fas fa-save text-xs mr-1"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal de Confirmación para Educación --}}
<div id="modalConfirmacionEducacion" class="fixed inset-0 bg-black bg-opacity-60 z-[60] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden animate-in">
        <div class="p-6 text-center">
            <div id="confirmIconWrapperEducacion" class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i id="confirmIconEducacion" class="text-2xl"></i>
            </div>
            <h4 id="confirmTituloEducacion" class="text-lg font-bold text-gray-800 mb-2"></h4>
            <p id="confirmMensajeEducacion" class="text-sm text-gray-500 leading-relaxed"></p>
        </div>
        <div class="flex gap-3 px-6 pb-6">
            <button type="button" onclick="cerrarConfirmacionEducacion()"
                class="flex-1 px-4 py-2.5 text-sm border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition font-medium">
                No, cancelar
            </button>
            <button type="button" id="confirmBtnEducacion"
                class="flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition">
                Confirmar
            </button>
        </div>
    </div>
</div>

<script>
// ============================================
// VARIABLES GLOBALES
// ============================================
let educacionEditandoId = null;

// ============================================
// CONFIGURACIÓN DE CONFIRMACIÓN
// ============================================
const CONFIRM_CONFIG_EDUCACION = {
    guardar: {
        titulo: '¿Guardar formación?',
        mensaje: 'Se almacenará la información de tu formación académica. Podrás editarla en cualquier momento.',
        icon: 'fas fa-save',
        iconBg: 'bg-blue-50',
        iconColor: 'text-blue-500',
        btnClass: 'bg-blue-500 hover:bg-blue-600',
        accion: () => submitEducacion(),
    },
    cancelar: {
        titulo: '¿Descartar cambios?',
        mensaje: 'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.',
        icon: 'fas fa-times-circle',
        iconBg: 'bg-yellow-50',
        iconColor: 'text-yellow-500',
        btnClass: 'bg-yellow-500 hover:bg-yellow-600',
        accion: () => cerrarModalEducacion(),
    },
    eliminar: {
        titulo: '¿Eliminar formación?',
        mensaje: 'Esta acción es permanente y no se puede deshacer. La formación será eliminada definitivamente.',
        icon: 'fas fa-trash-alt',
        iconBg: 'bg-red-50',
        iconColor: 'text-red-500',
        btnClass: 'bg-red-500 hover:bg-red-600',
        accion: null,
    },
};

// ============================================
// MODAL DE CONFIRMACIÓN
// ============================================
function mostrarConfirmacionEducacion(tipo) {
    const cfg = CONFIRM_CONFIG_EDUCACION[tipo];
    
    document.getElementById('confirmTituloEducacion').textContent = cfg.titulo;
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

// ============================================
// HELPER: RESALTAR ERROR
// ============================================
function resaltarErrorEducacion(campoId, mensaje) {
    const el = document.getElementById(campoId);
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

// ============================================
// CONFIRMAR GUARDAR (VALIDACIONES)
// ============================================
function confirmarGuardarEducacion() {
    const titulo = document.getElementById('edu_titulo').value.trim();
    const institucion = document.getElementById('edu_institucion').value.trim();
    const nivel = document.getElementById('edu_nivel').value;
    const fechaIni = document.getElementById('edu_fecha_ini').value;
    const fechaFin = document.getElementById('edu_fecha_fin').value;
    const enCurso = document.getElementById('edu_en_curso').checked;

    if (!titulo) {
        resaltarErrorEducacion('edu_titulo', 'El título es obligatorio.');
        return;
    }

    if (!institucion) {
        resaltarErrorEducacion('edu_institucion', 'La institución es obligatoria.');
        return;
    }

    if (!nivel) {
        resaltarErrorEducacion('edu_nivel', 'El nivel es obligatorio.');
        return;
    }

    if (!fechaIni) {
        resaltarErrorEducacion('edu_fecha_ini', 'La fecha de inicio es obligatoria.');
        return;
    }

    if (!enCurso && !fechaFin) {
        resaltarErrorEducacion('edu_fecha_fin', 'Si no está en curso, debes indicar la fecha de finalización.');
        return;
    }

    if (!enCurso && fechaFin && fechaFin < fechaIni) {
        resaltarErrorEducacion('edu_fecha_fin', 'La fecha de finalización no puede ser anterior a la fecha de inicio.');
        return;
    }

    mostrarConfirmacionEducacion('guardar');
}

function confirmarCancelarEducacion() {
    const titulo = document.getElementById('edu_titulo').value.trim();
    const institucion = document.getElementById('edu_institucion').value.trim();
    if (titulo || institucion) {
        mostrarConfirmacionEducacion('cancelar');
    } else {
        cerrarModalEducacion();
    }
}

// ============================================
// ABRIR MODAL CREAR
// ============================================
function abrirModalEducacion() {
    document.getElementById('modalEducacionTitulo').textContent = 'Agregar Formación Académica';
    document.getElementById('formEducacion').reset();
    document.getElementById('edu_id_formacion').value = '';
    educacionEditandoId = null;
    
    document.getElementById('edu_fecha_fin_container').style.opacity = '1';
    document.getElementById('edu_fecha_fin').disabled = false;
    document.getElementById('edu_en_curso').checked = false;
    
    document.getElementById('modalEducacion').classList.remove('hidden');
    document.getElementById('modalEducacion').classList.add('flex');
}

// ============================================
// ABRIR MODAL EDITAR
// ============================================
function abrirModalEditarEducacion(edu) {
    document.getElementById('modalEducacionTitulo').textContent = 'Editar Formación Académica';
    document.getElementById('edu_id_formacion').value = edu.id_formacion;
    document.getElementById('edu_titulo').value = edu.titulo ?? '';
    document.getElementById('edu_institucion').value = edu.institucion ?? '';
    document.getElementById('edu_nivel').value = edu.nivel ?? '';
    document.getElementById('edu_fecha_ini').value = edu.fecha_ini ? edu.fecha_ini.substring(0, 7) : '';
    document.getElementById('edu_fecha_fin').value = edu.fecha_fin ? edu.fecha_fin.substring(0, 7) : '';
    document.getElementById('edu_descripcion').value = edu.descripcion ?? '';
    
    const enCurso = !edu.fecha_fin || edu.fecha_fin === null;
    document.getElementById('edu_en_curso').checked = enCurso;
    educacionEditandoId = edu.id_formacion;
    
    if (enCurso) {
        document.getElementById('edu_fecha_fin_container').style.opacity = '0.5';
        document.getElementById('edu_fecha_fin').disabled = true;
        document.getElementById('edu_fecha_fin').value = '';
    } else {
        document.getElementById('edu_fecha_fin_container').style.opacity = '1';
        document.getElementById('edu_fecha_fin').disabled = false;
    }
    
    document.getElementById('modalEducacion').classList.remove('hidden');
    document.getElementById('modalEducacion').classList.add('flex');
}

// ============================================
// CERRAR MODAL
// ============================================
function cerrarModalEducacion() {
    document.getElementById('modalEducacion').classList.add('hidden');
    document.getElementById('modalEducacion').classList.remove('flex');
    educacionEditandoId = null;
}

function cerrarModalEducacionFondo(event) {
    if (event.target.id === 'modalEducacion') {
        confirmarCancelarEducacion();
    }
}

// ============================================
// CHECKBOX en curso
// ============================================
document.getElementById('edu_en_curso')?.addEventListener('change', function(e) {
    const fechaFinContainer = document.getElementById('edu_fecha_fin_container');
    const fechaFinInput = document.getElementById('edu_fecha_fin');
    
    if (e.target.checked) {
        fechaFinContainer.style.opacity = '0.5';
        fechaFinInput.disabled = true;
        fechaFinInput.value = '';
    } else {
        fechaFinContainer.style.opacity = '1';
        fechaFinInput.disabled = false;
    }
});

// ============================================
// TOAST NOTIFICATIONS
// ============================================
function mostrarToast(mensaje, tipo = 'success') {
    let toastContainer = document.getElementById('toastContainer');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toastContainer';
        toastContainer.className = 'fixed bottom-4 right-4 z-50 space-y-2';
        document.body.appendChild(toastContainer);
    }
    
    const toast = document.createElement('div');
    const bgColor = tipo === 'success' ? 'bg-green-500' : 'bg-red-500';
    toast.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg text-sm flex items-center gap-2`;
    
    const icon = tipo === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    toast.innerHTML = `<i class="fas ${icon}"></i><span>${mensaje}</span>`;
    
    toastContainer.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => {
            toast.remove();
            if (toastContainer.children.length === 0) {
                toastContainer.remove();
            }
        }, 300);
    }, 3000);
}

// ============================================
// ESCAPAR HTML
// ============================================
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ============================================
// CONSTRUIR TARJETA HTML
// ============================================
function buildCardHTMLEducacion(educacion) {
    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    
    let fechaInicioStr = '';
    if (educacion.fecha_ini) {
        const fecha = new Date(educacion.fecha_ini);
        fechaInicioStr = `${meses[fecha.getMonth()]} ${fecha.getFullYear()}`;
    }
    
    let fechaFinStr = '';
    if (!educacion.fecha_fin) {
        fechaFinStr = '<span class="text-green-600 font-medium">En curso</span>';
    } else if (educacion.fecha_fin) {
        const fecha = new Date(educacion.fecha_fin);
        fechaFinStr = `${meses[fecha.getMonth()]} ${fecha.getFullYear()}`;
    }
    
    const titulo = escapeHtml(educacion.titulo || '');
    const institucion = escapeHtml(educacion.institucion || '');
    const nivel = escapeHtml(educacion.nivel || '');
    const descripcion = escapeHtml(educacion.descripcion || 'Sin descripción');
    
    return `
<div class="educacion-item mb-6 last:mb-0 border-b border-gray-100 pb-4 last:border-0" data-id="${educacion.id_formacion}">
    <div class="flex justify-between items-start flex-wrap gap-2">
        <div class="flex-1">
            <div class="flex items-center gap-2 mb-1">
                <h3 class="font-semibold text-gray-800">${titulo}</h3>
                <span class="text-xs px-2 py-0.5 bg-blue-100 text-blue-600 rounded-full">${nivel}</span>
            </div>
            <p class="text-blue-600 font-medium">${institucion}</p>
        </div>
        <div class="flex items-center gap-2">
            <p class="text-sm text-gray-500">
                ${fechaInicioStr} - ${fechaFinStr}
            </p>
            <button onclick='abrirModalEditarEducacion(${JSON.stringify(educacion).replace(/'/g, "\\'")})' 
                class="text-gray-400 hover:text-blue-500 transition">
                <i class="fas fa-edit"></i>
            </button>
            <button onclick="confirmarEliminarEducacion(${educacion.id_formacion})" 
                class="text-gray-400 hover:text-red-500 transition">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    <p class="text-gray-600 text-sm mt-2">${descripcion}</p>
</div>`;
}

// ============================================
// SUBMIT FORMULARIO (GUARDAR)
// ============================================
function submitEducacion() {
    const btnGuardar = document.querySelector('#modalEducacion button[onclick="confirmarGuardarEducacion()"]');
    const textoOriginal = btnGuardar.innerHTML;
    btnGuardar.disabled = true;
    btnGuardar.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...';

    const enCurso = document.getElementById('edu_en_curso').checked;

    const data = {
        titulo: document.getElementById('edu_titulo').value,
        institucion: document.getElementById('edu_institucion').value,
        nivel: document.getElementById('edu_nivel').value,
        fecha_ini: document.getElementById('edu_fecha_ini').value,
        fecha_fin: enCurso ? null : document.getElementById('edu_fecha_fin').value,
        descripcion: document.getElementById('edu_descripcion').value,
        en_curso: enCurso ? 1 : 0
    };

    const url = educacionEditandoId ? `/perfil/educacion/${educacionEditandoId}` : '/perfil/educacion';
    const method = educacionEditandoId ? 'PUT' : 'POST';

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
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
    .then(data => {
        if (data.success) {
            const educacion = data.educacion;
            const container = document.getElementById('educaciones-container');
            
            if (container.children.length === 1 && container.children[0].classList?.contains('text-center')) {
                container.innerHTML = '';
            }
            
            const cardHTML = buildCardHTMLEducacion(educacion);
            
            if (educacionEditandoId) {
                const existing = container.querySelector(`.educacion-item[data-id="${educacion.id_formacion}"]`);
                if (existing) {
                    existing.outerHTML = cardHTML;
                }
            } else {
                container.insertAdjacentHTML('afterbegin', cardHTML);
            }
            
            cerrarModalEducacion();
            mostrarToast('Formación guardada correctamente', 'success');
        } else {
            mostrarToast(data.error || 'Error al guardar', 'error');
        }
    })
    .catch(error => {
        if (error.message !== 'validation') {
            console.error('Error:', error);
            mostrarToast('Hubo un problema al guardar', 'error');
        }
    })
    .finally(() => {
        btnGuardar.disabled = false;
        btnGuardar.innerHTML = textoOriginal;
    });
}

// ============================================
// CONFIRMAR ELIMINAR
// ============================================
function confirmarEliminarEducacion(id) {
    CONFIRM_CONFIG_EDUCACION.eliminar.accion = () => ejecutarEliminarEducacion(id);
    mostrarConfirmacionEducacion('eliminar');
}

// ============================================
// EJECUTAR ELIMINAR
// ============================================
function ejecutarEliminarEducacion(id) {
    fetch(`/perfil/educacion/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const card = document.querySelector(`.educacion-item[data-id="${id}"]`);
            if (card) card.remove();
            
            const container = document.getElementById('educaciones-container');
            if (container && container.children.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8 text-gray-400">
                        <i class="fas fa-graduation-cap text-3xl mb-2"></i>
                        <p>No hay formación académica registrada</p>
                        <p class="text-sm">Haz clic en "+ Agregar" para añadir</p>
                    </div>
                `;
            }
            
            mostrarToast('Formación eliminada correctamente', 'success');
        } else {
            mostrarToast(data.error || 'Error al eliminar', 'error');
        }
    });
}

// ============================================
// NO AGREGAR event listener al submit del formulario
// ============================================
// El formulario NO tiene submit automático porque los botones son type="button"
// Esto evita completamente el doble envío
</script>