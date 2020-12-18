<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Skyriver\RegistrationController;
use App\Http\Controllers\Skyriver\PasswordResetController;
use App\Http\Controllers\Skyriver\AuthenticationController;
use App\Http\Controllers\Skyriver\ForgotPasswordController;
use App\Http\Controllers\Skyriver\UpdatePasswordController;
use App\Http\Controllers\Skyriver\EmailVerificationController;
use App\Http\Controllers\Skyriver\Socialite\ProviderController;
use App\Http\Controllers\Skyriver\Passport\ClientTokenController;
use App\Http\Controllers\Skyriver\Passport\RevokeTokenController;
use App\Http\Controllers\Skyriver\PasswordConfirmationController;
use App\Http\Controllers\Skyriver\Passport\RefreshTokenController;
use App\Http\Controllers\Skyriver\Passport\PasswordTokenController;
use App\Http\Controllers\Skyriver\Passport\PersonalTokenController;


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

// Oauth Token Management...
Route::any('client-token',[ClientTokenController::class,'__invoke']);
Route::any('password-token',[PasswordTokenController::class,'__invoke']);
Route::any('personal-token',[PersonalTokenController::class,'__invoke']);
Route::any('refresh-token',[RefreshTokenController::class,'__invoke']);
Route::any('revoke-token',[RevokeTokenController::class,'__invoke']);

// Authentication...
Route::get('/user', [AuthenticationController::class, 'index']);
Route::post('login', [AuthenticationController::class, 'store']);
Route::post('logout', [AuthenticationController::class, 'logoutDevice'])->name('logout');

// Social Authentication...
Route::get('login/{provider}', [ProviderController::class,'redirectToProvider']);
Route::get('login/{provider}/callback', [ProviderController::class,'handleProviderCallback']);

// Registration...
Route::post('register', [RegistrationController::class,'store']);

// Password Confirmation...
Route::post('/confirm-password', [PasswordConfirmationController::class, 'store']);

// Email Verification...
Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])->name('verification.send');

// Forgot Password...
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');

// Password Reset...
Route::post('/reset-password', [PasswordResetController::class, 'store'])->name('password.update');

// Update Password...
Route::post('/update-password', [UpdatePasswordController::class,'store']);
