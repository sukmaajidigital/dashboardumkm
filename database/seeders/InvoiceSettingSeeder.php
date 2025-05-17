<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoicesetting = \App\Models\transaksi\InvoiceSetting::first();
        if (!$invoicesetting) {
            \App\Models\transaksi\InvoiceSetting::create([
                'logo_invoice' => 'invoice/logo.png',
                'name_invoice' => 'Muria Batik Kudus',
                'address' => 'Desa Karangmalang RT 004 RW 002, Kecamatan Gebog, Kabupaten Kudus, Jawa Tengah 59333',
                'phone' => '+62 811-2828-188',
                'email' => 'mbatikkudus@gmail.com',
                'website' => 'https://www.muriabatikkudus.com',
                'instagram' => 'https://www.instagram.com/muriabatik',
                'ttd_image' => 'invoice/ttdyuli.png',
                'ttd_name' => 'Yuli Astuti',
                'ttd_position' => 'Owner',
            ]);
        }
    }
}
