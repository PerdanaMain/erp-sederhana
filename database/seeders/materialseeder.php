<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class materialseeder extends Seeder
{
    public function run(): void
    {
        Material::insert([
            [
                'name' => 'Material 1',
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Material 2',
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
