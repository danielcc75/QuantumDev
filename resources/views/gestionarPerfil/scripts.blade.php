{{-- resources/views/gestionarPerfil/scripts.blade.php --}}

<script>
const CSRF_PERFIL = document.querySelector('meta[name="csrf-token"]').content;

// ── Configuración de confirmación ──────────────────────────────────────────────

const CONFIRM_CONFIG_PERFIL = {
    guardar: {
        titulo:    '¿Guardar cambios?',
        mensaje:   'Se actualizará tu información de perfil. Podrás editarla en cualquier momento.',
        icon:      'fas fa-save',
        iconBg:    'bg-blue-50',
        iconColor: 'text-blue-500',
        btnClass:  'bg-blue-500 hover:bg-blue-600',
        accion:    () => submitPerfil(),
    },
    cancelar: {
        titulo:    '¿Descartar cambios?',
        mensaje:   'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.',
        icon:      'fas fa-times-circle',
        iconBg:    'bg-yellow-50',
        iconColor: 'text-yellow-500',
        btnClass:  'bg-yellow-500 hover:bg-yellow-600',
        accion:    () => cerrarModalPerfil(),
    },
};

const EXITO_CONFIG_PERFIL = {
    exito: {
        titulo:    '¡Perfil Actualizado!',
        mensaje:   'Tu información de perfil se ha guardado correctamente.',
        icon:      'fas fa-check-circle',
        iconBg:    'bg-green-50',
        iconColor: 'text-green-500',
        btnClass:  'bg-green-500 hover:bg-green-600',
    }
};

function mostrarConfirmacionPerfil(tipo) {
    const cfg = CONFIRM_CONFIG_PERFIL[tipo];
    document.getElementById('confirmTituloPerfil').textContent  = cfg.titulo;
    document.getElementById('confirmMensajePerfil').textContent = cfg.mensaje;

    const wrapper = document.getElementById('confirmIconWrapperPerfil');
    wrapper.className = `w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 ${cfg.iconBg}`;

    const icon = document.getElementById('confirmIconPerfil');
    icon.className = `${cfg.icon} text-2xl ${cfg.iconColor}`;

    const btn = document.getElementById('confirmBtnPerfil');
    btn.className = `flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition ${cfg.btnClass}`;
    btn.onclick = () => { cerrarConfirmacionPerfil(); cfg.accion(); };
    
    const cancelBtn = document.querySelector('#modalConfirmacionPerfil .flex.gap-3 button:first-child');
    if (cancelBtn) {
        cancelBtn.style.display = tipo === 'exito' ? 'none' : 'block';
    }

    document.getElementById('modalConfirmacionPerfil').classList.remove('hidden');
    document.getElementById('modalConfirmacionPerfil').classList.add('flex');
}

function mostrarExitoPerfil() {
    const cfg = EXITO_CONFIG_PERFIL.exito;
    document.getElementById('confirmTituloPerfil').textContent  = cfg.titulo;
    document.getElementById('confirmMensajePerfil').textContent = cfg.mensaje;

    const wrapper = document.getElementById('confirmIconWrapperPerfil');
    wrapper.className = `w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 ${cfg.iconBg}`;

    const icon = document.getElementById('confirmIconPerfil');
    icon.className = `${cfg.icon} text-2xl ${cfg.iconColor}`;

    const btn = document.getElementById('confirmBtnPerfil');
    btn.className = `flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition ${cfg.btnClass}`;
    btn.onclick = () => { cerrarConfirmacionPerfil(); };
    
    const cancelBtn = document.querySelector('#modalConfirmacionPerfil .flex.gap-3 button:first-child');
    if (cancelBtn) {
        cancelBtn.style.display = 'none';
    }

    document.getElementById('modalConfirmacionPerfil').classList.remove('hidden');
    document.getElementById('modalConfirmacionPerfil').classList.add('flex');
    
    setTimeout(() => {
        cerrarConfirmacionPerfil();
    }, 2000);
}

function cerrarConfirmacionPerfil() {
    document.getElementById('modalConfirmacionPerfil').classList.add('hidden');
    document.getElementById('modalConfirmacionPerfil').classList.remove('flex');
    
    const cancelBtn = document.querySelector('#modalConfirmacionPerfil .flex.gap-3 button:first-child');
    if (cancelBtn) {
        cancelBtn.style.display = 'block';
    }
}

document.getElementById('modalConfirmacionPerfil')?.addEventListener('click', function(e) {
    if (e.target === this) cerrarConfirmacionPerfil();
});

// ── Helper: resaltar error ─────────────────────────────────────────────────────

