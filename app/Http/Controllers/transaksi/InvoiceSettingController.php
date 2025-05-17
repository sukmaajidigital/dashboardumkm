<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\transaksi\InvoiceSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use IntlChar;

class InvoiceSettingController extends Controller
{
    public function index()
    {
        $invoicesetting = InvoiceSetting::first();
        return view('page_transaksi.invoice_setting.index', compact('invoicesetting'));
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'logo_invoice' => 'nullable',
            'name_invoice' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
            'website' => 'nullable',
            'instagram' => 'nullable',
            'ttd_image' => 'nullable',
            'ttd_name' => 'nullable',
            'ttd_position' => 'nullable',
        ]);
        $invoicesetting = InvoiceSetting::first();
        if ($request->hasFile('logo_invoice')) {
            $logoPath = $request->file('logo_invoice')->store('invoice', 'public');
            if ($invoicesetting && $invoicesetting->logo_invoice) {
                Storage::disk('public')->delete($invoicesetting->logo_invoice);
            }
            $validated['logo_invoice'] = $logoPath;
        }
        if ($request->hasFile('ttd_image')) {
            $logoPath = $request->file('ttd_image')->store('invoice', 'public');
            if ($invoicesetting && $invoicesetting->ttd_image) {
                Storage::disk('public')->delete($invoicesetting->ttd_image);
            }
            $validated['ttd_image'] = $logoPath;
        }
        if ($invoicesetting) {
            $invoicesetting->update($validated);
        } else {
            InvoiceSetting::create($validated);
        }
        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
