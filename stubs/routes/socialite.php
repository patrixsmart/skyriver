<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Skyriver\Socialite\ProviderController;


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


// Social Authentication...
Route::get('login/{provider}', [ProviderController::class,'redirectToProvider']);
Route::get('login/{provider}/callback', [ProviderController::class,'handleProviderCallback']);
