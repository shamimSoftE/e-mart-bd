<?php

namespace App\Http\Controllers;

use App\Models\OrderCancel;
use Illuminate\Http\Request;

class OrderCancelController extends Controller
{
    public function store(Request $request)
    {
        OrderCancel::create($request->all());
        return back()->with('sms', 'We will cancel your order');
    }

    public function canceledOrder()
    {
        $canceled = OrderCancel::latest()->get();
        return view('BackEnd.order.order_cancel',compact('canceled'));
    }
}
