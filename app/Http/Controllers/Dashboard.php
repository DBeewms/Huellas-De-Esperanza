<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;

class Dashboard extends Controller
{
    //
    public function index()
    {
        $pets = Pet::whereIn('status', ['available', 'waiting'])->get();
        $organizations = User::whereHas('role', function($query) {
            $query->where('name', 'rescue_organization');
        })->get();

        return view('dashboard', compact('pets', 'organizations'));
    }
}
