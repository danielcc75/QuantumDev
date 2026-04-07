{{-- resources/views/gestionarPerfil/perfil.blade.php --}}

<!-- Contenido central - Perfil tipo CV -->
<div class="ml-80 mr-80">
    <main class="p-8">
        @php
            // Obtener datos del usuario y su perfil
            $usuario = DB::table('usuario')->where('id_usuario', $userId)->first();
            $perfil = DB::table('perfil')->where('id_usuario', $userId)->first();

            // Obtener links desde la tabla perfil_links
            $links = [];
            if ($perfil) {
                $linksRows = DB::table('perfil_links')->where('id_perfil', $perfil->id_perfil)->get();
                foreach ($linksRows as $link) {
                    $links[$link->tipo] = $link->url;
                }
            }

            // Nombre completo
            $nombreCompleto = trim(($usuario->nombre ?? '') . ' ' . ($usuario->apellido ?? ''));
            if (empty($nombreCompleto)) {
                $nombreCompleto = 'Usuario';
            }

            // URL de la foto
            $fotoUrl = $perfil->foto_perfil ?? null;
        @endphp

        <!-- Perfil - Diseño tipo CV -->
        <div class="max-w-4xl mx-auto">
           
            <!-- Cabecera del perfil -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
        <!-- Foto -->
        <div class="flex-shrink-0">
            @if($fotoUrl)
                <img src="{{ $fotoUrl }}" alt="Foto de perfil" class="w-32 h-32 rounded-full object-cover border-4 border-blue-100">
            @else
                <div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center border-4 border-blue-100">
                    <span class="text-white text-4xl font-bold">{{ substr($usuario->nombre ?? 'U', 0, 1) }}{{ substr($usuario->apellido ?? 'S', 0, 1) }}</span>
                </div>
            @endif
        </div>
        
        <!-- Información principal (ocupa todo el espacio disponible) -->
        <div class="flex-1 text-center md:text-left">
            <h1 class="text-3xl font-bold text-gray-800">{{ $nombreCompleto }}</h1>
            <p class="text-gray-500 mt-1">___ <!-- Título profesional pendiente --></p>
            
            <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-3 text-sm text-gray-600">
                <span class="flex items-center">
                    <i class="fas fa-map-marker-alt w-4 h-4 mr-1 text-gray-400"></i>
                    ___ <!-- Ubicación pendiente -->
                </span>
                <span class="flex items-center">
                    <i class="fas fa-envelope w-4 h-4 mr-1 text-gray-400"></i>
                    {{ $usuario->correo_electronico ?? '___' }}
                </span>
            </div>
            
            <!-- Links / Redes sociales -->
            <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
                @if($links['github'] ?? false)
                    <a href="{{ $links['github'] }}" target="_blank" class="text-gray-600 hover:text-gray-900 transition-colors">
                        <i class="fab fa-github text-xl"></i>
                    </a>
                @else
                    <span class="text-gray-300"><i class="fab fa-github text-xl"></i></span>
                @endif
                
                @if($links['linkedin'] ?? false)
                    <a href="{{ $links['linkedin'] }}" target="_blank" class="text-gray-600 hover:text-blue-700 transition-colors">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                @else
                    <span class="text-gray-300"><i class="fab fa-linkedin text-xl"></i></span>
                @endif
                
                @if($links['twitter'] ?? false)
                    <a href="{{ $links['twitter'] }}" target="_blank" class="text-gray-600 hover:text-blue-400 transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                @else
                    <span class="text-gray-300"><i class="fab fa-twitter text-xl"></i></span>
                @endif
                
                @if($links['portfolio'] ?? false)
                    <a href="{{ $links['portfolio'] }}" target="_blank" class="text-gray-600 hover:text-green-600 transition-colors">
                        <i class="fas fa-globe text-xl"></i>
                    </a>
                @else
                    <span class="text-gray-300"><i class="fas fa-globe text-xl"></i></span>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Botón Editar Perfil - Parte inferior derecha de la tarjeta -->
    <div class="flex justify-end mt-6 pt-4 border-t border-gray-100">
        <button onclick="abrirModalEditar()" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg shadow hover:shadow-lg transition-all flex items-center space-x-2">
            <i class="fas fa-edit"></i>
            <span>Editar Perfil</span>
        </button>
    </div>
</div>

            <!-- Sobre mí / Biografía -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                    Sobre mí
                </h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ $perfil->biografia ?? '___' }}
                </p>
            </div>

            <!-- Experiencia Laboral (Pendiente) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-blue-500 mr-2"></i>
                    Experiencia Laboral
                </h2>
                
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-plus-circle text-3xl mb-2"></i>
                    <p>No hay experiencia laboral registrada</p>
                    <p class="text-sm">Usa el botón "Editar Perfil" para agregar</p>
                </div>
            </div>

            <!-- Habilidades Técnicas (Pendiente) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-code text-blue-500 mr-2"></i>
                    Habilidades Técnicas
                </h2>
                
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-plus-circle text-3xl mb-2"></i>
                    <p>No hay habilidades registradas</p>
                    <p class="text-sm">Usa el botón "Editar Perfil" para agregar</p>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Modal de Edición -->
