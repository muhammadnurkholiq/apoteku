<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get
        $transactions = Transactions::latest()->paginate(5);

        // response
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'address' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'phone_number' => 'required',
            'notes' => 'required',
            'proof' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('proof')) {
            $proof = $request->file('proof');
            $proof->storeAs('public/transactions', $proof->hashName());
        } else {
            return redirect()->back()->withErrors(['proof' => 'proof upload is required']);
        }

        Transactions::create([
            'user_id' => Auth::id(),
            'total_amount' => $request->total_amount,
            'is_paid' => false,
            'address' => $request->address,
            'city' => $request->city,
            'post_code' => $request->post_code,
            'phone_number' => $request->phone_number,
            'notes' => $request->notes,
            'proof' => $proof->hashName(),
        ]);

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('dashboard')->with(['Success' => 'Transaction data successfully created and cart items removed']);
    }


    /**
     * Display the specified resource.
     */
    public function show(transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transactions $transactions)
    {
        //
    }
}
