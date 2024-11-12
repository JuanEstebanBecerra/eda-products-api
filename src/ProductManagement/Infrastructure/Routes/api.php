<?php

namespace Auth\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use ProductManagement\Infrastructure\Controllers\ProductController;

Route::post('/store', [ProductController::class, 'store']);
//    ->middleware(['auth:sanctum', 'role:admin']);
Route::put('/{productId}/update', [ProductController::class, 'update']);
//    ->middleware(['auth:sanctum', 'role:admin']);
Route::get('/get_all', [ProductController::class, 'getAll']);
//    ->middleware(['auth:sanctum', 'role:admin']);
Route::get('/{productId}', [ProductController::class, 'findById']);
//    ->middleware(['auth:sanctum', 'role:admin']);
