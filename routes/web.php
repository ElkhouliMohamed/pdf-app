<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\TopKeywordController;
use App\Http\Controllers\TopSessionPageController;
use Illuminate\Support\Facades\Route;

// Use ProjetController consistently
Route::resource("/projets", ProjetController::class);
Route::resource("/rapports", RapportController::class);
Route::resource("/topKeywords", TopKeywordController::class);
Route::resource('topSessionPages', TopSessionPageController::class);

// Change ProjetsController to ProjetController
Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
Route::get('/projets/{projet_id}/rapports', [ProjetController::class, 'viewRapports'])->name('projets.rapports');
Route::get('rapport/{id_rapport}', [RapportController::class, 'show'])->name('rapport.show');
Route::get('/rapports/{rapport}', [RapportController::class, 'show'])->name('rapports.show');

Route::get('topKeywords/{topKeyword}/edit', [TopKeywordController::class, 'edit'])->name('topKeywords.edit');
Route::delete('/topKeywords/{id}', [TopKeywordController::class, 'destroy'])->name('topKeywords.destroy');

Route::get('rapport/pdf/{rapport_id}', [RapportController::class, 'pdf_rapport'])->name('rapport.pdf');



Route::get('/rapport/{id}/charts', [ChartController::class, 'show'])->name('charts.show');
Route::get('/chart-data/{rapport_id}', [ChartController::class, 'show'])->name('chart-data.show');

require __DIR__ . '/auth.php';

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
