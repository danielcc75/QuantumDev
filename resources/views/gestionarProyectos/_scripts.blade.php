{{-- resources/views/gestionarProyectos/_scripts.blade.php --}}

<script>
const CSRF    = document.querySelector('meta[name="csrf-token"]').content;
const USER_ID = {{ $userId }};

// ── Helpers de stats ──────────────────────────────────────────────────────────

function recalcularStats() {
    const cards = document.querySelectorAll('#proyectos-grid [data-proyecto-id]');
    let total = 0, enCurso = 0, finalizados = 0;
    cards.forEach(c => {
        total++;
        if (c.dataset.estado === 'en_progreso') enCurso++;
        if (c.dataset.estado === 'completado')  finalizados++;
    });
    document.getElementById('stat-total').textContent      = total;
    document.getElementById('stat-en-curso').textContent   = enCurso;
    document.getElementById('stat-finalizados').textContent = finalizados;

    const grid  = document.getElementById('proyectos-grid');
    const empty = document.getElementById('empty-state');
    if (total === 0) { grid.classList.add('hidden'); empty.classList.remove('hidden'); }
    else             { grid.classList.remove('hidden'); empty.classList.add('hidden'); }
}

// ── Construir HTML de tarjeta desde datos JS ──────────────────────────────────

const ESTADO_BADGE = {
    en_progreso: { label: 'en curso',   cls: 'bg-[#1e3a5f]/10 text-[#1e3a5f]'  },
    completado:  { label: 'finalizado', cls: 'bg-indigo-100 text-indigo-700'      },
    pendiente:   { label: 'pendiente',  cls: 'bg-gray-100 text-gray-600'         },
    cancelado:   { label: 'cancelado',  cls: 'bg-red-100 text-[#e11d48]'         },
};

const MESES = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

function formatFecha(str) {
    if (!str) return 'Presente';
    const d = new Date(str + 'T00:00:00');
    return `${String(d.getDate()).padStart(2,'0')} ${MESES[d.getMonth()]} ${d.getFullYear()}`;
}

// Extrae la parte YYYY-MM-DD de cualquier formato de fecha que devuelva Laravel
function toInputDate(str) {
    if (!str) return '';
    return String(str).substring(0, 10);
}

function buildCardHTML(p) {
    const badge    = ESTADO_BADGE[p.estado] ?? { label: p.estado, cls: 'bg-gray-100 text-gray-600' };
    const tags     = p.tecnologias ? p.tecnologias.split(',').map(t => t.trim()).filter(Boolean) : [];
    const esPublico = !!p.visible;
    const fechaIni  = formatFecha(p.fecha_ini);
    const fechaFin  = p.fecha_fin ? formatFecha(p.fecha_fin) : 'Presente';

    const tagsHTML = tags.map(t =>
        `<span class="text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2 py-0.5 rounded-md font-medium">${t}</span>`
    ).join('');

    const demoBtn = (p.url_link && esPublico)
        ? `<a href="${p.url_link}" target="_blank"
              class="flex items-center gap-2 text-xs font-medium bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-lg w-fit transition">
              <i class="fas fa-globe text-xs"></i> Ver Demo
              <i class="fas fa-external-link-alt text-xs"></i>
           </a>`
        : '';

    const toggleColor = esPublico ? 'bg-[#1e3a5f]'  : 'bg-gray-300';
    const thumbPos    = esPublico ? 'translate-x-4' : 'translate-x-1';
    const visLabel    = esPublico ? 'Público' : 'Privado';
    const visLabelCls = esPublico ? 'text-[#1e3a5f]' : 'text-gray-400';

    return `
<div class="bg-white rounded-2xl border border-gray-200 shadow-md p-5 flex flex-col gap-3 border-t-4 border-t-[#1e3a5f] hover:-translate-y-1 hover:shadow-xl transition-all duration-200"
     data-proyecto-id="${p.id_proyecto}"
     data-estado="${p.estado}">

    <div class="flex items-center justify-between gap-2">
        <h3 class="font-semibold text-[#1e3a5f] text-sm leading-snug line-clamp-1">${p.nombre}</h3>
        <span class="text-xs font-medium px-2 py-0.5 rounded-full whitespace-nowrap ${badge.cls}">
            ${badge.label}
        </span>
    </div>

    <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
        ${p.descripcion ?? 'Sin descripción'}
    </p>

    <div class="flex items-center text-xs text-gray-400 gap-1.5">
        <i class="fas fa-calendar-alt text-[#1e3a5f]/50"></i>
        <span>${fechaIni} – ${fechaFin}</span>
    </div>

    ${tags.length ? `<div class="flex flex-wrap gap-1.5">${tagsHTML}</div>` : ''}

    ${demoBtn}

    <div class="flex items-center gap-2 text-xs text-gray-500">
        <span>Visibilidad:</span>
        <span class="font-medium ${visLabelCls}">${visLabel}</span>
        <button onclick="toggleVisibilidad(${p.id_proyecto}, this)"
            data-visible="${esPublico ? '1' : '0'}"
            class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors ${toggleColor}">
            <span class="inline-block h-3.5 w-3.5 transform rounded-full bg-white shadow transition-transform ${thumbPos}"></span>
        </button>
    </div>

    <div class="flex gap-2 pt-1 border-t border-gray-100 mt-auto">
        <button onclick="abrirModalEditar(${p.id_proyecto})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-pencil-alt"></i> Editar
        </button>
        <button onclick="eliminarProyecto(${p.id_proyecto})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-trash"></i> Eliminar
        </button>
    </div>
</div>`;
}

