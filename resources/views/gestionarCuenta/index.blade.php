{{-- resources/views/gestionarCuenta/index.blade.php --}}

@php
    use Illuminate\Support\Facades\DB;
    $perfilCuenta = DB::table('perfil')->where('id_usuario', $userId)->first();
    $visibilidad  = $perfilCuenta->visibilidad ?? 'publico';
@endphp

{{-- Separador visual --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6 mb-6">
    <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-cog text-blue-500 mr-2"></i>
        Configuración de cuenta
    </h2>

    <div class="space-y-5">

        {{-- ── Cambiar contraseña ───────────────────────────────────────── --}}
        <div class="border border-gray-100 rounded-xl p-5">
            <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                <div class="w-8 h-8 rounded-lg bg-[#1e3a5f]/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-lock text-[#1e3a5f] text-sm"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 text-sm">Cambiar contraseña</h3>
                    <p class="text-xs text-gray-400">Usa una contraseña segura que no uses en otros sitios</p>
                </div>
            </div>
            <form id="form-contrasenia" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Contraseña actual</label>
                    <div class="relative">
                        <input type="password" name="contrasenia_actual" placeholder="••••••••"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pr-11 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/30 focus:border-[#1e3a5f]/50">
                        <button type="button" onclick="togglePasswordVisibility(this)"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-[#1e3a5f] transition-colors">
                            <i class="fas fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Nueva contraseña</label>
                    <div class="relative">
                        <input type="password" name="nueva_contrasenia" placeholder="••••••••"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pr-11 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/30 focus:border-[#1e3a5f]/50">
                        <button type="button" onclick="togglePasswordVisibility(this)"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-[#1e3a5f] transition-colors">
                            <i class="fas fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Confirmar nueva contraseña</label>
                    <div class="relative">
                        <input type="password" name="nueva_contrasenia_confirmation" placeholder="••••••••"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pr-11 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/30 focus:border-[#1e3a5f]/50">
                        <button type="button" onclick="togglePasswordVisibility(this)"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-[#1e3a5f] transition-colors">
                            <i class="fas fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>
                <div class="sm:col-span-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <p class="text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Mínimo 8 caracteres, una mayúscula, un número y un símbolo.
                    </p>
                    <button type="button" onclick="confirmarCambiarContrasenia()"
                        class="inline-flex items-center gap-2 bg-[#1e3a5f] hover:bg-[#e11d48] text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-colors duration-200 flex-shrink-0">
                        <i class="fas fa-key text-xs"></i> Cambiar contraseña
                    </button>
                </div>
            </form>
        </div>

        {{-- ── Visibilidad del perfil ───────────────────────────────────── --}}
        <div class="border border-gray-100 rounded-xl p-5">
            <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                <div class="w-8 h-8 rounded-lg bg-[#1e3a5f]/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-eye text-[#1e3a5f] text-sm"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 text-sm">Visibilidad del perfil</h3>
                    <p class="text-xs text-gray-400">Controla quién puede ver tu portafolio</p>
                </div>
            </div>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-700" id="label-visibilidad">
                        {{ $visibilidad === 'publico' ? 'Perfil público' : 'Perfil privado' }}
                    </p>
                    <p class="text-xs text-gray-400 mt-0.5" id="desc-visibilidad">
                        {{ $visibilidad === 'publico'
                            ? 'Cualquier persona puede ver tu portafolio'
                            : 'Solo tú puedes ver tu portafolio' }}
                    </p>
                </div>
                <button type="button" id="btn-visibilidad"
                    onclick="confirmarCambiarVisibilidad()"
                    data-actual="{{ $visibilidad }}"
                    class="relative inline-flex h-7 w-14 flex-shrink-0 items-center rounded-full transition-colors duration-300
                           {{ $visibilidad === 'publico' ? 'bg-[#1e3a5f]' : 'bg-gray-300' }}">
                    <span id="toggle-dot"
                        class="inline-block h-5 w-5 transform rounded-full bg-white shadow transition-transform duration-300
                               {{ $visibilidad === 'publico' ? 'translate-x-8' : 'translate-x-1' }}">
                    </span>
                </button>
            </div>
            <div class="mt-3">
                <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full
                    {{ $visibilidad === 'publico' ? 'bg-[#1e3a5f]/10 text-[#1e3a5f]' : 'bg-gray-100 text-gray-500' }}"
                    id="badge-visibilidad">
                    <i class="fas {{ $visibilidad === 'publico' ? 'fa-globe' : 'fa-lock' }} text-[10px]"></i>
                    {{ $visibilidad === 'publico' ? 'Público' : 'Privado' }}
                </span>
            </div>
        </div>

        {{-- ── Zona de peligro ──────────────────────────────────────────── --}}
        <div class="border border-[#e11d48]/30 rounded-xl p-5 bg-red-50/50">
            <div class="flex items-center gap-3 mb-4 pb-3 border-b border-[#e11d48]/20">
                <div class="w-8 h-8 rounded-lg bg-[#e11d48]/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-[#e11d48] text-sm"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-[#e11d48] text-sm">Zona de peligro</h3>
                    <p class="text-xs text-gray-400">Acción sensible sobre tu cuenta</p>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <p class="text-sm font-medium text-gray-800">Desactivar cuenta</p>
                    <p class="text-xs text-gray-500 mt-0.5">Perderás el acceso a tu cuenta y tu portafolio dejará de ser visible. Tus datos se conservan, pero no podrás volver a iniciar sesión.</p>
                </div>
                <button type="button" onclick="confirmarDesactivarCuenta()"
                    class="inline-flex items-center gap-2 bg-[#e11d48] hover:bg-red-700 text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-colors duration-200 flex-shrink-0">
                    <i class="fas fa-user-slash text-xs"></i> Desactivar cuenta
                </button>
            </div>
        </div>

    </div>
</div>

<script>
(function () {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    // ── Ver / ocultar contraseña ───────────────────────────────────────────
    window.togglePasswordVisibility = function (btn) {
        const input = btn.closest('.relative').querySelector('input');
        const icon  = btn.querySelector('i');
        const mostrar = input.type === 'password';
        input.type = mostrar ? 'text' : 'password';
        icon.classList.toggle('fa-eye',       !mostrar);
        icon.classList.toggle('fa-eye-slash',  mostrar);
    };

    // ── Cambiar contraseña ─────────────────────────────────────────────────
    window.confirmarCambiarContrasenia = function () {
        const form         = document.getElementById('form-contrasenia');
        const actual       = form.querySelector('[name="contrasenia_actual"]').value;
        const nueva        = form.querySelector('[name="nueva_contrasenia"]').value;
        const confirmacion = form.querySelector('[name="nueva_contrasenia_confirmation"]').value;

        if (!actual || !nueva || !confirmacion) {
            Swal.fire({ icon: 'warning', title: 'Campos requeridos', text: 'Completa todos los campos de contraseña.', confirmButtonColor: '#1e3a5f' });
            return;
        }

        Swal.fire({
            title: '¿Cambiar contraseña?',
            text: 'Tu contraseña actual quedará invalidada.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3a5f',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, cambiar',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch('{{ route("cuenta.contrasenia") }}', {
                method: 'PUT',
                headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ contrasenia_actual: actual, nueva_contrasenia: nueva, nueva_contrasenia_confirmation: confirmacion })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    form.reset();
                    Swal.fire({ icon: 'success', title: '¡Contraseña cambiada!', text: 'Tu contraseña fue actualizada correctamente.', confirmButtonColor: '#1e3a5f' });
                } else {
                    const msgs = res.errors
                        ? Object.values(res.errors).flat().join('\n')
                        : (res.message ?? 'Error al cambiar la contraseña.');
                    Swal.fire({ icon: 'error', title: 'Error', text: msgs, confirmButtonColor: '#1e3a5f' });
                }
            })
            .catch(() => Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar al servidor.', confirmButtonColor: '#1e3a5f' }));
        });
    };

    // ── Aplicar UI público ─────────────────────────────────────────────────
    window.aplicarVisibilidadPublica = function () {
        const btn   = document.getElementById('btn-visibilidad');
        const dot   = document.getElementById('toggle-dot');
        const label = document.getElementById('label-visibilidad');
        const desc  = document.getElementById('desc-visibilidad');
        const badge = document.getElementById('badge-visibilidad');
        btn.dataset.actual = 'publico';
        btn.classList.replace('bg-gray-300', 'bg-[#1e3a5f]');
        dot.classList.replace('translate-x-1', 'translate-x-8');
        label.textContent = 'Perfil público';
        desc.textContent  = 'Cualquier persona puede ver tu portafolio';
        badge.className   = 'inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-[#1e3a5f]/10 text-[#1e3a5f]';
        badge.innerHTML   = '<i class="fas fa-globe text-[10px]"></i> Público';
    };

    // ── Visibilidad ────────────────────────────────────────────────────────
    window.confirmarCambiarVisibilidad = function () {
        const btn    = document.getElementById('btn-visibilidad');
        const actual = btn.dataset.actual;
        const nueva  = actual === 'publico' ? 'privado' : 'publico';

        // Activando público: abrir modal de selección
        if (nueva === 'publico') {
            if (typeof window.abrirModalPublicar === 'function') {
                window.abrirModalPublicar();
            }
            return;
        }

        // Pasando a privado: confirmación rápida
        Swal.fire({
            title: '¿Hacer perfil privado?',
            text: 'Solo tú podrás ver tu portafolio.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3a5f',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, hacer privado',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch('{{ route("cuenta.visibilidad") }}', {
                method: 'PUT',
                headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ visibilidad: 'privado' })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    const dot   = document.getElementById('toggle-dot');
                    const label = document.getElementById('label-visibilidad');
                    const desc  = document.getElementById('desc-visibilidad');
                    const badge = document.getElementById('badge-visibilidad');
                    btn.dataset.actual = 'privado';
                    btn.classList.replace('bg-[#1e3a5f]', 'bg-gray-300');
                    dot.classList.replace('translate-x-8', 'translate-x-1');
                    label.textContent = 'Perfil privado';
                    desc.textContent  = 'Solo tú puedes ver tu portafolio';
                    badge.className   = 'inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-500';
                    badge.innerHTML   = '<i class="fas fa-lock text-[10px]"></i> Privado';

                    Swal.fire({ icon: 'success', title: '¡Listo!', text: 'Tu perfil ahora es privado.', confirmButtonColor: '#1e3a5f', timer: 2000, showConfirmButton: false });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: res.message ?? 'No se pudo cambiar la visibilidad.', confirmButtonColor: '#1e3a5f' });
                }
            })
            .catch(() => Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar al servidor.', confirmButtonColor: '#1e3a5f' }));
        });
    };

    // ── Desactivar cuenta ──────────────────────────────────────────────────
    window.confirmarDesactivarCuenta = function () {
        Swal.fire({
            title: '¿Desactivar tu cuenta?',
            html: `
                <p class="text-sm text-gray-600 mb-3">Tu cuenta quedará <strong>inactiva</strong> y <strong>no podrás volver a iniciar sesión</strong>. Tus datos se conservan, pero el acceso queda bloqueado.</p>
                <p class="text-sm text-gray-600 mb-2">Ingresa tu <strong>contraseña actual</strong> para confirmar:</p>
                <input id="swal-confirmar-desactivar" type="password" class="swal2-input" placeholder="••••••••" autocomplete="current-password">
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Desactivar cuenta',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const val = document.getElementById('swal-confirmar-desactivar').value;
                if (!val) {
                    Swal.showValidationMessage('Debes ingresar tu contraseña para confirmar');
                    return false;
                }
                return val;
            }
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch('{{ route("cuenta.desactivar") }}', {
                method: 'PUT',
                headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ contrasenia: result.value })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cuenta desactivada',
                        text: 'Tu cuenta ha sido desactivada. Serás redirigido.',
                        confirmButtonColor: '#1e3a5f',
                        timer: 2500,
                        showConfirmButton: false
                    }).then(() => { window.location.href = res.redirect ?? '/'; });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: res.message ?? 'No se pudo desactivar la cuenta.', confirmButtonColor: '#1e3a5f' });
                }
            })
            .catch(() => Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar al servidor.', confirmButtonColor: '#1e3a5f' }));
        });
    };
})();
</script>

@include('gestionarCuenta._modal_publicar')
