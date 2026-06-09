{{-- resources/views/gestionarProyectos/_scripts.blade.php --}}

<script>
const CSRF    = document.querySelector('meta[name="csrf-token"]').content;
const USER_ID = {{ $userId }};

// ── Helpers ───────────────────────────────────────────────────────────────────

function apiFetch(url, options = {}) {
    return fetch(url, {
        ...options,
        headers: {
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            ...options.headers,
        },
    });
}

function isValidUrl(str) {
    try { new URL(str); return true; } catch (_) { return false; }
}

function setModalVisible(id, show) {
    document.getElementById(id).classList.toggle('hidden', !show);
    document.getElementById(id).classList.toggle('flex',   show);
}

// ── Stats ─────────────────────────────────────────────────────────────────────

function recalcularStats() {
    const cards = document.querySelectorAll('#proyectos-grid [data-proyecto-id]');
    let total = 0, enCurso = 0, finalizados = 0;
    cards.forEach(c => {
        total++;
        if (c.dataset.estado === 'en_progreso') enCurso++;
        if (c.dataset.estado === 'completado')  finalizados++;
    });
    document.getElementById('stat-total').textContent       = total;
    document.getElementById('stat-en-curso').textContent    = enCurso;
    document.getElementById('stat-finalizados').textContent = finalizados;

    document.getElementById('proyectos-grid').classList.toggle('hidden', total === 0);
    document.getElementById('empty-state').classList.toggle('hidden',   total !== 0);

    // Actualizar stats del Resumen general
    const resumenRepos = document.getElementById('resumen-stat-repos');
    if (resumenRepos) resumenRepos.textContent = total;
    const resumenActividades = document.getElementById('resumen-stat-actividades');
    if (resumenActividades) resumenActividades.textContent = (total * 45).toLocaleString();
}

// ── Construir HTML de tarjeta ─────────────────────────────────────────────────

const ESTADO_BADGE = {
    en_progreso: { label: __t('js.proyectos.badge_en_curso'),   cls: 'bg-[#1e3a5f]/10 text-[#1e3a5f]' },
    completado:  { label: __t('js.proyectos.badge_finalizado'), cls: 'bg-indigo-100 text-indigo-700'   },
    pendiente:   { label: __t('js.proyectos.badge_pendiente'),  cls: 'bg-gray-100 text-gray-600'       },
    cancelado:   { label: __t('js.proyectos.badge_cancelado'),  cls: 'bg-red-100 text-[#e11d48]'       },
};

const MESES = (window.__lang?.js?.dashboard?.meses_corto)
    || ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

