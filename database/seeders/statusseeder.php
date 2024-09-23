<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class statusseeder extends Seeder
{
    public function run(): void
    {
        Status::insert([
            [
                'name' => 'Pending',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'Approved',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'Rejected',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'Drafted',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}