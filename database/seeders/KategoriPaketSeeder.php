<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriPaket;

class KategoriPaketSeeder extends Seeder
{
    public function run(): void
    {
        KategoriPaket::create([
            'nama_kategori' => 'Wedding'
        ]);

        KategoriPaket::create([
            'nama_kategori' => 'Engagement'
        ]);
    }
}

