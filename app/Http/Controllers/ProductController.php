<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\FileExists;
use Storage;
use PHPUnit\Event\Code\Throwable;
use Illuminate\Validation\ValidationException;
use \Illuminate\Support\Facades\Log;

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
        try {
            // Laravel's validate method already handles returning back with errors
            // You don't need to do it manually with if(!$validated)


            $error_messages = [
                'required' => 'حقل :attribute مطلوب.',
                'min' => [
                    'string' => 'يجب أن يكون :attribute على الأقل :min حروف.',
                    'numeric' => 'يجب أن تكون قيمة :attribute على الأقل :min.',
                ],
                'max' => [
                    'string' => 'يجب أن لا يتجاوز :attribute :max حروف.',
                    'numeric' => 'قيمة :attribute كبيرة جدًا.',
                    'file' => 'يجب أن لا يتجاوز حجم ملف :attribute :max كيلوبايت.',
                ],
                'string' => 'يجب أن يكون :attribute نصًا.',
                'numeric' => 'يجب أن يكون :attribute رقمًا.',
                'image' => 'يجب أن يكون :attribute صورة.',
                'mimes' => 'يجب أن يكون :attribute من نوع: :values.',
            ];
            $attributes = [
                'name' => 'الاسم',
                'desc' => 'الوصف',
                'stock' => 'المخزون',
                'price' => 'السعر',
                'primary_image' => 'الصورة الرئيسية',
                'additional_images.*' => 'الصور الإضافية',
            ];
            $validated = $request->validate([
                'name' => 'required|min:3|max:255|string',
                'desc' => 'nullable|min:3|max:2000|string',
                'stock' => 'numeric|min:0|max:100000',
                'price' => 'numeric|required|min:0.1|max:9999999',
                'primary_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], $error_messages, $attributes);

            $product = Product::create([
                'user_id' => Auth::user()->id,
                'name' => $validated['name'],
                'desc' => $validated['desc'] ?? null,
                'stock' => $validated['stock'] ?? 0,
                'price' => $validated['price'],
            ]);
            
            // Store primary image with error handling
            try {
                if ($request->hasFile('primary_image')) {
                    $path = $request->file('primary_image')->store('products/' . $product->id, 'private');
                    $product->images()->create([
                        'path' => $path,
                        'is_primary' => true,
                        'display_order' => 0
                    ]);
                }
            } catch (Throwable $e) {
                // If primary image upload fails, delete the product and return with error
                $product->delete();
                return back()->withErrors(['primary_image' => 'Failed to upload primary image. Please try again.']);
            }
            
            // Store additional images with error handling
            if ($request->hasFile('additional_images')) {
                try {
                    foreach ($request->file('additional_images') as $index => $image) {
                        $path = $image->store('products/' . $product->id, 'private');
                        $product->images()->create([
                            'path' => $path,
                            'is_primary' => false,
                            'display_order' => $index + 1
                        ]);
                    }
                } catch (Throwable $e) {
                    // If additional image upload fails, log the error but don't fail the entire process
                    Log::error('Failed to upload additional image: ' . $e->message());
                    // Optionally notify the user
                    // We don't delete the product here since we have the primary image
                    return redirect()->route('products.product.show', $product)
                        ->with('warning', 'تم إنشاء المنتج ولكن فشل تحميل بعض الصور الإضافية.');
                }
            }
            
            return redirect()->route('products.product.show', $product)
                ->with('success', 'Product created successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Laravel automatically handles this, but we're being explicit
            return back()->withErrors($e->errors())->withInput();
        } catch (Throwable $e) {
            // Catch any other exceptions
            Log::error('Product creation failed: ' . $e->message());
            return back()->withErrors(['general' => 'فشل في إنشاء المنتج. يرجى المحاولة مرة أخرى.'])->withInput();
        }
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
        return view("product.edit", ['product' => $product]);
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
