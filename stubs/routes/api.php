<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Skyriver')->group(function (){

    // Authentication...
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('logout')->middleware('auth:api');

    // Refresh User Token
    Route::post('/refresh-user-token', 'LoginController@refreshUserToken');

    // Registration...
    Route::post('/register', 'RegisterController@register');

    // Profile Information...
    Route::get('/user/profile-information', 'ProfileController')->middleware('auth:api')->name('user.profile');

    // Password Reset...
    Route::post('/forgot-password', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/reset-password', 'ResetPasswordController@reset')->name('password.update');

    // Password Confirmation...
    Route::post('/confirm-password', 'ConfirmPasswordController@confirm');

    // Passwords...
    Route::put('/update-password', 'UpdatePasswordController')->middleware('auth:api');

    // Email Verification...
    Route::get('/verify-email/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
    Route::post('/email/verification-notification', 'VerificationController@send')->name('verification.send');
});
