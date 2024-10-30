<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Waiting List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($waitingList->isEmpty())
                        <p class="text-center text-lg">No pets in the waiting list.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($waitingList as $item)
                                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 hover:shadow-lg transition-shadow border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 relative">
                                    <div class="absolute top-4 right-4 text-white px-2 py-1 rounded-full">
                                        @if($item->pet->status == 'available')
                                            <span class="bg-green-500 px-2 py-1 rounded-full">Disponible</span>
                                        @elseif($item->pet->status == 'waiting')
                                            <span class="bg-yellow-500 px-2 py-1 rounded-full">En espera</span>
                                        @elseif($item->pet->status == 'adopted')
                                            <span class="bg-blue-500 px-2 py-1 rounded-full">Adoptado</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <img src="{{ asset('photos/' . $item->pet->photo) }}" alt="{{ $item->pet->name }}" class="w-12 h-12 rounded-full mr-4">
                                        <div>
                                            <div class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $item->user->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $item->user->email }}</div>
                                        </div>
                                    </div>
                                    <div class="w-full h-40 mb-4">
                                        <img src="{{ asset('photos/' . $item->pet->photo) }}" alt="{{ $item->pet->name }}" class="w-full h-full object-cover rounded-full">
                                    </div>
                                    <div class="text-center">
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                            <strong>Name:</strong> {{ $item->pet->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                            <strong>Breed:</strong> {{ $item->pet->breed }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                            <strong>Sex:</strong> {{ ucfirst($item->pet->sex) }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                            <strong>FechaNac:</strong> {{ $item->pet->dob }}
                                        </div>
                                        <div class="flex justify-center space-x-4">
                                            <form action="{{ route('finalizeAdoption', $item->pet->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-700 transition-colors mt-2">
                                                    Accept Adoption
                                                </button>
                                            </form>
                                            <form action="{{ route('rejectAdoption', $item->pet->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-700 transition-colors mt-2">
                                                    Reject Adoption
                                                </button>
                                            </form>
                                        </div>
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