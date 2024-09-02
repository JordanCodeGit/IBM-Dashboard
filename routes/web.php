<?php

use App\Http\Controllers\APISalesmanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\SalesmanController;
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
    Route::get('/help', [MiscellaneousController::class, 'help']);
    Route::get('/settings', [MiscellaneousController::class, 'settings']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // API Routes
    Route::get('/api/salesman/get', [APISalesmanController::class, 'get']);
    Route::get('/api/salesman/get/daily', [APISalesmanController::class, 'getDaily']);
    Route::get('/api/salesman/get/monthly', [APISalesmanController::class, 'getMonthly']);
    Route::get('/api/salesman/get/{id}', [APISalesmanController::class, 'getBySalesmanId']);
    Route::get('/api/salesman/get/{id}/daily', [APISalesmanController::class, 'getBySalesmanIdDaily']);
    Route::get('/api/salesman/get/{id}/monthly', [APISalesmanController::class, 'getBySalesmanIdMonthly']);

    // Debug Routes
    Route::get('/setup/fetch', [DebugController::class, 'fetchAll'])->name('debug.fetch');
    Route::get('/setup/delete', [DebugController::class, 'deleteAll'])->name('debug.delete');
    Route::get('/setup/reset', [DebugController::class, 'resetSchema'])->name('debug.reset');
});

// Public Web Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

