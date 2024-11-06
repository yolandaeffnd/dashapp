<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashController, RefSemesterController};

Route::get('/', function () {
    return view('components.app-home');
});

Route::get('dashboard', [DashController::class, 'index'])->name('dashboard');
Route::get('tarikdata', [DashController::class, 'tarikdata'])->name('tarikdata');
Route::get('semester', [RefSemesterController::class, 'index'])->name('semester.index');
