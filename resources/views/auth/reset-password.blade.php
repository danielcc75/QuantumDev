<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center px-4 min-h-screen">

<div class="w-full max-w-md bg-[#f3f4f6] rounded-xl shadow-xl overflow-hidden">

    <!-- HEADER -->
    <div class="bg-[#1e3a5f] text-center px-6 py-6">
        <div class="flex justify-center items-center gap-2 mb-1">
            <i class="fas fa-lock text-white text-xl"></i>
            <h2 class="text-white text-2xl font-bold">
                Restablecer contraseña
            </h2>
        </div>
        <p class="text-gray-200 text-sm">
            Ingresa tu nueva contraseña
        </p>
    </div>

    <!-- BODY -->
    <div class="p-6">

        <!-- ERROR GENERAL -->
        <div id="resetErrorBox"
             class="hidden mb-4 text-sm bg-red-100 border border-red-300 text-red-700 p-3 rounded-md"></div>

        <form id="resetPasswordForm" method="POST" action="/reset-password" class="space-y-4">

            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            @php
                $inputClass = "w-full mt-1 px-3 py-2 rounded-md border border-gray-300 bg-white outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20";
            @endphp

            <!-- PASSWORD -->
            <div>
                <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                    <i class="fas fa-lock text-[#1e3a5f] text-xs"></i>
                    Nueva contraseña
                </label>

                <div class="relative">
                    <input id="resetPassword"
                           type="password"
                           name="contrasenia"
                           class="{{ $inputClass }} pr-10"
                           placeholder="••••••••">

                    <button type="button"
                            onclick="togglePassword('resetPassword', 'iconPass1')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1e3a5f]">
                        <i id="iconPass1" class="fas fa-eye"></i>
                    </button>
                </div>

                <p id="errorPassword" class="hidden mt-1 text-sm text-red-600"></p>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div>
                <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                    <i class="fas fa-lock text-[#1e3a5f] text-xs"></i>
                    Confirmar contraseña
                </label>

                <div class="relative">
                    <input id="resetPasswordConfirm"
                           type="password"
                           name="contrasenia_confirmation"
                           class="{{ $inputClass }} pr-10"
                           placeholder="••••••••">

                    <button type="button"
                            onclick="togglePassword('resetPasswordConfirm', 'iconPass2')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1e3a5f]">
                        <i id="iconPass2" class="fas fa-eye"></i>
                    </button>
                </div>

                <p id="errorConfirm" class="hidden mt-1 text-sm text-red-600"></p>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full bg-[#1e3a5f] text-white py-3 rounded-md font-semibold hover:bg-[#16304d] transition">
                Actualizar contraseña
            </button>
        </form>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('resetPasswordForm');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const errorBox = document.getElementById('resetErrorBox');
        errorBox.classList.add('hidden');

        // limpiar errores por campo
        document.getElementById('errorPassword').classList.add('hidden');
        document.getElementById('errorConfirm').classList.add('hidden');

        const res = await fetch(form.action, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: new URLSearchParams(new FormData(form))
        });

        const data = await res.json();

        if (data.ok) {
            alert('Contraseña actualizada correctamente');
            window.location.replace(data.redirect);
        } else {

            // errores estilo register
            if (data.errors) {

                if (data.errors.contrasenia) {
                    const el = document.getElementById('errorPassword');
                    el.innerText = data.errors.contrasenia[0];
                    el.classList.remove('hidden');
                }

                if (data.errors.contrasenia_confirmation) {
                    const el = document.getElementById('errorConfirm');
                    el.innerText = data.errors.contrasenia_confirmation[0];
                    el.classList.remove('hidden');
                }
            }

            errorBox.innerText = data.message || 'Error al actualizar contraseña';
            errorBox.classList.remove('hidden');
        }
    });

});
</script>

</body>
</html>