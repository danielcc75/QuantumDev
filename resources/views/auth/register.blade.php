<div id="modalRegister" class="fixed inset-0 hidden items-center justify-center z-50 px-4">

    <!-- fondo -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="cerrarRegister()"></div>

    <!-- modal -->
    <div class="relative w-full max-w-2xl bg-[#f3f4f6] rounded-xl shadow-xl overflow-hidden z-10">

        <!-- cerrar -->
        <button onclick="cerrarRegister()" class="absolute top-3 right-4 text-white/80 hover:text-white text-xl z-20">
            ✕
        </button>

        <!-- header -->
        <div class="bg-[#1e3a5f] text-center px-6 py-6">
            <div class="flex justify-center items-center gap-2 mb-1">
                <i class="fas fa-user-circle text-white text-xl"></i>
                <h2 class="text-white text-2xl font-bold">Crear Cuenta</h2>
            </div>
            <p class="text-gray-200 text-sm">
                Completa el formulario para registrarte en el sistema de portafolios
            </p>
        </div>

        <!-- contenido -->
        <div class="p-6">

            @php
                $inputClass = "w-full mt-1 px-3 py-2 rounded-md border border-gray-300 bg-white outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20";
            @endphp

            <!-- error general -->
            <div id="registerErrorBox" class="hidden mb-4 text-sm bg-red-100 border border-red-300 text-red-700 p-3 rounded-md"></div>

            <form id="registerForm" action="{{ route('register.store') }}" method="POST" class="grid md:grid-cols-2 gap-4" novalidate>
                @csrf

                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-user text-[#1e3a5f] text-xs"></i>
                        Nombre <span class="text-[#e11d48]">*</span>
                    </label>
                    <input id="registerNombre" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Tu nombre" class="{{ $inputClass }}">
                    <p id="registerNombreError" class="hidden mt-1 text-sm text-red-600"></p>
                </div>

                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-users text-[#1e3a5f] text-xs"></i>
                        Apellidos <span class="text-[#e11d48]">*</span>
                    </label>
                    <input id="registerApellido" type="text" name="apellido" value="{{ old('apellido') }}" placeholder="Tus apellidos" class="{{ $inputClass }}">
                    <p id="registerApellidoError" class="hidden mt-1 text-sm text-red-600"></p>
                </div>

                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-envelope text-[#1e3a5f] text-xs"></i>
                        Correo electrónico <span class="text-[#e11d48]">*</span>
                    </label>
                    <input id="registerCorreo" type="email" name="correo_electronico" value="{{ old('correo_electronico') }}" placeholder="tu@email.com" class="{{ $inputClass }}">
                    <p id="registerCorreoError" class="hidden mt-1 text-sm text-red-600"></p>
                </div>

                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-phone text-[#1e3a5f] text-xs"></i>
                        Teléfono
                    </label>
                    <input id="registerTelefono" type="text" name="telefono" value="{{ old('telefono') }}" placeholder="+591 700 00000" class="{{ $inputClass }}">
                    <p id="registerTelefonoError" class="hidden mt-1 text-sm text-red-600"></p>
                </div>

                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-lock text-[#1e3a5f] text-xs"></i>
                        Contraseña <span class="text-[#e11d48]">*</span>
                    </label>
                    <input id="registerContrasenia" type="password" name="contrasenia" placeholder="Minimo 8 caracteres" class="{{ $inputClass }}">
                    
                    <p class="mt-1 text-xs text-gray-500">
                        Debe tener al menos 8 caracteres, una mayuscula, una minuscula, un numero y un simbolo.
                    </p>

                    <p id="registerContraseniaError" class="hidden mt-1 text-sm text-red-600"></p>
                </div>

                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-lock text-[#1e3a5f] text-xs"></i>
                        Confirmar contraseña <span class="text-[#e11d48]">*</span>
                    </label>
                    <input id="registerContraseniaConfirmacion" type="password" name="contrasenia_confirmation" placeholder="Repite tu contraseña" class="{{ $inputClass }}">
                    <p id="registerContraseniaConfirmacionError" class="hidden mt-1 text-sm text-red-600"></p>
                </div>

                <button type="submit"
                    class="md:col-span-2 w-full bg-[#1e3a5f] text-white py-3 rounded-md font-semibold hover:bg-[#16304d] transition">
                    <i class="fas fa-check mr-2"></i> Crear Cuenta
                </button>
            </form>

            <p class="text-sm text-center mt-4 text-gray-600">
                ¿Ya tienes una cuenta?
                <span onclick="irALogin()" class="text-[#1e3a5f] font-semibold cursor-pointer hover:text-[#e11d48] transition">
                    Inicia sesión
                </span>
            </p>

        </div>
    </div>
</div>