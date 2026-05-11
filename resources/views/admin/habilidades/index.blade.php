@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Título -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-code text-[#1e3a5f] mr-2"></i>
            Gestión de Habilidades
        </h1>
        <p class="text-gray-500 mt-1">Administra el catálogo global de habilidades técnicas y blandas</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tabs -->
    <div class="bg-white rounded-xl shadow-md">
        <div class="border-b border-gray-200 flex">
            <button type="button" data-tab="tecnicas"
                class="tab-btn px-6 py-3 border-b-2 font-medium text-sm transition-colors border-[#1e3a5f] text-[#1e3a5f]">
                <i class="fas fa-laptop-code mr-2"></i> Técnicas
            </button>
            <button type="button" data-tab="blandas"
                class="tab-btn px-6 py-3 border-b-2 font-medium text-sm transition-colors border-transparent text-gray-500 hover:text-gray-700">
                <i class="fas fa-users mr-2"></i> Blandas
            </button>
        </div>

        <!-- ============ TAB: TÉCNICAS ============ -->
        <div data-tab-panel="tecnicas" class="p-6 space-y-6">

            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">Total Habilidades</p>
                    <p class="text-3xl font-bold">{{ $habilidades->total() }}</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
                    <p class="text-gray-500 text-sm">Habilidad más popular</p>
                    <p class="text-xl font-bold">{{ $habilidadPopular->nombre ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-500">{{ $habilidadPopular->total ?? 0 }} usuarios</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500">
                    <p class="text-gray-500 text-sm">Habilidades duplicadas</p>
                    <p class="text-3xl font-bold">{{ $habilidadesDuplicadas->count() }}</p>
                    <p class="text-sm text-gray-500">Mismos nombres diferentes</p>
                </div>
            </div>

            @if($habilidadesDuplicadas->count() > 0)
            <div class="bg-yellow-50 rounded-xl shadow p-6 border border-yellow-200">
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

            <!-- Gestión de Categorías -->
            <div class="bg-gray-50 rounded-xl p-4 space-y-4">
                <h3 class="font-semibold text-gray-700">
                    <i class="fas fa-tags mr-2 text-[#1e3a5f]"></i> Categorías de habilidades técnicas
                </h3>

                <form action="{{ route('admin.categorias.store') }}" method="POST" class="flex flex-wrap gap-3">
                    @csrf
                    <input type="text" name="nombre" required maxlength="100" placeholder="Nueva categoría"
                        class="flex-1 min-w-[200px] px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f]">
                    <button type="submit" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-plus mr-1"></i> Agregar
                    </button>
                </form>

                @if($categorias->count() > 0)
                <div class="flex flex-wrap gap-2">
                    @foreach($categorias as $categoria)
                    <div class="inline-flex items-center bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-sm">
                        <span class="font-medium text-gray-700">{{ $categoria->nombre }}</span>
                        <span class="ml-2 text-xs text-gray-500">({{ $categoria->habilidades_count ?? 0 }})</span>
                        <button type="button" onclick="abrirModalEditarCategoria({{ $categoria->id_categoria }}, '{{ addslashes($categoria->nombre) }}')"
                            class="ml-2 text-blue-600 hover:text-blue-800" title="Editar">
                            <i class="fas fa-pen text-xs"></i>
                        </button>
                        <form action="{{ route('admin.categorias.destroy', $categoria->id_categoria) }}" method="POST"
                            class="inline ml-1" onsubmit="return confirm('¿Eliminar la categoría {{ $categoria->nombre }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" title="Eliminar">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Filtros -->
            <div class="bg-gray-50 rounded-xl p-4">
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

            <!-- Tabla técnicas -->
            <div class="bg-white rounded-xl shadow overflow-hidden">
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
                                    <form action="{{ route('admin.habilidades.toggle', $habilidad->id_habilidad) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 rounded-lg {{ $habilidad->activa ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                                            <i class="fas {{ $habilidad->activa ? 'fa-ban' : 'fa-check' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.habilidades.destroy', $habilidad->id_habilidad) }}" method="POST" onsubmit="return confirm('¿Eliminar esta habilidad?')">
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
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">No hay habilidades técnicas registradas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4">
                    {{ $habilidades->links() }}
                </div>
            </div>
        </div>

        <!-- ============ TAB: BLANDAS ============ -->
        <div data-tab-panel="blandas" class="p-6 space-y-6 hidden">

            <!-- Crear nueva blanda -->
            <div class="bg-gray-50 rounded-xl p-4">
                <h3 class="font-semibold text-gray-700 mb-3">Registrar nueva habilidad blanda</h3>
                <form action="{{ route('habilidades-blandas.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @csrf
                    <input type="text" name="nombre" required maxlength="100" placeholder="Nombre"
                        class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f]">
                    <input type="text" name="descripcion" maxlength="500" placeholder="Descripción (opcional)"
                        class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] md:col-span-1">
                    <button type="submit" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-plus mr-1"></i> Registrar
                    </button>
                </form>
            </div>

            <!-- Tabla blandas -->
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">NOMBRE</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">DESCRIPCIÓN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ESTADO</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($habilidadesBlandas as $blanda)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $blanda->nombre }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $blanda->descripcion ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs {{ $blanda->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $blanda->estado === 'activo' ? 'Activa' : 'Inactiva' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <form action="{{ route('habilidades-blandas.toggle', $blanda->id_habilidad_blanda) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 rounded-lg {{ $blanda->estado === 'activo' ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                                            <i class="fas {{ $blanda->estado === 'activo' ? 'fa-ban' : 'fa-check' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('habilidades-blandas.destroy', $blanda->id_habilidad_blanda) }}" method="POST" onsubmit="return confirm('¿Eliminar esta habilidad blanda?')">
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
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">No hay habilidades blandas registradas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
    function activarTab(target) {
        document.querySelectorAll('.tab-btn').forEach(b => {
            const activo = b.dataset.tab === target;
            b.classList.toggle('border-[#1e3a5f]', activo);
            b.classList.toggle('text-[#1e3a5f]', activo);
            b.classList.toggle('border-transparent', !activo);
            b.classList.toggle('text-gray-500', !activo);
            b.classList.toggle('hover:text-gray-700', !activo);
        });
        document.querySelectorAll('[data-tab-panel]').forEach(p => {
            p.classList.toggle('hidden', p.dataset.tabPanel !== target);
        });
    }

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => activarTab(btn.dataset.tab));
    });

    @if(session('active_tab'))
        activarTab(@json(session('active_tab')));
    @endif

    function abrirModalFusion(nombre) {
        document.getElementById('nombre_original').value = nombre;
        document.getElementById('formFusion').action = "{{ route('admin.habilidades.fusionar') }}";
        document.getElementById('modalFusion').classList.remove('hidden');
        document.getElementById('modalFusion').classList.add('flex');
    }

    function cerrarModalFusion() {
        document.getElementById('modalFusion').classList.add('hidden');
        document.getElementById('modalFusion').classList.remove('flex');
    }

    function abrirModalEditarCategoria(id, nombre) {
        const form = document.getElementById('formEditarCategoria');
        form.action = "{{ url('admin/categorias') }}/" + id;
        document.getElementById('categoria_nombre').value = nombre;
        const modal = document.getElementById('modalEditarCategoria');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function cerrarModalEditarCategoria() {
        const modal = document.getElementById('modalEditarCategoria');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
