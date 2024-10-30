<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tipos de Mascotas') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Header Section -->
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        Tipos de Mascotas
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('pet_types.create') }}" class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors">
                            Crear Nuevo Tipo de Mascota
                        </a>
                    </div>
                </div>

                <!-- Pet Types Grid -->
                <div class="p-6 bg-gray-50 dark:bg-gray-700">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($pet_types as $petType)
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 flex flex-col items-center hover:shadow-xl transition-shadow duration-300">
                                <!-- Pet Type Image (Circular) -->
                                <div class="w-24 h-24 mb-4">
                                    @if($petType->image)
                                        <img src="{{ asset('images/pet_types/' . $petType->image) }}" alt="{{ $petType->name }}" class="w-full h-full object-cover rounded-full">
                                    @else
                                        <img src="https://via.placeholder.com/150" alt="{{ $petType->name }}" class="w-full h-full object-cover rounded-full">
                                    @endif
                                </div>

                                <!-- Pet Type Name -->
                                <div class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                    {{ $petType->name }}
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex space-x-3">
                                    <a href="{{ route('pet_types.show', $petType) }}" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors">
                                        Ver
                                    </a>
                                    <a href="{{ route('pet_types.edit', $petType) }}" class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors">
                                        Editar
                                    </a>
                                    <form action="{{ route('pet_types.destroy', $petType) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este tipo de mascota?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        @if($pet_types->isEmpty())
                            <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                                No hay tipos de mascotas disponibles.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>