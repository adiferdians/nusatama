<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'dashboard'])->name('login');
    Route::get('/certificate', [CertificateController::class, 'index']);
    Route::get('/certificate/create', [CertificateController::class, 'create']);
    Route::post('/certificate/send', [CertificateController::class, 'send']);
    Route::post('/certificate/Update/{id}', [CertificateController::class, 'getUpdate']);
    Route::post('/certificate/delete/{id}', [CertificateController::class, 'delete']);
});