<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adopted Pet Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sección izquierda -->
                        <div>
                            <div class="text-2xl font-semibold text-gray-900 mb-4">
                                {{ $adoption->pet->name }}
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <img src="{{ asset('photos/' . $adoption->pet->photo) }}" alt="{{ $adoption->pet->name }}" class="w-full h-auto rounded-lg">
                            </div>
                        </div>
                        <!-- Sección derecha -->
                        <div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <div class="text-lg font-semibold text-gray-900">Raza</div>
                                <div class="mt-2">{{ $adoption->pet->breed }}</div>
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <div class="text-lg font-semibold text-gray-900">Sexo</div>
                                <div class="mt-2">{{ ucfirst($adoption->pet->sex) }}</div>
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <div class="text-lg font-semibold text-gray-900">Fecha de Nacimiento</div>
                                <div class="mt-2">{{ $adoption->pet->dob }}</div>
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <div class="text-lg font-semibold text-gray-900">Estado</div>
                                <div class="mt-2">{{ ucfirst($adoption->pet->status) }}</div>
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <div class="text-lg font-semibold text-gray-900">Descripción</div>
                                <div class="mt-2">{{ $adoption->pet->description }}</div>
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <div class="text-lg font-semibold text-gray-900">Adoptante</div>
                                <div class="mt-2">{{ $adoption->user->name }}</div>
                                <div class="mt-2">{{ $adoption->user->email }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('adoptedPets') }}" class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-gray-700">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>