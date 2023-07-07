<?php

use App\Models\Sale;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/test', function () {
	/* return Role::all()->pluck('name'); */
	/* $users = User::get();
	foreach($users as $user){
		if($user->number_id == 1093221111) $user->assignRole('admin');
		else $user->assignRole('user');
	} */
	/* Role::create(['name' => 'user']); */
});

Route::get('/', [ProductController::class, 'showHomeWithBooks']);
Route::get('/home', [ProductController::class, 'showHomeWithBooks']);


Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	Route::group(['middleware' => ['auth', 'role:admin']], function () {
		Route::get('/', 'showAllUsers')->name('users');
		Route::get('/GetAllUsers', 'getAllUsers');
		Route::get('/GetAnUser/{user}', 'getAnUser');
		Route::post('/CreateUser', 'createUser');
		Route::put('/UpdateUser/{user}', 'updateUser');
		Route::delete('/DeleteUser/{user}', 'deleteUser');

		Route::get('/GetAllSalesByUser/{user}', 'getAllSalesByUser');
		Route::get('/GetAllUserWithSales', 'getAllUserWithSales');
		Route::get('/GetAllUsersForDataTable', 'getAllUsersForDataTable');
	});
	Route::group(['middleware' => ['auth']], function () {
		Route::get('/GetUsersAuth', 'getUsersAuth');
	});
});

Route::group(['prefix' => 'Products', 'controller' => ProductController::class], function () {
	Route::get('/GetAllProducts', 'getAllProducts');
	Route::get('/GetAllProductsForCategory/{category_id}', 'getAllProductsForCategory');
	Route::get('/GetProductsForCategory/{category_id}', 'getProductsForCategory');
	Route::get('/GetAllProductsForDataTable', 'getAllProductsForDataTable');
	Route::get('/GetAProduct/{product}', 'getAProduct');
	Route::group(['middleware' => ['auth', 'role:admin']], function () {
		Route::get('/', 'showProducts')->name('products');
		Route::post('/CreateProduct', 'createProduct');
		Route::post('/UpdateProduct/{product}', 'updateProduct');
		Route::delete('/DeleteAProduct/{product}', 'deleteAProduct');
	});
});

Route::group(['prefix' => 'Sales', 'controller' => SaleController::class], function () {
	Route::post('/CreateSale', 'createSale');
	Route::get('/', 'showAllSales')->name('sales');
	Route::get('/GetAllSaleForSale', 'getAllSaleForSale');
	Route::delete('/DeleteAProductSale/{product}', 'deleteAProductSale');
});


Route::group(['prefix' => 'ProductsForCategory', 'controller' => ProductController::class], function () {
	Route::get('/', 'showProductsForCategory')->name('productsForCategory');
});
Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function () {
	Route::get('/GetAllCategories', 'getAllCategories');
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

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
