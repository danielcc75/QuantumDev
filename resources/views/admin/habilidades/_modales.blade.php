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

<!-- Modal Fusionar -->
<div id="modalFusion" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold mb-4">Fusionar habilidades</h3>
        <form id="formFusion" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nombre original</label>
                <input type="text" id="nombre_original" name="nombre_original" readonly class="w-full px-3 py-2 bg-gray-100 rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Fusionar en</label>
                <input type="text" name="nombre_fusion" required class="w-full px-3 py-2 border rounded-lg" placeholder="Ej: React">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Categoría</label>
                <select name="categoria_id" required class="w-full px-3 py-2 border rounded-lg">
                    @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="cerrarModalFusion()" class="px-4 py-2 bg-gray-300 rounded-lg">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg">Fusionar</button>
            </div>
        </form>
    </div>
</div>
