<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pages.auth.home');
})->name('home');

Route::get('/contact', function () {
    return view('pages.profile.contact-us');
})->name('contact-us');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'getLoginPage']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'getRegisterPage']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::post('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/wallet', [ProfileController::class, 'wallet'])->name('wallet');
        
        Route::post('/request-admin/{user}', [ProfileController::class, 'requestAdmin'])->name('request-admin');
    });

    Route::get('/affiliate/orders', [OrderController::class, 'userOrders'])->name('affiliate.orders');
    Route::delete('/affiliate/{order}', [OrderController::class, 'destroy'])->name('affiliate.orders.destroy');

    // Dashboard
    Route::get('/dashboard', [ProfileController::class, 'serveDashboard'])->name('dashboard');
    
    // Product Routes for Regular Users
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/search', [ProductController::class, 'search'])->name('search');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        
        // Product Image Routes
        Route::get('/images/default', [ProductController::class, 'default_img'])->name('images.default');
        Route::post('/images/store', [ProductImageController::class, 'store'])->name('images.store');
        Route::get('/image/{path}', [ProductImageController::class, 'show'])
            ->where('path', '.*')->name('images.show');
        Route::get('/thumbnail/{product}', [ProductImageController::class, 'thumbnail'])->name('thumbnail');
        Route::get('/second-img/{product}', [ProductImageController::class, 'secondImg'])->name('second-img');
        
        // Product Detail & Checkout
        Route::get('/{product}', [ProductController::class, 'show'])->name('product');
        Route::get('/{product}/checkout', [ProductController::class, 'checkout'])->name('product.checkout');
        Route::post('/{product}/checkout', [ProductController::class, 'processCheckout'])->name('product.checkout-process');
    });

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Product Management
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/{product}/update', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::delete('/images/{img}', [ProductImageController::class, 'destroy'])->name('images.destroy');
    });
    
    // Admin Order Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    });
    
    Route::prefix('order')->name('order.')->group(function () {
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
        
        // Order Status Management
        Route::put('/{order}/reject', [OrderController::class, 'rejectOrder'])->name('reject');
        Route::put('/{order}/accept', [OrderController::class, 'acceptOrder'])->name('accept');
        
        // Shipping Status Management
        Route::prefix('{order}/shipping')->name('shipping.')->group(function () {
            Route::put('/shipped', [OrderController::class, 'makeShipped'])->name('shipped');
            Route::put('/delivered', [OrderController::class, 'makeDelivered'])->name('delivered');
            Route::put('/cancel', [OrderController::class, 'cancelShipping'])->name('cancel');
        });
        
        // Payment Status Management
        Route::prefix('{order}/payment')->name('payment.')->group(function () {
            Route::put('/pay', [OrderController::class, 'makePayed'])->name('paid');
            Route::put('/cancel', [OrderController::class, 'makeUnPayed'])->name('unpaid');
        });
    });
    
    // Admin Panel Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Admin Request Management
        Route::prefix('requests')->name('requests.')->group(function () {
            Route::get('/', [AdminController::class, 'getAdminReqsPage'])->name('index');
            Route::post('/{user}/approve', [AdminController::class, 'approveAdminReq'])->name('approve');
            Route::delete('/{user}/reject', [AdminController::class, 'rejectAdminReq'])->name('reject');
        });
    });
    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminController::class, 'getUsersPage'])->name('index');
        Route::get('/deleted', [AdminController::class, 'getDeletedUsersPage'])->name('deleted');
        Route::get('/search', [AdminController::class, 'getSearchedPage'])->name('search');
        
        // Individual User Operations
        Route::prefix('{user}')->group(function () {
            Route::get('/edit', [AdminController::class, 'edit'])->name('edit');
            Route::put('/update', [AdminController::class, 'update'])->name('update');
            Route::patch('/verify', [AdminController::class, 'toggleVerification'])->name('verify');
            Route::delete('/', [AdminController::class, 'destroy'])->name('destroy');
            Route::post('/restore', [AdminController::class, 'restore'])->name('restore');
            Route::delete('/force', [AdminController::class, 'forceDelete'])->name('force-delete');
        });
    });

    // Shipping Management
    Route::resource('shipping', ShippingController::class);

});

/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return view('pages.error.error');
})->name('error');