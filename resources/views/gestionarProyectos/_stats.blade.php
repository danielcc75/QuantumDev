{{-- resources/views/gestionarProyectos/_stats.blade.php
     Tarjetas de resumen: total, en curso y finalizados. --}}

<div class="grid grid-cols-3 gap-5 mb-8">

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex justify-between items-start mb-3">
            <p class="text-sm text-gray-500">Total Proyectos</p>
            <i class="fas fa-folder text-gray-300 text-xl"></i>
        </div>
        <p id="stat-total" class="text-4xl font-bold text-gray-800">{{ $totalProyectos }}</p>
        <p class="text-xs text-gray-400 mt-1">Todos los registrados</p>
    </div>

    <div class="bg-blue-50 rounded-2xl border border-blue-100 shadow-sm p-6">
        <div class="flex justify-between items-start mb-3">
            <p class="text-sm text-blue-600 font-medium">En Curso</p>
            <div class="w-4 h-4 rounded-full bg-blue-500"></div>
        </div>
        <p id="stat-en-curso" class="text-4xl font-bold text-gray-800">{{ $enCurso }}</p>
        <p class="text-xs text-blue-500 mt-1">Actualmente trabajando</p>
    </div>

    <div class="bg-purple-50 rounded-2xl border border-purple-100 shadow-sm p-6">
        <div class="flex justify-between items-start mb-3">
            <p class="text-sm text-purple-600 font-medium">Finalizados</p>
            <i class="fas fa-check-circle text-purple-400 text-xl"></i>
        </div>
        <p id="stat-finalizados" class="text-4xl font-bold text-gray-800">{{ $finalizados }}</p>
        <p class="text-xs text-purple-500 mt-1">Proyectos completados</p>
    </div>

</div>
