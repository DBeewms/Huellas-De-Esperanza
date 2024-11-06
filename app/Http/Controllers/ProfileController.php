<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

     public function update(ProfileUpdateRequest $request): RedirectResponse
     {
         $user = $request->user();
         $user->fill($request->validated());
     
         if ($request->hasFile('profile_photo')) {
             // Eliminar la foto anterior si existe
             if ($user->profile_photo && file_exists(public_path('profile_photos/' . $user->profile_photo))) {
                 unlink(public_path('profile_photos/' . $user->profile_photo));
             }
     
             // Subir la nueva imagen y obtener la ruta
             $image = $request->file('profile_photo');
             $imageName = time() . '.' . $image->getClientOriginalExtension();
             $image->move(public_path('profile_photos'), $imageName);
             $user->profile_photo = $imageName;
         }
     
         if ($user->isDirty('email')) {
             $user->email_verified_at = null;
         }
     
         $user->save();
     
         return Redirect::route('profile.edit')->with('status', 'profile-updated');
     }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
