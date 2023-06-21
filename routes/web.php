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
Route::prefix('admin')->group(function () {
    Route::view('/', 'admin.login')->name('admin_login_page');
    Route::post('auth', [AdminController::class, 'auth'])->name('admin_login');
    //    Middleware for admin
    Route::middleware(['admin_auth'])->group(function () {
        Route::get('home', [AdminController::class, 'home'])->name('admin_home');
        Route::get('blocks', [AdminController::class, 'blocks'])->name('admin_blocks');
        Route::post('add-block', [AdminController::class, 'add_block'])->name('add_block');
        Route::get('wards/{block_id}/{type}/{status}', [AdminController::class, 'getWards'])->name('admin_wards');
    });
});


Route::prefix('reception')->group(function () {
    Route::view('/', 'reception.login')->name('reception_login_page');
    Route::post('auth', [ReceptionController::class, 'auth'])->name('reception_login');
//    Middleware for reception
    Route::middleware(['reception_auth'])->group(function () {
        Route::get('home', [ReceptionController::class, 'reception_home'])->name('reception_home');
        Route::get('logout', [ReceptionController::class, 'logout_reception'])->name('logout_reception');
        Route::get('show/{id?}', [ReceptionController::class, 'showWard'])->name('showWard');
    });
});










