<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\CertificateController;
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

// Route::post('login', [loginController::class, 'Auth'])->middleware("throttle:3,2");
Route::get('register', [registerController::class, 'index']);
Route::post('send', [registerController::class, 'register']);
Route::get('/', [loginController::class, 'index']);
Route::get('out', [loginController::class, 'out']);
Route::post('login', [loginController::class, 'Auth']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'dashboard'])->name('login');
    Route::get('/certificate', [CertificateController::class, 'index']);
    Route::get('/certificate/create', [CertificateController::class, 'create']);
    Route::post('/certificate/send', [CertificateController::class, 'send']);
    Route::get('/certificate/update/{id}', [CertificateController::class, 'getUpdate']);
    Route::post('/certificate/sendUpdate/{id}', [CertificateController::class, 'send']);
    Route::post('/certificate/delete/{id}', [CertificateController::class, 'delete']);
});
