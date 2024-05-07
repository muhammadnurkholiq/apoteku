<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $subTotal = $cartItems->reduce(function ($carry, $item) {
            return $carry + $item->product->price;
        }, 0);

        $ppn = $subTotal * 0.11;

        $deliveryFee = 10000;

        $total = $subTotal + $ppn + $deliveryFee;

        return view('cart.show', [
            'cartItems' => $cartItems,
            'subTotal' => $subTotal,
            'ppn' => $ppn,
            'deliveryFee' => $deliveryFee,
            'total' => $total,
        ]);
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
    public function store(Request $request, $productId)
    {
        // create
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        // response
        return back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // get
        $cartItem = Cart::findOrFail($id);

        // delete
        $cartItem->delete();

        // response
        return redirect()->route('cart.show')->with('success', 'Item removed from cart successfully!');
    }
}