// ── Modal de Confirmación ─────────────────────────────────────────────────────

const CONFIRM_CONFIG = {
    guardar: {
        titulo:     '¿Guardar proyecto?',
        mensaje:    'Se almacenará toda la información ingresada. Podrás editarla en cualquier momento.',
        icon:       'fas fa-save',
        iconBg:     'bg-[#1e3a5f]/10',
        iconColor:  'text-[#1e3a5f]',
        headerColor:'bg-[#1e3a5f]',
        btnClass:   'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80',
        accion:     () => submitProyecto(),
    },
    cancelar: {
        titulo:     '¿Descartar cambios?',
        mensaje:    'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.',
        icon:       'fas fa-times-circle',
        iconBg:     'bg-gray-100',
        iconColor:  'text-gray-500',
        headerColor:'bg-gray-400',
        btnClass:   'bg-gray-500 hover:bg-gray-600',
        accion:     () => cerrarModalProyecto(),
    },
    editar: {
        titulo:     '¿Editar este proyecto?',
        mensaje:    'Vas a modificar la información de este proyecto. Podrás cancelar si cambias de opinión.',
        icon:       'fas fa-pencil-alt',
        iconBg:     'bg-[#1e3a5f]/10',
        iconColor:  'text-[#1e3a5f]',
        headerColor:'bg-[#1e3a5f]',
        btnClass:   'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80',
        accion:     null,
    },
    eliminar: {
        titulo:     '¿Eliminar proyecto?',
        mensaje:    'Esta acción es permanente y no se puede deshacer. El proyecto será eliminado definitivamente.',
        icon:       'fas fa-trash-alt',
        iconBg:     'bg-[#e11d48]/10',
        iconColor:  'text-[#e11d48]',
        headerColor:'bg-[#e11d48]',
        btnClass:   'bg-[#e11d48] hover:bg-[#e11d48]/80',
        accion:     null,
    },
};

function mostrarConfirmacion(tipo) {
    const cfg = CONFIRM_CONFIG[tipo];
    document.getElementById('confirmTitulo').textContent  = cfg.titulo;
    document.getElementById('confirmMensaje').textContent = cfg.mensaje;
    document.getElementById('confirmHeader').className    = `h-1.5 w-full ${cfg.headerColor}`;

    const wrapper = document.getElementById('confirmIconWrapper');
    wrapper.className = `w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 ${cfg.iconBg}`;

    const icon = document.getElementById('confirmIcon');
    icon.className = `${cfg.icon} text-2xl ${cfg.iconColor}`;

    const btn = document.getElementById('confirmBtn');
    btn.className = `flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition ${cfg.btnClass}`;
    btn.onclick = () => { cerrarConfirmacion(); cfg.accion(); };

    document.getElementById('modalConfirmacion').classList.remove('hidden');
    document.getElementById('modalConfirmacion').classList.add('flex');
}

function cerrarConfirmacion() {
    document.getElementById('modalConfirmacion').classList.add('hidden');
    document.getElementById('modalConfirmacion').classList.remove('flex');
}

document.getElementById('modalConfirmacion').addEventListener('click', function(e) {
    if (e.target === this) cerrarConfirmacion();
});

