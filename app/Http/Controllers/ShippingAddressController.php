<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    public function showForm()
    {
        return view('FrontEnd.pages.shipping_address_add');
    }

    public function storeShipping(Request $request)
    {
        // dd($request->all());
        ShippingAddress::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'delivery_charge_id' => $request->delivery_charge_id,
            // 'state' => $request->state,
            // 'pincode' => $request->pincode,
            // 'country' => $request->country,
            'customer_id' => auth()->user()->id,
        ]);
        // dd('okay');
        return redirect()->route('cart_item')->with('sms', 'Shipping Address Added');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $shipping = ShippingAddress::where('customer_id',$user->id)->get()->first();

        return view('FrontEnd.pages.shipping_address_edit', compact('shipping'));
    }

    public function update(Request $request,$id)
    {
        $shipping = ShippingAddress::findOrFail($id);

        $shipping->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'delivery_charge_id' => $request->delivery_charge_id,
            'customer_id' => auth()->user()->id,
        ]);

        $cartItem = \Cart::getContent();
        if($cartItem->count() >= 1)
        {
            return redirect()->route('cart_item')->with('sms', 'Shipping Address Updated');
        }
        else
        {
            return redirect()->route('customer_dashboard')->with('sms', 'Shipping Address Updated');
        }

    }


    public function destroy($id)
    {
        $address = ShippingAddress::findOrFail($id);

        $address->delete();
        return back()->with('sms', 'Address Deleted');
    }
}
