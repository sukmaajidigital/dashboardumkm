<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\transaksi\DownPayment;
use App\Models\transaksi\Pemesanan;
use App\Models\transaksi\Penjualan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DownPaymentController extends Controller
{
    public function ajax()
    {
        $downpayments = DownPayment::all();
        return response()->json($downpayments);
    }
    public function index(): View
    {
        $downpayments = DownPayment::orderByDesc('created_at')->paginate(10);
        $penjualans = Penjualan::all();
        $pemesanans = Pemesanan::all();
        return view('page_transaksi.downpayment.index', compact('downpayments', 'penjualans', 'pemesanans'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        $penjualans = Penjualan::all();
        $pemesanans = Pemesanan::all();
        return view('page_transaksi.downpayment.form', compact('penjualans', 'pemesanans'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            DownPayment::create($request->all());
            return redirect()->route('downpayment.index')->with('success', 'downpayment created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to create downpayment.');
        }
    }

    public function edit(DownPayment $downpayment): View
    {
        return view('page_transaksi.downpayment.edit', compact('downpayment'));
    }
    public function update(Request $request, DownPayment $downpayment): RedirectResponse
    {
        try {
            $downpayment->update($request->all());
            return redirect()->route('downpayment.index')->with('success', 'downpayment update successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to update downpayment.');
        }
    }
    public function destroy(DownPayment $downpayment)
    {
        $downpayment->delete();
        return to_route('downpayment.index')->with('success', 'downpayment Deleted successfully.');
    }
}
