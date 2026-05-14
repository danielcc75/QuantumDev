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
                        <button type="button" onclick="abrirModalEditarCategoria({{ $categoria->id_categoria }}, {!! Js::from($categoria->nombre) !!})"
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

