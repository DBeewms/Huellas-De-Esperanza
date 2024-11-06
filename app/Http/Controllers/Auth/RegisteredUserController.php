<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar el request
        $request->validate($this->validatorRules($request));

        // Determinar el rol basado en la selección del usuario
        $role = $request->input('is_rescue_organization') 
            ? Role::where('name', 'rescue_organization')->first() 
            : Role::where('name', 'user')->first();

        // Preparar los datos del usuario
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
        ];

        // Añadir campos adicionales si es una organización de rescate
        if ($request->input('is_rescue_organization')) {
            $userData['address'] = $request->address;
            $userData['phone'] = $request->phone;
            $userData['contact_email'] = $request->contact_email;
        }

        // Crear el usuario
        $user = User::create($userData);

        // Emitir el evento de registro
        event(new Registered($user));

        // Autenticar al usuario
        Auth::login($user);

        // Redirigir al dashboard o página de inicio
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Define las reglas de validación para el registro.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function validatorRules(Request $request): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        // Si se selecciona registrar como organización de rescate, agregar reglas adicionales
        if ($request->has('is_rescue_organization') && $request->is_rescue_organization) {
            $rules['address'] = ['required', 'string', 'max:255'];
            $rules['phone'] = ['required', 'string', 'max:20'];
            $rules['contact_email'] = ['required', 'string', 'email', 'max:255'];
        }

        return $rules;
    }
}
