@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold text-gray-800">
                <i class="fas fa-microchip text-blue-600 mr-2"></i>
                Gestión de Tecnologías
            </h3>
            <p class="text-sm text-gray-600 mt-1">Administra el catálogo de tecnologías</p>
        </div>
        <button onclick="abrirModalCrear()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition transform hover:scale-105 inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Nueva Tecnología
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($tecnologias as $tecnologia)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $tecnologia->id_tecnologia }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-medium text-gray-900">{{ $tecnologia->nombre }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
                            {{ $tecnologia->categoria }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button onclick="editarTecnologia({{ $tecnologia->id_tecnologia }}, '{{ $tecnologia->nombre }}', '{{ $tecnologia->categoria }}')" 
                                    class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.tecnologias.destroy', $tecnologia->id_tecnologia) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta tecnología?')">
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
                        <i class="fas fa-microchip text-4xl mb-3 opacity-50"></i>
                        <p>No hay tecnologías registradas</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4">
        {{ $tecnologias->links() }}
    </div>
</div>

<!-- Modal Crear/Editar Tecnología -->
<div id="modalTecnologia" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modalTitulo" class="text-lg font-bold text-gray-900">Nueva Tecnología</h3>
            <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="formTecnologia" method="POST">
            @csrf
            <input type="hidden" name="_method" id="methodField" value="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                <input type="text" name="nombre" id="tecnologiaNombre" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ej: Laravel, React, Python">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Categoría *</label>
                <select id="tecnologiaCategoriaSelect" onchange="onCategoriaChange()"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Seleccionar categoría</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                    <option value="__nueva__">+ Crear nueva categoría</option>
                </select>
                <input type="text" id="tecnologiaCategoriaNueva" maxlength="100"
                    class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 hidden"
                    placeholder="Nombre de la nueva categoría">
                <input type="hidden" name="categoria" id="tecnologiaCategoria" required>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="cerrarModal()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function setCategoriaUI(valor) {
        const select = document.getElementById('tecnologiaCategoriaSelect');
        const nueva  = document.getElementById('tecnologiaCategoriaNueva');
        const hidden = document.getElementById('tecnologiaCategoria');

        nueva.classList.add('hidden');
        nueva.value = '';

        if (!valor) {
            select.value = '';
            hidden.value = '';
            return;
        }

        const existe = Array.from(select.options).some(o => o.value === valor && o.value !== '__nueva__');
        if (existe) {
            select.value = valor;
            hidden.value = valor;
        } else {
            select.value = '__nueva__';
            nueva.classList.remove('hidden');
            nueva.value = valor;
            hidden.value = valor;
        }
    }

    function onCategoriaChange() {
        const select = document.getElementById('tecnologiaCategoriaSelect');
        const nueva  = document.getElementById('tecnologiaCategoriaNueva');
        const hidden = document.getElementById('tecnologiaCategoria');

        if (select.value === '__nueva__') {
            nueva.classList.remove('hidden');
            nueva.value = '';
            hidden.value = '';
            nueva.focus();
        } else {
            nueva.classList.add('hidden');
            nueva.value = '';
            hidden.value = select.value;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const nueva  = document.getElementById('tecnologiaCategoriaNueva');
        const hidden = document.getElementById('tecnologiaCategoria');
        nueva.addEventListener('input', () => { hidden.value = nueva.value.trim(); });

        document.getElementById('formTecnologia').addEventListener('submit', function (e) {
            if (!hidden.value || !hidden.value.trim()) {
                e.preventDefault();
                alert('Selecciona una categoría existente o escribe el nombre de la nueva.');
            }
        });
    });

    function abrirModalCrear() {
        document.getElementById('modalTitulo').innerText = 'Nueva Tecnología';
        document.getElementById('formTecnologia').action = "{{ route('admin.tecnologias.store') }}";
        document.getElementById('methodField').value = 'POST';
        document.getElementById('tecnologiaNombre').value = '';
        setCategoriaUI('');
        document.getElementById('modalTecnologia').classList.remove('hidden');
    }

    function editarTecnologia(id, nombre, categoria) {
        document.getElementById('modalTitulo').innerText = 'Editar Tecnología';
        document.getElementById('formTecnologia').action = `/admin/tecnologias/${id}`;
        document.getElementById('methodField').value = 'PUT';
        document.getElementById('tecnologiaNombre').value = nombre;
        setCategoriaUI(categoria);
        document.getElementById('modalTecnologia').classList.remove('hidden');
    }

    function cerrarModal() {
        document.getElementById('modalTecnologia').classList.add('hidden');
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            cerrarModal();
        }
    });
</script>
@endsection