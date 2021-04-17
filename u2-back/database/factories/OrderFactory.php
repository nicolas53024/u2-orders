<?php

namespace Database\Factories;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer' => $this->faker->name,
            'passport_number' => $this->faker->ein,
            'internal_id' => $this->faker->uuid,
            'delivery_at' => Carbon::now()->addDays(random_int(1,20)),
        ];
    }
}