<div id="modalEditar" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-100 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-edit text-blue-500 mr-2"></i>
                Editar Perfil
            </h3>
            <button onclick="cerrarModalEditar()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="formEditarPerfil" class="p-6">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        
        <!-- Foto URL -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">URL de la foto</label>
            <input type="url" name="foto" id="edit_foto" value="{{ $perfil->foto_perfil ?? '' }}"
                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>
        <!-- Nombre Completo -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
            <div class="flex gap-3">
                <input type="text" name="nombre" id="edit_nombre" value="{{ $usuario->nombre ?? '' }}" 
                    class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="Nombre">
                <input type="text" name="apellido" id="edit_apellido" value="{{ $usuario->apellido ?? '' }}" 
                    class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="Apellido">
            </div>
        </div>
        <!-- Email -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
            <input type="email" name="email" id="edit_email" value="{{ $usuario->correo_electronico ?? '' }}"
                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="usuario@ejemplo.com">
        </div>
        <!-- Biografía -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Biografía / Sobre mí</label>
            <textarea name="biografia" id="edit_biografia" rows="4" 
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">{{ $perfil->biografia ?? '' }}</textarea>
        </div>
        
        <!-- Redes Sociales -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Redes sociales</label>
            
            <div class="space-y-3">
                <div class="flex items-center">
                    <i class="fab fa-github w-8 text-gray-600"></i>
                    <input type="url" id="edit_github" value="{{ $links['github'] ?? '' }}" 
                        class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="https://github.com/tuusuario">
                </div>
                <div class="flex items-center">
                    <i class="fab fa-linkedin w-8 text-blue-700"></i>
                    <input type="url" id="edit_linkedin" value="{{ $links['linkedin'] ?? '' }}" 
                        class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="https://linkedin.com/in/tuusuario">
                </div>
                <div class="flex items-center">
                    <i class="fab fa-twitter w-8 text-blue-400"></i>
                    <input type="url" id="edit_twitter" value="{{ $links['twitter'] ?? '' }}" 
                        class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="https://twitter.com/tuusuario">
                </div>
                <div class="flex items-center">
                    <i class="fas fa-globe w-8 text-green-600"></i>
                    <input type="url" id="edit_portfolio" value="{{ $links['portfolio'] ?? '' }}" 
                        class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="https://tusitio.com">
                </div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
            <button type="button" onclick="cerrarModalEditar()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancelar
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Guardar cambios
            </button>
        </div>
    </form>
    <!-- Mensaje flotante -->
    <div id="mensajeExito" class="fixed top-20 right-8 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hidden z-50 transition-all">
        <i class="fas fa-check-circle mr-2"></i>
        <span id="mensajeTexto">Perfil actualizado correctamente</span>
    </div>
    </div>
</div>

<script>
    // Función para cerrar modal
function cerrarModalEditar() {
    document.getElementById('modalEditar').classList.add('hidden');
    document.getElementById('modalEditar').classList.remove('flex');
    document.body.style.overflow = '';
}

