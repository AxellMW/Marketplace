<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::whereHas('order', function($query) {
            $query->where('customer_id', Auth::id())
                  ->orWhere('merchant_id', Auth::id());
        })->get();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::where('customer_id', Auth::id())->get();
        return view('invoices.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'invoice_number' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        // Create the invoice
        Invoice::create([
            'order_id' => $request->order_id,
            'invoice_number' => $request->invoice_number,
            'amount' => $request->amount,
        ]);

        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $orders = Order::where('customer_id', Auth::id())->get();
        return view('invoices.edit', compact('invoice', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'invoice_number' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        // Update the invoice
        $invoice->update([
            'order_id' => $request->order_id,
            'invoice_number' => $request->invoice_number,
            'amount' => $request->amount,
        ]);

        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice->delete();

        return redirect()->route('invoices.index');
    }
}
