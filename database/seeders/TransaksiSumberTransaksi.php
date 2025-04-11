<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSumberTransaksi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sources')->insert([
            'sumber_transaksi' => 'Tunai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sources')->insert([
            'sumber_transaksi' => 'Kredit',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
