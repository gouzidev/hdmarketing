<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['product', 'affiliate', 'shipping'])->paginate(10);
        
        return view('admin.orders.index', ['orders'=> $orders]);

    }
    public function show(Order $order)
    {
        return view('admin.orders.order', ['order' => $order]);
    }
    static public function getOrders($user_id)
    {
        $orders = Order::where('user');
        return $orders;
    }
    public function acceptOrder(Order $order)
    {
        if ($order->status != 'accepted')
        {
            $product = $order->product;
            // Update product stock
            if ($product->stock < $order->quantity)
                return back()->withErrors('رفض الطلب بنجاح');
            $product->decrement('stock', $order->quantity);
            $order->handling_date = now();
            $order->status = 'accepted';
            $order->save();
            return back()->with('success', 'تم قبول الطلب بنجاح');
        }
        return back()->withErrors(' رفض الطلب بنجاح');
    }

    public function rejectOrder(Order $order)
    {
        if ($order->status != 'rejected')
        {
            $product = $order->product;
            $order->status = 'rejected';
            $order->handling_date = now();
            $order->save();
            return back()->with('success', 'تم رفض الطلب بنجاح');
        }
        return back()->withErrors('فشل رفض الطلب');
    }
    
    public function makeShipped(Order $order)
    {
        if ($order->shipping_status == 'pending')
        {
            $order->shipping_date = now();
            $order->shipping_status = 'shipped';
            $order->save();
            return back()->with('success', 'تم تحديث شحن الطلب بنجاح');
        }
        return back()->withErrors('فشل شحن الطلب');
    }

    public function makeDelivered(Order $order)
    {
        if ($order->shipping_status == 'shipped')
        {
            $order->delivery_date = now();
            $order->shipping_status = 'delivered';
            $order->save();
            return back()->with('success', 'تم تحديث شحن الطلب بنجاح');
        }
        return back()->withErrors('يجب شحن الطلب أولاً');
    }
    public function cancelShipping(Order $order)
    {
        if ($order->shipping_status != 'pending')
        {
            $order->shipping_status = 'pending';
            $order->shipping_date = null;
            $order->delivery_date = null;
            $order->save();
            return back()->with('success', 'تم إلغاء شحن الطلب بنجاح');
        }
        return back()->withErrors('يجب شحن الطلب أولاً');
    }


    public function destroy(Order $order)
    {
        $product = $order->product();
        // Update product stock
        $product->increment('stock', $order->quantity);
        $order->delete();
        return redirect()->route('orders')->with('success', 'تم حذف الطلب بنجاح');
    }
}
