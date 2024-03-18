<?php

use App\Livewire\Product\Admin;
use App\Livewire\Product\HomeProduct;
use App\Livewire\Shop\Checkout;
use App\Livewire\Shop\Item;
use App\Http\Controllers\login;
use App\Http\Controllers\register;
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


Route::get('/', HomeProduct::class)->middleware('auth')->name('home');

Route::get('/admin/products', Admin::class)->middleware('auth');

Route::get('/shop-item', Item::class)->middleware('auth');

Route::get('/checkout/{user}', Checkout::class)->middleware('auth');

Route::get('/login', [login::class, 'view'])->middleware('guest')->name('login');

Route::post('/login', [login::class, 'auth']);

Route::get('/register', [register::class, 'view'])->middleware('guest');

Route::post('/register', [register::class, 'store']);

Route::get('/logout', [login::class, 'logout']);

