<?php

use App\Http\Controllers\Admin\SitesController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SiteManager\FarmersController;
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
        Route::get('/', 'index');
        Route::post('/', 'store');
    });
    Route::controller(SitesController::class)->prefix('sites')->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');
    });
});

//Site Manager Routes
Route::middleware('check.role:' . User::SITE_MANAGER . '')->group(function () {
    Route::controller(FarmersController::class)->prefix('farmers')->group(function () {
        Route::post('/', 'store');
    });
});
//Farmer Routes
Route::middleware('check.role:' . User::FARMER . '')->group(function () {
});
