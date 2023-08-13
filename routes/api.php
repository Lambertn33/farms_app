<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Models\User;

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
// Authentication Routes
Route::controller(AuthController::class)
    ->prefix('auth')
    ->middleware('api')
    ->group(function () {
        Route::post('/login', 'login');
        Route::post('/logout', 'logout');
    });

//Administrator Routes
Route::middleware('check.role:' . User::ADMIN . '')->group(function () {
    Route::controller(UsersController::class)->prefix('users')->group(function () {
        Route::post('/', 'store');
    });
});

//Site Manager Routes
Route::middleware('check.role:' . User::SITE_MANAGER . '')->group(function () {
});
//Farmer Routes
Route::middleware('check.role:' . User::FARMER . '')->group(function () {
});
