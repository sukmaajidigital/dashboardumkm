<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\customer\Customer;
use App\Models\postingan\Produk;
use App\Models\transaksi\ManualInvoice;
use App\Models\transaksi\ManualInvoiceDetail;
use App\Models\transaksi\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ManualInvoiceController extends Controller
{
    public function ajax()
    {
        $manualinvoices = ManualInvoice::all();
        return response()->json($manualinvoices);
    }
    private function generateInvoiceManualNumber(): string
    {
        $latestInvoice = ManualInvoice::latest('invoicenumber')->first();
        if (!$latestInvoice) {
            return 'INV.MBK/MINV/' . date('Y') . '/0000001';
        }
        $latestInvoiceNumber = $latestInvoice->invoicenumber;
        $incrementedNumber = (int)substr($latestInvoiceNumber, 18) + 1;
        $newInvoiceNumber = 'INV.MBK/MINV/' . date('Y') . '/' . str_pad($incrementedNumber, 7, '0', STR_PAD_LEFT);
        return $newInvoiceNumber;
    }
    public function index(): View
    {
        $manualinvoices = ManualInvoice::all();
        $customers = Customer::all();
        $sources = Source::all();
        $produks = Produk::all();
        return view('page_transaksi.manualinvoice.index', compact('manualinvoices', 'customers', 'sources', 'produks'));
    }

    public function create(): View
    {
        $manualinvoices = ManualInvoice::all();
        $customers = Customer::all();
        $sources = Source::all();
        $produks = Produk::all();
        $generateInvoiceManualNumber = $this->generateInvoiceManualNumber();
        return view('page_transaksi.manualinvoice.form', compact('manualinvoices', 'customers', 'sources', 'produks', 'generateInvoiceManualNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoicenumber' => 'required',
            'tanggal' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'source_id' => 'required|exists:sources,id',
            'total_harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',
            'last_total' => 'required|numeric|min:0',
            'nama_produk' => 'required',
            'nama_produk.*' => 'required',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric|min:1',
            'harga' => 'required|array',
            'harga.*' => 'required|numeric|min:0',
            'sub_harga' => 'required|array',
            'sub_harga.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Create main manualinvoice record
            $manualinvoice = ManualInvoice::create([
                'invoicenumber' => $validated['invoicenumber'],
                'tanggal' => $validated['tanggal'],
                'customer_id' => $validated['customer_id'],
                'source_id' => $validated['source_id'],
                'total_harga' => $validated['total_harga'],
                'diskon' => $validated['diskon'] ?? 0,
                'last_total' => $validated['last_total'],
                'status' => 'belum lunas',
            ]);

            // Create manualinvoice details
            foreach ($validated['nama_produk'] as $index => $namaProduk) {
                ManualInvoiceDetail::create([
                    'manual_invoice_id' => $manualinvoice->id,
                    'nama_produk' => $namaProduk,
                    'qty' => $validated['qty'][$index],
                    'harga' => $validated['harga'][$index],
                    'sub_harga' => $validated['sub_harga'][$index],
                ]);
            }

            DB::commit();

            return redirect()->route('manualinvoice.index')->with('success', 'manualinvoice berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan ManualInvoice: ' . $e->getMessage());
        }
    }

    public function edit(ManualInvoice $manualinvoice): View
    {
        $customers = Customer::all();
        $sources = Source::all();
        $manualInvoiceDetails = ManualInvoiceDetail::where('manual_invoice_id', $manualinvoice->id)->get();
        $produks = Produk::all();
        return view('page_transaksi.manualinvoice.edit', compact('manualinvoice', 'customers', 'sources', 'manualInvoiceDetails', 'produks'));
    }
    public function update(Request $request, ManualInvoice $manualinvoice)
    {
        $validated = $request->validate([
            'invoicenumber' => 'required',
            'tanggal' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'source_id' => 'required|exists:sources,id',
            'total_harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',
            'last_total' => 'required|numeric|min:0',
            'nama_produk' => 'required',
            'nama_produk.*' => 'required',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric|min:1',
            'harga' => 'required|array',
            'harga.*' => 'required|numeric|min:0',
            'sub_harga' => 'required|array',
            'sub_harga.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Update main manualinvoice record
            $manualinvoice->update([
                'invoicenumber' => $validated['invoicenumber'],
                'tanggal' => $validated['tanggal'],
                'customer_id' => $validated['customer_id'],
                'source_id' => $validated['source_id'],
                'total_harga' => $validated['total_harga'],
                'diskon' => $validated['diskon'] ?? 0,
                'last_total' => $validated['last_total'],
            ]);

            // Delete existing details
            $manualinvoice->details()->delete();

            // Create new manualinvoice details
            foreach ($validated['nama_produk'] as $index => $namaProduk) {
                ManualInvoiceDetail::create([
                    'manual_invoice_id' => $manualinvoice->id,
                    'nama_produk' => $namaProduk,
                    'qty' => $validated['qty'][$index],
                    'harga' => $validated['harga'][$index],
                    'sub_harga' => $validated['sub_harga'][$index],
                ]);
            }

            DB::commit();

            return redirect()->route('manualinvoice.index')->with('success', 'manualinvoice berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui ManualInvoice: ' . $e->getMessage());
        }
    }
    public function destroy(ManualInvoice $manualinvoice)
    {
        $manualinvoice->delete();
        return to_route('manualinvoice.index')->with('success', 'manualinvoice Deleted successfully.');
    }
}
