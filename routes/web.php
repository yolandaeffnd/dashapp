<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashController, RefSemesterController};
use App\Http\Controllers\{AccountsController,ParentMenuController,RolesController,MenusController,AccessRoleController};
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('components.app-home');
});

Route::get('dashboard', [DashController::class, 'index'])->name('dashboard');
Route::get('tarikdata', [DashController::class, 'tarikdata'])->name('tarikdata');
Route::get('semester', [RefSemesterController::class, 'index'])->name('semester.index');


Route::GET('/parent_menu',[ParentMenuController::class,'parent_menu'])->name('parent_menu');
Route::POST('/crudParentMenu',[ParentMenuController::class,'crudParentMenu'])->name('crudParentMenu');
Route::GET('/getParentMenu',[ParentMenuController::class,'getParentMenu'])->name("getParentMenu");

Route::GET('/menu',[MenusController::class,'menu'])->name('menu');
Route::POST('/crudMenu',[MenusController::class,'crudMenu'])->name('crudMenu');
Route::GET('/getMenu',[MenusController::class,'getMenu'])->name("getMenu");

Route::GET('/role',[RolesController::class,'role'])->name("role");
Route::POST('/crudRole',[RolesController::class,'crudRole'])->name('crudRole');
Route::GET('/getRole',[RolesController::class,'getRole'])->name("getRole");

Route::GET('/access_role',[AccessRoleController::class,'access_role'])->name('access_role');
Route::POST('/crudAccessRole',[AccessRoleController::class,'crudAccessRole'])->name('crudAccessRole');
Route::GET('/getAccessRole',[AccessRoleController::class,'getAccessRole'])->name('getAccessRole');

Route::GET('/',[AccountsController::class,'index'])->name("index");


Route::GET('/login',[AccountsController::class,'login'])->name("login");
Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::GET('/login',[AccountsController::class,'login'])->name("login");
Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
Route::GET('/logout',[AccountsController::class,'logout'])->name("logout");
