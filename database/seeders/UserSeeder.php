<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrador',
                'email' => 'admin@exemplo.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Funcionário',
                'email' => 'staff@exemplo.com',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ],
            [
                'name' => 'João Silva',
                'email' => 'joao@exemplo.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ],
            [
                'name' => 'Maria Oliveira',
                'email' => 'maria@exemplo.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ],
            [
                'name' => 'Pedro Santos',
                'email' => 'pedro@exemplo.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
} 