{{-- resources/views/gestionarProyectos/_modal.blade.php
     Modal crear / editar proyectos con diseño tipo página completa dentro de overlay. --}}

@php
    $inputCls    = 'w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/40 focus:border-[#1e3a5f]';
    $selectCls   = $inputCls . ' appearance-none bg-white pr-8';
    $textareaCls = $inputCls . ' resize-none';
@endphp

{{-- ── Modal de Confirmación ─────────────────────────────────────────────── --}}
<div id="modalConfirmacion" class="fixed inset-0 bg-black bg-opacity-60 z-[60] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">

        <div id="confirmHeader" class="h-1.5 w-full"></div>

        <div class="px-6 pt-6 pb-4 text-center">
            <div id="confirmIconWrapper" class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i id="confirmIcon" class="text-2xl"></i>
            </div>
            <h4 id="confirmTitulo" class="text-base font-bold text-[#1e3a5f] mb-1.5"></h4>
            <p id="confirmMensaje" class="text-xs text-gray-500 leading-relaxed"></p>
        </div>

        <div class="flex gap-3 px-6 pb-6">
            <button type="button" onclick="cerrarConfirmacion()"
                class="flex-1 px-4 py-2.5 text-sm border border-gray-200 text-gray-500 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition font-medium">
                No, cancelar
            </button>
            <button type="button" id="confirmBtn"
                class="flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition">
                Confirmar
            </button>
        </div>
    </div>
</div>

