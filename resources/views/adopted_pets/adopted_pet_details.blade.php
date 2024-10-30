<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de la Mascota Adoptada') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Sección Izquierda: Información Básica -->
                        <div class="flex flex-col items-center">
                            <!-- Imagen Circular de la Mascota -->
                            <div class="w-40 h-40 mb-6">
                                <img src="{{ asset('photos/' . $adoption->pet->photo) }}" alt="{{ $adoption->pet->name }}" class="w-full h-full object-cover rounded-full border-4 border-indigo-500">
                            </div>
                            <!-- Nombre de la Mascota -->
                            <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-2">
                                {{ $adoption->pet->name }}
                            </h3>
                            <!-- Estado de Adopción -->
                            <span class="px-3 py-1 bg-green-500 text-white rounded-full">
                                Adoptado
                            </span>
                        </div>

                        <!-- Sección Derecha: Detalles de la Adopción -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-inner">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                Información de la Adopción
                            </h4>
                            <div class="mb-4">
                                <h5 class="font-medium text-gray-700 dark:text-gray-300">Adoptante:</h5>
                                <p class="text-gray-600 dark:text-gray-400">{{ $adoption->user->name }}</p>
                            </div>
                            <div class="mb-4">
                                <h5 class="font-medium text-gray-700 dark:text-gray-300">Fecha de Adopción:</h5>
                                <p class="text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($adoption->created_at)->format('d/m/Y') }}</p>
                            </div>
                            <div class="mb-4">
                                <h5 class="font-medium text-gray-700 dark:text-gray-300">Estado:</h5>
                                <span class="px-3 py-1 bg-green-500 text-white rounded-full">
                                    {{ ucfirst($adoption->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Adicional: Descripción de la Mascota -->
                    <div class="mt-8">
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                            Descripción de la Mascota
                        </h4>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $adoption->pet->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>