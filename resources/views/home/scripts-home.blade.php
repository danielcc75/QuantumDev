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
            } else if (contrasenia.length < 6) {
                marcarInputErrorRegister(registerContrasenia, registerContraseniaError, 'La contraseña debe tener al menos 6 caracteres.');
                hayErrores = true;
            }

            if (!confirmacion) {
                marcarInputErrorRegister(registerContraseniaConfirmacion, registerContraseniaConfirmacionError, 'Debes confirmar tu contraseña.');
                hayErrores = true;
            }

            if (hayErrores) return;

            if (contrasenia !== confirmacion) {
                mostrarErrorGeneralRegister('Las contraseñas no coinciden.');
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
</script>