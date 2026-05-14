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

    btnVista.addEventListener('click', () => {
        const payload = {};
        todasLasSecciones().forEach(s => {
            payload[s] = estado[s].filter(i => i.publicado).map(i => i.id);
        });

        const textoOriginal = btnVista.innerHTML;
        btnVista.disabled = true;
        btnVista.innerHTML = '<i class="fas fa-spinner fa-spin text-xs"></i> Cargando...';

        fetch('{{ route("cuenta.portafolio.preview") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json' },
            credentials: 'same-origin',
            body: JSON.stringify(payload)
        })
        .then(r => r.json())
        .then(res => {
            btnVista.disabled = false;
            btnVista.innerHTML = textoOriginal;
            if (!res.ok || !res.portafolio) {
                Swal.fire({ icon: 'error', title: 'No se pudo cargar la vista previa', text: res.message || '', confirmButtonColor: '#1e3a5f' });
                return;
            }
            if (typeof window.abrirModalPortafolio === 'function') {
                window.abrirModalPortafolio({ data: res.portafolio, preview: true });
            }
        })
        .catch(() => {
            btnVista.disabled = false;
            btnVista.innerHTML = textoOriginal;
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo obtener la vista previa.', confirmButtonColor: '#1e3a5f' });
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

                // Recalcular banner "elementos sin publicar"
                const aviso  = document.getElementById('aviso-sin-publicar');
                const countEl = document.getElementById('aviso-sin-publicar-count');
                if (aviso && countEl) {
                    const sinPublicar = todasLasSecciones()
                        .flatMap(s => estado[s])
                        .filter(it => !it.publicado).length;
                    countEl.textContent = sinPublicar;
                    if (sinPublicar > 0) {
                        aviso.classList.remove('hidden');
                        aviso.classList.add('flex');
                    } else {
                        aviso.classList.add('hidden');
                        aviso.classList.remove('flex');
                    }
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
