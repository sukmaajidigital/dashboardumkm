<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomerController extends Controller
{
    // Method untuk menampilkan halaman
    public function index()
    {
        $kategoris = Kategori::all();
        $customers = Customer::with('kategori')->get();
        return view('page_customer.customer.index', compact('kategoris', 'customers'));
    }
    public function create()
    {
        $kategoris = Kategori::all();
        return view('page_customer.customer.form', compact('kategoris'));
    }
    public function edit(Customer $customer)
    {
        $kategoris = Kategori::all();
        return view('page_customer.customer.edit', compact('kategoris', 'customer'));
    }
    // Method untuk menyimpan data
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'telepon' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'histori_pembelian' => 'nullable|string',
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
                'kategori_id' => 'required|exists:kategoris,id',
                'telepon' => 'required|string|max:255',
                'alamat' => 'required|string',
                'email' => 'required|email',
                'histori_pembelian' => 'nullable|string',
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
