<div id="modalForgotPassword" class="fixed inset-0 hidden items-center justify-center z-50 px-4">

    <!-- fondo -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
         onclick="cerrarForgotPassword()"></div>

    <!-- modal -->
    <div class="relative w-full max-w-lg bg-[#f3f4f6] rounded-xl shadow-xl overflow-hidden z-10">

        <!-- cerrar -->
        <button onclick="cerrarForgotPassword()"
                class="absolute top-3 right-4 text-white/80 hover:text-white text-xl z-20">
            ✕
        </button>

        <!-- header -->
        <div class="bg-[#1e3a5f] text-center px-6 py-6">
            <div class="flex justify-center items-center gap-2 mb-1">
                <i class="fas fa-key text-white text-xl"></i>

                <h2 class="text-white text-2xl font-bold">
                    Recuperar contraseña
                </h2>
            </div>

            <p class="text-gray-200 text-sm">
                Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
            </p>
        </div>

        <!-- contenido -->
        <div class="p-6">

            <div id="forgotSuccessBox"
                 class="hidden mb-4 text-sm bg-green-100 border border-green-300 text-green-700 p-3 rounded-md">
            </div>

            <div id="forgotErrorBox"
                 class="hidden mb-4 text-sm bg-red-100 border border-red-300 text-red-700 p-3 rounded-md">
            </div>

            <form id="forgotPasswordForm"
                action="/forgot-password"
                method="GET"
                class="space-y-4">

                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-envelope text-[#1e3a5f] text-xs"></i>
                        Correo electrónico
                    </label>

                    <input
                        id="forgotCorreo"
                        type="email"
                        name="correo_electronico"
                        class="w-full mt-1 px-3 py-2 rounded-md border border-gray-300 bg-white outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20"
                        placeholder="ejemplo@correo.com"
                    >

                    <p id="forgotCorreoError"
                       class="hidden mt-1 text-sm text-red-600"></p>
                </div>

                <button
                    type="submit"
                    class="w-full bg-[#1e3a5f] text-white py-3 rounded-md font-semibold hover:bg-[#16304d] transition">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Enviar enlace
                </button>

            </form>

            <p class="text-sm text-center mt-4 text-gray-600">
                ¿Recordaste tu contraseña?
                <span onclick="irALogin()"
                      class="text-[#1e3a5f] font-semibold cursor-pointer hover:text-[#e11d48] transition">
                    Iniciar sesión
                </span>
            </p>

        </div>
    </div>
</div>