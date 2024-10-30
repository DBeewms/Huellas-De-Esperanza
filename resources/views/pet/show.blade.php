<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pet Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <!-- Sección izquierda -->
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            {{ $pet->name }}
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                            <img src="{{ asset('photos/' . $pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-auto rounded-full object-cover">
                        </div>
                    </div>
                    <!-- Sección derecha -->
                    <div>
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 mb-4">
                            <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Raza</div>
                            <div class="mt-2 text-gray-700 dark:text-gray-300">{{ $pet->breed }}</div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 mb-4">
                            <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Sexo</div>
                            <div class="mt-2 text-gray-700 dark:text-gray-300">{{ ucfirst($pet->sex) }}</div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 mb-4">
                            <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Fecha de Nacimiento</div>
                            <div class="mt-2 text-gray-700 dark:text-gray-300">{{ $pet->dob }}</div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                            <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Descripción</div>
                            <div class="mt-2 text-gray-700 dark:text-gray-300">{{ $pet->description }}</div>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between">
                        <a href="{{ route('pets.index') }}" class="px-4 py-2 bg-gray-500 dark:bg-gray-600 text-white rounded-full hover:bg-gray-700 dark:hover:bg-gray-500">Back</a>
                        <a href="{{ route('pets.edit', $pet) }}" class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded-full hover:bg-blue-700 dark:hover:bg-blue-500">Edit</a>
                        <form action="{{ route('pets.destroy', $pet) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded-full hover:bg-red-700 dark:hover:bg-red-500">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>