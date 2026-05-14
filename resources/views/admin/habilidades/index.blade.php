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
        @include('admin.habilidades._tab-tecnicas')
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
                                    <button type="button"
                                        onclick="abrirModalEditarBlanda({{ $blanda->id_habilidad_blanda }}, {!! Js::from($blanda->nombre) !!}, {!! Js::from($blanda->descripcion ?? '') !!})"
                                        class="p-2 rounded-lg bg-blue-100 text-blue-600" title="Editar">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <form action="{{ route('habilidades-blandas.toggle', $blanda->id_habilidad_blanda) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 rounded-lg {{ $blanda->estado === 'activo' ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                                            <i class="fas {{ $blanda->estado === 'activo' ? 'fa-ban' : 'fa-check' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('habilidades-blandas.destroy', $blanda->id_habilidad_blanda) }}" method="POST" data-confirm="¿Eliminar la habilidad blanda «{{ $blanda->nombre }}»?">
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

@include('admin.habilidades._modales')

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

    function actualizarPreviewCategoria(url) {
        const preview = document.getElementById('categoria_imagen_preview');
        if (url && url.trim()) {
            preview.src = url.trim();
            preview.classList.remove('hidden');
            preview.onerror = () => preview.classList.add('hidden');
        } else {
            preview.classList.add('hidden');
            preview.src = '';
        }
    }

    document.getElementById('categoria_imagen')?.addEventListener('input', (e) => {
        actualizarPreviewCategoria(e.target.value);
    });

    function abrirModalEditarCategoria(id, nombre, imagen) {
        const form = document.getElementById('formEditarCategoria');
        form.action = "{{ url('admin/categorias') }}/" + id;
        document.getElementById('categoria_nombre').value = nombre;
        document.getElementById('categoria_imagen').value = imagen || '';
        actualizarPreviewCategoria(imagen || '');
        const modal = document.getElementById('modalEditarCategoria');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function cerrarModalEditarCategoria() {
        const modal = document.getElementById('modalEditarCategoria');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function abrirModalEditarBlanda(id, nombre, descripcion) {
        const form = document.getElementById('formEditarBlanda');
        form.action = "{{ url('admin/habilidades-blandas') }}/" + id;
        document.getElementById('blanda_nombre').value = nombre;
        document.getElementById('blanda_descripcion').value = descripcion;
        const modal = document.getElementById('modalEditarBlanda');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        activarTab('blandas');
    }

    function cerrarModalEditarBlanda() {
        const modal = document.getElementById('modalEditarBlanda');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
