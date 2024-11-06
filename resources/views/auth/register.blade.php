<x-guest-layout>
    <div class="mb-8">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Correo Electrónico -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Correo Electrónico')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmar Contraseña -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Checkbox para Organización de Rescate Animal -->
            <div class="mt-4">
                <div class="flex items-center">
                    <input type="checkbox" id="is_rescue_organization" name="is_rescue_organization"
                        class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400" {{ old('is_rescue_organization') ? 'checked' : '' }}>
                    <label for="is_rescue_organization" class="ml-2 text-gray-700 dark:text-gray-300">
                        {{ __('¿Registrar como Organización de Rescate Animal?') }}
                    </label>
                </div>
            </div>

            <!-- Campos adicionales para Organización de Rescate Animal -->
            <div id="extra-fields" class="mt-4" style="display: none;">
                <!-- Dirección -->
                <div>
                    <x-input-label for="address" :value="__('Dirección')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                        :value="old('address')" autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Número de Teléfono -->
                <div class="mt-4">
                    <x-input-label for="phone" :value="__('Número de Teléfono')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                        :value="old('phone')" autocomplete="phone" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Correo de Contacto -->
                <div class="mt-4">
                    <x-input-label for="contact_email" :value="__('Correo de Contacto')" />
                    <x-text-input id="contact_email" class="block mt-1 w-full" type="email" name="contact_email"
                        :value="old('contact_email')" autocomplete="contact_email" />
                    <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
                </div>
            </div>

            <!-- Botones de Registro -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100"
                    href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>

        <!-- JavaScript para mostrar/ocultar los campos adicionales -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const isRescueCheckbox = document.getElementById('is_rescue_organization');
                const extraFields = document.getElementById('extra-fields');

                function toggleExtraFields() {
                    if (isRescueCheckbox.checked) {
                        extraFields.style.display = 'block';
                    } else {
                        extraFields.style.display = 'none';
                    }
                }

                // Inicializar el estado al cargar la página
                toggleExtraFields();

                // Agregar evento al cambiar el estado del checkbox
                isRescueCheckbox.addEventListener('change', toggleExtraFields);
            });
        </script>
    </div>
</x-guest-layout>