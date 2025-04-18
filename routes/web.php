<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('home');
}) -> name("home");

Route::get('/login', [AuthController::class, 'getLoginPage']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'getRegisterPage']);

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





Route::middleware(['auth'])->group(function () {
    Route::get("/dashboard", [ProfileController::class, 'serveDashboard'])->name('dashboard'); 
    Route::post("/request-admin/{user}", [ProfileController::class, 'requestAdmin'])->name('request-admin'); 
    Route::get("/profile", [ProfileController::class, 'index'])->name('profile'); 
    Route::post("/profile/edit", [ProfileController::class, 'edit'])->name('profile.edit'); 
});


Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management Routes
    Route::get('/admin-requests', [AdminController::class, 'getAdminReqsPage'])->name('admin-requests');
    Route::post('/admin-requests/{user}/approve', [AdminController::class, 'approveAdminReq'])->name('requests.approve');
    Route::delete('/admin-requests/{user}/reject', [AdminController::class, 'rejectAdminReq'])->name('requests.reject');
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
    Route::get('/products', [AdminController::class, 'getProductsPage'])->name('products');
});
