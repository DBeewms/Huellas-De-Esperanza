<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Pet;
use App\Models\WaitingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\AdoptedPetsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AdoptionController extends Controller
{
    public function adopt(Request $request, $petId)
    {
        $user = Auth::user();

        // Verificar si el perfil del usuario está completo

        // Verificar si el usuario ya tiene una mascota en lista de espera
        if (WaitingList::where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'Ya tienes una mascota en la lista de espera.');
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

        return redirect()->route('pets.index')->with('success', 'Has agregado la mascota a la lista de espera exitosamente.');
    }

    public function finalizeAdoption($petId)
    {
        $user = Auth::user();

        // Verificar si el usuario tiene el rol de administrador
        if ($user->role->name !== 'admin') {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        // Obtener el primer usuario en la lista de espera para esta mascota
        $waitingList = WaitingList::where('pet_id', $petId)->orderBy('created_at')->first();
        if (!$waitingList) {
            return redirect()->back()->with('error', 'No hay usuarios en la lista de espera para esta mascota.');
        }

        // Registrar la adopción
        $adoption = new Adoption();
        $adoption->user_id = $waitingList->user_id;
        $adoption->pet_id = $petId;
        $adoption->status = 'completed';
        $adoption->save();

        // Actualizar el estado de la mascota a "adopted"
        $pet = Pet::find($petId);
        $pet->status = 'adopted';
        $pet->save();

        // Eliminar de la lista de espera de todos los usuarios
        WaitingList::where('pet_id', $petId)->delete();

        return redirect()->route('adoptedPets')->with('success', 'La adopción ha sido finalizada exitosamente.');
    }

    public function rejectAdoption($petId)
    {
        $user = Auth::user();

        // Verificar si el usuario tiene el rol de administrador
        if ($user->role->name !== 'admin') {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        // Eliminar el primer usuario de la lista de espera para esta mascota
        $waitingList = WaitingList::where('pet_id', $petId)->orderBy('created_at')->first();
        if ($waitingList) {
            $waitingList->delete();
        }

        // Verificar si hay otros usuarios en la lista de espera para esta mascota
        $remainingWaitingList = WaitingList::where('pet_id', $petId)->exists();

        if (!$remainingWaitingList) {
            // Actualizar el estado de la mascota a "available"
            $pet = Pet::find($petId);
            $pet->status = 'available';
            $pet->save();
        }

        return redirect()->route('generalWaitingList')->with('success', 'La solicitud de adopción ha sido rechazada.');
    }

    // Lista de espera individual (para usuarios)
    public function waitingList()
    {
        $user = Auth::user();
        $waitingList = WaitingList::where('user_id', $user->id)->with('pet', 'user')->get();

        return view('waiting_lists.waiting_list', compact('waitingList'));
    }

    // Lista de espera general (solo para administradores)
    public function generalWaitingList()
    {
        // Verificar si el usuario tiene el rol de administrador
        if (Auth::user()->role->name !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder a esta página.');
        }

        // Obtener todas las mascotas en lista de espera
        $generalWaitingList = WaitingList::with('pet', 'user')->get();

        return view('waiting_lists.waiting_list_general', compact('generalWaitingList'));
    }

    public function adoptedPets()
    {
        $adoptedPets = Adoption::where('status', 'completed')->with('pet', 'user')->get();

        return view('adopted_pets.adopted_pets', compact('adoptedPets'));
    }

    public function adoptedPetDetails($id)
    {
        $adoption = Adoption::with('pet', 'user')->findOrFail($id);

        return view('adopted_pets.adopted_pet_details', compact('adoption'));
    }

    public function myAdoptedPets()
    {
        $user = Auth::user();
        $adoptions = Adoption::where('user_id', $user->id)->with('pet')->get();

        return view('adopted_pets.my_adopted_pets', compact('adoptions'));
    }

    public function myAdoptedPetDetails($id)
    {
        $user = Auth::user();
        $adoption = Adoption::where('id', $id)->where('user_id', $user->id)->with('pet')->firstOrFail();

        return view('adopted_pets.my_adopted_pet_details', compact('adoption'));
    }

    public function exportAdoptedPetsToExcel()
    {
        return Excel::download(new AdoptedPetsExport, 'adopted_pets.xlsx');
    }

    public function exportAdoptedPetsToPdf()
    {
        $adoptedPets = Adoption::where('status', 'completed')->with('pet', 'user')->get();
        $pdf = Pdf::loadView('adopted_pets.adopted_pets_pdf', compact('adoptedPets'));
        return $pdf->download('adopted_pets.pdf');
    }
}
