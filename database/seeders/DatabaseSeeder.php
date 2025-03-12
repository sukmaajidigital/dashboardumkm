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
        $kategoriIds = [];
        $kategoriData = [
            ['nama_kategori' => 'VIP'],
            ['nama_kategori' => 'Reguler'],
            ['nama_kategori' => 'Premium'],
        ];

        foreach ($kategoriData as $kategori) {
            $kategoriIds[] = DB::table('customer_kategoris')->insertGetId($kategori);
        }
        $this->call([
            SettingSeeder::class,
            UserSeeder::class,
            // CustomerSeeder::class,
            BahanKategoriseeder::class,
            BahanSeeder::class,
            KeperluanSeeder::class,
            SupplierSeeder::class,
            BahanMasukSeeder::class,
            BahanKeluarSeeder::class
        ]);
        // Seed kategori data

    }
}
