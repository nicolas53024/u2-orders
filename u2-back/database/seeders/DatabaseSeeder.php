<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // UserSeeder::class,
            // \App\Models\Provider::factory(10)->create(),
            // \App\Models\Order::factory(15)->create(),
            // \App\Models\Product::factory(150)->create(),
            OrderContainsSeeder::class,
        ]);
    }
}
