<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Skyriver')->group(function (){

    // Authentication...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Registration...
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    // Profile Information...
    Route::get('/user/profile-information', 'ProfileController')->middleware('auth:api')->name('user.profile');

    // Password Reset...
    Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('reset-password/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('reset-password', 'ResetPasswordController@reset')->name('password.update');

    // Password Confirmation...
    Route::get('/confirm-password', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('/confirm-password', 'ConfirmPasswordController@confirm');

    // Passwords...
    Route::put('/update-password', 'UpdatePasswordController')->middleware('auth');

    // Email Verification...
    Route::get('verify-email', 'VerificationController@show')->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
    Route::post('email/verification-notification', 'VerificationController@send')->name('verification.send');
});
