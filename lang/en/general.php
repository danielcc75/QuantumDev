<?php

return array (
  'Portafolio' => 'Portfolio',
  'Digital' => 'Digital',
  'Notificaciones' => 'Notifications',
  'Ver todas' => 'See all',
  'Cargando...' => 'Charging...',
  'Mi perfil' => 'my profile',
  'Configuración' => 'Configuration',
  'Cerrar sesion' => 'Log out',
  'Buscar proyectos...' => 'Search projects...',
  'document.querySelectorAll(\'.dropdown\').forEach(dropdown => {
            const button = dropdown.querySelector(\'button\');
            const menu = dropdown.querySelector(\'.dropdown-menu\');

            if (button && menu) {
                button.addEventListener(\'click\', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll(\'.dropdown-menu\').forEach(m => {
                        if (m !== menu) m.classList.add(\'hidden\');
                    });
                    menu.classList.toggle(\'hidden\');
                });
            }
        });

        document.addEventListener(\'click\', (e) => {
            if (!e.target.closest(\'.dropdown\')) {
                document.querySelectorAll(\'.dropdown-menu\').forEach(menu => {
                    menu.classList.add(\'hidden\');
                });
            }
        });

        function resaltarLink(seccionId) {
            document.querySelectorAll(\'.seccion-link\').forEach(link => {
                link.classList.remove(\'bg-[#1e3a5f]\', \'border-r-4\', \'border-[#e11d48]\', \'shadow-sm\');
                link.classList.add(\'text-gray-700\');
                link.classList.remove(\'text-white\', \'font-semibold\');
                const icono = link.querySelector(\'i\');
                if (icono) {
                    icono.classList.remove(\'text-white\');
                    icono.classList.add(\'text-gray-500\');
                }
                const span = link.querySelector(\'span\');
                if (span) span.classList.remove(\'font-semibold\');
            });

            const linkActivo = document.querySelector(`.seccion-link[data-seccion="${seccionId}"]`);
            if (linkActivo) {
                linkActivo.classList.add(\'bg-[#1e3a5f]\', \'border-r-4\', \'border-[#e11d48]\', \'shadow-sm\');
                linkActivo.classList.remove(\'text-gray-700\');
                linkActivo.classList.add(\'text-white\', \'font-semibold\');
                const icono = linkActivo.querySelector(\'i\');
                if (icono) {
                    icono.classList.remove(\'text-gray-500\');
                    icono.classList.add(\'text-white\');
                }
                const span = linkActivo.querySelector(\'span\');
                if (span) span.classList.add(\'font-semibold\');
            }
        }

        function esEscritorio() {
            return window.innerWidth >= 1024;
        }

        function cambiarSeccion(seccionId) {
            if (esEscritorio()) {
                document.querySelectorAll(\'.seccion-contenido\').forEach(s => s.classList.add(\'hidden\'));
                const seccionActiva = document.getElementById(\'seccion-\' + seccionId);
                if (seccionActiva) seccionActiva.classList.remove(\'hidden\');
            } else {
                const seccionActiva = document.getElementById(\'seccion-\' + seccionId);
                if (seccionActiva) seccionActiva.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
            }
            resaltarLink(seccionId);
        }

        window.irAConfiguracionCuenta = function () {
            cambiarSeccion(\'perfil\');
            setTimeout(() => {
                const seccionConfig = document.getElementById(\'seccion-configuracion\');
                if (seccionConfig && seccionConfig.classList.contains(\'hidden\') && typeof toggleConfiguracionCuenta === \'function\') {
                    toggleConfiguracionCuenta();
                } else if (seccionConfig) {
                    seccionConfig.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
                }
            }, 50);
        };

        document.querySelectorAll(\'.seccion-link\').forEach(link => {
            link.addEventListener(\'click\', (e) => {
                e.preventDefault();
                const seccion = link.getAttribute(\'data-seccion\');
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
                    const id = entry.target.id.replace(\'seccion-\', \'\');
                    resaltarLink(id);
                }
            });
        }, {
            rootMargin: \'-30% 0px -60% 0px\',
            threshold: 0,
        });

        function activarScrollSpy() {
            document.querySelectorAll(\'.seccion-contenido\').forEach(s => seccionObserver.observe(s));
        }
        function desactivarScrollSpy() {
            seccionObserver.disconnect();
        }

        if (!esEscritorio()) activarScrollSpy();

        // ── Sidebars móviles / tablet ──────────────────────────────────────────
        const sidebarIzq     = document.getElementById(\'sidebar-izquierdo\');
        const sidebarDer     = document.getElementById(\'sidebar-derecho\');
        const sidebarOverlay = document.getElementById(\'sidebar-overlay\');
        const btnMenu        = document.getElementById(\'btn-menu-mobile\');
        const btnSidebarDer  = document.getElementById(\'btn-sidebar-derecho\');

        function abrirSidebarIzq() {
            sidebarIzq.classList.remove(\'-translate-x-full\');
            sidebarOverlay.classList.remove(\'hidden\');
        }
        function abrirSidebarDer() {
            sidebarDer.classList.remove(\'translate-x-full\');
            sidebarOverlay.classList.remove(\'hidden\');
        }
        function cerrarSidebars() {
            if (window.innerWidth' => 'document.querySelectorAll(\'.dropdown\').forEach(dropdown => {
            const button = dropdown.querySelector(\'button\');
            const menu = dropdown.querySelector(\'.dropdown-menu\');

            if (button && menu) {
                button.addEventListener(\'click\', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll(\'.dropdown-menu\').forEach(m => {
                        if (m !== menu) m.classList.add(\'hidden\');
                    });
                    menu.classList.toggle(\'hidden\');
                });
            }
        });

        document.addEventListener(\'click\', (e) => {
            if (!e.target.closest(\'.dropdown\')) {
                document.querySelectorAll(\'.dropdown-menu\').forEach(menu => {
                    menu.classList.add(\'hidden\');
                });
            }
        });

        function resaltarLink(seccionId) {
            document.querySelectorAll(\'.seccion-link\').forEach(link => {
                link.classList.remove(\'bg-[#1e3a5f]\', \'border-r-4\', \'border-[#e11d48]\', \'shadow-sm\');
                link.classList.add(\'text-gray-700\');
                link.classList.remove(\'text-white\', \'font-semibold\');
                const icono = link.querySelector(\'i\');
                if (icono) {
                    icono.classList.remove(\'text-white\');
                    icono.classList.add(\'text-gray-500\');
                }
                const span = link.querySelector(\'span\');
                if (span) span.classList.remove(\'font-semibold\');
            });

            const linkActivo = document.querySelector(`.seccion-link[data-seccion="${seccionId}"]`);
            if (linkActivo) {
                linkActivo.classList.add(\'bg-[#1e3a5f]\', \'border-r-4\', \'border-[#e11d48]\', \'shadow-sm\');
                linkActivo.classList.remove(\'text-gray-700\');
                linkActivo.classList.add(\'text-white\', \'font-semibold\');
                const icono = linkActivo.querySelector(\'i\');
                if (icono) {
                    icono.classList.remove(\'text-gray-500\');
                    icono.classList.add(\'text-white\');
                }
                const span = linkActivo.querySelector(\'span\');
                if (span) span.classList.add(\'font-semibold\');
            }
        }

        function esEscritorio() {
            return window.innerWidth >= 1024;
        }

        function cambiarSeccion(seccionId) {
            if (esEscritorio()) {
                document.querySelectorAll(\'.seccion-contenido\').forEach(s => s.classList.add(\'hidden\'));
                const seccionActiva = document.getElementById(\'seccion-\' + seccionId);
                if (seccionActiva) seccionActiva.classList.remove(\'hidden\');
            } else {
                const seccionActiva = document.getElementById(\'seccion-\' + seccionId);
                if (seccionActiva) seccionActiva.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
            }
            resaltarLink(seccionId);
        }

        window.irAConfiguracionCuenta = function () {
            cambiarSeccion(\'perfil\');
            setTimeout(() => {
                const seccionConfig = document.getElementById(\'seccion-configuracion\');
                if (seccionConfig && seccionConfig.classList.contains(\'hidden\') && typeof toggleConfiguracionCuenta === \'function\') {
                    toggleConfiguracionCuenta();
                } else if (seccionConfig) {
                    seccionConfig.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
                }
            }, 50);
        };

        document.querySelectorAll(\'.seccion-link\').forEach(link => {
            link.addEventListener(\'click\', (e) => {
                e.preventDefault();
                const seccion = link.getAttribute(\'data-seccion\');
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
                    const id = entry.target.id.replace(\'seccion-\', \'\');
                    resaltarLink(id);
                }
            });
        }, {
            rootMargin: \'-30% 0px -60% 0px\',
            threshold: 0,
        });

        function activarScrollSpy() {
            document.querySelectorAll(\'.seccion-contenido\').forEach(s => seccionObserver.observe(s));
        }
        function desactivarScrollSpy() {
            seccionObserver.disconnect();
        }

        if (!esEscritorio()) activarScrollSpy();

        // ── Sidebars móviles / tablet ──────────────────────────────────────────
        const sidebarIzq     = document.getElementById(\'sidebar-izquierdo\');
        const sidebarDer     = document.getElementById(\'sidebar-derecho\');
        const sidebarOverlay = document.getElementById(\'sidebar-overlay\');
        const btnMenu        = document.getElementById(\'btn-menu-mobile\');
        const btnSidebarDer  = document.getElementById(\'btn-sidebar-derecho\');

        function abrirSidebarIzq() {
            sidebarIzq.classList.remove(\'-translate-x-full\');
            sidebarOverlay.classList.remove(\'hidden\');
        }
        function abrirSidebarDer() {
            sidebarDer.classList.remove(\'translate-x-full\');
            sidebarOverlay.classList.remove(\'hidden\');
        }
        function cerrarSidebars() {
            if (window.innerWidth',
  '{
            if (window.innerWidth >= 1024) sidebarIzq.classList.remove(\'-translate-x-full\');
            if (window.innerWidth >= 1280) sidebarDer.classList.remove(\'translate-x-full\');
            if (window.innerWidth >= 1280) sidebarOverlay.classList.add(\'hidden\');

            const ahoraEscritorio = esEscritorio();
            if (ahoraEscritorio !== fueEscritorio) {
                fueEscritorio = ahoraEscritorio;
                if (ahoraEscritorio) {
                    // Pasó a escritorio: modo tabs
                    desactivarScrollSpy();
                    const linkActivo = document.querySelector(\'.seccion-link.bg-\\\\[\\\\#1e3a5f\\\\]\');
                    const idActivo = linkActivo?.getAttribute(\'data-seccion\') ?? \'resumen\';
                    document.querySelectorAll(\'.seccion-contenido\').forEach(s => s.classList.add(\'hidden\'));
                    const elActivo = document.getElementById(\'seccion-\' + idActivo);
                    if (elActivo) elActivo.classList.remove(\'hidden\');
                } else {
                    // Pasó a móvil: mostrar todas y activar scroll-spy
                    document.querySelectorAll(\'.seccion-contenido\').forEach(s => s.classList.remove(\'hidden\'));
                    activarScrollSpy();
                }
            }
        });

        // ── Buscador móvil ─────────────────────────────────────────────────────
        const btnBuscadorMobile = document.getElementById(\'btn-buscador-mobile\');
        const buscadorMobileWrapper = document.getElementById(\'buscador-mobile-wrapper\');
        btnBuscadorMobile?.addEventListener(\'click\', () => {
            buscadorMobileWrapper?.classList.toggle(\'hidden\');
        });

        document.querySelectorAll(\'a[href="#"]\').forEach(link => {
            link.addEventListener(\'click\', (e) => {
                if (!link.classList.contains(\'seccion-link\')) {
                    e.preventDefault();
                }
            });
        });

        const seccionInicial = new URLSearchParams(window.location.search).get(\'seccion\') ?? \'resumen\';

        if (esEscritorio()) {
            document.querySelectorAll(\'.seccion-contenido\').forEach(s => s.classList.add(\'hidden\'));
            const elInicial = document.getElementById(\'seccion-\' + seccionInicial);
            if (elInicial) elInicial.classList.remove(\'hidden\');
        } else {
            const elInicial = document.getElementById(\'seccion-\' + seccionInicial);
            if (elInicial && seccionInicial !== \'resumen\') {
                elInicial.scrollIntoView({ behavior: \'auto\', block: \'start\' });
            }
        }
        resaltarLink(seccionInicial);
        // Limpiar el parámetro de la URL para que al recargar no vuelva a la misma sección
        if (window.location.search) {
            history.replaceState(null, \'\', window.location.pathname);
        }

        // ── Animación barra de progreso ───────────────────────────────────────
        window.addEventListener(\'load\', () => {
            const barra = document.getElementById(\'barra-progreso\');
            if (barra) {
                setTimeout(() => {
                    barra.style.width = barra.dataset.target + \'%\';
                }, 300);
            }
        });

        // ── Buscador de proyectos ─────────────────────────────────────────────
        const inputBusqueda   = document.getElementById(\'buscador-global\');
        const resultadosPanel = document.getElementById(\'buscador-resultados\');
        const clearBtn        = document.getElementById(\'buscador-clear\');

        function obtenerProyectos() {
            return Array.from(document.querySelectorAll(\'#proyectos-grid [data-proyecto-id]\'));
        }

        function limpiarBusqueda() {
            inputBusqueda.value = \'\';
            resultadosPanel.classList.add(\'hidden\');
            clearBtn.classList.add(\'hidden\');
            obtenerProyectos().forEach(c => c.style.display = \'\');
        }

        inputBusqueda.addEventListener(\'input\', function () {
            const q = this.value.trim().toLowerCase();

            clearBtn.classList.toggle(\'hidden\', q === \'\');

            if (!q) {
                resultadosPanel.classList.add(\'hidden\');
                obtenerProyectos().forEach(c => c.style.display = \'\');
                return;
            }

            const cards   = obtenerProyectos();
            const matches = cards.filter(c => {
                const nombre = c.querySelector(\'h3\')?.textContent.toLowerCase() ?? \'\';
                const desc   = c.querySelector(\'p\')?.textContent.toLowerCase() ?? \'\';
                return nombre.includes(q) || desc.includes(q);
            });

            // Mostrar resultados en el panel desplegable
            resultadosPanel.innerHTML = \'\';

            if (matches.length === 0) {
                resultadosPanel.innerHTML = `' => '{
            if (window.innerWidth >= 1024) leftsidebar.classList.remove(\'-translate-x-full\');
            if (window.innerWidth >= 1280) sidebarDer.classList.remove(\'translate-x-full\');
            if (window.innerWidth >= 1280) sidebarOverlay.classList.add(\'hidden\');

            const nowDesktop = isDesktop();
            if (nowDesktop !== wasDesktop) {
                wasDesktop = nowDesktop;
                if (nowDesktop) {
                    // Switched to desktop: tabs mode
                    disableScrollSpy();
                    const activelink = document.querySelector(\'.section-link.bg-\\\\[\\\\#1e3a5f\\\\]\');
                    const activeId = activelink?.getAttribute(\'data-section\') ?? \'summary\';
                    document.querySelectorAll(\'.content-section\').forEach(s => s.classList.add(\'hidden\'));
                    const theActive = document.getElementById(\'section-\' + activeId);
                    if (theAsset) theAsset.classList.remove(\'hidden\');
                } else {
                    // Switched to mobile: show all and activate scroll-spy
                    document.querySelectorAll(\'.content-section\').forEach(s => s.classList.remove(\'hidden\'));
                    activateScrollSpy();
                }
            }
        });

        // ── Mobile search engine ────────────────────────── ───────────────────────────
        const btnMobileSearcher = document.getElementById(\'btn-mobile-finder\');
        const finderMobileWrapper = document.getElementById(\'finder-mobile-wrapper\');
        btnMobileSearch?.addEventListener(\'click\', () => {
            finderMobileWrapper?.classList.toggle(\'hidden\');
        });

        document.querySelectorAll(\'a[href="#"]\').forEach(link => {
            link.addEventListener(\'click\', (e) => {
                if (!link.classList.contains(\'link-section\')) {
                    e.preventDefault();
                }
            });
        });

        const initialsection = new URLSearchParams(window.location.search).get(\'section\') ?? \'summary\';

        if (isDesktop()) {
            document.querySelectorAll(\'.content-section\').forEach(s => s.classList.add(\'hidden\'));
            const initialElement = document.getElementById(\'section-\' + initialSection);
            if (theInitial) theInitial.classList.remove(\'hidden\');
        } else {
            const initialElement = document.getElementById(\'section-\' + initialSection);
            if (theInitial && initialSection !== \'summary\') {
                elInicial.scrollIntoView({ behavior: \'auto\', block: \'start\' });
            }
        }
        highlightLink(startSection);
        // Clear the URL parameter so that when reloading it does not return to the same section
        if (window.location.search) {
            history.replaceState(null, \'\', window.location.pathname);
        }

        // ── Progress bar animation ───────────────────────────────────────
        window.addEventListener(\'load\', () => {
            const bar = document.getElementById(\'progress-bar\');
            if (slash) {
                setTimeout(() => {
                    bar.style.width = bar.dataset.target + \'%\';
                }, 300);
            }
        });

        // ── Project search engine ────────────────────── ───────────────────────
        const inputSearch = document.getElementById(\'global-search engine\');
        const resultsPanel = document.getElementById(\'search-results\');
        const clearBtn = document.getElementById(\'finder-clear\');

        function getProjects() {
            return Array.from(document.querySelectorAll(\'#projects-grid [data-project-id]\'));
        }

        function clearSearch() {
            inputSearch.value = \'\';
            resultsPanel.classList.add(\'hidden\');
            clearBtn.classList.add(\'hidden\');
            getProjects().forEach(c => c.style.display = \'\');
        }

        inputSearch.addEventListener(\'input\', function () {
            const q = this.value.trim().toLowerCase();

            clearBtn.classList.toggle(\'hidden\', q === \'\');

            if (!q) {
                resultsPanel.classList.add(\'hidden\');
                getProjects().forEach(c => c.style.display = \'\');
                return;
            }

            const cards = getProjects();
            const matches = cards.filter(c => {
                const name = c.querySelector(\'h3\')?.textContent.toLowerCase() ?? \'\';
                const desc = c.querySelector(\'p\')?.textContent.toLowerCase() ?? \'\';
                return name.includes(q) || desc.includes(q);
            });

            // Show results in dropdown panel
            resultsPanel.innerHTML = \'\';

            if (matches.length === 0) {
                resultsPanel.innerHTML = `',
  'Sin resultados para "' => 'No results for "',
  '${q}' => '${q}',
  '`;
            } else {
                matches.forEach(card => {
                    const nombre = card.querySelector(\'h3\')?.textContent.trim() ?? \'\';
                    const badge  = card.querySelector(\'span.rounded-full\')?.textContent.trim() ?? \'\';
                    const item   = document.createElement(\'div\');
                    item.className = \'flex items-center gap-3 px-4 py-3 hover:bg-[#1e3a5f]/5 cursor-pointer border-b border-gray-50 last:border-0 transition-colors\';
                    item.innerHTML = `' => '`;
            } else {
                matches.forEach(card => {
                    const nombre = card.querySelector(\'h3\')?.textContent.trim() ?? \'\';
                    const badge  = card.querySelector(\'span.rounded-full\')?.textContent.trim() ?? \'\';
                    const item   = document.createElement(\'div\');
                    item.className = \'flex items-center gap-3 px-4 py-3 hover:bg-[#1e3a5f]/5 cursor-pointer border-b border-gray-50 last:border-0 transition-colors\';
                    item.innerHTML = `',
  '${nombre}' => '${name}',
  '${badge}' => '${badge}',
  '`;
                    item.addEventListener(\'click\', () => {
                        cambiarSeccion(\'proyectos\');
                        limpiarBusqueda();
                        setTimeout(() => {
                            card.scrollIntoView({ behavior: \'smooth\', block: \'center\' });
                            card.classList.add(\'ring-2\', \'ring-[#1e3a5f]\', \'ring-offset-2\');
                            setTimeout(() => card.classList.remove(\'ring-2\', \'ring-[#1e3a5f]\', \'ring-offset-2\'), 1800);
                        }, 150);
                    });
                    resultadosPanel.appendChild(item);
                });
            }

            resultadosPanel.classList.remove(\'hidden\');
        });

        // Cerrar panel al hacer clic fuera
        document.addEventListener(\'click\', e => {
            if (!e.target.closest(\'#buscador-global\') && !e.target.closest(\'#buscador-resultados\')) {
                resultadosPanel.classList.add(\'hidden\');
            }
        });

        inputBusqueda.addEventListener(\'focus\', () => {
            if (inputBusqueda.value.trim()) resultadosPanel.classList.remove(\'hidden\');
        });

        // ── Marcar novedades como leídas (campana + sidebar) ────────────────
        async function marcarNovedadesVistas(botones) {
            const hayItemsVisibles = !!document.querySelector(\'.novedad-item, .novedad-item-header\');
            if (!hayItemsVisibles) return;

            botones.forEach(b => b && (b.disabled = true));
            try {
                const res = await fetch(\'{{ route(\'novedades.marcar-vistas\') }}\', {
                    method: \'POST\',
                    headers: {
                        \'Content-Type\': \'application/json\',
                        \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\')?.content || \'\',
                        \'Accept\': \'application/json\',
                    },
                    body: JSON.stringify({ todas: true }),
                });
                if (!res.ok) {
                    botones.forEach(b => b && (b.disabled = false));
                    return;
                }

                document.querySelectorAll(\'.novedad-item, .novedad-item-header\').forEach(el => el.remove());
                botones.forEach(b => b && b.remove());

                // Sidebar vacío
                const contSide = document.getElementById(\'contenedor-notificaciones\');
                if (contSide && !contSide.querySelector(\'div\')) {
                    const vacio = document.createElement(\'p\');
                    vacio.className = \'text-xs text-gray-500 italic\';
                    vacio.textContent = \'No hay novedades recientes.\';
                    contSide.appendChild(vacio);
                }

                // Header dropdown vacío
                const contHdr = document.getElementById(\'contenedor-notificaciones-header\');
                if (contHdr && !contHdr.querySelector(\'div\')) {
                    const vacio = document.createElement(\'p\');
                    vacio.className = \'p-4 text-xs text-gray-500 italic text-center\';
                    vacio.textContent = \'Sin notificaciones\';
                    contHdr.appendChild(vacio);
                }

                // Actualizar badge: restar las novedades marcadas; quedan solo los avisos de moderación (si los hay)
                const badge = document.getElementById(\'badge-notificaciones\');
                if (badge) {
                    const quedanAvisos = !!document.querySelector(\'#contenedor-notificaciones-header > div\');
                    if (quedanAvisos) {
                        badge.textContent = \'1\';
                        badge.classList.remove(\'hidden\');
                    } else {
                        badge.classList.add(\'hidden\');
                        badge.textContent = \'\';
                    }
                }
            } catch (e) {
                botones.forEach(b => b && (b.disabled = false));
            }
        }

        const btnNovSidebar = document.getElementById(\'btn-marcar-novedades-vistas\');
        const btnNovHeader  = document.getElementById(\'btn-marcar-novedades-vistas-header\');
        const grupoBotones = [btnNovSidebar, btnNovHeader];
        btnNovSidebar?.addEventListener(\'click\', () => marcarNovedadesVistas(grupoBotones));
        btnNovHeader?.addEventListener(\'click\',  () => marcarNovedadesVistas(grupoBotones));

        // ── Calendario interactivo ───────────────────────────────────────────
        (function inicializarCalendario() {
            const widget = document.getElementById(\'widget-calendario\');
            if (!widget) return;

            const endpoint = widget.dataset.endpoint;
            const hoyStr   = widget.dataset.hoy; // YYYY-MM-DD
            const titulo   = document.getElementById(\'cal-titulo\');
            const grid     = document.getElementById(\'cal-grid\');
            const panelLista = document.getElementById(\'cal-panel-lista\');
            const panelTitulo = document.getElementById(\'cal-panel-titulo\');
            const btnPrev = document.getElementById(\'cal-prev\');
            const btnNext = document.getElementById(\'cal-next\');

            const MESES = [\'Enero\',\'Febrero\',\'Marzo\',\'Abril\',\'Mayo\',\'Junio\',\'Julio\',\'Agosto\',\'Septiembre\',\'Octubre\',\'Noviembre\',\'Diciembre\'];
            const hoy = parseFecha(hoyStr);
            let mesVisible = new Date(hoy.getFullYear(), hoy.getMonth(), 1);
            let diaSeleccionado = formatearFecha(hoy);
            let eventosCache = {}; // { \'YYYY-MM-DD\': [eventos] }

            function parseFecha(str) {
                const [y, m, d] = str.split(\'-\').map(Number);
                return new Date(y, m - 1, d);
            }
            function formatearFecha(d) {
                const y = d.getFullYear();
                const m = String(d.getMonth() + 1).padStart(2, \'0\');
                const day = String(d.getDate()).padStart(2, \'0\');
                return `${y}-${m}-${day}`;
            }
            function formatearLargoEsp(str) {
                const d = parseFecha(str);
                return `${d.getDate()} de ${MESES[d.getMonth()].toLowerCase()} de ${d.getFullYear()}`;
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
                    const res = await fetch(url, { headers: { \'Accept\': \'application/json\' } });
                    const data = await res.json();
                    eventosCache = data.eventos || {};
                } catch (e) {
                    eventosCache = {};
                }
                renderizarGrid(desde, hasta, eventosCache);
                renderizarPanel(diaSeleccionado);
            }

            function renderizarGrid(desde, hasta, eventos) {
                grid.innerHTML = \'\';
                const primerDiaSemana = (desde.getDay() + 6) % 7; // lunes = 0
                const diasEnMes = hasta.getDate();
                const hoyFmt = formatearFecha(hoy);

                for (let i = 0; i' => '`;
                    item.addEventListener(\'click\', () => {
                        cambiarSeccion(\'proyectos\');
                        limpiarBusqueda();
                        setTimeout(() => {
                            card.scrollIntoView({ behavior: \'smooth\', block: \'center\' });
                            card.classList.add(\'ring-2\', \'ring-[#1e3a5f]\', \'ring-offset-2\');
                            setTimeout(() => card.classList.remove(\'ring-2\', \'ring-[#1e3a5f]\', \'ring-offset-2\'), 1800);
                        }, 150);
                    });
                    resultadosPanel.appendChild(item);
                });
            }

            resultadosPanel.classList.remove(\'hidden\');
        });

        // Cerrar panel al hacer clic fuera
        document.addEventListener(\'click\', e => {
            if (!e.target.closest(\'#buscador-global\') && !e.target.closest(\'#buscador-resultados\')) {
                resultadosPanel.classList.add(\'hidden\');
            }
        });

        inputBusqueda.addEventListener(\'focus\', () => {
            if (inputBusqueda.value.trim()) resultadosPanel.classList.remove(\'hidden\');
        });

        // ── Marcar novedades como leídas (campana + sidebar) ────────────────
        async function marcarNovedadesVistas(botones) {
            const hayItemsVisibles = !!document.querySelector(\'.novedad-item, .novedad-item-header\');
            if (!hayItemsVisibles) return;

            botones.forEach(b => b && (b.disabled = true));
            try {
                const res = await fetch(\'{{ route(\'novedades.marcar-vistas\') }}\', {
                    method: \'POST\',
                    headers: {
                        \'Content-Type\': \'application/json\',
                        \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\')?.content || \'\',
                        \'Accept\': \'application/json\',
                    },
                    body: JSON.stringify({ todas: true }),
                });
                if (!res.ok) {
                    botones.forEach(b => b && (b.disabled = false));
                    return;
                }

                document.querySelectorAll(\'.novedad-item, .novedad-item-header\').forEach(el => el.remove());
                botones.forEach(b => b && b.remove());

                // Sidebar vacío
                const contSide = document.getElementById(\'contenedor-notificaciones\');
                if (contSide && !contSide.querySelector(\'div\')) {
                    const vacio = document.createElement(\'p\');
                    vacio.className = \'text-xs text-gray-500 italic\';
                    vacio.textContent = \'No hay novedades recientes.\';
                    contSide.appendChild(vacio);
                }

                // Header dropdown vacío
                const contHdr = document.getElementById(\'contenedor-notificaciones-header\');
                if (contHdr && !contHdr.querySelector(\'div\')) {
                    const vacio = document.createElement(\'p\');
                    vacio.className = \'p-4 text-xs text-gray-500 italic text-center\';
                    vacio.textContent = \'Sin notificaciones\';
                    contHdr.appendChild(vacio);
                }

                // Actualizar badge: restar las novedades marcadas; quedan solo los avisos de moderación (si los hay)
                const badge = document.getElementById(\'badge-notificaciones\');
                if (badge) {
                    const quedanAvisos = !!document.querySelector(\'#contenedor-notificaciones-header > div\');
                    if (quedanAvisos) {
                        badge.textContent = \'1\';
                        badge.classList.remove(\'hidden\');
                    } else {
                        badge.classList.add(\'hidden\');
                        badge.textContent = \'\';
                    }
                }
            } catch (e) {
                botones.forEach(b => b && (b.disabled = false));
            }
        }

        const btnNovSidebar = document.getElementById(\'btn-marcar-novedades-vistas\');
        const btnNovHeader  = document.getElementById(\'btn-marcar-novedades-vistas-header\');
        const grupoBotones = [btnNovSidebar, btnNovHeader];
        btnNovSidebar?.addEventListener(\'click\', () => marcarNovedadesVistas(grupoBotones));
        btnNovHeader?.addEventListener(\'click\',  () => marcarNovedadesVistas(grupoBotones));

        // ── Calendario interactivo ───────────────────────────────────────────
        (function inicializarCalendario() {
            const widget = document.getElementById(\'widget-calendario\');
            if (!widget) return;

            const endpoint = widget.dataset.endpoint;
            const hoyStr   = widget.dataset.hoy; // YYYY-MM-DD
            const titulo   = document.getElementById(\'cal-titulo\');
            const grid     = document.getElementById(\'cal-grid\');
            const panelLista = document.getElementById(\'cal-panel-lista\');
            const panelTitulo = document.getElementById(\'cal-panel-titulo\');
            const btnPrev = document.getElementById(\'cal-prev\');
            const btnNext = document.getElementById(\'cal-next\');

            const MESES = [\'Enero\',\'Febrero\',\'Marzo\',\'Abril\',\'Mayo\',\'Junio\',\'Julio\',\'Agosto\',\'Septiembre\',\'Octubre\',\'Noviembre\',\'Diciembre\'];
            const hoy = parseFecha(hoyStr);
            let mesVisible = new Date(hoy.getFullYear(), hoy.getMonth(), 1);
            let diaSeleccionado = formatearFecha(hoy);
            let eventosCache = {}; // { \'YYYY-MM-DD\': [eventos] }

            function parseFecha(str) {
                const [y, m, d] = str.split(\'-\').map(Number);
                return new Date(y, m - 1, d);
            }
            function formatearFecha(d) {
                const y = d.getFullYear();
                const m = String(d.getMonth() + 1).padStart(2, \'0\');
                const day = String(d.getDate()).padStart(2, \'0\');
                return `${y}-${m}-${day}`;
            }
            function formatearLargoEsp(str) {
                const d = parseFecha(str);
                return `${d.getDate()} de ${MESES[d.getMonth()].toLowerCase()} de ${d.getFullYear()}`;
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
                    const res = await fetch(url, { headers: { \'Accept\': \'application/json\' } });
                    const data = await res.json();
                    eventosCache = data.eventos || {};
                } catch (e) {
                    eventosCache = {};
                }
                renderizarGrid(desde, hasta, eventosCache);
                renderizarPanel(diaSeleccionado);
            }

            function renderizarGrid(desde, hasta, eventos) {
                grid.innerHTML = \'\';
                const primerDiaSemana = (desde.getDay() + 6) % 7; // lunes = 0
                const diasEnMes = hasta.getDate();
                const hoyFmt = formatearFecha(hoy);

                for (let i = 0; i',
  '${d}' => '${d}',
  '${tieneEventos ? `' => '${tieneEventos ? `',
  '` : \'\'}
                    `;
                    cell.addEventListener(\'click\', () => {
                        diaSeleccionado = fechaStr;
                        renderizarGrid(desde, hasta, eventos);
                        renderizarPanel(fechaStr);
                    });
                    grid.appendChild(cell);
                }
            }

            function renderizarPanel(fechaStr) {
                panelTitulo.textContent = `Eventos · ${formatearLargoEsp(fechaStr)}`;
                const eventos = eventosCache[fechaStr] || [];

                if (!eventos.length) {
                    panelLista.innerHTML = \'' => '` : \'\'}
                    `;
                    cell.addEventListener(\'click\', () => {
                        selectedDay = strDate;
                        renderGrid(from, to, events);
                        renderPanel(dateStr);
                    });
                    grid.appendChild(cell);
                }
            }

            function renderPanel(dateStr) {
                TitlePanel.textContent = `Events · ${formatLargoEsp(fechaStr)}`;
                const events = eventsCache[dateStr] || [];

                if (!events.length) {
                    panelList.innerHTML = \'',
  'Sin eventos ese día.' => 'No events that day.',
  '\';
                    return;
                }

                panelLista.innerHTML = eventos.map(ev => `' => '\';
                    return;
                }

                panelLista.innerHTML = eventos.map(ev => `',
  '${escapeHtmlCal(ev.titulo)}' => '${escapeHtmlCal(ev.title)}',
  '${ev.detalle ? `' => '${wave.dateley ? `',
  '${escapeHtmlCal(ev.detalle)}' => '${escapeHtmlCal(ev.detail)}',
  '` : \'\'}' => '` : \'\'}',
  '`).join(\'\');
            }

            function escapeHtmlCal(s) {
                const d = document.createElement(\'div\');
                d.textContent = s ?? \'\';
                return d.innerHTML;
            }

            btnPrev.addEventListener(\'click\', () => {
                mesVisible = new Date(mesVisible.getFullYear(), mesVisible.getMonth() - 1, 1);
                cargarMes();
            });
            btnNext.addEventListener(\'click\', () => {
                mesVisible = new Date(mesVisible.getFullYear(), mesVisible.getMonth() + 1, 1);
                cargarMes();
            });

            cargarMes();
        })();
// ========================================
// NOTIFICACIONES DROPDOWN (MEJORADO)
// ========================================
const btnNotif = document.getElementById(\'btn-notificaciones\');
const menuNotif = document.getElementById(\'notificaciones-menu\');
let notifAbierto = false;

function escapeHtml(text) {
    const div = document.createElement(\'div\');
    div.textContent = text;
    return div.innerHTML;
}

function cargarNotificaciones() {
    fetch(\'{{ route("notifications.list") }}\')
        .then(response => response.json())
        .then(data => {
            const lista = document.getElementById(\'notificaciones-lista\');
            const badge = document.getElementById(\'notificaciones-badge\');
            
            if (data.noLeidas > 0) {
                badge.textContent = data.noLeidas > 99 ? \'99+\' : data.noLeidas;
                badge.classList.remove(\'hidden\');
            } else {
                badge.classList.add(\'hidden\');
            }
            
            if (data.notificaciones.length === 0) {
                lista.innerHTML = `' => '`).join(\'\');
            }

            function escapeHtmlCal(s) {
                const d = document.createElement(\'div\');
                d.textContent = s ?? \'\';
                return d.innerHTML;
            }

            btnPrev.addEventListener(\'click\', () => {
                mesVisible = new Date(mesVisible.getFullYear(), mesVisible.getMonth() - 1, 1);
                cargarMes();
            });
            btnNext.addEventListener(\'click\', () => {
                mesVisible = new Date(mesVisible.getFullYear(), mesVisible.getMonth() + 1, 1);
                cargarMes();
            });

            cargarMes();
        })();
// ========================================
// NOTIFICACIONES DROPDOWN (MEJORADO)
// ========================================
const btnNotif = document.getElementById(\'btn-notificaciones\');
const menuNotif = document.getElementById(\'notificaciones-menu\');
let notifAbierto = false;

function escapeHtml(text) {
    const div = document.createElement(\'div\');
    div.textContent = text;
    return div.innerHTML;
}

function cargarNotificaciones() {
    fetch(\'{{ route("notifications.list") }}\')
        .then(response => response.json())
        .then(data => {
            const lista = document.getElementById(\'notificaciones-lista\');
            const badge = document.getElementById(\'notificaciones-badge\');
            
            if (data.noLeidas > 0) {
                badge.textContent = data.noLeidas > 99 ? \'99+\' : data.noLeidas;
                badge.classList.remove(\'hidden\');
            } else {
                badge.classList.add(\'hidden\');
            }
            
            if (data.notificaciones.length === 0) {
                lista.innerHTML = `',
  'No hay notificaciones' => 'No notifications',
  '`;
            } else {
                let html = \'\';
                data.notificaciones.forEach(notif => {
                    let tipoIcon = \'\';
                    if (notif.tipo === \'info\') tipoIcon = \'fa-info-circle text-blue-500\';
                    else if (notif.tipo === \'success\') tipoIcon = \'fa-check-circle text-green-500\';
                    else if (notif.tipo === \'warning\') tipoIcon = \'fa-exclamation-triangle text-yellow-500\';
                    else tipoIcon = \'fa-times-circle text-red-500\';
                    
                    const fondoClass = !notif.leido ? \'bg-blue-50\' : \'bg-white\';
                    
                    html += `' => '`;
            } else {
                let html = \'\';
                data.notificaciones.forEach(notif => {
                    let tipoIcon = \'\';
                    if (notif.tipo === \'info\') tipoIcon = \'fa-info-circle text-blue-500\';
                    else if (notif.tipo === \'success\') tipoIcon = \'fa-check-circle text-green-500\';
                    else if (notif.tipo === \'warning\') tipoIcon = \'fa-exclamation-triangle text-yellow-500\';
                    else tipoIcon = \'fa-times-circle text-red-500\';
                    
                    const fondoClass = !notif.leido ? \'bg-blue-50\' : \'bg-white\';
                    
                    html += `',
  '${escapeHtml(notif.titulo)}' => '${escapeHtml(notif.title)}',
  '${escapeHtml(notif.mensaje)}' => '${escapeHtml(notif.message)}',
  '${notif.hace}' => '${notif.ago}',
  '${!notif.leido ? \'' => '${!notif.allowed ? \'',
  '\' : \'\'}' => '\' : \'\'}',
  '`;
                });
                lista.innerHTML = html;
            }
        });
}

function marcarLeida(id, url, elemento) {
    if (elemento && elemento.classList.contains(\'marcando\')) return;
    if (elemento) elemento.classList.add(\'marcando\', \'opacity-50\');
    
    fetch(\'{{ route("notifications.marcar-leida") }}\', {
        method: \'POST\',
        headers: {
            \'X-CSRF-TOKEN\': \'{{ csrf_token() }}\',
            \'Content-Type\': \'application/json\'
        },
        body: JSON.stringify({ id: id })
    }).then(() => {
        if (elemento) {
            elemento.classList.remove(\'bg-blue-50\');
            elemento.classList.add(\'bg-white\');
            const badgeAzul = elemento.querySelector(\'.w-2.h-2.bg-blue-500\');
            if (badgeAzul) badgeAzul.remove();
        }
        
        if (url && url !== \'\') {
            window.location.href = url;
        } else {
            actualizarContadorNotificaciones();
            if (notifAbierto) cargarNotificaciones();
        }
    }).catch(error => {
        console.error(\'Error:\', error);
        if (elemento) elemento.classList.remove(\'opacity-50\');
    }).finally(() => {
        if (elemento) {
            elemento.classList.remove(\'marcando\');
            setTimeout(() => {
                if (elemento) elemento.classList.remove(\'opacity-50\');
            }, 300);
        }
    });
}

function actualizarContadorNotificaciones() {
    fetch(\'{{ route("notifications.count") }}\')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById(\'notificaciones-badge\');
            if (data.count > 0) {
                badge.textContent = data.count > 99 ? \'99+\' : data.count;
                badge.classList.remove(\'hidden\');
            } else {
                badge.classList.add(\'hidden\');
            }
        });
}

if (btnNotif) {
    btnNotif.addEventListener(\'click\', (e) => {
        e.stopPropagation();
        if (!notifAbierto) {
            cargarNotificaciones();
            menuNotif.classList.remove(\'hidden\');
            notifAbierto = true;
        } else {
            menuNotif.classList.add(\'hidden\');
            notifAbierto = false;
        }
    });
    
    document.addEventListener(\'click\', (e) => {
        if (btnNotif && menuNotif && 
            !btnNotif.contains(e.target) && 
            !menuNotif.contains(e.target)) {
            menuNotif.classList.add(\'hidden\');
            notifAbierto = false;
        }
    });
}

// Inicializar
actualizarContadorNotificaciones();
setInterval(actualizarContadorNotificaciones, 30000);' => '`;
                });
                lista.innerHTML = html;
            }
        });
}

function marcarLeida(id, url, elemento) {
    if (elemento && elemento.classList.contains(\'marcando\')) return;
    if (elemento) elemento.classList.add(\'marcando\', \'opacity-50\');
    
    fetch(\'{{ route("notifications.marcar-leida") }}\', {
        method: \'POST\',
        headers: {
            \'X-CSRF-TOKEN\': \'{{ csrf_token() }}\',
            \'Content-Type\': \'application/json\'
        },
        body: JSON.stringify({ id: id })
    }).then(() => {
        if (elemento) {
            elemento.classList.remove(\'bg-blue-50\');
            elemento.classList.add(\'bg-white\');
            const badgeAzul = elemento.querySelector(\'.w-2.h-2.bg-blue-500\');
            if (badgeAzul) badgeAzul.remove();
        }
        
        if (url && url !== \'\') {
            window.location.href = url;
        } else {
            actualizarContadorNotificaciones();
            if (notifAbierto) cargarNotificaciones();
        }
    }).catch(error => {
        console.error(\'Error:\', error);
        if (elemento) elemento.classList.remove(\'opacity-50\');
    }).finally(() => {
        if (elemento) {
            elemento.classList.remove(\'marcando\');
            setTimeout(() => {
                if (elemento) elemento.classList.remove(\'opacity-50\');
            }, 300);
        }
    });
}

function actualizarContadorNotificaciones() {
    fetch(\'{{ route("notifications.count") }}\')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById(\'notificaciones-badge\');
            if (data.count > 0) {
                badge.textContent = data.count > 99 ? \'99+\' : data.count;
                badge.classList.remove(\'hidden\');
            } else {
                badge.classList.add(\'hidden\');
            }
        });
}

if (btnNotif) {
    btnNotif.addEventListener(\'click\', (e) => {
        e.stopPropagation();
        if (!notifAbierto) {
            cargarNotificaciones();
            menuNotif.classList.remove(\'hidden\');
            notifAbierto = true;
        } else {
            menuNotif.classList.add(\'hidden\');
            notifAbierto = false;
        }
    });
    
    document.addEventListener(\'click\', (e) => {
        if (btnNotif && menuNotif && 
            !btnNotif.contains(e.target) && 
            !menuNotif.contains(e.target)) {
            menuNotif.classList.add(\'hidden\');
            notifAbierto = false;
        }
    });
}

// Inicializar
actualizarContadorNotificaciones();
setInterval(actualizarContadorNotificaciones, 30000);',
  'toDateString() }}"
                     data-endpoint="{{ route(\'calendario.eventos\') }}">' => 'toDateString() }}"
                     data-endpoint="{{ route(\'calendario.eventos\') }}">',
  '—' => '—',
  'Eventos del día' => 'Events of the day',
  'Selecciona un día para ver sus eventos.' => 'Select a day to view its events.',
  'Notificaciones y novedades' => 'Notifications and news',
  'Marcar leídas' => 'Mark read',
  'Enlaces rápidos' => 'Quick links',
  'Mi portafolio público' => 'My public portfolio',
  'Artículos guardados' => 'Saved Articles',
  'Novedades del sistema' => 'System news',
  'function cargarNovedades() {
    const container = document.getElementById(\'contenedor-novedades\');
    const btnMarcar = document.getElementById(\'btn-marcar-novedades-vistas\');
    
    if (!container) return;
    
    // Mostrar loading
    container.innerHTML = `' => 'function loadNovedades() {
    const container = document.getElementById(\'contenedor-novedades\');
    const btnMarcar = document.getElementById(\'btn-marcar-novedades-vistas\');
    
    if (!container) return;
    
    // Show loading
    container.innerHTML = `',
  '`;
    
    fetch(\'{{ route("novedades.list") }}\', {
        headers: {
            \'X-Requested-With\': \'XMLHttpRequest\',
            \'Accept\': \'application/json\'
        },
        credentials: \'same-origin\'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(\'HTTP error \' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            container.innerHTML = `' => '`;
    
    fetch(\'{{ route("novedades.list") }}\', {
        headers: {
            \'X-Requested-With\': \'XMLHttpRequest\',
            \'Accept\': \'application/json\'
        },
        credentials: \'same-origin\'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(\'HTTP error \' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            container.innerHTML = `',
  'Error: ${data.error}' => 'Error: ${data.error}',
  '`;
            if (btnMarcar) btnMarcar.classList.add(\'hidden\');
            return;
        }
        
        if (!data.novedades || data.novedades.length === 0) {
            container.innerHTML = \'' => '`;
            if (btnMarcar) btnMarcar.classList.add(\'hidden\');
            return;
        }
        
        if (!data.novedades || data.novedades.length === 0) {
            container.innerHTML = \'',
  'No hay novedades recientes.' => 'There are no recent news.',
  '\';
            if (btnMarcar) btnMarcar.classList.add(\'hidden\');
            return;
        }
        
        // Mostrar solo las 4 más recientes
        const novedadesMostrar = data.novedades.slice(0, 4);
        const totalRestantes = data.novedades.length - 4;
        
        // Verificar si hay notificaciones no leídas
        const hayNoLeidas = data.novedades.some(n => n.tipo === \'notificacion\' && !n.leido);
        if (btnMarcar) {
            if (hayNoLeidas) {
                btnMarcar.classList.remove(\'hidden\');
            } else {
                btnMarcar.classList.add(\'hidden\');
            }
        }
        
        let html = \'\';
        
        novedadesMostrar.forEach(novedad => {
            let bgClass = \'\';
            let borderClass = \'\';
            
            if (novedad.tipo === \'portafolio_oculto\') {
                bgClass = \'bg-red-50\';
                borderClass = \'border-l-4 border-red-500\';
            } else if (novedad.tipo === \'nota_moderacion\') {
                bgClass = \'bg-yellow-50\';
                borderClass = \'border-l-4 border-yellow-500\';
            } else if (novedad.tipo === \'notificacion\' && !novedad.leido) {
                bgClass = \'bg-blue-50\';
                borderClass = \'border-l-4 border-blue-500\';
            }
            
            html += `' => '\';
            if (btnMark) btnMark.classList.add(\'hidden\');
            return;
        }
        
        // Show only the 4 most recent
        const newsShow = data.news.slice(0, 4);
        const totalRemaining = data.news.length - 4;
        
        // Check for unread notifications
        const noRead = data.news.some(n => n.type === \'notification\' && !n.read);
        if (btnMark) {
            if (there areNoReads) {
                btnMark.classList.remove(\'hidden\');
            } else {
                btnMark.classList.add(\'hidden\');
            }
        }
        
        let html = \'\';
        
        newShow.forEach(new => {
            let bgClass = \'\';
            let borderClass = \'\';
            
            if (new.type === \'hidden_portfolio\') {
                bgClass = \'bg-network-50\';
                borderClass = \'border-l-4 border-red-500\';
            } else if (new.type === \'note_moderation\') {
                bgClass = \'bg-yellow-50\';
                borderClass = \'border-l-4 border-yellow-500\';
            } else if (new.type === \'notification\' && !new.read) {
                bgClass = \'bg-blue-50\';
                borderClass = \'border-l-4 border-blue-500\';
            }
            
            html += `',
  '${escapeHtml(novedad.titulo || \'Sin título\')}' => '${escapeHtml(new.title || \'Untitled\')}',
  '${escapeHtml(novedad.detalle || \'\')}' => '${escapeHtml(new.detail || \'\')}',
  '${formatDate(novedad.created_at)}' => '${formatDate(novedad.created_at)}',
  '${novedad.tipo === \'notificacion\' && !novedad.leido ? \'' => '${new.type === \'notification\' && !new.read ? \'',
  '`;
        });
        
        // Agregar enlace "Ver todas" si hay más notificaciones
        if (totalRestantes > 0) {
            html += `' => '`;
        });
        
        // Add "See all" link if there are more notifications
        if (totalRemaining > 0) {
            html += `',
  'Ver ${totalRestantes} notificaciones más...' => 'See ${totalRemaining} notifications more...',
  '`;
        }
        
        container.innerHTML = html;
        
        // Agregar eventos click a cada novedad
        document.querySelectorAll(\'#contenedor-novedades [data-tipo]\').forEach(item => {
            item.addEventListener(\'click\', function(e) {
                e.stopPropagation();
                const tipo = this.dataset.tipo;
                const id = this.dataset.id;
                const url = this.dataset.url;
                
                if (tipo === \'notificacion\' && id) {
                    fetch(\'{{ route("novedades.marcar-vista") }}\', {
                        method: \'POST\',
                        headers: {
                            \'X-CSRF-TOKEN\': \'{{ csrf_token() }}\',
                            \'Content-Type\': \'application/json\'
                        },
                        body: JSON.stringify({ tipo: tipo, id: id })
                    }).then(() => {
                        if (url) {
                            window.location.href = url;
                        } else {
                            cargarNovedades();
                            // Actualizar también la campana
                            if (typeof actualizarContadorNotificaciones === \'function\') {
                                actualizarContadorNotificaciones();
                            }
                        }
                    }).catch(err => console.error(\'Error:\', err));
                } else if (url) {
                    window.location.href = url;
                }
            });
        });
    })
    .catch(error => {
        console.error(\'Error cargando novedades:\', error);
        container.innerHTML = \'' => '`;
        }
        
        container.innerHTML = html;
        
        // Agregar eventos click a cada novedad
        document.querySelectorAll(\'#contenedor-novedades [data-tipo]\').forEach(item => {
            item.addEventListener(\'click\', function(e) {
                e.stopPropagation();
                const tipo = this.dataset.tipo;
                const id = this.dataset.id;
                const url = this.dataset.url;
                
                if (tipo === \'notificacion\' && id) {
                    fetch(\'{{ route("novedades.marcar-vista") }}\', {
                        method: \'POST\',
                        headers: {
                            \'X-CSRF-TOKEN\': \'{{ csrf_token() }}\',
                            \'Content-Type\': \'application/json\'
                        },
                        body: JSON.stringify({ tipo: tipo, id: id })
                    }).then(() => {
                        if (url) {
                            window.location.href = url;
                        } else {
                            cargarNovedades();
                            // Actualizar también la campana
                            if (typeof actualizarContadorNotificaciones === \'function\') {
                                actualizarContadorNotificaciones();
                            }
                        }
                    }).catch(err => console.error(\'Error:\', err));
                } else if (url) {
                    window.location.href = url;
                }
            });
        });
    })
    .catch(error => {
        console.error(\'Error cargando novedades:\', error);
        container.innerHTML = \'',
  'Error al cargar novedades' => 'Error loading news',
  '\';
    });
}

// Función auxiliar para escapar HTML
function escapeHtml(text) {
    if (!text) return \'\';
    const div = document.createElement(\'div\');
    div.textContent = text;
    return div.innerHTML;
}

// Función para formatear fechas
function formatDate(dateStr) {
    if (!dateStr) return \'\';
    const date = new Date(dateStr);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMs / 3600000);
    const diffDays = Math.floor(diffMs / 86400000);
    
    if (diffMins' => '\';
    });
}

// Función auxiliar para escapar HTML
function escapeHtml(text) {
    if (!text) return \'\';
    const div = document.createElement(\'div\');
    div.textContent = text;
    return div.innerHTML;
}

// Función para formatear fechas
function formatDate(dateStr) {
    if (!dateStr) return \'\';
    const date = new Date(dateStr);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMs / 3600000);
    const diffDays = Math.floor(diffMs / 86400000);
    
    if (diffMins',
  '{
        cargarNovedades();
    }).catch(err => console.error(\'Error:\', err));
});

document.addEventListener(\'DOMContentLoaded\', function() {
    cargarNovedades();
});' => '{
        cargarNovedades();
    }).catch(err => console.error(\'Error:\', err));
});

document.addEventListener(\'DOMContentLoaded\', function() {
    cargarNovedades();
});',
  'html {
            scroll-behavior: smooth;
        }

        #sidebar-izquierdo,
        #sidebar-derecho {
            scroll-behavior: smooth;
        }

        .seccion-contenido {
            scroll-margin-top: 6rem;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .transition-all-soft {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .sidebar-item:hover {
            transform: translateX(5px);
            background: rgba(0,0,0,0.05);
        }

        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }

        .right-sidebar-item:hover {
            background: #f3f4f6;
            transform: translateX(-3px);
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        html, body {
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .main-container {
            min-height: calc(100vh - 4rem);
        }
        .notificacion-item {
            transition: all 0.3s ease;
        }

        .notificacion-item:hover {
            transform: translateX(4px);
        }

        .notificacion-item.marcando {
            pointer-events: none;
            cursor: wait;
        }

        /* Efecto de fade out al marcar */
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0.6; }
        }

        .notificacion-item:active {
            animation: fadeOut 0.2s ease;
        }' => 'html {
            scroll-behavior: smooth;
        }

        #sidebar-izquierdo,
        #sidebar-derecho {
            scroll-behavior: smooth;
        }

        .seccion-contenido {
            scroll-margin-top: 6rem;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .transition-all-soft {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .sidebar-item:hover {
            transform: translateX(5px);
            background: rgba(0,0,0,0.05);
        }

        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }

        .right-sidebar-item:hover {
            background: #f3f4f6;
            transform: translateX(-3px);
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        html, body {
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .main-container {
            min-height: calc(100vh - 4rem);
        }
        .notificacion-item {
            transition: all 0.3s ease;
        }

        .notificacion-item:hover {
            transform: translateX(4px);
        }

        .notificacion-item.marcando {
            pointer-events: none;
            cursor: wait;
        }

        /* Efecto de fade out al marcar */
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0.6; }
        }

        .notificacion-item:active {
            animation: fadeOut 0.2s ease;
        }',
  'Respaldos (Backups)' => 'Backups',
  'Administra los respaldos de la base de datos' => 'Manage database backups',
  'Backup completo' => 'Full backup',
  'Exporta toda la base de datos' => 'Export the entire database',
  'Genera un volcado completo con' => 'Generate a full dump with',
  'pg_dump' => 'pg_dump',
  '. Incluye esquema y todos los datos.' => '. Includes schematic and all data.',
  'Crear backup completo' => 'Create full backup',
  'Backup por rango de fechas' => 'Backup by date range',
  'Solo los registros creados en ese período' => 'Only records created in that period',
  'Exporta únicamente los registros cuya fecha de creación (' => 'Exports only records whose creation date (',
  'created_at' => 'created_at',
  ') esté dentro del rango seleccionado.' => ') is within the selected range.',
  'Desde' => 'From',
  'Hasta' => 'Until',
  'Crear backup por fechas' => 'Create backup by dates',
  'Mostrar backups desde' => 'Show backups from',
  'Filtrar' => 'Filter',
  'Limpiar' => 'Clean',
  'Nombre' => 'Name',
  'Tipo' => 'Type',
  'Tamaño' => 'Size',
  'Generado' => 'Generated',
  'Acciones' => 'Actions',
  'Por fechas' => 'By dates',
  'Completo' => 'Full',
  '$backup[\'name\']]) }}"
                                   class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 p-2 rounded-lg transition"
                                   title="Descargar">' => '$backup[\'name\']]) }}"
                                   class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 p-2 rounded-lg transition"
                                   title="Descargar">',
  'No hay respaldos disponibles' => 'No backups available',
  'Descargar' => 'Descargar',
  'Eliminar' => 'Eliminate',
  'Gestión de Categorías' => 'Category Management',
  'Administra las categorías de habilidades' => 'Manage skill categories',
  'Nueva Categoría' => 'New Category',
  'Imagen' => 'Image',
  'Habilidades' => 'Skills',
  '#{{ $categoria->id_categoria }}' => '#{{ $category->category_id }}',
  'imagen }}" alt="{{ $categoria->nombre }}"
                                 class="h-10 w-10 rounded-full object-cover border border-gray-200"
                                 onerror="this.onerror=null;this.src=\'https://via.placeholder.com/40?text=?\';">
                        @else' => 'imagen }}" alt="{{ $categoria->nombre }}"
                                 class="h-10 w-10 rounded-full object-cover border border-gray-200"
                                 onerror="this.onerror=null;this.src=\'https://via.placeholder.com/40?text=?\';">
                        @else',
  'id_categoria }}, {!! Js::from($categoria->nombre) !!}, {!! Js::from($categoria->imagen) !!})"
                                    class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition">' => 'id_categoria }}, {!! Js::from($categoria->nombre) !!}, {!! Js::from($categoria->imagen) !!})"
                                    class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition">',
  'id_categoria) }}" method="POST" class="inline" data-confirm="¿Eliminar la categoría «{{ $categoria->nombre }}»?">
                                @csrf
                                @method(\'DELETE\')' => 'id_categoria) }}" method="POST" class="inline" data-confirm="Delete the category «{{ $categoria->name }}»?">
                                @csrf
                                @method(\'DELETE\')',
  'No hay categorías registradas' => 'There are no registered categories',
  'Nombre *' => 'Name *',
  'URL de imagen *' => 'Image URL *',
  'Pega la URL pública de la imagen.' => 'Paste the public URL of the image.',
  'Cancelar' => 'Cancel',
  'Guardar' => 'Keep',
  'const previewImg = document.getElementById(\'categoriaImagenPreview\');
    const imagenInput = document.getElementById(\'categoriaImagen\');

    function actualizarPreview(url) {
        if (url && url.trim()) {
            previewImg.src = url.trim();
            previewImg.classList.remove(\'hidden\');
            previewImg.onerror = () => previewImg.classList.add(\'hidden\');
        } else {
            previewImg.classList.add(\'hidden\');
            previewImg.src = \'\';
        }
    }

    imagenInput.addEventListener(\'input\', (e) => actualizarPreview(e.target.value));

    function abrirModalCrear() {
        document.getElementById(\'modalTitulo\').innerText = \'Nueva Categoría\';
        document.getElementById(\'formCategoria\').action = "{{ route(\'admin.categorias.store\') }}";
        document.getElementById(\'methodField\').value = \'POST\';
        document.getElementById(\'categoriaNombre\').value = \'\';
        imagenInput.value = \'\';
        actualizarPreview(\'\');
        document.getElementById(\'modalCategoria\').classList.remove(\'hidden\');
    }

    function editarCategoria(id, nombre, imagen) {
        document.getElementById(\'modalTitulo\').innerText = \'Editar Categoría\';
        document.getElementById(\'formCategoria\').action = `/admin/categorias/${id}`;
        document.getElementById(\'methodField\').value = \'PUT\';
        document.getElementById(\'categoriaNombre\').value = nombre;
        imagenInput.value = imagen || \'\';
        actualizarPreview(imagen || \'\');
        document.getElementById(\'modalCategoria\').classList.remove(\'hidden\');
    }

    function cerrarModal() {
        document.getElementById(\'modalCategoria\').classList.add(\'hidden\');
    }
    
    // Reabrir modal si hay errores de validación
    @if($errors->any())
        document.getElementById(\'modalTitulo\').innerText = \'Nueva Categoría\';
        document.getElementById(\'formCategoria\').action = "{{ route(\'admin.categorias.store\') }}";
        document.getElementById(\'methodField\').value = \'POST\';
        actualizarPreview(imagenInput.value);
        document.getElementById(\'modalCategoria\').classList.remove(\'hidden\');
    @endif

    // Cerrar modal con ESC
    document.addEventListener(\'keydown\', function(event) {
        if (event.key === \'Escape\') {
            cerrarModal();
        }
    });
    
    // Cerrar modal al hacer clic fuera
    document.getElementById(\'modalCategoria\').addEventListener(\'click\', function(e) {
        if (e.target === this) {
            cerrarModal();
        }
    });' => 'const previewImg = document.getElementById(\'categoriaImagenPreview\');
    const imagenInput = document.getElementById(\'categoriaImagen\');

    function actualizarPreview(url) {
        if (url && url.trim()) {
            previewImg.src = url.trim();
            previewImg.classList.remove(\'hidden\');
            previewImg.onerror = () => previewImg.classList.add(\'hidden\');
        } else {
            previewImg.classList.add(\'hidden\');
            previewImg.src = \'\';
        }
    }

    imagenInput.addEventListener(\'input\', (e) => actualizarPreview(e.target.value));

    function abrirModalCrear() {
        document.getElementById(\'modalTitulo\').innerText = \'Nueva Categoría\';
        document.getElementById(\'formCategoria\').action = "{{ route(\'admin.categorias.store\') }}";
        document.getElementById(\'methodField\').value = \'POST\';
        document.getElementById(\'categoriaNombre\').value = \'\';
        imagenInput.value = \'\';
        actualizarPreview(\'\');
        document.getElementById(\'modalCategoria\').classList.remove(\'hidden\');
    }

    function editarCategoria(id, nombre, imagen) {
        document.getElementById(\'modalTitulo\').innerText = \'Editar Categoría\';
        document.getElementById(\'formCategoria\').action = `/admin/categorias/${id}`;
        document.getElementById(\'methodField\').value = \'PUT\';
        document.getElementById(\'categoriaNombre\').value = nombre;
        imagenInput.value = imagen || \'\';
        actualizarPreview(imagen || \'\');
        document.getElementById(\'modalCategoria\').classList.remove(\'hidden\');
    }

    function cerrarModal() {
        document.getElementById(\'modalCategoria\').classList.add(\'hidden\');
    }
    
    // Reabrir modal si hay errores de validación
    @if($errors->any())
        document.getElementById(\'modalTitulo\').innerText = \'Nueva Categoría\';
        document.getElementById(\'formCategoria\').action = "{{ route(\'admin.categorias.store\') }}";
        document.getElementById(\'methodField\').value = \'POST\';
        actualizarPreview(imagenInput.value);
        document.getElementById(\'modalCategoria\').classList.remove(\'hidden\');
    @endif

    // Cerrar modal con ESC
    document.addEventListener(\'keydown\', function(event) {
        if (event.key === \'Escape\') {
            cerrarModal();
        }
    });
    
    // Cerrar modal al hacer clic fuera
    document.getElementById(\'modalCategoria\').addEventListener(\'click\', function(e) {
        if (e.target === this) {
            cerrarModal();
        }
    });',
  'Ej: Programación, Diseño, Marketing' => 'In: Programming, Design, Marketing',
  'https://ejemplo.com/imagen.png' => 'https://ejemplo.com/imagen.png',
  'Configuración del sitio' => 'Site Settings',
  'Edita los datos que aparecen en el footer y en la home page pública.' => 'Edit the data that appears in the footer and on the public home page.',
  'Nombre de la empresa' => 'Company name',
  'nombre_empresa) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">' => 'nombre_empresa) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">',
  'Descripción' => 'Description',
  'Aparece en el footer junto al nombre de la empresa.' => 'It appears in the footer next to the company name.',
  'Email de contacto' => 'Contact email',
  'email_contacto) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">' => 'email_contacto) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">',
  'Teléfono' => 'Telephone',
  'telefono) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">' => 'telefono) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">',
  'Guardar cambios' => 'Save changes',
  'Dashboard / Resumen general' => 'Dashboard / General Summary',
  'Resumen general' => 'General summary',
  'Total Usuarios' => 'Total Users',
  '+{{ $crecimientoUsuarios }}% vs mes anterior' => '+{{ $growthUsers }}% vs previous month',
  'Usuarios Activos' => 'Active Users',
  'Usuarios Suspendidos' => 'Suspended Users',
  'Portafolios' => 'Briefcase',
  'Usuarios hoy' => 'Users today',
  'Proyectos hoy' => 'Projects today',
  'Tasa de conversión' => 'Conversion rate',
  'Inactivos >30 días' => 'Inactive >30 days',
  'Sin actividad reciente' => 'No recent activity',
  'Proyectos privados' => 'Private projects',
  'Crecimiento de Usuarios' => 'User Growth',
  '= 0 ? \'text-green-600\' : \'text-red-600\' }}">' => '= 0 ? \'text-green-600\' : \'text-red-600\' }}">',
  '= 0 ? \'up\' : \'down\' }}">' => '= 0 ? \'up\' : \'down\' }}">',
  'Este mes' => 'This month',
  'Mes anterior' => 'Previous month',
  'Proyección próximo mes' => 'Projection next month',
  'Crecimiento de Proyectos' => 'Project Growth',
  'Tecnologías más usadas' => 'Most used technologies',
  'No hay datos disponibles' => 'No data available',
  'Habilidades más comunes' => 'Most common skills',
  'Usuarios Recientes' => 'Recent Users',
  'Ver todos' => 'See all',
  'USUARIO' => 'USER',
  'EMAIL' => 'EMAIL',
  'ESTADO' => 'STATE',
  'FECHA REGISTRO' => 'REGISTRATION DATE',
  'ÚLTIMO ACCESO' => 'LAST ACCESS',
  'Activo' => 'Asset',
  'Suspendido' => 'Suspended',
  'No hay usuarios registrados' => 'There are no registered users',
  'Editar categoría' => 'Edit category',
  'URL de imagen' => 'Image URL',
  'Editar habilidad blanda' => 'Edit soft skill',
  'Total Habilidades' => 'Total Skills',
  'Habilidad más popular' => 'Most popular skill',
  'Categorías de habilidades técnicas' => 'Technical Skills Categories',
  'Agregar' => 'Add',
  'imagen }}" alt="{{ $categoria->nombre }}"
                                 class="h-6 w-6 rounded-full object-cover border border-gray-200 mr-2"
                                 onerror="this.onerror=null;this.style.display=\'none\';">
                        @else' => 'imagen }}" alt="{{ $categoria->nombre }}"
                                 class="h-6 w-6 rounded-full object-cover border border-gray-200 mr-2"
                                 onerror="this.onerror=null;this.style.display=\'none\';">
                        @else',
  '({{ $categoria->habilidades_count ?? 0 }})' => '({{ $category->skills_count ?? 0 }})',
  'id_categoria }}, {!! Js::from($categoria->nombre) !!}, {!! Js::from($categoria->imagen ?? \'\') !!})"
                            class="ml-2 text-blue-600 hover:text-blue-800" title="Editar">' => 'id_categoria }}, {!! Js::from($categoria->nombre) !!}, {!! Js::from($categoria->imagen ?? \'\') !!})"
                            class="ml-2 text-blue-600 hover:text-blue-800" title="Editar">',
  'id_categoria) }}" method="POST"
                            class="inline ml-1" data-confirm="¿Eliminar la categoría «{{ $categoria->nombre }}»?">
                            @csrf
                            @method(\'DELETE\')' => 'category_id) }}" method="POST"
                            class="inline ml-1" data-confirm="Delete the category «{{ $category->name }}»?">
                            @csrf
                            @method(\'DELETE\')',
  'Todas las categorías' => 'All categories',
  'id_categoria }}" {{ request(\'categoria\') == $categoria->id_categoria ? \'selected\' : \'\' }}>
                            {{ $categoria->nombre }}' => 'category_id }}" {{ request(\'category\') == $category->category_id ? \'selected\' : \'\' }}>
                            {{ $category->name }}',
  'HABILIDAD' => 'ABILITY',
  'CATEGORÍA' => 'CATEGORY',
  'ACCIONES' => 'ACTIONS',
  'activa ? \'bg-green-100 text-green-800\' : \'bg-red-100 text-red-800\' }}">
                                    {{ $habilidad->activa ? \'Activa\' : \'Inactiva\' }}' => 'active? \'bg-green-100 text-green-800\' : \'bg-red-100 text-red-800\' }}">
                                    {{ $skill->active ? \'Active\' : \'Inactive\' }}',
  'id_habilidad) }}"
                                       class="text-blue-600 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg">Ver' => 'id_habilidad) }}"
                                       class="text-blue-600 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg">Ver',
  'id_habilidad }}, {!! Js::from($habilidad->nombre) !!})"
                                            class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                            Ocultar' => 'skill_id }}, {!! Js::from($skill->name) !!})"
                                            class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                            Hide',
  'id_habilidad) }}" method="POST">
                                            @csrf' => 'skill_id) }}" method="POST">
                                            @csrf',
  'Mostrar' => 'Show',
  'No hay habilidades técnicas registradas' => 'No technical skills recorded',
  'Nueva categoría' => 'New category',
  'URL de imagen (https://...)' => 'Image URL (https://...)',
  'Buscar habilidad...' => 'Search skill...',
  'Editar' => 'Edit',
  'Gestión de Habilidades' => 'Skills Management',
  'Administra el catálogo global de habilidades técnicas y blandas' => 'Manage the global catalog of technical and soft skills',
  'Técnicas' => 'Techniques',
  'Blandas' => 'Commingle',
  'Registrar nueva habilidad blanda' => 'Register new soft skill',
  'Registrar' => 'Registrar',
  'NOMBRE' => 'NAME',
  'DESCRIPCIÓN' => 'DESCRIPTION',
  'estado === \'activo\' ? \'bg-green-100 text-green-800\' : \'bg-red-100 text-red-800\' }}">
                                    {{ $blanda->estado === \'activo\' ? \'Activa\' : \'Inactiva\' }}' => 'status === \'active\' ? \'bg-green-100 text-green-800\' : \'bg-red-100 text-red-800\' }}">
                                    {{ $soft->state === \'active\' ? \'Active\' : \'Inactive\' }}',
  'id_habilidad_blanda }}, {!! Js::from($blanda->nombre) !!}, {!! Js::from($blanda->descripcion ?? \'\') !!})"
                                        class="p-2 rounded-lg bg-blue-100 text-blue-600" title="Editar">' => 'soft_skill_id }}, {!! Js::from($soft->name) !!}, {!! Js::from($soft->description ?? \'\') !!})"
                                        class="p-2 rounded-lg bg-blue-100 text-blue-600" title="Edit">',
  'id_habilidad_blanda) }}" method="POST">
                                        @csrf' => 'soft_skill_id) }}" method="POST">
                                        @csrf',
  'estado === \'activo\' ? \'bg-orange-100 text-orange-600\' : \'bg-green-100 text-green-600\' }}">' => 'estado === \'activo\' ? \'bg-orange-100 text-orange-600\' : \'bg-green-100 text-green-600\' }}">',
  'estado === \'activo\' ? \'fa-ban\' : \'fa-check\' }}">' => 'status === \'active\' ? \'fa-ban\' : \'fa-check\' }}">',
  'id_habilidad_blanda) }}" method="POST" data-confirm="¿Eliminar la habilidad blanda «{{ $blanda->nombre }}»?">
                                        @csrf
                                        @method(\'DELETE\')' => 'soft_skill_id) }}" method="POST" data-confirm="Delete the soft skill «{{ $soft->name }}»?">
                                        @csrf
                                        @method(\'DELETE\')',
  'No hay habilidades blandas registradas' => 'No soft skills recorded',
  'function activarTab(target) {
        document.querySelectorAll(\'.tab-btn\').forEach(b => {
            const activo = b.dataset.tab === target;
            b.classList.toggle(\'border-[#1e3a5f]\', activo);
            b.classList.toggle(\'text-[#1e3a5f]\', activo);
            b.classList.toggle(\'border-transparent\', !activo);
            b.classList.toggle(\'text-gray-500\', !activo);
            b.classList.toggle(\'hover:text-gray-700\', !activo);
        });
        document.querySelectorAll(\'[data-tab-panel]\').forEach(p => {
            p.classList.toggle(\'hidden\', p.dataset.tabPanel !== target);
        });
    }

    document.querySelectorAll(\'.tab-btn\').forEach(btn => {
        btn.addEventListener(\'click\', () => activarTab(btn.dataset.tab));
    });

    @if(session(\'active_tab\'))
        activarTab(@json(session(\'active_tab\')));
    @endif

    function actualizarPreviewCategoria(url) {
        const preview = document.getElementById(\'categoria_imagen_preview\');
        if (url && url.trim()) {
            preview.src = url.trim();
            preview.classList.remove(\'hidden\');
            preview.onerror = () => preview.classList.add(\'hidden\');
        } else {
            preview.classList.add(\'hidden\');
            preview.src = \'\';
        }
    }

    document.getElementById(\'categoria_imagen\')?.addEventListener(\'input\', (e) => {
        actualizarPreviewCategoria(e.target.value);
    });

    function abrirModalEditarCategoria(id, nombre, imagen) {
        const form = document.getElementById(\'formEditarCategoria\');
        form.action = "{{ url(\'admin/categorias\') }}/" + id;
        document.getElementById(\'categoria_nombre\').value = nombre;
        document.getElementById(\'categoria_imagen\').value = imagen || \'\';
        actualizarPreviewCategoria(imagen || \'\');
        const modal = document.getElementById(\'modalEditarCategoria\');
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
    }

    function cerrarModalEditarCategoria() {
        const modal = document.getElementById(\'modalEditarCategoria\');
        modal.classList.add(\'hidden\');
        modal.classList.remove(\'flex\');
    }

    function abrirModalEditarBlanda(id, nombre, descripcion) {
        const form = document.getElementById(\'formEditarBlanda\');
        form.action = "{{ url(\'admin/habilidades-blandas\') }}/" + id;
        document.getElementById(\'blanda_nombre\').value = nombre;
        document.getElementById(\'blanda_descripcion\').value = descripcion;
        const modal = document.getElementById(\'modalEditarBlanda\');
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        activarTab(\'blandas\');
    }

    function cerrarModalEditarBlanda() {
        const modal = document.getElementById(\'modalEditarBlanda\');
        modal.classList.add(\'hidden\');
        modal.classList.remove(\'flex\');
    }' => 'function activarTab(target) {
        document.querySelectorAll(\'.tab-btn\').forEach(b => {
            const activo = b.dataset.tab === target;
            b.classList.toggle(\'border-[#1e3a5f]\', activo);
            b.classList.toggle(\'text-[#1e3a5f]\', activo);
            b.classList.toggle(\'border-transparent\', !activo);
            b.classList.toggle(\'text-gray-500\', !activo);
            b.classList.toggle(\'hover:text-gray-700\', !activo);
        });
        document.querySelectorAll(\'[data-tab-panel]\').forEach(p => {
            p.classList.toggle(\'hidden\', p.dataset.tabPanel !== target);
        });
    }

    document.querySelectorAll(\'.tab-btn\').forEach(btn => {
        btn.addEventListener(\'click\', () => activarTab(btn.dataset.tab));
    });

    @if(session(\'active_tab\'))
        activarTab(@json(session(\'active_tab\')));
    @endif

    function actualizarPreviewCategoria(url) {
        const preview = document.getElementById(\'categoria_imagen_preview\');
        if (url && url.trim()) {
            preview.src = url.trim();
            preview.classList.remove(\'hidden\');
            preview.onerror = () => preview.classList.add(\'hidden\');
        } else {
            preview.classList.add(\'hidden\');
            preview.src = \'\';
        }
    }

    document.getElementById(\'categoria_imagen\')?.addEventListener(\'input\', (e) => {
        actualizarPreviewCategoria(e.target.value);
    });

    function abrirModalEditarCategoria(id, nombre, imagen) {
        const form = document.getElementById(\'formEditarCategoria\');
        form.action = "{{ url(\'admin/categorias\') }}/" + id;
        document.getElementById(\'categoria_nombre\').value = nombre;
        document.getElementById(\'categoria_imagen\').value = imagen || \'\';
        actualizarPreviewCategoria(imagen || \'\');
        const modal = document.getElementById(\'modalEditarCategoria\');
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
    }

    function cerrarModalEditarCategoria() {
        const modal = document.getElementById(\'modalEditarCategoria\');
        modal.classList.add(\'hidden\');
        modal.classList.remove(\'flex\');
    }

    function abrirModalEditarBlanda(id, nombre, descripcion) {
        const form = document.getElementById(\'formEditarBlanda\');
        form.action = "{{ url(\'admin/habilidades-blandas\') }}/" + id;
        document.getElementById(\'blanda_nombre\').value = nombre;
        document.getElementById(\'blanda_descripcion\').value = descripcion;
        const modal = document.getElementById(\'modalEditarBlanda\');
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        activarTab(\'blandas\');
    }

    function cerrarModalEditarBlanda() {
        const modal = document.getElementById(\'modalEditarBlanda\');
        modal.classList.add(\'hidden\');
        modal.classList.remove(\'flex\');
    }',
  'Ocultar habilidad' => 'Hide skill',
  'Vas a ocultar la habilidad' => 'You are going to hide the ability',
  '.
                        Indica el motivo (será visible para el dueño de la habilidad en su panel).' => '.
                        Indicate the reason (it will be visible to the skill owner in their dashboard).',
  'Motivo' => 'Reason',
  'Confirmar ocultar' => 'Confirm hide',
  'const __modalOcultarHab = document.getElementById(\'modalOcultarHabilidad\');
    const __formOcultarHab  = document.getElementById(\'formOcultarHabilidad\');
    const __motivoHabInput  = document.getElementById(\'modalOcultarHabilidadMotivo\');
    const __motivoHabError  = document.getElementById(\'modalOcultarHabilidadError\');

    function abrirModalOcultarHabilidad(idHab, nombre) {
        __formOcultarHab.action = `/admin/habilidades/${idHab}/toggle`;
        document.getElementById(\'modalOcultarHabilidadNombre\').textContent = nombre || \'\';
        __motivoHabInput.value = \'\';
        __motivoHabError.classList.add(\'hidden\');
        __motivoHabError.textContent = \'\';
        __modalOcultarHab.classList.remove(\'hidden\');
        document.body.style.overflow = \'hidden\';
        setTimeout(() => __motivoHabInput.focus(), 50);
    }

    function cerrarModalOcultarHabilidad() {
        __modalOcultarHab.classList.add(\'hidden\');
        document.body.style.overflow = \'\';
    }

    function cerrarModalOcultarHabilidadFondo(event) {
        if (event.target === __modalOcultarHab) cerrarModalOcultarHabilidad();
    }

    __formOcultarHab.addEventListener(\'submit\', function (e) {
        if (!__motivoHabInput.value.trim()) {
            e.preventDefault();
            __motivoHabError.textContent = \'Debes indicar el motivo para ocultar la habilidad.\';
            __motivoHabError.classList.remove(\'hidden\');
            __motivoHabInput.focus();
        }
    });

    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\' && !__modalOcultarHab.classList.contains(\'hidden\')) {
            cerrarModalOcultarHabilidad();
        }
    });' => 'const __modalOcultarHab = document.getElementById(\'modalOcultarHabilidad\');
    const __formOcultarHab  = document.getElementById(\'formOcultarHabilidad\');
    const __motivoHabInput  = document.getElementById(\'modalOcultarHabilidadMotivo\');
    const __motivoHabError  = document.getElementById(\'modalOcultarHabilidadError\');

    function abrirModalOcultarHabilidad(idHab, nombre) {
        __formOcultarHab.action = `/admin/habilidades/${idHab}/toggle`;
        document.getElementById(\'modalOcultarHabilidadNombre\').textContent = nombre || \'\';
        __motivoHabInput.value = \'\';
        __motivoHabError.classList.add(\'hidden\');
        __motivoHabError.textContent = \'\';
        __modalOcultarHab.classList.remove(\'hidden\');
        document.body.style.overflow = \'hidden\';
        setTimeout(() => __motivoHabInput.focus(), 50);
    }

    function cerrarModalOcultarHabilidad() {
        __modalOcultarHab.classList.add(\'hidden\');
        document.body.style.overflow = \'\';
    }

    function cerrarModalOcultarHabilidadFondo(event) {
        if (event.target === __modalOcultarHab) cerrarModalOcultarHabilidad();
    }

    __formOcultarHab.addEventListener(\'submit\', function (e) {
        if (!__motivoHabInput.value.trim()) {
            e.preventDefault();
            __motivoHabError.textContent = \'Debes indicar el motivo para ocultar la habilidad.\';
            __motivoHabError.classList.remove(\'hidden\');
            __motivoHabInput.focus();
        }
    });

    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\' && !__modalOcultarHab.classList.contains(\'hidden\')) {
            cerrarModalOcultarHabilidad();
        }
    });',
  'Descripción (opcional)' => 'Description (optional)',
  'Ej. Nombre poco profesional, duplicado, no corresponde a la categoría...' => 'Eg. Unprofessional name, duplicate, does not correspond to the category...',
  'Volver a habilidades' => 'Back to skills',
  'Registrada por {{ $habilidad->perfil?->usuario?->nombre_completo ?? \'Sin usuario\' }}
                el {{ $habilidad->created_at->format(\'d/m/Y H:i\') }}' => 'Registered by {{ $skill->profile?->user?->full_name ?? \'No user\' }}
                the {{ $skill->created_at->format(\'d/m/Y H:i\') }}',
  'Categoría' => 'Category',
  'categoria->imagen }}" alt="{{ $habilidad->categoria->nombre }}"
                                 class="h-6 w-6 rounded-full object-cover border border-gray-200 mr-2"
                                 onerror="this.onerror=null;this.style.display=\'none\';">
                        @else' => 'categoria->imagen }}" alt="{{ $habilidad->categoria->nombre }}"
                                 class="h-6 w-6 rounded-full object-cover border border-gray-200 mr-2"
                                 onerror="this.onerror=null;this.style.display=\'none\';">
                        @else',
  'Información' => 'Information',
  'Estado:' => 'State:',
  'Años experiencia:' => 'Years of experience:',
  'Usuario:' => 'User:',
  'Email:' => 'Email:',
  'Creada:' => 'Created:',
  'Bitácora de Actividades' => 'Activity Log',
  'Registro de acciones realizadas por administradores' => 'Record of actions carried out by administrators',
  'Exportar CSV' => 'Export CSV',
  'ADMIN' => 'ADMIN',
  'ACCIÓN' => 'ACTION',
  'DETALLES' => 'DETAILS',
  'FECHA' => 'DATE',
  '#{{ $log->id_log }}' => '#{{ $log->id_log }}',
  'No hay registros en la bitácora' => 'There are no records in the log',
  'Buscar acción...' => 'Search action...',
  'Moderación de Perfiles' => 'Profile Moderation',
  'Revisa y modera los perfiles de los usuarios' => 'Review and moderate user profiles',
  'Todos' => 'All',
  'Visibles' => 'Visible',
  'Ocultos' => 'Hidden',
  'Usuario' => 'User',
  'Ubicación' => 'Location',
  'Estado' => 'State',
  'Nota' => 'Use',
  'foto_perfil }}" alt="" class="h-10 w-10 rounded-full object-cover">
                            @else' => 'foto_perfil }}" alt="" class="h-10 w-10 rounded-full object-cover">
                            @else',
  'Visible' => 'Visible',
  'Oculto' => 'Hidden',
  'id_perfil }})"
                                class="text-blue-600 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg">Ver' => 'id_perfil }})"
                                class="text-blue-600 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg">Ver',
  'id_perfil }}, {!! Js::from(trim($perfil->usuario->nombre . \' \' . $perfil->usuario->apellido)) !!})"
                                    class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                    Ocultar' => 'profile_id }}, {!! Js::from(trim($profile->user->name . \' \' . $profile->user->last name)) !!})"
                                    class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                    Hide',
  'id_perfil) }}" method="POST">
                                    @csrf' => 'id_perfil) }}" method="POST">
                                    @csrf',
  'No hay perfiles para moderar' => 'There are no profiles to moderate',
  'async function abrirVistaPortafolio(idPerfil) {
        try {
            const resp = await fetch(`/admin/moderacion/perfiles/${idPerfil}/portafolio-json`, {
                headers: {
                    \'X-Requested-With\': \'XMLHttpRequest\',
                    \'Accept\': \'application/json\'
                }
            });
            if (!resp.ok) throw new Error(\'No se pudo cargar el portafolio\');
            const data = await resp.json();
            if (data.ok && typeof window.abrirModalPortafolio === \'function\') {
                window.abrirModalPortafolio({ data: data.portafolio });
            }
        } catch (err) {
            alert(\'No se pudo abrir la vista del portafolio: \' + err.message);
        }
    }' => 'async function openVistaPortafolio(profileId) {
        try {
            const resp = await fetch(`/admin/moderacion/perfiles/${profileid}/portafolio-json`, {
                headers: {
                    \'X-Requested-With\': \'XMLHttpRequest\',
                    \'Accept\': \'application/json\'
                }
            });
            if (! resp.ok) throw new Error(\'Can\'t load the portfolio\');
            const data = await resp.json();
            if (data.ok && typeof window.abrirModalPortafolio === \'function\') {
                window.openModalPortafolio({ data: data.portafolio });
            }
        } catch (err) {
            alert(\'I couldn\'t open the portfolio view: \' + err.message);
        }
    }',
  'Ocultar portafolio' => 'Hide portfolio',
  'Vas a ocultar el portafolio de' => 'You are going to hide the portfolio',
  '.
                        Indica el motivo (se guardará como nota de moderación y será visible para el equipo administrador).' => '.
                        Please indicate the reason (it will be saved as a moderation note and visible to the admin team).',
  'const __modalOcultar = document.getElementById(\'modalOcultar\');
    const __formOcultar  = document.getElementById(\'formOcultar\');
    const __motivoInput  = document.getElementById(\'modalOcultarMotivo\');
    const __motivoError  = document.getElementById(\'modalOcultarError\');

    function abrirModalOcultar(idPerfil, nombre) {
        __formOcultar.action = `/admin/moderacion/perfiles/${idPerfil}/toggle-visibilidad`;
        document.getElementById(\'modalOcultarUsuario\').textContent = nombre || \'\';
        __motivoInput.value = \'\';
        __motivoError.classList.add(\'hidden\');
        __motivoError.textContent = \'\';
        __modalOcultar.classList.remove(\'hidden\');
        document.body.style.overflow = \'hidden\';
        setTimeout(() => __motivoInput.focus(), 50);
    }

    function cerrarModalOcultar() {
        __modalOcultar.classList.add(\'hidden\');
        document.body.style.overflow = \'\';
    }

    function cerrarModalOcultarFondo(event) {
        if (event.target === __modalOcultar) cerrarModalOcultar();
    }

    __formOcultar.addEventListener(\'submit\', function (e) {
        if (!__motivoInput.value.trim()) {
            e.preventDefault();
            __motivoError.textContent = \'Debes indicar el motivo para ocultar el portafolio.\';
            __motivoError.classList.remove(\'hidden\');
            __motivoInput.focus();
        }
    });

    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\' && !__modalOcultar.classList.contains(\'hidden\')) {
            cerrarModalOcultar();
        }
    });' => 'const __modalHidden = document.getElementById(\'modalHidden\');
    const __formHidden = document.getElementById(\'formHidden\');
    const __motivoInput = document.getElementById(\'modalHideMotivo\');
    const __motivoError = document.getElementById(\'modalHiddenError\');

    function openHiddenModal(ProfileId, name) {
        __formHide.action = `/admin/moderation/profiles/${ProfileID}/toggle-visibility`;
        document.getElementById(\'modalHideUser\').textContent = name || \'\';
        __motivoInput.value = \'\';
        __motivoError.classList.add(\'hidden\');
        __reasonError.textContent = \'\';
        __modalHidden.classList.remove(\'hidden\');
        document.body.style.overflow = \'hidden\';
        setTimeout(() => __motivoInput.focus(), 50);
    }

    function closeModalHide() {
        __modalHidden.classList.add(\'hidden\');
        document.body.style.overflow = \'\';
    }

    function closeModalHideBackground(event) {
        if (event.target === __modalHide) closeModalHide();
    }

    __formHidden.addEventListener(\'submit\', function (e) {
        if (!__motivoInput.value.trim()) {
            e.preventDefault();
            __reasonError.textContent = \'You must specify the reason for hiding the wallet.\';
            __motivoError.classList.remove(\'hidden\');
            __motifInput.focus();
        }
    });

    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\' && !__modalHidden.classList.contains(\'hidden\')) {
            closeHideModal();
        }
    });',
  'Buscar usuario...' => 'Search user...',
  'Ej. Contenido inapropiado, datos personales expuestos, denuncia recibida...' => 'Eg. Inappropriate content, exposed personal data, complaint received...',
  'Portafolio publicado — {{ $perfil->usuario->nombre }} {{ $perfil->usuario->apellido }}' => 'Published portfolio — {{ $profile->user->first name }} {{ $profile->user->last name }}',
  'Vista del portafolio tal como lo ven los visitantes públicos.' => 'View of the portfolio as seen by public visitors.',
  'Volver al listado' => 'Return to list',
  'Visible (admin)' => 'Visible (admin)',
  'Oculto (admin)' => 'Hidden (admin)',
  'Perfil público' => 'Public profile',
  'Perfil privado' => 'Private profile',
  'id_perfil }}, {!! Js::from(trim($perfil->usuario->nombre . \' \' . $perfil->usuario->apellido)) !!})"
                    class="ml-auto text-orange-700 bg-orange-100 hover:bg-orange-200 px-3 py-2 rounded-lg text-sm">' => 'profile_id }}, {!! Js::from(trim($profile->user->name . \' \' . $profile->user->last name)) !!})"
                    class="ml-auto text-orange-700 bg-orange-100 hover:bg-orange-200 px-3 py-2 rounded-lg text-sm">',
  'id_perfil) }}" method="POST" class="ml-auto">
                    @csrf' => 'id_perfil) }}" method="POST" class="ml-auto">
                    @csrf',
  'Mostrar portafolio' => 'Show portfolio',
  'Reabrir vista pública' => 'Reopen public view',
  'Nota de moderación' => 'Moderation note',
  'id_perfil) }}" method="POST" class="p-6 space-y-2">
            @csrf' => 'id_perfil) }}" method="POST" class="p-6 space-y-2">
            @csrf',
  'Guardar nota' => 'Save note',
  '.
                        Indica el motivo (se guardará como nota de moderación).' => '.
                        Please indicate the reason (it will be saved as a moderation note).',
  'window.__portafolioAdmin = @json($portafolio);
    document.addEventListener(\'DOMContentLoaded\', function () {
        if (typeof window.abrirModalPortafolio === \'function\') {
            window.abrirModalPortafolio({ data: window.__portafolioAdmin });
        }
    });

    @if($perfil->visible)
    const __modalOcultar = document.getElementById(\'modalOcultar\');
    const __formOcultar  = document.getElementById(\'formOcultar\');
    const __motivoInput  = document.getElementById(\'modalOcultarMotivo\');
    const __motivoError  = document.getElementById(\'modalOcultarError\');

    function abrirModalOcultar(idPerfil, nombre) {
        __formOcultar.action = `/admin/moderacion/perfiles/${idPerfil}/toggle-visibilidad`;
        document.getElementById(\'modalOcultarUsuario\').textContent = nombre || \'\';
        __motivoInput.value = \'\';
        __motivoError.classList.add(\'hidden\');
        __motivoError.textContent = \'\';
        __modalOcultar.classList.remove(\'hidden\');
        document.body.style.overflow = \'hidden\';
        setTimeout(() => __motivoInput.focus(), 50);
    }

    function cerrarModalOcultar() {
        __modalOcultar.classList.add(\'hidden\');
        document.body.style.overflow = \'\';
    }

    function cerrarModalOcultarFondo(event) {
        if (event.target === __modalOcultar) cerrarModalOcultar();
    }

    __formOcultar.addEventListener(\'submit\', function (e) {
        if (!__motivoInput.value.trim()) {
            e.preventDefault();
            __motivoError.textContent = \'Debes indicar el motivo para ocultar el portafolio.\';
            __motivoError.classList.remove(\'hidden\');
            __motivoInput.focus();
        }
    });

    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\' && !__modalOcultar.classList.contains(\'hidden\')) {
            cerrarModalOcultar();
        }
    });
    @endif' => 'window.__portfolioAdmin = @json($portfolio);
    document.addEventListener(\'DOMContentLoaded\', function () {
        if (typeof window.openModalPortfolio === \'function\') {
            window.openPortfolioModal({ data: window.__portfolioAdmin });
        }
    });

    @if($profile->visible)
    const __modalHidden = document.getElementById(\'modalHidden\');
    const __formHidden = document.getElementById(\'formHidden\');
    const __motivoInput = document.getElementById(\'modalHideMotivo\');
    const __motivoError = document.getElementById(\'modalHiddenError\');

    function openHiddenModal(ProfileId, name) {
        __formHide.action = `/admin/moderation/profiles/${ProfileID}/toggle-visibility`;
        document.getElementById(\'modalHideUser\').textContent = name || \'\';
        __motivoInput.value = \'\';
        __motivoError.classList.add(\'hidden\');
        __reasonError.textContent = \'\';
        __modalHidden.classList.remove(\'hidden\');
        document.body.style.overflow = \'hidden\';
        setTimeout(() => __motivoInput.focus(), 50);
    }

    function closeModalHide() {
        __modalHidden.classList.add(\'hidden\');
        document.body.style.overflow = \'\';
    }

    function closeModalHideBackground(event) {
        if (event.target === __modalHide) closeModalHide();
    }

    __formHidden.addEventListener(\'submit\', function (e) {
        if (!__motivoInput.value.trim()) {
            e.preventDefault();
            __reasonError.textContent = \'You must specify the reason for hiding the wallet.\';
            __motivoError.classList.remove(\'hidden\');
            __motifInput.focus();
        }
    });

    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\' && !__modalHidden.classList.contains(\'hidden\')) {
            closeHideModal();
        }
    });
    @endif',
  'Anota el motivo de la decisión de moderación...' => 'Write down the reason for the moderation decision...',
  'Volver a notificaciones' => 'Back to notifications',
  'Nueva Notificación' => 'New Notification',
  'Envía notificaciones a los usuarios del sistema' => 'Send notifications to system users',
  'Tipo de notificación *' => 'Notification type *',
  'ℹ️ Información' => 'ℹ️ Information',
  '✅ Éxito' => '✅ Success',
  '⚠️ Advertencia' => '⚠️ Warning',
  '❌ Error' => '❌ Error',
  'Destinatario *' => 'Recipient *',
  'Todos los usuarios' => 'All users',
  'Usuario específico' => 'Specific user',
  'Seleccionar usuario *' => 'Select user *',
  '-- Seleccionar --' => '-- Select --',
  'id_usuario }}">{{ $usuario->nombre }} {{ $usuario->apellido }} ({{ $usuario->correo_electronico }})' => 'user_id }}">{{ $user->name }} {{ $user->last_name }} ({{ $user->email }})',
  'Título *' => 'Title *',
  'Mensaje *' => 'Message *',
  'URL (opcional)' => 'URL (optional)',
  'Link al que irá el usuario al hacer clic en la notificación' => 'Link that the user will go to when clicking on the notification',
  'Enviar Notificación' => 'Send Notification',
  'document.querySelectorAll(\'input[name="destinatario"]\').forEach(radio => {
        radio.addEventListener(\'change\', function() {
            const selectDiv = document.getElementById(\'selectUsuario\');
            if (this.value === \'individual\') {
                selectDiv.classList.remove(\'hidden\');
            } else {
                selectDiv.classList.add(\'hidden\');
            }
        });
    });' => 'document.querySelectorAll(\'input[name="destinatario"]\').forEach(radio => {
        radio.addEventListener(\'change\', function() {
            const selectDiv = document.getElementById(\'selectUsuario\');
            if (this.value === \'individual\') {
                selectDiv.classList.remove(\'hidden\');
            } else {
                selectDiv.classList.add(\'hidden\');
            }
        });
    });',
  'Ej: Nuevo proyecto destacado' => 'Ex: Featured new project',
  'Escribe el contenido de la notificación...' => 'Write the content of the notification...',
  'https://ejemplo.com/algo' => 'https://ejemplo.com/algo',
  'Gestiona las notificaciones del sistema' => 'Manage system notifications',
  'Limpiar Antiguas' => 'Clean Old',
  'Total' => 'Total',
  'Leídas' => 'Read',
  'No leídas' => 'Not read',
  'Alertas' => 'Alerts',
  'Todos los tipos' => 'All types',
  'TIPO' => 'TYPE',
  'TÍTULO' => 'TITLE',
  'leido ? \'bg-yellow-50\' : \'\' }}">' => 'leido ? \'bg-yellow-50\' : \'\' }}">',
  'ℹ️ Info' => 'ℹ️ Info',
  '⚠️ Alerta' => '⚠️ Alert',
  'Leída' => 'Read',
  'No leída' => 'Not read',
  'id_notification) }}" class="text-blue-600 bg-blue-100 p-2 rounded-lg hover:bg-blue-200 transition-colors">' => 'id_notification) }}" class="text-blue-600 bg-blue-100 p-2 rounded-lg hover:bg-blue-200 transition-colors">',
  'id_notification) }}" method="POST" onsubmit="return confirm(\'¿Eliminar esta notificación?\')">
                                    @csrf
                                    @method(\'DELETE\')' => 'id_notification) }}" method="POST" onsubmit="return confirm(\'Delete this notification?\')">
                                    @csrf
                                    @method(\'DELETE\')',
  'No hay notificaciones registradas' => 'No notifications registered',
  'Buscar usuario *' => 'Search user *',
  '(Escribe nombre, apellido o email)' => '(Write name, surname or email)',
  '// Abrir modal
    function abrirModalNotificacion() {
        const modal = document.getElementById(\'modalNotificacion\');
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        
        // Resetear formulario
        const form = document.getElementById(\'formNotificacion\');
        form.reset();
        
        // Resetear campos específicos
        document.getElementById(\'modalSelectUsuario\').classList.add(\'hidden\');
        document.getElementById(\'modalParaTodos\').checked = true;
        
        // Limpiar errores visuales si los hay
        const inputs = form.querySelectorAll(\'input, select, textarea\');
        inputs.forEach(input => {
            input.classList.remove(\'border-red-500\');
        });
    }
    
    // Cerrar modal
    function cerrarModalNotificacion() {
        const modal = document.getElementById(\'modalNotificacion\');
        modal.classList.add(\'hidden\');
        modal.classList.remove(\'flex\');
    }
    
    // Mostrar/ocultar selector de usuario
    document.addEventListener(\'DOMContentLoaded\', function() {
        const radioButtons = document.querySelectorAll(\'input[name="destinatario"]\');
        radioButtons.forEach(radio => {
            radio.addEventListener(\'change\', function() {
                const selectDiv = document.getElementById(\'modalSelectUsuario\');
                if (this.value === \'individual\') {
                    selectDiv.classList.remove(\'hidden\');
                } else {
                    selectDiv.classList.add(\'hidden\');
                }
            });
        });
    });
    
    // Envío del formulario con AJAX
    const formNotificacion = document.getElementById(\'formNotificacion\');
    
    if (formNotificacion) {
        formNotificacion.addEventListener(\'submit\', async function(e) {
            e.preventDefault();
            
            // Mostrar loading en el botón
            const submitBtn = this.querySelector(\'button[type="submit"]\');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = \'' => '// Abrir modal
    function abrirModalNotificacion() {
        const modal = document.getElementById(\'modalNotificacion\');
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        
        // Resetear formulario
        const form = document.getElementById(\'formNotificacion\');
        form.reset();
        
        // Resetear campos específicos
        document.getElementById(\'modalSelectUsuario\').classList.add(\'hidden\');
        document.getElementById(\'modalParaTodos\').checked = true;
        
        // Limpiar errores visuales si los hay
        const inputs = form.querySelectorAll(\'input, select, textarea\');
        inputs.forEach(input => {
            input.classList.remove(\'border-red-500\');
        });
    }
    
    // Cerrar modal
    function cerrarModalNotificacion() {
        const modal = document.getElementById(\'modalNotificacion\');
        modal.classList.add(\'hidden\');
        modal.classList.remove(\'flex\');
    }
    
    // Mostrar/ocultar selector de usuario
    document.addEventListener(\'DOMContentLoaded\', function() {
        const radioButtons = document.querySelectorAll(\'input[name="destinatario"]\');
        radioButtons.forEach(radio => {
            radio.addEventListener(\'change\', function() {
                const selectDiv = document.getElementById(\'modalSelectUsuario\');
                if (this.value === \'individual\') {
                    selectDiv.classList.remove(\'hidden\');
                } else {
                    selectDiv.classList.add(\'hidden\');
                }
            });
        });
    });
    
    // Envío del formulario con AJAX
    const formNotificacion = document.getElementById(\'formNotificacion\');
    
    if (formNotificacion) {
        formNotificacion.addEventListener(\'submit\', async function(e) {
            e.preventDefault();
            
            // Mostrar loading en el botón
            const submitBtn = this.querySelector(\'button[type="submit"]\');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = \'',
  'Enviando...\';
            submitBtn.disabled = true;
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch(this.action, {
                    method: \'POST\',
                    body: formData,
                    headers: {
                        \'X-Requested-With\': \'XMLHttpRequest\',
                        \'Accept\': \'application/json\'
                    }
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    // Éxito
                    await Swal.fire({
                        icon: \'success\',
                        title: \'¡Notificación enviada!\',
                        text: data.message || \'La notificación se ha enviado correctamente\',
                        confirmButtonColor: \'#1e3a5f\',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    cerrarModalNotificacion();
                    location.reload();
                } else {
                    // Error de validación o del servidor
                    let errorMsg = \'\';
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat();
                        errorMsg = errorList.join(\'\\n\');
                    } else {
                        errorMsg = data.message || \'Error al enviar la notificación\';
                    }
                    
                    await Swal.fire({
                        icon: \'error\',
                        title: \'Error\',
                        text: errorMsg,
                        confirmButtonColor: \'#d33\'
                    });
                    
                    // Restaurar botón
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error(\'Error:\', error);
                await Swal.fire({
                    icon: \'error\',
                    title: \'Error de conexión\',
                    text: \'No se pudo conectar con el servidor. Verifica tu conexión.\',
                    confirmButtonColor: \'#d33\'
                });
                
                // Restaurar botón
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }
    
    // Cerrar modal con ESC
    document.addEventListener(\'keydown\', function(event) {
        if (event.key === \'Escape\') {
            const modal = document.getElementById(\'modalNotificacion\');
            if (modal && !modal.classList.contains(\'hidden\')) {
                cerrarModalNotificacion();
            }
        }
    });
    
    // Cerrar modal al hacer clic fuera
    const modal = document.getElementById(\'modalNotificacion\');
    if (modal) {
        modal.addEventListener(\'click\', function(e) {
            if (e.target === this) {
                cerrarModalNotificacion();
            }
        });
    }
    // Variables para el buscador
let todosUsuarios = [];

// Cargar todos los usuarios al abrir el modal
function cargarListaUsuarios() {
    fetch(\'/admin/usuarios/listado-simple\')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                todosUsuarios = data.usuarios;
            }
        })
        .catch(error => console.error(\'Error:\', error));
}

// Buscar usuarios en tiempo real
function buscarUsuariosNotificacion() {
    const searchTerm = document.getElementById(\'buscadorUsuarioNotificacion\').value.toLowerCase();
    const resultadosDiv = document.getElementById(\'resultadosUsuariosNotificacion\');
    
    if (searchTerm.length' => 'Enviando...\';
            submitBtn.disabled = true;
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch(this.action, {
                    method: \'POST\',
                    body: formData,
                    headers: {
                        \'X-Requested-With\': \'XMLHttpRequest\',
                        \'Accept\': \'application/json\'
                    }
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    // Éxito
                    await Swal.fire({
                        icon: \'success\',
                        title: \'¡Notificación enviada!\',
                        text: data.message || \'La notificación se ha enviado correctamente\',
                        confirmButtonColor: \'#1e3a5f\',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    cerrarModalNotificacion();
                    location.reload();
                } else {
                    // Error de validación o del servidor
                    let errorMsg = \'\';
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat();
                        errorMsg = errorList.join(\'\\n\');
                    } else {
                        errorMsg = data.message || \'Error al enviar la notificación\';
                    }
                    
                    await Swal.fire({
                        icon: \'error\',
                        title: \'Error\',
                        text: errorMsg,
                        confirmButtonColor: \'#d33\'
                    });
                    
                    // Restaurar botón
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error(\'Error:\', error);
                await Swal.fire({
                    icon: \'error\',
                    title: \'Error de conexión\',
                    text: \'No se pudo conectar con el servidor. Verifica tu conexión.\',
                    confirmButtonColor: \'#d33\'
                });
                
                // Restaurar botón
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }
    
    // Cerrar modal con ESC
    document.addEventListener(\'keydown\', function(event) {
        if (event.key === \'Escape\') {
            const modal = document.getElementById(\'modalNotificacion\');
            if (modal && !modal.classList.contains(\'hidden\')) {
                cerrarModalNotificacion();
            }
        }
    });
    
    // Cerrar modal al hacer clic fuera
    const modal = document.getElementById(\'modalNotificacion\');
    if (modal) {
        modal.addEventListener(\'click\', function(e) {
            if (e.target === this) {
                cerrarModalNotificacion();
            }
        });
    }
    // Variables para el buscador
let todosUsuarios = [];

// Cargar todos los usuarios al abrir el modal
function cargarListaUsuarios() {
    fetch(\'/admin/usuarios/listado-simple\')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                todosUsuarios = data.usuarios;
            }
        })
        .catch(error => console.error(\'Error:\', error));
}

// Buscar usuarios en tiempo real
function buscarUsuariosNotificacion() {
    const searchTerm = document.getElementById(\'buscadorUsuarioNotificacion\').value.toLowerCase();
    const resultadosDiv = document.getElementById(\'resultadosUsuariosNotificacion\');
    
    if (searchTerm.length',
  '{
        const nombreCompleto = `${user.nombre} ${user.apellido}`.toLowerCase();
        const email = user.correo_electronico.toLowerCase();
        return nombreCompleto.includes(searchTerm) || email.includes(searchTerm);
    });
    
    if (filtrados.length === 0) {
        resultadosDiv.innerHTML = `' => '{
        const fullName = `${user.firstname} ${user.lastname}`.toLowerCase();
        const email = user.email.toLowerCase();
        return fullName.includes(searchTerm) || email.includes(searchTerm);
    });
    
    if (filtered.length === 0) {
        resultsDiv.innerHTML = `',
  'No se encontraron usuarios' => 'No users found',
  '`;
        resultadosDiv.classList.remove(\'hidden\');
        return;
    }
    
    resultadosDiv.innerHTML = filtrados.map(user => `' => '`;
        resultsDiv.classList.remove(\'hidden\');
        return;
    }
    
    resultsDiv.innerHTML = filtered.map(user => `',
  '${user.nombre} ${user.apellido}' => '${user.firstname} ${user.lastname}',
  '${user.correo_electronico}' => '${user.email}',
  '`).join(\'\');
    
    resultadosDiv.classList.remove(\'hidden\');
}

// Seleccionar usuario
function seleccionarUsuarioNotificacion(id, nombre, apellido, email) {
    document.getElementById(\'usuarioIdSeleccionadoNotificacion\').value = id;
    document.getElementById(\'usuarioSeleccionadoNombre\').innerHTML = `' => '`).join(\'\');
    
    resultsDiv.classList.remove(\'hidden\');
}

// Select user
function selectNotificationUser(id, first name, last name, email) {
    document.getElementById(\'userIdSelectedNotification\').value = id;
    document.getElementById(\'selecteduserName\').innerHTML = `',
  '${nombre} ${apellido}`;
    document.getElementById(\'usuarioSeleccionadoEmail\').innerHTML = `' => '${firstname} ${lastname}`;
    document.getElementById(\'selecteduserEmail\').innerHTML = `',
  '${email}`;
    
    document.getElementById(\'resultadosUsuariosNotificacion\').classList.add(\'hidden\');
    document.getElementById(\'usuarioSeleccionadoNotificacion\').classList.remove(\'hidden\');
    document.getElementById(\'buscadorUsuarioNotificacion\').value = \'\';
}

// Limpiar selección
function limpiarSeleccionUsuarioNotificacion() {
    document.getElementById(\'usuarioIdSeleccionadoNotificacion\').value = \'\';
    document.getElementById(\'usuarioSeleccionadoNotificacion\').classList.add(\'hidden\');
    document.getElementById(\'buscadorUsuarioNotificacion\').value = \'\';
    document.getElementById(\'buscadorUsuarioNotificacion\').focus();
}

// Evento de búsqueda en tiempo real
document.getElementById(\'buscadorUsuarioNotificacion\')?.addEventListener(\'input\', function() {
    buscarUsuariosNotificacion();
});

// Modificar la función abrirModalNotificacion
const abrirModalOriginal = window.abrirModalNotificacion;
window.abrirModalNotificacion = function() {
    if (abrirModalOriginal) abrirModalOriginal();
    cargarListaUsuarios();
    limpiarSeleccionUsuarioNotificacion();
};

// Validar que se haya seleccionado un usuario antes de enviar
const formOriginal = document.getElementById(\'formNotificacion\');
if (formOriginal) {
    formOriginal.addEventListener(\'submit\', function(e) {
        const destinatario = document.querySelector(\'input[name="destinatario"]:checked\').value;
        if (destinatario === \'individual\') {
            const usuarioId = document.getElementById(\'usuarioIdSeleccionadoNotificacion\').value;
            if (!usuarioId) {
                e.preventDefault();
                Swal.fire({
                    icon: \'warning\',
                    title: \'Campo requerido\',
                    text: \'Por favor, busca y selecciona un usuario\',
                    confirmButtonColor: \'#1e3a5f\'
                });
            }
        }
    });
}' => '${email}`;
    
    document.getElementById(\'NotificationUserresults\').classList.add(\'hidden\');
    document.getElementById(\'userSelectedNotification\').classList.remove(\'hidden\');
    document.getElementById(\'notificationUsersearcher\').value = \'\';
}

// Clear selection
function clearNotificationUserSelection() {
    document.getElementById(\'userIdSelectedNotification\').value = \'\';
    document.getElementById(\'userSelectedNotification\').classList.add(\'hidden\');
    document.getElementById(\'notificationUsersearcher\').value = \'\';
    document.getElementById(\'notificationUsersearcher\').focus();
}

// Real-time search event
document.getElementById(\'notificationUsersearcher\')?.addEventListener(\'input\', function() {
    searchNotificationUsers();
});

// Modify the openModalNotification function
const openOriginalModal = window.openNotificationModal;
window.openModalNotification = function() {
    if (openOriginalModal) openOriginalModal();
    loadUserList();
    clearNotificationUserSelection();
};

// Validate that a user has been selected before submitting
const formOriginal = document.getElementById(\'formNotification\');
if (formOriginal) {
    formOriginal.addEventListener(\'submit\', function(e) {
        const recipient = document.querySelector(\'input[name="recipient"]:checked\').value;
        if (recipient === \'individual\') {
            const userId = document.getElementById(\'userIdSelectedNotification\').value;
            if (!userId) {
                e.preventDefault();
                Swal.fire({
                    icon: \'warning\',
                    title: \'Required field\',
                    text: \'Please search and select a user\',
                    confirmButtonColor: \'#1e3a5f\'
                });
            }
        }
    });
}',
  '🔍 Escribe para buscar usuario...' => '🔍 Write to search for user...',
  'Papelera' => 'Bin',
  'Elementos eliminados recientemente' => 'Recently deleted items',
  'Usuarios' => 'Users',
  'Proyectos' => 'Projects',
  'Habilidades técnicas' => 'Technical skills',
  'Experiencias' => 'Experiences',
  'Formación' => 'Training',
  '👥 Usuarios ({{ $totalUsuarios }})' => '👥 Users ({{ $totalUsers }})',
  '📁 Proyectos ({{ $totalProyectos }})' => '📁 Projects ({{ $totalProjects }})',
  '🧠 Habilidades ({{ $totalHabilidades }})' => '🧠 Skills ({{ $totalSkills }})',
  '💼 Experiencias ({{ $totalExperiencias }})' => '💼 Experiences ({{ $totalExperiences }})',
  '🎓 Formación ({{ $totalEducaciones }})' => '🎓 Training ({{ $totalEducations }})',
  'ELIMINADO POR' => 'DELETED BY',
  'MOTIVO' => 'REASON',
  'id_usuario) }}" method="POST">
                            @csrf' => 'user_id) }}" method="POST">
                            @csrf',
  'No hay usuarios en la papelera' => 'There are no users in the trash',
  'PROYECTO' => 'PROJECT',
  'AUTOR' => 'AUTHOR',
  'id_proyecto) }}" method="POST">
                            @csrf' => 'id_proyecto) }}" method="POST">
                            @csrf',
  'No hay proyectos en la papelera' => 'There are no projects in the trash',
  'id_habilidad) }}" method="POST">
                            @csrf' => 'skill_id) }}" method="POST">
                            @csrf',
  'No hay habilidades en la papelera' => 'There are no skills in the trash',
  'CARGO' => 'CARGO',
  'EMPRESA' => 'ENTERPRISE',
  'id_experiencia) }}" method="POST">
                            @csrf' => 'id_experiencia) }}" method="POST">
                            @csrf',
  'No hay experiencias en la papelera' => 'There are no experiences in the trash',
  'INSTITUCIÓN' => 'INSTITUTION',
  'id_formacion) }}" method="POST">
                            @csrf' => 'id_formacion) }}" method="POST">
                            @csrf',
  'No hay formación en la papelera' => 'There is no training in the trash',
  'const TABS = [\'usuarios\', \'proyectos\', \'habilidades\', \'experiencias\', \'educaciones\'];

    function mostrarTab(tab) {
        TABS.forEach(t => {
            const idCap = t.charAt(0).toUpperCase() + t.slice(1);
            const panel = document.getElementById(\'tab\' + idCap);
            const btn   = document.getElementById(\'tab\' + idCap + \'Btn\');
            if (!panel || !btn) return;

            if (t === tab) {
                panel.classList.remove(\'hidden\');
                btn.classList.add(\'border-b-2\', \'border-[#1e3a5f]\', \'text-[#1e3a5f]\');
                btn.classList.remove(\'text-gray-500\');
            } else {
                panel.classList.add(\'hidden\');
                btn.classList.remove(\'border-b-2\', \'border-[#1e3a5f]\', \'text-[#1e3a5f]\');
                btn.classList.add(\'text-gray-500\');
            }
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    const tabParam = urlParams.get(\'tab\');
    if (tabParam && TABS.includes(tabParam)) {
        mostrarTab(tabParam);
    }' => 'const TABS = [\'usuarios\', \'proyectos\', \'habilidades\', \'experiencias\', \'educaciones\'];

    function mostrarTab(tab) {
        TABS.forEach(t => {
            const idCap = t.charAt(0).toUpperCase() + t.slice(1);
            const panel = document.getElementById(\'tab\' + idCap);
            const btn   = document.getElementById(\'tab\' + idCap + \'Btn\');
            if (!panel || !btn) return;

            if (t === tab) {
                panel.classList.remove(\'hidden\');
                btn.classList.add(\'border-b-2\', \'border-[#1e3a5f]\', \'text-[#1e3a5f]\');
                btn.classList.remove(\'text-gray-500\');
            } else {
                panel.classList.add(\'hidden\');
                btn.classList.remove(\'border-b-2\', \'border-[#1e3a5f]\', \'text-[#1e3a5f]\');
                btn.classList.add(\'text-gray-500\');
            }
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    const tabParam = urlParams.get(\'tab\');
    if (tabParam && TABS.includes(tabParam)) {
        mostrarTab(tabParam);
    }',
  'Restaurar' => 'Restore',
  'Gestión de Proyectos' => 'Project management',
  'Modera y administra todos los proyectos del sistema' => 'Moderate and manage all system projects',
  'Total Proyectos' => 'Total Projects',
  'Públicos' => 'Audiences',
  'Privados' => 'Private',
  'Todos los estados' => 'All states',
  'Pendiente' => 'Earring',
  'En progreso' => 'In progress',
  'Completado' => 'Filled',
  'Cancelado' => 'Canceled',
  'VISIBILIDAD' => 'VISIBILITY',
  'estado == \'completado\') bg-green-100 text-green-700
                                @elseif($proyecto->estado == \'en_progreso\') bg-blue-100 text-blue-700
                                @elseif($proyecto->estado == \'pendiente\') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($proyecto->estado) }}' => 'status == \'completed\') bg-green-100 text-green-700
                                @elseif($project->status == \'in_progress\') bg-blue-100 text-blue-700
                                @elseif($project->status == \'pending\') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($project->state) }}',
  'Público' => 'Public',
  'id_proyecto }})" 
                                    class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition" 
                                    title="Ver proyecto">' => 'id_proyecto }})" 
                                    class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition" 
                                    title="Ver proyecto">',
  'id_proyecto }}, \'{{ addslashes($proyecto->nombre) }}\')"
                                        class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">' => 'project_id }}, \'{{ addslashes($project->name) }}\')"
                                        class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">',
  'id_proyecto) }}" method="POST" class="inline">
                                        @csrf' => 'id_proyecto) }}" method="POST" class="inline">
                                        @csrf',
  'No hay proyectos registrados' => 'There are no registered projects',
  'Ocultar proyecto' => 'Hide project',
  'Vas a ocultar el proyecto' => 'You are going to hide the project',
  '.
                    Indica el motivo (será visible para el dueño del proyecto en su panel).' => '.
                    Indicate the reason (it will be visible to the project owner in their dashboard).',
  '// ========================================
    // FUNCIONES PARA EL MODAL DE VER PROYECTO
    // ========================================
    
    // Esta función necesita que cargues el proyecto específico
    // Si ya tienes el proyecto en la variable $proyecto en el modal, usa esta versión:
    function abrirModalVerProyecto(proyectoId) {
        const modal = document.getElementById(\'modalVerProyecto\');
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'hidden\';
        
        // Si necesitas cargar los datos vía AJAX, descomenta esto:
        /*
        fetch(`/admin/proyectos/${proyectoId}/json`, {
            headers: {
                \'X-Requested-With\': \'XMLHttpRequest\',
                \'Accept\': \'application/json\'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar el contenido del modal con los datos
                actualizarModalProyecto(data.proyecto);
            }
        });
        */
    }
    
    // ========================================
    // FUNCIONES PARA EL MODAL DE OCULTAR PROYECTO
    // ========================================
    
    const __modalOcultarProyecto = document.getElementById(\'modalOcultarProyecto\');
    const __formOcultarProyecto  = document.getElementById(\'formOcultarProyecto\');
    const __motivoProyectoInput  = document.getElementById(\'modalOcultarProyectoMotivo\');
    const __motivoProyectoError  = document.getElementById(\'modalOcultarProyectoError\');

    function abrirModalOcultarProyecto(idProyecto, nombre) {
        __formOcultarProyecto.action = `/admin/proyectos/${idProyecto}/toggle-visibilidad`;
        document.getElementById(\'modalOcultarProyectoNombre\').textContent = nombre || \'\';
        __motivoProyectoInput.value = \'\';
        __motivoProyectoError.classList.add(\'hidden\');
        __motivoProyectoError.textContent = \'\';
        __modalOcultarProyecto.classList.remove(\'hidden\');
        __modalOcultarProyecto.style.display = \'flex\';
        document.body.style.overflow = \'hidden\';
        setTimeout(() => __motivoProyectoInput.focus(), 50);
    }

    function cerrarModalOcultarProyecto() {
        __modalOcultarProyecto.classList.add(\'hidden\');
        __modalOcultarProyecto.style.display = \'none\';
        document.body.style.overflow = \'\';
    }

    function cerrarModalOcultarProyectoFondo(event) {
        if (event.target === __modalOcultarProyecto) cerrarModalOcultarProyecto();
    }

    __formOcultarProyecto.addEventListener(\'submit\', function (e) {
        if (!__motivoProyectoInput.value.trim()) {
            e.preventDefault();
            __motivoProyectoError.textContent = \'Debes indicar el motivo para ocultar el proyecto.\';
            __motivoProyectoError.classList.remove(\'hidden\');
            __motivoProyectoInput.focus();
        }
    });

    // Cerrar modales con ESC
    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\') {
            if (!__modalOcultarProyecto.classList.contains(\'hidden\')) {
                cerrarModalOcultarProyecto();
            }
            const modalProyecto = document.getElementById(\'modalVerProyecto\');
            if (modalProyecto && !modalProyecto.classList.contains(\'hidden\')) {
                cerrarModalVerProyecto();
            }
        }
    });' => '// ========================================
    // FUNCTIONS FOR THE PROJECT VIEW MODE
    // ========================================
    
    // This function needs you to load the specific project
    // If you already have the project in the $project variable in the modal, use this version:
    function openModalViewProject(projectId) {
        const modal = document.getElementById(\'modalViewProject\');
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'hidden\';
        
        // If you need to load the data via AJAX, uncomment this:
        /*
        fetch(`/admin/projects/${projectId}/json`, {
            headers: {
                \'X-Requested-With\': \'XMLHttpRequest\',
                \'Accept\': \'application/json\'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the content of the modal with the data
                updateProjectModal(data.project);
            }
        });
        */
    }
    
    // ========================================
    // FUNCTIONS FOR THE PROJECT HIDE MODE
    // ========================================
    
    const __modalHideProject = document.getElementById(\'modalHideProject\');
    const __formHideProject = document.getElementById(\'formHideProject\');
    const __reasonProjectInput = document.getElementById(\'modalHideProjectReason\');
    const __reasonProjectError = document.getElementById(\'modalHideProjectError\');

    function openModalHideProject(projectid, name) {
        __formHideProject.action = `/admin/projects/${projectid}/toggle-visibility`;
        document.getElementById(\'modalHideProjectName\').textContent = name || \'\';
        __reasonProjectInput.value = \'\';
        __reasonProjectError.classList.add(\'hidden\');
        __reasonProjectError.textContent = \'\';
        __modalHideProject.classList.remove(\'hidden\');
        __modalHideProject.style.display = \'flex\';
        document.body.style.overflow = \'hidden\';
        setTimeout(() => __reasonProjectInput.focus(), 50);
    }

    function closeModalHideProject() {
        __modalHideProject.classList.add(\'hidden\');
        __modalHideProject.style.display = \'none\';
        document.body.style.overflow = \'\';
    }

    function closeModalHideProjectBackground(event) {
        if (event.target === __modalHideProject) closeModalHideProject();
    }

    __formHideProject.addEventListener(\'submit\', function (e) {
        if (!__projectreasonInput.value.trim()) {
            e.preventDefault();
            __motivoProyectoError.textContent = \'You must indicate the reason for hiding the project.\';
            __reasonProjectError.classList.remove(\'hidden\');
            __reasonProjectInput.focus();
        }
    });

    // Close modals with ESC
    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\') {
            if (!__modalHideProject.classList.contains(\'hidden\')) {
                closeModalHideProject();
            }
            const modalProject = document.getElementById(\'modalViewProject\');
            if (modalProject && !modalProject.classList.contains(\'hidden\')) {
                closeModalViewProject();
            }
        }
    });',
  '#modalOcultarProyecto {
        display: none;
    }' => '#modalOcultarProyecto {
        display: none;
    }',
  'Buscar proyecto...' => 'Search project...',
  'Ej. Contenido inapropiado, datos sensibles expuestos, denuncia recibida...' => 'Eg. Inappropriate content, sensitive data exposed, complaint received...',
  'Ver proyecto' => 'See project',
  'Mostrar proyecto' => 'Show project',
  'Detalle del Proyecto' => 'Project Detail',
  'Información completa del proyecto' => 'Complete project information',
  'Volver a proyectos' => 'Return to projects',
  'Creado por {{ $proyecto->perfil->usuario->nombre ?? \'Usuario\' }} 
                        el {{ $proyecto->created_at->format(\'d/m/Y H:i\') }}' => 'Created by {{ $project->profile->user->name ?? \'User\' }} 
                        the {{ $project->created_at->format(\'d/m/Y H:i\') }}',
  'Tecnologías' => 'Technologies',
  'Enlace' => 'Link',
  'url_link }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                {{ $proyecto->url_link }}' => 'url_link }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                {{ $proyecto->url_link }}',
  'Visibilidad:' => 'Visibility:',
  'Fecha inicio:' => 'Start date:',
  'Fecha fin:' => 'End date:',
  'function abrirModalVerProyecto() {
        const modal = document.getElementById(\'modalVerProyecto\');
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'hidden\';
    }
    
    function cerrarModalVerProyecto() {
        const modal = document.getElementById(\'modalVerProyecto\');
        modal.classList.add(\'hidden\');
        modal.classList.remove(\'flex\');
        document.body.style.overflow = \'\';
    }
    
    // Cerrar modal con ESC
    document.addEventListener(\'keydown\', function(event) {
        if (event.key === \'Escape\') {
            const modal = document.getElementById(\'modalVerProyecto\');
            if (modal && !modal.classList.contains(\'hidden\')) {
                cerrarModalVerProyecto();
            }
        }
    });
    
    // Cerrar modal al hacer clic fuera
    const modalProyecto = document.getElementById(\'modalVerProyecto\');
    if (modalProyecto) {
        modalProyecto.addEventListener(\'click\', function(e) {
            if (e.target === this) {
                cerrarModalVerProyecto();
            }
        });
    }' => 'function abrirModalVerProyecto() {
        const modal = document.getElementById(\'modalVerProyecto\');
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'hidden\';
    }
    
    function cerrarModalVerProyecto() {
        const modal = document.getElementById(\'modalVerProyecto\');
        modal.classList.add(\'hidden\');
        modal.classList.remove(\'flex\');
        document.body.style.overflow = \'\';
    }
    
    // Cerrar modal con ESC
    document.addEventListener(\'keydown\', function(event) {
        if (event.key === \'Escape\') {
            const modal = document.getElementById(\'modalVerProyecto\');
            if (modal && !modal.classList.contains(\'hidden\')) {
                cerrarModalVerProyecto();
            }
        }
    });
    
    // Cerrar modal al hacer clic fuera
    const modalProyecto = document.getElementById(\'modalVerProyecto\');
    if (modalProyecto) {
        modalProyecto.addEventListener(\'click\', function(e) {
            if (e.target === this) {
                cerrarModalVerProyecto();
            }
        });
    }',
  '#modalVerProyecto {
        animation: fadeIn 0.2s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }' => '#modalVerProyecto {
        animation: fadeIn 0.2s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }',
  'Gestión de Tecnologías' => 'Technology Management',
  'Administra el catálogo de tecnologías' => 'Manage the technology catalog',
  'Nueva Tecnología' => 'New technology',
  'Buscar por nombre' => 'Search by name',
  'Todas' => 'All',
  'Período' => 'Period',
  'Cualquier fecha' => 'Any date',
  'Últimas 24 horas' => 'Last 24 hours',
  'Últimos 7 días' => 'Last 7 days',
  'Últimos 30 días' => 'Last 30 days',
  'Ordenar por' => 'sort by',
  'Fecha de creación' => 'Creation date',
  'Dirección' => 'Address',
  'Ascendente' => 'Ascending',
  'Descendente' => 'Descendant',
  'Aplicar' => 'Apply',
  'Creada' => 'Created',
  '#{{ $tecnologia->id_tecnologia }}' => '#{{ $technology->technology_id }}',
  'created_at->format(\'d/m/Y H:i\') }}">
                                {{ $tecnologia->created_at->diffForHumans() }}' => 'created_at->format(\'d/m/Y H:i\') }}">
                                {{ $tecnologia->created_at->diffForHumans() }}',
  'id_tecnologia }}, \'{{ $tecnologia->nombre }}\', \'{{ $tecnologia->categoria }}\')" 
                                    class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition">' => 'id_tecnologia }}, \'{{ $tecnologia->nombre }}\', \'{{ $tecnologia->categoria }}\')" 
                                    class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition">',
  'id_tecnologia) }}" method="POST" class="inline" data-confirm="¿Eliminar la tecnología «{{ $tecnologia->nombre }}»?">
                                @csrf
                                @method(\'DELETE\')' => 'technology_id) }}" method="POST" class="inline" data-confirm="Delete the technology «{{ $technology->name }}»?">
                                @csrf
                                @method(\'DELETE\')',
  'No hay tecnologías registradas con esos filtros' => 'There are no technologies registered with these filters',
  'Categoría *' => 'Category *',
  'Seleccionar categoría' => 'Select category',
  '+ Crear nueva categoría' => '+ Create new category',
  'function setCategoriaUI(valor) {
        const select = document.getElementById(\'tecnologiaCategoriaSelect\');
        const nueva  = document.getElementById(\'tecnologiaCategoriaNueva\');
        const hidden = document.getElementById(\'tecnologiaCategoria\');

        nueva.classList.add(\'hidden\');
        nueva.value = \'\';

        if (!valor) {
            select.value = \'\';
            hidden.value = \'\';
            return;
        }

        const existe = Array.from(select.options).some(o => o.value === valor && o.value !== \'__nueva__\');
        if (existe) {
            select.value = valor;
            hidden.value = valor;
        } else {
            select.value = \'__nueva__\';
            nueva.classList.remove(\'hidden\');
            nueva.value = valor;
            hidden.value = valor;
        }
    }

    function onCategoriaChange() {
        const select = document.getElementById(\'tecnologiaCategoriaSelect\');
        const nueva  = document.getElementById(\'tecnologiaCategoriaNueva\');
        const hidden = document.getElementById(\'tecnologiaCategoria\');

        if (select.value === \'__nueva__\') {
            nueva.classList.remove(\'hidden\');
            nueva.value = \'\';
            hidden.value = \'\';
            nueva.focus();
        } else {
            nueva.classList.add(\'hidden\');
            nueva.value = \'\';
            hidden.value = select.value;
        }
    }

    document.addEventListener(\'DOMContentLoaded\', function () {
        const nueva  = document.getElementById(\'tecnologiaCategoriaNueva\');
        const hidden = document.getElementById(\'tecnologiaCategoria\');
        nueva.addEventListener(\'input\', () => { hidden.value = nueva.value.trim(); });

        document.getElementById(\'formTecnologia\').addEventListener(\'submit\', function (e) {
            if (!hidden.value || !hidden.value.trim()) {
                e.preventDefault();
                alert(\'Selecciona una categoría existente o escribe el nombre de la nueva.\');
            }
        });
    });

    function abrirModalCrear() {
        document.getElementById(\'modalTitulo\').innerText = \'Nueva Tecnología\';
        document.getElementById(\'formTecnologia\').action = "{{ route(\'admin.tecnologias.store\') }}";
        document.getElementById(\'methodField\').value = \'POST\';
        document.getElementById(\'tecnologiaNombre\').value = \'\';
        setCategoriaUI(\'\');
        document.getElementById(\'modalTecnologia\').classList.remove(\'hidden\');
    }

    function editarTecnologia(id, nombre, categoria) {
        document.getElementById(\'modalTitulo\').innerText = \'Editar Tecnología\';
        document.getElementById(\'formTecnologia\').action = `/admin/tecnologias/${id}`;
        document.getElementById(\'methodField\').value = \'PUT\';
        document.getElementById(\'tecnologiaNombre\').value = nombre;
        setCategoriaUI(categoria);
        document.getElementById(\'modalTecnologia\').classList.remove(\'hidden\');
    }

    function cerrarModal() {
        document.getElementById(\'modalTecnologia\').classList.add(\'hidden\');
    }

    document.addEventListener(\'keydown\', function (event) {
        if (event.key === \'Escape\') cerrarModal();
    });' => 'function setUICategory(value) {
        const select = document.getElementById(\'technologyCategorySelect\');
        const new = document.getElementById(\'newCategorytechnology\');
        const hidden = document.getElementById(\'technologyCategory\');

        new.classList.add(\'hidden\');
        new.value = \'\';

        if (!value) {
            select.value = \'\';
            hidden.value = \'\';
            return;
        }

        const exists = Array.from(select.options).some(o => o.value === value && o.value !== \'__new__\');
        if (exists) {
            select.value = value;
            hidden.value = value;
        } else {
            select.value = \'__new__\';
            new.classList.remove(\'hidden\');
            new.value = value;
            hidden.value = value;
        }
    }

    function onCategoryChange() {
        const select = document.getElementById(\'technologyCategorySelect\');
        const new = document.getElementById(\'newCategorytechnology\');
        const hidden = document.getElementById(\'technologyCategory\');

        if (select.value === \'__new__\') {
            new.classList.remove(\'hidden\');
            new.value = \'\';
            hidden.value = \'\';
            new.focus();
        } else {
            new.classList.add(\'hidden\');
            new.value = \'\';
            hidden.value = select.value;
        }
    }

    document.addEventListener(\'DOMContentLoaded\', function () {
        const new = document.getElementById(\'newCategorytechnology\');
        const hidden = document.getElementById(\'technologyCategory\');
        new.addEventListener(\'input\', () => { hidden.value = new.value.trim(); });

        document.getElementById(\'formTecnologia\').addEventListener(\'submit\', function (e) {
            if (!hidden.value || !hidden.value.trim()) {
                e.preventDefault();
                alert(\'Select an existing category or type the name of the new one.\');
            }
        });
    });

    function openModalCreate() {
        document.getElementById(\'modalTitulo\').innerText = \'New Technology\';
        document.getElementById(\'formTecnologia\').action = "{{ route(\'admin.tecnologias.store\') }}";
        document.getElementById(\'methodField\').value = \'POST\';
        document.getElementById(\'technologyName\').value = \'\';
        setUICategory(\'\');
        document.getElementById(\'modalTechnology\').classList.remove(\'hidden\');
    }

    function editTechnology(id, name, category) {
        document.getElementById(\'modalTitulo\').innerText = \'Edit Technology\';
        document.getElementById(\'formTecnologia\').action = `/admin/tecnologias/${id}`;
        document.getElementById(\'methodField\').value = \'PUT\';
        document.getElementById(\'technologyName\').value = name;
        setUICategory(category);
        document.getElementById(\'modalTechnology\').classList.remove(\'hidden\');
    }

    function closeModal() {
        document.getElementById(\'modalTechnology\').classList.add(\'hidden\');
    }

    document.addEventListener(\'keydown\', function (event) {
        if (event.key === \'Escape\') closeModal();
    });',
  'Ej: Laravel, React...' => 'Ej: Laravel, React...',
  'Ej: Laravel, React, Python' => 'Ej: Laravel, React, Python',
  'Nombre de la nueva categoría' => 'Name of the new category',
  'Crear Usuario' => 'Create User',
  'Completa el formulario para registrar un nuevo usuario' => 'Complete the form to register a new user',
  'Apellido' => 'Last name',
  'Correo electrónico' => 'Email',
  'Contraseña' => 'Password',
  'Mínimo 6 caracteres' => 'Minimum 6 characters',
  'Rol' => 'Role',
  'Usuario normal' => 'Normal user',
  'Administrador' => 'Administrator',
  'function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input && icon) {
            if (input.type === \'password\') {
                input.type = \'text\';
                icon.classList.remove(\'fa-eye\');
                icon.classList.add(\'fa-eye-slash\');
            } else {
                input.type = \'password\';
                icon.classList.remove(\'fa-eye-slash\');
                icon.classList.add(\'fa-eye\');
            }
        }
    }
    
    function cerrarModalUsuario() {
        const modal = document.getElementById(\'modalCrearUsuario\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
        }
    }
    
    // Envío del formulario con AJAX
    document.addEventListener(\'DOMContentLoaded\', function() {
        const formCrearUsuario = document.getElementById(\'formCrearUsuario\');
        
        if (formCrearUsuario) {
            formCrearUsuario.addEventListener(\'submit\', async function(e) {
                e.preventDefault();
                
                const submitBtn = this.querySelector(\'button[type="submit"]\');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = \'' => 'function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input && icon) {
            if (input.type === \'password\') {
                input.type = \'text\';
                icon.classList.remove(\'fa-eye\');
                icon.classList.add(\'fa-eye-slash\');
            } else {
                input.type = \'password\';
                icon.classList.remove(\'fa-eye-slash\');
                icon.classList.add(\'fa-eye\');
            }
        }
    }
    
    function cerrarModalUsuario() {
        const modal = document.getElementById(\'modalCrearUsuario\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
        }
    }
    
    // Envío del formulario con AJAX
    document.addEventListener(\'DOMContentLoaded\', function() {
        const formCrearUsuario = document.getElementById(\'formCrearUsuario\');
        
        if (formCrearUsuario) {
            formCrearUsuario.addEventListener(\'submit\', async function(e) {
                e.preventDefault();
                
                const submitBtn = this.querySelector(\'button[type="submit"]\');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = \'',
  'Creando...\';
                submitBtn.disabled = true;
                
                // Limpiar errores
                document.querySelectorAll(\'[class^="error-"]\').forEach(el => {
                    el.classList.add(\'hidden\');
                });
                document.querySelectorAll(\'#formCrearUsuario input, #formCrearUsuario select\').forEach(input => {
                    input.classList.remove(\'border-red-500\');
                });
                
                const formData = new FormData(this);
                
                try {
                    const response = await fetch(this.action, {
                        method: \'POST\',
                        body: formData,
                        headers: {
                            \'X-Requested-With\': \'XMLHttpRequest\',
                            \'Accept\': \'application/json\'
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok && data.success) {
                        await Swal.fire({
                            icon: \'success\',
                            title: \'¡Usuario creado!\',
                            text: data.message,
                            confirmButtonColor: \'#1e3a5f\',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        cerrarModalUsuario();
                        location.reload();
                    } else {
                        if (data.errors) {
                            for (const [key, messages] of Object.entries(data.errors)) {
                                const errorElement = document.querySelector(`.error-${key}`);
                                if (errorElement) {
                                    errorElement.textContent = messages[0];
                                    errorElement.classList.remove(\'hidden\');
                                    
                                    const inputElement = document.getElementById(key);
                                    if (inputElement) {
                                        inputElement.classList.add(\'border-red-500\');
                                    }
                                }
                            }
                        } else {
                            await Swal.fire({
                                icon: \'error\',
                                title: \'Error\',
                                text: data.message || \'Error al crear el usuario\',
                                confirmButtonColor: \'#d33\'
                            });
                        }
                        
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                } catch (error) {
                    console.error(\'Error:\', error);
                    await Swal.fire({
                        icon: \'error\',
                        title: \'Error de conexión\',
                        text: \'No se pudo conectar con el servidor.\',
                        confirmButtonColor: \'#d33\'
                    });
                    
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        }
    });' => 'Creando...\';
                submitBtn.disabled = true;
                
                // Limpiar errores
                document.querySelectorAll(\'[class^="error-"]\').forEach(el => {
                    el.classList.add(\'hidden\');
                });
                document.querySelectorAll(\'#formCrearUsuario input, #formCrearUsuario select\').forEach(input => {
                    input.classList.remove(\'border-red-500\');
                });
                
                const formData = new FormData(this);
                
                try {
                    const response = await fetch(this.action, {
                        method: \'POST\',
                        body: formData,
                        headers: {
                            \'X-Requested-With\': \'XMLHttpRequest\',
                            \'Accept\': \'application/json\'
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok && data.success) {
                        await Swal.fire({
                            icon: \'success\',
                            title: \'¡Usuario creado!\',
                            text: data.message,
                            confirmButtonColor: \'#1e3a5f\',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        cerrarModalUsuario();
                        location.reload();
                    } else {
                        if (data.errors) {
                            for (const [key, messages] of Object.entries(data.errors)) {
                                const errorElement = document.querySelector(`.error-${key}`);
                                if (errorElement) {
                                    errorElement.textContent = messages[0];
                                    errorElement.classList.remove(\'hidden\');
                                    
                                    const inputElement = document.getElementById(key);
                                    if (inputElement) {
                                        inputElement.classList.add(\'border-red-500\');
                                    }
                                }
                            }
                        } else {
                            await Swal.fire({
                                icon: \'error\',
                                title: \'Error\',
                                text: data.message || \'Error al crear el usuario\',
                                confirmButtonColor: \'#d33\'
                            });
                        }
                        
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                } catch (error) {
                    console.error(\'Error:\', error);
                    await Swal.fire({
                        icon: \'error\',
                        title: \'Error de conexión\',
                        text: \'No se pudo conectar con el servidor.\',
                        confirmButtonColor: \'#d33\'
                    });
                    
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        }
    });',
  '/* Animación suave para el modal */
    #modalCrearUsuario {
        animation: fadeIn 0.2s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }' => '/* Smooth animation for the modal */
    #modalCreateUser {
        animation: fadeIn 0.2s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        or {
            opacity: 1;
        }
    }',
  'Nombre del usuario' => 'User name',
  'Apellido del usuario' => 'User\'s last name',
  'usuario@email.com' => 'usuario@email.com',
  '+591 700 00000' => '+591 700 00000',
  'Editar Usuario' => 'Edit User',
  'Modifica la información del usuario' => 'Modify user information',
  'Volver a usuarios' => 'Back to users',
  'id_usuario) }}" method="POST">
                @csrf
                @method(\'PUT\')' => 'id_usuario) }}" method="POST">
                @csrf
                @method(\'PUT\')',
  'Datos Personales' => 'Personal Data',
  'Información básica del usuario' => 'Basic user information',
  'nombre) }}" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">' => 'nombre) }}" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">',
  'apellido) }}" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">' => 'apellido) }}" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">',
  'Correo Electrónico' => 'Email',
  'correo_electronico) }}" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">' => 'correo_electronico) }}" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">',
  'telefono) }}"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white"
                                    placeholder="Ej: +34 123 456 789">' => 'telefono) }}"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white"
                                    placeholder="Ej: +34 123 456 789">',
  'Rol y Estado' => 'Role and Status',
  'Configuración de permisos' => 'Permission settings',
  'is_admin ? \'selected\' : \'\' }}>Usuario normal' => 'is_admin ? \'selected\' : \'\' }}>Normal user',
  'is_admin ? \'selected\' : \'\' }}>Administrador' => 'is_admin ? \'selected\' : \'\' }}>Administrador',
  'estado == \'activo\' ? \'selected\' : \'\' }}>Activo' => 'status == \'active\' ? \'selected\' : \'\' }}>Active',
  'estado == \'suspendido\' ? \'selected\' : \'\' }}>Suspendido' => 'status == \'suspended\' ? \'selected\' : \'\' }}>Suspended',
  'Seguridad' => 'Security',
  'Cambiar contraseña del usuario' => 'Change user password',
  'Nueva Contraseña' => 'New Password',
  'Información del sistema' => 'System information',
  'Datos de registro' => 'Registration data',
  'ID de usuario:' => 'User ID:',
  '#{{ $usuario->id_usuario }}' => '#{{ $user->user_id }}',
  'Registrado:' => 'Registered:',
  'Último acceso:' => 'Last access:',
  'Guardar Cambios' => 'Save Changes',
  'Ej: +34 123 456 789' => 'Ej: +34 123 456 789',
  'Dejar en blanco para mantener la actual' => 'Leave blank to keep current',
  'Usuarios del sistema' => 'System users',
  'Activos' => 'Assets',
  'Inactivos' => 'Inactive',
  'Nuevo Usuario' => 'New User',
  'CORREO' => 'MAIL',
  'FECHA DE REGISTRO' => 'REGISTRATION DATE',
  'estado }}" data-nombre="{{ strtolower($usuario->nombre) }} {{ strtolower($usuario->apellido) }}" data-email="{{ strtolower($usuario->correo_electronico) }}">' => 'status }}" data-name="{{ strtolower($user->name) }} {{ strtolower($user->last_name) }}" data-email="{{ strtolower($user->email) }}">',
  'perfil->foto_perfil }}" alt="">
                                @else' => 'profile->profile_photo }}" alt="">
                                @else',
  'Activado' => 'Activated',
  'Inactivo' => 'Idle',
  'id_usuario }})" 
                                class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition" 
                                title="Ver perfil">' => 'id_usuario }})" 
                                class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition" 
                                title="Ver perfil">',
  'id_usuario }})" 
                                class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition" 
                                title="Editar usuario">' => 'id_usuario }})" 
                                class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition" 
                                title="Editar usuario">',
  'id_usuario) }}" method="POST" class="inline">
                                    @csrf' => 'id_usuario) }}" method="POST" class="inline">
                                    @csrf',
  'is_admin ? \'Quitar admin\' : \'Hacer admin\' }}">' => 'is_admin ? \'Remove admin\' : \'Make admin\' }}">',
  'Crear el primer usuario' => 'Create the first user',
  'Mostrando {{ $usuarios->firstItem() ?? 0 }} a {{ $usuarios->lastItem() ?? 0 }} de {{ $usuarios->total() }} usuarios' => 'Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} users',
  'Anterior' => 'Anterior',
  'previousPageUrl() }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Anterior' => 'previousPageUrl() }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Anterior',
  'nextPageUrl() }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Siguiente' => 'nextPageUrl() }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Siguiente',
  'Siguiente' => 'Following',
  '// Función para abrir el modal de crear usuario
    function abrirModalUsuario() {
        const modal = document.getElementById(\'modalCrearUsuario\');
        if (modal) {
            modal.classList.remove(\'hidden\');
            modal.classList.add(\'flex\');
        }
    }
    
    // Función para abrir modal VER con AJAX
    function abrirModalVerUsuario(id) {
        const modal = document.getElementById(\'modalVerUsuario\');
        const contenidoDiv = modal.querySelector(\'.p-6\');
        
        // Mostrar loading
        contenidoDiv.innerHTML = \'' => '// Function to open the create user modal
    function openUserModal() {
        const modal = document.getElementById(\'modalCrearUser\');
        if (modal) {
            modal.classList.remove(\'hidden\');
            modal.classList.add(\'flex\');
        }
    }
    
    // Function to open VER modal with AJAX
    function openModalViewUser(id) {
        const modal = document.getElementById(\'modalVerUser\');
        const contentDiv = modal.querySelector(\'.p-6\');
        
        // Show loading
        contentDiv.innerHTML = \'',
  '\';
        
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'hidden\';
        
        // Cargar contenido vía AJAX
        fetch(`/admin/usuarios/${id}`, {
            headers: { \'X-Requested-With\': \'XMLHttpRequest\' }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, \'text/html\');
            const nuevoContenido = doc.querySelector(\'#modalVerUsuario .p-6\');
            if (nuevoContenido) {
                contenidoDiv.innerHTML = nuevoContenido.innerHTML;
            } else {
                contenidoDiv.innerHTML = \'' => '\';
        
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'hidden\';
        
        // Cargar contenido vía AJAX
        fetch(`/admin/usuarios/${id}`, {
            headers: { \'X-Requested-With\': \'XMLHttpRequest\' }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, \'text/html\');
            const nuevoContenido = doc.querySelector(\'#modalVerUsuario .p-6\');
            if (nuevoContenido) {
                contenidoDiv.innerHTML = nuevoContenido.innerHTML;
            } else {
                contenidoDiv.innerHTML = \'',
  'Error al cargar el perfil' => 'Error loading profile',
  '\';
            }
        })
        .catch(() => {
            contenidoDiv.innerHTML = \'' => '\';
            }
        })
        .catch(() => {
            contenidoDiv.innerHTML = \'',
  'Error de conexión' => 'Connection error',
  '\';
        });
    }
    
    // Función para abrir modal EDITAR con AJAX
    function abrirModalEditarUsuario(id) {
        const modal = document.getElementById(\'modalEditarUsuario\');
        const contenidoDiv = modal.querySelector(\'.p-6\');
        
        // Mostrar loading
        contenidoDiv.innerHTML = \'' => '\';
        });
    }
    
    // Function to open EDIT modal with AJAX
    function openModalEditUser(id) {
        const modal = document.getElementById(\'modalEditarUsuario\');
        const contentDiv = modal.querySelector(\'.p-6\');
        
        // Show loading
        contentDiv.innerHTML = \'',
  '\';
        
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'hidden\';
        
        fetch(`/admin/usuarios/${id}/editar`, {
            headers: { \'X-Requested-With\': \'XMLHttpRequest\' }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, \'text/html\');
            const nuevoContenido = doc.querySelector(\'#modalEditarUsuario .p-6\');
            if (nuevoContenido) {
                contenidoDiv.innerHTML = nuevoContenido.innerHTML;
                // Actualizar action del formulario
                const form = contenidoDiv.querySelector(\'form\');
                if (form) form.action = `/admin/usuarios/${id}`;
                // Re-ejecutar scripts si es necesario (para togglePassword, etc.)
                const scripts = nuevoContenido.querySelectorAll(\'script\');
                scripts.forEach(script => {
                    const newScript = document.createElement(\'script\');
                    if (script.src) {
                        newScript.src = script.src;
                    } else {
                        newScript.textContent = script.textContent;
                    }
                    document.body.appendChild(newScript);
                });
            } else {
                contenidoDiv.innerHTML = \'' => '\';
        
        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'hidden\';
        
        fetch(`/admin/usuarios/${id}/editar`, {
            headers: { \'X-Requested-With\': \'XMLHttpRequest\' }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, \'text/html\');
            const nuevoContenido = doc.querySelector(\'#modalEditarUsuario .p-6\');
            if (nuevoContenido) {
                contenidoDiv.innerHTML = nuevoContenido.innerHTML;
                // Actualizar action del formulario
                const form = contenidoDiv.querySelector(\'form\');
                if (form) form.action = `/admin/usuarios/${id}`;
                // Re-ejecutar scripts si es necesario (para togglePassword, etc.)
                const scripts = nuevoContenido.querySelectorAll(\'script\');
                scripts.forEach(script => {
                    const newScript = document.createElement(\'script\');
                    if (script.src) {
                        newScript.src = script.src;
                    } else {
                        newScript.textContent = script.textContent;
                    }
                    document.body.appendChild(newScript);
                });
            } else {
                contenidoDiv.innerHTML = \'',
  'Error al cargar el formulario' => 'Error loading form',
  '\';
        });
    }
    
    // Cerrar modales (funciones ya definidas en cada archivo, pero las redefinimos globalmente por si acaso)
    window.cerrarModalVerUsuario = function() {
        const modal = document.getElementById(\'modalVerUsuario\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
            document.body.style.overflow = \'\';
        }
    };
    
    window.cerrarModalEditarUsuario = function() {
        const modal = document.getElementById(\'modalEditarUsuario\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
            document.body.style.overflow = \'\';
        }
    };
    
    window.cerrarModalUsuario = function() {
        const modal = document.getElementById(\'modalCrearUsuario\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
        }
    };
    
    // Cerrar modales con ESC
    document.addEventListener(\'keydown\', function(e) {
        if (e.key === \'Escape\') {
            cerrarModalVerUsuario();
            cerrarModalEditarUsuario();
            cerrarModalUsuario();
        }
    });
    
    // Cerrar al hacer clic fuera
    document.getElementById(\'modalVerUsuario\')?.addEventListener(\'click\', function(e) {
        if (e.target === this) cerrarModalVerUsuario();
    });
    document.getElementById(\'modalEditarUsuario\')?.addEventListener(\'click\', function(e) {
        if (e.target === this) cerrarModalEditarUsuario();
    });
    document.getElementById(\'modalCrearUsuario\')?.addEventListener(\'click\', function(e) {
        if (e.target === this) cerrarModalUsuario();
    });
    
    // Buscador en tiempo real (sin cambios)
    const searchInput = document.getElementById(\'searchInput\');
    const estadoFilter = document.getElementById(\'estadoFilter\');
    const tableRows = document.querySelectorAll(\'tbody tr[data-estado]\');
    
    function filtrarTabla() {
        const searchTerm = searchInput.value.toLowerCase();
        const estadoValue = estadoFilter.value;
        tableRows.forEach(row => {
            const nombre = row.getAttribute(\'data-nombre\') || \'\';
            const email = row.getAttribute(\'data-email\') || \'\';
            const estado = row.getAttribute(\'data-estado\');
            const matchesSearch = searchTerm === \'\' || nombre.includes(searchTerm) || email.includes(searchTerm);
            const matchesEstado = estadoValue === \'todos\' || estado === estadoValue;
            row.style.display = (matchesSearch && matchesEstado) ? \'\' : \'none\';
        });
    }
    
    if (searchInput) searchInput.addEventListener(\'input\', filtrarTabla);
    if (estadoFilter) estadoFilter.addEventListener(\'change\', filtrarTabla);' => '\';
        });
    }
    
    // Cerrar modales (funciones ya definidas en cada archivo, pero las redefinimos globalmente por si acaso)
    window.cerrarModalVerUsuario = function() {
        const modal = document.getElementById(\'modalVerUsuario\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
            document.body.style.overflow = \'\';
        }
    };
    
    window.cerrarModalEditarUsuario = function() {
        const modal = document.getElementById(\'modalEditarUsuario\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
            document.body.style.overflow = \'\';
        }
    };
    
    window.cerrarModalUsuario = function() {
        const modal = document.getElementById(\'modalCrearUsuario\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
        }
    };
    
    // Cerrar modales con ESC
    document.addEventListener(\'keydown\', function(e) {
        if (e.key === \'Escape\') {
            cerrarModalVerUsuario();
            cerrarModalEditarUsuario();
            cerrarModalUsuario();
        }
    });
    
    // Cerrar al hacer clic fuera
    document.getElementById(\'modalVerUsuario\')?.addEventListener(\'click\', function(e) {
        if (e.target === this) cerrarModalVerUsuario();
    });
    document.getElementById(\'modalEditarUsuario\')?.addEventListener(\'click\', function(e) {
        if (e.target === this) cerrarModalEditarUsuario();
    });
    document.getElementById(\'modalCrearUsuario\')?.addEventListener(\'click\', function(e) {
        if (e.target === this) cerrarModalUsuario();
    });
    
    // Buscador en tiempo real (sin cambios)
    const searchInput = document.getElementById(\'searchInput\');
    const estadoFilter = document.getElementById(\'estadoFilter\');
    const tableRows = document.querySelectorAll(\'tbody tr[data-estado]\');
    
    function filtrarTabla() {
        const searchTerm = searchInput.value.toLowerCase();
        const estadoValue = estadoFilter.value;
        tableRows.forEach(row => {
            const nombre = row.getAttribute(\'data-nombre\') || \'\';
            const email = row.getAttribute(\'data-email\') || \'\';
            const estado = row.getAttribute(\'data-estado\');
            const matchesSearch = searchTerm === \'\' || nombre.includes(searchTerm) || email.includes(searchTerm);
            const matchesEstado = estadoValue === \'todos\' || estado === estadoValue;
            row.style.display = (matchesSearch && matchesEstado) ? \'\' : \'none\';
        });
    }
    
    if (searchInput) searchInput.addEventListener(\'input\', filtrarTabla);
    if (estadoFilter) estadoFilter.addEventListener(\'change\', filtrarTabla);',
  'Ver perfil' => 'View profile',
  'Editar usuario' => 'Edit user',
  'Suspender usuario' => 'Suspend user',
  'Activar usuario' => 'Activate user',
  'perfil->foto_perfil }}" alt="Foto de {{ $usuario->nombre }}" class="h-16 w-16 rounded-full object-cover shadow-md">
        @else' => 'profile->profile_photo }}" alt="Photo of {{ $user->name }}" class="h-16 w-16 rounded-full object-cover shadow-md">
        @else',
  'Información Personal' => 'Personal Information',
  'Nombre:' => 'Name:',
  'Teléfono:' => 'Telephone:',
  'Ubicación:' => 'Location:',
  '({{ $usuario->motivo_suspension }})' => '({{ $user->suspension_reason }})',
  'Inactivo (desactivado por el usuario)' => 'Inactive (disabled by user)',
  'Rol:' => 'Role:',
  'Registro:' => 'Record:',
  'Biografía' => 'Biography',
  'Enlaces' => 'Links',
  'url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-xs">' => 'url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-xs">',
  'Experiencia laboral' => 'Work experience',
  'Actual' => 'Actual',
  'Referencias:' => 'References:',
  'No hay experiencia registrada' => 'No experience recorded',
  '({{ ($usuario->perfil->proyectos ?? collect())->count() }})' => '({{ ($user->profile->projects ?? collect())->count() }})',
  'Destacado' => 'Outstanding',
  'Privado' => 'Private',
  'url_link }}" target="_blank" rel="noopener" class="text-xs text-blue-600 hover:underline pl-6 mt-1 inline-block">' => 'url_link }}" target="_blank" rel="noopener" class="text-xs text-blue-600 hover:underline pl-6 mt-1 inline-block">',
  'Gestión de cuenta' => 'Account management',
  'id_usuario) }}" method="POST">
                            @csrf' => 'user_id) }}" method="POST">
                            @csrf',
  'Desactivar cuenta' => 'Deactivate account',
  'Activar cuenta' => 'Activate account',
  '({{ ($usuario->perfil->habilidades ?? collect())->count() }})' => '({{ ($user->profile->skills ?? collect())->count() }})',
  'Categoría: {{ $habilidad->categoria->nombre }}' => 'Category: {{ $skill->category->name }}',
  'No hay habilidades registradas' => 'No skills registered',
  'Habilidades blandas' => 'Soft skills',
  '({{ ($usuario->perfil->habilidadesBlandas ?? collect())->count() }})' => '({{ ($user->profile->softskills ?? collect())->count() }})',
  'descripcion }}">
                            {{ $blanda->nombre }}' => 'description }}">
                            {{ $soft->name }}',
  'Formación académica' => 'Academic training',
  '({{ ($usuario->perfil->formacionAcademica ?? collect())->count() }})' => '({{ ($user->profile->academictraining ?? collect())->count() }})',
  'No hay formación registrada' => 'There is no registered training',
  'Perfil de Usuario' => 'User Profile',
  'Información detallada del usuario' => 'Detailed user information',
  'perfil->foto_perfil }}" alt="Foto de {{ $usuario->nombre }}" class="h-16 w-16 rounded-full object-cover shadow-md">
                    @else' => 'profile->profile_photo }}" alt="Photo of {{ $user->name }}" class="h-16 w-16 rounded-full object-cover shadow-md">
                    @else',
  'url }}" target="_blank" rel="noopener"
                                           class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-xs">' => 'url }}" target="_blank" rel="noopener"
                                           class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-xs">',
  'id_usuario) }}" method="POST">
                                        @csrf' => 'user_id) }}" method="POST">
                                        @csrf',
  'descripcion }}">
                                        {{ $blanda->nombre }}' => 'description }}">
                                        {{ $soft->name }}',
  '✕' => '✕',
  'Iniciar Sesión' => 'Login',
  'Ingresa tus credenciales para acceder a tu cuenta' => 'Enter your credentials to access your account',
  '¿Olvidaste tu contraseña?' => 'Forgot your password?',
  'o continúa con' => 'or continue with',
  'Continuar con GitHub' => 'Continue with GitHub',
  'Continuar con Google' => 'Continue with Google',
  'Continuar con LinkedIn' => 'Continue with LinkedIn',
  '(Próximamente)' => '(Soon)',
  '¿No tienes una cuenta?' => 'Don\'t have an account?',
  'Regístrate aquí' => 'Register here',
  'tu@email.com' => 'tu@email.com',
  'Ingresa tu contraseña' => 'Enter your password',
  'Crear Cuenta' => 'Create Account',
  'Completa el formulario para registrarte en el sistema de portafolios' => 'Complete the form to register in the portfolio system',
  'Apellidos' => 'Surnames',
  'Debe tener al menos 8 caracteres, una mayuscula, una minuscula, un numero y un simbolo.' => 'It must have at least 8 characters, an uppercase letter, a lowercase letter, a number and a symbol.',
  'Confirmar contraseña' => 'Confirm Password',
  '¿Ya tienes una cuenta?' => 'Do you already have an account?',
  'Inicia sesión' => 'Sign in',
  'Tu nombre' => 'your name',
  'Tus apellidos' => 'your last names',
  'Minimo 8 caracteres' => 'Minimum 8 characters',
  'Repite tu contraseña' => 'Repeat your password',
  'Portfolio Digital' => 'Portfolio Digital',
  'visibilidad ?? \'privado\';
    @endphp' => 'visibility?? \'private\';
    @endphp',
  '// Visibilidad actual del perfil (publico/privado) — usada por los flujos de creación
        window.PERFIL_VISIBILIDAD = @json($visibilidadDash);

        // Cuando se crea un elemento, si el perfil es público actualizamos el banner de
        // "elementos sin publicar" (no muestra popups). El banner vive en la sección
        // de Configuración de cuenta → Visibilidad del perfil.
        window.notificarItemPublicable = function (tipo) {
            if (window.PERFIL_VISIBILIDAD !== \'publico\') return;

            const aviso = document.getElementById(\'aviso-sin-publicar\');
            const countEl = document.getElementById(\'aviso-sin-publicar-count\');
            if (!aviso || !countEl) return;

            const actual = parseInt(countEl.textContent || \'0\', 10) || 0;
            countEl.textContent = actual + 1;
            aviso.classList.remove(\'hidden\');
            aviso.classList.add(\'flex\');
        };' => '// Current profile visibility (public/private) — used by creation flows
        window.PROFILE_VISIBILITY = @json($visibilityDash);

        // When an item is created, if the profile is public we update the profile banner
        // "unpublished items" (does not show popups). The banner lives in the section
        // from Account Settings → Profile Visibility.
        window.notifyItemPublicable = function (type) {
            if (window.PROFILE_VISIBILITY !== \'public\') return;

            const notice = document.getElementById(\'unpublished-notice\');
            const countEl = document.getElementById(\'unpublished-notice-count\');
            if (!notice || !countEl) return;

            const current = parseInt(countEl.textContent || \'0\', 10) || 0;
            countEl.textContent = current + 1;
            notice.classList.remove(\'hidden\');
            notice.classList.add(\'flex\');
        };',
  'Submenu' => 'Submenu',
  'Mis Habilidades' => 'My Skills',
  'Experiencia Laboral' => 'Work Experience',
  'Formación Académica' => 'Academic Training',
  'Mis Proyectos' => 'My Projects',
  'id_habilidad) : route(\'habilidades.store\') }}">

    @csrf

    @if(isset($habilidad))
        @method(\'PUT\')
    @endif' => 'skill_id) : route(\'skills.store\') }}">

    @csrf

    @if(isset($skill))
        @method(\'PUT\')
    @endif',
  'Nombre de la Habilidad' => 'Skill Name',
  'nombre ?? \'\') }}"
            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">' => 'nombre ?? \'\') }}"
            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">',
  'Selecciona una categoría' => 'Select a category',
  'id_categoria }}"
                    {{ old(\'categoria\', $habilidad->id_categoria ?? \'\') == $categoria->id_categoria ? \'selected\' : \'\' }}>
                    {{ $categoria->nombre }}' => 'category_id }}"
                    {{ old(\'category\', $skill->category_id ?? \'\') == $category->category_id ? \'selected\' : \'\' }}>
                    {{ $category->name }}',
  'Años de Experiencia' => 'Years of Experience',
  'anios_experiencia ?? \'\') }}"
            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">' => 'anios_experiencia ?? \'\') }}"
            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">',
  'Mínimo 20 caracteres, máximo 500' => 'Minimum 20 characters, maximum 500',
  'Ej: React, Node.js, PostgreSQL' => 'Ej: React, Node.js, PostgreSQL',
  'Ej: 3' => 'Ej: 3',
  'Describe tu experiencia y proyectos realizados...' => 'Describe your experience and projects carried out...',
  '(function () {

    const CONFIRM_CONFIG_HAB = {
        guardar: {
            titulo:    \'¿Guardar habilidad?\',
            mensaje:   \'Se almacenará la información de tu habilidad. Podrás editarla en cualquier momento.\',
            icon:      \'fas fa-save\',
            iconBg:    \'bg-blue-50\',
            iconColor: \'text-blue-500\',
            btnClass:  \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90\',
            accion:    () => submitHabilidad(),
        },
        cancelar: {
            titulo:    \'¿Descartar cambios?\',
            mensaje:   \'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.\',
            icon:      \'fas fa-times-circle\',
            iconBg:    \'bg-red-50\',
            iconColor: \'text-red-500\',
            btnClass:  \'bg-red-500 hover:bg-red-600\',
            accion:    () => cerrarModalHabilidad(),
        },
        eliminar: {
            titulo:    \'¿Eliminar habilidad?\',
            mensaje:   \'Esta acción es permanente y no se puede deshacer. La habilidad será eliminada definitivamente.\',
            icon:      \'fas fa-trash-alt\',
            iconBg:    \'bg-red-50\',
            iconColor: \'text-red-500\',
            btnClass:  \'bg-[#e11d48] hover:bg-red-600\',
            accion:    null,
        },
    };

    function mostrarConfirmacionHabilidad(tipo) {
        const cfg = CONFIRM_CONFIG_HAB[tipo];
        if (!cfg) return;
        window.confirmar({
            titulo:    cfg.titulo,
            mensaje:   cfg.mensaje,
            icon:      cfg.icon,
            iconBg:    cfg.iconBg,
            iconColor: cfg.iconColor,
            btnClass:  cfg.btnClass,
            onConfirm: cfg.accion,
        });
    }
    window.mostrarConfirmacionHabilidad = mostrarConfirmacionHabilidad;

    function resaltarErrorHabilidad(campoId, mensaje) {
        const el = document.getElementById(campoId);
        if (!el) return;
        el.classList.add(\'border-red-400\', \'ring-2\', \'ring-red-300\');
        el.focus();
        setTimeout(() => el.classList.remove(\'border-red-400\', \'ring-2\', \'ring-red-300\'), 2500);

        const prev = el.parentElement.querySelector(\'.error-msg-hab\');
        if (prev) prev.remove();

        const msg = document.createElement(\'p\');
        msg.className = \'error-msg-hab text-xs text-red-500 mt-1\';
        msg.textContent = mensaje;
        el.parentElement.appendChild(msg);
        setTimeout(() => msg.remove(), 2500);
    }

    function recalcularStatsHabilidad() {
        const lista = document.getElementById(\'habilidades-lista\');
        if (!lista) return;

        const cards = lista.querySelectorAll(\'[data-habilidad-id]\');
        const total = cards.length;

        const categorias = new Set();
        cards.forEach(c => {
            const catId = c.getAttribute(\'data-categoria-id\');
            if (catId) categorias.add(catId);
        });

        const elTotal      = document.getElementById(\'stat-hab-total\');
        const elCategorias = document.getElementById(\'stat-hab-categorias\');
        if (elTotal)      elTotal.textContent      = total;
        if (elCategorias) elCategorias.textContent = categorias.size;

        const emptyState = document.getElementById(\'empty-state-hab\');
        if (emptyState) emptyState.classList.toggle(\'hidden\', total > 0);
        lista.classList.toggle(\'hidden\', total === 0);
    }

    function abrirModalHabilidad() {
        const form        = document.getElementById(\'formHabilidad\');
        const tituloModal = document.getElementById(\'titulo-modal-habilidad\');

        tituloModal.textContent = \'Registrar Habilidad\';
        form.reset();
        form.querySelector(\'[name="nombreHabilidad"]\').value = \'\';
        form.querySelector(\'[name="categoria"]\').value       = \'\';
        form.querySelector(\'[name="anosExperiencia"]\').value = \'\';
        form.querySelector(\'[name="descripcion"]\').value     = \'\';

        const methodInput = form.querySelector(\'input[name="_method"]\');
        if (methodInput) methodInput.remove();

        form.action = "{{ route(\'habilidades.store\') }}";

        document.getElementById(\'modal-habilidades\').classList.remove(\'hidden\');
        document.getElementById(\'modal-habilidades\').classList.add(\'flex\');
    }

    window.cerrarModalHabilidad = function () {
        document.getElementById(\'modal-habilidades\').classList.add(\'hidden\');
        document.getElementById(\'modal-habilidades\').classList.remove(\'flex\');
    };

    window.cerrarModalHabilidadFondo = function (event) {
        if (event.target.id === \'modal-habilidades\') confirmarCancelarHabilidad();
    };

    window.confirmarGuardarHabilidad = function () {
        const nombre      = document.getElementById(\'hab_nombre\').value.trim();
        const categoria   = document.getElementById(\'hab_categoria\').value;
        const anios       = document.getElementById(\'hab_anios\').value;
        const descripcion = document.getElementById(\'hab_descripcion\').value.trim();

        if (!nombre)      { resaltarErrorHabilidad(\'hab_nombre\',      \'El nombre es obligatorio.\');         return; }
        if (!categoria)   { resaltarErrorHabilidad(\'hab_categoria\',   \'La categoría es obligatoria.\');      return; }
        if (anios === \'\') { resaltarErrorHabilidad(\'hab_anios\',       \'Los años de experiencia son obligatorios.\'); return; }
        if (parseInt(anios)' => '(function () {

    const CONFIRM_CONFIG_HAB = {
        save: {
            title: \'Save skill?\',
            message: \'Your skill information will be stored. You can edit it at any time.\',
            icon: \'fas fa-save\',
            iconBg: \'bg-blue-50\',
            iconColor: \'text-blue-500\',
            btnClass: \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90\',
            action: () => submitSkill(),
        },
        cancel: {
            title: \'Discard changes?\',
            message: \'The data entered will not be saved. This action cannot be undone.\',
            icon: \'fas fa-times-circle\',
            iconBg: \'bg-red-50\',
            iconColor: \'text-red-500\',
            btnClass: \'bg-red-500 hover:bg-red-600\',
            action: () => closeSkillModal(),
        },
        remove: {
            title: \'Remove skill?\',
            message: \'This action is permanent and cannot be undone. The ability will be permanently removed.\',
            icon: \'fas fa-trash-alt\',
            iconBg: \'bg-red-50\',
            iconColor: \'text-red-500\',
            btnClass: \'bg-[#e11d48] hover:bg-red-600\',
            action: null,
        },
    };

    function showSkillConfirmation(type) {
        const cfg = CONFIRM_CONFIG_HAB[type];
        if (!cfg) return;
        window.confirm({
            title: cfg.title,
            message: cfg.message,
            icon: cfg.icon,
            iconBg: cfg.iconBg,
            iconColor: cfg.iconColor,
            btnClass: cfg.btnClass,
            onConfirm: cfg.action,
        });
    }
    window.showSkillConfirmation = showSkillConfirmation;

    function highlightSkillError(fieldId, message) {
        const el = document.getElementById(fieldId);
        if (!el) return;
        el.classList.add(\'border-red-400\', \'ring-2\', \'ring-red-300\');
        el.focus();
        setTimeout(() => el.classList.remove(\'border-red-400\', \'ring-2\', \'ring-red-300\'), 2500);

        const prev = el.parentElement.querySelector(\'.error-msg-hab\');
        if (prev) prev.remove();

        const msg = document.createElement(\'p\');
        msg.className = \'error-msg-hab text-xs text-red-500 mt-1\';
        msg.textContent = message;
        el.parentElement.appendChild(msg);
        setTimeout(() => msg.remove(), 2500);
    }

    function recalculateSkillStats() {
        const list = document.getElementById(\'skills-list\');
        if (!list) return;

        const cards = list.querySelectorAll(\'[data-skill-id]\');
        const total = cards.length;

        const categories = new Set();
        cards.forEach(c => {
            const catId = c.getAttribute(\'data-category-id\');
            if (catId) categories.add(catId);
        });

        const theTotal = document.getElementById(\'stat-hab-total\');
        const theCategories = document.getElementById(\'stat-hab-categories\');
        if (elTotal) elTotal.textContent = total;
        if (theCategories) theCategories.textContent = categories.size;

        const emptyState = document.getElementById(\'empty-state-hab\');
        if (emptyState) emptyState.classList.toggle(\'hidden\', total > 0);
        list.classList.toggle(\'hidden\', total === 0);
    }

    function openSkillModal() {
        const form = document.getElementById(\'formSkill\');
        const titleModal = document.getElementById(\'title-modal-skill\');

        titleModal.textContent = \'Register Skill\';
        form.reset();
        form.querySelector(\'[name="skillname"]\').value = \'\';
        form.querySelector(\'[name="category"]\').value = \'\';
        form.querySelector(\'[name="yearsExperience"]\').value = \'\';
        form.querySelector(\'[name="description"]\').value = \'\';

        const methodInput = form.querySelector(\'input[name="_method"]\');
        if (methodInput) methodInput.remove();

        form.action = "{{ route(\'skills.store\') }}";

        document.getElementById(\'modal-skills\').classList.remove(\'hidden\');
        document.getElementById(\'modal-skills\').classList.add(\'flex\');
    }

    window.closeModalSkill = function () {
        document.getElementById(\'modal-skills\').classList.add(\'hidden\');
        document.getElementById(\'modal-skills\').classList.remove(\'flex\');
    };

    window.closeBackgroundSkillModal = function (event) {
        if (event.target.id === \'modal-skills\') confirmCancelSkill();
    };

    window.confirmSaveSkill = function () {
        const name = document.getElementById(\'room_name\').value.trim();
        const category = document.getElementById(\'hab_categoria\').value;
        const anios = document.getElementById(\'hab_anios\').value;
        const description = document.getElementById(\'hab_descripcion\').value.trim();

        if (!name) { highlightSkillError(\'hab_name\', \'The name is required.\');         return; }
        if (!category) { highlightSkillError(\'hab_categoria\', \'The category is required.\');      return; }
        if (years === \'\') { highlightSkillError(\'years_experience\', \'Years of experience are required.\'); return; }
        if (parseInt(years)',
  '{
            document.getElementById(`delete-hab-${id}`).submit();
        };
        mostrarConfirmacionHabilidad(\'eliminar\');
    };

    document.querySelectorAll(\'.editar-habilidad\').forEach(btn => {
        btn.addEventListener(\'click\', () => {
            const id          = btn.getAttribute(\'data-id\');
            const nombre      = btn.getAttribute(\'data-nombre\');
            const categoria   = btn.getAttribute(\'data-categoria\');
            const experiencia = btn.getAttribute(\'data-experiencia\');
            const descripcion = btn.getAttribute(\'data-descripcion\');

            const form        = document.getElementById(\'formHabilidad\');
            const tituloModal = document.getElementById(\'titulo-modal-habilidad\');

            tituloModal.textContent = \'Editar Habilidad\';

            form.querySelector(\'[name="nombreHabilidad"]\').value = nombre;
            form.querySelector(\'[name="categoria"]\').value       = categoria;
            form.querySelector(\'[name="anosExperiencia"]\').value = experiencia;
            form.querySelector(\'[name="descripcion"]\').value     = descripcion;

            form.action = `/habilidades/${id}`;

            let methodInput = form.querySelector(\'input[name="_method"]\');
            if (methodInput) {
                methodInput.value = \'PUT\';
            } else {
                methodInput = document.createElement(\'input\');
                methodInput.setAttribute(\'type\', \'hidden\');
                methodInput.setAttribute(\'name\', \'_method\');
                methodInput.setAttribute(\'value\', \'PUT\');
                form.appendChild(methodInput);
            }

            document.getElementById(\'modal-habilidades\').classList.remove(\'hidden\');
            document.getElementById(\'modal-habilidades\').classList.add(\'flex\');
        });
    });

    const btnAgregar      = document.getElementById(\'agregar-habilidad-btn\');
    const btnAgregarEmpty = document.getElementById(\'agregar-habilidad-btn-empty\');

    if (btnAgregar)      btnAgregar.addEventListener(\'click\', abrirModalHabilidad);
    if (btnAgregarEmpty) btnAgregarEmpty.addEventListener(\'click\', abrirModalHabilidad);

})();' => '{
            document.getElementById(`delete-hab-${id}`).submit();
        };
        showSkillConfirmation(\'delete\');
    };

    document.querySelectorAll(\'.edit-skill\').forEach(btn => {
        btn.addEventListener(\'click\', () => {
            const id = btn.getAttribute(\'data-id\');
            const name = btn.getAttribute(\'data-name\');
            const category = btn.getAttribute(\'data-category\');
            const experience = btn.getAttribute(\'data-experience\');
            const description = btn.getAttribute(\'data-description\');

            const form = document.getElementById(\'formSkill\');
            const titleModal = document.getElementById(\'title-modal-skill\');

            titleModal.textContent = \'Edit Skill\';

            form.querySelector(\'[name="skillname"]\').value = name;
            form.querySelector(\'[name="category"]\').value = category;
            form.querySelector(\'[name="yearsExperience"]\').value = experience;
            form.querySelector(\'[name="description"]\').value = description;

            form.action = `/skills/${id}`;

            let methodInput = form.querySelector(\'input[name="_method"]\');
            if (methodInput) {
                methodInput.value = \'PUT\';
            } else {
                methodInput = document.createElement(\'input\');
                methodInput.setAttribute(\'type\', \'hidden\');
                methodInput.setAttribute(\'name\', \'_method\');
                methodInput.setAttribute(\'value\', \'PUT\');
                form.appendChild(methodInput);
            }

            document.getElementById(\'modal-skills\').classList.remove(\'hidden\');
            document.getElementById(\'modal-skills\').classList.add(\'flex\');
        });
    });

    const btnAdd = document.getElementById(\'add-skill-btn\');
    const btnAddEmpty = document.getElementById(\'add-skill-btn-empty\');

    if (btnAdd) btnAdd.addEventListener(\'click\', openSkillModal);
    if (btnAddEmpty) btnAddEmpty.addEventListener(\'click\', openSkillModal);

})();',
  'count();
    $categoriasHab = $habilidades->pluck(\'id_categoria\')->unique()->count();
    $promedioAnios = $totalHab > 0
        ? round($habilidades->avg(\'anios_experiencia\'), 1)
        : 0;
@endphp' => 'count();
    $categoriesHab = $skills->pluck(\'id_categoria\')->unique()->count();
    $averageyears = $totalHab > 0
        ? round($skills->avg(\'years_experience\'), 1)
        : 0;
@endphp',
  'Habilidades Técnicas' => 'Technical Skills',
  'Administra tus habilidades técnicas y controla lo que muestras al mundo' => 'Manage your technical skills and control what you show to the world',
  'Nueva Habilidad' => 'New Skill',
  'Todas las registradas' => 'All registered',
  'Categorías' => 'Categories',
  'Distintas áreas cubiertas' => 'Different areas covered',
  'Promedio Años' => 'Average Years',
  'Años de experiencia promedio' => 'Average years of experience',
  'isEmpty() ? \'\' : \'hidden\' }} bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">' => 'isEmpty() ? \'\' : \'hidden\' }} bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">',
  'No tienes habilidades técnicas registradas aún' => 'You do not have registered technical skills yet',
  'Comienza agregando tu primera habilidad técnica' => 'Start by adding your first technical skill',
  'Agregar primera habilidad' => 'Add first skill',
  'isEmpty() ? \'hidden\' : \'\' }}">
                @foreach($habilidades as $habilidad)' => 'isEmpty() ? \'hidden\' : \'\' }}">
                @foreach($skills as $skill)',
  'id_habilidad }}"
                     data-categoria-id="{{ $habilidad->id_categoria }}">' => 'skill_id }}"
                     data-category-id="{{ $skill->category_id }}">',
  'categoria->imagen ?? \'https://via.placeholder.com/100\' }}"
                             alt="{{ $habilidad->categoria->nombre }}"
                             class="h-14 w-14 rounded-full object-cover border-2 border-[#1e3a5f]/10">' => 'category->image?? \'https://via.placeholder.com/100\' }}"
                             alt="{{ $skill->category->name }}"
                             class="h-14 w-14 rounded-full object-cover border-2 border-[#1e3a5f]/10">',
  'id_habilidad }}"
                            data-nombre="{{ $habilidad->nombre }}"
                            data-categoria="{{ $habilidad->id_categoria }}"
                            data-experiencia="{{ $habilidad->anios_experiencia }}"
                            data-descripcion="{{ $habilidad->descripcion }}">' => 'skill_id }}"
                            data-name="{{ $skill->name }}"
                            data-category="{{ $skill->category_id }}"
                            data-experience="{{ $skill->years_experience }}"
                            data-description="{{ $skill->description }}">',
  'id_habilidad }}"
                              action="{{ route(\'habilidades.destroy\', $habilidad->id_habilidad) }}"
                              method="POST" class="flex-1">
                            @csrf
                            @method(\'DELETE\')' => 'skill_id }}"
                              action="{{ route(\'skills.destroy\', $skill->skill_id) }}"
                              method="POST" class="flex-1">
                            @csrf
                            @method(\'DELETE\')',
  'id_habilidad }})"
                                class="w-full flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">' => 'id_habilidad }})"
                                class="w-full flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">',
  'Habilidades Blandas' => 'Soft Skills',
  'Selecciona hasta 6 habilidades interpersonales para mostrar en tu perfil' => 'Select up to 6 soft skills to display on your profile',
  'Aún no agregaste habilidades blandas' => 'You haven\'t added soft skills yet',
  'Agrega habilidades interpersonales para completar tu perfil' => 'Add interpersonal skills to complete your profile',
  'Registrar Habilidad' => 'Register Skill',
  'Completa los detalles de tu habilidad' => 'Fill in the details of your skill',
  'Selecciona hasta 6 habilidades' => 'Select up to 6 skills',
  'id_habilidad_blanda }}"
                        data-nombre="{{ strtolower($habilidadBlanda->nombre) }}"
                        data-seleccionada="{{ $estaSeleccionada ? \'1\' : \'0\' }}"
                    >
                        {{ $habilidadBlanda->nombre }}' => 'soft_skill_id }}"
                        data-name="{{ strtolower($softskill->name) }}"
                        data-selected="{{ $isSelected ? \'1\' : \'0\' }}"
                    >
                        {{ $softskill->name }}',
  'no hay habilidades blandas activas disponibles' => 'no active soft skills available',
  'seleccionadas:' => 'selected:',
  '/ 6' => '/ 6',
  'solo puedes seleccionar hasta 6 habilidades' => 'you can only select up to 6 skills',
  'Guardar habilidades blandas' => 'Save soft skills',
  'let seleccionIds = @json($habilidadesBlandasSeleccionadas);
    let seleccionadas = seleccionIds.length;
    const max = 6;

    function abrirModalHabilidadesBlandas() {
        document.getElementById(\'modal-habilidades-blandas\').classList.remove(\'hidden\');
        document.getElementById(\'modal-habilidades-blandas\').classList.add(\'flex\');
    }

    function cerrarModalHabilidadesBlandas() {
        document.getElementById(\'modal-habilidades-blandas\').classList.add(\'hidden\');
        document.getElementById(\'modal-habilidades-blandas\').classList.remove(\'flex\');
    }

    function toggleHabilidad(btn) {
        const id = btn.getAttribute(\'data-id\');
        const mensajeLimite = document.getElementById(\'mensaje-limite\');
        const contadorWrapper = document.getElementById(\'contador-wrapper\');

        if (btn.classList.contains(\'bg-[#1e3a5f]\')) {
            btn.classList.remove(\'bg-[#1e3a5f]\', \'text-white\', \'border-[#1e3a5f]\');
            btn.classList.add(\'border-gray-300\', \'text-gray-700\');

            seleccionadas--;
            seleccionIds = seleccionIds.filter(i => i != id && i != parseInt(id));

            mensajeLimite.classList.add(\'hidden\');
            contadorWrapper.classList.remove(\'text-red-500\', \'font-bold\');

        } else {
            if (seleccionadas >= max) {
                mensajeLimite.classList.remove(\'hidden\');
                contadorWrapper.classList.add(\'text-red-500\', \'font-bold\');

                setTimeout(() => {
                    mensajeLimite.classList.add(\'hidden\');
                    contadorWrapper.classList.remove(\'text-red-500\', \'font-bold\');
                }, 2000);

                return;
            }

            btn.classList.add(\'bg-[#1e3a5f]\', \'text-white\', \'border-[#1e3a5f]\');
            btn.classList.remove(\'border-gray-300\', \'text-gray-700\');

            seleccionadas++;

            if (!seleccionIds.includes(id) && !seleccionIds.includes(parseInt(id))) {
                seleccionIds.push(id);
            }
        }

        document.getElementById(\'contador-habilidades\').innerText = seleccionadas;
    }

    function filtrarHabilidadesBlandas() {
        const texto = document.getElementById(\'buscar-habilidades-blandas\').value.toLowerCase();
        const items = document.querySelectorAll(\'.habilidad-blanda\');

        items.forEach(item => {
            const nombre = item.getAttribute(\'data-nombre\');
            item.style.display = nombre.includes(texto) ? \'inline-block\' : \'none\';
        });
    }

    function guardarHabilidadesBlandas() {
        fetch("{{ route(\'habilidades-blandas.guardar\') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: JSON.stringify({ habilidades: seleccionIds })
        })
        .then(res => res.json())
        .then(data => {
            if (data.ok) {
                cerrarModalHabilidadesBlandas();
                actualizarChipsBlandasEnVista();
                if (typeof window.notificarItemPublicable === \'function\') {
                    window.notificarItemPublicable(\'blanda\');
                }
            } else {
                alert(\'No se pudieron guardar las habilidades blandas.\');
            }
        })
        .catch(() => {
            alert(\'Ocurrió un error al guardar las habilidades blandas.\');
        });
    }

    function actualizarChipsBlandasEnVista() {
        const display = document.getElementById(\'chips-blandas-display\');
        if (!display) return;

        const seleccionados = [...document.querySelectorAll(\'.habilidad-blanda\')]
            .filter(btn => btn.classList.contains(\'bg-[#1e3a5f]\'));

        if (seleccionados.length === 0) {
            display.innerHTML = `' => 'let seleccionIds = @json($habilidadesBlandasSeleccionadas);
    let seleccionadas = seleccionIds.length;
    const max = 6;

    function abrirModalHabilidadesBlandas() {
        document.getElementById(\'modal-habilidades-blandas\').classList.remove(\'hidden\');
        document.getElementById(\'modal-habilidades-blandas\').classList.add(\'flex\');
    }

    function cerrarModalHabilidadesBlandas() {
        document.getElementById(\'modal-habilidades-blandas\').classList.add(\'hidden\');
        document.getElementById(\'modal-habilidades-blandas\').classList.remove(\'flex\');
    }

    function toggleHabilidad(btn) {
        const id = btn.getAttribute(\'data-id\');
        const mensajeLimite = document.getElementById(\'mensaje-limite\');
        const contadorWrapper = document.getElementById(\'contador-wrapper\');

        if (btn.classList.contains(\'bg-[#1e3a5f]\')) {
            btn.classList.remove(\'bg-[#1e3a5f]\', \'text-white\', \'border-[#1e3a5f]\');
            btn.classList.add(\'border-gray-300\', \'text-gray-700\');

            seleccionadas--;
            seleccionIds = seleccionIds.filter(i => i != id && i != parseInt(id));

            mensajeLimite.classList.add(\'hidden\');
            contadorWrapper.classList.remove(\'text-red-500\', \'font-bold\');

        } else {
            if (seleccionadas >= max) {
                mensajeLimite.classList.remove(\'hidden\');
                contadorWrapper.classList.add(\'text-red-500\', \'font-bold\');

                setTimeout(() => {
                    mensajeLimite.classList.add(\'hidden\');
                    contadorWrapper.classList.remove(\'text-red-500\', \'font-bold\');
                }, 2000);

                return;
            }

            btn.classList.add(\'bg-[#1e3a5f]\', \'text-white\', \'border-[#1e3a5f]\');
            btn.classList.remove(\'border-gray-300\', \'text-gray-700\');

            seleccionadas++;

            if (!seleccionIds.includes(id) && !seleccionIds.includes(parseInt(id))) {
                seleccionIds.push(id);
            }
        }

        document.getElementById(\'contador-habilidades\').innerText = seleccionadas;
    }

    function filtrarHabilidadesBlandas() {
        const texto = document.getElementById(\'buscar-habilidades-blandas\').value.toLowerCase();
        const items = document.querySelectorAll(\'.habilidad-blanda\');

        items.forEach(item => {
            const nombre = item.getAttribute(\'data-nombre\');
            item.style.display = nombre.includes(texto) ? \'inline-block\' : \'none\';
        });
    }

    function guardarHabilidadesBlandas() {
        fetch("{{ route(\'habilidades-blandas.guardar\') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: JSON.stringify({ habilidades: seleccionIds })
        })
        .then(res => res.json())
        .then(data => {
            if (data.ok) {
                cerrarModalHabilidadesBlandas();
                actualizarChipsBlandasEnVista();
                if (typeof window.notificarItemPublicable === \'function\') {
                    window.notificarItemPublicable(\'blanda\');
                }
            } else {
                alert(\'No se pudieron guardar las habilidades blandas.\');
            }
        })
        .catch(() => {
            alert(\'Ocurrió un error al guardar las habilidades blandas.\');
        });
    }

    function actualizarChipsBlandasEnVista() {
        const display = document.getElementById(\'chips-blandas-display\');
        if (!display) return;

        const seleccionados = [...document.querySelectorAll(\'.habilidad-blanda\')]
            .filter(btn => btn.classList.contains(\'bg-[#1e3a5f]\'));

        if (seleccionados.length === 0) {
            display.innerHTML = `',
  '`;
            return;
        }

        const chips = seleccionados.map(btn =>
            `' => '`;
            return;
        }

        const chips = selected.map(btn =>
            `',
  '${btn.textContent.trim()}' => '${btn.textContent.trim()}',
  '`
        ).join(\'\');

        display.innerHTML = `' => '`
        ).join(\'\');

        display.innerHTML = `',
  '${chips}' => '${chips}',
  '`;
    }

    document.getElementById(\'abrir-modal-habilidades-blandas\')?.addEventListener(\'click\', abrirModalHabilidadesBlandas);' => '`;
    }

    document.getElementById(\'abrir-modal-habilidades-blandas\')?.addEventListener(\'click\', abreModalHabilidadesBlandas);',
  'Buscar habilidades...' => 'Search skills...',
  'Portafolio Principal' => 'Main Portfolio',
  'Selecciona el contenido a publicar' => 'Select the content to publish',
  'Progreso' => 'Progress',
  'Seleccionados' => 'Selected',
  '0/0' => '0/0',
  'Publicar' => 'Post',
  'Seleccionar todas' => 'Select all',
  'Deseleccionar todas' => 'Deselect all',
  'Habilidad' => 'Ability',
  'Nivel' => 'Level',
  'No tienes elementos en esta sección' => 'You have no items in this section',
  'Agrégalos desde tu dashboard antes de publicar' => 'Add them from your dashboard before publishing',
  'Cargando contenido...' => 'Loading content...',
  'URL pública' => 'Public URL',
  'Vista previa' => 'Preview',
  'Copiar URL' => 'Copy URL',
  '(function () {
    const csrf = document.querySelector(\'meta[name="csrf-token"]\')?.content ?? \'\';

    const modal     = document.getElementById(\'modal-publicar\');
    const btnCerrar = document.getElementById(\'mp-cerrar\');
    const btnPublicar = document.getElementById(\'mp-publicar\');
    const tabsBtns  = modal.querySelectorAll(\'.mp-tab\');
    const listaBody = document.getElementById(\'mp-lista-body\');
    const listaHeader = document.getElementById(\'mp-lista-header\');
    const colNombre = document.getElementById(\'mp-col-nombre\');
    const colDetalle= document.getElementById(\'mp-col-detalle\');
    const vacio     = document.getElementById(\'mp-vacio\');
    const cargando  = document.getElementById(\'mp-cargando\');
    const titulo    = document.getElementById(\'mp-titulo-seccion\');
    const contador  = document.getElementById(\'mp-contador\');
    const progreso  = document.getElementById(\'mp-progreso\');
    const btnTodos  = document.getElementById(\'mp-todos\');
    const btnNinguno= document.getElementById(\'mp-ninguno\');
    const urlLink   = document.getElementById(\'mp-url\');
    const btnCopiar = document.getElementById(\'mp-copiar\');
    const btnVista  = document.getElementById(\'mp-vista-previa\');

    // Estado: { tecnicas:[{id,nombre,nivel,publicado}], blandas:[...], ... }
    let estado = {
        tecnicas: [], blandas: [], experiencia: [], educacion: [], proyectos: [],
    };
    let tabActual = \'todo\';

    const seccionesMeta = {
        tecnicas:    { titulo: \'Habilidades Técnicas\', col1: \'Habilidad\',  col2: \'Nivel\'    },
        blandas:     { titulo: \'Habilidades Blandas\',  col1: \'Habilidad\',  col2: \'\'         },
        experiencia: { titulo: \'Experiencia Laboral\',  col1: \'Cargo\',      col2: \'Empresa\'  },
        educacion:   { titulo: \'Formación Académica\',  col1: \'Título\',     col2: \'Detalle\'  },
        proyectos:   { titulo: \'Proyectos\',            col1: \'Proyecto\',   col2: \'Resumen\'  },
    };

    function nivelClase(nivel) {
        switch (nivel) {
            case \'Experto\':    return \'bg-[#e11d48]/10 text-[#e11d48]\';
            case \'Avanzado\':   return \'bg-[#1e3a5f]/10 text-[#1e3a5f]\';
            case \'Intermedio\': return \'bg-amber-100 text-amber-700\';
            default:           return \'bg-gray-100 text-gray-600\';
        }
    }

    window.abrirModalPublicar = async function () {
        modal.classList.remove(\'hidden\');
        document.body.style.overflow = \'hidden\';
        cargando.classList.remove(\'hidden\');
        listaBody.innerHTML = \'\';
        vacio.classList.add(\'hidden\');

        try {
            const res = await fetch(\'{{ route("cuenta.portafolio.datos") }}\', {
                headers: { \'Accept\': \'application/json\' },
                credentials: \'same-origin\'
            });
            const data = await res.json();
            if (!data.ok) throw new Error(data.message || \'Error\');

            estado = {
                tecnicas:    data.tecnicas    || [],
                blandas:     data.blandas     || [],
                experiencia: data.experiencia || [],
                educacion:   data.educacion   || [],
                proyectos:   data.proyectos   || [],
            };

            const baseUrl = window.location.origin;
            const slug = data.slug || \'\';
            urlLink.textContent = baseUrl + \'/\' + slug;
            urlLink.href = \'/\' + slug;

            actualizarConteos();
            mostrarTab(\'todo\');
        } catch (e) {
            cargando.classList.add(\'hidden\');
            listaBody.innerHTML = `' => '(function () {
    const csrf = document.querySelector(\'meta[name="csrf-token"]\')?.content ?? \'\';

    const modal     = document.getElementById(\'modal-publicar\');
    const btnCerrar = document.getElementById(\'mp-cerrar\');
    const btnPublicar = document.getElementById(\'mp-publicar\');
    const tabsBtns  = modal.querySelectorAll(\'.mp-tab\');
    const listaBody = document.getElementById(\'mp-lista-body\');
    const listaHeader = document.getElementById(\'mp-lista-header\');
    const colNombre = document.getElementById(\'mp-col-nombre\');
    const colDetalle= document.getElementById(\'mp-col-detalle\');
    const vacio     = document.getElementById(\'mp-vacio\');
    const cargando  = document.getElementById(\'mp-cargando\');
    const titulo    = document.getElementById(\'mp-titulo-seccion\');
    const contador  = document.getElementById(\'mp-contador\');
    const progreso  = document.getElementById(\'mp-progreso\');
    const btnTodos  = document.getElementById(\'mp-todos\');
    const btnNinguno= document.getElementById(\'mp-ninguno\');
    const urlLink   = document.getElementById(\'mp-url\');
    const btnCopiar = document.getElementById(\'mp-copiar\');
    const btnVista  = document.getElementById(\'mp-vista-previa\');

    // Estado: { tecnicas:[{id,nombre,nivel,publicado}], blandas:[...], ... }
    let estado = {
        tecnicas: [], blandas: [], experiencia: [], educacion: [], proyectos: [],
    };
    let tabActual = \'todo\';

    const seccionesMeta = {
        tecnicas:    { titulo: \'Habilidades Técnicas\', col1: \'Habilidad\',  col2: \'Nivel\'    },
        blandas:     { titulo: \'Habilidades Blandas\',  col1: \'Habilidad\',  col2: \'\'         },
        experiencia: { titulo: \'Experiencia Laboral\',  col1: \'Cargo\',      col2: \'Empresa\'  },
        educacion:   { titulo: \'Formación Académica\',  col1: \'Título\',     col2: \'Detalle\'  },
        proyectos:   { titulo: \'Proyectos\',            col1: \'Proyecto\',   col2: \'Resumen\'  },
    };

    function nivelClase(nivel) {
        switch (nivel) {
            case \'Experto\':    return \'bg-[#e11d48]/10 text-[#e11d48]\';
            case \'Avanzado\':   return \'bg-[#1e3a5f]/10 text-[#1e3a5f]\';
            case \'Intermedio\': return \'bg-amber-100 text-amber-700\';
            default:           return \'bg-gray-100 text-gray-600\';
        }
    }

    window.abrirModalPublicar = async function () {
        modal.classList.remove(\'hidden\');
        document.body.style.overflow = \'hidden\';
        cargando.classList.remove(\'hidden\');
        listaBody.innerHTML = \'\';
        vacio.classList.add(\'hidden\');

        try {
            const res = await fetch(\'{{ route("cuenta.portafolio.datos") }}\', {
                headers: { \'Accept\': \'application/json\' },
                credentials: \'same-origin\'
            });
            const data = await res.json();
            if (!data.ok) throw new Error(data.message || \'Error\');

            estado = {
                tecnicas:    data.tecnicas    || [],
                blandas:     data.blandas     || [],
                experiencia: data.experiencia || [],
                educacion:   data.educacion   || [],
                proyectos:   data.proyectos   || [],
            };

            const baseUrl = window.location.origin;
            const slug = data.slug || \'\';
            urlLink.textContent = baseUrl + \'/\' + slug;
            urlLink.href = \'/\' + slug;

            actualizarConteos();
            mostrarTab(\'todo\');
        } catch (e) {
            cargando.classList.add(\'hidden\');
            listaBody.innerHTML = `',
  'No se pudo cargar el contenido.' => 'The content could not be loaded.',
  '`;
        }
    };

    function cerrarModal() {
        modal.classList.add(\'hidden\');
        document.body.style.overflow = \'\';
    }
    btnCerrar.addEventListener(\'click\', cerrarModal);
    modal.addEventListener(\'click\', (e) => { if (e.target === modal) cerrarModal(); });

    function todasLasSecciones() {
        return [\'tecnicas\',\'blandas\',\'experiencia\',\'educacion\',\'proyectos\'];
    }

    function itemsDeTab(tab) {
        if (tab === \'todo\') {
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
        const todoBtn = modal.querySelector(\'[data-mp-tab="todo"] .mp-tab-count\');
        if (todoBtn) todoBtn.textContent = totalGlobal;

        contador.textContent = `${selGlobal}/${totalGlobal}`;
        const pct = totalGlobal === 0 ? 0 : Math.round((selGlobal / totalGlobal) * 100);
        progreso.textContent = pct + \'%\';
    }

    function mostrarTab(tab) {
        tabActual = tab;
        tabsBtns.forEach(b => {
            const activa = b.dataset.mpTab === tab;
            b.classList.toggle(\'text-[#1e3a5f]\', activa);
            b.classList.toggle(\'border-[#e11d48]\', activa);
            b.classList.toggle(\'font-semibold\', activa);
            b.classList.toggle(\'text-gray-500\', !activa);
        });

        const meta = tab === \'todo\'
            ? { titulo: \'Todo el contenido\', col1: \'Elemento\', col2: \'Sección\' }
            : seccionesMeta[tab];
        titulo.textContent = meta.titulo;
        colNombre.textContent = meta.col1;
        colDetalle.textContent = meta.col2;

        const items = itemsDeTab(tab);
        cargando.classList.add(\'hidden\');
        listaBody.innerHTML = \'\';
        if (items.length === 0) {
            vacio.classList.remove(\'hidden\');
            listaHeader.classList.add(\'hidden\');
            return;
        }
        vacio.classList.add(\'hidden\');
        listaHeader.classList.remove(\'hidden\');

        items.forEach(it => {
            const row = document.createElement(\'div\');
            row.className = \'mp-row grid grid-cols-[auto_1fr_auto] gap-3 items-center px-4 py-3 hover:bg-[#1e3a5f]/5 transition cursor-pointer\';
            row.dataset.seccion = it._seccion;
            row.dataset.id = it.id;

            const checked = it.publicado ? \'checked\' : \'\';
            let detalleHtml = \'\';
            if (tab === \'todo\') {
                const seccionLabel = {
                    tecnicas: \'Técnica\', blandas: \'Blanda\', experiencia: \'Experiencia\',
                    educacion: \'Educación\', proyectos: \'Proyecto\'
                }[it._seccion];
                detalleHtml = `' => '`;
        }
    };

    function closeModal() {
        modal.classList.add(\'hidden\');
        document.body.style.overflow = \'\';
    }
    btnClose.addEventListener(\'click\', closeModal);
    modal.addEventListener(\'click\', (e) => { if (e.target === modal) closeModal(); });

    function allSections() {
        return [\'techniques\',\'soft\',\'experience\',\'education\',\'projects\'];
    }

    function itemsDeTab(tab) {
        if (tab === \'todo\') {
            return allSections().flatMap(s => state[s].map(it => ({ ...it, _section: s })));
        }
        return state[tab].map(it => ({ ...it, _section: tab }));
    }

    function updateCounts() {
        letTotalGlobal = 0, cellGlobal = 0;
        allSections().forEach(s => {
            const t = state[s].length;
            const sel = state[s].filter(i => i.published).length;
            totalGlobal += t; cellGlobal += cell;
            const btn = modal.querySelector(`[data-mp-tab="${s}"] .mp-tab-count`);
            if (btn) btn.textContent = t;
        });
        const todoBtn = modal.querySelector(\'[data-mp-tab="todo"] .mp-tab-count\');
        if (todoBtn) todoBtn.textContent = totalGlobal;

        counter.textContent = `${selGlobal}/${totalGlobal}`;
        const pct = totalGlobal === 0 ? 0 : Math.round((cellGlobal / totalGlobal) * 100);
        progress.textContent = pct + \'%\';
    }

    function showTab(tab) {
        CurrentTab = tab;
        tabsBtns.forEach(b => {
            const active = b.dataset.mpTab === tab;
            b.classList.toggle(\'text-[#1e3a5f]\', active);
            b.classList.toggle(\'border-[#e11d48]\', active);
            b.classList.toggle(\'font-semibold\', active);
            b.classList.toggle(\'text-gray-500\', !active);
        });

        const meta = tab === \'all\'
            ? { title: \'All Content\', col1: \'Item\', col2: \'Section\' }
            : sectionsMeta[tab];
        title.textContent = meta.title;
        colName.textContent = meta.col1;
        colDetails.textContent = meta.col2;

        const items = itemsFromTab(tab);
        loading.classList.add(\'hidden\');
        listBody.innerHTML = \'\';
        if (items.length === 0) {
            vacio.classList.remove(\'hidden\');
            listHeader.classList.add(\'hidden\');
            return;
        }
        vacio.classList.add(\'hidden\');
        listHeader.classList.remove(\'hidden\');

        items.forEach(it => {
            const row = document.createElement(\'div\');
            row.className = \'mp-row grid grid-cols-[auto_1fr_auto] gap-3 items-center px-4 py-3 hover:bg-[#1e3a5f]/5 transition cursor-pointer\';
            row.dataset.section = it._section;
            row.dataset.id = it.id;

            const checked = it.published ? \'checked\' : \'\';
            let detailHtml = \'\';
            if (tab === \'todo\') {
                const sectionLabel = {
                    techniques: \'Technique\', soft: \'Soft\', experience: \'Experience\',
                    education: \'Education\', projects: \'Project\'
                }[it._section];
                detailsHtml = `',
  '${seccionLabel}' => '${sectionLabel}',
  '`;
            } else if (it._seccion === \'tecnicas\') {
                detalleHtml = `' => '`;
            } else if (it._section === \'techniques\') {
                detailHtml = `',
  '${it.nivel}' => '${it.nivel}',
  '`;
            } else if (it.detalle) {
                detalleHtml = `' => '`;
            } else if (it.detalle) {
                detalleHtml = `',
  '${it.detalle}' => '${the.detail}',
  '`;
            } else {
                detalleHtml = \'\';
            }

            row.innerHTML = `' => '`;
            } else {
                detalleHtml = \'\';
            }

            row.innerHTML = `',
  '${it.nombre ?? \'\'}' => '${it.name ?? \'\'}',
  '${detalleHtml}' => '${detailsHtml}',
  '`;
            listaBody.appendChild(row);
        });
    }

    listaBody.addEventListener(\'click\', (e) => {
        const row = e.target.closest(\'.mp-row\');
        if (!row) return;
        const seccion = row.dataset.seccion;
        const id = parseInt(row.dataset.id, 10);
        const item = estado[seccion].find(i => i.id === id);
        if (!item) return;
        item.publicado = !item.publicado;

        const box = row.querySelector(\'.mp-box\');
        const tick = box.querySelector(\'i\');
        if (item.publicado) {
            box.classList.add(\'bg-[#1e3a5f]\', \'border-[#1e3a5f]\');
            box.classList.remove(\'border-gray-300\', \'bg-white\');
            tick.classList.remove(\'hidden\');
        } else {
            box.classList.remove(\'bg-[#1e3a5f]\', \'border-[#1e3a5f]\');
            box.classList.add(\'border-gray-300\', \'bg-white\');
            tick.classList.add(\'hidden\');
        }
        actualizarConteos();
    });

    tabsBtns.forEach(b => b.addEventListener(\'click\', () => mostrarTab(b.dataset.mpTab)));

    btnTodos.addEventListener(\'click\', () => {
        const secciones = tabActual === \'todo\' ? todasLasSecciones() : [tabActual];
        secciones.forEach(s => estado[s].forEach(i => i.publicado = true));
        actualizarConteos();
        mostrarTab(tabActual);
    });
    btnNinguno.addEventListener(\'click\', () => {
        const secciones = tabActual === \'todo\' ? todasLasSecciones() : [tabActual];
        secciones.forEach(s => estado[s].forEach(i => i.publicado = false));
        actualizarConteos();
        mostrarTab(tabActual);
    });

    btnCopiar.addEventListener(\'click\', () => {
        navigator.clipboard.writeText(urlLink.textContent).then(() => {
            const i = btnCopiar.querySelector(\'i\');
            i.classList.replace(\'far\', \'fas\');
            i.classList.replace(\'fa-copy\', \'fa-check\');
            setTimeout(() => { i.classList.replace(\'fas\',\'far\'); i.classList.replace(\'fa-check\',\'fa-copy\'); }, 1200);
        });
    });

    btnVista.addEventListener(\'click\', () => {
        const payload = {};
        todasLasSecciones().forEach(s => {
            payload[s] = estado[s].filter(i => i.publicado).map(i => i.id);
        });

        const textoOriginal = btnVista.innerHTML;
        btnVista.disabled = true;
        btnVista.innerHTML = \'' => '`;
            listaBody.appendChild(row);
        });
    }

    listaBody.addEventListener(\'click\', (e) => {
        const row = e.target.closest(\'.mp-row\');
        if (!row) return;
        const seccion = row.dataset.seccion;
        const id = parseInt(row.dataset.id, 10);
        const item = estado[seccion].find(i => i.id === id);
        if (!item) return;
        item.publicado = !item.publicado;

        const box = row.querySelector(\'.mp-box\');
        const tick = box.querySelector(\'i\');
        if (item.publicado) {
            box.classList.add(\'bg-[#1e3a5f]\', \'border-[#1e3a5f]\');
            box.classList.remove(\'border-gray-300\', \'bg-white\');
            tick.classList.remove(\'hidden\');
        } else {
            box.classList.remove(\'bg-[#1e3a5f]\', \'border-[#1e3a5f]\');
            box.classList.add(\'border-gray-300\', \'bg-white\');
            tick.classList.add(\'hidden\');
        }
        actualizarConteos();
    });

    tabsBtns.forEach(b => b.addEventListener(\'click\', () => mostrarTab(b.dataset.mpTab)));

    btnTodos.addEventListener(\'click\', () => {
        const secciones = tabActual === \'todo\' ? todasLasSecciones() : [tabActual];
        secciones.forEach(s => estado[s].forEach(i => i.publicado = true));
        actualizarConteos();
        mostrarTab(tabActual);
    });
    btnNinguno.addEventListener(\'click\', () => {
        const secciones = tabActual === \'todo\' ? todasLasSecciones() : [tabActual];
        secciones.forEach(s => estado[s].forEach(i => i.publicado = false));
        actualizarConteos();
        mostrarTab(tabActual);
    });

    btnCopiar.addEventListener(\'click\', () => {
        navigator.clipboard.writeText(urlLink.textContent).then(() => {
            const i = btnCopiar.querySelector(\'i\');
            i.classList.replace(\'far\', \'fas\');
            i.classList.replace(\'fa-copy\', \'fa-check\');
            setTimeout(() => { i.classList.replace(\'fas\',\'far\'); i.classList.replace(\'fa-check\',\'fa-copy\'); }, 1200);
        });
    });

    btnVista.addEventListener(\'click\', () => {
        const payload = {};
        todasLasSecciones().forEach(s => {
            payload[s] = estado[s].filter(i => i.publicado).map(i => i.id);
        });

        const textoOriginal = btnVista.innerHTML;
        btnVista.disabled = true;
        btnVista.innerHTML = \'',
  'Cargando...\';

        fetch(\'{{ route("cuenta.portafolio.preview") }}\', {
            method: \'POST\',
            headers: { \'X-CSRF-TOKEN\': csrf, \'Content-Type\': \'application/json\', \'Accept\': \'application/json\' },
            credentials: \'same-origin\',
            body: JSON.stringify(payload)
        })
        .then(r => r.json())
        .then(res => {
            btnVista.disabled = false;
            btnVista.innerHTML = textoOriginal;
            if (!res.ok || !res.portafolio) {
                Swal.fire({ icon: \'error\', title: \'No se pudo cargar la vista previa\', text: res.message || \'\', confirmButtonColor: \'#1e3a5f\' });
                return;
            }
            if (typeof window.abrirModalPortafolio === \'function\') {
                window.abrirModalPortafolio({ data: res.portafolio, preview: true });
            }
        })
        .catch(() => {
            btnVista.disabled = false;
            btnVista.innerHTML = textoOriginal;
            Swal.fire({ icon: \'error\', title: \'Error de conexión\', text: \'No se pudo obtener la vista previa.\', confirmButtonColor: \'#1e3a5f\' });
        });
    });

    btnPublicar.addEventListener(\'click\', () => {
        const payload = {};
        todasLasSecciones().forEach(s => {
            payload[s] = estado[s].filter(i => i.publicado).map(i => i.id);
        });

        btnPublicar.disabled = true;
        btnPublicar.innerHTML = \'' => 'Cargando...\';

        fetch(\'{{ route("cuenta.portafolio.preview") }}\', {
            method: \'POST\',
            headers: { \'X-CSRF-TOKEN\': csrf, \'Content-Type\': \'application/json\', \'Accept\': \'application/json\' },
            credentials: \'same-origin\',
            body: JSON.stringify(payload)
        })
        .then(r => r.json())
        .then(res => {
            btnVista.disabled = false;
            btnVista.innerHTML = textoOriginal;
            if (!res.ok || !res.portafolio) {
                Swal.fire({ icon: \'error\', title: \'No se pudo cargar la vista previa\', text: res.message || \'\', confirmButtonColor: \'#1e3a5f\' });
                return;
            }
            if (typeof window.abrirModalPortafolio === \'function\') {
                window.abrirModalPortafolio({ data: res.portafolio, preview: true });
            }
        })
        .catch(() => {
            btnVista.disabled = false;
            btnVista.innerHTML = textoOriginal;
            Swal.fire({ icon: \'error\', title: \'Error de conexión\', text: \'No se pudo obtener la vista previa.\', confirmButtonColor: \'#1e3a5f\' });
        });
    });

    btnPublicar.addEventListener(\'click\', () => {
        const payload = {};
        todasLasSecciones().forEach(s => {
            payload[s] = estado[s].filter(i => i.publicado).map(i => i.id);
        });

        btnPublicar.disabled = true;
        btnPublicar.innerHTML = \'',
  'Publicando...\';

        fetch(\'{{ route("cuenta.portafolio.publicar") }}\', {
            method: \'PUT\',
            headers: { \'X-CSRF-TOKEN\': csrf, \'Content-Type\': \'application/json\', \'Accept\': \'application/json\' },
            credentials: \'same-origin\',
            body: JSON.stringify(payload)
        })
        .then(r => r.json())
        .then(res => {
            btnPublicar.disabled = false;
            btnPublicar.innerHTML = \'' => 'Publicando...\';

        fetch(\'{{ route("cuenta.portafolio.publicar") }}\', {
            method: \'PUT\',
            headers: { \'X-CSRF-TOKEN\': csrf, \'Content-Type\': \'application/json\', \'Accept\': \'application/json\' },
            credentials: \'same-origin\',
            body: JSON.stringify(payload)
        })
        .then(r => r.json())
        .then(res => {
            btnPublicar.disabled = false;
            btnPublicar.innerHTML = \'',
  'Publicar\';
            if (res.ok) {
                cerrarModal();
                if (typeof window.aplicarVisibilidadPublica === \'function\') {
                    window.aplicarVisibilidadPublica();
                }

                // Recalcular banner "elementos sin publicar"
                const aviso  = document.getElementById(\'aviso-sin-publicar\');
                const countEl = document.getElementById(\'aviso-sin-publicar-count\');
                if (aviso && countEl) {
                    const sinPublicar = todasLasSecciones()
                        .flatMap(s => estado[s])
                        .filter(it => !it.publicado).length;
                    countEl.textContent = sinPublicar;
                    if (sinPublicar > 0) {
                        aviso.classList.remove(\'hidden\');
                        aviso.classList.add(\'flex\');
                    } else {
                        aviso.classList.add(\'hidden\');
                        aviso.classList.remove(\'flex\');
                    }
                }
                Swal.fire({
                    icon: \'success\',
                    title: \'¡Portafolio publicado!\',
                    text: \'Tu perfil ahora es público con el contenido seleccionado.\',
                    confirmButtonColor: \'#1e3a5f\',
                    timer: 2200,
                    showConfirmButton: false
                });
            } else if (res.code === \'perfil_incompleto\') {
                Swal.fire({
                    icon: \'info\',
                    title: \'Tu perfil aún está vacío\',
                    html: `' => 'Publish\';
            if (res.ok) {
                closeModal();
                if (typeof window.aplicarVisibilidadPublica === \'function\') {
                    window.applyPublicVisibility();
                }

                // Recalculate banner "unpublished elements"
                const notice = document.getElementById(\'aviso-sin-publish\');
                const countEl = document.getElementById(\'aviso-sin-publicar-count\');
                if (warning && countEl) {
                    const sinPublicar = TodasLasSecciones()
                        .flatMap(s => state[s])
                        .filter(it => !it.published).length;
                    countEl.textContent = sinPublish;
                    if (sinPublish > 0) {
                        warning.classList.remove(\'hidden\');
                        notice.classList.add(\'flex\');
                    } else {
                        notice.classList.add(\'hidden\');
                        warning.classList.remove(\'flex\');
                    }
                }
                Swal.fire({
                    icon: \'success\',
                    title: \'¡Portafolio published!\',
                    text: \'Your profile is now public with selected content.\',
                    confirmButtonColor: \'#1e3a5f\',
                    timer: 2200,
                    showConfirmButton: false
                });
            } else if (res.code === \'incomplete_profile\') {
                Swal.fire({
                    icon: \'info\',
                    title: \'Your profile is still empty\',
                    html:`',
  'Para publicar tu portafolio, primero debes registrar al menos una de estas cosas:' => 'To publish your portfolio, you must first register at least one of these things:',
  'Una' => 'A',
  'biografía' => 'biography',
  'proyecto' => 'project',
  'experiencia laboral' => 'work experience',
  '`,
                    confirmButtonColor: \'#1e3a5f\',
                    confirmButtonText: \'Entendido\'
                });
            } else {
                Swal.fire({ icon: \'error\', title: \'Error\', text: res.message ?? \'No se pudo publicar.\', confirmButtonColor: \'#1e3a5f\' });
            }
        })
        .catch(() => {
            btnPublicar.disabled = false;
            btnPublicar.innerHTML = \'' => '`,
                    confirmButtonColor: \'#1e3a5f\',
                    confirmButtonText: \'Entendido\'
                });
            } else {
                Swal.fire({ icon: \'error\', title: \'Error\', text: res.message ?? \'No se pudo publicar.\', confirmButtonColor: \'#1e3a5f\' });
            }
        })
        .catch(() => {
            btnPublicar.disabled = false;
            btnPublicar.innerHTML = \'',
  'Publicar\';
            Swal.fire({ icon: \'error\', title: \'Error de conexión\', confirmButtonColor: \'#1e3a5f\' });
        });
    });
})();' => 'Post\';
            Swal.fire({ icon: \'error\', title: \'Connection error\', confirmButtonColor: \'#1e3a5f\' });
        });
    });
})();',
  'where(\'id_usuario\', $userId)->first();
    $visibilidad  = $perfilCuenta->visibilidad ?? \'publico\';

    $perfilIdCuenta = $perfilCuenta->id_perfil ?? null;
    $itemsSinPublicar = 0;
    if ($perfilIdCuenta) {
        $itemsSinPublicar += DB::table(\'proyectos\')->where(\'id_perfil\', $perfilIdCuenta)->where(\'visible\', false)->whereNull(\'deleted_at\')->count();
        $itemsSinPublicar += DB::table(\'habilidades\')->where(\'id_perfil\', $perfilIdCuenta)->where(\'publicado\', false)->whereNull(\'deleted_at\')->count();
        $itemsSinPublicar += DB::table(\'experiencia_laboral\')->where(\'id_perfil\', $perfilIdCuenta)->where(\'publicado\', false)->whereNull(\'deleted_at\')->count();
        $itemsSinPublicar += DB::table(\'formacion_academica\')->where(\'id_perfil\', $perfilIdCuenta)->where(\'publicado\', false)->whereNull(\'deleted_at\')->count();
        $itemsSinPublicar += DB::table(\'perfil_habilidad_blanda\')->where(\'id_perfil\', $perfilIdCuenta)->where(\'publicado\', false)->count();
    }
@endphp

{{-- Separador visual --}}' => 'where(\'user_id\', $userId)->first();
    $visibility = $accountprofile->visibility ?? \'public\';

    $profileAccountId = $profileaccount->profile_id ?? null;
    $itemsUnPublished = 0;
    if ($profileAccountId) {
        $itemsUnPublished += DB::table(\'projects\')->where(\'profile_id\', $perfilIdCuenta)->where(\'visible\', false)->whereNull(\'deleted_at\')->count();
        $itemsUnPublished += DB::table(\'skills\')->where(\'profile_id\', $profileIdAccount)->where(\'published\', false)->whereNull(\'deleted_at\')->count();
        $itemsUnPublished += DB::table(\'work_experience\')->where(\'profile_id\', $profileIdAccount)->where(\'published\', false)->whereNull(\'deleted_at\')->count();
        $itemsUnPublished += DB::table(\'academic_formation\')->where(\'profile_id\', $perfilIdCuenta)->where(\'published\', false)->whereNull(\'deleted_at\')->count();
        $itemsUnPublished += DB::table(\'soft_skill_profile\')->where(\'profile_id\', $accountIdprofile)->where(\'published\', false)->count();
    }
@endphp

{{-- Visual separator --}}',
  'Configuración de cuenta' => 'Account Settings',
  'Cambiar contraseña' => 'Change password',
  'Usa una contraseña segura que no uses en otros sitios' => 'Use a strong password that you don\'t use on other sites',
  'Contraseña actual' => 'Current password',
  'Nueva contraseña' => 'New password',
  'Confirmar nueva contraseña' => 'Confirm new password',
  'Mínimo 8 caracteres, una mayúscula, un número y un símbolo.' => 'Minimum 8 characters, a capital letter, a number and a symbol.',
  'Visibilidad del perfil' => 'Profile Visibility',
  'Controla quién puede ver tu portafolio' => 'Control who can see your portfolio',
  '0) ? \'flex\' : \'hidden\' }} mt-4 items-center gap-3 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3">' => '0) ? \'flex\' : \'hidden\' }} mt-4 items-center gap-3 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3">',
  'Tienes' => 'Have',
  'elemento(s) sin publicar' => 'unpublished item(s)',
  'Actualiza tu publicación para mostrarlos en tu portafolio público.' => 'Update your post to show them in your public portfolio.',
  'Actualizar publicación' => 'Update post',
  'Zona de peligro' => 'danger zone',
  'Acción sensible sobre tu cuenta' => 'Sensitive action on your account',
  'Perderás el acceso a tu cuenta y tu portafolio dejará de ser visible. Tus datos se conservan, pero no podrás volver a iniciar sesión.' => 'You will lose access to your account and your portfolio will no longer be visible. Your data is retained, but you will not be able to log in again.',
  '(function () {
    const csrf = document.querySelector(\'meta[name="csrf-token"]\')?.content ?? \'\';

    // ── Ver / ocultar contraseña ───────────────────────────────────────────
    window.togglePasswordVisibility = function (btn) {
        const input = btn.closest(\'.relative\').querySelector(\'input\');
        const icon  = btn.querySelector(\'i\');
        const mostrar = input.type === \'password\';
        input.type = mostrar ? \'text\' : \'password\';
        icon.classList.toggle(\'fa-eye\',       !mostrar);
        icon.classList.toggle(\'fa-eye-slash\',  mostrar);
    };

    // ── Cambiar contraseña ─────────────────────────────────────────────────
    window.confirmarCambiarContrasenia = function () {
        const form         = document.getElementById(\'form-contrasenia\');
        const actual       = form.querySelector(\'[name="contrasenia_actual"]\').value;
        const nueva        = form.querySelector(\'[name="nueva_contrasenia"]\').value;
        const confirmacion = form.querySelector(\'[name="nueva_contrasenia_confirmation"]\').value;

        if (!actual || !nueva || !confirmacion) {
            Swal.fire({ icon: \'warning\', title: \'Campos requeridos\', text: \'Completa todos los campos de contraseña.\', confirmButtonColor: \'#1e3a5f\' });
            return;
        }

        Swal.fire({
            title: \'¿Cambiar contraseña?\',
            text: \'Tu contraseña actual quedará invalidada.\',
            icon: \'question\',
            showCancelButton: true,
            confirmButtonColor: \'#1e3a5f\',
            cancelButtonColor: \'#6b7280\',
            confirmButtonText: \'Sí, cambiar\',
            cancelButtonText: \'Cancelar\'
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch(\'{{ route("cuenta.contrasenia") }}\', {
                method: \'PUT\',
                headers: { \'X-CSRF-TOKEN\': csrf, \'Content-Type\': \'application/json\', \'Accept\': \'application/json\' },
                body: JSON.stringify({ contrasenia_actual: actual, nueva_contrasenia: nueva, nueva_contrasenia_confirmation: confirmacion })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    form.reset();
                    Swal.fire({ icon: \'success\', title: \'¡Contraseña cambiada!\', text: \'Tu contraseña fue actualizada correctamente.\', confirmButtonColor: \'#1e3a5f\' });
                } else {
                    const msgs = res.errors
                        ? Object.values(res.errors).flat().join(\'\\n\')
                        : (res.message ?? \'Error al cambiar la contraseña.\');
                    Swal.fire({ icon: \'error\', title: \'Error\', text: msgs, confirmButtonColor: \'#1e3a5f\' });
                }
            })
            .catch(() => Swal.fire({ icon: \'error\', title: \'Error de conexión\', text: \'No se pudo conectar al servidor.\', confirmButtonColor: \'#1e3a5f\' }));
        });
    };

    // ── Aplicar UI público ─────────────────────────────────────────────────
    window.aplicarVisibilidadPublica = function () {
        const btn   = document.getElementById(\'btn-visibilidad\');
        const dot   = document.getElementById(\'toggle-dot\');
        const label = document.getElementById(\'label-visibilidad\');
        const desc  = document.getElementById(\'desc-visibilidad\');
        const badge = document.getElementById(\'badge-visibilidad\');
        btn.dataset.actual = \'publico\';
        btn.classList.replace(\'bg-gray-300\', \'bg-[#1e3a5f]\');
        dot.classList.replace(\'translate-x-1\', \'translate-x-8\');
        label.textContent = \'Perfil público\';
        desc.textContent  = \'Cualquier persona puede ver tu portafolio\';
        badge.className   = \'inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-[#1e3a5f]/10 text-[#1e3a5f]\';
        badge.innerHTML   = \'' => '(function () {
    const csrf = document.querySelector(\'meta[name="csrf-token"]\')?.content ?? \'\';

    // ── Ver / ocultar contraseña ───────────────────────────────────────────
    window.togglePasswordVisibility = function (btn) {
        const input = btn.closest(\'.relative\').querySelector(\'input\');
        const icon  = btn.querySelector(\'i\');
        const mostrar = input.type === \'password\';
        input.type = mostrar ? \'text\' : \'password\';
        icon.classList.toggle(\'fa-eye\',       !mostrar);
        icon.classList.toggle(\'fa-eye-slash\',  mostrar);
    };

    // ── Cambiar contraseña ─────────────────────────────────────────────────
    window.confirmarCambiarContrasenia = function () {
        const form         = document.getElementById(\'form-contrasenia\');
        const actual       = form.querySelector(\'[name="contrasenia_actual"]\').value;
        const nueva        = form.querySelector(\'[name="nueva_contrasenia"]\').value;
        const confirmacion = form.querySelector(\'[name="nueva_contrasenia_confirmation"]\').value;

        if (!actual || !nueva || !confirmacion) {
            Swal.fire({ icon: \'warning\', title: \'Campos requeridos\', text: \'Completa todos los campos de contraseña.\', confirmButtonColor: \'#1e3a5f\' });
            return;
        }

        Swal.fire({
            title: \'¿Cambiar contraseña?\',
            text: \'Tu contraseña actual quedará invalidada.\',
            icon: \'question\',
            showCancelButton: true,
            confirmButtonColor: \'#1e3a5f\',
            cancelButtonColor: \'#6b7280\',
            confirmButtonText: \'Sí, cambiar\',
            cancelButtonText: \'Cancelar\'
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch(\'{{ route("cuenta.contrasenia") }}\', {
                method: \'PUT\',
                headers: { \'X-CSRF-TOKEN\': csrf, \'Content-Type\': \'application/json\', \'Accept\': \'application/json\' },
                body: JSON.stringify({ contrasenia_actual: actual, nueva_contrasenia: nueva, nueva_contrasenia_confirmation: confirmacion })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    form.reset();
                    Swal.fire({ icon: \'success\', title: \'¡Contraseña cambiada!\', text: \'Tu contraseña fue actualizada correctamente.\', confirmButtonColor: \'#1e3a5f\' });
                } else {
                    const msgs = res.errors
                        ? Object.values(res.errors).flat().join(\'\\n\')
                        : (res.message ?? \'Error al cambiar la contraseña.\');
                    Swal.fire({ icon: \'error\', title: \'Error\', text: msgs, confirmButtonColor: \'#1e3a5f\' });
                }
            })
            .catch(() => Swal.fire({ icon: \'error\', title: \'Error de conexión\', text: \'No se pudo conectar al servidor.\', confirmButtonColor: \'#1e3a5f\' }));
        });
    };

    // ── Aplicar UI público ─────────────────────────────────────────────────
    window.aplicarVisibilidadPublica = function () {
        const btn   = document.getElementById(\'btn-visibilidad\');
        const dot   = document.getElementById(\'toggle-dot\');
        const label = document.getElementById(\'label-visibilidad\');
        const desc  = document.getElementById(\'desc-visibilidad\');
        const badge = document.getElementById(\'badge-visibilidad\');
        btn.dataset.actual = \'publico\';
        btn.classList.replace(\'bg-gray-300\', \'bg-[#1e3a5f]\');
        dot.classList.replace(\'translate-x-1\', \'translate-x-8\');
        label.textContent = \'Perfil público\';
        desc.textContent  = \'Cualquier persona puede ver tu portafolio\';
        badge.className   = \'inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-[#1e3a5f]/10 text-[#1e3a5f]\';
        badge.innerHTML   = \'',
  'Público\';
        window.PERFIL_VISIBILIDAD = \'publico\';
    };

    // ── Editar publicación (re-abrir modal cuando ya está público) ─────────
    window.editarPublicacion = function () {
        if (typeof window.abrirModalPublicar === \'function\') {
            window.abrirModalPublicar();
        }
    };

    // ── Visibilidad ────────────────────────────────────────────────────────
    window.confirmarCambiarVisibilidad = function () {
        const btn    = document.getElementById(\'btn-visibilidad\');
        const actual = btn.dataset.actual;

        // Si ya está público, ofrecer editar publicación o pasar a privado
        if (actual === \'publico\') {
            Swal.fire({
                title: \'Tu portafolio está público\',
                text:  \'¿Qué deseas hacer?\',
                icon:  \'question\',
                showCancelButton: true,
                showDenyButton:   true,
                confirmButtonColor: \'#1e3a5f\',
                denyButtonColor:    \'#e11d48\',
                cancelButtonColor:  \'#6b7280\',
                confirmButtonText:  \'Editar publicación\',
                denyButtonText:     \'Hacer privado\',
                cancelButtonText:   \'Cancelar\'
            }).then(result => {
                if (result.isConfirmed) {
                    window.editarPublicacion();
                } else if (result.isDenied) {
                    cambiarVisibilidadAPrivado();
                }
            });
            return;
        }

        // Si está privado: abrir modal de publicación (flujo existente)
        if (typeof window.abrirModalPublicar === \'function\') {
            window.abrirModalPublicar();
        }
    };

    // Pasar a privado (extraído del flujo original)
    function cambiarVisibilidadAPrivado() {
        const btn = document.getElementById(\'btn-visibilidad\');
        Swal.fire({
            title: \'¿Hacer perfil privado?\',
            text: \'Solo tú podrás ver tu portafolio.\',
            icon: \'question\',
            showCancelButton: true,
            confirmButtonColor: \'#1e3a5f\',
            cancelButtonColor: \'#6b7280\',
            confirmButtonText: \'Sí, hacer privado\',
            cancelButtonText: \'Cancelar\'
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch(\'{{ route("cuenta.visibilidad") }}\', {
                method: \'PUT\',
                headers: { \'X-CSRF-TOKEN\': csrf, \'Content-Type\': \'application/json\', \'Accept\': \'application/json\' },
                body: JSON.stringify({ visibilidad: \'privado\' })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    const dot   = document.getElementById(\'toggle-dot\');
                    const label = document.getElementById(\'label-visibilidad\');
                    const desc  = document.getElementById(\'desc-visibilidad\');
                    const badge = document.getElementById(\'badge-visibilidad\');
                    btn.dataset.actual = \'privado\';
                    btn.classList.replace(\'bg-[#1e3a5f]\', \'bg-gray-300\');
                    dot.classList.replace(\'translate-x-8\', \'translate-x-1\');
                    label.textContent = \'Perfil privado\';
                    desc.textContent  = \'Solo tú puedes ver tu portafolio\';
                    badge.className   = \'inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-500\';
                    badge.innerHTML   = \'' => 'Public\';
        window.PROFILE_VISIBILITY = \'public\';
    };

    // ── Edit post (re-open modal when already public) ─────────
    window.editPost = function () {
        if (typeof window.openModalPublish === \'function\') {
            window.openModalPublish();
        }
    };

    // ── Visibility ──────────────────────────── ────────────────────────────
    window.confirmChangeVisibility = function () {
        const btn = document.getElementById(\'btn-visibility\');
        const current = btn.dataset.current;

        // If it\'s already public, offer to edit post or make it private
        if (current === \'public\') {
            Swal.fire({
                title: \'Your portfolio is public\',
                text: \'What do you want to do?\',
                icon: \'question\',
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonColor: \'#1e3a5f\',
                denyButtonColor: \'#e11d48\',
                cancelButtonColor: \'#6b7280\',
                confirmButtonText: \'Edit Post\',
                denyButtonText: \'Make private\',
                cancelButtonText: \'Cancel\'
            }).then(result => {
                if (result.isConfirmed) {
                    window.editPost();
                } else if (result.isDenied) {
                    changePrivateVisibility();
                }
            });
            return;
        }

        // If private: open post modal (existing flow)
        if (typeof window.openModalPublish === \'function\') {
            window.openModalPublish();
        }
    };

    // Go private (extracted from original stream)
    function changeVisibilityAPrivate() {
        const btn = document.getElementById(\'btn-visibility\');
        Swal.fire({
            title: \'Make profile private?\',
            text: \'Only you will be able to see your portfolio.\',
            icon: \'question\',
            showCancelButton: true,
            confirmButtonColor: \'#1e3a5f\',
            cancelButtonColor: \'#6b7280\',
            confirmButtonText: \'Yes, make private\',
            cancelButtonText: \'Cancel\'
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch(\'{{ route("account.visibility") }}\', {
                method: \'PUT\',
                headers: { \'X-CSRF-TOKEN\': csrf, \'Content-Type\': \'application/json\', \'Accept\': \'application/json\' },
                body: JSON.stringify({ visibility: \'private\' })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    const dot = document.getElementById(\'toggle-dot\');
                    const label = document.getElementById(\'label-visibility\');
                    const desc = document.getElementById(\'desc-visibility\');
                    const badge = document.getElementById(\'badge-visibility\');
                    btn.dataset.current = \'private\';
                    btn.classList.replace(\'bg-[#1e3a5f]\', \'bg-gray-300\');
                    dot.classList.replace(\'translate-x-8\', \'translate-x-1\');
                    label.textContent = \'Private Profile\';
                    desc.textContent = \'Only you can see your portfolio\';
                    badge.className = \'inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-500\';
                    badge.innerHTML = \'',
  'Privado\';
                    window.PERFIL_VISIBILIDAD = \'privado\';

                    Swal.fire({ icon: \'success\', title: \'¡Listo!\', text: \'Tu perfil ahora es privado.\', confirmButtonColor: \'#1e3a5f\', timer: 2000, showConfirmButton: false });
                } else {
                    Swal.fire({ icon: \'error\', title: \'Error\', text: res.message ?? \'No se pudo cambiar la visibilidad.\', confirmButtonColor: \'#1e3a5f\' });
                }
            })
            .catch(() => Swal.fire({ icon: \'error\', title: \'Error de conexión\', text: \'No se pudo conectar al servidor.\', confirmButtonColor: \'#1e3a5f\' }));
        });
    }

    // ── Desactivar cuenta ──────────────────────────────────────────────────
    window.confirmarDesactivarCuenta = function () {
        Swal.fire({
            title: \'¿Desactivar tu cuenta?\',
            html: `' => 'Private\';
                    window.PROFILE_VISIBILITY = \'private\';

                    Swal.fire({ icon: \'success\', title: \'Done!\', text: \'Your profile is now private.\', confirmButtonColor: \'#1e3a5f\', timer: 2000, showConfirmButton: false });
                } else {
                    Swal.fire({ icon: \'error\', title: \'Error\', text: res.message ?? \'Could not change visibility.\', confirmButtonColor: \'#1e3a5f\' });
                }
            })
            .catch(() => Swal.fire({ icon: \'error\', title: \'Connection error\', text: \'Could not connect to the server.\', confirmButtonColor: \'#1e3a5f\' }));
        });
    }

    // ── Deactivate account ───────────────────────── ─────────────────────────
    window.confirmDeactivateAccount = function () {
        Swal.fire({
            title: \'Deactivate your account?\',
            html:`',
  'Tu cuenta quedará' => 'Your account will be',
  'inactiva' => 'inactive',
  'no podrás volver a iniciar sesión' => 'you will not be able to log in again',
  '. Tus datos se conservan, pero el acceso queda bloqueado.' => '. Your data is preserved, but access is blocked.',
  'Ingresa tu' => 'Enter your',
  'contraseña actual' => 'current password',
  'para confirmar:' => 'to confirm:',
  '`,
            icon: \'warning\',
            showCancelButton: true,
            confirmButtonColor: \'#e11d48\',
            cancelButtonColor: \'#6b7280\',
            confirmButtonText: \'Desactivar cuenta\',
            cancelButtonText: \'Cancelar\',
            preConfirm: () => {
                const val = document.getElementById(\'swal-confirmar-desactivar\').value;
                if (!val) {
                    Swal.showValidationMessage(\'Debes ingresar tu contraseña para confirmar\');
                    return false;
                }
                return val;
            }
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch(\'{{ route("cuenta.desactivar") }}\', {
                method: \'PUT\',
                headers: { \'X-CSRF-TOKEN\': csrf, \'Content-Type\': \'application/json\', \'Accept\': \'application/json\' },
                body: JSON.stringify({ contrasenia: result.value })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    Swal.fire({
                        icon: \'success\',
                        title: \'Cuenta desactivada\',
                        text: \'Tu cuenta ha sido desactivada. Serás redirigido.\',
                        confirmButtonColor: \'#1e3a5f\',
                        timer: 2500,
                        showConfirmButton: false
                    }).then(() => { window.location.href = res.redirect ?? \'/\'; });
                } else {
                    Swal.fire({ icon: \'error\', title: \'Error\', text: res.message ?? \'No se pudo desactivar la cuenta.\', confirmButtonColor: \'#1e3a5f\' });
                }
            })
            .catch(() => Swal.fire({ icon: \'error\', title: \'Error de conexión\', text: \'No se pudo conectar al servidor.\', confirmButtonColor: \'#1e3a5f\' }));
        });
    };
})();' => '`,
            icon: \'warning\',
            showCancelButton: true,
            confirmButtonColor: \'#e11d48\',
            cancelButtonColor: \'#6b7280\',
            confirmButtonText: \'Desactivar cuenta\',
            cancelButtonText: \'Cancelar\',
            preConfirm: () => {
                const val = document.getElementById(\'swal-confirmar-desactivar\').value;
                if (!val) {
                    Swal.showValidationMessage(\'Debes ingresar tu contraseña para confirmar\');
                    return false;
                }
                return val;
            }
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch(\'{{ route("cuenta.desactivar") }}\', {
                method: \'PUT\',
                headers: { \'X-CSRF-TOKEN\': csrf, \'Content-Type\': \'application/json\', \'Accept\': \'application/json\' },
                body: JSON.stringify({ contrasenia: result.value })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    Swal.fire({
                        icon: \'success\',
                        title: \'Cuenta desactivada\',
                        text: \'Tu cuenta ha sido desactivada. Serás redirigido.\',
                        confirmButtonColor: \'#1e3a5f\',
                        timer: 2500,
                        showConfirmButton: false
                    }).then(() => { window.location.href = res.redirect ?? \'/\'; });
                } else {
                    Swal.fire({ icon: \'error\', title: \'Error\', text: res.message ?? \'No se pudo desactivar la cuenta.\', confirmButtonColor: \'#1e3a5f\' });
                }
            })
            .catch(() => Swal.fire({ icon: \'error\', title: \'Error de conexión\', text: \'No se pudo conectar al servidor.\', confirmButtonColor: \'#1e3a5f\' }));
        });
    };
})();',
  '••••••••' => '••••••••',
  'where(\'id_usuario\', $userId)->first();
    $perfilIdExp = $perfilExp->id_perfil ?? null;

    $experiencias = $perfilIdExp
        ? DB::table(\'experiencia_laboral\')
              ->where(\'id_perfil\', $perfilIdExp)
              ->whereNull(\'deleted_at\')
              ->orderBy(\'fecha_ini\', \'desc\')
              ->get()
        : collect();

    // Proyectos vinculados a experiencias de este perfil, agrupados por id_experiencia
    $proyectosPorExp = $perfilIdExp
        ? DB::table(\'proyectos\')
              ->where(\'id_perfil\', $perfilIdExp)
              ->whereNotNull(\'id_experiencia\')
              ->whereNull(\'deleted_at\')
              ->get()
              ->groupBy(\'id_experiencia\')
        : collect();

    // Todos los proyectos del usuario (para selector de "vincular proyecto existente")
    $proyectosUsuario = $perfilIdExp
        ? DB::table(\'proyectos\')
              ->where(\'id_perfil\', $perfilIdExp)
              ->whereNull(\'deleted_at\')
              ->orderBy(\'nombre\')
              ->get([\'id_proyecto\', \'nombre\', \'id_experiencia\'])
        : collect();

    $totalExp      = $experiencias->count();
    $actualesExp   = $experiencias->where(\'trabajo_actual\', 1)->count();
    $finalizadasExp = $experiencias->where(\'trabajo_actual\', 0)->count();
@endphp' => 'where(\'user_id\', $userId)->first();
    $profileIdExp = $profileExp->profile_id ?? null;

    $experiences = $profileIdExp
        ? DB::table(\'work_experience\')
              ->where(\'profile_id\', $profileIdExp)
              ->whereNull(\'deleted_at\')
              ->orderBy(\'ini_date\', \'desc\')
              ->get()
        : collect();

    // Projects linked to experiences of this profile, grouped by experience_id
    $projectsByExp = $profileIdExp
        ? DB::table(\'projects\')
              ->where(\'profile_id\', $profileIdExp)
              ->whereNotNull(\'experience_id\')
              ->whereNull(\'deleted_at\')
              ->get()
              ->groupBy(\'experience_id\')
        : collect();

    // All user projects (for "link existing project" selector)
    $userprojects = $expIdprofile
        ? DB::table(\'projects\')
              ->where(\'profile_id\', $profileIdExp)
              ->whereNull(\'deleted_at\')
              ->orderBy(\'name\')
              ->get([\'project_id\', \'name\', \'experience_id\'])
        : collect();

    $totalExp = $experiences->count();
    $currentExp = $experiences->where(\'current_job\', 1)->count();
    $completedExp = $experiences->where(\'current_job\', 0)->count();
@endphp',
  'Administra tu historial profesional y controla lo que muestras al mundo' => 'Manage your professional history and control what you show to the world',
  'Nueva Experiencia' => 'New Experience',
  'Total Experiencias' => 'Total Experiences',
  'Trabajo Actual' => 'Current Job',
  'Posición activa' => 'Active position',
  'Finalizadas' => 'Finished',
  'Experiencias completadas' => 'Completed experiences',
  'No tienes experiencias registradas aún' => 'You have no registered experiences yet',
  'Comienza agregando tu primera experiencia laboral' => 'Start adding your first work experience',
  'Agregar primera experiencia' => 'Add first experience',
  'isEmpty() ? \'hidden\' : \'\' }}">
            @foreach($experiencias as $exp)
            @php
                $esActual = (bool) $exp->trabajo_actual;
                $badgeClass = $esActual ? \'bg-[#1e3a5f]/10 text-[#1e3a5f]\' : \'bg-gray-100 text-gray-600\';
                $badgeLabel = $esActual ? \'actual\' : \'finalizada\';
            @endphp' => 'isEmpty() ? \'hidden\' : \'\' }}">
            @foreach($experiencias as $exp)
            @php
                $esActual = (bool) $exp->trabajo_actual;
                $badgeClass = $esActual ? \'bg-[#1e3a5f]/10 text-[#1e3a5f]\' : \'bg-gray-100 text-gray-600\';
                $badgeLabel = $esActual ? \'actual\' : \'finalizada\';
            @endphp',
  'id_experiencia }}"
                 data-trabajo-actual="{{ $esActual ? \'1\' : \'0\' }}">

                {{-- Cargo + badge --}}' => 'experience_id }}"
                 current-job-data="{{ $isCurrent ? \'1\' : \'0\' }}">

                {{-- Position + badge --}}',
  'Actualidad' => 'Present',
  'Referencias' => 'References',
  'Proyectos relacionados' => 'Related projects',
  'id_experiencia }}">
                        @foreach($proyectosExp as $proy)' => 'experience_id }}">
                        @foreach($projectsExp as $proy)',
  'id_proyecto }}); return false;"
                           class="flex items-center gap-1.5 text-xs text-[#1e3a5f] hover:text-[#e11d48] transition-colors group">' => 'id_proyecto }}); return false;"
                           class="flex items-center gap-1.5 text-xs text-[#1e3a5f] hover:text-[#e11d48] transition-colors group">',
  'id_experiencia }}">' => 'experience_id }}">',
  'id_experiencia }})"
                        class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">' => 'id_experiencia }})"
                        class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">',
  'where(\'id_usuario\', $userId)->first();
    $perfilIdEdu = $perfilEdu->id_perfil ?? null;

    $educaciones = $perfilIdEdu
        ? DB::table(\'formacion_academica\')
              ->where(\'id_perfil\', $perfilIdEdu)
              ->whereNull(\'deleted_at\')
              ->orderBy(\'fecha_ini\', \'desc\')
              ->get()
        : collect();

    $totalEdu      = $educaciones->count();
    $enCursoEdu    = $educaciones->whereNull(\'fecha_fin\')->count();
    $completadasEdu = $educaciones->whereNotNull(\'fecha_fin\')->count();
@endphp' => 'where(\'user_id\', $userId)->first();
    $perfilIdEdu = $perfilEdu->profile_id ?? null;

    $educations = $profileIdEdu
        ? DB::table(\'academic_training\')
              ->where(\'profile_id\', $perfilIdEdu)
              ->whereNull(\'deleted_at\')
              ->orderBy(\'ini_date\', \'desc\')
              ->get()
        : collect();

    $totalEdu = $educations->count();
    $enCursoEdu = $educaciones->whereNull(\'end_date\')->count();
    $completedEdu = $educations->whereNotNull(\'end_date\')->count();
@endphp',
  'Administra tu historial educativo y controla lo que muestras al mundo' => 'Manage your educational history and control what you show to the world',
  'Nueva Formación' => 'New Training',
  'Total Formaciones' => 'Total Training',
  'En Curso' => 'In Progress',
  'Actualmente estudiando' => 'Currently studying',
  'Completadas' => 'Completed',
  'Formaciones finalizadas' => 'Completed training',
  'No tienes formaciones registradas aún' => 'You do not have registered training yet',
  'Comienza agregando tu primera formación académica' => 'Start adding your first academic training',
  'Agregar primera formación' => 'Add first training',
  'isEmpty() ? \'hidden\' : \'\' }}">
            @foreach($educaciones as $edu)
            @php
                $enCurso = is_null($edu->fecha_fin);
                $nivelColors = [
                    \'Técnico\'    => \'bg-orange-100 text-orange-700\',
                    \'Tecnólogo\'  => \'bg-yellow-100 text-yellow-700\',
                    \'Pregrado\'   => \'bg-blue-100 text-blue-700\',
                    \'Posgrado\'   => \'bg-indigo-100 text-indigo-700\',
                    \'Maestría\'   => \'bg-purple-100 text-purple-700\',
                    \'Doctorado\'  => \'bg-pink-100 text-pink-700\',
                    \'Diplomado\'  => \'bg-teal-100 text-teal-700\',
                    \'Curso\'      => \'bg-gray-100 text-gray-600\',
                ];
                $nivelClass = $nivelColors[$edu->nivel] ?? \'bg-blue-100 text-blue-700\';
            @endphp' => 'isEmpty() ? \'hidden\' : \'\' }}">
            @foreach($educations as $edu)
            @php
                $inCourse = is_null($edu->end_date);
                $levelColors = [
                    \'Technical\' => \'bg-orange-100 text-orange-700\',
                    \'Technologist\' => \'bg-yellow-100 text-yellow-700\',
                    \'Undergraduate\' => \'bg-blue-100 text-blue-700\',
                    \'Postgraduate\' => \'bg-indigo-100 text-indigo-700\',
                    \'Mastery\' => \'bg-purple-100 text-purple-700\',
                    \'Doctorate\' => \'bg-pink-100 text-pink-700\',
                    \'Diplomated\' => \'bg-teal-100 text-teal-700\',
                    \'Course\' => \'bg-gray-100 text-gray-600\',
                ];
                $levelClass = $levelColors[$edu->level] ?? \'bg-blue-100 text-blue-700\';
            @endphp',
  'id_formacion }}"
                 data-en-curso="{{ $enCurso ? \'1\' : \'0\' }}">

                {{-- Título + nivel --}}' => 'training_id }}"
                 data-in-progress="{{ $inProgress ? \'1\' : \'0\' }}">

                {{-- Title + level --}}',
  'En curso' => 'In progress',
  'id_formacion }})"
                        class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">' => 'id_formacion }})"
                        class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">',
  '// ============================================================
// VARIABLES GLOBALES
// ============================================================
let educacionEditandoId = null;

// ============================================================
// CONFIGURACIÓN DE CONFIRMACIÓN
// ============================================================
const CONFIRM_CONFIG_EDUCACION = {
    guardar: {
        titulo:    \'¿Guardar formación?\',
        mensaje:   \'Se almacenará la información de tu formación académica. Podrás editarla en cualquier momento.\',
        icon:      \'fas fa-save\',
        iconBg:    \'bg-blue-50\',
        iconColor: \'text-blue-500\',
        btnClass:  \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90\',
        accion:    () => submitEducacion(),
    },
    cancelar: {
        titulo:    \'¿Descartar cambios?\',
        mensaje:   \'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.\',
        icon:      \'fas fa-times-circle\',
        iconBg:    \'bg-red-50\',
        iconColor: \'text-red-500\',
        btnClass:  \'bg-red-500 hover:bg-red-600\',
        accion:    () => cerrarModalEducacion(),
    },
    eliminar: {
        titulo:    \'¿Eliminar formación?\',
        mensaje:   \'Esta acción es permanente y no se puede deshacer. La formación será eliminada definitivamente.\',
        icon:      \'fas fa-trash-alt\',
        iconBg:    \'bg-red-50\',
        iconColor: \'text-red-500\',
        btnClass:  \'bg-[#e11d48] hover:bg-red-600\',
        accion:    null,
    },
};

// ============================================================
// MODAL DE CONFIRMACIÓN (delega al modal global de layouts.app)
// ============================================================
function mostrarConfirmacionEducacion(tipo) {
    const cfg = CONFIRM_CONFIG_EDUCACION[tipo];
    if (!cfg) return;
    window.confirmar({
        titulo:    cfg.titulo,
        mensaje:   cfg.mensaje,
        icon:      cfg.icon,
        iconBg:    cfg.iconBg,
        iconColor: cfg.iconColor,
        btnClass:  cfg.btnClass,
        onConfirm: cfg.accion,
    });
}

// ============================================================
// HELPER: RESALTAR ERROR
// ============================================================
function resaltarErrorEducacion(campoId, mensaje) {
    const el = document.getElementById(campoId);
    if (!el) return;
    el.classList.add(\'border-red-400\', \'ring-2\', \'ring-red-300\');
    el.focus();
    setTimeout(() => el.classList.remove(\'border-red-400\', \'ring-2\', \'ring-red-300\'), 2500);

    const prev = el.parentElement.querySelector(\'.error-msg-edu\');
    if (prev) prev.remove();

    const msg = document.createElement(\'p\');
    msg.className = \'error-msg-edu text-xs text-red-500 mt-1\';
    msg.textContent = mensaje;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ============================================================
// RECALCULAR ESTADÍSTICAS Y ESTADO VACÍO
// ============================================================
function recalcularStatsEducacion() {
    const lista = document.getElementById(\'educaciones-lista\');
    if (!lista) return;

    const cards      = lista.querySelectorAll(\'[data-formacion-id]\');
    const total      = cards.length;
    const enCurso    = lista.querySelectorAll(\'[data-en-curso="1"]\').length;
    const completadas = total - enCurso;

    const elTotal      = document.getElementById(\'stat-edu-total\');
    const elEnCurso    = document.getElementById(\'stat-edu-en-curso\');
    const elCompletada = document.getElementById(\'stat-edu-completada\');
    if (elTotal)      elTotal.textContent      = total;
    if (elEnCurso)    elEnCurso.textContent    = enCurso;
    if (elCompletada) elCompletada.textContent = completadas;

    const emptyState = document.getElementById(\'empty-state-edu\');
    if (emptyState) emptyState.classList.toggle(\'hidden\', total > 0);
    lista.classList.toggle(\'hidden\', total === 0);
}

// ============================================================
// CONFIRMAR GUARDAR (VALIDACIONES)
// ============================================================
function confirmarGuardarEducacion() {
    const titulo      = document.getElementById(\'edu_titulo\').value.trim();
    const institucion = document.getElementById(\'edu_institucion\').value.trim();
    const nivel       = document.getElementById(\'edu_nivel\').value;
    const fechaIni    = document.getElementById(\'edu_fecha_ini\').value;
    const fechaFin    = document.getElementById(\'edu_fecha_fin\').value;
    const enCurso     = document.getElementById(\'edu_en_curso\').checked;

    if (!titulo)      { resaltarErrorEducacion(\'edu_titulo\',      \'El título es obligatorio.\');       return; }
    if (!institucion) { resaltarErrorEducacion(\'edu_institucion\', \'La institución es obligatoria.\');  return; }
    if (!nivel)       { resaltarErrorEducacion(\'edu_nivel\',       \'El nivel es obligatorio.\');        return; }
    if (!fechaIni)    { resaltarErrorEducacion(\'edu_fecha_ini\',   \'La fecha de inicio es obligatoria.\'); return; }

    if (!enCurso && !fechaFin) {
        resaltarErrorEducacion(\'edu_fecha_fin\', \'Si no está en curso, indica la fecha de finalización.\');
        return;
    }
    if (!enCurso && fechaFin && fechaFin' => '// ==============================================================
// GLOBAL VARIABLES
// ==============================================================
let educationEditingId = null;

// ==============================================================
// CONFIRMATION SETUP
// ==============================================================
const CONFIRM_EDUCATION_CONFIG = {
    save: {
        title: \'Save training?\',
        message: \'The information about your academic training will be stored. You can edit it at any time.\',
        icon: \'fas fa-save\',
        iconBg: \'bg-blue-50\',
        iconColor: \'text-blue-500\',
        btnClass: \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90\',
        action: () => submitEducation(),
    },
    cancel: {
        title: \'Discard changes?\',
        message: \'The data entered will not be saved. This action cannot be undone.\',
        icon: \'fas fa-times-circle\',
        iconBg: \'bg-red-50\',
        iconColor: \'text-red-500\',
        btnClass: \'bg-red-500 hover:bg-red-600\',
        action: () => closeModalEducation(),
    },
    remove: {
        title: \'Delete formation?\',
        message: \'This action is permanent and cannot be undone. The formation will be definitively eliminated.\',
        icon: \'fas fa-trash-alt\',
        iconBg: \'bg-red-50\',
        iconColor: \'text-red-500\',
        btnClass: \'bg-[#e11d48] hover:bg-red-600\',
        action: null,
    },
};

// ==============================================================
// CONFIRMATION MODAL (delegates to layouts.app global modal)
// ==============================================================
function showEducationConfirmation(type) {
    const cfg = CONFIRM_CONFIG_EDUCACION[type];
    if (!cfg) return;
    window.confirm({
        title: cfg.title,
        message: cfg.message,
        icon: cfg.icon,
        iconBg: cfg.iconBg,
        iconColor: cfg.iconColor,
        btnClass: cfg.btnClass,
        onConfirm: cfg.action,
    });
}

// ==============================================================
// HELPER: HIGHLIGHT ERROR
// ==============================================================
function highlightErrorEducation(fieldId, message) {
    const el = document.getElementById(fieldId);
    if (!el) return;
    el.classList.add(\'border-red-400\', \'ring-2\', \'ring-red-300\');
    el.focus();
    setTimeout(() => el.classList.remove(\'border-red-400\', \'ring-2\', \'ring-red-300\'), 2500);

    const prev = el.parentElement.querySelector(\'.error-msg-edu\');
    if (prev) prev.remove();

    const msg = document.createElement(\'p\');
    msg.className = \'error-msg-edu text-xs text-red-500 mt-1\';
    msg.textContent = message;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ==============================================================
// RECOMPULATE STATISTICS AND EMPTY STATUS
// ==============================================================
function recalculateEducationStats() {
    const list = document.getElementById(\'educations-list\');
    if (!list) return;

    const cards = list.querySelectorAll(\'[data-training-id]\');
    const total = cards.length;
    const inCourse = list.querySelectorAll(\'[data-in-course="1"]\').length;
    const completed = total - inCourse;

    const theTotal = document.getElementById(\'stat-edu-total\');
    const elInCurso = document.getElementById(\'stat-edu-in-course\');
    const theCompleted = document.getElementById(\'stat-edu-completed\');
    if (elTotal) elTotal.textContent = total;
    if (elEnCurso) elEnCurso.textContent = enCurso;
    if (theCompleted) theCompleted.textContent = completed;

    const emptyState = document.getElementById(\'empty-state-edu\');
    if (emptyState) emptyState.classList.toggle(\'hidden\', total > 0);
    list.classList.toggle(\'hidden\', total === 0);
}

// ==============================================================
// CONFIRM SAVE (VALIDATIONS)
// ==============================================================
function confirmSaveEducation() {
    const title = document.getElementById(\'edu_title\').value.trim();
    const institution = document.getElementById(\'edu_institucion\').value.trim();
    const level = document.getElementById(\'edu_level\').value;
    const dateIni = document.getElementById(\'edu_date_ini\').value;
    const enddate = document.getElementById(\'edu_end_date\').value;
    const inCourse = document.getElementById(\'edu_in_course\').checked;

    if (!titulo) { highlightErrorEducacion(\'edu_titulo\', \'The title is required.\');       return; }
    if (!institucion) { highlightErrorEducacion(\'edu_institucion\', \'The institution is mandatory.\');  return; }
    if (!level) { highlightErrorEducation(\'edu_level\', \'The level is required.\');        return; }
    if (!fechaIni) { highlightErrorEducacion(\'edu_fecha_ini\', \'The start date is required.\'); return; }

    if (!inCourse && !EndDate) {
        highlightErrorEducacion(\'edu_fecha_end\', \'If not in progress, indicates the end date.\');
        return;
    }
    if (!inCourse && EndDate && EndDate',
  '\';
    } else {
        const d = new Date(educacion.fecha_fin + \'T12:00:00\');
        fechaFinStr = `${meses[d.getMonth()]} ${d.getFullYear()}`;
    }

    const nivelColors = {
        \'Técnico\':   \'bg-orange-100 text-orange-700\',
        \'Tecnólogo\': \'bg-yellow-100 text-yellow-700\',
        \'Pregrado\':  \'bg-blue-100 text-blue-700\',
        \'Posgrado\':  \'bg-indigo-100 text-indigo-700\',
        \'Maestría\':  \'bg-purple-100 text-purple-700\',
        \'Doctorado\': \'bg-pink-100 text-pink-700\',
        \'Diplomado\': \'bg-teal-100 text-teal-700\',
        \'Curso\':     \'bg-gray-100 text-gray-600\',
    };
    const nivelClass = nivelColors[educacion.nivel] ?? \'bg-blue-100 text-blue-700\';

    const titulo      = escapeHtmlEdu(educacion.titulo      || \'\');
    const institucion = escapeHtmlEdu(educacion.institucion || \'\');
    const nivel       = escapeHtmlEdu(educacion.nivel       || \'\');
    const descripcion = escapeHtmlEdu(educacion.descripcion || \'\');

    const eduJson = JSON.stringify(educacion).replace(/\\\\/g, \'\\\\\\\\\').replace(/\'/g, "\\\\\'");

    return `' => '\';
    } else {
        const d = new Date(education.end_date + \'T12:00:00\');
        dateFinStr = `${months[d.getMonth()]} ${d.getFullYear()}`;
    }

    const levelColors = {
        \'Technical\': \'bg-orange-100 text-orange-700\',
        \'Technologist\': \'bg-yellow-100 text-yellow-700\',
        \'Undergraduate\': \'bg-blue-100 text-blue-700\',
        \'Postgraduate\': \'bg-indigo-100 text-indigo-700\',
        \'Mastery\': \'bg-purple-100 text-purple-700\',
        \'PhD\': \'bg-pink-100 text-pink-700\',
        \'Diploma\': \'bg-teal-100 text-teal-700\',
        \'Course\': \'bg-gray-100 text-gray-600\',
    };
    const levelClass = levelColors[education.level] ?? \'bg-blue-100 text-blue-700\';

    const title = escapeHtmlEdu(education.title || \'\');
    const institution = escapeHtmlEdu(education.institution || \'\');
    const level = escapeHtmlEdu(education.level || \'\');
    const description = escapeHtmlEdu(education.description || \'\');

    const eduJson = JSON.stringify(education).replace(/\\\\/g, \'\\\\\\\\\').replace(/\'/g, "\\\\\'");

    return `',
  '${titulo}' => '${title}',
  '${nivel}' => '${level}',
  '${institucion}' => '${institution}',
  '${fechaInicioStr} – ${fechaFinStr}' => '${fechaInicioStr} – ${fechaFinStr}',
  '${descripcion ? `' => '${description ? `',
  '${descripcion}' => '${description}',
  '`;
}

// ============================================================
// TOAST
// ============================================================
function mostrarToastEdu(mensaje, tipo = \'success\') {
    let container = document.getElementById(\'toastContainer\');
    if (!container) {
        container = document.createElement(\'div\');
        container.id = \'toastContainer\';
        container.className = \'fixed bottom-4 right-4 z-[70] space-y-2\';
        document.body.appendChild(container);
    }
    const toast = document.createElement(\'div\');
    const bg    = tipo === \'success\' ? \'bg-green-500\' : \'bg-red-500\';
    const ico   = tipo === \'success\' ? \'fa-check-circle\' : \'fa-exclamation-circle\';
    toast.className = `${bg} text-white px-6 py-3 rounded-lg shadow-lg text-sm flex items-center gap-2`;
    toast.innerHTML = `' => '`;
}

// ============================================================
// TOAST
// ============================================================
function mostrarToastEdu(mensaje, tipo = \'success\') {
    let container = document.getElementById(\'toastContainer\');
    if (!container) {
        container = document.createElement(\'div\');
        container.id = \'toastContainer\';
        container.className = \'fixed bottom-4 right-4 z-[70] space-y-2\';
        document.body.appendChild(container);
    }
    const toast = document.createElement(\'div\');
    const bg    = tipo === \'success\' ? \'bg-green-500\' : \'bg-red-500\';
    const ico   = tipo === \'success\' ? \'fa-check-circle\' : \'fa-exclamation-circle\';
    toast.className = `${bg} text-white px-6 py-3 rounded-lg shadow-lg text-sm flex items-center gap-2`;
    toast.innerHTML = `',
  '${mensaje}' => '${message}',
  '`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity    = \'0\';
        toast.style.transform  = \'translateX(100%)\';
        toast.style.transition = \'all 0.3s ease\';
        setTimeout(() => { toast.remove(); if (!container.children.length) container.remove(); }, 300);
    }, 3000);
}

// ============================================================
// SUBMIT FORMULARIO (GUARDAR)
// ============================================================
function submitEducacion() {
    const btnGuardar = document.querySelector(\'#modalEducacion button[onclick="confirmarGuardarEducacion()"]\');
    const textoOriginal = btnGuardar.innerHTML;
    btnGuardar.disabled = true;
    btnGuardar.innerHTML = \'' => '`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity    = \'0\';
        toast.style.transform  = \'translateX(100%)\';
        toast.style.transition = \'all 0.3s ease\';
        setTimeout(() => { toast.remove(); if (!container.children.length) container.remove(); }, 300);
    }, 3000);
}

// ============================================================
// SUBMIT FORMULARIO (GUARDAR)
// ============================================================
function submitEducacion() {
    const btnGuardar = document.querySelector(\'#modalEducacion button[onclick="confirmarGuardarEducacion()"]\');
    const textoOriginal = btnGuardar.innerHTML;
    btnGuardar.disabled = true;
    btnGuardar.innerHTML = \'',
  'Guardando...\';

    const enCurso = document.getElementById(\'edu_en_curso\').checked;
    const data = {
        titulo:      document.getElementById(\'edu_titulo\').value,
        institucion: document.getElementById(\'edu_institucion\').value,
        nivel:       document.getElementById(\'edu_nivel\').value,
        fecha_ini:   document.getElementById(\'edu_fecha_ini\').value,
        fecha_fin:   enCurso ? null : document.getElementById(\'edu_fecha_fin\').value,
        descripcion: document.getElementById(\'edu_descripcion\').value,
        en_curso:    enCurso ? 1 : 0,
    };

    const url    = educacionEditandoId ? `/perfil/educacion/${educacionEditandoId}` : \'/perfil/educacion\';
    const method = educacionEditandoId ? \'PUT\' : \'POST\';

    fetch(url, {
        method,
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
        body: JSON.stringify(data),
    })
    .then(r => {
        if (r.status === 422) {
            return r.json().then(err => {
                const msgs = err.errors ? Object.values(err.errors).flat() : [err.message ?? \'Error de validación\'];
                resaltarErrorEducacion(\'edu_titulo\', msgs[0]);
                throw new Error(\'validation\');
            });
        }
        return r.json();
    })
    .then(res => {
        if (res.success) {
            const edu      = res.educacion;
            const lista    = document.getElementById(\'educaciones-lista\');
            const cardHTML = buildCardHTMLEducacion(edu);

            if (educacionEditandoId) {
                const existing = lista?.querySelector(`[data-formacion-id="${edu.id_formacion}"]`);
                if (existing) existing.outerHTML = cardHTML;
            } else {
                lista?.insertAdjacentHTML(\'afterbegin\', cardHTML);
                if (typeof window.notificarItemPublicable === \'function\') {
                    window.notificarItemPublicable(\'educacion\');
                }
            }

            recalcularStatsEducacion();
            cerrarModalEducacion();
            mostrarToastEdu(\'Formación guardada correctamente\', \'success\');
        } else {
            mostrarToastEdu(res.error || \'Error al guardar\', \'error\');
        }
    })
    .catch(err => {
        if (err.message !== \'validation\') {
            console.error(err);
            mostrarToastEdu(\'Hubo un problema al guardar\', \'error\');
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
    mostrarConfirmacionEducacion(\'eliminar\');
}

function ejecutarEliminarEducacion(id) {
    fetch(`/perfil/educacion/${id}`, {
        method: \'DELETE\',
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const card = document.querySelector(`[data-formacion-id="${id}"]`);
            if (card) card.remove();
            recalcularStatsEducacion();
            mostrarToastEdu(\'Formación eliminada correctamente\', \'success\');
        } else {
            mostrarToastEdu(res.error || \'Error al eliminar\', \'error\');
        }
    });
}' => 'Looking...\';

    const enCurso = document.getElementById(\'edu_en_curso\').checked;
    const data = {
        title: document.getElementById(\'edu_title\').value,
        institution: document.getElementById(\'edu_institution\').value,
        level: document.getElementById(\'edu_level\').value,
        date_this: document.getElementById(\'edu_date_this\').value,
        end_date: inProgress ? null : document.getElementById(\'edu_date_end\').value,
        description: document.getElementById(\'edu_description\').value,
        in_current: current ? 1 : 0,
    };

    const url = educationEditingId ? `/profile/education/${educationEditingId}` : \'/profile/education\';
    const method = educationEditingId ? \'PUT\' : \'POST\';

    fetch(url, {
        method,
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
        body: JSON.stringify(data),
    })
    .then(r => {
        if (r.status === 422) {
            return r.json().then(err => {
                const msgs = err.errors ? Object.values(err.errors).flat() : [err.message ?? \'Validation Error\'];
                highlightErrorEducation(\'edu_title\', msgs[0]);
                throw new Error(\'validation\');
            });
        }
        return r.json();
    })
    .then(res => {
        if (res.success) {
            const edu = res.education;
            const list = document.getElementById(\'educaciones-list\');
            const cardHTML = buildCardHTMLEducation(edu);

            if (educationEditingId) {
                const existing = list?.querySelector(`[data-training-id="${edu.training_id}"]`);
                if (existing) existing.outerHTML = cardHTML;
            } else {
                list?.insertAdjacentHTML(\'afterbegin\', cardHTML);
                if (typeof window.notifyItemPublishable === \'function\') {
                    window.notifyPublishableItem(\'education\');
                }
            }

            recalculateStatsEducation();
            closeEducationModal();
            showToastEdu(\'Correctly saved training\', \'success\');
        } else {
            showToastEdu(res.error || \'Error on saving\', \'error\');
        }
    })
    .catch(err => {
        if (err.message !== \'validation\') {
            console.error(err);
            showToastEdu(\'There was a problem saving\', \'error\');
        }
    })
    .finally(() => {
        btnGuardar.disabled = false;
        btnGuardar.innerHTML = textOriginal;
    });
}

// ============================================================
// DELETE
// ============================================================
function confirmDeleteEducation(id) {
    CONFIRM_CONFIG_EDUCATION.delete.action = () => executeDeleteEducation(id);
    showEducationConfirmation(\'delete\');
}

function executeDeleteEducation(id) {
    fetch(`/profile/education/${id}`, {
        method: \'DELETE\',
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const card = document.querySelector(`[data-training-id="${id}"]`);
            if (card) card.remove();
            recalculateStatsEducation();
            showToastEdu(\'Training deleted correctly\', \'success\');
        } else {
            showToastEdu(res.error || \'Error on deleting\', \'error\');
        }
    });
}',
  '// ============================================================
// VARIABLES GLOBALES
// ============================================================
let experienciaEditandoId = null;
const EXP_USER_ID = {{ $userId ?? \'null\' }};

// Lista de proyectos del usuario: [{id_proyecto, nombre, id_experiencia}, ...]
window.PROYECTOS_USUARIO_LIST = @json(($proyectosUsuario ?? collect())->values());

// Mantener PROYECTOS_USUARIO_LIST en sync con cambios desde Mis Proyectos
window.syncProyectoEnListaExp = function(action, proyecto) {
    if (!proyecto) return;
    window.PROYECTOS_USUARIO_LIST = window.PROYECTOS_USUARIO_LIST || [];
    const id = Number(proyecto.id_proyecto ?? proyecto);
    const idx = window.PROYECTOS_USUARIO_LIST.findIndex(p => Number(p.id_proyecto) === id);

    if (action === \'delete\') {
        if (idx !== -1) window.PROYECTOS_USUARIO_LIST.splice(idx, 1);
        return;
    }

    const entry = {
        id_proyecto:    id,
        nombre:         proyecto.nombre,
        id_experiencia: proyecto.id_experiencia ?? null,
    };
    if (idx === -1) window.PROYECTOS_USUARIO_LIST.push(entry);
    else            window.PROYECTOS_USUARIO_LIST[idx] = entry;
};


// ============================================================
// CONFIGURACIÓN DE CONFIRMACIÓN
// ============================================================
const CONFIRM_CONFIG_EXPERIENCIA = {
    guardar: {
        titulo:      \'¿Guardar experiencia?\',
        mensaje:     \'Se almacenará la información de tu experiencia laboral. Podrás editarla en cualquier momento.\',
        icon:        \'fas fa-save\',
        iconBg:      \'bg-[#1e3a5f]/10\',
        iconColor:   \'text-[#1e3a5f]\',
        headerColor: \'bg-[#1e3a5f]\',
        btnClass:    \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80\',
        accion:      () => submitExperiencia(),
    },
    cancelar: {
        titulo:      \'¿Descartar cambios?\',
        mensaje:     \'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.\',
        icon:        \'fas fa-times-circle\',
        iconBg:      \'bg-red-50\',
        iconColor:   \'text-red-500\',
        headerColor: \'bg-red-500\',
        btnClass:    \'bg-red-500 hover:bg-red-600\',
        accion:      () => cerrarModalExperiencia(),
    },
    eliminar: {
        titulo:      \'¿Eliminar experiencia?\',
        mensaje:     \'Esta acción es permanente y no se puede deshacer. La experiencia será eliminada definitivamente.\',
        icon:        \'fas fa-trash-alt\',
        iconBg:      \'bg-[#e11d48]/10\',
        iconColor:   \'text-[#e11d48]\',
        headerColor: \'bg-[#e11d48]\',
        btnClass:    \'bg-[#e11d48] hover:bg-[#e11d48]/80\',
        accion:      null,
    },
};

// ============================================================
// MODAL DE CONFIRMACIÓN (delega al modal global de layouts.app)
// ============================================================
function mostrarConfirmacionExperiencia(tipo) {
    const cfg = CONFIRM_CONFIG_EXPERIENCIA[tipo];
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

// ============================================================
// HELPER: RESALTAR ERROR
// ============================================================
function resaltarErrorExperiencia(campoId, mensaje) {
    const el = document.getElementById(campoId);
    if (!el) return;
    el.classList.add(\'border-red-400\', \'ring-2\', \'ring-red-300\');
    el.focus();
    setTimeout(() => el.classList.remove(\'border-red-400\', \'ring-2\', \'ring-red-300\'), 2500);

    const prev = el.parentElement.querySelector(\'.error-msg-exp\');
    if (prev) prev.remove();

    const msg = document.createElement(\'p\');
    msg.className = \'error-msg-exp text-xs text-red-500 mt-1\';
    msg.textContent = mensaje;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ============================================================
// RECALCULAR ESTADÍSTICAS Y ESTADO VACÍO
// ============================================================
function recalcularStatsExperiencia() {
    const lista = document.getElementById(\'experiencias-lista\');
    if (!lista) return;

    const cards       = lista.querySelectorAll(\'[data-experiencia-id]\');
    const total       = cards.length;
    const actuales    = lista.querySelectorAll(\'[data-trabajo-actual="1"]\').length;
    const finalizadas = total - actuales;

    const elTotal      = document.getElementById(\'stat-exp-total\');
    const elActual     = document.getElementById(\'stat-exp-actual\');
    const elFinalizada = document.getElementById(\'stat-exp-finalizada\');
    if (elTotal)      elTotal.textContent      = total;
    if (elActual)     elActual.textContent     = actuales;
    if (elFinalizada) elFinalizada.textContent = finalizadas;

    const emptyState = document.getElementById(\'empty-state-exp\');
    if (emptyState) emptyState.classList.toggle(\'hidden\', total > 0);
    lista.classList.toggle(\'hidden\', total === 0);
}

// ============================================================
// CONFIRMAR GUARDAR (VALIDACIONES)
// ============================================================
function confirmarGuardarExperiencia() {
    const cargo       = document.getElementById(\'exp_cargo\').value.trim();
    const empresa     = document.getElementById(\'exp_empresa\').value.trim();
    const fechaIni    = document.getElementById(\'exp_fecha_ini\').value;
    const fechaFin    = document.getElementById(\'exp_fecha_fin\').value;
    const trabajoActual = document.getElementById(\'exp_trabajo_actual\').checked;

    if (!cargo)   { resaltarErrorExperiencia(\'exp_cargo\',    \'El cargo es obligatorio.\');    return; }
    if (!empresa) { resaltarErrorExperiencia(\'exp_empresa\',  \'La empresa es obligatoria.\');  return; }
    if (!fechaIni){ resaltarErrorExperiencia(\'exp_fecha_ini\',\'La fecha de inicio es obligatoria.\'); return; }

    if (!trabajoActual && !fechaFin) {
        resaltarErrorExperiencia(\'exp_fecha_fin\', \'Si no es tu trabajo actual, indica la fecha de finalización.\');
        return;
    }
    if (!trabajoActual && fechaFin && fechaFin' => '// ==============================================================
// GLOBAL VARIABLES
// ==============================================================
let experienceEditingId = null;
const EXP_USER_ID = {{ $userId ?? \'null\' }};

// List of user\'s projects: [{project_id, name, experience_id}, ...]
window.USERPROJECTS_LIST = @json(($userprojects ?? collect())->values());

// Keep PROJECTS_USER_LIST in sync with changes from My Projects
window.syncProjectInListExp = function(action, project) {
    if (!project) return;
    window.PROJECTS_USER_LIST = window.PROJECTS_USER_LIST || [];
    const id = Number(project.project_id ?? project);
    const idx = window.PROJECTS_USER_LIST.findIndex(p => Number(p.project_id) === id);

    if (action === \'delete\') {
        if (idx !== -1) window.PROJECTS_USER_LIST.splice(idx, 1);
        return;
    }

    const entry = {
        project_id: id,
        name: project.name,
        experience_id: project.experience_id ?? null,
    };
    if (idx === -1) window.PROJECTS_USER_LIST.push(entry);
    else window.PROJECTS_USER_LIST[idx] = entry;
};


// ==============================================================
// CONFIRMATION SETUP
// ==============================================================
const CONFIRM_CONFIG_EXPERIENCE = {
    save: {
        title: \'Save experience?\',
        message: \'Your work experience information will be stored. You can edit it at any time.\',
        icon: \'fas fa-save\',
        iconBg: \'bg-[#1e3a5f]/10\',
        iconColor: \'text-[#1e3a5f]\',
        headerColor: \'bg-[#1e3a5f]\',
        btnClass: \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80\',
        action: () => submitExperience(),
    },
    cancel: {
        title: \'Discard changes?\',
        message: \'The data entered will not be saved. This action cannot be undone.\',
        icon: \'fas fa-times-circle\',
        iconBg: \'bg-red-50\',
        iconColor: \'text-red-500\',
        headerColor: \'bg-red-500\',
        btnClass: \'bg-red-500 hover:bg-red-600\',
        action: () => closeExperienceModal(),
    },
    remove: {
        title: \'Delete experience?\',
        message: \'This action is permanent and cannot be undone. The experience will be definitively eliminated.\',
        icon: \'fas fa-trash-alt\',
        iconBg: \'bg-[#e11d48]/10\',
        iconColor: \'text-[#e11d48]\',
        headerColor: \'bg-[#e11d48]\',
        btnClass: \'bg-[#e11d48] hover:bg-[#e11d48]/80\',
        action: null,
    },
};

// ==============================================================
// CONFIRMATION MODAL (delegates to layouts.app global modal)
// ==============================================================
function showExperienceConfirmation(type) {
    const cfg = CONFIRM_CONFIG_EXPERIENCE[type];
    if (!cfg) return;
    window.confirm({
        title: cfg.title,
        message: cfg.message,
        icon: cfg.icon,
        iconBg: cfg.iconBg,
        iconColor: cfg.iconColor,
        headerColor: cfg.headerColor,
        btnClass: cfg.btnClass,
        onConfirm: cfg.action,
    });
}

// ==============================================================
// HELPER: HIGHLIGHT ERROR
// ==============================================================
function highlightExperienceError(fieldId, message) {
    const el = document.getElementById(fieldId);
    if (!el) return;
    el.classList.add(\'border-red-400\', \'ring-2\', \'ring-red-300\');
    el.focus();
    setTimeout(() => el.classList.remove(\'border-red-400\', \'ring-2\', \'ring-red-300\'), 2500);

    const prev = el.parentElement.querySelector(\'.error-msg-exp\');
    if (prev) prev.remove();

    const msg = document.createElement(\'p\');
    msg.className = \'error-msg-exp text-xs text-red-500 mt-1\';
    msg.textContent = message;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ==============================================================
// RECOMPULATE STATISTICS AND EMPTY STATUS
// ==============================================================
function recalculateExperienceStats() {
    const list = document.getElementById(\'experiences-list\');
    if (!list) return;

    const cards = list.querySelectorAll(\'[data-experience-id]\');
    const total = cards.length;
    const current = list.querySelectorAll(\'[current-job-data="1"]\').length;
    const finished = total - current;

    const theTotal = document.getElementById(\'stat-exp-total\');
    const thecurrent = document.getElementById(\'stat-exp-current\');
    const theFinished = document.getElementById(\'stat-exp-finished\');
    if (elTotal) elTotal.textContent = total;
    if (theCurrent) theCurrent.textContent = currents;
    if (elFinalizada) elFinalizada.textContent = finished;

    const emptyState = document.getElementById(\'empty-state-exp\');
    if (emptyState) emptyState.classList.toggle(\'hidden\', total > 0);
    list.classList.toggle(\'hidden\', total === 0);
}

// ==============================================================
// CONFIRM SAVE (VALIDATIONS)
// ==============================================================
function confirmSaveExperience() {
    const cargo = document.getElementById(\'exp_cargo\').value.trim();
    const company = document.getElementById(\'company_exp\').value.trim();
    const dateIni = document.getElementById(\'exp_date_ini\').value;
    const enddate = document.getElementById(\'exp_end_date\').value;
    const current_job = document.getElementById(\'exp_current_job\').checked;

    if (!charge) { highlightExperienceError(\'exp_charge\', \'The charge is required.\');    return; }
    if (!company) { highlightExperienceError(\'company_exp\', \'Company is required.\');  return; }
    if (!startdate){ highlightExperienceError(\'exp_ini_date\',\'The start date is required.\'); return; }

    if (!currentjob && !enddate) {
        highlightExperienceError(\'exp_enddate\', \'If it is not your current job, indicate the end date.\');
        return;
    }
    if (!currentjob && enddate && enddate',
  'r.checked = (r.value === \'ninguno\'));
    const chipsCont = document.getElementById(\'exp_proj_existente_chips\');
    if (chipsCont) chipsCont.innerHTML = \'\';
    aplicarModoProyectoExp();
}

// ============================================================
// LISTA DE PROYECTOS DEL USUARIO (helpers)
// ============================================================
function popularChipsProyectosDisponibles(idExperienciaActual = null) {
    const cont  = document.getElementById(\'exp_proj_existente_chips\');
    const vacio = document.getElementById(\'exp_proj_existente_vacio\');
    if (!cont) return;
    cont.innerHTML = \'\';

    const disponibles = (window.PROYECTOS_USUARIO_LIST || []).filter(p => {
        // Excluir los que ya están vinculados a esta experiencia
        return !idExperienciaActual || Number(p.id_experiencia) !== Number(idExperienciaActual);
    });

    if (disponibles.length === 0) {
        if (vacio) vacio.classList.remove(\'hidden\');
        return;
    }
    if (vacio) vacio.classList.add(\'hidden\');

    disponibles.forEach(p => {
        const yaVinculadoAOtra = p.id_experiencia && Number(p.id_experiencia) !== Number(idExperienciaActual);
        const chip = document.createElement(\'button\');
        chip.type            = \'button\';
        chip.dataset.idProyecto = p.id_proyecto;
        chip.dataset.activo  = \'0\';
        chip.className       = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none\';
        chip.innerHTML       = `' => 'r.checked = (r.value === \'none\'));
    const chipsCont = document.getElementById(\'exp_existing_proj_chips\');
    if (chipsCont) chipsCont.innerHTML = \'\';
    applyExpProjectMode();
}

// ==============================================================
// LIST OF USER PROJECTS (helpers)
// ==============================================================
function popularAvailableProjectChips(currentExperienceid = null) {
    const cont = document.getElementById(\'exp_existing_proj_chips\');
    const empty = document.getElementById(\'exp_existing_proj_empty\');
    if (!cont) return;
    cont.innerHTML = \'\';

    const available = (window.PROJECTS_USER_LIST || []).filter(p => {
        // Exclude those already linked to this experience
        return !currentExperienceid || Number(p.experience_id) !== Number(currentExperienceid);
    });

    if (available.length === 0) {
        if (empty) empty.classList.remove(\'hidden\');
        return;
    }
    if (empty) empty.classList.add(\'hidden\');

    available.forEach(p => {
        const alreadyLinkedToOther = p.experience_id && Number(p.experience_id) !== Number(currentExperienceid);
        const chip = document.createElement(\'button\');
        chip.type = \'button\';
        chip.dataset.projectId = p.project_id;
        chip.dataset.active = \'0\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none\';
        chip.innerHTML = `',
  '${escapeHtmlExp(p.nombre)}${yaVinculadoAOtra ? \'' => '${escapeHtmlExp(p.name)}${alreadyLinkedToAnother ? \'',
  '(en otra exp.)' => '(in another exp.)',
  '\' : \'\'}`;
        chip.addEventListener(\'click\', () => toggleChipProyectoExistente(chip));
        cont.appendChild(chip);
    });
}

function toggleChipProyectoExistente(chip) {
    const activo = chip.dataset.activo === \'1\';
    if (activo) {
        chip.dataset.activo = \'0\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none\';
    } else {
        chip.dataset.activo = \'1\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f] bg-[#1e3a5f] text-white transition cursor-pointer select-none\';
    }
}

function getProyectosExistentesSeleccionados() {
    return Array.from(document.querySelectorAll(\'#exp_proj_existente_chips [data-activo="1"]\'))
        .map(c => Number(c.dataset.idProyecto));
}

function renderProyectosVinculadosEnModal(idExperiencia, proyectos) {
    const wrapper   = document.getElementById(\'exp_proyectos_vinculados_wrapper\');
    const container = document.getElementById(\'exp_proyectos_vinculados\');
    if (!wrapper || !container) return;
    container.innerHTML = \'\';
    if (!proyectos || proyectos.length === 0) {
        wrapper.classList.add(\'hidden\');
        return;
    }
    proyectos.forEach(p => {
        const chip = document.createElement(\'span\');
        chip.className = \'flex items-center gap-1 text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/20 px-2.5 py-1 rounded-full\';
        chip.dataset.idProyecto = p.id_proyecto;
        chip.innerHTML = `' => '\' : \'\'}`;
        chip.addEventListener(\'click\', () => toggleChipProyectoExistente(chip));
        cont.appendChild(chip);
    });
}

function toggleChipProyectoExistente(chip) {
    const activo = chip.dataset.activo === \'1\';
    if (activo) {
        chip.dataset.activo = \'0\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none\';
    } else {
        chip.dataset.activo = \'1\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f] bg-[#1e3a5f] text-white transition cursor-pointer select-none\';
    }
}

function getProyectosExistentesSeleccionados() {
    return Array.from(document.querySelectorAll(\'#exp_proj_existente_chips [data-activo="1"]\'))
        .map(c => Number(c.dataset.idProyecto));
}

function renderProyectosVinculadosEnModal(idExperiencia, proyectos) {
    const wrapper   = document.getElementById(\'exp_proyectos_vinculados_wrapper\');
    const container = document.getElementById(\'exp_proyectos_vinculados\');
    if (!wrapper || !container) return;
    container.innerHTML = \'\';
    if (!proyectos || proyectos.length === 0) {
        wrapper.classList.add(\'hidden\');
        return;
    }
    proyectos.forEach(p => {
        const chip = document.createElement(\'span\');
        chip.className = \'flex items-center gap-1 text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/20 px-2.5 py-1 rounded-full\';
        chip.dataset.idProyecto = p.id_proyecto;
        chip.innerHTML = `',
  '${escapeHtmlExp(p.nombre)}' => '${escapeHtmlExp(p.name)}',
  '`;
        chip.querySelector(\'button\').addEventListener(\'click\', () => desvincularProyectoExp(p.id_proyecto, idExperiencia, chip));
        container.appendChild(chip);
    });
    wrapper.classList.remove(\'hidden\');
}

function desvincularProyectoExp(idProyecto, idExperiencia, chipEl) {
    fetch(`/proyectos/${idProyecto}`, {
        method: \'PUT\',
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
        body: JSON.stringify({ id_experiencia: null }),
    })
    .then(r => r.json())
    .then(res => {
        if (!res.success) { mostrarToastExp(\'No se pudo desvincular el proyecto\', \'error\'); return; }

        // Actualizar lista global
        const item = (window.PROYECTOS_USUARIO_LIST || []).find(p => Number(p.id_proyecto) === Number(idProyecto));
        if (item) item.id_experiencia = null;

        // Quitar chip
        chipEl?.remove();
        const container = document.getElementById(\'exp_proyectos_vinculados\');
        if (container && container.children.length === 0) {
            document.getElementById(\'exp_proyectos_vinculados_wrapper\')?.classList.add(\'hidden\');
        }

        // Refrescar select de "vincular existente"
        popularChipsProyectosDisponibles(idExperiencia);

        // Limpiar bloque de proyectos en la tarjeta de experiencia (si era el último)
        if (container && container.children.length === 0) {
            const enTarjeta = document.getElementById(`exp-proyectos-${idExperiencia}`);
            if (enTarjeta) enTarjeta.innerHTML = \'\';
        } else {
            // Quitar solo el link de ese proyecto en la tarjeta
            const enTarjeta = document.getElementById(`exp-proyectos-${idExperiencia}`);
            const link = enTarjeta?.querySelector(`a[onclick*="verProyectoDesdeExp(${idProyecto})"]`);
            link?.remove();
        }

        mostrarToastExp(\'Proyecto desvinculado\', \'success\');
    })
    .catch(() => mostrarToastExp(\'Error al desvincular el proyecto\', \'error\'));
}

// ============================================================
// MODO DE PROYECTO (ninguno / existente / nuevo)
// ============================================================
function getModoProyectoExp() {
    const r = document.querySelector(\'input[name="exp_proj_modo"]:checked\');
    return r ? r.value : \'ninguno\';
}

function aplicarModoProyectoExp() {
    const modo      = getModoProyectoExp();
    const existente = document.getElementById(\'exp_proyecto_existente\');
    const nuevo     = document.getElementById(\'exp_proyecto_form\');
    if (existente) existente.classList.toggle(\'hidden\', modo !== \'existente\');
    if (nuevo)     nuevo.classList.toggle(\'hidden\',     modo !== \'nuevo\');
}

document.addEventListener(\'change\', function(e) {
    if (e.target && e.target.name === \'exp_proj_modo\') aplicarModoProyectoExp();
});

// ============================================================
// ABRIR MODAL CREAR
// ============================================================
function abrirModalExperiencia() {
    document.getElementById(\'modalExperienciaTitulo\').textContent = \'Agregar Experiencia Laboral\';
    document.getElementById(\'formExperiencia\').reset();
    document.getElementById(\'exp_id_experiencia\').value = \'\';
    experienciaEditandoId = null;

    document.getElementById(\'exp_fecha_fin_container\').style.opacity = \'1\';
    document.getElementById(\'exp_fecha_fin\').disabled = false;
    document.getElementById(\'exp_trabajo_actual\').checked = false;

    // Mostrar sección de proyecto
    document.getElementById(\'exp_proyecto_wrapper\').classList.remove(\'hidden\');
    resetProyectoForm();
    renderProyectosVinculadosEnModal(null, []);
    popularChipsProyectosDisponibles(null);

    document.getElementById(\'modalExperiencia\').classList.remove(\'hidden\');
    document.getElementById(\'modalExperiencia\').classList.add(\'flex\');
}

// ============================================================
// ABRIR MODAL EDITAR
// ============================================================
// Wrapper que se llama desde los botones de las tarjetas: deriva la lista
// de proyectos vinculados al click (siempre fresca, no quemada en el HTML).
function editarExperienciaDesdeBoton(exp) {
    const proyectosVinculados = obtenerProyectosVinculadosDeExp(exp.id_experiencia);
    abrirModalEditarExperiencia(exp, proyectosVinculados);
}

function abrirModalEditarExperiencia(exp, proyectosVinculados = []) {
    document.getElementById(\'modalExperienciaTitulo\').textContent = \'Editar Experiencia Laboral\';
    // Mostrar sección de proyecto también al editar
    document.getElementById(\'exp_proyecto_wrapper\').classList.remove(\'hidden\');
    resetProyectoForm();
    renderProyectosVinculadosEnModal(exp.id_experiencia, proyectosVinculados);
    popularChipsProyectosDisponibles(exp.id_experiencia);
    document.getElementById(\'exp_id_experiencia\').value = exp.id_experiencia;
    document.getElementById(\'exp_cargo\').value          = exp.cargo       ?? \'\';
    document.getElementById(\'exp_empresa\').value        = exp.empresa     ?? \'\';
    document.getElementById(\'exp_fecha_ini\').value      = exp.fecha_ini   ? exp.fecha_ini.substring(0, 10) : \'\';
    document.getElementById(\'exp_fecha_fin\').value      = exp.fecha_fin   ? exp.fecha_fin.substring(0, 10) : \'\';
    document.getElementById(\'exp_descripcion\').value    = exp.descripcion ?? \'\';
    document.getElementById(\'exp_referencias\').value    = exp.referencias ?? \'\';

    const trabajoActual = (exp.trabajo_actual === 1 || exp.trabajo_actual === true);
    document.getElementById(\'exp_trabajo_actual\').checked = trabajoActual;
    experienciaEditandoId = exp.id_experiencia;

    if (trabajoActual) {
        document.getElementById(\'exp_fecha_fin_container\').style.opacity = \'0.5\';
        document.getElementById(\'exp_fecha_fin\').disabled = true;
        document.getElementById(\'exp_fecha_fin\').value    = \'\';
    } else {
        document.getElementById(\'exp_fecha_fin_container\').style.opacity = \'1\';
        document.getElementById(\'exp_fecha_fin\').disabled = false;
    }

    document.getElementById(\'modalExperiencia\').classList.remove(\'hidden\');
    document.getElementById(\'modalExperiencia\').classList.add(\'flex\');
}

// ============================================================
// CERRAR MODAL
// ============================================================
function cerrarModalExperiencia() {
    document.getElementById(\'modalExperiencia\').classList.add(\'hidden\');
    document.getElementById(\'modalExperiencia\').classList.remove(\'flex\');
    experienciaEditandoId = null;
    resetProyectoForm();
}

function cerrarModalExperienciaFondo(event) {
    if (event.target.id === \'modalExperiencia\') confirmarCancelarExperiencia();
}

// ============================================================
// CHECKBOX trabajo actual
// ============================================================
document.getElementById(\'exp_trabajo_actual\')?.addEventListener(\'change\', function(e) {
    const container = document.getElementById(\'exp_fecha_fin_container\');
    const input     = document.getElementById(\'exp_fecha_fin\');
    if (e.target.checked) {
        container.style.opacity = \'0.5\';
        input.disabled = true;
        input.value    = \'\';
    } else {
        container.style.opacity = \'1\';
        input.disabled = false;
    }
});

// ============================================================
// CONSTRUIR TARJETA HTML (estilo card igual que gestionarProyectos)
// ============================================================
function escapeHtmlExp(text) {
    if (!text) return \'\';
    const div = document.createElement(\'div\');
    div.textContent = text;
    return div.innerHTML;
}

// Refresca el bloque de "proyectos relacionados" en la tarjeta de experiencia
function actualizarTarjetaExpConProyecto(idExperiencia, proyecto) {
    const contenedor = document.getElementById(`exp-proyectos-${idExperiencia}`);
    if (!contenedor) return;
    contenedor.innerHTML = `' => '`;
        chip.querySelector(\'button\').addEventListener(\'click\', () => desvincularProyectoExp(p.id_proyecto, idExperiencia, chip));
        container.appendChild(chip);
    });
    wrapper.classList.remove(\'hidden\');
}

function desvincularProyectoExp(idProyecto, idExperiencia, chipEl) {
    fetch(`/proyectos/${idProyecto}`, {
        method: \'PUT\',
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
        body: JSON.stringify({ id_experiencia: null }),
    })
    .then(r => r.json())
    .then(res => {
        if (!res.success) { mostrarToastExp(\'No se pudo desvincular el proyecto\', \'error\'); return; }

        // Actualizar lista global
        const item = (window.PROYECTOS_USUARIO_LIST || []).find(p => Number(p.id_proyecto) === Number(idProyecto));
        if (item) item.id_experiencia = null;

        // Quitar chip
        chipEl?.remove();
        const container = document.getElementById(\'exp_proyectos_vinculados\');
        if (container && container.children.length === 0) {
            document.getElementById(\'exp_proyectos_vinculados_wrapper\')?.classList.add(\'hidden\');
        }

        // Refrescar select de "vincular existente"
        popularChipsProyectosDisponibles(idExperiencia);

        // Limpiar bloque de proyectos en la tarjeta de experiencia (si era el último)
        if (container && container.children.length === 0) {
            const enTarjeta = document.getElementById(`exp-proyectos-${idExperiencia}`);
            if (enTarjeta) enTarjeta.innerHTML = \'\';
        } else {
            // Quitar solo el link de ese proyecto en la tarjeta
            const enTarjeta = document.getElementById(`exp-proyectos-${idExperiencia}`);
            const link = enTarjeta?.querySelector(`a[onclick*="verProyectoDesdeExp(${idProyecto})"]`);
            link?.remove();
        }

        mostrarToastExp(\'Proyecto desvinculado\', \'success\');
    })
    .catch(() => mostrarToastExp(\'Error al desvincular el proyecto\', \'error\'));
}

// ============================================================
// MODO DE PROYECTO (ninguno / existente / nuevo)
// ============================================================
function getModoProyectoExp() {
    const r = document.querySelector(\'input[name="exp_proj_modo"]:checked\');
    return r ? r.value : \'ninguno\';
}

function aplicarModoProyectoExp() {
    const modo      = getModoProyectoExp();
    const existente = document.getElementById(\'exp_proyecto_existente\');
    const nuevo     = document.getElementById(\'exp_proyecto_form\');
    if (existente) existente.classList.toggle(\'hidden\', modo !== \'existente\');
    if (nuevo)     nuevo.classList.toggle(\'hidden\',     modo !== \'nuevo\');
}

document.addEventListener(\'change\', function(e) {
    if (e.target && e.target.name === \'exp_proj_modo\') aplicarModoProyectoExp();
});

// ============================================================
// ABRIR MODAL CREAR
// ============================================================
function abrirModalExperiencia() {
    document.getElementById(\'modalExperienciaTitulo\').textContent = \'Agregar Experiencia Laboral\';
    document.getElementById(\'formExperiencia\').reset();
    document.getElementById(\'exp_id_experiencia\').value = \'\';
    experienciaEditandoId = null;

    document.getElementById(\'exp_fecha_fin_container\').style.opacity = \'1\';
    document.getElementById(\'exp_fecha_fin\').disabled = false;
    document.getElementById(\'exp_trabajo_actual\').checked = false;

    // Mostrar sección de proyecto
    document.getElementById(\'exp_proyecto_wrapper\').classList.remove(\'hidden\');
    resetProyectoForm();
    renderProyectosVinculadosEnModal(null, []);
    popularChipsProyectosDisponibles(null);

    document.getElementById(\'modalExperiencia\').classList.remove(\'hidden\');
    document.getElementById(\'modalExperiencia\').classList.add(\'flex\');
}

// ============================================================
// ABRIR MODAL EDITAR
// ============================================================
// Wrapper que se llama desde los botones de las tarjetas: deriva la lista
// de proyectos vinculados al click (siempre fresca, no quemada en el HTML).
function editarExperienciaDesdeBoton(exp) {
    const proyectosVinculados = obtenerProyectosVinculadosDeExp(exp.id_experiencia);
    abrirModalEditarExperiencia(exp, proyectosVinculados);
}

function abrirModalEditarExperiencia(exp, proyectosVinculados = []) {
    document.getElementById(\'modalExperienciaTitulo\').textContent = \'Editar Experiencia Laboral\';
    // Mostrar sección de proyecto también al editar
    document.getElementById(\'exp_proyecto_wrapper\').classList.remove(\'hidden\');
    resetProyectoForm();
    renderProyectosVinculadosEnModal(exp.id_experiencia, proyectosVinculados);
    popularChipsProyectosDisponibles(exp.id_experiencia);
    document.getElementById(\'exp_id_experiencia\').value = exp.id_experiencia;
    document.getElementById(\'exp_cargo\').value          = exp.cargo       ?? \'\';
    document.getElementById(\'exp_empresa\').value        = exp.empresa     ?? \'\';
    document.getElementById(\'exp_fecha_ini\').value      = exp.fecha_ini   ? exp.fecha_ini.substring(0, 10) : \'\';
    document.getElementById(\'exp_fecha_fin\').value      = exp.fecha_fin   ? exp.fecha_fin.substring(0, 10) : \'\';
    document.getElementById(\'exp_descripcion\').value    = exp.descripcion ?? \'\';
    document.getElementById(\'exp_referencias\').value    = exp.referencias ?? \'\';

    const trabajoActual = (exp.trabajo_actual === 1 || exp.trabajo_actual === true);
    document.getElementById(\'exp_trabajo_actual\').checked = trabajoActual;
    experienciaEditandoId = exp.id_experiencia;

    if (trabajoActual) {
        document.getElementById(\'exp_fecha_fin_container\').style.opacity = \'0.5\';
        document.getElementById(\'exp_fecha_fin\').disabled = true;
        document.getElementById(\'exp_fecha_fin\').value    = \'\';
    } else {
        document.getElementById(\'exp_fecha_fin_container\').style.opacity = \'1\';
        document.getElementById(\'exp_fecha_fin\').disabled = false;
    }

    document.getElementById(\'modalExperiencia\').classList.remove(\'hidden\');
    document.getElementById(\'modalExperiencia\').classList.add(\'flex\');
}

// ============================================================
// CERRAR MODAL
// ============================================================
function cerrarModalExperiencia() {
    document.getElementById(\'modalExperiencia\').classList.add(\'hidden\');
    document.getElementById(\'modalExperiencia\').classList.remove(\'flex\');
    experienciaEditandoId = null;
    resetProyectoForm();
}

function cerrarModalExperienciaFondo(event) {
    if (event.target.id === \'modalExperiencia\') confirmarCancelarExperiencia();
}

// ============================================================
// CHECKBOX trabajo actual
// ============================================================
document.getElementById(\'exp_trabajo_actual\')?.addEventListener(\'change\', function(e) {
    const container = document.getElementById(\'exp_fecha_fin_container\');
    const input     = document.getElementById(\'exp_fecha_fin\');
    if (e.target.checked) {
        container.style.opacity = \'0.5\';
        input.disabled = true;
        input.value    = \'\';
    } else {
        container.style.opacity = \'1\';
        input.disabled = false;
    }
});

// ============================================================
// CONSTRUIR TARJETA HTML (estilo card igual que gestionarProyectos)
// ============================================================
function escapeHtmlExp(text) {
    if (!text) return \'\';
    const div = document.createElement(\'div\');
    div.textContent = text;
    return div.innerHTML;
}

// Refresca el bloque de "proyectos relacionados" en la tarjeta de experiencia
function actualizarTarjetaExpConProyecto(idExperiencia, proyecto) {
    const contenedor = document.getElementById(`exp-proyectos-${idExperiencia}`);
    if (!contenedor) return;
    contenedor.innerHTML = `',
  '${escapeHtmlExp(proyecto.nombre)}' => '${escapeHtmlExp(project.name)}',
  '`;
}

// Navega a la sección proyectos y resalta el proyecto indicado
function verProyectoDesdeExp(idProyecto) {
    if (typeof cambiarSeccion === \'function\') cambiarSeccion(\'proyectos\');
    setTimeout(() => {
        const card = document.querySelector(`[data-proyecto-id="${idProyecto}"]`);
        if (card) {
            card.scrollIntoView({ behavior: \'smooth\', block: \'center\' });
            card.classList.add(\'ring-2\', \'ring-[#1e3a5f]\', \'ring-offset-2\');
            setTimeout(() => card.classList.remove(\'ring-2\', \'ring-[#1e3a5f]\', \'ring-offset-2\'), 1800);
        }
    }, 150);
}

function buildCardHTMLExperiencia(experiencia, proyectos = []) {
    const meses = [\'Ene\',\'Feb\',\'Mar\',\'Abr\',\'May\',\'Jun\',\'Jul\',\'Ago\',\'Sep\',\'Oct\',\'Nov\',\'Dic\'];

    let fechaInicioStr = \'\';
    if (experiencia.fecha_ini) {
        const d = new Date(experiencia.fecha_ini + \'T12:00:00\');
        fechaInicioStr = `${meses[d.getMonth()]} ${d.getFullYear()}`;
    }

    const esActual = (experiencia.trabajo_actual === 1 || experiencia.trabajo_actual === true);
    let fechaFinStr = \'\';
    if (esActual) {
        fechaFinStr = \'' => '`;
}

// Navigate to the projects section and highlight the indicated project
function viewProjectFromExp(projectid) {
    if (typeof changeSection === \'function\') changeSection(\'projects\');
    setTimeout(() => {
        const card = document.querySelector(`[data-project-id="${projectid}"]`);
        if (card) {
            card.scrollIntoView({ behavior: \'smooth\', block: \'center\' });
            card.classList.add(\'ring-2\', \'ring-[#1e3a5f]\', \'ring-offset-2\');
            setTimeout(() => card.classList.remove(\'ring-2\', \'ring-[#1e3a5f]\', \'ring-offset-2\'), 1800);
        }
    }, 150);
}

function buildCardHTMLExperience(experience, projects = []) {
    const months = [\'Jan\',\'Feb\',\'Mar\',\'Apr\',\'May\',\'Jun\',\'Jul\',\'Aug\',\'Sep\',\'Oct\',\'Nov\',\'Dec\'];

    let startDateStr = \'\';
    if (experience.date_ini) {
        const d = new Date(experience.date_ini + \'T12:00:00\');
        StartDateStr = `${months[d.getMonth()]} ${d.getFullYear()}`;
    }

    const iscurrent = (experience.current_job === 1 || experience.current_job === true);
    let EndStrDate = \'\';
    if (isCurrent) {
        dateEndStr = \'',
  '\';
    } else if (experiencia.fecha_fin) {
        const d = new Date(experiencia.fecha_fin + \'T12:00:00\');
        fechaFinStr = `${meses[d.getMonth()]} ${d.getFullYear()}`;
    }

    const badgeClass = esActual ? \'bg-[#1e3a5f]/10 text-[#1e3a5f]\' : \'bg-gray-100 text-gray-600\';
    const badgeLabel = esActual ? \'actual\' : \'finalizada\';

    const cargo       = escapeHtmlExp(experiencia.cargo       || \'\');
    const empresa     = escapeHtmlExp(experiencia.empresa     || \'\');
    const descripcion = escapeHtmlExp(experiencia.descripcion || \'\');
    const referencias = escapeHtmlExp(experiencia.referencias || \'\');

    const expJson = JSON.stringify(experiencia).replace(/\\\\/g, \'\\\\\\\\\').replace(/\'/g, "\\\\\'");

    return `' => '\';
    } else if (experience.end_date) {
        const d = new Date(experience.end_date + \'T12:00:00\');
        dateFinStr = `${months[d.getMonth()]} ${d.getFullYear()}`;
    }

    const badgeClass = isCurrent ? \'bg-[#1e3a5f]/10 text-[#1e3a5f]\' : \'bg-gray-100 text-gray-600\';
    const badgeLabel = isCurrent ? \'current\' : \'finished\';

    const charge = escapeHtmlExp(experience.charge || \'\');
    const company = escapeHtmlExp(experience.company || \'\');
    const description = escapeHtmlExp(experience.description || \'\');
    const references = escapeHtmlExp(experience.references || \'\');

    const expJson = JSON.stringify(experience).replace(/\\\\/g, \'\\\\\\\\\').replace(/\'/g, "\\\\\'");

    return `',
  '${cargo}' => '${cargo}',
  '${badgeLabel}' => '${badgeLabel}',
  '${empresa}' => '${company}',
  '` : \'\'}

    ${referencias ? `' => '` : \'\'}

    ${references ? `',
  '${referencias}' => '${references}',
  '${proyectos.length ? `' => '${projects.length ? `',
  '${proyectos.map(p => `' => '${projects.map(p => `',
  '`).join(\'\')}' => '`).join(\'\')}',
  '`;
}

// ============================================================
// TOAST
// ============================================================
function mostrarToastExp(mensaje, tipo = \'success\') {
    let container = document.getElementById(\'toastContainer\');
    if (!container) {
        container = document.createElement(\'div\');
        container.id = \'toastContainer\';
        container.className = \'fixed bottom-4 right-4 z-[70] space-y-2\';
        document.body.appendChild(container);
    }
    const toast = document.createElement(\'div\');
    const bg    = tipo === \'success\' ? \'bg-green-500\' : \'bg-red-500\';
    const ico   = tipo === \'success\' ? \'fa-check-circle\' : \'fa-exclamation-circle\';
    toast.className = `${bg} text-white px-6 py-3 rounded-lg shadow-lg text-sm flex items-center gap-2`;
    toast.innerHTML = `' => '`;
}

// ============================================================
// TOAST
// ============================================================
function mostrarToastExp(mensaje, tipo = \'success\') {
    let container = document.getElementById(\'toastContainer\');
    if (!container) {
        container = document.createElement(\'div\');
        container.id = \'toastContainer\';
        container.className = \'fixed bottom-4 right-4 z-[70] space-y-2\';
        document.body.appendChild(container);
    }
    const toast = document.createElement(\'div\');
    const bg    = tipo === \'success\' ? \'bg-green-500\' : \'bg-red-500\';
    const ico   = tipo === \'success\' ? \'fa-check-circle\' : \'fa-exclamation-circle\';
    toast.className = `${bg} text-white px-6 py-3 rounded-lg shadow-lg text-sm flex items-center gap-2`;
    toast.innerHTML = `',
  '`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity   = \'0\';
        toast.style.transform = \'translateX(100%)\';
        toast.style.transition = \'all 0.3s ease\';
        setTimeout(() => { toast.remove(); if (!container.children.length) container.remove(); }, 300);
    }, 3000);
}

// ============================================================
// HELPERS PARA SUBMIT
// ============================================================
function obtenerProyectosVinculadosDeExp(idExperiencia) {
    return (window.PROYECTOS_USUARIO_LIST || [])
        .filter(p => Number(p.id_experiencia) === Number(idExperiencia))
        .map(p => ({ id_proyecto: p.id_proyecto, nombre: p.nombre }));
}

function refrescarTarjetaExpConVinculados(idExperiencia) {
    const proyectos = obtenerProyectosVinculadosDeExp(idExperiencia);
    const contenedor = document.getElementById(`exp-proyectos-${idExperiencia}`);
    if (!contenedor) return;
    if (proyectos.length === 0) {
        contenedor.innerHTML = \'\';
        return;
    }
    contenedor.innerHTML = `' => '`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = \'0\';
        toast.style.transform = \'translateX(100%)\';
        toast.style.transition = \'all 0.3s ease\';
        setTimeout(() => { toast.remove(); if (!container.children.length) container.remove(); }, 300);
    }, 3000);
}

// ==============================================================
// HELPERS FOR SUBMIT
// ==============================================================
function getExp LinkedProjects(experienceid) {
    return (window.PROJECTS_USER_LIST || [])
        .filter(p => Number(p.experience_id) === Number(experienceid))
        .map(p => ({ project_id: p.project_id, name: p.name }));
}

function refreshLinkedExpCard(experienceid) {
    const projects = getLinkedProjectsFromExp(experienceid);
    const container = document.getElementById(`exp-projects-${experienceid}`);
    if (!container) return;
    if (projects.length === 0) {
        container.innerHTML = \'\';
        return;
    }
    container.innerHTML = `',
  '`;
}

function manejarProyectoEnSubmit(idExperiencia, editing) {
    const modo = getModoProyectoExp();

    if (modo === \'ninguno\') {
        cerrarModalExperiencia();
        mostrarToastExp(editing ? \'Experiencia actualizada correctamente\' : \'Experiencia guardada correctamente\', \'success\');
        return;
    }

    if (modo === \'existente\') {
        const ids = getProyectosExistentesSeleccionados();
        const csrf = document.querySelector(\'meta[name="csrf-token"]\').content;

        const peticiones = ids.map(idProy =>
            fetch(`/proyectos/${idProy}`, {
                method: \'PUT\',
                headers: { \'Content-Type\': \'application/json\', \'X-CSRF-TOKEN\': csrf },
                body: JSON.stringify({ id_experiencia: idExperiencia }),
            })
            .then(r => r.json())
            .then(res => ({ idProy, ok: !!res.success }))
            .catch(() => ({ idProy, ok: false }))
        );

        Promise.all(peticiones).then(resultados => {
            const exitosos = resultados.filter(r => r.ok).map(r => r.idProy);
            const fallidos = resultados.filter(r => !r.ok).map(r => r.idProy);

            // Actualizar lista global con los exitosos
            exitosos.forEach(idProy => {
                const item = (window.PROYECTOS_USUARIO_LIST || []).find(p => Number(p.id_proyecto) === Number(idProy));
                if (item) item.id_experiencia = idExperiencia;
            });
            if (exitosos.length) refrescarTarjetaExpConVinculados(idExperiencia);

            cerrarModalExperiencia();
            if (fallidos.length === 0) {
                mostrarToastExp(`Experiencia guardada y ${exitosos.length} proyecto${exitosos.length === 1 ? \'\' : \'s\'} vinculado${exitosos.length === 1 ? \'\' : \'s\'}`, \'success\');
            } else if (exitosos.length === 0) {
                mostrarToastExp(\'Experiencia guardada, pero no se pudo vincular ningún proyecto\', \'error\');
            } else {
                mostrarToastExp(`Experiencia guardada. ${exitosos.length} vinculado(s), ${fallidos.length} fallaron`, \'error\');
            }
        });
        return;
    }

    // modo === \'nuevo\'
    fetch(\'/proyectos\', {
        method: \'POST\',
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
        body: JSON.stringify({
            user_id:        EXP_USER_ID,
            id_experiencia: idExperiencia,
            nombre:         document.getElementById(\'exp_proj_nombre\').value.trim(),
            descripcion:    document.getElementById(\'exp_proj_descripcion\').value,
            fecha_ini:      document.getElementById(\'exp_proj_fecha_ini\').value,
            fecha_fin:      document.getElementById(\'exp_proj_fecha_fin\').value || null,
            tecnologias:    document.getElementById(\'exp_proj_tecnologias\').value,
            url_link:       document.getElementById(\'exp_proj_url_link\').value.trim() || null,
            estado:         document.getElementById(\'exp_proj_estado\').value,
            visible:        1,
        }),
    })
    .then(r => r.json())
    .then(projRes => {
        if (projRes.success) {
            const proyecto = projRes.proyecto;

            // Agregar a lista global
            (window.PROYECTOS_USUARIO_LIST = window.PROYECTOS_USUARIO_LIST || []).push({
                id_proyecto: proyecto.id_proyecto,
                nombre: proyecto.nombre,
                id_experiencia: idExperiencia,
            });

            // Inyectar en grid de Mis Proyectos
            if (typeof buildCardHTML === \'function\') {
                const grid = document.getElementById(\'proyectos-grid\');
                if (grid) {
                    grid.insertAdjacentHTML(\'afterbegin\', buildCardHTML(proyecto));
                    if (typeof recalcularStats === \'function\') recalcularStats();
                }
            }

            refrescarTarjetaExpConVinculados(idExperiencia);
        }
        cerrarModalExperiencia();
        mostrarToastExp(
            projRes.success
                ? \'Experiencia y proyecto guardados correctamente\'
                : \'Experiencia guardada, pero el proyecto no pudo crearse\',
            projRes.success ? \'success\' : \'error\'
        );
    })
    .catch(() => {
        cerrarModalExperiencia();
        mostrarToastExp(\'Experiencia guardada, pero hubo un problema al crear el proyecto\', \'error\');
    });
}

// ============================================================
// SUBMIT FORMULARIO (GUARDAR)
// ============================================================
function submitExperiencia() {
    const btnGuardar = document.querySelector(\'#modalExperiencia button[onclick="confirmarGuardarExperiencia()"]\');
    const textoOriginal = btnGuardar.innerHTML;
    btnGuardar.disabled = true;
    btnGuardar.innerHTML = \'' => '`;
}

function handleProjectInSubmit(experienceid, editing) {
    const mode = getExpProjectMode();

    if (mode === \'none\') {
        closeExperienceModal();
        showToastExp(editing ? \'Experience updated successfully\' : \'Experience saved successfully\', \'success\');
        return;
    }

    if (mode === \'existing\') {
        const ids = getSelectedExistingProjects();
        const csrf = document.querySelector(\'meta[name="csrf-token"]\').content;

        const requests = ids.map(Proyid =>
            fetch(`/projects/${idProy}`, {
                method: \'PUT\',
                headers: { \'Content-Type\': \'application/json\', \'X-CSRF-TOKEN\': csrf },
                body: JSON.stringify({ experience_id: experienceid }),
            })
            .then(r => r.json())
            .then(res => ({ idProy, ok: !!res.success }))
            .catch(() => ({ proyid, ok: false }))
        );

        Promise.all(requests).then(results => {
            const successful = results.filter(r => r.ok).map(r => r.idProy);
            const failed = results.filter(r => !r.ok).map(r => r.idProy);

            // Update global list with successful ones
            successful.forEach(Proyid => {
                const item = (window.PROJECTS_USER_LIST || []).find(p => Number(p.project_id) === Number(projectid));
                if (item) item.experience_id = experienceid;
            });
            if (successes.length) refreshLinkedExpCard(experienceid);

            closeExperienceModal();
            if (failed.length === 0) {
                showToastExp(`Saved experience and ${successes.length} project${successes.length === 1 ? \'\' : \'s\'} linked${successes.length === 1 ? \'\' : \'s\'}`, \'success\');
            } else if (successful.length === 0) {
                showToastExp(\'Experience saved, but no project could be linked\', \'error\');
            } else {
                showToastExp(`Saved experience. ${successful.length} linked(s), ${failed.length} failed`, \'error\');
            }
        });
        return;
    }

    // mode === \'new\'
    fetch(\'/projects\', {
        method: \'POST\',
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
        body: JSON.stringify({
            user_id: EXP_USER_ID,
            experience_id: experienceid,
            name: document.getElementById(\'exp_proj_name\').value.trim(),
            description: document.getElementById(\'exp_proj_descripcion\').value,
            date_ini: document.getElementById(\'exp_proj_date_ini\').value,
            end_date: document.getElementById(\'exp_proj_end_date\').value || null,
            technologies: document.getElementById(\'exp_proj_tecnologias\').value,
            url_link: document.getElementById(\'exp_proj_url_link\').value.trim() || null,
            status: document.getElementById(\'exp_proj_status\').value,
            visible: 1,
        }),
    })
    .then(r => r.json())
    .then(projRes => {
        if (projRes.success) {
            const project = projRes.project;

            // Add to global list
            (window.PROJECTS_USER_LIST = window.PROJECTS_USER_LIST || []).push({
                project_id: project.project_id,
                name: project.name,
                experience_id: experienceid,
            });

            // Inject into My Projects grid
            if (typeof buildCardHTML === \'function\') {
                const grid = document.getElementById(\'grid-projects\');
                if (grid) {
                    grid.insertAdjacentHTML(\'afterbegin\', buildCardHTML(project));
                    if (typeof recalculateStats === \'function\') recalculateStats();
                }
            }

            refreshLinkedExpCard(experienceid);
        }
        closeExperienceModal();
        showToastExp(
            projRes.success
                ? \'Experience and project saved successfully\'
                : \'Experience saved, but the project could not be created\',
            projRes.success ? \'success\' : \'error\'
        );
    })
    .catch(() => {
        closeExperienceModal();
        showToastExp(\'Experience saved, but there was a problem creating the project\', \'error\');
    });
}

// ==============================================================
// SUBMIT FORM (SAVE)
// ==============================================================
function submitExperience() {
    const btnSave = document.querySelector(\'#modalExperience button[onclick="confirmSaveExperience()"]\');
    const originalText = btnSave.innerHTML;
    btnSave.disabled = true;
    btnSave.innerHTML = \'',
  'Guardando...\';

    const trabajoActual = document.getElementById(\'exp_trabajo_actual\').checked;
    const data = {
        cargo:          document.getElementById(\'exp_cargo\').value,
        empresa:        document.getElementById(\'exp_empresa\').value,
        fecha_ini:      document.getElementById(\'exp_fecha_ini\').value,
        fecha_fin:      trabajoActual ? null : document.getElementById(\'exp_fecha_fin\').value,
        descripcion:    document.getElementById(\'exp_descripcion\').value,
        referencias:    document.getElementById(\'exp_referencias\').value,
        trabajo_actual: trabajoActual ? 1 : 0,
    };

    const url    = experienciaEditandoId ? `/perfil/experiencia/${experienciaEditandoId}` : \'/perfil/experiencia\';
    const method = experienciaEditandoId ? \'PUT\' : \'POST\';

    fetch(url, {
        method,
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
        body: JSON.stringify(data),
    })
    .then(r => {
        if (r.status === 422) {
            return r.json().then(err => {
                const msgs = err.errors ? Object.values(err.errors).flat() : [err.message ?? \'Error de validación\'];
                resaltarErrorExperiencia(\'exp_cargo\', msgs[0]);
                throw new Error(\'validation\');
            });
        }
        return r.json();
    })
    .then(res => {
        if (!res.success) {
            mostrarToastExp(res.error || \'Error al guardar\', \'error\');
            return;
        }

        const exp     = res.experiencia;
        const editing = !!experienciaEditandoId;

        // Insertar/actualizar tarjeta de experiencia (sin proyectos por ahora; se rellenan abajo)
        const proyectosVinculados = obtenerProyectosVinculadosDeExp(exp.id_experiencia);
        const lista    = document.getElementById(\'experiencias-lista\');
        const cardHTML = buildCardHTMLExperiencia(exp, proyectosVinculados);
        if (editing) {
            const existing = lista?.querySelector(`[data-experiencia-id="${exp.id_experiencia}"]`);
            if (existing) existing.outerHTML = cardHTML;
        } else {
            lista?.insertAdjacentHTML(\'afterbegin\', cardHTML);
            if (typeof window.notificarItemPublicable === \'function\') {
                window.notificarItemPublicable(\'experiencia\');
            }
        }

        recalcularStatsExperiencia();

        // Manejar proyecto adicional según modo (aplica tanto al crear como al editar)
        manejarProyectoEnSubmit(exp.id_experiencia, editing);
    })
    .catch(err => {
        if (err.message !== \'validation\') {
            console.error(err);
            mostrarToastExp(\'Hubo un problema al guardar\', \'error\');
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
    \'Frontend\':             [\'React\', \'Vue.js\', \'Angular\', \'Svelte\', \'Next.js\', \'Nuxt.js\', \'HTML\', \'CSS\', \'Tailwind CSS\', \'Bootstrap\', \'jQuery\', \'TypeScript\'],
    \'Backend\':              [\'Node.js\', \'Express\', \'Django\', \'FastAPI\', \'Spring Boot\', \'Laravel\', \'Ruby on Rails\', \'ASP.NET\', \'Flask\', \'NestJS\', \'Phoenix\'],
    \'Lenguajes\':            [\'JavaScript\', \'TypeScript\', \'Python\', \'Java\', \'C#\', \'C++\', \'C\', \'PHP\', \'Ruby\', \'Go\', \'Rust\', \'Swift\', \'Kotlin\', \'Dart\', \'R\'],
    \'Bases de Datos\':       [\'MySQL\', \'PostgreSQL\', \'MongoDB\', \'SQLite\', \'Redis\', \'MariaDB\', \'Oracle\', \'SQL Server\', \'Cassandra\', \'Firebase\', \'Supabase\'],
    \'Cloud & DevOps\':       [\'AWS\', \'Google Cloud\', \'Azure\', \'Docker\', \'Kubernetes\', \'GitHub Actions\', \'GitLab CI\', \'Terraform\', \'Ansible\', \'Jenkins\', \'Nginx\'],
    \'Mobile\':               [\'React Native\', \'Flutter\', \'Android\', \'iOS\', \'Ionic\', \'Xamarin\', \'Expo\'],
    \'APIs & Real-time\':     [\'REST API\', \'GraphQL\', \'WebSockets\', \'gRPC\', \'Swagger\', \'Postman\', \'Socket.io\'],
    \'Testing\':              [\'Jest\', \'PHPUnit\', \'Cypress\', \'Selenium\', \'Pytest\', \'JUnit\', \'Mocha\', \'Vitest\'],
    \'Data Science & ML\':    [\'TensorFlow\', \'PyTorch\', \'Scikit-learn\', \'Pandas\', \'NumPy\', \'Keras\', \'OpenCV\', \'Jupyter\'],
    \'Diseño & Prototipado\': [\'Figma\', \'Adobe XD\', \'Sketch\', \'InVision\', \'Canva\'],
    \'Gestión de Proyectos\': [\'Git\', \'GitHub\', \'GitLab\', \'Jira\', \'Trello\', \'Notion\', \'Slack\', \'Linear\'],
};

function getTagsExp() {
    const val = document.getElementById(\'exp_proj_tecnologias\').value;
    return val ? val.split(\',\').map(t => t.trim()).filter(Boolean) : [];
}

function setTagsExp(tags) {
    document.getElementById(\'exp_proj_tecnologias\').value = tags.join(\', \');
    renderizarTagsExp(tags);
}

function renderizarTagsExp(tags) {
    const container = document.getElementById(\'exp_proj_tags\');
    container.innerHTML = \'\';
    tags.forEach((tag, i) => {
        const span = document.createElement(\'span\');
        span.className = \'flex items-center gap-1 text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/20 px-2.5 py-1 rounded-full\';
        span.innerHTML = `${tag}' => 'Saving...\';

    const current_job = document.getElementById(\'exp_current_job\').checked;
    const data = {
        cargo: document.getElementById(\'exp_cargo\').value,
        company: document.getElementById(\'exp_company\').value,
        date_ini: document.getElementById(\'exp_date_ini\').value,
        end_date: currentjob ? null : document.getElementById(\'exp_fecha_end\').value,
        description: document.getElementById(\'exp_descripcion\').value,
        references: document.getElementById(\'exp_references\').value,
        current_job: current_job ? 1:0,
    };

    const url = experienceEditingId ? `/profile/experience/${experienceEditingId}`: \'/profile/experience\';
    const method = experienceEditingId ? \'PUT\' : \'POST\';

    fetch(url, {
        method,
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
        body: JSON.stringify(data),
    })
    .then(r => {
        if (r.status === 422) {
            return r.json().then(err => {
                const msgs = err.errors ? Object.values(err.errors).flat() : [err.message ?? \'Validation error\'];
                highlightExperienceError(\'exp_charge\', msgs[0]);
                throw new Error(\'validation\');
            });
        }
        return r.json();
    })
    .then(res => {
        if (!res.success) {
            showToastExp(res.error || \'Error saving\', \'error\');
            return;
        }

        const exp = res.experience;
        const editing = !!experienceeditingId;

        // Insert/update experience card (no projects for now; filled in below)
        const LinkedProjects = getLinkedProjectsFromExp(exp.experience_id);
        const list = document.getElementById(\'experiences-list\');
        const cardHTML = buildCardHTMLExperience(exp, LinkedProjects);
        if (editing) {
            const existing = list?.querySelector(`[data-experience-id="${exp.id_experience}"]`);
            if (existing) existing.outerHTML = cardHTML;
        } else {
            list?.insertAdjacentHTML(\'afterbegin\', cardHTML);
            if (typeof window.notifyItemPublicable === \'function\') {
                window.notifyItemPublicable(\'experience\');
            }
        }

        recalculateExperienceStats();

        // Handle additional project according to mode (applies both when creating and editing)
        handleProjectInSubmit(exp.experience_id, editing);
    })
    .catch(err => {
        if (err.message !== \'validation\') {
            console.error(err);
            showToastExp(\'There was a problem saving\', \'error\');
        }
    })
    .finally(() => {
        btnSave.disabled = false;
        btnSave.innerHTML = originalText;
    });
}

// ==============================================================
// TECHNOLOGIES (chips) — PROJECT IN EXPERIENCE
// ==============================================================

// Reuse TECHNOLOGIES_BY_CATEGORY defined in _scripts.blade.php
// If not available on this page, it is defined locally
window.TECHNOLOGIES_BY_CATEGORY = window.TECHNOLOGIES_BY_CATEGORY || {
    \'Frontend\': [\'React\', \'Vue.js\', \'Angular\', \'Svelte\', \'Next.js\', \'Nuxt.js\', \'HTML\', \'CSS\', \'Tailwind CSS\', \'Bootstrap\', \'jQuery\', \'TypeScript\'],
    \'Backend\': [\'Node.js\', \'Express\', \'Django\', \'FastAPI\', \'Spring Boot\', \'Laravel\', \'Ruby on Rails\', \'ASP.NET\', \'Flask\', \'NestJS\', \'Phoenix\'],
    \'Languages\': [\'JavaScript\', \'TypeScript\', \'Python\', \'Java\', \'C#\', \'C++\', \'C\', \'PHP\', \'Ruby\', \'Go\', \'Rust\', \'Swift\', \'Kotlin\', \'Dart\', \'R\'],
    \'Databases\': [\'MySQL\', \'PostgreSQL\', \'MongoDB\', \'SQLite\', \'Redis\', \'MariaDB\', \'Oracle\', \'SQL Server\', \'Cassandra\', \'Firebase\', \'Supabase\'],
    \'Cloud & DevOps\': [\'AWS\', \'Google Cloud\', \'Azure\', \'Docker\', \'Kubernetes\', \'GitHub Actions\', \'GitLab CI\', \'Terraform\', \'Ansible\', \'Jenkins\', \'Nginx\'],
    \'Mobile\': [\'React Native\', \'Flutter\', \'Android\', \'iOS\', \'Ionic\', \'Xamarin\', \'Expo\'],
    \'APIs & Real-time\': [\'REST API\', \'GraphQL\', \'WebSockets\', \'gRPC\', \'Swagger\', \'Postman\', \'Socket.io\'],
    \'Testing\': [\'Jest\', \'PHPUnit\', \'Cypress\', \'Selenium\', \'Pytest\', \'JUnit\', \'Mocha\', \'Vitest\'],
    \'Data Science & ML\': [\'TensorFlow\', \'PyTorch\', \'Scikit-learn\', \'Pandas\', \'NumPy\', \'Keras\', \'OpenCV\', \'Jupyter\'],
    \'Design & Prototyping\': [\'Figma\', \'Adobe XD\', \'Sketch\', \'InVision\', \'Canva\'],
    \'Project Management\': [\'Git\', \'GitHub\', \'GitLab\', \'Jira\', \'Trello\', \'Notion\', \'Slack\', \'Linear\'],
};

function getTagsExp() {
    const val = document.getElementById(\'exp_proj_tecnologias\').value;
    return val ? val.split(\',\').map(t => t.trim()).filter(Boolean) : [];
}

function setTagsExp(tags) {
    document.getElementById(\'exp_proj_tecnologias\').value = tags.join(\', \');
    renderTagsExp(tags);
}

function renderTagsExp(tags) {
    const container = document.getElementById(\'exp_proj_tags\');
    container.innerHTML = \'\';
    tags.forEach((tag, i) => {
        const span = document.createElement(\'span\');
        span.className = \'flex items-center gap-1 text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/20 px-2.5 py-1 rounded-full\';
        span.innerHTML = `${tag}',
  '`;
        container.appendChild(span);
    });
}

function eliminarTagExp(index) {
    const tags = getTagsExp();
    tags.splice(index, 1);
    setTagsExp(tags);
}

function verificarFechaFinProyectoExp() {
    const fechaFin = document.getElementById(\'exp_proj_fecha_fin\').value;
    const wrapper  = document.getElementById(\'exp_proj_url_wrapper\');
    const hoy      = new Date().toISOString().split(\'T\')[0];
    const pasado   = fechaFin && fechaFin' => '`;
        container.appendChild(span);
    });
}

function eliminarTagExp(index) {
    const tags = getTagsExp();
    tags.splice(index, 1);
    setTagsExp(tags);
}

function verificarFechaFinProyectoExp() {
    const fechaFin = document.getElementById(\'exp_proj_fecha_fin\').value;
    const wrapper  = document.getElementById(\'exp_proj_url_wrapper\');
    const hoy      = new Date().toISOString().split(\'T\')[0];
    const pasado   = fechaFin && fechaFin',
  '{
        const chip = document.createElement(\'button\');
        chip.type        = \'button\';
        chip.dataset.tec = tec;
        chip.textContent = tec;

        if (yaAgregadas.includes(tec)) {
            chip.className = \'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed\';
            chip.disabled  = true;
        } else {
            chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none\';
            chip.addEventListener(\'click\', () => toggleChipExp(chip));
        }

        chipsDiv.appendChild(chip);
    });

    container.classList.remove(\'hidden\');
}

function toggleChipExp(chip) {
    const activo = chip.dataset.activo === \'1\';
    if (activo) {
        chip.dataset.activo = \'0\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none\';
    } else {
        chip.dataset.activo = \'1\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f] bg-[#1e3a5f] text-white transition cursor-pointer select-none\';
    }
}

function agregarTecnologiaExp() {
    const seleccionados = document.querySelectorAll(\'#exp_chips [data-activo="1"]\');
    if (!seleccionados.length) return;

    const tags = getTagsExp();
    seleccionados.forEach(chip => {
        const tec = chip.dataset.tec;
        if (!tags.includes(tec)) tags.push(tec);
    });
    setTagsExp(tags);

    seleccionados.forEach(chip => {
        chip.dataset.activo = \'0\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed\';
        chip.disabled  = true;
    });
}

// ============================================================
// ELIMINAR
// ============================================================
function confirmarEliminarExperiencia(id) {
    CONFIRM_CONFIG_EXPERIENCIA.eliminar.accion = () => ejecutarEliminarExperiencia(id);
    mostrarConfirmacionExperiencia(\'eliminar\');
}

function ejecutarEliminarExperiencia(id) {
    fetch(`/perfil/experiencia/${id}`, {
        method: \'DELETE\',
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const card = document.querySelector(`[data-experiencia-id="${id}"]`);
            if (card) card.remove();
            recalcularStatsExperiencia();
            mostrarToastExp(\'Experiencia eliminada correctamente\', \'success\');
        } else {
            mostrarToastExp(res.error || \'Error al eliminar\', \'error\');
        }
    });
}' => '{
        const chip = document.createElement(\'button\');
        chip.type        = \'button\';
        chip.dataset.tec = tec;
        chip.textContent = tec;

        if (yaAgregadas.includes(tec)) {
            chip.className = \'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed\';
            chip.disabled  = true;
        } else {
            chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none\';
            chip.addEventListener(\'click\', () => toggleChipExp(chip));
        }

        chipsDiv.appendChild(chip);
    });

    container.classList.remove(\'hidden\');
}

function toggleChipExp(chip) {
    const activo = chip.dataset.activo === \'1\';
    if (activo) {
        chip.dataset.activo = \'0\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none\';
    } else {
        chip.dataset.activo = \'1\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f] bg-[#1e3a5f] text-white transition cursor-pointer select-none\';
    }
}

function agregarTecnologiaExp() {
    const seleccionados = document.querySelectorAll(\'#exp_chips [data-activo="1"]\');
    if (!seleccionados.length) return;

    const tags = getTagsExp();
    seleccionados.forEach(chip => {
        const tec = chip.dataset.tec;
        if (!tags.includes(tec)) tags.push(tec);
    });
    setTagsExp(tags);

    seleccionados.forEach(chip => {
        chip.dataset.activo = \'0\';
        chip.className = \'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed\';
        chip.disabled  = true;
    });
}

// ============================================================
// ELIMINAR
// ============================================================
function confirmarEliminarExperiencia(id) {
    CONFIRM_CONFIG_EXPERIENCIA.eliminar.accion = () => ejecutarEliminarExperiencia(id);
    mostrarConfirmacionExperiencia(\'eliminar\');
}

function ejecutarEliminarExperiencia(id) {
    fetch(`/perfil/experiencia/${id}`, {
        method: \'DELETE\',
        headers: {
            \'Content-Type\': \'application/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content,
        },
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const card = document.querySelector(`[data-experiencia-id="${id}"]`);
            if (card) card.remove();
            recalcularStatsExperiencia();
            mostrarToastExp(\'Experiencia eliminada correctamente\', \'success\');
        } else {
            mostrarToastExp(res.error || \'Error al eliminar\', \'error\');
        }
    });
}',
  'Desvincular' => 'Unlink',
  'Editar Perfil' => 'Edit Profile',
  'Actualiza tu información personal y profesional' => 'Update your personal and professional information',
  'Cambios' => 'Changes',
  'Información básica de contacto' => 'Basic contact information',
  'Información Profesional' => 'Professional Information',
  'Tu perfil profesional y ubicación' => 'Your professional profile and location',
  'Título Profesional' => 'Professional Title',
  'Foto de Perfil (URL)' => 'Profile Photo (URL)',
  'Pega la URL de tu foto de perfil' => 'Paste the URL of your profile photo',
  'Cuéntanos sobre ti, tu experiencia y objetivos' => 'Tell us about yourself, your experience and goals',
  'Sobre mí' => 'about me',
  'Redes Sociales' => 'Social networks',
  'Conecta tu perfil con tus redes profesionales' => 'Connect your profile with your professional networks',
  'GitHub' => 'GitHub',
  'LinkedIn' => 'LinkedIn',
  'Twitter / X' => 'Twitter / X',
  'Portafolio Web' => 'Web Portfolio',
  'Ej: Ingeniero de Software' => 'Ex: Software Engineer',
  'Ciudad, País' => 'City, Country',
  'https://ejemplo.com/mi-foto.jpg' => 'https://ejemplo.com/mi-foto.jpg',
  'Desarrollador full-stack con 5 años de experiencia...' => 'Full-stack developer with 5 years of experience...',
  'https://github.com/tuusuario' => 'https://github.com/tuusuario',
  'https://linkedin.com/in/tuusuario' => 'https://linkedin.com/in/tuusuario',
  'https://twitter.com/tuusuario' => 'https://twitter.com/tuusuario',
  'https://tusitioweb.com' => 'https://tusitioweb.com',
  'Agregar Formación Académica' => 'Add Academic Training',
  'Completa los detalles de tu formación' => 'Complete the details of your training',
  'Título' => 'Title',
  'Institución' => 'Institution',
  'Selecciona un nivel' => 'Select a level',
  'Técnico' => 'Technical',
  'Tecnólogo' => 'Technologist',
  'Pregrado' => 'Undergraduate',
  'Posgrado' => 'Postgraduate',
  'Maestría' => 'Mastery',
  'Doctorado' => 'Doctorate',
  'Diplomado' => 'Diploma',
  'Curso' => 'Course',
  'Fecha Inicio' => 'Start Date',
  'Fecha Fin' => 'End Date',
  'Actualmente estudiando aquí' => 'Currently studying here',
  'Ej: Ingeniería Informática' => 'Ex: Computer Engineering',
  'Ej: Universidad Nacional' => 'Ex: National University',
  'Describe lo que aprendiste o destacaste...' => 'Describe what you learned or highlighted...',
  'Agregar Experiencia Laboral' => 'Add Work Experience',
  'Completa los detalles de tu experiencia' => 'Fill in the details of your experience',
  'Cargo' => 'Cargo',
  'Empresa' => 'Enterprise',
  'Trabajo actualmente aquí' => 'I currently work here',
  '(opcional)' => '(optional)',
  'Proyecto vinculado' => 'Linked project',
  'Ninguno' => 'None',
  'Vincular existente' => 'Link existing',
  'Crear nuevo' => 'Create new',
  'Proyectos vinculados actualmente:' => 'Currently linked projects:',
  'Selecciona uno o más proyectos' => 'Select one or more projects',
  'No hay proyectos disponibles para vincular.' => 'There are no projects available to link.',
  'Clic para seleccionar / deseleccionar. Los seleccionados se enlazarán a esta experiencia.' => 'Click to select/deselect. Those selected will be linked to this experience.',
  'El proyecto quedará vinculado a esta experiencia y también aparecerá en' => 'The project will be linked to this experience and will also appear in',
  'Nombre del Proyecto' => 'Project Name',
  'Enlace del Proyecto' => 'Project Link',
  '(obligatorio porque el proyecto ya finalizó)' => '(required because the project has already ended)',
  'Frontend' => 'Frontend',
  'Backend' => 'Backend',
  'Lenguajes' => 'Languages',
  'Bases de Datos' => 'Databases',
  'Cloud &amp; DevOps' => 'Cloud & DevOps',
  'Mobile' => 'Mobile',
  'APIs &amp; Real-time' => 'APIs & Real-time',
  'Testing' => 'Testing',
  'Data Science &amp; ML' => 'Data Science & ML',
  'Diseño &amp; Prototipado' => 'Design and Prototyping',
  'Clic para seleccionar, clic de nuevo para deseleccionar' => 'Click to select, click again to deselect',
  'Ej: Desarrollador Full Stack' => 'Ex: Full Stack Developer',
  'Ej: Google, Microsoft, Startup X' => 'Ej: Google, Microsoft, Startup X',
  'Describe tus responsabilidades y logros...' => 'Describe your responsibilities and accomplishments...',
  'Ej: Juan Pérez — Jefe directo · juan@empresa.com · +57 300 000 0000' => 'Ex: Juan Pérez — Direct manager · juan@empresa.com · +57 300 000 0000',
  'Ej: Sistema de Gestión Interna' => 'Ex: Internal Management System',
  'Breve descripción del proyecto...' => 'Brief description of the project...',
  'https://proyecto-cliente.com' => 'https://proyecto-cliente.com',
  'Subiendo foto...' => 'Uploading photo...',
  'Mi Perfil' => 'My Profile',
  'Correo:' => 'Mail:',
  'Título:' => 'Title:',
  'GitHub:' => 'GitHub:',
  'LinkedIn:' => 'LinkedIn:',
  'Twitter / X:' => 'Twitter / X:',
  'Portafolio:' => 'Portfolio:',
  'Configurar cuenta' => 'Set up account',
  'function toggleConfiguracionCuenta() {
            const seccion = document.getElementById(\'seccion-configuracion\');
            const icono   = document.getElementById(\'icono-config\');
            const texto   = document.getElementById(\'texto-btn-config\');
            const abierto = !seccion.classList.contains(\'hidden\');

            if (abierto) {
                seccion.classList.add(\'hidden\');
                icono.classList.remove(\'rotate-90\');
                texto.textContent = \'Configurar cuenta\';
            } else {
                seccion.classList.remove(\'hidden\');
                icono.classList.add(\'rotate-90\');
                texto.textContent = \'Ocultar configuración\';
                seccion.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
            }
        }
        
        // Función para subir foto de perfil (como Facebook)
        function subirFotoPerfil(input) {
        if (!input.files || !input.files[0]) return;
        
        const file = input.files[0];
        
        // Validar tipo de archivo
        if (!file.type.startsWith(\'image/\')) {
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'Por favor, selecciona una imagen válida (JPG, PNG, GIF)\',
                confirmButtonColor: \'#1e3a5f\'
            });
            input.value = \'\';
            return;
        }
        
        // Validar tamaño (máximo 2MB)
        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'La imagen no debe superar los 2MB\',
                confirmButtonColor: \'#1e3a5f\'
            });
            input.value = \'\';
            return;
        }
        
        // Mostrar preview temporal
        const reader = new FileReader();
        reader.onload = function(e) {
            const fotoContainer = document.getElementById(\'perfil-foto-container\');
            fotoContainer.innerHTML = `' => 'function toggleAccountSettings() {
            const section = document.getElementById(\'section-configuration\');
            const icon = document.getElementById(\'icon-config\');
            const text = document.getElementById(\'text-btn-config\');
            const open = !section.classList.contains(\'hidden\');

            if (open) {
                section.classList.add(\'hidden\');
                icon.classList.remove(\'rotate-90\');
                text.textContent = \'Set up account\';
            } else {
                section.classList.remove(\'hidden\');
                icon.classList.add(\'rotate-90\');
                text.textContent = \'Hide Settings\';
                section.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
            }
        }
        
        // Function to upload profile photo (like Facebook)
        function uploadProfilePhoto(input) {
        if (!input.files || !input.files[0]) return;
        
        const file = input.files[0];
        
        // Validate file type
        if (!file.type.startsWith(\'image/\')) {
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'Please select a valid image (JPG, PNG, GIF)\',
                confirmButtonColor: \'#1e3a5f\'
            });
            input.value = \'\';
            return;
        }
        
        // Validate size (maximum 2MB)
        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'The image must not exceed 2MB\',
                confirmButtonColor: \'#1e3a5f\'
            });
            input.value = \'\';
            return;
        }
        
        // Show temporary preview
        const reader = new FileReader();
        reader.onload = function(e) {
            const photoContainer = document.getElementById(\'profile-photo-container\');
            photoContainer.innerHTML = `',
  '`;
        };
        reader.readAsDataURL(file);
        
        // Mostrar barra de progreso
        const progressContainer = document.getElementById(\'progress-foto-container\');
        const progressBar = document.getElementById(\'progress-foto-bar\');
        progressContainer.classList.remove(\'hidden\');
        progressBar.style.width = \'0%\';
        
        // Simular progreso
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            if (progress' => '`;
        };
        reader.readAsDataURL(file);
        
        // Mostrar barra de progreso
        const progressContainer = document.getElementById(\'progress-foto-container\');
        const progressBar = document.getElementById(\'progress-foto-bar\');
        progressContainer.classList.remove(\'hidden\');
        progressBar.style.width = \'0%\';
        
        // Simular progreso
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            if (progress',
  'response.json())
        .then(data => {
            clearInterval(interval);
            progressBar.style.width = \'100%\';
            
            if (data.success) {
                // 1. Actualizar foto en el contenido principal (perfil)
                const fotoContainer = document.getElementById(\'perfil-foto-container\');
                fotoContainer.innerHTML = `' => 'response.json())
        .then(data => {
            clearInterval(interval);
            progressBar.style.width = \'100%\';
            
            if (data.success) {
                // 1. Update photo in the main content (profile)
                const photoContainer = document.getElementById(\'profile-photo-container\');
                photoContainer.innerHTML = `',
  '`;
                
                // 2. Actualizar avatar en el HEADER (nuevo)
                const headerAvatar = document.getElementById(\'header-avatar\');
                if (headerAvatar) {
                    let img = headerAvatar.querySelector(\'img\');
                    if (img) {
                        // Ya existe imagen, solo cambiar src
                        img.src = data.foto_url + \'?t=\' + Date.now();
                    } else {
                        // Era el span con iniciales, reemplazar por imagen
                        headerAvatar.innerHTML = `' => '`;
                
                // 2. Update avatar in the HEADER (new)
                const headerAvatar = document.getElementById(\'header-avatar\');
                if (headerAvatar) {
                    let img = headerAvatar.querySelector(\'img\');
                    if (img) {
                        // Image already exists, just change src
                        img.src = data.photo_url + \'?t=\' + Date.now();
                    } else {
                        // It was the span with initials, replace with image
                        headerAvatar.innerHTML = `',
  '`;
                    }
                }
                
                // 3. Actualizar foto en el modal de edición si existe
                const modalFoto = document.querySelector(\'#modal-editar-perfil #foto-perfil-actual\');
                if (modalFoto) {
                    modalFoto.innerHTML = `' => '`;
                    }
                }
                
                // 3. Update photo in the editing modal if it exists
                const modalPhoto = document.querySelector(\'#modal-edit-profile #current-profile-photo\');
                if (photomodal) {
                    modalPhoto.innerHTML = `',
  '`;
                }
                
                setTimeout(() => {
                    progressContainer.classList.add(\'hidden\');
                }, 1000);
                
                Swal.fire({
                    icon: \'success\',
                    title: \'¡Foto actualizada!\',
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                throw new Error(data.message || \'Error al subir la foto\');
            }
        })
        .catch(error => {
            console.error(\'Error:\', error);
            clearInterval(interval);
            progressContainer.classList.add(\'hidden\');
            
            // Recargar la foto original
            location.reload();
            
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'No se pudo subir la imagen. Intenta nuevamente.\',
                confirmButtonColor: \'#d33\'
            });
        });
    }' => '`;
                }
                
                setTimeout(() => {
                    progressContainer.classList.add(\'hidden\');
                }, 1000);
                
                Swal.fire({
                    icon: \'success\',
                    title: \'Updated photo!\',
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                throw new Error(data.message || \'Error uploading photo\');
            }
        })
        .catch(error => {
            console.error(\'Error:\', error);
            clearInterval(interval);
            progressContainer.classList.add(\'hidden\');
            
            // Reload the original photo
            location.reload();
            
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'The image could not be uploaded. Try again.\',
                confirmButtonColor: \'#d33\'
            });
        });
    }',
  'Dashboard / Mi Perfil / Proyectos' => 'Dashboard / My Profile / Projects',
  'Hola, {{ $nombreUsuario ?? \'Usuario\' }}' => 'Hello, {{ $username ?? \'User\' }}',
  'Resumen de tu actividad, proyectos y rendimiento reciente en el sistema.' => 'Summary of your activity, projects and recent performance in the system.',
  'Actividades' => 'Activities',
  'Estudios' => 'Studies',
  'Proyectos recientes' => 'Recent projects',
  'Últimos {{ $proyectosRecientes->count() }} registros' => 'Latest {{ $recent projects->count() }} records',
  'window._resumenProyectosIniciales = {{ $proyectosRecientes->count() }};' => 'window._initialProjectsummary = {{ $recentprojects->count() }};',
  'const CSRF_PERFIL = document.querySelector(\'meta[name="csrf-token"]\').content;

// ── Configuración de confirmación ──────────────────────────────────────────────

const CONFIRM_CONFIG_PERFIL = {
    guardar: {
        titulo:    \'¿Guardar cambios?\',
        mensaje:   \'Se actualizará tu información de perfil. Podrás editarla en cualquier momento.\',
        icon:      \'fas fa-save\',
        iconBg:    \'bg-blue-50\',
        iconColor: \'text-blue-500\',
        btnClass:  \'bg-blue-500 hover:bg-blue-600\',
        accion:    () => submitPerfil(),
    },
    cancelar: {
        titulo:    \'¿Descartar cambios?\',
        mensaje:   \'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.\',
        icon:      \'fas fa-times-circle\',
        iconBg:    \'bg-red-50\',
        iconColor: \'text-red-500\',
        btnClass:  \'bg-red-500 hover:bg-red-600\',
        accion:    () => cerrarModalPerfil(),
    },
};

const EXITO_CONFIG_PERFIL = {
    exito: {
        titulo:    \'¡Perfil Actualizado!\',
        mensaje:   \'Tu información de perfil se ha guardado correctamente.\',
        icon:      \'fas fa-check-circle\',
        iconBg:    \'bg-green-50\',
        iconColor: \'text-green-500\',
        btnClass:  \'bg-green-500 hover:bg-green-600\',
    }
};

function mostrarConfirmacionPerfil(tipo) {
    const cfg = CONFIRM_CONFIG_PERFIL[tipo];
    if (!cfg) return;
    window.confirmar({
        titulo:    cfg.titulo,
        mensaje:   cfg.mensaje,
        icon:      cfg.icon,
        iconBg:    cfg.iconBg,
        iconColor: cfg.iconColor,
        btnClass:  cfg.btnClass,
        onConfirm: cfg.accion,
    });
}

function mostrarExitoPerfil() {
    const cfg = EXITO_CONFIG_PERFIL.exito;
    window.confirmar({
        tipo:           \'success\',
        titulo:         cfg.titulo,
        mensaje:        cfg.mensaje,
        icon:           cfg.icon,
        iconBg:         cfg.iconBg,
        iconColor:      cfg.iconColor,
        btnClass:       cfg.btnClass,
        textoConfirmar: \'OK\',
        soloConfirmar:  true,
    });
    setTimeout(() => window.cerrarConfirmar(), 2000);
}

// ── Helper: resaltar error ─────────────────────────────────────────────────────

function resaltarErrorPerfil(campoId, mensaje) {
    const el = document.getElementById(campoId);
    if (!el) return;
    el.classList.add(\'border-red-400\', \'ring-2\', \'ring-red-300\');
    el.focus();
    setTimeout(() => el.classList.remove(\'border-red-400\', \'ring-2\', \'ring-red-300\'), 2500);
    const prev = el.parentElement.querySelector(\'.error-msg\');
    if (prev) prev.remove();
    const msg = document.createElement(\'p\');
    msg.className = \'error-msg text-xs text-red-500 mt-1\';
    msg.textContent = mensaje;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ── Actualizar la interfaz con los nuevos datos ───────────────────────────────

function actualizarInterfazPerfil(data) {
    const u = data.usuario || {};
    const p = data.perfil  || {};

    const nombreCompleto = `${u.nombre ?? \'\'} ${u.apellido ?? \'\'}`.trim() || \'Usuario\';
    const iniciales = ((u.nombre?.charAt(0) || \'U\') + (u.apellido?.charAt(0) || \'S\')).toUpperCase();

    const setText = (id, value, fallback = \'—\') => {
        const el = document.getElementById(id);
        if (el) el.textContent = (value && String(value).trim() !== \'\') ? value : fallback;
    };

    // ── Header del dashboard ──────────────────────────────────────────────────
    setText(\'header-nombre-usuario\', nombreCompleto, \'Usuario\');

    const headerAvatar = document.getElementById(\'header-avatar\');
    if (headerAvatar) {
        headerAvatar.innerHTML = p.foto_perfil
            ? `' => 'const CSRF_PROFILE = document.querySelector(\'meta[name="csrf-token"]\').content;

// ── Confirmation settings ─────────────────────── ───────────────────────

const CONFIRM_CONFIG_PROFILE = {
    save: {
        title: \'Save changes?\',
        message: \'Your profile information will be updated. You can edit it at any time.\',
        icon: \'fas fa-save\',
        iconBg: \'bg-blue-50\',
        iconColor: \'text-blue-500\',
        btnClass: \'bg-blue-500 hover:bg-blue-600\',
        action: () => submitProfile(),
    },
    cancel: {
        title: \'Discard changes?\',
        message: \'The data entered will not be saved. This action cannot be undone.\',
        icon: \'fas fa-times-circle\',
        iconBg: \'bg-red-50\',
        iconColor: \'text-red-500\',
        btnClass: \'bg-red-500 hover:bg-red-600\',
        action: () => closeProfileModal(),
    },
};

const SUCCESS_CONFIG_PROFILE = {
    success: {
        title: \'Updated Profile!\',
        message: \'Your profile information has been successfully saved.\',
        icon: \'fas fa-check-circle\',
        iconBg: \'bg-green-50\',
        iconColor: \'text-green-500\',
        btnClass: \'bg-green-500 hover:bg-green-600\',
    }
};

function showProfileConfirmation(type) {
    const cfg = CONFIRM_CONFIG_PROFILE[type];
    if (!cfg) return;
    window.confirm({
        title: cfg.title,
        message: cfg.message,
        icon: cfg.icon,
        iconBg: cfg.iconBg,
        iconColor: cfg.iconColor,
        btnClass: cfg.btnClass,
        onConfirm: cfg.action,
    });
}

function showProfileSuccess() {
    const cfg = SUCCESS_CONFIG_PROFILE.success;
    window.confirm({
        type: \'success\',
        title: cfg.title,
        message: cfg.message,
        icon: cfg.icon,
        iconBg: cfg.iconBg,
        iconColor: cfg.iconColor,
        btnClass: cfg.btnClass,
        textConfirm: \'OK\',
        justConfirm: true,
    });
    setTimeout(() => window.closeConfirm(), 2000);
}

// ── Helper: highlight error ────────────────────────── ───────────────────────────

function highlightProfileError(fieldId, message) {
    const el = document.getElementById(fieldId);
    if (!el) return;
    el.classList.add(\'border-red-400\', \'ring-2\', \'ring-red-300\');
    el.focus();
    setTimeout(() => el.classList.remove(\'border-red-400\', \'ring-2\', \'ring-red-300\'), 2500);
    const prev = el.parentElement.querySelector(\'.error-msg\');
    if (prev) prev.remove();
    const msg = document.createElement(\'p\');
    msg.className = \'error-msg text-xs text-red-500 mt-1\';
    msg.textContent = message;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ── Update the interface with the new data ───────────────────────────────

function updateProfileInterface(data) {
    const u = data.user || {};
    const p = data.profile || {};

    const fullName = `${u.name ?? \'\'} ${yourlastname?? \'\'}`.trim() || \'User\';
    const initials = ((u.firstname?.charAt(0) || \'U\') + (u.lastname?.charAt(0) || \'S\')).toUpperCase();

    const setText = (id, value, fallback = \'—\') => {
        const el = document.getElementById(id);
        if (el) el.textContent = (value && String(value).trim() !== \'\') ? value : fallback;
    };

    // ── Dashboard header ───────────────────────── ─────────────────────────
    setText(\'header-username\', fullName, \'User\');

    const headerAvatar = document.getElementById(\'header-avatar\');
    if (headerAvatar) {
        headerAvatar.innerHTML = p.profile_photo
            ? `',
  '`
            : `' => '`
            : `',
  '${iniciales}' => '${initials}',
  '`;
    }

    // ── Cabecera del perfil ───────────────────────────────────────────────────
    setText(\'perfil-nombre-header\',    nombreCompleto, \'Usuario\');
    setText(\'perfil-titulo-header\',    p.titulo_profesional, \'Desarrollador\');
    setText(\'perfil-ubicacion-header\', p.ubicacion, \'Ubicación no especificada\');
    setText(\'perfil-correo-header\',    u.correo_electronico, \'___\');

    const fotoContainer = document.getElementById(\'perfil-foto-container\');
    if (fotoContainer) {
        fotoContainer.innerHTML = p.foto_perfil
            ? `' => '`;
    }

    // ── Profile header ───────────────────────── ──────────────────────────
    setText(\'profile-header-name\', fullName, \'User\');
    setText(\'profile-title-header\', p.professional_title, \'Developer\');
    setText(\'profile-location-header\', p.location, \'Unspecified location\');
    setText(\'profile-email-header\', u.email, \'___\');

    const photoContainer = document.getElementById(\'profile-photo-container\');
    if (photoContainer) {
        photoContainer.innerHTML = p.profile_photo
            ? `',
  '`;
    }

    // ── Biografía ─────────────────────────────────────────────────────────────
    setText(\'perfil_biografia_texto\', p.biografia,
        \'Sin biografía. Haz clic en "Editar Perfil" para agregar una descripción.\');

    // ── Lista de datos ────────────────────────────────────────────────────────
    setText(\'perfil-datos-nombre\',    nombreCompleto);
    setText(\'perfil-datos-correo\',    u.correo_electronico);
    setText(\'perfil-datos-telefono\',  u.telefono);
    setText(\'perfil-datos-titulo\',    p.titulo_profesional);
    setText(\'perfil-datos-ubicacion\', p.ubicacion);

    // ── Links / Redes sociales ────────────────────────────────────────────────
    const linksMap = {};
    (data.links || []).forEach(l => { linksMap[l.tipo] = l.url; });

    const linksConfig = {
        github:    { icon: \'fab fa-github\',   color: \'hover:text-gray-900\' },
        linkedin:  { icon: \'fab fa-linkedin\', color: \'hover:text-blue-700\' },
        twitter:   { icon: \'fab fa-twitter\',  color: \'hover:text-blue-400\' },
        portfolio: { icon: \'fas fa-globe\',    color: \'hover:text-green-600\' },
    };

    // Iconos del encabezado
    const socialContainer = document.getElementById(\'perfil-social-container\');
    if (socialContainer) {
        socialContainer.innerHTML = \'\';
        for (const [tipo, cfg] of Object.entries(linksConfig)) {
            const url = linksMap[tipo];
            const html = (url && url.trim() !== \'\')
                ? `' => '`;
    }

    // ── Biography ────────────────────────────── ───────────────────────────────
    setText(\'profile_biography_text\', p.biography,
        \'No biography. Click "Edit Profile" to add a description.\');

    // ── Data list ──────────────────────────── ────────────────────────────
    setText(\'profile-data-name\', fullName);
    setText(\'profile-email-data\', u.email);
    setText(\'phone-data-profile\', u.phone);
    setText(\'profile-data-title\', p.professional_title);
    setText(\'profile-location-data\', p.location);

    // ── Links / Social networks ──────────────────────── ────────────────────────
    const linksMap = {};
    (data.links || []).forEach(l => { linksMap[l.type] = l.url; });

    const linksConfig = {
        github: { icon: \'fab fa-github\', color: \'hover:text-gray-900\' },
        linkedin: { icon: \'fab fa-linkedin\', color: \'hover:text-blue-700\' },
        twitter: { icon: \'fab fa-twitter\', color: \'hover:text-blue-400\' },
        portfolio: { icon: \'fas fa-globe\', color: \'hover:text-green-600\' },
    };

    // Header icons
    const socialContainer = document.getElementById(\'social-profile-container\');
    if (socialContainer) {
        socialContainer.innerHTML = \'\';
        for (const [type, cfg] of Object.entries(linksConfig)) {
            const url = linksMap[type];
            const html = (url && url.trim() !== \'\')
                ? `',
  '`
                : `' => '`
                : `',
  '`;
            socialContainer.insertAdjacentHTML(\'beforeend\', html);
        }
    }

    // Lista de redes en el panel de datos
    for (const tipo of Object.keys(linksConfig)) {
        const cell = document.getElementById(`perfil-datos-${tipo}`);
        if (!cell) continue;
        const url = linksMap[tipo];
        cell.innerHTML = (url && url.trim() !== \'\')
            ? `' => '`;
            socialContainer.insertAdjacentHTML(\'beforeend\', html);
        }
    }

    // List of networks in the data panel
    for (const type of Object.keys(linksConfig)) {
        const cell = document.getElementById(`profile-data-${type}`);
        if (! cell) continue;
        const url = linksMap[type];
        cell.innerHTML = (url && url.trim() !== \'\')
            ? `',
  '${url}' => '${url}',
  '`;
    }
}

// ── Modal Perfil ───────────────────────────────────────────────────────────────

function abrirModalPerfil() {
    document.getElementById(\'formPerfil\').reset();
    
    fetch(\'{{ route("perfil.editar") }}\')
        .then(response => response.json())
        .then(data => {
            document.getElementById(\'edit_nombre\').value = data.usuario?.nombre || \'\';
            document.getElementById(\'edit_apellido\').value = data.usuario?.apellido || \'\';
            document.getElementById(\'edit_correo\').value = data.usuario?.correo_electronico || \'\';
            document.getElementById(\'edit_telefono\').value = data.usuario?.telefono || \'\';
            document.getElementById(\'edit_biografia\').value = data.perfil?.biografia || \'\';
            document.getElementById(\'edit_titulo\').value = data.perfil?.titulo_profesional || \'\';
            document.getElementById(\'edit_ubicacion\').value = data.perfil?.ubicacion || \'\';
            document.getElementById(\'edit_foto\').value = data.perfil?.foto_perfil || \'\';
            
            const linksMap = {};
            (data.links || []).forEach(link => {
                linksMap[link.tipo] = link.url;
            });
            document.getElementById(\'link_github\').value = linksMap.github || \'\';
            document.getElementById(\'link_linkedin\').value = linksMap.linkedin || \'\';
            document.getElementById(\'link_twitter\').value = linksMap.twitter || \'\';
            document.getElementById(\'link_portfolio\').value = linksMap.portfolio || \'\';
        })
        .catch(error => {
            console.error(\'Error:\', error);
            alert(\'Error al cargar los datos del perfil\');
        });
    
    document.getElementById(\'modalPerfil\').classList.remove(\'hidden\');
    document.getElementById(\'modalPerfil\').classList.add(\'flex\');
}

function cerrarModalPerfil() {
    document.getElementById(\'modalPerfil\').classList.add(\'hidden\');
    document.getElementById(\'modalPerfil\').classList.remove(\'flex\');
}

document.getElementById(\'modalPerfil\')?.addEventListener(\'click\', function(e) {
    if (e.target === this) confirmarCancelarPerfil();
});

// ── Disparadores de confirmación ──────────────────────────────────────────────

function confirmarGuardarPerfil() {
    const nombre = document.getElementById(\'edit_nombre\').value.trim();
    const apellido = document.getElementById(\'edit_apellido\').value.trim();
    const correo = document.getElementById(\'edit_correo\').value.trim();

    if (!nombre) {
        resaltarErrorPerfil(\'edit_nombre\', \'El nombre es obligatorio.\');
        return;
    }
    if (!apellido) {
        resaltarErrorPerfil(\'edit_apellido\', \'El apellido es obligatorio.\');
        return;
    }
    if (!correo) {
        resaltarErrorPerfil(\'edit_correo\', \'El correo electrónico es obligatorio.\');
        return;
    }
    if (!correo.includes(\'@\')) {
        resaltarErrorPerfil(\'edit_correo\', \'Ingresa un correo electrónico válido.\');
        return;
    }

    mostrarConfirmacionPerfil(\'guardar\');
}

function confirmarCancelarPerfil() {
    const form = document.getElementById(\'formPerfil\');
    const inputs = form.querySelectorAll(\'input, textarea\');
    let hasChanges = false;
    inputs.forEach(input => {
        if (input.value && input.value.trim() !== \'\') {
            hasChanges = true;
        }
    });
    
    if (hasChanges) {
        mostrarConfirmacionPerfil(\'cancelar\');
    } else {
        cerrarModalPerfil();
    }
}

// ── Enviar formulario y actualizar vista ──────────────────────────────────────

function submitPerfil() {
    const formData = new FormData(document.getElementById(\'formPerfil\'));
    
    fetch(\'{{ route("perfil.actualizar") }}\', {
        method: \'POST\',
        body: formData,
        headers: {
            \'X-Requested-With\': \'XMLHttpRequest\'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalPerfil();
            return fetch(\'{{ route("perfil.editar") }}\');
        } else {
            alert(data.message || \'Error al guardar\');
            throw new Error(\'Error en guardado\');
        }
    })
    .then(response => response.json())
    .then(data => {
        actualizarInterfazPerfil(data);
        mostrarExitoPerfil();
    })
    .catch(error => {
        console.error(\'Error:\', error);
        if (error.message !== \'Error en guardado\') {
            alert(\'Hubo un problema al guardar\');
        }
    });
}

document.getElementById(\'formPerfil\')?.addEventListener(\'submit\', function(e) {
    e.preventDefault();
    confirmarGuardarPerfil();
});

// Cerrar con tecla ESC
document.addEventListener(\'keydown\', function(e) {
    if (e.key === \'Escape\') {
        const modal = document.getElementById(\'modalPerfil\');
        if (modal && !modal.classList.contains(\'hidden\')) {
            confirmarCancelarPerfil();
        }
    }
});

console.log(\'Scripts de perfil cargados correctamente\');' => '`;
    }
}

// ── Modal Profile ─────────────────────────────── ────────────────────────────────

function openProfileModal() {
    document.getElementById(\'formProfile\').reset();
    
    fetch(\'{{ route("profile.edit") }}\')
        .then(response => response.json())
        .then(data => {
            document.getElementById(\'edit_name\').value = data.user?.name || \'\';
            document.getElementById(\'edit_lastname\').value = data.user?.lastname || \'\';
            document.getElementById(\'edit_mail\').value = data.user?.email || \'\';
            document.getElementById(\'edit_phone\').value = data.user?.phone || \'\';
            document.getElementById(\'edit_biography\').value = data.profile?.biography || \'\';
            document.getElementById(\'edit_title\').value = data.profile?.professional_title || \'\';
            document.getElementById(\'edit_location\').value = data.profile?.location || \'\';
            document.getElementById(\'edit_photo\').value = data.profile?.photo_profile || \'\';
            
            const linksMap = {};
            (data.links || []).forEach(link => {
                linksMap[link.type] = link.url;
            });
            document.getElementById(\'link_github\').value = linksMap.github || \'\';
            document.getElementById(\'link_linkedin\').value = linksMap.linkedin || \'\';
            document.getElementById(\'link_twitter\').value = linksMap.twitter || \'\';
            document.getElementById(\'link_portfolio\').value = linksMap.portfolio || \'\';
        })
        .catch(error => {
            console.error(\'Error:\', error);
            alert(\'Error loading profile data\');
        });
    
    document.getElementById(\'modalProfile\').classList.remove(\'hidden\');
    document.getElementById(\'modalProfile\').classList.add(\'flex\');
}

function closeProfileModal() {
    document.getElementById(\'modalProfile\').classList.add(\'hidden\');
    document.getElementById(\'modalProfile\').classList.remove(\'flex\');
}

document.getElementById(\'modalProfile\')?.addEventListener(\'click\', function(e) {
    if (e.target === this) confirmCancelProfile();
});

// ── Confirmation triggers ─────────────────────── ───────────────────────

function confirmSaveProfile() {
    const name = document.getElementById(\'edit_name\').value.trim();
    const lastname = document.getElementById(\'edit_lastname\').value.trim();
    const mail = document.getElementById(\'edit_mail\').value.trim();

    if (!name) {
        highlightProfileError(\'edit_name\', \'The name is required.\');
        return;
    }
    if (!lastname) {
        highlightProfileError(\'edit_lastname\', \'Last name is required.\');
        return;
    }
    if (!mail) {
        highlightProfileError(\'edit_email\', \'Email is required.\');
        return;
    }
    if (!mail.includes(\'@\')) {
        highlightProfileError(\'edit_email\', \'Enter a valid email.\');
        return;
    }

    showProfileConfirmation(\'save\');
}

function confirmCancelProfile() {
    const form = document.getElementById(\'formProfile\');
    const inputs = form.querySelectorAll(\'input, textarea\');
    let hasChanges = false;
    inputs.forEach(input => {
        if (input.value && input.value.trim() !== \'\') {
            hasChanges = true;
        }
    });
    
    if (hasChanges) {
        showProfileConfirmation(\'cancel\');
    } else {
        closeProfileModal();
    }
}

// ── Submit form and update view ──────────────────────────────────────

function submitProfile() {
    const formData = new FormData(document.getElementById(\'formProfile\'));
    
    fetch(\'{{ route("profile.update") }}\', {
        method: \'POST\',
        body: formData,
        headers: {
            \'X-Requested-With\': \'XMLHttpRequest\'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeProfileModal();
            return fetch(\'{{ route("profile.edit") }}\');
        } else {
            alert(data.message || \'Error saving\');
            throw new Error(\'Error saving\');
        }
    })
    .then(response => response.json())
    .then(data => {
        updateProfileInterface(data);
        showProfileSuccess();
    })
    .catch(error => {
        console.error(\'Error:\', error);
        if (error.message !== \'Error saving\') {
            alert(\'There was a problem saving\');
        }
    });
}

document.getElementById(\'formProfile\')?.addEventListener(\'submit\', function(e) {
    e.preventDefault();
    confirmSaveProfile();
});

// Close with ESC key
document.addEventListener(\'keydown\', function(e) {
    if (e.key === \'Escape\') {
        const modal = document.getElementById(\'modalProfile\');
        if (modal && !modal.classList.contains(\'hidden\')) {
            confirmCancelProfile();
        }
    }
});

console.log(\'Profile scripts loaded successfully\');',
  '[\'label\' => \'en curso\',   \'class\' => \'bg-[#1e3a5f]/10 text-[#1e3a5f]\'],
        \'completado\'  => [\'label\' => \'finalizado\',  \'class\' => \'bg-indigo-100 text-indigo-700\'],
        \'pendiente\'   => [\'label\' => \'pendiente\',   \'class\' => \'bg-gray-100 text-gray-600\'],
        \'cancelado\'   => [\'label\' => \'cancelado\',   \'class\' => \'bg-red-100 text-[#e11d48]\'],
    ];

    $badge    = $estadoBadge[$proyecto->estado] ?? [\'label\' => $proyecto->estado, \'class\' => \'bg-gray-100 text-gray-600\'];
    $tags     = $proyecto->tecnologias
        ? array_filter(array_map(\'trim\', explode(\',\', $proyecto->tecnologias)))
        : [];
    $fechaIni  = \\Carbon\\Carbon::parse($proyecto->fecha_ini)->format(\'d M Y\');
    $fechaFin  = $proyecto->fecha_fin
        ? \\Carbon\\Carbon::parse($proyecto->fecha_fin)->format(\'d M Y\')
        : \'Presente\';
@endphp' => '[\'label\' => \'in progress\', \'class\' => \'bg-[#1e3a5f]/10 text-[#1e3a5f]\'],
        \'completed\' => [\'label\' => \'completed\', \'class\' => \'bg-indigo-100 text-indigo-700\'],
        \'pending\' => [\'label\' => \'pending\', \'class\' => \'bg-gray-100 text-gray-600\'],
        \'cancelled\' => [\'label\' => \'canceled\', \'class\' => \'bg-red-100 text-[#e11d48]\'],
    ];

    $badge = $stateBadge[$project->state] ?? [\'label\' => $project->state, \'class\' => \'bg-gray-100 text-gray-600\'];
    $tags = $project->technologies
        ? array_filter(array_map(\'trim\', explode(\',\', $project->technologies)))
        : [];
    $dateIni = \\Carbon\\Carbon::parse($project->date_ini)->format(\'d M Y\');
    $end_date = $project->end_date
        ? \\Carbon\\Carbon::parse($project->end_date)->format(\'d M Y\')
        : \'Present\';
@endphp',
  'id_proyecto }}"
     data-estado="{{ $proyecto->estado }}">

    {{-- Nombre + estado --}}' => 'project_id }}"
     data-state="{{ $project->state }}">

    {{-- Name + status --}}',
  'url_link }}" target="_blank"
        class="flex items-center gap-2 text-xs font-medium bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-lg w-fit transition">' => 'url_link }}" target="_blank"
        class="flex items-center gap-2 text-xs font-medium bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-lg w-fit transition">',
  'Ver Demo' => 'View Demo',
  'id_proyecto }})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition">' => 'id_proyecto }})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition">',
  'id_proyecto }})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">' => 'id_proyecto }})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">',
  'Crear Nuevo Proyecto' => 'Create New Project',
  'Completa la información de tu proyecto' => 'Complete your project information',
  'Proyecto' => 'Project',
  'Información Básica' => 'Basic Information',
  'Datos principales de tu proyecto' => 'Main data of your project',
  'Tecnologías Utilizadas' => 'Technologies Used',
  'Agrega las tecnologías, lenguajes y frameworks que usaste' => 'Add the technologies, languages ​​and frameworks you used',
  'Haz clic para seleccionar, vuelve a hacer clic para deseleccionar' => 'Click to select, click again to deselect',
  'Agregar seleccionadas' => 'Add selected',
  'Estado y Visibilidad' => 'Status and Visibility',
  'Configura el estado actual y quién puede ver este proyecto' => 'Set the current status and who can see this project',
  'Estado del Proyecto' => 'Project Status',
  'URL de la página web o aplicación desarrollada para la empresa o institución' => 'URL of the website or application developed for the company or institution',
  'URL del Proyecto Desplegado' => 'Deployed Project URL',
  'Enlace a la aplicación o sitio web en producción desarrollada para el cliente' => 'Link to the production application or website developed for the client',
  'Referencias del Proyecto' => 'Project References',
  'Información sobre personas que pueden dar referencias sobre este proyecto' => 'Information about people who can give references about this project',
  'Nombre, cargo, email y teléfono de las personas que pueden dar referencias' => 'Name, position, email and telephone number of people who can provide references',
  'Cronograma' => 'Timeline',
  'Define las fechas de inicio y finalización' => 'Define start and end dates',
  'Fecha de Inicio' => 'Start Date',
  'Fecha de Finalización' => 'Completion Date',
  'Disponible solo cuando el estado es "Completado"' => 'Available only when status is "Completed"',
  'Ej: Sistema de Gestión de Inventario' => 'Ex: Inventory Management System',
  'Describe brevemente el proyecto y su objetivo principal...' => 'Briefly describe the project and its main objective...',
  'Ej: Juan Pérez - Supervisor de Proyecto&#10;Email: juan@ejemplo.com&#10;Teléfono: +123456789' => 'Ex: Juan Pérez - Project Supervisor
Email: juan@ejemplo.com
Telephone: +123456789',
  'const CSRF    = document.querySelector(\'meta[name="csrf-token"]\').content;
const USER_ID = {{ $userId }};

// ── Helpers ───────────────────────────────────────────────────────────────────

function apiFetch(url, options = {}) {
    return fetch(url, {
        ...options,
        headers: { \'X-CSRF-TOKEN\': CSRF, ...options.headers },
    });
}

function isValidUrl(str) {
    try { new URL(str); return true; } catch (_) { return false; }
}

function setModalVisible(id, show) {
    document.getElementById(id).classList.toggle(\'hidden\', !show);
    document.getElementById(id).classList.toggle(\'flex\',   show);
}

// ── Stats ─────────────────────────────────────────────────────────────────────

function recalcularStats() {
    const cards = document.querySelectorAll(\'#proyectos-grid [data-proyecto-id]\');
    let total = 0, enCurso = 0, finalizados = 0;
    cards.forEach(c => {
        total++;
        if (c.dataset.estado === \'en_progreso\') enCurso++;
        if (c.dataset.estado === \'completado\')  finalizados++;
    });
    document.getElementById(\'stat-total\').textContent       = total;
    document.getElementById(\'stat-en-curso\').textContent    = enCurso;
    document.getElementById(\'stat-finalizados\').textContent = finalizados;

    document.getElementById(\'proyectos-grid\').classList.toggle(\'hidden\', total === 0);
    document.getElementById(\'empty-state\').classList.toggle(\'hidden\',   total !== 0);

    // Actualizar stats del Resumen general
    const resumenRepos = document.getElementById(\'resumen-stat-repos\');
    if (resumenRepos) resumenRepos.textContent = total;
    const resumenActividades = document.getElementById(\'resumen-stat-actividades\');
    if (resumenActividades) resumenActividades.textContent = (total * 45).toLocaleString();
}

// ── Construir HTML de tarjeta ─────────────────────────────────────────────────

const ESTADO_BADGE = {
    en_progreso: { label: \'en curso\',   cls: \'bg-[#1e3a5f]/10 text-[#1e3a5f]\' },
    completado:  { label: \'finalizado\', cls: \'bg-indigo-100 text-indigo-700\'   },
    pendiente:   { label: \'pendiente\',  cls: \'bg-gray-100 text-gray-600\'       },
    cancelado:   { label: \'cancelado\',  cls: \'bg-red-100 text-[#e11d48]\'       },
};

const MESES = [\'Ene\',\'Feb\',\'Mar\',\'Abr\',\'May\',\'Jun\',\'Jul\',\'Ago\',\'Sep\',\'Oct\',\'Nov\',\'Dic\'];

function formatFecha(str) {
    if (!str) return \'Presente\';
    const d = new Date(str + \'T00:00:00\');
    return `${String(d.getDate()).padStart(2,\'0\')} ${MESES[d.getMonth()]} ${d.getFullYear()}`;
}

// Extrae la parte YYYY-MM-DD de cualquier formato de fecha que devuelva Laravel
function toInputDate(str) {
    if (!str) return \'\';
    return String(str).substring(0, 10);
}

function buildCardHTML(p) {
    const badge    = ESTADO_BADGE[p.estado] ?? { label: p.estado, cls: \'bg-gray-100 text-gray-600\' };
    const tags     = p.tecnologias ? p.tecnologias.split(\',\').map(t => t.trim()).filter(Boolean) : [];
    const fechaFin = p.fecha_fin ? formatFecha(p.fecha_fin) : \'Presente\';

    const tagsHTML = tags.map(t =>
        `' => 'const CSRF    = document.querySelector(\'meta[name="csrf-token"]\').content;
const USER_ID = {{ $userId }};

// ── Helpers ───────────────────────────────────────────────────────────────────

function apiFetch(url, options = {}) {
    return fetch(url, {
        ...options,
        headers: { \'X-CSRF-TOKEN\': CSRF, ...options.headers },
    });
}

function isValidUrl(str) {
    try { new URL(str); return true; } catch (_) { return false; }
}

function setModalVisible(id, show) {
    document.getElementById(id).classList.toggle(\'hidden\', !show);
    document.getElementById(id).classList.toggle(\'flex\',   show);
}

// ── Stats ─────────────────────────────────────────────────────────────────────

function recalcularStats() {
    const cards = document.querySelectorAll(\'#proyectos-grid [data-proyecto-id]\');
    let total = 0, enCurso = 0, finalizados = 0;
    cards.forEach(c => {
        total++;
        if (c.dataset.estado === \'en_progreso\') enCurso++;
        if (c.dataset.estado === \'completado\')  finalizados++;
    });
    document.getElementById(\'stat-total\').textContent       = total;
    document.getElementById(\'stat-en-curso\').textContent    = enCurso;
    document.getElementById(\'stat-finalizados\').textContent = finalizados;

    document.getElementById(\'proyectos-grid\').classList.toggle(\'hidden\', total === 0);
    document.getElementById(\'empty-state\').classList.toggle(\'hidden\',   total !== 0);

    // Actualizar stats del Resumen general
    const resumenRepos = document.getElementById(\'resumen-stat-repos\');
    if (resumenRepos) resumenRepos.textContent = total;
    const resumenActividades = document.getElementById(\'resumen-stat-actividades\');
    if (resumenActividades) resumenActividades.textContent = (total * 45).toLocaleString();
}

// ── Construir HTML de tarjeta ─────────────────────────────────────────────────

const ESTADO_BADGE = {
    en_progreso: { label: \'en curso\',   cls: \'bg-[#1e3a5f]/10 text-[#1e3a5f]\' },
    completado:  { label: \'finalizado\', cls: \'bg-indigo-100 text-indigo-700\'   },
    pendiente:   { label: \'pendiente\',  cls: \'bg-gray-100 text-gray-600\'       },
    cancelado:   { label: \'cancelado\',  cls: \'bg-red-100 text-[#e11d48]\'       },
};

const MESES = [\'Ene\',\'Feb\',\'Mar\',\'Abr\',\'May\',\'Jun\',\'Jul\',\'Ago\',\'Sep\',\'Oct\',\'Nov\',\'Dic\'];

function formatFecha(str) {
    if (!str) return \'Presente\';
    const d = new Date(str + \'T00:00:00\');
    return `${String(d.getDate()).padStart(2,\'0\')} ${MESES[d.getMonth()]} ${d.getFullYear()}`;
}

// Extrae la parte YYYY-MM-DD de cualquier formato de fecha que devuelva Laravel
function toInputDate(str) {
    if (!str) return \'\';
    return String(str).substring(0, 10);
}

function buildCardHTML(p) {
    const badge    = ESTADO_BADGE[p.estado] ?? { label: p.estado, cls: \'bg-gray-100 text-gray-600\' };
    const tags     = p.tecnologias ? p.tecnologias.split(\',\').map(t => t.trim()).filter(Boolean) : [];
    const fechaFin = p.fecha_fin ? formatFecha(p.fecha_fin) : \'Presente\';

    const tagsHTML = tags.map(t =>
        `',
  '${t}' => '${t}',
  '`
    ).join(\'\');

    const demoBtn = p.url_link
        ? `' => '`
    ).join(\'\');

    const demoBtn = p.url_link
        ? `',
  '`
        : \'\';

    return `' => '`
        : \'\';

    return `',
  '${p.nombre}' => '${p.name}',
  '${badge.label}' => '${badge.label}',
  '${p.descripcion ?? \'Sin descripción\'}' => '${p.description ?? \'No description\'}',
  '${formatFecha(p.fecha_ini)} – ${fechaFin}' => '${formatDate(p.date_ini)} – ${enddate}',
  '${tags.length ? `' => '${tags.length ? `',
  '${tagsHTML}' => '${tagsHTML}',
  '` : \'\'}

    ${demoBtn}' => '` : \'\'}

    ${demoBtn}',
  '`;
}

// ── Modal de Confirmación ─────────────────────────────────────────────────────

const CONFIRM_CONFIG = {
    guardar: {
        titulo:     \'¿Guardar proyecto?\',
        mensaje:    \'Se almacenará toda la información ingresada. Podrás editarla en cualquier momento.\',
        icon:       \'fas fa-save\',
        iconBg:     \'bg-[#1e3a5f]/10\',
        iconColor:  \'text-[#1e3a5f]\',
        headerColor:\'bg-[#1e3a5f]\',
        btnClass:   \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80\',
        accion:     () => submitProyecto(),
    },
    cancelar: {
        titulo:     \'¿Descartar cambios?\',
        mensaje:    \'Los datos ingresados no se guardarán. Esta acción no se puede deshacer.\',
        icon:       \'fas fa-times-circle\',
        iconBg:     \'bg-red-50\',
        iconColor:  \'text-red-500\',
        headerColor:\'bg-red-500\',
        btnClass:   \'bg-red-500 hover:bg-red-600\',
        accion:     () => cerrarModalProyecto(),
    },
    editar: {
        titulo:     \'¿Editar este proyecto?\',
        mensaje:    \'Vas a modificar la información de este proyecto. Podrás cancelar si cambias de opinión.\',
        icon:       \'fas fa-pencil-alt\',
        iconBg:     \'bg-[#1e3a5f]/10\',
        iconColor:  \'text-[#1e3a5f]\',
        headerColor:\'bg-[#1e3a5f]\',
        btnClass:   \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80\',
        accion:     null,
    },
    eliminar: {
        titulo:     \'¿Eliminar proyecto?\',
        mensaje:    \'Esta acción es permanente y no se puede deshacer. El proyecto será eliminado definitivamente.\',
        icon:       \'fas fa-trash-alt\',
        iconBg:     \'bg-[#e11d48]/10\',
        iconColor:  \'text-[#e11d48]\',
        headerColor:\'bg-[#e11d48]\',
        btnClass:   \'bg-[#e11d48] hover:bg-[#e11d48]/80\',
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
    const nombre   = document.getElementById(\'proj_nombre\').value.trim();
    const fechaIni = document.getElementById(\'proj_fecha_ini\').value;
    const fechaFin = document.getElementById(\'proj_fecha_fin\').value;
    const urlLink  = document.getElementById(\'proj_url_link\').value.trim();

    if (!nombre) {
        resaltarError(\'proj_nombre\', \'El nombre del proyecto es obligatorio.\');
        return;
    }
    if (nombre.length > 100) {
        resaltarError(\'proj_nombre\', \'El nombre no puede superar los 100 caracteres.\');
        return;
    }
    if (!fechaIni) {
        resaltarError(\'proj_fecha_ini\', \'La fecha de inicio es obligatoria.\');
        return;
    }
    const estado = document.getElementById(\'proj_estado\').value;
    if (estado === \'completado\' && !fechaFin) {
        resaltarError(\'proj_fecha_fin\', \'La fecha de finalización es obligatoria si el estado es Completado.\');
        return;
    }
    const hoyStr = new Date().toISOString().split(\'T\')[0];
    if (estado === \'completado\' && fechaFin && fechaFin > hoyStr) {
        resaltarError(\'proj_fecha_fin\', \'La fecha de finalización no puede ser posterior a la fecha actual.\');
        return;
    }
    if (fechaFin && fechaFin' => '`;
}

// ── Confirmation Modal ────────────────────────── ───────────────────────────

const CONFIRM_CONFIG = {
    save: {
        title: \'Save project?\',
        message: \'All information entered will be stored. You can edit it at any time.\',
        icon: \'fas fa-save\',
        iconBg: \'bg-[#1e3a5f]/10\',
        iconColor: \'text-[#1e3a5f]\',
        headerColor:\'bg-[#1e3a5f]\',
        btnClass: \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80\',
        action: () => submitProject(),
    },
    cancel: {
        title: \'Discard changes?\',
        message: \'The data entered will not be saved. This action cannot be undone.\',
        icon: \'fas fa-times-circle\',
        iconBg: \'bg-red-50\',
        iconColor: \'text-red-500\',
        headerColor:\'bg-red-500\',
        btnClass: \'bg-red-500 hover:bg-red-600\',
        action: () => closeProjectModal(),
    },
    edit: {
        title: \'Edit this project?\',
        message: \'You are going to modify the information of this project. You can cancel if you change your mind.\',
        icon: \'fas fa-pencil-alt\',
        iconBg: \'bg-[#1e3a5f]/10\',
        iconColor: \'text-[#1e3a5f]\',
        headerColor:\'bg-[#1e3a5f]\',
        btnClass: \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/80\',
        action: null,
    },
    remove: {
        title: \'Delete project?\',
        message: \'This action is permanent and cannot be undone. The project will be definitively eliminated.\',
        icon: \'fas fa-trash-alt\',
        iconBg: \'bg-[#e11d48]/10\',
        iconColor: \'text-[#e11d48]\',
        headerColor:\'bg-[#e11d48]\',
        btnClass: \'bg-[#e11d48] hover:bg-[#e11d48]/80\',
        action: null,
    },
};

function showConfirmation(type) {
    const cfg = CONFIRM_CONFIG[type];
    if (!cfg) return;
    window.confirm({
        title: cfg.title,
        message: cfg.message,
        icon: cfg.icon,
        iconBg: cfg.iconBg,
        iconColor: cfg.iconColor,
        headerColor: cfg.headerColor,
        btnClass: cfg.btnClass,
        onConfirm: cfg.action,
    });
}

// ── Confirmation triggers ─────────────────────── ───────────────────────

function confirmSave() {
    const name = document.getElementById(\'proj_name\').value.trim();
    const dateIni = document.getElementById(\'proj_date_ini\').value;
    const enddate = document.getElementById(\'proj_end_date\').value;
    const urlLink = document.getElementById(\'proj_url_link\').value.trim();

    if (!name) {
        highlightError(\'proj_name\', \'The project name is required.\');
        return;
    }
    if (name.length > 100) {
        highlightError(\'proj_name\', \'The name cannot exceed 100 characters.\');
        return;
    }
    if (!inidate) {
        highlightError(\'proj_date_ini\', \'Start date is required.\');
        return;
    }
    const status = document.getElementById(\'proj_status\').value;
    if (status === \'completed\' && !endDate) {
        highlightError(\'proj_end_date\', \'The end date is required if the status is Completed.\');
        return;
    }
    const todayStr = new Date().toISOString().split(\'T\')[0];
    if (status === \'completed\' && endDate && endDate > todayStr) {
        highlightError(\'proj_end_date\', \'The end date cannot be later than the current date.\');
        return;
    }
    if (EndDate && EndDate',
  'ejecutarEliminar(id);
    mostrarConfirmacion(\'eliminar\');
}

function confirmarEditar(id) {
    CONFIRM_CONFIG.editar.accion = () => ejecutarAbrirEditar(id);
    mostrarConfirmacion(\'editar\');
}

// ── Helper: resaltar campo con error ─────────────────────────────────────────

function resaltarError(campoId, mensaje) {
    const el = document.getElementById(campoId);
    el.classList.add(\'border-red-400\', \'ring-2\', \'ring-red-300\');
    el.focus();
    setTimeout(() => el.classList.remove(\'border-red-400\', \'ring-2\', \'ring-red-300\'), 2500);
    const prev = el.parentElement.querySelector(\'.error-msg\');
    if (prev) prev.remove();
    const msg = document.createElement(\'p\');
    msg.className   = \'error-msg text-xs text-red-500 mt-1\';
    msg.textContent = mensaje;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ── Tecnologías por categoría ─────────────────────────────────────────────────

window.TECNOLOGIAS_POR_CATEGORIA = {
    \'Frontend\':              [\'React\', \'Vue.js\', \'Angular\', \'Svelte\', \'Next.js\', \'Nuxt.js\', \'HTML\', \'CSS\', \'Tailwind CSS\', \'Bootstrap\', \'jQuery\', \'TypeScript\'],
    \'Backend\':               [\'Node.js\', \'Express\', \'Django\', \'FastAPI\', \'Spring Boot\', \'Laravel\', \'Ruby on Rails\', \'ASP.NET\', \'Flask\', \'NestJS\', \'Phoenix\'],
    \'Lenguajes\':             [\'JavaScript\', \'TypeScript\', \'Python\', \'Java\', \'C#\', \'C++\', \'C\', \'PHP\', \'Ruby\', \'Go\', \'Rust\', \'Swift\', \'Kotlin\', \'Dart\', \'R\'],
    \'Bases de Datos\':        [\'MySQL\', \'PostgreSQL\', \'MongoDB\', \'SQLite\', \'Redis\', \'MariaDB\', \'Oracle\', \'SQL Server\', \'Cassandra\', \'Firebase\', \'Supabase\'],
    \'Cloud & DevOps\':        [\'AWS\', \'Google Cloud\', \'Azure\', \'Docker\', \'Kubernetes\', \'GitHub Actions\', \'GitLab CI\', \'Terraform\', \'Ansible\', \'Jenkins\', \'Nginx\'],
    \'Mobile\':                [\'React Native\', \'Flutter\', \'Android\', \'iOS\', \'Ionic\', \'Xamarin\', \'Expo\'],
    \'APIs & Real-time\':      [\'REST API\', \'GraphQL\', \'WebSockets\', \'gRPC\', \'Swagger\', \'Postman\', \'Socket.io\'],
    \'Testing\':               [\'Jest\', \'PHPUnit\', \'Cypress\', \'Selenium\', \'Pytest\', \'JUnit\', \'Mocha\', \'Vitest\'],
    \'Data Science & ML\':     [\'TensorFlow\', \'PyTorch\', \'Scikit-learn\', \'Pandas\', \'NumPy\', \'Keras\', \'OpenCV\', \'Jupyter\'],
    \'Diseño & Prototipado\':  [\'Figma\', \'Adobe XD\', \'Sketch\', \'InVision\', \'Canva\'],
    \'Gestión de Proyectos\':  [\'Git\', \'GitHub\', \'GitLab\', \'Jira\', \'Trello\', \'Notion\', \'Slack\', \'Linear\'],
};

const CHIP_ACTIVE_CLS   = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f] bg-[#1e3a5f] text-white transition cursor-pointer select-none\';
const CHIP_INACTIVE_CLS = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none\';
const CHIP_DISABLED_CLS = \'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed\';

function filtrarTecnologias() {
    const categoria = document.getElementById(\'proj_categoria_select\').value;
    const container = document.getElementById(\'proj_chips_container\');
    const chipsDiv  = document.getElementById(\'proj_chips\');

    chipsDiv.innerHTML = \'\';

    if (!categoria || !TECNOLOGIAS_POR_CATEGORIA[categoria]) {
        container.classList.add(\'hidden\');
        return;
    }

    const yaAgregadas = getTags();

    TECNOLOGIAS_POR_CATEGORIA[categoria].forEach(tec => {
        const chip = document.createElement(\'button\');
        chip.type        = \'button\';
        chip.dataset.tec = tec;
        chip.textContent = tec;

        if (yaAgregadas.includes(tec)) {
            chip.className = CHIP_DISABLED_CLS;
            chip.disabled  = true;
        } else {
            chip.className = CHIP_INACTIVE_CLS;
            chip.addEventListener(\'click\', () => toggleChip(chip));
        }

        chipsDiv.appendChild(chip);
    });

    container.classList.remove(\'hidden\');
}

function toggleChip(chip) {
    const activo = chip.dataset.activo === \'1\';
    chip.dataset.activo = activo ? \'0\' : \'1\';
    chip.className      = activo ? CHIP_INACTIVE_CLS : CHIP_ACTIVE_CLS;
}

// ── Estado → fecha fin ────────────────────────────────────────────────────────

function actualizarFechaFinSegunEstado() {
    const estado    = document.getElementById(\'proj_estado\').value;
    const fechaFin  = document.getElementById(\'proj_fecha_fin\');
    const required  = document.getElementById(\'proj_fecha_fin_required\');
    const hint      = document.getElementById(\'proj_fecha_fin_hint\');
    const completado = estado === \'completado\';

    fechaFin.disabled = !completado;
    required.classList.toggle(\'hidden\', !completado);

    if (completado) {
        fechaFin.max     = new Date().toISOString().split(\'T\')[0];
        hint.textContent = \'Obligatoria para proyectos completados (no puede ser posterior a hoy)\';
        hint.className   = \'text-xs text-[#e11d48] mt-1\';
    } else {
        fechaFin.value   = \'\';
        fechaFin.removeAttribute(\'max\');
        hint.textContent = \'Disponible solo cuando el estado es "Completado"\';
        hint.className   = \'text-xs text-gray-400 mt-1\';
    }
}

// ── Tags de tecnologías ───────────────────────────────────────────────────────

function renderizarTags(tags) {
    const container = document.getElementById(\'proj_tags\');
    container.innerHTML = \'\';
    tags.forEach((tag, i) => {
        const span = document.createElement(\'span\');
        span.className = \'flex items-center gap-1 text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/20 px-2.5 py-1 rounded-full\';
        span.innerHTML = `${tag}' => 'executeDelete(id);
    showConfirmation(\'delete\');
}

function confirmEdit(id) {
    CONFIRM_CONFIG.edit.action = () => executeOpenEdit(id);
    showConfirmation(\'edit\');
}

// ── Helper: highlight field with error ──────────────────── ─────────────────────

function highlightError(fieldId, message) {
    const el = document.getElementById(fieldId);
    el.classList.add(\'border-red-400\', \'ring-2\', \'ring-red-300\');
    el.focus();
    setTimeout(() => el.classList.remove(\'border-red-400\', \'ring-2\', \'ring-red-300\'), 2500);
    const prev = el.parentElement.querySelector(\'.error-msg\');
    if (prev) prev.remove();
    const msg = document.createElement(\'p\');
    msg.className = \'error-msg text-xs text-red-500 mt-1\';
    msg.textContent = message;
    el.parentElement.appendChild(msg);
    setTimeout(() => msg.remove(), 2500);
}

// ── Technologies by category ──────────────────────── ─────────────────────────

window.TECHNOLOGIES_BY_CATEGORY = {
    \'Frontend\': [\'React\', \'Vue.js\', \'Angular\', \'Svelte\', \'Next.js\', \'Nuxt.js\', \'HTML\', \'CSS\', \'Tailwind CSS\', \'Bootstrap\', \'jQuery\', \'TypeScript\'],
    \'Backend\': [\'Node.js\', \'Express\', \'Django\', \'FastAPI\', \'Spring Boot\', \'Laravel\', \'Ruby on Rails\', \'ASP.NET\', \'Flask\', \'NestJS\', \'Phoenix\'],
    \'Languages\': [\'JavaScript\', \'TypeScript\', \'Python\', \'Java\', \'C#\', \'C++\', \'C\', \'PHP\', \'Ruby\', \'Go\', \'Rust\', \'Swift\', \'Kotlin\', \'Dart\', \'R\'],
    \'Databases\': [\'MySQL\', \'PostgreSQL\', \'MongoDB\', \'SQLite\', \'Redis\', \'MariaDB\', \'Oracle\', \'SQL Server\', \'Cassandra\', \'Firebase\', \'Supabase\'],
    \'Cloud & DevOps\': [\'AWS\', \'Google Cloud\', \'Azure\', \'Docker\', \'Kubernetes\', \'GitHub Actions\', \'GitLab CI\', \'Terraform\', \'Ansible\', \'Jenkins\', \'Nginx\'],
    \'Mobile\': [\'React Native\', \'Flutter\', \'Android\', \'iOS\', \'Ionic\', \'Xamarin\', \'Expo\'],
    \'APIs & Real-time\': [\'REST API\', \'GraphQL\', \'WebSockets\', \'gRPC\', \'Swagger\', \'Postman\', \'Socket.io\'],
    \'Testing\': [\'Jest\', \'PHPUnit\', \'Cypress\', \'Selenium\', \'Pytest\', \'JUnit\', \'Mocha\', \'Vitest\'],
    \'Data Science & ML\': [\'TensorFlow\', \'PyTorch\', \'Scikit-learn\', \'Pandas\', \'NumPy\', \'Keras\', \'OpenCV\', \'Jupyter\'],
    \'Design & Prototyping\': [\'Figma\', \'Adobe XD\', \'Sketch\', \'InVision\', \'Canva\'],
    \'Project Management\': [\'Git\', \'GitHub\', \'GitLab\', \'Jira\', \'Trello\', \'Notion\', \'Slack\', \'Linear\'],
};

const CHIP_ACTIVE_CLS = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f] bg-[#1e3a5f] text-white transition cursor-pointer select-none\';
const CHIP_INACTIVE_CLS = \'text-xs px-2.5 py-1 rounded-full border border-[#1e3a5f]/20 bg-white text-[#1e3a5f] hover:bg-[#1e3a5f]/10 transition cursor-pointer select-none\';
const CHIP_DISABLED_CLS = \'text-xs px-2.5 py-1 rounded-full border border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed\';

function filterTechnologies() {
    const category = document.getElementById(\'proj_categoria_select\').value;
    const container = document.getElementById(\'proj_chips_container\');
    const chipsDiv = document.getElementById(\'proj_chips\');

    chipsDiv.innerHTML = \'\';

    if (!category || !TECHNOLOGIES_BY_CATEGORY[category]) {
        container.classList.add(\'hidden\');
        return;
    }

    const alreadyAdded = getTags();

    TECHNOLOGIES_BY_CATEGORY[category].forEach(tec => {
        const chip = document.createElement(\'button\');
        chip.type = \'button\';
        chip.dataset.tec = tec;
        chip.textContent = tec;

        if (alreadyAdded.includes(tec)) {
            chip.className = CHIP_DISABLED_CLS;
            chip.disabled = true;
        } else {
            chip.className = CHIP_INACTIVE_CLS;
            chip.addEventListener(\'click\', () => toggleChip(chip));
        }

        chipsDiv.appendChild(chip);
    });

    container.classList.remove(\'hidden\');
}

function toggleChip(chip) {
    const active = chip.dataset.active === \'1\';
    chip.dataset.active = active ? \'0\' : \'1\';
    chip.className = active ? CHIP_INACTIVE_CLS : CHIP_ACTIVE_CLS;
}

// ── Status → end date ──────────────────────────── ────────────────────────────

function updateEndDateSecondState() {
    const status = document.getElementById(\'proj_status\').value;
    const endDate = document.getElementById(\'proj_end_date\');
    const required = document.getElementById(\'proj_end_date_required\');
    const hint = document.getElementById(\'proj_end_date_hint\');
    const completed = status === \'completed\';

    EndDate.disabled = !completed;
    required.classList.toggle(\'hidden\', !completed);

    if (completed) {
        EndDate.max = new Date().toISOString().split(\'T\')[0];
        hint.textContent = \'Required for completed projects (cannot be later than today)\';
        hint.className = \'text-xs text-[#e11d48] mt-1\';
    } else {
        EndDate.value = \'\';
        EndDate.removeAttribute(\'max\');
        hint.textContent = \'Available only when status is "Completed"\';
        hint.className = \'text-xs text-gray-400 mt-1\';
    }
}

// ── Technology tags ─────────────────────────── ────────────────────────────

function renderTags(tags) {
    const container = document.getElementById(\'proj_tags\');
    container.innerHTML = \'\';
    tags.forEach((tag, i) => {
        const span = document.createElement(\'span\');
        span.className = \'flex items-center gap-1 text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/20 px-2.5 py-1 rounded-full\';
        span.innerHTML = `${tag}',
  '`;
        container.appendChild(span);
    });
}

function getTags() {
    const val = document.getElementById(\'proj_tecnologias\').value;
    return val ? val.split(\',\').map(t => t.trim()).filter(Boolean) : [];
}

function setTags(tags) {
    document.getElementById(\'proj_tecnologias\').value = tags.join(\', \');
    renderizarTags(tags);
}

function agregarTecnologia() {
    const seleccionados = document.querySelectorAll(\'#proj_chips [data-activo="1"]\');
    if (!seleccionados.length) return;

    const tags = getTags();
    seleccionados.forEach(chip => {
        if (!tags.includes(chip.dataset.tec)) tags.push(chip.dataset.tec);
    });
    setTags(tags);

    seleccionados.forEach(chip => {
        chip.dataset.activo = \'0\';
        chip.className = CHIP_DISABLED_CLS;
        chip.disabled  = true;
        chip.removeEventListener(\'click\', toggleChip);
    });
}

function eliminarTag(index) {
    const tags = getTags();
    tags.splice(index, 1);
    setTags(tags);
}

// ── Validación en tiempo real de URL ─────────────────────────────────────────

document.getElementById(\'proj_url_link\').addEventListener(\'input\', function() {
    const val    = this.value.trim();
    const status = document.getElementById(\'url_status\');
    const hint   = document.getElementById(\'url_hint\');

    if (!val) {
        status.classList.add(\'hidden\');
        this.classList.remove(\'border-[#1e3a5f]\', \'border-red-400\', \'ring-2\', \'ring-[#1e3a5f]/20\', \'ring-red-200\');
        this.classList.add(\'border-gray-200\');
        hint.textContent = \'Enlace a la aplicación o sitio web en producción desarrollada para el cliente\';
        hint.className   = \'text-xs text-gray-400 mt-1\';
        return;
    }

    const valid = isValidUrl(val);
    status.classList.remove(\'hidden\');
    this.classList.remove(\'border-gray-200\', \'border-[#1e3a5f]\', \'border-red-400\', \'ring-[#1e3a5f]/20\', \'ring-red-200\');
    this.classList.add(\'ring-2\');

    if (valid) {
        status.innerHTML = \'' => '`;
        container.appendChild(span);
    });
}

function getTags() {
    const val = document.getElementById(\'proj_tecnologias\').value;
    return val ? val.split(\',\').map(t => t.trim()).filter(Boolean) : [];
}

function setTags(tags) {
    document.getElementById(\'proj_tecnologias\').value = tags.join(\', \');
    renderizarTags(tags);
}

function agregarTecnologia() {
    const seleccionados = document.querySelectorAll(\'#proj_chips [data-activo="1"]\');
    if (!seleccionados.length) return;

    const tags = getTags();
    seleccionados.forEach(chip => {
        if (!tags.includes(chip.dataset.tec)) tags.push(chip.dataset.tec);
    });
    setTags(tags);

    seleccionados.forEach(chip => {
        chip.dataset.activo = \'0\';
        chip.className = CHIP_DISABLED_CLS;
        chip.disabled  = true;
        chip.removeEventListener(\'click\', toggleChip);
    });
}

function eliminarTag(index) {
    const tags = getTags();
    tags.splice(index, 1);
    setTags(tags);
}

// ── Validación en tiempo real de URL ─────────────────────────────────────────

document.getElementById(\'proj_url_link\').addEventListener(\'input\', function() {
    const val    = this.value.trim();
    const status = document.getElementById(\'url_status\');
    const hint   = document.getElementById(\'url_hint\');

    if (!val) {
        status.classList.add(\'hidden\');
        this.classList.remove(\'border-[#1e3a5f]\', \'border-red-400\', \'ring-2\', \'ring-[#1e3a5f]/20\', \'ring-red-200\');
        this.classList.add(\'border-gray-200\');
        hint.textContent = \'Enlace a la aplicación o sitio web en producción desarrollada para el cliente\';
        hint.className   = \'text-xs text-gray-400 mt-1\';
        return;
    }

    const valid = isValidUrl(val);
    status.classList.remove(\'hidden\');
    this.classList.remove(\'border-gray-200\', \'border-[#1e3a5f]\', \'border-red-400\', \'ring-[#1e3a5f]/20\', \'ring-red-200\');
    this.classList.add(\'ring-2\');

    if (valid) {
        status.innerHTML = \'',
  '\';
        this.classList.add(\'border-[#1e3a5f]\', \'ring-[#1e3a5f]/20\');
        hint.textContent = \'✓ URL válida\';
        hint.className   = \'text-xs text-[#1e3a5f] mt-1 font-medium\';
    } else {
        status.innerHTML = \'' => '\';
        this.classList.add(\'border-[#1e3a5f]\', \'ring-[#1e3a5f]/20\');
        hint.textContent = \'✓ URL válida\';
        hint.className   = \'text-xs text-[#1e3a5f] mt-1 font-medium\';
    } else {
        status.innerHTML = \'',
  '\';
        this.classList.add(\'border-red-400\', \'ring-red-200\');
        hint.textContent = \'URL no válida. Debe comenzar con https:// o http://\';
        hint.className   = \'text-xs text-red-500 mt-1\';
    }
});

function resetUrlStatus() {
    const input  = document.getElementById(\'proj_url_link\');
    const status = document.getElementById(\'url_status\');
    const hint   = document.getElementById(\'url_hint\');
    input.classList.remove(\'border-green-400\', \'border-red-400\', \'ring-2\', \'ring-green-200\', \'ring-red-200\');
    input.classList.add(\'border-gray-200\');
    status.classList.add(\'hidden\');
    hint.textContent = \'Enlace a la aplicación o sitio web en producción desarrollada para el cliente\';
    hint.className   = \'text-xs text-gray-400 mt-1\';
}

// ── Modal Proyecto ────────────────────────────────────────────────────────────

function abrirModalProyecto() {
    document.getElementById(\'proyectoId\').value = \'\';
    document.getElementById(\'formProyecto\').reset();
    document.getElementById(\'proj_tecnologias\').value = \'\';
    document.getElementById(\'proj_tags\').innerHTML = \'\';
    document.getElementById(\'proj_categoria_select\').value = \'\';
    document.getElementById(\'proj_chips\').innerHTML = \'\';
    document.getElementById(\'proj_chips_container\').classList.add(\'hidden\');
    document.getElementById(\'modalProyectoTitulo\').textContent = \'Crear Nuevo Proyecto\';
    document.getElementById(\'proj_visible\').value = \'0\';
    resetUrlStatus();
    actualizarFechaFinSegunEstado();
    setModalVisible(\'modalProyecto\', true);
}

function cerrarModalProyecto() {
    setModalVisible(\'modalProyecto\', false);
}

document.getElementById(\'modalProyecto\').addEventListener(\'click\', function(e) {
    if (e.target === this) confirmarCancelar();
});

// ── Editar ────────────────────────────────────────────────────────────────────

function ejecutarAbrirEditar(id) {
    apiFetch(`/proyectos/${id}`)
        .then(r => r.json())
        .then(p => {
            document.getElementById(\'proyectoId\').value            = p.id_proyecto;
            document.getElementById(\'proj_nombre\').value           = p.nombre      ?? \'\';
            document.getElementById(\'proj_descripcion\').value      = p.descripcion ?? \'\';
            document.getElementById(\'proj_fecha_ini\').value        = toInputDate(p.fecha_ini);
            document.getElementById(\'proj_fecha_fin\').value        = toInputDate(p.fecha_fin);
            document.getElementById(\'proj_estado\').value           = p.estado      ?? \'pendiente\';
            document.getElementById(\'proj_referencias\').value      = p.referencias ?? \'\';
            document.getElementById(\'proj_categoria_select\').value = \'\';
            document.getElementById(\'proj_chips\').innerHTML        = \'\';
            document.getElementById(\'proj_chips_container\').classList.add(\'hidden\');

            const urlInput = document.getElementById(\'proj_url_link\');
            urlInput.value = p.url_link ?? \'\';
            urlInput.dispatchEvent(new Event(\'input\')); // activa el indicador visual

            setTags(p.tecnologias ? p.tecnologias.split(\',\').map(t => t.trim()).filter(Boolean) : []);
            document.getElementById(\'proj_visible\').value = p.visible ? \'1\' : \'0\';
            actualizarFechaFinSegunEstado();
            document.getElementById(\'modalProyectoTitulo\').textContent = \'Editar Proyecto\';
            setModalVisible(\'modalProyecto\', true);
        });
}

// ── Crear / Actualizar ────────────────────────────────────────────────────────

function submitProyecto() {
    const id     = document.getElementById(\'proyectoId\').value;
    const url    = id ? `/proyectos/${id}` : \'/proyectos\';
    const method = id ? \'PUT\' : \'POST\';

    apiFetch(url, {
        method,
        headers: { \'Content-Type\': \'application/json\' },
        body: JSON.stringify({
            user_id:     USER_ID,
            nombre:      document.getElementById(\'proj_nombre\').value.trim(),
            descripcion: document.getElementById(\'proj_descripcion\').value,
            fecha_ini:   document.getElementById(\'proj_fecha_ini\').value || null,
            fecha_fin:   document.getElementById(\'proj_fecha_fin\').value || null,
            estado:      document.getElementById(\'proj_estado\').value,
            tecnologias: document.getElementById(\'proj_tecnologias\').value,
            url_link:    document.getElementById(\'proj_url_link\').value.trim() || null,
            referencias: document.getElementById(\'proj_referencias\').value,
            visible:     parseInt(document.getElementById(\'proj_visible\').value),
        })
    })
    .then(r => {
        if (r.status === 422) {
            return r.json().then(err => {
                const msgs = err.errors ? Object.values(err.errors).flat() : [err.message ?? \'Error de validación\'];
                resaltarError(\'proj_nombre\', msgs[0]);
                throw new Error(\'validation\');
            });
        }
        return r.json();
    })
    .then(data => {
        if (!data?.success) { alert(data?.message ?? \'Error al guardar\'); return; }

        cerrarModalProyecto();
        const cardHTML = buildCardHTML(data.proyecto);
        const grid     = document.getElementById(\'proyectos-grid\');

        if (id) {
            const existing = grid.querySelector(`[data-proyecto-id="${data.proyecto.id_proyecto}"]`);
            if (existing) existing.outerHTML = cardHTML;
        } else {
            grid.insertAdjacentHTML(\'afterbegin\', cardHTML);
            actualizarResumenProyectos(data.proyecto, \'crear\');
            if (typeof window.notificarItemPublicable === \'function\') {
                window.notificarItemPublicable(\'proyecto\');
            }
        }

        // Sincronizar con la lista usada en el modal de Experiencia Laboral
        if (typeof window.syncProyectoEnListaExp === \'function\') {
            window.syncProyectoEnListaExp(id ? \'update\' : \'create\', data.proyecto);
        }

        recalcularStats();
    });
}

document.getElementById(\'formProyecto\').addEventListener(\'submit\', function(e) {
    e.preventDefault();
    confirmarGuardar();
});

// ── Eliminar ──────────────────────────────────────────────────────────────────

function ejecutarEliminar(id) {
    apiFetch(`/proyectos/${id}`, { method: \'DELETE\' })
        .then(r => r.json())
        .then(data => {
            if (!data.success) return;
            document.querySelector(`[data-proyecto-id="${id}"]`)?.remove();
            actualizarResumenProyectos(id, \'eliminar\');

            if (typeof window.syncProyectoEnListaExp === \'function\') {
                window.syncProyectoEnListaExp(\'delete\', { id_proyecto: id });
            }

            recalcularStats();
        });
}

// ── Proyectos Recientes (Resumen) ─────────────────────────────────────────────

const RESUMEN_ACCENTS = [\'bg-[#1e3a5f]\', \'bg-[#e11d48]\', \'bg-indigo-600\'];

const RESUMEN_ESTADO = {
    en_progreso: { label: \'En curso\',   icon: \'fa-spinner\',      bg: \'bg-[#1e3a5f]/10\', text: \'text-[#1e3a5f]\' },
    completado:  { label: \'Finalizado\', icon: \'fa-check-circle\', bg: \'bg-indigo-100\',   text: \'text-indigo-700\' },
    pendiente:   { label: \'Pendiente\',  icon: \'fa-clock\',        bg: \'bg-gray-100\',     text: \'text-gray-600\' },
    cancelado:   { label: \'Cancelado\',  icon: \'fa-times-circle\', bg: \'bg-red-100\',      text: \'text-[#e11d48]\' },
};

function buildResumenCardHTML(p, index) {
    const cfg    = RESUMEN_ESTADO[p.estado] ?? RESUMEN_ESTADO[\'pendiente\'];
    const accent = RESUMEN_ACCENTS[index % RESUMEN_ACCENTS.length];
    const tags   = p.tecnologias
        ? p.tecnologias.split(\',\').map(t => t.trim()).filter(Boolean).slice(0, 3)
        : [];

    const tagsHTML = tags.map(t =>
        `' => '\';
        this.classList.add(\'border-red-400\', \'ring-red-200\');
        hint.textContent = \'URL no válida. Debe comenzar con https:// o http://\';
        hint.className   = \'text-xs text-red-500 mt-1\';
    }
});

function resetUrlStatus() {
    const input  = document.getElementById(\'proj_url_link\');
    const status = document.getElementById(\'url_status\');
    const hint   = document.getElementById(\'url_hint\');
    input.classList.remove(\'border-green-400\', \'border-red-400\', \'ring-2\', \'ring-green-200\', \'ring-red-200\');
    input.classList.add(\'border-gray-200\');
    status.classList.add(\'hidden\');
    hint.textContent = \'Enlace a la aplicación o sitio web en producción desarrollada para el cliente\';
    hint.className   = \'text-xs text-gray-400 mt-1\';
}

// ── Modal Proyecto ────────────────────────────────────────────────────────────

function abrirModalProyecto() {
    document.getElementById(\'proyectoId\').value = \'\';
    document.getElementById(\'formProyecto\').reset();
    document.getElementById(\'proj_tecnologias\').value = \'\';
    document.getElementById(\'proj_tags\').innerHTML = \'\';
    document.getElementById(\'proj_categoria_select\').value = \'\';
    document.getElementById(\'proj_chips\').innerHTML = \'\';
    document.getElementById(\'proj_chips_container\').classList.add(\'hidden\');
    document.getElementById(\'modalProyectoTitulo\').textContent = \'Crear Nuevo Proyecto\';
    document.getElementById(\'proj_visible\').value = \'0\';
    resetUrlStatus();
    actualizarFechaFinSegunEstado();
    setModalVisible(\'modalProyecto\', true);
}

function cerrarModalProyecto() {
    setModalVisible(\'modalProyecto\', false);
}

document.getElementById(\'modalProyecto\').addEventListener(\'click\', function(e) {
    if (e.target === this) confirmarCancelar();
});

// ── Editar ────────────────────────────────────────────────────────────────────

function ejecutarAbrirEditar(id) {
    apiFetch(`/proyectos/${id}`)
        .then(r => r.json())
        .then(p => {
            document.getElementById(\'proyectoId\').value            = p.id_proyecto;
            document.getElementById(\'proj_nombre\').value           = p.nombre      ?? \'\';
            document.getElementById(\'proj_descripcion\').value      = p.descripcion ?? \'\';
            document.getElementById(\'proj_fecha_ini\').value        = toInputDate(p.fecha_ini);
            document.getElementById(\'proj_fecha_fin\').value        = toInputDate(p.fecha_fin);
            document.getElementById(\'proj_estado\').value           = p.estado      ?? \'pendiente\';
            document.getElementById(\'proj_referencias\').value      = p.referencias ?? \'\';
            document.getElementById(\'proj_categoria_select\').value = \'\';
            document.getElementById(\'proj_chips\').innerHTML        = \'\';
            document.getElementById(\'proj_chips_container\').classList.add(\'hidden\');

            const urlInput = document.getElementById(\'proj_url_link\');
            urlInput.value = p.url_link ?? \'\';
            urlInput.dispatchEvent(new Event(\'input\')); // activa el indicador visual

            setTags(p.tecnologias ? p.tecnologias.split(\',\').map(t => t.trim()).filter(Boolean) : []);
            document.getElementById(\'proj_visible\').value = p.visible ? \'1\' : \'0\';
            actualizarFechaFinSegunEstado();
            document.getElementById(\'modalProyectoTitulo\').textContent = \'Editar Proyecto\';
            setModalVisible(\'modalProyecto\', true);
        });
}

// ── Crear / Actualizar ────────────────────────────────────────────────────────

function submitProyecto() {
    const id     = document.getElementById(\'proyectoId\').value;
    const url    = id ? `/proyectos/${id}` : \'/proyectos\';
    const method = id ? \'PUT\' : \'POST\';

    apiFetch(url, {
        method,
        headers: { \'Content-Type\': \'application/json\' },
        body: JSON.stringify({
            user_id:     USER_ID,
            nombre:      document.getElementById(\'proj_nombre\').value.trim(),
            descripcion: document.getElementById(\'proj_descripcion\').value,
            fecha_ini:   document.getElementById(\'proj_fecha_ini\').value || null,
            fecha_fin:   document.getElementById(\'proj_fecha_fin\').value || null,
            estado:      document.getElementById(\'proj_estado\').value,
            tecnologias: document.getElementById(\'proj_tecnologias\').value,
            url_link:    document.getElementById(\'proj_url_link\').value.trim() || null,
            referencias: document.getElementById(\'proj_referencias\').value,
            visible:     parseInt(document.getElementById(\'proj_visible\').value),
        })
    })
    .then(r => {
        if (r.status === 422) {
            return r.json().then(err => {
                const msgs = err.errors ? Object.values(err.errors).flat() : [err.message ?? \'Error de validación\'];
                resaltarError(\'proj_nombre\', msgs[0]);
                throw new Error(\'validation\');
            });
        }
        return r.json();
    })
    .then(data => {
        if (!data?.success) { alert(data?.message ?? \'Error al guardar\'); return; }

        cerrarModalProyecto();
        const cardHTML = buildCardHTML(data.proyecto);
        const grid     = document.getElementById(\'proyectos-grid\');

        if (id) {
            const existing = grid.querySelector(`[data-proyecto-id="${data.proyecto.id_proyecto}"]`);
            if (existing) existing.outerHTML = cardHTML;
        } else {
            grid.insertAdjacentHTML(\'afterbegin\', cardHTML);
            actualizarResumenProyectos(data.proyecto, \'crear\');
            if (typeof window.notificarItemPublicable === \'function\') {
                window.notificarItemPublicable(\'proyecto\');
            }
        }

        // Sincronizar con la lista usada en el modal de Experiencia Laboral
        if (typeof window.syncProyectoEnListaExp === \'function\') {
            window.syncProyectoEnListaExp(id ? \'update\' : \'create\', data.proyecto);
        }

        recalcularStats();
    });
}

document.getElementById(\'formProyecto\').addEventListener(\'submit\', function(e) {
    e.preventDefault();
    confirmarGuardar();
});

// ── Eliminar ──────────────────────────────────────────────────────────────────

function ejecutarEliminar(id) {
    apiFetch(`/proyectos/${id}`, { method: \'DELETE\' })
        .then(r => r.json())
        .then(data => {
            if (!data.success) return;
            document.querySelector(`[data-proyecto-id="${id}"]`)?.remove();
            actualizarResumenProyectos(id, \'eliminar\');

            if (typeof window.syncProyectoEnListaExp === \'function\') {
                window.syncProyectoEnListaExp(\'delete\', { id_proyecto: id });
            }

            recalcularStats();
        });
}

// ── Proyectos Recientes (Resumen) ─────────────────────────────────────────────

const RESUMEN_ACCENTS = [\'bg-[#1e3a5f]\', \'bg-[#e11d48]\', \'bg-indigo-600\'];

const RESUMEN_ESTADO = {
    en_progreso: { label: \'En curso\',   icon: \'fa-spinner\',      bg: \'bg-[#1e3a5f]/10\', text: \'text-[#1e3a5f]\' },
    completado:  { label: \'Finalizado\', icon: \'fa-check-circle\', bg: \'bg-indigo-100\',   text: \'text-indigo-700\' },
    pendiente:   { label: \'Pendiente\',  icon: \'fa-clock\',        bg: \'bg-gray-100\',     text: \'text-gray-600\' },
    cancelado:   { label: \'Cancelado\',  icon: \'fa-times-circle\', bg: \'bg-red-100\',      text: \'text-[#e11d48]\' },
};

function buildResumenCardHTML(p, index) {
    const cfg    = RESUMEN_ESTADO[p.estado] ?? RESUMEN_ESTADO[\'pendiente\'];
    const accent = RESUMEN_ACCENTS[index % RESUMEN_ACCENTS.length];
    const tags   = p.tecnologias
        ? p.tecnologias.split(\',\').map(t => t.trim()).filter(Boolean).slice(0, 3)
        : [];

    const tagsHTML = tags.map(t =>
        `',
  '`
    ).join(\'\');

    const fecha = p.fecha_ini ? formatFecha(p.fecha_ini) : \'—\';

    return `' => '`
    ).join(\'\');

    const date = p.date_ini ? formatDate(p.date_ini) : \'—\';

    return `',
  '${fecha}' => '${date}',
  '${cfg.label}' => '${cfg.label}',
  '`;
}

function actualizarResumenProyectos(proyecto, accion) {
    const grid  = document.getElementById(\'resumen-proyectos-grid\');
    const empty = document.getElementById(\'resumen-proyectos-empty\');
    const count = document.getElementById(\'resumen-proyectos-count\');
    if (!grid) return;

    if (accion === \'crear\') {
        // Insertar al inicio y dejar solo los 3 más recientes
        grid.insertAdjacentHTML(\'afterbegin\', buildResumenCardHTML(proyecto, 0));

        // Recolorar acentos de los 3 primeros
        const cards = grid.querySelectorAll(\'[data-resumen-id]\');
        cards.forEach((card, i) => {
            const franja = card.querySelector(\'.h-1\\\\.5\');
            const icono  = card.querySelector(\'.w-9.h-9\');
            RESUMEN_ACCENTS.forEach(cls => {
                franja?.classList.remove(cls);
                icono?.classList.remove(cls);
            });
            franja?.classList.add(RESUMEN_ACCENTS[i % RESUMEN_ACCENTS.length]);
            icono?.classList.add(RESUMEN_ACCENTS[i % RESUMEN_ACCENTS.length]);

            if (i >= 3) card.remove(); // máximo 3
        });
    } else if (accion === \'eliminar\') {
        const card = grid.querySelector(`[data-resumen-id="${proyecto}"]`);
        if (card) card.remove();
    }

    const total = grid.querySelectorAll(\'[data-resumen-id]\').length;
    if (count) count.textContent = `Últimos ${total} registros`;

    const vacio = total === 0;
    grid.classList.toggle(\'hidden\', vacio);
    if (empty) empty.classList.toggle(\'hidden\', !vacio);
}' => '`;
}

function updateProjectSummary(project, action) {
    const grid = document.getElementById(\'grid-project-summary\');
    const empty = document.getElementById(\'project-summary-empty\');
    const count = document.getElementById(\'project-summary-count\');
    if (!grid) return;

    if (action === \'create\') {
        // Insert at the beginning and leave only the 3 most recent
        grid.insertAdjacentHTML(\'afterbegin\', buildCardHTMLSummary(project, 0));

        // Recolor accents of the first 3
        const cards = grid.querySelectorAll(\'[data-summary-id]\');
        cards.forEach((card, i) => {
            const stripe = card.querySelector(\'.h-1\\\\.5\');
            const icon = card.querySelector(\'.w-9.h-9\');
            SUMMARY_ACCENTS.forEach(cls => {
                stripe?.classList.remove(cls);
                icon?.classList.remove(cls);
            });
            stripe?.classList.add(SUMMARY_ACCENTS[i % SUMMARY_ACCENTS.length]);
            icon?.classList.add(SUMMARY_ACCENTS[i % SUMMARY_ACCENTS.length]);

            if (i >= 3) card.remove(); // maximum 3
        });
    } else if (action === \'delete\') {
        const card = grid.querySelector(`[data-summary-id="${project}"]`);
        if (card) card.remove();
    }

    const total = grid.querySelectorAll(\'[data-summary-id]\').length;
    if (count) count.textContent = `Latest ${total} records`;

    const void = total === 0;
    grid.classList.toggle(\'hidden\', empty);
    if (empty) empty.classList.toggle(\'hidden\', !empty);
}',
  '\'stat-total\',
        \'label\'    => \'Total Proyectos\',
        \'value\'    => $totalProyectos,
        \'subtitle\' => \'Todos los registrados\',
        \'icon\'     => \'fas fa-folder\',
        \'card\'     => \'bg-white border-gray-100\',
        \'borderL\'  => \'border-l-[#1e3a5f]\',
        \'iconBg\'   => \'bg-[#1e3a5f]/8\',
        \'iconCls\'  => \'text-[#1e3a5f]\',
        \'labelCls\' => \'text-gray-500 font-medium\',
        \'subCls\'   => \'text-gray-400\',
    ],
    [
        \'id\'       => \'stat-en-curso\',
        \'label\'    => \'En Curso\',
        \'value\'    => $enCurso,
        \'subtitle\' => \'Actualmente trabajando\',
        \'icon\'     => \'fas fa-spinner\',
        \'card\'     => \'bg-[#1e3a5f]/5 border-[#1e3a5f]/15\',
        \'borderL\'  => \'border-l-[#1e3a5f]\',
        \'iconBg\'   => \'bg-[#1e3a5f]/10\',
        \'iconCls\'  => \'text-[#1e3a5f]\',
        \'labelCls\' => \'text-[#1e3a5f] font-semibold\',
        \'subCls\'   => \'text-[#1e3a5f]/60\',
    ],
    [
        \'id\'       => \'stat-finalizados\',
        \'label\'    => \'Finalizados\',
        \'value\'    => $finalizados,
        \'subtitle\' => \'Proyectos completados\',
        \'icon\'     => \'fas fa-check-circle\',
        \'card\'     => \'bg-red-50 border-red-100\',
        \'borderL\'  => \'border-l-[#e11d48]\',
        \'iconBg\'   => \'bg-[#e11d48]/10\',
        \'iconCls\'  => \'text-[#e11d48]\',
        \'labelCls\' => \'text-[#e11d48] font-semibold\',
        \'subCls\'   => \'text-[#e11d48]/70\',
    ],
];
@endphp' => '\'stat-total\',
        \'label\' => \'Total Projects\',
        \'value\' => $totalProjects,
        \'subtitle\' => \'All registered\',
        \'icon\' => \'fas fa-folder\',
        \'card\' => \'bg-white border-gray-100\', .
        \'borderL\' => \'border-l-[#1e3a5f]\',
        \'iconBg\' => \'bg-[#1e3a5f]/8\',
        \'iconCls\' => \'text-[#1e3a5f]\',
        \'labelCls\' => \'text-gray-500 font-medium\',
        \'subCls\' => \'text-gray-400\',
    ],
    [
        \'id\' => \'stat-in-progress\',
        \'label\' => \'In Progress\',
        \'value\' => $inCourse,
        \'subtitle\' => \'Currently working\',
        \'icon\' => \'fas fa-spinner\',
        \'card\' => \'bg-[#1e3a5f]/5 border-[#1e3a5f]/15\',
        \'borderL\' => \'border-l-[#1e3a5f]\',
        \'iconBg\' => \'bg-[#1e3a5f]/10\',
        \'iconCls\' => \'text-[#1e3a5f]\',
        \'labelCls\' => \'text-[#1e3a5f] font-semibold\',
        \'subCls\' => \'text-[#1e3a5f]/60\',
    ],
    [
        \'id\' => \'stat-finalized\',
        \'label\' => \'Finalized\',
        \'value\' => $finalized,
        \'subtitle\' => \'Completed Projects\',
        \'icon\' => \'fas fa-check-circle\',
        \'card\' => \'bg-red-50 border-red-100\',
        \'borderL\' => \'border-l-[#e11d48]\',
        \'iconBg\' => \'bg-[#e11d48]/10\',
        \'iconCls\' => \'text-[#e11d48]\',
        \'labelCls\' => \'text-[#e11d48] font-semibold\',
        \'subCls\' => \'text-[#e11d48]/70\',
    ],
];
@endphp',
  'where(\'id_usuario\', $userId)->first();
    $perfilId = $perfil->id_perfil ?? null;

    $proyectos = $perfilId
        ? Proyecto::where(\'id_perfil\', $perfilId)->orderBy(\'created_at\', \'desc\')->get()
        : collect();

    $totalProyectos = $proyectos->count();
    $enCurso        = $proyectos->where(\'estado\', \'en_progreso\')->count();
    $finalizados    = $proyectos->where(\'estado\', \'completado\')->count();
@endphp' => 'where(\'user_id\', $userId)->first();
    $profileId = $profile->profile_id ?? null;

    $projects = $profileId
        ? Project::where(\'profile_id\', $profileId)->orderBy(\'created_at\', \'desc\')->get()
        : collect();

    $totalProjects = $projects->count();
    $inProgress = $projects->where(\'status\', \'in_progress\')->count();
    $completed = $projects->where(\'status\', \'completed\')->count();
@endphp',
  'Gestión de Portafolio' => 'Portfolio Management',
  'Administra tus proyectos personales y controla lo que muestras al mundo' => 'Manage your personal projects and control what you show to the world',
  'Nuevo Proyecto' => 'New Project',
  'No tienes proyectos registrados aún' => 'You do not have registered projects yet',
  'Comienza agregando tu primer proyecto al portafolio' => 'Start by adding your first project to the portfolio',
  'Agregar primer proyecto' => 'Add first project',
  'isEmpty() ? \'hidden\' : \'\' }}">
            @foreach($proyectos as $proyecto)
                @include(\'gestionarProyectos._card\', [\'proyecto\' => $proyecto])
            @endforeach' => 'isEmpty() ? \'hidden\' : \'\' }}">
            @foreach($projects as $project)
                @include(\'manageProjects._card\', [\'project\' => $project])
            @endforeach',
  'Inicio' => 'Start',
  'Como funciona' => 'How it works',
  'Sobre nosotros' => 'About us',
  'Explorar' => 'Explore',
  'Mi dashboard' => 'Mi dashboard',
  'Iniciar sesion' => 'Login',
  'Registrarse' => 'Register',
  '(function () {
    const modal = document.getElementById(\'modalPortafolio\');

    const ICONS_LINK = {
        github:    \'fab fa-github\',
        linkedin:  \'fab fa-linkedin\',
        twitter:   \'fab fa-twitter\',
        x:         \'fab fa-x-twitter\',
        facebook:  \'fab fa-facebook\',
        instagram: \'fab fa-instagram\',
        youtube:   \'fab fa-youtube\',
        website:   \'fas fa-globe\',
        web:       \'fas fa-globe\',
        sitio:     \'fas fa-globe\',
        portfolio: \'fas fa-globe\',
        email:     \'fas fa-envelope\',
    };

    function setText(id, value) {
        const el = document.getElementById(id);
        if (el) el.textContent = value ?? \'\';
    }

    function escapeHtml(s) {
        const d = document.createElement(\'div\');
        d.textContent = s ?? \'\';
        return d.innerHTML;
    }

    // Acepta:
    //   - un botón con dataset.portafolio (uso del home)
    //   - un objeto de datos directamente { data, preview: bool } (uso del dashboard / vista previa)
    window.abrirModalPortafolio = function (input) {
        let data;
        let isPreview = false;

        if (input instanceof Element) {
            try { data = JSON.parse(input.dataset.portafolio); } catch (e) { return; }
        } else if (input && typeof input === \'object\') {
            if (input.data) {
                data = input.data;
                isPreview = !!input.preview;
            } else {
                data = input;
            }
        } else {
            return;
        }

        // Banner de preview
        const banner = document.getElementById(\'mp_preview_banner\');
        if (banner) banner.classList.toggle(\'hidden\', !isPreview);

        const sidebar = document.getElementById(\'mp_sidebar\');
        const from = data.cover_from || \'#1e3a5f\';
        const to   = data.cover_to   || \'#e11d48\';
        sidebar.style.backgroundImage = `linear-gradient(160deg, ${from} 0%, ${to} 100%)`;

        const avatar = document.getElementById(\'mp_avatar\');
        if (data.foto) {
            avatar.innerHTML = `' => '(function () {
    const modal = document.getElementById(\'modalPortfolio\');

    const ICONS_LINK = {
        github: \'fab fa-github\',
        linkedin: \'fab fa-linkedin\',
        twitter: \'fab fa-twitter\',
        x: \'fab fa-x-twitter\',
        facebook: \'fab fa-facebook\',
        instagram: \'fab fa-instagram\',
        youtube: \'fab fa-youtube\',
        website: \'fas fa-globe\',
        web: \'make-globe\',
        site: \'fas-globe\',
        portfolio: \'fas fa-globe\',
        email: \'fas fa-envelope\',
    };

    function setText(id, value) {
        const el = document.getElementById(id);
        if (el) el.textContent = value ?? \'\';
    }

    function escapeHtml(s) {
        const d = document.createElement(\'div\');
        d.textContent = s ?? \'\';
        return d.innerHTML;
    }

    // Accept:
    // - a button with dataset.portfolio (human use)
    // - a data object directly { date, preview: bool } (dashboard usage / preview)
    window.openModalPortfolio = function(input) {
        data letters;
        let isPreview = false;

        if (input instanceof Element) {
            try { data = JSON.parse(input.dataset.portfolio); } catch (e) { return; }
        } else if (input && typeof input === \'object\') {
            if (input.data) {
                data = input.data;
                isPreview = !!input.preview;
            } else {
                data = input;
            }
        } else {
            return;
        }

        // Preview banner
        const banner = document.getElementById(\'mp_preview_banner\');
        if (banner) banner.classList.toggle(\'hidden\', !isPreview);

        const sidebar = document.getElementById(\'mp_sidebar\');
        const from = data.cover_from || \'#1e3a5f\';
        const to = data.cover_to || \'#e11d48\';
        sidebar.style.backgroundImage = `linear-gradient(160deg, ${from} 0%, ${to} 100%)`;

        const avatar = document.getElementById(\'mp_avatar\');
        if (data.photo) {
            avatar.innerHTML = `',
  '`;
        } else {
            avatar.textContent = data.iniciales || \'??\';
        }

        setText(\'mp_nombre\', data.nombre);
        setText(\'mp_rol\', data.rol);
        setText(\'mp_bio_corta\', data.descripcion);
        setText(\'mp_bio\', data.descripcion);
        setText(\'mp_stat_anios\', (data.anios_num ?? 0) + (data.anios_num >= 1 ? \'+\' : \'\'));
        setText(\'mp_stat_proy\', data.cnt_proy ?? 0);
        setText(\'mp_stat_empresas\', data.cnt_empresas ?? 0);

        const setContact = (wrapperId, value) => {
            const wrap = document.getElementById(wrapperId);
            const span = wrap.querySelector(\'.mp-contact-text\');
            const hasValue = value && String(value).trim() !== \'\' && value !== \'Sin ubicación\';
            if (hasValue) {
                span.textContent = value;
                wrap.title = value;
                wrap.classList.remove(\'hidden\');
                wrap.classList.add(\'flex\');
            } else {
                wrap.classList.add(\'hidden\');
                wrap.classList.remove(\'flex\');
            }
        };
        setContact(\'mp_contact_email\', data.email);
        setContact(\'mp_contact_tel\',   data.telefono);
        setContact(\'mp_contact_loc\',   data.ubicacion);

        const linksWrap = document.getElementById(\'mp_links\');
        linksWrap.innerHTML = \'\';
        const links = data.links || {};
        Object.keys(links).forEach(tipo => {
            const url  = links[tipo];
            if (!url) return;
            const icon = ICONS_LINK[tipo] || \'fas fa-link\';
            const a = document.createElement(\'a\');
            a.href = url;
            a.target = \'_blank\';
            a.rel = \'noopener noreferrer\';
            a.title = tipo.charAt(0).toUpperCase() + tipo.slice(1);
            a.className = \'w-9 h-9 rounded-lg bg-white/20 hover:bg-white/35 border border-white/25 text-white flex items-center justify-center transition\';
            a.innerHTML = `' => '`;
        } else {
            avatar.textContent = data.iniciales || \'??\';
        }

        setText(\'mp_nombre\', data.nombre);
        setText(\'mp_rol\', data.rol);
        setText(\'mp_bio_corta\', data.descripcion);
        setText(\'mp_bio\', data.descripcion);
        setText(\'mp_stat_anios\', (data.anios_num ?? 0) + (data.anios_num >= 1 ? \'+\' : \'\'));
        setText(\'mp_stat_proy\', data.cnt_proy ?? 0);
        setText(\'mp_stat_empresas\', data.cnt_empresas ?? 0);

        const setContact = (wrapperId, value) => {
            const wrap = document.getElementById(wrapperId);
            const span = wrap.querySelector(\'.mp-contact-text\');
            const hasValue = value && String(value).trim() !== \'\' && value !== \'Sin ubicación\';
            if (hasValue) {
                span.textContent = value;
                wrap.title = value;
                wrap.classList.remove(\'hidden\');
                wrap.classList.add(\'flex\');
            } else {
                wrap.classList.add(\'hidden\');
                wrap.classList.remove(\'flex\');
            }
        };
        setContact(\'mp_contact_email\', data.email);
        setContact(\'mp_contact_tel\',   data.telefono);
        setContact(\'mp_contact_loc\',   data.ubicacion);

        const linksWrap = document.getElementById(\'mp_links\');
        linksWrap.innerHTML = \'\';
        const links = data.links || {};
        Object.keys(links).forEach(tipo => {
            const url  = links[tipo];
            if (!url) return;
            const icon = ICONS_LINK[tipo] || \'fas fa-link\';
            const a = document.createElement(\'a\');
            a.href = url;
            a.target = \'_blank\';
            a.rel = \'noopener noreferrer\';
            a.title = tipo.charAt(0).toUpperCase() + tipo.slice(1);
            a.className = \'w-9 h-9 rounded-lg bg-white/20 hover:bg-white/35 border border-white/25 text-white flex items-center justify-center transition\';
            a.innerHTML = `',
  '`;
            linksWrap.appendChild(a);
        });

        const grupos = data.habilidades_grupos || [];
        const contTec = document.getElementById(\'mp_habilidades_tecnicas\');
        const emptyTec = document.getElementById(\'mp_habilidades_tecnicas_empty\');
        contTec.innerHTML = \'\';
        const totalTec = grupos.reduce((acc, g) => acc + ((g.items || []).length), 0);
        if (totalTec === 0) {
            emptyTec.classList.remove(\'hidden\');
        } else {
            emptyTec.classList.add(\'hidden\');
            grupos.forEach(g => {
                const items = g.items || [];
                if (items.length === 0) return;

                const grupoLi = document.createElement(\'li\');
                grupoLi.className = \'space-y-2\';

                const header = document.createElement(\'div\');
                header.className = \'flex items-center gap-2 pb-1.5 border-b border-gray-100\';
                header.innerHTML = `
                    ${g.imagen
                        ? `' => '`;
            linksWrap.appendChild(a);
        });

        const grupos = data.habilidades_grupos || [];
        const contTec = document.getElementById(\'mp_habilidades_tecnicas\');
        const emptyTec = document.getElementById(\'mp_habilidades_tecnicas_empty\');
        contTec.innerHTML = \'\';
        const totalTec = grupos.reduce((acc, g) => acc + ((g.items || []).length), 0);
        if (totalTec === 0) {
            emptyTec.classList.remove(\'hidden\');
        } else {
            emptyTec.classList.add(\'hidden\');
            grupos.forEach(g => {
                const items = g.items || [];
                if (items.length === 0) return;

                const grupoLi = document.createElement(\'li\');
                grupoLi.className = \'space-y-2\';

                const header = document.createElement(\'div\');
                header.className = \'flex items-center gap-2 pb-1.5 border-b border-gray-100\';
                header.innerHTML = `
                    ${g.imagen
                        ? `',
  '`
                        : `' => '`
                        : `',
  '`
                    }' => '`
                    }',
  '${escapeHtml(g.categoria || \'Otras\')}' => '${escapeHtml(g.category || \'Other\')}',
  '(${items.length})' => '(${items.length})',
  '`;
                grupoLi.appendChild(header);

                const inner = document.createElement(\'ul\');
                inner.className = \'space-y-2 pl-1\';
                items.forEach(h => {
                    const sub = document.createElement(\'li\');
                    sub.className = \'flex items-start gap-2.5 text-sm text-gray-700\';
                    const anios = h.anios_experiencia || 0;
                    const aniosTxt = anios === 0 ? \'Menos de 1 año\' : `${anios} ${anios === 1 ? \'año\' : \'años\'}`;
                    sub.innerHTML = `' => '`;
                groupLi . appendChild ( header ) ;

                const inner = document.createElement(\'ul\');
                inner.className = \'space-and-2 pl-1\';
                items . forEach ( h => {
                    const sub = document.createElement(\'li\');
                    sub.className = \'flex items-start gap-2.5 text-sm text-gray-700\';
                    const years = h.years_experience || 0;
                    const yearsTxt = years === 0 ? \'Less than 1 year\' : `${years} ${years === 1 ? \'year\' : \'years\'}`;
                    sub.innerHTML = `',
  '${escapeHtml(h.nombre)}' => '${escapeHtml(h.name)}',
  '${escapeHtml(h.nivel || \'\')}' => '${escapeHtml(h.level || \'\')}',
  '${aniosTxt}' => '${aniosTxt}',
  '${h.descripcion ? `' => '${h.description ? `',
  '${escapeHtml(h.descripcion)}' => '${escapeHtml(h.description)}',
  '`;
                    inner.appendChild(sub);
                });
                grupoLi.appendChild(inner);
                contTec.appendChild(grupoLi);
            });
        }

        const blandas     = data.habilidades_blandas || [];
        const contBlandas = document.getElementById(\'mp_habilidades_blandas\');
        const emptyBlandas = document.getElementById(\'mp_habilidades_blandas_empty\');
        contBlandas.innerHTML = \'\';
        if (blandas.length === 0) {
            emptyBlandas.classList.remove(\'hidden\');
        } else {
            emptyBlandas.classList.add(\'hidden\');
            blandas.forEach(nombre => {
                const li = document.createElement(\'li\');
                li.className = \'flex items-center gap-2.5 hover:text-[#e11d48] transition cursor-default\';
                li.innerHTML = `' => '`;
                    inner.appendChild(sub);
                });
                grupoLi.appendChild(inner);
                contTec.appendChild(grupoLi);
            });
        }

        const blandas     = data.habilidades_blandas || [];
        const contBlandas = document.getElementById(\'mp_habilidades_blandas\');
        const emptyBlandas = document.getElementById(\'mp_habilidades_blandas_empty\');
        contBlandas.innerHTML = \'\';
        if (blandas.length === 0) {
            emptyBlandas.classList.remove(\'hidden\');
        } else {
            emptyBlandas.classList.add(\'hidden\');
            blandas.forEach(nombre => {
                const li = document.createElement(\'li\');
                li.className = \'flex items-center gap-2.5 hover:text-[#e11d48] transition cursor-default\';
                li.innerHTML = `',
  '${escapeHtml(nombre)}' => '${escapeHtml(name)}',
  '`;
                contBlandas.appendChild(li);
            });
        }

        renderTimeline(
            \'mp_experiencias\', \'mp_experiencias_empty\',
            data.experiencias || [],
            (e) => {
                const proys = e.proyectos || [];
                const proysHtml = proys.length ? `' => '`;
                contBlandas.appendChild(li);
            });
        }

        renderTimeline(
            \'mp_experiences\', \'mp_experiencias_empty\',
            data.experiences || [],
            (e) => {
                const proys = e.projects || [];
                const proysHtml = proys.length ? `',
  '${proys.map(pr => pr.url_link
                                ? `' => '${proys.map(pr => pr.url_link
                                ? `',
  '${escapeHtml(pr.nombre)}' => '${escapeHtml(pr.name)}',
  '`
                                : `' => '`
                                : `',
  '`
                            ).join(\'\')}' => '`
                            ).join(\'\')}',
  '` : \'\';
                return `' => '` : \'\';
                return `',
  '${escapeHtml(e.cargo)}' => '${escapeHtml(e.cargo)}',
  '${escapeHtml(e.empresa)}' => '${escapeHtml(e.empresa)}',
  '${e.trabajo_actual
                            ? \'' => '${e.current_job
                            ? \'',
  '\'
                            : \'\'}' => '\'
                            : \'\'}',
  '${formatRangoFecha(e.fecha_ini, e.fecha_fin, e.trabajo_actual)}' => '${formatDateRange(e.ini_date, e.end_date, e.current_job)}',
  '${e.descripcion ? `' => '${e.description ? `',
  '${escapeHtml(e.descripcion)}' => '${escapeHtml(e.description)}',
  '` : \'\'}
                    ${proysHtml}' => '` : \'\'}
                    ${proysHtml}',
  '`;
            }
        );

        renderTimeline(
            \'mp_formacion\', \'mp_formacion_empty\',
            data.formacion || [],
            (f) => `' => '`;
            }
        );

        renderTimeline(
            \'mp_formacion\', \'mp_formacion_empty\',
            data.training || [],
            (f) => `',
  '${escapeHtml(f.titulo)}' => '${escapeHtml(f.title)}',
  '${escapeHtml(f.institucion)}' => '${escapeHtml(p.institution)}',
  '${f.nivel ? `' => '${f.level ? `',
  '${escapeHtml(f.nivel)}' => '${escapeHtml(f.level)}',
  '${formatRangoFecha(f.fecha_ini, f.fecha_fin, false)}' => '${formatRangoFecha(f.fecha_ini, f.fecha_fin, false)}',
  '${f.descripcion ? `' => '${f.description ? `',
  '${escapeHtml(f.descripcion)}' => '${escapeHtml(f.description)}',
  '`
        );

        const ESTADO_LABELS = {
            en_progreso: { label: \'En curso\',     bg: \'bg-[#1e3a5f]/10\', text: \'text-[#1e3a5f]\' },
            completado:  { label: \'Completado\',   bg: \'bg-emerald-50\',   text: \'text-emerald-700\' },
            pendiente:   { label: \'Pendiente\',    bg: \'bg-gray-100\',     text: \'text-gray-600\' },
            cancelado:   { label: \'Cancelado\',    bg: \'bg-red-50\',       text: \'text-[#e11d48]\' },
        };
        renderTimeline(
            \'mp_proyectos\', \'mp_proyectos_empty\',
            data.proyectos_lista || [],
            (pr) => {
                const estado = ESTADO_LABELS[pr.estado] || ESTADO_LABELS.pendiente;
                const tags = (pr.tecnologias || \'\').split(\',\').map(t => t.trim()).filter(Boolean);
                return `' => '`
        );

        const STATUS_LABELS = {
            in_progress: { label: \'In progress\', bg: \'bg-[#1e3a5f]/10\', text: \'text-[#1e3a5f]\' },
            completed: { label: \'Completed\', bg: \'bg-emerald-50\', text: \'text-emerald-700\' },
            pending: { label: \'Pending\', bg: \'bg-gray-100\', text: \'text-gray-600\' },
            canceled: { label: \'Cancelled\', bg: \'bg-red-50\', text: \'text-[#e11d48]\' },
        };
        renderTimeline(
            \'mp_projects\', \'mp_projects_empty\',
            data.projects_list || [],
            (pr) => {
                const status = STATUS_LABELS[pr.status] || STATUS_LABELS.pending;
                const tags = (pr.technologies || \'\').split(\',\').map(t => t.trim()).filter(Boolean);
                return `',
  '${estado.label}' => '${status.label}',
  '${pr.descripcion ? `' => '${pr.description ? `',
  '${escapeHtml(pr.descripcion)}' => '${escapeHtml(pr.description)}',
  '${formatRangoFecha(pr.fecha_ini, pr.fecha_fin, false)}' => '${formatRangoFecha(pr.fecha_ini, pr.fecha_fin, false)}',
  '${tags.slice(0, 6).map(t => `' => '${tags.slice(0, 6).map(t => `',
  '${escapeHtml(t)}' => '${escapeHtml(t)}',
  '`).join(\'\')}${tags.length > 6 ? `' => '`).join(\'\')}${tags.length > 6 ? `',
  '+${tags.length - 6}' => '+${tags.length - 6}',
  '` : \'\'}
                        ${pr.url_link ? `' => '` : \'\'}
                        ${at.url_link? `',
  '`;
            }
        );

        modal.classList.remove(\'hidden\');
        modal.scrollTop = 0;
        const contenido = document.getElementById(\'mp_contenido\');
        if (contenido) contenido.scrollTop = 0;
        document.body.style.overflow = \'hidden\';

        const navLinks = document.querySelectorAll(\'.mp-nav\');
        navLinks.forEach((link, idx) => {
            link.classList.toggle(\'active\', idx === 0);
            link.onclick = function (e) {
                e.preventDefault();
                const id = link.getAttribute(\'href\').replace(\'#\', \'\');
                const target = document.getElementById(id);
                if (!target) return;
                if (contenido && contenido.scrollHeight > contenido.clientHeight) {
                    contenido.scrollTo({ top: target.offsetTop - 8, behavior: \'smooth\' });
                } else {
                    target.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
                }
                navLinks.forEach(l => l.classList.remove(\'active\'));
                link.classList.add(\'active\');
            };
        });
    };

    window.irAProyecto = function (idProyecto) {
        const card = document.getElementById(\'mp_proy_\' + idProyecto);
        if (!card) return;
        card.scrollIntoView({ behavior: \'smooth\', block: \'center\' });
        card.classList.add(\'ring-2\', \'ring-[#e11d48]\', \'ring-offset-2\');
        setTimeout(() => card.classList.remove(\'ring-2\', \'ring-[#e11d48]\', \'ring-offset-2\'), 1800);
    };

    function renderTimeline(contId, emptyId, items, builder) {
        const cont  = document.getElementById(contId);
        const empty = document.getElementById(emptyId);
        cont.innerHTML = \'\';
        if (!items || items.length === 0) {
            empty.classList.remove(\'hidden\');
            return;
        }
        empty.classList.add(\'hidden\');
        cont.innerHTML = items.map(builder).join(\'\');
    }

    function formatRangoFecha(ini, fin, actual) {
        if (!ini) return \'\';
        const f = (s) => {
            const d = new Date(s + \'T12:00:00\');
            if (isNaN(d.getTime())) return \'\';
            const meses = [\'Ene\',\'Feb\',\'Mar\',\'Abr\',\'May\',\'Jun\',\'Jul\',\'Ago\',\'Sep\',\'Oct\',\'Nov\',\'Dic\'];
            return `${meses[d.getMonth()]} ${d.getFullYear()}`;
        };
        const ini2 = f(ini);
        const fin2 = actual ? \'Actualidad\' : (fin ? f(fin) : \'—\');
        return `${ini2} – ${fin2}`;
    }

    window.cerrarModalPortafolio = function () {
        modal.classList.add(\'hidden\');
        document.body.style.overflow = \'\';
    };

    window.cerrarModalPortafolioFondo = function (e) {
        if (e.target === modal) cerrarModalPortafolio();
    };

    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\' && !modal.classList.contains(\'hidden\')) cerrarModalPortafolio();
    });
})();' => '`;
            }
        );

        modal.classList.remove(\'hidden\');
        modal.scrollTop = 0;
        const contenido = document.getElementById(\'mp_contenido\');
        if (contenido) contenido.scrollTop = 0;
        document.body.style.overflow = \'hidden\';

        const navLinks = document.querySelectorAll(\'.mp-nav\');
        navLinks.forEach((link, idx) => {
            link.classList.toggle(\'active\', idx === 0);
            link.onclick = function (e) {
                e.preventDefault();
                const id = link.getAttribute(\'href\').replace(\'#\', \'\');
                const target = document.getElementById(id);
                if (!target) return;
                if (contenido && contenido.scrollHeight > contenido.clientHeight) {
                    contenido.scrollTo({ top: target.offsetTop - 8, behavior: \'smooth\' });
                } else {
                    target.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
                }
                navLinks.forEach(l => l.classList.remove(\'active\'));
                link.classList.add(\'active\');
            };
        });
    };

    window.irAProyecto = function (idProyecto) {
        const card = document.getElementById(\'mp_proy_\' + idProyecto);
        if (!card) return;
        card.scrollIntoView({ behavior: \'smooth\', block: \'center\' });
        card.classList.add(\'ring-2\', \'ring-[#e11d48]\', \'ring-offset-2\');
        setTimeout(() => card.classList.remove(\'ring-2\', \'ring-[#e11d48]\', \'ring-offset-2\'), 1800);
    };

    function renderTimeline(contId, emptyId, items, builder) {
        const cont  = document.getElementById(contId);
        const empty = document.getElementById(emptyId);
        cont.innerHTML = \'\';
        if (!items || items.length === 0) {
            empty.classList.remove(\'hidden\');
            return;
        }
        empty.classList.add(\'hidden\');
        cont.innerHTML = items.map(builder).join(\'\');
    }

    function formatRangoFecha(ini, fin, actual) {
        if (!ini) return \'\';
        const f = (s) => {
            const d = new Date(s + \'T12:00:00\');
            if (isNaN(d.getTime())) return \'\';
            const meses = [\'Ene\',\'Feb\',\'Mar\',\'Abr\',\'May\',\'Jun\',\'Jul\',\'Ago\',\'Sep\',\'Oct\',\'Nov\',\'Dic\'];
            return `${meses[d.getMonth()]} ${d.getFullYear()}`;
        };
        const ini2 = f(ini);
        const fin2 = actual ? \'Actualidad\' : (fin ? f(fin) : \'—\');
        return `${ini2} – ${fin2}`;
    }

    window.cerrarModalPortafolio = function () {
        modal.classList.add(\'hidden\');
        document.body.style.overflow = \'\';
    };

    window.cerrarModalPortafolioFondo = function (e) {
        if (e.target === modal) cerrarModalPortafolio();
    };

    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\' && !modal.classList.contains(\'hidden\')) cerrarModalPortafolio();
    });
})();',
  'Vista previa — así verán tu portafolio' => 'Preview — this is how they will see your portfolio',
  'Experiencia' => 'Experience',
  'Educación' => 'Education',
  'Años' => 'Years',
  'Empresas' => 'Companies',
  'Sin habilidades registradas.' => 'No registered skills.',
  'Sin habilidades blandas.' => 'No soft skills.',
  'No hay proyectos publicados.' => 'There are no published projects.',
  'No hay experiencia laboral registrada.' => 'There is no registered work experience.',
  'No hay formación académica registrada.' => 'There is no registered academic training.',
  '.mp-nav.active {
        background-color: rgba(255,255,255,0.22);
        box-shadow: inset 3px 0 0 #fff;
        font-weight: 700;
    }
    .mp-nav.active i.fa-chevron-right { opacity: 0.9 !important; }
    #mp_contenido { scroll-behavior: smooth; }

    #mp_contenido::-webkit-scrollbar,
    #mp_sidebar::-webkit-scrollbar { width: 6px; }
    #mp_contenido::-webkit-scrollbar-thumb { background: rgba(225,29,72,0.3); border-radius: 3px; }
    #mp_sidebar::-webkit-scrollbar-thumb   { background: rgba(255,255,255,0.3); border-radius: 3px; }

    #mp_experiencias > div,
    #mp_formacion    > div { position: relative; }
    #mp_experiencias > div::before,
    #mp_formacion    > div::before {
        content: \'\';
        position: absolute;
        left: -1.6rem;
        top: 1.25rem;
        width: 0.75rem;
        height: 0.75rem;
        border-radius: 9999px;
        background: linear-gradient(135deg, #1e3a5f, #e11d48);
        box-shadow: 0 0 0 3px #fff, 0 0 0 4px rgba(225,29,72,0.25);
    }

    @keyframes mpFadeUp {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    #modalPortafolio:not(.hidden) > div > div { animation: mpFadeUp .35s ease both; }' => '.mp-nav.active {
        background-color: rgba(255,255,255,0.22);
        box-shadow: inset 3px 0 0 #fff;
        font-weight: 700;
    }
    .mp-nav.active i.fa-chevron-right { opacity: 0.9 !important; }
    #mp_contenido { scroll-behavior: smooth; }

    #mp_contenido::-webkit-scrollbar,
    #mp_sidebar::-webkit-scrollbar { width: 6px; }
    #mp_contenido::-webkit-scrollbar-thumb { background: rgba(225,29,72,0.3); border-radius: 3px; }
    #mp_sidebar::-webkit-scrollbar-thumb   { background: rgba(255,255,255,0.3); border-radius: 3px; }

    #mp_experiencias > div,
    #mp_formacion    > div { position: relative; }
    #mp_experiencias > div::before,
    #mp_formacion    > div::before {
        content: \'\';
        position: absolute;
        left: -1.6rem;
        top: 1.25rem;
        width: 0.75rem;
        height: 0.75rem;
        border-radius: 9999px;
        background: linear-gradient(135deg, #1e3a5f, #e11d48);
        box-shadow: 0 0 0 3px #fff, 0 0 0 4px rgba(225,29,72,0.25);
    }

    @keyframes mpFadeUp {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    #modalPortafolio:not(.hidden) > div > div { animation: mpFadeUp .35s ease both; }',
  'Proyectos y portafolios públicos' => 'Public projects and portfolios',
  'Encuentra desarrolladores filtrando por tecnología, categoría, experiencia o ubicación.' => 'Find developers by filtering by technology, category, experience or location.',
  'Buscar' => 'Look for',
  'Años mín. experiencia' => 'Min years experience',
  'Categoría de tecnología' => 'Technology category',
  'nombre }}" data-cat-tec="{{ $categoria }}">{{ $tec->nombre }}' => 'name }}" data-cat-tec="{{ $category }}">{{ $tec->name }}',
  'Categorías de habilidades' => 'Skill Categories',
  'id_categoria }}">{{ $cat->nombre }}' => 'category_id }}">{{ $cat->name }}',
  'Solo con proyectos publicados' => 'Only with published projects',
  'Cargando portafolios...' => 'Loading portfolio...',
  'No encontramos portafolios con esos filtros' => 'We did not find portfolios with those filters',
  'Prueba ajustando los filtros o limpiándolos.' => 'Try adjusting the filters or cleaning them.',
  'Cargar más' => 'Load more',
  'Nombre, biografía o cargo...' => 'Name, biography or position...',
  'Selecciona una o varias' => 'Select one or more',
  'Ciudad o país' => 'City or country',
  'function abrirLogin() {
        const modal = document.getElementById(\'modalLogin\');
        if (modal) {
            modal.classList.remove(\'hidden\');
            modal.classList.add(\'flex\');
        }
    }

    function cerrarLogin() {
        const modal = document.getElementById(\'modalLogin\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
        }
    }

    function abrirRegister() {
        const modal = document.getElementById(\'modalRegister\');
        if (modal) {
            modal.classList.remove(\'hidden\');
            modal.classList.add(\'flex\');
        }
    }

    function cerrarRegister() {
        const modal = document.getElementById(\'modalRegister\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
        }
    }

    function irALogin() {
        cerrarRegister();
        abrirLogin();
    }

    function irARegister() {
        cerrarLogin();
        abrirRegister();
    }

    document.querySelectorAll(\'.dropdown\').forEach(dropdown => {
        const button = dropdown.querySelector(\'button\');
        const menu = dropdown.querySelector(\'.dropdown-menu\');

        if (button && menu) {
            button.addEventListener(\'click\', (e) => {
                e.stopPropagation();

                document.querySelectorAll(\'.dropdown-menu\').forEach(m => {
                    if (m !== menu) m.classList.add(\'hidden\');
                });

                menu.classList.toggle(\'hidden\');
            });
        }
    });

    document.addEventListener(\'click\', (e) => {
        if (!e.target.closest(\'.dropdown\')) {
            document.querySelectorAll(\'.dropdown-menu\').forEach(menu => {
                menu.classList.add(\'hidden\');
            });
        }
    });

    const flashMessage = document.getElementById(\'flashMessage\');

    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.opacity = \'0\';
            flashMessage.style.transform = \'translateY(-10px)\';

            setTimeout(() => {
                flashMessage.remove();
            }, 500);
        }, 3000);
    }

    const menuLinks = document.querySelectorAll(\'.menu-link\');
    const secciones = document.querySelectorAll(\'#inicio, #explorar, #como-funciona, #sobre-nosotros\');

    function activarMenuActual() {
        let seccionActual = \'inicio\';
        const puntoReferencia = window.scrollY + 140;

        secciones.forEach(seccion => {
            const top = seccion.offsetTop;
            const height = seccion.offsetHeight;

            if (puntoReferencia >= top && puntoReferencia' => 'function abrirLogin() {
        const modal = document.getElementById(\'modalLogin\');
        if (modal) {
            modal.classList.remove(\'hidden\');
            modal.classList.add(\'flex\');
        }
    }

    function cerrarLogin() {
        const modal = document.getElementById(\'modalLogin\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
        }
    }

    function abrirRegister() {
        const modal = document.getElementById(\'modalRegister\');
        if (modal) {
            modal.classList.remove(\'hidden\');
            modal.classList.add(\'flex\');
        }
    }

    function cerrarRegister() {
        const modal = document.getElementById(\'modalRegister\');
        if (modal) {
            modal.classList.add(\'hidden\');
            modal.classList.remove(\'flex\');
        }
    }

    function irALogin() {
        cerrarRegister();
        abrirLogin();
    }

    function irARegister() {
        cerrarLogin();
        abrirRegister();
    }

    document.querySelectorAll(\'.dropdown\').forEach(dropdown => {
        const button = dropdown.querySelector(\'button\');
        const menu = dropdown.querySelector(\'.dropdown-menu\');

        if (button && menu) {
            button.addEventListener(\'click\', (e) => {
                e.stopPropagation();

                document.querySelectorAll(\'.dropdown-menu\').forEach(m => {
                    if (m !== menu) m.classList.add(\'hidden\');
                });

                menu.classList.toggle(\'hidden\');
            });
        }
    });

    document.addEventListener(\'click\', (e) => {
        if (!e.target.closest(\'.dropdown\')) {
            document.querySelectorAll(\'.dropdown-menu\').forEach(menu => {
                menu.classList.add(\'hidden\');
            });
        }
    });

    const flashMessage = document.getElementById(\'flashMessage\');

    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.opacity = \'0\';
            flashMessage.style.transform = \'translateY(-10px)\';

            setTimeout(() => {
                flashMessage.remove();
            }, 500);
        }, 3000);
    }

    const menuLinks = document.querySelectorAll(\'.menu-link\');
    const secciones = document.querySelectorAll(\'#inicio, #explorar, #como-funciona, #sobre-nosotros\');

    function activarMenuActual() {
        let seccionActual = \'inicio\';
        const puntoReferencia = window.scrollY + 140;

        secciones.forEach(seccion => {
            const top = seccion.offsetTop;
            const height = seccion.offsetHeight;

            if (puntoReferencia >= top && puntoReferencia',
  '{
            link.classList.remove(\'text-[#e11d48]\', \'font-bold\');
            link.classList.add(\'text-gray-600\');

            if (link.getAttribute(\'href\') === `#${seccionActual}`) {
                link.classList.remove(\'text-gray-600\');
                link.classList.add(\'text-[#e11d48]\', \'font-bold\');
            }
        });
    }

    window.addEventListener(\'scroll\', activarMenuActual);
    window.addEventListener(\'load\', activarMenuActual);

    menuLinks.forEach(link => {
        link.addEventListener(\'click\', function () {
            menuLinks.forEach(item => {
                item.classList.remove(\'text-[#e11d48]\', \'font-bold\');
                item.classList.add(\'text-gray-600\');
            });

            this.classList.remove(\'text-gray-600\');
            this.classList.add(\'text-[#e11d48]\', \'font-bold\');
        });
    });

    const loginForm = document.getElementById(\'loginForm\');
    const loginCorreo = document.getElementById(\'loginCorreo\');
    const loginContrasenia = document.getElementById(\'loginContrasenia\');
    const loginErrorBox = document.getElementById(\'loginErrorBox\');
    const loginCorreoError = document.getElementById(\'loginCorreoError\');
    const loginContraseniaError = document.getElementById(\'loginContraseniaError\');

    function mostrarErrorGeneralLogin(mensaje) {
        if (!loginErrorBox) return;
        loginErrorBox.textContent = mensaje;
        loginErrorBox.classList.remove(\'hidden\');
    }

    function limpiarErrorGeneralLogin() {
        if (!loginErrorBox) return;
        loginErrorBox.textContent = \'\';
        loginErrorBox.classList.add(\'hidden\');
    }

    function marcarInputError(input, errorElement, mensaje) {
        if (!input || !errorElement) return;
        input.classList.add(\'border-red-500\', \'ring-2\', \'ring-red-200\');
        input.classList.remove(\'border-gray-300\');
        errorElement.textContent = mensaje;
        errorElement.classList.remove(\'hidden\');
    }

    function limpiarInputError(input, errorElement) {
        if (!input || !errorElement) return;
        input.classList.remove(\'border-red-500\', \'ring-2\', \'ring-red-200\');
        input.classList.add(\'border-gray-300\');
        errorElement.textContent = \'\';
        errorElement.classList.add(\'hidden\');
    }

    function limpiarErroresLogin() {
        limpiarErrorGeneralLogin();
        limpiarInputError(loginCorreo, loginCorreoError);
        limpiarInputError(loginContrasenia, loginContraseniaError);
    }

    if (loginForm) {
        loginForm.addEventListener(\'submit\', async function (e) {
            e.preventDefault();
            limpiarErroresLogin();

            const correo = loginCorreo?.value.trim() || \'\';
            const contrasenia = loginContrasenia?.value.trim() || \'\';

            let hayErrores = false;

            if (!correo) {
                marcarInputError(loginCorreo, loginCorreoError, \'Debes ingresar tu correo electrónico.\');
                hayErrores = true;
            } else {
                const emailValido = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
                if (!emailValido.test(correo)) {
                    marcarInputError(loginCorreo, loginCorreoError, \'Ingresa un correo electrónico válido.\');
                    hayErrores = true;
                }
            }

            if (!contrasenia) {
                marcarInputError(loginContrasenia, loginContraseniaError, \'Debes ingresar tu contraseña.\');
                hayErrores = true;
            }

            if (hayErrores) return;

            const formData = new FormData(loginForm);

            try {
                const response = await fetch(loginForm.action, {
                    method: \'POST\',
                    body: formData,
                    headers: {
                        \'X-Requested-With\': \'XMLHttpRequest\',
                        \'Accept\': \'application/json\'
                    }
                });

                const contentType = response.headers.get(\'content-type\') || \'\';

                if (!contentType.includes(\'application/json\')) {
                    mostrarErrorGeneralLogin(\'La respuesta del servidor no fue válida.\');
                    return;
                }

                const data = await response.json();

                if (!response.ok) {
                    mostrarErrorGeneralLogin(data.message || \'No se pudo iniciar sesión.\');
                    return;
                }

                if (data.ok && data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    mostrarErrorGeneralLogin(\'Ocurrió un error inesperado.\');
                }

            } catch (error) {
                mostrarErrorGeneralLogin(\'No se pudo conectar con el servidor. Intenta nuevamente.\');
            }
        });

        [loginCorreo, loginContrasenia].forEach(input => {
            if (input) {
                input.addEventListener(\'input\', () => {
                    limpiarErrorGeneralLogin();

                    if (input === loginCorreo) {
                        limpiarInputError(loginCorreo, loginCorreoError);
                    }

                    if (input === loginContrasenia) {
                        limpiarInputError(loginContrasenia, loginContraseniaError);
                    }
                });
            }
        });
    }

    const registerForm = document.getElementById(\'registerForm\');
    const registerNombre = document.getElementById(\'registerNombre\');
    const registerApellido = document.getElementById(\'registerApellido\');
    const registerCorreo = document.getElementById(\'registerCorreo\');
    const registerTelefono = document.getElementById(\'registerTelefono\');
    const registerContrasenia = document.getElementById(\'registerContrasenia\');
    const registerContraseniaConfirmacion = document.getElementById(\'registerContraseniaConfirmacion\');
    const registerErrorBox = document.getElementById(\'registerErrorBox\');

    const registerNombreError = document.getElementById(\'registerNombreError\');
    const registerApellidoError = document.getElementById(\'registerApellidoError\');
    const registerCorreoError = document.getElementById(\'registerCorreoError\');
    const registerTelefonoError = document.getElementById(\'registerTelefonoError\');
    const registerContraseniaError = document.getElementById(\'registerContraseniaError\');
    const registerContraseniaConfirmacionError = document.getElementById(\'registerContraseniaConfirmacionError\');

    function mostrarErrorGeneralRegister(mensaje) {
        if (!registerErrorBox) return;
        registerErrorBox.textContent = mensaje;
        registerErrorBox.classList.remove(\'hidden\');
    }

    function limpiarErrorGeneralRegister() {
        if (!registerErrorBox) return;
        registerErrorBox.textContent = \'\';
        registerErrorBox.classList.add(\'hidden\');
    }

    function marcarInputErrorRegister(input, errorElement, mensaje) {
        if (!input || !errorElement) return;
        input.classList.add(\'border-red-500\', \'ring-2\', \'ring-red-200\');
        input.classList.remove(\'border-gray-300\');
        errorElement.textContent = mensaje;
        errorElement.classList.remove(\'hidden\');
    }

    function limpiarInputErrorRegister(input, errorElement) {
        if (!input || !errorElement) return;
        input.classList.remove(\'border-red-500\', \'ring-2\', \'ring-red-200\');
        input.classList.add(\'border-gray-300\');
        errorElement.textContent = \'\';
        errorElement.classList.add(\'hidden\');
    }

    function limpiarErroresRegister() {
        limpiarErrorGeneralRegister();
        limpiarInputErrorRegister(registerNombre, registerNombreError);
        limpiarInputErrorRegister(registerApellido, registerApellidoError);
        limpiarInputErrorRegister(registerCorreo, registerCorreoError);
        limpiarInputErrorRegister(registerTelefono, registerTelefonoError);
        limpiarInputErrorRegister(registerContrasenia, registerContraseniaError);
        limpiarInputErrorRegister(registerContraseniaConfirmacion, registerContraseniaConfirmacionError);
    }

    if (registerForm) {
        registerForm.addEventListener(\'submit\', async function (e) {
            e.preventDefault();
            limpiarErroresRegister();

            const nombre = registerNombre?.value.trim() || \'\';
            const apellido = registerApellido?.value.trim() || \'\';
            const correo = registerCorreo?.value.trim() || \'\';
            const telefono = registerTelefono?.value.trim() || \'\';
            const contrasenia = registerContrasenia?.value || \'\';
            const confirmacion = registerContraseniaConfirmacion?.value || \'\';

            let hayErrores = false;

            if (!nombre) {
                marcarInputErrorRegister(registerNombre, registerNombreError, \'Debes ingresar tu nombre.\');
                hayErrores = true;
            }

            if (!apellido) {
                marcarInputErrorRegister(registerApellido, registerApellidoError, \'Debes ingresar tus apellidos.\');
                hayErrores = true;
            }

            if (!correo) {
                marcarInputErrorRegister(registerCorreo, registerCorreoError, \'Debes ingresar tu correo electrónico.\');
                hayErrores = true;
            } else {
                const emailValido = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
                if (!emailValido.test(correo)) {
                    marcarInputErrorRegister(registerCorreo, registerCorreoError, \'Ingresa un correo electrónico válido.\');
                    hayErrores = true;
                }
            }

            if (telefono.length > 50) {
                marcarInputErrorRegister(registerTelefono, registerTelefonoError, \'El teléfono no debe exceder los 50 caracteres.\');
                hayErrores = true;
            }

            if (!contrasenia) {
                marcarInputErrorRegister(registerContrasenia, registerContraseniaError, \'Debes ingresar una contraseña.\');
                hayErrores = true;
            } else if (contrasenia.length' => '{
            link.classList.remove(\'text-[#e11d48]\', \'font-bold\');
            link.classList.add(\'text-gray-600\');

            if (link.getAttribute(\'href\') === `#${seccionActual}`) {
                link.classList.remove(\'text-gray-600\');
                link.classList.add(\'text-[#e11d48]\', \'font-bold\');
            }
        });
    }

    window.addEventListener(\'scroll\', activarMenuActual);
    window.addEventListener(\'load\', activarMenuActual);

    menuLinks.forEach(link => {
        link.addEventListener(\'click\', function () {
            menuLinks.forEach(item => {
                item.classList.remove(\'text-[#e11d48]\', \'font-bold\');
                item.classList.add(\'text-gray-600\');
            });

            this.classList.remove(\'text-gray-600\');
            this.classList.add(\'text-[#e11d48]\', \'font-bold\');
        });
    });

    const loginForm = document.getElementById(\'loginForm\');
    const loginCorreo = document.getElementById(\'loginCorreo\');
    const loginContrasenia = document.getElementById(\'loginContrasenia\');
    const loginErrorBox = document.getElementById(\'loginErrorBox\');
    const loginCorreoError = document.getElementById(\'loginCorreoError\');
    const loginContraseniaError = document.getElementById(\'loginContraseniaError\');

    function mostrarErrorGeneralLogin(mensaje) {
        if (!loginErrorBox) return;
        loginErrorBox.textContent = mensaje;
        loginErrorBox.classList.remove(\'hidden\');
    }

    function limpiarErrorGeneralLogin() {
        if (!loginErrorBox) return;
        loginErrorBox.textContent = \'\';
        loginErrorBox.classList.add(\'hidden\');
    }

    function marcarInputError(input, errorElement, mensaje) {
        if (!input || !errorElement) return;
        input.classList.add(\'border-red-500\', \'ring-2\', \'ring-red-200\');
        input.classList.remove(\'border-gray-300\');
        errorElement.textContent = mensaje;
        errorElement.classList.remove(\'hidden\');
    }

    function limpiarInputError(input, errorElement) {
        if (!input || !errorElement) return;
        input.classList.remove(\'border-red-500\', \'ring-2\', \'ring-red-200\');
        input.classList.add(\'border-gray-300\');
        errorElement.textContent = \'\';
        errorElement.classList.add(\'hidden\');
    }

    function limpiarErroresLogin() {
        limpiarErrorGeneralLogin();
        limpiarInputError(loginCorreo, loginCorreoError);
        limpiarInputError(loginContrasenia, loginContraseniaError);
    }

    if (loginForm) {
        loginForm.addEventListener(\'submit\', async function (e) {
            e.preventDefault();
            limpiarErroresLogin();

            const correo = loginCorreo?.value.trim() || \'\';
            const contrasenia = loginContrasenia?.value.trim() || \'\';

            let hayErrores = false;

            if (!correo) {
                marcarInputError(loginCorreo, loginCorreoError, \'Debes ingresar tu correo electrónico.\');
                hayErrores = true;
            } else {
                const emailValido = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
                if (!emailValido.test(correo)) {
                    marcarInputError(loginCorreo, loginCorreoError, \'Ingresa un correo electrónico válido.\');
                    hayErrores = true;
                }
            }

            if (!contrasenia) {
                marcarInputError(loginContrasenia, loginContraseniaError, \'Debes ingresar tu contraseña.\');
                hayErrores = true;
            }

            if (hayErrores) return;

            const formData = new FormData(loginForm);

            try {
                const response = await fetch(loginForm.action, {
                    method: \'POST\',
                    body: formData,
                    headers: {
                        \'X-Requested-With\': \'XMLHttpRequest\',
                        \'Accept\': \'application/json\'
                    }
                });

                const contentType = response.headers.get(\'content-type\') || \'\';

                if (!contentType.includes(\'application/json\')) {
                    mostrarErrorGeneralLogin(\'La respuesta del servidor no fue válida.\');
                    return;
                }

                const data = await response.json();

                if (!response.ok) {
                    mostrarErrorGeneralLogin(data.message || \'No se pudo iniciar sesión.\');
                    return;
                }

                if (data.ok && data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    mostrarErrorGeneralLogin(\'Ocurrió un error inesperado.\');
                }

            } catch (error) {
                mostrarErrorGeneralLogin(\'No se pudo conectar con el servidor. Intenta nuevamente.\');
            }
        });

        [loginCorreo, loginContrasenia].forEach(input => {
            if (input) {
                input.addEventListener(\'input\', () => {
                    limpiarErrorGeneralLogin();

                    if (input === loginCorreo) {
                        limpiarInputError(loginCorreo, loginCorreoError);
                    }

                    if (input === loginContrasenia) {
                        limpiarInputError(loginContrasenia, loginContraseniaError);
                    }
                });
            }
        });
    }

    const registerForm = document.getElementById(\'registerForm\');
    const registerNombre = document.getElementById(\'registerNombre\');
    const registerApellido = document.getElementById(\'registerApellido\');
    const registerCorreo = document.getElementById(\'registerCorreo\');
    const registerTelefono = document.getElementById(\'registerTelefono\');
    const registerContrasenia = document.getElementById(\'registerContrasenia\');
    const registerContraseniaConfirmacion = document.getElementById(\'registerContraseniaConfirmacion\');
    const registerErrorBox = document.getElementById(\'registerErrorBox\');

    const registerNombreError = document.getElementById(\'registerNombreError\');
    const registerApellidoError = document.getElementById(\'registerApellidoError\');
    const registerCorreoError = document.getElementById(\'registerCorreoError\');
    const registerTelefonoError = document.getElementById(\'registerTelefonoError\');
    const registerContraseniaError = document.getElementById(\'registerContraseniaError\');
    const registerContraseniaConfirmacionError = document.getElementById(\'registerContraseniaConfirmacionError\');

    function mostrarErrorGeneralRegister(mensaje) {
        if (!registerErrorBox) return;
        registerErrorBox.textContent = mensaje;
        registerErrorBox.classList.remove(\'hidden\');
    }

    function limpiarErrorGeneralRegister() {
        if (!registerErrorBox) return;
        registerErrorBox.textContent = \'\';
        registerErrorBox.classList.add(\'hidden\');
    }

    function marcarInputErrorRegister(input, errorElement, mensaje) {
        if (!input || !errorElement) return;
        input.classList.add(\'border-red-500\', \'ring-2\', \'ring-red-200\');
        input.classList.remove(\'border-gray-300\');
        errorElement.textContent = mensaje;
        errorElement.classList.remove(\'hidden\');
    }

    function limpiarInputErrorRegister(input, errorElement) {
        if (!input || !errorElement) return;
        input.classList.remove(\'border-red-500\', \'ring-2\', \'ring-red-200\');
        input.classList.add(\'border-gray-300\');
        errorElement.textContent = \'\';
        errorElement.classList.add(\'hidden\');
    }

    function limpiarErroresRegister() {
        limpiarErrorGeneralRegister();
        limpiarInputErrorRegister(registerNombre, registerNombreError);
        limpiarInputErrorRegister(registerApellido, registerApellidoError);
        limpiarInputErrorRegister(registerCorreo, registerCorreoError);
        limpiarInputErrorRegister(registerTelefono, registerTelefonoError);
        limpiarInputErrorRegister(registerContrasenia, registerContraseniaError);
        limpiarInputErrorRegister(registerContraseniaConfirmacion, registerContraseniaConfirmacionError);
    }

    if (registerForm) {
        registerForm.addEventListener(\'submit\', async function (e) {
            e.preventDefault();
            limpiarErroresRegister();

            const nombre = registerNombre?.value.trim() || \'\';
            const apellido = registerApellido?.value.trim() || \'\';
            const correo = registerCorreo?.value.trim() || \'\';
            const telefono = registerTelefono?.value.trim() || \'\';
            const contrasenia = registerContrasenia?.value || \'\';
            const confirmacion = registerContraseniaConfirmacion?.value || \'\';

            let hayErrores = false;

            if (!nombre) {
                marcarInputErrorRegister(registerNombre, registerNombreError, \'Debes ingresar tu nombre.\');
                hayErrores = true;
            }

            if (!apellido) {
                marcarInputErrorRegister(registerApellido, registerApellidoError, \'Debes ingresar tus apellidos.\');
                hayErrores = true;
            }

            if (!correo) {
                marcarInputErrorRegister(registerCorreo, registerCorreoError, \'Debes ingresar tu correo electrónico.\');
                hayErrores = true;
            } else {
                const emailValido = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
                if (!emailValido.test(correo)) {
                    marcarInputErrorRegister(registerCorreo, registerCorreoError, \'Ingresa un correo electrónico válido.\');
                    hayErrores = true;
                }
            }

            if (telefono.length > 50) {
                marcarInputErrorRegister(registerTelefono, registerTelefonoError, \'El teléfono no debe exceder los 50 caracteres.\');
                hayErrores = true;
            }

            if (!contrasenia) {
                marcarInputErrorRegister(registerContrasenia, registerContraseniaError, \'Debes ingresar una contraseña.\');
                hayErrores = true;
            } else if (contrasenia.length',
  '{
            if (input) {
                input.addEventListener(\'input\', () => {
                    limpiarErrorGeneralRegister();

                    if (input === registerNombre) limpiarInputErrorRegister(registerNombre, registerNombreError);
                    if (input === registerApellido) limpiarInputErrorRegister(registerApellido, registerApellidoError);
                    if (input === registerCorreo) limpiarInputErrorRegister(registerCorreo, registerCorreoError);
                    if (input === registerTelefono) limpiarInputErrorRegister(registerTelefono, registerTelefonoError);
                    if (input === registerContrasenia) limpiarInputErrorRegister(registerContrasenia, registerContraseniaError);
                    if (input === registerContraseniaConfirmacion) limpiarInputErrorRegister(registerContraseniaConfirmacion, registerContraseniaConfirmacionError);
                });
            }
        });
    }

    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (!input || !icon) return;

        if (input.type === \'password\') {
            input.type = \'text\';
            icon.classList.remove(\'fa-eye\');
            icon.classList.add(\'fa-eye-slash\');
        } else {
            input.type = \'password\';
            icon.classList.remove(\'fa-eye-slash\');
            icon.classList.add(\'fa-eye\');
        }
    }

    // ── Buscador público de portafolios ────────────────────────────────────
    (function inicializarBuscadorPortafolios() {
        const form        = document.getElementById(\'form-buscador-portafolios\');
        const contenedor  = document.getElementById(\'buscador-portafolios-resultados\');
        const skeleton    = document.getElementById(\'buscador-portafolios-skeleton\');
        const vacio       = document.getElementById(\'buscador-portafolios-vacio\');
        const estado      = document.getElementById(\'buscador-portafolios-estado\');
        const btnCargarMas = document.getElementById(\'btn-buscador-cargar-mas\');
        if (!form || !contenedor) return;

        const LIMITE = 12;
        let offset = 0;
        let total  = 0;
        let cargando = false;
        let filtrosActuales = {};
        const choicesInstances = {};

        // Catálogo original de tecnologías (preservado al inicializar)
        let catalogoTecnologias = null;

        // Inicializa Choices.js en los' => '{
            if (input) {
                input.addEventListener(\'input\', () => {
                    limpiarErrorGeneralRegister();

                    if (input === registerNombre) limpiarInputErrorRegister(registerNombre, registerNombreError);
                    if (input === registerApellido) limpiarInputErrorRegister(registerApellido, registerApellidoError);
                    if (input === registerCorreo) limpiarInputErrorRegister(registerCorreo, registerCorreoError);
                    if (input === registerTelefono) limpiarInputErrorRegister(registerTelefono, registerTelefonoError);
                    if (input === registerContrasenia) limpiarInputErrorRegister(registerContrasenia, registerContraseniaError);
                    if (input === registerContraseniaConfirmacion) limpiarInputErrorRegister(registerContraseniaConfirmacion, registerContraseniaConfirmacionError);
                });
            }
        });
    }

    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (!input || !icon) return;

        if (input.type === \'password\') {
            input.type = \'text\';
            icon.classList.remove(\'fa-eye\');
            icon.classList.add(\'fa-eye-slash\');
        } else {
            input.type = \'password\';
            icon.classList.remove(\'fa-eye-slash\');
            icon.classList.add(\'fa-eye\');
        }
    }

    // ── Buscador público de portafolios ────────────────────────────────────
    (function inicializarBuscadorPortafolios() {
        const form        = document.getElementById(\'form-buscador-portafolios\');
        const contenedor  = document.getElementById(\'buscador-portafolios-resultados\');
        const skeleton    = document.getElementById(\'buscador-portafolios-skeleton\');
        const vacio       = document.getElementById(\'buscador-portafolios-vacio\');
        const estado      = document.getElementById(\'buscador-portafolios-estado\');
        const btnCargarMas = document.getElementById(\'btn-buscador-cargar-mas\');
        if (!form || !contenedor) return;

        const LIMITE = 12;
        let offset = 0;
        let total  = 0;
        let cargando = false;
        let filtrosActuales = {};
        const choicesInstances = {};

        // Catálogo original de tecnologías (preservado al inicializar)
        let catalogoTecnologias = null;

        // Inicializa Choices.js en los',
  'del buscador (multi y single).
        function inicializarChoices() {
            if (typeof Choices === \'undefined\') return;

            // Multiselects con pills
            form.querySelectorAll(\'select[data-buscador-multi]\').forEach(sel => {
                const key = sel.dataset.buscadorMulti;
                if (choicesInstances[key]) return;

                // Capturamos el catálogo original de tecnologías antes de que Choices lo mueva
                if (key === \'tecnologias\' && !catalogoTecnologias) {
                    catalogoTecnologias = construirCatalogoTecnologias(sel);
                }

                const inst = new Choices(sel, {
                    removeItemButton: true,
                    shouldSort: false,
                    placeholder: true,
                    placeholderValue: sel.getAttribute(\'placeholder\') || \'Selecciona...\',
                    noResultsText: \'Sin coincidencias\',
                    noChoicesText: \'No hay más opciones\',
                    itemSelectText: \'\',
                    classNames: { containerInner: \'choices__inner buscador-choice\' },
                });
                inst.containerOuter.element.classList.add(\'buscador-multi-\' + key);
                choicesInstances[key] = inst;
            });

            // Selects single (uno solo seleccionable)
            form.querySelectorAll(\'select[data-buscador-single]\').forEach(sel => {
                const key = sel.dataset.buscadorSingle;
                if (choicesInstances[key]) return;
                const inst = new Choices(sel, {
                    shouldSort: false,
                    searchEnabled: true,
                    noResultsText: \'Sin coincidencias\',
                    itemSelectText: \'\',
                    classNames: { containerInner: \'choices__inner buscador-choice\' },
                });
                inst.containerOuter.element.classList.add(\'buscador-single-\' + key);
                choicesInstances[key] = inst;
            });

            // Conectar: cuando cambia la categoría de tecnología, repintar el dropdown de tecnologías
            const selectCatTec = form.querySelector(\'select[data-buscador-single="categoriatec"]\');
            if (selectCatTec) {
                selectCatTec.addEventListener(\'change\', () => filtrarTecnologiasPorCategoria());
            }
        }

        // Lee los' => 'of the search engine (multi and single).
        function initializeChoices() {
            if (typeofChoices === \'undefined\') return;

            // Multiselects with pills
            form.querySelectorAll(\'select[data-search-multi]\').forEach(sel => {
                const key = sel.dataset.multisearch;
                if (choicesInstances[key]) return;

                // We capture the original catalog of technologies before Choices moves it
                if (key === \'technologies\' && !technologycatalogo) {
                    technologyCatalog = buildTechnologyCatalog(sel);
                }

                const inst = new Choices(sel, {
                    removeItemButton: true,
                    shouldSort: false,
                    placeholder: true,
                    placeholderValue: sel.getAttribute(\'placeholder\') || \'Select...\',
                    noResultsText: \'No matches\',
                    noChoicesText: \'There are no more options\',
                    itemSelectText: \'\',
                    classNames: { containerInner: \'choices__inner search-choice\' },
                });
                inst.containerOuter.element.classList.add(\'multi-finder-\' + key);
                choicesInstances[key] = inst;
            });

            // Selects single (only one selectable)
            form.querySelectorAll(\'select[data-search-single]\').forEach(sel => {
                const key = sel.dataset.singlefinder;
                if (choicesInstances[key]) return;
                const inst = new Choices(sel, {
                    shouldSort: false,
                    searchEnabled: true,
                    noResultsText: \'No matches\',
                    itemSelectText: \'\',
                    classNames: { containerInner: \'choices__inner search-choice\' },
                });
                inst.containerOuter.element.classList.add(\'searcher-single-\' + key);
                choicesInstances[key] = inst;
            });

            // Connect: When technology category changes, repaint technologies dropdown
            const selectCatTec = form.querySelector(\'select[data-searcher-single="categoriatec"]\');
            if (selectCatTec) {
                selectCatTec.addEventListener(\'change\', () => filterTechnologiesByCategory());
            }
        }

        // Read the',
  'originales y construye una estructura [{label, choices: [{value, label, customProperties}]}]
        function construirCatalogoTecnologias(sel) {
            const grupos = [];
            sel.querySelectorAll(\'optgroup\').forEach(og => {
                const label = og.getAttribute(\'label\') || \'Otras\';
                const choices = Array.from(og.querySelectorAll(\'option\')).map(op => ({
                    value: op.value,
                    label: op.textContent,
                    customProperties: { categoria: label },
                }));
                grupos.push({ label, id: label, choices });
            });
            return grupos;
        }

        // Repuebla el dropdown de tecnologías mostrando solo las que pertenecen a la categoría seleccionada.
        // Conserva las tecnologías ya seleccionadas aunque su categoría se haya quitado del filtro.
        function filtrarTecnologiasPorCategoria() {
            const instTec = choicesInstances[\'tecnologias\'];
            const instCat = choicesInstances[\'categoriatec\'];
            if (!instTec || !instCat || !catalogoTecnologias) return;

            const catSeleccionada  = instCat.getValue(true) || \'\';
            const tecSeleccionadas = instTec.getValue(true) || [];

            // Filtrar grupos: si no hay categoría → mostrar todos
            const gruposFiltrados = (!catSeleccionada)
                ? catalogoTecnologias
                : catalogoTecnologias.filter(g => g.label === catSeleccionada);

            // Marcar como ya seleccionadas las que el usuario tenía
            const setSeleccionadas = new Set(tecSeleccionadas);
            const gruposParaChoices = gruposFiltrados.map(g => ({
                label: g.label,
                id: g.label,
                disabled: false,
                choices: g.choices.map(c => ({
                    ...c,
                    selected: setSeleccionadas.has(c.value),
                })),
            }));

            // Si una tec seleccionada quedó fuera del filtro, la añadimos en un grupo aparte para no perderla
            const todasIds = new Set();
            gruposParaChoices.forEach(g => g.choices.forEach(c => todasIds.add(c.value)));
            const huerfanas = tecSeleccionadas.filter(v => !todasIds.has(v));
            if (huerfanas.length) {
                gruposParaChoices.push({
                    label: \'Seleccionadas (fuera del filtro)\',
                    id: \'__huerfanas__\',
                    choices: huerfanas.map(v => ({ value: v, label: v, selected: true })),
                });
            }

            instTec.clearChoices();
            instTec.setChoices(gruposParaChoices, \'value\', \'label\', true);
        }

        // Choices.js se carga con defer; esperamos hasta que esté disponible.
        if (typeof Choices !== \'undefined\') {
            inicializarChoices();
        } else {
            const intento = setInterval(() => {
                if (typeof Choices !== \'undefined\') {
                    clearInterval(intento);
                    inicializarChoices();
                }
            }, 50);
        }

        const ENDPOINT = @json(route(\'portafolios.buscar\'));

        function obtenerFiltros() {
            const fd = new FormData(form);
            const filtros = {
                q: (fd.get(\'q\') || \'\').trim(),
                anios_min: parseInt(fd.get(\'anios_min\') || \'0\', 10) || 0,
                ubicacion: (fd.get(\'ubicacion\') || \'\').trim(),
                con_proyectos: fd.get(\'con_proyectos\') ? 1 : 0,
                tecnologias:   fd.getAll(\'tecnologias[]\'),
                categoria_tec: (fd.get(\'categoria_tec\') || \'\').trim(),
                categorias:    fd.getAll(\'categorias[]\').map(v => parseInt(v, 10)).filter(Boolean),
            };
            return filtros;
        }

        function construirQueryString(filtros, offsetVal, limitVal) {
            const params = new URLSearchParams();
            if (filtros.q) params.append(\'q\', filtros.q);
            if (filtros.anios_min) params.append(\'anios_min\', filtros.anios_min);
            if (filtros.ubicacion) params.append(\'ubicacion\', filtros.ubicacion);
            if (filtros.con_proyectos) params.append(\'con_proyectos\', 1);
            filtros.tecnologias.forEach(t => params.append(\'tecnologias[]\', t));
            if (filtros.categoria_tec) params.append(\'categoria_tec\', filtros.categoria_tec);
            filtros.categorias.forEach(c => params.append(\'categorias[]\', c));
            params.append(\'offset\', offsetVal);
            params.append(\'limit\',  limitVal);
            return params.toString();
        }

        function escapeHtmlBP(s) {
            const d = document.createElement(\'div\');
            d.textContent = s ?? \'\';
            return d.innerHTML;
        }

        function renderizarTarjeta(p) {
            const avatar = p.foto
                ? `' => 'originals and build a structure [{label, choices: [{value, label, customProperties}]}]
        function buildTechnologyCatalog(sel) {
            const groups = [];
            sel.querySelectorAll(\'optgroup\').forEach(og => {
                const label = og.getAttribute(\'label\') || \'Others\';
                const choices = Array.from(og.querySelectorAll(\'option\')).map(op => ({
                    value: op.value,
                    label: op.textContent,
                    customProperties: { category: label },
                }));
                groups.push({ label, id: label, choices });
            });
            return groups;
        }

        // Repopulates the technology dropdown showing only those that belong to the selected category.
        // Retains already selected technologies even if their category has been removed from the filter.
        function filterTechnologiesByCategory() {
            const instTec = choicesInstances[\'technologies\'];
            const instCat = choicesInstances[\'categoriatec\'];
            if (!instTec || !instCat || !catalogoTecnologias) return;

            const catSelected = instCat.getValue(true) || \'\';
            const SelectedTec = instTec.getValue(true) || [];

            // Filter groups: if there is no category → show all
            constFilteredGroups = (!catSelected)
                ? catalogTechnologies
                : catalogoTecnologias.filter(g => g.label === catSelected);

            // Mark as already selected those that the user had
            const setSelected = new Set(setSelected);
            const groupsForChoices = Filteredgroups.map(g => ({
                label: g.label,
                id: g.label,
                disable: false,
                choices: g.choices.map(c => ({
                    ...c,
                    selected: setSelected.has(c.value),
                })),
            }));

            // If a selected technique was left out of the filter, we add it in a separate group so as not to lose it
            const allIds = new Set();
            groupsForChoices.forEach(g => g.choices.forEach(c => allIds.add(c.value)));
            const orphans = selectedSec.filter(v => !allIds.has(v));
            if (orphans.length) {
                groupsForChoices.push({
                    label: \'Selected (outside filter)\',
                    id: \'__orphans__\',
                    choices: orfanas.map(v => ({ value: v, label: v, selected: true })),
                });
            }

            instTec.clearChoices();
            instTec.setChoices(groupsForChoices, \'value\', \'label\', true);
        }

        // Choices.js is loaded with defer; We wait until it is available.
        if (typeofChoices !== \'undefined\') {
            initializeChoices();
        } else {
            const try = setInterval(() => {
                if (typeofChoices !== \'undefined\') {
                    clearInterval(attempt);
                    initializeChoices();
                }
            }, 50);
        }

        const ENDPOINT = @json(route(\'portfolio.search\'));

        function getFilters() {
            const fd = new FormData(form);
            const filters = {
                q: (fd.get(\'q\') || \'\').trim(),
                anios_min: parseInt(fd.get(\'anios_min\') || \'0\', 10) || 0.
                location: (fd.get(\'location\') || \'\').trim(),
                with_projects: fd.get(\'with_projects\') ? 1:0,
                technologies: fd.getAll(\'technologies[]\'),
                tech_category: (fd.get(\'tech_category\') || \'\').trim(),
                categories: fd.getAll(\'categories[]\').map(v => parseInt(v, 10)).filter(Boolean),
            };
            return filters;
        }

        function buildQueryString(filters, offsetVal, limitVal) {
            const params = new URLSearchParams();
            if (filters.q) params.append(\'q\', filters.q);
            if (filters.anios_min) params.append(\'anios_min\', filters.anios_min);
            if (filters.location) params.append(\'location\', filters.location);
            if (filters.with_projects) params.append(\'with_projects\', 1);
            filters.technologies.forEach(t => params.append(\'technologies[]\', t));
            if (filters.tech_category) params.append(\'tech_category\', filters.tech_category);
            filters.categories.forEach(c => params.append(\'categories[]\', c));
            params.append(\'offset\', offsetVal);
            params.append(\'limit\', limitVal);
            return params.toString();
        }

        function escapeHtmlBP(s) {
            const d = document.createElement(\'div\');
            d.textContent = s ?? \'\';
            return d.innerHTML;
        }

        function renderCard(p) {
            const avatar = p.photo
                ? `',
  '${escapeHtmlBP(p.iniciales)}' => '${escapeHtmlBP(p.initials)}',
  '`;

            const tagsHtml = (p.tags || []).map(t =>
                `' => '`;

            const tagsHtml = (p.tags || []).map(t =>
                `',
  '${escapeHtmlBP(t)}' => '${escapeHtmlBP(t)}',
  '`
            ).join(\'\');
            const tagsExtra = (p.tags_extra > 0)
                ? `' => '`
            ).join(\'\');
            const tagsExtra = (p.tags_extra > 0)
                ? `',
  '+${p.tags_extra}' => '+${p.tags_extra}',
  '`
                : \'\';

            const article = document.createElement(\'article\');
            article.className = \'bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all-soft overflow-hidden flex flex-col\';
            article.innerHTML = `' => '`
                : \'\';

            const article = document.createElement(\'article\');
            article.className = \'bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all-soft overflow-hidden flex flex-col\';
            article.innerHTML = `',
  '${avatar}' => '${avatar}',
  '${escapeHtmlBP(p.nombre)}' => '${escapeHtmlBP(p.name)}',
  '${escapeHtmlBP(p.rol)}' => '${escapeHtmlBP(p.rol)}',
  '${escapeHtmlBP(p.descripcion)}' => '${escapeHtmlBP(p.description)}',
  '${tagsHtml}${tagsExtra}' => '${tagsHtml}${tagsExtra}',
  '${escapeHtmlBP(p.anios)}' => '${escapeHtmlBP(p.years)}',
  '${escapeHtmlBP(p.proyectos)}' => '${escapeHtmlBP(p.projects)}',
  '${escapeHtmlBP(p.ubicacion)}' => '${escapeHtmlBP(p.location)}',
  'Ver portafolio' => 'View portfolio',
  '`;

            const btnVer = article.querySelector(\'button\');
            btnVer.dataset.portafolio = JSON.stringify(p);
            btnVer.addEventListener(\'click\', () => {
                if (typeof abrirModalPortafolio === \'function\') abrirModalPortafolio(btnVer);
            });

            return article;
        }

        window.buscarPortafolios = async function (reset) {
            if (cargando) return;
            cargando = true;

            if (reset) {
                offset = 0;
                contenedor.innerHTML = \'\';
                filtrosActuales = obtenerFiltros();
            }

            btnCargarMas.classList.add(\'hidden\');
            vacio.classList.add(\'hidden\');
            if (reset) {
                skeleton.classList.remove(\'hidden\');
                estado.textContent = \'Buscando portafolios...\';
            } else {
                estado.textContent = \'Cargando más...\';
            }

            try {
                const qs = construirQueryString(filtrosActuales, offset, LIMITE);
                const res = await fetch(`${ENDPOINT}?${qs}`, { headers: { \'Accept\': \'application/json\' } });
                if (!res.ok) throw new Error(\'Error HTTP \' + res.status);
                const data = await res.json();

                total = data.total ?? 0;
                (data.items || []).forEach(p => contenedor.appendChild(renderizarTarjeta(p)));
                offset += (data.items || []).length;

                if (total === 0) {
                    estado.textContent = \'\';
                    vacio.classList.remove(\'hidden\');
                } else {
                    estado.textContent = `Mostrando ${contenedor.children.length} de ${total} portafolio${total === 1 ? \'\' : \'s\'}`;
                }

                if (data.hay_mas) btnCargarMas.classList.remove(\'hidden\');
            } catch (e) {
                estado.textContent = \'No se pudo cargar los portafolios. Intenta de nuevo.\';
            } finally {
                skeleton.classList.add(\'hidden\');
                cargando = false;
            }
        };

        window.limpiarFiltrosPortafolios = function () {
            // No usamos form.reset() porque Choices.js gestiona sus' => '`;

            const btnView = article.querySelector(\'button\');
            btnView.dataset.portfolio = JSON.stringify(p);
            btnVer.addEventListener(\'click\', () => {
                if (typeof openModalPortfolio === \'function\') openModalPortfolio(btnView);
            });

            return article;
        }

        window.searchPortfolios = async function (reset) {
            if (loading) return;
            loading = true;

            if (reset) {
                offset = 0;
                container.innerHTML = \'\';
                currentFilters = getFilters();
            }

            btnLoadMore.classList.add(\'hidden\');
            empty.classList.add(\'hidden\');
            if (reset) {
                skeleton.classList.remove(\'hidden\');
                status.textContent = \'Searching for portfolios...\';
            } else {
                status.textContent = \'Loading more...\';
            }

            try {
                const qs = constructQueryString(currentFilters, offset, LIMIT);
                const res = await fetch(`${ENDPOINT}?${qs}`, { headers: { \'Accept\': \'application/json\' } });
                if (!res.ok) throw new Error(\'HTTP Error \' + res.status);
                const data = await res.json();

                total = data.total ?? 0;
                (data.items || []).forEach(p => container.appendChild(renderCard(p)));
                offset += (data.items || []).length;

                if (total === 0) {
                    status.textContent = \'\';
                    empty.classList.remove(\'hidden\');
                } else {
                    status.textContent = `Showing ${container.children.length} from ${total} portfolio${total === 1 ? \'\': \'s\'}`;
                }

                if (data.there_are_more) btnLoadMore.classList.remove(\'hidden\');
            } catch (e) {
                status.textContent = \'Failed to load portfolios. Try again.\';
            } finally {
                skeleton.classList.add(\'hidden\');
                loading = false;
            }
        };

        window.clearPortfolioFilters = function () {
            // We don\'t use form.reset() because Choices.js manages its',
  'en un DOM aparte
            // y el reset deja los selects inconsistentes (sin opciones visibles).
            form.querySelectorAll(\'input\').forEach(i => {
                if (i.type === \'checkbox\' || i.type === \'radio\') i.checked = false;
                else i.value = \'\';
            });
            // Multis: quitar todas las pills
            [\'tecnologias\', \'categorias\'].forEach(k => {
                const c = choicesInstances[k];
                c && c.removeActiveItems && c.removeActiveItems();
            });
            // Single: volver al placeholder
            const single = choicesInstances[\'categoriatec\'];
            if (single) {
                single.setChoiceByValue(\'\');
            }
            // Restaurar el dropdown completo de tecnologías
            filtrarTecnologiasPorCategoria();
            buscarPortafolios(true);
        };

        // Carga inicial
        buscarPortafolios(true);
    })();' => 'in a separate DOM
            // and the reset leaves the selects inconsistent (no visible options).
            form.querySelectorAll(\'input\').forEach(i => {
                if (i.type === \'checkbox\' || i.type === \'radio\') i.checked = false;
                else i.value = \'\';
            });
            // Multis: remove all pills
            [\'technologies\', \'categories\'].forEach(k => {
                const c = choicesInstances[k];
                c && c.removeActiveItems && c.removeActiveItems();
            });
            // Single: return to placeholder
            const single = choicesInstances[\'categoriatec\'];
            if (single) {
                single.setChoiceByValue(\'\');
            }
            // Restore the full technology dropdown
            filterTechnologiesByCategory();
            searchPortfolios(true);
        };

        // Initial load
        searchPortfolios(true);
    })();',
  'Crea y comparte tu portafolio en pocos pasos' => 'Create and share your portfolio in just a few steps',
  'La plataforma esta diseñada para que puedas construir tu portafolio digital
                de forma sencilla, ordenada y profesional.' => 'The platform is designed so you can build your digital portfolio
                in a simple, orderly and professional way.',
  'Crea tu perfil' => 'Create your profile',
  'Registra tu informacion personal y profesional para construir
                        una base solida de tu portafolio digital.' => 'Register your personal and professional information to build
                        a solid foundation for your digital portfolio.',
  'Agrega tus proyectos' => 'Add your projects',
  'Incorpora tus trabajos, tecnologias, descripciones y logros
                        para mostrar mejor tu experiencia y capacidades.' => 'Incorporate your jobs, technologies, descriptions and achievements
                        to better show your experience and capabilities.',
  'Comparte tu portafolio' => 'Share your portfolio',
  'Publica tu perfil y permite que otras personas puedan ver
                        tu trabajo de una manera clara, accesible y profesional.' => 'Publish your profile and allow other people to see
                        your work in a clear, accessible and professional way.',
  'Una plataforma para mostrar tu talento de forma profesional' => 'A platform to show your talent professionally',
  'Portafolio Digital es una plataforma pensada para facilitar la creación de portafolios digitales,
                permitiendo a estudiantes y desarrolladores organizar, mostrar y compartir sus proyectos
                de forma clara, profesional y accesible.' => 'Digital Portfolio is a platform designed to facilitate the creation of digital portfolios,
                allowing students and developers to organize, display and share their projects
                in a clear, professional and accessible manner.',
  'Organiza tu perfil' => 'Organize your profile',
  'Centraliza tu información, experiencia y habilidades en un solo espacio para construir
                    una presentación más clara y ordenada.' => 'Centralize your information, experience and skills in a single space to build
                    a clearer and more organized presentation.',
  'Muestra tus proyectos' => 'Show your projects',
  'Presenta tus trabajos de manera visual y estructurada para destacar mejor tu perfil
                    y facilitar que otros comprendan lo que sabes hacer.' => 'Present your work in a visual and structured way to better highlight your profile
                    and make it easier for others to understand what you know how to do.',
  'Haz visible tu trabajo en un entorno profesional y permite que otras personas
                    conozcan tus capacidades, proyectos y logros.' => 'Make your work visible in a professional environment and allow other people
                    know your capabilities, projects and achievements.',
  'Portafolio Digital' => 'Digital Portfolio',
  'html {
            scroll-behavior: smooth;
        }

        .transition-all-soft {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        .hero-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hero-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12);
        }

        /* Choices.js: armonizar con Tailwind del buscador */
        .choices { margin-bottom: 0; font-size: 0.875rem; }
        .choices__inner.buscador-choice {
            min-height: 38px;
            padding: 4px 6px;
            border-radius: 0.5rem;
            border-color: #d1d5db;
            background: #fff;
        }
        .choices[data-type*="select-multiple"] .choices__button { margin-left: 6px; }
        .choices__list--multiple .choices__item {
            border-radius: 9999px;
            padding: 2px 10px;
            font-weight: 500;
        }
        /* Pills de TECNOLOGÍAS — azul oscuro corporativo */
        .buscador-multi-tecnologias .choices__list--multiple .choices__item {
            background-color: #1e3a5f;
            border-color: #1e3a5f;
        }
        .buscador-multi-tecnologias .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #1e3a5f;
            color: #fff;
        }
        /* Pills de CATEGORÍAS — rojo coral del sistema */
        .buscador-multi-categorias .choices__list--multiple .choices__item {
            background-color: #e11d48;
            border-color: #e11d48;
        }
        .buscador-multi-categorias .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #e11d48;
            color: #fff;
        }
        /* Single de CATEGORÍA DE TECNOLOGÍA — verde esmeralda en hover/highlight */
        .buscador-single-categoriatec .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #10b981;
            color: #fff;
        }
        .buscador-single-categoriatec.is-focused .choices__inner.buscador-choice {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
        }
        .choices.is-focused .choices__inner.buscador-choice {
            border-color: #1e3a5f;
            box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.15);
        }
        /* Encabezados de grupo (optgroup) dentro del dropdown */
        .choices__list--dropdown .choices__group {
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }
        .choices__list--dropdown .choices__group .choices__heading {
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.04em;
            color: #6b7280;
            font-weight: 700;
            padding: 6px 10px;
            border: none;
        }
        .choices__list--dropdown .choices__item--choice {
            padding-left: 18px;
        }' => 'html {
            scroll-behavior: smooth;
        }

        .transition-all-soft {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        .hero-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hero-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12);
        }

        /* Choices.js: armonizar con Tailwind del buscador */
        .choices { margin-bottom: 0; font-size: 0.875rem; }
        .choices__inner.buscador-choice {
            min-height: 38px;
            padding: 4px 6px;
            border-radius: 0.5rem;
            border-color: #d1d5db;
            background: #fff;
        }
        .choices[data-type*="select-multiple"] .choices__button { margin-left: 6px; }
        .choices__list--multiple .choices__item {
            border-radius: 9999px;
            padding: 2px 10px;
            font-weight: 500;
        }
        /* Pills de TECNOLOGÍAS — azul oscuro corporativo */
        .buscador-multi-tecnologias .choices__list--multiple .choices__item {
            background-color: #1e3a5f;
            border-color: #1e3a5f;
        }
        .buscador-multi-tecnologias .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #1e3a5f;
            color: #fff;
        }
        /* Pills de CATEGORÍAS — rojo coral del sistema */
        .buscador-multi-categorias .choices__list--multiple .choices__item {
            background-color: #e11d48;
            border-color: #e11d48;
        }
        .buscador-multi-categorias .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #e11d48;
            color: #fff;
        }
        /* Single de CATEGORÍA DE TECNOLOGÍA — verde esmeralda en hover/highlight */
        .buscador-single-categoriatec .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #10b981;
            color: #fff;
        }
        .buscador-single-categoriatec.is-focused .choices__inner.buscador-choice {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
        }
        .choices.is-focused .choices__inner.buscador-choice {
            border-color: #1e3a5f;
            box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.15);
        }
        /* Encabezados de grupo (optgroup) dentro del dropdown */
        .choices__list--dropdown .choices__group {
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }
        .choices__list--dropdown .choices__group .choices__heading {
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.04em;
            color: #6b7280;
            font-weight: 700;
            padding: 6px 10px;
            border: none;
        }
        .choices__list--dropdown .choices__item--choice {
            padding-left: 18px;
        }',
  'Una plataforma pensada para que estudiantes y desarrolladores puedan
                    crear, organizar y compartir sus proyectos en un espacio profesional,
                    claro y accesible.' => 'A platform designed so that students and developers can
                    create, organize and share your projects in a professional space,
                    clear and accessible.',
  'Ir a mi portafolio' => 'Go to my portfolio',
  'Crea tu portafolio' => 'Create your portfolio',
  'Explorar proyectos' => 'Explore projects',
  'Proyectos Entregados' => 'Projects Delivered',
  '100%' => '100%',
  'Satisfaccion' => 'Satisfaction',
  'Crea tu presencia profesional' => 'Create your professional presence',
  'Proyectos, habilidades y perfil en un solo lugar' => 'Projects, skills and profile in one place',
  'Contacto' => 'Contact',
  'Email: {{ $configSitio?->email_contacto ?? \'contacto@quantumdev.dev\' }}' => 'Email: {{ $configSite?->contact_email ?? \'contact@quantumdev.dev\' }}',
  'Tel: {{ $configSitio?->telefono ?? \'+591 700 123 456\' }}' => 'Tel: {{ $configSitio?->telephone?? \'+591 700 123 456\' }}',
  '© 2026 Portafolio Digital. Todos los derechos reservados.' => '© 2026 Digital Portfolio. All rights reserved.',
  'Portfolio Digital - @yield(\'title\', \'Admin Panel\')' => 'Portfolio Digital - @yield(\'title\', \'Admin Panel\')',
  'html {
            scroll-behavior: smooth;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .transition-all-soft {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .sidebar-item:hover {
            transform: translateX(5px);
            background: rgba(0,0,0,0.05);
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        html, body {
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .main-container {
            min-height: calc(100vh - 4rem);
        }' => 'html {
            scroll-behavior: smooth;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .transition-all-soft {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.04);
        }

        .sidebar-item:hover {
            transform: translateX(5px);
            background: rgba(0,0,0,0.05);
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        html, body {
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .main-container {
            min-height: calc(100vh - 4rem);
        }',
  'Ir a la home page' => 'Go to home page',
  'Cerrar sesión' => 'Sign out',
  'Menu' => 'Menu',
  'routeIs(\'admin.dashboard\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.dashboard\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">',
  'routeIs(\'admin.dashboard\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.dashboard\') ? \'text-white\' : \'text-gray-500\' }}">',
  'routeIs(\'admin.usuarios*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.usuarios*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">',
  'routeIs(\'admin.usuarios*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.usuarios*\') ? \'text-white\' : \'text-gray-500\' }}">',
  'Gestionar usuarios' => 'Manage users',
  'routeIs(\'admin.proyectos*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.proyectos*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">',
  'routeIs(\'admin.proyectos*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.proyectos*\') ? \'text-white\' : \'text-gray-500\' }}">',
  'routeIs(\'admin.habilidades*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.skills*\') ? \'bg-[#1e3a5f] text-white\': \'\'}}">',
  'routeIs(\'admin.habilidades*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.habilidades*\') ? \'text-white\' : \'text-gray-500\' }}">',
  'routeIs(\'admin.tecnologias*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.tecnologias*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">',
  'routeIs(\'admin.tecnologias*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.tecnologias*\') ? \'text-white\' : \'text-gray-500\' }}">',
  'routeIs(\'admin.perfiles*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.perfiles*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">',
  'routeIs(\'admin.perfiles*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.perfiles*\') ? \'text-white\' : \'text-gray-500\' }}">',
  'Moderar portafolios' => 'Moderate portfolios',
  'routeIs(\'admin.backup*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.backup*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">',
  'routeIs(\'admin.backup*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.backup*\') ? \'text-white\' : \'text-gray-500\' }}">',
  'Respaldos' => 'Backups',
  'routeIs(\'admin.logs*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.logs*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">',
  'routeIs(\'admin.logs*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.logs*\') ? \'text-white\' : \'text-gray-500\' }}">',
  'Bitácora' => 'Bitácora',
  'routeIs(\'admin.papelera*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.papelera*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">',
  'routeIs(\'admin.papelera*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.papelera*\') ? \'text-white\' : \'text-gray-500\' }}">',
  'routeIs(\'admin.notifications*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.notifications*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">',
  'routeIs(\'admin.notifications*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.notifications*\') ? \'text-white\' : \'text-gray-500\' }}">',
  'routeIs(\'admin.configuracion*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.configuracion*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">',
  'routeIs(\'admin.configuracion*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.configuracion*\') ? \'text-white\' : \'text-gray-500\' }}">',
  'SUBMENU' => 'SUBMENU',
  '// Dropdowns
        document.querySelectorAll(\'.dropdown\').forEach(dropdown => {
            const button = dropdown.querySelector(\'button\');
            const menu = dropdown.querySelector(\'.dropdown-menu\');

            if (button && menu) {
                button.addEventListener(\'click\', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll(\'.dropdown-menu\').forEach(m => {
                        if (m !== menu) m.classList.add(\'hidden\');
                    });
                    menu.classList.toggle(\'hidden\');
                });
            }
        });

        document.addEventListener(\'click\', (e) => {
            if (!e.target.closest(\'.dropdown\')) {
                document.querySelectorAll(\'.dropdown-menu\').forEach(menu => {
                    menu.classList.add(\'hidden\');
                });
            }
        });

        // Sidebar móvil
        const sidebarIzq = document.getElementById(\'sidebar-izquierdo\');
        const sidebarOverlay = document.getElementById(\'sidebar-overlay\');
        const btnMenu = document.getElementById(\'btn-menu-mobile\');

        function cerrarSidebars() {
            if (window.innerWidth' => '// Dropdowns
        document.querySelectorAll(\'.dropdown\').forEach(dropdown => {
            const button = dropdown.querySelector(\'button\');
            const menu = dropdown.querySelector(\'.dropdown-menu\');

            if (button && menu) {
                button.addEventListener(\'click\', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll(\'.dropdown-menu\').forEach(m => {
                        if (m !== menu) m.classList.add(\'hidden\');
                    });
                    menu.classList.toggle(\'hidden\');
                });
            }
        });

        document.addEventListener(\'click\', (e) => {
            if (!e.target.closest(\'.dropdown\')) {
                document.querySelectorAll(\'.dropdown-menu\').forEach(menu => {
                    menu.classList.add(\'hidden\');
                });
            }
        });

        // Sidebar móvil
        const sidebarIzq = document.getElementById(\'sidebar-izquierdo\');
        const sidebarOverlay = document.getElementById(\'sidebar-overlay\');
        const btnMenu = document.getElementById(\'btn-menu-mobile\');

        function cerrarSidebars() {
            if (window.innerWidth',
  '{
                sidebarIzq.classList.remove(\'-translate-x-full\');
                if (sidebarOverlay) sidebarOverlay.classList.remove(\'hidden\');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener(\'click\', cerrarSidebars);
        }

        window.addEventListener(\'resize\', () => {
            if (window.innerWidth >= 1024) sidebarIzq.classList.remove(\'-translate-x-full\');
            if (window.innerWidth >= 1024 && sidebarOverlay) sidebarOverlay.classList.add(\'hidden\');
        });

        // Funcionalidad para usuarios normales (secciones)
        @if(!$esAdmin)
        function resaltarLink(seccionId) {
            document.querySelectorAll(\'.seccion-link\').forEach(link => {
                link.classList.remove(\'bg-[#1e3a5f]\', \'text-white\');
                link.classList.add(\'text-gray-700\');
                const icono = link.querySelector(\'i\');
                if (icono) {
                    icono.classList.remove(\'text-white\');
                    icono.classList.add(\'text-gray-500\');
                }
            });

            const linkActivo = document.querySelector(`.seccion-link[data-seccion="${seccionId}"]`);
            if (linkActivo) {
                linkActivo.classList.add(\'bg-[#1e3a5f]\', \'text-white\');
                const icono = linkActivo.querySelector(\'i\');
                if (icono) {
                    icono.classList.remove(\'text-gray-500\');
                    icono.classList.add(\'text-white\');
                }
            }
        }

        function cambiarSeccion(seccionId) {
            const seccionActiva = document.getElementById(\'seccion-\' + seccionId);
            if (seccionActiva) {
                seccionActiva.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
            }
            resaltarLink(seccionId);
            cerrarSidebars();
        }

        document.querySelectorAll(\'.seccion-link\').forEach(link => {
            link.addEventListener(\'click\', (e) => {
                e.preventDefault();
                const seccion = link.getAttribute(\'data-seccion\');
                if (seccion) {
                    cambiarSeccion(seccion);
                }
            });
        });

        // Scroll-spy
        const seccionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id.replace(\'seccion-\', \'\');
                    resaltarLink(id);
                }
            });
        }, {
            rootMargin: \'-30% 0px -60% 0px\',
            threshold: 0,
        });

        document.querySelectorAll(\'.seccion-contenido\').forEach(s => seccionObserver.observe(s));

        const seccionInicial = new URLSearchParams(window.location.search).get(\'seccion\') ?? \'resumen\';
        const elInicial = document.getElementById(\'seccion-\' + seccionInicial);
        if (elInicial && seccionInicial !== \'resumen\') {
            elInicial.scrollIntoView({ behavior: \'auto\', block: \'start\' });
        }
        resaltarLink(seccionInicial);
        if (window.location.search) {
            history.replaceState(null, \'\', window.location.pathname);
        }
        @endif' => '{
                sidebarIzq.classList.remove(\'-translate-x-full\');
                if (sidebarOverlay) sidebarOverlay.classList.remove(\'hidden\');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener(\'click\', cerrarSidebars);
        }

        window.addEventListener(\'resize\', () => {
            if (window.innerWidth >= 1024) sidebarIzq.classList.remove(\'-translate-x-full\');
            if (window.innerWidth >= 1024 && sidebarOverlay) sidebarOverlay.classList.add(\'hidden\');
        });

        // Funcionalidad para usuarios normales (secciones)
        @if(!$esAdmin)
        function resaltarLink(seccionId) {
            document.querySelectorAll(\'.seccion-link\').forEach(link => {
                link.classList.remove(\'bg-[#1e3a5f]\', \'text-white\');
                link.classList.add(\'text-gray-700\');
                const icono = link.querySelector(\'i\');
                if (icono) {
                    icono.classList.remove(\'text-white\');
                    icono.classList.add(\'text-gray-500\');
                }
            });

            const linkActivo = document.querySelector(`.seccion-link[data-seccion="${seccionId}"]`);
            if (linkActivo) {
                linkActivo.classList.add(\'bg-[#1e3a5f]\', \'text-white\');
                const icono = linkActivo.querySelector(\'i\');
                if (icono) {
                    icono.classList.remove(\'text-gray-500\');
                    icono.classList.add(\'text-white\');
                }
            }
        }

        function cambiarSeccion(seccionId) {
            const seccionActiva = document.getElementById(\'seccion-\' + seccionId);
            if (seccionActiva) {
                seccionActiva.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
            }
            resaltarLink(seccionId);
            cerrarSidebars();
        }

        document.querySelectorAll(\'.seccion-link\').forEach(link => {
            link.addEventListener(\'click\', (e) => {
                e.preventDefault();
                const seccion = link.getAttribute(\'data-seccion\');
                if (seccion) {
                    cambiarSeccion(seccion);
                }
            });
        });

        // Scroll-spy
        const seccionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id.replace(\'seccion-\', \'\');
                    resaltarLink(id);
                }
            });
        }, {
            rootMargin: \'-30% 0px -60% 0px\',
            threshold: 0,
        });

        document.querySelectorAll(\'.seccion-contenido\').forEach(s => seccionObserver.observe(s));

        const seccionInicial = new URLSearchParams(window.location.search).get(\'seccion\') ?? \'resumen\';
        const elInicial = document.getElementById(\'seccion-\' + seccionInicial);
        if (elInicial && seccionInicial !== \'resumen\') {
            elInicial.scrollIntoView({ behavior: \'auto\', block: \'start\' });
        }
        resaltarLink(seccionInicial);
        if (window.location.search) {
            history.replaceState(null, \'\', window.location.pathname);
        }
        @endif',
  'function marcarLeida(id, url) {
        fetch(\'{{ route("notifications.marcar-leida") }}\', {
            method: \'POST\',
            headers: {
                \'X-CSRF-TOKEN\': \'{{ csrf_token() }}\',
                \'Content-Type\': \'application/json\'
            },
            body: JSON.stringify({ id: id })
        }).then(() => {
            if (url) {
                window.location.href = url;
            } else {
                location.reload();
            }
        });
    }' => 'function marcarLeida(id, url) {
        fetch(\'{{ route("notifications.marcar-leida") }}\', {
            method: \'POST\',
            headers: {
                \'X-CSRF-TOKEN\': \'{{ csrf_token() }}\',
                \'Content-Type\': \'application/json\'
            },
            body: JSON.stringify({ id: id })
        }).then(() => {
            if (url) {
                window.location.href = url;
            } else {
                location.reload();
            }
        });
    }',
  '// Función para subir foto de perfil 
    function subirFotoPerfil(input) {
        if (!input.files || !input.files[0]) return;
        
        const file = input.files[0];
        
        // Validar tipo de archivo
        if (!file.type.startsWith(\'image/\')) {
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'Por favor, selecciona una imagen válida (JPG, PNG, GIF)\',
                confirmButtonColor: \'#1e3a5f\'
            });
            input.value = \'\';
            return;
        }
        
        // Validar tamaño (máximo 2MB)
        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'La imagen no debe superar los 2MB\',
                confirmButtonColor: \'#1e3a5f\'
            });
            input.value = \'\';
            return;
        }
        
        // Mostrar preview temporal
        const reader = new FileReader();
        reader.onload = function(e) {
            const fotoContainer = document.getElementById(\'perfil-foto-container\');
            if (fotoContainer) {
                fotoContainer.innerHTML = `' => '// Function to upload profile photo 
    function uploadProfilePhoto(input) {
        if (!input.files || !input.files[0]) return;
        
        const file = input.files[0];
        
        // Validate file type
        if (!file.type.startsWith(\'image/\')) {
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'Please select a valid image (JPG, PNG, GIF)\',
                confirmButtonColor: \'#1e3a5f\'
            });
            input.value = \'\';
            return;
        }
        
        // Validate size (maximum 2MB)
        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'The image must not exceed 2MB\',
                confirmButtonColor: \'#1e3a5f\'
            });
            input.value = \'\';
            return;
        }
        
        // Show temporary preview
        const reader = new FileReader();
        reader.onload = function(e) {
            const photoContainer = document.getElementById(\'profile-photo-container\');
            if (photoContainer) {
                photoContainer.innerHTML = `',
  '`;
            }
        };
        reader.readAsDataURL(file);
        
        // Mostrar barra de progreso
        const progressContainer = document.getElementById(\'progress-foto-container\');
        const progressBar = document.getElementById(\'progress-foto-bar\');
        if (progressContainer) {
            progressContainer.classList.remove(\'hidden\');
        }
        if (progressBar) {
            progressBar.style.width = \'0%\';
        }
        
        // Simular progreso
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            if (progress' => '`;
            }
        };
        reader.readAsDataURL(file);
        
        // Mostrar barra de progreso
        const progressContainer = document.getElementById(\'progress-foto-container\');
        const progressBar = document.getElementById(\'progress-foto-bar\');
        if (progressContainer) {
            progressContainer.classList.remove(\'hidden\');
        }
        if (progressBar) {
            progressBar.style.width = \'0%\';
        }
        
        // Simular progreso
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            if (progress',
  'response.json())
        .then(data => {
            clearInterval(interval);
            if (progressBar) {
                progressBar.style.width = \'100%\';
            }
            
            if (data.success) {
                // Actualizar con la foto real del servidor
                const fotoContainer = document.getElementById(\'perfil-foto-container\');
                if (fotoContainer) {
                    fotoContainer.innerHTML = `' => 'response.json())
        .then(data => {
            clearInterval(interval);
            if (progressBar) {
                progressBar.style.width = \'100%\';
            }
            
            if (data.success) {
                // Actualizar con la foto real del servidor
                const fotoContainer = document.getElementById(\'perfil-foto-container\');
                if (fotoContainer) {
                    fotoContainer.innerHTML = `',
  '`;
                }
                setTimeout(() => {
                    if (progressContainer) {
                        progressContainer.classList.add(\'hidden\');
                    }
                }, 1000);
                
                // También actualizar en el modal de edición si existe
                const modalFoto = document.querySelector(\'#modal-editar-perfil #foto-perfil-actual\');
                if (modalFoto) {
                    modalFoto.innerHTML = `' => '`;
                }
                setTimeout(() => {
                    if (progressContainer) {
                        progressContainer.classList.add(\'hidden\');
                    }
                }, 1000);
                
                // Also update in the edit modal if it exists
                const modalPhoto = document.querySelector(\'#modal-edit-profile #current-profile-photo\');
                if (photomodal) {
                    modalPhoto.innerHTML = `',
  '`;
                }
                
                // Actualizar foto en el header
                const headerFoto = document.querySelector(\'header .dropdown button img\');
                if (headerFoto) {
                    headerFoto.src = data.foto_url + \'?t=\' + Date.now();
                } else {
                    const headerSpan = document.querySelector(\'header .dropdown button span.w-10.h-10\');
                    if (headerSpan && headerSpan.classList.contains(\'bg-gradient-to-br\')) {
                        headerSpan.outerHTML = `' => '`;
                }
                
                // Actualizar foto en el header
                const headerFoto = document.querySelector(\'header .dropdown button img\');
                if (headerFoto) {
                    headerFoto.src = data.foto_url + \'?t=\' + Date.now();
                } else {
                    const headerSpan = document.querySelector(\'header .dropdown button span.w-10.h-10\');
                    if (headerSpan && headerSpan.classList.contains(\'bg-gradient-to-br\')) {
                        headerSpan.outerHTML = `',
  '`;
                    }
                }
                
                Swal.fire({
                    icon: \'success\',
                    title: \'¡Foto actualizada!\',
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                throw new Error(data.message || \'Error al subir la foto\');
            }
        })
        .catch(error => {
            console.error(\'Error:\', error);
            clearInterval(interval);
            if (progressContainer) {
                progressContainer.classList.add(\'hidden\');
            }
            
            // Recargar la foto original
            location.reload();
            
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'No se pudo subir la imagen. Intenta nuevamente.\',
                confirmButtonColor: \'#d33\'
            });
        });
    }' => '`;
                    }
                }
                
                Swal.fire({
                    icon: \'success\',
                    title: \'Updated photo!\',
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                throw new Error(data.message || \'Error uploading photo\');
            }
        })
        .catch(error => {
            console.error(\'Error:\', error);
            clearInterval(interval);
            if (progressContainer) {
                progressContainer.classList.add(\'hidden\');
            }
            
            // Reload the original photo
            location.reload();
            
            Swal.fire({
                icon: \'error\',
                title: \'Error\',
                text: \'The image could not be uploaded. Try again.\',
                confirmButtonColor: \'#d33\'
            });
        });
    }',
  'Portfolio Digital - Mis Notificaciones' => 'Digital Portfolio - My Notifications',
  'visibilidad ?? \'privado\';
    @endphp' => 'visibility?? \'private\';
    @endphp',
  'Mis Notificaciones' => 'My Notifications',
  'notificaciones no leídas
                                @else
                                    No tienes notificaciones pendientes
                                @endif' => 'unread notifications
                                @else
                                    You have no pending notifications
                                @endif',
  'Marcar todas como leídas' => 'Mark all as read',
  'tipo == \'info\') border-blue-500
                        @elseif($notif->tipo == \'success\') border-green-500
                        @elseif($notif->tipo == \'warning\') border-yellow-500
                        @else border-red-500 @endif
                        {{ !$notif->leido ? \'bg-blue-50\' : \'\' }}">' => 'tipo == \'info\') border-blue-500
                        @elseif($notif->tipo == \'success\') border-green-500
                        @elseif($notif->tipo == \'warning\') border-yellow-500
                        @else border-red-500 @endif
                        {{ !$notif->leido ? \'bg-blue-50\' : \'\' }}">',
  'Nueva' => 'Nueva',
  'id_notification) }}" method="POST">
                                            @csrf' => 'id_notification) }}" method="POST">
                                            @csrf',
  'Marcar como leída' => 'Mark as read',
  'url }}" class="ml-3 text-blue-500 hover:text-blue-700">' => 'url }}" class="ml-3 text-blue-500 hover:text-blue-700">',
  'No tienes notificaciones' => 'You don\'t have notifications',
  'Cuando recibas notificaciones aparecerán aquí' => 'When you receive notifications they will appear here',
  '{ ... },
            onCancel: () => { ... },
        });

     Uso declarativo (forms con confirmación):' => '{...},
            onCancel: () => { ... },
        });

     Declarative use (forms with confirmation):',
  '...' => '...',
  '--}}' => '--}}',
  '¿Estás seguro?' => 'You\'re sure?',
  'Esta acción no se puede deshacer.' => 'This action cannot be undone.',
  'Confirmar' => 'Confirm',
  '(function () {
    const modal = document.getElementById(\'gcfModal\');
    if (!modal) return;

    const presets = {
        danger:  { header: \'bg-red-500\',          iconBg: \'bg-red-50\',          iconColor: \'text-red-500\',          icon: \'fas fa-trash-alt\',           btn: \'bg-red-500 hover:bg-red-600\' },
        warning: { header: \'bg-yellow-500\',       iconBg: \'bg-yellow-50\',       iconColor: \'text-yellow-500\',       icon: \'fas fa-exclamation-triangle\',btn: \'bg-yellow-500 hover:bg-yellow-600\' },
        success: { header: \'bg-green-500\',        iconBg: \'bg-green-50\',        iconColor: \'text-green-500\',        icon: \'fas fa-check-circle\',        btn: \'bg-green-500 hover:bg-green-600\' },
        info:    { header: \'bg-blue-500\',         iconBg: \'bg-blue-50\',         iconColor: \'text-blue-500\',         icon: \'fas fa-info-circle\',         btn: \'bg-blue-500 hover:bg-blue-600\' },
        primary: { header: \'bg-[#1e3a5f]\',        iconBg: \'bg-[#1e3a5f]/10\',    iconColor: \'text-[#1e3a5f]\',        icon: \'fas fa-question-circle\',     btn: \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90\' },
    };

    // Extrae el color base de un btnClass tipo "bg-yellow-500 hover:bg-yellow-600"
    // o "bg-[#e11d48] hover:bg-[#e11d48]/80" → "bg-yellow-500" / "bg-[#e11d48]"
    function deriveHeader(btnClass) {
        if (!btnClass) return null;
        const m = btnClass.match(/bg-(?:\\[[^\\]]+\\]|[a-z]+-\\d+)/);
        return m ? m[0] : null;
    }

    window.confirmar = function (cfg) {
        cfg = cfg || {};
        const tipo = cfg.tipo || \'danger\';
        const base = presets[tipo] || presets.danger;

        const iconBg    = cfg.iconBg      || base.iconBg;
        const iconColor = cfg.iconColor   || base.iconColor;
        const icon      = cfg.icon        || base.icon;
        const btnClass  = cfg.btnClass    || base.btn;
        // Si no hay headerColor explícito, se infiere del btnClass
        const header    = cfg.headerColor || deriveHeader(btnClass) || base.header;

        document.getElementById(\'gcfHeader\').className   = \'h-1.5 w-full \' + header;
        document.getElementById(\'gcfIconWrap\').className = \'w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 \' + iconBg;
        document.getElementById(\'gcfIcon\').className     = \'text-2xl \' + icon + \' \' + iconColor;
        document.getElementById(\'gcfTitle\').textContent  = cfg.titulo  || \'¿Estás seguro?\';
        document.getElementById(\'gcfMessage\').textContent= cfg.mensaje || \'Esta acción no se puede deshacer.\';

        const btnConfirm = document.getElementById(\'gcfBtnConfirm\');
        btnConfirm.textContent = cfg.textoConfirmar || \'Confirmar\';
        btnConfirm.className   = \'flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition \' + btnClass;

        const btnCancel = document.getElementById(\'gcfBtnCancel\');
        btnCancel.textContent = cfg.textoCancelar || \'Cancelar\';
        btnCancel.style.display = cfg.soloConfirmar ? \'none\' : \'\';

        btnConfirm.onclick = function () {
            cerrarConfirmar();
            if (typeof cfg.onConfirm === \'function\') cfg.onConfirm();
            else if (typeof cfg.accion === \'function\') cfg.accion();
        };
        btnCancel.onclick = function () {
            cerrarConfirmar();
            if (typeof cfg.onCancel === \'function\') cfg.onCancel();
        };

        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
    };

    window.cerrarConfirmar = function () {
        modal.classList.add(\'hidden\');
        modal.classList.remove(\'flex\');
    };

    // Aliases retrocompatibles con código existente
    window.cerrarConfirmacion            = window.cerrarConfirmar;
    window.cerrarConfirmacionPerfil      = window.cerrarConfirmar;
    window.cerrarConfirmacionExperiencia = window.cerrarConfirmar;
    window.cerrarConfirmacionEducacion   = window.cerrarConfirmar;
    window.cerrarConfirmacionHabilidad   = window.cerrarConfirmar;

    // Cerrar al clic en backdrop
    modal.addEventListener(\'click\', function (e) {
        if (e.target === modal) cerrarConfirmar();
    });

    // Cerrar con Escape
    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\' && !modal.classList.contains(\'hidden\')) cerrarConfirmar();
    });

    // Auto-handler: formularios con atributo data-confirm
    document.addEventListener(\'submit\', function (e) {
        const form = e.target;
        if (!form.dataset.confirm) return;
        if (form.dataset.confirmed === \'1\') {
            form.removeAttribute(\'data-confirmed\');
            return;
        }
        e.preventDefault();
        confirmar({
            tipo: form.dataset.confirmType || \'danger\',
            titulo: form.dataset.confirmTitle || \'¿Confirmar eliminación?\',
            mensaje: form.dataset.confirm,
            textoConfirmar: form.dataset.confirmButton || \'Eliminar\',
            onConfirm: function () {
                form.dataset.confirmed = \'1\';
                form.submit();
            }
        });
    });
})();' => '(function () {
    const modal = document.getElementById(\'gcfModal\');
    if (!modal) return;

    const presets = {
        danger:  { header: \'bg-red-500\',          iconBg: \'bg-red-50\',          iconColor: \'text-red-500\',          icon: \'fas fa-trash-alt\',           btn: \'bg-red-500 hover:bg-red-600\' },
        warning: { header: \'bg-yellow-500\',       iconBg: \'bg-yellow-50\',       iconColor: \'text-yellow-500\',       icon: \'fas fa-exclamation-triangle\',btn: \'bg-yellow-500 hover:bg-yellow-600\' },
        success: { header: \'bg-green-500\',        iconBg: \'bg-green-50\',        iconColor: \'text-green-500\',        icon: \'fas fa-check-circle\',        btn: \'bg-green-500 hover:bg-green-600\' },
        info:    { header: \'bg-blue-500\',         iconBg: \'bg-blue-50\',         iconColor: \'text-blue-500\',         icon: \'fas fa-info-circle\',         btn: \'bg-blue-500 hover:bg-blue-600\' },
        primary: { header: \'bg-[#1e3a5f]\',        iconBg: \'bg-[#1e3a5f]/10\',    iconColor: \'text-[#1e3a5f]\',        icon: \'fas fa-question-circle\',     btn: \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90\' },
    };

    // Extrae el color base de un btnClass tipo "bg-yellow-500 hover:bg-yellow-600"
    // o "bg-[#e11d48] hover:bg-[#e11d48]/80" → "bg-yellow-500" / "bg-[#e11d48]"
    function deriveHeader(btnClass) {
        if (!btnClass) return null;
        const m = btnClass.match(/bg-(?:\\[[^\\]]+\\]|[a-z]+-\\d+)/);
        return m ? m[0] : null;
    }

    window.confirmar = function (cfg) {
        cfg = cfg || {};
        const tipo = cfg.tipo || \'danger\';
        const base = presets[tipo] || presets.danger;

        const iconBg    = cfg.iconBg      || base.iconBg;
        const iconColor = cfg.iconColor   || base.iconColor;
        const icon      = cfg.icon        || base.icon;
        const btnClass  = cfg.btnClass    || base.btn;
        // Si no hay headerColor explícito, se infiere del btnClass
        const header    = cfg.headerColor || deriveHeader(btnClass) || base.header;

        document.getElementById(\'gcfHeader\').className   = \'h-1.5 w-full \' + header;
        document.getElementById(\'gcfIconWrap\').className = \'w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 \' + iconBg;
        document.getElementById(\'gcfIcon\').className     = \'text-2xl \' + icon + \' \' + iconColor;
        document.getElementById(\'gcfTitle\').textContent  = cfg.titulo  || \'¿Estás seguro?\';
        document.getElementById(\'gcfMessage\').textContent= cfg.mensaje || \'Esta acción no se puede deshacer.\';

        const btnConfirm = document.getElementById(\'gcfBtnConfirm\');
        btnConfirm.textContent = cfg.textoConfirmar || \'Confirmar\';
        btnConfirm.className   = \'flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition \' + btnClass;

        const btnCancel = document.getElementById(\'gcfBtnCancel\');
        btnCancel.textContent = cfg.textoCancelar || \'Cancelar\';
        btnCancel.style.display = cfg.soloConfirmar ? \'none\' : \'\';

        btnConfirm.onclick = function () {
            cerrarConfirmar();
            if (typeof cfg.onConfirm === \'function\') cfg.onConfirm();
            else if (typeof cfg.accion === \'function\') cfg.accion();
        };
        btnCancel.onclick = function () {
            cerrarConfirmar();
            if (typeof cfg.onCancel === \'function\') cfg.onCancel();
        };

        modal.classList.remove(\'hidden\');
        modal.classList.add(\'flex\');
    };

    window.cerrarConfirmar = function () {
        modal.classList.add(\'hidden\');
        modal.classList.remove(\'flex\');
    };

    // Aliases retrocompatibles con código existente
    window.cerrarConfirmacion            = window.cerrarConfirmar;
    window.cerrarConfirmacionPerfil      = window.cerrarConfirmar;
    window.cerrarConfirmacionExperiencia = window.cerrarConfirmar;
    window.cerrarConfirmacionEducacion   = window.cerrarConfirmar;
    window.cerrarConfirmacionHabilidad   = window.cerrarConfirmar;

    // Cerrar al clic en backdrop
    modal.addEventListener(\'click\', function (e) {
        if (e.target === modal) cerrarConfirmar();
    });

    // Cerrar con Escape
    document.addEventListener(\'keydown\', function (e) {
        if (e.key === \'Escape\' && !modal.classList.contains(\'hidden\')) cerrarConfirmar();
    });

    // Auto-handler: formularios con atributo data-confirm
    document.addEventListener(\'submit\', function (e) {
        const form = e.target;
        if (!form.dataset.confirm) return;
        if (form.dataset.confirmed === \'1\') {
            form.removeAttribute(\'data-confirmed\');
            return;
        }
        e.preventDefault();
        confirmar({
            tipo: form.dataset.confirmType || \'danger\',
            titulo: form.dataset.confirmTitle || \'¿Confirmar eliminación?\',
            mensaje: form.dataset.confirm,
            textoConfirmar: form.dataset.confirmButton || \'Eliminar\',
            onConfirm: function () {
                form.dataset.confirmed = \'1\';
                form.submit();
            }
        });
    });
})();',
);
