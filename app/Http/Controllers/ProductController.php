<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use PHPUnit\Event\Code\Throwable;
use Illuminate\Validation\ValidationException;
use \Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Http\Controllers\HelperMethodsController;
use Str;

use PHPUnit\Exception;

class ProductController extends Controller
{
    static private function getTranslatedCategories($cat)
    {
        $arr  = 
        [
            'clothes'       => 'ملابس',
            'kitchen_home'  => 'المنزل والمطبخ',
            'beauty_health' => 'الصحة والجمال',
            'electronics'   => 'هواتف وأجهزة ذكية',
            'real_estate'   => 'بيع العقار',
            'cars'          => 'بيع السيارات'
        ];
        return $arr[$cat];
    }
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
                'in' => 'قيمة :attribute غير صالحة. يجب أن تكون واحدة من: :values',
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
                'category' => 'التصنيف',
                'primary_image' => 'الصورة الرئيسية',
                'additional_images.*' => 'الصور الإضافية',
            ];
            $validated = $request->validate([
                'name' => 'required|min:3|max:255|string',
                'desc' => 'nullable|min:3|max:2000|string',
                'stock' => 'numeric|min:0|max:100000',
                'price' => 'numeric|required|min:0.1|max:9999999',
                'category' => ['required', Rule::in(['clothes', 'kitchen_home', 'beauty_health', 'electronics', 'real_estate', 'cars'])],
                'primary_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], $error_messages, $attributes);

            $validated['name'] = Str::trim($validated['name']);
            $validated['desc'] = Str::trim($validated['desc']);
            $product = Product::create([
                'user_id' => Auth::user()->id,
                'name' => $validated['name'],
                'desc' => $validated['desc'] ?? null,
                'stock' => $validated['stock'] ?? 0,
                'category' => $validated['category'] ?? 0,
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
                return back()->withErrors(['primary_image' => 'فشل تحميل الصورة الأساسية. يُرجى المحاولة مرة أخرى.']);
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
                    return redirect()->route('products.product', $product)
                        ->with('warning', 'تم إنشاء المنتج ولكن فشل تحميل بعض الصور الإضافية.');
                }
            }
            
            return redirect()->route('products.product', $product)
                ->with('success', 'تم إنشاء المنتج');
        } catch (ValidationException $e) {
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
        $product->category = ProductController::getTranslatedCategories($product->category);
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

    public function checkout(Request $request, Product $product)
    {
        if ($request->input('quantity') == null)
            return redirect('notverified');
        $quantity = $request->input('quantity');
        if ($quantity < 1 || $quantity > 10000)
            return redirect('notverified');
        if (!Auth::user()->verified)
        return redirect('notverified');
        $shippings = Shipping::all();
        return view("product.checkout", [
            'product' => $product,
            'shippings' => $shippings,
            'quantity' => $quantity
        ]);
    }

    public function processCheckout(Request $request, Product $product)
    {
        // Validate the request data
        // Custom Arabic validation messages
        if (!Auth::user()->verified)
            return redirect('notverified');
        $messages = [
            'required' => 'حقل :attribute مطلوب.',
            'exists' => 'قيمة :attribute غير صالحة.',
            'integer' => 'يجب أن يكون :attribute رقمًا صحيحًا.',
            'numeric' => 'يجب أن يكون :attribute رقمًا.',
            'min' => [
                'numeric' => 'يجب أن تكون قيمة :attribute على الأقل :min.',
                'string' => 'يجب أن يحتوي :attribute على الأقل :min حروف.',
            ],
            'max' => [
                'numeric' => 'قيمة :attribute كبيرة جدًا.',
                'string' => 'يجب ألا يتجاوز :attribute :max حروف.',
            ],
            'email' => 'يجب أن يكون :attribute بريدًا إلكترونيًا صالحًا.',
            'in' => 'قيمة :attribute غير صالحة.',
            'accepted' => 'يجب قبول :attribute.',
        ];

        // Arabic attribute names
        $attributes = [
            'product_id' => 'معرف المنتج',
            'affiliate_id' => 'معرف البائع',
            'affiliate_price' => 'سعر البيع',
            'quantity' => 'الكمية',
            'shipping_id' => 'طريقة الشحن',
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'address' => 'العنوان',
            'country' => 'البلد',
            'city' => 'المدينة',
            'zip' => 'الرمز البريدي',
        ];

        // Validate the request data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:'.$product->stock,
            'total_price' => 'required|numeric|min:0|max:999999',
            'affiliate_price' => 'required|numeric|max:999999|min:'.$product->price,
            'shipping_id' => 'required|exists:shippings,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'nullable|string|max:20',
        ], $messages, $attributes);
        try {
            // Verify the product is still available
            if ($product->stock < $request->quantity) {
                return back()->withErrors(['quantity' => 'الكمية المطلوبة غير متوفرة في المخزن'])->withInput();
            }

            // Verify the shipping method exists and matches the selected country/city
            $shipping = Shipping::findOrFail($request->shipping_id);
            if ($shipping->country !== $request->country || $shipping->city !== $request->city) {
                return back()->withErrors(['shipping_id' => 'طريقة الشحن المحددة غير متاحة للموقع المختار'])->withInput();
            }

            // Verify the total price calculation
            $expectedTotal = ($request->affiliate_price * $request->quantity) + ($shipping->price);
            if (HelperMethodsController::abs($expectedTotal - $request->total_price) > 0.01) {
                return back()->withErrors(['total_price' => 'حساب السعر الإجمالي غير صحيح'])->withInput();
            }
            // Create the order
            $order = Order::create([
                'product_id' => $product->id,
                'affiliate_id' => Auth::user()->id,
                'quantity' => $request->quantity,
                'affiliate_price' => $request->affiliate_price,
                'shipping_id' => $shipping->id,
                'status' => 'pending',
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'country' => $request->country,
                'city' => $request->city,
                'zip' => $request->postal_code,
            ]);
    
            // Update product stock
            $product->decrement('stock', $request->quantity);
    
            // Redirect to success page
            return back()->with(['success' => 'تم الطلب بنجاح.'])->withInput();
            
    
        } catch (Exception $e) {
            // Log the error
            \Log::error('Checkout failed:');
            
            // Return with error message
            return back()->withErrors(['general' => 'حدث خطأ أثناء معالجة الطلب. يرجى المحاولة مرة أخرى.'])->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
            try {
            // Laravel's validate method already handles returning back with errors
            // You don't need to do it manually with if(!$validated)

            $error_messages = [
                'in' => 'قيمة :attribute غير صالحة. يجب أن تكون واحدة من: :values',
                'required' => 'حقل :attribute مطلوب.',
                'min' => [
                    'string' => 'يجب أن يكون :attribute على الأقل :min حروف.',
                    'numeric' => 'يجب أن تكون قيمة :attribute على الأقل :min.',
                ],
                'max' => [
                    'string' => 'يجب أن لا يتجاوز :attribute :max حروف.',
                    'numeric' => 'قيمة :attribute كبيرة جدًا.',
                    // 'file' => 'يجب أن لا يتجاوز حجم ملف :attribute :max كيلوبايت.',
                ],
                'string' => 'يجب أن يكون :attribute نصًا.',
                'numeric' => 'يجب أن يكون :attribute رقمًا.',
                // 'image' => 'يجب أن يكون :attribute صورة.',
                // 'mimes' => 'يجب أن يكون :attribute من نوع: :values.',
            ];
            $attributes = [
                'name' => 'الاسم',
                'desc' => 'الوصف',
                'stock' => 'المخزون',
                'price' => 'السعر',
                'category' => 'التصنيف',
                // 'primary_image' => 'الصورة الرئيسية',
                // 'additional_images.*' => 'الصور الإضافية',
            ];
            $validated = $request->validate([
                'name' => 'required|min:3|max:255|string',
                'desc' => 'nullable|min:3|max:2000|string',
                'stock' => 'numeric|min:0|max:100000',
                'price' => 'numeric|required|min:0.1|max:9999999',
                'category' => ['required', Rule::in(['clothes', 'kitchen_home', 'beauty_health', 'electronics', 'real_estate', 'cars'])]
                // 'primary_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                // 'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], $error_messages, $attributes);

            $validated['name'] = Str::trim($validated['name']);
            $validated['desc'] = Str::trim($validated['desc']);
            $validated['category'] = Str::trim($validated['category']);
            $product->update([
                'user_id' => Auth::user()->id,
                'name' => $validated['name'],
                'desc' => $validated['desc'] ?? null,
                'stock' => $validated['stock'] ?? 0,
                'price' => $validated['price'],
                'category' => $validated['category'],
            ]);
        }
        catch (ValidationException $e)
        {
            dd($e->errors());
            Log::error('Product creation failed: ');
            return redirect()->back()->withErrors(['general' => 'فشل في إنشاء المنتج. يرجى المحاولة مرة أخرى.'])->withInput();
        }

        return back()->with('success', 'تم تحديث المنتج بنجاح');
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
        try {
            $imgs = $product->images();
            DB::transaction();
            $product->delete();
            return redirect()->route('products.index')
                ->with('success', 'تم حذف المنتج بنجاح');
        }
        catch (Exception $e)
        {
            Log::error('Product creation failed: ');
            return redirect()->back()->withErrors(['general' => 'فشل في حذف المنتج. يرجى المحاولة مرة أخرى.'])->withInput();
        }
    }
}
