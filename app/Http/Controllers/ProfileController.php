<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $req)
    {
        if (Auth::check())
        {
            $user = auth()->user()->only(['name', 'email', 'phone', 'city', 'country']);
            return view('profile', ['user' => $user]);
        }
        return redirect()->route('login')->with('error', 'يجب تسجيل الدخول للوصول إلى صفحة الملف الشخصي');
    }
    public function edit(Request $req)
    {
        $messages = [
            'name.max' => '* يجب ألا يتجاوز اسم المستخدم 255 حرفًا',
            'name.min' => '* يجب أن يحتوي اسم المستخدم على الأقل 3 أحرف',
            'email.email' => '* يجب إدخال بريد إلكتروني صحيح',
            'email.unique' => '* هذا البريد الإلكتروني مستخدم بالفعل',
            'phone.min' => '* يجب أن يتجاوز رقم الهاتف 10 أرقام',
            'phone.max' => '* يجب ألا يتجاوز رقم الهاتف 20 رقماً',
            'city.max' => '* يجب ألا يتجاوز اسم المدينة 255 حرفًا',
            'country.size' => '* يجب اختيار بلد صحيح',
            'password.min' => '* يجب أن تحتوي كلمة المرور على الأقل 8 أحرف',
            'password.confirmed' => '* كلمة المرور غير متطابقة'
        ];
    
        // Conditional validation rules
        $rules = [
            'name' => 'nullable|string|max:255|min:3',
            'email' => 'nullable|email|max:255|unique:users,email,'.auth()->id(),
            'phone' => 'nullable|string|max:20|min:10',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|size:2',
            'password' => 'nullable|min:8',
            'confirm' => 'nullable|string|same:password'
        ];
    
        // Validate the request
        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $validatedData = $validator->validated();
    
        if (isset($validatedData['password'])) {
            if (isset($validatedData['confirm']))
            {
                if ($validatedData['password'] == $validatedData['confirm'])
                    $validatedData['password'] = Hash::make($validatedData['password']);
            }
        } else {
            unset($validatedData['password']);
        }
        auth()->user()->update($validatedData);
        return back()->with('success', 'تم تحديث البيانات بنجاح');
    }
}
