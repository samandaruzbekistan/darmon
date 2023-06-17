<?php

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

Route::view('/reception', 'reception.login')->name('reception_login_page');

Route::post('reception-auth', [ReceptionController::class, 'auth'])->name('reception_login');

Route::middleware(['reception_auth'])->group(function () {
    Route::view('/add', 'reception.login');
});
