<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);
        // return view('o')

    }
    static public function getOrders($user_id)
    {
        $orders = Order::where('user');
        return $orders;
    }
}
