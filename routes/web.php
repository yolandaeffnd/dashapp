<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashController, RefSemesterController};
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('components.app-home');
});

Route::get('dashboard', [DashController::class, 'index'])->name('dashboard');
Route::get('tarikdata', [DashController::class, 'tarikdata'])->name('tarikdata');
Route::get('semester', [RefSemesterController::class, 'index'])->name('semester.index');



Route::GET('/',[AccountsController::class,'index'])->name("index");


    Route::GET('/login',[AccountsController::class,'login'])->name("login");
    Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
    Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::GET('/login',[AccountsController::class,'login'])->name("login");
Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
Route::GET('/logout',[AccountsController::class,'logout'])->name("logout");
