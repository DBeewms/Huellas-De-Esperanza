<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetTypeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\AdoptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Pet Type routes
Route::middleware('auth')->group(function () {
    Route::get('/pet_types', [PetTypeController::class, 'index'])->name('pet_types.index');
    Route::get('/pet_types/create', [PetTypeController::class, 'create'])->name('pet_types.create');
    Route::post('/pet_types', [PetTypeController::class, 'store'])->name('pet_types.store');
    Route::get('/pet_types/{pet_type}', [PetTypeController::class, 'show'])->name('pet_types.show');
    Route::get('/pet_types/{pet_type}/edit', [PetTypeController::class, 'edit'])->name('pet_types.edit');
    Route::patch('/pet_types/{pet_type}', [PetTypeController::class, 'update'])->name('pet_types.update');
    Route::delete('/pet_types/{pet_type}', [PetTypeController::class, 'destroy'])->name('pet_types.destroy');
});

// Pet routes
Route::middleware('auth')->group(function () {
    Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
    Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
    Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');
    Route::get('/pets/{pet}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::patch('/pets/{pet}', [PetController::class, 'update'])->name('pets.update');
    Route::delete('/pets/{pet}', [PetController::class, 'destroy'])->name('pets.destroy');
});

// Adoption routes
Route::middleware('auth')->group(function () {
    Route::post('/adopt/{petId}', [AdoptionController::class, 'adopt'])->name('adopt');
    Route::post('/finalize-adoption/{petId}', [AdoptionController::class, 'finalizeAdoption'])->name('finalizeAdoption');
    Route::post('/reject-adoption/{petId}', [AdoptionController::class, 'rejectAdoption'])->name('rejectAdoption');
    Route::get('/waiting-list', [AdoptionController::class, 'waitingList'])->name('waitingList');
    Route::get('/general-waiting-list', [AdoptionController::class, 'generalWaitingList'])->name('generalWaitingList');
    Route::get('/adopted-pets', [AdoptionController::class, 'adoptedPets'])->name('adoptedPets');
    Route::get('/adopted-pet-details/{id}', [AdoptionController::class, 'adoptedPetDetails'])->name('adoptedPetDetails');
});

require __DIR__.'/auth.php';