function formatFecha(str) {
    if (!str) return __t('js.proyectos.presente');
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
    const fechaFin = p.fecha_fin ? formatFecha(p.fecha_fin) : __t('js.proyectos.presente');

    const tagsHTML = tags.map(t =>
        `<span class="text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2 py-0.5 rounded-md font-medium">${t}</span>`
    ).join('');

    const demoBtn = p.url_link
        ? `<a href="${p.url_link}" target="_blank"
              class="flex items-center gap-2 text-xs font-medium bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-lg w-fit transition">
              <i class="fas fa-globe text-xs"></i> ${__t('js.proyectos.ver_demo')}
              <i class="fas fa-external-link-alt text-xs"></i>
           </a>`
        : '';

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
        ${p.descripcion ?? __t('js.proyectos.sin_descripcion')}
    </p>

    <div class="flex items-center text-xs text-gray-400 gap-1.5">
        <i class="fas fa-calendar-alt text-[#1e3a5f]/50"></i>
        <span>${formatFecha(p.fecha_ini)} – ${fechaFin}</span>
    </div>

    ${tags.length ? `<div class="flex flex-wrap gap-1.5">${tagsHTML}</div>` : ''}

    ${demoBtn}

    <div class="flex gap-2 pt-1 border-t border-gray-100 mt-auto">
        <button onclick="confirmarEditar(${p.id_proyecto})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-pencil-alt"></i> ${__t('common.editar')}
        </button>
        <button onclick="confirmarEliminar(${p.id_proyecto})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-trash"></i> ${__t('common.eliminar')}
        </button>
    </div>
</div>`;
}

// ── Modal de Confirmación ─────────────────────────────────────────────────────

const CONFIRM_CONFIG = {
    guardar: {
        titulo:     __t('js.proyectos.confirm_guardar_titulo'),
        mensaje:    __t('js.proyectos.confirm_guardar_mensaje'),
        icon:       'fas fa-save',
        iconBg:     'bg-[#1e3a5f]/10',
        iconColor:  'text-[#1e3a5f]',
        headerColor:'bg-[#1e3a5f]',
        btnClass:   'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80',
        accion:     () => submitProyecto(),
    },
    cancelar: {
        titulo:     __t('js.proyectos.confirm_cancelar_titulo'),
        mensaje:    __t('js.proyectos.confirm_cancelar_mensaje'),
        icon:       'fas fa-times-circle',
        iconBg:     'bg-[#1e3a5f]/10',
        iconColor:  'text-[#1e3a5f]',
        headerColor:'bg-[#1e3a5f]',
        btnClass:   'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90',
        accion:     () => cerrarModalProyecto(),
    },
    editar: {
        titulo:     __t('js.proyectos.confirm_editar_titulo'),
        mensaje:    __t('js.proyectos.confirm_editar_mensaje'),
        icon:       'fas fa-pencil-alt',
        iconBg:     'bg-[#1e3a5f]/10',
        iconColor:  'text-[#1e3a5f]',
        headerColor:'bg-[#1e3a5f]',
        btnClass:   'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80',
        accion:     null,
    },
    eliminar: {
        titulo:     __t('js.proyectos.confirm_eliminar_titulo'),
        mensaje:    __t('js.proyectos.confirm_eliminar_mensaje'),
        icon:       'fas fa-trash-alt',
        iconBg:     'bg-[#1e3a5f]/10',
        iconColor:  'text-[#1e3a5f]',
        headerColor:'bg-[#1e3a5f]',
        btnClass:   'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90',
        accion:     null,
    },
};

function mostrarConfirmacion(tipo) {
    const cfg = CONFIRM_CONFIG[tipo];
    if (!cfg) return;
    window.confirmar({
        titulo:      cfg.titulo,
        mensaje:     cfg.mensaje,
        icon:        cfg.icon,
        iconBg:      cfg.iconBg,
        iconColor:   cfg.iconColor,
        headerColor: cfg.headerColor,
        btnClass:    cfg.btnClass,
        onConfirm:   cfg.accion,
    });
}

// ── Disparadores de confirmación ──────────────────────────────────────────────

function confirmarGuardar() {
    const nombre   = document.getElementById('proj_nombre').value.trim();
    const fechaIni = document.getElementById('proj_fecha_ini').value;
    const fechaFin = document.getElementById('proj_fecha_fin').value;
    const urlLink  = document.getElementById('proj_url_link').value.trim();

    if (!nombre) {
        resaltarError('proj_nombre', __t('js.proyectos.err_nombre_req'));
        return;
    }
    if (nombre.length > 100) {
        resaltarError('proj_nombre', __t('js.proyectos.err_nombre_max'));
        return;
    }
    if (!fechaIni) {
        resaltarError('proj_fecha_ini', __t('js.proyectos.err_fecha_ini_req'));
        return;
    }
    const estado = document.getElementById('proj_estado').value;
    if (estado === 'completado' && !fechaFin) {
        resaltarError('proj_fecha_fin', __t('js.proyectos.err_fecha_fin_completado'));
        return;
    }
    const hoyStr = new Date().toISOString().split('T')[0];
    if (estado === 'completado' && fechaFin && fechaFin > hoyStr) {
        resaltarError('proj_fecha_fin', __t('js.proyectos.err_fecha_fin_futuro'));
        return;
    }
    if (fechaFin && fechaFin < fechaIni) {
        resaltarError('proj_fecha_fin', __t('js.proyectos.err_fecha_fin_inv'));
        return;
    }

    const hoy = new Date().toISOString().split('T')[0];
    if (fechaFin && fechaFin < hoy && !urlLink) {
        resaltarError('proj_url_link', __t('js.proyectos.err_url_obligatorio'));
        return;
    }
    if (urlLink && !isValidUrl(urlLink)) {
        resaltarError('proj_url_link', __t('js.proyectos.err_url_invalida'));
        return;
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
    msg.className   = 'error-msg text-xs text-red-500 mt-1';
    msg.textContent = mensaje;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ── Tecnologías por categoría ─────────────────────────────────────────────────

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

const CHIP_ACTIVE_CLS   = 'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f] bg-[#1e3a5f] text-white transition cursor-pointer select-none';
const CHIP_INACTIVE_CLS = 'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none';
const CHIP_DISABLED_CLS = 'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed';

function filtrarTecnologias() {
    const categoria = document.getElementById('proj_categoria_select').value;
    const container = document.getElementById('proj_chips_container');
    const chipsDiv  = document.getElementById('proj_chips');

    chipsDiv.innerHTML = '';

    if (!categoria || !TECNOLOGIAS_POR_CATEGORIA[categoria]) {
        container.classList.add('hidden');
        return;
    }

    const yaAgregadas = getTags();

    TECNOLOGIAS_POR_CATEGORIA[categoria].forEach(tec => {
        const chip = document.createElement('button');
        chip.type        = 'button';
        chip.dataset.tec = tec;
        chip.textContent = tec;

        if (yaAgregadas.includes(tec)) {
            chip.className = CHIP_DISABLED_CLS;
            chip.disabled  = true;
        } else {
            chip.className = CHIP_INACTIVE_CLS;
            chip.addEventListener('click', () => toggleChip(chip));
        }

        chipsDiv.appendChild(chip);
    });

    container.classList.remove('hidden');
}

function toggleChip(chip) {
    const activo = chip.dataset.activo === '1';
    chip.dataset.activo = activo ? '0' : '1';
    chip.className      = activo ? CHIP_INACTIVE_CLS : CHIP_ACTIVE_CLS;
}

// ── Estado → fecha fin ────────────────────────────────────────────────────────

function actualizarFechaFinSegunEstado() {
    const estado    = document.getElementById('proj_estado').value;
    const fechaFin  = document.getElementById('proj_fecha_fin');
    const required  = document.getElementById('proj_fecha_fin_required');
    const hint      = document.getElementById('proj_fecha_fin_hint');
    const completado = estado === 'completado';

    fechaFin.disabled = !completado;
    required.classList.toggle('hidden', !completado);

    if (completado) {
        fechaFin.max     = new Date().toISOString().split('T')[0];
        hint.textContent = __t('js.proyectos.hint_completado_max');
        hint.className   = 'text-xs text-[#e11d48] mt-1';
    } else {
        fechaFin.value   = '';
        fechaFin.removeAttribute('max');
        hint.textContent = __t('js.proyectos.hint_completado_disabled');
        hint.className   = 'text-xs text-gray-400 mt-1';
    }
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
        if (!tags.includes(chip.dataset.tec)) tags.push(chip.dataset.tec);
    });
    setTags(tags);

    seleccionados.forEach(chip => {
        chip.dataset.activo = '0';
        chip.className = CHIP_DISABLED_CLS;
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

    if (!val) {
        status.classList.add('hidden');
        this.classList.remove('border-[#1e3a5f]', 'border-red-400', 'ring-2', 'ring-[#1e3a5f]/20', 'ring-red-200');
        this.classList.add('border-gray-200');
        hint.textContent = __t('js.proyectos.url_hint_default');
        hint.className   = 'text-xs text-gray-400 mt-1';
        return;
    }

    const valid = isValidUrl(val);
    status.classList.remove('hidden');
    this.classList.remove('border-gray-200', 'border-[#1e3a5f]', 'border-red-400', 'ring-[#1e3a5f]/20', 'ring-red-200');
    this.classList.add('ring-2');

    if (valid) {
        status.innerHTML = '<i class="fas fa-check-circle text-[#1e3a5f]"></i>';
        this.classList.add('border-[#1e3a5f]', 'ring-[#1e3a5f]/20');
        hint.textContent = __t('js.proyectos.url_valida');
        hint.className   = 'text-xs text-[#1e3a5f] mt-1 font-medium';
    } else {
        status.innerHTML = '<i class="fas fa-times-circle text-red-400"></i>';
        this.classList.add('border-red-400', 'ring-red-200');
        hint.textContent = __t('js.proyectos.url_invalida');
        hint.className   = 'text-xs text-red-500 mt-1';
    }
});

function resetUrlStatus() {
    const input  = document.getElementById('proj_url_link');
    const status = document.getElementById('url_status');
    const hint   = document.getElementById('url_hint');
    input.classList.remove('border-green-400', 'border-red-400', 'ring-2', 'ring-green-200', 'ring-red-200');
    input.classList.add('border-gray-200');
    status.classList.add('hidden');
    hint.textContent = __t('js.proyectos.url_hint_default');
    hint.className   = 'text-xs text-gray-400 mt-1';
}

// ── Modal Proyecto ────────────────────────────────────────────────────────────

function abrirModalProyecto() {
    document.getElementById('proyectoId').value = '';
    document.getElementById('formProyecto').reset();
    document.getElementById('proj_tecnologias').value = '';
    document.getElementById('proj_tags').innerHTML = '';
    document.getElementById('proj_categoria_select').value = '';
    document.getElementById('proj_chips').innerHTML = '';
    document.getElementById('proj_chips_container').classList.add('hidden');
    document.getElementById('modalProyectoTitulo').textContent = __t('js.proyectos.modal_titulo_crear');
    document.getElementById('proj_visible').value = '0';
    resetUrlStatus();
    actualizarFechaFinSegunEstado();
    setModalVisible('modalProyecto', true);
}

function cerrarModalProyecto() {
    setModalVisible('modalProyecto', false);
}

document.getElementById('modalProyecto').addEventListener('click', function(e) {
    if (e.target === this) confirmarCancelar();
});

// ── Editar ────────────────────────────────────────────────────────────────────

function ejecutarAbrirEditar(id) {
    apiFetch(`/proyectos/${id}`)
        .then(r => r.json())
        .then(p => {
            document.getElementById('proyectoId').value            = p.id_proyecto;
            document.getElementById('proj_nombre').value           = p.nombre      ?? '';
            document.getElementById('proj_descripcion').value      = p.descripcion ?? '';
            document.getElementById('proj_fecha_ini').value        = toInputDate(p.fecha_ini);
            document.getElementById('proj_fecha_fin').value        = toInputDate(p.fecha_fin);
            document.getElementById('proj_estado').value           = p.estado      ?? 'pendiente';
            document.getElementById('proj_referencias').value      = p.referencias ?? '';
            document.getElementById('proj_categoria_select').value = '';
            document.getElementById('proj_chips').innerHTML        = '';
            document.getElementById('proj_chips_container').classList.add('hidden');

            const urlInput = document.getElementById('proj_url_link');
            urlInput.value = p.url_link ?? '';
            urlInput.dispatchEvent(new Event('input')); // activa el indicador visual

            setTags(p.tecnologias ? p.tecnologias.split(',').map(t => t.trim()).filter(Boolean) : []);
            document.getElementById('proj_visible').value = p.visible ? '1' : '0';
            actualizarFechaFinSegunEstado();
            document.getElementById('modalProyectoTitulo').textContent = __t('js.proyectos.modal_titulo_editar');
            setModalVisible('modalProyecto', true);
        });
}

// ── Crear / Actualizar ────────────────────────────────────────────────────────

function submitProyecto() {
    const id     = document.getElementById('proyectoId').value;
    const url    = id ? `/proyectos/${id}` : '/proyectos';
    const method = id ? 'PUT' : 'POST';

    apiFetch(url, {
        method,
        headers: { 'Content-Type': 'application/json' },
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
                const msgs = err.errors ? Object.values(err.errors).flat() : [err.message ?? __t('js.proyectos.val_err')];
                resaltarError('proj_nombre', msgs[0]);
                throw new Error('validation');
            });
        }
        return r.json();
    })
    .then(data => {
        if (!data?.success) { alert(data?.message ?? __t('js.proyectos.err_guardar')); return; }

        cerrarModalProyecto();
        const cardHTML = buildCardHTML(data.proyecto);
        const grid     = document.getElementById('proyectos-grid');

        if (id) {
            const existing = grid.querySelector(`[data-proyecto-id="${data.proyecto.id_proyecto}"]`);
            if (existing) existing.outerHTML = cardHTML;
        } else {
            grid.insertAdjacentHTML('afterbegin', cardHTML);
            actualizarResumenProyectos(data.proyecto, 'crear');
            if (typeof window.notificarItemPublicable === 'function') {
                window.notificarItemPublicable('proyecto');
            }
        }

        // Sincronizar con la lista usada en el modal de Experiencia Laboral
        if (typeof window.syncProyectoEnListaExp === 'function') {
            window.syncProyectoEnListaExp(id ? 'update' : 'create', data.proyecto);
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
    apiFetch(`/proyectos/${id}`, { method: 'DELETE' })
        .then(r => r.json())
        .then(data => {
            if (!data.success) return;
            document.querySelector(`[data-proyecto-id="${id}"]`)?.remove();
            actualizarResumenProyectos(id, 'eliminar');

            if (typeof window.syncProyectoEnListaExp === 'function') {
                window.syncProyectoEnListaExp('delete', { id_proyecto: id });
            }

            recalcularStats();
        });
}

// ── Proyectos Recientes (Resumen) ─────────────────────────────────────────────

const RESUMEN_ACCENTS = ['bg-[#1e3a5f]', 'bg-[#e11d48]', 'bg-indigo-600'];

const RESUMEN_ESTADO = {
    en_progreso: { label: __t('js.proyectos.resumen_en_curso'),   icon: 'fa-spinner',      bg: 'bg-[#1e3a5f]/10', text: 'text-[#1e3a5f]' },
    completado:  { label: __t('js.proyectos.resumen_finalizado'), icon: 'fa-check-circle', bg: 'bg-indigo-100',   text: 'text-indigo-700' },
    pendiente:   { label: __t('js.proyectos.resumen_pendiente'),  icon: 'fa-clock',        bg: 'bg-gray-100',     text: 'text-gray-600' },
    cancelado:   { label: __t('js.proyectos.resumen_cancelado'),  icon: 'fa-times-circle', bg: 'bg-red-100',      text: 'text-[#e11d48]' },
};

function buildResumenCardHTML(p, index) {
    const cfg    = RESUMEN_ESTADO[p.estado] ?? RESUMEN_ESTADO['pendiente'];
    const accent = RESUMEN_ACCENTS[index % RESUMEN_ACCENTS.length];
    const tags   = p.tecnologias
        ? p.tecnologias.split(',').map(t => t.trim()).filter(Boolean).slice(0, 3)
        : [];

    const tagsHTML = tags.map(t =>
        `<span class="text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2 py-0.5 rounded-md font-medium">${t}</span>`
    ).join('');

    const fecha = p.fecha_ini ? formatFecha(p.fecha_ini) : '—';

    return `
<div class="bg-white rounded-2xl border border-gray-100 shadow-md hover:-translate-y-1 hover:shadow-xl transition-all duration-200 overflow-hidden flex flex-col"
     data-resumen-id="${p.id_proyecto}">
    <div class="h-1.5 w-full ${accent}"></div>
    <div class="p-5 flex flex-col gap-3 flex-1">
        <div class="flex items-start gap-3">
            <div class="w-9 h-9 rounded-xl ${accent} flex items-center justify-center flex-shrink-0">
                <i class="fas fa-code-branch text-white text-sm"></i>
            </div>
            <div class="min-w-0">
                <p class="font-semibold text-[#1e3a5f] text-sm leading-snug line-clamp-1">${p.nombre}</p>
                <p class="text-xs text-gray-400 mt-0.5"><i class="fas fa-calendar-alt mr-1"></i>${fecha}</p>
            </div>
        </div>
        <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">${p.descripcion ?? __t('js.proyectos.sin_descripcion')}</p>
        ${tags.length ? `<div class="flex flex-wrap gap-1">${tagsHTML}</div>` : ''}
        <div class="mt-auto pt-3 border-t border-gray-100">
            <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full ${cfg.bg} ${cfg.text}">
                <i class="fas ${cfg.icon} text-xs"></i> ${cfg.label}
            </span>
        </div>
    </div>
</div>`;
}

function actualizarResumenProyectos(proyecto, accion) {
    const grid  = document.getElementById('resumen-proyectos-grid');
    const empty = document.getElementById('resumen-proyectos-empty');
    const count = document.getElementById('resumen-proyectos-count');
    if (!grid) return;

    if (accion === 'crear') {
        // Insertar al inicio y dejar solo los 3 más recientes
        grid.insertAdjacentHTML('afterbegin', buildResumenCardHTML(proyecto, 0));

        // Recolorar acentos de los 3 primeros
        const cards = grid.querySelectorAll('[data-resumen-id]');
        cards.forEach((card, i) => {
            const franja = card.querySelector('.h-1\\.5');
            const icono  = card.querySelector('.w-9.h-9');
            RESUMEN_ACCENTS.forEach(cls => {
                franja?.classList.remove(cls);
                icono?.classList.remove(cls);
            });
            franja?.classList.add(RESUMEN_ACCENTS[i % RESUMEN_ACCENTS.length]);
            icono?.classList.add(RESUMEN_ACCENTS[i % RESUMEN_ACCENTS.length]);

            if (i >= 3) card.remove(); // máximo 3
        });
    } else if (accion === 'eliminar') {
        const card = grid.querySelector(`[data-resumen-id="${proyecto}"]`);
        if (card) card.remove();
    }

    const total = grid.querySelectorAll('[data-resumen-id]').length;
    if (count) count.textContent = __t('js.proyectos.ultimos_registros', { n: total });

    const vacio = total === 0;
    grid.classList.toggle('hidden', vacio);
    if (empty) empty.classList.toggle('hidden', !vacio);
}

</script>

{{-- Modal Sugerir Tec --}}
<div id="modal-sugerir-tecnologia" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[70] p-4" onclick="cerrarModalSugerirTecnologiaFondo(event)">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md" onclick="event.stopPropagation()">
        <div class="bg-[#1e3a5f] text-white px-6 py-4 flex items-center justify-between rounded-t-2xl">
            <div>
                <h3 class="text-lg font-bold">{{ __('general.sugerir.tec_titulo') }}</h3>
            </div>
            <button type="button" onclick="cerrarModalSugerirTecnologia()" class="text-white hover:text-blue-200 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div class="p-6">
            <form id="formSugerirTecnologia">
                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-700 mb-1">{{ __('general.sugerir.tec_label') }} <span class="text-red-500">*</span></label>
                    <input type="text" id="sugerir_titulo_tech" name="titulo" placeholder="{{ __('general.sugerir.tec_ph') }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div class="mb-6">
                    <label class="block text-xs font-medium text-gray-700 mb-1">{{ __('general.sugerir.desc_label') }} <span class="text-red-500">*</span></label>
                    <textarea id="sugerir_descripcion_tech" name="descripcion" rows="3" placeholder="{{ __('general.sugerir.tec_desc_ph') }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"></textarea>
                </div>
                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="cerrarModalSugerirTecnologia()" class="flex-1 px-4 py-2 text-sm border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">{{ __('general.sugerir.cancelar') }}</button>
                    <button type="button" onclick="enviarSugerenciaTecnologia()" class="flex-1 px-4 py-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg font-medium transition">
                        <i class="fas fa-paper-plane text-xs mr-1"></i> {{ __('general.sugerir.enviar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectTech = document.getElementById("proj_categoria_select");
        if (selectTech) {
            let prevValueTech = "";
            selectTech.addEventListener("focus", function () { prevValueTech = this.value; });
            selectTech.addEventListener("change", function () {
                if (this.value === "sugerir") {
                    this.value = prevValueTech;
                    filtrarTecnologias(); // Refresh chips since inline onchange saw "sugerir"
                    abrirModalSugerirTecnologia();
                } else {
                    prevValueTech = this.value;
                }
            });
        }
    });
    window.abrirModalSugerirTecnologia = function () {
        const form = document.getElementById("formSugerirTecnologia");
        if(form) form.reset();
        const modal = document.getElementById("modal-sugerir-tecnologia");
        if(modal) { modal.classList.remove("hidden"); modal.classList.add("flex"); }
    };
    window.cerrarModalSugerirTecnologia = function () {
        const modal = document.getElementById("modal-sugerir-tecnologia");
        if(modal) { modal.classList.add("hidden"); modal.classList.remove("flex"); }
    };
    window.cerrarModalSugerirTecnologiaFondo = function (event) {
        if (event.target.id === "modal-sugerir-tecnologia") { cerrarModalSugerirTecnologia(); }
    };
    window.enviarSugerenciaTecnologia = async function () {
        const tituloEl = document.getElementById("sugerir_titulo_tech");
        const descripcionEl = document.getElementById("sugerir_descripcion_tech");
        const titulo = tituloEl ? tituloEl.value.trim() : "";
        const descripcion = descripcionEl ? descripcionEl.value.trim() : "";
        if (!titulo) { alert(__t('js.sugerir.titulo_req')); return; }
        if (!descripcion) { alert(__t('js.sugerir.desc_req')); return; }
        
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const resp = await fetch('/sugerencias', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ tipo: 'tecnologia', titulo, descripcion })
            });
            const data = await resp.json();
            if(resp.ok) {
                cerrarModalSugerirTecnologia();
                if (typeof window.confirmar === 'function') {
                    window.confirmar({
                        tipo:           'success',
                        titulo:         __t('js.sugerir.enviada_titulo'),
                        mensaje:        data.message || __t('js.sugerir.enviada_msg'),
                        icon:           'fas fa-check-circle',
                        iconBg:         'bg-[#1e3a5f]/10',
                        iconColor:      'text-[#1e3a5f]',
                        btnClass:       'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90',
                        textoConfirmar: __t('js.sugerir.ok'),
                        soloConfirmar:  true,
                    });
                    setTimeout(() => { if(typeof window.cerrarConfirmar === 'function') window.cerrarConfirmar(); }, 2500);
                } else if (typeof window.Toastify === "function") {
                    window.Toastify({ text: data.message || __t('js.sugerir.enviada_toast'), duration: 3000, close: true, gravity: "top", position: "right", style: { background: "#4caf50" } }).showToast();
                } else {
                    alert(data.message || __t('js.sugerir.enviada_toast'));
                }
            } else {
                alert(data.error || __t('js.sugerir.error_enviar'));
            }
        } catch (error) {
            alert(__t('js.sugerir.error_conexion'));
        }
    };
</script>