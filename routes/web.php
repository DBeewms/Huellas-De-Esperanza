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
| Aquí es donde puedes registrar las rutas web de tu aplicación. Estas
| rutas son cargadas por el RouteServiceProvider y asignadas al grupo "web".
|
*/

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas accesibles solo para administradores
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Rutas de tipos de mascotas
    Route::get('/pet_types', [PetTypeController::class, 'index'])->name('pet_types.index');
    Route::get('/pet_types/create', [PetTypeController::class, 'create'])->name('pet_types.create');
    Route::post('/pet_types', [PetTypeController::class, 'store'])->name('pet_types.store');
    Route::get('/pet_types/{pet_type}', [PetTypeController::class, 'show'])->name('pet_types.show');
    Route::get('/pet_types/{pet_type}/edit', [PetTypeController::class, 'edit'])->name('pet_types.edit');
    Route::patch('/pet_types/{pet_type}', [PetTypeController::class, 'update'])->name('pet_types.update');
    Route::delete('/pet_types/{pet_type}', [PetTypeController::class, 'destroy'])->name('pet_types.destroy');

    // Vista general de la lista de espera
    Route::get('/general-waiting-list', [AdoptionController::class, 'generalWaitingList'])->name('generalWaitingList');

    // Vista general de mascotas adoptadas
    Route::get('/adopted-pets', [AdoptionController::class, 'adoptedPets'])->name('adoptedPets');
    Route::get('/adopted-pet-details/{id}', [AdoptionController::class, 'adoptedPetDetails'])->name('adoptedPetDetails');

    // Exportar lista de mascotas adoptadas a Excel y PDF
    Route::get('/export-adopted-pets-excel', [AdoptionController::class, 'exportAdoptedPetsToExcel'])->name('exportAdoptedPetsToExcel');
    Route::get('/export-adopted-pets-pdf', [AdoptionController::class, 'exportAdoptedPetsToPdf'])->name('exportAdoptedPetsToPdf');
});

// Rutas accesibles para todos los visitantes
Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');

// Rutas accesibles solo para usuarios autenticados
Route::middleware('auth')->group(function () {
    // Dashboard y perfil
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD de mascotas (para cualquier usuario autenticado)
    Route::get('/pet/create', [PetController::class, 'create'])->name('pet.create');
    Route::post('/pet', [PetController::class, 'store'])->name('pet.store');
    Route::get('/pets/{pet}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::patch('/pets/{pet}', [PetController::class, 'update'])->name('pets.update');
    Route::delete('/pets/{pet}', [PetController::class, 'destroy'])->name('pets.destroy');

    // Rutas de adopción
    Route::post('/adopt/{petId}', [AdoptionController::class, 'adopt'])->name('adopt');
    Route::post('/finalize-adoption/{petId}', [AdoptionController::class, 'finalizeAdoption'])->name('finalizeAdoption');
    Route::post('/reject-adoption/{petId}', [AdoptionController::class, 'rejectAdoption'])->name('rejectAdoption');

    // Lista de espera individual
    Route::get('/waiting-list', [AdoptionController::class, 'waitingList'])->name('waitingList');

    // Registro de mascotas adoptadas del usuario
    Route::get('/my-adopted-pets', [AdoptionController::class, 'myAdoptedPets'])->name('myAdoptedPets');
    Route::get('/my-adopted-pet-details/{id}', [AdoptionController::class, 'myAdoptedPetDetails'])->name('myAdoptedPetDetails');
});

require __DIR__.'/auth.php';