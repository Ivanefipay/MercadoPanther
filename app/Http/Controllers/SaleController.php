<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function createSale( Request $request)
	{
		$sale = new Sale($request->all());
		$sale->save();
		return response()->json(['sale'=>$sale], 201);
	}
	public function getAllSales()
	{
		$sale = Sale::get();
		return response()->json(['sale' => $sale], 200);
	}
	public function showAllSales()
	{
		return view('sales.index');
	}
	public function getAllSaleForSale()
	{
		$id = Auth::id();
		$sale = Sale::with('Product')->where('user_id', $id)->get();
		return response()->json(['sale' => $sale], 200);
	}
	public function deleteAProductSale(Sale $product)
	{
		$product->delete();
		return response()->json([], 204);
	}
}
