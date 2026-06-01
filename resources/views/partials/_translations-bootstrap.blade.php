{{--
    Bootstrap de traducciones para JavaScript.

    Estrategia:
      1. Lee localStorage sincrónicamente. Si hay caché, `window.__lang` ya queda usable.
      2. Hace fetch al endpoint /api/translations/{locale} en background.
      3. Si la versión del server difiere de la cacheada, actualiza __lang y storage,
         y emite un CustomEvent 'translations:updated' para que la UI pueda re-renderizar.

    Uso desde JS:
        __t('home.explorar.btn_buscar')
        __t('general.home.footer.copyright', { year: 2026 })  // sustituye :year
--}}
<script>
(function () {
    var locale       = '{{ app()->getLocale() }}';
    var STORAGE_KEY  = 'qd_lang_' + locale;
    var API_URL      = '{{ url("/api/translations") }}/' + locale;

    // 0) Hidratación SERVER-SIDE inline → __t() funciona sincrónicamente desde
    // el primer paint, incluso en la primera visita (cuando localStorage está vacío).
    window.__lang      = @json(__('general'));
    window.__langReady = true;

    // 1) También cacheamos en localStorage para que el endpoint pueda revalidar
    // y para casos futuros (preload de otro locale, SPA, etc.)
    try {
        var serverVersion = '{{ @filemtime(lang_path(app()->getLocale() . "/general.php")) ?: 0 }}';
        var raw = localStorage.getItem(STORAGE_KEY);
        var cached = raw ? JSON.parse(raw) : null;
        if (!cached || cached.version !== serverVersion) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify({
                locale:  locale,
                version: serverVersion,
                data:    window.__lang,
            }));
        }
    } catch (e) { /* localStorage roto / quota — seguimos */ }

    // 2) Revalidar en background
    fetch(API_URL, { credentials: 'same-origin' })
        .then(function (r) { return r.ok ? r.json() : Promise.reject(); })
        .then(function (payload) {
            if (!payload || !payload.data) return;

            var prev;
            try { prev = JSON.parse(localStorage.getItem(STORAGE_KEY) || 'null'); } catch (e) { prev = null; }

            var changed = !prev || prev.version !== payload.version;

            try { localStorage.setItem(STORAGE_KEY, JSON.stringify(payload)); } catch (e) {}

            window.__lang      = payload.data;
            window.__langReady = true;

            if (changed) {
                document.dispatchEvent(new CustomEvent('translations:updated', { detail: payload }));
            } else if (!prev) {
                document.dispatchEvent(new CustomEvent('translations:loaded',  { detail: payload }));
            }
        })
        .catch(function () { /* offline / 5xx — usamos lo que haya en __lang */ });

    // 3) Helper de lookup con notación punteada y reemplazo de :placeholders
    window.__t = function (key, params) {
        if (!key) return '';
        var parts = String(key).split('.');
        var val   = window.__lang;
        for (var i = 0; i < parts.length; i++) {
            if (val && typeof val === 'object' && parts[i] in val) {
                val = val[parts[i]];
            } else {
                return key; // clave no encontrada → devolvemos la clave (debugging)
            }
        }
        if (typeof val !== 'string') return key;
        if (params && typeof params === 'object') {
            Object.keys(params).forEach(function (k) {
                val = val.replace(new RegExp(':' + k, 'g'), params[k]);
            });
        }
        return val;
    };
})();
</script>
