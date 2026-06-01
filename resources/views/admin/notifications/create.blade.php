{{-- resources/views/admin/notifications/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <div class="mb-4">
        <a href="{{ route('admin.notifications') }}" class="text-[#1e3a5f] hover:underline">
            <i class="fas fa-arrow-left mr-2"></i> Volver a notificaciones
        </a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#1e3a5f] to-indigo-600 px-6 py-4">
            <h1 class="text-xl font-bold text-white">
                <i class="fas fa-bell mr-2"></i> Nueva Notificación
            </h1>
            <p class="text-blue-200 text-sm">Envía notificaciones a los usuarios del sistema</p>
        </div>
        
        <form action="{{ route('admin.notifications.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de notificación *</label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="tipo" value="info" checked class="mr-1"> ℹ️ Información
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="tipo" value="success" class="mr-1"> ✅ Éxito
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="tipo" value="warning" class="mr-1"> ⚠️ Advertencia
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="tipo" value="error" class="mr-1"> ❌ Error
                    </label>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Destinatario *</label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="destinatario" value="todos" id="paraTodos" checked class="mr-1"> Todos los usuarios
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="destinatario" value="individual" id="paraIndividual" class="mr-1"> Usuario específico
                    </label>
                </div>
            </div>
            
            <div id="selectUsuario" class="mb-4 hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Seleccionar usuario *</label>
                <select name="usuario_id" class="w-full px-3 py-2 border rounded-lg">
                    <option value="">-- Seleccionar --</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }} {{ $usuario->apellido }} ({{ $usuario->correo_electronico }})</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
                <input type="text" name="titulo" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f]" placeholder="Ej: Nuevo proyecto destacado">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje *</label>
                <textarea name="mensaje" rows="4" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f]" placeholder="Escribe el contenido de la notificación..."></textarea>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">URL (opcional)</label>
                <input type="url" name="url" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f]" placeholder="https://ejemplo.com/algo">
                <p class="text-xs text-gray-500 mt-1">Link al que irá el usuario al hacer clic en la notificación</p>
            </div>
            
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.notifications') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-[#1e3a5f] text-white rounded-lg hover:bg-[#152c47]">
                    <i class="fas fa-paper-plane mr-2"></i> Enviar Notificación
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('input[name="destinatario"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const selectDiv = document.getElementById('selectUsuario');
            if (this.value === 'individual') {
                selectDiv.classList.remove('hidden');
            } else {
                selectDiv.classList.add('hidden');
            }
        });
    });
</script>
@endsection