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
    
    // Residents Routes - hanya admin dan ketua
    Route::middleware(['auth'])->group(function () {
        Route::resource('residents', ResidentController::class)->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin() && !auth()->user()->isKetua()) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    });
    
    // Schedules Routes - hanya admin dan ketua
    Route::middleware(['auth'])->group(function () {
        Route::resource('schedules', ScheduleController::class)->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin() && !auth()->user()->isKetua()) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    });
    
    // Reports Routes - bisa diakses semua user yang login
    Route::resource('reports', ReportController::class);
});