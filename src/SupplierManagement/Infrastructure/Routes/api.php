<?php

namespace Auth\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use SupplierManagement\Infrastructure\Controllers\SupplierController;

Route::post('/store',[SupplierController::class, 'store']);
//    ->middleware(['auth:sanctum', 'role:admin']);

Route::post('/{supplierId}/update',[SupplierController::class, 'update']);
//    ->middleware(['auth:sanctum', 'role:admin']);

Route::get('/get_all',[SupplierController::class, 'getAll']);
//    ->middleware(['auth:sanctum', 'role:admin']);

Route::get('/{supplierId}',[SupplierController::class, 'findById']);
//    ->middleware(['auth:sanctum', 'role:admin']);
