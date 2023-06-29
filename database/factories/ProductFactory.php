<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{

	protected $model = Product::class;

	/* public function userId($user)
	{
		return $this->state([
			'user_id' => $user->id,
		]);
	} */

    public function definition(): array
    {
        return [
			'category_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
			'name' => $this->faker->sentence(),
			'value' => $this->faker->randomNumber(6,true),
			'stock' => $this->faker->randomDigit(),
			'description' => $this->faker->paragraph()
        ];
    }
}
