@php
    use App\Helpers\LocaleHelper;
    $currentLocale = LocaleHelper::getCurrentLocale();
    $availableLocales = LocaleHelper::getAvailableLocales();
    $localeNames = LocaleHelper::getLocaleNames();
@endphp

<div class="locale-switcher">
    <div class="flex items-center gap-2">
        <select id="locale-select" class="rounded border border-gray-300 dark:border-gray-600 px-3 py-1 text-sm dark:bg-gray-800 dark:text-white">
            @foreach ($availableLocales as $locale)
                <option value="{{ route('locale.switch', $locale) }}" 
                    {{ $currentLocale === $locale ? 'selected' : '' }}>
                    {{ LocaleHelper::getLocaleFlagEmoji($locale) }} {{ $localeNames[$locale] }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<script>
    document.getElementById('locale-select').addEventListener('change', function() {
        window.location.href = this.value;
    });
</script>
