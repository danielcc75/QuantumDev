@php
    use App\Helpers\LocaleHelper;
    $currentLocale     = LocaleHelper::getCurrentLocale();
    $availableLocales  = LocaleHelper::getAvailableLocales();
    $localeLabels = [
        'es' => ['nativo' => 'Español',   'espanol' => 'Español'],
        'en' => ['nativo' => 'English',   'espanol' => 'Inglés'],
        'pt' => ['nativo' => 'Português', 'espanol' => 'Portugués'],
    ];
    $uid = 'locale-' . uniqid();
@endphp

<div class="relative inline-block" id="{{ $uid }}">
    <button type="button"
        class="locale-switcher-btn inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:text-[#1e3a5f] border border-transparent hover:border-gray-200 rounded-lg transition focus:outline-none">
        <i class="fas fa-globe text-base text-[#1e3a5f]"></i>
        <span class="font-semibold uppercase tracking-wide">{{ $currentLocale }}</span>
        <i class="fas fa-chevron-down text-[10px] text-gray-400"></i>
    </button>

    <div class="locale-switcher-menu hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-100 z-50 overflow-hidden">
        @foreach ($availableLocales as $loc)
            @php $info = $localeLabels[$loc] ?? ['nativo' => $loc, 'espanol' => $loc]; @endphp
            <a href="{{ route('locale.switch', $loc) }}"
                class="flex items-center justify-between gap-3 px-4 py-2.5 text-sm transition
                       {{ $currentLocale === $loc
                            ? 'bg-emerald-50 text-[#1e3a5f] font-semibold'
                            : 'text-gray-700 hover:bg-gray-50' }}">
                <span>
                    {{ $info['nativo'] }}
                    <span class="text-gray-400 font-normal">({{ $info['espanol'] }})</span>
                </span>
                @if ($currentLocale === $loc)
                    <i class="fas fa-check text-emerald-600"></i>
                @endif
            </a>
        @endforeach
    </div>
</div>

<script>
(function () {
    const root = document.getElementById('{{ $uid }}');
    if (!root) return;
    const btn  = root.querySelector('.locale-switcher-btn');
    const menu = root.querySelector('.locale-switcher-menu');

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        document.querySelectorAll('.locale-switcher-menu').forEach(m => {
            if (m !== menu) m.classList.add('hidden');
        });
        menu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!root.contains(e.target)) menu.classList.add('hidden');
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') menu.classList.add('hidden');
    });
})();
</script>
