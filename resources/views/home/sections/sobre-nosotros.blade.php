<section id="sobre-nosotros" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <!-- encabezado -->
        <div class="max-w-3xl mx-auto text-center mb-14">
            <span class="inline-block text-sm font-semibold tracking-wide uppercase text-[#e11d48] bg-red-50 px-4 py-1 rounded-full mb-4">
                {{ __('general.home.sobre_nosotros.eyebrow') }}
            </span>

            <h2 class="text-3xl md:text-4xl font-bold text-[#1e3a5f] leading-tight">
                {{ __('general.home.sobre_nosotros.titulo') }}
            </h2>

            <p class="mt-5 text-gray-600 text-base md:text-lg leading-relaxed">
                {{ __('general.home.sobre_nosotros.subtitulo') }}
            </p>
        </div>

        <!-- tarjetas -->
        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all-soft hover:-translate-y-1">
                <div class="w-12 h-12 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center mb-4">
                    <i class="fas fa-id-badge text-[#1e3a5f] text-xl"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">
                    {{ __('general.home.sobre_nosotros.card1_titulo') }}
                </h3>

                <p class="text-gray-600 leading-relaxed">
                    {{ __('general.home.sobre_nosotros.card1_desc') }}
                </p>
            </div>

            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all-soft hover:-translate-y-1">
                <div class="w-12 h-12 rounded-xl bg-[#e11d48]/10 flex items-center justify-center mb-4">
                    <i class="fas fa-folder-open text-[#e11d48] text-xl"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">
                    {{ __('general.home.sobre_nosotros.card2_titulo') }}
                </h3>

                <p class="text-gray-600 leading-relaxed">
                    {{ __('general.home.sobre_nosotros.card2_desc') }}
                </p>
            </div>

            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all-soft hover:-translate-y-1">
                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center mb-4">
                    <i class="fas fa-share-nodes text-[#f59e0b] text-xl"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">
                    {{ __('general.home.sobre_nosotros.card3_titulo') }}
                </h3>

                <p class="text-gray-600 leading-relaxed">
                    {{ __('general.home.sobre_nosotros.card3_desc') }}
                </p>
            </div>

        </div>
    </div>
</section>
