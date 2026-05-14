@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
        <h3 class="text-xl font-bold text-gray-800">
            <i class="fas fa-shield-alt text-orange-600 mr-2"></i>
            Moderación de Perfiles
        </h3>
        <p class="text-sm text-gray-600 mt-1">Revisa y modera los perfiles de los usuarios</p>
    </div>
    
    <!-- Filtros -->
    <div class="px-6 py-3 bg-gray-50 border-b flex gap-3">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" placeholder="Buscar usuario..." value="{{ request('search') }}"
                class="px-3 py-1 border rounded-lg text-sm">
            <select name="visible" class="px-3 py-1 border rounded-lg text-sm">
                <option value="todos">Todos</option>
                <option value="visible" {{ request('visible') == 'visible' ? 'selected' : '' }}>Visibles</option>
                <option value="oculto" {{ request('visible') == 'oculto' ? 'selected' : '' }}>Ocultos</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded-lg text-sm">Filtrar</button>
        </form>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Usuario</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Ubicación</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Nota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($perfiles as $perfil)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($perfil->foto_perfil)
                                <img src="{{ $perfil->foto_perfil }}" alt="" class="h-10 w-10 rounded-full object-cover">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-[#1e3a5f] to-indigo-600 flex items-center justify-center">
                                    <span class="text-sm font-bold text-white">{{ substr($perfil->usuario->nombre, 0, 1) }}{{ substr($perfil->usuario->apellido, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="ml-3">
                                <p class="font-medium">{{ $perfil->usuario->nombre }} {{ $perfil->usuario->apellido }}</p>
                                <p class="text-xs text-gray-500">{{ $perfil->usuario->correo_electronico }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $perfil->ubicacion ?? 'No especificada' }}</td>
                    <td class="px-6 py-4">
                        @if($perfil->visible)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Visible</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Oculto</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm max-w-xs truncate">{{ $perfil->moderation_note ?? 'Sin nota' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <button type="button"
                                onclick="abrirVistaPortafolio({{ $perfil->id_perfil }})"
                                class="text-blue-600 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg">Ver</button>

                            @if($perfil->visible)
                                {{-- Abrir modal para pedir el motivo --}}
                                <button type="button"
                                    onclick="abrirModalOcultar({{ $perfil->id_perfil }}, {!! Js::from(trim($perfil->usuario->nombre . ' ' . $perfil->usuario->apellido)) !!})"
                                    class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                    Ocultar
                                </button>
                            @else
                                <form action="{{ route('admin.moderacion.toggle-visibilidad', $perfil->id_perfil) }}" method="POST">
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
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">No hay perfiles para moderar</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal del portafolio público (reutilizado del home) --}}
@include('home._modal_portafolio_publico')

<script>
    async function abrirVistaPortafolio(idPerfil) {
        try {
            const resp = await fetch(`/admin/moderacion/perfiles/${idPerfil}/portafolio-json`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            if (!resp.ok) throw new Error('No se pudo cargar el portafolio');
            const data = await resp.json();
            if (data.ok && typeof window.abrirModalPortafolio === 'function') {
                window.abrirModalPortafolio({ data: data.portafolio });
            }
        } catch (err) {
            alert('No se pudo abrir la vista del portafolio: ' + err.message);
        }
    }
</script>

{{-- Modal: motivo para ocultar portafolio --}}
<div id="modalOcultar" class="fixed inset-0 z-[80] hidden bg-black/50 backdrop-blur-sm" onclick="cerrarModalOcultarFondo(event)">
    <div class="min-h-full flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-[#1e3a5f] to-[#e11d48] px-6 py-4 flex items-center justify-between">
                <h3 class="text-white font-bold text-lg">
                    <i class="fas fa-eye-slash mr-2"></i> Ocultar portafolio
                </h3>
                <button type="button" onclick="cerrarModalOcultar()" class="text-white/90 hover:text-white text-xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="formOcultar" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <p class="text-sm text-gray-700">
                        Vas a ocultar el portafolio de
                        <span id="modalOcultarUsuario" class="font-semibold text-gray-900"></span>.
                        Indica el motivo (se guardará como nota de moderación y será visible para el equipo administrador).
                    </p>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Motivo <span class="text-red-500">*</span>
                        </label>
                        <textarea name="motivo" id="modalOcultarMotivo" rows="4" maxlength="500" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20 outline-none"
                            placeholder="Ej. Contenido inapropiado, datos personales expuestos, denuncia recibida..."></textarea>
                        <p id="modalOcultarError" class="hidden mt-1 text-xs text-red-600"></p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3 flex justify-end gap-2">
                    <button type="button" onclick="cerrarModalOcultar()"
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
    const __modalOcultar = document.getElementById('modalOcultar');
    const __formOcultar  = document.getElementById('formOcultar');
    const __motivoInput  = document.getElementById('modalOcultarMotivo');
    const __motivoError  = document.getElementById('modalOcultarError');

    function abrirModalOcultar(idPerfil, nombre) {
        __formOcultar.action = `/admin/moderacion/perfiles/${idPerfil}/toggle-visibilidad`;
        document.getElementById('modalOcultarUsuario').textContent = nombre || '';
        __motivoInput.value = '';
        __motivoError.classList.add('hidden');
        __motivoError.textContent = '';
        __modalOcultar.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => __motivoInput.focus(), 50);
    }

    function cerrarModalOcultar() {
        __modalOcultar.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function cerrarModalOcultarFondo(event) {
        if (event.target === __modalOcultar) cerrarModalOcultar();
    }

    __formOcultar.addEventListener('submit', function (e) {
        if (!__motivoInput.value.trim()) {
            e.preventDefault();
            __motivoError.textContent = 'Debes indicar el motivo para ocultar el portafolio.';
            __motivoError.classList.remove('hidden');
            __motivoInput.focus();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !__modalOcultar.classList.contains('hidden')) {
            cerrarModalOcultar();
        }
    });
</script>
@endsection