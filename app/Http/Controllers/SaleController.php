<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

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
}
