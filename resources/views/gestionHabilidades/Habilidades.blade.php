<form method="POST" action="{{ route('habilidades.store') }}" class="space-y-6">
    @csrf

    <!-- GRID -->
    <div class="grid grid-cols-2 gap-6">

        <!-- NOMBRE -->
        <div>
            <label class="block mb-1 font-medium">
                Nombre de la Habilidad <span class="text-red-500">*</span>
            </label>

            <input type="text" name="nombreHabilidad"
                placeholder="Ej: React, Node.js, PostgreSQL"
                value="{{ old('nombreHabilidad') }}"
                class="w-full p-3 border border-gray-300 rounded-lg bg-gray-200 focus:outline-none">
        </div>

        <!-- CATEGORIA -->
        <div>
            <label class="block mb-1 font-medium">
                Categoría <span class="text-red-500">*</span>
            </label>

            <select name="categoria"
                class="w-full p-3 border border-gray-300 rounded-lg bg-gray-200">

                <option value="">Selecciona una categoría</option>

                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}"
                        {{ old('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach

            </select>
        </div>

    </div>

    <!-- AÑOS -->
    <div>
        <label class="block mb-1 font-medium">
            Años de Experiencia <span class="text-red-500">*</span>
        </label>

        <input type="number" step="0.5" name="anosExperiencia"
            placeholder="Ej: 2.5"
            value="{{ old('anosExperiencia') }}"
            class="w-full p-3 border border-gray-300 rounded-lg bg-gray-200">
    </div>

    <!-- DESCRIPCIÓN -->
    <div>
        <label class="block mb-1 font-medium">
            Descripción <span class="text-red-500">*</span>
        </label>

        <textarea name="descripcion"
            placeholder="Describe tu experiencia y proyectos realizados..."
            class="w-full p-3 border border-gray-300 rounded-lg bg-gray-200 min-h-32">{{ old('descripcion') }}</textarea>

        <p class="text-sm text-gray-500 mt-1">
            Mínimo 20 caracteres, máximo 500 caracteres
        </p>
    </div>

    <!-- BOTONES -->
    <div class="grid grid-cols-2 gap-4 pt-4">

        <!-- CANCELAR -->
        <button type="button"
            onclick="document.getElementById('modal-habilidades').classList.add('hidden')"
            class="py-4 text-lg border border-gray-300 rounded-lg bg-white hover:bg-gray-100">
            ✖ Cancelar
        </button>

        <!-- GUARDAR -->
        <button type="submit"
            class="py-4 text-lg rounded-lg text-white bg-black hover:bg-gray-800 transition">
            💾 Guardar Habilidad
        </button>

    </div>

</form>