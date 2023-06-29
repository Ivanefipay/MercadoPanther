<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Event\TestSuite\Loaded;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    public function getAllUsers()
	{
		$users = User::get();
		return response()->json(['users' => $users], 200);
	}

	public function getAllUserWithSales()
	{
		$users = User::with("Sales.Product")->has("Sales.Product")->where('id', 2)->get();
		return response()->json(['users' => $users], 200);
	}

	public function getAllSalesByUser(User $user)
	{
		$sales = $user->load('Sales.Product.Category')->Sales;
		return response()->json(['sales' => $sales], 200);
	}

	public function getAnUser(User $user)
	{
		return response()->json(['user' => $user], 200);
	}

	public function createUser(CreateUserRequest $request)
	{
		/* dd($request); */
		$user = new User($request->all());
		$user->save();
		return response()->json(['user' => $user], 201);
	}

	public function updateUser(User $user, UpdateUserRequest $request)
	{
		$user->update($request->all());
		return response()->json(['user' => $user->refresh()], 201);
	}

	public function deleteUser(User $user)
	{
		$user->delete();
		return response()->json([], 204);
	}
}
