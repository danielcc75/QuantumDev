<div id="modalLogin" class="fixed inset-0 hidden items-center justify-center z-50">

    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="cerrarLogin()"></div>

    <div class="relative bg-white w-full max-w-xl mx-auto rounded-xl shadow-lg p-8 z-10">

        <button onclick="cerrarLogin()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-xl">
            ✕
        </button>

        <div class="flex items-center gap-3 mb-4">
            <div class="bg-blue-100 text-blue-900 p-2 rounded-lg">
                🔐
            </div>

            <h2 class="text-2xl font-bold text-blue-900">
                Iniciar sesion
            </h2>
        </div>

        <p class="text-gray-500 text-sm mb-6">
            Ingresa tus credenciales para acceder a tu cuenta
        </p>

        @if (session('error_login'))
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-700 p-3 text-sm">
                {{ session('error_login') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-700 p-3 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm text-gray-600">Correo electronico</label>
                <div class="flex items-center border rounded-md px-3 py-2 mt-1">
                    <span class="mr-2">📧</span>
                    <input
                        type="email"
                        name="correo_electronico"
                        value="{{ old('correo_electronico') }}"
                        placeholder="correo@ejemplo.com"
                        class="w-full outline-none"
                        required
                    >
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-600">Contraseña</label>
                <div class="flex items-center border rounded-md px-3 py-2 mt-1">
                    <span class="mr-2">🔒</span>
                    <input
                        type="password"
                        name="contrasenia"
                        placeholder="********"
                        class="w-full outline-none"
                        required
                    >
                </div>
            </div>

            <div class="text-right">
                <a href="#" class="text-sm text-blue-900 hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-md hover:bg-blue-800 transition">
                Iniciar sesion
            </button>
        </form>

        <p class="text-sm text-center mt-6">
            ¿No tienes cuenta?
            <span onclick="irARegister()" class="text-blue-900 font-semibold cursor-pointer">
                Registrate
            </span>
        </p>

    </div>
</div>