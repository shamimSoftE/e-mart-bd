<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCharge;
use Illuminate\Http\Request;

class DeliveryChargeController extends Controller
{
    public function index()
    {
        $charges = DeliveryCharge::latest()->get();
        return view('BackEnd.shipping_charge.list',compact('charges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('BackEnd.shipping_charge.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DeliveryCharge::create($request->all());

        return back()->with('sms', 'Charge Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingCharge  $shippingCharge
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryCharge $shippingCharge)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingCharge  $shippingCharge
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryCharge $shippingCharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShippingCharge  $shippingCharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryCharge $charge)
    {
        $charge->update($request->all());

        return back()->with('sms', 'Charge Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingCharge  $shippingCharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryCharge $charge)
    {
        $charge->delete();

        return back()->with('sms', 'Charge Deleted');
    }

    public function status($id)
    {
        $charge = DeliveryCharge::find($id);
        if($charge->status == 0)
        {
            $charge->status = 1;
            $charge->save();
            return back()->with('sms', 'Charge Available');
        }
        else
        {
            $charge->status = 0;
            $charge->save();
            return back()->with('sms', 'Charge Unavailable');
        }
    }
}