function resaltarErrorPerfil(campoId, mensaje) {
    const el = document.getElementById(campoId);
    if (!el) return;
    el.classList.add('border-red-400', 'ring-2', 'ring-red-300');
    el.focus();
    setTimeout(() => el.classList.remove('border-red-400', 'ring-2', 'ring-red-300'), 2500);
    const prev = el.parentElement.querySelector('.error-msg');
    if (prev) prev.remove();
    const msg = document.createElement('p');
    msg.className = 'error-msg text-xs text-red-500 mt-1';
    msg.textContent = mensaje;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ── Actualizar la interfaz con los nuevos datos (CORREGIDO) ───────────────────

function actualizarInterfazPerfil(data) {
    // 1. Actualizar nombre completo en el header (dropdown)
    const nombreCompleto = data.usuario.nombre + ' ' + data.usuario.apellido;
    const headerNombre = document.querySelector('header .text-sm.font-medium.text-gray-700');
    if (headerNombre) headerNombre.textContent = nombreCompleto;
    
    // 2. Actualizar nombre en el perfil (h1 principal)
    const nombrePerfil = document.querySelector('.max-w-4xl.mx-auto .bg-white.rounded-2xl h1');
    if (nombrePerfil) nombrePerfil.textContent = nombreCompleto;
    
    // 3. Actualizar título profesional
    const tituloPerfil = document.querySelector('.max-w-4xl.mx-auto .bg-white.rounded-2xl .text-gray-500.mt-1');
    if (tituloPerfil && data.perfil.titulo_profesional) {
        tituloPerfil.textContent = data.perfil.titulo_profesional;
    }
    
    // 4. Actualizar ubicación
    const ubicacionSpan = document.querySelector('.max-w-4xl.mx-auto .bg-white.rounded-2xl .flex.flex-wrap .flex.items-center:first-child span:last-child');
    if (ubicacionSpan && data.perfil.ubicacion) {
        ubicacionSpan.textContent = data.perfil.ubicacion;
    }
    
    // 5. Actualizar correo electrónico
    const emailSpan = document.querySelector('.max-w-4xl.mx-auto .bg-white.rounded-2xl .flex.flex-wrap .flex.items-center:last-child span:last-child');
    if (emailSpan && data.usuario.correo_electronico) {
        emailSpan.textContent = data.usuario.correo_electronico;
    }
    
    // 6. Actualizar biografía
    const bioParrafo = document.querySelector('#perfil_biografia_texto');
    if (bioParrafo) {
        bioParrafo.textContent = data.perfil.biografia || 'Sin biografía. Haz clic en "Editar Perfil" para agregar una descripción.';
    }
    
    // 7. Actualizar foto en el header (dropdown)
    const dropdownButton = document.querySelector('header .dropdown button');
    if (dropdownButton) {
        let avatarContainer = dropdownButton.querySelector('.w-10.h-10, div:first-child');
        if (avatarContainer) {
            if (data.perfil.foto_perfil) {
                avatarContainer.innerHTML = `<img src="${data.perfil.foto_perfil}" class="w-full h-full rounded-full object-cover">`;
                avatarContainer.className = 'w-10 h-10 rounded-full object-cover shadow-md';
            } else {
                const iniciales = (data.usuario.nombre?.charAt(0) || 'U') + (data.usuario.apellido?.charAt(0) || 'S');
                avatarContainer.innerHTML = `<div class="w-full h-full bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                                                <span class="text-white text-sm font-bold">${iniciales.toUpperCase()}</span>
                                            </div>`;
                avatarContainer.className = 'w-10 h-10';
            }
        }
    }
    
    // 8. Actualizar foto en el perfil
    const fotoContainer = document.querySelector('.max-w-4xl.mx-auto .bg-white.rounded-2xl .flex-shrink-0');
    if (fotoContainer) {
        if (data.perfil.foto_perfil) {
            fotoContainer.innerHTML = `<img src="${data.perfil.foto_perfil}" alt="Foto de perfil" class="w-32 h-32 rounded-full object-cover border-4 border-blue-100">`;
        } else {
            const iniciales = (data.usuario.nombre?.charAt(0) || 'U') + (data.usuario.apellido?.charAt(0) || 'S');
            fotoContainer.innerHTML = `<div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center border-4 border-blue-100">
                                        <span class="text-white text-4xl font-bold">${iniciales.toUpperCase()}</span>
                                      </div>`;
        }
    }
    
    // 9. Actualizar links de redes sociales
    // Crear mapa de links
    const linksMap = {};
    (data.links || []).forEach(link => {
        linksMap[link.tipo] = link.url;
    });
    
    // Obtener el contenedor de redes sociales
    const socialContainer = document.querySelector('.max-w-4xl.mx-auto .bg-white.rounded-2xl .flex.flex-wrap.justify-center.md\\:justify-start.gap-3.mt-4');
    if (socialContainer) {
        // Limpiar y regenerar los links
        const linksConfig = {
            github: { icon: 'fab fa-github', color: 'hover:text-gray-900' },
            linkedin: { icon: 'fab fa-linkedin', color: 'hover:text-blue-700' },
            twitter: { icon: 'fab fa-twitter', color: 'hover:text-blue-400' },
            portfolio: { icon: 'fas fa-globe', color: 'hover:text-green-600' }
        };
        
        socialContainer.innerHTML = '';
        
        for (const [tipo, config] of Object.entries(linksConfig)) {
            if (linksMap[tipo] && linksMap[tipo].trim() !== '') {
                const link = document.createElement('a');
                link.href = linksMap[tipo];
                link.target = '_blank';
                link.className = `text-gray-600 ${config.color} transition-colors`;
                link.innerHTML = `<i class="${config.icon} text-xl"></i>`;
                socialContainer.appendChild(link);
            } else {
                const span = document.createElement('span');
                span.className = 'text-gray-300';
                span.innerHTML = `<i class="${config.icon} text-xl"></i>`;
                socialContainer.appendChild(span);
            }
        }
    }
}

// ── Modal Perfil ───────────────────────────────────────────────────────────────

function abrirModalPerfil() {
    document.getElementById('formPerfil').reset();
    
    fetch('{{ route("perfil.editar") }}')
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_nombre').value = data.usuario?.nombre || '';
            document.getElementById('edit_apellido').value = data.usuario?.apellido || '';
            document.getElementById('edit_correo').value = data.usuario?.correo_electronico || '';
            document.getElementById('edit_telefono').value = data.usuario?.telefono || '';
            document.getElementById('edit_biografia').value = data.perfil?.biografia || '';
            document.getElementById('edit_titulo').value = data.perfil?.titulo_profesional || '';
            document.getElementById('edit_ubicacion').value = data.perfil?.ubicacion || '';
            document.getElementById('edit_foto').value = data.perfil?.foto_perfil || '';
            
            const linksMap = {};
            (data.links || []).forEach(link => {
                linksMap[link.tipo] = link.url;
            });
            document.getElementById('link_github').value = linksMap.github || '';
            document.getElementById('link_linkedin').value = linksMap.linkedin || '';
            document.getElementById('link_twitter').value = linksMap.twitter || '';
            document.getElementById('link_portfolio').value = linksMap.portfolio || '';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cargar los datos del perfil');
        });
    
    document.getElementById('modalPerfil').classList.remove('hidden');
    document.getElementById('modalPerfil').classList.add('flex');
}

