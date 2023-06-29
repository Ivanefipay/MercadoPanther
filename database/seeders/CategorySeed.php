<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
			'name' => 'Tecnología',
		]);
		DB::table('categories')->insert([
			'name' => 'Deportes',
		]);
		DB::table('categories')->insert([
			'name' => 'Hogar',
		]);
		DB::table('categories')->insert([
			'name' => 'Ropa',
		]);
		DB::table('categories')->insert([
			'name' => 'herramientas',
		]);
    }
}
