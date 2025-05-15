<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;
use Log;
use PHPUnit\Event\Code\Throwable;
use Str;

class ShippingController extends Controller
{
    public function index()
    {
        $shippings = Shipping::paginate(10);
        return view('pages.admin.shipping.index', ['shippings' => $shippings]);
    }

    public function create()
    {
        return view('pages.admin.shipping.create');
    }

    public function store(Request $request)
    {
        try
        {
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
            ];
            $attributes = [
                'country' => 'الدولة',
                'city' => 'المدينة',
                'street' => 'الشارع',
                'price' => 'السعر',
            ];
            $validated = $request->validate([
                'country' => 'required|min:1|max:255|string',
                'city' => 'required|min:1|max:255|string',
                'street' => 'required|min:1|max:255|string',
                'price' => 'numeric|required|min:1|max:1000',
            ], $error_messages, $attributes);

            $validated['country'] = Str::lower(Str::trim($validated['country']));
            $validated['city'] = Str::lower(Str::trim($validated['city']));
            $validated['street'] = Str::lower(Str::trim($validated['street']));

            $shipping = Shipping::create([
                'country' => $validated['country'],
                'city' => $validated['city'],
                'street' => $validated['street'],
                'price' => $validated['price'],
            ]);
        }
        catch (Throwable $e)
        {
            Log::error('Shipping creation failed: ');
            return redirect()->back()->withErrors(['general' => 'فشل في إنشاء طريقة الشحن. يرجى المحاولة مرة أخرى.'])->withInput();
        }
        return redirect()->back()->with('success', 'تم إنشاء طريقة الشحن');
    }

    public function show(Shipping $shipping)
    {
        
        return view('pages.admin.shipping.show', ['shipping' => $shipping]);
    }

    public function edit(Shipping $shipping)
    {
        return view('pages.admin.shipping.edit', ['shipping' => $shipping]);
    }

    public function update(Request $request, Shipping $shipping)
    {
        try
        {
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
            ];
            $attributes = [
                'country' => 'الدولة',
                'city' => 'المدينة',
                'street' => 'الشارع',
                'price' => 'السعر',
            ];
            $validated = $request->validate([
                'country' => 'required|min:1|max:255|string',
                'city' => 'required|min:1|max:255|string',
                'street' => 'required|min:1|max:255|string',
                'price' => 'numeric|required|min:1|max:1000',
            ], $error_messages, $attributes);

            $validated['country'] = Str::lower(Str::trim($validated['country']));
            $validated['city'] = Str::lower(Str::trim($validated['city']));
            $validated['street'] = Str::lower(Str::trim($validated['street']));

            $shipping->update($validated);
        }
        catch (Throwable $e)
        {
            Log::error('Shipping updating failed: ');
            return redirect()->back()->withErrors(['general' => 'فشل في تحديث طريقة الشحن. يرجى المحاولة مرة أخرى.'])->withInput();
        }
        return redirect()->back()->with('success', 'تم تحديث طريقة الشحن');
    }

    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        return redirect()->back()->with('sucess', 'تم مسح طريقة الشحن بنجاح');
    }
}
