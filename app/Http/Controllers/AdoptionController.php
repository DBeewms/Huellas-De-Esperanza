<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Pet;
use App\Models\WaitingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
{
    public function adopt(Request $request, $petId)
    {
        $user = Auth::user();

        // Verificar si el perfil del usuario está completo

        // Verificar si el usuario ya tiene una mascota en lista de espera
        if (WaitingList::where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You already have a pet in the waiting list.');
        }

        // Añadir a la lista de espera
        $waitingList = new WaitingList();
        $waitingList->user_id = $user->id;
        $waitingList->pet_id = $petId;
        $waitingList->save();

        // Actualizar el estado de la mascota a "waiting"
        $pet = Pet::find($petId);
        $pet->status = 'waiting';
        $pet->save();

        return redirect()->route('pets.index')->with('success', 'You have successfully added the pet to the waiting list.');
    }

    public function finalizeAdoption($petId)
    {
        $user = Auth::user();

        // Verificar si la mascota está en la lista de espera del usuario
        $waitingList = WaitingList::where('user_id', $user->id)->where('pet_id', $petId)->first();
        if (!$waitingList) {
            return redirect()->back()->with('error', 'This pet is not in your waiting list.');
        }

        // Registrar la adopción
        $adoption = new Adoption();
        $adoption->user_id = $user->id;
        $adoption->pet_id = $petId;
        $adoption->save();

        // Actualizar el estado de la mascota a "adopted"
        $pet = Pet::find($petId);
        $pet->status = 'adopted';
        $pet->save();

        // Eliminar de la lista de espera
        $waitingList->delete();

        return redirect()->route('pets.index')->with('success', 'You have successfully adopted the pet.');
    }

    public function rejectAdoption($petId)
    {
        $user = Auth::user();

        // Verificar si la mascota está en la lista de espera del usuario
        $waitingList = WaitingList::where('user_id', $user->id)->where('pet_id', $petId)->first();
        if (!$waitingList) {
            return redirect()->back()->with('error', 'This pet is not in your waiting list.');
        }

        // Actualizar el estado de la mascota a "available"
        $pet = Pet::find($petId);
        $pet->status = 'available';
        $pet->save();

        // Eliminar de la lista de espera
        $waitingList->delete();

        return redirect()->route('pets.index')->with('success', 'You have successfully rejected the adoption.');
    }

    public function waitingList()
    {
        $user = Auth::user();
        $waitingList = WaitingList::where('user_id', $user->id)->with('pet', 'user')->get();

        return view('waiting_lists.waiting_list', compact('waitingList'));
    }
}