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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [login::class, 'view'])->name('login');
    Route::get('/register', [register::class, 'view']);
    Route::get('/auth/redirect', [login::class, 'googleRedirect']);
    Route::get('/auth/google/callback', [login::class, 'loginGoogle']);
    Route::post('/login', [login::class, 'auth']);
    Route::post('/register', [register::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', AdminDashboard::class)->name('dashboard');
    Route::get('/admin/products', AdminProducts::class)->name('admin/products');
    Route::get('/admin/category', CreateCategories::class)->name('admin/categories');
    Route::get('/cart', Item::class);
    Route::get('/order', Order::class);
    Route::get('/transaction', Transaction::class)->name('admin/transactions');
    Route::get('/proses-apriori', ProsesApriori::class)->name('Proses-Apriori');
    Route::get('/product/{title}', Product::class)->name('product');
    Route::get('/logout', [login::class, 'logout']);
});










