{{-- Modal: Publicar Portafolio --}}
<div id="modal-publicar" class="hidden fixed inset-0 z-[60] overflow-y-auto bg-black/50 backdrop-blur-sm"
     aria-modal="true" role="dialog">
    <div class="min-h-screen flex items-start justify-center px-3 sm:px-6 py-6">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl overflow-hidden border border-gray-100">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-rocket text-[#1e3a5f]"></i>
                    </div>
                    <div class="min-w-0">
                        <h2 class="text-lg sm:text-xl font-bold text-[#1e3a5f] truncate">Portafolio Principal</h2>
                        <p class="text-xs text-gray-500">Selecciona el contenido a publicar</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                    <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg border border-[#1e3a5f]/20 bg-[#1e3a5f]/5">
                        <span class="text-[10px] uppercase tracking-wide text-[#1e3a5f]/70 font-semibold">Progreso</span>
                        <span id="mp-progreso" class="text-sm font-bold text-[#1e3a5f]">0%</span>
                    </div>
                    <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg border border-gray-200 bg-gray-50">
                        <span class="text-[10px] uppercase tracking-wide text-gray-500 font-semibold">Seleccionados</span>
                        <span id="mp-contador" class="text-sm font-bold text-gray-800">0/0</span>
                    </div>
                    <button id="mp-publicar"
                        class="inline-flex items-center gap-2 bg-[#e11d48] hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors duration-200">
                        <i class="fas fa-rocket text-xs"></i> Publicar
                    </button>
                    <button id="mp-cerrar" type="button"
                        class="w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            {{-- Tabs --}}
            <div class="px-6 pt-4 border-b border-gray-100">
                <div class="flex gap-1 overflow-x-auto -mb-px scrollbar-thin">
                    @php
                        $mpTabs = [
                            ['id' => 'todo',        'label' => 'Todo',       'icon' => 'fa-chart-line'],
                            ['id' => 'tecnicas',    'label' => 'Técnicas',   'icon' => 'fa-code'],
                            ['id' => 'blandas',     'label' => 'Blandas',    'icon' => 'fa-handshake'],
                            ['id' => 'experiencia', 'label' => 'Experiencia','icon' => 'fa-briefcase'],
                            ['id' => 'educacion',   'label' => 'Educación',  'icon' => 'fa-graduation-cap'],
                            ['id' => 'proyectos',   'label' => 'Proyectos',  'icon' => 'fa-folder-open'],
                        ];
                    @endphp

                    @foreach($mpTabs as $tab)
                        <button type="button" data-mp-tab="{{ $tab['id'] }}"
                            class="mp-tab inline-flex items-center gap-2 px-3 sm:px-4 py-2.5 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-[#1e3a5f] transition whitespace-nowrap">
                            <i class="fas {{ $tab['icon'] }} text-xs"></i>
                            <span>{{ $tab['label'] }}</span>
                            <span class="mp-tab-count text-[10px] font-semibold px-1.5 py-0.5 rounded-full bg-gray-100 text-gray-600">0</span>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Contenido --}}
            <div class="p-4 sm:p-6 max-h-[60vh] overflow-y-auto">

                {{-- Encabezado de sección + acciones --}}
                <div class="flex items-center justify-between mb-4 gap-3">
                    <h3 id="mp-titulo-seccion" class="text-base sm:text-lg font-semibold text-[#1e3a5f]">Habilidades Técnicas</h3>
                    <div class="flex gap-2 flex-shrink-0">
                        <button type="button" id="mp-todos"
                            class="text-xs font-medium px-3 py-1.5 rounded-lg border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 transition">
                            Seleccionar todas
                        </button>
                        <button type="button" id="mp-ninguno"
                            class="text-xs font-medium px-3 py-1.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                            Deseleccionar todas
                        </button>
                    </div>
                </div>

                {{-- Lista de items --}}
                <div id="mp-lista" class="rounded-xl border border-gray-100 overflow-hidden">
                    {{-- Header tabla --}}
                    <div id="mp-lista-header" class="grid grid-cols-[auto_1fr_auto] gap-3 px-4 py-2.5 bg-gray-50 text-[11px] font-semibold uppercase tracking-wide text-gray-500 border-b border-gray-100">
                        <span class="w-5"></span>
                        <span id="mp-col-nombre">Habilidad</span>
                        <span id="mp-col-detalle">Nivel</span>
                    </div>
                    <div id="mp-lista-body" class="divide-y divide-gray-100"></div>
                </div>

                {{-- Estado vacío --}}
                <div id="mp-vacio" class="hidden text-center py-10">
                    <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-3">
                        <i class="fas fa-inbox text-xl text-gray-400"></i>
                    </div>
                    <p class="text-sm text-gray-600 font-medium">No tienes elementos en esta sección</p>
                    <p class="text-xs text-gray-400 mt-1">Agrégalos desde tu dashboard antes de publicar</p>
                </div>

                {{-- Cargando --}}
                <div id="mp-cargando" class="text-center py-10">
                    <i class="fas fa-spinner fa-spin text-2xl text-[#1e3a5f]/60"></i>
                    <p class="text-sm text-gray-500 mt-2">Cargando contenido...</p>
                </div>
            </div>

            {{-- Footer URL pública --}}
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0 w-full sm:w-auto">
                    <div class="w-9 h-9 rounded-lg bg-[#1e3a5f]/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-globe text-[#1e3a5f] text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] uppercase tracking-wide text-gray-500 font-semibold">URL pública</p>
                        <div class="flex items-center gap-2">
                            <a id="mp-url" href="#" target="_blank"
                               class="text-sm text-[#1e3a5f] hover:text-[#e11d48] truncate max-w-xs sm:max-w-md">—</a>
                            <button type="button" id="mp-copiar" class="text-gray-400 hover:text-[#1e3a5f] transition" title="Copiar URL">
                                <i class="far fa-copy text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <a id="mp-vista-previa" href="#" target="_blank"
                   class="inline-flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-xl border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 transition">
                    <i class="fas fa-eye text-xs"></i> Vista previa
                    <i class="fas fa-external-link-alt text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    const modal     = document.getElementById('modal-publicar');
    const btnCerrar = document.getElementById('mp-cerrar');
    const btnPublicar = document.getElementById('mp-publicar');
    const tabsBtns  = modal.querySelectorAll('.mp-tab');
    const listaBody = document.getElementById('mp-lista-body');
    const listaHeader = document.getElementById('mp-lista-header');
    const colNombre = document.getElementById('mp-col-nombre');
    const colDetalle= document.getElementById('mp-col-detalle');
    const vacio     = document.getElementById('mp-vacio');
    const cargando  = document.getElementById('mp-cargando');
    const titulo    = document.getElementById('mp-titulo-seccion');
    const contador  = document.getElementById('mp-contador');
    const progreso  = document.getElementById('mp-progreso');
    const btnTodos  = document.getElementById('mp-todos');
    const btnNinguno= document.getElementById('mp-ninguno');
    const urlLink   = document.getElementById('mp-url');
    const btnCopiar = document.getElementById('mp-copiar');
    const btnVista  = document.getElementById('mp-vista-previa');

    // Estado: { tecnicas:[{id,nombre,nivel,publicado}], blandas:[...], ... }
    let estado = {
        tecnicas: [], blandas: [], experiencia: [], educacion: [], proyectos: [],
    };
    let tabActual = 'todo';

    const seccionesMeta = {
        tecnicas:    { titulo: 'Habilidades Técnicas', col1: 'Habilidad',  col2: 'Nivel'    },
        blandas:     { titulo: 'Habilidades Blandas',  col1: 'Habilidad',  col2: ''         },
        experiencia: { titulo: 'Experiencia Laboral',  col1: 'Cargo',      col2: 'Empresa'  },
        educacion:   { titulo: 'Formación Académica',  col1: 'Título',     col2: 'Detalle'  },
        proyectos:   { titulo: 'Proyectos',            col1: 'Proyecto',   col2: 'Resumen'  },
    };

    function nivelClase(nivel) {
        switch (nivel) {
            case 'Experto':    return 'bg-[#e11d48]/10 text-[#e11d48]';
            case 'Avanzado':   return 'bg-[#1e3a5f]/10 text-[#1e3a5f]';
            case 'Intermedio': return 'bg-amber-100 text-amber-700';
            default:           return 'bg-gray-100 text-gray-600';
        }
    }

    window.abrirModalPublicar = async function () {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        cargando.classList.remove('hidden');
        listaBody.innerHTML = '';
        vacio.classList.add('hidden');

        try {
            const res = await fetch('{{ route("cuenta.portafolio.datos") }}', {
                headers: { 'Accept': 'application/json' },
                credentials: 'same-origin'
            });
            const data = await res.json();
            if (!data.ok) throw new Error(data.message || 'Error');

            estado = {
                tecnicas:    data.tecnicas    || [],
                blandas:     data.blandas     || [],
                experiencia: data.experiencia || [],
                educacion:   data.educacion   || [],
                proyectos:   data.proyectos   || [],
            };

            const baseUrl = window.location.origin;
            const slug = data.slug || '';
            urlLink.textContent = baseUrl + '/' + slug;
            urlLink.href = '/' + slug;
            btnVista.href = '/' + slug;

            actualizarConteos();
            mostrarTab('todo');
        } catch (e) {
            cargando.classList.add('hidden');
            listaBody.innerHTML = `<div class="p-6 text-center text-sm text-red-500">No se pudo cargar el contenido.</div>`;
        }
    };

    function cerrarModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
    btnCerrar.addEventListener('click', cerrarModal);
    modal.addEventListener('click', (e) => { if (e.target === modal) cerrarModal(); });

    function todasLasSecciones() {
        return ['tecnicas','blandas','experiencia','educacion','proyectos'];
    }

    function itemsDeTab(tab) {
        if (tab === 'todo') {
            return todasLasSecciones().flatMap(s => estado[s].map(it => ({ ...it, _seccion: s })));
        }
        return estado[tab].map(it => ({ ...it, _seccion: tab }));
    }

    function actualizarConteos() {
        let totalGlobal = 0, selGlobal = 0;
        todasLasSecciones().forEach(s => {
            const t = estado[s].length;
            const sel = estado[s].filter(i => i.publicado).length;
            totalGlobal += t; selGlobal += sel;
            const btn = modal.querySelector(`[data-mp-tab="${s}"] .mp-tab-count`);
            if (btn) btn.textContent = t;
        });
        const todoBtn = modal.querySelector('[data-mp-tab="todo"] .mp-tab-count');
        if (todoBtn) todoBtn.textContent = totalGlobal;

        contador.textContent = `${selGlobal}/${totalGlobal}`;
        const pct = totalGlobal === 0 ? 0 : Math.round((selGlobal / totalGlobal) * 100);
        progreso.textContent = pct + '%';
    }

    function mostrarTab(tab) {
        tabActual = tab;
        tabsBtns.forEach(b => {
            const activa = b.dataset.mpTab === tab;
            b.classList.toggle('text-[#1e3a5f]', activa);
            b.classList.toggle('border-[#e11d48]', activa);
            b.classList.toggle('font-semibold', activa);
            b.classList.toggle('text-gray-500', !activa);
        });

        const meta = tab === 'todo'
            ? { titulo: 'Todo el contenido', col1: 'Elemento', col2: 'Sección' }
            : seccionesMeta[tab];
        titulo.textContent = meta.titulo;
        colNombre.textContent = meta.col1;
        colDetalle.textContent = meta.col2;

        const items = itemsDeTab(tab);
        cargando.classList.add('hidden');
        listaBody.innerHTML = '';
        if (items.length === 0) {
            vacio.classList.remove('hidden');
            listaHeader.classList.add('hidden');
            return;
        }
        vacio.classList.add('hidden');
        listaHeader.classList.remove('hidden');

        items.forEach(it => {
            const row = document.createElement('div');
            row.className = 'mp-row grid grid-cols-[auto_1fr_auto] gap-3 items-center px-4 py-3 hover:bg-[#1e3a5f]/5 transition cursor-pointer';
            row.dataset.seccion = it._seccion;
            row.dataset.id = it.id;

            const checked = it.publicado ? 'checked' : '';
            let detalleHtml = '';
            if (tab === 'todo') {
                const seccionLabel = {
                    tecnicas: 'Técnica', blandas: 'Blanda', experiencia: 'Experiencia',
                    educacion: 'Educación', proyectos: 'Proyecto'
                }[it._seccion];
                detalleHtml = `<span class="text-xs px-2 py-0.5 rounded-full bg-[#1e3a5f]/10 text-[#1e3a5f]">${seccionLabel}</span>`;
            } else if (it._seccion === 'tecnicas') {
                detalleHtml = `<span class="text-xs font-medium px-2.5 py-1 rounded-full ${nivelClase(it.nivel)}">${it.nivel}</span>`;
            } else if (it.detalle) {
                detalleHtml = `<span class="text-xs text-gray-500">${it.detalle}</span>`;
            } else {
                detalleHtml = '';
            }

            row.innerHTML = `
                <span class="mp-box w-5 h-5 rounded-md border-2 ${it.publicado ? 'bg-[#1e3a5f] border-[#1e3a5f]' : 'border-gray-300 bg-white'} flex items-center justify-center transition flex-shrink-0">
                    <i class="fas fa-check text-white text-[10px] ${it.publicado ? '' : 'hidden'}"></i>
                </span>
                <div class="min-w-0">
                    <p class="text-sm text-gray-800 truncate">${it.nombre ?? ''}</p>
                </div>
                <div>${detalleHtml}</div>
            `;
            listaBody.appendChild(row);
        });
    }

    listaBody.addEventListener('click', (e) => {
        const row = e.target.closest('.mp-row');
        if (!row) return;
        const seccion = row.dataset.seccion;
        const id = parseInt(row.dataset.id, 10);
        const item = estado[seccion].find(i => i.id === id);
        if (!item) return;
        item.publicado = !item.publicado;

        const box = row.querySelector('.mp-box');
        const tick = box.querySelector('i');
        if (item.publicado) {
            box.classList.add('bg-[#1e3a5f]', 'border-[#1e3a5f]');
            box.classList.remove('border-gray-300', 'bg-white');
            tick.classList.remove('hidden');
        } else {
            box.classList.remove('bg-[#1e3a5f]', 'border-[#1e3a5f]');
            box.classList.add('border-gray-300', 'bg-white');
            tick.classList.add('hidden');
        }
        actualizarConteos();
    });

    tabsBtns.forEach(b => b.addEventListener('click', () => mostrarTab(b.dataset.mpTab)));

    btnTodos.addEventListener('click', () => {
        const secciones = tabActual === 'todo' ? todasLasSecciones() : [tabActual];
        secciones.forEach(s => estado[s].forEach(i => i.publicado = true));
        actualizarConteos();
        mostrarTab(tabActual);
    });
    btnNinguno.addEventListener('click', () => {
        const secciones = tabActual === 'todo' ? todasLasSecciones() : [tabActual];
        secciones.forEach(s => estado[s].forEach(i => i.publicado = false));
        actualizarConteos();
        mostrarTab(tabActual);
    });

    btnCopiar.addEventListener('click', () => {
        navigator.clipboard.writeText(urlLink.textContent).then(() => {
            const i = btnCopiar.querySelector('i');
            i.classList.replace('far', 'fas');
            i.classList.replace('fa-copy', 'fa-check');
            setTimeout(() => { i.classList.replace('fas','far'); i.classList.replace('fa-check','fa-copy'); }, 1200);
        });
    });

    btnPublicar.addEventListener('click', () => {
        const payload = {};
        todasLasSecciones().forEach(s => {
            payload[s] = estado[s].filter(i => i.publicado).map(i => i.id);
        });

        btnPublicar.disabled = true;
        btnPublicar.innerHTML = '<i class="fas fa-spinner fa-spin text-xs"></i> Publicando...';

        fetch('{{ route("cuenta.portafolio.publicar") }}', {
            method: 'PUT',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json' },
            credentials: 'same-origin',
            body: JSON.stringify(payload)
        })
        .then(r => r.json())
        .then(res => {
            btnPublicar.disabled = false;
            btnPublicar.innerHTML = '<i class="fas fa-rocket text-xs"></i> Publicar';
            if (res.ok) {
                cerrarModal();
                if (typeof window.aplicarVisibilidadPublica === 'function') {
                    window.aplicarVisibilidadPublica();
                }
                Swal.fire({
                    icon: 'success',
                    title: '¡Portafolio publicado!',
                    text: 'Tu perfil ahora es público con el contenido seleccionado.',
                    confirmButtonColor: '#1e3a5f',
                    timer: 2200,
                    showConfirmButton: false
                });
            } else if (res.code === 'perfil_incompleto') {
                Swal.fire({
                    icon: 'info',
                    title: 'Tu perfil aún está vacío',
                    html: `
                        <p class="text-sm text-gray-600 mb-2">Para publicar tu portafolio, primero debes registrar al menos una de estas cosas:</p>
                        <ul class="text-sm text-gray-600 text-left inline-block mt-1 space-y-1">
                            <li><i class="fas fa-check text-[#1e3a5f] mr-1"></i> Una <strong>biografía</strong></li>
                            <li><i class="fas fa-check text-[#1e3a5f] mr-1"></i> Un <strong>proyecto</strong></li>
                            <li><i class="fas fa-check text-[#1e3a5f] mr-1"></i> Una <strong>experiencia laboral</strong></li>
                        </ul>`,
                    confirmButtonColor: '#1e3a5f',
                    confirmButtonText: 'Entendido'
                });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: res.message ?? 'No se pudo publicar.', confirmButtonColor: '#1e3a5f' });
            }
        })
        .catch(() => {
            btnPublicar.disabled = false;
            btnPublicar.innerHTML = '<i class="fas fa-rocket text-xs"></i> Publicar';
            Swal.fire({ icon: 'error', title: 'Error de conexión', confirmButtonColor: '#1e3a5f' });
        });
    });
})();
</script>
