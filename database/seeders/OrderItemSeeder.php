<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderItems = [
            // itens pedido 1 (João Silva)
            [
                'order_id' => 1,
                'dish_id' => 3, // picanha
                'quantity' => 1,
                'unit_price' => 59.90,
                'total_price' => 59.90,
                'notes' => 'ponto médio',
            ],
            [
                'order_id' => 1,
                'dish_id' => 1, // bruschetta
                'quantity' => 1,
                'unit_price' => 15.90,
                'total_price' => 15.90,
                'notes' => null,
            ],
            [
                'order_id' => 1,
                'dish_id' => 7,
                'quantity' => 1,
                'unit_price' => 15.90,
                'total_price' => 15.90,
                'notes' => null,
            ],
            [
                'order_id' => 1,
                'dish_id' => 9, // suco l
                'quantity' => 2,
                'unit_price' => 9.90,
                'total_price' => 19.80,
                'notes' => 'Um sem açúcar',
            ],
            [
                'order_id' => 1,
                'dish_id' => 10, // caipirossska
                'quantity' => 1,
                'unit_price' => 15.90,
                'total_price' => 15.90,
                'notes' => null,
            ],
            
            // itens pedido 2 (Maria Oliveira)
            [
                'order_id' => 2,
                'dish_id' => 4, // salmão
                'quantity' => 1,
                'unit_price' => 49.90,
                'total_price' => 49.90,
                'notes' => 'Sem manteiga',
            ],
            [
                'order_id' => 2,
                'dish_id' => 8, // mousse
                'quantity' => 1,
                'unit_price' => 18.90,
                'total_price' => 18.90,
                'notes' => null,
            ],
            [
                'order_id' => 2,
                'dish_id' => 9, // suco l
                'quantity' => 1,
                'unit_price' => 9.90,
                'total_price' => 9.90,
                'notes' => null,
            ],
            
            // Itens do pedido 3 (Pedro Santos)
            [
                'order_id' => 3,
                'dish_id' => 5, // espaguete
                'quantity' => 1,
                'unit_price' => 38.90,
                'total_price' => 38.90,
                'notes' => 'com bastante pimenta',
            ],
            [
                'order_id' => 3,
                'dish_id' => 2, // carpaccio
                'quantity' => 1,
                'unit_price' => 28.50,
                'total_price' => 28.50,
                'notes' => null,
            ],
            [
                'order_id' => 3,
                'dish_id' => 7, // pudim
                'quantity' => 1,
                'unit_price' => 15.90,
                'total_price' => 15.90,
                'notes' => null,
            ],
            [
                'order_id' => 3,
                'dish_id' => 10, // caipirosssketa
                'quantity' => 1,
                'unit_price' => 15.90,
                'total_price' => 15.90,
                'notes' => 'caprichar no limão',
            ],
            
            // iten pedido 4 visitante
            [
                'order_id' => 4,
                'dish_id' => 4, // salmão
                'quantity' => 1,
                'unit_price' => 49.90,
                'total_price' => 49.90,
                'notes' => null,
            ],
            [
                'order_id' => 4,
                'dish_id' => 9, // suco l
                'quantity' => 1,
                'unit_price' => 9.90,
                'total_price' => 9.90,
                'notes' => null,
            ],
            
            // itens pedido 5 (Família Silva)
            [
                'order_id' => 5,
                'dish_id' => 3, // picanha
                'quantity' => 2,
                'unit_price' => 59.90,
                'total_price' => 119.80,
                'notes' => 'uma ao ponto e outra bem passada',
            ],
            [
                'order_id' => 5,
                'dish_id' => 1, // bruschetta
                'quantity' => 1,
                'unit_price' => 15.90,
                'total_price' => 15.90,
                'notes' => null,
            ],
            [
                'order_id' => 5,
                'dish_id' => 7, // pudim
                'quantity' => 1,
                'unit_price' => 15.90,
                'total_price' => 15.90,
                'notes' => null,
            ],
            [
                'order_id' => 5,
                'dish_id' => 8,
                'quantity' => 1,
                'unit_price' => 18.90,
                'total_price' => 18.90,
                'notes' => null,
            ],
            [
                'order_id' => 5,
                'dish_id' => 9,
                'quantity' => 1,
                'unit_price' => 9.90,
                'total_price' => 9.90,
                'notes' => null,
            ],
        ];

        foreach ($orderItems as $item) {
            OrderItem::create($item);
        }
    }
} 