<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Sección Mascotas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Nuevo Tipo de Mascota (Especie) -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center">
                    <img src="https://via.placeholder.com/150" alt="Nuevo Tipo de Mascota" class="mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Nuevo Tipo de Mascota (Especie)</h3>
                    <a href="{{ route('pet_types.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nuevo Tipo Mascota</a>
                </div>
                <!-- Nuevo Registro de Mascota en Adopción -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center">
                    <img src="https://via.placeholder.com/150" alt="Agregar Mascota" class="mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Nuevo Registro de Mascota en Adopción</h3>
                    <a href="{{ route('pets.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Agregar Mascota</a>
                </div>
                <!-- Ver todas las mascotas disponibles -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center">
                    <img src="https://via.placeholder.com/150" alt="Ver Mascotas" class="mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Ver todas las mascotas disponibles</h3>
                    <a href="{{ route('pets.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Ver Mascotas</a>
                </div>
            </div>

            <!-- Sección Adopciones -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <!-- Lista de Espera General -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center">
                    <img src="https://via.placeholder.com/150" alt="Lista de Espera General" class="mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Lista de Espera General</h3>
                    <a href="{{ route('generalWaitingList') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Ver Lista de Espera General</a>
                </div>
                <!-- Registro de Mascotas Adoptadas -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center">
                    <img src="https://via.placeholder.com/150" alt="Mascotas Adoptadas" class="mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Registro de Mascotas Adoptadas</h3>
                    <a href="{{ route('adoptedPets') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Mascotas Adoptadas</a>
                </div>
            </div>

            <!-- Sección de Mascotas Disponibles y en Espera -->
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Pets') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($pets as $pet)
                        @if(in_array($pet->status, ['available', 'waiting']))
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 hover:shadow-lg transition-shadow border border-gray-200 hover:border-gray-400 hover:bg-gray-50">
                            <div class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                                {{ $pet->name }}
                            </div>
                            <div class="w-full h-40 mb-2">
                                <img src="{{ asset('photos/' . $pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="text-center">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                    <strong>Breed:</strong> {{ $pet->breed }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                    <strong>Sex:</strong> {{ ucfirst($pet->sex) }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <strong>FechaNac:</strong> {{ $pet->dob }}
                                </div>
                                <form action="{{ route('adopt', $pet->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-700 transition-colors mt-2">
                                        Adoptar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>