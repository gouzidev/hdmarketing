<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingController;

Route::get('/', function () {
    return view('home');
}) -> name("home");


Route::get('/notverified', function () {
    return view('notverified');
}) -> name("notverified");

Route::get('/contact', function () {
    return view('profile.contact-us');
}) -> name("contact-us");


Route::get('/login', [AuthController::class, 'getLoginPage']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'getRegisterPage']);

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'admin'])->group(function () 
{
    Route::prefix('products')->name('products.')->group( function () 
    {
        Route::get("/create", [ProductController::class, 'create'])->name('create');
        Route::post("/", [ProductController::class, 'store'])->name('store');
        Route::get("/{product}/edit", [ProductController::class, 'edit'])->name('product.edit');
        Route::put("/{product}/update", [ProductController::class, 'update'])->name('product.update');
        Route::delete("/{product}", [ProductController::class, 'destroy'])->name('product.destroy');
        Route::delete('products/images/{img}', [ProductImageController::class, 'destroy'])->name('images.destroy');


    });

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::put('/order/{order}/reject', [OrderController::class, 'rejectOrder'])->name('order.reject');
    Route::put('/order/{order}/accept', [OrderController::class, 'acceptOrder'])->name('order.accept');
    Route::put('/order/{order}/shipping/shipped', [OrderController::class, 'makeShipped'])->name('order.shipping.shipped');
    Route::put('/order/{order}/shipping/delivered', [OrderController::class, 'makeDelivered'])->name('order.shipping.delivered');
    Route::put('/order/{order}/payment/pay', [OrderController::class, 'makePayed'])->name('order.payment.paid');
    Route::put('/order/{order}/payment/cancel', [OrderController::class, 'makeUnPayed'])->name('order.payment.unpaid');
    Route::put('/order/{order}/shipping/cancel', [OrderController::class, 'cancelShipping'])->name('order.shipping.cancel');
    Route::delete('/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
});

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management Routes
    Route::get('/requests', [AdminController::class, 'getAdminReqsPage'])->name('requests');
    Route::post('/requests/{user}/approve', [AdminController::class, 'approveAdminReq'])->name('requests.approve');
    Route::delete('/requests/{user}/reject', [AdminController::class, 'rejectAdminReq'])->name('requests.reject');




    Route::resource('shipping', ShippingController::class);

    Route::prefix('users')->name('users.')->group(function () {
        // Active users
        Route::get('/', [AdminController::class, 'getUsersPage'])->name('index');
        // Deleted users
        Route::get('/deleted', [AdminController::class, 'getDeletedUsersPage'])->name('deleted');
        Route::get('/search', [AdminController::class, 'getSearchedPage'])->name('search');
        // User operations
        Route::prefix('{user}')->group(function () {
            // Edit user
            Route::get('/edit', [AdminController::class, 'getEditUserPage'])->name('edit');
            Route::put('/update', [AdminController::class, 'edit'])->name('update');
            
            // Verification
            Route::patch('/verify', [AdminController::class, 'toggleVerification'])->name('verify');
            
            // Soft delete
            Route::delete('/', [AdminController::class, 'destroy'])->name('destroy');
            
            // Restore
            Route::post('/restore', [AdminController::class, 'restore'])->name('restore');
            
            // Force delete
            Route::delete('/force', [AdminController::class, 'forceDelete'])->name('force-delete');
        });
    });
    
    // Products routes would go here
});

Route::middleware(['auth'])->group(function () {
    Route::get("/dashboard", [ProfileController::class, 'serveDashboard'])->name('dashboard'); 
    Route::post("/request-admin/{user}", [ProfileController::class, 'requestAdmin'])->name('request-admin'); 
    Route::get("/profile", [ProfileController::class, 'index'])->name('profile'); 
    Route::get("/wallet", [ProfileController::class, 'wallet'])->name('wallet'); 
    Route::post("/profile/edit", [ProfileController::class, 'edit'])->name('profile.edit'); 





    Route::get("/products", [ProductController::class, 'index'])->name('products.index');
    Route::get("/products/{product}", [ProductController::class, 'show'])->name('products.product');
    Route::get("/products/{product}/checkout", [ProductController::class, 'checkout'])->name('products.product.checkout');
    Route::post("/products/{product}/checkout", [ProductController::class, 'processCheckout'])->name('products.product.checkout-process');

    Route::get("/products/search", [ProductController::class, 'search'])->name('products.search');
    
    Route::get('products/images/default', [ProductController::class, 'default_img'])->name('products.images.default');
    Route::get('products/image/{path}', [ProductImageController::class, 'show'])
        ->where('path', '.*')->name('products.images.show');


    Route::delete('products/images/{id}', [ProductImageController::class, 'destroy'])->name('products.images.destroy');

    Route::get('products/thumbnail/{product}', [ProductImageController::class, 'thumbnail'])->name('products.thumbnail');
    Route::get('products/second-img/{product}', [ProductImageController::class, 'secondImg'])->name('products.second-img');

});
