<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

