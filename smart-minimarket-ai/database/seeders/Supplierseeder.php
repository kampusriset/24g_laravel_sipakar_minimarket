<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'nama_supplier' => 'PT Indofood',
                'alamat' => 'Jakarta',
                'telepon' => '021111111',
                'email' => 'indofood@email.com',
                'lead_time_supplier' => 3,
            ],
            [
                'nama_supplier' => 'PT Wings',
                'alamat' => 'Surabaya',
                'telepon' => '031222222',
                'email' => 'wings@email.com',
                'lead_time_supplier' => 5,
            ],
            [
                'nama_supplier' => 'PT Aqua',
                'alamat' => 'Bekasi',
                'telepon' => '021333333',
                'email' => 'aqua@email.com',
                'lead_time_supplier' => 2,
            ],
            [
                'nama_supplier' => 'PT Unilever',
                'alamat' => 'Tangerang',
                'telepon' => '021444444',
                'email' => 'unilever@email.com',
                'lead_time_supplier' => 4,
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}