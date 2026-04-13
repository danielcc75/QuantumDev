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
                    <input type="month" id="exp_fecha_ini" name="fecha_ini"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div id="exp_fecha_fin_container">
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        Fecha Fin
                    </label>
                    <input type="month" id="exp_fecha_fin" name="fecha_fin"
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

            {{-- Botones --}}
            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-100">
                <button type="button" onclick="confirmarCancelarExperiencia()"
                    class="flex-1 px-4 py-2 text-sm border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </button>
                <button type="button" onclick="confirmarGuardarExperiencia()"
                    class="flex-1 px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition">
                    <i class="fas fa-save text-xs mr-1"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal de Confirmación para Experiencia --}}
<div id="modalConfirmacionExperiencia" class="fixed inset-0 bg-black bg-opacity-60 z-[60] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden animate-in">
        <div class="p-6 text-center">
            <div id="confirmIconWrapperExperiencia" class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i id="confirmIconExperiencia" class="text-2xl"></i>
            </div>
            <h4 id="confirmTituloExperiencia" class="text-lg font-bold text-gray-800 mb-2"></h4>
            <p id="confirmMensajeExperiencia" class="text-sm text-gray-500 leading-relaxed"></p>
        </div>
        <div class="flex gap-3 px-6 pb-6">
            <button type="button" onclick="cerrarConfirmacionExperiencia()"
                class="flex-1 px-4 py-2.5 text-sm border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition font-medium">
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
// ============================================
// VARIABLES GLOBALES
// ============================================
let experienciaEditandoId = null;

