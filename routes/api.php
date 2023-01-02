<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
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

Route::middleware('api')->get('/login', function () {
    return abort(403);
});
Route::middleware('api')->post('/login', [UserAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/logout', function () {
        return abort(403);
    });
    Route::post('/logout', [UserAuthController::class, 'logout']);

    // Route::prefix('suppliers')->group(function () {
    //     // Route::get('/', [SupplierController::class, 'index']);
    //     // Route::get('/{id}', [SupplierController::class, 'show']);

    //CRUD DATA
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('warehouses', WarehouseController::class);
    Route::apiResource('sub-categories', SubCategoryController::class);
    Route::apiResource('units', UnitController::class);
    Route::apiResource('products/specs', SpecController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('users', UserController::class);

    Route::prefix('stats')->group(function () {
        Route::get('/count', [StatsController::class, 'count']);
    });

    // });
});
