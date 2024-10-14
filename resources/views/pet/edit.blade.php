<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('pets.update', $pet) }}" method="POST" enctype="multipart/form-data">
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
                            <div class="bg-white shadow-md rounded-lg p-4">
                                <label for="status" class="text-lg font-semibold text-gray-900">Status</label>
                                <select name="status" id="status" class="mt-2 w-full p-2 border rounded-lg">
                                    <option value="1" {{ $pet->status == 1 ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ $pet->status == 0 ? 'selected' : '' }}>Adopted</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 sm:px-20 bg-white border-t border-gray-200">
                        <div class="flex justify-between">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-700">Save</button>
                            <a href="{{ route('pets.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-gray-700">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>