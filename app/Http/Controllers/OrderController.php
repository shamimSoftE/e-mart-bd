<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Popular;
use App\Models\Product;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function checkout (Request $request)
    {
        if($request->shipping_id == null)
        {
            return back()->with('warning', 'Please Add Your Shipping Address');
        }


        if($request->payment_type == "cash-on-delivery")
        {
            $payment = "Cash-On-Delivery";

            foreach (json_decode($request->products, true) as $data)
            {
                $pro = Product::findOrFail($data['id']);

                $qty = $pro->quantity - $data['quantity'];

                $pro->update([
                    'quantity' => $qty,
                ]);

                Popular::create([
                    'product_id' => $pro->id,
                    'category_id' => $pro->category_id,
                ]);
            }
            // dd('lol');
            Order::create([
                'customer_id' => Auth::user()->id,
                'shipping_id' => $request->shipping_id,
                'payment_type' => $payment,
                'products' => $request->products,
                'sub_total' => $request->subtotal,
                'shipping_charge' => $request->shipping_charge,
                'grand_total' => $request->shipping_charge + $request->subtotal,
                'tracking_number' => '#'.date("ymdHis").'-'.rand(11,99),
            ]);

            \Cart::clear();

            return redirect()->route('order_complete');
        }
        elseif($request->payment_type == "bKash")
        {
            $payment = "Cash-On-Delivery";

            foreach (json_decode($request->products, true) as $data)
            {
                $pro = Product::findOrFail($data['id']);

                $qty = $pro->quantity - $data['quantity'];

                $pro->update([
                    'quantity' => $qty,
                ]);

                Popular::create([
                    'product_id' => $pro->id,
                    'category_id' => $pro->category_id,
                ]);
            }

            Order::create([
                'customer_id' => Auth::user()->id,
                'shipping_id' => $request->shipping_id,
                'payment_type' => $payment,
                'products' => $request->products,
                'sub_total' => $request->subtotal,
                'shipping_charge' => $request->shipping_charge,
                'grand_total' => $request->shipping_charge + $request->subtotal,
                'tracking_number' => '#'.date("ymdHis").'-'.rand(11,99),
            ]);
            \Cart::clear();

            // $payment = "bKash";
            return redirect()->route('order_complete')->with('sms','Your Order Submitted Using Cash On Method. bKash intragation comming soon.');
        }
        else
        {
            $payment = "Cash-On-Delivery";
            foreach (json_decode($request->products, true) as $data)
            {
                $pro = Product::findOrFail($data['id']);

                $qty = $pro->quantity - $data['quantity'];

                $pro->update([
                    'quantity' => $qty,
                ]);

                Popular::create([
                    'product_id' => $pro->id,
                    'category_id' => $pro->category_id,
                ]);
            }

            Order::create([
                'customer_id' => Auth::user()->id,
                'shipping_id' => $request->shipping_id,
                'payment_type' => $payment,
                'products' => $request->products,
                'sub_total' => $request->subtotal,
                'shipping_charge' => $request->shipping_charge,
                'grand_total' => $request->shipping_charge + $request->subtotal,
                'tracking_number' => '#'.date("ymdHis").'-'.rand(11,99),
            ]);
            \Cart::clear();
            // $payment = "nagad";
            return redirect()->route('order_complete')->with('sms','Your Order Submitted Using Cash On Delivery Method. Nagad intragation comming soon.');
        }
    }


    public function complete()
    {
        return view('FrontEnd.pages.order_complete');
    }


    //===================> back end route here <================================

    public function index()
    {
        $orders = Order::latest()->get();
        return view('BackEnd.order.order_list',compact('orders'));
    }

    public function todayOrder()
    {
        $todayOrders = Order::whereDate('created_at', '=', Carbon::today()->toDateString())->get();
        return view('BackEnd.order.todaysOrder',compact('todayOrders'));
    }

    public function view($id)
    {
        $order = Order::findOrFail($id);

        return view('BackEnd.order.order_view',compact('order'));
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);

        $pdf = Pdf::loadView('BackEnd.order.order_invoice_view_old',compact('order'));
        // $pdf = Pdf::loadView('BackEnd.order.order_invoice_view',compact('order'));

        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Order-Invoice.pdf',['Attachment' => true]);
    }

    public function status($id)
    {
        $order = Order::findOrFail($id);

        if($order->status == 0)
        {
            $order->status = 1;
            $order->save();
            return back()->with('sms', 'Order In Process/Packaging');
        }
        elseif($order->status == 1)
        {
            $order->status = 2;
            $order->save();
            return back()->with('sms', 'Order Shipped');
        }
        elseif($order->status == 2)
        {
            $order->status = 3;
            $order->save();
            return back()->with('sms', 'Order Delivered');
        }
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('sms', 'Order Deleted');
    }

    public function all_orders()
    {
        $orders = Order::with('customer','shipping')->latest()->get();
        return $orders;
    }
}
