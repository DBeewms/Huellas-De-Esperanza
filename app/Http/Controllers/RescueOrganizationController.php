<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RescueOrganizationController extends Controller
{
    // Muestra una lista de organizaciones de rescate animal.
    public function index()
    {
        // Obtener los usuarios con rol 'rescue_organization'
        $organizations = User::whereHas('role', function($query) {
            $query->where('name', 'rescue_organization');
        })->get();

        // Retornar la vista con las organizaciones
        return view('rescue_organizations.rescue_organizations', compact('organizations'));
    }

    // Método para mostrar la vista individual de una organización
    public function show($userId)
    {
        // Obtener el usuario con rol 'rescue_organization' y el ID proporcionado
        $organization = User::where('id', $userId)
            ->whereHas('role', function($query) {
                $query->where('name', 'rescue_organization');
            })->firstOrFail();

        // Retornar la vista con la organización
        return view('rescue_organizations.rescue_organizations_details', compact('organization'));
    }
}
