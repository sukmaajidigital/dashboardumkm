<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class
        ]);
        // Seed kategori data
        $kategoriIds = [];
        $kategoriData = [
            ['nama_kategori' => 'VIP'],
            ['nama_kategori' => 'Reguler'],
            ['nama_kategori' => 'Premium'],
        ];

        foreach ($kategoriData as $kategori) {
            $kategoriIds[] = DB::table('kategoris')->insertGetId($kategori);
        }

        // Seed customers data
        $customerData = [
            [
                'kategori_id' => $kategoriIds[array_rand($kategoriIds)],
                'nama_customer' => 'John Doe',
                'telepon' => '081234567890',
                'alamat' => 'Jl. Mawar No. 123, Jakarta',
                'email' => 'johndoe@example.com',
                'histori_pembelian' => 'Pembelian produk A, Pembelian produk B'
            ],
            [
                'kategori_id' => $kategoriIds[array_rand($kategoriIds)],
                'nama_customer' => 'Jane Smith',
                'telepon' => '081298765432',
                'alamat' => 'Jl. Melati No. 456, Bandung',
                'email' => 'janesmith@example.com',
                'histori_pembelian' => 'Pembelian produk C'
            ]
        ];

        DB::table('customers')->insert($customerData);
    }
}
