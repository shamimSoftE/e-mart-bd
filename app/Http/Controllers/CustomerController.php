<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        $check = $request->all();

        //  dd($check);

        if(Auth::attempt([
            'email' => $check['email'],
             'password' => $check['password']
        ]))
        {
            $cartItem = \Cart::getContent();

            if($cartItem->count() >0)
            {
                return redirect()->route('cart_item');
            }else{
                // return redirect()->route('customer_dashboard');
                return redirect()->back();
            }

        }
        elseif (Auth::attempt([
            'phone_number' => $check['email'],
            'password' => $check['password']
        ]))
        {
            $cartItem = \Cart::getContent();

            if($cartItem->count() >0)
            {
                return redirect()->route('cart_item');
            }else{
                return redirect()->back();
            }
        }
        else{
           return back()->with('error', 'Invalid email or password');
        }
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|min:3|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }

     try {
        $user = new User();

        $user->name = $request->name;
        $user->slug = Str::slug($request->name).'-'.rand('111', '999');
        $user->email =$request->email;
        $user->password = Hash::make($request->password);
        $user->agreement = "I agree to the privacy police";
        $user->type = "customer";
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        // return back()->with('sms', "Thanks for your joinig, 'Please Check your email and verify it' ");
        return back()->with('sms', "Thanks for your joinig");
     } catch (\Throwable $th) {
        return redirect()->back()->with('error', "Something went wrong!");
     }

    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email',
            // 'phone_number' => 'required|numeric',
            'password' => 'max:30',
            'password_confirmation' => 'same:password',
        ]);

        $user = User::findOrFail($request->id);

        if($request->password === null)
        {
            $password = $user->password;
        }else
        {
            $password = Hash::make($request->password);
        }
        unset($request['password_confirmation']);

        $user->update([
            'name' => $request->name,
            'slug' =>  Str::slug($request->name.'-'.rand('00', '99')),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => $password,
        ]);
        // dd($user);
        return back()->with('sms','Information Updated!');
    }

    public function dashboard()
    {
        $customer_id = auth()->user()->id;
        $shippingAddress = ShippingAddress::where('customer_id',$customer_id)->get()->first();
        $orders = Order::where('customer_id', $customer_id)->latest()->get();

        return view('FrontEnd.pages.customer_dashboard',compact('shippingAddress', 'orders'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
