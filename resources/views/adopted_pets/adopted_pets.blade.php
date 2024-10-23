<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adopted Pets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($adoptedPets->isEmpty())
                        <p>No adopted pets found.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($adoptedPets as $adoption)
                                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 hover:shadow-lg transition-shadow border border-gray-200 hover:border-gray-400 hover:bg-gray-50 relative">
                                    <div class="absolute top-4 right-4 text-white px-2 py-1 rounded-full">
                                        <span class="bg-blue-500 px-2 py-1 rounded-full">Adoptado</span>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <img src="{{ asset('photos/' . $adoption->pet->photo) }}" alt="{{ $adoption->pet->name }}" class="w-12 h-12 rounded-full mr-4">
                                        <div>
                                            <div class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $adoption->user->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $adoption->user->email }}</div>
                                        </div>
                                    </div>
                                    <div class="w-full h-40 mb-4">
                                        <img src="{{ asset('photos/' . $adoption->pet->photo) }}" alt="{{ $adoption->pet->name }}" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="text-center">
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                            <strong>Name:</strong> {{ $adoption->pet->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                            <strong>Breed:</strong> {{ $adoption->pet->breed }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                            <strong>Sex:</strong> {{ ucfirst($adoption->pet->sex) }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                            <strong>FechaNac:</strong> {{ $adoption->pet->dob }}
                                        </div>
                                        <a href="{{ route('adoptedPetDetails', $adoption->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-700 transition-colors mt-2">
                                            Mostrar más
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>