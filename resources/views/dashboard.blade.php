<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('pet_types.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Go to Pet Types
                    </a>
                    <a href="{{ route('waitingList') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-4">
                        View Waiting List
                    </a>
                    <a href="{{ route('pets.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-4">
                        Add New Pet
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('pets.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Go to Pets
                    </a>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($pets as $pet)
                @if($pet->status == 'available')
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
</x-app-layout>