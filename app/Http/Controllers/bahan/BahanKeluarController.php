<?php

namespace App\Http\Controllers\bahan;

use App\Exports\BahanKeluarExport;
use App\Http\Controllers\Controller;
use App\Models\bahan\Bahan;
use App\Models\bahan\BahanKategori;
use App\Models\bahan\BahanKeluar;
use App\Models\bahan\Keperluan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BahanKeluarController extends Controller
{
    public function ajax()
    {
        $bahankeluars = BahanKeluar::all();
        return response()->json($bahankeluars);
    }
    public function index(Request $request): View
    {
        $bahankategoriId = $request->input('bahankategori');
        $keperluanId = $request->input('keperluan');

        $bahankeluars = BahanKeluar::when($bahankategoriId, function ($query, $bahankategoriId) {
            return $query->whereHas('bahan.bahankategori', function ($query) use ($bahankategoriId) {
                $query->where('id', $bahankategoriId);
            });
        })
            ->when($keperluanId, function ($query, $keperluanId) {
                return $query->where('keperluan_id', $keperluanId);
            })
            ->get();

        $bahankategoris = BahanKategori::all();
        $keperluans = Keperluan::all();

        return view('page_bahan.bahankeluar.index', compact('bahankeluars', 'bahankategoris', 'keperluans'));
    }
    public function export(Request $request)
    {
        $bahankategoriId = $request->input('bahankategori');
        $supplierId = $request->input('supplier');
        $format = $request->input('format');

        $bahankeluars = BahanKeluar::when($bahankategoriId, function ($query, $bahankategoriId) {
            return $query->whereHas('bahan.bahankategori', function ($query) use ($bahankategoriId) {
                $query->where('id', $bahankategoriId);
            });
        })
            ->when($supplierId, function ($query, $supplierId) {
                return $query->where('supplier_id', $supplierId);
            })
            ->get();

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('page_bahan.bahankeluar.export', compact('bahankeluars'));
            return $pdf->download('bahankeluar.pdf');
        } elseif ($format === 'excel') {
            return Excel::download(new BahanKeluarExport($bahankeluars), 'bahankeluar.xlsx');
        }

        return redirect()->back();
    }
    public function create(): View
    {
        $bahans = Bahan::all();
        $keperluans = Keperluan::all();
        return view('page_bahan.bahankeluar.form', compact('bahans', 'keperluans'));
    }
    public function store(Request $request): RedirectResponse
    {
        // Ambil data stok lama
        $bahan = Bahan::where('id', $request->bahan_id)->first();

        // Cek apakah stok cukup
        if ($request->jumlah > $bahan->stok) {
            return redirect()->back()->with('error', 'Jumlah bahan keluar melebihi stok yang tersedia!');
        }

        // Kurangi stok jika cukup
        $bahan->update([
            'stok' => $bahan->stok - $request->jumlah
        ]);

        // Simpan data bahan keluar
        BahanKeluar::create([
            'bahan_id' => $request->bahan_id,
            'tanggal' => $request->tanggal,
            'keperluan_id' => $request->keperluan_id,
            'jumlah' => $request->jumlah,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('bahankeluar.index')->with('success', 'Bahan keluar berhasil ditambahkan.');
    }
    public function edit(BahanKeluar $bahankeluar): View
    {
        $bahans = Bahan::all();
        $keperluans = Keperluan::all();
        return view('page_bahan.bahankeluar.edit', compact('bahankeluar', 'bahans', 'keperluans'));
    }
    public function update(Request $request, BahanKeluar $bahankeluar): RedirectResponse
    {
        return DB::transaction(function () use ($request, $bahankeluar) {
            // Ambil stok lama dari tabel bahan
            $bahan = Bahan::where('id', $bahankeluar->bahan_id)->first();

            // Kembalikan stok sebelum mengupdate
            $bahan->stok += $bahankeluar->jumlah;

            // Cek apakah stok cukup untuk perubahan
            if ($request->jumlah > $bahan->stok) {
                return redirect()->back()->with('error', 'Jumlah bahan keluar melebihi stok yang tersedia!');
            }

            // Update stok dengan jumlah baru
            $bahan->stok -= $request->jumlah;
            $bahan->save();

            // Update data bahan keluar
            $bahankeluar->update([
                'bahan_id' => $request->bahan_id,
                'tanggal' => $request->tanggal,
                'keperluan_id' => $request->keperluan_id,
                'jumlah' => $request->jumlah,
                'catatan' => $request->catatan,
            ]);

            return redirect()->route('bahankeluar.index')->with('success', 'Bahan keluar berhasil diperbarui.');
        });
    }
    public function destroy(BahanKeluar $bahankeluar)
    {
        return DB::transaction(function () use ($bahankeluar) {
            // Ambil data bahan
            $bahan = Bahan::where('id', $bahankeluar->bahan_id)->first();

            if ($bahan) {
                // Kembalikan stok sebelum menghapus data
                $bahan->stok += $bahankeluar->jumlah;
                $bahan->save();
            }

            // Hapus data bahan keluar
            $bahankeluar->delete();

            return redirect()->route('bahankeluar.index')->with('success', 'Bahan keluar berhasil dihapus.');
        });
    }
}
