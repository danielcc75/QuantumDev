    <script>
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            const button = dropdown.querySelector('button');
            const menu = dropdown.querySelector('.dropdown-menu');

            if (button && menu) {
                button.addEventListener('click', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll('.dropdown-menu').forEach(m => {
                        if (m !== menu) m.classList.add('hidden');
                    });
                    menu.classList.toggle('hidden');
                });
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });

        function resaltarLink(seccionId) {
            document.querySelectorAll('.seccion-link').forEach(link => {
                link.classList.remove('bg-[#1e3a5f]', 'border-r-4', 'border-[#e11d48]', 'shadow-sm');
                link.classList.add('text-gray-700');
                link.classList.remove('text-white', 'font-semibold');
                const icono = link.querySelector('i');
                if (icono) {
                    icono.classList.remove('text-white');
                    icono.classList.add('text-gray-500');
                }
                const span = link.querySelector('span');
                if (span) span.classList.remove('font-semibold');
            });

            const linkActivo = document.querySelector(`.seccion-link[data-seccion="${seccionId}"]`);
            if (linkActivo) {
                linkActivo.classList.add('bg-[#1e3a5f]', 'border-r-4', 'border-[#e11d48]', 'shadow-sm');
                linkActivo.classList.remove('text-gray-700');
                linkActivo.classList.add('text-white', 'font-semibold');
                const icono = linkActivo.querySelector('i');
                if (icono) {
                    icono.classList.remove('text-gray-500');
                    icono.classList.add('text-white');
                }
                const span = linkActivo.querySelector('span');
                if (span) span.classList.add('font-semibold');
            }
        }

        function esEscritorio() {
            return window.innerWidth >= 1024;
        }

        function cambiarSeccion(seccionId) {
            if (esEscritorio()) {
                document.querySelectorAll('.seccion-contenido').forEach(s => s.classList.add('hidden'));
                const seccionActiva = document.getElementById('seccion-' + seccionId);
                if (seccionActiva) seccionActiva.classList.remove('hidden');
            } else {
                const seccionActiva = document.getElementById('seccion-' + seccionId);
                if (seccionActiva) seccionActiva.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            resaltarLink(seccionId);
        }

        window.irAConfiguracionCuenta = function () {
            cambiarSeccion('perfil');
            setTimeout(() => {
                const seccionConfig = document.getElementById('seccion-configuracion');
                if (seccionConfig && seccionConfig.classList.contains('hidden') && typeof toggleConfiguracionCuenta === 'function') {
                    toggleConfiguracionCuenta();
                } else if (seccionConfig) {
                    seccionConfig.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }, 50);
        };

        document.querySelectorAll('.seccion-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const seccion = link.getAttribute('data-seccion');
                if (seccion) {
                    cambiarSeccion(seccion);
                    cerrarSidebars();
                }
            });
        });

        // ── Scroll-spy: solo en móvil ──────────────────────────────────────────
        const seccionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id.replace('seccion-', '');
                    resaltarLink(id);
                }
            });
        }, {
            rootMargin: '-30% 0px -60% 0px',
            threshold: 0,
        });

        function activarScrollSpy() {
            document.querySelectorAll('.seccion-contenido').forEach(s => seccionObserver.observe(s));
        }
        function desactivarScrollSpy() {
            seccionObserver.disconnect();
        }

        if (!esEscritorio()) activarScrollSpy();

        // ── Sidebars móviles / tablet ──────────────────────────────────────────
        const sidebarIzq     = document.getElementById('sidebar-izquierdo');
        const sidebarDer     = document.getElementById('sidebar-derecho');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const btnMenu        = document.getElementById('btn-menu-mobile');
        const btnSidebarDer  = document.getElementById('btn-sidebar-derecho');

        function abrirSidebarIzq() {
            sidebarIzq.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        }
        function abrirSidebarDer() {
            sidebarDer.classList.remove('translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        }
        function cerrarSidebars() {
            if (window.innerWidth < 1024) sidebarIzq.classList.add('-translate-x-full');
            if (window.innerWidth < 1280) sidebarDer.classList.add('translate-x-full');
            sidebarOverlay.classList.add('hidden');
        }

        btnMenu?.addEventListener('click', abrirSidebarIzq);
        btnSidebarDer?.addEventListener('click', abrirSidebarDer);
        sidebarOverlay?.addEventListener('click', cerrarSidebars);

        // Reset al redimensionar
        let fueEscritorio = esEscritorio();
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) sidebarIzq.classList.remove('-translate-x-full');
            if (window.innerWidth >= 1280) sidebarDer.classList.remove('translate-x-full');
            if (window.innerWidth >= 1280) sidebarOverlay.classList.add('hidden');

            const ahoraEscritorio = esEscritorio();
            if (ahoraEscritorio !== fueEscritorio) {
                fueEscritorio = ahoraEscritorio;
                if (ahoraEscritorio) {
                    // Pasó a escritorio: modo tabs
                    desactivarScrollSpy();
                    const linkActivo = document.querySelector('.seccion-link.bg-\\[\\#1e3a5f\\]');
                    const idActivo = linkActivo?.getAttribute('data-seccion') ?? 'resumen';
                    document.querySelectorAll('.seccion-contenido').forEach(s => s.classList.add('hidden'));
                    const elActivo = document.getElementById('seccion-' + idActivo);
                    if (elActivo) elActivo.classList.remove('hidden');
                } else {
                    // Pasó a móvil: mostrar todas y activar scroll-spy
                    document.querySelectorAll('.seccion-contenido').forEach(s => s.classList.remove('hidden'));
                    activarScrollSpy();
                }
            }
        });

        // ── Buscador móvil ─────────────────────────────────────────────────────
        const btnBuscadorMobile = document.getElementById('btn-buscador-mobile');
        const buscadorMobileWrapper = document.getElementById('buscador-mobile-wrapper');
        btnBuscadorMobile?.addEventListener('click', () => {
            buscadorMobileWrapper?.classList.toggle('hidden');
        });

        document.querySelectorAll('a[href="#"]').forEach(link => {
            link.addEventListener('click', (e) => {
                if (!link.classList.contains('seccion-link')) {
                    e.preventDefault();
                }
            });
        });

        const seccionInicial = new URLSearchParams(window.location.search).get('seccion') ?? 'resumen';

        if (esEscritorio()) {
            document.querySelectorAll('.seccion-contenido').forEach(s => s.classList.add('hidden'));
            const elInicial = document.getElementById('seccion-' + seccionInicial);
            if (elInicial) elInicial.classList.remove('hidden');
        } else {
            const elInicial = document.getElementById('seccion-' + seccionInicial);
            if (elInicial && seccionInicial !== 'resumen') {
                elInicial.scrollIntoView({ behavior: 'auto', block: 'start' });
            }
        }
        resaltarLink(seccionInicial);
        // Limpiar el parámetro de la URL para que al recargar no vuelva a la misma sección
        if (window.location.search) {
            history.replaceState(null, '', window.location.pathname);
        }

        // ── Animación barra de progreso ───────────────────────────────────────
        window.addEventListener('load', () => {
            const barra = document.getElementById('barra-progreso');
            if (barra) {
                setTimeout(() => {
                    barra.style.width = barra.dataset.target + '%';
                }, 300);
            }
        });

        // ── Buscador de proyectos ─────────────────────────────────────────────
        const inputBusqueda   = document.getElementById('buscador-global');
        const resultadosPanel = document.getElementById('buscador-resultados');
        const clearBtn        = document.getElementById('buscador-clear');

        function obtenerProyectos() {
            return Array.from(document.querySelectorAll('#proyectos-grid [data-proyecto-id]'));
        }

        function limpiarBusqueda() {
            inputBusqueda.value = '';
            resultadosPanel.classList.add('hidden');
            clearBtn.classList.add('hidden');
            obtenerProyectos().forEach(c => c.style.display = '');
        }

        inputBusqueda.addEventListener('input', function () {
            const q = this.value.trim().toLowerCase();

            clearBtn.classList.toggle('hidden', q === '');

            if (!q) {
                resultadosPanel.classList.add('hidden');
                obtenerProyectos().forEach(c => c.style.display = '');
                return;
            }

            const cards   = obtenerProyectos();
            const matches = cards.filter(c => {
                const nombre = c.querySelector('h3')?.textContent.toLowerCase() ?? '';
                const desc   = c.querySelector('p')?.textContent.toLowerCase() ?? '';
                return nombre.includes(q) || desc.includes(q);
            });

            // Mostrar resultados en el panel desplegable
            resultadosPanel.innerHTML = '';

            if (matches.length === 0) {
                resultadosPanel.innerHTML = `
                    <div class="px-4 py-6 text-center text-sm text-gray-400">
                        <i class="fas fa-search mb-2 block text-lg"></i>
                        ${__t('js.dashboard.sin_resultados', { q: `<strong>${q}</strong>` })}
                    </div>`;
            } else {
                matches.forEach(card => {
                    const nombre = card.querySelector('h3')?.textContent.trim() ?? '';
                    const badge  = card.querySelector('span.rounded-full')?.textContent.trim() ?? '';
                    const item   = document.createElement('div');
                    item.className = 'flex items-center gap-3 px-4 py-3 hover:bg-[#1e3a5f]/5 cursor-pointer border-b border-gray-50 last:border-0 transition-colors';
                    item.innerHTML = `
                        <div class="w-7 h-7 rounded-lg bg-[#1e3a5f] flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-code-branch text-white text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-[#1e3a5f] truncate">${nombre}</p>
                        </div>
                        <span class="text-xs text-gray-400">${badge}</span>`;
                    item.addEventListener('click', () => {
                        cambiarSeccion('proyectos');
                        limpiarBusqueda();
                        setTimeout(() => {
                            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            card.classList.add('ring-2', 'ring-[#1e3a5f]', 'ring-offset-2');
                            setTimeout(() => card.classList.remove('ring-2', 'ring-[#1e3a5f]', 'ring-offset-2'), 1800);
                        }, 150);
                    });
                    resultadosPanel.appendChild(item);
                });
            }

            resultadosPanel.classList.remove('hidden');
        });

        // Cerrar panel al hacer clic fuera
        document.addEventListener('click', e => {
            if (!e.target.closest('#buscador-global') && !e.target.closest('#buscador-resultados')) {
                resultadosPanel.classList.add('hidden');
            }
        });

        inputBusqueda.addEventListener('focus', () => {
            if (inputBusqueda.value.trim()) resultadosPanel.classList.remove('hidden');
        });

        // ── Marcar novedades como leídas (campana + sidebar) ────────────────
        async function marcarNovedadesVistas(botones) {
            const hayItemsVisibles = !!document.querySelector('.novedad-item, .novedad-item-header');
            if (!hayItemsVisibles) return;

            botones.forEach(b => b && (b.disabled = true));
            try {
                const res = await fetch('{{ route('novedades.marcar-vistas') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ todas: true }),
                });
                if (!res.ok) {
                    botones.forEach(b => b && (b.disabled = false));
                    return;
                }

                document.querySelectorAll('.novedad-item, .novedad-item-header').forEach(el => el.remove());
                botones.forEach(b => b && b.remove());

                // Sidebar vacío
                const contSide = document.getElementById('contenedor-notificaciones');
                if (contSide && !contSide.querySelector('div')) {
                    const vacio = document.createElement('p');
                    vacio.className = 'text-xs text-gray-500 italic';
                    vacio.textContent = __t('js.dashboard.sin_novedades');
                    contSide.appendChild(vacio);
                }

                // Header dropdown vacío
                const contHdr = document.getElementById('contenedor-notificaciones-header');
                if (contHdr && !contHdr.querySelector('div')) {
                    const vacio = document.createElement('p');
                    vacio.className = 'p-4 text-xs text-gray-500 italic text-center';
                    vacio.textContent = __t('js.dashboard.sin_notificaciones');
                    contHdr.appendChild(vacio);
                }

                // Actualizar badge: restar las novedades marcadas; quedan solo los avisos de moderación (si los hay)
                const badge = document.getElementById('badge-notificaciones');
                if (badge) {
                    const quedanAvisos = !!document.querySelector('#contenedor-notificaciones-header > div');
                    if (quedanAvisos) {
                        badge.textContent = '1';
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                        badge.textContent = '';
                    }
                }
            } catch (e) {
                botones.forEach(b => b && (b.disabled = false));
            }
        }

        const btnNovSidebar = document.getElementById('btn-marcar-novedades-vistas');
        const btnNovHeader  = document.getElementById('btn-marcar-novedades-vistas-header');
        const grupoBotones = [btnNovSidebar, btnNovHeader];
        btnNovSidebar?.addEventListener('click', () => marcarNovedadesVistas(grupoBotones));
        btnNovHeader?.addEventListener('click',  () => marcarNovedadesVistas(grupoBotones));

        // ── Calendario interactivo ───────────────────────────────────────────
        (function inicializarCalendario() {
            const widget = document.getElementById('widget-calendario');
            if (!widget) return;

            const endpoint = widget.dataset.endpoint;
            const hoyStr   = widget.dataset.hoy; // YYYY-MM-DD
            const titulo   = document.getElementById('cal-titulo');
            const grid     = document.getElementById('cal-grid');
            const panelLista = document.getElementById('cal-panel-lista');
            const panelTitulo = document.getElementById('cal-panel-titulo');
            const btnPrev = document.getElementById('cal-prev');
            const btnNext = document.getElementById('cal-next');

            const MESES = (window.__lang?.js?.dashboard?.meses_capital)
                || ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            const MESES_MIN = (window.__lang?.js?.dashboard?.meses)
                || MESES.map(m => m.toLowerCase());
            const hoy = parseFecha(hoyStr);
            let mesVisible = new Date(hoy.getFullYear(), hoy.getMonth(), 1);
            let diaSeleccionado = formatearFecha(hoy);
            let eventosCache = {}; // { 'YYYY-MM-DD': [eventos] }

            function parseFecha(str) {
                const [y, m, d] = str.split('-').map(Number);
                return new Date(y, m - 1, d);
            }
            function formatearFecha(d) {
                const y = d.getFullYear();
                const m = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                return `${y}-${m}-${day}`;
            }
            function formatearLargoEsp(str) {
                const d = parseFecha(str);
                return __t('js.dashboard.fecha_larga', {
                    dia:  d.getDate(),
                    mes:  MESES_MIN[d.getMonth()] || MESES[d.getMonth()].toLowerCase(),
                    anio: d.getFullYear(),
                });
            }

            async function cargarMes() {
                const y = mesVisible.getFullYear();
                const m = mesVisible.getMonth();
                const desde = new Date(y, m, 1);
                const hasta = new Date(y, m + 1, 0);
                titulo.textContent = `${MESES[m]} ${y}`;

                renderizarGrid(desde, hasta, {}); // mientras carga

                try {
                    const url = `${endpoint}?desde=${formatearFecha(desde)}&hasta=${formatearFecha(hasta)}`;
                    const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                    const data = await res.json();
                    eventosCache = data.eventos || {};
                } catch (e) {
                    eventosCache = {};
                }
                renderizarGrid(desde, hasta, eventosCache);
                renderizarPanel(diaSeleccionado);
            }

            function renderizarGrid(desde, hasta, eventos) {
                grid.innerHTML = '';
                const primerDiaSemana = (desde.getDay() + 6) % 7; // lunes = 0
                const diasEnMes = hasta.getDate();
                const hoyFmt = formatearFecha(hoy);

                for (let i = 0; i < primerDiaSemana; i++) {
                    const v = document.createElement('div');
                    grid.appendChild(v);
                }

                for (let d = 1; d <= diasEnMes; d++) {
                    const fechaIter = new Date(desde.getFullYear(), desde.getMonth(), d);
                    const fechaStr  = formatearFecha(fechaIter);
                    const tieneEventos = !!(eventos[fechaStr] && eventos[fechaStr].length);
                    const esHoy = fechaStr === hoyFmt;
                    const esSeleccionado = fechaStr === diaSeleccionado;

                    const cell = document.createElement('button');
                    cell.type = 'button';
                    cell.dataset.fecha = fechaStr;
                    cell.className = [
                        'relative py-1.5 rounded-md text-sm transition-colors',
                        esSeleccionado ? 'bg-[#1e3a5f] text-white font-semibold'
                                       : (esHoy ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-200'),
                    ].join(' ');
                    cell.innerHTML = `
                        <span>${d}</span>
                        ${tieneEventos ? `<span class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full ${esSeleccionado ? 'bg-white' : 'bg-[#e11d48]'}"></span>` : ''}
                    `;
                    cell.addEventListener('click', () => {
                        diaSeleccionado = fechaStr;
                        renderizarGrid(desde, hasta, eventos);
                        renderizarPanel(fechaStr);
                    });
                    grid.appendChild(cell);
                }
            }

            function renderizarPanel(fechaStr) {
                panelTitulo.textContent = __t('js.dashboard.eventos_de', { fecha: formatearLargoEsp(fechaStr) });
                const eventos = eventosCache[fechaStr] || [];

                if (!eventos.length) {
                    panelLista.innerHTML = `<p class="text-xs text-gray-400 italic">${__t('js.dashboard.sin_eventos')}</p>`;
                    return;
                }

                panelLista.innerHTML = eventos.map(ev => `
                    <div class="flex items-start gap-2 text-xs">
                        <span class="${ev.color} w-1.5 h-1.5 rounded-full mt-1.5 flex-shrink-0"></span>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">
                                <i class="${ev.icono} ${ev.colorTexto} mr-1"></i>
                                ${escapeHtmlCal(ev.titulo)}
                            </p>
                            ${ev.detalle ? `<p class="text-gray-500">${escapeHtmlCal(ev.detalle)}</p>` : ''}
                        </div>
                    </div>
                `).join('');
            }

            function escapeHtmlCal(s) {
                const d = document.createElement('div');
                d.textContent = s ?? '';
                return d.innerHTML;
            }

            btnPrev.addEventListener('click', () => {
                mesVisible = new Date(mesVisible.getFullYear(), mesVisible.getMonth() - 1, 1);
                cargarMes();
            });
            btnNext.addEventListener('click', () => {
                mesVisible = new Date(mesVisible.getFullYear(), mesVisible.getMonth() + 1, 1);
                cargarMes();
            });

            cargarMes();
        })();
// ========================================
// NOTIFICACIONES DROPDOWN (MEJORADO)
// ========================================
const btnNotif = document.getElementById('btn-notificaciones');
const menuNotif = document.getElementById('notificaciones-menu');
let notifAbierto = false;

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function cargarNotificaciones() {
    fetch('{{ route("notifications.list") }}')
        .then(response => response.json())
        .then(data => {
            const lista = document.getElementById('notificaciones-lista');
            const badge = document.getElementById('notificaciones-badge');
            
            if (data.noLeidas > 0) {
                badge.textContent = data.noLeidas > 99 ? '99+' : data.noLeidas;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
            
            if (data.notificaciones.length === 0) {
                lista.innerHTML = `
                    <div class="p-6 text-center">
                        <i class="fas fa-bell-slash text-gray-300 text-3xl mb-2"></i>
                        <p class="text-gray-500 text-sm">${__t('js.dashboard.no_notificaciones')}</p>
                    </div>
                `;
            } else {
                let html = '';
                data.notificaciones.forEach(notif => {
                    let tipoIcon = '';
                    if (notif.tipo === 'info') tipoIcon = 'fa-info-circle text-blue-500';
                    else if (notif.tipo === 'success') tipoIcon = 'fa-check-circle text-green-500';
                    else if (notif.tipo === 'warning') tipoIcon = 'fa-exclamation-triangle text-yellow-500';
                    else tipoIcon = 'fa-times-circle text-red-500';
                    
                    const fondoClass = !notif.leido ? 'bg-blue-50' : 'bg-white';
                    
                    html += `
                        <div onclick="marcarLeida(${notif.id}, '${notif.url || ''}', this)" 
                             class="p-3 border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition ${fondoClass}">
                            <div class="flex gap-3">
                                <div class="flex-shrink-0">
                                    <i class="fas ${tipoIcon} text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800">${escapeHtml(notif.titulo)}</p>
                                    <p class="text-xs text-gray-500 truncate">${escapeHtml(notif.mensaje)}</p>
                                    <p class="text-xs text-gray-400 mt-1">${notif.hace}</p>
                                </div>
                                ${!notif.leido ? '<div class="flex-shrink-0"><span class="w-2 h-2 bg-blue-500 rounded-full block"></span></div>' : ''}
                            </div>
                        </div>
                    `;
                });
                lista.innerHTML = html;
            }
        });
}

function marcarLeida(id, url, elemento) {
    if (elemento && elemento.classList.contains('marcando')) return;
    if (elemento) elemento.classList.add('marcando', 'opacity-50');
    
    fetch('{{ route("notifications.marcar-leida") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    }).then(() => {
        if (elemento) {
            elemento.classList.remove('bg-blue-50');
            elemento.classList.add('bg-white');
            const badgeAzul = elemento.querySelector('.w-2.h-2.bg-blue-500');
            if (badgeAzul) badgeAzul.remove();
        }
        
        if (url && url !== '') {
            window.location.href = url;
        } else {
            actualizarContadorNotificaciones();
            if (notifAbierto) cargarNotificaciones();
        }
    }).catch(error => {
        console.error('Error:', error);
        if (elemento) elemento.classList.remove('opacity-50');
    }).finally(() => {
        if (elemento) {
            elemento.classList.remove('marcando');
            setTimeout(() => {
                if (elemento) elemento.classList.remove('opacity-50');
            }, 300);
        }
    });
}

function actualizarContadorNotificaciones() {
    fetch('{{ route("notifications.count") }}')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('notificaciones-badge');
            if (data.count > 0) {
                badge.textContent = data.count > 99 ? '99+' : data.count;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        });
}

if (btnNotif) {
    btnNotif.addEventListener('click', (e) => {
        e.stopPropagation();
        if (!notifAbierto) {
            cargarNotificaciones();
            menuNotif.classList.remove('hidden');
            notifAbierto = true;
        } else {
            menuNotif.classList.add('hidden');
            notifAbierto = false;
        }
    });
    
    document.addEventListener('click', (e) => {
        if (btnNotif && menuNotif && 
            !btnNotif.contains(e.target) && 
            !menuNotif.contains(e.target)) {
            menuNotif.classList.add('hidden');
            notifAbierto = false;
        }
    });
}

// Inicializar
actualizarContadorNotificaciones();
setInterval(actualizarContadorNotificaciones, 30000);

    </script>
