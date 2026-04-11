{{-- resources/views/gestionarProyectos/_stats.blade.php
     Tarjetas de resumen: total, en curso y finalizados. --}}

<div class="grid grid-cols-3 gap-5 mb-8">

    {{-- Total --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 border-l-4 border-l-[#1e3a5f]">
        <div class="flex justify-between items-start mb-3">
            <p class="text-sm text-gray-500 font-medium">Total Proyectos</p>
            <div class="w-9 h-9 rounded-xl bg-[#1e3a5f]/8 flex items-center justify-center">
                <i class="fas fa-folder text-[#1e3a5f] text-sm"></i>
            </div>
        </div>
        <p id="stat-total" class="text-4xl font-bold text-[#1e3a5f]">{{ $totalProyectos }}</p>
        <p class="text-xs text-gray-400 mt-1">Todos los registrados</p>
    </div>

    {{-- En Curso --}}
    <div class="bg-[#1e3a5f]/5 rounded-2xl border border-[#1e3a5f]/15 shadow-sm p-6 border-l-4 border-l-[#1e3a5f]">
        <div class="flex justify-between items-start mb-3">
            <p class="text-sm text-[#1e3a5f] font-semibold">En Curso</p>
            <div class="w-9 h-9 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center">
                <i class="fas fa-spinner text-[#1e3a5f] text-sm"></i>
            </div>
        </div>
        <p id="stat-en-curso" class="text-4xl font-bold text-[#1e3a5f]">{{ $enCurso }}</p>
        <p class="text-xs text-[#1e3a5f]/60 mt-1">Actualmente trabajando</p>
    </div>

    {{-- Finalizados --}}
    <div class="bg-red-50 rounded-2xl border border-red-100 shadow-sm p-6 border-l-4 border-l-[#e11d48]">
        <div class="flex justify-between items-start mb-3">
            <p class="text-sm text-[#e11d48] font-semibold">Finalizados</p>
            <div class="w-9 h-9 rounded-xl bg-[#e11d48]/10 flex items-center justify-center">
                <i class="fas fa-check-circle text-[#e11d48] text-sm"></i>
            </div>
        </div>
        <p id="stat-finalizados" class="text-4xl font-bold text-[#1e3a5f]">{{ $finalizados }}</p>
        <p class="text-xs text-[#e11d48]/70 mt-1">Proyectos completados</p>
    </div>

</div>
