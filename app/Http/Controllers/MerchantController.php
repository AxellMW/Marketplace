<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merchants = User::where('role', 'merchant')->get();
        return view('merchants.index', compact('merchants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('merchants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'business_name' => 'required',
            'business_address' => 'required',
            'business_contact' => 'required'
        ]);

        // Create the merchant
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'merchant',
            'business_name' => $request->business_name,
            'business_address' => $request->business_address,
            'business_contact' => $request->business_contact,
            'business_desc' => $request->business_desc,
        ]);

        return redirect()->route('merchants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $merchant = User::where('role', 'merchant')->findOrFail($id);
        return view('merchants.show', compact('merchant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $merchant = User::where('role', 'merchant')->findOrFail($id);
        return view('merchants.edit', compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $merchant = User::where('role', 'merchant')->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'business_name' => 'required',
            'business_address' => 'required',
            'business_contact' => 'required',
        ]);

        $merchant->update($request->all());

        return redirect()->route('merchants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $merchant = User::where('role', 'merchant')->findOrFail($id);
        $merchant->delete();

        return redirect()->route('merchants.index');
    }
}
