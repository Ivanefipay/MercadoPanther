<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Sale;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

	protected $table = 'users';

	protected $fillable = [
		'number_id',
		'name',
		'last_name',
		'email',
		'password',
	];

	protected $appends = ['full_name'];

	protected $hidden = [
		'password',
	];

	protected $casts = [
		'created_at' => 'datetime:y-m-d',
		'updated_at' => 'datetime:y-m-d',
	];


	//Accesor (get)
	public function getFullNameAttribute()
	{
		return "{$this->name} {$this->last_name}";
	}


	//mutador (create-update)
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}


	//relations
	public function Sales()
	{
		return $this->hasMany(Sale::class, 'user_id', 'id');
	}
}
