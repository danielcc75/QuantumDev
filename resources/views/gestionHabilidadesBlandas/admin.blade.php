<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestion de habilidades blandas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Gestion de habilidades blandas</h1>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="formHabilidad" action="{{ route('habilidades-blandas.store') }}" method="POST" class="mb-6 bg-gray-50 p-4 rounded border">
            @csrf

            <input type="hidden" name="_method" id="formMethod" value="POST">

            <h2 id="tituloFormulario" class="text-lg font-semibold mb-4">
                registrar nueva habilidad blanda
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">nombre</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        class="w-full border rounded px-3 py-2"
                        placeholder="ej: comunicacion"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">descripcion</label>
                    <input
                        type="text"
                        id="descripcion"
                        name="descripcion"
                        value="{{ old('descripcion') }}"
                        class="w-full border rounded px-3 py-2"
                        placeholder="descripcion breve"
                    >
                </div>
            </div>

            <div class="mt-4 flex gap-2">
                <button id="btnGuardar" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    guardar habilidad
                </button>

                <button id="btnCancelar" type="button" onclick="cancelarEdicion()" class="hidden bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    cancelar
                </button>
            </div>
        </form>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-3">nombre</th>
                    <th class="p-3">descripcion</th>
                    <th class="p-3">fecha</th>
                    <th class="p-3">estado</th>
                    <th class="p-3">acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($habilidadesBlandas as $habilidad)
                    <tr class="border-b">
                        <td class="p-3 font-semibold">{{ $habilidad->nombre }}</td>

                        <td class="p-3">
                            {{ $habilidad->descripcion ?? 'sin descripcion' }}
                        </td>

                        <td class="p-3">
                            {{ $habilidad->created_at ? $habilidad->created_at->format('Y-m-d') : '-' }}
                        </td>

                        <td class="p-3">
                            <form action="{{ route('habilidades-blandas.toggle', $habilidad->id_habilidad_blanda) }}" method="POST">
                                @csrf

                                @if ($habilidad->estado === 'activo')
                                    <button type="submit" class="bg-green-200 text-green-800 px-2 py-1 rounded text-sm hover:bg-green-300">
                                        activa
                                    </button>
                                @else
                                    <button type="submit" class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-sm hover:bg-gray-300">
                                        inactiva
                                    </button>
                                @endif
                            </form>
                        </td>

                        <td class="p-3 flex gap-3 items-center">
                            <button
                                type="button"
                                class="text-blue-600"
                                onclick="editarHabilidad(
                                    '{{ $habilidad->id_habilidad_blanda }}',
                                    '{{ addslashes($habilidad->nombre) }}',
                                    '{{ addslashes($habilidad->descripcion ?? '') }}'
                                )"
                            >
                                editar
                            </button>

                            <form action="{{ route('habilidades-blandas.destroy', $habilidad->id_habilidad_blanda) }}" method="POST"
                                  onsubmit="return confirm('seguro que quieres eliminar esta habilidad blanda?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-600">
                                    eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            no hay habilidades blandas registradas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-8 bg-gray-50 border rounded-lg p-5">
            <h2 class="text-xl font-bold mb-1">Vista previa para usuario</h2>
            <p class="text-sm text-gray-600 mb-4">
                Asi se verian las habilidades blandas disponibles para seleccionar
            </p>

            <div class="flex flex-wrap gap-3">
                @forelse ($habilidadesBlandas->where('estado', 'activo') as $habilidad)
                    <button
                        type="button"
                        onclick="toggleBurbuja(this)"
                        class="burbuja-habilidad border border-gray-300 text-gray-800 px-4 py-2 rounded-full hover:bg-blue-100 transition"
                    >
                        {{ $habilidad->nombre }}
                    </button>
                @empty
                    <p class="text-gray-500">
                        no hay habilidades activas para mostrar
                    </p>
                @endforelse
            </div>

            <p class="text-xs text-gray-500 mt-4">
                haz clic para seleccionar, vuelve a hacer clic para deseleccionar
            </p>
        </div>

    </div>

    <script>
        const form = document.getElementById('formHabilidad');
        const formMethod = document.getElementById('formMethod');
        const tituloFormulario = document.getElementById('tituloFormulario');
        const nombreInput = document.getElementById('nombre');
        const descripcionInput = document.getElementById('descripcion');
        const btnGuardar = document.getElementById('btnGuardar');
        const btnCancelar = document.getElementById('btnCancelar');

        const storeUrl = "{{ route('habilidades-blandas.store') }}";
        const updateBaseUrl = "{{ url('/admin/habilidades-blandas') }}";

        function editarHabilidad(id, nombre, descripcion) {
            form.action = updateBaseUrl + '/' + id;
            formMethod.value = 'PUT';

            nombreInput.value = nombre;
            descripcionInput.value = descripcion;

            tituloFormulario.textContent = 'editar habilidad blanda';
            btnGuardar.textContent = 'actualizar habilidad';
            btnCancelar.classList.remove('hidden');
        }

        function cancelarEdicion() {
            form.action = storeUrl;
            formMethod.value = 'POST';

            nombreInput.value = '';
            descripcionInput.value = '';

            tituloFormulario.textContent = 'registrar nueva habilidad blanda';
            btnGuardar.textContent = 'guardar habilidad';
            btnCancelar.classList.add('hidden');
        }

        function toggleBurbuja(boton) {
            boton.classList.toggle('bg-blue-900');
            boton.classList.toggle('text-white');
            boton.classList.toggle('border-blue-900');

            boton.classList.toggle('text-gray-800');
            boton.classList.toggle('border-gray-300');
        }
    </script>

</body>
</html>