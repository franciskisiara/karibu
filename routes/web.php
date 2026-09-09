<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OccupancyController;
use App\Http\Controllers\ResidenceController;
use App\Http\Controllers\ResidentialUnitController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:web', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('residences', ResidenceController::class)
        ->only(['index', 'store']);

    Route::group(['prefix' => 'residences/{residence}'], function () {
        Route::resource('residential-units', ResidentialUnitController::class)
            ->only(['index', 'store']);
    });

    Route::resource('occupancies', OccupancyController::class)
        ->only(['index', 'store']);

    Route::resource('visits', VisitController::class)
        ->only(['index', 'store', 'update']);
});

require __DIR__.'/auth.php';
