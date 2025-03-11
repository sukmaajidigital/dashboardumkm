<?php

namespace App\Http\Controllers;

use App\Exports\BahanMasukExport;
use App\Models\Bahan;
use App\Models\BahanMasuk;
use App\Models\BahanKategori;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BahanMasukController extends Controller
{
    public function ajax()
    {
        $bahanmasuks = BahanMasuk::all();
        return response()->json($bahanmasuks);
    }
    public function index(Request $request): View
    {
        $bahankategoriId = $request->input('bahankategori');
        $supplierId = $request->input('supplier');

        $bahanmasuks = BahanMasuk::when($bahankategoriId, function ($query, $bahankategoriId) {
            return $query->whereHas('bahan.bahankategori', function ($query) use ($bahankategoriId) {
                $query->where('id', $bahankategoriId);
            });
        })
            ->when($supplierId, function ($query, $supplierId) {
                return $query->where('supplier_id', $supplierId);
            })
            ->get();

        $bahankategoris = BahanKategori::all();
        $suppliers = Supplier::all();

        return view('page_bahan.bahanmasuk.index', compact('bahanmasuks', 'bahankategoris', 'suppliers'));
    }
    public function export(Request $request)
    {
        $bahankategoriId = $request->input('bahankategori');
        $supplierId = $request->input('supplier');
        $format = $request->input('format');
        $bahanmasuks = BahanMasuk::when($bahankategoriId, function ($query, $bahankategoriId) {
            return $query->whereHas('bahan.bahankategori', function ($query) use ($bahankategoriId) {
                $query->where('id', $bahankategoriId);
            });
        })
            ->when($supplierId, function ($query, $supplierId) {
                return $query->where('supplier_id', $supplierId);
            })
            ->get();

        if ($format === 'pdf') {
            // return view('page_bahan.bahanmasuk.export', compact('bahanmasuks'));
            $pdf = Pdf::loadView('page_bahan.bahanmasuk.export', compact('bahanmasuks'));
            return $pdf->download('bahanmasuk.pdf');
        } elseif ($format === 'excel') {
            return Excel::download(new BahanMasukExport($bahanmasuks), 'bahanmasuk.xlsx');
        }

        return redirect()->back();
    }
    public function create(): View
    {
        $suppliers = Supplier::all();
        $bahans = Bahan::all();
        return view('page_bahan.bahanmasuk.form', compact('suppliers', 'bahans'));
    }
    public function store(Request $request): RedirectResponse
    {
        $stoklama = Bahan::where('id', $request->bahan_id)->first()->stok;
        Bahan::where('id', $request->bahan_id)->update([
            'stok' => $stoklama + $request->jumlah
        ]);
        BahanMasuk::create($request->all());
        return redirect()->route('bahanmasuk.index')->with('success', 'bahanmasuk created successfully.');
    }
    public function edit(BahanMasuk $bahanmasuk): View
    {
        $suppliers = Supplier::all();
        $bahans = Bahan::all();
        return view('page_bahan.bahanmasuk.edit', compact('bahanmasuk', 'suppliers', 'bahans'));
    }
    public function update(Request $request, BahanMasuk $bahanmasuk): RedirectResponse
    {
        $stoklama = bahan::where('id', $request->bahan_id)->first()->stok;
        $editbahanmasuk = BahanMasuk::where('bahan_id', $request->bahan_id)->first()->jumlah;
        $hasilstoklama = $stoklama - $editbahanmasuk;
        bahan::where('id', $request->bahan_id)->update([
            'stok' => $hasilstoklama + $request->jumlah
        ]);
        $bahanmasuk->update($request->all());
        return redirect()->route('bahanmasuk.index')->with('success', 'bahanmasuk update successfully.');
    }
    public function destroy(BahanMasuk $bahanmasuk)
    {
        $stoklama = bahan::where('id', $bahanmasuk->bahan_id)->first()->stok;
        bahan::where('id', $bahanmasuk->bahan_id)->update([
            'stok' => $stoklama - $bahanmasuk->jumlah
        ]);
        $bahanmasuk->delete();
        return to_route('bahanmasuk.index')->with('success', 'bahanmasuk Deleted successfully.');
    }
}
