<?php

namespace Database\Seeders;

use App\Models\customer\Customer;
use App\Models\postingan\Produk;
use App\Models\transaksi\Penjualan;
use App\Models\transaksi\Source;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produk = Produk::all();
        $sources = Source::all();
        $customers = Customer::all();

        foreach (range(1, 50) as $index) {
            $customer = $customers->random();
            $source = $sources->random();
            $tanggal = date('Y-m-d');
            $invoicenumber = $this->generateInvoicePenjualanNumber();

            $penjualan = DB::table('penjualans')->insertGetId([
                'customer_id' => $customer->id,
                'source_id' => $source->id,
                'tanggal' => $tanggal,
                'invoicenumber' => $invoicenumber,
                'total_harga' => 0, // Akan diupdate setelah penjualan_details diisi
                'diskon' => rand(0, 50000),
                'last_total' => 0,  // Akan diupdate setelah penjualan_details diisi
                'status' => rand(0, 1) ? 'lunas' : 'belum lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $totalHarga = 0;
            foreach (range(1, rand(1, 5)) as $i) {
                $selectedProduk = $produk->random();
                $qty = rand(1, 10);
                $harga = $selectedProduk->harga;
                $sub_harga = $qty * $harga;
                $totalHarga += $sub_harga;

                DB::table('penjualan_details')->insert([
                    'penjualan_id' => $penjualan,
                    'produk_id' => $selectedProduk->id,
                    'qty' => $qty,
                    'harga' => $harga,
                    'sub_harga' => $sub_harga,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $diskon = DB::table('penjualans')->where('id', $penjualan)->value('diskon');
            $lastTotal = $totalHarga - $diskon;

            DB::table('penjualans')->where('id', $penjualan)->update([
                'total_harga' => $totalHarga,
                'last_total' => max($lastTotal, 0),
            ]);
        }
    }
    private function generateInvoicePenjualanNumber(): string
    {
        $latestInvoice = Penjualan::latest('invoicenumber')->first();
        if (!$latestInvoice) {
            return 'INV.MBK/PNJ/' . date('Y') . '/0000001';
        }
        $latestInvoiceNumber = $latestInvoice->invoicenumber;
        $incrementedNumber = (int)substr($latestInvoiceNumber, 17) + 1;
        $newInvoiceNumber = 'INV.MBK/PNJ/' . date('Y') . '/' . str_pad($incrementedNumber, 7, '0', STR_PAD_LEFT);
        return $newInvoiceNumber;
    }
}
