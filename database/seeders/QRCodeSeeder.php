<?php

namespace Database\Seeders;

use App\Models\QrCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QRCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar QR Codes para 10 mesas
        for ($i = 1; $i <= 10; $i++) {
            QrCode::create([
                'table_number' => 'Mesa ' . $i,
                'code' => Str::random(10),
                'active' => true,
            ]);
        }
    }
} 