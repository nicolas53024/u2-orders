<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'barcode' => $this->faker->ean13,
            'price' =>  mt_rand(1000000000, 9999999999),
            'weithg' => random_int(100,2000),
            'stock' => random_int(0,120),
            'provider_id' => Provider::select('id')->inRandomOrder()->first(),
        ];
    }
}
