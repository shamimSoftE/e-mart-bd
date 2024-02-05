<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::latest()->get();
        return view('BackEnd.color.color-list', compact('colors'));
    }

    public function create()
    {
        return view('BackEnd.color.color-add');
    }

    public function show()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|regex:/^[a-zA-Z]/|unique:colors'
        ]);


        Color::create($request->only('name'));

        return back()->with('sms','Color Stored');
    }

    public function update(Color $color,Request $request)
    {

       $color->update($request->only('name'));

        return back()->with('sms','Color updated');
    }

    public function active(Request $request)
    {
        $color = Color::find($request->id);
        $color->status = 1;
        $color->save();
        return back()->with('sms','Color available in public');
    }
    public function deactive(Request $request)
    {
        $color = Color::find($request->id);
        $color->status = 0;
        $color->save();
        return back()->with('sms','Color in private mode');
    }


    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();
        return back()->with('sms','Color Destroyed');
    }
}