// ── Disparadores de confirmación ──────────────────────────────────────────────

function confirmarGuardar() {
    const nombre   = document.getElementById('proj_nombre').value.trim();
    const fechaIni = document.getElementById('proj_fecha_ini').value;
    const fechaFin = document.getElementById('proj_fecha_fin').value;
    const urlLink  = document.getElementById('proj_url_link').value.trim();

    // Nombre obligatorio y máx. 100 caracteres
    if (!nombre) {
        resaltarError('proj_nombre', 'El nombre del proyecto es obligatorio.');
        return;
    }
    if (nombre.length > 100) {
        resaltarError('proj_nombre', 'El nombre no puede superar los 100 caracteres.');
        return;
    }

    // Fecha de inicio obligatoria
    if (!fechaIni) {
        resaltarError('proj_fecha_ini', 'La fecha de inicio es obligatoria.');
        return;
    }

    // Fecha de finalización no puede ser anterior a inicio
    if (fechaFin && fechaFin < fechaIni) {
        resaltarError('proj_fecha_fin', 'La fecha de finalización no puede ser anterior a la de inicio.');
        return;
    }

    // Si la fecha de fin es anterior a hoy, el enlace es obligatorio
    const hoy = new Date().toISOString().split('T')[0];
    if (fechaFin && fechaFin < hoy) {
        if (!urlLink) {
            resaltarError('proj_url_link', 'El proyecto ya finalizó. El enlace es obligatorio.');
            return;
        }
    }

    // URL válida (si se proporcionó)
    if (urlLink) {
        try { new URL(urlLink); } catch (_) {
            resaltarError('proj_url_link', 'Ingresa una URL válida (ej: https://miproyecto.com).');
            return;
        }
    }

    mostrarConfirmacion('guardar');
}

function confirmarCancelar() {
    const nombre = document.getElementById('proj_nombre').value.trim();
    const desc   = document.getElementById('proj_descripcion').value.trim();
    if (nombre || desc) { mostrarConfirmacion('cancelar'); }
    else { cerrarModalProyecto(); }
}

function confirmarEliminar(id) {
    CONFIRM_CONFIG.eliminar.accion = () => ejecutarEliminar(id);
    mostrarConfirmacion('eliminar');
}

function confirmarEditar(id) {
    CONFIRM_CONFIG.editar.accion = () => ejecutarAbrirEditar(id);
    mostrarConfirmacion('editar');
}

// ── Helper: resaltar campo con error ─────────────────────────────────────────

