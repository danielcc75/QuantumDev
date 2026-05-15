<!-- Modal Editar Categoría -->
<div id="modalEditarCategoria" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold mb-4">Editar categoría</h3>
        <form id="formEditarCategoria" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" id="categoria_nombre" name="nombre" required maxlength="100" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">URL de imagen</label>
                <input type="url" id="categoria_imagen" name="imagen" required maxlength="250"
                       placeholder="https://ejemplo.com/imagen.png"
                       class="w-full px-3 py-2 border rounded-lg">
                <div class="flex justify-center mt-3">
                    <img id="categoria_imagen_preview" src="" alt=""
                         class="h-16 w-16 rounded-full object-cover border border-gray-200 hidden">
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="cerrarModalEditarCategoria()" class="px-4 py-2 bg-gray-300 rounded-lg">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-[#1e3a5f] text-white rounded-lg">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Habilidad Blanda -->
<div id="modalEditarBlanda" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold mb-4">Editar habilidad blanda</h3>
        <form id="formEditarBlanda" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" id="blanda_nombre" name="nombre" required maxlength="100" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Descripción</label>
                <input type="text" id="blanda_descripcion" name="descripcion" maxlength="500" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="cerrarModalEditarBlanda()" class="px-4 py-2 bg-gray-300 rounded-lg">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-[#1e3a5f] text-white rounded-lg">Guardar</button>
            </div>
        </form>
    </div>
</div>
