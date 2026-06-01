<section id="como-funciona" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <!-- encabezado -->
        <div class="max-w-3xl mx-auto text-center mb-14">
            <span class="inline-block text-sm font-semibold tracking-wide uppercase text-[#e11d48] bg-red-50 px-4 py-1 rounded-full mb-4">
                {{ __('general.home.como_funciona.eyebrow') }}
            </span>

            <h2 class="text-3xl md:text-4xl font-bold text-[#1e3a5f] leading-tight">
                {{ __('general.home.como_funciona.titulo') }}
            </h2>

            <p class="mt-5 text-gray-600 text-base md:text-lg leading-relaxed">
                {{ __('general.home.como_funciona.subtitulo') }}
            </p>
        </div>

        <!-- pasos -->
        <div class="grid md:grid-cols-3 gap-6">

            <div class="relative bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all-soft hover:-translate-y-1">
                <div class="absolute -top-4 left-6 w-10 h-10 rounded-full bg-[#1e3a5f] text-white flex items-center justify-center font-bold shadow-md">
                    1
                </div>

                <div class="pt-4">
                    <div class="w-12 h-12 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center mb-4">
                        <i class="fas fa-user-plus text-[#1e3a5f] text-xl"></i>
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800 mb-3">
                        {{ __('general.home.como_funciona.paso1_titulo') }}
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        {{ __('general.home.como_funciona.paso1_desc') }}
                    </p>
                </div>
            </div>

            <div class="relative bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all-soft hover:-translate-y-1">
                <div class="absolute -top-4 left-6 w-10 h-10 rounded-full bg-[#e11d48] text-white flex items-center justify-center font-bold shadow-md">
                    2
                </div>

                <div class="pt-4">
                    <div class="w-12 h-12 rounded-xl bg-[#e11d48]/10 flex items-center justify-center mb-4">
                        <i class="fas fa-diagram-project text-[#e11d48] text-xl"></i>
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800 mb-3">
                        {{ __('general.home.como_funciona.paso2_titulo') }}
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        {{ __('general.home.como_funciona.paso2_desc') }}
                    </p>
                </div>
            </div>

            <div class="relative bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all-soft hover:-translate-y-1">
                <div class="absolute -top-4 left-6 w-10 h-10 rounded-full bg-[#f59e0b] text-white flex items-center justify-center font-bold shadow-md">
                    3
                </div>

                <div class="pt-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center mb-4">
                        <i class="fas fa-paper-plane text-[#f59e0b] text-xl"></i>
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800 mb-3">
                        {{ __('general.home.como_funciona.paso3_titulo') }}
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        {{ __('general.home.como_funciona.paso3_desc') }}
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
