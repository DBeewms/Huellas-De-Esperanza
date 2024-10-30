<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista General de Espera') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($generalWaitingList->isEmpty())
                        <p class="text-center text-lg">No hay mascotas en la lista de espera.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($generalWaitingList as $waiting)
                                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-500 hover:bg-gray-50 dark:hover:bg-gray-700 relative">
                                    <div class="absolute top-4 right-4 text-white px-2 py-1 rounded-full">
                                        @if($waiting->pet->status == 'available')
                                            <span class="bg-green-500 px-2 py-1 rounded-full">Disponible</span>
                                        @elseif($waiting->pet->status == 'waiting')
                                            <span class="bg-yellow-500 px-2 py-1 rounded-full">En espera</span>
                                        @elseif($waiting->pet->status == 'adopted')
                                            <span class="bg-blue-500 px-2 py-1 rounded-full">Adoptado</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <img src="{{ asset('photos/' . $waiting->pet->photo) }}" alt="{{ $waiting->pet->name }}" class="w-16 h-16 rounded-full mr-4 object-cover">
                                        <div>
                                            <div class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $waiting->pet->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $waiting->pet->breed }}</div>
                                        </div>
                                    </div>
                                    <div class="w-full h-40 mb-4">
                                        <img src="{{ asset('photos/' . $waiting->pet->photo) }}" alt="{{ $waiting->pet->name }}" class="w-full h-full object-cover rounded-full">
                                    </div>
                                    <div class="text-center">
                                        <div class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $waiting->pet->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                            <strong>Raza:</strong> {{ $waiting->pet->breed }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                            <strong>Sexo:</strong> {{ ucfirst($waiting->pet->sex) }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                            <strong>Fecha Nac.:</strong> {{ $waiting->pet->dob ? \Carbon\Carbon::parse($waiting->pet->dob)->format('d/m/Y') : 'N/A' }}
                                        </div>
                                        <div class="flex justify-center space-x-2">
                                            <form action="{{ route('finalizeAdoption', $waiting->pet->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-700 transition-colors">
                                                    Finalizar Adopción
                                                </button>
                                            </form>
                                            <form action="{{ route('rejectAdoption', $waiting->pet->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-700 transition-colors">
                                                    Rechazar Adopción
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