<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register/customer', [CustomAuthController::class, 'showCustomerRegisterForm'])->name('register.customer');
Route::post('/register/customer', [CustomAuthController::class, 'registerCustomer']);

Route::get('/register/admin', [CustomAuthController::class, 'showAdminRegisterForm'])->name('register.admin');
Route::post('/register/admin', [CustomAuthController::class, 'registerAdmin']);

Route::get('/verify-email', [CustomAuthController::class, 'showVerificationForm'])->name('verify.email');
Route::post('/verify-email', [CustomAuthController::class, 'verifyEmail']);

Route::get('/admin/login', [CustomAuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [CustomAuthController::class, 'adminLogin']);