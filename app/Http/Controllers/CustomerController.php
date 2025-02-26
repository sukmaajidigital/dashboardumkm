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
        return view('page.customer.index', compact('kategoris'));
    }

    // Method untuk mengambil data dalam format JSON
    public function getData(Request $request): JsonResponse
    {
        $data = Customer::with('kategori');
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $kategoris = Kategori::all();
                return view('components.modal.editmodal', [
                    'id' => "modaledit-" . $row->id,
                    'title' => "Edit Data",
                    'routes' =>  route('customer.update', $row->id),
                    'slot' => view('page.customer.form', compact('kategoris'))
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
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
            $customer->update($request->all());
            return response()->json(['success' => 'Customer updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update customer.'], 500);
        }
    }

    // Method untuk menghapus data
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return response()->json(['success' => 'Customer deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete customer.'], 500);
        }
    }
}
