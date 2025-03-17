<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\TopKeywordController;
use App\Http\Controllers\TopPageController;
use App\Http\Controllers\TopSessionPageController;
use Illuminate\Support\Facades\Route;

// Use the 'auth' middleware to restrict access
Route::middleware('auth')->group(function () {
    // Use ProjetController consistently
    Route::resource("/projets", ProjetController::class);
    Route::resource("/rapports", RapportController::class);
    Route::resource("/topKeywords", TopKeywordController::class);
    Route::resource('topSessionPages', TopSessionPageController::class);
    Route::resource('topPages', TopPageController::class);

    Route::get('/', [ProjetController::class, 'index'])->name('index');
    Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
    Route::get('/projets/{projet_id}/rapports', [ProjetController::class, 'viewRapports'])->name('projets.rapports');
    Route::get('rapport/{id_rapport}', [RapportController::class, 'show'])->name('rapport.show');
    Route::get('/rapports/{rapport}', [RapportController::class, 'show'])->name('rapports.show');

    Route::get('topKeywords/{topKeyword}/edit', [TopKeywordController::class, 'edit'])->name('topKeywords.edit');
    Route::delete('/topKeywords/{id}', [TopKeywordController::class, 'destroy'])->name('topKeywords.destroy');

    Route::get('rapport/pdf/{rapport_id}', [RapportController::class, 'pdf_rapport'])->name('rapport.pdf');

    Route::get('/rapport/{id}/charts', [ChartController::class, 'show'])->name('charts.show');
    Route::get('/chart-data/{rapport_id}', [ChartController::class, 'show'])->name('chart-data.show');
});

// This route handles registration and can be customized for restricted access if needed
require __DIR__ . '/auth.php';
