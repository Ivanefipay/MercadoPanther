<?php

use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
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


