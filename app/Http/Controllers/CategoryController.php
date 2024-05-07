<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get
        $categories = Category::latest()->paginate(5);

        // response
        return view('admin.categories.index', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // response
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate
        $request->validate([
            'name' => 'required|min:3'
        ]);

        // create
        Category::create([
            'name' => $request->name,
        ]);

        // response
        return redirect()->route('admin.categories.index')->with(['Success' => 'Category data successfully created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        // response
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        // validate
        $request->validate([
            'name' => 'required|min:3'
        ]);

        // update 
        $category->update([
            'name' => $request->name
        ]);

        //response
        return redirect()->route('admin.categories.index', compact('category'))->with(['Success' => 'Category data successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        // get
        $category = Category::findOrFail($category->id);

        // delete
        $category->delete();

        // response
        return redirect()->route('admin.categories.index')->with(['Success' => 'Category data successfully deleted']);
    }
}
