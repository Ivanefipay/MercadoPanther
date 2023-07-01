<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Product;

Route::get('/', [ProductController::class, 'showHomeWithBooks']);

Route::group(['controller' => ProductController::class], function () {
	Route::get('login', 'showProducts')->name('products');
});
Route::group(['controller' => LoginController::class], function () {
	// Login Routes...
	Route::get('login', 'showLoginForm')->name('login');
	Route::post('login', 'login');
	// Logout Routes...
	Route::post('logout', 'logout')->name('logout');
});

Route::group(['controller' => ForgotPasswordController::class], function () {
	// Password Reset Routes...
	Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'sendResetLinkEmail')->name('password.email');
});

Route::group(['controller' => ResetPasswordController::class], function () {
	// Password Reset Routes...
	Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
	Route::post('password/reset', 'reset')->name('password.update');
});

Route::group(['controller' => ConfirmPasswordController::class], function () {
	// Password Confirmation Routes...
	Route::get('password/confirm', 'showConfirmForm')->name('password.confirm');
	Route::post('password/confirm', 'confirm');
});
Route::group(['controller' => VerificationController::class], function () {
	// Email Verification Routes...
	Route::get('email/verify', 'show')->name('verification.notice');
	Route::get('email/verify/{id}/{hash}', 'verify')->name('verification.verify');
	Route::post('email/resend', 'resend')->name('verification.resend');
});

Route::group(['controller' => RegisterController::class], function () {
	// Registration Routes...
	Route::get('register', 'showRegistrationForm')->name('register');
	Route::post('register', 'register');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
