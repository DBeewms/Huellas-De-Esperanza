<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Sección: Acciones Rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Nuevo Tipo de Mascota (Especie) - Solo para Admins -->
                @if(Auth::user()->role->name == 'admin')
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center transform hover:scale-105 transition-transform">
                    <img src="{{ asset('icons/pet-type.png') }}" alt="Nuevo Tipo de Mascota" class="mx-auto mb-4 w-24 h-24 object-cover rounded-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Nuevo Tipo de Mascota (Especie)</h3>
                    <a href="{{ route('pet_types.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition-colors">Nuevo Tipo Mascota</a>
                </div>
                @endif
                <!-- Nuevo Registro de Mascota en Adopción -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center transform hover:scale-105 transition-transform">
                    <img src="{{ asset('icons/add-pet.png') }}" alt="Agregar Mascota" class="mx-auto mb-4 w-24 h-24 object-cover rounded-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Nuevo Registro de Mascota en Adopción</h3>
                    <a href="{{ route('pet.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition-colors">Agregar Mascota</a>
                </div>
                <!-- Ver todas las mascotas disponibles -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center transform hover:scale-105 transition-transform">
                    <img src="{{ asset('icons/view-pets.png') }}" alt="Ver Mascotas" class="mx-auto mb-4 w-24 h-24 object-cover rounded-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Ver todas las mascotas disponibles</h3>
                    <a href="{{ route('pets.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full transition-colors">Ver Mascotas</a>
                </div>
            </div>

            <!-- Sección: Adopciones -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                @if(Auth::user()->role->name == 'admin')
                <!-- Lista de Espera General -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center transform hover:scale-105 transition-transform">
                    <img src="{{ asset('icons/waiting-list.png') }}" alt="Lista de Espera General" class="mx-auto mb-4 w-24 h-24 object-cover rounded-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Lista de Espera General</h3>
                    <a href="{{ route('generalWaitingList') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full transition-colors">Ver Lista de Espera General</a>
                </div>
                <!-- Registro de Mascotas Adoptadas -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center transform hover:scale-105 transition-transform">
                    <img src="{{ asset('icons/adopted-pets.png') }}" alt="Mascotas Adoptadas" class="mx-auto mb-4 w-24 h-24 object-cover rounded-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Registro de Mascotas Adoptadas</h3>
                    <a href="{{ route('adoptedPets') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition-colors">Mascotas Adoptadas</a>
                    <div class="mt-4 flex justify-center space-x-2">
                        <a href="{{ route('exportAdoptedPetsToExcel') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition-colors">Exportar a Excel</a>
                        <a href="{{ route('exportAdoptedPetsToPdf') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition-colors">Exportar a PDF</a>
                    </div>
                </div>
                @else
                <!-- Mi Lista de Espera -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center transform hover:scale-105 transition-transform">
                    <img src="{{ asset('icons/my-waiting-list.png') }}" alt="Mi Lista de Espera" class="mx-auto mb-4 w-24 h-24 object-cover rounded-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Mi Lista de Espera</h3>
                    <a href="{{ route('waitingList') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full transition-colors">Ver Mi Lista de Espera</a>
                </div>
                <!-- Mis Mascotas Adoptadas -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center transform hover:scale-105 transition-transform">
                    <img src="{{ asset('icons/my-adopted-pets.png') }}" alt="Mis Mascotas Adoptadas" class="mx-auto mb-4 w-24 h-24 object-cover rounded-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Mis Mascotas Adoptadas</h3>
                    <a href="{{ route('myAdoptedPets') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition-colors">Mis Mascotas Adoptadas</a>
                </div>
                @endif
            </div>

            <!-- Sección: Mascotas Disponibles -->
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
                    {{ __('Mascotas Disponibles') }}
                </h2>
                @if($pets->isEmpty())
                <p class="text-center text-gray-600 dark:text-gray-400">No hay mascotas disponibles en este momento.</p>
                @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($pets as $pet)
                    @if(in_array($pet->status, ['available', 'waiting']))
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow transform hover:scale-105">
                        <div class="relative">
                            <img src="{{ asset('photos/' . $pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover">
                            <div class="absolute top-2 right-2 bg-{{ $pet->status == 'available' ? 'green' : 'yellow' }}-600 text-white px-2 py-1 rounded-full text-xs">
                                {{ ucfirst($pet->status) }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">{{ $pet->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1"><strong>Raza:</strong> {{ $pet->breed }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1"><strong>Sexo:</strong> {{ ucfirst($pet->sex) }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2"><strong>Fecha Nac.:</strong> {{ $pet->dob }}</p>
                            <div class="flex justify-center">
                                <form action="{{ route('adopt', $pet->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors">
                                        Adoptar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif
            </div>
            <!-- Sección: Organizaciones de Rescate Animal -->
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
                    {{ __('Organizaciones de Rescate Animal') }}
                </h2>
                @if($organizations->isEmpty())
                <p class="text-center text-gray-600 dark:text-gray-400">No hay organizaciones de rescate registradas en este momento.</p>
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

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">{{ $org->name }}</h3>
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
        </div>
    </div>
    </div>
</x-app-layout>