{{-- ── Modal Proyecto ───────────────────────────────────────────────────────── --}}
<div id="modalProyecto" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-gray-300 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[95vh] overflow-y-auto flex flex-col">

        {{-- Header --}}
        <div class="bg-[#1e3a5f] text-white px-8 py-5 flex items-center justify-between rounded-t-2xl sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <button type="button" onclick="confirmarCancelar()" class="text-white hover:text-red-300 transition">
                    <i class="fas fa-arrow-left text-lg"></i>
                </button>
                <div>
                    <h3 id="modalProyectoTitulo" class="text-xl font-bold">Crear Nuevo Proyecto</h3>
                    <p class="text-blue-200 text-xs mt-0.5">Completa la información de tu proyecto</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" onclick="confirmarCancelar()"
                    class="px-4 py-2 text-sm border border-white/30 text-white rounded-lg hover:bg-white/10 transition">
                    Cancelar
                </button>
                <button type="button" onclick="confirmarGuardar()"
                    class="flex items-center gap-2 px-4 py-2 text-sm bg-[#e11d48] hover:bg-red-600 text-white rounded-lg font-medium transition">
                    <i class="fas fa-save text-xs"></i> Guardar Proyecto
                </button>
            </div>
        </div>

        {{-- Body --}}
        <form id="formProyecto" class="p-6 grid grid-cols-2 gap-5">
            @csrf
            <input type="hidden" id="proyectoId" value="">

            {{-- Columna Izquierda --}}
            <div class="flex flex-col gap-5">

                {{-- Información Básica --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#1e3a5f]">
                    <h4 class="font-semibold text-[#1e3a5f] text-sm mb-0.5">Información Básica</h4>
                    <p class="text-xs text-[#e11d48] mb-4">Datos principales de tu proyecto</p>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Nombre del Proyecto <span class="text-[#e11d48]">*</span>
                        </label>
                        <input type="text" id="proj_nombre" required
                            class="{{ $inputCls }}"
                            placeholder="Ej: Sistema de Gestión de Inventario">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea id="proj_descripcion" rows="3"
                            class="{{ $textareaCls }}"
                            placeholder="Describe brevemente el proyecto y su objetivo principal..."></textarea>
                    </div>
                </div>

                {{-- Tecnologías --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#1e3a5f]">
                    <div class="flex items-center gap-2 mb-0.5">
                        <i class="fas fa-code text-[#1e3a5f] text-sm"></i>
                        <h4 class="font-semibold text-[#1e3a5f] text-sm">Tecnologías Utilizadas</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Agrega las tecnologías, lenguajes y frameworks que usaste</p>

                    <div class="relative mb-3">
                        <select id="proj_categoria_select" onchange="filtrarTecnologias()"
                            class="{{ $selectCls }} text-gray-500">
                            <option value="">Selecciona una categoría</option>
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
                        </select>
                        <i class="fas fa-chevron-down text-gray-400 text-xs absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    </div>

                    <div id="proj_chips_container" class="hidden mb-2">
                        <div id="proj_chips" class="flex flex-wrap gap-1.5 max-h-28 overflow-y-auto p-1"></div>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-xs text-gray-400">Haz clic para seleccionar, vuelve a hacer clic para deseleccionar</p>
                            <button type="button" onclick="agregarTecnologia()"
                                class="flex items-center gap-1.5 px-3 py-1.5 text-xs bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg transition font-medium">
                                <i class="fas fa-plus text-xs"></i> Agregar seleccionadas
                            </button>
                        </div>
                    </div>

                    <div id="proj_tags" class="flex flex-wrap gap-2 mt-1"></div>
                    <input type="hidden" id="proj_tecnologias">
                </div>

                {{-- Estado y Visibilidad --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#1e3a5f]">
                    <h4 class="font-semibold text-[#1e3a5f] text-sm mb-0.5">Estado y Visibilidad</h4>
                    <p class="text-xs text-gray-400 mb-4">Configura el estado actual y quién puede ver este proyecto</p>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Estado del Proyecto</label>
                        <div class="relative">
                            <select id="proj_estado" class="{{ $selectCls }}">
                                <option value="pendiente">Pendiente</option>
                                <option value="en_progreso" selected>En Curso</option>
                                <option value="completado">Completado</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                            <i class="fas fa-chevron-down text-gray-400 text-xs absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                        </div>
                    </div>

                    <div class="flex items-center justify-between bg-[#1e3a5f]/5 rounded-xl px-4 py-3">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-eye text-[#1e3a5f] text-sm"></i>
                            <div>
                                <p class="text-sm font-medium text-[#1e3a5f]">Proyecto Público</p>
                                <p class="text-xs text-gray-400">Visible en tu portafolio público</p>
                            </div>
                        </div>
                        <button type="button" id="toggleVisible" onclick="toggleVisibleModal()"
                            data-on="1"
                            class="relative inline-flex h-6 w-11 items-center rounded-full bg-[#1e3a5f] transition-colors">
                            <span id="toggleThumb" class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform translate-x-6"></span>
                        </button>
                        <input type="hidden" id="proj_visible" value="1">
                    </div>
                </div>

            </div>

            {{-- Columna Derecha --}}
            <div class="flex flex-col gap-5">

                {{-- Enlace del Proyecto --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#e11d48]">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-globe text-[#e11d48] text-sm"></i>
                        <h4 class="font-semibold text-[#1e3a5f] text-sm">Enlace del Proyecto</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">URL de la página web o aplicación desarrollada para la empresa o institución</p>

                    <label class="flex items-center gap-1 text-xs font-medium text-gray-700 mb-1">
                        <i class="fas fa-globe text-[#e11d48] text-xs"></i> URL del Proyecto Desplegado
                    </label>
                    <div class="relative flex items-center gap-2">
                        <input type="url" id="proj_url_link"
                            class="{{ $inputCls }} pr-9"
                            placeholder="https://proyecto-cliente.com">
                        <span id="url_status" class="hidden absolute right-3 text-sm pointer-events-none"></span>
                    </div>
                    <p id="url_hint" class="text-xs text-gray-400 mt-1">Enlace a la aplicación o sitio web en producción desarrollada para el cliente</p>
                </div>

                {{-- Referencias --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#e11d48]">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-user-friends text-[#e11d48] text-sm"></i>
                        <h4 class="font-semibold text-[#1e3a5f] text-sm">Referencias del Proyecto</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Información sobre personas que pueden dar referencias sobre este proyecto</p>

                    <label class="block text-xs font-medium text-gray-700 mb-1">Referencias</label>
                    <textarea id="proj_referencias" rows="4"
                        class="{{ $textareaCls }}"
                        placeholder="Ej: Juan Pérez - Supervisor de Proyecto&#10;Email: juan@ejemplo.com&#10;Teléfono: +123456789"></textarea>
                    <p class="text-xs text-gray-400 mt-1">Nombre, cargo, email y teléfono de las personas que pueden dar referencias</p>
                </div>

                {{-- Cronograma --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border-t-2 border-t-[#1e3a5f]">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-calendar-alt text-[#1e3a5f] text-sm"></i>
                        <h4 class="font-semibold text-[#1e3a5f] text-sm">Cronograma</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Define las fechas de inicio y finalización</p>

                    <div class="mb-3">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Fecha de Inicio <span class="text-[#e11d48]">*</span>
                        </label>
                        <input type="date" id="proj_fecha_ini" required class="{{ $inputCls }}">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Fecha de Finalización</label>
                        <input type="date" id="proj_fecha_fin" onchange="verificarFechaFinProyecto()"
                            class="{{ $inputCls }}">
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
