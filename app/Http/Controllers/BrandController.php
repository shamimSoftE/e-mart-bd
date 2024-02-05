<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('BackEnd.brand.brand-list', compact('brands'));
    }

    public function create()
    {
        return view('BackEnd.brand.brand-add');
    }

    public function show()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|regex:/^[a-zA-Z]/|unique:brands'
        ]);

        Brand::create($request->all());

        return back()->with('sms','Brand Stored');
    }

    public function update(Brand $brand,Request $request)
    {
        $brand->update($request->all());

        return back()->with('sms','Brand updated');
    }

    public function status(Request $request)
    {
        $brand = Brand::find($request->id);
        if($brand->status == 0)
        {
            $brand->status = 1;
            $brand->save();
            return back()->with('sms','Brand available in public');
        }
        else
        {
            $brand->status = 0;
            $brand->save();
            return back()->with('sms','Brand in private mode');
        }

    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return back()->with('sms','Brand destroyed');
    }
}
