<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;


Route::GET('/',[AccountsController::class,'index'])->name("index");


Route::GET('/login',[AccountsController::class,'login'])->name("login");
Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
Route::GET('/logout',[AccountsController::class,'logout'])->name("logout");