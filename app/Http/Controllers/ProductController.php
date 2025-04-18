<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images')->paginate(10);
        return view('product.index', ["products" => $products]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:100|string',
            'desc' => 'nullable|min:3|max:1000|string',
            'stock' => 'numeric|min:0|max:100000',
            'price' => 'numeric|required|min:0.1|max:9999999',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $product = Product::create(
        [
            'user_id' => Auth::user()->id,
            'name' => $validated['name'],
            'desc' => $validated['desc'],
            'stock' => $validated['stock'],
            'price' => $validated['price'],
        ]
        );
        if ($request->hasFile('images'))
        {
            foreach ($request->file('images') as $image) {
                // Store the image
                $path = $image->store('products/' . $product->id, 'private');
                
                // Create image record
                $product->images()->create([
                    'path' => $path,
                ]);
            }
        }
        return redirect()->route('admin.products.show', $product)
            ->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        dd($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
