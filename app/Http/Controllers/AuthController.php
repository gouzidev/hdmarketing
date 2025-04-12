<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function getLoginPage(Request $req)
    {
        return view("login");
    }

    function login(Request $req)
    {
        $messages = [
            'email.required' => '* البريد الإلكتروني مطلوب',
            'email.min' => '* يجب أن يحتوي البريد الإلكتروني على الأقل 8 أحرف',
            'email.max' => '* يجب ألا يتجاوز البريد الإلكتروني 30 حرفًا',
            'password.required' => '* كلمة المرور مطلوبة',
            'password.min' => '* يجب أن تحتوي كلمة المرور على الأقل 8 أحرف',
            'password.max' => '* يجب ألا تتجاوز كلمة المرور 30 حرفًا'
        ];

        $validator = Validator::make($req->all(), [
            'email' => 'required|min:8|max:30',
            'password' => 'required|min:8|max:30'
        ], $messages);
        
        if ($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $validated = $validator->validated();

        if (Auth::attempt(['email' => $validated->email, 'password' => $validated->password]))
            return redirect()->intended('/dashboard')->with('success', 'تم تسجيل الدخول بنجاح');
        return redirect()->back()
            ->withErrors(['auth' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة'])
            ->withInput(['email' => $credentials['email']]);
    
    }
    function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('/login')->with('sucess', 'تم تسجيل الدخول بنجاح');
    }
    function register(Request $req)
    {
        $messages = [
            'name.required' => '* اسم المستخدم مطلوب',
            'name.min' => '* يجب أن يحتوي اسم المستخدم على الأقل 3 أحرف',
            'name.max' => '* يجب ألا يتجاوز اسم المستخدم 50 حرفًا',
            'email.required' => '* البريد الإلكتروني مطلوب',
            'email.email' => '* يرجى إدخال بريد إلكتروني صالح',
            'email.max' => '* يجب ألا يتجاوز البريد الإلكتروني 50 حرفًا',
            'password.required' => '* كلمة المرور مطلوبة',
            'password.min' => '* يجب أن تحتوي كلمة المرور على الأقل 8 أحرف',
            'password.max' => '* يجب ألا تتجاوز كلمة المرور 30 حرفًا',
            'confirm.required' => '* تأكيد كلمة المرور مطلوب',
            'confirm.same' => '* كلمة المرور وتأكيدها غير متطابقين',
            'phone.required' => '* رقم الهاتف مطلوب',
            'phone.regex' => '* يرجى إدخال رقم هاتف صالح',
            'city.max' => '* يجب ألا يتجاوز اسم المدينة 50 حرفًا',
            'country.max' => '* يرجى اختيار بلد صالح'
        ];
    
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|min:8|max:30',
            'confirm' => 'required|same:password',
            'phone' => 'required|regex:/^[0-9\+\-\s]+$/',
            'city' => 'nullable|max:50',
            'country' => 'nullable|max:2'
        ], $messages);
        
        if ($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $validated = $validator->validated();
        
        // Add your registration logic here
        
        return view("dashboard");
    }
    function getRegisterPage(Request $req)
    {
        return view("register");
    }
}
