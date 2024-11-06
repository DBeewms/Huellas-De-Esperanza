<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Tarjeta de Detalles de la Organización -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <!-- Mostrar la foto de perfil de la organización -->
                @if($organization->profile_photo)
                    <img src="{{ asset('profile_photos/' . $organization->profile_photo) }}" alt="{{ $organization->name }}" class="mx-auto mb-4 w-32 h-32 object-cover rounded-full">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" alt="Foto de Perfil" class="mx-auto mb-4 w-32 h-32 object-cover rounded-full">
                @endif

                <!-- Nombre de la Organización -->
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4 text-center">
                    {{ $organization->name }}
                </h2>

                <!-- Dirección -->
                @if($organization->address)
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-2">
                        <strong>Dirección:</strong> {{ $organization->address }}
                    </p>
                @endif

                <!-- Teléfono -->
                @if($organization->phone)
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-2">
                        <strong>Teléfono:</strong> {{ $organization->phone }}
                    </p>
                @endif

                <!-- Correo de Contacto -->
                @if($organization->contact_email)
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">
                        <strong>Correo de Contacto:</strong> {{ $organization->contact_email }}
                    </p>
                @endif

                <!-- Botón para Contactar -->
                <div class="mt-6 text-center">
                    <a href="mailto:{{ $organization->contact_email }}" class="px-6 py-3 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors">
                        Contactar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>