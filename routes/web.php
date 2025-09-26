<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UsersController::class, 'home'])->name('home');


Route::get('/dashboard', [UsersController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/add_to_cart', [UsersController::class, 'addToCart'])->middleware(['auth', 'verified'])->name('add_to_cart');
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth', 'verified'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->middleware(['auth', 'verified'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->middleware(['auth', 'verified'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->middleware(['auth', 'verified'])->name('cart.remove');

// Checkout route
Route::get('/checkout', function () {
    return view('cart.checkout');
})->name('checkout');

// Order submission and payment flow
Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::get('/order/payment', [OrderController::class, 'paymentPage'])->name('orders.payment');
Route::post('/order/pay', [OrderController::class, 'processPayment'])->name('orders.pay');
// Buy Now (single product quick checkout)
Route::post('/buy/{id}', [OrderController::class, 'buyNow'])->name('orders.buy');
// Backwards-compatible (not used by new flow)
Route::post('/order', [OrderController::class, 'store'])->name('orders.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('deleteproducts/{id}', [AdminController::class, 'deleteproducts'])->name('admin.deleteproducts');
    Route::get('/product/{id}', [AdminController::class, 'viewProduct'])->name('product.view');
});
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Admin product routes
    Route::get('addproducts', [AdminController::class, 'addproducts'])->name('admin.addproducts');
    Route::post('addproducts', [AdminController::class, 'store'])->name('admin.postaddproducts');
    Route::get('viewproducts', [AdminController::class, 'viewproducts'])->name('admin.viewproducts');
    // Show edit form
    Route::get('updateproduct/{id}', [AdminController::class, 'updateproduct'])->name('admin.updateproduct');
    // Handle full update (post)
    Route::post('updateproduct/{id}', [AdminController::class, 'postupdateproduct'])->name('admin.postupdateproduct');
    // Update only category (PATCH)
    Route::patch('product/{id}/category', [AdminController::class, 'updateCategory'])->name('admin.updateproduct.category');
    Route::delete('deleteproducts/{id}', [AdminController::class, 'deleteproducts'])->name('admin.deleteproducts');

    // Admin category routes
    Route::get('addcategories', [AdminController::class, 'addcategories'])->name('admin.addcategories');
    Route::post('addcategories', [AdminController::class, 'postaddcategories'])->name('admin.postaddcategories');
    Route::get('viewcategories', [AdminController::class, 'viewcategories'])->name('admin.viewcategories');
    Route::delete('deletecategories/{id}', [AdminController::class, 'deletecategories'])->name('admin.deletecategories');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/orders', [AdminController::class, 'orderindex'])->name('admin.orders.index');
    Route::post('/admin/orders/{order}/receive', [AdminController::class, 'receive'])->name('admin.orders.receive');
    
});

require __DIR__.'/auth.php';
