<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pet Types') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-2xl">
                        Pet Types
                    </div>
                    <div class="mt-6 text-gray-500">
                        <a href="{{ route('pet_types.create') }}" class="text-indigo-600 hover:text-indigo-900">Create a new pet type</a>
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($pet_types as $petType)
                        <div class="bg-white shadow-md rounded-lg p-4 transform transition duration-500 hover:scale-105 hover:shadow-lg">
                            <div class="text-lg font-semibold text-gray-900">{{ $petType->name }}</div>
                            <div class="mt-4 flex justify-between">
                                <a href="{{ route('pet_types.show', $petType) }}" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-700">View</a>
                                <a href="{{ route('pet_types.edit', $petType) }}" class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-700">Edit</a>
                                <form class="inline" action="{{ route('pet_types.destroy', $petType) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-700">Delete</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>