<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
}) -> name("/home");

Route::get('/login', [AuthController::class, 'getLoginPage'])->name('/login');


Route::post('/login', [AuthController::class, 'login'])->name('/login');


Route::get('/register', [AuthController::class, 'getRegisterPage'])->name('/register');

Route::post('/register', [AuthController::class, 'register'])->name('/register');


Route::middleware(['auth'])->group(function () {
    Route::get("/dashboard", function () 
    {
        return view("dashboard");
    });
})