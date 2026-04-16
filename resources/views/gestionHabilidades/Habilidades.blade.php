<form id="formHabilidad" method="POST"
      action="{{ isset($habilidad) ? route('habilidades.update', $habilidad->id_habilidad) : route('habilidades.store') }}">

    @csrf

    @if(isset($habilidad))
        @method('PUT')
    @endif

    <!-- NOMBRE -->
    <div class="mb-4">
        <label class="block text-xs font-medium text-gray-700 mb-1">
            Nombre de la Habilidad <span class="text-red-500">*</span>
        </label>
        <input type="text"
            id="hab_nombre"
            name="nombreHabilidad"
            placeholder="Ej: React, Node.js, PostgreSQL"
            value="{{ old('nombreHabilidad', $habilidad->nombre ?? '') }}"
            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- CATEGORÍA -->
    <div class="mb-4">
        <label class="block text-xs font-medium text-gray-700 mb-1">
            Categoría <span class="text-red-500">*</span>
        </label>
        <select id="hab_categoria"
            name="categoria"
            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">

            <option value="">Selecciona una categoría</option>

            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id_categoria }}"
                    {{ old('categoria', $habilidad->id_categoria ?? '') == $categoria->id_categoria ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach

        </select>
    </div>

    <!-- AÑOS DE EXPERIENCIA -->
    <div class="mb-4">
        <label class="block text-xs font-medium text-gray-700 mb-1">
            Años de Experiencia <span class="text-red-500">*</span>
        </label>
        <input type="number"
            id="hab_anios"
            step="1"
            min="0"
            name="anosExperiencia"
            placeholder="Ej: 3"
            value="{{ old('anosExperiencia', $habilidad->anios_experiencia ?? '') }}"
            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- DESCRIPCIÓN -->
    <div class="mb-4">
        <label class="block text-xs font-medium text-gray-700 mb-1">
            Descripción <span class="text-red-500">*</span>
        </label>
        <textarea id="hab_descripcion"
            name="descripcion"
            rows="3"
            placeholder="Describe tu experiencia y proyectos realizados..."
            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none">{{ old('descripcion', $habilidad->descripcion ?? '') }}</textarea>
        <p class="text-xs text-gray-400 mt-1">Mínimo 20 caracteres, máximo 500</p>
    </div>

    <!-- BOTONES -->
    <div class="flex gap-3 mt-6 pt-4 border-t border-gray-100">
        <button type="button" onclick="confirmarCancelarHabilidad()"
            class="flex-1 px-4 py-2 text-sm border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">
            Cancelar
        </button>
        <button type="button" onclick="confirmarGuardarHabilidad()"
            class="flex-1 px-4 py-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg font-medium transition">
            <i class="fas fa-save text-xs mr-1"></i> Guardar
        </button>
    </div>

</form>
