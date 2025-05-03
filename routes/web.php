<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Residents Routes
    Route::resource('residents', ResidentController::class);
    
    // Schedules Routes
    Route::resource('schedules', ScheduleController::class);
    
    // Reports Routes - bisa diakses semua user yang login
    Route::resource('reports', ReportController::class);
    
});