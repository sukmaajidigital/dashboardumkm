<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\BahanKategori;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BahanExport;

class BahanController extends Controller
{
    public function ajax()
    {
        $bahans = Bahan::all();
        return response()->json($bahans);
    }
    public function index(): View
    {
        $bahans = Bahan::all();
        $bahankategoris = BahanKategori::select('id', 'nama_kategori')->get();
        return view('page_bahan.bahan.index', compact('bahans', 'bahankategoris'));
    }
    public function exportExcel(Request $request)
    {
        $bahankategori = $request->bahankategori;
        $satuan = $request->satuan;
        return Excel::download(new BahanExport($bahankategori, $satuan), 'bahan.xlsx');
    }

    public function create(): View
    {
        $bahankategoris = BahanKategori::all();
        return view('page_bahan.bahan.form', compact('bahankategoris'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            Bahan::create($request->all());
            return redirect()->route('bahan.index')->with('success', 'bahan created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to create bahan.');
        }
    }

    public function edit(Bahan $bahan): View
    {
        $bahankategoris = BahanKategori::all();
        return view('page_bahan.bahan.edit', compact('bahan', 'bahankategoris'));
    }
    public function update(Request $request, Bahan $bahan): RedirectResponse
    {
        try {
            $bahan->update($request->all());
            return redirect()->route('bahan.index')->with('success', 'bahan update successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to update bahan.');
        }
    }
    public function destroy(Bahan $bahan)
    {
        $bahan->delete();
        return to_route('bahan.index')->with('success', 'bahan Deleted successfully.');
    }
}
