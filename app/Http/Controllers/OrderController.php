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
}
