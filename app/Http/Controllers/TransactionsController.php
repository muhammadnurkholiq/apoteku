<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

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
        //
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