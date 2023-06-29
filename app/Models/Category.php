<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'name',
	];


	public function Products()
	{
		return $this->hasMany(Product::class, 'foreign_key', 'local_key');
	}
}
