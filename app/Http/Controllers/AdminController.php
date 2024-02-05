<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('id', '!=', auth()->user()->id )->latest()->get();
        return view('BackEnd.admin.admin_list', compact('admins'));
    }

    public function register()
    {
        return view('BackEnd.admin.register');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|max:20',
            'password_confirmation' => 'required|same:password',
        ]);
        $admin = new User();
        $admin->name = $request->name;
        $admin->slug =  Str::slug($request->name.'-'.rand('00', '99'));
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();
        return back()->with('sms', 'Admin Created');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|max:20',
            'password_confirmation' => 'required|same:password',
        ]);
        $admin = User::find($request->id);

        $admin->update([
            'name' =>  $request->name,
            'slug' =>  Str::slug($request->name.'-'.rand('00', '99')),
            'email' =>  $request->email,
            'password' =>  bcrypt($request->password),
        ]);

        return back()->with('sms', 'Admin Information Update');
    }

    public function destroy($id)
    {
        $admin = User::find($id);
        $admin->delete();
        return back()->with('sms', 'Admin Deleted');
    }
}
