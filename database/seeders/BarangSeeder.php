<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'merk' => 'Samsung',
                'seri' => '1234',
                'spesifikasi' => 'Layar 55 inci, Resolusi 4K, Smart TV',
                'stok' => 10,
                'kategori_id' => 3, // Ubah sesuai dengan kategori yang sesuai
            ],
            [
                'merk' => 'Dell',
                'seri' => 'XPS 13',
                'spesifikasi' => 'Intel Core i7, RAM 16 GB, SSD 512 GB',
                'stok' => 5,
                'kategori_id' => 2, // Ubah sesuai dengan kategori yang sesuai
            ],
            [
                'merk' => 'Sony',
                'seri' => 'Bravia',
                'spesifikasi' => 'Layar 65 inci, Resolusi 4K, Android TV',
                'stok' => 8,
                'kategori_id' => 3, // Ubah sesuai dengan kategori yang sesuai
            ],
            // Tambahkan data barang lainnya sesuai kebutuhan
        ];

        Barang::insert($data);
    }
}