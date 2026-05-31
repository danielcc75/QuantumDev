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
                <form action="{{ route('habilidades-blandas.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    @csrf
                    <input type="text" name="nombre" required maxlength="100" placeholder="Nombre"
                        class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] md:col-span-1">
                    <input type="text" name="descripcion" maxlength="500" placeholder="Descripción (opcional)"
                        class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] md:col-span-2">
                    <div class="flex gap-2">
                        <button type="submit" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg hover:bg-[#152c47] transition flex-1">
                            <i class="fas fa-plus mr-1"></i> Registrar
                        </button>
                        <button type="button" onclick="abrirModalSugerenciasBlanda()" class="bg-[#e11d48] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition shadow-sm font-medium flex-1">
                            <i class="fas fa-lightbulb mr-1"></i> Sugerencias
                        </button>
                    </div>
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

{{-- Modal: motivo para ocultar habilidad técnica --}}
<div id="modalOcultarHabilidad" class="fixed inset-0 z-[80] hidden bg-black/50 backdrop-blur-sm" onclick="cerrarModalOcultarHabilidadFondo(event)">
    <div class="min-h-full flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-[#1e3a5f] to-[#e11d48] px-6 py-4 flex items-center justify-between">
                <h3 class="text-white font-bold text-lg">
                    <i class="fas fa-eye-slash mr-2"></i> Ocultar habilidad
                </h3>
                <button type="button" onclick="cerrarModalOcultarHabilidad()" class="text-white/90 hover:text-white text-xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="formOcultarHabilidad" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <p class="text-sm text-gray-700">
                        Vas a ocultar la habilidad
                        <span id="modalOcultarHabilidadNombre" class="font-semibold text-gray-900"></span>.
                        Indica el motivo (será visible para el dueño de la habilidad en su panel).
                    </p>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Motivo <span class="text-red-500">*</span>
                        </label>
                        <textarea name="motivo" id="modalOcultarHabilidadMotivo" rows="4" maxlength="500" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20 outline-none"
                            placeholder="Ej. Nombre poco profesional, duplicado, no corresponde a la categoría..."></textarea>
                        <p id="modalOcultarHabilidadError" class="hidden mt-1 text-xs text-red-600"></p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3 flex justify-end gap-2">
                    <button type="button" onclick="cerrarModalOcultarHabilidad()"
                        class="px-4 py-2 rounded-lg text-sm text-gray-700 bg-gray-200 hover:bg-gray-300">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg text-sm text-white bg-[#e11d48] hover:bg-[#be123c]">
                        <i class="fas fa-eye-slash mr-1"></i> Confirmar ocultar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const __modalOcultarHab = document.getElementById('modalOcultarHabilidad');
    const __formOcultarHab  = document.getElementById('formOcultarHabilidad');
    const __motivoHabInput  = document.getElementById('modalOcultarHabilidadMotivo');
    const __motivoHabError  = document.getElementById('modalOcultarHabilidadError');

    function abrirModalOcultarHabilidad(idHab, nombre) {
        __formOcultarHab.action = `/admin/habilidades/${idHab}/toggle`;
        document.getElementById('modalOcultarHabilidadNombre').textContent = nombre || '';
        __motivoHabInput.value = '';
        __motivoHabError.classList.add('hidden');
        __motivoHabError.textContent = '';
        __modalOcultarHab.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => __motivoHabInput.focus(), 50);
    }

    function cerrarModalOcultarHabilidad() {
        __modalOcultarHab.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function cerrarModalOcultarHabilidadFondo(event) {
        if (event.target === __modalOcultarHab) cerrarModalOcultarHabilidad();
    }

    __formOcultarHab.addEventListener('submit', function (e) {
        if (!__motivoHabInput.value.trim()) {
            e.preventDefault();
            __motivoHabError.textContent = 'Debes indicar el motivo para ocultar la habilidad.';
            __motivoHabError.classList.remove('hidden');
            __motivoHabInput.focus();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !__modalOcultarHab.classList.contains('hidden')) {
            cerrarModalOcultarHabilidad();
        }
    });
</script>

{{-- Modal Sugerencias de Habilidades Blandas (Frontend) --}}
<div id="modal-sugerencias-blanda" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[70] p-4" onclick="cerrarModalSugerenciasBlandaFondo(event)">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md flex flex-col">
        <div class="flex justify-between items-center p-4 border-b border-gray-100 bg-gray-50 rounded-t-xl">
            <h3 class="text-lg font-bold text-[#1e3a5f]"><i class="fas fa-lightbulb text-[#e11d48] mr-2"></i>Sugerencias de Usuarios</h3>
            <button type="button" onclick="cerrarModalSugerenciasBlanda()" class="text-gray-400 hover:text-gray-600 transition">
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
            <button type="button" onclick="cerrarModalSugerenciasBlanda()" class="px-5 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">Cerrar</button>
        </div>
    </div>
</div>

<script>
    window.abrirModalSugerenciasBlanda = function() {
        const modal = document.getElementById("modal-sugerencias-blanda");
        if(modal) { modal.classList.remove("hidden"); modal.classList.add("flex"); }
    };
    window.cerrarModalSugerenciasBlanda = function() {
        const modal = document.getElementById("modal-sugerencias-blanda");
        if(modal) { modal.classList.add("hidden"); modal.classList.remove("flex"); }
    };
    window.cerrarModalSugerenciasBlandaFondo = function(event) {
        if (event.target.id === "modal-sugerencias-blanda") { cerrarModalSugerenciasBlanda(); }
    };
</script>
        }
    });
</script>
@endsection
