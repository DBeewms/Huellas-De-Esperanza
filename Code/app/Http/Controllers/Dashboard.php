<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class Dashboard extends Controller
{
    //
    public function index()
    {
        $pets = Pet::all();
        return view('dashboard', compact('pets'));
    }
}
