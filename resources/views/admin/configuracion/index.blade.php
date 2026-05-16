@extends('layouts.app')

@section('content')
<div class="space-y-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">
                <i class="fas fa-cog text-[#1e3a5f] mr-2"></i>
                Configuración del sitio
            </h3>
            <p class="text-sm text-gray-600 mt-1">
                Edita los datos que aparecen en el footer y en la home page pública.
            </p>
        </div>

        <form action="{{ route('admin.configuracion.update') }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de la empresa</label>
                <input type="text" name="nombre_empresa" maxlength="100" required
                    value="{{ old('nombre_empresa', $config->nombre_empresa) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea name="descripcion" rows="3" maxlength="1000" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">{{ old('descripcion', $config->descripcion) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Aparece en el footer junto al nombre de la empresa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email de contacto</label>
                    <input type="email" name="email_contacto" maxlength="150" required
                        value="{{ old('email_contacto', $config->email_contacto) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                    <input type="text" name="telefono" maxlength="30" required
                        value="{{ old('telefono', $config->telefono) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:outline-none">
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="bg-[#1e3a5f] hover:bg-[#152c47] text-white font-semibold py-2 px-6 rounded-lg transition inline-flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
