<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Product;

class UserFactory extends Factory
{
	protected $model = User::class;

    public function definition(): array
    {
        return [
            'number_id' => $this->faker->randomNumber(9,true),
            'name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt(123456789),
        ];
    }

	public function configure()
	{
		return $this->afterCreating(function (User $user){
			Product::factory(5)->create();
		});
		/* return $this->afterCreating(function (User $user){
			Product::factory(5)->userId($user)->create();
		}); */
	}

}
