<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Pets</h2>
                <div class="mt-4">
                    <a href="{{ route('pet.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-600">Create a new pet</a>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($pets as $pet)
                    <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4 transform transition duration-500 hover:scale-105 hover:shadow-lg">
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $pet->name }}</div>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('pets.show', $pet) }}" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-700">View</a>
                            <a href="{{ route('pets.edit', $pet) }}" class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-700">Edit</a>
                            <form class="inline" action="{{ route('pets.destroy', $pet) }}" method="POST">
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
</x-app-layout>
