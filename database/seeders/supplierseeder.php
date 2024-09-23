<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class supplierseeder extends Seeder
{

    public function run(): void
    {
        Supplier::insert([
            [
                'name' => 'PT. Supplier 1',
                'address' => 'Jl. Supplier 1 No. 1',
                'phone' => '08123456789',
            ],
            [
                'name' => 'PT. Supplier 2',
                'address' => 'Jl. Supplier 2 No. 2',
                'phone' => '08123456789',
            ],
            [
                'name' => 'PT. Supplier 3',
                'address' => 'Jl. Supplier 3 No. 3',
                'phone' => '08123456789',
            ],
            [
                'name' => 'PT. Supplier 4',
                'address' => 'Jl. Supplier 4 No. 4',
                'phone' => '08123456789',
            ],
            [
                'name' => 'PT. Supplier 5',
                'address' => 'Jl. Supplier 5 No. 5',
                'phone' => '08123456789',
            ],
        ]);
    }
}