<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\DesignSymbolController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::middleware(['auth:api'])->group(function () {
    Route::post('/navigation', [NavigationController::class, 'update']);
    Route::post('/design/symbols', [DesignSymbolController::class, 'store']);
    Route::post('/design/symbols/{id}', [DesignSymbolController::class, 'update']);
    Route::delete('/design/symbols/{id}', [DesignSymbolController::class, 'destroy']);
});

Route::post('/admin/login', [AuthController::class, 'login']);

Route::get('/design/symbols', [DesignSymbolController::class, 'index']);
Route::get('/design/symbols/{id}', [DesignSymbolController::class, 'show']);

Route::get('/navigation', [NavigationController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/design/symbols/image/{name}', function($name) {
   return response()->file(Storage::path('public/symbols/'.$name));
});

Route::get('/products/image/{name}', function($name) {
    return response()->file(Storage::path('public/products/'.$name));
});
