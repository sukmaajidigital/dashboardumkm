<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\customer\Customer;
use App\Models\postingan\Produk;
use App\Models\transaksi\Penjualan;
use App\Models\transaksi\PenjualanDetail;
use App\Models\transaksi\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PenjualanController extends Controller
{
    public function ajax()
    {
        $penjualans = Penjualan::all();
        return response()->json($penjualans);
    }
    public function index(): View
    {
        $penjualans = Penjualan::all();
        $customers = Customer::all();
        $sources = Source::all();
        $produk = Produk::all();
        return view('page_transaksi.penjualan.index', compact('penjualans', 'customers', 'sources', 'produk'));
    }
    public function search(Request $request)
    {
        $term = $request->input('q');

        $products = Produk::where('name', 'like', '%' . $term . '%')
            ->select('id', 'name', 'harga')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->name, // We use name as ID to handle new products
                    'name' => $product->name,
                    'harga' => $product->harga,
                    'text' => $product->name
                ];
            });

        return response()->json([
            'items' => $products,
            'total_count' => $products->count()
        ]);
    }

    public function create(): View
    {
        $penjualans = Penjualan::all();
        $customers = Customer::all();
        $sources = Source::all();
        $produk = Produk::all();
        return view('page_transaksi.penjualan.form', compact('penjualans', 'customers', 'sources', 'produk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoicenumber' => 'required|string|unique:penjualans,invoicenumber',
            'tanggal' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'source_id' => 'required|exists:sources,id',
            'total_harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',
            'last_total' => 'required|numeric|min:0',
            'nama_produk' => 'required|array',
            'nama_produk.*' => 'required|string',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric|min:1',
            'harga' => 'required|array',
            'harga.*' => 'required|numeric|min:0',
            'sub_harga' => 'required|array',
            'sub_harga.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Create main penjualan record
            $penjualan = Penjualan::create([
                'invoicenumber' => $validated['invoicenumber'],
                'tanggal' => $validated['tanggal'],
                'customer_id' => $validated['customer_id'],
                'source_id' => $validated['source_id'],
                'total_harga' => $validated['total_harga'],
                'diskon' => $validated['diskon'] ?? 0,
                'last_total' => $validated['last_total'],
                'status' => 'belum lunas',
            ]);

            // Create penjualan details
            foreach ($validated['nama_produk'] as $index => $namaProduk) {
                PenjualanDetail::create([
                    'penjualan_id' => $penjualan->id,
                    'nama produk' => $namaProduk,
                    'qty' => $validated['qty'][$index],
                    'harga' => $validated['harga'][$index],
                    'sub_harga' => $validated['sub_harga'][$index],
                ]);
            }

            DB::commit();

            return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan penjualan: ' . $e->getMessage());
        }
    }

    public function edit(Penjualan $penjualan): View
    {
        $customers = Customer::all();
        $sources = Source::all();
        $penjualanDetails = PenjualanDetail::where('penjualan_id', $penjualan->id)->get();
        $produk = Produk::all();
        return view('page_transaksi.penjualan.edit', compact('penjualan', 'customers', 'sources', 'penjualanDetails', 'produk'));
    }
    public function update(Request $request, Penjualan $penjualan)
    {
        $validated = $request->validate([
            'invoicenumber' => 'required|string|unique:penjualans,invoicenumber,' . $penjualan->id,
            'tanggal' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'source_id' => 'required|exists:sources,id',
            'total_harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',
            'last_total' => 'required|numeric|min:0',
            'nama_produk' => 'required|array',
            'nama_produk.*' => 'required|string',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric|min:1',
            'harga' => 'required|array',
            'harga.*' => 'required|numeric|min:0',
            'sub_harga' => 'required|array',
            'sub_harga.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Update main penjualan record
            $penjualan->update([
                'invoicenumber' => $validated['invoicenumber'],
                'tanggal' => $validated['tanggal'],
                'customer_id' => $validated['customer_id'],
                'source_id' => $validated['source_id'],
                'total_harga' => $validated['total_harga'],
                'diskon' => $validated['diskon'] ?? 0,
                'last_total' => $validated['last_total'],
            ]);

            // Delete existing details
            $penjualan->details()->delete();

            // Create new penjualan details
            foreach ($validated['nama_produk'] as $index => $namaProduk) {
                PenjualanDetail::create([
                    'penjualan_id' => $penjualan->id,
                    'nama produk' => $namaProduk,
                    'qty' => $validated['qty'][$index],
                    'harga' => $validated['harga'][$index],
                    'sub_harga' => $validated['sub_harga'][$index],
                ]);
            }

            DB::commit();

            return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui penjualan: ' . $e->getMessage());
        }
    }
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return to_route('penjualan.index')->with('success', 'penjualan Deleted successfully.');
    }
}
