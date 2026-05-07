@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <!-- Título -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-code text-[#1e3a5f] mr-2"></i>
            Gestión de Habilidades
        </h1>
        <p class="text-gray-500 mt-1">Administra el catálogo global de habilidades</p>
    </div>
    
    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <p class="text-gray-500 text-sm">Total Habilidades</p>
            <p class="text-3xl font-bold">{{ $habilidades->total() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <p class="text-gray-500 text-sm">Habilidad más popular</p>
            <p class="text-xl font-bold">{{ $habilidadPopular->nombre ?? 'N/A' }}</p>
            <p class="text-sm text-gray-500">{{ $habilidadPopular->total ?? 0 }} usuarios</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
            <p class="text-gray-500 text-sm">Habilidades duplicadas</p>
            <p class="text-3xl font-bold">{{ $habilidadesDuplicadas->count() }}</p>
            <p class="text-sm text-gray-500">Mismos nombres diferentes</p>
        </div>
    </div>
    
    <!-- Habilidades duplicadas -->
    @if($habilidadesDuplicadas->count() > 0)
    <div class="bg-yellow-50 rounded-xl shadow-md p-6 border border-yellow-200">
        <h3 class="font-bold text-yellow-800 mb-3">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Habilidades duplicadas detectadas
        </h3>
        <div class="space-y-2">
            @foreach($habilidadesDuplicadas as $duplicada)
            <div class="flex justify-between items-center">
                <span class="text-gray-700">{{ $duplicada->nombre }} ({{ $duplicada->total }} veces)</span>
                <button onclick="abrirModalFusion('{{ $duplicada->nombre }}')" 
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm">
                    <i class="fas fa-code-branch mr-1"></i> Fusionar
                </button>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Filtros -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <form method="GET" class="flex flex-wrap gap-4">
            <input type="text" name="search" placeholder="Buscar habilidad..." value="{{ request('search') }}"
                class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f]">
            <select name="categoria" class="px-4 py-2 border rounded-lg">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id_categoria }}" {{ request('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
                @endforeach
            </select>
            <button type="submit" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg">Filtrar</button>
        </form>
    </div>
    
    <!-- Tabla de habilidades -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">HABILIDAD</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">CATEGORÍA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">USUARIOS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ESTADO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($habilidades as $habilidad)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $habilidad->nombre }}</td>
                    <td class="px-6 py-4">{{ $habilidad->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td class="px-6 py-4">{{ $habilidad->perfil_id ? 1 : 0 }} usuarios</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs {{ $habilidad->activa ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $habilidad->activa ? 'Activa' : 'Inactiva' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <form action="{{ route('admin.habilidades.toggle', $habilidad->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 rounded-lg {{ $habilidad->activa ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                                    <i class="fas {{ $habilidad->activa ? 'fa-ban' : 'fa-check' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.habilidades.destroy', $habilidad->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta habilidad?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg bg-red-100 text-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">No hay habilidades registradas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $habilidades->links() }}
        </div>
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

<script>
    function abrirModalFusion(nombre) {
        document.getElementById('nombre_original').value = nombre;
        document.getElementById('formFusion').action = "{{ route('admin.habilidades.fusionar') }}";
        document.getElementById('modalFusion').classList.remove('hidden');
    }
    
    function cerrarModalFusion() {
        document.getElementById('modalFusion').classList.add('hidden');
    }
</script>
@endsection