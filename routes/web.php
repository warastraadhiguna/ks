<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\DashboardController;

Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('do-login', [LoginController::class, 'doLogin'])->name('doLogin');


// admin
Route::prefix('/admin')->middleware('auth')->group(
    function () {
        Route::get('/logout', [LoginController::class, "logout"]);
        Route::get('/dashboard', [DashboardController::class, "index"]);
        Route::get('/receipt/sale', [ReceiptController::class, "index"])->name('receipt.sale');

        Route::get('/receipt/detail-sale/{id}', [ReceiptController::class, "showDetailSale"]);
        Route::get('/receipt/return-sale/{id}', [ReceiptController::class, "showReturSale"]);
        Route::get('/receipt/sale-resume', [ReceiptController::class, "showSaleResume"]);
        Route::get('/receipt/sale-product-resume', [ReceiptController::class, "showProductSaleResume"])->name('receipt.sale.product.resume');
        Route::get('/receipt/purchasing', [ReceiptController::class, "showPurchasing"])->name('receipt.purchasing');
        Route::get('/receipt/detail-purchasing', [ReceiptController::class, "showDetailPurchasing"]);
        Route::get('/receipt/return-purchasing', [ReceiptController::class, "showReturnPurchasing"]);
        Route::get('/receipt/cicilan-purchasing', [ReceiptController::class, "showCicilanPurchasing"]);
        // Route::get('/stock/json', [StockController::class, 'data'])->name('stock.data');
        Route::get('/stock/detail', [StockController::class, "index"])->name('stock.detail');
        Route::get('/stock/total', [StockController::class, "showTotal"])->name('stock.total');

        Route::resource('/user', UserController::class)->middleware('checkRole:superadmin, admin');
    }
);
