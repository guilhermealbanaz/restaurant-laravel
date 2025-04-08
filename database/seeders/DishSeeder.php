<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = [
            // entradas categoria 1
            [
                'name' => 'Bruschetta de Tomate',
                'description' => 'Torrada de pão italiano com tomate, manjericão e azeite',
                'price' => 15.90,
                'ingredients' => 'Pão italiano, tomate, manjericão, alho, azeite, sal',
                'is_vegetarian' => true,
                'is_vegan' => true,
                'is_gluten_free' => false,
                'available' => true,
                'featured' => true,
                'preparation_time' => 10,
                'category_id' => 1,
            ],
            [
                'name' => 'Carpaccio',
                'description' => 'Finas fatias de carne crua com molho especial e alcaparras',
                'price' => 28.50,
                'ingredients' => 'Filé mignon, alcaparras, queijo parmesão, azeite, limão',
                'allergens' => 'Leite',
                'is_vegetarian' => false,
                'is_vegan' => false,
                'is_gluten_free' => true,
                'available' => true,
                'featured' => false,
                'preparation_time' => 15,
                'category_id' => 1,
            ],
            
            // pratos principais categoria 2
            [
                'name' => 'Picanha à Brasileira',
                'description' => 'Picanha grelhada com arroz, feijão tropeiro e vinagrete',
                'price' => 59.90,
                'ingredients' => 'Picanha, arroz, feijão, farofa, vinagrete',
                'is_vegetarian' => false,
                'is_vegan' => false,
                'is_gluten_free' => false,
                'available' => true,
                'featured' => true,
                'preparation_time' => 30,
                'category_id' => 2,
            ],
            [
                'name' => 'Salmão Grelhado',
                'description' => 'Filé de salmão grelhado com legumes salteados e molho de limão',
                'price' => 49.90,
                'ingredients' => 'Salmão, abobrinha, cenoura, brócolis, limão, manteiga',
                'allergens' => 'Peixe, leite',
                'is_vegetarian' => false,
                'is_vegan' => false,
                'is_gluten_free' => true,
                'available' => true,
                'featured' => true,
                'preparation_time' => 25,
                'category_id' => 2,
            ],
            
            // massas categoria 3
            [
                'name' => 'Espaguete à Carbonara',
                'description' => 'Espaguete com molho cremoso de ovos, queijo pecorino e bacon',
                'price' => 38.90,
                'ingredients' => 'Espaguete, ovo, queijo pecorino, bacon, pimenta preta',
                'allergens' => 'Glúten, ovo, leite',
                'is_vegetarian' => false,
                'is_vegan' => false,
                'is_gluten_free' => false,
                'available' => true,
                'featured' => false,
                'preparation_time' => 20,
                'category_id' => 3,
            ],
            [
                'name' => 'Ravioli de Queijo',
                'description' => 'Ravioli recheado com quatro queijos ao molho de tomate',
                'price' => 42.90,
                'ingredients' => 'Massa fresca, ricota, gorgonzola, parmesão, provolone, tomate',
                'allergens' => 'Glúten, leite',
                'is_vegetarian' => true,
                'is_vegan' => false,
                'is_gluten_free' => false,
                'available' => true,
                'featured' => false,
                'preparation_time' => 25,
                'category_id' => 3,
            ],
            
            // sobremesas categoria 4
            [
                'name' => 'Pudim de Leite',
                'description' => 'Clássico pudim de leite condensado com calda de caramelo',
                'price' => 15.90,
                'ingredients' => 'Leite condensado, leite, ovos, açúcar',
                'allergens' => 'Leite, ovo',
                'is_vegetarian' => true,
                'is_vegan' => false,
                'is_gluten_free' => true,
                'available' => true,
                'featured' => true,
                'preparation_time' => 10,
                'category_id' => 4,
            ],
            [
                'name' => 'Mousse de Chocolate',
                'description' => 'Mousse aerada de chocolate meio-amargo',
                'price' => 18.90,
                'ingredients' => 'Chocolate meio-amargo, ovos, açúcar, creme de leite',
                'allergens' => 'Leite, ovo',
                'is_vegetarian' => true,
                'is_vegan' => false,
                'is_gluten_free' => true,
                'available' => true,
                'featured' => false,
                'preparation_time' => 15,
                'category_id' => 4,
            ],
            
            // bebidas categoria 5
            [
                'name' => 'Suco de Laranja',
                'description' => 'Suco de laranja natural',
                'price' => 9.90,
                'ingredients' => 'Laranja, açúcar (opcional)',
                'is_vegetarian' => true,
                'is_vegan' => true,
                'is_gluten_free' => true,
                'available' => true,
                'featured' => false,
                'preparation_time' => 5,
                'category_id' => 5,
            ],
            [
                'name' => 'Caipirinha',
                'description' => 'Clássica caipirinha de limão',
                'price' => 15.90,
                'ingredients' => 'Cachaça, limão, açúcar, gelo',
                'is_vegetarian' => true,
                'is_vegan' => true,
                'is_gluten_free' => true,
                'available' => true,
                'featured' => false,
                'preparation_time' => 5,
                'category_id' => 5,
            ],
        ];

        foreach ($dishes as $dish) {
            Dish::create($dish);
        }
    }
} 