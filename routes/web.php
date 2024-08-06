<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\SalesmanController;
use App\Http\Controllers\StorageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/salesman', [SalesmanController::class, 'index']);
Route::get('/storage', [StorageController::class, 'index']);
Route::get('/driver', [DriverController::class, 'index']);
