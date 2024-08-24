<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\SitesController as AdminSitesController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\FarmersController as AdminFarmersController;
use App\Http\Controllers\Admin\YieldsController as AdminYieldsController;

use App\Http\Controllers\SiteManager\FarmersController as ManagerFarmersController;
use App\Http\Controllers\SiteManager\SitesController as ManagerSitesController;
use App\Http\Controllers\SiteManager\FarmsController as ManagerFarmsController;
use App\Http\Controllers\SiteManager\YieldsController as ManagerYieldsController;
use App\Http\Controllers\SiteManager\ReportsController as ManagerReportsController;

use App\Http\Controllers\Farmer\FarmsController as FarmerFarmsController;
use App\Http\Controllers\Farmer\YieldsController as FarmerYieldsController;
use App\Http\Controllers\Farmer\IncomesController as FarmerIncomesController;
use App\Http\Controllers\Farmer\ExpensesController as FarmerExpensesController;
use App\Http\Controllers\Farmer\ReportsController as FarmerReportsController;
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

    Route::controller(AdminYieldsController::class)->prefix('yields')->group(function () {
        Route::get('/', 'index');
        Route::get('/{yield}', 'show');
    });
});

//Site Manager Routes
Route::middleware('check.role:' . User::SITE_MANAGER . '')->prefix('manager')->group(function () {
    Route::prefix('reports')->controller(ManagerReportsController::class)->group(function () {
        // type is either incomes_expenses_report or products_report
        Route::get('/{type}', 'index');
    });
    Route::controller(ManagerFarmersController::class)->prefix('farmers')->group(function () {
        Route::post('/', 'store');
    });
    Route::prefix('sites')->group(function () {
        Route::controller(ManagerSitesController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/{siteId}/farms', 'show');
        });
        Route::controller(ManagerFarmsController::class)->group(function () {
            Route::prefix('{siteId}/farms')->group(function () {
                Route::prefix('{farmId}')->group(function () {
                    Route::get('/', 'show');
                    Route::put('/', 'update');
                });
            });
        });
    });

    Route::controller(ManagerYieldsController::class)->prefix('yields')->group(function () {
        Route::get('/', 'index');
        Route::get('/{yield}', 'show');
    });
});

//Farmer Routes
Route::middleware('check.role:' . User::FARMER . '')->prefix('farmer')->group(function () {
    Route::prefix('reports')->controller(FarmerReportsController::class)->group(function () {
        // type is either incomes_expenses_report or products_report
        Route::get('/{type}', 'index');
    });
    Route::prefix('farms')->group(function () {
        Route::controller(FarmerFarmsController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/', 'store');
        });
        Route::prefix('{farmId}')->group(function () {
            Route::prefix('yields')->group(function () {
                Route::controller(FarmerYieldsController::class)->group(function () {
                    Route::get('/', 'show');
                    Route::get('/create', 'create');
                    Route::post('/', 'store');
                    Route::put("/", 'update');
                    Route::prefix('{yieldId}')->group(function () {
                        Route::controller(FarmerIncomesController::class)->prefix('incomes')->group(function () {
                            Route::get('/', 'index');
                            Route::post('/', 'store');
                        });
                        Route::controller(FarmerExpensesController::class)->prefix('expenses')->group(function () {
                            Route::get('/', 'index');
                            Route::post('/', 'store');
                        });
                    });
                });
            });
        });
    });
});
