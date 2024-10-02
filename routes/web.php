<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MerchantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuController;

Route::middleware(['auth'])->group(function () {
    Route::resource('merchants', MerchantController::class);
    
    Route::resource('customers', CustomerController::class);

    Route::resource('orders', OrderController::class);

    Route::resource('invoices', InvoiceController::class);
    
    Route::resource('menus', MenuController::class);
});

Route::get('/', function () {
    return view('welcome');
});
