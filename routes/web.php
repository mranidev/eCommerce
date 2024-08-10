<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontProductListController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

// Route::get('/', 'FrontProductListController@index');
Route::get('/',                    [FrontProductListController::class, 'index']);
Route::get('/product/{id}',        [FrontProductListController::class, 'show'])->name('product.view');
Route::get('/orders',              [CartController::class, 'order'])->name('order')->middleware('auth');
Route::get('/checkout/{amount}',   [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::post('/charge',             [CartController::class, 'charge'])->name('cart.charge');
// Route::get('/category/{name}', 'FrontProductListController@allProduct')->name('product.list');
Route::get('/addToCart/{product}', [CartController::class, 'addToCart'])->name('add.cart');
Route::get('/cart',                [CartController::class, 'showCart'])->name('cart.show');

Route::post('/products/{product}', [CartController::class, 'updateCarte'])->name('cart.update');
Route::post('/product/{product}',  [CartController::class, 'removeCart'])->name('cart.remove');


// Auth::routes();

Route::get('all/products', [FrontProductListController::class, 'moreProducts'])->name('more.product');
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('subcatories/{id}', 'ProductController@loadSubCategories');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
