<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
	public function getAProduct(Product $product)
	{
		$product->load('category');
		return response()->json(['product' => $product], 200);
	}

	public function createProduct(Request $request)
	{
		$product = new Product($request->all());
		$this->uploadImages($request, $product);
		$product->save();
		return response()->json(['product' => $product->load('Category')], 201);
	}

	public function updateProduct(Product $product, Request $request)
	{
		$requestAll = $request->all();
		$this->uploadImages($request, $product);
		$requestAll['image'] = $product->image;
		$product->update($requestAll);
		return response()->json(['product' => $product->refresh()->load('Category')], 201);
	}

	public function deleteAProduct(Product $product)
	{
		$product->delete();
		return response()->json([], 204);
	}

	public function showProducts()
	{
		return view('products.index');

	}
	public function showProductsForCategory()
	{
		return view('productforcategory.index');

	}
	public function showHomeWithBooks()
	{
		$products = $this->getAllProducts()->original['product'];
		return view('home', compact('products'));
	}

	public function getAllProducts()
	{
		$product = product::with('Category')->where('stock', '!=','0')->get();
		return response()->json(['product' => $product], 200);
	}

	public function getAllProductsForCategory($product)
	{
		/* $users = User::with("Sales.Product")->has("Sales.Product")->where('id', 2)->get(); */
		$product = product::where('category_id', $product)->where('stock', '!=','0')->limit(5)->get();
		return response()->json(['product' => $product], 200);
	}
	public function getProductsForCategory($product)
	{
		/* $users = User::with("Sales.Product")->has("Sales.Product")->where('id', 2)->get(); */
		$product = product::where('category_id', $product)->where('stock', '!=','0')->get();
		return response()->json(['product' => $product], 200);
	}


	public function getAllProductsForDataTable()
	{
		$products = Product::with('Category');
		return DataTables::of($products)
		->addColumn('action', function ($row){
			return "<a
			href='#'
			onclick='event.preventDefault();'
			data-id='{$row->id}'
			role='edit'
			class=' btn btn-warning btn-sm'>Editar</a>
			<a
			href='#'
			onclick='event.preventDefault();'
			data-id='{$row->id}'
			role='delete'
			class=' btn btn-danger btn-sm'>Eliminar</a>
			";
		})
		->rawColumns(['action'])
		->make();
	}

	public function uploadImages($request, &$product){
		if(!isset($request->image)) return;
		$random = Str::random(20);
		$image_name = "{$random}.{$request->image->clientExtension()}";
		$request->image->move(storage_path('app/public/images'), $image_name);
		$product->image = $image_name;
	}
}
