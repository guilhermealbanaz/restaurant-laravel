<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // oq ta comentado foi pq eu ja criei
        $this->call([
            // UserSeeder::class,
            // CategorySeeder::class,
            QRCodeSeeder::class,
        ]);

        // prato
        $this->call(DishSeeder::class);

        // pedido/ valiação
        $this->call([
            OrderSeeder::class,
            OrderItemSeeder::class,
            RatingSeeder::class,
        ]);
    }
}
