<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;

Route::get('/', function () {
    return view('admin.akademik.ref_semester');
});

Route::get('dashboard', [DashController::class, 'index'])->name('dashboard');
