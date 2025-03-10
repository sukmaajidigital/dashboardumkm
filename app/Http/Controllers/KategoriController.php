<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function ajax()
    {
        $kategoris = Kategori::all();
        return response()->json($kategoris);
    }
    public function index(): View
    {
        $kategoris = Kategori::orderByDesc('created_at')->paginate(10);
        return view('page_bahan.kategori.index', compact('kategoris'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view('page_bahan.kategori.form');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            Kategori::create($request->all());
            return redirect()->route('kategori.index')->with('success', 'kategori created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to create kategori.');
        }
    }

    public function edit(Kategori $kategori): View
    {
        return view('page_bahan.kategori.edit', compact('kategori'));
    }
    public function update(Request $request, Kategori $kategori): RedirectResponse
    {
        try {
            $kategori->update($request->all());
            return redirect()->route('kategori.index')->with('success', 'kategori update successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to update kategori.');
        }
    }
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return to_route('kategori.index')->with('success', 'kategori Deleted successfully.');
    }
}
