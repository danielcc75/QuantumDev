{{-- resources/views/gestionarProyectos/_modal.blade.php
     Modal crear / editar proyectos con diseño tipo página completa dentro de overlay. --}}

@php
    $inputCls    = 'w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/40 focus:border-[#1e3a5f]';
    $selectCls   = $inputCls . ' appearance-none bg-white pr-8';
    $textareaCls = $inputCls . ' resize-none';
@endphp

{{-- Modal de confirmación reemplazado por el modal global en layouts.app. --}}

{{-- ── Modal Proyecto ───────────────────────────────────────────────────────── --}}
<div id="modalProyecto" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-gray-300 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[95vh] overflow-y-auto flex flex-col">

        {{-- Header --}}
        <div class="bg-[#1e3a5f] text-white px-4 sm:px-6 lg:px-8 py-4 sm:py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 rounded-t-2xl sticky top-0 z-10">
            <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                <button type="button" onclick="confirmarCancelar()" class="text-white hover:text-red-300 transition flex-shrink-0">
                    <i class="fas fa-arrow-left text-lg"></i>
                </button>
                <div class="min-w-0">
                    <h3 id="modalProyectoTitulo" class="text-lg sm:text-xl font-bold truncate">{{ __('general.proyectos.modal.titulo_crear') }}</h3>
                    <p class="text-blue-200 text-xs mt-0.5 hidden sm:block">{{ __('general.proyectos.modal.subtitulo') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3 justify-end">
                <button type="button" onclick="confirmarCancelar()"
                    class="flex-1 sm:flex-none px-3 sm:px-4 py-2 text-xs sm:text-sm border border-white/30 text-white rounded-lg hover:bg-white/10 transition">
                    {{ __('general.proyectos.modal.cancelar') }}
                </button>
                <button type="button" onclick="confirmarGuardar()"
                    class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-3 sm:px-4 py-2 text-xs sm:text-sm bg-[#e11d48] hover:bg-red-600 text-white rounded-lg font-medium transition whitespace-nowrap">
                    <i class="fas fa-save text-xs"></i> <span>{{ __('general.proyectos.modal.guardar') }}</span><span class="hidden sm:inline"> {{ __('general.proyectos.modal.proyecto') }}</span>
                </button>
            </div>
        </div>

        {{-- Body --}}
        <form id="formProyecto" class="p-4 sm:p-6 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
            @csrf
            <input type="hidden" id="proyectoId" value="">

            {{-- Columna Izquierda --}}
            <div class="flex flex-col gap-5">

                {{-- Información Básica --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#1e3a5f]">
                    <h4 class="font-semibold text-[#1e3a5f] text-sm mb-0.5">{{ __('general.proyectos.modal.seccion_info') }}</h4>
                    <p class="text-xs text-[#e11d48] mb-4">{{ __('general.proyectos.modal.seccion_info_desc') }}</p>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            {{ __('general.proyectos.modal.nombre') }} <span class="text-[#e11d48]">*</span>
                        </label>
                        <input type="text" id="proj_nombre" required
                            class="{{ $inputCls }}"
                            placeholder="{{ __('general.proyectos.modal.nombre_ph') }}">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">{{ __('general.proyectos.modal.descripcion') }}</label>
                        <textarea id="proj_descripcion" rows="3"
                            class="{{ $textareaCls }}"
                            placeholder="{{ __('general.proyectos.modal.descripcion_ph') }}"></textarea>
                    </div>
                </div>

                {{-- Tecnologías --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#1e3a5f]">
                    <div class="flex items-center gap-2 mb-0.5">
                        <i class="fas fa-code text-[#1e3a5f] text-sm"></i>
                        <h4 class="font-semibold text-[#1e3a5f] text-sm">{{ __('general.proyectos.modal.seccion_tec') }}</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">{{ __('general.proyectos.modal.seccion_tec_desc') }}</p>

                    <div class="relative mb-3">
                        <select id="proj_categoria_select" onchange="filtrarTecnologias()"
                            class="{{ $selectCls }} text-gray-500">
                            <option value="">{{ __('general.proyectos.modal.selecciona_cat') }}</option>
                            <option value="Frontend">Frontend</option>
                            <option value="Backend">Backend</option>
                            <option value="Lenguajes">Lenguajes</option>
                            <option value="Bases de Datos">Bases de Datos</option>
                            <option value="Cloud & DevOps">Cloud &amp; DevOps</option>
                            <option value="Mobile">Mobile</option>
                            <option value="APIs & Real-time">APIs &amp; Real-time</option>
                            <option value="Testing">Testing</option>
                            <option value="Data Science & ML">Data Science &amp; ML</option>
                            <option value="Diseño & Prototipado">Diseño &amp; Prototipado</option>
                            <option value="Gestión de Proyectos">Gestión de Proyectos</option>
                            <option disabled>──────────</option>
                            <option value="sugerir" class="font-semibold text-blue-600 bg-blue-50">{{ __('general.proyectos.modal.sugerir_tec') }}</option>
                        </select>
                        <i class="fas fa-chevron-down text-gray-400 text-xs absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    </div>

                    <div id="proj_chips_container" class="hidden mb-2">
                        <div id="proj_chips" class="flex flex-wrap gap-1.5 max-h-28 overflow-y-auto p-1"></div>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-xs text-gray-400">{{ __('general.proyectos.modal.tec_help') }}</p>
                            <button type="button" onclick="agregarTecnologia()"
                                class="flex items-center gap-1.5 px-3 py-1.5 text-xs bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg transition font-medium">
                                <i class="fas fa-plus text-xs"></i> {{ __('general.proyectos.modal.agregar_sel') }}
                            </button>
                        </div>
                    </div>

                    <div id="proj_tags" class="flex flex-wrap gap-2 mt-1"></div>
                    <input type="hidden" id="proj_tecnologias">
                </div>

                {{-- Estado y Visibilidad --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#1e3a5f]">
                    <h4 class="font-semibold text-[#1e3a5f] text-sm mb-0.5">{{ __('general.proyectos.modal.seccion_estado') }}</h4>
                    <p class="text-xs text-gray-400 mb-4">{{ __('general.proyectos.modal.seccion_estado_desc') }}</p>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">{{ __('general.proyectos.modal.estado') }}</label>
                        <div class="relative">
                            <select id="proj_estado" onchange="actualizarFechaFinSegunEstado()" class="{{ $selectCls }}">
                                <option value="pendiente">{{ __('general.proyectos.modal.estado_pendiente') }}</option>
                                <option value="en_progreso" selected>{{ __('general.proyectos.modal.estado_progreso') }}</option>
                                <option value="completado">{{ __('general.proyectos.modal.estado_completado') }}</option>
                                <option value="cancelado">{{ __('general.proyectos.modal.estado_cancelado') }}</option>
                            </select>
                            <i class="fas fa-chevron-down text-gray-400 text-xs absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                        </div>
                    </div>

                    <input type="hidden" id="proj_visible" value="0">
                </div>

            </div>

            {{-- Columna Derecha --}}
            <div class="flex flex-col gap-5">

                {{-- Enlace del Proyecto --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#e11d48]">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-globe text-[#e11d48] text-sm"></i>
                        <h4 class="font-semibold text-[#1e3a5f] text-sm">{{ __('general.proyectos.modal.seccion_enlace') }}</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">{{ __('general.proyectos.modal.seccion_enlace_desc') }}</p>

                    <label class="flex items-center gap-1 text-xs font-medium text-gray-700 mb-1">
                        <i class="fas fa-globe text-[#e11d48] text-xs"></i> {{ __('general.proyectos.modal.url_label') }}
                    </label>
                    <div class="relative flex items-center gap-2">
                        <input type="url" id="proj_url_link"
                            class="{{ $inputCls }} pr-9"
                            placeholder="https://proyecto-cliente.com">
                        <span id="url_status" class="hidden absolute right-3 text-sm pointer-events-none"></span>
                    </div>
                    <p id="url_hint" class="text-xs text-gray-400 mt-1">{{ __('general.proyectos.modal.url_hint_default') }}</p>
                </div>

                {{-- Referencias --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#e11d48]">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-user-friends text-[#e11d48] text-sm"></i>
                        <h4 class="font-semibold text-[#1e3a5f] text-sm">{{ __('general.proyectos.modal.seccion_refs') }}</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">{{ __('general.proyectos.modal.seccion_refs_desc') }}</p>

                    <label class="block text-xs font-medium text-gray-700 mb-1">{{ __('general.proyectos.modal.refs_label') }}</label>
                    <textarea id="proj_referencias" rows="4"
                        class="{{ $textareaCls }}"
                        placeholder="{{ __('general.proyectos.modal.refs_ph') }}"></textarea>
                    <p class="text-xs text-gray-400 mt-1">{{ __('general.proyectos.modal.refs_help') }}</p>
                </div>

                {{-- Cronograma --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#1e3a5f]">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-calendar-alt text-[#1e3a5f] text-sm"></i>
                        <h4 class="font-semibold text-[#1e3a5f] text-sm">{{ __('general.proyectos.modal.seccion_cron') }}</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">{{ __('general.proyectos.modal.seccion_cron_desc') }}</p>

                    <div class="mb-3">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            {{ __('general.proyectos.modal.fecha_ini') }} <span class="text-[#e11d48]">*</span>
                        </label>
                        <input type="date" id="proj_fecha_ini" required class="{{ $inputCls }}">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            {{ __('general.proyectos.modal.fecha_fin') }}
                            <span id="proj_fecha_fin_required" class="text-[#e11d48] hidden">*</span>
                        </label>
                        <input type="date" id="proj_fecha_fin" disabled
                            class="{{ $inputCls }} disabled:bg-gray-100 disabled:cursor-not-allowed disabled:text-gray-400">
                        <p id="proj_fecha_fin_hint" class="text-xs text-gray-400 mt-1">{{ __('general.proyectos.modal.fecha_fin_hint') }}</p>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
