<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\WarehouseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [UserAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [UserAuthController::class, 'logout']);

    // Route::prefix('suppliers')->group(function () {
    //     // Route::get('/', [SupplierController::class, 'index']);
    //     // Route::get('/{id}', [SupplierController::class, 'show']);

    //CRUD DATA
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('warehouses', WarehouseController::class);

    // });
});
