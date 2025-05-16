<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\customer\Customer;
use App\Models\postingan\Produk;
use App\Models\transaksi\Pemesanan;
use App\Models\transaksi\PemesananDetail;
use App\Models\transaksi\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PemesananController extends Controller
{
    public function ajax()
    {
        $pemesanans = Pemesanan::all();
        return response()->json($pemesanans);
    }
    private function generateInvoicepemesananNumber(): string
    {
        $latestInvoice = Pemesanan::latest('invoicenumber')->first();
        if (!$latestInvoice) {
            return 'INV.MBK/PNJ/' . date('Y') . '/0000001';
        }
        $latestInvoiceNumber = $latestInvoice->invoicenumber;
        $incrementedNumber = (int)substr($latestInvoiceNumber, 17) + 1;
        $newInvoiceNumber = 'INV.MBK/PNJ/' . date('Y') . '/' . str_pad($incrementedNumber, 7, '0', STR_PAD_LEFT);
        return $newInvoiceNumber;
    }
    public function index(): View
    {
        $pemesanans = Pemesanan::all();
        $customers = Customer::all();
        $sources = Source::all();
        $produks = Produk::all();
        return view('page_transaksi.pemesanan.index', compact('pemesanans', 'customers', 'sources', 'produks'));
    }

    public function create(): View
    {
        $pemesanans = Pemesanan::all();
        $customers = Customer::all();
        $sources = Source::all();
        $produks = Produk::all();
        $generateInvoicePemesananNumber = $this->generateInvoicePemesananNumber();
        return view('page_transaksi.pemesanan.form', compact('pemesanans', 'customers', 'sources', 'produks', 'generateInvoicePemesananNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoicenumber' => 'required|string|unique:pemesanans,invoicenumber',
            'tanggal' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'source_id' => 'required|exists:sources,id',
            'total_harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',
            'last_total' => 'required|numeric|min:0',
            'produk_id' => 'required',
            'produk_id.*' => 'required',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric|min:1',
            'harga' => 'required|array',
            'harga.*' => 'required|numeric|min:0',
            'sub_harga' => 'required|array',
            'sub_harga.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Create main pemesanan record
            $pemesanan = Pemesanan::create([
                'invoicenumber' => $validated['invoicenumber'],
                'tanggal' => $validated['tanggal'],
                'customer_id' => $validated['customer_id'],
                'source_id' => $validated['source_id'],
                'total_harga' => $validated['total_harga'],
                'diskon' => $validated['diskon'] ?? 0,
                'last_total' => $validated['last_total'],
                'status' => 'belum lunas',
            ]);

            // Create pemesanan details
            foreach ($validated['produk_id'] as $index => $produkId) {
                PemesananDetail::create([
                    'pemesanan_id' => $pemesanan->id,
                    'produk_id' => $produkId,
                    'qty' => $validated['qty'][$index],
                    'harga' => $validated['harga'][$index],
                    'sub_harga' => $validated['sub_harga'][$index],
                ]);
            }

            DB::commit();

            return redirect()->route('pemesanan.index')->with('success', 'pemesanan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan pemesanan: ' . $e->getMessage());
        }
    }

    public function edit(Pemesanan $pemesanan): View
    {
        $customers = Customer::all();
        $sources = Source::all();
        $pemesananDetails = PemesananDetail::where('pemesanan_id', $pemesanan->id)->get();
        $produks = Produk::all();
        return view('page_transaksi.pemesanan.edit', compact('pemesanan', 'customers', 'sources', 'pemesananDetails', 'produks'));
    }
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $validated = $request->validate([
            'invoicenumber' => 'required|string|unique:pemesanans,invoicenumber,' . $pemesanan->id,
            'tanggal' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'source_id' => 'required|exists:sources,id',
            'total_harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',
            'last_total' => 'required|numeric|min:0',
            'produk_id' => 'required',
            'produk_id.*' => 'required',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric|min:1',
            'harga' => 'required|array',
            'harga.*' => 'required|numeric|min:0',
            'sub_harga' => 'required|array',
            'sub_harga.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Update main pemesanan record
            $pemesanan->update([
                'invoicenumber' => $validated['invoicenumber'],
                'tanggal' => $validated['tanggal'],
                'customer_id' => $validated['customer_id'],
                'source_id' => $validated['source_id'],
                'total_harga' => $validated['total_harga'],
                'diskon' => $validated['diskon'] ?? 0,
                'last_total' => $validated['last_total'],
            ]);

            // Delete existing details
            $pemesanan->details()->delete();

            // Create new pemesanan details
            foreach ($validated['produk_id'] as $index => $produkId) {
                PemesananDetail::create([
                    'pemesanan_id' => $pemesanan->id,
                    'produk_id' => $produkId,
                    'qty' => $validated['qty'][$index],
                    'harga' => $validated['harga'][$index],
                    'sub_harga' => $validated['sub_harga'][$index],
                ]);
            }

            DB::commit();

            return redirect()->route('pemesanan.index')->with('success', 'pemesanan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui pemesanan: ' . $e->getMessage());
        }
    }
    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();
        return to_route('pemesanan.index')->with('success', 'pemesanan Deleted successfully.');
    }
}
