<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\dashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::post('login', [loginController::class, 'Auth'])
// ->middleware("throttle:3,2")
;
Route::get('register', [registerController::class, 'index']);
Route::post('send', [registerController::class, 'register']);
Route::get('out', [loginController::class, 'out']);


Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', [dashboardController::class, 'dashboard']);
});

