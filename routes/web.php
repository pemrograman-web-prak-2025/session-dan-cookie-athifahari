<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\CareScheduleController;
use App\Http\Controllers\CareLogController;
use Illuminate\Support\Facades\Route;

// Redirect root URL ke login
Route::get('/', function () {
    return redirect('/login');
});

// Plants Routes - Resource
Route::resource('plants', PlantController::class)->middleware('auth');

// Care Schedules Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/care-schedules/create', [CareScheduleController::class, 'create'])->name('care-schedules.create');
    Route::post('/care-schedules', [CareScheduleController::class, 'store'])->name('care-schedules.store');
    Route::get('/care-schedules/{careSchedule}/edit', [CareScheduleController::class, 'edit'])->name('care-schedules.edit');
    Route::put('/care-schedules/{careSchedule}', [CareScheduleController::class, 'update'])->name('care-schedules.update');
    Route::delete('/care-schedules/{careSchedule}', [CareScheduleController::class, 'destroy'])->name('care-schedules.destroy');
    
    // Care Logs Routes
    Route::get('/care-logs/create', [CareLogController::class, 'create'])->name('care-logs.create');
    Route::post('/care-logs', [CareLogController::class, 'store'])->name('care-logs.store');
});

// Breeze auth routes
require __DIR__.'/auth.php';