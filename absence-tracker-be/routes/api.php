<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenceController;
use App\Http\Middleware\CheckAbsenceRestrictions;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AbsenceTypesController;

Route::middleware('api')->group(function () {
    Route::get('/absences', [AbsenceController::class, 'index']);
    Route::post('/absences', [AbsenceController::class, 'store'])->middleware(CheckAbsenceRestrictions::class);
    Route::get('/absences/{id}', [AbsenceController::class, 'show']);
    Route::put('/absences/{id}', [AbsenceController::class, 'update']);
    Route::delete('/absences/{id}', [AbsenceController::class, 'destroy']);
    Route::post('/absences/archive', [AbsenceController::class, 'archive']);
    Route::get('/archive', [ArchiveController::class, 'index']);
    Route::get('/absence-types', [AbsenceTypesController::class, 'index']);
});
