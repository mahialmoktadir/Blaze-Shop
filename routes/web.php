<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UsersController::class, 'home'])->name('home');


Route::get('/dashboard', [UsersController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
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

require __DIR__.'/auth.php';
