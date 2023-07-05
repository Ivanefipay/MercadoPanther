<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


/* Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	Route::get('/GetAllUsers', 'getAllUsers');
	Route::get('/GetAnUser/{user}', 'getAnUser');
	Route::post('/CreateUser', 'createUser');
	Route::put('/UpdateUser/{user}', 'updateUser');
	Route::delete('/DeleteUser/{user}', 'deleteUser');

	Route::get('/GetAllSalesByUser/{user}', 'getAllSalesByUser');
	Route::get('/GetAllUserWithSales', 'getAllUserWithSales');

});

Route::group(['prefix' => 'Sales', 'controller' => SaleController::class], function () {
	Route::get('/GetAllSales', 'getAllSales');
	Route::post('/CreateSale', 'createSale');
});


Route::group(['prefix' => 'Products', 'controller' => ProductController::class], function () {
	Route::get('/GetAllProducts', 'getAllProducts');
	Route::post('/CreateProduct', 'createProduct');
	Route::put('/UpdateProduct', 'updateProduct');
});

Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function () {
	Route::get('/GetAllCategories', 'getAllCategories');
}); */