// Función para abrir modal
function abrirModalEditar() {
    document.getElementById('modalEditar').classList.remove('hidden');
    document.getElementById('modalEditar').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

// Función para mostrar mensaje flotante
function mostrarMensaje(mensaje, tipo = 'success') {
    const mensajeDiv = document.getElementById('mensajeExito');
    const mensajeTexto = document.getElementById('mensajeTexto');
    mensajeTexto.textContent = mensaje;
    
    if (tipo === 'success') {
        mensajeDiv.classList.remove('bg-red-500', 'bg-yellow-500');
        mensajeDiv.classList.add('bg-green-500');
    } else if (tipo === 'error') {
        mensajeDiv.classList.remove('bg-green-500', 'bg-yellow-500');
        mensajeDiv.classList.add('bg-red-500');
    } else {
        mensajeDiv.classList.remove('bg-green-500', 'bg-red-500');
        mensajeDiv.classList.add('bg-yellow-500');
    }
    
    mensajeDiv.classList.remove('hidden');
    setTimeout(() => {
        mensajeDiv.classList.add('hidden');
    }, 3000);
}

// Función para actualizar la vista del perfil sin recargar
function actualizarVistaPerfil(datos) {
    const nombreElement = document.querySelector('h1.text-3xl.font-bold.text-gray-800');
    if (nombreElement && datos.nombre && datos.apellido) {
        nombreElement.textContent = datos.nombre + ' ' + datos.apellido;
    }
    const emailElement = document.querySelector('.flex.items-center .fa-envelope')?.parentElement?.querySelector('span:not(.fa-envelope)');
    if (emailElement && datos.correo_electronico) {
        emailElement.textContent = datos.correo_electronico;
    }
    // Actualizar biografía en la vista principal
    const bioElement = document.querySelector('.bg-white.rounded-2xl.shadow-sm p.text-gray-600');
    if (bioElement && datos.biografia) {
        bioElement.textContent = datos.biografia;
    }
    
    // Actualizar foto
    const fotoContainer = document.querySelector('.flex-shrink-0 div:first-child');
    if (datos.foto) {
        // Cambiar la imagen si existe
        const imgElement = document.querySelector('.flex-shrink-0 img');
        if (imgElement) {
            imgElement.src = datos.foto;
        } else {
            // Si no había imagen, crear una
            const fotoDiv = document.querySelector('.flex-shrink-0');
            if (fotoDiv) {
                fotoDiv.innerHTML = `<img src="${datos.foto}" alt="Foto de perfil" class="w-32 h-32 rounded-full object-cover border-4 border-blue-100">`;
            }
        }
    }
    
    // Actualizar links en la vista principal
    if (datos.links) {
        const linksData = typeof datos.links === 'string' ? JSON.parse(datos.links) : datos.links;
        
        // Actualizar GitHub
        const githubLink = document.querySelector('a[href*="github.com"]');
        if (linksData.github) {
            if (githubLink) {
                githubLink.href = linksData.github;
                githubLink.classList.remove('text-gray-300');
                githubLink.classList.add('text-gray-600');
            }
        }
        
        // Actualizar LinkedIn
        const linkedinLink = document.querySelector('a[href*="linkedin.com"]');
        if (linksData.linkedin) {
            if (linkedinLink) {
                linkedinLink.href = linksData.linkedin;
                linkedinLink.classList.remove('text-gray-300');
                linkedinLink.classList.add('text-gray-600');
            }
        }
        
        // Actualizar Twitter
        const twitterLink = document.querySelector('a[href*="twitter.com"]');
        if (linksData.twitter) {
            if (twitterLink) {
                twitterLink.href = linksData.twitter;
                twitterLink.classList.remove('text-gray-300');
                twitterLink.classList.add('text-gray-600');
            }
        }
        
        // Actualizar Portfolio
        const portfolioLink = document.querySelector('a[href*="http"]:not([href*="github"]):not([href*="linkedin"]):not([href*="twitter"])');
        if (linksData.portfolio) {
            if (portfolioLink && portfolioLink.querySelector('.fa-globe')) {
                portfolioLink.href = linksData.portfolio;
                portfolioLink.classList.remove('text-gray-300');
                portfolioLink.classList.add('text-gray-600');
            }
        }
    }
}

// Envío del formulario con AJAX
document.getElementById('formEditarPerfil').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Construir objeto de links
    const links = {};
    const github = document.getElementById('edit_github').value;
    const linkedin = document.getElementById('edit_linkedin').value;
    const twitter = document.getElementById('edit_twitter').value;
    const portfolio = document.getElementById('edit_portfolio').value;
    
    if (github) links.github = github;
    if (linkedin) links.linkedin = linkedin;
    if (twitter) links.twitter = twitter;
    if (portfolio) links.portfolio = portfolio;
    
    // Preparar datos
    const formData = new FormData();
    formData.append('_token', document.querySelector('input[name="_token"]').value);
    formData.append('_method', 'PUT');
    formData.append('foto_perfil', document.getElementById('edit_foto').value);
    formData.append('nombre', document.getElementById('edit_nombre').value);
    formData.append('apellido', document.getElementById('edit_apellido').value);
    formData.append('correo_electronico', document.getElementById('edit_email').value);
    formData.append('biografia', document.getElementById('edit_biografia').value);
    formData.append('links', JSON.stringify(links));
    
    // Enviar petición
    fetch('/usuarios/{{ $userId }}/perfil', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success || response.ok) {
            // Cerrar modal
            cerrarModalEditar();
            
            // Actualizar la vista
            actualizarVistaPerfil({
                foto: document.getElementById('edit_foto').value,
                biografia: document.getElementById('edit_biografia').value,
                links: links
            });
            
            // Mostrar mensaje de éxito
            mostrarMensaje('Perfil actualizado correctamente', 'success');
        } else {
            mostrarMensaje('Error al actualizar el perfil', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarMensaje('Error al actualizar el perfil', 'error');
    });
});

// Cerrar modal al hacer clic fuera
document.getElementById('modalEditar').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModalEditar();
    }
});
</script>