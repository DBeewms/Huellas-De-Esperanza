<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    //
    
}
<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
{
    public function adopt(Request $request, $petId)
    {
        $user = Auth::user();

        // Verificar si el perfil del usuario está completo
        if (!$this->isProfileComplete($user)) {
            return redirect()->back()->with('error', 'Your profile is not complete. Please complete your profile before adopting a pet.');
        }

        // Registrar la adopción
        $adoption = new Adoption();
        $adoption->user_id = $user->id;
        $adoption->pet_id = $petId;
        $adoption->save();

        return redirect()->route('pets.index')->with('success', 'You have successfully adopted the pet.');
    }

    private function isProfileComplete($user)
    {
        // Verificar si los campos necesarios del perfil están completos
        return $user->name && $user->email && $user->address && $user->phone;
    }
}