<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with('kategori')->get();
        $kategoris = Kategori::all();
        return view('page.customer.index', compact('customers', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('page.customer.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        try {
            dd($request);
            Customer::create($request->all());
            return response()->json(['success' => 'Customer created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create customer.'], 500);
        }
    }

    public function edit(Customer $customer)
    {
        $kategoris = Kategori::all();
        return view('page.customer.edit', compact('customer', 'kategoris'));
    }

    public function update(Request $request, Customer $customer)
    {
        try {
            $customer->update($request->all());
            return response()->json(['success' => 'Customer updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update customer.'], 500);
        }
    }

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
