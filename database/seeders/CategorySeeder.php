<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Entradas',
                'description' => 'Pratos perfeitos para iniciar sua refeição',
                'active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Pratos Principais',
                'description' => 'Nossas especialidades para sua refeição principal',
                'active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Massas',
                'description' => 'Massas frescas e saborosas',
                'active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Sobremesas',
                'description' => 'Doces e sobremesas para finalizar sua refeição',
                'active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Refrigerantes, sucos e bebidas alcoólicas',
                'active' => true,
                'order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 