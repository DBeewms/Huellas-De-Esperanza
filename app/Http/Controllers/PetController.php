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
        // Mostrar solo mascotas disponibles o en espera
        $pets = Pet::whereIn('status', ['available', 'waiting'])->get();
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
        $pet->status = 'available'; // Estado inicial
        $pet->save();

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('photos'), $imageName);
            $pet->photo = $imageName;
        }

        $pet->save();

        return redirect()->route('pets.index')->with('success', 'Pet created successfully.');
    }

    public function show(string $id)
    {
        // Usa findOrFail para arrojar un 404 si no se encuentra la mascota
        $pet = Pet::find($id);

        // if (!$pet) {
        //     // Redirige al índice si la mascota no se encuentra
        //     return redirect()->route('pets.index')->with('error', 'Pet not found.');
        // }

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
            if ($pet->photo && file_exists(public_path('photos/' . $pet->photo))) {
                unlink(public_path('photos/' . $pet->photo));
            }

            // Subir la nueva imagen y obtener la ruta
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('photos'), $imageName);
            $pet->photo = $imageName;
        }

        $pet->save();

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully.');
    }

    public function destroy(string $id)
    {
        $pet = Pet::find($id);

        // Eliminar la foto de la mascota si existe
        if ($pet->photo && file_exists(public_path('photos/' . $pet->photo))) {
            unlink(public_path('photos/' . $pet->photo));
        }

        $pet->delete();

        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully.');
    }
}
