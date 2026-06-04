<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        html, body {
            height: 100%;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center px-4">

    <!-- CARD PRINCIPAL -->
    <div class="w-full max-w-md">

        <!-- FORM CARD -->
        <div id="formCard" class="bg-[#f3f4f6] rounded-xl shadow-xl overflow-hidden">

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

                <div id="resetErrorBox"
                     class="hidden mb-4 text-sm bg-red-100 border border-red-300 text-red-700 p-3 rounded-md">
                </div>

                <form id="resetPasswordForm" method="POST" action="/reset-password" class="space-y-4">

                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nueva contraseña</label>
                        <input type="password"
                               name="contrasenia"
                               class="w-full mt-1 px-3 py-2 rounded-md border border-gray-300 focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20"
                               placeholder="••••••••">
                    </div>

                    <!-- CONFIRM -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Confirmar contraseña</label>
                        <input type="password"
                               name="contrasenia_confirmation"
                               class="w-full mt-1 px-3 py-2 rounded-md border border-gray-300 focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20"
                               placeholder="••••••••">
                    </div>

                    <button type="submit"
                            class="w-full bg-[#1e3a5f] text-white py-3 rounded-md font-semibold hover:bg-[#16304d] transition">
                        Actualizar contraseña
                    </button>
                </form>
            </div>
        </div>

        <!-- SUCCESS SCREEN -->
        <div id="successCard"
             class="hidden bg-white rounded-xl shadow-xl p-10 text-center">

            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-2">
                ¡Contraseña actualizada!
            </h2>

            <p class="text-gray-500 text-sm mb-6">
                Tu contraseña fue cambiada correctamente.
                Serás redirigido al inicio de sesión.
            </p>

            <div class="animate-pulse text-sm text-gray-400">
                Redirigiendo...
            </div>
        </div>

    </div>

    <!-- JS -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('resetPasswordForm');

        if (!form) return;

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formCard = document.getElementById('formCard');
            const successCard = document.getElementById('successCard');
            const errorBox = document.getElementById('resetErrorBox');

            errorBox.classList.add('hidden');

            try {
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

                    // ocultar formulario
                    formCard.classList.add('hidden');

                    // mostrar éxito
                    successCard.classList.remove('hidden');

                    // redirigir
                    setTimeout(() => {
                        window.location.replace(data.redirect);
                    }, 2500);

                } else {
                    errorBox.innerText = data.message || 'Error al actualizar contraseña';
                    errorBox.classList.remove('hidden');
                }

            } catch (err) {
                console.error(err);
                errorBox.innerText = 'Error de conexión con el servidor';
                errorBox.classList.remove('hidden');
            }
        });

    });
    </script>

</body>
</html>