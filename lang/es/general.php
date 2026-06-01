<?php

return array (
  'Portafolio' => 'Portafolio',
  'Digital' => 'Digital',
  'Notificaciones' => 'Notificaciones',
  'Ver todas' => 'Ver todas',
  'Cargando...' => 'Cargando...',
  'Mi perfil' => 'Mi perfil',
  'Configuración' => 'Configuración',
  'Cerrar sesion' => 'Cerrar sesion',
  'Buscar proyectos...' => 'Buscar proyectos...',
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
            botón constante = dropdown.querySelector(\'botón\');
            menú constante = dropdown.querySelector(\'.menú desplegable\');

            si (botón && menú) {
                button.addEventListener(\'hacer clic\', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll(\'.menú desplegable\').forEach(m => {
                        if (m! == menú) m.classList.add(\'oculto\');
                    });
                    menu.classList.toggle(\'oculto\');
                });
            }
        });

        document.addEventListener(\'hacer clic\', (e) => {
            si (!e.target.closest(\'.dropdown\')) {
                document.querySelectorAll(\'.menú desplegable\').forEach(menú => {
                    menu.classList.add(\'oculto\');
                });
            }
        });

        function resaltarLink(seccionId) {
            document.querySelectorAll(\'.seccion-link\').forEach(enlace => {
                link.classList.remove(\'bg-[#1e3a5f]\', \'border-r-4\', \'border-[#e11d48]\', \'shadow-sm\');
                link.classList.add(\'texto-gris-700\');
                link.classList.remove(\'texto-blanco\', \'fuente-semibold\');
                const icono = link.querySelector(\'i\');
                si (icono) {
                    icono.classList.remove(\'texto-blanco\');
                    icono.classList.add(\'texto-gris-500\');
                }
                const span = link.querySelector(\'span\');
                if (span) span.classList.remove(\'font-semibold\');
            });

            const linkActivo = document.querySelector(`.seccion-link[data-seccion="${seccionId}"]`);
            si (enlaceActivo) {
                linkActivo.classList.add(\'bg-[#1e3a5f]\', \'border-r-4\', \'border-[#e11d48]\', \'shadow-sm\');
                linkActivo.classList.remove(\'text-gray-700\');
                linkActivo.classList.add(\'texto-blanco\', \'fuente-semibold\');
                const icono = linkActivo.querySelector(\'i\');
                si (icono) {
                    icono.classList.remove(\'texto-gris-500\');
                    icono.classList.add(\'texto-blanco\');
                }
                const intervalo = linkActivo.querySelector(\'intervalo\');
                if (span) span.classList.add(\'font-semibold\');
            }
        }

        function esEscritorio() {
            devolver ventana.innerWidth >= 1024;
        }

        function cambiarSeccion(seccionId) {
            if (esEscritorio()) {
                document.querySelectorAll(\'.seccion-contenido\').forEach(s => s.classList.add(\'hidden\'));
                const secciónActiva = document.getElementById(\'sección-\' + secciónId);
                if (seccionActiva) secciónActiva.classList.remove(\'oculto\');
            } más {
                const secciónActiva = document.getElementById(\'sección-\' + secciónId);
                if (seccionActiva) secciónActiva.scrollIntoView({ comportamiento: \'suave\', bloque: \'inicio\' });
            }
            resaltarLink(seccionId);
        }

        ventana.irAConfiguracionCuenta = funcion() {
            cambiarSeccion(\'perfil\');
            setTimeout(() => {
                const secciónConfig = document.getElementById(\'sección-configuracion\');
                if (seccionConfig && secciónConfig.classList.contains(\'hidden\') && tipode toggleConfiguracionCuenta === \'función\') {
                    toggleConfiguracionCuenta();
                } si no (secciónConfig) {
                    seccionConfig.scrollIntoView({ comportamiento: \'suave\', bloque: \'inicio\' });
                }
            }, 50);
        };

        document.querySelectorAll(\'.seccion-link\').forEach(enlace => {
            link.addEventListener(\'hacer clic\', (e) => {
                e.preventDefault();
                const sección = link.getAttribute(\'data-seccion\');
                si (sección) {
                    cambiarSeccion(seccion);
                    cerrarbarras laterales();
                }
            });
        });

        // ── Scroll-spy: solo en móvil ───────────────────── ─────────────────────
        const secciónObserver = new IntersectionObserver((entradas) => {
            entradas.forEach(entrada => {
                si (entrada.isIntersecting) {
                    const id = entrada.target.id.replace(\'sección-\', \'\');
                    resaltarEnlace(id);
                }
            });
        }, {
            raízMargin: \'-30% 0px -60% 0px\',
            umbral: 0,
        });

        función activarScrollSpy() {
            document.querySelectorAll(\'.seccion-contenido\').forEach(s => secciónObserver.observe(s));
        }
        función desactivarScrollSpy() {
            seccionObserver.disconnect();
        }

        if (!esEscritorio()) activarScrollSpy();

        // ── Barras laterales móviles / tablet ───────────────────── ─────────────────────
        const sidebarIzq = document.getElementById(\'sidebar-izquierdo\');
        const sidebarDer = document.getElementById(\'sidebar-derecho\');
        const sidebarOverlay = document.getElementById(\'superposición de barra lateral\');
        const btnMenu = document.getElementById(\'btn-menu-mobile\');
        const btnSidebarDer = document.getElementById(\'btn-sidebar-derecho\');

        función abrirbarra lateralIzq() {
            barra lateralIzq.classList.remove(\'-translate-x-full\');
            barra lateralOverlay.classList.remove(\'oculto\');
        }
        function abrirbarraDer() {
            barra lateralDer.classList.remove(\'traducir-x-full\');
            barra lateralOverlay.classList.remove(\'oculto\');
        }
        function cerrarbarras laterales() {
            si (ventana.anchointerior',
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
                resultadosPanel.innerHTML = `',
  'Sin resultados para "' => 'Sin resultados para "',
  '${q}' => '${q}',
  '`;
            } else {
                matches.forEach(card => {
                    const nombre = card.querySelector(\'h3\')?.textContent.trim() ?? \'\';
                    const badge  = card.querySelector(\'span.rounded-full\')?.textContent.trim() ?? \'\';
                    const item   = document.createElement(\'div\');
                    item.className = \'flex items-center gap-3 px-4 py-3 hover:bg-[#1e3a5f]/5 cursor-pointer border-b border-gray-50 last:border-0 transition-colors\';
                    item.innerHTML = `' => '`;
            } más {
                coincidencias.forEach(tarjeta => {
                    const nombre = card.querySelector(\'h3\')?.textContent.trim() ?? \'\';
                    insignia constante = card.querySelector(\'span.rounded-full\')?.textContent.trim() ?? \'\';
                    elemento constante = document.createElement(\'div\');
                    item.className = \'elementos flexibles-centro espacio-3 px-4 py-3 hover:bg-[#1e3a5f]/5 cursor-puntero borde-b borde-gris-50 último:borde-0 colores-de transición\';
                    elemento.innerHTML = `',
  '${nombre}' => '${nombre}',
  '${badge}' => '${insignia}',
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
                    item.addEventListener(\'hacer clic\', () => {
                        cambiarSeccion(\'proyectos\');
                        limpiarBusqueda();
                        setTimeout(() => {
                            card.scrollIntoView({ comportamiento: \'suave\', bloque: \'centro\' });
                            card.classList.add(\'ring-2\', \'ring-[#1e3a5f]\', \'ring-offset-2\');
                            setTimeout(() => card.classList.remove(\'ring-2\', \'ring-[#1e3a5f]\', \'ring-offset-2\'), 1800);
                        }, 150);
                    });
                    resultadosPanel.appendChild(elemento);
                });
            }

            resultadosPanel.classList.remove(\'oculto\');
        });

        // Cerrar panel al hacer clic fuera
        document.addEventListener(\'hacer clic\', e => {
            if (!e.target.closest(\'#buscador-global\') && !e.target.closest(\'#buscador-resultados\')) {
                resultadosPanel.classList.add(\'oculto\');
            }
        });

        inputBusqueda.addEventListener(\'enfoque\', () => {
            if (inputBusqueda.value.trim()) resultadosPanel.classList.remove(\'oculto\');
        });

        // ── Marcar novedades como leídas (campana + sidebar) ────────────────
        función asíncrona marcarNovedadesVistas(botones) {
            const hayItemsVisibles = !!document.querySelector(\'.novedad-item, .novedad-item-header\');
            si (!hayItemsVisibles) regresa;

            botones.forEach(b => b && (b.disabled = true));
            prueba {
                const res = await fetch(\'{{ ruta(\'novedades.marcar-vistas\') }}\', {
                    método: \'POST\',
                    encabezados: {
                        \'Tipo de contenido\': \'aplicación/json\',
                        \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\')?.content || \'\',
                        \'Aceptar\': \'aplicación/json\',
                    },
                    cuerpo: JSON.stringify({ todas: true }),
                });
                si (!res.ok) {
                    botones.forEach(b => b && (b.disabled = false));
                    devolver;
                }

                document.querySelectorAll(\'.novedad-item, .novedad-item-header\').forEach(el => el.remove());
                botones.forEach(b => b && b.remove());

                // Barra lateral vacía
                const contSide = document.getElementById(\'contenedor-notificaciones\');
                if (ladocont && !ladocont.querySelector(\'div\')) {
                    const vacio = document.createElement(\'p\');
                    vacio.className = \'texto-xs texto-gris-500 cursiva\';
                    vacio.textContent = \'No hay novedades recientes.\';
                    contSide.appendChild(vacio);
                }

                // Encabezado desplegable vacío
                const contHdr = document.getElementById(\'contenedor-notificaciones-header\');
                si (contHdr && !contHdr.querySelector(\'div\')) {
                    const vacio = document.createElement(\'p\');
                    vacio.className = \'p-4 texto-xs texto-gris-500 cursiva centro de texto\';
                    vacio.textContent = \'Sin notificaciones\';
                    contHdr.appendChild(vacio);
                }

                // Actualizar insignia: reiniciar las novedades marcadas; quedan solo los avisos de moderación (si los hay)
                insignia const = document.getElementById(\'insignia-notificaciones\');
                si (insignia) {
                    const quedanAvisos = !!document.querySelector(\'#contenedor-notificaciones-header > div\');
                    if (quedanavisos) {
                        insignia.textContent = \'1\';
                        insignia.classList.remove(\'oculto\');
                    } más {
                        insignia.classList.add(\'oculto\');
                        insignia.textContent = \'\';
                    }
                }
            } atrapar (e) {
                botones.forEach(b => b && (b.disabled = false));
            }
        }

        const btnNovSidebar = document.getElementById(\'btn-marcar-novedades-vistas\');
        const btnNovHeader = document.getElementById(\'btn-marcar-novedades-vistas-header\');
        const grupoBotones = [btnNovSidebar, btnNovHeader];
        btnNovSidebar?.addEventListener(\'click\', () => marcarNovedadesVistas(grupoBotones));
        btnNovHeader?.addEventListener(\'click\', () => marcarNovedadesVistas(grupoBotones));

        // ── Calendario interactivo ───────────────────── ──────────────────────
        (función inicializarCalendario() {
            widget const = document.getElementById(\'widget-calendario\');
            si (!widget) regresa;

            punto final constante = widget.dataset.punto final;
            const hoyStr = widget.dataset.hoy; // AAAA-MM-DD
            const titulo = document.getElementById(\'cal-titulo\');
            const grid = document.getElementById(\'cal-grid\');
            const panelLista = document.getElementById(\'cal-panel-lista\');
            const panelTitulo = document.getElementById(\'cal-panel-titulo\');
            const btnPrev = document.getElementById(\'cal-prev\');
            const btnNext = document.getElementById(\'cal-siguiente\');

            const MESES = [\'Enero\',\'Febrero\',\'Marzo\',\'Abril\',\'Mayo\',\'Junio\',\'Julio\',\'Agosto\',\'Septiembre\',\'Octubre\',\'Noviembre\',\'Diciembre\'];
            const hoy = parseFecha(hoyStr);
            let mesVisible = new Fecha(hoy.getFullYear(), hoy.getMonth(), 1);
            let diaSeleccionado = formatearFecha(hoy);
            let eventosCache = {}; // { \'AAAA-MM-DD\': [eventos] }

            función parseFecha (cadena) {
                const [y, m, d] = str.split(\'-\').map(Número);
                devolver nueva fecha (y, m - 1, d);
            }
            función formatearFecha(d) {
                const y = d.getFullYear();
                const m = String(d.getMonth() + 1).padStart(2, \'0\');
                día constante = String(d.getDate()).padStart(2, \'0\');
                devolver `${y}-${m}-${día}`;
            }
            función formatearLargoEsp(cadena) {
                const d = parseFecha(cadena);
                return `${d.getDate()} de ${MESES[d.getMonth()].toLowerCase()} de ${d.getFullYear()}`;
            }

            función asíncrona cargarMes() {
                const y = mesVisible.getFullYear();
                const m = mesVisible.getMonth();
                const desde = nueva Fecha(y, m, 1);
                const hasta = nueva fecha(y, m + 1, 0);
                titulo.textContent = `${MESES[m]} ${y}`;

                renderizarGrid(desde, hasta, {}); // mientras carga

                prueba {
                    const url = `${endpoint}?desde=${formatearFecha(desde)}&hasta=${formatearFecha(hasta)}`;
                    const res = await fetch(url, {encabezados: { \'Aceptar\': \'aplicación/json\' } });
                    datos constantes = esperar res.json();
                    eventosCache = datos.eventos || {};
                } atrapar (e) {
                    eventosCaché = {};
                }
                renderizarGrid(desde, hasta, eventosCache);
                renderizarPanel(diaSeleccionado);
            }

            function renderizarGrid(desde, hasta, eventos) {
                grid.innerHTML = \'\';
                const primerDiaSemana = (desde.getDay() + 6) % 7; // lunes = 0
                const diasEnMes = hasta.getDate();
                const hoyFmt = formatearFecha(hoy);

                para (sea i = 0; i',
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
                    panelLista.innerHTML = \'',
  'Sin eventos ese día.' => 'Sin eventos ese día.',
  '\';
                    return;
                }

                panelLista.innerHTML = eventos.map(ev => `' => '\';
                    devolver;
                }

                panelLista.innerHTML = eventos.map(ev => `',
  '${escapeHtmlCal(ev.titulo)}' => '${escapeHtmlCal(ev.título)}',
  '${ev.detalle ? `' => '${wave.dateley? `',
  '${escapeHtmlCal(ev.detalle)}' => '${escapeHtmlCal(ev.detalle)}',
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
                lista.innerHTML = `' => '`).unirse(\'\');
            }

            función escapeHtmlCal(s) {
                const d = document.createElement(\'div\');
                d.textContenido = s ?? \'\';
                devolver d.innerHTML;
            }

            btnPrev.addEventListener(\'hacer clic\', () => {
                mesVisible = nueva Fecha(mesVisible.getFullYear(), mesVisible.getMonth() - 1, 1);
                cargarme();
            });
            btnNext.addEventListener(\'hacer clic\', () => {
                mesVisible = nueva Fecha(mesVisible.getFullYear(), mesVisible.getMonth() + 1, 1);
                cargarme();
            });

            cargarme();
        })();
// ==========================================
// DESPLEGABLE NOTIFICACIONES (MEJORADO)
// ==========================================
const btnNotif = document.getElementById(\'btn-notificaciones\');
const menuNotif = document.getElementById(\'notificaciones-menu\');
let notifAbierto = false;

función escapeHtml(texto) {
    const div = document.createElement(\'div\');
    div.textContent = texto;
    devolver div.innerHTML;
}

function cargarNotificaciones() {
    buscar(\'{{ ruta("notificaciones.lista") }}\')
        .entonces(respuesta => respuesta.json())
        .entonces(datos => {
            const lista = document.getElementById(\'notificaciones-lista\');
            insignia const = document.getElementById(\'notificaciones-badge\');
            
            si (datos.noLeidas > 0) {
                insignia.textContent = data.noLeidas > 99 ? \'99+\' : datos.noLeidas;
                insignia.classList.remove(\'oculto\');
            } más {
                insignia.classList.add(\'oculto\');
            }
            
            if (datos.notificaciones.length === 0) {
                lista.innerHTML = `',
  'No hay notificaciones' => 'No hay notificaciones',
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
            } más {
                dejar html = \'\';
                data.notificaciones.forEach(notif => {
                    let tipoIcon = \'\';
                    if (notif.tipo === \'info\') tipoIcon = \'fa-info-circle text-blue-500\';
                    else if (notif.tipo === \'éxito\') tipoIcon = \'fa-check-circle text-green-500\';
                    else if (notif.tipo === \'advertencia\') tipoIcon = \'fa-triángulo-de-exclamación-texto-amarillo-500\';
                    else tipoIcon = \'fa-times-circle text-red-500\';
                    
                    const fondoClass = !notif.leido ? \'bg-azul-50\' : \'bg-blanco\';
                    
                    html+=`',
  '${escapeHtml(notif.titulo)}' => '${escapeHtml(notif.titulo)}',
  '${escapeHtml(notif.mensaje)}' => '${escapeHtml(notif.mensaje)}',
  '${notif.hace}' => '${notif.hace}',
  '${!notif.leido ? \'' => '${!notif.permitido? \'',
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

function marcarLeida(id,url,elemento) {
    if (elemento && elemento.classList.contains(\'marcando\')) return;
    if (elemento) elemento.classList.add(\'marcando\', \'opacity-50\');
    
    fetch(\'{{ ruta("notificaciones.marcar-leida") }}\', {
        método: \'POST\',
        encabezados: {
            \'X-CSRF-TOKEN\': \'{{ csrf_token() }}\',
            \'Tipo de contenido\': \'aplicación/json\'
        },
        cuerpo: JSON.stringify({ id: id })
    }).entonces(() => {
        si (elemento) {
            elemento.classList.remove(\'bg-blue-50\');
            elemento.classList.add(\'bg-blanco\');
            const insigniaAzul = elemento.querySelector(\'.w-2.h-2.bg-blue-500\');
            if (insigniaAzul) insigniaAzul.remove();
        }
        
        si (url && url! == \'\') {
            ventana.ubicación.href = url;
        } más {
            actualizarContadorNotificaciones();
            if (notifAbierto) cargarNotificaciones();
        }
    }).catch(error => {
        console.error(\'Error:\', error);
        if (elemento) elemento.classList.remove(\'opacidad-50\');
    }).finalmente(() => {
        si (elemento) {
            elemento.classList.remove(\'marcando\');
            setTimeout(() => {
                if (elemento) elemento.classList.remove(\'opacidad-50\');
            }, 300);
        }
    });
}

function actualizarContadorNotificaciones() {
    buscar(\'{{ ruta("notificaciones.count") }}\')
        .entonces(respuesta => respuesta.json())
        .entonces(datos => {
            insignia const = document.getElementById(\'notificaciones-badge\');
            si (datos.count > 0) {
                Badge.textContent = datos.count > 99? \'99+\': datos.count;
                insignia.classList.remove(\'oculto\');
            } más {
                insignia.classList.add(\'oculto\');
            }
        });
}

si (btnNotif) {
    btnNotif.addEventListener(\'hacer clic\', (e) => {
        e.stopPropagation();
        si (!notifAbierto) {
            cargarNotificaciones();
            menuNotif.classList.remove(\'oculto\');
            notifAbierto = verdadero;
        } más {
            menuNotif.classList.add(\'oculto\');
            notifAbierto = falso;
        }
    });
    
    document.addEventListener(\'hacer clic\', (e) => {
        si (btnNotif && menuNotif && 
            !btnNotif.contiene(e.objetivo) && 
            !menuNotif.contiene(e.objetivo)) {
            menuNotif.classList.add(\'oculto\');
            notifAbierto = falso;
        }
    });
}

// Inicializar
actualizarContadorNotificaciones();
setInterval(actualizarContadorNotificaciones, 30000);',
  'toDateString() }}"
                     data-endpoint="{{ route(\'calendario.eventos\') }}">' => 'toDateString() }}"
                     punto-endpoint="{{ ruta(\'calendario.eventos\') }}">',
  '—' => '—',
  'Eventos del día' => 'Eventos del día',
  'Selecciona un día para ver sus eventos.' => 'Selecciona un día para ver sus eventos.',
  'Notificaciones y novedades' => 'Notificaciones y novedades',
  'Marcar leídas' => 'Marcar leídas',
  'Enlaces rápidos' => 'Enlaces rápidos',
  'Mi portafolio público' => 'Mi portafolio público',
  'Artículos guardados' => 'Artículos guardados',
  'Novedades del sistema' => 'Novedades del sistema',
  'function cargarNovedades() {
    const container = document.getElementById(\'contenedor-novedades\');
    const btnMarcar = document.getElementById(\'btn-marcar-novedades-vistas\');
    
    if (!container) return;
    
    // Mostrar loading
    container.innerHTML = `' => 'función cargarNovedades() {
    const contenedor = document.getElementById(\'contenedor-novedades\');
    const btnMarcar = document.getElementById(\'btn-marcar-novedades-vistas\');
    
    si (!contenedor) regresa;
    
    // Mostrar cargando
    contenedor.innerHTML = `',
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
    
    fetch(\'{{ ruta("novedades.lista") }}\', {
        encabezados: {
            \'X-Solicitado-Con\': \'XMLHttpRequest\',
            \'Aceptar\': \'aplicación/json\'
        },
        credenciales: \'mismo origen\'
    })
    .entonces(respuesta => {
        si (!respuesta.ok) {
            lanzar nuevo Error(\'Error HTTP \' + respuesta.status);
        }
        devolver respuesta.json();
    })
    .entonces(datos => {
        si (datos.error) {
            contenedor.innerHTML = `',
  'Error: ${data.error}' => 'Error: ${datos.error}',
  '`;
            if (btnMarcar) btnMarcar.classList.add(\'hidden\');
            return;
        }
        
        if (!data.novedades || data.novedades.length === 0) {
            container.innerHTML = \'' => '`;
            if (btnMarcar) btnMarcar.classList.add(\'oculto\');
            devolver;
        }
        
        if (!datos.novedades || datos.novedades.length === 0) {
            contenedor.innerHTML = \'',
  'No hay novedades recientes.' => 'No hay novedades recientes.',
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
            
            html += `',
  '${escapeHtml(novedad.titulo || \'Sin título\')}' => '${escapeHtml(novedad.titulo || \'Sin título\')}',
  '${escapeHtml(novedad.detalle || \'\')}' => '${escapeHtml(novedad.detalle || \'\')}',
  '${formatDate(novedad.created_at)}' => '${formatoFecha(novedad.created_at)}',
  '${novedad.tipo === \'notificacion\' && !novedad.leido ? \'' => '${novedad.tipo === \'notificacion\' && !novedad.leido ? \'',
  '`;
        });
        
        // Agregar enlace "Ver todas" si hay más notificaciones
        if (totalRestantes > 0) {
            html += `' => '`;
        });
        
        // Agregar enlace "Ver todas" si hay más notificaciones
        if (totalRestantes > 0) {
            html += `',
  'Ver ${totalRestantes} notificaciones más...' => 'Ver ${totalRestantes} notificaciones más...',
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
        
        contenedor.innerHTML = html;
        
        // Agregar eventos haga clic en cada novedad
        document.querySelectorAll(\'#contenedor-novedades [tipo-datos]\').forEach(item => {
            item.addEventListener(\'hacer clic\', función(e) {
                e.stopPropagation();
                const tipo = this.dataset.tipo;
                identificación constante = this.dataset.id;
                url constante = this.dataset.url;
                
                if (tipo === \'notificacion\' && id) {
                    fetch(\'{{ ruta("novedades.marcar-vista") }}\', {
                        método: \'POST\',
                        encabezados: {
                            \'X-CSRF-TOKEN\': \'{{ csrf_token() }}\',
                            \'Tipo de contenido\': \'aplicación/json\'
                        },
                        cuerpo: JSON.stringify({ tipo: tipo, id: id })
                    }).entonces(() => {
                        si (url) {
                            ventana.ubicación.href = url;
                        } más {
                            Novedad cargar();
                            // Actualizar también la campana
                            if (tipo de actualizarContadorNotificaciones === \'función\') {
                                actualizarContadorNotificaciones();
                            }
                        }
                    }).catch(err => console.error(\'Error:\', err));
                } si no (url) {
                    ventana.ubicación.href = url;
                }
            });
        });
    })
    .catch(error => {
        console.error(\'Error cargando novedades:\', error);
        contenedor.innerHTML = \'',
  'Error al cargar novedades' => 'Error al cargar novedades',
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
función escapeHtml(texto) {
    si (!texto) regresa \'\';
    const div = document.createElement(\'div\');
    div.textContent = texto;
    devolver div.innerHTML;
}

// Función para formatear fechas
función formatoFecha(fechaStr) {
    si (!dateStr) regresa \'\';
    fecha constante = nueva fecha (dateStr);
    constante ahora = nueva fecha();
    const diffMs = ahora - fecha;
    const diffMins = Math.floor(diffMs/60000);
    const diffHours = Math.floor(diffMs/3600000);
    const diffDays = Math.floor(diffMs/86400000);
    
    si (diffMins',
  '{
        cargarNovedades();
    }).catch(err => console.error(\'Error:\', err));
});

document.addEventListener(\'DOMContentLoaded\', function() {
    cargarNovedades();
});' => '{
        Novedad cargar();
    }).catch(err => console.error(\'Error:\', err));
});

document.addEventListener(\'DOMContentLoaded\', función() {
    Novedad cargar();
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
            comportamiento de desplazamiento: suave;
        }

        #sidebar-izquierdo,
        #barra-derecho {
            comportamiento de desplazamiento: suave;
        }

        .sección-contenido {
            margen de desplazamiento superior: 6rem;
        }

        .transición-todo {
            transición: todos los 0,3 s facilitan;
        }

        .transición-todo-suave {
            transición: todos los 0,3 s facilitan;
        }

        .hover-escala: flotar {
            transformar: escala (1.04);
        }

        .elemento de barra lateral: pasar el cursor {
            transformar: traducirX(5px);
            fondo: rgba(0,0,0,0.05);
        }

        .tarjeta estadística {
            transición: transformación 0,2 s, sombra de cuadro 0,2 s;
        }

        .stat-card: flotar {
            transformar: traducirY(-4px);
            sombra de cuadro: 0 10px 25px -5px rgba(0,0,0,0.1);
        }

        .elemento de la barra lateral derecha: pasar el cursor {
            fondo: #f3f4f6;
            transformar: traducirX(-3px);
        }

        .dropdown: situar el cursor sobre .dropdown-menu {
            mostrar: bloquear;
        }

        .enlace de navegación {
            transición: todos los 0,3 s facilitan;
        }

        .nav-link: flotar {
            transformar: traducirY(-1px);
        }

        html, cuerpo {
            altura: 100%;
            desbordamiento-y: automático;
            desbordamiento-x: oculto;
        }

        .contenedor-principal {
            altura mínima: calc(100vh - 4rem);
        }
        .notificación-item {
            transición: todos los 0,3 s facilitan;
        }

        .notificacion-item:hover {
            transformar: traducirX(4px);
        }

        .notificacion-item.marcando {
            eventos de puntero: ninguno;
            cursor: espera;
        }

        /* Efecto de desvanecimiento al marcar */
        @keyframes se desvanecen {
            de {opacidad: 1; }
            a {opacidad: 0,6; }
        }

        .notificacion-item:activo {
            animación: desvanecimiento 0,2 s de facilidad;
        }',
  'Respaldos (Backups)' => 'Respaldos (Backups)',
  'Administra los respaldos de la base de datos' => 'Administra los respaldos de la base de datos',
  'Backup completo' => 'Backup completo',
  'Exporta toda la base de datos' => 'Exporta toda la base de datos',
  'Genera un volcado completo con' => 'Genera un volcado completo con',
  'pg_dump' => 'pg_dump',
  '. Incluye esquema y todos los datos.' => '. Incluye esquema y todos los datos.',
  'Crear backup completo' => 'Crear backup completo',
  'Backup por rango de fechas' => 'Backup por rango de fechas',
  'Solo los registros creados en ese período' => 'Solo los registros creados en ese período',
  'Exporta únicamente los registros cuya fecha de creación (' => 'Exporta únicamente los registros cuya fecha de creación (',
  'created_at' => 'creado_en',
  ') esté dentro del rango seleccionado.' => ') esté dentro del rango seleccionado.',
  'Desde' => 'Desde',
  'Hasta' => 'Hasta',
  'Crear backup por fechas' => 'Crear backup por fechas',
  'Mostrar backups desde' => 'Mostrar backups desde',
  'Filtrar' => 'Filtrar',
  'Limpiar' => 'Limpiar',
  'Nombre' => 'Nombre',
  'Tipo' => 'Tipo',
  'Tamaño' => 'Tamaño',
  'Generado' => 'Generado',
  'Acciones' => 'Acciones',
  'Por fechas' => 'Por fechas',
  'Completo' => 'Lleno',
  '$backup[\'name\']]) }}"
                                   class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 p-2 rounded-lg transition"
                                   title="Descargar">' => '$copia de seguridad[\'nombre\']]) }}"
                                   class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 p-2 transición redondeada-lg"
                                   título="Descargar">',
  'No hay respaldos disponibles' => 'No hay respaldos disponibles',
  'Descargar' => 'Descargar',
  'Eliminar' => 'Eliminar',
  'Gestión de Categorías' => 'Gestión de Categorías',
  'Administra las categorías de habilidades' => 'Administra las categorías de habilidades',
  'Nueva Categoría' => 'Nueva Categoría',
  'Imagen' => 'Imagen',
  'Habilidades' => 'Habilidades',
  '#{{ $categoria->id_categoria }}' => '#{{ $categoría->categoría_id }}',
  'imagen }}" alt="{{ $categoria->nombre }}"
                                 class="h-10 w-10 rounded-full object-cover border border-gray-200"
                                 onerror="this.onerror=null;this.src=\'https://via.placeholder.com/40?text=?\';">
                        @else' => 'imagen }}" alt="{{ $categoria->nombre }}"
                                 class="h-10 w-10 borde de cubierta de objeto completo redondeado borde-gris-200"
                                 onerror="this.onerror=null;this.src=\'https://via.placeholder.com/40?text=?\';">
                        @más',
  'id_categoria }}, {!! Js::from($categoria->nombre) !!}, {!! Js::from($categoria->imagen) !!})"
                                    class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition">' => 'id_categoria }}, {!! Js::from($categoria->nombre) !!}, {!! Js::from($categoria->imagen) !!})"
                                    class="text-amarillo-600 hover:text-amarillo-900 bg-amarillo-100 hover:bg-amarillo-200 p-2 transición redondeada-lg">',
  'id_categoria) }}" method="POST" class="inline" data-confirm="¿Eliminar la categoría «{{ $categoria->nombre }}»?">
                                @csrf
                                @method(\'DELETE\')' => 'id_categoria) }}" method="POST" class="inline" data-confirm="¿Eliminar la categoría «{{ $categoria->nombre }}»?">
                                @csrf
                                @method(\'DELETE\')',
  'No hay categorías registradas' => 'No hay categorías registradas',
  'Nombre *' => 'Nombre *',
  'URL de imagen *' => 'URL de imagen *',
  'Pega la URL pública de la imagen.' => 'Pega la URL pública de la imagen.',
  'Cancelar' => 'Cancelar',
  'Guardar' => 'Guardar',
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
    });' => 'constvista previaImg = document.getElementById(\'categoriaImagenPreview\');
    const imagenInput = document.getElementById(\'categoriaImagen\');

    función actualizarPreview(url) {
        si (url && url.trim()) {
            vista previaImg.src = url.trim();
            vista previaImg.classList.remove(\'oculto\');
            vista previaImg.onerror = () => vista previaImg.classList.add(\'oculto\');
        } más {
            vista previaImg.classList.add(\'oculto\');
            vista previaImg.src = \'\';
        }
    }

    imagenInput.addEventListener(\'input\', (e) => actualizarPreview(e.target.value));

    función abrirModalCrear() {
        document.getElementById(\'modalTitulo\').innerText = \'Nueva Categoría\';
        document.getElementById(\'formCategoria\').action = "{{ ruta(\'admin.categorias.store\') }}";
        document.getElementById(\'methodField\').value = \'POST\';
        document.getElementById(\'categoriaNombre\').value = \'\';
        imagenInput.valor = \'\';
        actualizarPreview(\'\');
        document.getElementById(\'modalCategoria\').classList.remove(\'hidden\');
    }

    function editarCategoria(id, nombre, imagen) {
        document.getElementById(\'modalTitulo\').innerText = \'Editar Categoría\';
        document.getElementById(\'formCategoria\').action = `/admin/categorias/${id}`;
        document.getElementById(\'methodField\').value = \'PUT\';
        document.getElementById(\'categoriaNombre\').value = nombre;
        imagenInput.valor = imagen || \'\';
        actualizarPreview(imagen || \'\');
        document.getElementById(\'modalCategoria\').classList.remove(\'hidden\');
    }

    función cerrarModal() {
        document.getElementById(\'modalCategoria\').classList.add(\'hidden\');
    }
    
    // Reabrir modal si hay errores de validación
    @if($errores->cualquier())
        document.getElementById(\'modalTitulo\').innerText = \'Nueva Categoría\';
        document.getElementById(\'formCategoria\').action = "{{ ruta(\'admin.categorias.store\') }}";
        document.getElementById(\'methodField\').value = \'POST\';
        actualizarPreview(imagenInput.value);
        document.getElementById(\'modalCategoria\').classList.remove(\'hidden\');
    @endif

    // Cerrar modal con ESC
    document.addEventListener(\'keydown\', función(evento) {
        if (event.key === \'Escape\') {
            cerrarModal();
        }
    });
    
    // Cerrar modal al hacer clic fuera
    document.getElementById(\'modalCategoria\').addEventListener(\'clic\', función(e) {
        si (e.target === esto) {
            cerrarModal();
        }
    });',
  'Ej: Programación, Diseño, Marketing' => 'Ej: Programación, Diseño, Marketing',
  'https://ejemplo.com/imagen.png' => 'https://ejemplo.com/imagen.png',
  'Configuración del sitio' => 'Configuración del sitio',
  'Edita los datos que aparecen en el footer y en la home page pública.' => 'Edita los datos que aparecen en el footer y en la home page pública.',
  'Nombre de la empresa' => 'Nombre de la empresa',
  'nombre_empresa) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">' => 'nombre_empresa) }}"
                    class="w-full px-4 py-2 borde redondeado-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">',
  'Descripción' => 'Descripción',
  'Aparece en el footer junto al nombre de la empresa.' => 'Aparece en el footer junto al nombre de la empresa.',
  'Email de contacto' => 'Email de contacto',
  'email_contacto) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">' => 'email_contacto) }}"
                        class="w-full px-4 py-2 borde redondeado-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">',
  'Teléfono' => 'Teléfono',
  'telefono) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">' => 'teléfono) }}"
                        class="w-full px-4 py-2 borde redondeado-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">',
  'Guardar cambios' => 'Guardar cambios',
  'Dashboard / Resumen general' => 'Dashboard / Resumen general',
  'Resumen general' => 'Resumen general',
  'Total Usuarios' => 'Total Usuarios',
  '+{{ $crecimientoUsuarios }}% vs mes anterior' => '+{{ $crecimientoUsuarios }}% vs mes anterior',
  'Usuarios Activos' => 'Usuarios Activos',
  'Usuarios Suspendidos' => 'Usuarios Suspendidos',
  'Portafolios' => 'Portafolios',
  'Usuarios hoy' => 'Usuarios hoy',
  'Proyectos hoy' => 'Proyectos hoy',
  'Tasa de conversión' => 'Tasa de conversión',
  'Inactivos >30 días' => 'Inactivos >30 días',
  'Sin actividad reciente' => 'Sin actividad reciente',
  'Proyectos privados' => 'Proyectos privados',
  'Crecimiento de Usuarios' => 'Crecimiento de Usuarios',
  '= 0 ? \'text-green-600\' : \'text-red-600\' }}">' => '= 0 ? \'texto-verde-600\' : \'texto-rojo-600\' }}">',
  '= 0 ? \'up\' : \'down\' }}">' => '= 0 ? \'arriba\' : \'abajo\' }}">',
  'Este mes' => 'Este mes',
  'Mes anterior' => 'Mes anterior',
  'Proyección próximo mes' => 'Proyección próximo mes',
  'Crecimiento de Proyectos' => 'Crecimiento de Proyectos',
  'Tecnologías más usadas' => 'Tecnologías más usadas',
  'No hay datos disponibles' => 'No hay datos disponibles',
  'Habilidades más comunes' => 'Habilidades más comunes',
  'Usuarios Recientes' => 'Usuarios Recientes',
  'Ver todos' => 'Ver todos',
  'USUARIO' => 'USUARIO',
  'EMAIL' => 'CORREO ELECTRÓNICO',
  'ESTADO' => 'ESTADO',
  'FECHA REGISTRO' => 'FECHA REGISTRO',
  'ÚLTIMO ACCESO' => 'ÚLTIMO ACCESO',
  'Activo' => 'Activo',
  'Suspendido' => 'Suspendido',
  'No hay usuarios registrados' => 'No hay usuarios registrados',
  'Editar categoría' => 'Editar categoría',
  'URL de imagen' => 'URL de imagen',
  'Editar habilidad blanda' => 'Editar habilidad blanda',
  'Total Habilidades' => 'Total Habilidades',
  'Habilidad más popular' => 'Habilidad más popular',
  'Categorías de habilidades técnicas' => 'Categorías de habilidades técnicas',
  'Agregar' => 'Agregar',
  'imagen }}" alt="{{ $categoria->nombre }}"
                                 class="h-6 w-6 rounded-full object-cover border border-gray-200 mr-2"
                                 onerror="this.onerror=null;this.style.display=\'none\';">
                        @else' => 'imagen }}" alt="{{ $categoria->nombre }}"
                                 class="h-6 w-6 borde de cubierta de objeto completo redondeado borde-gris-200 mr-2"
                                 onerror="this.onerror=null;this.style.display=\'none\';">
                        @más',
  '({{ $categoria->habilidades_count ?? 0 }})' => '({{ $categoria->habilidades_count ?? 0 }})',
  'id_categoria }}, {!! Js::from($categoria->nombre) !!}, {!! Js::from($categoria->imagen ?? \'\') !!})"
                            class="ml-2 text-blue-600 hover:text-blue-800" title="Editar">' => 'id_categoria }}, {!! Js::from($categoria->nombre) !!}, {!! Js::from($categoria->imagen ?? \'\') !!})"
                            class="ml-2 text-blue-600 hover:text-blue-800" title="Editar">',
  'id_categoria) }}" method="POST"
                            class="inline ml-1" data-confirm="¿Eliminar la categoría «{{ $categoria->nombre }}»?">
                            @csrf
                            @method(\'DELETE\')' => 'id_categoria) }}" method="POST"
                            class="inline ml-1" data-confirm="¿Eliminar la categoría «{{ $categoria->nombre }}»?">
                            @csrf
                            @method(\'DELETE\')',
  'Todas las categorías' => 'Todas las categorías',
  'id_categoria }}" {{ request(\'categoria\') == $categoria->id_categoria ? \'selected\' : \'\' }}>
                            {{ $categoria->nombre }}' => 'id_categoria }}" {{ request(\'categoria\') == $categoria->id_categoria ? \'selected\' : \'\' }}>
                            {{ $categoria->nombre }}',
  'HABILIDAD' => 'HABILIDAD',
  'CATEGORÍA' => 'CATEGORÍA',
  'ACCIONES' => 'ACCIONES',
  'activa ? \'bg-green-100 text-green-800\' : \'bg-red-100 text-red-800\' }}">
                                    {{ $habilidad->activa ? \'Activa\' : \'Inactiva\' }}' => 'activa ? \'bg-green-100 text-green-800\' : \'bg-red-100 text-red-800\' }}">
                                    {{ $habilidad->activa ? \'Activa\' : \'Inactiva\' }}',
  'id_habilidad) }}"
                                       class="text-blue-600 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg">Ver' => 'id_habilidad) }}"
                                       class="text-blue-600 bg-blue-100 hover:bg-blue-200 p-2 redondeado-lg">Ver',
  'id_habilidad }}, {!! Js::from($habilidad->nombre) !!})"
                                            class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                            Ocultar' => 'id_habilidad }}, {!! Js::from($habilidad->nombre) !!})"
                                            class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                            Ocultar',
  'id_habilidad) }}" method="POST">
                                            @csrf' => 'id_habilidad) }}" method="POST">
                                            @csrf',
  'Mostrar' => 'Espectáculo',
  'No hay habilidades técnicas registradas' => 'No hay habilidades técnicas registradas',
  'Nueva categoría' => 'Nueva categoría',
  'URL de imagen (https://...)' => 'URL de imagen (https://...)',
  'Buscar habilidad...' => 'Buscar habilidad...',
  'Editar' => 'Editar',
  'Gestión de Habilidades' => 'Gestión de Habilidades',
  'Administra el catálogo global de habilidades técnicas y blandas' => 'Administra el catálogo global de habilidades técnicas y blandas',
  'Técnicas' => 'Técnicas',
  'Blandas' => 'Mezclar',
  'Registrar nueva habilidad blanda' => 'Registrar nueva habilidad blanda',
  'Registrar' => 'Registrador',
  'NOMBRE' => 'NOMBRE',
  'DESCRIPCIÓN' => 'DESCRIPCIÓN',
  'estado === \'activo\' ? \'bg-green-100 text-green-800\' : \'bg-red-100 text-red-800\' }}">
                                    {{ $blanda->estado === \'activo\' ? \'Activa\' : \'Inactiva\' }}' => 'estado === \'activo\' ? \'bg-green-100 text-green-800\' : \'bg-red-100 text-red-800\' }}">
                                    {{ $blanda->estado === \'activo\' ? \'Activa\' : \'Inactiva\' }}',
  'id_habilidad_blanda }}, {!! Js::from($blanda->nombre) !!}, {!! Js::from($blanda->descripcion ?? \'\') !!})"
                                        class="p-2 rounded-lg bg-blue-100 text-blue-600" title="Editar">' => 'id_habilidad_blanda }}, {!! Js::from($blanda->nombre) !!}, {!! Js::from($blanda->descripcion ?? \'\') !!})"
                                        class="p-2 rounded-lg bg-blue-100 text-blue-600" title="Editar">',
  'id_habilidad_blanda) }}" method="POST">
                                        @csrf' => 'id_habilidad_blanda) }}" method="POST">
                                        @csrf',
  'estado === \'activo\' ? \'bg-orange-100 text-orange-600\' : \'bg-green-100 text-green-600\' }}">' => 'estado === \'activo\' ? \'bg-orange-100 texto-orange-600\' : \'bg-green-100 texto-verde-600\' }}">',
  'estado === \'activo\' ? \'fa-ban\' : \'fa-check\' }}">' => 'estado === \'activo\' ? \'fa-ban\' : \'fa-check\' }}">',
  'id_habilidad_blanda) }}" method="POST" data-confirm="¿Eliminar la habilidad blanda «{{ $blanda->nombre }}»?">
                                        @csrf
                                        @method(\'DELETE\')' => 'id_habilidad_blanda) }}" method="POST" data-confirm="¿Eliminar la habilidad blanda «{{ $blanda->nombre }}»?">
                                        @csrf
                                        @method(\'DELETE\')',
  'No hay habilidades blandas registradas' => 'No hay habilidades blandas registradas',
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
    }' => 'function activarTab(destino) {
        document.querySelectorAll(\'.tab-btn\').forEach(b => {
            const activo = b.dataset.tab === objetivo;
            b.classList.toggle(\'border-[#1e3a5f]\', activo);
            b.classList.toggle(\'text-[#1e3a5f]\', activo);
            b.classList.toggle(\'borde-transparente\', !activo);
            b.classList.toggle(\'text-gray-500\', !activo);
            b.classList.toggle(\'hover:text-gray-700\', !activo);
        });
        document.querySelectorAll(\'[panel-pestaña-datos]\').forEach(p => {
            p.classList.toggle(\'oculto\', p.dataset.tabPanel!== destino);
        });
    }

    document.querySelectorAll(\'.tab-btn\').forEach(btn => {
        btn.addEventListener(\'click\', () => activarTab(btn.dataset.tab));
    });

    @if(sesión(\'active_tab\'))
        activarTab(@json(session(\'active_tab\')));
    @endif

    función actualizarPreviewCategoria(url) {
        vista previa constante = document.getElementById(\'categoria_imagen_preview\');
        si (url && url.trim()) {
            vista previa.src = url.trim();
            vista previa.classList.remove(\'oculto\');
            vista previa.onerror = () => vista previa.classList.add(\'oculto\');
        } más {
            vista previa.classList.add(\'oculto\');
            vista previa.src = \'\';
        }
    }

    document.getElementById(\'categoria_imagen\')?.addEventListener(\'input\', (e) => {
        actualizarPreviewCategoria(e.target.value);
    });

    function abrirModalEditarCategoria(id, nombre, imagen) {
        formulario const = document.getElementById(\'formEditarCategoria\');
        form.action = "{{ url(\'admin/categorias\') }}/" + id;
        document.getElementById(\'categoria_nombre\').value = nombre;
        document.getElementById(\'categoria_imagen\').value = imagen || \'\';
        actualizarPreviewCategoria(imagen || \'\');
        const modal = document.getElementById(\'modalEditarCategoria\');
        modal.classList.remove(\'oculto\');
        modal.classList.add(\'flex\');
    }

    function cerrarModalEditarCategoria() {
        const modal = document.getElementById(\'modalEditarCategoria\');
        modal.classList.add(\'oculto\');
        modal.classList.remove(\'flex\');
    }

    function abrirModalEditarBlanda(id, nombre, descripcion) {
        formulario const = document.getElementById(\'formEditarBlanda\');
        form.action = "{{ url(\'admin/habilidades-blandas\') }}/" + id;
        document.getElementById(\'blanda_nombre\').value = nombre;
        document.getElementById(\'blanda_descripcion\').value = descripcion;
        const modal = document.getElementById(\'modalEditarBlanda\');
        modal.classList.remove(\'oculto\');
        modal.classList.add(\'flex\');
        activarTab(\'blandas\');
    }

    function cerrarModalEditarBlanda() {
        const modal = document.getElementById(\'modalEditarBlanda\');
        modal.classList.add(\'oculto\');
        modal.classList.remove(\'flex\');
    }',
  'Ocultar habilidad' => 'Ocultar habilidad',
  'Vas a ocultar la habilidad' => 'Vas a ocultar la habilidad',
  '.
                        Indica el motivo (será visible para el dueño de la habilidad en su panel).' => '.
                        Indica el motivo (será visible para el dueño de la habilidad en su panel).',
  'Motivo' => 'Razón',
  'Confirmar ocultar' => 'Confirmar ocultar',
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
    const __formOcultarHab = document.getElementById(\'formOcultarHabilidad\');
    const __motivoHabInput = document.getElementById(\'modalOcultarHabilidadMotivo\');
    const __motivoHabError = document.getElementById(\'modalOcultarHabilidadError\');

    function abrirModalOcultarHabilidad(idHab, nombre) {
        __formOcultarHab.action = `/admin/habilidades/${idHab}/toggle`;
        document.getElementById(\'modalOcultarHabilidadNombre\').textContent = nombre || \'\';
        __motivoHabInput.value = \'\';
        __motivoHabError.classList.add(\'oculto\');
        __motivoHabError.textContent = \'\';
        __modalOcultarHab.classList.remove(\'oculto\');
        document.body.style.overflow = \'oculto\';
        setTimeout(() => __motivoHabInput.focus(), 50);
    }

    function cerrarModalOcultarHabilidad() {
        __modalOcultarHab.classList.add(\'oculto\');
        documento.body.style.overflow = \'\';
    }

    function cerrarModalOcultarHabilidadFondo(evento) {
        if (event.target === __modalOcultarHab) cerrarModalOcultarHabilidad();
    }

    __formOcultarHab.addEventListener(\'enviar\', función (e) {
        if (!__motivoHabInput.value.trim()) {
            e.preventDefault();
            __motivoHabError.textContent = \'Debes indicar el motivo para ocultar la habilidad.\';
            __motivoHabError.classList.remove(\'oculto\');
            __motivoHabInput.focus();
        }
    });

    document.addEventListener(\'keydown\', función (e) {
        if (e.key === \'Escape\' && !__modalOcultarHab.classList.contains(\'hidden\')) {
            cerrarModalOcultarHabilidad();
        }
    });',
  'Descripción (opcional)' => 'Descripción (opcional)',
  'Ej. Nombre poco profesional, duplicado, no corresponde a la categoría...' => 'Ej. Nombre poco profesional, duplicado, no corresponde a la categoría...',
  'Volver a habilidades' => 'Volver a habilidades',
  'Registrada por {{ $habilidad->perfil?->usuario?->nombre_completo ?? \'Sin usuario\' }}
                el {{ $habilidad->created_at->format(\'d/m/Y H:i\') }}' => 'Registrada por {{ $habilidad->perfil?->usuario?->nombre_completo ?? \'Sin usuario\' }}
                el {{ $habilidad->created_at->format(\'d/m/Y H:i\') }}',
  'Categoría' => 'Categoría',
  'categoria->imagen }}" alt="{{ $habilidad->categoria->nombre }}"
                                 class="h-6 w-6 rounded-full object-cover border border-gray-200 mr-2"
                                 onerror="this.onerror=null;this.style.display=\'none\';">
                        @else' => 'categoria->imagen }}" alt="{{ $habilidad->categoria->nombre }}"
                                 class="h-6 w-6 borde de cubierta de objeto completo redondeado borde-gris-200 mr-2"
                                 onerror="this.onerror=null;this.style.display=\'none\';">
                        @más',
  'Información' => 'Información',
  'Estado:' => 'Estado:',
  'Años experiencia:' => 'Años experiencia:',
  'Usuario:' => 'Usuario:',
  'Email:' => 'Correo electrónico:',
  'Creada:' => 'Creada:',
  'Bitácora de Actividades' => 'Bitácora de Actividades',
  'Registro de acciones realizadas por administradores' => 'Registro de acciones realizadas por administradores',
  'Exportar CSV' => 'Exportar CSV',
  'ADMIN' => 'ADMINISTRACIÓN',
  'ACCIÓN' => 'ACCIÓN',
  'DETALLES' => 'DETALLES',
  'FECHA' => 'FECHA',
  '#{{ $log->id_log }}' => '#{{ $log->id_log }}',
  'No hay registros en la bitácora' => 'No hay registros en la bitácora',
  'Buscar acción...' => 'Buscar acción...',
  'Moderación de Perfiles' => 'Moderación de Perfiles',
  'Revisa y modera los perfiles de los usuarios' => 'Revisa y modera los perfiles de los usuarios',
  'Todos' => 'Todo',
  'Visibles' => 'Visible',
  'Ocultos' => 'Ocultos',
  'Usuario' => 'Usuario',
  'Ubicación' => 'Ubicación',
  'Estado' => 'Estado',
  'Nota' => 'Usar',
  'foto_perfil }}" alt="" class="h-10 w-10 rounded-full object-cover">
                            @else' => 'foto_perfil }}" alt="" class="h-10 w-10 redondeado-cubierta-objeto completo">
                            @más',
  'Visible' => 'Visible',
  'Oculto' => 'Oculto',
  'id_perfil }})"
                                class="text-blue-600 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg">Ver' => 'id_perfil }})"
                                class="text-blue-600 bg-blue-100 hover:bg-blue-200 p-2 redondeado-lg">Ver',
  'id_perfil }}, {!! Js::from(trim($perfil->usuario->nombre . \' \' . $perfil->usuario->apellido)) !!})"
                                    class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                    Ocultar' => 'id_perfil }}, {!! Js::from(trim($perfil->usuario->nombre . \' \' . $perfil->usuario->apellido)) !!})"
                                    class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                    Ocultar',
  'id_perfil) }}" method="POST">
                                    @csrf' => 'id_perfil) }}" método="POST">
                                    @csrf',
  'No hay perfiles para moderar' => 'No hay perfiles para moderar',
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
    }' => 'función asíncrona openVistaPortafolio(profileId) { prueba {
            const resp = await fetch(`/admin/moderacion/perfiles/${profileid}/portafolio-json`, {
                encabezados: {
                    \'X-Solicitado-Con\': \'XMLHttpRequest\',
                    \'Aceptar\': \'aplicación/json\'
                }
            } );
            if (! resp.ok) throw new Error(\'No se puede cargar el portafolio\');
            datos constantes = esperar resp.json();
            if (data.ok && tipo de ventana.abrirModalPortafolio === \'función\') { ventana.openModalPortafolio ({ datos: datos.portafolio });
            } } atrapar (errar) {
            alert (\'No pude abrir la vista de cartera: \' + err.message);
        } }',
  'Ocultar portafolio' => 'Ocultar portafolio',
  'Vas a ocultar el portafolio de' => 'Vas a ocultar el portafolio de',
  '.
                        Indica el motivo (se guardará como nota de moderación y será visible para el equipo administrador).' => '.
                        Indica el motivo (se guardará como nota de moderación y será visible para el equipo administrador).',
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

    función openHiddenModal(ProfileId, nombre) {
        __formHide.action = `/admin/moderation/profiles/${ProfileID}/toggle-visibility`;
        document.getElementById(\'modalHideUser\').textContent = nombre || \'\';
        __motivoInput.value = \'\';
        __motivoError.classList.add(\'oculto\');
        __reasonError.textContent = \'\';
        __modalHidden.classList.remove(\'oculto\');
        document.body.style.overflow = \'oculto\';
        setTimeout(() => __motivoInput.focus(), 50);
    }

    función cerrarModalOcultar() {
        __modalHidden.classList.add(\'oculto\');
        documento.body.style.overflow = \'\';
    }

    función closeModalHideBackground(evento) {
        if (event.target === __modalHide) closeModalHide();
    }

    __formHidden.addEventListener(\'enviar\', función (e) {
        si (!__motivoInput.value.trim()) {
            e.preventDefault();
            __reasonError.textContent = \'Debe especificar el motivo para ocultar la billetera.\';
            __motivoError.classList.remove(\'oculto\');
            __motifInput.focus();
        }
    });

    document.addEventListener(\'keydown\', función (e) {
        if (e.key === \'Escape\' && !__modalHidden.classList.contains(\'hidden\')) {
            cerrarHideModal();
        }
    });',
  'Buscar usuario...' => 'Buscar usuario...',
  'Ej. Contenido inapropiado, datos personales expuestos, denuncia recibida...' => 'Ej. Contenido inapropiado, datos personales expuestos, denuncia recibida...',
  'Portafolio publicado — {{ $perfil->usuario->nombre }} {{ $perfil->usuario->apellido }}' => 'Portafolio publicado — {{ $perfil->usuario->nombre }} {{ $perfil->usuario->apellido }}',
  'Vista del portafolio tal como lo ven los visitantes públicos.' => 'Vista del portafolio tal como lo ven los visitantes públicos.',
  'Volver al listado' => 'Volver al listado',
  'Visible (admin)' => 'Visible (administrador)',
  'Oculto (admin)' => 'Oculto (administrador)',
  'Perfil público' => 'Perfil publico',
  'Perfil privado' => 'Perfil privado',
  'id_perfil }}, {!! Js::from(trim($perfil->usuario->nombre . \' \' . $perfil->usuario->apellido)) !!})"
                    class="ml-auto text-orange-700 bg-orange-100 hover:bg-orange-200 px-3 py-2 rounded-lg text-sm">' => 'id_perfil }}, {!! Js::from(trim($perfil->usuario->nombre . \' \' . $perfil->usuario->apellido)) !!})"
                    class="ml-auto text-orange-700 bg-orange-100 hover:bg-orange-200 px-3 py-2 rounded-lg text-sm">',
  'id_perfil) }}" method="POST" class="ml-auto">
                    @csrf' => 'id_perfil) }}" método="POST" clase="ml-auto">
                    @csrf',
  'Mostrar portafolio' => 'Mostrar portafolio',
  'Reabrir vista pública' => 'Reabrir vista pública',
  'Nota de moderación' => 'Nota de moderación',
  'id_perfil) }}" method="POST" class="p-6 space-y-2">
            @csrf' => 'id_perfil) }}" método="POST" clase="p-6 espacio-y-2">
            @csrf',
  'Guardar nota' => 'guardar nota',
  '.
                        Indica el motivo (se guardará como nota de moderación).' => '.
                        Indica el motivo (se guardará como nota de moderación).',
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
    @endif' => 'ventana.__portfolioAdmin = @json($cartera);
    document.addEventListener(\'DOMContentLoaded\', función () {
        if (tipo de ventana.openModalPortfolio === \'función\') {
            ventana.openPortfolioModal({ datos: ventana.__portfolioAdmin });
        }
    });

    @if($perfil->visible)
    const __modalHidden = document.getElementById(\'modalHidden\');
    const __formHidden = document.getElementById(\'formHidden\');
    const __motivoInput = document.getElementById(\'modalHideMotivo\');
    const __motivoError = document.getElementById(\'modalHiddenError\');

    función openHiddenModal(ProfileId, nombre) {
        __formHide.action = `/admin/moderation/profiles/${ProfileID}/toggle-visibility`;
        document.getElementById(\'modalHideUser\').textContent = nombre || \'\';
        __motivoInput.value = \'\';
        __motivoError.classList.add(\'oculto\');
        __reasonError.textContent = \'\';
        __modalHidden.classList.remove(\'oculto\');
        document.body.style.overflow = \'oculto\';
        setTimeout(() => __motivoInput.focus(), 50);
    }

    función cerrarModalOcultar() {
        __modalHidden.classList.add(\'oculto\');
        documento.body.style.overflow = \'\';
    }

    función closeModalHideBackground(evento) {
        if (event.target === __modalHide) closeModalHide();
    }

    __formHidden.addEventListener(\'enviar\', función (e) {
        si (!__motivoInput.value.trim()) {
            e.preventDefault();
            __reasonError.textContent = \'Debe especificar el motivo para ocultar la billetera.\';
            __motivoError.classList.remove(\'oculto\');
            __motifInput.focus();
        }
    });

    document.addEventListener(\'keydown\', función (e) {
        if (e.key === \'Escape\' && !__modalHidden.classList.contains(\'hidden\')) {
            cerrarHideModal();
        }
    });
    @endif',
  'Anota el motivo de la decisión de moderación...' => 'Anota el motivo de la decisión de moderación...',
  'Volver a notificaciones' => 'Volver a notificaciones',
  'Nueva Notificación' => 'Nueva Notificación',
  'Envía notificaciones a los usuarios del sistema' => 'Envía notificaciones a los usuarios del sistema',
  'Tipo de notificación *' => 'Tipo de notificación *',
  'ℹ️ Información' => 'ℹ️ Información',
  '✅ Éxito' => '✅ Éxito',
  '⚠️ Advertencia' => '⚠️ Advertencia',
  '❌ Error' => '❌Error',
  'Destinatario *' => 'Destinatario *',
  'Todos los usuarios' => 'Todos los usuarios',
  'Usuario específico' => 'Usuario específico',
  'Seleccionar usuario *' => 'Seleccionar usuario *',
  '-- Seleccionar --' => '-- Seleccionar --',
  'id_usuario }}">{{ $usuario->nombre }} {{ $usuario->apellido }} ({{ $usuario->correo_electronico }})' => 'id_usuario }}">{{ $usuario->nombre }} {{ $usuario->apellido }} ({{ $usuario->correo_electronico }})',
  'Título *' => 'Título *',
  'Mensaje *' => 'Mensaje *',
  'URL (opcional)' => 'URL (opcional)',
  'Link al que irá el usuario al hacer clic en la notificación' => 'Link al que irá el usuario al hacer clic en la notificación',
  'Enviar Notificación' => 'Enviar Notificación',
  'document.querySelectorAll(\'input[name="destinatario"]\').forEach(radio => {
        radio.addEventListener(\'change\', function() {
            const selectDiv = document.getElementById(\'selectUsuario\');
            if (this.value === \'individual\') {
                selectDiv.classList.remove(\'hidden\');
            } else {
                selectDiv.classList.add(\'hidden\');
            }
        });
    });' => 'document.querySelectorAll(\'input[nombre="destinatario"]\').forEach(radio => {
        radio.addEventListener(\'cambiar\', función() {
            const selectDiv = document.getElementById(\'selectUsuario\');
            if (este.valor === \'individual\') {
                selectDiv.classList.remove(\'oculto\');
            } más {
                selectDiv.classList.add(\'oculto\');
            }
        });
    });',
  'Ej: Nuevo proyecto destacado' => 'Ej: Nuevo proyecto destacado',
  'Escribe el contenido de la notificación...' => 'Escribe el contenido de la notificación...',
  'https://ejemplo.com/algo' => 'https://ejemplo.com/algo',
  'Gestiona las notificaciones del sistema' => 'Gestiona las notificaciones del sistema',
  'Limpiar Antiguas' => 'Limpiar Antiguas',
  'Total' => 'Total',
  'Leídas' => 'Leídas',
  'No leídas' => 'No leídas',
  'Alertas' => 'Alertas',
  'Todos los tipos' => 'Todos los tipos',
  'TIPO' => 'TIPO',
  'TÍTULO' => 'TÍTULO',
  'leido ? \'bg-yellow-50\' : \'\' }}">' => 'leido? \'bg-amarillo-50\': \'\' }}">',
  'ℹ️ Info' => 'ℹ️ Información',
  '⚠️ Alerta' => '⚠️ Alerta',
  'Leída' => 'Leída',
  'No leída' => 'No leída',
  'id_notification) }}" class="text-blue-600 bg-blue-100 p-2 rounded-lg hover:bg-blue-200 transition-colors">' => 'id_notificación) }}" class="text-blue-600 bg-blue-100 p-2 rounded-lg hover:bg-blue-200 colores-de transición">',
  'id_notification) }}" method="POST" onsubmit="return confirm(\'¿Eliminar esta notificación?\')">
                                    @csrf
                                    @method(\'DELETE\')' => 'id_notification) }}" method="POST" onsubmit="return confirm(\'¿Eliminar esta notificación?\')">
                                    @csrf
                                    @method(\'DELETE\')',
  'No hay notificaciones registradas' => 'No hay notificaciones registradas',
  'Buscar usuario *' => 'Buscar usuario *',
  '(Escribe nombre, apellido o email)' => '(Escribe nombre, apellido o email)',
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
            submitBtn.innerHTML = \'' => '// Abrir modo
    function abrirModalNotificacion() {
        const modal = document.getElementById(\'modalNotificacion\');
        modal.classList.remove(\'oculto\');
        modal.classList.add(\'flex\');
        
        // Restablecer formulario
        formulario const = document.getElementById(\'formNotificacion\');
        formulario.reset();
        
        // Restablecer campos específicos
        document.getElementById(\'modalSelectUsuario\').classList.add(\'hidden\');
        document.getElementById(\'modalParaTodos\').checked = true;
        
        // Limpiar errores visuales si los hay
        entradas constantes = form.querySelectorAll(\'entrada, selección, área de texto\');
        entradas.forEach(entrada => {
            input.classList.remove(\'borde-rojo-500\');
        });
    }
    
    // Cerrar modal
    function cerrarModalNotificacion() {
        const modal = document.getElementById(\'modalNotificacion\');
        modal.classList.add(\'oculto\');
        modal.classList.remove(\'flex\');
    }
    
    // Mostrar/ocultar selector de usuario
    document.addEventListener(\'DOMContentLoaded\', función() {
        const radioButtons = document.querySelectorAll(\'input[nombre="destinatario"]\');
        botones de radio.forEach(radio => {
            radio.addEventListener(\'cambiar\', función() {
                const selectDiv = document.getElementById(\'modalSelectUsuario\');
                if (este.valor === \'individual\') {
                    selectDiv.classList.remove(\'oculto\');
                } más {
                    selectDiv.classList.add(\'oculto\');
                }
            });
        });
    });
    
    // Envío del formulario con AJAX
    const formNotificacion = document.getElementById(\'formNotificacion\');
    
    if (formularioNotificacion) {
        formNotificacion.addEventListener(\'enviar\', función asíncrona(e) {
            e.preventDefault();
            
            // Mostrar cargando en el botón
            const submitBtn = this.querySelector(\'botón[tipo="enviar"]\');
            const texto original = enviarBtn.innerHTML;
            enviarBtn.innerHTML = \'',
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
            submitBtn.disabled = verdadero;
            
            const formData = nuevo FormData (este);
            
            prueba {
                respuesta constante = esperar a buscar (esta.acción, {
                    método: \'POST\',
                    cuerpo: datos de formulario,
                    encabezados: {
                        \'X-Solicitado-Con\': \'XMLHttpRequest\',
                        \'Aceptar\': \'aplicación/json\'
                    }
                });
                
                datos constantes = espera respuesta.json();
                
                if (respuesta.ok && datos.éxito) {
                    // Éxito
                    aguardar Swal.fire ({
                        icono: \'éxito\',
                        título: \'¡Notificación enviada!\',
                        texto: datos.mensaje || \'La notificación se ha enviado correctamente\',
                        confirmarButtonColor: \'#1e3a5f\',
                        temporizador: 2000,
                        mostrar botón de confirmación: falso
                    });
                    
                    cerrarModalNotificacion();
                    ubicación.recargar();
                } más {
                    // Error de validación del servidor
                    let mensaje de error = \'\';
                    si (datos.errores) {
                        const lista de errores = Objeto.valores(datos.errores).plano();
                        errorMsg = errorList.join(\'\\n\');
                    } más {
                        mensaje de error = datos.mensaje || \'Error al enviar la notificación\';
                    }
                    
                    aguardar Swal.fire ({
                        icono: \'error\',
                        título: \'Error\',
                        texto: mensaje de error,
                        confirmarButtonColor: \'#d33\'
                    });
                    
                    // botón de restauración
                    submitBtn.innerHTML = texto original;
                    submitBtn.disabled = falso;
                }
            } captura (error) {
                console.error(\'Error:\', error);
                aguardar Swal.fire ({
                    icono: \'error\',
                    título: \'Error de conexión\',
                    texto: \'No se pudo conectar con el servidor. Verifica tu conexión.\',
                    confirmarButtonColor: \'#d33\'
                });
                
                // botón de restauración
                submitBtn.innerHTML = texto original;
                submitBtn.disabled = falso;
            }
        });
    }
    
    // Cerrar modal con ESC
    document.addEventListener(\'keydown\', función(evento) {
        if (event.key === \'Escape\') {
            const modal = document.getElementById(\'modalNotificacion\');
            if (modal && !modal.classList.contains(\'oculto\')) {
                cerrarModalNotificacion();
            }
        }
    });
    
    // Cerrar modal al hacer clic fuera
    const modal = document.getElementById(\'modalNotificacion\');
    si (modal) {
        modal.addEventListener(\'hacer clic\', función(e) {
            si (e.target === esto) {
                cerrarModalNotificacion();
            }
        });
    }
    //Variables para el buscador
let todosUsuarios = [];

// Cargar todos los usuarios al abrir el modal
function cargarListaUsuarios() {
    fetch(\'/admin/usuarios/listado-simple\')
        .entonces(respuesta => respuesta.json())
        .entonces(datos => {
            si (datos.éxito) {
                todosUsuarios = datos.usuarios;
            }
        })
        .catch(error => console.error(\'Error:\', error));
}

//Buscar usuarios en tiempo real
function buscarUsuariosNotificacion() {
    const searchTerm = document.getElementById(\'buscadorUsuarioNotificacion\').value.toLowerCase();
    const resultadosDiv = document.getElementById(\'resultadosUsuariosNotificacion\');
    
    si (término de búsqueda.longitud',
  '{
        const nombreCompleto = `${user.nombre} ${user.apellido}`.toLowerCase();
        const email = user.correo_electronico.toLowerCase();
        return nombreCompleto.includes(searchTerm) || email.includes(searchTerm);
    });
    
    if (filtrados.length === 0) {
        resultadosDiv.innerHTML = `' => '{
        const nombreCompleto = `${user.nombre} ${user.apellido}`.toLowerCase();
        const email = user.correo_electronico.toLowerCase();
        return nombreCompleto.includes(searchTerm) || email.includes(searchTerm);
    });
    
    if (filtrados.length === 0) {
        resultadosDiv.innerHTML = `',
  'No se encontraron usuarios' => 'No se encontraron usuarios',
  '`;
        resultadosDiv.classList.remove(\'hidden\');
        return;
    }
    
    resultadosDiv.innerHTML = filtrados.map(user => `' => '`;
        resultadosDiv.classList.remove(\'oculto\');
        devolver;
    }
    
    resultsDiv.innerHTML = filtrado.map(usuario => `',
  '${user.nombre} ${user.apellido}' => '${user.nombre} ${user.apellido}',
  '${user.correo_electronico}' => '${user.correo_electronico}',
  '`).join(\'\');
    
    resultadosDiv.classList.remove(\'hidden\');
}

// Seleccionar usuario
function seleccionarUsuarioNotificacion(id, nombre, apellido, email) {
    document.getElementById(\'usuarioIdSeleccionadoNotificacion\').value = id;
    document.getElementById(\'usuarioSeleccionadoNombre\').innerHTML = `' => '`).join(\'\');
    
    resultadosDiv.classList.remove(\'hidden\');
}

// Seleccionar usuario
function seleccionarUsuarioNotificacion(id, nombre, apellido, email) {
    document.getElementById(\'usuarioIdSeleccionadoNotificacion\').value = id;
    document.getElementById(\'usuarioSeleccionadoNombre\').innerHTML = `',
  '${nombre} ${apellido}`;
    document.getElementById(\'usuarioSeleccionadoEmail\').innerHTML = `' => '${nombre} ${apellido}`;
    document.getElementById(\'usuarioSeleccionadoEmail\').innerHTML = `',
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
}',
  '🔍 Escribe para buscar usuario...' => '🔍 Escribe para buscar usuario...',
  'Papelera' => 'Papelera',
  'Elementos eliminados recientemente' => 'Elementos eliminados recientemente',
  'Usuarios' => 'Usuarios',
  'Proyectos' => 'Proyectos',
  'Habilidades técnicas' => 'Habilidades técnicas',
  'Experiencias' => 'Experiencias',
  'Formación' => 'Capacitación',
  '👥 Usuarios ({{ $totalUsuarios }})' => '👥 Usuarios ({{ $totalUsuarios }})',
  '📁 Proyectos ({{ $totalProyectos }})' => '📁 Proyectos ({{ $totalProyectos }})',
  '🧠 Habilidades ({{ $totalHabilidades }})' => '🧠 Habilidades ({{ $totalSkills }})',
  '💼 Experiencias ({{ $totalExperiencias }})' => '💼 Experiencias ({{ $totalExperiencias }})',
  '🎓 Formación ({{ $totalEducaciones }})' => '🎓 Formación ({{ $totalEducaciones }})',
  'ELIMINADO POR' => 'BORRADO POR',
  'MOTIVO' => 'RAZÓN',
  'id_usuario) }}" method="POST">
                            @csrf' => 'user_id) }}" método="POST">
                            @csrf',
  'No hay usuarios en la papelera' => 'No hay usuarios en la papelera',
  'PROYECTO' => 'PROYECTO',
  'AUTOR' => 'AUTOR',
  'id_proyecto) }}" method="POST">
                            @csrf' => 'id_proyecto) }}" método="POST">
                            @csrf',
  'No hay proyectos en la papelera' => 'No hay proyectos en la papelera',
  'id_habilidad) }}" method="POST">
                            @csrf' => 'id_habilidad) }}" method="POST">
                            @csrf',
  'No hay habilidades en la papelera' => 'No hay habilidades en la papelera',
  'CARGO' => 'CARGA',
  'EMPRESA' => 'EMPRESA',
  'id_experiencia) }}" method="POST">
                            @csrf' => 'id_experiencia) }}" método="POST">
                            @csrf',
  'No hay experiencias en la papelera' => 'No hay experiencias en la papelera',
  'INSTITUCIÓN' => 'INSTITUCIÓN',
  'id_formacion) }}" method="POST">
                            @csrf' => 'id_formacion) }}" método="POST">
                            @csrf',
  'No hay formación en la papelera' => 'No hay formación en la papelera',
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
        PESTAÑAS.paraCada(t => {
            const idCap = t.charAt(0).toUpperCase() + t.slice(1);
            panel constante = document.getElementById(\'tab\' + idCap);
            const btn = document.getElementById(\'tab\' + idCap + \'Btn\');
            si (!panel || !btn) regresa;

            si (t === pestaña) {
                panel.classList.remove(\'oculto\');
                btn.classList.add(\'border-b-2\', \'border-[#1e3a5f]\', \'texto-[#1e3a5f]\');
                btn.classList.remove(\'texto-gris-500\');
            } más {
                panel.classList.add(\'oculto\');
                btn.classList.remove(\'border-b-2\', \'border-[#1e3a5f]\', \'texto-[#1e3a5f]\');
                btn.classList.add(\'texto-gris-500\');
            }
        });
    }

    const urlParams = nuevo URLSearchParams(ventana.ubicación.búsqueda);
    const tabParam = urlParams.get(\'tab\');
    if (tabParam && TABS.includes(tabParam)) {
        mostrarTab(tabParam);
    }',
  'Restaurar' => 'Restaurar',
  'Gestión de Proyectos' => 'Gestión de Proyectos',
  'Modera y administra todos los proyectos del sistema' => 'Modera y administra todos los proyectos del sistema',
  'Total Proyectos' => 'Total Proyectos',
  'Públicos' => 'Audiencias',
  'Privados' => 'Privado',
  'Todos los estados' => 'Todos los estados',
  'Pendiente' => 'Pendiente',
  'En progreso' => 'En progreso',
  'Completado' => 'Completado',
  'Cancelado' => 'Cancelado',
  'VISIBILIDAD' => 'VISIBILIDAD',
  'estado == \'completado\') bg-green-100 text-green-700
                                @elseif($proyecto->estado == \'en_progreso\') bg-blue-100 text-blue-700
                                @elseif($proyecto->estado == \'pendiente\') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($proyecto->estado) }}' => 'estado == \'completado\') bg-green-100 text-green-700
                                @elseif($proyecto->estado == \'en_progreso\') bg-blue-100 text-blue-700
                                @elseif($proyecto->estado == \'pendiente\') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($proyecto->estado) }}',
  'Público' => 'Público',
  'id_proyecto }})" 
                                    class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition" 
                                    title="Ver proyecto">' => 'id_proyecto }})" 
                                    class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 transición redondeada-lg" 
                                    title="Ver proyecto">',
  'id_proyecto }}, \'{{ addslashes($proyecto->nombre) }}\')"
                                        class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">' => 'id_proyecto }}, \'{{ addslashes($proyecto->nombre) }}\')"
                                        class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">',
  'id_proyecto) }}" method="POST" class="inline">
                                        @csrf' => 'id_proyecto) }}" método="POST" clase="inline">
                                        @csrf',
  'No hay proyectos registrados' => 'No hay proyectos registrados',
  'Ocultar proyecto' => 'Ocultar proyecto',
  'Vas a ocultar el proyecto' => 'Vas a ocultar el proyecto',
  '.
                    Indica el motivo (será visible para el dueño del proyecto en su panel).' => '.
                    Indica el motivo (será visible para el dueño del proyecto en su panel).',
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
    });',
  '#modalOcultarProyecto {
        display: none;
    }' => '#modalOcultarProyecto {
        pantalla: ninguna;
    }',
  'Buscar proyecto...' => 'Buscar proyecto...',
  'Ej. Contenido inapropiado, datos sensibles expuestos, denuncia recibida...' => 'Ej. Contenido inapropiado, datos sensibles expuestos, denuncia recibida...',
  'Ver proyecto' => 'Ver proyecto',
  'Mostrar proyecto' => 'Mostrar proyecto',
  'Detalle del Proyecto' => 'Detalle del Proyecto',
  'Información completa del proyecto' => 'Información completa del proyecto',
  'Volver a proyectos' => 'Volver a proyectos',
  'Creado por {{ $proyecto->perfil->usuario->nombre ?? \'Usuario\' }} 
                        el {{ $proyecto->created_at->format(\'d/m/Y H:i\') }}' => 'Creado por {{ $proyecto->perfil->usuario->nombre ?? \'Usuario\' }} 
                        el {{ $proyecto->created_at->format(\'d/m/Y H:i\') }}',
  'Tecnologías' => 'Tecnologías',
  'Enlace' => 'Enlace',
  'url_link }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                {{ $proyecto->url_link }}' => 'url_link }}" target="_blank" class="text-blue-600 hover:subrayado text-sm">
                                {{ $proyecto->url_link }}',
  'Visibilidad:' => 'Visibilidad:',
  'Fecha inicio:' => 'Fecha inicio:',
  'Fecha fin:' => 'Fecha fin:',
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
        modal.classList.remove(\'oculto\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'oculto\';
    }
    
    function cerrarModalVerProyecto() {
        const modal = document.getElementById(\'modalVerProyecto\');
        modal.classList.add(\'oculto\');
        modal.classList.remove(\'flex\');
        documento.body.style.overflow = \'\';
    }
    
    // Cerrar modal con ESC
    document.addEventListener(\'keydown\', función(evento) {
        if (event.key === \'Escape\') {
            const modal = document.getElementById(\'modalVerProyecto\');
            if (modal && !modal.classList.contains(\'oculto\')) {
                cerrarModalVerProyecto();
            }
        }
    });
    
    // Cerrar modal al hacer clic fuera
    const modalProyecto = document.getElementById(\'modalVerProyecto\');
    if (proyectomodal) {
        modalProyecto.addEventListener(\'clic\', función(e) {
            si (e.target === esto) {
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
        animación: desvanecimiento en 0,2 segundos;
    }
    
    @keyframes se desvanecen {
        de {
            opacidad: 0;
        }
        a {
            opacidad: 1;
        }
    }',
  'Gestión de Tecnologías' => 'Gestión de Tecnologías',
  'Administra el catálogo de tecnologías' => 'Administra el catálogo de tecnologías',
  'Nueva Tecnología' => 'Nueva Tecnología',
  'Buscar por nombre' => 'Buscar por nombre',
  'Todas' => 'Todo',
  'Período' => 'Período',
  'Cualquier fecha' => 'Cualquier fecha',
  'Últimas 24 horas' => 'Últimas 24 horas',
  'Últimos 7 días' => 'Últimos 7 días',
  'Últimos 30 días' => 'Últimos 30 días',
  'Ordenar por' => 'Ordenar por',
  'Fecha de creación' => 'Fecha de creación',
  'Dirección' => 'Dirección',
  'Ascendente' => 'Ascendente',
  'Descendente' => 'Descendiente',
  'Aplicar' => 'Aplicar',
  'Creada' => 'Creada',
  '#{{ $tecnologia->id_tecnologia }}' => '#{{ $tecnología->tecnología_id }}',
  'created_at->format(\'d/m/Y H:i\') }}">
                                {{ $tecnologia->created_at->diffForHumans() }}' => 'creado_en->formato(\'d/m/Y H:i\') }}">
                                {{ $tecnologia->created_at->diffForHumans() }}',
  'id_tecnologia }}, \'{{ $tecnologia->nombre }}\', \'{{ $tecnologia->categoria }}\')" 
                                    class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition">' => 'id_tecnologia }}, \'{{ $tecnologia->nombre }}\', \'{{ $tecnologia->categoria }}\')" 
                                    class="text-amarillo-600 hover:text-amarillo-900 bg-amarillo-100 hover:bg-amarillo-200 p-2 transición redondeada-lg">',
  'id_tecnologia) }}" method="POST" class="inline" data-confirm="¿Eliminar la tecnología «{{ $tecnologia->nombre }}»?">
                                @csrf
                                @method(\'DELETE\')' => 'id_tecnologia) }}" method="POST" class="inline" data-confirm="¿Eliminar la tecnología «{{ $tecnologia->nombre }}»?">
                                @csrf
                                @method(\'DELETE\')',
  'No hay tecnologías registradas con esos filtros' => 'No hay tecnologías registradas con esos filtros',
  'Categoría *' => 'Categoría *',
  'Seleccionar categoría' => 'Seleccionar categoría',
  '+ Crear nueva categoría' => '+ Crear nueva categoría',
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
    });' => 'function setCategoriaUI(valor) {
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
    });',
  'Ej: Laravel, React...' => 'Ej: Laravel, reacciona...',
  'Ej: Laravel, React, Python' => 'Ej: Laravel, reaccionar, Python',
  'Nombre de la nueva categoría' => 'Nombre de la nueva categoría',
  'Crear Usuario' => 'Crear Usuario',
  'Completa el formulario para registrar un nuevo usuario' => 'Completa el formulario para registrar un nuevo usuario',
  'Apellido' => 'Apellido',
  'Correo electrónico' => 'Correo electrónico',
  'Contraseña' => 'Contraseña',
  'Mínimo 6 caracteres' => 'Mínimo 6 caracteres',
  'Rol' => 'Role',
  'Usuario normal' => 'Usuario normal',
  'Administrador' => 'Administrador',
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
                submitBtn.innerHTML = \'' => 'función alternarContraseña(inputId, iconId) {
        entrada constante = document.getElementById(inputId);
        icono constante = document.getElementById(iconId);
        
        si (ingrese && icono) {
            if (entrada.tipo === \'contraseña\') {
                entrada.tipo = \'texto\';
                icon.classList.remove(\'fa-ojo\');
                icon.classList.add(\'fa-eye-slash\');
            } más {
                input.type = \'contraseña\';
                icon.classList.remove(\'fa-eye-slash\');
                icon.classList.add(\'fa-ojo\');
            }
        }
    }
    
    function cerrarModalUsuario() {
        const modal = document.getElementById(\'modalCrearUsuario\');
        si (modal) {
            modal.classList.add(\'oculto\');
            modal.classList.remove(\'flex\');
        }
    }
    
    // Envío del formulario con AJAX
    document.addEventListener(\'DOMContentLoaded\', función() {
        const formCrearUsuario = document.getElementById(\'formCrearUsuario\');
        
        if (formularioCrearUsuario) {
            formCrearUsuario.addEventListener(\'enviar\', función asíncrona(e) {
                e.preventDefault();
                
                const submitBtn = this.querySelector(\'botón[tipo="enviar"]\');
                const texto original = enviarBtn.innerHTML;
                enviarBtn.innerHTML = \'',
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
                submitBtn.disabled = verdadero;
                
                // Limpiar errores
                document.querySelectorAll(\'[class^="error-"]\').forEach(el => {
                    el.classList.add(\'oculto\');
                });
                document.querySelectorAll(\'#formCrearUsuario entrada, #formCrearUsuario selección\').forEach(entrada => {
                    input.classList.remove(\'borde-rojo-500\');
                });
                
                const formData = nuevo FormData (este);
                
                prueba {
                    respuesta constante = esperar a buscar (esta.acción, {
                        método: \'POST\',
                        cuerpo: datos de formulario,
                        encabezados: {
                            \'X-Solicitado-Con\': \'XMLHttpRequest\',
                            \'Aceptar\': \'aplicación/json\'
                        }
                    });
                    
                    datos constantes = espera respuesta.json();
                    
                    if (respuesta.ok && datos.éxito) {
                        aguardar Swal.fire ({
                            icono: \'éxito\',
                            título: \'¡Usuario creado!\',
                            texto: datos.mensaje,
                            confirmarButtonColor: \'#1e3a5f\',
                            temporizador: 2000,
                            mostrar botón de confirmación: falso
                        });
                        
                        cerrarModalUsuario();
                        ubicación.recargar();
                    } más {
                        si (datos.errores) {
                            for (const [clave, mensajes] de Object.entries(data.errors)) {
                                const errorElement = document.querySelector(`.error-${key}`);
                                si (elementoerror) {
                                    errorElement.textContent = mensajes[0];
                                    errorElement.classList.remove(\'oculto\');
                                    
                                    const inputElement = document.getElementById(clave);
                                    si (elemento de entrada) {
                                        inputElement.classList.add(\'borde-rojo-500\');
                                    }
                                }
                            }
                        } más {
                            aguardar Swal.fire ({
                                icono: \'error\',
                                título: \'Error\',
                                texto: datos.mensaje || \'Error al crear el usuario\',
                                confirmarButtonColor: \'#d33\'
                            });
                        }
                        
                        submitBtn.innerHTML = texto original;
                        submitBtn.disabled = falso;
                    }
                } captura (error) {
                    console.error(\'Error:\', error);
                    aguardar Swal.fire ({
                        icono: \'error\',
                        título: \'Error de conexión\',
                        text: \'No se pudo conectar con el servidor.\',
                        confirmarButtonColor: \'#d33\'
                    });
                    
                    submitBtn.innerHTML = texto original;
                    submitBtn.disabled = falso;
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
    }' => '/* Animación suave para el modal */
    #modalCrearUsuario {
        animación: desvanecimiento en 0,2 segundos;
    }
    
    @keyframes se desvanecen {
        de {
            opacidad: 0;
        }
        o {
            opacidad: 1;
        }
    }',
  'Nombre del usuario' => 'Nombre del usuario',
  'Apellido del usuario' => 'Apellido del usuario',
  'usuario@email.com' => 'usuario@correo electrónico.com',
  '+591 700 00000' => '+591 700 00000',
  'Editar Usuario' => 'Editar Usuario',
  'Modifica la información del usuario' => 'Modifica la información del usuario',
  'Volver a usuarios' => 'Volver a usuarios',
  'id_usuario) }}" method="POST">
                @csrf
                @method(\'PUT\')' => 'id_usuario) }}" método="POST">
                @csrf
                @método(\'PONER\')',
  'Datos Personales' => 'Datos Personales',
  'Información básica del usuario' => 'Información básica del usuario',
  'nombre) }}" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">' => 'nombre) }}" requerido
                                    class="w-full px-3 py-2 borde borde-gris-200 redondeado-lg texto-sm enfoque: contorno-ninguno enfoque: anillo-2 enfoque: anillo-azul-400 bg-blanco">',
  'apellido) }}" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">' => 'apellido) }}" requerido
                                    class="w-full px-3 py-2 borde borde-gris-200 redondeado-lg texto-sm enfoque: contorno-ninguno enfoque: anillo-2 enfoque: anillo-azul-400 bg-blanco">',
  'Correo Electrónico' => 'Correo Electrónico',
  'correo_electronico) }}" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">' => 'correo_electronico) }}" requerido
                                    class="w-full px-3 py-2 borde borde-gris-200 redondeado-lg texto-sm enfoque: contorno-ninguno enfoque: anillo-2 enfoque: anillo-azul-400 bg-blanco">',
  'telefono) }}"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white"
                                    placeholder="Ej: +34 123 456 789">' => 'teléfono) }}"
                                    class="w-full px-3 py-2 borde borde-gris-200 redondeado-lg texto-sm enfoque: contorno-ninguno enfoque: anillo-2 enfoque: anillo-azul-400 bg-blanco"
                                    marcador de posición="Ej: +34 123 456 789">',
  'Rol y Estado' => 'Rol y Estado',
  'Configuración de permisos' => 'Configuración de permisos',
  'is_admin ? \'selected\' : \'\' }}>Usuario normal' => 'es_admin? \'seleccionado\' : \'\' }}>Usuario normal',
  'is_admin ? \'selected\' : \'\' }}>Administrador' => 'es_admin? \'seleccionado\' : \'\' }}>Administrador',
  'estado == \'activo\' ? \'selected\' : \'\' }}>Activo' => 'estado == \'activo\' ? \'selected\' : \'\' }}>Activo',
  'estado == \'suspendido\' ? \'selected\' : \'\' }}>Suspendido' => 'estado == \'suspendido\' ? \'selected\' : \'\' }}>Suspendido',
  'Seguridad' => 'Seguridad',
  'Cambiar contraseña del usuario' => 'Cambiar contraseña del usuario',
  'Nueva Contraseña' => 'Nueva Contraseña',
  'Información del sistema' => 'Información del sistema',
  'Datos de registro' => 'Datos de registro',
  'ID de usuario:' => 'ID de usuario:',
  '#{{ $usuario->id_usuario }}' => '#{{ $usuario->user_id }}',
  'Registrado:' => 'Registrado:',
  'Último acceso:' => 'Último acceso:',
  'Guardar Cambios' => 'Guardar Cambios',
  'Ej: +34 123 456 789' => 'Eje: +34 123 456 789',
  'Dejar en blanco para mantener la actual' => 'Dejar en blanco para mantener la actual',
  'Usuarios del sistema' => 'Usuarios del sistema',
  'Activos' => 'Activos',
  'Inactivos' => 'Inactivos',
  'Nuevo Usuario' => 'Nuevo Usuario',
  'CORREO' => 'CORREO',
  'FECHA DE REGISTRO' => 'FECHA DE REGISTRO',
  'estado }}" data-nombre="{{ strtolower($usuario->nombre) }} {{ strtolower($usuario->apellido) }}" data-email="{{ strtolower($usuario->correo_electronico) }}">' => 'estado }}" data-nombre="{{ strtolower($usuario->nombre) }} {{ strtolower($usuario->apellido) }}" data-email="{{ strtolower($usuario->correo_electronico) }}">',
  'perfil->foto_perfil }}" alt="">
                                @else' => 'perfil->foto_perfil }}" alt="">
                                @else',
  'Activado' => 'Activado',
  'Inactivo' => 'Inactivo',
  'id_usuario }})" 
                                class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition" 
                                title="Ver perfil">' => 'id_usuario }})" 
                                class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 transición redondeada-lg" 
                                title="Ver perfil">',
  'id_usuario }})" 
                                class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition" 
                                title="Editar usuario">' => 'id_usuario }})" 
                                class="text-amarillo-600 hover:text-amarillo-900 bg-amarillo-100 hover:bg-amarillo-200 p-2 transición redondeada-lg" 
                                title="Editar usuario">',
  'id_usuario) }}" method="POST" class="inline">
                                    @csrf' => 'id_usuario) }}" método="POST" clase="en línea">
                                    @csrf',
  'is_admin ? \'Quitar admin\' : \'Hacer admin\' }}">' => 'is_admin ? \'Quitar admin\' : \'Hacer admin\' }}">',
  'Crear el primer usuario' => 'Crear el primer usuario',
  'Mostrando {{ $usuarios->firstItem() ?? 0 }} a {{ $usuarios->lastItem() ?? 0 }} de {{ $usuarios->total() }} usuarios' => 'Mostrando {{ $usuarios->firstItem() ?? 0 }} a {{ $usuarios->lastItem() ?? 0 }} de {{ $usuarios->total() }} usuarios',
  'Anterior' => 'Anterior',
  'previousPageUrl() }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Anterior' => 'anteriorPageUrl() }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 transición redondeada-lg">Anterior',
  'nextPageUrl() }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Siguiente' => 'nextPageUrl() }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transición">Siguiente',
  'Siguiente' => 'Siguiente',
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
        contenidoDiv.innerHTML = \'' => '// Función para abrir el modal de creación de usuario
    función openUserModal() {
        const modal = document.getElementById(\'modalCrearUser\');
        si (modal) {
            modal.classList.remove(\'oculto\');
            modal.classList.add(\'flex\');
        }
    }
    
    // Función para abrir modal VER con AJAX
    función openModalViewUser(id) {
        const modal = document.getElementById(\'modalVerUser\');
        const contentDiv = modal.querySelector(\'.p-6\');
        
        // Mostrar cargando
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
        
        modal.classList.remove(\'oculto\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'oculto\';
        
        // Cargar contenido vía AJAX
        fetch(`/admin/usuarios/${id}`, {
            encabezados: { \'X-Requested-With\': \'XMLHttpRequest\' }
        })
        .entonces(respuesta => respuesta.texto())
        .entonces(html => {
            analizador constante = nuevo DOMParser();
            const doc = parser.parseFromString(html, \'texto/html\');
            const nuevoContenido = doc.querySelector(\'#modalVerUsuario .p-6\');
            si (nuevoContenido) {
                contenidoDiv.innerHTML = nuevoContenido.innerHTML;
            } más {
                contenidoDiv.innerHTML = \'',
  'Error al cargar el perfil' => 'Error al cargar el perfil',
  '\';
            }
        })
        .catch(() => {
            contenidoDiv.innerHTML = \'' => '\';
            }
        })
        .catch(() => {
            contenidoDiv.innerHTML = \'',
  'Error de conexión' => 'Error de conexión',
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
    
    //Función para abrir modal EDITAR con AJAX
    función openModalEditUser(id) {
        const modal = document.getElementById(\'modalEditarUsuario\');
        const contentDiv = modal.querySelector(\'.p-6\');
        
        // Mostrar cargando
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
        
        modal.classList.remove(\'oculto\');
        modal.classList.add(\'flex\');
        document.body.style.overflow = \'oculto\';
        
        fetch(`/admin/usuarios/${id}/editar`, {
            encabezados: { \'X-Requested-With\': \'XMLHttpRequest\' }
        })
        .entonces(respuesta => respuesta.texto())
        .entonces(html => {
            analizador constante = nuevo DOMParser();
            const doc = parser.parseFromString(html, \'texto/html\');
            const nuevoContenido = doc.querySelector(\'#modalEditarUsuario .p-6\');
            si (nuevoContenido) {
                contenidoDiv.innerHTML = nuevoContenido.innerHTML;
                // Actualizar acción del formulario
                formulario const = contenidoDiv.querySelector(\'formulario\');
                if (formulario) form.action = `/admin/usuarios/${id}`;
                // Reejecutar scripts si es necesario (para togglePassword, etc.)
                const scripts = nuevoContenido.querySelectorAll(\'script\');
                scripts.forEach(script => {
                    const nuevoScript = document.createElement(\'script\');
                    si (script.src) {
                        nuevoScript.src = script.src;
                    } más {
                        nuevoScript.textContent = script.textContent;
                    }
                    documento.body.appendChild(nuevoScript);
                });
            } más {
                contenidoDiv.innerHTML = \'',
  'Error al cargar el formulario' => 'Error al cargar el formulario',
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
    ventana.cerrarModalVerUsuario = función() {
        const modal = document.getElementById(\'modalVerUsuario\');
        si (modal) {
            modal.classList.add(\'oculto\');
            modal.classList.remove(\'flex\');
            documento.body.style.overflow = \'\';
        }
    };
    
    ventana.cerrarModalEditarUsuario = función() {
        const modal = document.getElementById(\'modalEditarUsuario\');
        si (modal) {
            modal.classList.add(\'oculto\');
            modal.classList.remove(\'flex\');
            documento.body.style.overflow = \'\';
        }
    };
    
    ventana.cerrarModalUsuario = función() {
        const modal = document.getElementById(\'modalCrearUsuario\');
        si (modal) {
            modal.classList.add(\'oculto\');
            modal.classList.remove(\'flex\');
        }
    };
    
    // Cerrar modos con ESC
    document.addEventListener(\'keydown\', función(e) {
        if (e.key === \'Escape\') {
            cerrarModalVerUsuario();
            cerrarModalEditarUsuario();
            cerrarModalUsuario();
        }
    });
    
    // Cerrar al hacer clic fuera
    document.getElementById(\'modalVerUsuario\')?.addEventListener(\'clic\', función(e) {
        if (e.target === this) cerrarModalVerUsuario();
    });
    document.getElementById(\'modalEditarUsuario\')?.addEventListener(\'clic\', función(e) {
        if (e.target === this) cerrarModalEditarUsuario();
    });
    document.getElementById(\'modalCrearUsuario\')?.addEventListener(\'clic\', función(e) {
        if (e.target === this) cerrarModalUsuario();
    });
    
    // Buscador en tiempo real (sin cambios)
    const searchInput = document.getElementById(\'searchInput\');
    const estadoFilter = document.getElementById(\'estadoFilter\');
    const tableRows = document.querySelectorAll(\'tbody tr[data-estado]\');
    
    function filtrarTabla() {
        const término de búsqueda = searchInput.value.toLowerCase();
        const estadoValue = estadoFilter.valor;
        tableRows.forEach(fila => {
            const nombre = row.getAttribute(\'data-nombre\') || \'\';
            correo electrónico constante = fila.getAttribute(\'correo electrónico de datos\') || \'\';
            const estado = row.getAttribute(\'datos-estado\');
            const coincidenciasBuscar = término de búsqueda === \'\' || nombre.includes(términodebúsqueda) || correo electrónico.incluye (término de búsqueda);
            const coincidenciasEstado = estadoValue === \'todos\' || estado === estadoValue;
            row.style.display = (matchesSearch &&matchesEstado) ? \'\' : \'ninguno\';
        });
    }
    
    if (searchInput) searchInput.addEventListener(\'input\', filtrarTabla);
    if (estadoFilter) estadoFilter.addEventListener(\'cambiar\', filtrarTabla);',
  'Ver perfil' => 'Ver perfil',
  'Editar usuario' => 'Editar usuario',
  'Suspender usuario' => 'Suspender usuario',
  'Activar usuario' => 'Activar usuario',
  'perfil->foto_perfil }}" alt="Foto de {{ $usuario->nombre }}" class="h-16 w-16 rounded-full object-cover shadow-md">
        @else' => 'perfil->foto_perfil }}" alt="Foto de {{ $usuario->nombre }}" class="h-16 w-16 rounded-full object-cover shadow-md">
        @else',
  'Información Personal' => 'Información Personal',
  'Nombre:' => 'Nombre:',
  'Teléfono:' => 'Teléfono:',
  'Ubicación:' => 'Ubicación:',
  '({{ $usuario->motivo_suspension }})' => '({{ $usuario->motivo_suspension }})',
  'Inactivo (desactivado por el usuario)' => 'Inactivo (desactivado por el usuario)',
  'Rol:' => 'Role:',
  'Registro:' => 'Registro:',
  'Biografía' => 'Biografía',
  'Enlaces' => 'Enlaces',
  'url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-xs">' => 'URL }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 redondeado-texto completo-xs">',
  'Experiencia laboral' => 'Experiencia laboral',
  'Actual' => 'Actual',
  'Referencias:' => 'Referencias:',
  'No hay experiencia registrada' => 'No hay experiencia registrada',
  '({{ ($usuario->perfil->proyectos ?? collect())->count() }})' => '({{ ($usuario->perfil->proyectos ?? collect())->count() }})',
  'Destacado' => 'Destacado',
  'Privado' => 'Privado',
  'url_link }}" target="_blank" rel="noopener" class="text-xs text-blue-600 hover:underline pl-6 mt-1 inline-block">' => 'url_link }}" target="_blank" rel="noopener" class="text-xs text-blue-600 hover:underline pl-6 mt-1 inline-block">',
  'Gestión de cuenta' => 'Gestión de cuenta',
  'id_usuario) }}" method="POST">
                            @csrf' => 'user_id) }}" método="POST">
                            @csrf',
  'Desactivar cuenta' => 'Desactivar cuenta',
  'Activar cuenta' => 'Activar cuenta',
  '({{ ($usuario->perfil->habilidades ?? collect())->count() }})' => '({{ ($usuario->perfil->habilidades ?? collect())->count() }})',
  'Categoría: {{ $habilidad->categoria->nombre }}' => 'Categoría: {{ $habilidad->categoria->nombre }}',
  'No hay habilidades registradas' => 'No hay habilidades registradas',
  'Habilidades blandas' => 'Habilidades blandas',
  '({{ ($usuario->perfil->habilidadesBlandas ?? collect())->count() }})' => '({{ ($usuario->perfil->habilidadesBlandas ?? collect())->count() }})',
  'descripcion }}">
                            {{ $blanda->nombre }}' => 'descripcion }}">
                            {{ $blanda->nombre }}',
  'Formación académica' => 'Formación académica',
  '({{ ($usuario->perfil->formacionAcademica ?? collect())->count() }})' => '({{ ($usuario->perfil->formacionAcademica ?? collect())->count() }})',
  'No hay formación registrada' => 'No hay formación registrada',
  'Perfil de Usuario' => 'Perfil de Usuario',
  'Información detallada del usuario' => 'Información detallada del usuario',
  'perfil->foto_perfil }}" alt="Foto de {{ $usuario->nombre }}" class="h-16 w-16 rounded-full object-cover shadow-md">
                    @else' => 'perfil->foto_perfil }}" alt="Foto de {{ $usuario->nombre }}" class="h-16 w-16 rounded-full object-cover shadow-md">
                    @else',
  'url }}" target="_blank" rel="noopener"
                                           class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-xs">' => 'URL }}" target="_blank" rel="noopener"
                                           class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 redondeado-texto completo-xs">',
  'id_usuario) }}" method="POST">
                                        @csrf' => 'user_id) }}" método="POST">
                                        @csrf',
  'descripcion }}">
                                        {{ $blanda->nombre }}' => 'descripcion }}">
                                        {{ $blanda->nombre }}',
  '✕' => '✕',
  'Iniciar Sesión' => 'Iniciar Sesión',
  'Ingresa tus credenciales para acceder a tu cuenta' => 'Ingresa tus credenciales para acceder a tu cuenta',
  '¿Olvidaste tu contraseña?' => '¿Olvidaste tu contraseña?',
  'o continúa con' => 'o continúa con',
  'Continuar con GitHub' => 'Continuar con GitHub',
  'Continuar con Google' => 'Continuar con Google',
  'Continuar con LinkedIn' => 'Continuar con LinkedIn',
  '(Próximamente)' => '(Próximamente)',
  '¿No tienes una cuenta?' => '¿No tienes una cuenta?',
  'Regístrate aquí' => 'Regístrate aquí',
  'tu@email.com' => 'tu@correo electrónico.com',
  'Ingresa tu contraseña' => 'Ingresa tu contraseña',
  'Crear Cuenta' => 'Crear Cuenta',
  'Completa el formulario para registrarte en el sistema de portafolios' => 'Completa el formulario para registrarte en el sistema de portafolios',
  'Apellidos' => 'Apellidos',
  'Debe tener al menos 8 caracteres, una mayuscula, una minuscula, un numero y un simbolo.' => 'Debe tener al menos 8 caracteres, una mayuscula, una minuscula, un numero y un simbolo.',
  'Confirmar contraseña' => 'Confirmar contraseña',
  '¿Ya tienes una cuenta?' => '¿Ya tienes una cuenta?',
  'Inicia sesión' => 'Inicia sesión',
  'Tu nombre' => 'Tu nombre',
  'Tus apellidos' => 'Tus apellidos',
  'Minimo 8 caracteres' => 'Minimo 8 caracteres',
  'Repite tu contraseña' => 'Repite tu contraseña',
  'Portfolio Digital' => 'Portafolio Digital',
  'visibilidad ?? \'privado\';
    @endphp' => 'visibilidad ?? \'privado\';
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
        };' => '// Visibilidad actual del perfil (publico/privado) — usada por los flujos de creación
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
        };',
  'Submenu' => 'Submenú',
  'Mis Habilidades' => 'Mis Habilidades',
  'Experiencia Laboral' => 'Experiencia Laboral',
  'Formación Académica' => 'Formación Académica',
  'Mis Proyectos' => 'Mis Proyectos',
  'id_habilidad) : route(\'habilidades.store\') }}">

    @csrf

    @if(isset($habilidad))
        @method(\'PUT\')
    @endif' => 'id_habilidad) : route(\'habilidades.store\') }}">

    @csrf

    @if(isset($habilidad))
        @method(\'PUT\')
    @endif',
  'Nombre de la Habilidad' => 'Nombre de la Habilidad',
  'nombre ?? \'\') }}"
            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">' => 'nombre ?? \'\') }}"
            class="w-full px-3 py-2 borde borde-gris-200 redondeado-lg texto-sm enfoque: contorno-ninguno enfoque: anillo-2 enfoque: anillo-azul-400">',
  'Selecciona una categoría' => 'Selecciona una categoría',
  'id_categoria }}"
                    {{ old(\'categoria\', $habilidad->id_categoria ?? \'\') == $categoria->id_categoria ? \'selected\' : \'\' }}>
                    {{ $categoria->nombre }}' => 'id_categoria }}"
                    {{ old(\'categoria\', $habilidad->id_categoria ?? \'\') == $categoria->id_categoria ? \'selected\' : \'\' }}>
                    {{ $categoria->nombre }}',
  'Años de Experiencia' => 'Años de Experiencia',
  'anios_experiencia ?? \'\') }}"
            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">' => 'anios_experiencia?? \'\') }}"
            class="w-full px-3 py-2 borde borde-gris-200 redondeado-lg texto-sm enfoque: contorno-ninguno enfoque: anillo-2 enfoque: anillo-azul-400">',
  'Mínimo 20 caracteres, máximo 500' => 'Mínimo 20 caracteres, máximo 500',
  'Ej: React, Node.js, PostgreSQL' => 'Ej: Reaccionar, Node.js, PostgreSQL',
  'Ej: 3' => 'Ej: 3',
  'Describe tu experiencia y proyectos realizados...' => 'Describe tu experiencia y proyectos realizados...',
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
        if (parseInt(anios)',
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

})();',
  'count();
    $categoriasHab = $habilidades->pluck(\'id_categoria\')->unique()->count();
    $promedioAnios = $totalHab > 0
        ? round($habilidades->avg(\'anios_experiencia\'), 1)
        : 0;
@endphp' => 'count();
    $categoriasHab = $habilidades->pluck(\'id_categoria\')->unique()->count();
    $promedioAnios = $totalHab > 0
        ? round($habilidades->avg(\'anios_experiencia\'), 1)
        : 0;
@endphp',
  'Habilidades Técnicas' => 'Habilidades técnicas',
  'Administra tus habilidades técnicas y controla lo que muestras al mundo' => 'Administra tus habilidades técnicas y controla lo que muestras al mundo',
  'Nueva Habilidad' => 'Nueva Habilidad',
  'Todas las registradas' => 'Todas las registradas',
  'Categorías' => 'Categorías',
  'Distintas áreas cubiertas' => 'Distintas áreas cubiertas',
  'Promedio Años' => 'Promedio Años',
  'Años de experiencia promedio' => 'Años de experiencia promedio',
  'isEmpty() ? \'\' : \'hidden\' }} bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">' => '¿Está vacío()? \'\' : \'oculto\' }} bg-blanco redondeado-borde 2xl borde-gris-100 sombra-sm p-12 centro de texto">',
  'No tienes habilidades técnicas registradas aún' => 'No tienes habilidades técnicas registradas aún',
  'Comienza agregando tu primera habilidad técnica' => 'Comienza agregando tu primera habilidad técnica',
  'Agregar primera habilidad' => 'Agregar primera habilidad',
  'isEmpty() ? \'hidden\' : \'\' }}">
                @foreach($habilidades as $habilidad)' => 'isEmpty() ? \'hidden\' : \'\' }}">
                @foreach($habilidades as $habilidad)',
  'id_habilidad }}"
                     data-categoria-id="{{ $habilidad->id_categoria }}">' => 'id_habilidad }}"
                     data-categoria-id="{{ $habilidad->id_categoria }}">',
  'categoria->imagen ?? \'https://via.placeholder.com/100\' }}"
                             alt="{{ $habilidad->categoria->nombre }}"
                             class="h-14 w-14 rounded-full object-cover border-2 border-[#1e3a5f]/10">' => 'categoria->imagen ?? \'https://via.placeholder.com/100\' }}"
                             alt="{{ $habilidad->categoria->nombre }}"
                             class="h-14 w-14 rounded-full object-cover border-2 border-[#1e3a5f]/10">',
  'id_habilidad }}"
                            data-nombre="{{ $habilidad->nombre }}"
                            data-categoria="{{ $habilidad->id_categoria }}"
                            data-experiencia="{{ $habilidad->anios_experiencia }}"
                            data-descripcion="{{ $habilidad->descripcion }}">' => 'id_habilidad }}"
                            data-nombre="{{ $habilidad->nombre }}"
                            data-categoria="{{ $habilidad->id_categoria }}"
                            data-experiencia="{{ $habilidad->anios_experiencia }}"
                            data-descripcion="{{ $habilidad->descripcion }}">',
  'id_habilidad }}"
                              action="{{ route(\'habilidades.destroy\', $habilidad->id_habilidad) }}"
                              method="POST" class="flex-1">
                            @csrf
                            @method(\'DELETE\')' => 'id_habilidad }}"
                              action="{{ route(\'habilidades.destroy\', $habilidad->id_habilidad) }}"
                              method="POST" class="flex-1">
                            @csrf
                            @method(\'DELETE\')',
  'id_habilidad }})"
                                class="w-full flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">' => 'id_habilidad }})"
                                class="w-full flex items-center justificar-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transición">',
  'Habilidades Blandas' => 'Habilidades Blandas',
  'Selecciona hasta 6 habilidades interpersonales para mostrar en tu perfil' => 'Selecciona hasta 6 habilidades interpersonales para mostrar en tu perfil',
  'Aún no agregaste habilidades blandas' => 'Aún no agregaste habilidades blandas',
  'Agrega habilidades interpersonales para completar tu perfil' => 'Agrega habilidades interpersonales para completar tu perfil',
  'Registrar Habilidad' => 'Registrar Habilidad',
  'Completa los detalles de tu habilidad' => 'Completa los detalles de tu habilidad',
  'Selecciona hasta 6 habilidades' => 'Selecciona hasta 6 habilidades',
  'id_habilidad_blanda }}"
                        data-nombre="{{ strtolower($habilidadBlanda->nombre) }}"
                        data-seleccionada="{{ $estaSeleccionada ? \'1\' : \'0\' }}"
                    >
                        {{ $habilidadBlanda->nombre }}' => 'id_habilidad_blanda }}"
                        data-nombre="{{ strtolower($habilidadBlanda->nombre) }}"
                        data-seleccionada="{{ $estaSeleccionada ? \'1\' : \'0\' }}"
                    >
                        {{ $habilidadBlanda->nombre }}',
  'no hay habilidades blandas activas disponibles' => 'no hay habilidades blandas activas disponibles',
  'seleccionadas:' => 'seleccionado:',
  '/ 6' => '/ 6',
  'solo puedes seleccionar hasta 6 habilidades' => 'solo puedes seleccionar hasta 6 habilidades',
  'Guardar habilidades blandas' => 'Guardar habilidades blandas',
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
    constante máx = 6;

    function abrirModalHabilidadesBlandas() {
        document.getElementById(\'modal-habilidades-blandas\').classList.remove(\'hidden\');
        document.getElementById(\'modal-habilidades-blandas\').classList.add(\'flex\');
    }

    function cerrarModalHabilidadesBlandas() {
        document.getElementById(\'modal-habilidades-blandas\').classList.add(\'hidden\');
        document.getElementById(\'modal-habilidades-blandas\').classList.remove(\'flex\');
    }

    función alternarHabilidad(btn) {
        const id = btn.getAttribute(\'id-datos\');
        const mensajeLimite = document.getElementById(\'mensaje-limite\');
        const contadorWrapper = document.getElementById(\'contador-wrapper\');

        if (btn.classList.contains(\'bg-[#1e3a5f]\')) {
            btn.classList.remove(\'bg-[#1e3a5f]\', \'texto-blanco\', \'borde-[#1e3a5f]\');
            btn.classList.add(\'borde-gris-300\', \'texto-gris-700\');

            seleccionadas--;
            seleccionIds = seleccionIds.filter(i => i != id && i != parseInt(id));

            mensajeLimite.classList.add(\'oculto\');
            contadorWrapper.classList.remove(\'text-red-500\', \'font-bold\');

        } más {
            if (seleccionadas >= max) {
                mensajeLimite.classList.remove(\'oculto\');
                contadorWrapper.classList.add(\'text-red-500\', \'font-bold\');

                setTimeout(() => {
                    mensajeLimite.classList.add(\'oculto\');
                    contadorWrapper.classList.remove(\'text-red-500\', \'font-bold\');
                }, 2000);

                devolver;
            }

            btn.classList.add(\'bg-[#1e3a5f]\', \'texto-blanco\', \'borde-[#1e3a5f]\');
            btn.classList.remove(\'borde-gris-300\', \'texto-gris-700\');

            seleccionadas++;

            if (!seleccionIds.includes(id) && !seleccionIds.includes(parseInt(id))) {
                seleccionIds.push(id);
            }
        }

        document.getElementById(\'contador-habilidades\').innerText = seleccionadas;
    }

    function filtrarHabilidadesBlandas() {
        const texto = document.getElementById(\'buscar-habilidades-blandas\').value.toLowerCase();
        elementos const = document.querySelectorAll(\'.habilidad-blanda\');

        elementos.forEach(elemento => {
            const nombre = item.getAttribute(\'data-nombre\');
            item.style.display = nombre.includes(texto)? \'bloque en línea\': \'ninguno\';
        });
    }

    function guardarHabilidadesBlandas() {
        fetch("{{ ruta(\'habilidades-blandas.guardar\') }}", {
            método: "POST",
            encabezados: {
                "Tipo de contenido": "aplicación/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Aceptar": "aplicación/json"
            },
            cuerpo: JSON.stringify({ habilidades: seleccionIds })
        })
        .entonces(res => res.json())
        .entonces(datos => {
            si (datos.ok) {
                cerrarModalHabilidadesBlandas();
                ChipsBlandasEn actualizarVista();
                if (tipo de ventana.notificarItemPublicable === \'función\') {
                    window.notificarItemPublicable(\'blanda\');
                }
            } más {
                alert(\'No se pudieron guardar las habilidades blandas.\');
            }
        })
        .catch(() => {
            alert(\'Ocurrió un error al guardar las habilidades blandas.\');
        });
    }

    function actualizarChipsBlandasEnVista() {
        const display = document.getElementById(\'chips-blandas-display\');
        si (!display) regresa;

        const seleccionados = [...document.querySelectorAll(\'.habilidad-blanda\')]
            .filter(btn => btn.classList.contains(\'bg-[#1e3a5f]\'));

        if (seleccionados.longitud === 0) {
            display.innerHTML = `',
  '`;
            return;
        }

        const chips = seleccionados.map(btn =>
            `' => '`;
            devolver;
        }

        chips constantes = seleccionado.map(btn =>
            `',
  '${btn.textContent.trim()}' => '${btn.textContent.trim()}',
  '`
        ).join(\'\');

        display.innerHTML = `' => '`
        ).unirse(\'\');

        display.innerHTML = `',
  '${chips}' => '${fichas}',
  '`;
    }

    document.getElementById(\'abrir-modal-habilidades-blandas\')?.addEventListener(\'click\', abrirModalHabilidadesBlandas);' => '`;
    }

    document.getElementById(\'abrir-modal-habilidades-blandas\')?.addEventListener(\'click\', abreModalHabilidadesBlandas);',
  'Buscar habilidades...' => 'Buscar habilidades...',
  'Portafolio Principal' => 'Portafolio Principal',
  'Selecciona el contenido a publicar' => 'Selecciona el contenido a publicar',
  'Progreso' => 'Progreso',
  'Seleccionados' => 'Seleccionado',
  '0/0' => '0/0',
  'Publicar' => 'Publicar',
  'Seleccionar todas' => 'Seleccionar todas',
  'Deseleccionar todas' => 'Deseleccionar todas',
  'Habilidad' => 'Habilidad',
  'Nivel' => 'Nivel',
  'No tienes elementos en esta sección' => 'No tienes elementos en esta sección',
  'Agrégalos desde tu dashboard antes de publicar' => 'Agrégalos desde tu dashboard antes de publicar',
  'Cargando contenido...' => 'Cargando contenido...',
  'URL pública' => 'URL pública',
  'Vista previa' => 'Vista previa',
  'Copiar URL' => 'Copiar URL',
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
            listaBody.innerHTML = `' => '(función () {
    const csrf = document.querySelector(\'meta[name="csrf-token"]\')?.content ?? \'\';

    const modal = document.getElementById(\'modal-publicar\');
    const btnCerrar = document.getElementById(\'mp-cerrar\');
    const btnPublicar = document.getElementById(\'mp-publicar\');
    const tabsBtns = modal.querySelectorAll(\'.mp-tab\');
    const listaBody = document.getElementById(\'mp-lista-body\');
    const listaHeader = document.getElementById(\'mp-lista-header\');
    const colNombre = document.getElementById(\'mp-col-nombre\');
    const colDetalle= document.getElementById(\'mp-col-detalle\');
    const vacio = document.getElementById(\'mp-vacio\');
    const cargando = document.getElementById(\'mp-cargando\');
    const titulo = document.getElementById(\'mp-titulo-seccion\');
    const contador = document.getElementById(\'mp-contador\');
    const progreso = document.getElementById(\'mp-progreso\');
    const btnTodos = document.getElementById(\'mp-todos\');
    const btnNinguno= document.getElementById(\'mp-ninguno\');
    const urlLink = document.getElementById(\'mp-url\');
    const btnCopiar = document.getElementById(\'mp-copiar\');
    const btnVista = document.getElementById(\'mp-vista-previa\');

    // Estado: { técnicas:[{id,nombre,nivel,publicado}], blandas:[...], ... }
    let estado = {
        tecnicas: [], blandas: [], experiencia: [], educacion: [], proyectos: [],
    };
    let tabActual = \'todo\';

    const seccionesMeta = {
        tecnicas: { titulo: \'Habilidades Técnicas\', col1: \'Habilidad\', col2: \'Nivel\' },
        blandas: { titulo: \'Habilidades Blandas\', col1: \'Habilidad\', col2: \'\' },
        experiencia: { titulo: \'Experiencia Laboral\', col1: \'Carga\', col2: \'Empresa\' },
        educacion: { titulo: \'Formación Académica\', col1: \'Título\', col2: \'Detalle\' },
        proyectos: { titulo: \'Proyectos\', col1: \'Proyecto\', col2: \'Resumen\' },
    };

    función nivelClase(nivel) {
        cambiar (nivel) {
            caso \'Experto\': return \'bg-[#e11d48]/10 texto-[#e11d48]\';
            caso \'Avanzado\': return \'bg-[#1e3a5f]/10 texto-[#1e3a5f]\';
            caso \'Intermedio\': return \'bg-amber-100 text-amber-700\';
            predeterminado: devolver \'bg-gray-100 texto-gris-600\';
        }
    }

    window.abrirModalPublicar = función asíncrona () {
        modal.classList.remove(\'oculto\');
        document.body.style.overflow = \'oculto\';
        cargando.classList.remove(\'oculto\');
        listaBody.innerHTML = \'\';
        vacio.classList.add(\'oculto\');

        prueba {
            const res = await fetch(\'{{ ruta("cuenta.portafolio.datos") }}\', {
                encabezados: { \'Aceptar\': \'aplicación/json\' },
                credenciales: \'mismo origen\'
            });
            datos constantes = esperar res.json();
            if (!data.ok) arroja un nuevo Error(data.message || \'Error\');

            estado = {
                tecnicas: datos.tecnicas || [],
                blandas: data.blandas || [],
                experiencia: datos.experiencia || [],
                educacion: data.educacion || [],
                proyectos: datos.proyectos || [],
            };

            const baseUrl = ventana.ubicación.origen;
            const slug = datos.slug || \'\';
            urlLink.textContent = baseUrl + \'/\' + slug;
            urlLink.href = \'/\' + babosa;

            actualizarConteos();
            mostrarTab(\'todo\');
        } atrapar (e) {
            cargando.classList.add(\'oculto\');
            listaBody.innerHTML = `',
  'No se pudo cargar el contenido.' => 'No se pudo cargar el contenido.',
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

    función cerrarModal() {
        modal.classList.add(\'oculto\');
        documento.body.style.overflow = \'\';
    }
    btnClose.addEventListener(\'hacer clic\', closeModal);
    modal.addEventListener(\'hacer clic\', (e) => { if (e.target === modal) closeModal(); });

    función todas las secciones() {
        return [\'técnicas\',\'soft\',\'experiencia\',\'educación\',\'proyectos\'];
    }

    elementos de funciónDeTab(tab) {
        si (tab === \'todo\') {
            return allSections().flatMap(s => estado[s].map(it => ({ ...it, _section: s })));
        }
        devolver estado[tab].map(it => ({ ...it, _section: tab }));
    }

    función actualizarCounts() {
        letTotalGlobal = 0, cellGlobal = 0;
        todas las secciones().forEach(s => {
            const t = estado[s].longitud;
            const sel = estado[s].filtro(i => i.publicado).longitud;
            totalGlobal += t; celularGlobal += celda;
            const btn = modal.querySelector(`[data-mp-tab="${s}"] .mp-tab-count`);
            si (btn) btn.textContent = t;
        });
        const todoBtn = modal.querySelector(\'[data-mp-tab="todo"] .mp-tab-count\');
        if (todoBtn) todoBtn.textContent = totalGlobal;

        contador.textContent = `${selGlobal}/${totalGlobal}`;
        pct constante = totalGlobal === 0? 0 : Math.round((cellGlobal / totalGlobal) * 100);
        progreso.textContent = pct + \'%\';
    }

    función mostrarTab(tab) {
        TabuladorActual = tabulador;
        pestañasBtns.forEach(b => {
            const active = b.dataset.mpTab === pestaña;
            b.classList.toggle(\'texto-[#1e3a5f]\', activo);
            b.classList.toggle(\'border-[#e11d48]\', activo);
            b.classList.toggle(\'fuente-semibold\', activo);
            b.classList.toggle(\'text-gray-500\',! Activo);
        });

        constante meta = pestaña === \'todos\'
            ? { título: \'Todo el contenido\', col1: \'Artículo\', col2: \'Sección\' }
            : seccionesMeta[tab];
        título.textContenido = meta.título;
        colName.textContent = meta.col1;
        colDetails.textContent = meta.col2;

        elementos constantes = elementosDeTab(pestaña);
        cargando.classList.add(\'oculto\');
        listBody.innerHTML = \'\';
        si (elementos.longitud === 0) {
            vacio.classList.remove(\'oculto\');
            listHeader.classList.add(\'oculto\');
            devolver;
        }
        vacio.classList.add(\'oculto\');
        listHeader.classList.remove(\'oculto\');

        elementos.forEach(es => {
            fila constante = document.createElement(\'div\');
            row.className = \'mp-row grid grid-cols-[auto_1fr_auto] espacio-3 elementos-centro px-4 py-3 hover:bg-[#1e3a5f]/5 transición cursor-puntero\';
            fila.dataset.section = it._section;
            fila.conjunto de datos.id = it.id;

            constante marcado = it.publicado? \'comprobado\': \'\';
            dejar detalleHtml = \'\';
            si (tab === \'todo\') {
                etiqueta de sección constante = {
                    técnicas: \'Técnica\', suave: \'Suave\', experiencia: \'Experiencia\',
                    educación: \'Educación\', proyectos: \'Proyecto\'
                }[it._sección];
                detallesHtml = `',
  '${seccionLabel}' => '${seccionLabel}',
  '`;
            } else if (it._seccion === \'tecnicas\') {
                detalleHtml = `' => '`;
            } else if (it._seccion === \'tecnicas\') {
                detalleHtml = `',
  '${it.nivel}' => '${it.novela}',
  '`;
            } else if (it.detalle) {
                detalleHtml = `' => '`;
            } si no (it.detalle) {
                detalleHtml = `',
  '${it.detalle}' => '${el.detalle}',
  '`;
            } else {
                detalleHtml = \'\';
            }

            row.innerHTML = `' => '`;
            } más {
                detalleHtml = \'\';
            }

            fila.innerHTML = `',
  '${it.nombre ?? \'\'}' => '${it.nombre ?? \'\'}',
  '${detalleHtml}' => '${detallesHtml}',
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
            listaBody.appendChild(fila);
        });
    }

    listaBody.addEventListener(\'hacer clic\', (e) => {
        fila constante = e.target.closest(\'.mp-row\');
        si (! fila) regresa;
        sección const = fila.conjunto de datos.seccion;
        identificación constante = parseInt(row.dataset.id, 10);
        const item = estado[sección].find(i => i.id === id);
        si (!item) regresa;
        item.publicado = !item.publicado;

        cuadro constante = fila.querySelector(\'.mp-box\');
        const tick = box.querySelector(\'i\');
        if (item.publicado) {
            box.classList.add(\'bg-[#1e3a5f]\', \'border-[#1e3a5f]\');
            box.classList.remove(\'borde-gris-300\', \'bg-blanco\');
            tick.classList.remove(\'oculto\');
        } más {
            box.classList.remove(\'bg-[#1e3a5f]\', \'border-[#1e3a5f]\');
            box.classList.add(\'borde-gris-300\', \'bg-blanco\');
            tick.classList.add(\'oculto\');
        }
        actualizarConteos();
    });

    tabsBtns.forEach(b => b.addEventListener(\'click\', () => mostrarTab(b.dataset.mpTab)));

    btnTodos.addEventListener(\'hacer clic\', () => {
        const secciones = tabActual === \'todo\' ? todasLasSecciones() : [tabActual];
        secciones.forEach(s => estado[s].forEach(i => i.publicado = true));
        actualizarConteos();
        mostrarTab(tabActual);
    });
    btnNinguno.addEventListener(\'hacer clic\', () => {
        const secciones = tabActual === \'todo\' ? todasLasSecciones() : [tabActual];
        secciones.forEach(s => estado[s].forEach(i => i.publicado = false));
        actualizarConteos();
        mostrarTab(tabActual);
    });

    btnCopiar.addEventListener(\'hacer clic\', () => {
        navigator.clipboard.writeText(urlLink.textContent).luego(() => {
            const i = btnCopiar.querySelector(\'i\');
            i.classList.replace(\'lejos\', \'fas\');
            i.classList.replace(\'fa-copia\', \'fa-verificación\');
            setTimeout(() => { i.classList.replace(\'fas\',\'far\'); i.classList.replace(\'fa-check\',\'fa-copy\'); }, 1200);
        });
    });

    btnVista.addEventListener(\'hacer clic\', () => {
        carga útil constante = {};
        todasLasSecciones().forEach(s => {
            payload[s] = estado[s].filter(i => i.publicado).map(i => i.id);
        });

        const textoOriginal = btnVista.innerHTML;
        btnVista.disabled = verdadero;
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

        fetch(\'{{ ruta("cuenta.portafolio.preview") }}\', {
            método: \'POST\',
            encabezados: { \'X-CSRF-TOKEN\': csrf, \'Tipo de contenido\': \'aplicación/json\', \'Aceptar\': \'aplicación/json\' },
            credenciales: \'mismo origen\',
            cuerpo: JSON.stringify (carga útil)
        })
        .entonces(r => r.json())
        .entonces(res => {
            btnVista.disabled = falso;
            btnVista.innerHTML = textoOriginal;
            if (!res.ok || !res.portafolio) {
                Swal.fire({ icon: \'error\', title: \'No se pudo cargar la vista previa\', text: res.message || \'\', confirmButtonColor: \'#1e3a5f\' });
                regresar;
            }
            if (tipo de ventana.abrirModalPortafolio === \'función\') {
                window.abrirModalPortafolio({ datos: res.portafolio, vista previa: verdadero });
            }
        })
        .catch(() => {
            btnVista.disabled = falso;
            btnVista.innerHTML = textoOriginal;
            Swal.fire({ icon: \'error\', title: \'Error de conexión\', text: \'No se pudo obtener la vista previa.\', confirmButtonColor: \'#1e3a5f\' });
        });
    });

    btnPublicar.addEventListener(\'hacer clic\', () => {
        carga útil constante = {};
        todasLasSecciones().forEach(s => {
            payload[s] = estado[s].filter(i => i.publicado).map(i => i.id);
        });

        btnPublicar.disabled = verdadero;
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

        fetch(\'{{ ruta("cuenta.portafolio.publicar") }}\', {
            método: \'PONER\',
            encabezados: { \'X-CSRF-TOKEN\': csrf, \'Tipo de contenido\': \'aplicación/json\', \'Aceptar\': \'aplicación/json\' },
            credenciales: \'mismo origen\',
            cuerpo: JSON.stringify (carga útil)
        })
        .entonces(r => r.json())
        .entonces(res => {
            btnPublicar.disabled = falso;
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
                    html: `' => 'Publicar\';
            si (res.ok) {
                cerrarModal();
                if (tipo de ventana.aplicarVisibilidadPublica === \'función\') {
                    ventana.applyPublicVisibility();
                }

                // Recalcular banner "elementos no publicados"
                aviso const = document.getElementById(\'aviso-sin-publish\');
                const countEl = document.getElementById(\'aviso-sin-publicar-count\');
                if (advertencia && countEl) {
                    const sinPublicar = TodasLasSecciones()
                        .flatMap(s => estado[s])
                        .filter(it => !it.published).length;
                    countEl.textContent = sinPublish;
                    si (sinPublish > 0) {
                        advertencia.classList.remove(\'oculto\');
                        aviso.classList.add(\'flex\');
                    } más {
                        aviso.classList.add(\'oculto\');
                        advertencia.classList.remove(\'flex\');
                    }
                }
                Tragar.fuego({
                    icono: \'éxito\',
                    título: \'¡Portafolio publicado!\',
                    text: \'Su perfil ahora es público con contenido seleccionado.\',
                    confirmarButtonColor: \'#1e3a5f\',
                    temporizador: 2200,
                    mostrar botón de confirmación: falso
                });
            } else if (res.code === \'perfil_incompleto\') {
                Tragar.fuego({
                    icono: \'información\',
                    título: \'Tu perfil todavía está vacío\',
                    HTML:`',
  'Para publicar tu portafolio, primero debes registrar al menos una de estas cosas:' => 'Para publicar tu portafolio, primero debes registrar al menos una de estas cosas:',
  'Una' => 'Una',
  'biografía' => 'biografía',
  'proyecto' => 'proyecto',
  'experiencia laboral' => 'experiencia laboral',
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
                    confirmarButtonColor: \'#1e3a5f\',
                    confirmButtonText: \'Entendido\'
                });
            } más {
                Swal.fire({ icon: \'error\', title: \'Error\', text: res.message ?? \'No se pudo publicar.\', confirmButtonColor: \'#1e3a5f\' });
            }
        })
        .catch(() => {
            btnPublicar.disabled = falso;
            btnPublicar.innerHTML = \'',
  'Publicar\';
            Swal.fire({ icon: \'error\', title: \'Error de conexión\', confirmButtonColor: \'#1e3a5f\' });
        });
    });
})();' => 'Publicar\';
            Swal.fire({ icon: \'error\', title: \'Error de conexión\', confirmButtonColor: \'#1e3a5f\' });
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

{{-- Separador visual --}}' => 'where(\'id_usuario\', $userId)->first();
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

{{-- Separador visual --}}',
  'Configuración de cuenta' => 'Configuración de cuenta',
  'Cambiar contraseña' => 'Cambiar contraseña',
  'Usa una contraseña segura que no uses en otros sitios' => 'Usa una contraseña segura que no uses en otros sitios',
  'Contraseña actual' => 'Contraseña actual',
  'Nueva contraseña' => 'Nueva contraseña',
  'Confirmar nueva contraseña' => 'Confirmar nueva contraseña',
  'Mínimo 8 caracteres, una mayúscula, un número y un símbolo.' => 'Mínimo 8 caracteres, una mayúscula, un número y un símbolo.',
  'Visibilidad del perfil' => 'Visibilidad del perfil',
  'Controla quién puede ver tu portafolio' => 'Controla quién puede ver tu portafolio',
  '0) ? \'flex\' : \'hidden\' }} mt-4 items-center gap-3 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3">' => '0)? \'flex\': \'oculto\' }} mt-4 elementos-centro espacio-3 bg-ámbar-50 borde borde-ámbar-200 redondeado-xl px-4 py-3">',
  'Tienes' => 'Tienes',
  'elemento(s) sin publicar' => 'elemento(s) sin publicar',
  'Actualiza tu publicación para mostrarlos en tu portafolio público.' => 'Actualiza tu publicación para mostrarlos en tu portafolio público.',
  'Actualizar publicación' => 'Actualizar publicación',
  'Zona de peligro' => 'Zona de peligro',
  'Acción sensible sobre tu cuenta' => 'Acción sensible sobre tu cuenta',
  'Perderás el acceso a tu cuenta y tu portafolio dejará de ser visible. Tus datos se conservan, pero no podrás volver a iniciar sesión.' => 'Perderás el acceso a tu cuenta y tu portafolio dejará de ser visible. Tus datos se conservan, pero no podrás volver a iniciar sesión.',
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
        badge.innerHTML   = \'' => '(función () {
    const csrf = document.querySelector(\'meta[name="csrf-token"]\')?.content ?? \'\';

    // ── Ver / ocultar contraseña ───────────────────── ──────────────────────
    window.togglePasswordVisibility = función (btn) {
        entrada constante = btn.closest(\'.relative\').querySelector(\'entrada\');
        icono constante = btn.querySelector(\'i\');
        const mostrar = input.type === \'contraseña\';
        input.type = mostrar ? \'texto\': \'contraseña\';
        icon.classList.toggle(\'fa-eye\', !mostrar);
        icon.classList.toggle(\'fa-eye-slash\', mostrar);
    };

    // ── Cambiar contraseña ──────────────────────── ─────────────────────────
    ventana.confirmarCambiarContrasenia = funcion () {
        formulario const = document.getElementById(\'formulario-contrasenia\');
        const actual = form.querySelector(\'[name="contrasenia_actual"]\').value;
        const nueva = form.querySelector(\'[nombre="nueva_contrasenia"]\').value;
        const confirmacion = form.querySelector(\'[name="nueva_contrasenia_confirmation"]\').value;

        if (!actual || !nueva || !confirmacion) {
            Swal.fire({ icon: \'warning\', title: \'Campos requeridos\', text: \'Completa todos los campos de contraseña.\', confirmButtonColor: \'#1e3a5f\' });
            regresar;
        }

        Tragar.fuego({
            título: \'¿Cambiar contraseña?\',
            text: \'Tu contraseña actual quedará invalidada.\',
            icono: \'pregunta\',
            showCancelButton: verdadero,
            confirmarButtonColor: \'#1e3a5f\',
            cancelarButtonColor: \'#6b7280\',
            confirmButtonText: \'Sí, cambiar\',
            cancelarButtonText: \'Cancelar\'
        }).entonces(resultado => {
            si (!resultado.isConfirmed) regresa;

            fetch(\'{{ ruta("cuenta.contrasenia") }}\', {
                método: \'PONER\',
                encabezados: { \'X-CSRF-TOKEN\': csrf, \'Tipo de contenido\': \'aplicación/json\', \'Aceptar\': \'aplicación/json\' },
                cuerpo: JSON.stringify({ contrasenia_actual: actual, nueva_contrasenia: nueva, nueva_contrasenia_confirmation: confirmacion })
            })
            .entonces(r => r.json())
            .entonces(res => {
                si (res.ok) {
                    formulario.reset();
                    Swal.fire({ icon: \'success\', title: \'¡Contraseña cambiada!\', text: \'Tu contraseña fue actualizada correctamente.\', confirmButtonColor: \'#1e3a5f\' });
                } más {
                    mensajes constantes = res.errores
                        ? Objeto.valores(res.errores).plano().join(\'\\n\')
                        : (res.message ?? \'Error al cambiar la contraseña.\');
                    Swal.fire({ icono: \'error\', título: \'Error\', texto: mensajes, confirmButtonColor: \'#1e3a5f\' });
                }
            })
            .catch(() => Swal.fire({ icon: \'error\', title: \'Error de conexión\', text: \'No se pudo conectar al servidor.\', confirmButtonColor: \'#1e3a5f\' }));
        });
    };

    // ── Aplicar UI público ──────────────────────── ─────────────────────────
    ventana.aplicarVisibilidadPublica = funcion () {
        const btn = document.getElementById(\'btn-visibilidad\');
        const punto = document.getElementById(\'alternar-punto\');
        const etiqueta = document.getElementById(\'label-visibilidad\');
        const desc = document.getElementById(\'desc-visibilidad\');
        const insignia = document.getElementById(\'badge-visibilidad\');
        btn.dataset.actual = \'público\';
        btn.classList.replace(\'bg-gray-300\', \'bg-[#1e3a5f]\');
        dot.classList.replace(\'traducir-x-1\', \'traducir-x-8\');
        label.textContent = \'Perfil público\';
        desc.textContent = \'Cualquier persona puede ver tu portafolio\';
        badge.className = \'elementos flexibles en línea-espacio central-1.5 texto-xs fuente-medio px-2.5 py-1 redondeado-completo bg-[#1e3a5f]/10 texto-[#1e3a5f]\';
        insignia.innerHTML = \'',
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
                    badge.innerHTML   = \'' => 'Público\';
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
                    badge.innerHTML   = \'',
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
            html: `' => 'Privado\';
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
            html: `',
  'Tu cuenta quedará' => 'Tu cuenta quedará',
  'inactiva' => 'inactiva',
  'no podrás volver a iniciar sesión' => 'no podrás volver a iniciar sesión',
  '. Tus datos se conservan, pero el acceso queda bloqueado.' => '. Tus datos se conservan, pero el acceso queda bloqueado.',
  'Ingresa tu' => 'Ingresa tu',
  'contraseña actual' => 'contraseña actual',
  'para confirmar:' => 'para confirmar:',
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
            icono: \'advertencia\',
            showCancelButton: verdadero,
            confirmarButtonColor: \'#e11d48\',
            cancelarButtonColor: \'#6b7280\',
            confirmButtonText: \'Desactivar cuenta\',
            cancelButtonText: \'Cancelar\',
            preconfirmar: () => {
                const val = document.getElementById(\'swal-confirmar-desactivar\').value;
                si (!val) {
                    Swal.showValidationMessage(\'Debes ingresar tu contraseña para confirmar\');
                    devolver falso;
                }
                valor de retorno;
            }
        }).entonces(resultado => {
            si (!resultado.isConfirmed) regresa;

            fetch(\'{{ ruta("cuenta.desactivar") }}\', {
                método: \'PONER\',
                encabezados: { \'X-CSRF-TOKEN\': csrf, \'Tipo de contenido\': \'aplicación/json\', \'Aceptar\': \'aplicación/json\' },
                cuerpo: JSON.stringify({ contrasenia: resultado.valor })
            })
            .entonces(r => r.json())
            .entonces(res => {
                si (res.ok) {
                    Tragar.fuego({
                        icono: \'éxito\',
                        título: \'Cuenta desactivada\',
                        texto: \'Tu cuenta ha sido desactivada. Serás redirigido.\',
                        confirmarButtonColor: \'#1e3a5f\',
                        temporizador: 2500,
                        mostrar botón de confirmación: falso
                    }).luego(() => { ventana.ubicación.href = res.redirect ?? \'/\'; });
                } más {
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
@endphp' => 'where(\'id_usuario\', $userId)->first();
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
@endphp',
  'Administra tu historial profesional y controla lo que muestras al mundo' => 'Administra tu historial profesional y controla lo que muestras al mundo',
  'Nueva Experiencia' => 'Nueva Experiencia',
  'Total Experiencias' => 'Total Experiencias',
  'Trabajo Actual' => 'Trabajo Actual',
  'Posición activa' => 'Posición activa',
  'Finalizadas' => 'Finalizado',
  'Experiencias completadas' => 'Experiencias completadas',
  'No tienes experiencias registradas aún' => 'No tienes experiencias registradas aún',
  'Comienza agregando tu primera experiencia laboral' => 'Comienza agregando tu primera experiencia laboral',
  'Agregar primera experiencia' => 'Agregar primera experiencia',
  'isEmpty() ? \'hidden\' : \'\' }}">
            @foreach($experiencias as $exp)
            @php
                $esActual = (bool) $exp->trabajo_actual;
                $badgeClass = $esActual ? \'bg-[#1e3a5f]/10 text-[#1e3a5f]\' : \'bg-gray-100 text-gray-600\';
                $badgeLabel = $esActual ? \'actual\' : \'finalizada\';
            @endphp' => '¿Está vacío()? \'oculto\': \'\' }}">
            @foreach($experiencias como $exp)
            @php
                $esActual = (bool) $exp->trabajo_actual;
                $badgeClass = $esActual ? \'bg-[#1e3a5f]/10 texto-[#1e3a5f]\' : \'bg-gray-100 texto-gris-600\';
                $badgeLabel = $esActual ? \'actual\' : \'finalizada\';
            @endphp',
  'id_experiencia }}"
                 data-trabajo-actual="{{ $esActual ? \'1\' : \'0\' }}">

                {{-- Cargo + badge --}}' => 'id_experiencia }}"
                 data-trabajo-actual="{{ $esActual ? \'1\' : \'0\' }}">

                {{-- Cargo + badge --}}',
  'Actualidad' => 'Actualidad',
  'Referencias' => 'Referencias',
  'Proyectos relacionados' => 'Proyectos relacionados',
  'id_experiencia }}">
                        @foreach($proyectosExp as $proy)' => 'id_experiencia }}">
                        @foreach($proyectosExp as $proy)',
  'id_proyecto }}); return false;"
                           class="flex items-center gap-1.5 text-xs text-[#1e3a5f] hover:text-[#e11d48] transition-colors group">' => 'id_proyecto }}); devolver falso;"
                           class="elementos flexibles-centro espacio-1.5 texto-xs texto-[#1e3a5f] hover:text-[#e11d48] grupo de colores de transición">',
  'id_experiencia }}">' => 'id_experiencia }}">',
  'id_experiencia }})"
                        class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">' => 'id_experiencia }})"
                        class="flex-1 elementos flexibles-centro justificar-centro espacio-1.5 texto-xs bg-[#e11d48] hover:bg-rojo-600 texto-blanco px-3 py-1.5 transición redondeada-lg">',
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
@endphp' => 'where(\'id_usuario\', $userId)->first();
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
@endphp',
  'Administra tu historial educativo y controla lo que muestras al mundo' => 'Administra tu historial educativo y controla lo que muestras al mundo',
  'Nueva Formación' => 'Nueva Formación',
  'Total Formaciones' => 'Total Formaciones',
  'En Curso' => 'En Curso',
  'Actualmente estudiando' => 'Actualmente estudiando',
  'Completadas' => 'Terminado',
  'Formaciones finalizadas' => 'Formaciones finalizadas',
  'No tienes formaciones registradas aún' => 'No tienes formaciones registradas aún',
  'Comienza agregando tu primera formación académica' => 'Comienza agregando tu primera formación académica',
  'Agregar primera formación' => 'Agregar primera formación',
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
            @endphp' => '¿Está vacío()? \'oculto\': \'\' }}">
            @foreach($educaciones como $edu)
            @php
                $enCurso = is_null($edu->end_date);
                $nivelColores = [
                    \'Técnico\' => \'bg-orange-100 text-orange-700\',
                    \'Tecnólogo\' => \'bg-amarillo-100 texto-amarillo-700\',
                    \'Pregrado\' => \'bg-blue-100 text-blue-700\',
                    \'Postgrado\' => \'bg-indigo-100 text-indigo-700\',
                    \'Maestría\' => \'bg-purple-100 text-purple-700\',
                    \'Doctorado\' => \'bg-pink-100 text-pink-700\',
                    \'Diplomado\' => \'bg-teal-100 text-teal-700\',
                    \'Curso\' => \'bg-gray-100 text-gray-600\',
                ];
                $levelClass = $levelColors[$edu->level] ?? \'bg-azul-100 texto-azul-700\';
            @endphp',
  'id_formacion }}"
                 data-en-curso="{{ $enCurso ? \'1\' : \'0\' }}">

                {{-- Título + nivel --}}' => 'id_formacion }}"
                 data-en-curso="{{ $enCurso ? \'1\' : \'0\' }}">

                {{-- Título + nivel --}}',
  'En curso' => 'En curso',
  'id_formacion }})"
                        class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">' => 'id_formacion }})"
                        class="flex-1 elementos flexibles-centro justificar-centro espacio-1.5 texto-xs bg-[#e11d48] hover:bg-rojo-600 texto-blanco px-3 py-1.5 transición redondeada-lg">',
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
    if (!enCurso && fechaFin && fechaFin' => '// ============================================================
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
    if (!enCurso && fechaFin && fechaFin',
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

    return `',
  '${titulo}' => '${título}',
  '${nivel}' => '${nivel}',
  '${institucion}' => '${institución}',
  '${fechaInicioStr} – ${fechaFinStr}' => '${fechaInicioStr} – ${fechaFinStr}',
  '${descripcion ? `' => '${descripcion ? `',
  '${descripcion}' => '${descripcion}',
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

// ==============================================================
// TOSTADO
// ==============================================================
function mostrarToastEdu(mensaje, tipo = \'éxito\') {
    let contenedor = document.getElementById(\'toastContainer\');
    si (! contenedor) {
        contenedor = document.createElement(\'div\');
        contenedor.id = \'tostadaContenedor\';
        container.className = \'fijo abajo-4 derecha-4 z-[70] espacio-y-2\';
        documento.body.appendChild(contenedor);
    }
    const brindis = document.createElement(\'div\');
    const bg = tipo === \'éxito\' ? \'bg-verde-500\' : \'bg-rojo-500\';
    const ico = tipo === \'éxito\' ? \'fa-check-circle\' : \'fa-exclamation-circle\';
    tostado.className = `${bg} texto-blanco px-6 py-3 redondeado-lg sombra-lg texto-sm flex elementos-centro espacio-2`;
    brindis.innerHTML = `',
  '${mensaje}' => '${mensaje}',
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
    contenedor.appendChild(tostada);
    setTimeout(() => {
        brindis.estilo.opacidad = \'0\';
        brindis.style.transform = \'translateX(100%)\';
        roast.style.transition = \'todos los 0.3s facilitan\';
        setTimeout(() => { brindis.remove(); if (!container.children.length) contenedor.remove(); }, 300);
    }, 3000);
}

// ==============================================================
// ENVIAR FORMULARIO (GUARDAR)
// ==============================================================
function enviarEducacion() {
    const btnGuardar = document.querySelector(\'#modalEducacion boton[onclick="confirmarGuardarEducacion()"]\');
    const textoOriginal = btnGuardar.innerHTML;
    btnGuardar.disabled = verdadero;
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
}' => 'Mirando...\';

    const enCurso = document.getElementById(\'edu_en_curso\').checked;
    datos constantes = {
        título: document.getElementById(\'edu_title\').valor,
        institución: document.getElementById(\'edu_institution\').valor,
        nivel: document.getElementById(\'edu_level\').valor,
        date_this: document.getElementById(\'edu_date_this\').valor,
        fecha_final: ¿en progreso? nulo: document.getElementById(\'edu_date_end\').valor,
        descripción: document.getElementById(\'edu_description\').valor,
        in_current: actual? 1: 0,
    };

    url const = educaciónEditingId? `/perfil/educación/${educaciónEditingId}` : \'/perfil/educación\';
    método constante = educaciónEditingId? \'PONER\' : \'POST\';

    buscar(url, {
        método,
        encabezados: {
            \'Tipo de contenido\': \'aplicación/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[nombre="csrf-token"]\').content,
        },
        cuerpo: JSON.stringify(datos),
    })
    .entonces(r => {
        si (r.estado === 422) {
            devolver r.json().entonces(err => {
                mensajes constantes = err.errors? Object.values(err.errors).flat() : [err.message ?? \'Error de validación\'];
                resaltaErrorEducation(\'edu_title\', mensajes[0]);
                lanzar nuevo Error(\'validación\');
            });
        }
        devolver r.json();
    })
    .entonces(res => {
        si (res.éxito) {
            const edu = res.educación;
            const list = document.getElementById(\'educaciones-list\');
            const cardHTML = buildCardHTMLEducation(edu);

            if (educaciónEditingId) {
                const existente = lista?.querySelector(`[data-training-id="${edu.training_id}"]`);
                si (existente) existente.outerHTML = cardHTML;
            } más {
                lista?.insertAdjacentHTML(\'después del comienzo\', cardHTML);
                if (tipo de ventana.notifyItemPublishable === \'función\') {
                    window.notifyPublishableItem(\'educación\');
                }
            }

            recalcularEstadísticasEducación();
            closeEducaciónModal();
            showToastEdu(\'Entrenamiento guardado correctamente\', \'éxito\');
        } más {
            showToastEdu(res.error || \'Error al guardar\', \'error\');
        }
    })
    .catch(err => {
        if (mensaje de error! == \'validación\') {
            consola.error(err);
            showToastEdu(\'Hubo un problema al guardar\', \'error\');
        }
    })
    .finalmente(() => {
        btnGuardar.disabled = falso;
        btnGuardar.innerHTML = textoOriginal;
    });
}

// ==============================================================
// BORRAR
// ==============================================================
función confirmarDeleteEducation(id) {
    CONFIRM_CONFIG_EDUCATION.delete.action = () => ejecutarDeleteEducation(id);
    showEducationConfirmation(\'eliminar\');
}

función ejecutarDeleteEducación(id) {
    fetch(`/perfil/educación/${id}`, {
        método: \'ELIMINAR\',
        encabezados: {
            \'Tipo de contenido\': \'aplicación/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[nombre="csrf-token"]\').content,
        },
    })
    .entonces(r => r.json())
    .entonces(res => {
        si (res.éxito) {
            tarjeta const = document.querySelector(`[data-training-id="${id}"]`);
            if (tarjeta) card.remove();
            recalcularEstadísticasEducación();
            showToastEdu(\'Entrenamiento eliminado correctamente\', \'éxito\');
        } más {
            showToastEdu(res.error || \'Error al eliminar\', \'error\');
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
    if (!trabajoActual && fechaFin && fechaFin' => '// ============================================================
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
    if (!trabajoActual && fechaFin && fechaFin',
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
        chip.innerHTML       = `' => 'r.checked = (r.value === \'ninguno\'));
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
        chip.innerHTML       = `',
  '${escapeHtmlExp(p.nombre)}${yaVinculadoAOtra ? \'' => '${escapeHtmlExp(p.nombre)}${yaVinculadoAOtra ? \'',
  '(en otra exp.)' => '(en otra exp.)',
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

función alternarChipProyectoExistente(chip) {
    const activo = chip.dataset.activo === \'1\';
    si (activo) {
        chip.dataset.activo = \'0\';
        chip.className = \'text-xs px-2.5 py-1 borde redondeado-borde completo-[#1e3a5f]/20 bg-texto blanco-[#1e3a5f] hover:bg-[#1e3a5f]/10 transición cursor-puntero seleccionar-ninguno\';
    } más {
        chip.dataset.activo = \'1\';
        chip.className = \'text-xs px-2.5 py-1 borde redondeado-borde completo-[#1e3a5f] bg-[#1e3a5f] texto-blanco transición cursor-puntero seleccionar-ninguno\';
    }
}

function getProyectosExistentesSeleccionados() {
    return Array.from(document.querySelectorAll(\'#exp_proj_existente_chips [data-activo="1"]\'))
        .map(c => Número(c.dataset.idProyecto));
}

function renderProyectosVinculadosEnModal(idExperiencia, proyectos) {
    const wrapper = document.getElementById(\'exp_proyectos_vinculados_wrapper\');
    const contenedor = document.getElementById(\'exp_proyectos_vinculados\');
    if (!wrapper || !container) regresa;
    contenedor.innerHTML = \'\';
    if (!proyectos || proyectos.length === 0) {
        wrapper.classList.add(\'oculto\');
        devolver;
    }
    proyectos.forEach(p => {
        chip constante = document.createElement(\'span\');
        chip.className = \'elementos flexibles-centro espacio-1 texto-xs bg-[#1e3a5f]/5 texto-[#1e3a5f] borde borde-[#1e3a5f]/20 px-2.5 py-1 redondeado-completo\';
        chip.dataset.idProyecto = p.id_proyecto;
        chip.innerHTML = `',
  '${escapeHtmlExp(p.nombre)}' => '${escapeHtmlExp(p.nombre)}',
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
        chip.querySelector(\'botón\').addEventListener(\'click\', () => desvincularProyectoExp(p.id_proyecto, idExperiencia, chip));
        contenedor.appendChild(chip);
    });
    wrapper.classList.remove(\'oculto\');
}

function desvincularProyectoExp(idProyecto, idExperiencia, chipEl) {
    fetch(`/proyectos/${idProyecto}`, {
        método: \'PONER\',
        encabezados: {
            \'Tipo de contenido\': \'aplicación/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[nombre="csrf-token"]\').content,
        },
        cuerpo: JSON.stringify({ id_experiencia: null }),
    })
    .entonces(r => r.json())
    .entonces(res => {
        if (!res.success) { mostrarToastExp(\'No se pudo desvincular el proyecto\', \'error\'); regresar; }

        // Actualizar lista global
        const item = (window.PROYECTOS_USUARIO_LIST || []).find(p => Número(p.id_proyecto) === Número(idProyecto));
        if (elemento) item.id_experiencia = null;

        //chip de quitar
        chipEl?.remove();
        const contenedor = document.getElementById(\'exp_proyectos_vinculados\');
        if (contenedor && contenedor.niños.longitud === 0) {
            document.getElementById(\'exp_proyectos_vinculados_wrapper\')?.classList.add(\'hidden\');
        }

        // Refrescar select de "vincular existente"
        popularChipsProyectosDisponibles(idExperiencia);

        // Limpiar bloque de proyectos en la tarjeta de experiencia (si era el último)
        if (contenedor && contenedor.niños.longitud === 0) {
            const enTarjeta = document.getElementById(`exp-proyectos-${idExperiencia}`);
            if (enTarjeta) enTarjeta.innerHTML = \'\';
        } más {
            // Quitar solo el link de ese proyecto en la tarjeta
            const enTarjeta = document.getElementById(`exp-proyectos-${idExperiencia}`);
            const link = enTarjeta?.querySelector(`a[onclick*="verProyectoDesdeExp(${idProyecto})"]`);
            enlace?.remove();
        }

        mostrarToastExp(\'Proyecto desvinculado\', \'éxito\');
    })
    .catch(() => mostrarToastExp(\'Error al desvincular el proyecto\', \'error\'));
}

// ==============================================================
// MODO DE PROYECTO (ninguno / existente / nuevo)
// ==============================================================
función getModoProyectoExp() {
    const r = document.querySelector(\'input[name="exp_proj_modo"]:marcado\');
    devolver r? r.valor: \'ninguno\';
}

function aplicarModoProyectoExp() {
    const modo = getModoProyectoExp();
    const existente = document.getElementById(\'exp_proyecto_existente\');
    const nuevo = document.getElementById(\'exp_proyecto_form\');
    if (existente) existente.classList.toggle(\'hidden\', modo !== \'existente\');
    if (nuevo) nuevo.classList.toggle(\'hidden\', modo !== \'nuevo\');
}

document.addEventListener(\'cambiar\', función(e) {
    if (e.target && e.target.name === \'exp_proj_modo\') aplicarModoProyectoExp();
});

// ==============================================================
// ABRIR MODAL CREAR
// ==============================================================
function abrirExperienciaModal() {
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

// ==============================================================
// ABRIR EDITAR MODAL
// ==============================================================
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
    document.getElementById(\'exp_cargo\').value = exp.carga ?? \'\';
    document.getElementById(\'exp_empresa\').value = exp.empresa ?? \'\';
    document.getElementById(\'exp_fecha_ini\').value = exp.fecha_ini ? exp.fecha_ini.substring(0, 10): \'\';
    document.getElementById(\'exp_fecha_fin\').value = exp.fecha_fin? exp.fecha_fin.substring(0, 10): \'\';
    document.getElementById(\'exp_descripcion\').value = exp.descripcion ?? \'\';
    document.getElementById(\'exp_referencias\').value = exp.referencias ?? \'\';

    const trabajoActual = (exp.trabajo_actual === 1 || exp.trabajo_actual === true);
    document.getElementById(\'exp_trabajo_actual\').checked = trabajoActual;
    experienciaEditandoId = exp.id_experiencia;

    if (trabajoActual) {
        document.getElementById(\'exp_fecha_fin_container\').style.opacity = \'0.5\';
        document.getElementById(\'exp_fecha_fin\').disabled = true;
        document.getElementById(\'exp_fecha_fin\').value = \'\';
    } más {
        document.getElementById(\'exp_fecha_fin_container\').style.opacity = \'1\';
        document.getElementById(\'exp_fecha_fin\').disabled = false;
    }

    document.getElementById(\'modalExperiencia\').classList.remove(\'hidden\');
    document.getElementById(\'modalExperiencia\').classList.add(\'flex\');
}

// ==============================================================
// CERRAR MODAL
// ==============================================================
function cerrarExperienciaModal() {
    document.getElementById(\'modalExperiencia\').classList.add(\'hidden\');
    document.getElementById(\'modalExperiencia\').classList.remove(\'flex\');
    experienciaEditandoId = null;
    resetProyectoForm();
}

function cerrarModalExperienciaFondo(evento) {
    if (event.target.id === \'modalExperiencia\') confirmarCancelarExperiencia();
}

// ==============================================================
// CHECKBOX trabajo actual
// ==============================================================
document.getElementById(\'exp_trabajo_actual\')?.addEventListener(\'cambiar\', función(e) {
    contenedor constante = document.getElementById(\'exp_fecha_fin_container\');
    entrada constante = document.getElementById(\'exp_fecha_fin\');
    si (e.objetivo.marcado) {
        contenedor.estilo.opacidad = \'0.5\';
        entrada.disabled = verdadero;
        entrada.valor = \'\';
    } más {
        contenedor.estilo.opacidad = \'1\';
        entrada.disabled = falso;
    }
});

// ==============================================================
// CONSTRUIR TARJETA HTML (estilo tarjeta igual que gestionarProyectos)
// ==============================================================
función escapeHtmlExp(texto) {
    si (!texto) regresa \'\';
    const div = document.createElement(\'div\');
    div.textContent = texto;
    devolver div.innerHTML;
}

// Refresca el bloque de "proyectos relacionados" en la tarjeta de experiencia
function actualizarTarjetaExpConProyecto(idExperiencia, proyecto) {
    const contenedor = document.getElementById(`exp-proyectos-${idExperiencia}`);
    if (!contenedor) regresa;
    contenedor.innerHTML = `',
  '${escapeHtmlExp(proyecto.nombre)}' => '${escapeHtmlExp(proyecto.nombre)}',
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
        fechaFinStr = \'',
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

    return `',
  '${cargo}' => '${carga}',
  '${badgeLabel}' => '${badgeLabel}',
  '${empresa}' => '${empresa}',
  '` : \'\'}

    ${referencias ? `' => '` : \'\'}

    ${referencias ? `',
  '${referencias}' => '${referencias}',
  '${proyectos.length ? `' => '${proyectos.length ? `',
  '${proyectos.map(p => `' => '${proyectos.map(p => `',
  '`).join(\'\')}' => '`).unirse(\'\')}',
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

// ==============================================================
// TOSTADO
// ==============================================================
function mostrarToastExp(mensaje, tipo = \'éxito\') {
    let contenedor = document.getElementById(\'toastContainer\');
    si (! contenedor) {
        contenedor = document.createElement(\'div\');
        contenedor.id = \'tostadaContenedor\';
        container.className = \'fijo abajo-4 derecha-4 z-[70] espacio-y-2\';
        documento.body.appendChild(contenedor);
    }
    const brindis = document.createElement(\'div\');
    const bg = tipo === \'éxito\' ? \'bg-verde-500\' : \'bg-rojo-500\';
    const ico = tipo === \'éxito\' ? \'fa-check-circle\' : \'fa-exclamation-circle\';
    tostado.className = `${bg} texto-blanco px-6 py-3 redondeado-lg sombra-lg texto-sm flex elementos-centro espacio-2`;
    brindis.innerHTML = `',
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
    contenedor.innerHTML = `',
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
    btnGuardar.innerHTML = \'',
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
        span.innerHTML = `${tag}' => 'Guardando...\';

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
        contenedor.appendChild(lapso);
    });
}

función eliminarTagExp(índice) {
    etiquetas constantes = getTagsExp();
    etiquetas.splice(índice, 1);
    setTagsExp(etiquetas);
}

función verificarFechaFinProyectoExp() {
    const fechaFin = document.getElementById(\'exp_proj_fecha_fin\').value;
    contenedor const = document.getElementById(\'exp_proj_url_wrapper\');
    const hoy = nueva Fecha().toISOString().split(\'T\')[0];
    const pasado = fechaFin && fechaFin',
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
        chip constante = document.createElement(\'botón\');
        chip.tipo = \'botón\';
        chip.dataset.tec = tec;
        chip.textContent = tec;

        if (yaAgregadas.incluye(tec)) {
            chip.className = \'text-xs px-2.5 py-1 borde completo redondeado borde-gris-200 bg-gray-100 texto-gris-400 cursor-no permitido\';
            chip.disabled = verdadero;
        } más {
            chip.className = \'text-xs px-2.5 py-1 borde redondeado-borde completo-[#1e3a5f]/20 bg-texto blanco-[#1e3a5f] hover:bg-[#1e3a5f]/10 transición cursor-puntero seleccionar-ninguno\';
            chip.addEventListener(\'hacer clic\', () => toggleChipExp(chip));
        }

        chipsDiv.appendChild(chip);
    });

    contenedor.classList.remove(\'oculto\');
}

función alternarChipExp(chip) {
    const activo = chip.dataset.activo === \'1\';
    si (activo) {
        chip.dataset.activo = \'0\';
        chip.className = \'text-xs px-2.5 py-1 borde redondeado-borde completo-[#1e3a5f]/20 bg-texto blanco-[#1e3a5f] hover:bg-[#1e3a5f]/10 transición cursor-puntero seleccionar-ninguno\';
    } más {
        chip.dataset.activo = \'1\';
        chip.className = \'text-xs px-2.5 py-1 borde redondeado-borde completo-[#1e3a5f] bg-[#1e3a5f] texto-blanco transición cursor-puntero seleccionar-ninguno\';
    }
}

function agregarTecnologiaExp() {
    const seleccionados = document.querySelectorAll(\'#exp_chips [data-activo="1"]\');
    if (!seleccionados.length) regresa;

    etiquetas constantes = getTagsExp();
    seleccionados.forEach(chip => {
        constante tec = chip.dataset.tec;
        if (!tags.includes(tec)) etiquetas.push(tec);
    });
    setTagsExp(etiquetas);

    seleccionados.forEach(chip => {
        chip.dataset.activo = \'0\';
        chip.className = \'text-xs px-2.5 py-1 borde completo redondeado borde-gris-200 bg-gray-100 texto-gris-400 cursor-no permitido\';
        chip.disabled = verdadero;
    });
}

// ==============================================================
// ELIMINAR
// ==============================================================
function confirmarEliminarExperiencia(id) {
    CONFIRM_CONFIG_EXPERIENCIA.eliminar.accion = () => ejecutarEliminarExperiencia(id);
    mostrarConfirmacionExperiencia(\'eliminar\');
}

function ejecutarEliminarExperiencia(id) {
    fetch(`/perfil/experiencia/${id}`, {
        método: \'ELIMINAR\',
        encabezados: {
            \'Tipo de contenido\': \'aplicación/json\',
            \'X-CSRF-TOKEN\': document.querySelector(\'meta[nombre="csrf-token"]\').content,
        },
    })
    .entonces(r => r.json())
    .entonces(res => {
        si (res.éxito) {
            tarjeta const = document.querySelector(`[data-experiencia-id="${id}"]`);
            if (tarjeta) card.remove();
            recalcularEstadísticasExperiencia();
            mostrarToastExp(\'Experiencia eliminada correctamente\', \'éxito\');
        } más {
            mostrarToastExp(res.error || \'Error al eliminar\', \'error\');
        }
    });
}',
  'Desvincular' => 'Desvincular',
  'Editar Perfil' => 'Editar Perfil',
  'Actualiza tu información personal y profesional' => 'Actualiza tu información personal y profesional',
  'Cambios' => 'Cambios',
  'Información básica de contacto' => 'Información básica de contacto',
  'Información Profesional' => 'Información Profesional',
  'Tu perfil profesional y ubicación' => 'Tu perfil profesional y ubicación',
  'Título Profesional' => 'Título Profesional',
  'Foto de Perfil (URL)' => 'Foto de Perfil (URL)',
  'Pega la URL de tu foto de perfil' => 'Pega la URL de tu foto de perfil',
  'Cuéntanos sobre ti, tu experiencia y objetivos' => 'Cuéntanos sobre ti, tu experiencia y objetivos',
  'Sobre mí' => 'Sobre mí',
  'Redes Sociales' => 'Redes Sociales',
  'Conecta tu perfil con tus redes profesionales' => 'Conecta tu perfil con tus redes profesionales',
  'GitHub' => 'GitHub',
  'LinkedIn' => 'LinkedIn',
  'Twitter / X' => 'Gorjeo / X',
  'Portafolio Web' => 'Portafolio web',
  'Ej: Ingeniero de Software' => 'Ej: Ingeniero de Software',
  'Ciudad, País' => 'Ciudad, País',
  'https://ejemplo.com/mi-foto.jpg' => 'https://ejemplo.com/mi-foto.jpg',
  'Desarrollador full-stack con 5 años de experiencia...' => 'Desarrollador full-stack con 5 años de experiencia...',
  'https://github.com/tuusuario' => 'https://github.com/tuusuario',
  'https://linkedin.com/in/tuusuario' => 'https://linkedin.com/in/tuusuario',
  'https://twitter.com/tuusuario' => 'https://twitter.com/tuusuario',
  'https://tusitioweb.com' => 'https://tusitioweb.com',
  'Agregar Formación Académica' => 'Agregar Formación Académica',
  'Completa los detalles de tu formación' => 'Completa los detalles de tu formación',
  'Título' => 'Título',
  'Institución' => 'Institución',
  'Selecciona un nivel' => 'Selecciona un nivel',
  'Técnico' => 'Técnico',
  'Tecnólogo' => 'Tecnólogo',
  'Pregrado' => 'Pregrado',
  'Posgrado' => 'Posgrado',
  'Maestría' => 'Maestría',
  'Doctorado' => 'Doctorado',
  'Diplomado' => 'Diplomado',
  'Curso' => 'Curso',
  'Fecha Inicio' => 'Fecha Inicio',
  'Fecha Fin' => 'Fecha Fin',
  'Actualmente estudiando aquí' => 'Actualmente estudiando aquí',
  'Ej: Ingeniería Informática' => 'Ej: Ingeniería Informática',
  'Ej: Universidad Nacional' => 'Ej: Universidad Nacional',
  'Describe lo que aprendiste o destacaste...' => 'Describe lo que aprendiste o destacaste...',
  'Agregar Experiencia Laboral' => 'Agregar Experiencia Laboral',
  'Completa los detalles de tu experiencia' => 'Completa los detalles de tu experiencia',
  'Cargo' => 'Carga',
  'Empresa' => 'Empresa',
  'Trabajo actualmente aquí' => 'Trabajo actualmente aquí',
  '(opcional)' => '(opcional)',
  'Proyecto vinculado' => 'Proyecto vinculado',
  'Ninguno' => 'Ninguno',
  'Vincular existente' => 'Vincular existente',
  'Crear nuevo' => 'Crear nuevo',
  'Proyectos vinculados actualmente:' => 'Proyectos vinculados actualmente:',
  'Selecciona uno o más proyectos' => 'Selecciona uno o más proyectos',
  'No hay proyectos disponibles para vincular.' => 'No hay proyectos disponibles para vincular.',
  'Clic para seleccionar / deseleccionar. Los seleccionados se enlazarán a esta experiencia.' => 'Clic para seleccionar / deseleccionar. Los seleccionados se enlazarán a esta experiencia.',
  'El proyecto quedará vinculado a esta experiencia y también aparecerá en' => 'El proyecto quedará vinculado a esta experiencia y también aparecerá en',
  'Nombre del Proyecto' => 'Nombre del Proyecto',
  'Enlace del Proyecto' => 'Enlace del Proyecto',
  '(obligatorio porque el proyecto ya finalizó)' => '(obligatorio porque el proyecto ya finalizó)',
  'Frontend' => 'Interfaz',
  'Backend' => 'backend',
  'Lenguajes' => 'Lenguajes',
  'Bases de Datos' => 'Bases de Datos',
  'Cloud &amp; DevOps' => 'Nube y DevOps',
  'Mobile' => 'Móvil',
  'APIs &amp; Real-time' => 'API y tiempo real',
  'Testing' => 'Pruebas',
  'Data Science &amp; ML' => 'Ciencia de datos y aprendizaje automático',
  'Diseño &amp; Prototipado' => 'Diseño & Prototipado',
  'Clic para seleccionar, clic de nuevo para deseleccionar' => 'Clic para seleccionar, clic de nuevo para deseleccionar',
  'Ej: Desarrollador Full Stack' => 'Ej: Desarrollador Full Stack',
  'Ej: Google, Microsoft, Startup X' => 'Ejemplo: Google, Microsoft, Startup X',
  'Describe tus responsabilidades y logros...' => 'Describe tus responsabilidades y logros...',
  'Ej: Juan Pérez — Jefe directo · juan@empresa.com · +57 300 000 0000' => 'Ej: Juan Pérez — Jefe directo · juan@empresa.com · +57 300 000 0000',
  'Ej: Sistema de Gestión Interna' => 'Ej: Sistema de Gestión Interna',
  'Breve descripción del proyecto...' => 'Breve descripción del proyecto...',
  'https://proyecto-cliente.com' => 'https://proyecto-cliente.com',
  'Subiendo foto...' => 'Subiendo foto...',
  'Mi Perfil' => 'Mi Perfil',
  'Correo:' => 'Correo:',
  'Título:' => 'Título:',
  'GitHub:' => 'GitHub:',
  'LinkedIn:' => 'LinkedIn:',
  'Twitter / X:' => 'Gorjeo/X:',
  'Portafolio:' => 'Portafolio:',
  'Configurar cuenta' => 'Configurar cuenta',
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
            fotoContainer.innerHTML = `' => 'function toggleConfiguracionCuenta() {
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
            fotoContainer.innerHTML = `',
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
        lector.readAsDataURL(archivo);
        
        // Mostrar barra de progreso
        const ProgressContainer = document.getElementById(\'progreso-foto-contenedor\');
        const ProgressBar = document.getElementById(\'progreso-foto-bar\');
        ProgressContainer.classList.remove(\'oculto\');
        ProgressBar.style.width = \'0%\';
        
        // Progreso similar
        dejar progreso = 0;
        intervalo constante = setInterval(() => {
            progreso += 10;
            si (progreso',
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
                // 1. Actualizar foto en el contenido principal (perfil)
                const fotoContainer = document.getElementById(\'perfil-foto-container\');
                fotoContainer.innerHTML = `',
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
                
                // 2. Actualizar avatar en el HEADER (nuevo)
                const headerAvatar = document.getElementById(\'header-avatar\');
                if (headerAvatar) {
                    let img = headerAvatar.querySelector(\'img\');
                    if (img) {
                        // Ya existe imagen, solo cambiar src
                        img.src = data.foto_url + \'?t=\' + Date.now();
                    } else {
                        // Era el span con iniciales, reemplazar por imagen
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
                
                // 3. Actualizar foto en el modal de edición si existe
                const modalFoto = document.querySelector(\'#modal-editar-perfil #foto-perfil-actual\');
                if (modalFoto) {
                    modalFoto.innerHTML = `',
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
    }',
  'Dashboard / Mi Perfil / Proyectos' => 'Dashboard / Mi Perfil / Proyectos',
  'Hola, {{ $nombreUsuario ?? \'Usuario\' }}' => 'Hola, {{ $nombreUsuario ?? \'Usuario\' }}',
  'Resumen de tu actividad, proyectos y rendimiento reciente en el sistema.' => 'Resumen de tu actividad, proyectos y rendimiento reciente en el sistema.',
  'Actividades' => 'Actividades',
  'Estudios' => 'Estudios',
  'Proyectos recientes' => 'Proyectos recientes',
  'Últimos {{ $proyectosRecientes->count() }} registros' => 'Últimos {{ $proyectosRecientes->count() }} registros',
  'window._resumenProyectosIniciales = {{ $proyectosRecientes->count() }};' => 'window._resumenProyectosIniciales = {{ $proyectosRecientes->count() }};',
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
            ? `' => 'const CSRF_PERFIL = document.querySelector(\'meta[name="csrf-token"]\').content;

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
            ? `',
  '`
            : `' => '`
            : `',
  '${iniciales}' => '${iniciales}',
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

    // ── Cabecera del perfil ───────────────────────────────────────────────────
    setText(\'perfil-nombre-header\',    nombreCompleto, \'Usuario\');
    setText(\'perfil-titulo-header\',    p.titulo_profesional, \'Desarrollador\');
    setText(\'perfil-ubicacion-header\', p.ubicacion, \'Ubicación no especificada\');
    setText(\'perfil-correo-header\',    u.correo_electronico, \'___\');

    const fotoContainer = document.getElementById(\'perfil-foto-container\');
    if (fotoContainer) {
        fotoContainer.innerHTML = p.foto_perfil
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
            socialContainer.insertAdjacentHTML(\'antes del fin\', html);
        } }

    // Lista de redes en el panel de datos
    para (tipo constante de Object.keys (linksConfig)) {
        const celda = document.getElementById(`perfil-datos-${tipo}`);
        si (! celda) continúa;
        url constante = mapa de enlaces[tipo];
        celda.innerHTML = (url && url.trim() !== \'\') ? `',
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

console.log(\'Scripts de perfil cargados correctamente\');',
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
@endphp' => '[\'label\' => \'en curso\',   \'class\' => \'bg-[#1e3a5f]/10 text-[#1e3a5f]\'],
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
@endphp',
  'id_proyecto }}"
     data-estado="{{ $proyecto->estado }}">

    {{-- Nombre + estado --}}' => 'id_proyecto }}"
     data-estado="{{ $proyecto->estado }}">

    {{-- Nombre + estado --}}',
  'url_link }}" target="_blank"
        class="flex items-center gap-2 text-xs font-medium bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-lg w-fit transition">' => 'enlace_url }}" target="_blank"
        class="elementos flexibles-centro espacio-2 texto-xs fuente-medio bg-indigo-600 hover:bg-indigo-700 texto-blanco px-3 py-1.5 redondeado-lg w-fit transición">',
  'Ver Demo' => 'Ver demostración',
  'id_proyecto }})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition">' => 'id_proyecto }})"
            class="flex-1 elementos flexibles-centro justificar-centro espacio-1.5 texto-xs borde borde-[#1e3a5f]/30 texto-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 transición redondeada-lg">',
  'id_proyecto }})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">' => 'id_proyecto }})"
            class="flex-1 elementos flexibles-centro justificar-centro espacio-1.5 texto-xs bg-[#e11d48] hover:bg-rojo-600 texto-blanco px-3 py-1.5 transición redondeada-lg">',
  'Crear Nuevo Proyecto' => 'Crear Nuevo Proyecto',
  'Completa la información de tu proyecto' => 'Completa la información de tu proyecto',
  'Proyecto' => 'Proyecto',
  'Información Básica' => 'Información Básica',
  'Datos principales de tu proyecto' => 'Datos principales de tu proyecto',
  'Tecnologías Utilizadas' => 'Tecnologías Utilizadas',
  'Agrega las tecnologías, lenguajes y frameworks que usaste' => 'Agrega las tecnologías, lenguajes y frameworks que usaste',
  'Haz clic para seleccionar, vuelve a hacer clic para deseleccionar' => 'Haz clic para seleccionar, vuelve a hacer clic para deseleccionar',
  'Agregar seleccionadas' => 'Agregar seleccionadas',
  'Estado y Visibilidad' => 'Estado y Visibilidad',
  'Configura el estado actual y quién puede ver este proyecto' => 'Configura el estado actual y quién puede ver este proyecto',
  'Estado del Proyecto' => 'Estado del Proyecto',
  'URL de la página web o aplicación desarrollada para la empresa o institución' => 'URL de la página web o aplicación desarrollada para la empresa o institución',
  'URL del Proyecto Desplegado' => 'URL del Proyecto Desplegado',
  'Enlace a la aplicación o sitio web en producción desarrollada para el cliente' => 'Enlace a la aplicación o sitio web en producción desarrollada para el cliente',
  'Referencias del Proyecto' => 'Referencias del Proyecto',
  'Información sobre personas que pueden dar referencias sobre este proyecto' => 'Información sobre personas que pueden dar referencias sobre este proyecto',
  'Nombre, cargo, email y teléfono de las personas que pueden dar referencias' => 'Nombre, cargo, email y teléfono de las personas que pueden dar referencias',
  'Cronograma' => 'Línea de tiempo',
  'Define las fechas de inicio y finalización' => 'Define las fechas de inicio y finalización',
  'Fecha de Inicio' => 'Fecha de Inicio',
  'Fecha de Finalización' => 'Fecha de Finalización',
  'Disponible solo cuando el estado es "Completado"' => 'Disponible solo cuando el estado es "Completado"',
  'Ej: Sistema de Gestión de Inventario' => 'Ej: Sistema de Gestión de Inventario',
  'Describe brevemente el proyecto y su objetivo principal...' => 'Describe brevemente el proyecto y su objetivo principal...',
  'Ej: Juan Pérez - Supervisor de Proyecto&#10;Email: juan@ejemplo.com&#10;Teléfono: +123456789' => 'Ej: Juan Pérez - Supervisor de Proyecto
Email: juan@ejemplo.com
Teléfono: +123456789',
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
        `' => 'const CSRF = document.querySelector(\'meta[name="csrf-token"]\').content;
constante USER_ID = {{ $userId }};

// ── Ayudantes ───────────────────────────────── ──────────────────────────────────

función apiFetch(url, opciones = {}) {
    devolver buscar(url, {
        ...opciones,
        encabezados: { \'X-CSRF-TOKEN\': CSRF, ...options.headers },
    });
}

función esValidUrl(cadena) {
    prueba {nueva URL(cadena); devolver verdadero; } captura (_) { retorno falso; }
}

función setModalVisible(id, mostrar) {
    document.getElementById(id).classList.toggle(\'oculto\', !show);
    document.getElementById(id).classList.toggle(\'flex\', mostrar);
}

// ── Estadísticas ────────────────────────────────── ───────────────────────────────────

función recalcularStats() {
    const cards = document.querySelectorAll(\'#proyectos-grid [datos-proyecto-id]\');
    let total = 0, enCurso = 0, finalizados = 0;
    tarjetas.forEach(c => {
        total++;
        if (c.dataset.estado === \'en_progreso\') enCurso++;
        if (c.dataset.estado === \'completado\') finalizados++;
    });
    document.getElementById(\'stat-total\').textContent = total;
    document.getElementById(\'stat-en-curso\').textContent = enCurso;
    document.getElementById(\'stat-finalizados\').textContent = finalizados;

    document.getElementById(\'proyectos-grid\').classList.toggle(\'hidden\', total === 0);
    document.getElementById(\'estado-vacío\').classList.toggle(\'oculto\', total!== 0);

    // Actualizar estadísticas del Resumen general
    const resumenRepos = document.getElementById(\'resumen-stat-repos\');
    if (resumenRepos) resumenRepos.textContent = total;
    const resumenActividades = document.getElementById(\'resumen-stat-actividades\');
    if (resumenActividades) resumenActividades.textContent = (total * 45).toLocaleString();
}

// ── Construir HTML de tarjeta ──────────────────────── ─────────────────────────

constante ESTADO_BADGE = {
    en_progreso: { label: \'en curso\', cls: \'bg-[#1e3a5f]/10 text-[#1e3a5f]\' },
    completado: { label: \'finalizado\', cls: \'bg-indigo-100 text-indigo-700\' },
    pendiente: { label: \'pendiente\', cls: \'bg-gray-100 text-gray-600\' },
    cancelado: { etiqueta: \'cancelado\', cls: \'bg-red-100 text-[#e11d48]\' },
};

const MESES = [\'Ene\',\'Feb\',\'Mar\',\'Abr\',\'May\',\'Jun\',\'Jul\',\'Ago\',\'Sep\',\'Oct\',\'Nov\',\'Dic\'];

formato de funciónFecha(cadena) {
    if (!str) devuelve \'Presente\';
    const d = nueva fecha (cadena + \'T00:00:00\');
    return `${String(d.getDate()).padStart(2,\'0\')} ${MESES[d.getMonth()]} ${d.getFullYear()}`;
}

// Extrae la parte AAAA-MM-DD de cualquier formato de fecha que devuelva Laravel
función toInputDate(cadena) {
    si (!cadena) regresa \'\';
    return String(str).substring(0, 10);
}

función construirCardHTML(p) {
    insignia constante = ESTADO_BADGE[p.estado] ?? {etiqueta: p.estado, cls: \'bg-gray-100 text-gray-600\' };
    etiquetas const = p.tecnologias ? p.tecnologias.split(\',\').map(t => t.trim()).filter(Boolean) : [];
    const fechaFin = p.fecha_fin ? formatFecha(p.fecha_fin) : \'Presente\';

    etiquetas constantesHTML = etiquetas.map(t =>
        `',
  '${t}' => '${t}',
  '`
    ).join(\'\');

    const demoBtn = p.url_link
        ? `' => '`
    ).unirse(\'\');

    const demoBtn = p.url_link
        ? `',
  '`
        : \'\';

    return `' => '`
        : \'\';

    regresar `',
  '${p.nombre}' => '${p.nombre}',
  '${badge.label}' => '${badge.label}',
  '${p.descripcion ?? \'Sin descripción\'}' => '${p.descripcion ?? \'Sin descripción\'}',
  '${formatFecha(p.fecha_ini)} – ${fechaFin}' => '${formatFecha(p.fecha_ini)} – ${fechaFin}',
  '${tags.length ? `' => '${etiquetas.longitud? `',
  '${tagsHTML}' => '${etiquetasHTML}',
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
    if (fechaFin && fechaFin',
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
        span.innerHTML = `${tag}' => 'ejecutarEliminar(id);
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
        contenedor.appendChild(lapso);
    });
}

función obtener etiquetas() {
    const val = document.getElementById(\'proj_tecnologias\').value;
    valor de retorno? val.split(\',\').map(t => t.trim()).filter(Booleano): [];
}

función estableceretiquetas(etiquetas) {
    document.getElementById(\'proj_tecnologias\').value = tags.join(\', \');
    renderizarEtiquetas(etiquetas);
}

function agregarTecnologia() {
    const seleccionados = document.querySelectorAll(\'#proj_chips [data-activo="1"]\');
    if (!seleccionados.length) regresa;

    etiquetas constantes = getEtiquetas();
    seleccionados.forEach(chip => {
        if (!tags.includes(chip.dataset.tec)) etiquetas.push(chip.dataset.tec);
    });
    establecerEtiquetas(etiquetas);

    seleccionados.forEach(chip => {
        chip.dataset.activo = \'0\';
        chip.className = CHIP_DISABLED_CLS;
        chip.disabled = verdadero;
        chip.removeEventListener(\'hacer clic\', alternarChip);
    });
}

función eliminarEtiqueta(índice) {
    etiquetas constantes = getEtiquetas();
    etiquetas.splice(índice, 1);
    establecerEtiquetas(etiquetas);
}

// ── Validación en tiempo real de URL ──────────────────── ─────────────────────

document.getElementById(\'proj_url_link\').addEventListener(\'entrada\', función() {
    const val = this.value.trim();
    estado constante = document.getElementById(\'url_status\');
    sugerencia constante = document.getElementById(\'url_hint\');

    si (!val) {
        status.classList.add(\'oculto\');
        this.classList.remove(\'border-[#1e3a5f]\', \'border-red-400\', \'ring-2\', \'ring-[#1e3a5f]/20\', \'ring-red-200\');
        this.classList.add(\'borde-gris-200\');
        hind.textContent = \'Enlace a la aplicación o sitio web en producción desarrollada para el cliente\';
        sugerencia.className = \'texto-xs texto-gris-400 mt-1\';
        regresar;
    }

    const válido = isValidUrl(val);
    status.classList.remove(\'oculto\');
    this.classList.remove(\'border-gray-200\', \'border-[#1e3a5f]\', \'border-red-400\', \'ring-[#1e3a5f]/20\', \'ring-red-200\');
    this.classList.add(\'anillo-2\');

    si (válido) {
        estado.innerHTML = \'',
  '\';
        this.classList.add(\'border-[#1e3a5f]\', \'ring-[#1e3a5f]/20\');
        hint.textContent = \'✓ URL válida\';
        hint.className   = \'text-xs text-[#1e3a5f] mt-1 font-medium\';
    } else {
        status.innerHTML = \'' => '\';
        this.classList.add(\'border-[#1e3a5f]\', \'ring-[#1e3a5f]/20\');
        sugerencia.textContent = \' ✓ URL válida\';
        sugerencia.className = \'texto-xs texto-[#1e3a5f] mt-1 fuente-medio\';
    } más {
        estado.innerHTML = \'',
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
        this.classList.add(\'borde-rojo-400\', \'anillo-rojo-200\');
        sugerencia.textContent = \'URL no válida. Debe comenzar con https:// o http://\';
        sugerencia.className = \'texto-xs texto-rojo-500 mt-1\';
    }
});

función restablecerUrlStatus() {
    entrada constante = document.getElementById(\'proj_url_link\');
    estado constante = document.getElementById(\'url_status\');
    sugerencia constante = document.getElementById(\'url_hint\');
    input.classList.remove(\'borde-verde-400\', \'borde-rojo-400\', \'anillo-2\', \'anillo-verde-200\', \'anillo-rojo-200\');
    input.classList.add(\'borde-gris-200\');
    status.classList.add(\'oculto\');
    hind.textContent = \'Enlace a la aplicación o sitio web en producción desarrollada para el cliente\';
    sugerencia.className = \'texto-xs texto-gris-400 mt-1\';
}

// ── Proyecto Modal ────────────────────────────── ──────────────────────────────

function abrirProyectoModal() {
    document.getElementById(\'proyectoId\').value = \'\';
    document.getElementById(\'formProyecto\').reset();
    document.getElementById(\'proj_tecnologias\').value = \'\';
    document.getElementById(\'proj_tags\').innerHTML = \'\';
    document.getElementById(\'proj_categoria_select\').value = \'\';
    document.getElementById(\'proj_chips\').innerHTML = \'\';
    document.getElementById(\'proj_chips_container\').classList.add(\'hidden\');
    document.getElementById(\'modalProyectoTitulo\').textContent = \'Crear Nuevo Proyecto\';
    document.getElementById(\'proj_visible\').value = \'0\';
    restablecerEstadoUrl();
    FechaFinSegun actualizarEstado();
    setModalVisible(\'modalProyecto\', verdadero);
}

function cerrarModalProyecto() {
    setModalVisible(\'modalProyecto\', false);
}

document.getElementById(\'modalProyecto\').addEventListener(\'clic\', función(e) {
    if (e.target === this) confirmarCancelar();
});

// ── Editar ────────────────────────────────── ──────────────────────────────────

function ejecutarAbrirEditar(id) {
    apiFetch(`/proyectos/${id}`)
        .entonces(r => r.json())
        .entonces(p => {
            document.getElementById(\'proyectoId\').value = p.id_proyecto;
            document.getElementById(\'proj_nombre\').value = p.nombre ?? \'\';
            document.getElementById(\'proj_descripcion\').value = p.descripcion ?? \'\';
            document.getElementById(\'proj_fecha_ini\').value = toInputDate(p.fecha_ini);
            document.getElementById(\'proj_fecha_fin\').value = toInputDate(p.fecha_fin);
            document.getElementById(\'proj_estado\').value = p.estado ?? \'pendiente\';
            document.getElementById(\'proj_referencias\').value = p.referencias ?? \'\';
            document.getElementById(\'proj_categoria_select\').value = \'\';
            document.getElementById(\'proj_chips\').innerHTML = \'\';
            document.getElementById(\'proj_chips_container\').classList.add(\'hidden\');

            const urlInput = document.getElementById(\'proj_url_link\');
            urlInput.valor = p.url_link ?? \'\';
            urlInput.dispatchEvent(nuevo evento(\'entrada\')); // activa el indicador visual

            setTags(p.tecnologias ? p.tecnologias.split(\',\').map(t => t.trim()).filter(Boolean) : []);
            document.getElementById(\'proj_visible\').value = p.visible? \'1\': \'0\';
            FechaFinSegun actualizarEstado();
            document.getElementById(\'modalProyectoTitulo\').textContent = \'Editar Proyecto\';
            setModalVisible(\'modalProyecto\', verdadero);
        });
}

// ── Crear / Actualizar ──────────────────────────── ────────────────────────────

function enviarProyecto() {
    const id = document.getElementById(\'proyectoId\').value;
    URL constante = identificación? `/proyectos/${id}` : \'/proyectos\';
    método constante = identificación? \'PONER\' : \'POST\';

    apiFetch(url, {
        método,
        encabezados: { \'Tipo de contenido\': \'aplicación/json\' },
        cuerpo: JSON.stringify({
            ID_usuario: ID_USUARIO,
            nombre: document.getElementById(\'proj_nombre\').value.trim(),
            descripción: document.getElementById(\'proj_descripcion\').value,
            fecha_ini: document.getElementById(\'proj_fecha_ini\').value || nulo,
            fecha_fin: document.getElementById(\'proj_fecha_fin\').value || nulo,
            estado: document.getElementById(\'proj_estado\').value,
            tecnologías: document.getElementById(\'proj_tecnologias\').value,
            enlace_url: document.getElementById(\'proj_url_link\').value.trim() || nulo,
            referencias: document.getElementById(\'proj_referencias\').value,
            visible: parseInt(document.getElementById(\'proj_visible\').value),
        })
    })
    .entonces(r => {
        si (r.estado === 422) {
            devolver r.json().entonces(err => {
                mensajes constantes = err.errors? Object.values(err.errors).flat() : [err.message ?? \'Error de validación\'];
                resaltarError(\'proj_nombre\', msgs[0]);
                lanzar nuevo Error(\'validación\');
            });
        }
        devolver r.json();
    })
    .entonces(datos => {
        if (!data?.success) { alert(data?.message ?? \'Error al guardar\'); regresar; }

        cerrarModalProyecto();
        const tarjetaHTML = buildCardHTML(datos.proyecto);
        const grid = document.getElementById(\'proyectos-grid\');

        si (identificación) {
            const existente = grid.querySelector(`[data-proyecto-id="${data.proyecto.id_proyecto}"]`);
            si (existente) existente.outerHTML = cardHTML;
        } más {
            grid.insertAdjacentHTML(\'después del comienzo\', cardHTML);
            actualizarResumenProyectos(data.proyecto, \'crear\');
            if (tipo de ventana.notificarItemPublicable === \'función\') {
                window.notificarItemPublicable(\'proyecto\');
            }
        }

        // Sincronizar con la lista usada en el modal de Experiencia Laboral
        if (tipo de ventana.syncProyectoEnListaExp === \'función\') {
            window.syncProyectoEnListaExp(id ? \'actualizar\' : \'crear\', datos.proyecto);
        }

        recalcularEstadísticas();
    });
}

document.getElementById(\'formProyecto\').addEventListener(\'enviar\', función(e) {
    e.preventDefault();
    confirmarGuardar();
});

// ── Eliminar ───────────────────────────────── ─────────────────────────────────

function ejecutarEliminar(id) {
    apiFetch(`/proyectos/${id}`, { método: \'DELETE\' })
        .entonces(r => r.json())
        .entonces(datos => {
            si (!data.success) regresa;
            document.querySelector(`[data-proyecto-id="${id}"]`)?.remove();
            actualizarResumenProyectos(id, \'eliminar\');

            if (tipo de ventana.syncProyectoEnListaExp === \'función\') {
                window.syncProyectoEnListaExp(\'eliminar\', { id_proyecto: id });
            }

            recalcularEstadísticas();
        });
}

// ── Proyectos Recientes (Resumen) ────────────────────── ───────────────────────

const RESUMEN_ACCENTS = [\'bg-[#1e3a5f]\', \'bg-[#e11d48]\', \'bg-indigo-600\'];

constRESUMEN_ESTADO = {
    en_progreso: { label: \'En curso\', icon: \'fa-spinner\', bg: \'bg-[#1e3a5f]/10\', text: \'text-[#1e3a5f]\' },
    completado: { label: \'Finalizado\', icon: \'fa-check-circle\', bg: \'bg-indigo-100\', text: \'text-indigo-700\' },
    pendiente: { label: \'Pendiente\', icon: \'fa-clock\', bg: \'bg-gray-100\', text: \'text-gray-600\' },
    cancelado: { etiqueta: \'Cancelado\', icono: \'fa-times-circle\', bg: \'bg-red-100\', texto: \'text-[#e11d48]\' },
};

función buildResumenCardHTML(p, índice) {
    const cfg = RESUMEN_ESTADO[p.estado] ?? RESUMEN_ESTADO[\'pendiente\'];
    acento constante = RESUMEN_ACCENTS[índice % RESUMEN_ACCENTS.length];
    etiquetas constantes = p.tecnologias
        ? p.tecnologias.split(\',\').map(t => t.trim()).filter(Boolean).slice(0, 3)
        : [];

    etiquetas constantesHTML = etiquetas.map(t =>
        `',
  '`
    ).join(\'\');

    const fecha = p.fecha_ini ? formatFecha(p.fecha_ini) : \'—\';

    return `' => '`
    ).join(\'\');

    const fecha = p.fecha_ini ? formatFecha(p.fecha_ini) : \'—\';

    return `',
  '${fecha}' => '${fecha}',
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
@endphp' => '\'estadística-total\',
        \'label\' => \'Proyectos totales\',
        \'valor\' => $totalProyectos,
        \'subtitle\' => \'Todos registrados\',
        \'icono\' => \'carpeta fas fa\',
        \'tarjeta\' => \'bg-borde blanco-gris-100\', .
        \'fronteraL\' => \'frontera-l-[#1e3a5f]\',
        \'iconBg\' => \'bg-[#1e3a5f]/8\',
        \'iconCls\' => \'texto-[#1e3a5f]\',
        \'labelCls\' => \'texto-gris-500 fuente-medio\',
        \'subCls\' => \'texto-gris-400\',
    ],
    [
        \'id\' => \'estadística en progreso\',
        \'etiqueta\' => \'En progreso\',
        \'valor\' => $enCurso,
        \'subtitle\' => \'Actualmente trabajando\',
        \'icono\' => \'fas fa-spinner\',
        \'tarjeta\' => \'bg-[#1e3a5f]/5 borde-[#1e3a5f]/15\',
        \'fronteraL\' => \'frontera-l-[#1e3a5f]\',
        \'iconBg\' => \'bg-[#1e3a5f]/10\',
        \'iconCls\' => \'texto-[#1e3a5f]\',
        \'labelCls\' => \'texto-[#1e3a5f] fuente-semibold\',
        \'subCls\' => \'texto-[#1e3a5f]/60\',
    ],
    [
        \'id\' => \'estadística finalizada\',
        \'etiqueta\' => \'Finalizado\',
        \'valor\' => $finalizado,
        \'subtitle\' => \'Proyectos completados\',
        \'icono\' => \'fas fa-check-circle\',
        \'tarjeta\' => \'bg-rojo-50 borde-rojo-100\',
        \'fronteraL\' => \'frontera-l-[#e11d48]\',
        \'iconBg\' => \'bg-[#e11d48]/10\',
        \'iconCls\' => \'texto-[#e11d48]\',
        \'labelCls\' => \'texto-[#e11d48] fuente-semibold\',
        \'subCls\' => \'texto-[#e11d48]/70\',
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
@endphp' => 'where(\'id_usuario\', $userId)->first();
    $perfilId = $perfil->id_perfil ?? null;

    $proyectos = $perfilId
        ? Proyecto::where(\'id_perfil\', $perfilId)->orderBy(\'created_at\', \'desc\')->get()
        : collect();

    $totalProyectos = $proyectos->count();
    $enCurso        = $proyectos->where(\'estado\', \'en_progreso\')->count();
    $finalizados    = $proyectos->where(\'estado\', \'completado\')->count();
@endphp',
  'Gestión de Portafolio' => 'Gestión de Portafolio',
  'Administra tus proyectos personales y controla lo que muestras al mundo' => 'Administra tus proyectos personales y controla lo que muestras al mundo',
  'Nuevo Proyecto' => 'Nuevo Proyecto',
  'No tienes proyectos registrados aún' => 'No tienes proyectos registrados aún',
  'Comienza agregando tu primer proyecto al portafolio' => 'Comienza agregando tu primer proyecto al portafolio',
  'Agregar primer proyecto' => 'Agregar primer proyecto',
  'isEmpty() ? \'hidden\' : \'\' }}">
            @foreach($proyectos as $proyecto)
                @include(\'gestionarProyectos._card\', [\'proyecto\' => $proyecto])
            @endforeach' => 'isEmpty() ? \'hidden\' : \'\' }}">
            @foreach($proyectos as $proyecto)
                @include(\'gestionarProyectos._card\', [\'proyecto\' => $proyecto])
            @endforeach',
  'Inicio' => 'Inicio',
  'Como funciona' => 'como funciona',
  'Sobre nosotros' => 'Sobre nosotros',
  'Explorar' => 'Explorar',
  'Mi dashboard' => 'mi tablero',
  'Iniciar sesion' => 'Iniciar sesion',
  'Registrarse' => 'Registrarse',
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
            avatar.innerHTML = `' => '(función () {
    const modal = document.getElementById(\'modalPortfolio\');

    constante ICONS_LINK = {
        github: \'fabuloso fa-github\',
        linkedin: \'fabuloso fa-linkedin\',
        twitter: \'fabuloso fa-twitter\',
        x: \'fabuloso fa-x-twitter\',
        facebook: \'fabuloso fa-facebook\',
        instagram: \'fabuloso fa-instagram\',
        youtube: \'fabuloso fa-youtube\',
        sitio web: \'fas fa-globe\',
        web: \'hacer-globo\',
        sitio: \'fas-globo\',
        cartera: \'fas fa-globe\',
        correo electrónico: \'fas fa-sobre\',
    };

    función setText(id, valor) {
        const el = document.getElementById(id);
        si (el) el.textContent = valor?? \'\';
    }

    función escapeHtml(s) {
        const d = document.createElement(\'div\');
        d.textContenido = s ?? \'\';
        devolver d.innerHTML;
    }

    // Aceptar:
    // - un botón con dataset.portfolio (uso humano)
    // - un objeto de datos directamente { fecha, vista previa: bool } (uso del panel/vista previa)
    ventana.openModalPortfolio = función (entrada) {
        cartas de datos;
        let isPreview = falso;

        if (instancia de entrada del elemento) {
            intente {datos = JSON.parse(input.dataset.portfolio); } captura (e) { retorno; }
        } else if (entrada && tipo de entrada === \'objeto\') {
            si (entrada.datos) {
                datos = entrada.datos;
                isPreview = !!input.preview;
            } más {
                datos = entrada;
            }
        } más {
            regresar;
        }

        // Vista previa del banner
        banner const = document.getElementById(\'mp_preview_banner\');
        if (banner) banner.classList.toggle(\'oculto\',!isPreview);

        barra lateral const = document.getElementById(\'mp_sidebar\');
        const de = datos.cover_from || \'#1e3a5f\';
        constante a = datos.cover_to || \'#e11d48\';
        sidebar.style.backgroundImage = `linear-gradient(160deg, ${from} 0%, ${to} 100%)`;

        const avatar = document.getElementById(\'mp_avatar\');
        si (datos.foto) {
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
        } más {
            avatar.textContent = datos.iniciales || \'??\';
        }

        setText(\'mp_nombre\', data.nombre);
        setText(\'mp_rol\', datos.rol);
        setText(\'mp_bio_corta\', datos.descripcion);
        setText(\'mp_bio\', datos.descripcion);
        setText(\'mp_stat_anios\', (data.anios_num ?? 0) + (data.anios_num >= 1 ? \'+\' : \'\'));
        setText(\'mp_stat_proy\', data.cnt_proy ?? 0);
        setText(\'mp_stat_empresas\', data.cnt_empresas ?? 0);

        const setContact = (wrapperId, valor) => {
            const envoltura = document.getElementById(wrapperId);
            const span = wrap.querySelector(\'.mp-contact-text\');
            const hasValue = valor && String(valor).trim() !== \'\' && valor !== \'Sin ubicación\';
            si (tiene valor) {
                span.textContent = valor;
                envoltura.título = valor;
                wrap.classList.remove(\'oculto\');
                wrap.classList.add(\'flex\');
            } más {
                wrap.classList.add(\'oculto\');
                wrap.classList.remove(\'flex\');
            }
        };
        setContact(\'mp_contact_email\', datos.email);
        setContact(\'mp_contact_tel\', datos.telefono);
        setContact(\'mp_contact_loc\', datos.ubicacion);

        const linksWrap = document.getElementById(\'mp_links\');
        enlacesWrap.innerHTML = \'\';
        enlaces constantes = datos.enlaces || {};
        Objeto.keys(enlaces).forEach(tipo => {
            url constante = enlaces[tipo];
            si (!url) regresa;
            icono constante = ICONS_LINK[tipo] || \'fas fa-enlace\';
            const a = document.createElement(\'a\');
            a.href = URL;
            a.objetivo = \'_en blanco\';
            a.rel = \'noopener noreferrer\';
            a.title = tipo.charAt(0).toUpperCase() + tipo.slice(1);
            a.className = \'w-9 h-9 redondeado-lg bg-blanco/20 hover:bg-blanco/35 borde borde-blanco/25 texto-blanco elementos flexibles-centro justificar-centro transición\';
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
            enlacesWrap.appendChild(a);
        });

        const grupos = datos.habilidades_grupos || [];
        const contTec = document.getElementById(\'mp_habilidades_tecnicas\');
        const vacíoTec = document.getElementById(\'mp_habilidades_tecnicas_empty\');
        contTec.innerHTML = \'\';
        const totalTec = grupos.reduce((acc, g) => acc + ((g.items || []).length), 0);
        si (totalTec === 0) {
            vacíoTec.classList.remove(\'oculto\');
        } más {
            vacíoTec.classList.add(\'oculto\');
            grupos.forEach(g => {
                elementos constantes = g.elementos || [];
                si (items.length === 0) regresa;

                const grupoLi = document.createElement(\'li\');
                grupoLi.className = \'espacio-y-2\';

                encabezado constante = document.createElement(\'div\');
                header.className = \'elementos flexibles-centro espacio-2 pb-1.5 borde-b borde-gris-100\';
                encabezado.innerHTML = `
                    ${g.imagen
                        ? `',
  '`
                        : `' => '`
                        : `',
  '`
                    }' => '`
                    }',
  '${escapeHtml(g.categoria || \'Otras\')}' => '${escapeHtml(g.categoria || \'Otras\')}',
  '(${items.length})' => '(${elementos.longitud})',
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
                grupoLi. appendChild (encabezado);

                const interior = document.createElement(\'ul\');
                internal.className = \'espacio-y-2 pl-1\';
                elementos . para cada uno ( h => {
                    const sub = document.createElement(\'li\');
                    sub.className = \'elementos flexibles-iniciar espacio-2.5 texto-sm texto-gris-700\';
                    años constantes = h.años_experiencia || 0;
                    const añosTxt = años === 0? \'Menos de 1 año\' : `${años} ${años === 1 ? \'año\' : \'años\'}`;
                    sub.innerHTML = `',
  '${escapeHtml(h.nombre)}' => '${escapeHtml(h.nombre)}',
  '${escapeHtml(h.nivel || \'\')}' => '${escapeHtml(h.nivel || \'\')}',
  '${aniosTxt}' => '${añosTxt}',
  '${h.descripcion ? `' => '${h.descripcion ? `',
  '${escapeHtml(h.descripcion)}' => '${escapeHtml(h.descripcion)}',
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
                    internal.appendChild(sub);
                });
                grupoLi.appendChild(interior);
                contTec.appendChild(grupoLi);
            });
        }

        const blandas = data.habilidades_blandas || [];
        const contBlandas = document.getElementById(\'mp_habilidades_blandas\');
        const vacíaBlandas = document.getElementById(\'mp_habilidades_blandas_empty\');
        contBlandas.innerHTML = \'\';
        if (blandas.longitud === 0) {
            vacioBlandas.classList.remove(\'oculto\');
        } más {
            vacioBlandas.classList.add(\'oculto\');
            blandas.forEach(nombre => {
                const li = document.createElement(\'li\');
                li.className = \'elementos flexibles-centro de espacio-2.5 hover:text-[#e11d48] cursor de transición-predeterminado\';
                li.innerHTML = `',
  '${escapeHtml(nombre)}' => '${escapeHtml(nombre)}',
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
            \'mp_experiencias\', \'mp_experiencias_empty\',
            data.experiencias || [],
            (e) => {
                const proys = e.proyectos || [];
                const proysHtml = proys.length ? `',
  '${proys.map(pr => pr.url_link
                                ? `' => '${proys.map(pr => pr.url_link
                                ? `',
  '${escapeHtml(pr.nombre)}' => '${escapeHtml(pr.nombre)}',
  '`
                                : `' => '`
                                : `',
  '`
                            ).join(\'\')}' => '`
                            ).unirse(\'\')}',
  '` : \'\';
                return `' => '` : \'\';
                regresar `',
  '${escapeHtml(e.cargo)}' => '${escapeHtml(e.cargo)}',
  '${escapeHtml(e.empresa)}' => '${escapeHtml(e.empresa)}',
  '${e.trabajo_actual
                            ? \'' => '${e.trabajo_actual
                            ? \'',
  '\'
                            : \'\'}' => '\'
                            : \'\'}',
  '${formatRangoFecha(e.fecha_ini, e.fecha_fin, e.trabajo_actual)}' => '${formatRangoFecha(e.fecha_ini, e.fecha_fin, e.trabajo_actual)}',
  '${e.descripcion ? `' => '${e.descripción? `',
  '${escapeHtml(e.descripcion)}' => '${escapeHtml(e.descripcion)}',
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
            data.formacion || [],
            (f) => `',
  '${escapeHtml(f.titulo)}' => '${escapeHtml(f.título)}',
  '${escapeHtml(f.institucion)}' => '${escapeHtml(p.institución)}',
  '${f.nivel ? `' => '${f.nivel? `',
  '${escapeHtml(f.nivel)}' => '${escapeHtml(f.nivel)}',
  '${formatRangoFecha(f.fecha_ini, f.fecha_fin, false)}' => '${formatRangoFecha(f.fecha_ini, f.fecha_fin, false)}',
  '${f.descripcion ? `' => '${f.descripcion ? `',
  '${escapeHtml(f.descripcion)}' => '${escapeHtml(f.descripcion)}',
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
                return `',
  '${estado.label}' => '${estado.label}',
  '${pr.descripcion ? `' => '${pr.descripcion ? `',
  '${escapeHtml(pr.descripcion)}' => '${escapeHtml(pr.descripcion)}',
  '${formatRangoFecha(pr.fecha_ini, pr.fecha_fin, false)}' => '${formatRangoFecha(pr.fecha_ini, pr.fecha_fin, false)}',
  '${tags.slice(0, 6).map(t => `' => '${etiquetas.slice(0, 6).map(t => `',
  '${escapeHtml(t)}' => '${escapeHtml(t)}',
  '`).join(\'\')}${tags.length > 6 ? `' => '`).join(\'\')}${etiquetas.longitud > 6? `',
  '+${tags.length - 6}' => '+${etiquetas.longitud - 6}',
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

        modal.classList.remove(\'oculto\');
        modal.scrollTop = 0;
        const contenido = document.getElementById(\'mp_contenido\');
        if (contenido) contenido.scrollTop = 0;
        document.body.style.overflow = \'oculto\';

        const navLinks = document.querySelectorAll(\'.mp-nav\');
        navLinks.forEach((enlace, idx) => {
            link.classList.toggle(\'activo\', idx === 0);
            enlace.onclick = función (e) {
                e.preventDefault();
                const id = link.getAttribute(\'href\').replace(\'#\', \'\');
                destino constante = document.getElementById(id);
                si (!objetivo) regresa;
                if (contenido && contenido.scrollHeight > contenido.clientHeight) {
                    contenido.scrollTo({ top: target.offsetTop - 8, comportamiento: \'suave\' });
                } más {
                    target.scrollIntoView({ comportamiento: \'suave\', bloque: \'inicio\' });
                }
                navLinks.forEach(l => l.classList.remove(\'activo\'));
                link.classList.add(\'activo\');
            };
        });
    };

    ventana.irAProyecto = funcion (idProyecto) {
        const tarjeta = document.getElementById(\'mp_proy_\' + idProyecto);
        si (!card) regresa;
        card.scrollIntoView({ comportamiento: \'suave\', bloque: \'centro\' });
        card.classList.add(\'ring-2\', \'ring-[#e11d48]\', \'ring-offset-2\');
        setTimeout(() => card.classList.remove(\'ring-2\', \'ring-[#e11d48]\', \'ring-offset-2\'), 1800);
    };

    función renderTimeline (contId, vacíoId, elementos, constructor) {
        const cont = document.getElementById(contId);
        const vacío = document.getElementById(emptyId);
        cont.innerHTML = \'\';
        if (!elementos || elementos.longitud === 0) {
            vacío.classList.remove(\'oculto\');
            devolver;
        }
        vacío.classList.add(\'oculto\');
        cont.innerHTML = items.map(builder).join(\'\');
    }

    formato de funciónRangoFecha(ini, fin, actual) {
        si (!ini) regresa \'\';
        constante f = (s) => {
            const d = nueva Fecha(s + \'T12:00:00\');
            si (isNaN(d.getTime())) return \'\';
            const meses = [\'Ene\',\'Feb\',\'Mar\',\'Abr\',\'May\',\'Jun\',\'Jul\',\'Ago\',\'Sep\',\'Oct\',\'Nov\',\'Dic\'];
            return `${meses[d.getMonth()]} ${d.getFullYear()}`;
        };
        constante ini2 = f(ini);
        constante fin2 = real? \'Actualidad\' : (fin ? f(fin) : \'—\');
        devolver `${ini2} – ${fin2}`;
    }

    ventana.cerrarModalPortafolio = función () {
        modal.classList.add(\'oculto\');
        documento.body.style.overflow = \'\';
    };

    ventana.cerrarModalPortafolioFondo = función (e) {
        if (e.target === modal) cerrarModalPortafolio();
    };

    document.addEventListener(\'keydown\', función (e) {
        if (e.key === \'Escape\' && !modal.classList.contains(\'hidden\')) cerrarModalPortafolio();
    });
})();',
  'Vista previa — así verán tu portafolio' => 'Vista previa — así verán tu portafolio',
  'Experiencia' => 'Experiencia',
  'Educación' => 'Educación',
  'Años' => 'Años',
  'Empresas' => 'Empresas',
  'Sin habilidades registradas.' => 'Sin habilidades registradas.',
  'Sin habilidades blandas.' => 'Sin habilidades blandas.',
  'No hay proyectos publicados.' => 'No hay proyectos publicados.',
  'No hay experiencia laboral registrada.' => 'No hay experiencia laboral registrada.',
  'No hay formación académica registrada.' => 'No hay formación académica registrada.',
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
    #modalPortafolio:not(.hidden) > div > div { animation: mpFadeUp .35s ease both; }' => '.mp-nav.activo {
        color de fondo: rgba(255,255,255,0.22);
        sombra de cuadro: inserción 3px 0 0 #fff;
        peso de fuente: 700;
    }
    .mp-nav.active i.fa-chevron-right { opacidad: 0,9 !importante; }
    #mp_contenido { comportamiento-desplazamiento: suave; }

    #mp_contenido::-webkit-scrollbar,
    #mp_sidebar::-webkit-scrollbar { ancho: 6px; }
    #mp_contenido::-webkit-scrollbar-thumb { fondo: rgba(225,29,72,0.3); radio del borde: 3px; }
    #mp_sidebar::-webkit-scrollbar-thumb { fondo: rgba(255,255,255,0.3); radio del borde: 3px; }

    #mp_experiencias > div,
    #mp_formacion > div { posición: relativa; }
    #mp_experiencias > div::antes,
    #mp_formacion > div::antes {
        contenido: \'\';
        posición: absoluta;
        izquierda: -1,6rem;
        arriba: 1,25rem;
        ancho: 0,75 rem;
        altura: 0,75 rem;
        radio de borde: 9999px;
        fondo: gradiente lineal (135deg, #1e3a5f, #e11d48);
        sombra de cuadro: 0 0 0 3px #fff, 0 0 0 4px rgba(225,29,72,0.25);
    }

    @keyframes mpFadeUp {
        desde { opacidad: 0; transformar: traducirY(8px); }
        a { opacidad: 1; transformar: traducirY(0); }
    }
    #modalPortafolio:not(.hidden) > div > div { animación: mpFadeUp .35s facilita ambos; }',
  'Proyectos y portafolios públicos' => 'Proyectos y portafolios públicos',
  'Encuentra desarrolladores filtrando por tecnología, categoría, experiencia o ubicación.' => 'Encuentra desarrolladores filtrando por tecnología, categoría, experiencia o ubicación.',
  'Buscar' => 'Buscar',
  'Años mín. experiencia' => 'Años mín. experiencia',
  'Categoría de tecnología' => 'Categoría de tecnología',
  'nombre }}" data-cat-tec="{{ $categoria }}">{{ $tec->nombre }}' => 'nombre }}" data-cat-tec="{{ $categoría }}">{{ $tec->nombre }}',
  'Categorías de habilidades' => 'Categorías de habilidades',
  'id_categoria }}">{{ $cat->nombre }}' => 'id_categoria }}">{{ $cat->nombre }}',
  'Solo con proyectos publicados' => 'Solo con proyectos publicados',
  'Cargando portafolios...' => 'Cargando portafolios...',
  'No encontramos portafolios con esos filtros' => 'No encontramos portafolios con esos filtros',
  'Prueba ajustando los filtros o limpiándolos.' => 'Prueba ajustando los filtros o limpiándolos.',
  'Cargar más' => 'Cargar más',
  'Nombre, biografía o cargo...' => 'Nombre, biografía o cargo...',
  'Selecciona una o varias' => 'Selecciona una o varias',
  'Ciudad o país' => 'Ciudad o país',
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
        si (modal) {
            modal.classList.remove(\'oculto\');
            modal.classList.add(\'flex\');
        }
    }

    function cerrarLogin() {
        const modal = document.getElementById(\'modalLogin\');
        si (modal) {
            modal.classList.add(\'oculto\');
            modal.classList.remove(\'flex\');
        }
    }

    function abrirRegistro() {
        const modal = document.getElementById(\'modalRegister\');
        si (modal) {
            modal.classList.remove(\'oculto\');
            modal.classList.add(\'flex\');
        }
    }

    function cerrarRegistro() {
        const modal = document.getElementById(\'modalRegister\');
        si (modal) {
            modal.classList.add(\'oculto\');
            modal.classList.remove(\'flex\');
        }
    }

    función irALogin() {
        cerrarRegistro();
        abrirLogin();
    }

    función irARegister() {
        cerrarIniciar sesión();
        abrirRegistro();
    }

    document.querySelectorAll(\'.dropdown\').forEach(dropdown => {
        botón constante = dropdown.querySelector(\'botón\');
        menú constante = dropdown.querySelector(\'.menú desplegable\');

        si (botón && menú) {
            button.addEventListener(\'hacer clic\', (e) => {
                e.stopPropagation();

                document.querySelectorAll(\'.menú desplegable\').forEach(m => {
                    if (m! == menú) m.classList.add(\'oculto\');
                });

                menu.classList.toggle(\'oculto\');
            });
        }
    });

    document.addEventListener(\'hacer clic\', (e) => {
        si (!e.target.closest(\'.dropdown\')) {
            document.querySelectorAll(\'.menú desplegable\').forEach(menú => {
                menu.classList.add(\'oculto\');
            });
        }
    });

    const flashMessage = document.getElementById(\'flashMessage\');

    si (mensajeflash) {
        setTimeout(() => {
            flashMessage.style.opacity = \'0\';
            flashMessage.style.transform = \'traducirY(-10px)\';

            setTimeout(() => {
                flashMessage.remove();
            }, 500);
        }, 3000);
    }

    const menuLinks = document.querySelectorAll(\'.menu-link\');
    const secciones = document.querySelectorAll(\'#inicio, #explorar, #como-funciona, #sobre-nosotros\');

    function activarMenuActual() {
        let secciónActual = \'inicio\';
        const puntoReferencia = ventana.scrollY + 140;

        secciones.forEach(seccion => {
            const arriba = sección.offsetTop;
            altura constante = sección.offsetHeight;

            if (puntoReferencia >= arriba && puntoReferencia',
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
            link.classList.add(\'texto-gris-600\');

            if (link.getAttribute(\'href\') === `#${seccionActual}`) {
                link.classList.remove(\'texto-gris-600\');
                link.classList.add(\'text-[#e11d48]\', \'font-bold\');
            }
        });
    }

    window.addEventListener(\'scroll\', activarMenuActual);
    window.addEventListener(\'cargar\', activarMenuActual);

    menuLinks.forEach(enlace => {
        link.addEventListener(\'hacer clic\', función () {
            menuLinks.forEach(elemento => {
                item.classList.remove(\'text-[#e11d48]\', \'font-bold\');
                item.classList.add(\'texto-gris-600\');
            });

            this.classList.remove(\'texto-gris-600\');
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
        si (!loginErrorBox) regresa;
        loginErrorBox.textContent = mensaje;
        loginErrorBox.classList.remove(\'oculto\');
    }

    función limpiarErrorGeneralLogin() {
        si (!loginErrorBox) regresa;
        loginErrorBox.textContent = \'\';
        loginErrorBox.classList.add(\'oculto\');
    }

    function marcarInputError(entrada, elemento error, mensaje) {
        si (!input || !errorElement) regresa;
        input.classList.add(\'borde-rojo-500\', \'anillo-2\', \'anillo-rojo-200\');
        input.classList.remove(\'borde-gris-300\');
        errorElement.textContent = mensaje;
        errorElement.classList.remove(\'oculto\');
    }

    function limpiarInputError(entrada, elemento error) {
        si (!input || !errorElement) regresa;
        input.classList.remove(\'borde-rojo-500\', \'anillo-2\', \'anillo-rojo-200\');
        input.classList.add(\'borde-gris-300\');
        errorElement.textContent = \'\';
        errorElement.classList.add(\'oculto\');
    }

    function limpiarErroresLogin() {
        limpiarErrorGeneralLogin();
        limpiarInputError(loginCorreo, loginCorreoError);
        limpiarInputError(loginContrasenia, loginContraseniaError);
    }

    si (formulario de inicio de sesión) {
        loginForm.addEventListener(\'enviar\', función asíncrona (e) {
            e.preventDefault();
            limpiarErroresLogin();

            const correo = loginCorreo?.value.trim() || \'\';
            const contrasenia = loginContrasenia?.value.trim() || \'\';

            let hayErrores = false;

            si (!correo) {
                marcarInputError(loginCorreo, loginCorreoError, \'Debes ingresar tu correo electrónico.\');
                hayErrores = verdadero;
            } más {
                const emailValido = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
                if (!emailValido.test(correo)) {
                    marcarInputError(loginCorreo, loginCorreoError, \'Ingresa un correo electrónico válido.\');
                    hayErrores = verdadero;
                }
            }

            si (!contrasenia) {
                marcarInputError(loginContrasenia, loginContraseniaError, \'Debes ingresar tu contraseña.\');
                hayErrores = verdadero;
            }

            si (hayErrores) regresa;

            const formData = nuevo FormData(loginForm);

            prueba {
                respuesta constante = esperar a buscar (loginForm.action, {
                    método: \'POST\',
                    cuerpo: datos de formulario,
                    encabezados: {
                        \'X-Solicitado-Con\': \'XMLHttpRequest\',
                        \'Aceptar\': \'aplicación/json\'
                    }
                });

                const contentType = respuesta.headers.get(\'tipo de contenido\') || \'\';

                if (!contentType.includes(\'aplicación/json\')) {
                    mostrarErrorGeneralLogin(\'La respuesta del servidor no fue válida.\');
                    regresar;
                }

                datos constantes = espera respuesta.json();

                si (!respuesta.ok) {
                    mostrarErrorGeneralLogin(data.message || \'No se pudo iniciar sesión.\');
                    regresar;
                }

                si (datos.ok && datos.redirect) {
                    ventana.ubicación.href = datos.redirect;
                } más {
                    mostrarErrorGeneralLogin(\'Ocurrió un error inesperado.\');
                }

            } captura (error) {
                mostrarErrorGeneralLogin(\'No se pudo conectar con el servidor. Intenta nuevamente.\');
            }
        });

        [loginCorreo, loginContrasenia].forEach(entrada => {
            si (entrada) {
                entrada.addEventListener(\'entrada\', () => {
                    limpiarErrorGeneralLogin();

                    if (entrada === loginCorreo) {
                        limpiarInputError(loginCorreo, loginCorreoError);
                    }

                    if (entrada === loginContrasenia) {
                        limpiarInputError(loginContrasenia, loginContraseniaError);
                    }
                });
            }
        });
    }

    const registrarForm = document.getElementById(\'registerForm\');
    const registroNombre = document.getElementById(\'registerNombre\');
    const registrarApellido = document.getElementById(\'registerApellido\');
    const registrarCorreo = document.getElementById(\'registerCorreo\');
    const registrarTelefono = document.getElementById(\'registerTelefono\');
    const registrarContrasenia = document.getElementById(\'registerContrasenia\');
    const registrarContraseniaConfirmacion = document.getElementById(\'registerContraseniaConfirmacion\');
    const RegisterErrorBox = document.getElementById(\'registerErrorBox\');

    const RegisterNombreError = document.getElementById(\'registerNombreError\');
    const registrarApellidoError = document.getElementById(\'registerApellidoError\');
    const registrarCorreoError = document.getElementById(\'registerCorreoError\');
    const registrarTelefonoError = document.getElementById(\'registerTelefonoError\');
    const registrarContraseniaError = document.getElementById(\'registerContraseniaError\');
    const registroContraseniaConfirmacionError = document.getElementById(\'registerContraseniaConfirmacionError\');

    function mostrarErrorGeneralRegister(mensaje) {
        si (!registerErrorBox) regresa;
        RegisterErrorBox.textContent = mensaje;
        RegisterErrorBox.classList.remove(\'oculto\');
    }

    function limpiarErrorGeneralRegister() {
        si (!registerErrorBox) regresa;
        RegisterErrorBox.textContent = \'\';
        RegisterErrorBox.classList.add(\'oculto\');
    }

    function marcarInputErrorRegister(entrada, elemento error, mensaje) {
        si (!input || !errorElement) regresa;
        input.classList.add(\'borde-rojo-500\', \'anillo-2\', \'anillo-rojo-200\');
        input.classList.remove(\'borde-gris-300\');
        errorElement.textContent = mensaje;
        errorElement.classList.remove(\'oculto\');
    }

    function limpiarInputErrorRegister(entrada, errorElement) {
        si (!input || !errorElement) regresa;
        input.classList.remove(\'borde-rojo-500\', \'anillo-2\', \'anillo-rojo-200\');
        input.classList.add(\'borde-gris-300\');
        errorElement.textContent = \'\';
        errorElement.classList.add(\'oculto\');
    }

    function limpiarErroresRegister() {
        limpiarErrorGeneralRegister();
        limpiarInputErrorRegister(registerNombre, RegisterNombreError);
        limpiarInputErrorRegister(registrarApellido, registrarApellidoError);
        limpiarInputErrorRegister(registrarCorreo, registrarCorreoError);
        limpiarInputErrorRegister(registrarTelefono, registrarTelefonoError);
        limpiarInputErrorRegister(registrarContrasenia, registrarContraseniaError);
        limpiarInputErrorRegister(registrarContraseniaConfirmacion, registrarContraseniaConfirmacionError);
    }

    si (formulario de registro) {
        RegisterForm.addEventListener(\'enviar\', función asíncrona (e) {
            e.preventDefault();
            limpiarErroresRegister();

            const nombre = registrarNombre?.valor.trim() || \'\';
            const apellido = registrarApellido?.value.trim() || \'\';
            const correo = registrarCorreo?.value.trim() || \'\';
            const telefono = registrarTelefono?.value.trim() || \'\';
            const contrasenia = registrarContrasenia?.valor || \'\';
            const confirmacion = registrarContraseniaConfirmacion?.valor || \'\';

            let hayErrores = false;

            si (!nombre) {
                marcarInputErrorRegister(registerNombre, RegisterNombreError, \'Debes ingresar tu nombre.\');
                hayErrores = verdadero;
            }

            si (!apellido) {
                marcarInputErrorRegister(registrarApellido, registrarApellidoError, \'Debes ingresar tus apellidos.\');
                hayErrores = verdadero;
            }

            si (!correo) {
                marcarInputErrorRegister(registerCorreo, RegisterCorreoError, \'Debes ingresar tu correo electrónico.\');
                hayErrores = verdadero;
            } más {
                const emailValido = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
                if (!emailValido.test(correo)) {
                    marcarInputErrorRegister(registerCorreo, RegisterCorreoError, \'Ingresa un correo electrónico válido.\');
                    hayErrores = verdadero;
                }
            }

            if (teléfono.longitud > 50) {
                marcarInputErrorRegister(registerTelefono, RegisterTelefonoError, \'El teléfono no debe exceder los 50 caracteres.\');
                hayErrores = verdadero;
            }

            si (!contrasenia) {
                marcarInputErrorRegister(registrarContrasenia, registrarContraseniaError, \'Debes ingresar una contraseña.\');
                hayErrores = verdadero;
            } else if (contrasenia.longitud',
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
            si (entrada) {
                entrada.addEventListener(\'entrada\', () => {
                    limpiarErrorGeneralRegister();

                    if (input === registrarNombre) limpiarInputErrorRegister(registrarNombre, registrarNombreError);
                    if (input === registrarApellido) limpiarInputErrorRegister(registrarApellido, registrarApellidoError);
                    if (input === registrarCorreo) limpiarInputErrorRegister(registrarCorreo, registrarCorreoError);
                    if (input === registrarTelefono) limpiarInputErrorRegister(registrarTelefono, registrarTelefonoError);
                    if (input === registrarContrasenia) limpiarInputErrorRegister(registrarContrasenia, registrarContraseniaError);
                    if (input === registrarContraseniaConfirmacion) limpiarInputErrorRegister(registrarContraseniaConfirmacion, registrarContraseniaConfirmacionError);
                });
            }
        });
    }

    función alternarContraseña(inputId, iconId) {
        entrada constante = document.getElementById(inputId);
        icono constante = document.getElementById(iconId);

        si (!entrada || !icono) regresa;

        if (entrada.tipo === \'contraseña\') {
            entrada.tipo = \'texto\';
            icon.classList.remove(\'fa-ojo\');
            icon.classList.add(\'fa-eye-slash\');
        } más {
            input.type = \'contraseña\';
            icon.classList.remove(\'fa-eye-slash\');
            icon.classList.add(\'fa-ojo\');
        }
    }

    // ── Buscador público de portafolios ────────────────────────────────────
    (función inicializarBuscadorPortafolios() {
        const form = document.getElementById(\'form-buscador-portafolios\');
        const contenedor = document.getElementById(\'buscador-portafolios-resultados\');
        const esqueleto = document.getElementById(\'buscador-portafolios-esqueleto\');
        const vacio = document.getElementById(\'buscador-portafolios-vacio\');
        const estado = document.getElementById(\'buscador-portafolios-estado\');
        const btnCargarMas = document.getElementById(\'btn-buscador-cargar-mas\');
        if (!formulario || !contenedor) return;

        LÍMITE constante = 12;
        dejar desplazamiento = 0;
        sea total = 0;
        let cargando = false;
        let filtrosActuales = {};
        opciones constantesInstancias = {};

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

        // Lee los' => 'del buscador (multi y single).
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

        // Lee los',
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
                ? `' => 'originales y construye una estructura [{label, choices: [{value, label, customProperties}]}]
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
                ? `',
  '${escapeHtmlBP(p.iniciales)}' => '${escapeHtmlBP(p.iniciales)}',
  '`;

            const tagsHtml = (p.tags || []).map(t =>
                `' => '`;

            const etiquetasHtml = (p.tags || []).map(t =>
                `',
  '${escapeHtmlBP(t)}' => '${escapeHtmlBP(t)}',
  '`
            ).join(\'\');
            const tagsExtra = (p.tags_extra > 0)
                ? `' => '`
            ).unirse(\'\');
            etiquetas constantesExtra = (p.tags_extra > 0)
                ? `',
  '+${p.tags_extra}' => '+${p.tags_extra}',
  '`
                : \'\';

            const article = document.createElement(\'article\');
            article.className = \'bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all-soft overflow-hidden flex flex-col\';
            article.innerHTML = `' => '`
                : \'\';

            artículo constante = document.createElement(\'artículo\');
            artículo.className = \'bg-borde blanco borde-gris-100 redondeado-2xl sombra-sm hover:shadow-lg hover:-translate-y-1 transición-todo-desbordamiento suave-oculto flex flex-col\';
            artículo.innerHTML = `',
  '${avatar}' => '${avatar}',
  '${escapeHtmlBP(p.nombre)}' => '${escapeHtmlBP(p.nombre)}',
  '${escapeHtmlBP(p.rol)}' => '${escapeHtmlBP(p.rol)}',
  '${escapeHtmlBP(p.descripcion)}' => '${escapeHtmlBP(p.descripcion)}',
  '${tagsHtml}${tagsExtra}' => '${tags Html}${tags Extra}',
  '${escapeHtmlBP(p.anios)}' => '${escapeHtmlBP(p.años)}',
  '${escapeHtmlBP(p.proyectos)}' => '${escapeHtmlBP(p.proyectos)}',
  '${escapeHtmlBP(p.ubicacion)}' => '${escapeHtmlBP(p.ubicación)}',
  'Ver portafolio' => 'Ver portafolio',
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
            // No usamos form.reset() porque Choices.js gestiona sus',
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
    })();' => 'en un DOM aparte
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
    })();',
  'Crea y comparte tu portafolio en pocos pasos' => 'Crea y comparte tu portafolio en pocos pasos',
  'La plataforma esta diseñada para que puedas construir tu portafolio digital
                de forma sencilla, ordenada y profesional.' => 'La plataforma esta diseñada para que puedas construir tu portafolio digital
                de forma sencilla, ordenada y profesional.',
  'Crea tu perfil' => 'Crea tu perfil',
  'Registra tu informacion personal y profesional para construir
                        una base solida de tu portafolio digital.' => 'Registra tu informacion personal y profesional para construir
                        una base solida de tu portafolio digital.',
  'Agrega tus proyectos' => 'Agrega tus proyectos',
  'Incorpora tus trabajos, tecnologias, descripciones y logros
                        para mostrar mejor tu experiencia y capacidades.' => 'Incorpora tus trabajos, tecnologias, descripciones y logros
                        para mostrar mejor tu experiencia y capacidades.',
  'Comparte tu portafolio' => 'Comparte tu portafolio',
  'Publica tu perfil y permite que otras personas puedan ver
                        tu trabajo de una manera clara, accesible y profesional.' => 'Publica tu perfil y permite que otras personas puedan ver
                        tu trabajo de una manera clara, accesible y profesional.',
  'Una plataforma para mostrar tu talento de forma profesional' => 'Una plataforma para mostrar tu talento de forma profesional',
  'Portafolio Digital es una plataforma pensada para facilitar la creación de portafolios digitales,
                permitiendo a estudiantes y desarrolladores organizar, mostrar y compartir sus proyectos
                de forma clara, profesional y accesible.' => 'Portafolio Digital es una plataforma pensada para facilitar la creación de portafolios digitales,
                permitiendo a estudiantes y desarrolladores organizar, mostrar y compartir sus proyectos
                de forma clara, profesional y accesible.',
  'Organiza tu perfil' => 'Organiza tu perfil',
  'Centraliza tu información, experiencia y habilidades en un solo espacio para construir
                    una presentación más clara y ordenada.' => 'Centraliza tu información, experiencia y habilidades en un solo espacio para construir
                    una presentación más clara y ordenada.',
  'Muestra tus proyectos' => 'Muestra tus proyectos',
  'Presenta tus trabajos de manera visual y estructurada para destacar mejor tu perfil
                    y facilitar que otros comprendan lo que sabes hacer.' => 'Presenta tus trabajos de manera visual y estructurada para destacar mejor tu perfil
                    y facilitar que otros comprendan lo que sabes hacer.',
  'Haz visible tu trabajo en un entorno profesional y permite que otras personas
                    conozcan tus capacidades, proyectos y logros.' => 'Haz visible tu trabajo en un entorno profesional y permite que otras personas
                    conozcan tus capacidades, proyectos y logros.',
  'Portafolio Digital' => 'Portafolio Digital',
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
            comportamiento de desplazamiento: suave;
        }

        .transición-todo-suave {
            transición: todos los 0,3 s facilitan;
        }

        .hover-lift: flotar {
            transformar: traducirY(-2px);
        }

        .hover-escala: flotar {
            transformar: escala (1.04);
        }

        .enlace de navegación {
            transición: todos los 0,3 s facilitan;
            posición: relativa;
        }

        .nav-link: flotar {
            transformar: traducirY(-1px);
        }

        .tarjeta de héroe {
            transición: transformar 0,3 s de facilidad, box-shadow 0,3 s de facilidad;
        }

        .hero-card: flotar {
            transformar: traducirY(-4px);
            sombra de cuadro: 0 12px 24px rgba(0,0,0,0.12);
        }

        /* Choices.js: armonizar con Tailwind del buscador */
        .choices { margen inferior: 0; tamaño de fuente: 0,875rem; }
        .choices__inner.buscador-elección {
            altura mínima: 38px;
            relleno: 4px 6px;
            radio del borde: 0,5 rem;
            color del borde: #d1d5db;
            fondo: #fff;
        }
        .choices[tipo de datos*="select-multiple"] .choices__button { margen izquierdo: 6px; }
        .choices__list - múltiples .choices__item {
            radio de borde: 9999px;
            relleno: 2px 10px;
            peso de fuente: 500;
        }
        /* Pills de TECNOLOGÍAS — azul oscuro corporativo */
        .buscador-multi-tecnologías .choices__list--multiple .choices__item {
            color de fondo: #1e3a5f;
            color del borde: #1e3a5f;
        }
        .buscador-multi-tecnologías .choices__list--dropdown .choices__item--selectable.is-highlighted {
            color de fondo: #1e3a5f;
            color: #fff;
        }
        /* Pills de CATEGORÍAS — rojo coral del sistema */
        .buscador-multi-categorias .choices__list--multiple .choices__item {
            color de fondo: #e11d48;
            color del borde: #e11d48;
        }
        .buscador-multi-categorias .choices__list--dropdown .choices__item--selectable.is-highlighted {
            color de fondo: #e11d48;
            color: #fff;
        }
        /* Single de CATEGORÍA DE TECNOLOGÍA — verde esmeralda en hover/highlight */
        .buscador-single-categoriatec .choices__list--dropdown .choices__item--selectable.is-highlighted {
            color de fondo: #10b981;
            color: #fff;
        }
        .buscador-single-categoriatec.is-focused .choices__inner.buscador-choice {
            color del borde: #10b981;
            sombra de cuadro: 0 0 0 3px rgba(16, 185, 129, 0.15);
        }
        .choices.is-focused .choices__inner.buscador-choice {
            color del borde: #1e3a5f;
            sombra de cuadro: 0 0 0 3px rgba(30, 58, 95, 0.15);
        }
        /* Encabezados de grupo (optgroup) dentro del menú desplegable */
        .choices__list--desplegable .choices__group {
            antecedentes: #f9fafb;
            borde superior: 1px sólido #e5e7eb;
        }
        .choices__list--desplegable .choices__group .choices__heading {
            transformación de texto: mayúsculas;
            tamaño de fuente: 0,7rem;
            espacio entre letras: 0,04 em;
            color: #6b7280;
            peso de fuente: 700;
            relleno: 6px 10px;
            borde: ninguno;
        }
        .choices__list--desplegable .choices__item--elección {
            relleno-izquierda: 18px;
        }',
  'Una plataforma pensada para que estudiantes y desarrolladores puedan
                    crear, organizar y compartir sus proyectos en un espacio profesional,
                    claro y accesible.' => 'Una plataforma pensada para que estudiantes y desarrolladores puedan
                    crear, organizar y compartir sus proyectos en un espacio profesional,
                    claro y accesible.',
  'Ir a mi portafolio' => 'Ir a mi portafolio',
  'Crea tu portafolio' => 'Crea tu portafolio',
  'Explorar proyectos' => 'Explorar proyectos',
  'Proyectos Entregados' => 'Proyectos Entregados',
  '100%' => '100%',
  'Satisfaccion' => 'Satisfaccion',
  'Crea tu presencia profesional' => 'Crea tu presencia profesional',
  'Proyectos, habilidades y perfil en un solo lugar' => 'Proyectos, habilidades y perfil en un solo lugar',
  'Contacto' => 'Contacto',
  'Email: {{ $configSitio?->email_contacto ?? \'contacto@quantumdev.dev\' }}' => 'Email: {{ $configSitio?->email_contacto ?? \'contacto@quantumdev.dev\' }}',
  'Tel: {{ $configSitio?->telefono ?? \'+591 700 123 456\' }}' => 'Tel: {{ $configSitio?->telefono ?? \'+591 700 123 456\' }}',
  '© 2026 Portafolio Digital. Todos los derechos reservados.' => '© 2026 Portafolio Digital. Todos los derechos reservados.',
  'Portfolio Digital - @yield(\'title\', \'Admin Panel\')' => 'Portafolio digital: @yield(\'título\', \'Panel de administración\')',
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
            comportamiento de desplazamiento: suave;
        }

        .transición-todo {
            transición: todos los 0,3 s facilitan;
        }

        .transición-todo-suave {
            transición: todos los 0,3 s facilitan;
        }

        .hover-escala: flotar {
            transformar: escala (1.04);
        }

        .elemento de barra lateral: pasar el cursor {
            transformar: traducirX(5px);
            fondo: rgba(0,0,0,0.05);
        }

        .dropdown: situar el cursor sobre .dropdown-menu {
            mostrar: bloquear;
        }

        .nav-link: flotar {
            transformar: traducirY(-1px);
        }

        html, cuerpo {
            altura: 100%;
            desbordamiento-y: automático;
            desbordamiento-x: oculto;
        }

        .contenedor-principal {
            altura mínima: calc(100vh - 4rem);
        }',
  'Ir a la home page' => 'Ir a la home page',
  'Cerrar sesión' => 'Cerrar sesión',
  'Menu' => 'Menú',
  'routeIs(\'admin.dashboard\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'rutaIs(\'admin.dashboard\')? \'bg-[#1e3a5f] texto-blanco\' : \'\' }}">',
  'routeIs(\'admin.dashboard\') ? \'text-white\' : \'text-gray-500\' }}">' => 'rutaIs(\'admin.dashboard\')? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'routeIs(\'admin.usuarios*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'rutaIs(\'admin.usuarios*\') ? \'bg-[#1e3a5f] texto-blanco\' : \'\' }}">',
  'routeIs(\'admin.usuarios*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'rutaIs(\'admin.usuarios*\') ? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'Gestionar usuarios' => 'Gestionar usuarios',
  'routeIs(\'admin.proyectos*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'rutaIs(\'admin.proyectos*\') ? \'bg-[#1e3a5f] texto-blanco\' : \'\' }}">',
  'routeIs(\'admin.proyectos*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'rutaIs(\'admin.proyectos*\') ? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'routeIs(\'admin.habilidades*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'rutaIs(\'admin.skills*\')? \'bg-[#1e3a5f] texto-blanco\': \'\'}}">',
  'routeIs(\'admin.habilidades*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'rutaIs(\'admin.habilidades*\') ? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'routeIs(\'admin.tecnologias*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.tecnologias*\') ? \'bg-[#1e3a5f] texto-blanco\' : \'\' }}">',
  'routeIs(\'admin.tecnologias*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.tecnologias*\') ? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'routeIs(\'admin.perfiles*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.perfiles*\') ? \'bg-[#1e3a5f] texto-blanco\' : \'\' }}">',
  'routeIs(\'admin.perfiles*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.perfiles*\') ? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'Moderar portafolios' => 'Moderar portafolios',
  'routeIs(\'admin.backup*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'rutaIs(\'admin.backup*\')? \'bg-[#1e3a5f] texto-blanco\' : \'\' }}">',
  'routeIs(\'admin.backup*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'rutaIs(\'admin.backup*\')? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'Respaldos' => 'Respaldos',
  'routeIs(\'admin.logs*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'rutaIs(\'admin.logs*\')? \'bg-[#1e3a5f] texto-blanco\' : \'\' }}">',
  'routeIs(\'admin.logs*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'rutaIs(\'admin.logs*\')? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'Bitácora' => 'Bitácora',
  'routeIs(\'admin.papelera*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'rutaIs(\'admin.papelera*\') ? \'bg-[#1e3a5f] texto-blanco\' : \'\' }}">',
  'routeIs(\'admin.papelera*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'rutaIs(\'admin.papelera*\') ? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'routeIs(\'admin.notifications*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'routeIs(\'admin.notificaciones*\')? \'bg-[#1e3a5f] texto-blanco\' : \'\' }}">',
  'routeIs(\'admin.notifications*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'routeIs(\'admin.notificaciones*\')? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'routeIs(\'admin.configuracion*\') ? \'bg-[#1e3a5f] text-white\' : \'\' }}">' => 'rutaIs(\'admin.configuracion*\') ? \'bg-[#1e3a5f] texto-blanco\' : \'\' }}">',
  'routeIs(\'admin.configuracion*\') ? \'text-white\' : \'text-gray-500\' }}">' => 'rutaIs(\'admin.configuracion*\') ? \'texto-blanco\' : \'texto-gris-500\' }}">',
  'SUBMENU' => 'SUBMENÚ',
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
            if (window.innerWidth' => '// Menús desplegables
        document.querySelectorAll(\'.dropdown\').forEach(dropdown => {
            botón constante = dropdown.querySelector(\'botón\');
            menú constante = dropdown.querySelector(\'.menú desplegable\');

            si (botón && menú) {
                button.addEventListener(\'hacer clic\', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll(\'.menú desplegable\').forEach(m => {
                        if (m! == menú) m.classList.add(\'oculto\');
                    });
                    menu.classList.toggle(\'oculto\');
                });
            }
        });

        document.addEventListener(\'hacer clic\', (e) => {
            si (!e.target.closest(\'.dropdown\')) {
                document.querySelectorAll(\'.menú desplegable\').forEach(menú => {
                    menu.classList.add(\'oculto\');
                });
            }
        });

        // Barra lateral móvil
        const sidebarIzq = document.getElementById(\'sidebar-izquierdo\');
        const sidebarOverlay = document.getElementById(\'superposición de barra lateral\');
        const btnMenu = document.getElementById(\'btn-menu-mobile\');

        function cerrarbarras laterales() {
            si (ventana.anchointerior',
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
                barra lateralIzq.classList.remove(\'-translate-x-full\');
                if (sidebarOverlay) sidebarOverlay.classList.remove(\'oculto\');
            });
        }

        si (barra lateralOverlay) {
            sidebarOverlay.addEventListener(\'click\', cerrarSidebars);
        }

        window.addEventListener(\'cambiar tamaño\', () => {
            if (window.innerWidth >= 1024) sidebarIzq.classList.remove(\'-translate-x-full\');
            if (window.innerWidth >= 1024 && sidebarOverlay) sidebarOverlay.classList.add(\'hidden\');
        });

        // Funcionalidad para usuarios normales (secciones)
        @si(!$esAdmin)
        function resaltarLink(seccionId) {
            document.querySelectorAll(\'.seccion-link\').forEach(enlace => {
                link.classList.remove(\'bg-[#1e3a5f]\', \'texto-blanco\');
                link.classList.add(\'texto-gris-700\');
                const icono = link.querySelector(\'i\');
                si (icono) {
                    icono.classList.remove(\'texto-blanco\');
                    icono.classList.add(\'texto-gris-500\');
                }
            });

            const linkActivo = document.querySelector(`.seccion-link[data-seccion="${seccionId}"]`);
            si (enlaceActivo) {
                linkActivo.classList.add(\'bg-[#1e3a5f]\', \'texto-blanco\');
                const icono = linkActivo.querySelector(\'i\');
                si (icono) {
                    icono.classList.remove(\'texto-gris-500\');
                    icono.classList.add(\'texto-blanco\');
                }
            }
        }

        function cambiarSeccion(seccionId) {
            const secciónActiva = document.getElementById(\'sección-\' + secciónId);
            if (secciónActiva) {
                seccionActiva.scrollIntoView({ comportamiento: \'suave\', bloque: \'inicio\' });
            }
            resaltarLink(seccionId);
            cerrarbarras laterales();
        }

        document.querySelectorAll(\'.seccion-link\').forEach(enlace => {
            link.addEventListener(\'hacer clic\', (e) => {
                e.preventDefault();
                const sección = link.getAttribute(\'data-seccion\');
                si (sección) {
                    cambiarSeccion(seccion);
                }
            });
        });

        // desplazamiento-espía
        const secciónObserver = new IntersectionObserver((entradas) => {
            entradas.forEach(entrada => {
                si (entrada.isIntersecting) {
                    const id = entrada.target.id.replace(\'sección-\', \'\');
                    resaltarEnlace(id);
                }
            });
        }, {
            raízMargin: \'-30% 0px -60% 0px\',
            umbral: 0,
        });

        document.querySelectorAll(\'.seccion-contenido\').forEach(s => secciónObserver.observe(s));

        const secciónInicial = new URLSearchParams(window.location.search).get(\'sección\') ?? \'currículum\';
        const elInicial = document.getElementById(\'sección-\' + secciónInicial);
        if (elInicial && secciónInicial !== \'resumen\') {
            elInicial.scrollIntoView({ comportamiento: \'automático\', bloque: \'inicio\' });
        }
        resaltarLink(seccionInicial);
        si (ventana.ubicación.búsqueda) {
            historial.replaceState(nulo, \'\', ventana.ubicación.nombre de ruta);
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
    }' => 'function marcarLeida(id,url) {
        fetch(\'{{ ruta("notificaciones.marcar-leida") }}\', {
            método: \'POST\',
            encabezados: {
                \'X-CSRF-TOKEN\': \'{{ csrf_token() }}\',
                \'Tipo de contenido\': \'aplicación/json\'
            },
            cuerpo: JSON.stringify({ id: id })
        }).entonces(() => {
            si (url) {
                ventana.ubicación.href = url;
            } más {
                ubicación.recargar();
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
                fotoContainer.innerHTML = `' => '// Función para subir foto de perfil 
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
                fotoContainer.innerHTML = `',
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
        lector.readAsDataURL(archivo);
        
        // Mostrar barra de progreso
        const ProgressContainer = document.getElementById(\'progreso-foto-contenedor\');
        const ProgressBar = document.getElementById(\'progreso-foto-bar\');
        si (contenedor de progreso) {
            ProgressContainer.classList.remove(\'oculto\');
        }
        si (barra de progreso) {
            ProgressBar.style.width = \'0%\';
        }
        
        // Progreso similar
        dejar progreso = 0;
        intervalo constante = setInterval(() => {
            progreso += 10;
            si (progreso',
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
                    fotoContainer.innerHTML = `' => 'respuesta.json())
        .entonces(datos => {
            clearInterval(intervalo);
            si (barra de progreso) {
                ProgressBar.style.width = \'100%\';
            }
            
            si (datos.éxito) {
                // Actualizar con la foto real del servidor
                const fotoContainer = document.getElementById(\'perfil-foto-container\');
                si (fotoContenedor) {
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
                
                // También actualizar en el modal de edición si existe
                const modalFoto = document.querySelector(\'#modal-editar-perfil #foto-perfil-actual\');
                if (modalFoto) {
                    modalFoto.innerHTML = `',
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
                
                // Actualizar foto en el encabezado
                const headerFoto = document.querySelector(\'encabezado .img del botón desplegable\');
                si (encabezadoFoto) {
                    headerFoto.src = data.foto_url + \'?t=\' + Fecha.now();
                } más {
                    const headerSpan = document.querySelector(\'encabezado .botón desplegable span.w-10.h-10\');
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
    }',
  'Portfolio Digital - Mis Notificaciones' => 'Portfolio Digital - Mis Notificaciones',
  'visibilidad ?? \'privado\';
    @endphp' => 'visibilidad ?? \'privado\';
    @endphp',
  'Mis Notificaciones' => 'Mis Notificaciones',
  'notificaciones no leídas
                                @else
                                    No tienes notificaciones pendientes
                                @endif' => 'notificaciones no leídas
                                @else
                                    No tienes notificaciones pendientes
                                @endif',
  'Marcar todas como leídas' => 'Marcar todas como leídas',
  'tipo == \'info\') border-blue-500
                        @elseif($notif->tipo == \'success\') border-green-500
                        @elseif($notif->tipo == \'warning\') border-yellow-500
                        @else border-red-500 @endif
                        {{ !$notif->leido ? \'bg-blue-50\' : \'\' }}">' => 'tipo == \'info\') borde-azul-500
                        @elseif($notif->tipo == \'éxito\') borde-verde-500
                        @elseif($notif->tipo == \'advertencia\') borde-amarillo-500
                        @else borde-rojo-500 @endif
                        {{ !$notif->leido ? \'bg-azul-50\': \'\' }}">',
  'Nueva' => 'nueva',
  'id_notification) }}" method="POST">
                                            @csrf' => 'id_notificación) }}" método="POST">
                                            @csrf',
  'Marcar como leída' => 'Marcar como leída',
  'url }}" class="ml-3 text-blue-500 hover:text-blue-700">' => 'URL }}" class="ml-3 text-blue-500 hover:text-blue-700">',
  'No tienes notificaciones' => 'No tienes notificaciones',
  'Cuando recibas notificaciones aparecerán aquí' => 'Cuando recibas notificaciones aparecerán aquí',
  '{ ... },
            onCancel: () => { ... },
        });

     Uso declarativo (forms con confirmación):' => '{ ... },
            onCancel: () => { ... },
        });

     Uso declarativo (forms con confirmación):',
  '...' => '...',
  '--}}' => '--}}',
  '¿Estás seguro?' => '¿Estás seguro?',
  'Esta acción no se puede deshacer.' => 'Esta acción no se puede deshacer.',
  'Confirmar' => 'Confirmar',
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
})();' => '(función () {
    const modal = document.getElementById(\'gcfModal\');
    si (!modal) regresa;

    ajustes preestablecidos constantes = {
        peligro: { encabezado: \'bg-red-500\', iconBg: \'bg-red-50\', iconColor: \'text-red-500\', icon: \'fas fa-trash-alt\', btn: \'bg-red-500 hover:bg-red-600\' },
        advertencia: { encabezado: \'bg-amarillo-500\', iconBg: \'bg-amarillo-50\', iconColor: \'texto-amarillo-500\', ícono: \'fas fa-exclamación-triángulo\', btn: \'bg-amarillo-500 hover:bg-amarillo-600\' },
        éxito: { encabezado: \'bg-green-500\', iconBg: \'bg-green-50\', iconColor: \'text-green-500\', icon: \'fas fa-check-circle\', btn: \'bg-green-500 hover:bg-green-600\' },
        información: { encabezado: \'bg-blue-500\', iconBg: \'bg-blue-50\', iconColor: \'text-blue-500\', icon: \'fas fa-info-circle\', btn: \'bg-blue-500 hover:bg-blue-600\' },
        primario: { header: \'bg-[#1e3a5f]\', iconBg: \'bg-[#1e3a5f]/10\', iconColor: \'text-[#1e3a5f]\', icon: \'fas fa-question-circle\', btn: \'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90\' },
    };

    // Extrae el color base de un btnClass tipo "bg-amarillo-500 hover:bg-amarillo-600"
    // o "bg-[#e11d48] hover:bg-[#e11d48]/80" → "bg-amarillo-500" / "bg-[#e11d48]"
    función derivarHeader(btnClass) {
        si (!btnClass) devuelve nulo;
        const m = btnClass.match(/bg-(?:\\[[^\\]]+\\]|[a-z]+-\\d+)/);
        devolver m? m[0] : nulo;
    }

    ventana.confirmar = función (cfg) {
        cfg = cfg || {};
        const tipo = cfg.tipo || \'peligro\';
        base constante = ajustes preestablecidos[tipo] || presets.peligro;

        const iconoBg = cfg.iconBg || base.iconBg;
        const coloricono = cfg.iconColor || base.iconColor;
        icono constante = cfg.icon || icono.base;
        const btnClass = cfg.btnClass || base.btn;
        // Si no hay headerColor explícito, se infiere del btnClass
        encabezado constante = cfg.headerColor || derivarHeader(btnClass) || base.encabezado;

        document.getElementById(\'gcfHeader\').className = \'h-1.5 w-full\' + encabezado;
        document.getElementById(\'gcfIconWrap\').className = \'w-14 h-14 redondeado-2xl elementos flexibles-centro justificar-centro mx-auto mb-4 \' + iconBg;
        document.getElementById(\'gcfIcon\').className = \'text-2xl \' + icono + \' \' + iconColor;
        document.getElementById(\'gcfTitle\').textContent = cfg.titulo || \'¿Estás seguro?\';
        document.getElementById(\'gcfMessage\').textContent= cfg.mensaje || \'Esta acción no se puede deshacer.\';

        const btnConfirm = document.getElementById(\'gcfBtnConfirm\');
        btnConfirm.textContent = cfg.textoConfirmar || \'Confirmar\';
        btnConfirm.className = \'flex-1 px-4 py-2.5 texto-sm texto-blanco redondeado-xl fuente-transición media \' + btnClass;

        const btnCancel = document.getElementById(\'gcfBtnCancel\');
        btnCancel.textContent = cfg.textoCancelar || \'Cancelar\';
        btnCancel.style.display = cfg.soloConfirmar ? \'ninguno\': \'\';

        btnConfirm.onclick = función () {
            cerrarConfirmar();
            if (tipo de cfg.onConfirm === \'función\') cfg.onConfirm();
            else if (tipo de cfg.accion === \'función\') cfg.accion();
        };
        btnCancel.onclick = función () {
            cerrarConfirmar();
            if (tipo de cfg.onCancel === \'función\') cfg.onCancel();
        };

        modal.classList.remove(\'oculto\');
        modal.classList.add(\'flex\');
    };

    ventana.cerrarConfirmar = funcion () {
        modal.classList.add(\'oculto\');
        modal.classList.remove(\'flex\');
    };

    // Alias retrocompatibles con código existente
    ventana.cerrarConfirmacion = ventana.cerrarConfirmar;
    ventana.cerrarConfirmacionPerfil = ventana.cerrarConfirmar;
    ventana.cerrarConfirmacionExperiencia = ventana.cerrarConfirmar;
    ventana.cerrarConfirmacionEducacion = ventana.cerrarConfirmar;
    ventana.cerrarConfirmacionHabilidad = ventana.cerrarConfirmar;

    // Cerrar al hacer clic en fondo
    modal.addEventListener(\'hacer clic\', función (e) {
        if (e.target === modal) cerrarConfirmar();
    });

    // Cerrar con Escape
    document.addEventListener(\'keydown\', función (e) {
        if (e.key === \'Escape\' && !modal.classList.contains(\'hidden\')) cerrarConfirmar();
    });

    // Auto-handler: formularios con atributo data-confirm
    document.addEventListener(\'enviar\', función (e) {
        forma constante = e.objetivo;
        si (!form.dataset.confirm) regresa;
        si (formulario.conjunto de datos.confirmado === \'1\') {
            form.removeAttribute(\'datos confirmados\');
            regresar;
        }
        e.preventDefault();
        confirmar({
            tipo: form.dataset.confirmType || \'peligro\',
            título: form.dataset.confirmTitle || \'¿Confirmar eliminación?\',
            mensaje: form.dataset.confirm,
            textoConfirmar: form.dataset.confirmButton || \'Eliminar\',
            onConfirm: función () {
                form.dataset.confirmed = \'1\';
                formulario.enviar();
            }
        });
    });
})();',
);
