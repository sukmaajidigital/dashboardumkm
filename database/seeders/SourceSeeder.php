<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sources')->insert([
            ['sumber_transaksi' => 'whatsapp', 'created_at' => now(), 'updated_at' => now()],
            ['sumber_transaksi' => 'pameran', 'created_at' => now(), 'updated_at' => now()],
            ['sumber_transaksi' => 'galeri', 'created_at' => now(), 'updated_at' => now()],
            ['sumber_transaksi' => 'online', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
