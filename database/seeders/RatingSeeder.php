<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = [
            // avaliações do joão
            [
                'dish_id' => 3, // picanha
                'user_id' => 3, // João Silva
                'rating' => 5,
                'comment' => 'Excelente prato! A picanha estava no ponto perfeito e o acompanhamento estava delicioso.',
                'created_at' => now()->subDays(2)->addHours(2),
            ],
            [
                'dish_id' => 1, // bruschetta
                'user_id' => 3, // João Silva
                'rating' => 4,
                'comment' => 'Muito boa entrada, tomates frescos e bem temperados.',
                'created_at' => now()->subDays(2)->addHours(2),
            ],
            [
                'dish_id' => 7, // pudim
                'user_id' => 3, // João Silva
                'rating' => 5,
                'comment' => 'Melhor pudim que já comi! Textura perfeita.',
                'created_at' => now()->subDays(2)->addHours(2),
            ],
            
            // Avaliações da Maria
            [
                'dish_id' => 4, // salmão
                'user_id' => 4, // Maria Oliveira
                'rating' => 4,
                'comment' => 'Salmão muito bem preparado, e os legumes estavam crocantes.',
                'created_at' => now()->subDays(1)->addHours(2),
            ],
            [
                'dish_id' => 8, // mousse
                'user_id' => 4, // Maria Oliveira
                'rating' => 3,
                'comment' => 'Boa mousse, mas um pouco doce demais para o meu gosto.',
                'created_at' => now()->subDays(1)->addHours(2),
            ],
            
            // Avaliações do Pedro
            [
                'dish_id' => 5, // espaguete
                'user_id' => 5, // Pedro Santos
                'rating' => 5,
                'comment' => 'Carbonara autêntica! Cremosa e com bastante bacon, do jeito que gosto.',
                'created_at' => now()->subHours(3),
            ],
            [
                'dish_id' => 2, // carpaccio
                'user_id' => 5, // Pedro Santos
                'rating' => 4,
                'comment' => 'Muito bom carpaccio, carne de qualidade e molho equilibrado.',
                'created_at' => now()->subHours(3),
            ],
            
            // Avaliações anônimas
            [
                'dish_id' => 3, // picanha
                'user_id' => null,
                'rating' => 5,
                'comment' => 'Prato tradicional brasileiro muito bem executado!',
                'created_at' => now()->subDays(5),
            ],
            [
                'dish_id' => 4, // salmão
                'user_id' => null,
                'rating' => 5,
                'comment' => 'O melhor salmão da cidade!',
                'created_at' => now()->subDays(4),
            ],
            [
                'dish_id' => 6, // ravioli
                'user_id' => null,
                'rating' => 4,
                'comment' => 'Massa fresca e recheio saboroso. Recomendo!',
                'created_at' => now()->subDays(3),
            ],
            [
                'dish_id' => 7, // pudim
                'user_id' => null,
                'rating' => 5,
                'comment' => 'Pudim perfeito, lisinho e com uma calda incrível!',
                'created_at' => now()->subDays(6),
            ],
        ];

        foreach ($ratings as $rating) {
            Rating::create($rating);
        }
    }
} 