<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get 
        $products = Product::with('category')->latest()->paginate(10);

        // response
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate
        $request->validate([
            'name' => 'required|min:3',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'price' => 'required|numeric',
            'about' => 'required',
            'category_id' => [
                'required', Rule::exists('categories', 'id')
            ]
        ]);

        // upload image
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('public/products', $image->hashName());
        } else {
            return redirect()->back()->withErrors(['photo' => 'Photo upload is required']);
        }

        // create product
        Product::create([
            'name' => $request->name,
            'photo' => $image->hashName(),
            'price' => $request->price,
            'about' => $request->about,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('admin.products.index')->with(['Success' => 'Product data successfully created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        // get
        $product = Product::with('category')->findOrFail($product->id);
        $categories = Category::all();

        // response
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        // validate
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'about' => 'required',
            'category_id' => [
                'required', Rule::exists('categories', 'id')
            ]
        ]);

        // get
        $product = Product::findOrFail($product->id);

        //check if image is uploaded
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('public/products', $image->hashName());

            Storage::delete('public/products/' . $product->photo);

            $product->update([
                'photo' => $image->hashName(),
                'name' => $request->name,
                'price' => $request->price,
                'about' => $request->about,
                'category_id' => $request->category_id
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'about' => $request->about,
                'category_id' => $request->category_id
            ]);
        }

        return redirect()->route('admin.products.index')->with(['Success' => 'Product data successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // get
        $product = Product::findOrFail($product->id);

        // delete 
        Storage::delete('public/products/' . $product->photo);
        $product->delete();

        return redirect()->route('admin.products.index')->with(['Success' => 'Product data successfully deleted']);
    }
}