// ============================================
// CONFIGURACIÓN DE CONFIRMACIÓN
// ============================================
const CONFIRM_CONFIG_EXPERIENCIA = {
    guardar: {
        titulo: '¿Guardar experiencia?',
        mensaje: 'Se almacenará la información de tu experiencia laboral. Podrás editarla en cualquier momento.',
        icon: 'fas fa-save',
        iconBg: 'bg-blue-50',
        iconColor: 'text-blue-500',
        btnClass: 'bg-blue-500 hover:bg-blue-600',
        accion: () => submitExperiencia(),
    },
    cancelar: {
        titulo: '¿Descartar cambios?',
        mensaje: 'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.',
        icon: 'fas fa-times-circle',
        iconBg: 'bg-yellow-50',
        iconColor: 'text-yellow-500',
        btnClass: 'bg-yellow-500 hover:bg-yellow-600',
        accion: () => cerrarModalExperiencia(),
    },
    eliminar: {
        titulo: '¿Eliminar experiencia?',
        mensaje: 'Esta acción es permanente y no se puede deshacer. La experiencia será eliminada definitivamente.',
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
function mostrarConfirmacionExperiencia(tipo) {
    const cfg = CONFIRM_CONFIG_EXPERIENCIA[tipo];
    
    document.getElementById('confirmTituloExperiencia').textContent = cfg.titulo;
    document.getElementById('confirmMensajeExperiencia').textContent = cfg.mensaje;
    
    const wrapper = document.getElementById('confirmIconWrapperExperiencia');
    wrapper.className = `w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 ${cfg.iconBg}`;
    
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

// ============================================
// HELPER: RESALTAR ERROR
// ============================================
function resaltarErrorExperiencia(campoId, mensaje) {
    const el = document.getElementById(campoId);
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

// ============================================
// CONFIRMAR GUARDAR (VALIDACIONES)
// ============================================
function confirmarGuardarExperiencia() {
    const cargo = document.getElementById('exp_cargo').value.trim();
    const empresa = document.getElementById('exp_empresa').value.trim();
    const fechaIni = document.getElementById('exp_fecha_ini').value;
    const fechaFin = document.getElementById('exp_fecha_fin').value;
    const trabajoActual = document.getElementById('exp_trabajo_actual').checked;

    if (!cargo) {
        resaltarErrorExperiencia('exp_cargo', 'El cargo es obligatorio.');
        return;
    }

    if (!empresa) {
        resaltarErrorExperiencia('exp_empresa', 'La empresa es obligatoria.');
        return;
    }

    if (!fechaIni) {
        resaltarErrorExperiencia('exp_fecha_ini', 'La fecha de inicio es obligatoria.');
        return;
    }

    if (!trabajoActual && !fechaFin) {
        resaltarErrorExperiencia('exp_fecha_fin', 'Si no es tu trabajo actual, debes indicar la fecha de finalización.');
        return;
    }

    if (!trabajoActual && fechaFin && fechaFin < fechaIni) {
        resaltarErrorExperiencia('exp_fecha_fin', 'La fecha de finalización no puede ser anterior a la fecha de inicio.');
        return;
    }

    mostrarConfirmacionExperiencia('guardar');
}

function confirmarCancelarExperiencia() {
    const cargo = document.getElementById('exp_cargo').value.trim();
    const empresa = document.getElementById('exp_empresa').value.trim();
    if (cargo || empresa) {
        mostrarConfirmacionExperiencia('cancelar');
    } else {
        cerrarModalExperiencia();
    }
}

// ============================================
// ABRIR MODAL CREAR
// ============================================
function abrirModalExperiencia() {
    document.getElementById('modalExperienciaTitulo').textContent = 'Agregar Experiencia Laboral';
    document.getElementById('formExperiencia').reset();
    document.getElementById('exp_id_experiencia').value = '';
    experienciaEditandoId = null;
    
    document.getElementById('exp_fecha_fin_container').style.opacity = '1';
    document.getElementById('exp_fecha_fin').disabled = false;
    document.getElementById('exp_trabajo_actual').checked = false;
    
    document.getElementById('modalExperiencia').classList.remove('hidden');
    document.getElementById('modalExperiencia').classList.add('flex');
}

// ============================================
// ABRIR MODAL EDITAR
// ============================================
function abrirModalEditarExperiencia(exp) {
    document.getElementById('modalExperienciaTitulo').textContent = 'Editar Experiencia Laboral';
    document.getElementById('exp_id_experiencia').value = exp.id_experiencia;
    document.getElementById('exp_cargo').value = exp.cargo ?? '';
    document.getElementById('exp_empresa').value = exp.empresa ?? '';
    document.getElementById('exp_fecha_ini').value = exp.fecha_ini ? exp.fecha_ini.substring(0, 7) : '';
    document.getElementById('exp_fecha_fin').value = exp.fecha_fin ? exp.fecha_fin.substring(0, 7) : '';
    document.getElementById('exp_descripcion').value = exp.descripcion ?? '';
    
    const trabajoActual = (exp.trabajo_actual === 1 || exp.trabajo_actual === true);
    document.getElementById('exp_trabajo_actual').checked = trabajoActual;
    experienciaEditandoId = exp.id_experiencia;
    
    if (trabajoActual) {
        document.getElementById('exp_fecha_fin_container').style.opacity = '0.5';
        document.getElementById('exp_fecha_fin').disabled = true;
        document.getElementById('exp_fecha_fin').value = '';
    } else {
        document.getElementById('exp_fecha_fin_container').style.opacity = '1';
        document.getElementById('exp_fecha_fin').disabled = false;
    }
    
    document.getElementById('modalExperiencia').classList.remove('hidden');
    document.getElementById('modalExperiencia').classList.add('flex');
}

// ============================================
// CERRAR MODAL
// ============================================
function cerrarModalExperiencia() {
    document.getElementById('modalExperiencia').classList.add('hidden');
    document.getElementById('modalExperiencia').classList.remove('flex');
    experienciaEditandoId = null;
}

function cerrarModalExperienciaFondo(event) {
    if (event.target.id === 'modalExperiencia') {
        confirmarCancelarExperiencia();
    }
}

// ============================================
// CHECKBOX trabajo actual
// ============================================
document.getElementById('exp_trabajo_actual')?.addEventListener('change', function(e) {
    const fechaFinContainer = document.getElementById('exp_fecha_fin_container');
    const fechaFinInput = document.getElementById('exp_fecha_fin');
    
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
    toast.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg text-sm flex items-center gap-2 animate-in slide-in-from-right-5`;
    
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
function buildCardHTMLExperiencia(experiencia) {
    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    
    let fechaInicioStr = '';
    if (experiencia.fecha_ini) {
        const fecha = new Date(experiencia.fecha_ini);
        fechaInicioStr = `${meses[fecha.getMonth()]} ${fecha.getFullYear()}`;
    }
    
    let fechaFinStr = '';
    if (experiencia.trabajo_actual) {
        fechaFinStr = '<span class="text-green-600 font-medium">Actualidad</span>';
    } else if (experiencia.fecha_fin) {
        const fecha = new Date(experiencia.fecha_fin);
        fechaFinStr = `${meses[fecha.getMonth()]} ${fecha.getFullYear()}`;
    }
    
    const cargo = escapeHtml(experiencia.cargo || '');
    const empresa = escapeHtml(experiencia.empresa || '');
    const descripcion = escapeHtml(experiencia.descripcion || 'Sin descripción');
    
    return `
<div class="experiencia-item mb-6 last:mb-0 border-b border-gray-100 pb-4 last:border-0" data-id="${experiencia.id_experiencia}">
    <div class="flex justify-between items-start flex-wrap gap-2">
        <div class="flex-1">
            <h3 class="font-semibold text-gray-800">${cargo}</h3>
            <p class="text-blue-600 font-medium">${empresa}</p>
        </div>
        <div class="flex items-center gap-2">
            <p class="text-sm text-gray-500">
                ${fechaInicioStr} - ${fechaFinStr}
            </p>
            <button onclick='abrirModalEditarExperiencia(${JSON.stringify(experiencia).replace(/'/g, "\\'")})' 
                class="text-gray-400 hover:text-blue-500 transition">
                <i class="fas fa-edit"></i>
            </button>
            <button onclick="confirmarEliminarExperiencia(${experiencia.id_experiencia})" 
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
function submitExperiencia() {
    const btnGuardar = document.querySelector('#modalExperiencia button[onclick="confirmarGuardarExperiencia()"]');
    const textoOriginal = btnGuardar.innerHTML;
    btnGuardar.disabled = true;
    btnGuardar.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...';

    const trabajoActual = document.getElementById('exp_trabajo_actual').checked;

    const data = {
        cargo: document.getElementById('exp_cargo').value,
        empresa: document.getElementById('exp_empresa').value,
        fecha_ini: document.getElementById('exp_fecha_ini').value,
        fecha_fin: trabajoActual ? null : document.getElementById('exp_fecha_fin').value,
        descripcion: document.getElementById('exp_descripcion').value,
        trabajo_actual: trabajoActual ? 1 : 0
    };

    const url = experienciaEditandoId ? `/perfil/experiencia/${experienciaEditandoId}` : '/perfil/experiencia';
    const method = experienciaEditandoId ? 'PUT' : 'POST';

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
                resaltarErrorExperiencia('exp_cargo', msgs[0]);
                throw new Error('validation');
            });
        }
        return r.json();
    })
    .then(data => {
        if (data.success) {
            const experiencia = data.experiencia;
            const container = document.getElementById('experiencias-container');
            
            if (container.children.length === 1 && container.children[0].classList?.contains('text-center')) {
                container.innerHTML = '';
            }
            
            const cardHTML = buildCardHTMLExperiencia(experiencia);
            
            if (experienciaEditandoId) {
                const existing = container.querySelector(`.experiencia-item[data-id="${experiencia.id_experiencia}"]`);
                if (existing) {
                    existing.outerHTML = cardHTML;
                }
            } else {
                container.insertAdjacentHTML('afterbegin', cardHTML);
            }
            
            cerrarModalExperiencia();
            mostrarToast('Experiencia guardada correctamente', 'success');
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
function confirmarEliminarExperiencia(id) {
    CONFIRM_CONFIG_EXPERIENCIA.eliminar.accion = () => ejecutarEliminarExperiencia(id);
    mostrarConfirmacionExperiencia('eliminar');
}

// ============================================
// EJECUTAR ELIMINAR
// ============================================
function ejecutarEliminarExperiencia(id) {
    fetch(`/perfil/experiencia/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const card = document.querySelector(`.experiencia-item[data-id="${id}"]`);
            if (card) card.remove();
            
            const container = document.getElementById('experiencias-container');
            if (container && container.children.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8 text-gray-400">
                        <i class="fas fa-briefcase text-3xl mb-2"></i>
                        <p>No hay experiencia laboral registrada</p>
                        <p class="text-sm">Haz clic en "+ Agregar" para añadir</p>
                    </div>
                `;
            }
            
            mostrarToast('Experiencia eliminada correctamente', 'success');
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