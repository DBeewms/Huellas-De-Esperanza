<?php

namespace App\Http\Controllers;
use App\Models\PetType;

use Illuminate\Http\Request;

class PetTypeController extends Controller
{
    //
    public function index()
    {
        $pet_types = PetType::all();
        return view('pet_types.index', compact('pet_types'));
    }

    public function create()
    {
        return view('pet_types.create');
    }

    public function store (Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        PetType::create($request->all());
        return redirect()->route('pet_types.index')
            ->with('success', 'Pet Type created successfully.');
    }

    public function show(PetType $pet_type)
    {
        return view('pet_types.show', compact('pet_type'));
    }

    public function edit(PetType $pet_type)
    {
        return view('pet_types.edit', compact('pet_type'));
    }

    public function update(Request $request, PetType $pet_type)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $pet_type->update($request->all());
        return redirect()->route('pet_types.index')
            ->with('success', 'Pet Type updated successfully');
    }

    public function destroy(PetType $pet_type)
    {
        $pet_type->delete();

        return redirect()->route('pet_types.index')
            ->with('success', 'Pet Type deleted successfully');
    }

}
