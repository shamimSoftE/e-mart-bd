<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function store(Request $request)
    {

        $product = Product::findOrFail($request->input('product_id'));

        /*if ($product->seller_id != NULL){
            $section = Section::find(json_decode($product->section_id)[0]);
            $commission= $section->commission;
        }else{
            $commission = 0;
        }*/


        // get image;

            $photos = json_decode($product->image);

        // get price;

            $price = $product->special_price;


        // check product qty
         $proQty = $product->quantity;

        if($proQty >= $request->input('quantity') )
        {
            \Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $request->input('quantity'),
                'price' => $price,
                // 'weight' => 250,
                'attributes' => array(
                    'image' => $photos[0],
                    'slug' => $product->slug,
                    'color_name' => $request->input('color_name'),
                )
            ]);
            return back()->with('sms', 'product Added Into The Cart');
        }
        else
        {
            return back()->with('error','Out of stock, Select valid quantity');
        }
    }
    
    public function akhoneKinun (Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        // dd($request->all());

        // get image;

            $photos = json_decode($product->image);

        // get price;

            $price = $product->special_price;


        // check product qty
         $proQty = $product->quantity;

        if($proQty >= $request->input('quantity') )
        {
            \Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $request->input('quantity'),
                'price' => $price,
                // 'weight' => 250,
                'attributes' => array(
                    'image' => $photos[0],
                    'slug' => $product->slug,
                    'color_name' => $request->input('color_name'),
                )
            ]);
            return redirect()->route('cart_item');
        }
        else
        {
            return back()->with('error','Out of stock, Select valid quantity');
        }
    }

    public function showCart()
    {
        $cartItem = \Cart::getContent();

        return view('FrontEnd.pages.cart',compact('cartItem'));
    }

    public function update(Request $request)
    {

        \Cart::update(
            $request->rowId,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->qty
                ],
            ]
        );

        // \Cart::update($request->rowId,[
        //     'quantity' => $request->qty
        //     ]);

        return back()->with('sms', 'Cart Item Update Successfully');
    }


    public function destroy($id)
    {
        // $item = Cart::get($rowId);
        // dd($item);
        \Cart::remove($id);

        return back()->with('warning', 'Cart Item Removed Successfully');
    }
}
