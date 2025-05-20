<?php

namespace App\Http\Controllers\produk;

use App\Http\Controllers\Controller;
use App\Models\postingan\ProdukKategori;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProdukKategoriController extends Controller
{
    public function ajax()
    {
        $produkkategoris = ProdukKategori::all();
        return response()->json($produkkategoris);
    }
    public function index(): View
    {
        $produkkategoris = ProdukKategori::orderByDesc('created_at')->paginate(10);
        return view('page_produk.produkkategori.index', compact('produkkategoris'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view('page_produk.produkkategori.form');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            ProdukKategori::create($request->all());
            return redirect()->route('produkkategori.index')->with('success', 'kategori created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to create kategori.');
        }
    }

    public function edit(ProdukKategori $produkkategori): View
    {
        return view('page_produk.produkkategori.edit', compact('produkkategori'));
    }
    public function update(Request $request, ProdukKategori $produkkategori): RedirectResponse
    {
        try {
            $produkkategori->update($request->all());
            return redirect()->route('produkkategori.index')->with('success', 'kategori update successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to update kategori.');
        }
    }
    public function destroy(ProdukKategori $produkkategori)
    {
        $produkkategori->delete();
        return to_route('produkkategori.index')->with('success', 'kategori Deleted successfully.');
    }
}
