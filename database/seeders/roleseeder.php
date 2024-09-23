<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class roleseeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            [
                'name' => 'Staff',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'Manager Gudang',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'Manager Umum',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
