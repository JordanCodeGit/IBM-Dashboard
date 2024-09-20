<?php

use App\Http\Controllers\APISalesmanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\SalesmanController;
use App\Http\Controllers\SalesmanKPIController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

// Protected Web Routes
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/driver', [DriverController::class, 'index']);
    Route::get('/warehouse', [WarehouseController::class, 'index']);
    Route::get('/salesman', [SalesmanController::class, 'index']);
    Route::get('/salesman/daily', [SalesmanController::class, 'index']);
    Route::get('/salesman/monthly', [SalesmanController::class, 'index']);
    Route::get('/salesman/{id}', [SalesmanController::class, 'index']);
    Route::get('/salesman/{id}/daily', [SalesmanController::class, 'index']);
    Route::get('/salesman/{id}/monthly', [SalesmanController::class, 'index']);
    Route::get('/form/salesman-kpi', [SalesmanKPIController::class, 'index']);
    Route::post('/form/salesman-kpi', [SalesmanKPIController::class, 'save']);
    Route::get('/help', [MiscellaneousController::class, 'help']);
    Route::get('/settings', [SettingsController::class, 'index']);
    Route::get('/settings/reset', [SettingsController::class, 'resetSchema'])->name('reset.all');
    Route::get('/settings/delete/all', [SettingsController::class, 'deleteAll'])->name('delete.all');
    Route::get('/settings/get/spreadsheet', [SettingsController::class, 'fetchAll'])->name('get.spreadsheet');
    Route::get('/settings/delete/dashboard-url', [SettingsController::class, 'resetDashboardURL'])->name('reset.dashboard-url');
    Route::post('/settings/update/dashboard-url', [SettingsController::class, 'updateDashboardURL'])->name('update.dashboard-url');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // API Routes
    Route::get('/api/salesman/get', [APISalesmanController::class, 'get']);
    Route::get('/api/salesman/get/daily', [APISalesmanController::class, 'getDaily']);
    Route::get('/api/salesman/get/monthly', [APISalesmanController::class, 'getMonthly']);
    Route::get('/api/salesman/get/{id}', [APISalesmanController::class, 'getBySalesmanId']);
    Route::get('/api/salesman/get/{id}/daily', [APISalesmanController::class, 'getBySalesmanIdDaily']);
    Route::get('/api/salesman/get/{id}/monthly', [APISalesmanController::class, 'getBySalesmanIdMonthly']);

});

// Public Web Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

