<?php
// app/Http/Controllers/PetController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\PetType; // Importa el modelo PetType
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::all();
        return view('pet.index', compact('pets'));
    }

    public function create()
    {
        $petTypes = PetType::all(); // Obtener todos los tipos de mascotas
        return view('pet.create', compact('petTypes'));
    }

    public function store(Request $request)
    {
        $pet = new Pet();
        $pet->name = $request->name;
        $pet->pet_type_id = $request->pet_type_id;
        $pet->breed = $request->breed;
        $pet->sex = $request->sex; // Nuevo campo
        $pet->dob = $request->dob;
        $pet->description = $request->description;
        $pet->status = $request->status;

        if ($request->hasFile('photo')) {
            // Subir la imagen y obtener la ruta
            $path = $request->file('photo')->store('public/photos');

            // Asignar la ruta de la imagen al campo 'photo' del modelo
            $pet->photo = $path;
        }

        $pet->save();

        return redirect()->route('pets.index')->with('success', 'Pet created successfully.');
    }

    public function show(string $id)
    {
        $pet = Pet::find($id);
        return view('pet.show', compact('pet'));
    }

    public function edit(string $id)
    {
        $pet = Pet::find($id);
        $petTypes = PetType::all(); // Obtener todos los tipos de mascotas
        return view('pet.edit', compact('pet', 'petTypes'));
    }

    public function update(Request $request, string $id)
    {
        $pet = Pet::find($id);
        $pet->name = $request->name;
        $pet->pet_type_id = $request->pet_type_id;
        $pet->breed = $request->breed;
        $pet->sex = $request->sex; // Nuevo campo
        $pet->dob = $request->dob;
        $pet->description = $request->description;
        $pet->status = $request->status;

        if ($request->hasFile('photo')) {
            // Eliminar la foto anterior si existe
            if ($pet->photo && Storage::exists($pet->photo)) {
                Storage::delete($pet->photo);
            }

            // Subir la nueva imagen y obtener la ruta
            $path = $request->file('photo')->store('public/photos');

            // Asignar la ruta de la nueva imagen al campo 'photo' del modelo
            $pet->photo = $path;
        }

        $pet->save();

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully.');
    }

    public function destroy(string $id)
    {
        $pet = Pet::find($id);

        // Eliminar la foto de la mascota si existe
        if ($pet->photo && Storage::exists($pet->photo)) {
            Storage::delete($pet->photo);
        }

        $pet->delete();

        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully.');
    }
}
