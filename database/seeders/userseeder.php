<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userseeder extends Seeder
{

    public function run(): void
    {
        User::insert([
            [
                "roleId" => 1,
                'name' => 'John Doe',
                'username' => 'jhondoe',
                'password' => Hash::make('12345'),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "roleId" => 1,
                'name' => 'Eric Doe',
                'username' => 'ericdoe',
                'password' => Hash::make('12345'),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "roleId" => 2,
                'name' => 'Manager A',
                'username' => 'managera',
                'password' => Hash::make('12345'),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "roleId" => 2,
                'name' => 'Manager B',
                'username' => 'managerb',
                'password' => Hash::make('12345'),
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}