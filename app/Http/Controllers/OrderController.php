<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\CountryService;
use Illuminate\Support\Facades\Auth;
use Number;

class OrderController extends Controller
{
    protected $countryService;
    
    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public  function getChangePerc($old, $new)
    {
        $percentage = 0;
        $percentage = ($new - $old) * 100;
        if ($old != 0)
            $percentage /= $old;
        $percentage = Number::format($percentage, 2);
        return $percentage;
    }
    public function index()
    {

        $user_id = Auth::user()->id;

        $lastweek = Carbon::now()->subWeek()->subWeek();
        $thisweek = Carbon::now()->subWeek();


        $thisWeekOrderCount = Order::where('payment_date', '>', $thisweek)->count();
        $lastWeekOrderCount = Order::where('payment_date', '>', $lastweek)
            ->where('payment_date', '<', $thisweek)
            ->count();
        $orderCountPerc = $this->getChangePerc($lastWeekOrderCount, $thisWeekOrderCount);
      
        




        // processing means not accepted



        $totalOrderProcessingCount = Order::where('status', '=','pending')
            ->count();

        $lastWeekOrderProcessingCount = Order::where('status', '=','pending')
        ->where('handling_date', '>', $lastweek)
        ->where('handling_date', '<', $thisweek)
        ->count();
        $thisWeekOrderProcessingCount = Order::where('status', '=','pending')
        ->where('handling_date', '>', $thisweek)
        ->count();

        $orderProcessingCountPerc = $this->getChangePerc($lastWeekOrderProcessingCount, $thisWeekOrderProcessingCount);
       



















        $totalOrderShippingProcessingCount = Order::where('status', '=','accepted')
            ->where('payment_status', '=', 'pending')
            ->count();


        $thisWeekOrderShippingProcessingCount = Order::where('shipping_status', '!=','delivered')
            ->where('status', '=', 'accepted')
            ->where('payment_status', '=', 'pending')
            ->where('handling_date', '>', $thisweek)
            ->count();
            
        $lastWeekOrderShippingProcessingCount = Order::where('shipping_status', '!=','delivered')
        ->where('status', '=', 'accepted')
        ->where('payment_status', '=', 'pending')
        ->where('handling_date', '<', $thisweek)
        ->where('handling_date', '>', $lastweek)
        ->count();
            
        $orderShippingProcessingCountPerc = $this->getChangePerc($lastWeekOrderShippingProcessingCount, $thisWeekOrderShippingProcessingCount);
        





        
        $totalOrderShippingDeliveredCount = Order::where('shipping_status', '=','delivered')->count();
        $thisWeekOrderShippingDeliveredCount = Order::where('shipping_status', '=','delivered')
        ->where('delivery_date', '>', $thisweek)
        ->count();
    
        $lastWeekOrderShippingDeliveredCount = Order::where('shipping_status', '=','delivered')
        ->where('delivery_date', '<', $thisweek)
        ->where('delivery_date', '>', $lastweek)
        ->count();
        
        $orderShippingDeliveredCountPerc = $this->getChangePerc($lastWeekOrderShippingDeliveredCount, $thisWeekOrderShippingDeliveredCount);

        
        $orders = Order::with(
            [
            'product:id,name,price,category', 
            'affiliate:id,name,email', 
            'shipping']
        )
        ->select([
        'id',
        'affiliate_id',
        'product_id',
        'shipping_id',
        'status',
        'quantity',
        'affiliate_price',
        'payment_status',
        'created_at'
        ])
        ->paginate(10);
        return view('pages.admin.orders.index', [
            'orders'=> $orders,
            'thisWeekOrderCount' => $thisWeekOrderCount,
            'orderCountPerc' => $orderCountPerc,

            'totalOrderProcessingCount' => $totalOrderProcessingCount,
            'orderProcessingCountPerc' => $orderProcessingCountPerc,
            
            'totalOrderShippingProcessingCount' => $totalOrderShippingProcessingCount,
            'orderShippingProcessingCountPerc' => $orderShippingProcessingCountPerc,

            'totalOrderShippingDeliveredCount' => $totalOrderShippingDeliveredCount,
            'orderShippingDeliveredCountPerc' => $orderShippingDeliveredCountPerc
        ]);

    }
    public function show(Order $order)
    {
        $user_id = $order->affiliate_id;
        return view('pages.admin.orders.order', [
            'order' => $order,
            
        ]);
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
                return back()->withErrors('فشلت عملية رفض الطلب, كمية المخزون ليست كافية');
            $product->decrement('stock', $order->quantity);
            $order->handling_date = now();
            $order->status = 'accepted';
            $order->save();
            return back()->with('success', 'تم قبول الطلب بنجاح');
        }
        return back()->withErrors('فشلت عملية رفض الطلب');
    }

    public function rejectOrder(Order $order)
    {
        if ($order->payment_status == 'paid')
        {
            return back()->withErrors('فشلت عملية رفض الطلب, يجب إلغاء الدفع أولاً');
        }
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
            return back()->with('success', 'تم تحديث معلومات شحن الطلب بنجاح');
        }
        return back()->withErrors('فشل تحديث معلومات شحن الطلب');
    }

    public function makeDelivered(Order $order)
    {
        if ($order->shipping_status == 'shipped')
        {
            $order->delivery_date = now();
            $order->shipping_status = 'delivered';
            $order->save();
            return back()->with('success', 'تم تحديث معلومات شحن الطلب بنجاح');
        }
        return back()->withErrors('يجب شحن الطلب أولاً');
    }
    
    public function makePayed(Order $order)
    {
        if ($order->payment_status == 'pending')
        {
            $order->payment_date = now();
            $order->payment_status = 'paid';
            $order->save();
            return back()->with('success', 'تم تحديث معلومات الدفع للطلب بنجاح');
        }
        return back()->withErrors('فشلت عملية الدفع');
    }
    
    public function makeUnPayed(Order $order)
    {
        if ($order->payment_status == 'paid')
        {
            $order->payment_date = NULL;
            $order->payment_status = 'pending';
            $order->save();
            return back()->with('success', 'تم تحديث معلومات الدفع للطلب بنجاح');
        }
        return back()->withErrors('يجب الدفع أولاً');
    }
    
    public function cancelShipping(Order $order)
    {
        if ($order->shipping_status != 'pending')
        {
            $order->shipping_status = 'pending';
            $order->payment_date = NULL;
            $order->payment_status = 'pending';
            $order->shipping_date = null;
            $order->delivery_date = null;
            $order->save();
            return back()->with('success', 'تم إلغاء شحن الطلب بنجاح');
        }
        return back()->withErrors('يجب شحن الطلب أولاً');
    }

    public function destroy(Order $order)
    {
        if ($order->affiliate_id != Auth::user()->id)
            return back()->withErrors('فشل في حذف الطلب');
        $product = $order->product();
        // Update product stock
        $product->increment('stock', $order->quantity);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'تم حذف الطلب بنجاح');
    }

    public function userOrders()
    {
        $user = Auth::user(); 
        $orders = Order::with ('affiliate')->where('affiliate_id', $user->id)->get();
        return view ('pages.affiliate.orders.index', ['orders' => $orders]);
    }
}
