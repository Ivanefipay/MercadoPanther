<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
	use HasFactory,SoftDeletes;
	protected $fillable = [
		'user_id',
		'product_id',
		'date',
	];

	public function Product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}
	public function User()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
