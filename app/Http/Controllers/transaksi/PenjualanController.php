<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\customer\Customer;
use App\Models\transaksi\Penjualan;
use App\Models\transaksi\Source;
use Illuminate\Http\Request;
use Illuminate\View\View;
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
        return view('page_transaksi.penjualan.index', compact('penjualans', 'customers', 'sources'));
    }

    public function create(): View
    {
        $penjualans = Penjualan::all();
        $customers = Customer::all();
        $sources = Source::all();
        return view('page_transaksi.penjualan.form', compact('penjualans', 'customers', 'sources'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            Penjualan::create($request->all());
            return redirect()->route('penjualan.index')->with('success', 'penjualan created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to create penjualan.');
        }
    }

    public function edit(Penjualan $penjualan): View
    {
        return view('page_transaksi.penjualan.edit', compact('penjualans'));
    }
    public function update(Request $request, Source $penjualan): RedirectResponse
    {
        try {
            $penjualan->update($request->all());
            return redirect()->route('penjualan.index')->with('success', 'penjualan update successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to update penjualan.');
        }
    }
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return to_route('penjualan.index')->with('success', 'penjualan Deleted successfully.');
    }
}
