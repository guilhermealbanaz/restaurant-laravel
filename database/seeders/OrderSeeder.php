<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'table_number' => 'Mesa 1',
                'customer_name' => 'João Silva',
                'status' => Order::STATUS_DELIVERED,
                'total_amount' => 124.70,
                'notes' => 'Sem observações',
                'user_id' => 3, // Cliente João
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2)->addHours(1),
            ],
            [
                'table_number' => 'Mesa 3',
                'customer_name' => 'Maria Oliveira',
                'status' => Order::STATUS_DELIVERED,
                'total_amount' => 78.80,
                'notes' => 'Cliente com alergia a amendoim',
                'user_id' => 4, // Mria
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1)->addHours(1),
            ],
            [
                'table_number' => 'Mesa 2',
                'customer_name' => 'Pedro Santos',
                'status' => Order::STATUS_PREPARING,
                'total_amount' => 98.70,
                'notes' => null,
                'user_id' => 5, // predo
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'table_number' => 'Mesa 5',
                'customer_name' => 'Visitante',
                'status' => Order::STATUS_PENDING,
                'total_amount' => 59.80,
                'notes' => 'Mesa próxima à janela',
                'user_id' => null, // sem
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30),
            ],
            [
                'table_number' => 'Mesa 7',
                'customer_name' => 'Família Silva',
                'status' => Order::STATUS_READY,
                'total_amount' => 178.50,
                'notes' => 'Pedido com urgência',
                'user_id' => null, // sem user
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subMinutes(10),
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
} 