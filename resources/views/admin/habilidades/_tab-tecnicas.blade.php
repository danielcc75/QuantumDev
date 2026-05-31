        <div data-tab-panel="tecnicas" class="p-6 space-y-6">

            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">Total Habilidades</p>
                    <p class="text-3xl font-bold">{{ $habilidades->total() }}</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
                    <p class="text-gray-500 text-sm">Habilidad más popular</p>
                    <p class="text-xl font-bold">{{ $habilidadPopular->nombre ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-500">{{ $habilidadPopular->total ?? 0 }} usuarios</p>
                </div>
            </div>

            <!-- Gestión de Categorías -->
            <div class="bg-gray-50 rounded-xl p-4 space-y-4">
                <h3 class="font-semibold text-gray-700">
                    <i class="fas fa-tags mr-2 text-[#1e3a5f]"></i> Categorías de habilidades técnicas
                </h3>

                <form action="{{ route('admin.categorias.store') }}" method="POST" class="flex flex-wrap gap-3">
                    @csrf
                    <input type="text" name="nombre" required maxlength="100" placeholder="Nueva categoría"
                        value="{{ old('nombre') }}"
                        class="flex-1 min-w-[180px] px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f]">
                    <input type="url" name="imagen" required maxlength="250" placeholder="URL de imagen (https://...)"
                        value="{{ old('imagen') }}"
                        class="flex-1 min-w-[220px] px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f]">
                    <button type="submit" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg hover:bg-[#152c47] transition">
                        <i class="fas fa-plus mr-1"></i> Agregar
                    </button>
                    <button type="button" onclick="abrirModalSugerenciasCategoria()" class="bg-[#e11d48] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition shadow-sm font-medium">
                        <i class="fas fa-lightbulb mr-1"></i> Sugerencias
                    </button>
                </form>

                @if($categorias->count() > 0)
                <div class="flex flex-wrap gap-2">
                    @foreach($categorias as $categoria)
                    <div class="inline-flex items-center bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-sm">
                        @if($categoria->imagen)
                            <img src="{{ $categoria->imagen }}" alt="{{ $categoria->nombre }}"
                                 class="h-6 w-6 rounded-full object-cover border border-gray-200 mr-2"
                                 onerror="this.onerror=null;this.style.display='none';">
                        @else
                            <span class="h-6 w-6 rounded-full bg-gray-100 mr-2 flex items-center justify-center text-gray-400 text-xs">
                                <i class="fas fa-image"></i>
                            </span>
                        @endif
                        <span class="font-medium text-gray-700">{{ $categoria->nombre }}</span>
                        <span class="ml-2 text-xs text-gray-500">({{ $categoria->habilidades_count ?? 0 }})</span>
                        <button type="button" onclick="abrirModalEditarCategoria({{ $categoria->id_categoria }}, {!! Js::from($categoria->nombre) !!}, {!! Js::from($categoria->imagen ?? '') !!})"
                            class="ml-2 text-blue-600 hover:text-blue-800" title="Editar">
                            <i class="fas fa-pen text-xs"></i>
                        </button>
                        <form action="{{ route('admin.categorias.destroy', $categoria->id_categoria) }}" method="POST"
                            class="inline ml-1" data-confirm="¿Eliminar la categoría «{{ $categoria->nombre }}»?">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">USUARIO</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ESTADO</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($habilidades as $habilidad)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $habilidad->nombre }}</td>
                            <td class="px-6 py-4">{{ $habilidad->categoria->nombre ?? 'Sin categoría' }}</td>
                            <td class="px-6 py-4">{{ $habilidad->perfil?->usuario?->nombre_completo ?? 'Sin usuario' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs {{ $habilidad->activa ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $habilidad->activa ? 'Activa' : 'Inactiva' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.habilidades.show', $habilidad->id_habilidad) }}"
                                       class="text-blue-600 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg">Ver</a>

                                    @if($habilidad->activa)
                                        <button type="button"
                                            onclick="abrirModalOcultarHabilidad({{ $habilidad->id_habilidad }}, {!! Js::from($habilidad->nombre) !!})"
                                            class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                            Ocultar
                                        </button>
                                    @else
                                        <form action="{{ route('admin.habilidades.toggle', $habilidad->id_habilidad) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-green-700 bg-green-100 hover:bg-green-200 p-2 rounded-lg">
                                                Mostrar
                                            </button>
                                        </form>
                                    @endif
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

{{-- Modal Sugerencias de Categorías (Frontend) --}}
<div id="modal-sugerencias-categoria" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[70] p-4" onclick="cerrarModalSugerenciasCategoriaFondo(event)">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md flex flex-col">
        <div class="flex justify-between items-center p-4 border-b border-gray-100 bg-gray-50 rounded-t-xl">
            <h3 class="text-lg font-bold text-[#1e3a5f]"><i class="fas fa-lightbulb text-[#e11d48] mr-2"></i>Sugerencias de Usuarios</h3>
            <button type="button" onclick="cerrarModalSugerenciasCategoria()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div class="p-4 max-h-96 overflow-y-auto">
            <div class="flex flex-col items-center justify-center py-8">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                    <i class="fas fa-inbox text-2xl text-gray-400"></i>
                </div>
                <p class="text-sm text-gray-500 text-center">No hay nuevas sugerencias por el momento.</p>
            </div>
        </div>
        <div class="p-4 border-t border-gray-100 flex justify-end bg-gray-50 rounded-b-xl">
            <button type="button" onclick="cerrarModalSugerenciasCategoria()" class="px-5 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">Cerrar</button>
        </div>
    </div>
</div>

<script>
    window.abrirModalSugerenciasCategoria = function() {
        const modal = document.getElementById("modal-sugerencias-categoria");
        if(modal) { modal.classList.remove("hidden"); modal.classList.add("flex"); }
    };
    window.cerrarModalSugerenciasCategoria = function() {
        const modal = document.getElementById("modal-sugerencias-categoria");
        if(modal) { modal.classList.add("hidden"); modal.classList.remove("flex"); }
    };
    window.cerrarModalSugerenciasCategoriaFondo = function(event) {
        if (event.target.id === "modal-sugerencias-categoria") { cerrarModalSugerenciasCategoria(); }
    };
</script>

