<div id="modalLogin" class="fixed inset-0 hidden items-center justify-center z-50 px-4">

    <!-- fondo -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="cerrarLogin()"></div>

    <!-- modal -->
    <div class="relative w-full max-w-2xl bg-[#f3f4f6] rounded-xl shadow-xl overflow-hidden z-10">

        <!-- cerrar -->
        <button onclick="cerrarLogin()" class="absolute top-3 right-4 text-white/80 hover:text-white text-xl z-20">
            ✕
        </button>

        <!-- header -->
        <div class="bg-[#1e3a5f] text-center px-6 py-6">
            <div class="flex justify-center items-center gap-2 mb-1">
                <i class="fas fa-right-to-bracket text-white text-xl"></i>
                <h2 class="text-white text-2xl font-bold">{{ __('general.auth.login.titulo') }}</h2>
            </div>
            <p class="text-gray-200 text-sm">
                {{ __('general.auth.login.subtitulo') }}
            </p>
        </div>

        <!-- contenido -->
        <div class="p-6">

            @php
                $inputClass = "w-full mt-1 px-3 py-2 rounded-md border border-gray-300 bg-white outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20";
            @endphp

            <!-- error general -->
            <div id="loginErrorBox" class="hidden mb-4 text-sm bg-red-100 border border-red-300 text-red-700 p-3 rounded-md"></div>

            <form id="loginForm" action="{{ route('login.store') }}" method="POST" class="space-y-4" novalidate>
                @csrf

                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-envelope text-[#1e3a5f] text-xs"></i>
                        {{ __('general.auth.common.correo') }} <span class="text-[#e11d48]">*</span>
                    </label>
                    <input
                        id="loginCorreo"
                        type="email"
                        name="correo_electronico"
                        value="{{ old('correo_electronico') }}"
                        placeholder="{{ __('general.auth.common.correo_placeholder') }}"
                        class="{{ $inputClass }}"
                    >
                    <p id="loginCorreoError" class="hidden mt-1 text-sm text-red-600"></p>
                </div>

                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-lock text-[#1e3a5f] text-xs"></i>
                        {{ __('general.auth.common.password') }} <span class="text-[#e11d48]">*</span>
                    </label>

                    <div class="relative">
                        <input
                            id="loginContrasenia"
                            type="password"
                            name="contrasenia"
                            placeholder="{{ __('general.auth.login.password_placeholder') }}"
                            class="{{ $inputClass }} pr-10"
                        >

                        <!-- boton ojo -->
                        <button
                            type="button"
                            onclick="togglePassword('loginContrasenia', 'loginPasswordIcon')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1e3a5f]"
                        >
                            <i id="loginPasswordIcon" class="fas fa-eye"></i>
                        </button>
                    </div>

                    <p id="loginContraseniaError" class="hidden mt-1 text-sm text-red-600"></p>
                </div>

                <div class="text-right">
                    <a href="#" class="text-sm font-medium text-[#1e3a5f] hover:text-[#e11d48] transition">
                        {{ __('general.auth.login.olvido_password') }}
                    </a>
                </div>

                <button
                    type="submit"
                    class="w-full bg-[#1e3a5f] text-white py-3 rounded-md font-semibold hover:bg-[#16304d] transition">
                    <i class="fas fa-right-to-bracket mr-2"></i> {{ __('general.auth.login.btn') }}
                </button>
            </form>

            <div class="flex items-center my-4">
                <div class="flex-1 border-t border-gray-300"></div>
                <span class="px-3 text-sm text-gray-500">{{ __('general.auth.common.continua_con') }}</span>
                <div class="flex-1 border-t border-gray-300"></div>
            </div>

            <div class="flex flex-col gap-3">

                <!-- github -->
                <a href="/auth/github"
                class="w-full flex items-center justify-center gap-3 border border-gray-300 bg-white hover:bg-gray-100 text-gray-700 py-3 rounded-md font-medium transition">

                    <i class="fab fa-github text-xl"></i>
                    {{ __('general.auth.common.github') }}
                </a>

                <!-- google -->
                <a href="/auth/google"
                class="w-full flex items-center justify-center gap-3 border border-gray-300 bg-white hover:bg-gray-100 text-gray-700 py-3 rounded-md font-medium transition">

                    <i class="fab fa-google text-xl text-red-500"></i>
                    {{ __('general.auth.common.google') }}
                </a>

            </div>

            <p class="text-sm text-center mt-5 text-gray-600">
                {{ __('general.auth.login.no_cuenta') }}
                <span onclick="irARegister()" class="text-[#1e3a5f] font-semibold cursor-pointer hover:text-[#e11d48] transition">
                    {{ __('general.auth.login.registrate') }}
                </span>
            </p>

        </div>
    </div>
</div>
