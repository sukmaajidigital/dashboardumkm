<?php

namespace App\Http\Controllers;

use App\Models\BahanKategori;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BahanKategoriController extends Controller
{
    public function ajax()
    {
        $bahankategoris = BahanKategori::all();
        return response()->json($bahankategoris);
    }
    public function index(): View
    {
        $bahankategoris = BahanKategori::orderByDesc('created_at')->paginate(10);
        return view('page_bahan.kategori.index', compact('bahankategoris'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view('page_bahan.kategori.form');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            BahanKategori::create($request->all());
            return redirect()->route('kategori.index')->with('success', 'kategori created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to create kategori.');
        }
    }

    public function edit(BahanKategori $bahankategori): View
    {
        return view('page_bahan.kategori.edit', compact('bahankategori'));
    }
    public function update(Request $request, BahanKategori $bahankategori): RedirectResponse
    {
        try {
            $bahankategori->update($request->all());
            return redirect()->route('kategori.index')->with('success', 'kategori update successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to update kategori.');
        }
    }
    public function destroy(BahanKategori $bahankategori)
    {
        $bahankategori->delete();
        return to_route('kategori.index')->with('success', 'kategori Deleted successfully.');
    }
}
