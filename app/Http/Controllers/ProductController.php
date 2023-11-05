<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function create_product()
    {
        return view('create_product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path,
        ]);

        return Redirect::route('product.create');
    }

    public function index_products()
    {
        $products = Product::all();
        return view('index_products', compact('products'));
    }

    public function show_product(Product $product)
    {
        return view('show_product', compact('product'));
    }

    public function edit_product(Product $product)
    {
        return view('edit_product', compact('product'));
    }

    public function update_product(Product $product, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ]);


        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return Redirect::route('product.detail', $product);
    }

    public function delete_product(Product $product)
    {
        $image_file = $product->image;
        Storage::disk('local')->delete('public/' . $image_file); // hapus file image di storage

        $product->delete(); // hapus dari database
        return Redirect::route('product.index');
    }
}
