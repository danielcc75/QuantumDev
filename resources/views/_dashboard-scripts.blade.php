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
                        Sin resultados para "<strong>${q}</strong>"
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
        
    </script>
