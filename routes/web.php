<?php

use App\Http\Livewire\Sale;
use App\Http\Livewire\Index;
use App\Http\Livewire\Inventory;
use App\Http\Livewire\ListSale;
use App\Http\Livewire\ListProduct;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', Index::class);
    Route::get('products', ListProduct::class)->name('productos');
    Route::get('sale', Sale::class)->name('sale');
    Route::get('sales.report', ListSale::class)->name('sales.report');
    Route::get('product.iventory', Inventory::class)->name('product_iventory');
    /* Route::get('/dashboard', [PageController::class, 'index']);
    Route::get('product', function () {
        return view('product.product');
    })->name('producto');
    Route::get('sale', function () {
        return view('sales.sales');
    })->name('sale');*/
});
