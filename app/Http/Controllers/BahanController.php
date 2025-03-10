<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Kategori;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\DataTables\DataTables;
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
        $kategoris = Kategori::select('id', 'nama_kategori')->get();
        return view('page_bahan.bahan.index', compact('kategoris'));
    }
    public function exportExcel(Request $request)
    {
        $kategori = $request->kategori;
        $satuan = $request->satuan;
        return Excel::download(new BahanExport($kategori, $satuan), 'bahan.xlsx');
    }

    public function create(): View
    {
        $kategoris = Kategori::all();
        return view('page_bahan.bahan.form', compact('kategoris'));
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
        $kategoris = Kategori::all();
        return view('page_bahan.bahan.edit', compact('bahan', 'kategoris'));
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
