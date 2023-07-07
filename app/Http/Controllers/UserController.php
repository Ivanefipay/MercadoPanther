<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use PHPUnit\Event\TestSuite\Loaded;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
	public function showAllUsers()
	{
		return view('users.index');
	}
	public function showAllProducts()
	{
		return view('products.index');
	}
	public function showAllProductsForCategory()
	{
		return view('products.index');
	}
	public function getAllUsers()
	{
		$users = User::get();
		return response()->json(['users' => $users], 200);
	}
	public function getUsersAuth()
	{
		$id = Auth::id();
		return $id;
	}
	public function changeRol(User $user)
	{

		/* $rol = $user->role();
		dd($rol);
		if (!$rol == 'admin') $user->assignRole('admin');
		else $user->assignRole('user'); */
	}

	public function getAllRoles()
	{
		$roles = Role::all()->pluck('name');
		return response()->json(['roles' => $roles], 200);
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
	public function getAllUsersForDataTable()
	{
		$users = User::with('roles');
		return DataTables::of($users)
			->addColumn('action', function ($row) {
				return "<a
			href='#'
			onclick='event.preventDefault();'
			data-id='{$row->id}'
			role='edit'
			class=' btn btn-warning btn-sm'>Cambiar rol</a>
			";
			})
			->rawColumns(['action'])
			->make();
	}
}
