<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('general.reset_password.title') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center px-4 min-h-screen pt-20">
    <nav class="absolute top-0 left-0 w-full bg-white shadow-sm border-b border-gray-200 px-6 py-3 flex justify-between items-center">

        <div class="flex items-center gap-2">
            <i class="fas fa-lock text-[#1e3a5f]"></i>
            <span class="font-semibold text-[#1e3a5f]">
                {{ __('general.reset_password.title') }}
            </span>
        </div>

        @include('components.locale-switcher')

    </nav>
    <div class="w-full max-w-md bg-[#f3f4f6] rounded-xl shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-[#1e3a5f] text-center px-6 py-6">
            <div class="flex justify-center items-center gap-2 mb-1">
                <i class="fas fa-lock text-white text-xl"></i>

                <h2 class="text-white text-2xl font-bold">
                    {{ __('general.reset_password.title') }}
                </h2>
            </div>

            <p class="text-gray-200 text-sm">
                {{ __('general.reset_password.subtitle') }}
            </p>
        </div>

        <!-- BODY -->
        <div class="p-6">

            <div id="resetErrorBox"
                class="hidden mb-4 text-sm bg-red-100 border border-red-300 text-red-700 p-3 rounded-md">
            </div>

            <form id="resetPasswordForm"
                method="POST"
                action="/reset-password"
                class="space-y-4">

                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                @php
                    $inputClass = "w-full mt-1 px-3 py-2 rounded-md border border-gray-300 bg-white outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20";
                @endphp

                <!-- PASSWORD -->
                <div>

                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-lock text-[#1e3a5f] text-xs"></i>
                        {{ __('general.reset_password.new_password') }}
                    </label>

                    <div class="relative">

                        <input
                            id="resetPassword"
                            type="password"
                            name="contrasenia"
                            class="{{ $inputClass }} pr-10"
                            placeholder="••••••••">

                        <button
                            type="button"
                            onclick="togglePassword('resetPassword','iconPass1')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1e3a5f]">

                            <i id="iconPass1" class="fas fa-eye"></i>

                        </button>

                    </div>

                    <p id="errorPassword"
                    class="hidden mt-1 text-sm text-red-600">
                    </p>

                </div>

                <!-- CONFIRM PASSWORD -->
                <div>

                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-lock text-[#1e3a5f] text-xs"></i>
                        {{ __('general.reset_password.confirm_password') }}
                    </label>

                    <div class="relative">

                        <input
                            id="resetPasswordConfirm"
                            type="password"
                            name="contrasenia_confirmation"
                            class="{{ $inputClass }} pr-10"
                            placeholder="••••••••">

                        <button
                            type="button"
                            onclick="togglePassword('resetPasswordConfirm','iconPass2')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1e3a5f]">

                            <i id="iconPass2" class="fas fa-eye"></i>

                        </button>

                    </div>

                    <p id="errorConfirm"
                    class="hidden mt-1 text-sm text-red-600">
                    </p>

                </div>

                <button
                    type="submit"
                    class="w-full bg-[#1e3a5f] text-white py-3 rounded-md font-semibold hover:bg-[#16304d] transition">

                    {{ __('general.reset_password.update_button') }}

                </button>

            </form>

        </div>

    </div>

    <!-- MODAL ÉXITO -->
    <div id="successModal"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 text-center animate-fade">

            <div class="flex justify-center mb-4">
                <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-circle-check text-5xl text-green-600"></i>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('general.reset_password.success_title') }}
            </h2>

            <p class="mt-3 text-gray-600">
                {{ __('general.reset_password.success') }}
            </p>

            <p class="mt-5 text-sm text-gray-400">
                {{ __('general.reset_password.redirecting') }}
            </p>

        </div>

    </div>

    <script>

        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {

                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");

            } else {

                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");

            }

        }

        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('resetPasswordForm');

            form.addEventListener('submit', async function (e) {

                e.preventDefault();

                const errorBox = document.getElementById('resetErrorBox');

                errorBox.classList.add('hidden');

                document.getElementById('errorPassword').classList.add('hidden');
                document.getElementById('errorConfirm').classList.add('hidden');

                const res = await fetch(form.action, {

                    method: 'POST',

                    headers: {

                        'Accept': 'application/json',

                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value

                    },

                    body: new URLSearchParams(new FormData(form))

                });

                const data = await res.json();

                if (data.ok) {

                    const modal = document.getElementById('successModal');

                    // mostrar modal
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    // esperar un poco y redirigir
                    setTimeout(() => {
                        window.location.replace(data.redirect);
                    }, 2500);

                } else {

                    if (data.errors) {

                        if (data.errors.contrasenia) {

                            const el = document.getElementById('errorPassword');

                            el.innerText = data.errors.contrasenia[0];

                            el.classList.remove('hidden');

                        }

                        if (data.errors.contrasenia_confirmation) {

                            const el = document.getElementById('errorConfirm');

                            el.innerText = data.errors.contrasenia_confirmation[0];

                            el.classList.remove('hidden');

                        }

                    }

                    errorBox.innerText = data.message || "{{ __('general.reset_password.error') }}";

                    errorBox.classList.remove('hidden');

                }

            });

        });

    </script>

</body>
</html>