<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\FileExists;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images')->paginate(10);
        return view('product.index', 
            [
                "products" => $products,
                "search" => ""
            ]
        );
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
            'primary_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $product = Product::create([
            'user_id' => Auth::user()->id,
            'name' => $validated['name'],
            'desc' => $validated['desc'],
            'stock' => $validated['stock'],
            'price' => $validated['price'],
        ]);
        
        // Store primary image
        if ($request->hasFile('primary_image')) {
            $path = $request->file('primary_image')->store('products/' . $product->id, 'private');
            $product->images()->create([
                'path' => $path,
                'is_primary' => true,
                'display_order' => 0
            ]);
        }
        
        // Store additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $image) {
                $path = $image->store('products/' . $product->id, 'private');
                $product->images()->create([
                    'path' => $path,
                    'is_primary' => false,
                    'display_order' => $index + 1
                ]);
            }
        }
        
        return redirect()->route('products.product.show', $product)
            ->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.product', ['product' => $product]);
    }

    static public function default_img()
    {
        $storage = Storage::disk('public');
        $img_path = "default-product.png";
        $fullpath = $storage->path($img_path);
        if ($storage->exists($img_path))
            return response()->file($fullpath);
        abort(404);
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
    public function search(Request $request)
    {
        if (!$request->filled('search'))
        {
            return redirect()->back()
                ->withErrors(['error' => 'يجب إدخال نص للبحث'])
                ->withInput();
        }
        $search = $request->input('search');
        $products = Product::with('images')->where('name', 'like', "%{$search}%")->paginate(10);
        return view("product.index", 
            ['products' => $products],
            ['search' => $search]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
