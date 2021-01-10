<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Skyriver\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication...
Route::get('login', [FrontendController::class,'__invoke'])->name('login');
Route::post('logout', [FrontendController::class,'__invoke'])->name('logout');

// Registration...
Route::get('register', [FrontendController::class,'__invoke'])->name('register');

// Password Confirmation...
Route::get('confirm-password', [FrontendController::class,'__invoke'])->name('password.confirm');

// Email Verification...
Route::get('verify-email', [FrontendController::class,'__invoke'])->name('verification.notice');
Route::get('verify-email/{id}/{hash}', [FrontendController::class,'__invoke'])->name('verification.verify');
Route::post('email/verification-notification', [FrontendController::class,'__invoke'])->name('verification.send');

// Forgot Password...
Route::get('forgot-password', [FrontendController::class,'__invoke'])->name('password.request');
Route::post('forgot-password', [FrontendController::class,'__invoke'])->name('password.email');

// Password Reset...
Route::get('reset-password/{token}', [FrontendController::class,'__invoke'])->name('password.reset');
Route::post('reset-password', [FrontendController::class,'__invoke'])->name('password.update');

Route::fallback([FrontendController::class,'__invoke'])->name('dashboard');
