@extends('layouts.app')

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Barra de moderación --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h3 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-eye text-orange-600 mr-2"></i>
                    Portafolio publicado — {{ $perfil->usuario->nombre }} {{ $perfil->usuario->apellido }}
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Vista del portafolio tal como lo ven los visitantes públicos.
                </p>
            </div>
            <a href="{{ route('admin.perfiles') }}" class="text-sm text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-1"></i> Volver al listado
            </a>
        </div>

        <div class="px-6 py-4 flex flex-wrap items-center gap-3">
            @if($perfil->visible)
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Visible (admin)</span>
            @else
                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Oculto (admin)</span>
            @endif

            @php $vis = $perfil->visibilidad ?? 'publico'; @endphp
            @if($vis === 'publico')
                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Perfil público</span>
            @else
                <span class="px-2 py-1 bg-gray-200 text-gray-700 rounded-full text-xs">Perfil privado</span>
            @endif

            @if($perfil->visible)
                <button type="button"
                    onclick="abrirModalOcultar({{ $perfil->id_perfil }}, {!! Js::from(trim($perfil->usuario->nombre . ' ' . $perfil->usuario->apellido)) !!})"
                    class="ml-auto text-orange-700 bg-orange-100 hover:bg-orange-200 px-3 py-2 rounded-lg text-sm">
                    <i class="fas fa-eye-slash mr-1"></i> Ocultar portafolio
                </button>
            @else
                <form action="{{ route('admin.moderacion.toggle-visibilidad', $perfil->id_perfil) }}" method="POST" class="ml-auto">
                    @csrf
                    <button type="submit" class="text-green-700 bg-green-100 hover:bg-green-200 px-3 py-2 rounded-lg text-sm">
                        <i class="fas fa-eye mr-1"></i> Mostrar portafolio
                    </button>
                </form>
            @endif

            <button type="button" onclick="abrirModalPortafolio({ data: window.__portafolioAdmin })"
                class="text-blue-700 bg-blue-100 hover:bg-blue-200 px-3 py-2 rounded-lg text-sm">
                <i class="fas fa-eye mr-1"></i> Reabrir vista pública
            </button>
        </div>
    </div>

    {{-- Nota de moderación --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-3 border-b border-gray-200 bg-gray-50">
            <h4 class="font-semibold text-gray-800">
                <i class="fas fa-sticky-note text-yellow-600 mr-2"></i>Nota de moderación
            </h4>
        </div>
        <form action="{{ route('admin.moderacion.agregar-nota', $perfil->id_perfil) }}" method="POST" class="p-6 space-y-2">
            @csrf
            <textarea name="moderation_note" rows="3" maxlength="500"
                class="w-full border rounded-lg p-2 text-sm"
                placeholder="Anota el motivo de la decisión de moderación...">{{ old('moderation_note', $perfil->moderation_note) }}</textarea>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-1.5 rounded-lg">
                Guardar nota
            </button>
        </form>
    </div>
</div>

{{-- Modal del portafolio público --}}
@include('home._modal_portafolio_publico')

{{-- Modal: motivo para ocultar portafolio --}}
@if($perfil->visible)
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
                        Indica el motivo (se guardará como nota de moderación).
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
@endif

<script>
    window.__portafolioAdmin = @json($portafolio);
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof window.abrirModalPortafolio === 'function') {
            window.abrirModalPortafolio({ data: window.__portafolioAdmin });
        }
    });

    @if($perfil->visible)
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
    @endif
</script>
@endsection
