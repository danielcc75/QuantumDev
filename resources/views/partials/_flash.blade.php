{{--
    Banner flash reutilizable: muestra errores de validación y mensajes
    de éxito/error como toasts arriba a la derecha. Auto-desaparecen.
    Incluir después del header en cualquier vista que reciba redirecciones
    con ->with('success'|'error') o errores de validación.
--}}
@if ($errors->any() || session('success') || session('error'))
    <div id="flash-container" class="fixed top-20 right-4 z-[100] flex flex-col gap-2 w-80 max-w-[calc(100vw-2rem)]">

        @if (session('success'))
            <div class="flash-item bg-white border-l-4 border-green-500 shadow-lg rounded-lg px-4 py-3 flex items-start gap-3">
                <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                <p class="text-sm text-gray-700 flex-1">{{ session('success') }}</p>
                <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xs"></i></button>
            </div>
        @endif

        @if (session('error'))
            <div class="flash-item bg-white border-l-4 border-red-500 shadow-lg rounded-lg px-4 py-3 flex items-start gap-3">
                <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
                <p class="text-sm text-gray-700 flex-1">{{ session('error') }}</p>
                <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xs"></i></button>
            </div>
        @endif

        @foreach ($errors->all() as $error)
            <div class="flash-item bg-white border-l-4 border-red-500 shadow-lg rounded-lg px-4 py-3 flex items-start gap-3">
                <i class="fas fa-exclamation-triangle text-red-500 mt-0.5"></i>
                <p class="text-sm text-gray-700 flex-1">{{ $error }}</p>
                <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xs"></i></button>
            </div>
        @endforeach

    </div>

    <script>
        setTimeout(function () {
            document.querySelectorAll('#flash-container .flash-item').forEach(function (el) {
                el.style.transition = 'opacity .4s ease';
                el.style.opacity = '0';
                setTimeout(function () { el.remove(); }, 400);
            });
        }, 5000);
    </script>
@endif
