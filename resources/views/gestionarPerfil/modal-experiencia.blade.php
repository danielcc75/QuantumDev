{{-- resources/views/gestionarPerfil/modal-experiencia.blade.php --}}

<div id="modalExperiencia" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4" onclick="cerrarModalExperienciaFondo(event)">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">

        {{-- Header --}}
        <div class="bg-[#1e3a5f] text-white px-4 sm:px-6 py-4 flex items-center justify-between gap-3 rounded-t-2xl sticky top-0 z-10">
            <div class="min-w-0">
                <h3 id="modalExperienciaTitulo" class="text-base sm:text-lg font-bold truncate">Agregar Experiencia Laboral</h3>
                <p class="text-blue-200 text-xs mt-0.5 hidden sm:block">Completa los detalles de tu experiencia</p>
            </div>
            <button type="button" onclick="confirmarCancelarExperiencia()" class="text-white hover:text-blue-200 transition flex-shrink-0">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        {{-- Body --}}
        <form id="formExperiencia" class="p-4 sm:p-6">
            @csrf
            <input type="hidden" id="exp_id_experiencia" name="id_experiencia">

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Cargo <span class="text-red-500">*</span>
                </label>
                <input type="text" id="exp_cargo" name="cargo"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Ej: Desarrollador Full Stack">
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Empresa <span class="text-red-500">*</span>
                </label>
                <input type="text" id="exp_empresa" name="empresa"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Ej: Google, Microsoft, Startup X">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        Fecha Inicio <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="exp_fecha_ini" name="fecha_ini"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div id="exp_fecha_fin_container">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Fecha Fin</label>
                    <input type="date" id="exp_fecha_fin" name="fecha_fin"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div class="mb-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="exp_trabajo_actual" name="trabajo_actual" class="w-4 h-4 text-blue-500 rounded">
                    <span class="text-sm text-gray-700">Trabajo actualmente aquí</span>
                </label>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="exp_descripcion" name="descripcion" rows="4"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                    placeholder="Describe tus responsabilidades y logros..."></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Referencias
                    <span class="text-gray-400 font-normal">(opcional)</span>
                </label>
                <textarea id="exp_referencias" name="referencias" rows="3"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                    placeholder="Ej: Juan Pérez — Jefe directo · juan@empresa.com · +57 300 000 0000"></textarea>
            </div>

            {{-- Sección opcional: vincular proyecto --}}
            <div id="exp_proyecto_wrapper" class="border-t border-gray-100 pt-4 mt-2">
                <p class="text-sm font-medium text-[#1e3a5f] mb-3">
                    <i class="fas fa-folder-plus text-xs mr-1"></i> Proyecto vinculado
                    <span class="text-gray-400 font-normal text-xs">(opcional)</span>
                </p>

                {{-- Selector de modo --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mb-3">
                    <label class="flex items-center gap-2 px-3 py-2 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition text-xs">
                        <input type="radio" name="exp_proj_modo" value="ninguno" class="text-[#1e3a5f]" checked>
                        <span class="text-gray-700">Ninguno</span>
                    </label>
                    <label class="flex items-center gap-2 px-3 py-2 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition text-xs">
                        <input type="radio" name="exp_proj_modo" value="existente" class="text-[#1e3a5f]">
                        <span class="text-gray-700">Vincular existente</span>
                    </label>
                    <label class="flex items-center gap-2 px-3 py-2 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition text-xs">
                        <input type="radio" name="exp_proj_modo" value="nuevo" class="text-[#1e3a5f]">
                        <span class="text-gray-700">Crear nuevo</span>
                    </label>
                </div>

                {{-- Proyectos ya vinculados (solo en modo edición) --}}
                <div id="exp_proyectos_vinculados_wrapper" class="hidden mb-3">
                    <p class="text-xs font-medium text-gray-600 mb-1.5">Proyectos vinculados actualmente:</p>
                    <div id="exp_proyectos_vinculados" class="flex flex-wrap gap-1.5"></div>
                </div>

                {{-- Modo: vincular existente (multi-select por chips) --}}
                <div id="exp_proyecto_existente" class="hidden bg-[#1e3a5f]/5 border border-[#1e3a5f]/15 rounded-xl p-4 flex flex-col gap-2">
                    <label class="block text-xs font-medium text-gray-700">
                        Selecciona uno o más proyectos <span class="text-red-500">*</span>
                    </label>
                    <div id="exp_proj_existente_chips" class="flex flex-wrap gap-1.5 max-h-40 overflow-y-auto p-1"></div>
                    <p id="exp_proj_existente_vacio" class="text-xs text-gray-400 italic hidden">No hay proyectos disponibles para vincular.</p>
                    <p class="text-xs text-gray-500">Clic para seleccionar / deseleccionar. Los seleccionados se enlazarán a esta experiencia.</p>
                </div>

                {{-- Modo: crear nuevo --}}
                <div id="exp_proyecto_form" class="hidden bg-[#1e3a5f]/5 border border-[#1e3a5f]/15 rounded-xl p-4 flex flex-col gap-3">
                    <p class="text-xs text-gray-500">El proyecto quedará vinculado a esta experiencia y también aparecerá en <strong>Mis Proyectos</strong>.</p>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Nombre del Proyecto <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="exp_proj_nombre"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Ej: Sistema de Gestión Interna">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea id="exp_proj_descripcion" rows="2"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                            placeholder="Breve descripción del proyecto..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">
                                Fecha Inicio <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="exp_proj_fecha_ini"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Fecha Fin</label>
                            <input type="date" id="exp_proj_fecha_fin" onchange="verificarFechaFinProyectoExp()"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>

                    {{-- Enlace obligatorio si el proyecto ya finalizó --}}
                    <div id="exp_proj_url_wrapper" class="hidden">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Enlace del Proyecto <span class="text-red-500">*</span>
                            <span class="text-gray-400 font-normal">(obligatorio porque el proyecto ya finalizó)</span>
                        </label>
                        <input type="url" id="exp_proj_url_link"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="https://proyecto-cliente.com">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Tecnologías</label>

                        {{-- Selector de categoría --}}
                        <div class="relative mb-2">
                            <select id="exp_categoria_select" onchange="filtrarTecnologiasExp()"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 appearance-none bg-white pr-8 text-gray-500">
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

                        {{-- Chips de tecnologías disponibles --}}
                        <div id="exp_chips_container" class="hidden mb-2">
                            <div id="exp_chips" class="flex flex-wrap gap-1.5 max-h-24 overflow-y-auto p-1"></div>
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-xs text-gray-400">Clic para seleccionar, clic de nuevo para deseleccionar</p>
                                <button type="button" onclick="agregarTecnologiaExp()"
                                    class="flex items-center gap-1 px-2.5 py-1 text-xs bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg transition font-medium">
                                    <i class="fas fa-plus text-xs"></i> Agregar
                                </button>
                            </div>
                        </div>

                        {{-- Tags agregados --}}
                        <div id="exp_proj_tags" class="flex flex-wrap gap-1.5 mt-1"></div>
                        <input type="hidden" id="exp_proj_tecnologias">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Estado</label>
                        <select id="exp_proj_estado"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                            <option value="en_progreso">En Curso</option>
                            <option value="completado">Completado</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex gap-3 mt-6 pt-4 border-t border-gray-100">
                <button type="button" onclick="confirmarCancelarExperiencia()"
                    class="flex-1 px-4 py-2 text-sm border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </button>
                <button type="button" onclick="confirmarGuardarExperiencia()"
                    class="flex-1 px-4 py-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg font-medium transition">
                    <i class="fas fa-save text-xs mr-1"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>

@include('gestionarPerfil._modal-confirmacion-experiencia')
@include('gestionarPerfil._scripts-experiencia')

