<?php


use App\Livewire\Home\HomeProduct;
use App\Livewire\Shop\Item;
use App\Http\Controllers\login;
use App\Http\Controllers\register;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AdminProducts;
use App\Livewire\Admin\CreateCategories;
use App\Livewire\Apriori\ProsesApriori;
use App\Livewire\Order\Index as Order;
use App\Livewire\Product\Product;
use App\Livewire\Transaction\Transaction;
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

Route::get('/admin', AdminDashboard::class)->middleware('auth')->name('dashboard');

Route::get('/admin/products', AdminProducts::class)->middleware('auth')->name('admin/products');

Route::get('/admin/category', CreateCategories::class)->middleware('auth')->name('admin/categories');

Route::get('/cart', Item::class)->middleware('auth');

Route::get('/order', Order::class)->middleware('auth');

Route::get('/transaction', Transaction::class)->middleware('auth')->name('admin/transactions');

Route::get('/login', [login::class, 'view'])->middleware('guest')->name('login');

Route::post('/login', [login::class, 'auth']);

Route::get('/register', [register::class, 'view'])->middleware('guest');

Route::post('/register', [register::class, 'store']);

Route::get('/logout', [login::class, 'logout']);

Route::get('/proses-apriori', ProsesApriori::class)->middleware('auth')->name('Proses-Apriori');

Route::get('/product/{title}', Product::class)->middleware('auth')->name('product');

Route::get('/auth/redirect', [login::class, 'googleRedirect'])->middleware('guest');

Route::get('/auth/google/callback', [login::class, 'loginGoogle'])->middleware('guest');

