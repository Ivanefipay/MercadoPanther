<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function createProduct(Request $request)
	{
		$product = new Product($request->all());
		$product->save();
		return response()->json(['product' => $product], 201);
	}

	public function showProducts()
	{
		return view('products.index');

	}
	public function showHomeWithBooks()
	{
		$products = $this->getAllProducts()->original['product'];
		return view('home', compact('products'));
	}

	public function getAllProducts()
	{
		$product = product::with('Category')->get();
		return response()->json(['product' => $product], 200);
	}
}
