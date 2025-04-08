<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\QRCodeController;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('menu')->group(function () {
    Route::get('/', function () {
        return view('menu.index');
    })->name('menu.index');
    
    Route::get('/table/{code}', function ($code) {
        $qrCode = App\Models\QrCode::where('code', $code)
            ->where('active', true)
            ->first();
            
        if (!$qrCode) {
            abort(404, 'QR Code inválido ou mesa não encontrada');
        }
        
        return view('menu.table', [
            'code' => $code,
            'tableNumber' => $qrCode->table_number
        ]);
    })->name('menu.table');
    
    Route::get('/dish/{dish}', function (App\Models\Dish $dish) {
        return view('menu.dish', compact('dish'));
    })->name('menu.dish');
    
    Route::post('/process-order', [App\Http\Controllers\OrderController::class, 'createOrder'])->name('menu.process-order');
});

Route::redirect('/admin/dashboard', '/admin');

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::resource('categories', CategoryController::class);
    
    Route::resource('dishes', DishController::class);
    
    // gerenciamento de pedidos
    Route::resource('orders', OrderController::class)->except(['edit', 'update']);
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
    // gerenciamento de avaliações
    Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');
    Route::delete('/ratings/{rating}', [RatingController::class, 'destroy'])->name('ratings.destroy');
    
    // gerenciamento de QR codes
    Route::resource('qrcodes', QRCodeController::class);
    // vou ter q achar oq ta sendo feito de errado na geração do qrcode
    Route::get('/qrcodes/{qrCode}/generate', [QRCodeController::class, 'generate'])->name('qrcodes.generate');
    Route::get('/qrcodes/{qrCode}/generate-base64', [QRCodeController::class, 'generateBase64'])->name('qrcodes.generate_base64');
    Route::get('/qrcodes/{qrCode}/print', [QRCodeController::class, 'print'])->name('qrcodes.print');
    
    // relatorios
    Route::get('/reports/sales', function () {
        return view('admin.reports.sales');
    })->name('reports.sales');
    
    Route::get('/reports/popular-dishes', function () {
        return view('admin.reports.popular_dishes');
    })->name('reports.popular_dishes');
});

// autenticação
require __DIR__.'/auth.php';
