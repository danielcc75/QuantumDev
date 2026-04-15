{{-- resources/views/gestionarProyectos/_stats.blade.php
     Tarjetas de resumen: total, en curso y finalizados. --}}

@php
$statCards = [
    [
        'id'       => 'stat-total',
        'label'    => 'Total Proyectos',
        'value'    => $totalProyectos,
        'subtitle' => 'Todos los registrados',
        'icon'     => 'fas fa-folder',
        'card'     => 'bg-white border-gray-100',
        'borderL'  => 'border-l-[#1e3a5f]',
        'iconBg'   => 'bg-[#1e3a5f]/8',
        'iconCls'  => 'text-[#1e3a5f]',
        'labelCls' => 'text-gray-500 font-medium',
        'subCls'   => 'text-gray-400',
    ],
    [
        'id'       => 'stat-en-curso',
        'label'    => 'En Curso',
        'value'    => $enCurso,
        'subtitle' => 'Actualmente trabajando',
        'icon'     => 'fas fa-spinner',
        'card'     => 'bg-[#1e3a5f]/5 border-[#1e3a5f]/15',
        'borderL'  => 'border-l-[#1e3a5f]',
        'iconBg'   => 'bg-[#1e3a5f]/10',
        'iconCls'  => 'text-[#1e3a5f]',
        'labelCls' => 'text-[#1e3a5f] font-semibold',
        'subCls'   => 'text-[#1e3a5f]/60',
    ],
    [
        'id'       => 'stat-finalizados',
        'label'    => 'Finalizados',
        'value'    => $finalizados,
        'subtitle' => 'Proyectos completados',
        'icon'     => 'fas fa-check-circle',
        'card'     => 'bg-red-50 border-red-100',
        'borderL'  => 'border-l-[#e11d48]',
        'iconBg'   => 'bg-[#e11d48]/10',
        'iconCls'  => 'text-[#e11d48]',
        'labelCls' => 'text-[#e11d48] font-semibold',
        'subCls'   => 'text-[#e11d48]/70',
    ],
];
@endphp

<div class="grid grid-cols-3 gap-5 mb-8">
    @foreach($statCards as $s)
    <div class="rounded-2xl border shadow-sm p-6 border-l-4 {{ $s['card'] }} {{ $s['borderL'] }}">
        <div class="flex justify-between items-start mb-3">
            <p class="text-sm {{ $s['labelCls'] }}">{{ $s['label'] }}</p>
            <div class="w-9 h-9 rounded-xl flex items-center justify-center {{ $s['iconBg'] }}">
                <i class="{{ $s['icon'] }} text-sm {{ $s['iconCls'] }}"></i>
            </div>
        </div>
        <p id="{{ $s['id'] }}" class="text-4xl font-bold text-[#1e3a5f]">{{ $s['value'] }}</p>
        <p class="text-xs mt-1 {{ $s['subCls'] }}">{{ $s['subtitle'] }}</p>
    </div>
    @endforeach
</div>
