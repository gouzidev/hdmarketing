<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Storage;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show($img_path)
    {
        $storage = Storage::disk('private');
        $fullpath = $storage->path($img_path);
        if ($storage->exists($img_path))
            return response()->file($fullpath);
        abort(404);
    }
    
    public function thumbnail(Product $product)
    {
        $primary_img = $product->primary_image;
        if (!$primary_img)
        {
            return response()->file(public_path('images/default-product.jpg'));
        }
        // $path = $image->store('products/' . $product->id, 'private');

        $path = storage_path('app/private/' . $primary_img->path);
        if (!$path)
            abort(404);
        return response()->file($path);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImage $productImage)
    {
        //
    }
}
