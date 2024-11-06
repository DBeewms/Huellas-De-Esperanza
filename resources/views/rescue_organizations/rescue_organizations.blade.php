<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
            {{ __('Organizaciones de Rescate Animal') }}
        </h2>
        @if($organizations->isEmpty())
            <p class="text-center text-gray-600 dark:text-gray-400">No hay organizaciones registradas en este momento.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($organizations as $org)
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-transform transform hover:scale-105">
                        <div class="p-4">
                            <!-- Mostrar la foto de perfil de la organización -->
                            @if($org->profile_photo)
                                <img src="{{ asset('profile_photos/' . $org->profile_photo) }}" alt="{{ $org->name }}" class="mx-auto mb-4 w-24 h-24 object-cover rounded-full">
                            @else
                                <img src="{{ asset('images/default-profile.png') }}" alt="Foto de Perfil" class="mx-auto mb-4 w-24 h-24 object-cover rounded-full">
                            @endif

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                                <a href="{{ route('rescue_organizations.show', $org->id) }}" class="hover:underline">
                                    {{ $org->name }}
                                </a>
                            </h3>
                            @if($org->address)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                                    <strong>Dirección:</strong> {{ $org->address }}
                                </p>
                            @endif
                            @if($org->phone)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                                    <strong>Teléfono:</strong> {{ $org->phone }}
                                </p>
                            @endif
                            @if($org->contact_email)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                    <strong>Correo de Contacto:</strong> {{ $org->contact_email }}
                                </p>
                            @endif
                            <div class="flex justify-center mt-4">
                                <a href="{{ route('rescue_organizations.show', $org->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                                    Ver Detalles
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <!-- Botón para redirigir a la vista de organizaciones -->
        <div class="flex justify-center mt-8">
            <a href="{{ route('rescue_organizations.index') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors">
                Ver Todas las Organizaciones
            </a>
        </div>
    </div>
</x-app-layout>