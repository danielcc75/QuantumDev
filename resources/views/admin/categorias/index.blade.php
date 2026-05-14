@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold text-gray-800">
                <i class="fas fa-tags text-[#1e3a5f] mr-2"></i>
                Gestión de Categorías
            </h3>
            <p class="text-sm text-gray-600 mt-1">Administra las categorías de habilidades</p>
        </div>
        <button onclick="abrirModalCrear()" class="bg-[#1e3a5f] hover:bg-[#152c47] text-white font-semibold py-2 px-4 rounded-lg transition inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Nueva Categoría
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Habilidades</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categorias as $categoria)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $categoria->id_categoria }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-medium text-gray-900">{{ $categoria->nombre }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                            {{ $categoria->habilidades_count ?? 0 }} habilidades
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button onclick="editarCategoria({{ $categoria->id_categoria }}, {!! Js::from($categoria->nombre) !!})"
                                    class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.categorias.destroy', $categoria->id_categoria) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta categoría?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 p-2 rounded-lg transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-tags text-4xl mb-3 opacity-50"></i>
                        <p>No hay categorías registradas</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4">
        {{ $categorias->links() }}
    </div>
</div>

<!-- Modal Crear/Editar Categoría -->
<div id="modalCategoria" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modalTitulo" class="text-lg font-bold text-gray-900">Nueva Categoría</h3>
            <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="formCategoria" method="POST">
            @csrf
            <input type="hidden" name="_method" id="methodField" value="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                <input type="text" name="nombre" id="categoriaNombre" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]"
                    placeholder="Ej: Programación, Diseño, Marketing">
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="cerrarModal()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-[#1e3a5f] text-white rounded-lg hover:bg-[#152c47]">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function abrirModalCrear() {
        document.getElementById('modalTitulo').innerText = 'Nueva Categoría';
        document.getElementById('formCategoria').action = "{{ route('admin.categorias.store') }}";
        document.getElementById('methodField').value = 'POST';
        document.getElementById('categoriaNombre').value = '';
        document.getElementById('modalCategoria').classList.remove('hidden');
    }
    
    function editarCategoria(id, nombre) {
        document.getElementById('modalTitulo').innerText = 'Editar Categoría';
        document.getElementById('formCategoria').action = `/admin/categorias/${id}`;
        document.getElementById('methodField').value = 'PUT';
        document.getElementById('categoriaNombre').value = nombre;
        document.getElementById('modalCategoria').classList.remove('hidden');
    }
    
    function cerrarModal() {
        document.getElementById('modalCategoria').classList.add('hidden');
    }
    
    // Cerrar modal con ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            cerrarModal();
        }
    });
    
    // Cerrar modal al hacer clic fuera
    document.getElementById('modalCategoria').addEventListener('click', function(e) {
        if (e.target === this) {
            cerrarModal();
        }
    });
</script>
@endsection