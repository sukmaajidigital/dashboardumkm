<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\transaksi\Source;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SourceController extends Controller
{
    public function ajax()
    {
        $sources = Source::all();
        return response()->json($sources);
    }
    public function index(): View
    {
        $sources = Source::orderByDesc('created_at')->paginate(10);
        return view('page_transaksi.source.index', compact('sources'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view('page_transaksi.source.form');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            Source::create($request->all());
            return redirect()->route('source.index')->with('success', 'source created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to create source.');
        }
    }

    public function edit(source $source): View
    {
        return view('page_transaksi.source.edit', compact('source'));
    }
    public function update(Request $request, source $source): RedirectResponse
    {
        try {
            $source->update($request->all());
            return redirect()->route('source.index')->with('success', 'source update successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to update source.');
        }
    }
    public function destroy(source $source)
    {
        $source->delete();
        return to_route('source.index')->with('success', 'source Deleted successfully.');
    }
}
