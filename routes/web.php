<?php

use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RapportController;
use Illuminate\Support\Facades\Route;

// Use ProjetController consistently
Route::resource("/projets", ProjetController::class);
Route::resource("/rapports", RapportController::class);


// Change ProjetsController to ProjetController
Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
Route::get('/projets/{projet_id}/rapports', [ProjetController::class, 'viewRapports'])->name('projets.rapports');
Route::get('rapport/{id_rapport}', [RapportController::class, 'show'])->name('rapport.show');

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
