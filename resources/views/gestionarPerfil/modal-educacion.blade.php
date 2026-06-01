{{-- resources/views/gestionarPerfil/modal-educacion.blade.php --}}

<div id="modalEducacion" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4" onclick="cerrarModalEducacionFondo(event)">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">

        {{-- Header --}}
        <div class="bg-[#1e3a5f] text-white px-4 sm:px-6 py-4 flex items-center justify-between gap-3 rounded-t-2xl sticky top-0 z-10">
            <div class="min-w-0">
                <h3 id="modalEducacionTitulo" class="text-base sm:text-lg font-bold truncate">{{ __('general.formacion.modal.titulo_crear') }}</h3>
                <p class="text-blue-200 text-xs mt-0.5 hidden sm:block">{{ __('general.formacion.modal.subtitulo') }}</p>
            </div>
            <button type="button" onclick="confirmarCancelarEducacion()" class="text-white hover:text-blue-200 transition flex-shrink-0">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        {{-- Body --}}
        <form id="formEducacion" class="p-4 sm:p-6">
            @csrf
            <input type="hidden" id="edu_id_formacion" name="id_formacion">

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    {{ __('general.formacion.modal.titulo') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" id="edu_titulo" name="titulo"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="{{ __('general.formacion.modal.titulo_ph') }}">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    {{ __('general.formacion.modal.institucion') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" id="edu_institucion" name="institucion"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="{{ __('general.formacion.modal.institucion_ph') }}">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    {{ __('general.formacion.modal.nivel') }} <span class="text-red-500">*</span>
                </label>
                <select id="edu_nivel" name="nivel"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">{{ __('general.formacion.modal.selecciona_nivel') }}</option>
                    <option value="Técnico">Técnico</option>
                    <option value="Tecnólogo">Tecnólogo</option>
                    <option value="Pregrado">Pregrado</option>
                    <option value="Posgrado">Posgrado</option>
                    <option value="Maestría">Maestría</option>
                    <option value="Doctorado">Doctorado</option>
                    <option value="Diplomado">Diplomado</option>
                    <option value="Curso">Curso</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        {{ __('general.formacion.modal.fecha_ini') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="edu_fecha_ini" name="fecha_ini"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div id="edu_fecha_fin_container">
                    <label class="block text-xs font-medium text-gray-700 mb-1">{{ __('general.formacion.modal.fecha_fin') }}</label>
                    <input type="date" id="edu_fecha_fin" name="fecha_fin"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div class="mb-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="edu_en_curso" name="en_curso" class="w-4 h-4 text-blue-500 rounded">
                    <span class="text-sm text-gray-700">{{ __('general.formacion.modal.en_curso') }}</span>
                </label>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">{{ __('general.formacion.modal.descripcion') }}</label>
                <textarea id="edu_descripcion" name="descripcion" rows="3"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                    placeholder="{{ __('general.formacion.modal.descripcion_ph') }}"></textarea>
            </div>

            {{-- Botones --}}
            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-100">
                <button type="button" onclick="confirmarCancelarEducacion()"
                    class="flex-1 px-4 py-2 text-sm border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">
                    {{ __('general.formacion.modal.cancelar') }}
                </button>
                <button type="button" onclick="confirmarGuardarEducacion()"
                    class="flex-1 px-4 py-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg font-medium transition">
                    <i class="fas fa-save text-xs mr-1"></i> {{ __('general.formacion.modal.guardar') }}
                </button>
            </div>
        </form>
    </div>
</div>

@include('gestionarPerfil._modal-confirmacion-educacion')
@include('gestionarPerfil._scripts-educacion')
