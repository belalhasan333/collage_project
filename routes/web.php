<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

// Buyer
use App\Http\Controllers\Buyer\BookController as BuyerBookController;

// Admin
use App\Http\Controllers\Admin\BookController as AdminBookController;

// Seller
use App\Http\Controllers\Seller\BookController as SellerBookController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

// Fixed route order: show should be after edit
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
});

/*
|--------------------------------------------------------------------------
| Buyer Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::post('/cart/remove/{book}', [CartController::class, 'remove'])->name('cart.remove');
});

/*
|--------------------------------------------------------------------------
| Buyer Book Routes
|--------------------------------------------------------------------------
*/
Route::get('/books', [BuyerBookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BuyerBookController::class, 'show'])->name('books.show');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/admin/books', AdminBookController::class)->names('admin.books');
});

/*
|--------------------------------------------------------------------------
| Seller Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::resource('/seller/books', SellerBookController::class);
});


require __DIR__.'/auth.php';
