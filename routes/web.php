<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController,ParentMenuController,RolesController,MenusController,AccessRoleController,TampildataController,KategoriController,DashController, RefSemesterController, AppchartController};

Route::get('dashboard', [DashController::class, 'index'])->name('dashboard');
Route::get('tarikdata', [TampildataController::class, 'tarikdata'])->name('tarikdata');
Route::get('/chartmhs', [TampildataController::class, 'mahasiswa'])->name('chart.mhs');
// Route::get('/chartmhs-angkatan', [TampildataController::class, 'mahasiswa_angkatan_index'])->name('chart.angkatan');
Route::get('/chartmhs-angkatan', [TampildataController::class, 'mahasiswa_angkatan'])->name('chart.mhs.angkatan');
Route::get('/chart-mahasiswa-filters', [TampildataController::class, 'getFilters']);
Route::get('semester', [RefSemesterController::class, 'index'])->name('semester.index');

Route::group(['middleware'=>['role:admin']], function () {
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

    Route::GET('/kategori',[KategoriController::class,'kategori'])->name('kategori');
    Route::POST('/crudKategori',[KategoriController::class,'crudKategori'])->name('crudKategori');
    Route::GET('/getKategori',[KategoriController::class,'getKategori'])->name('getKategori');

    Route::GET('/chart',[AppchartController::class,'Appchart'])->name('chart');
    Route::POST('/crudAppchart',[AppchartController::class,'crudAppchart'])->name('crudAppchart');
    Route::GET('/getAppchart',[AppchartController::class,'getAppchart'])->name('getAppchart');

    Route::GET('/chartview',[AppchartController::class,'viewChart'])->name('chartview');
});


Route::group([], function () {
    Route::GET('/login',[AccountsController::class,'login'])->name("login");
    Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
    Route::GET('/logout',[AccountsController::class,'logout'])->name("logout");
    Route::GET('/Y3JlYXRlYWt1bg',[AccountsController::class,'registration'])->name("registration");
    Route::POST('/Y3JlYXRlYWt1bgX',[AccountsController::class,'registrationAction'])->name("registrationAction");
});

Route::GET('/',[AccountsController::class,'index'])->name("index");
Route::GET('/dashboard',[AccountsController::class,'dashboard'])->name("dashboard");