function cerrarModalPerfil() {
    document.getElementById('modalPerfil').classList.add('hidden');
    document.getElementById('modalPerfil').classList.remove('flex');
}

document.getElementById('modalPerfil')?.addEventListener('click', function(e) {
    if (e.target === this) confirmarCancelarPerfil();
});

// ── Disparadores de confirmación ──────────────────────────────────────────────

function confirmarGuardarPerfil() {
    const nombre = document.getElementById('edit_nombre').value.trim();
    const apellido = document.getElementById('edit_apellido').value.trim();
    const correo = document.getElementById('edit_correo').value.trim();

    if (!nombre) {
        resaltarErrorPerfil('edit_nombre', 'El nombre es obligatorio.');
        return;
    }
    if (!apellido) {
        resaltarErrorPerfil('edit_apellido', 'El apellido es obligatorio.');
        return;
    }
    if (!correo) {
        resaltarErrorPerfil('edit_correo', 'El correo electrónico es obligatorio.');
        return;
    }
    if (!correo.includes('@')) {
        resaltarErrorPerfil('edit_correo', 'Ingresa un correo electrónico válido.');
        return;
    }

    mostrarConfirmacionPerfil('guardar');
}

function confirmarCancelarPerfil() {
    const form = document.getElementById('formPerfil');
    const inputs = form.querySelectorAll('input, textarea');
    let hasChanges = false;
    inputs.forEach(input => {
        if (input.value && input.value.trim() !== '') {
            hasChanges = true;
        }
    });
    
    if (hasChanges) {
        mostrarConfirmacionPerfil('cancelar');
    } else {
        cerrarModalPerfil();
    }
}

// ── Enviar formulario y actualizar vista ──────────────────────────────────────

function submitPerfil() {
    const formData = new FormData(document.getElementById('formPerfil'));
    
    fetch('{{ route("perfil.actualizar") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalPerfil();
            return fetch('{{ route("perfil.editar") }}');
        } else {
            alert(data.message || 'Error al guardar');
            throw new Error('Error en guardado');
        }
    })
    .then(response => response.json())
    .then(data => {
        actualizarInterfazPerfil(data);
        mostrarExitoPerfil();
    })
    .catch(error => {
        console.error('Error:', error);
        if (error.message !== 'Error en guardado') {
            alert('Hubo un problema al guardar');
        }
    });
}

document.getElementById('formPerfil')?.addEventListener('submit', function(e) {
    e.preventDefault();
    confirmarGuardarPerfil();
});

// Cerrar con tecla ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('modalPerfil');
        if (modal && !modal.classList.contains('hidden')) {
            confirmarCancelarPerfil();
        }
    }
});

console.log('Scripts de perfil cargados correctamente');

</script>