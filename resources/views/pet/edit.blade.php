<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                        <!-- Sección izquierda -->
                        <div>
                            <div class="text-2xl font-semibold text-gray-900 mb-4">
                                {{ $pet->name }}
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-auto rounded-lg">
                                <input type="file" name="photo" accept=".jpg, .jpeg" class="mt-4">
                            </div>
                        </div>
                        <!-- Sección derecha -->
                        <div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <label for="name" class="text-lg font-semibold text-gray-900">Name</label>
                                <input type="text" name="name" id="name" value="{{ $pet->name }}" class="mt-2 w-full p-2 border rounded-lg">
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <label for="breed" class="text-lg font-semibold text-gray-900">Breed</label>
                                <input type="text" name="breed" id="breed" value="{{ $pet->breed }}" class="mt-2 w-full p-2 border rounded-lg">
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <label for="sex" class="text-lg font-semibold text-gray-900">Sex</label>
                                <select name="sex" id="sex" class="mt-2 w-full p-2 border rounded-lg">
                                    <option value="male" {{ $pet->sex == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $pet->sex == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <label for="dob" class="text-lg font-semibold text-gray-900">Date of Birth</label>
                                <input type="date" name="dob" id="dob" value="{{ $pet->dob }}" class="mt-2 w-full p-2 border rounded-lg">
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <label for="description" class="text-lg font-semibold text-gray-900">Description</label>
                                <textarea name="description" id="description" class="mt-2 w-full p-2 border rounded-lg">{{ $pet->description }}</textarea>
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <label for="pet_type_id" class="text-lg font-semibold text-gray-900">Pet Type</label>
                                <select name="pet_type_id" id="pet_type_id" class="mt-2 w-full p-2 border rounded-lg">
                                    @foreach($petTypes as $petType)
                                    <option value="{{ $petType->id }}" {{ $pet->pet_type_id == $petType->id ? 'selected' : '' }}>{{ $petType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <label for="status" class="text-lg font-semibold text-gray-900">Status</label>
                                <select name="status" id="status" class="mt-2 w-full p-2 border rounded-lg">
                                    <option value="available" {{ $pet->status == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="waiting" {{ $pet->status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                                    <option value="adopted" {{ $pet->status == 'adopted' ? 'selected' : '' }}>Adopted</option>
                                </select>
                            </div>
                            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Update Pet
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>