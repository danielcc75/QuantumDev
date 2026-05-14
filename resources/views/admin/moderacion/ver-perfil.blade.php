@extends('layouts.app')

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Encabezado --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-user-shield text-orange-600 mr-2"></i>
                    Detalle de perfil — Moderación
                </h3>
                <p class="text-sm text-gray-600 mt-1">Información completa del portafolio del usuario</p>
            </div>
            <a href="{{ route('admin.perfiles') }}" class="text-sm text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-1"></i> Volver al listado
            </a>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Datos básicos --}}
            <div class="md:col-span-1 flex flex-col items-center text-center">
                @if($perfil->foto_perfil)
                    <img src="{{ $perfil->foto_perfil }}" alt="" class="h-28 w-28 rounded-full object-cover ring-4 ring-gray-100">
                @else
                    <div class="h-28 w-28 rounded-full bg-gradient-to-r from-[#1e3a5f] to-indigo-600 flex items-center justify-center ring-4 ring-gray-100">
                        <span class="text-2xl font-bold text-white">
                            {{ substr($perfil->usuario->nombre, 0, 1) }}{{ substr($perfil->usuario->apellido, 0, 1) }}
                        </span>
                    </div>
                @endif

                <h4 class="mt-3 text-lg font-bold text-gray-800">
                    {{ $perfil->usuario->nombre }} {{ $perfil->usuario->apellido }}
                </h4>
                <p class="text-sm text-gray-500">{{ $perfil->usuario->correo_electronico }}</p>
                @if($perfil->ubicacion)
                    <p class="text-sm text-gray-600 mt-1"><i class="fas fa-map-marker-alt mr-1"></i>{{ $perfil->ubicacion }}</p>
                @endif

                <div class="mt-3 flex flex-wrap justify-center gap-2">
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
                </div>

                <div class="mt-4 w-full flex flex-col gap-2">
                    <form action="{{ route('admin.moderacion.toggle-visibilidad', $perfil->id_perfil) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-orange-700 bg-orange-100 hover:bg-orange-200 px-3 py-2 rounded-lg text-sm">
                            {{ $perfil->visible ? 'Ocultar portafolio' : 'Mostrar portafolio' }}
                        </button>
                    </form>
                </div>
            </div>

            {{-- Biografía + Nota --}}
            <div class="md:col-span-2 space-y-4">
                <div>
                    <h5 class="text-sm font-semibold text-gray-700 mb-1">Biografía</h5>
                    <p class="text-sm text-gray-700 bg-gray-50 rounded-lg p-3 whitespace-pre-line">
                        {{ $perfil->biografia ?: 'Sin biografía' }}
                    </p>
                </div>

                <div>
                    <h5 class="text-sm font-semibold text-gray-700 mb-1">Nota de moderación</h5>
                    <form action="{{ route('admin.moderacion.agregar-nota', $perfil->id_perfil) }}" method="POST" class="space-y-2">
                        @csrf
                        <textarea name="moderation_note" rows="3" maxlength="500"
                            class="w-full border rounded-lg p-2 text-sm"
                            placeholder="Anota el motivo de la decisión de moderación...">{{ old('moderation_note', $perfil->moderation_note) }}</textarea>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-1.5 rounded-lg">
                            Guardar nota
                        </button>
                    </form>
                </div>

                @if($perfil->links && $perfil->links->count())
                    <div>
                        <h5 class="text-sm font-semibold text-gray-700 mb-1">Enlaces</h5>
                        <ul class="text-sm space-y-1">
                            @foreach($perfil->links as $link)
                                <li>
                                    <span class="font-medium capitalize">{{ $link->tipo }}:</span>
                                    <a href="{{ $link->url }}" target="_blank" rel="noopener" class="text-blue-600 hover:underline break-all">
                                        {{ $link->url }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Experiencia laboral --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-3 border-b border-gray-200 bg-gray-50">
            <h4 class="font-semibold text-gray-800"><i class="fas fa-briefcase text-[#1e3a5f] mr-2"></i>Experiencia laboral</h4>
        </div>
        <div class="p-6">
            @forelse($perfil->experienciasLaborales as $exp)
                <div class="border-l-4 border-[#1e3a5f] pl-4 mb-4">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-gray-800">{{ $exp->cargo }} — {{ $exp->empresa }}</p>
                        @if($exp->publicado)
                            <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs">Publicado</span>
                        @else
                            <span class="px-2 py-0.5 bg-gray-200 text-gray-700 rounded-full text-xs">No publicado</span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500">
                        {{ optional($exp->fecha_ini)->format('Y-m') }} —
                        {{ $exp->trabajo_actual ? 'Actualidad' : optional($exp->fecha_fin)->format('Y-m') }}
                    </p>
                    @if($exp->descripcion)
                        <p class="text-sm text-gray-700 mt-1 whitespace-pre-line">{{ $exp->descripcion }}</p>
                    @endif
                </div>
            @empty
                <p class="text-sm text-gray-500">Sin experiencia laboral registrada.</p>
            @endforelse
        </div>
    </div>

    {{-- Formación académica --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-3 border-b border-gray-200 bg-gray-50">
            <h4 class="font-semibold text-gray-800"><i class="fas fa-graduation-cap text-[#1e3a5f] mr-2"></i>Formación académica</h4>
        </div>
        <div class="p-6">
            @forelse($perfil->formacionAcademica as $form)
                <div class="border-l-4 border-indigo-500 pl-4 mb-4">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-gray-800">{{ $form->titulo }}</p>
                        @if($form->publicado)
                            <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs">Publicado</span>
                        @else
                            <span class="px-2 py-0.5 bg-gray-200 text-gray-700 rounded-full text-xs">No publicado</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600">{{ $form->institucion }} @if($form->nivel) — {{ $form->nivel }} @endif</p>
                    <p class="text-xs text-gray-500">
                        {{ optional($form->fecha_ini)->format('Y-m') }} —
                        {{ optional($form->fecha_fin)->format('Y-m') ?: 'Sin fecha fin' }}
                    </p>
                    @if($form->descripcion)
                        <p class="text-sm text-gray-700 mt-1 whitespace-pre-line">{{ $form->descripcion }}</p>
                    @endif
                </div>
            @empty
                <p class="text-sm text-gray-500">Sin formación académica registrada.</p>
            @endforelse
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('admin.usuarios.show', $perfil->usuario->id_usuario) }}"
           class="text-sm text-blue-700 hover:underline">
            <i class="fas fa-external-link-alt mr-1"></i> Ver ficha de usuario
        </a>
    </div>
</div>
@endsection
