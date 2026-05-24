<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\DashboardController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\RevenueController;

use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderDetailController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.password');
});
require __DIR__ . '/auth.php';

Route::get('/dashboard', function (Request $request) {
    $user = $request->user();
    if (!$user) {
        return redirect()->route('login');
    }

    $isAdmin =
        (($user->role ?? null) === 'admin') ||
        (($user->is_admin ?? false) === true) ||
        (method_exists($user, 'isAdmin') && $user->isAdmin());

    if ($isAdmin) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('dashboard');

// User route
Route::middleware(['auth', 'userMiddleware'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::get('/products', [UserProductController::class, 'index'])->name('products.index');

        // Trang chi tiết sản phẩm
        Route::get('/products/{id}', [UserProductController::class, 'show'])->name('products.show');
        
        // Orders
        Route::get('/orders', [UserController::class, 'orders'])->name('orders.index');
        Route::get('/orders/{id}', [UserController::class, 'showOrder'])->name('orders.show');

        // Cart
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::put('/cart/{id}/update', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

        // Checkout
        Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('checkout.show');
        Route::post('/checkout/{id}', [CheckoutController::class, 'process'])->name('checkout.process');
    });


// Admin route 
Route::middleware(['auth', 'adminMiddleware'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Resource routes
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::get('/revenue', [RevenueController::class, 'index'])->name('revenue');
    });
