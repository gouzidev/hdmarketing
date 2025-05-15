<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $req)
    {
        if (Auth::check())
        {
            /** @var \App\Models\User $user */
            $user = Auth::user()->only(['name', 'email', 'phone', 'city', 'country']);
            return view('pages.profile.profile', ['user' => $user]);
        }
        return redirect()->route('login')->with('error', 'يجب تسجيل الدخول للوصول إلى صفحة الملف الشخصي');
    }
    public function edit(Request $req)
    {
        $messages = [
            'filled' => 'لا يمكن أن يكون أي حقل فارغاً',
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
            'name' => 'nullable|string|max:255|min:3|filled',
            'email' => 'nullable|email|max:255|filled|unique:users,email,'.Auth::id(),
            'phone' => 'nullable|string|max:20|filled|min:10',
            'city' => 'nullable|string|max:255|filled',
            'country' => 'nullable|string|filled|size:2',
            'password' => 'nullable|filled|min:8',
            'confirm' => 'nullable|filled|string|same:password'
        ];
    
        // Validate the request
        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if (isset($validatedData['password'])){
            if (isset($validatedData['confirm']))
            {
                if ($validatedData['password'] == $validatedData['confirm'])
                    $validatedData['password'] = Hash::make($validatedData['password']);
            }
        } else {
            unset($validatedData['password']);
        }
        // auth()->user()->update($validatedData); changed to :
        Auth::user()->update($validatedData);
        return back()->with('success', 'تم تحديث البيانات بنجاح');
    }
    public function serveDashboard(Request $req)
    {
        $user_id = Auth::user()->id;
        $hasPendingRequest = AdminRequest::where('user_id', $user_id)
        ->where('status', 'pending')
        ->exists();
        ;
        $orders = OrderController::getOrders($user_id);
        return view('pages.profile.dashboard', ['hasPendingRequest' => $hasPendingRequest]);
    }
    public function requestAdmin($id)
    {
        // Verify authenticated user matches requested ID
        if (Auth::id() != $id) {
            return redirect()->route('login')->with('error', 'غير مصرح بهذا الإجراء');
        }
    
        // Check for existing pending requests
        if (Auth::user()->adminRequests()->where('status', 'pending')->exists()) {
            return back()->with('error', 'لديك طلب معلق بالفعل. يرجى الانتظار حتى المراجعة');
        }
    
        // Create new admin request
        AdminRequest::create([
            'user_id' => $id,
            'description' => 'طلب صلاحيات مدير',
            'admin_id' => null,
            'status' => 'pending',
        ]);
    
        return back()->with('success', 'تم إرسال طلبك بنجاح. سيتم مراجعته من قبل المسؤولين');
    }
    public function wallet()
    {
        if (Auth::check())
        {
            /** @var \App\Models\User $user */
            $user = Auth::user()    ;
            
            $orders = Order::where('affiliate_id', $user->id)->where('payment_status', 'paid')->get();
            $AllOrders = Order::where('affiliate_id', $user->id)->where('payment_status', 'paid')->get();
            $SoonPayedOrders = Order::where('affiliate_id', $user->id)->where('status', 'accepted')
                ->where('shipping_status', '!=', 'pending')
                ->where('payment_status', '!=', 'paid')
            ->get();
            $totalSales = 0;
            $tempSale = 0;
            $tempProfit = 0;
            $totalProfit = 0;
            $numOrders = 0;
            foreach ($orders as $order)
            {
                $numOrders ++;
                $tempSale = $order->quantity * $order->affiliate_price;
                $tempProfit = $tempSale - ($order->product->price * $order->quantity);

                $totalSales += $tempSale;
                $totalProfit += $tempProfit;
            }
            $nextProfit = 0;
            $numNextOrders = 0;

            foreach ($SoonPayedOrders as $order)
            {
                $tempSale = $order->quantity * $order->affiliate_price;
                $numNextOrders++;
                $nextProfit += $tempSale - ($order->product->price * $order->quantity);
            }
            return view('pages.profile.wallet', [
                'user' => $user,
                'numOrders' => $numOrders,
                'orders' => $orders,
                'totalSales' => $totalSales,
                'totalProfit' => $totalProfit,
                'numNextOrders' => $numNextOrders,
                'nextProfit' => $nextProfit,
            ]);
        }
        return redirect()->route('login')->with('error', 'يجب تسجيل الدخول للوصول إلى صفحة الملف الشخصي');
    }
}
