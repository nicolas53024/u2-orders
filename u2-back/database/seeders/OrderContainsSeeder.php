<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\order_product;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderContainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            for ($i = 0; $i < 10; $i++) {
                $product=Product::inRandomOrder()->first();
                order_product::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => random_int(1,20),
                ]);
            }
        }
    }
}
