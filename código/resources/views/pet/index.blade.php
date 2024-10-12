<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="text-2xl">
                            Pets
                        </div>
                        <div class="mt-6 text-gray-500">
                            <a href="{{ route('pets.create') }}" class="text-indigo-600 hover:text-indigo-900">Create a new pet</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($pets as $pet)
                            <div class="bg-white shadow-md rounded-lg p-4 transform transition duration-500 hover:scale-105 hover:shadow-lg">
                                <div class="text-lg font-semibold text-gray-900">{{ $pet->name }}</div>
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
        </div>
    </div>
</x-app-layout>
