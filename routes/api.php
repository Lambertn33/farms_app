<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\SitesController as AdminSitesController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\FarmersController as AdminFarmersController;

use App\Http\Controllers\SiteManager\FarmersController as ManagerFarmersController;
use App\Http\Controllers\SiteManager\SitesController as ManagerSitesController;

use App\Http\Controllers\Farmer\FarmsController as FarmerFarmsController;

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
        Route::put('/updatePassword', 'updatePassword');
    });

//Administrator Routes
Route::middleware('check.role:' . User::ADMIN . '')->prefix('admin')->group(function () {
    Route::controller(AdminUsersController::class)->prefix('users')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
    });
    Route::controller(AdminSitesController::class)->prefix('sites')->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');
    });

    Route::controller(AdminFarmersController::class)->prefix('farmers')->group(function () {
        Route::get('/', 'index');
        Route::get('/{farmerId}', 'show');
    });
});

//Site Manager Routes
Route::middleware('check.role:' . User::SITE_MANAGER . '')->prefix('manager')->group(function () {
    Route::controller(ManagerFarmersController::class)->prefix('farmers')->group(function () {
        Route::post('/', 'store');
    });
    Route::controller(ManagerSitesController::class)->prefix('sites')->group(function () {
        Route::get('/', 'index');
        Route::get('/{siteId}/farms', 'show');
    });
});
//Farmer Routes
Route::middleware('check.role:' . User::FARMER . '')->prefix('farmer')->group(function () {
    Route::controller(FarmerFarmsController::class)->prefix('farms')->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');
    });
});
