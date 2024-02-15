<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['deskripsi' => 'Kipas Angin', 'kategori' => 'A'],
            ['deskripsi' => 'Laptop', 'kategori' => 'M'],
            ['deskripsi' => 'Televisi', 'kategori' => 'M'],
            ['deskripsi' => 'Peralatan Olahraga', 'kategori' => 'A'],
            ['deskripsi' => 'Peralatan Masak', 'kategori' => 'A'],
            ['deskripsi' => 'Kamera', 'kategori' => 'M'],
            ['deskripsi' => 'Alat Musik', 'kategori' => 'A'],
            ['deskripsi' => 'Alat Tulis', 'kategori' => 'A'],
            ['deskripsi' => 'Peralatan Camping', 'kategori' => 'A'],
            ['deskripsi' => 'Barang Elektronik', 'kategori' => 'M'],
        ];

        Kategori::insert($data);
    }
}