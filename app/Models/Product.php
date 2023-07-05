<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Sale;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use HasFactory,SoftDeletes;

	protected $fillable = [
		'category_id',
		'name',
		'image',
		'value',
		'stock',
		'description',
	];


	public function Category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function Sales()
	{
		return $this->hasMany(Sale::class, 'product_id', 'id');
	}
}
