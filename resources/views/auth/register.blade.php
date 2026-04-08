<div id="modalRegister" class="fixed inset-0 hidden items-center justify-center z-50">

    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="cerrarRegister()"></div>

    <div class="relative bg-white w-full max-w-xl mx-auto rounded-xl shadow-lg p-8 z-10">

        <button onclick="cerrarRegister()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-xl">
            ✕
        </button>

        <div class="flex items-center gap-3 mb-4">
            <div class="bg-blue-100 text-blue-900 p-2 rounded-lg">
                📝
            </div>

            <h2 class="text-2xl font-bold text-blue-900">
                Crear cuenta
            </h2>
        </div>

        <p class="text-gray-500 text-sm mb-6">
            Completa el formulario para registrarte
        </p>

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-700 p-3 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            <div>
                <label class="text-sm text-gray-600">Nombre</label>
                <div class="flex items-center border rounded-md px-3 py-2 mt-1">
                    <span class="mr-2">👤</span>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Tu nombre" class="w-full outline-none" required>
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-600">Apellidos</label>
                <div class="flex items-center border rounded-md px-3 py-2 mt-1">
                    <span class="mr-2">👥</span>
                    <input type="text" name="apellido" value="{{ old('apellido') }}" placeholder="Tus apellidos" class="w-full outline-none" required>
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-600">Correo electronico</label>
                <div class="flex items-center border rounded-md px-3 py-2 mt-1">
                    <span class="mr-2">📧</span>
                    <input type="email" name="correo_electronico" value="{{ old('correo_electronico') }}" placeholder="correo@ejemplo.com" class="w-full outline-none" required>
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-600">Telefono</label>
                <div class="flex items-center border rounded-md px-3 py-2 mt-1">
                    <span class="mr-2">📱</span>
                    <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="+591 700 00000" class="w-full outline-none">
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-600">Contraseña</label>
                <div class="flex items-center border rounded-md px-3 py-2 mt-1">
                    <span class="mr-2">🔒</span>
                    <input type="password" name="contrasenia" placeholder="********" class="w-full outline-none" required>
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-600">Confirmar contraseña</label>
                <div class="flex items-center border rounded-md px-3 py-2 mt-1">
                    <span class="mr-2">🔐</span>
                    <input type="password" name="contrasenia_confirmation" placeholder="********" class="w-full outline-none" required>
                </div>
            </div>

            <button type="submit" class="col-span-1 md:col-span-2 w-full bg-blue-900 text-white py-3 rounded-md hover:bg-blue-800 transition">
                Crear cuenta
            </button>
        </form>

        <p class="text-sm text-center mt-4">
            ¿Ya tienes cuenta?
            <span onclick="irALogin()" class="text-blue-900 font-semibold cursor-pointer">
                Inicia sesion
            </span>
        </p>

    </div>
</div>