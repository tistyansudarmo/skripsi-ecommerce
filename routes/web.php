<?php

use App\Livewire\Product\Admin;
use App\Livewire\Product\HomeProduct;
use App\Livewire\Shop\Checkout;
use App\Livewire\Shop\Item;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', HomeProduct::class)->name('home');

Route::get('/admin/products', Admin::class);

Route::get('/shop-item', Item::class);

Route::get('/checkout', Checkout::class);





