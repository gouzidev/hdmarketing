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
    Route::get("/dashboard", function () 
    {
        return view("dashboard");
    })->name('dashboard'); 
    Route::get("/profile", [ProfileController::class, 'index'])->name('profile'); 
    Route::post("/profile/edit", [ProfileController::class, 'edit'])->name('profile.edit'); 
});



// Route::middleware(['admin'])->prefix('admin')->group(function () {
//     // List all users
//     Route::get('/users', [AdminController::class, 'getUsersPage'])->name('admin.users');
//     Route::get('/admin/deleted-users', [AdminController::class, 'getDeletedUsersPage'])->name('admin.users.deleted');
        

//     Route::get('/deleted-users', [AdminController::class, 'getDeletedUsersPage'])->name('admin.deleted-users');
//     // User operations
//     Route::prefix('user/{user}')->group(function () {
//         // Restore user
//         Route::post('/restore', [AdminController::class, 'restore'])->name('admin.users.restore');
//         // Permanent delete
//         Route::delete('/force-delete', [AdminController::class, 'forceDelete'])->name('admin.users.force-delete');
//         // Delete user
//         Route::delete('/', [AdminController::class, 'destroy'])->name('admin.users.destroy');
//         // Edit user page
//         Route::get('/edit', [AdminController::class, 'getEditUserPage']);
//         Route::put('/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        
//         // Toggle verification
//         Route::patch('/verify', [AdminController::class, 'toggleVerification'])->name('admin.users.verify');
//     });
// });


Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management Routes
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
