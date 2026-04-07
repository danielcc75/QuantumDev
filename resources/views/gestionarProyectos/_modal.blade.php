{{-- resources/views/gestionarProyectos/_modal.blade.php
     Modal compartido para crear y editar proyectos. --}}

<div id="modalProyecto" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">

        <div class="sticky top-0 bg-white border-b border-gray-100 px-6 py-4 flex justify-between items-center">
            <h3 id="modalProyectoTitulo" class="text-lg font-semibold text-gray-800">Nuevo Proyecto</h3>
            <button onclick="cerrarModalProyecto()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <form id="formProyecto" class="p-6 space-y-4">
            @csrf
            <input type="hidden" id="proyectoId" value="">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del proyecto *</label>
                <input type="text" id="proj_nombre" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Ej: Sistema de inventario">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="proj_descripcion" rows="3"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Describe brevemente el proyecto..."></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha inicio *</label>
                    <input type="date" id="proj_fecha_ini" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha fin</label>
                    <input type="date" id="proj_fecha_fin"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select id="proj_estado"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                    <option value="pendiente">Pendiente</option>
                    <option value="en_progreso">En progreso</option>
                    <option value="completado">Completado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tecnologías</label>
                <input type="text" id="proj_tecnologias"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="React, Node.js, PostgreSQL (separadas por coma)">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL demo / repositorio</label>
                <input type="url" id="proj_url_link"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="https://...">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Referencias / notas</label>
                <input type="text" id="proj_referencias"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Links o notas adicionales">
            </div>

            <div class="flex items-center gap-3">
                <label class="text-sm font-medium text-gray-700">Visible al público</label>
                <input type="checkbox" id="proj_visible" checked class="w-4 h-4 accent-blue-500">
            </div>

            <div class="flex justify-end gap-3 pt-2 border-t border-gray-100">
                <button type="button" onclick="cerrarModalProyecto()"
                    class="px-4 py-2 text-sm border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm bg-gray-900 text-white rounded-lg hover:bg-gray-700 transition">
                    Guardar
                </button>
            </div>
        </form>

    </div>
</div>
