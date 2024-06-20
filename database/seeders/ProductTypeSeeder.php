<?php

namespace Database\Seeders;
use App\Models\ProductType;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 100; $i++) {
            $productType = new ProductType();
            $productType->product_type_name = $faker->word;
            $productType->product_type_code = $faker->randomNumber();
            $productType->is_active = $faker->randomElement([0, 1]);
            $productType->save();
        }
    }
}
