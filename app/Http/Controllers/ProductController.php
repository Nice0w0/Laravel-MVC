<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function read()
    {
        $products = Product::all();
        return view('dashboard', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'status' => $request->input('status')
        ]);
        $products = Product::all();
        return ['products' => $products];
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Product $product)
    {

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $id = $request->input('id');
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->unit = $request->input('unit');
        $product->status = $request->input('status');
        $product->save();
        $products = Product::all();
        return ['products' => $products];
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        $id = $request->input('id');
        Product::where('id', $id)->delete();
        $products = Product::all();
        return ['products' => $products];
    }
}
