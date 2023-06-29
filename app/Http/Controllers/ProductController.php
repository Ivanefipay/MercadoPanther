<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct( Request $request)
	{
		$product = new Product($request->all());
		$product->save();
		return response()->json(['product'=>$product], 201);
	}
	public function getAllProducts()
	{
		$product = product::get();
		return response()->json(['sale' => $product], 200);
	}
}
