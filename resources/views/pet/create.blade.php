<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Pet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('pet.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                        <!-- Sección izquierda -->
                        <div>
                            <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('New Pet') }}
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="flex justify-center">
                                    <img id="preview" class="rounded-full w-80 h-80 object-cover" src="#" alt="Pet Photo" style="display: none;">
                                </div>
                                <input type="file" name="photo" accept=".jpg, .jpeg" class="mt-4 w-full text-gray-900 dark:text-gray-100" onchange="previewImage(event)">
                            </div>
                        </div>
                        <!-- Sección derecha -->
                        <div>
                            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4 mb-4">
                                <label for="name" class="text-lg font-semibold text-gray-900 dark:text-gray-100">Name</label>
                                <input type="text" name="name" id="name" class="mt-2 w-full p-2 border rounded-lg text-gray-900 dark:text-gray-100 dark:bg-gray-800">
                            </div>
                            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4 mb-4">
                                <label for="breed" class="text-lg font-semibold text-gray-900 dark:text-gray-100">Breed</label>
                                <input type="text" name="breed" id="breed" class="mt-2 w-full p-2 border rounded-lg text-gray-900 dark:text-gray-100 dark:bg-gray-800">
                            </div>
                            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4 mb-4">
                                <label for="sex" class="text-lg font-semibold text-gray-900 dark:text-gray-100">Sex</label>
                                <select name="sex" id="sex" class="mt-2 w-full p-2 border rounded-lg text-gray-900 dark:text-gray-100 dark:bg-gray-800">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4 mb-4">
                                <label for="dob" class="text-lg font-semibold text-gray-900 dark:text-gray-100">Date of Birth</label>
                                <input type="date" name="dob" id="dob" class="mt-2 w-full p-2 border rounded-lg text-gray-900 dark:text-gray-100 dark:bg-gray-800">
                            </div>
                            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4 mb-4">
                                <label for="description" class="text-lg font-semibold text-gray-900 dark:text-gray-100">Description</label>
                                <textarea name="description" id="description" class="mt-2 w-full p-2 border rounded-lg text-gray-900 dark:text-gray-100 dark:bg-gray-800"></textarea>
                            </div>
                            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4 mb-4">
                                <label for="pet_type_id" class="text-lg font-semibold text-gray-900 dark:text-gray-100">Pet Type</label>
                                <select name="pet_type_id" id="pet_type_id" class="mt-2 w-full p-2 border rounded-lg text-gray-900 dark:text-gray-100 dark:bg-gray-800">
                                    @foreach($petTypes as $petType)
                                    <option value="{{ $petType->id }}">{{ $petType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-700">Save</button>
                            <a href="{{ route('pets.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-gray-700">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>