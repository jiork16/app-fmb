<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Index;
use App\Http\Livewire\ListProduct;
use App\Http\Livewire\Sale;

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
    Route::get('product', ListProduct::class)->name('producto');
    Route::get('sale', Sale::class)->name('sale');
    Route::get('listSale', ListProduct::class)->name('listSale');
    /* Route::get('/dashboard', [PageController::class, 'index']);
    Route::get('product', function () {
        return view('product.product');
    })->name('producto');
    Route::get('sale', function () {
        return view('sales.sales');
    })->name('sale');*/
});