function resaltarError(campoId, mensaje) {
    const el = document.getElementById(campoId);
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

// ── Datos de tecnologías por categoría ───────────────────────────────────────

window.TECNOLOGIAS_POR_CATEGORIA = {
    'Frontend':              ['React', 'Vue.js', 'Angular', 'Svelte', 'Next.js', 'Nuxt.js', 'HTML', 'CSS', 'Tailwind CSS', 'Bootstrap', 'jQuery', 'TypeScript'],
    'Backend':               ['Node.js', 'Express', 'Django', 'FastAPI', 'Spring Boot', 'Laravel', 'Ruby on Rails', 'ASP.NET', 'Flask', 'NestJS', 'Phoenix'],
    'Lenguajes':             ['JavaScript', 'TypeScript', 'Python', 'Java', 'C#', 'C++', 'C', 'PHP', 'Ruby', 'Go', 'Rust', 'Swift', 'Kotlin', 'Dart', 'R'],
    'Bases de Datos':        ['MySQL', 'PostgreSQL', 'MongoDB', 'SQLite', 'Redis', 'MariaDB', 'Oracle', 'SQL Server', 'Cassandra', 'Firebase', 'Supabase'],
    'Cloud & DevOps':        ['AWS', 'Google Cloud', 'Azure', 'Docker', 'Kubernetes', 'GitHub Actions', 'GitLab CI', 'Terraform', 'Ansible', 'Jenkins', 'Nginx'],
    'Mobile':                ['React Native', 'Flutter', 'Android', 'iOS', 'Ionic', 'Xamarin', 'Expo'],
    'APIs & Real-time':      ['REST API', 'GraphQL', 'WebSockets', 'gRPC', 'Swagger', 'Postman', 'Socket.io'],
    'Testing':               ['Jest', 'PHPUnit', 'Cypress', 'Selenium', 'Pytest', 'JUnit', 'Mocha', 'Vitest'],
    'Data Science & ML':     ['TensorFlow', 'PyTorch', 'Scikit-learn', 'Pandas', 'NumPy', 'Keras', 'OpenCV', 'Jupyter'],
    'Diseño & Prototipado':  ['Figma', 'Adobe XD', 'Sketch', 'InVision', 'Canva'],
    'Gestión de Proyectos':  ['Git', 'GitHub', 'GitLab', 'Jira', 'Trello', 'Notion', 'Slack', 'Linear'],
};

function filtrarTecnologias() {
    const categoria  = document.getElementById('proj_categoria_select').value;
    const container  = document.getElementById('proj_chips_container');
    const chipsDiv   = document.getElementById('proj_chips');

    chipsDiv.innerHTML = '';

    if (!categoria || !TECNOLOGIAS_POR_CATEGORIA[categoria]) {
        container.classList.add('hidden');
        return;
    }

    const yaAgregadas = getTags();

    TECNOLOGIAS_POR_CATEGORIA[categoria].forEach(tec => {
        const chip = document.createElement('button');
        chip.type      = 'button';
        chip.dataset.tec = tec;
        chip.textContent = tec;

        if (yaAgregadas.includes(tec)) {
            // Ya está en los tags → mostrar deshabilitado
            chip.className = 'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed';
            chip.disabled  = true;
        } else {
            chip.className = 'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none';
            chip.addEventListener('click', () => toggleChip(chip));
        }

        chipsDiv.appendChild(chip);
    });

    container.classList.remove('hidden');
}

function toggleChip(chip) {
    const activo = chip.dataset.activo === '1';
    if (activo) {
        chip.dataset.activo = '0';
        chip.className = 'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none';
    } else {
        chip.dataset.activo = '1';
        chip.className = 'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f] bg-[#1e3a5f] text-white transition cursor-pointer select-none';
    }
}

// ── Fecha fin → estado y enlace obligatorio ───────────────────────────────────

function verificarFechaFinProyecto() {
    const fechaFin = document.getElementById('proj_fecha_fin').value;
    const hoy      = new Date().toISOString().split('T')[0];
    const pasado   = fechaFin && fechaFin < hoy;

    document.getElementById('proj_estado').value = pasado ? 'completado' : 'en_progreso';
}

// ── Tags de tecnologías ───────────────────────────────────────────────────────

function renderizarTags(tags) {
    const container = document.getElementById('proj_tags');
    container.innerHTML = '';
    tags.forEach((tag, i) => {
        const span = document.createElement('span');
        span.className = 'flex items-center gap-1 text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/20 px-2.5 py-1 rounded-full';
        span.innerHTML = `${tag} <button type="button" onclick="eliminarTag(${i})" class="text-blue-400 hover:text-red-500 ml-1"><i class="fas fa-times text-xs"></i></button>`;
        container.appendChild(span);
    });
}

function getTags() {
    const val = document.getElementById('proj_tecnologias').value;
    return val ? val.split(',').map(t => t.trim()).filter(Boolean) : [];
}

function setTags(tags) {
    document.getElementById('proj_tecnologias').value = tags.join(', ');
    renderizarTags(tags);
}

function agregarTecnologia() {
    const seleccionados = document.querySelectorAll('#proj_chips [data-activo="1"]');
    if (!seleccionados.length) return;

    const tags = getTags();
    seleccionados.forEach(chip => {
        const tec = chip.dataset.tec;
        if (!tags.includes(tec)) tags.push(tec);
    });
    setTags(tags);

    // Marcar los chips agregados como deshabilitados
    seleccionados.forEach(chip => {
        chip.dataset.activo = '0';
        chip.className = 'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed';
        chip.disabled  = true;
        chip.removeEventListener('click', toggleChip);
    });
}

function eliminarTag(index) {
    const tags = getTags();
    tags.splice(index, 1);
    setTags(tags);
}

// ── Validación en tiempo real de URL ─────────────────────────────────────────

document.getElementById('proj_url_link').addEventListener('input', function() {
    const val    = this.value.trim();
    const status = document.getElementById('url_status');
    const hint   = document.getElementById('url_hint');
    const input  = this;

    if (!val) {
        // Campo vacío → estado neutro
        status.classList.add('hidden');
        input.classList.remove('border-[#1e3a5f]', 'border-red-400', 'ring-2', 'ring-[#1e3a5f]/20', 'ring-red-200');
        input.classList.add('border-gray-200');
        hint.textContent = 'Enlace a la aplicación o sitio web en producción desarrollada para el cliente';
        hint.className   = 'text-xs text-gray-400 mt-1';
        return;
    }

    let valid = false;
    try { new URL(val); valid = true; } catch (_) {}

    status.classList.remove('hidden');
    input.classList.remove('border-gray-200', 'border-[#1e3a5f]', 'border-red-400', 'ring-[#1e3a5f]/20', 'ring-red-200');
    input.classList.add('ring-2');

    if (valid) {
        status.innerHTML  = '<i class="fas fa-check-circle text-[#1e3a5f]"></i>';
        input.classList.add('border-[#1e3a5f]', 'ring-[#1e3a5f]/20');
        hint.textContent = '✓ URL válida';
        hint.className   = 'text-xs text-[#1e3a5f] mt-1 font-medium';
    } else {
        status.innerHTML  = '<i class="fas fa-times-circle text-red-400"></i>';
        input.classList.add('border-red-400', 'ring-red-200');
        hint.textContent = 'URL no válida. Debe comenzar con https:// o http://';
        hint.className   = 'text-xs text-red-500 mt-1';
    }
});


// ── Toggle visible en modal ───────────────────────────────────────────────────

function toggleVisibleModal() {
    const btn   = document.getElementById('toggleVisible');
    const thumb = document.getElementById('toggleThumb');
    const input = document.getElementById('proj_visible');
    const isOn  = btn.dataset.on === '1';
    if (isOn) {
        btn.dataset.on = '0';
        btn.classList.replace('bg-[#1e3a5f]', 'bg-gray-300');
        thumb.classList.replace('translate-x-6', 'translate-x-1');
        input.value = '0';
    } else {
        btn.dataset.on = '1';
        btn.classList.replace('bg-gray-300', 'bg-[#1e3a5f]');
        thumb.classList.replace('translate-x-1', 'translate-x-6');
        input.value = '1';
    }
}

// ── Modal Proyecto ────────────────────────────────────────────────────────────

function resetToggle(on) {
    const btn   = document.getElementById('toggleVisible');
    const thumb = document.getElementById('toggleThumb');
    btn.dataset.on = on ? '1' : '0';
    if (on) {
        btn.classList.add('bg-[#1e3a5f]');   btn.classList.remove('bg-gray-300');
        thumb.classList.add('translate-x-6'); thumb.classList.remove('translate-x-1');
    } else {
        btn.classList.add('bg-gray-300');    btn.classList.remove('bg-[#1e3a5f]');
        thumb.classList.add('translate-x-1'); thumb.classList.remove('translate-x-6');
    }
    document.getElementById('proj_visible').value = on ? '1' : '0';
}

function resetUrlStatus() {
    const input  = document.getElementById('proj_url_link');
    const status = document.getElementById('url_status');
    const hint   = document.getElementById('url_hint');
    input.classList.remove('border-green-400', 'border-red-400', 'ring-2', 'ring-green-200', 'ring-red-200');
    input.classList.add('border-gray-200');
    status.classList.add('hidden');
    hint.textContent = 'Enlace a la aplicación o sitio web en producción desarrollada para el cliente';
    hint.className   = 'text-xs text-gray-400 mt-1';
}

function abrirModalProyecto() {
    document.getElementById('proyectoId').value = '';
    document.getElementById('formProyecto').reset();
    document.getElementById('proj_tecnologias').value = '';
    document.getElementById('proj_tags').innerHTML = '';
    document.getElementById('proj_categoria_select').value = '';
    document.getElementById('proj_chips').innerHTML = '';
    document.getElementById('proj_chips_container').classList.add('hidden');
    document.getElementById('modalProyectoTitulo').textContent = 'Crear Nuevo Proyecto';
    resetToggle(true);
    resetUrlStatus();
    document.getElementById('modalProyecto').classList.remove('hidden');
    document.getElementById('modalProyecto').classList.add('flex');
}

function cerrarModalProyecto() {
    document.getElementById('modalProyecto').classList.add('hidden');
    document.getElementById('modalProyecto').classList.remove('flex');
}

document.getElementById('modalProyecto').addEventListener('click', function(e) {
    if (e.target === this) confirmarCancelar();
});

// ── Editar ────────────────────────────────────────────────────────────────────

function ejecutarAbrirEditar(id) {
    fetch(`/proyectos/${id}`)
        .then(r => r.json())
        .then(p => {
            document.getElementById('proyectoId').value       = p.id_proyecto;
            document.getElementById('proj_nombre').value      = p.nombre       ?? '';
            document.getElementById('proj_descripcion').value = p.descripcion  ?? '';
            document.getElementById('proj_fecha_ini').value   = toInputDate(p.fecha_ini);
            document.getElementById('proj_fecha_fin').value   = toInputDate(p.fecha_fin);
            document.getElementById('proj_estado').value      = p.estado       ?? 'pendiente';
            const urlInput = document.getElementById('proj_url_link');
            urlInput.value = p.url_link ?? '';
            urlInput.dispatchEvent(new Event('input')); // activa el indicador visual
            document.getElementById('proj_referencias').value = p.referencias  ?? '';
            document.getElementById('proj_categoria_select').value = '';
            document.getElementById('proj_chips').innerHTML = '';
            document.getElementById('proj_chips_container').classList.add('hidden');
            setTags(p.tecnologias ? p.tecnologias.split(',').map(t => t.trim()).filter(Boolean) : []);
            resetToggle(!!p.visible);
            document.getElementById('modalProyectoTitulo').textContent = 'Editar Proyecto';
            document.getElementById('modalProyecto').classList.remove('hidden');
            document.getElementById('modalProyecto').classList.add('flex');
        });
}

function abrirModalEditar(id) { confirmarEditar(id); }

// ── Crear / Actualizar ────────────────────────────────────────────────────────

function submitProyecto() {
    const id     = document.getElementById('proyectoId').value;
    const url    = id ? `/proyectos/${id}` : '/proyectos';
    const method = id ? 'PUT' : 'POST';

    fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({
            user_id:     USER_ID,
            nombre:      document.getElementById('proj_nombre').value.trim(),
            descripcion: document.getElementById('proj_descripcion').value,
            fecha_ini:   document.getElementById('proj_fecha_ini').value || null,
            fecha_fin:   document.getElementById('proj_fecha_fin').value || null,
            estado:      document.getElementById('proj_estado').value,
            tecnologias: document.getElementById('proj_tecnologias').value,
            url_link:    document.getElementById('proj_url_link').value.trim() || null,
            referencias: document.getElementById('proj_referencias').value,
            visible:     parseInt(document.getElementById('proj_visible').value),
        })
    })
    .then(r => {
        if (r.status === 422) {
            return r.json().then(err => {
                const msgs = err.errors ? Object.values(err.errors).flat() : [err.message ?? 'Error de validación'];
                resaltarError('proj_nombre', msgs[0]);
                throw new Error('validation');
            });
        }
        return r.json();
    })
    .then(data => {
        if (!data || !data.success) { alert(data?.message ?? 'Error al guardar'); return; }

        cerrarModalProyecto();
        const p        = data.proyecto;
        const cardHTML = buildCardHTML(p);
        const grid     = document.getElementById('proyectos-grid');

        if (id) {
            // Editar: reemplazar tarjeta existente
            const existing = grid.querySelector(`[data-proyecto-id="${p.id_proyecto}"]`);
            if (existing) existing.outerHTML = cardHTML;
        } else {
            // Crear: insertar al inicio del grid
            grid.insertAdjacentHTML('afterbegin', cardHTML);
        }

        recalcularStats();
    });
}

document.getElementById('formProyecto').addEventListener('submit', function(e) {
    e.preventDefault();
    confirmarGuardar();
});

// ── Eliminar ──────────────────────────────────────────────────────────────────

function ejecutarEliminar(id) {
    fetch(`/proyectos/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF }
    })
    .then(r => r.json())
    .then(data => {
        if (!data.success) return;
        const card = document.querySelector(`[data-proyecto-id="${id}"]`);
        if (card) card.remove();
        recalcularStats();
    });
}

function eliminarProyecto(id) { confirmarEliminar(id); }

// ── Toggle visibilidad (en la tarjeta) ───────────────────────────────────────

function toggleVisibilidad(id, btn) {
    const visible = btn.dataset.visible === '1' ? 0 : 1;
    fetch(`/proyectos/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ visible })
    })
    .then(r => r.json())
    .then(data => {
        if (!data.success) return;
        const p    = data.proyecto;
        const card = document.querySelector(`[data-proyecto-id="${id}"]`);
        if (card) card.outerHTML = buildCardHTML(p);
    });
}
</script>
