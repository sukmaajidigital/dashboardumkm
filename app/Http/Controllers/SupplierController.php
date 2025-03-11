<?php

namespace App\Http\Controllers;

use App\Exports\SupplierExport;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{
    public function ajax()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }
    public function index(): View
    {
        $suppliers = Supplier::all();
        return view('page_bahan.supplier.index', compact('suppliers'));
    }

    public function create(): View
    {
        return view('page_bahan.supplier.form');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            Supplier::create($request->all());
            return redirect()->route('supplier.index')->with('success', 'supplier created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to create supplier.');
        }
    }

    public function edit(Supplier $supplier): View
    {
        return view('page_bahan.supplier.edit', compact('supplier'));
    }
    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        try {
            $supplier->update($request->all());
            return redirect()->route('supplier.index')->with('success', 'supplier update successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('Failed to update supplier.');
        }
    }
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return to_route('supplier.index')->with('success', 'supplier Deleted successfully.');
    }
    public function export(Request $request)
    {
        $format = $request->input('format');
        $suppliers = Supplier::all();

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('page_bahan.supplier.export', compact('suppliers'));
            return $pdf->download('supplier.pdf');
        } elseif ($format === 'excel') {
            return Excel::download(new SupplierExport($suppliers), 'supplier.xlsx');
        }

        return redirect()->back();
    }
}
