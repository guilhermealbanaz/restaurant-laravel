<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\QRCodeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotas públicas da API
Route::prefix('v1')->group(function () {
    // Categorias e pratos
    Route::get('/categories', [CategoryController::class, 'getActiveCategories']);
    Route::get('/dishes/featured', [DishController::class, 'getFeaturedDishes']);
    Route::get('/dishes/{dish}', [DishController::class, 'getDishDetails']);
    
    // QR Codes
    Route::get('/qrcode/validate/{code}', [QRCodeController::class, 'validateCode']);
    
    // Pedidos
    Route::post('/orders', [OrderController::class, 'createOrder']);
    Route::get('/orders/{order}', [OrderController::class, 'getOrderStatus']);
    
    // Avaliações
    Route::get('/dishes/{dish}/ratings', [RatingController::class, 'getDishRatings']);
    
    // Rotas protegidas com autenticação
    Route::middleware('auth:sanctum')->group(function () {
        // Avaliações do usuário autenticado
        Route::post('/ratings', [RatingController::class, 'storeRating']);
    });
}); 