{{-- resources/views/gestionarPerfil/modal-editar.blade.php --}}

<div id="modalPerfil" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-[#f0f4f8] rounded-2xl shadow-2xl w-full max-w-4xl max-h-[95vh] overflow-y-auto flex flex-col">

        {{-- Header --}}
        <div class="bg-[#1e3a5f] text-white px-4 sm:px-6 lg:px-8 py-4 sm:py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 rounded-t-2xl sticky top-0 z-10">
            <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                <button type="button" onclick="confirmarCancelarPerfil()" class="text-white hover:text-blue-200 transition flex-shrink-0">
                    <i class="fas fa-arrow-left text-lg"></i>
                </button>
                <div class="min-w-0">
                    <h3 class="text-lg sm:text-xl font-bold truncate">Editar Perfil</h3>
                    <p class="text-blue-200 text-xs mt-0.5 hidden sm:block">Actualiza tu información personal y profesional</p>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3 justify-end">
                <button type="button" onclick="confirmarCancelarPerfil()"
                    class="flex-1 sm:flex-none px-3 sm:px-4 py-2 text-xs sm:text-sm border border-white/30 text-white rounded-lg hover:bg-white/10 transition">
                    Cancelar
                </button>
                <button type="button" onclick="confirmarGuardarPerfil()"
                    class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-3 sm:px-4 py-2 text-xs sm:text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition whitespace-nowrap">
                    <i class="fas fa-save text-xs"></i> <span>Guardar</span><span class="hidden sm:inline"> Cambios</span>
                </button>
            </div>
        </div>

        {{-- Body --}}
        <form id="formPerfil" class="p-4 sm:p-6 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
            @csrf
            @method('PUT')

            {{-- Columna Izquierda --}}
            <div class="flex flex-col gap-5">

                {{-- Datos Personales --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm">
                    <h4 class="font-semibold text-gray-800 text-sm mb-0.5">Datos Personales</h4>
                    <p class="text-xs text-blue-500 mb-4">Información básica de contacto</p>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Nombre <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_nombre" name="nombre"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Apellido <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_apellido" name="apellido"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Correo Electrónico <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="edit_correo" name="correo_electronico"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" id="edit_telefono" name="telefono"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Ej: +34 123 456 789">
                    </div>
                </div>

                {{-- Información Profesional --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-0.5">
                        <i class="fas fa-briefcase text-blue-500 text-sm"></i>
                        <h4 class="font-semibold text-gray-800 text-sm">Información Profesional</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Tu perfil profesional y ubicación</p>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Título Profesional</label>
                        <input type="text" id="edit_titulo" name="titulo_profesional"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Ej: Ingeniero de Software">
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Ubicación</label>
                        <input type="text" id="edit_ubicacion" name="ubicacion"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Ciudad, País">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Foto de Perfil (URL)</label>
                        <input type="text" id="edit_foto" name="foto_perfil"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="https://ejemplo.com/mi-foto.jpg">
                        <p class="text-xs text-gray-400 mt-1">Pega la URL de tu foto de perfil</p>
                    </div>
                </div>

            </div>

            {{-- Columna Derecha --}}
            <div class="flex flex-col gap-5">

                {{-- Biografía --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-user-circle text-blue-500 text-sm"></i>
                        <h4 class="font-semibold text-gray-800 text-sm">Biografía</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Cuéntanos sobre ti, tu experiencia y objetivos</p>

                    <label class="block text-xs font-medium text-gray-700 mb-1">Sobre mí</label>
                    <textarea id="edit_biografia" name="biografia" rows="6"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                        placeholder="Desarrollador full-stack con 5 años de experiencia..."></textarea>
                </div>

                {{-- Redes Sociales --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-share-alt text-blue-500 text-sm"></i>
                        <h4 class="font-semibold text-gray-800 text-sm">Redes Sociales</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Conecta tu perfil con tus redes profesionales</p>

                    <div class="mb-3">
                        <label class="flex items-center gap-1 text-xs font-medium text-gray-700 mb-1">
                            <i class="fab fa-github text-gray-700"></i> GitHub
                        </label>
                        <input type="url" id="link_github" name="link_github"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="https://github.com/tuusuario">
                    </div>

                    <div class="mb-3">
                        <label class="flex items-center gap-1 text-xs font-medium text-gray-700 mb-1">
                            <i class="fab fa-linkedin text-blue-600"></i> LinkedIn
                        </label>
                        <input type="url" id="link_linkedin" name="link_linkedin"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="https://linkedin.com/in/tuusuario">
                    </div>

                    <div class="mb-3">
                        <label class="flex items-center gap-1 text-xs font-medium text-gray-700 mb-1">
                            <i class="fab fa-twitter text-blue-400"></i> Twitter / X
                        </label>
                        <input type="url" id="link_twitter" name="link_twitter"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="https://twitter.com/tuusuario">
                    </div>

                    <div>
                        <label class="flex items-center gap-1 text-xs font-medium text-gray-700 mb-1">
                            <i class="fas fa-globe text-green-500"></i> Portafolio Web
                        </label>
                        <input type="url" id="link_portfolio" name="link_portfolio"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="https://tusitioweb.com">
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>

{{-- Modal de Confirmación --}}
<div id="modalConfirmacionPerfil" class="fixed inset-0 bg-black bg-opacity-60 z-[60] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden animate-in">
        <div class="p-6 text-center">
            <div id="confirmIconWrapperPerfil" class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i id="confirmIconPerfil" class="text-2xl"></i>
            </div>
            <h4 id="confirmTituloPerfil" class="text-lg font-bold text-gray-800 mb-2"></h4>
            <p id="confirmMensajePerfil" class="text-sm text-gray-500 leading-relaxed"></p>
        </div>
        <div class="flex gap-3 px-6 pb-6">
            <button type="button" onclick="cerrarConfirmacionPerfil()"
                class="flex-1 px-4 py-2.5 text-sm border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition font-medium">
                No, cancelar
            </button>
            <button type="button" id="confirmBtnPerfil"
                class="flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition">
                Confirmar
            </button>
        </div>
    </div>
        {{-- Modal de Confirmación --}}
    <div id="modalConfirmacionPerfil" class="fixed inset-0 bg-black bg-opacity-60 z-[60] hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden animate-in">
            <div class="p-6 text-center">
                <div id="confirmIconWrapperPerfil" class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i id="confirmIconPerfil" class="text-2xl"></i>
                </div>
                <h4 id="confirmTituloPerfil" class="text-lg font-bold text-gray-800 mb-2"></h4>
                <p id="confirmMensajePerfil" class="text-sm text-gray-500 leading-relaxed"></p>
            </div>
            <div class="flex gap-3 px-6 pb-6">
                <button type="button" onclick="cerrarConfirmacionPerfil()"
                    class="flex-1 px-4 py-2.5 text-sm border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition font-medium">
                    No, cancelar
                </button>
                <button type="button" id="confirmBtnPerfil"
                    class="flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition">
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</div>