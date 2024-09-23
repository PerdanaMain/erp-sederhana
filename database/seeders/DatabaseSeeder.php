<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            roleseeder::class,
            userseeder::class,
            supplierseeder::class,
            statusseeder::class,
            materialseeder::class,
        ]);
    }
}
