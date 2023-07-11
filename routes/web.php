<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReceptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::view('/', 'welcome');


Route::prefix('admin')->group(function () {
    Route::view('/', 'admin.login')->name('admin_login_page');
    Route::post('auth', [AdminController::class, 'auth'])->name('admin_login');
    //    Middleware for admin
    Route::middleware(['admin_auth'])->group(function () {
        Route::get('home', [AdminController::class, 'home'])->name('admin_home');
        Route::get('blocks', [AdminController::class, 'blocks'])->name('admin_blocks');
        Route::post('add-block', [AdminController::class, 'add_block'])->name('add_block');
        Route::post('add-ward', [AdminController::class, 'add_ward'])->name('add_ward');
        Route::get('wards', [AdminController::class, 'getWards'])->name('admin_wards');
        Route::get('wards_parms', [AdminController::class, 'getWardsWithParams'])->name('admin_wards_with_params');
        Route::get('logout-admin', [AdminController::class, 'logout'])->name('admin_logout');


        Route::get('all-receptions', [AdminController::class,'receptions'])->name('receptions');
        Route::get('all-nurses', [AdminController::class,'nurses'])->name('nurses');


        Route::get('doctors', [AdminController::class,'getDoctors'])->name('doctors');
        Route::post('add-doctor', [AdminController::class,'addDoctor'])->name('add_doctor');
        Route::get('doctor/{name?}', [AdminController::class,'getDoctor'])->name('doctor');
        Route::get('editDoctor/{name?}', [AdminController::class,'editDoctor'])->name('doctor_edit');


        Route::post('editDoctorkjhjhk', [AdminController::class,'getFace'])->name('getFace');
    });
});


Route::prefix('reception')->group(function () {
    Route::view('/', 'reception.login')->name('reception_login_page');
    Route::post('auth', [ReceptionController::class, 'auth'])->name('reception_login');
//    Middleware for reception
    Route::middleware(['reception_auth'])->group(function () {
        Route::get('home', [ReceptionController::class, 'reception_home'])->name('reception_home');
        Route::get('logout-reception', [ReceptionController::class, 'logout_reception'])->name('logout_reception');
        Route::get('show/{id?}', [ReceptionController::class, 'showWard'])->name('showWard');


        // Userlar bilan ishlash
        Route::get('get-users/{id?}', [ReceptionController::class, 'getUsers'])->name('reception_get_users');
        Route::get('search-users', [ReceptionController::class, 'searchUsers'])->name('reception_search_users');
        Route::get('get-all-doctors', [ReceptionController::class, 'getDoctors'])->name('reception_get_doctors');


        // Regionlar bilan ishlash
        Route::get('get-regions', [ReceptionController::class, 'getRegions'])->name('reception_get_regions');
        Route::get('get-districts/{id?}', [ReceptionController::class, 'getDistricts'])->name('reception_get_districts');
        Route::get('get-quarters/{id?}', [ReceptionController::class, 'getQuarters'])->name('reception_get_quarters');
    });
});










