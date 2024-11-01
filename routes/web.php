<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;


Route::GET('/',[AccountsController::class,'index'])->name("index");

Route::group(['prefix' => 'account'], function () {
    Route::GET('/login',[AccountsController::class,'login'])->name("login");
    Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
});
