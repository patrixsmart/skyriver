<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Skyriver\Passport\CallbackController;
use App\Http\Controllers\Skyriver\Passport\RedirectController;
use App\Http\Controllers\Skyriver\Passport\ClientTokenController;
use App\Http\Controllers\Skyriver\Passport\RevokeTokenController;
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

// Oauth Redirect...
Route::get('auth/redirect',[RedirectController::class,'__invoke']);
Route::get('auth/callback',[CallbackController::class,'__invoke']);

// Oauth Token Management...
Route::any('client-token',[ClientTokenController::class,'__invoke']);
Route::any('password-token',[PasswordTokenController::class,'__invoke']);
Route::any('personal-token',[PersonalTokenController::class,'__invoke']);
Route::any('refresh-token',[RefreshTokenController::class,'__invoke']);
Route::any('revoke-token',[RevokeTokenController::class,'__invoke']);
