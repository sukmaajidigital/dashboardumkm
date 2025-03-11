<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerKategori;

class CustomerController extends Controller
{
    // Method untuk menampilkan halaman
    public function index()
    {
        $customerkategoris = CustomerKategori::all();
        $customers = Customer::with('customerkategori')->get();
        return view('page_customer.customer.index', compact('customerkategoris', 'customers'));
    }
    public function create()
    {
        $customerkategoris = CustomerKategori::all();
        return view('page_customer.customer.form', compact('customerkategoris'));
    }
    public function edit(Customer $customer)
    {
        $customerkategoris = CustomerKategori::all();
        return view('page_customer.customer.edit', compact('customerkategoris', 'customer'));
    }
    // Method untuk menyimpan data
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'customer_kategori_id' => 'required|exists:customer_kategoris,id',
            'telepon' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'history_pembelian' => 'nullable|string',
        ]);

        Customer::create($validated);
        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan.');
    }

    // Method untuk mengupdate data
    public function update(Request $request, Customer $customer)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nama_customer' => 'required|string|max:255',
                'customer_kategori_id' => 'required|exists:customer_kategoris,id',
                'telepon' => 'required|string|max:255',
                'alamat' => 'required|string',
                'email' => 'required|email',
                'history_pembelian' => 'nullable|string',
            ]);

            $customer->update($validated);
            return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('customer.index')->with('error', 'Failed to update customer.');
        }
    }

    // Method untuk menghapus data
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('customer.index')->with('error', 'Gagal menghapus customer.');
        }
    }
}
