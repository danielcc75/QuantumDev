<script>
    function abrirLogin() {
        const modal = document.getElementById('modalLogin');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function cerrarLogin() {
        const modal = document.getElementById('modalLogin');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function abrirRegister() {
        const modal = document.getElementById('modalRegister');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function cerrarRegister() {
        const modal = document.getElementById('modalRegister');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
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

    const flashMessage = document.getElementById('flashMessage');

    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.opacity = '0';
            flashMessage.style.transform = 'translateY(-10px)';

            setTimeout(() => {
                flashMessage.remove();
            }, 500);
        }, 3000);
    }

    const menuLinks = document.querySelectorAll('.menu-link');
    const secciones = document.querySelectorAll('#inicio, #explorar, #como-funciona, #sobre-nosotros');

    function activarMenuActual() {
        let seccionActual = 'inicio';
        const puntoReferencia = window.scrollY + 140;

        secciones.forEach(seccion => {
            const top = seccion.offsetTop;
            const height = seccion.offsetHeight;

            if (puntoReferencia >= top && puntoReferencia < top + height) {
                seccionActual = seccion.getAttribute('id');
            }
        });

        menuLinks.forEach(link => {
            link.classList.remove('text-[#e11d48]', 'font-bold');
            link.classList.add('text-gray-600');

            if (link.getAttribute('href') === `#${seccionActual}`) {
                link.classList.remove('text-gray-600');
                link.classList.add('text-[#e11d48]', 'font-bold');
            }
        });
    }

    window.addEventListener('scroll', activarMenuActual);
    window.addEventListener('load', activarMenuActual);

    menuLinks.forEach(link => {
        link.addEventListener('click', function () {
            menuLinks.forEach(item => {
                item.classList.remove('text-[#e11d48]', 'font-bold');
                item.classList.add('text-gray-600');
            });

            this.classList.remove('text-gray-600');
            this.classList.add('text-[#e11d48]', 'font-bold');
        });
    });

    const loginForm = document.getElementById('loginForm');
    const loginCorreo = document.getElementById('loginCorreo');
    const loginContrasenia = document.getElementById('loginContrasenia');
    const loginErrorBox = document.getElementById('loginErrorBox');
    const loginCorreoError = document.getElementById('loginCorreoError');
    const loginContraseniaError = document.getElementById('loginContraseniaError');

    function mostrarErrorGeneralLogin(mensaje) {
        if (!loginErrorBox) return;
        loginErrorBox.textContent = mensaje;
        loginErrorBox.classList.remove('hidden');
    }

    function limpiarErrorGeneralLogin() {
        if (!loginErrorBox) return;
        loginErrorBox.textContent = '';
        loginErrorBox.classList.add('hidden');
    }

    function marcarInputError(input, errorElement, mensaje) {
        if (!input || !errorElement) return;
        input.classList.add('border-red-500', 'ring-2', 'ring-red-200');
        input.classList.remove('border-gray-300');
        errorElement.textContent = mensaje;
        errorElement.classList.remove('hidden');
    }

    function limpiarInputError(input, errorElement) {
        if (!input || !errorElement) return;
        input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
        input.classList.add('border-gray-300');
        errorElement.textContent = '';
        errorElement.classList.add('hidden');
    }

    function limpiarErroresLogin() {
        limpiarErrorGeneralLogin();
        limpiarInputError(loginCorreo, loginCorreoError);
        limpiarInputError(loginContrasenia, loginContraseniaError);
    }

    if (loginForm) {
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            limpiarErroresLogin();

            const correo = loginCorreo?.value.trim() || '';
            const contrasenia = loginContrasenia?.value.trim() || '';

            let hayErrores = false;

            if (!correo) {
                marcarInputError(loginCorreo, loginCorreoError, 'Debes ingresar tu correo electrónico.');
                hayErrores = true;
            } else {
                const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailValido.test(correo)) {
                    marcarInputError(loginCorreo, loginCorreoError, 'Ingresa un correo electrónico válido.');
                    hayErrores = true;
                }
            }

            if (!contrasenia) {
                marcarInputError(loginContrasenia, loginContraseniaError, 'Debes ingresar tu contraseña.');
                hayErrores = true;
            }

            if (hayErrores) return;

            const formData = new FormData(loginForm);

            try {
                const response = await fetch(loginForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const contentType = response.headers.get('content-type') || '';

                if (!contentType.includes('application/json')) {
                    mostrarErrorGeneralLogin('La respuesta del servidor no fue válida.');
                    return;
                }

                const data = await response.json();

                if (!response.ok) {
                    mostrarErrorGeneralLogin(data.message || 'No se pudo iniciar sesión.');
                    return;
                }

                if (data.ok && data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    mostrarErrorGeneralLogin('Ocurrió un error inesperado.');
                }

            } catch (error) {
                mostrarErrorGeneralLogin('No se pudo conectar con el servidor. Intenta nuevamente.');
            }
        });

        [loginCorreo, loginContrasenia].forEach(input => {
            if (input) {
                input.addEventListener('input', () => {
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

    const registerForm = document.getElementById('registerForm');
    const registerNombre = document.getElementById('registerNombre');
    const registerApellido = document.getElementById('registerApellido');
    const registerCorreo = document.getElementById('registerCorreo');
    const registerTelefono = document.getElementById('registerTelefono');
    const registerContrasenia = document.getElementById('registerContrasenia');
    const registerContraseniaConfirmacion = document.getElementById('registerContraseniaConfirmacion');
    const registerErrorBox = document.getElementById('registerErrorBox');

    const registerNombreError = document.getElementById('registerNombreError');
    const registerApellidoError = document.getElementById('registerApellidoError');
    const registerCorreoError = document.getElementById('registerCorreoError');
    const registerTelefonoError = document.getElementById('registerTelefonoError');
    const registerContraseniaError = document.getElementById('registerContraseniaError');
    const registerContraseniaConfirmacionError = document.getElementById('registerContraseniaConfirmacionError');

    function mostrarErrorGeneralRegister(mensaje) {
        if (!registerErrorBox) return;
        registerErrorBox.textContent = mensaje;
        registerErrorBox.classList.remove('hidden');
    }

    function limpiarErrorGeneralRegister() {
        if (!registerErrorBox) return;
        registerErrorBox.textContent = '';
        registerErrorBox.classList.add('hidden');
    }

    function marcarInputErrorRegister(input, errorElement, mensaje) {
        if (!input || !errorElement) return;
        input.classList.add('border-red-500', 'ring-2', 'ring-red-200');
        input.classList.remove('border-gray-300');
        errorElement.textContent = mensaje;
        errorElement.classList.remove('hidden');
    }

    function limpiarInputErrorRegister(input, errorElement) {
        if (!input || !errorElement) return;
        input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
        input.classList.add('border-gray-300');
        errorElement.textContent = '';
        errorElement.classList.add('hidden');
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
        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            limpiarErroresRegister();

            const nombre = registerNombre?.value.trim() || '';
            const apellido = registerApellido?.value.trim() || '';
            const correo = registerCorreo?.value.trim() || '';
            const telefono = registerTelefono?.value.trim() || '';
            const contrasenia = registerContrasenia?.value || '';
            const confirmacion = registerContraseniaConfirmacion?.value || '';

            let hayErrores = false;

            if (!nombre) {
                marcarInputErrorRegister(registerNombre, registerNombreError, 'Debes ingresar tu nombre.');
                hayErrores = true;
            }

            if (!apellido) {
                marcarInputErrorRegister(registerApellido, registerApellidoError, 'Debes ingresar tus apellidos.');
                hayErrores = true;
            }

            if (!correo) {
                marcarInputErrorRegister(registerCorreo, registerCorreoError, 'Debes ingresar tu correo electrónico.');
                hayErrores = true;
            } else {
                const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailValido.test(correo)) {
                    marcarInputErrorRegister(registerCorreo, registerCorreoError, 'Ingresa un correo electrónico válido.');
                    hayErrores = true;
                }
            }

            if (telefono.length > 50) {
                marcarInputErrorRegister(registerTelefono, registerTelefonoError, 'El teléfono no debe exceder los 50 caracteres.');
                hayErrores = true;
            }

            if (!contrasenia) {
                marcarInputErrorRegister(registerContrasenia, registerContraseniaError, 'Debes ingresar una contraseña.');
                hayErrores = true;
            } else if (contrasenia.length < 8) {
                marcarInputErrorRegister(registerContrasenia, registerContraseniaError, 'La contraseña debe tener al menos 8 caracteres.');
                hayErrores = true;
            } else if (!/[a-z]/.test(contrasenia)) {
                marcarInputErrorRegister(registerContrasenia, registerContraseniaError, 'La contraseña debe incluir al menos una letra minúscula.');
                hayErrores = true;
            } else if (!/[A-Z]/.test(contrasenia)) {
                marcarInputErrorRegister(registerContrasenia, registerContraseniaError, 'La contraseña debe incluir al menos una letra mayúscula.');
                hayErrores = true;
            } else if (!/[0-9]/.test(contrasenia)) {
                marcarInputErrorRegister(registerContrasenia, registerContraseniaError, 'La contraseña debe incluir al menos un número.');
                hayErrores = true;
            } else if (!/[^A-Za-z0-9]/.test(contrasenia)) {
                marcarInputErrorRegister(registerContrasenia, registerContraseniaError, 'La contraseña debe incluir al menos un símbolo.');
                hayErrores = true;
            }

            if (!confirmacion) {
                marcarInputErrorRegister(registerContraseniaConfirmacion, registerContraseniaConfirmacionError, 'Debes confirmar tu contraseña.');
                hayErrores = true;
            }

            if (hayErrores) return;

            if (contrasenia !== confirmacion) {
                marcarInputErrorRegister(
                    registerContraseniaConfirmacion,
                    registerContraseniaConfirmacionError,
                    'Las contraseñas no coinciden.'
                );
                return;
            }

            const formData = new FormData(registerForm);

            try {
                const response = await fetch(registerForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const contentType = response.headers.get('content-type') || '';

                if (!contentType.includes('application/json')) {
                    mostrarErrorGeneralRegister('La respuesta del servidor no fue válida.');
                    return;
                }

                const data = await response.json();

                if (!response.ok) {
                    if (data.errors) {
                        if (data.errors.nombre) {
                            marcarInputErrorRegister(registerNombre, registerNombreError, data.errors.nombre[0]);
                        }
                        if (data.errors.apellido) {
                            marcarInputErrorRegister(registerApellido, registerApellidoError, data.errors.apellido[0]);
                        }
                        if (data.errors.correo_electronico) {
                            marcarInputErrorRegister(registerCorreo, registerCorreoError, data.errors.correo_electronico[0]);
                        }
                        if (data.errors.telefono) {
                            marcarInputErrorRegister(registerTelefono, registerTelefonoError, data.errors.telefono[0]);
                        }
                        if (data.errors.contrasenia) {
                            marcarInputErrorRegister(registerContrasenia, registerContraseniaError, data.errors.contrasenia[0]);
                        }
                    } else {
                        mostrarErrorGeneralRegister(data.message || 'No se pudo crear la cuenta.');
                    }
                    return;
                }

                if (data.ok && data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    mostrarErrorGeneralRegister('Ocurrió un error inesperado.');
                }

            } catch (error) {
                mostrarErrorGeneralRegister('No se pudo conectar con el servidor. Intenta nuevamente.');
            }
        });

        [
            registerNombre,
            registerApellido,
            registerCorreo,
            registerTelefono,
            registerContrasenia,
            registerContraseniaConfirmacion
        ].forEach(input => {
            if (input) {
                input.addEventListener('input', () => {
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

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // ── Buscador público de portafolios ────────────────────────────────────
    (function inicializarBuscadorPortafolios() {
        const form        = document.getElementById('form-buscador-portafolios');
        const contenedor  = document.getElementById('buscador-portafolios-resultados');
        const skeleton    = document.getElementById('buscador-portafolios-skeleton');
        const vacio       = document.getElementById('buscador-portafolios-vacio');
        const estado      = document.getElementById('buscador-portafolios-estado');
        const btnCargarMas = document.getElementById('btn-buscador-cargar-mas');
        if (!form || !contenedor) return;

        const LIMITE = 12;
        let offset = 0;
        let total  = 0;
        let cargando = false;
        let filtrosActuales = {};
        const choicesInstances = {};

        // Catálogo original de tecnologías (preservado al inicializar)
        let catalogoTecnologias = null;

        // Inicializa Choices.js en los <select> del buscador (multi y single).
        function inicializarChoices() {
            if (typeof Choices === 'undefined') return;

            // Multiselects con pills
            form.querySelectorAll('select[data-buscador-multi]').forEach(sel => {
                const key = sel.dataset.buscadorMulti;
                if (choicesInstances[key]) return;

                // Capturamos el catálogo original de tecnologías antes de que Choices lo mueva
                if (key === 'tecnologias' && !catalogoTecnologias) {
                    catalogoTecnologias = construirCatalogoTecnologias(sel);
                }

                const inst = new Choices(sel, {
                    removeItemButton: true,
                    shouldSort: false,
                    placeholder: true,
                    placeholderValue: sel.getAttribute('placeholder') || 'Selecciona...',
                    noResultsText: 'Sin coincidencias',
                    noChoicesText: 'No hay más opciones',
                    itemSelectText: '',
                    classNames: { containerInner: 'choices__inner buscador-choice' },
                });
                inst.containerOuter.element.classList.add('buscador-multi-' + key);
                choicesInstances[key] = inst;
            });

            // Selects single (uno solo seleccionable)
            form.querySelectorAll('select[data-buscador-single]').forEach(sel => {
                const key = sel.dataset.buscadorSingle;
                if (choicesInstances[key]) return;
                const inst = new Choices(sel, {
                    shouldSort: false,
                    searchEnabled: true,
                    noResultsText: 'Sin coincidencias',
                    itemSelectText: '',
                    classNames: { containerInner: 'choices__inner buscador-choice' },
                });
                inst.containerOuter.element.classList.add('buscador-single-' + key);
                choicesInstances[key] = inst;
            });

            // Conectar: cuando cambia la categoría de tecnología, repintar el dropdown de tecnologías
            const selectCatTec = form.querySelector('select[data-buscador-single="categoriatec"]');
            if (selectCatTec) {
                selectCatTec.addEventListener('change', () => filtrarTecnologiasPorCategoria());
            }
        }

        // Lee los <optgroup>/<option> originales y construye una estructura [{label, choices: [{value, label, customProperties}]}]
        function construirCatalogoTecnologias(sel) {
            const grupos = [];
            sel.querySelectorAll('optgroup').forEach(og => {
                const label = og.getAttribute('label') || 'Otras';
                const choices = Array.from(og.querySelectorAll('option')).map(op => ({
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
            const instTec = choicesInstances['tecnologias'];
            const instCat = choicesInstances['categoriatec'];
            if (!instTec || !instCat || !catalogoTecnologias) return;

            const catSeleccionada  = instCat.getValue(true) || '';
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
                    label: 'Seleccionadas (fuera del filtro)',
                    id: '__huerfanas__',
                    choices: huerfanas.map(v => ({ value: v, label: v, selected: true })),
                });
            }

            instTec.clearChoices();
            instTec.setChoices(gruposParaChoices, 'value', 'label', true);
        }

        // Choices.js se carga con defer; esperamos hasta que esté disponible.
        if (typeof Choices !== 'undefined') {
            inicializarChoices();
        } else {
            const intento = setInterval(() => {
                if (typeof Choices !== 'undefined') {
                    clearInterval(intento);
                    inicializarChoices();
                }
            }, 50);
        }

        const ENDPOINT = @json(route('portafolios.buscar'));

        function obtenerFiltros() {
            const fd = new FormData(form);
            const filtros = {
                q: (fd.get('q') || '').trim(),
                anios_min: parseInt(fd.get('anios_min') || '0', 10) || 0,
                ubicacion: (fd.get('ubicacion') || '').trim(),
                con_proyectos: fd.get('con_proyectos') ? 1 : 0,
                tecnologias:   fd.getAll('tecnologias[]'),
                categoria_tec: (fd.get('categoria_tec') || '').trim(),
                categorias:    fd.getAll('categorias[]').map(v => parseInt(v, 10)).filter(Boolean),
            };
            return filtros;
        }

        function construirQueryString(filtros, offsetVal, limitVal) {
            const params = new URLSearchParams();
            if (filtros.q) params.append('q', filtros.q);
            if (filtros.anios_min) params.append('anios_min', filtros.anios_min);
            if (filtros.ubicacion) params.append('ubicacion', filtros.ubicacion);
            if (filtros.con_proyectos) params.append('con_proyectos', 1);
            filtros.tecnologias.forEach(t => params.append('tecnologias[]', t));
            if (filtros.categoria_tec) params.append('categoria_tec', filtros.categoria_tec);
            filtros.categorias.forEach(c => params.append('categorias[]', c));
            params.append('offset', offsetVal);
            params.append('limit',  limitVal);
            return params.toString();
        }

        function escapeHtmlBP(s) {
            const d = document.createElement('div');
            d.textContent = s ?? '';
            return d.innerHTML;
        }

        function renderizarTarjeta(p) {
            const avatar = p.foto
                ? `<img src="${escapeHtmlBP(p.foto)}" alt="${escapeHtmlBP(p.nombre)}" class="absolute -bottom-6 left-5 w-14 h-14 rounded-full object-cover ring-4 ring-white shadow-md bg-white">`
                : `<div class="absolute -bottom-6 left-5 w-14 h-14 rounded-full bg-[#1e3a5f] text-white flex items-center justify-center font-bold text-base ring-4 ring-white shadow-md">${escapeHtmlBP(p.iniciales)}</div>`;

            const tagsHtml = (p.tags || []).map(t =>
                `<span class="text-xs font-medium bg-[#1e3a5f]/8 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2.5 py-0.5 rounded-full">${escapeHtmlBP(t)}</span>`
            ).join('');
            const tagsExtra = (p.tags_extra > 0)
                ? `<span class="text-xs font-medium bg-[#e11d48]/8 text-[#e11d48] border border-[#e11d48]/15 px-2.5 py-0.5 rounded-full">+${p.tags_extra}</span>`
                : '';

            const article = document.createElement('article');
            article.className = 'bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all-soft overflow-hidden flex flex-col';
            article.innerHTML = `
                <div class="relative h-28" style="background-image: linear-gradient(135deg, ${p.cover_from} 0%, ${p.cover_to} 100%);">
                    <div class="absolute inset-0 opacity-20"
                         style="background-image: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.4) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255,255,255,0.3) 0%, transparent 50%);"></div>
                    ${avatar}
                </div>
                <div class="px-5 pt-9 pb-5 flex flex-col gap-3 flex-1">
                    <div>
                        <h3 class="font-bold text-gray-900 text-base leading-tight">${escapeHtmlBP(p.nombre)}</h3>
                        <p class="text-sm font-semibold text-[#e11d48] mt-0.5">${escapeHtmlBP(p.rol)}</p>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-2">${escapeHtmlBP(p.descripcion)}</p>
                    <div class="flex flex-wrap gap-1.5">${tagsHtml}${tagsExtra}</div>
                    <div class="flex items-center justify-between text-xs text-gray-600 pt-3 mt-auto border-t border-gray-100">
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-briefcase text-[#1e3a5f]"></i>
                            ${escapeHtmlBP(p.anios)}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-code text-[#1e3a5f]"></i>
                            ${escapeHtmlBP(p.proyectos)}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-500 flex items-center gap-1.5">
                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                            ${escapeHtmlBP(p.ubicacion)}
                        </span>
                        <button type="button" class="font-semibold text-[#e11d48] hover:text-[#1e3a5f] transition-colors flex items-center gap-1">
                            Ver portafolio
                            <i class="fas fa-external-link-alt text-[10px]"></i>
                        </button>
                    </div>
                </div>
            `;

            const btnVer = article.querySelector('button');
            btnVer.dataset.portafolio = JSON.stringify(p);
            btnVer.addEventListener('click', () => {
                if (typeof abrirModalPortafolio === 'function') abrirModalPortafolio(btnVer);
            });

            return article;
        }

        window.buscarPortafolios = async function (reset) {
            if (cargando) return;
            cargando = true;

            if (reset) {
                offset = 0;
                contenedor.innerHTML = '';
                filtrosActuales = obtenerFiltros();
            }

            btnCargarMas.classList.add('hidden');
            vacio.classList.add('hidden');
            if (reset) {
                skeleton.classList.remove('hidden');
                estado.textContent = 'Buscando portafolios...';
            } else {
                estado.textContent = 'Cargando más...';
            }

            try {
                const qs = construirQueryString(filtrosActuales, offset, LIMITE);
                const res = await fetch(`${ENDPOINT}?${qs}`, { headers: { 'Accept': 'application/json' } });
                if (!res.ok) throw new Error('Error HTTP ' + res.status);
                const data = await res.json();

                total = data.total ?? 0;
                (data.items || []).forEach(p => contenedor.appendChild(renderizarTarjeta(p)));
                offset += (data.items || []).length;

                if (total === 0) {
                    estado.textContent = '';
                    vacio.classList.remove('hidden');
                } else {
                    estado.textContent = `Mostrando ${contenedor.children.length} de ${total} portafolio${total === 1 ? '' : 's'}`;
                }

                if (data.hay_mas) btnCargarMas.classList.remove('hidden');
            } catch (e) {
                estado.textContent = 'No se pudo cargar los portafolios. Intenta de nuevo.';
            } finally {
                skeleton.classList.add('hidden');
                cargando = false;
            }
        };

        window.limpiarFiltrosPortafolios = function () {
            // No usamos form.reset() porque Choices.js gestiona sus <select> en un DOM aparte
            // y el reset deja los selects inconsistentes (sin opciones visibles).
            form.querySelectorAll('input').forEach(i => {
                if (i.type === 'checkbox' || i.type === 'radio') i.checked = false;
                else i.value = '';
            });
            // Multis: quitar todas las pills
            ['tecnologias', 'categorias'].forEach(k => {
                const c = choicesInstances[k];
                c && c.removeActiveItems && c.removeActiveItems();
            });
            // Single: volver al placeholder
            const single = choicesInstances['categoriatec'];
            if (single) {
                single.setChoiceByValue('');
            }
            // Restaurar el dropdown completo de tecnologías
            filtrarTecnologiasPorCategoria();
            buscarPortafolios(true);
        };

        // Carga inicial
        buscarPortafolios(true);
    })();
</script>