<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 100; $i++) {
            $product = new Product();
            $product->product_name = $faker->sentence(3);
            $product->product_cost = $faker->randomFloat(2, 10, 100); 
            $product->prod_type_name = $faker->word;
            $product->release_date = $faker->date();
            $product->version_id = $faker->randomFloat( 1.0, 2.0, 3.0); 
            $product->product_description = $faker->paragraph();
            $product->available_colors = $faker->randomElement(['Red', 'Blue', 'Green', 'White']);
            $product->save();
        }
    }
}
