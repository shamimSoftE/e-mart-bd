<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Image;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();

        return view('BackEnd.banner.banner_list',compact('banners'));

    }

    public function create()
    {
        return view('BackEnd.banner.banner_add');
    }

    public function store(Request $request)
    {
        if($request->hasFile('image')){

            $img_tmp = $request->file('image');

            if ($img_tmp->isValid()){
                $img_exten = $img_tmp->getClientOriginalExtension();
                $img_name = rand(111, 99999).'-'.time().'.'.$img_exten;

                $img_path = 'Back/images/banner/'.$img_name;
                $img_path_small = 'Back/images/banner/small/'.$img_name;
                Image::make($img_tmp)->resize(1130, 200)->save($img_path);
                Image::make($img_tmp)->resize(1920, 200)->save($img_path_small);

                Banner::create([
                    'image' => $img_name,
                    'section_id' => $request->section_id
                ]);
                return redirect()->route('banner.index')->with('sms', 'Banner Created');
            }
        }
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);

        if($request->hasFile('image'))
        {
            $img_tmp = $request->file('image');
            $img_exten = $img_tmp->getClientOriginalExtension();
            $img_name = rand(111, 99999).'-'.time().'.'.$img_exten;

            $img_path = 'Back/images/banner/'.$img_name;
            $img_path_small = 'Back/images/banner/small/'.$img_name;
            Image::make($img_tmp)->resize(1130, 200)->save($img_path);
            Image::make($img_tmp)->resize(1920, 200)->save($img_path_small);

            $old_img = public_path('Back/images/banner/'.$banner->image);
            $old_img_small = public_path('Back/images/banner/small/'.$banner->image);

            if(file_exists($old_img))
            {
                unlink($old_img);
            }
            if(file_exists($old_img_small))
            {
                unlink($old_img_small);
            }

            $banner->image = $img_name;
            $banner->section_id = $request->section_id;
            $banner->update();
        }
        return redirect()->back()->with('sms', 'Banner Updated');
    }

    public function status($id)
    {
        $banner = Banner::find($id);
        if($banner->status == 1)
        {
            $banner->status = 0;
        }
        else
        {
            $banner->status = 1;
        }
        $banner->save();
        return back()->with('sms', 'Banner Status Updated');
    }

    public function destroy(Banner $banner)
    {
        $path_img = public_path('Back/images/banner/'.$banner->image);
        $path_img_small = public_path('Back/images/banner/small/'.$banner->image);

        if(file_exists($path_img))
            {
                unlink($path_img);
            }
        if(file_exists($path_img_small))
            {
                unlink($path_img_small);
            }
        $banner->delete();

        return back()->with('sms', 'Banner Deleted');
    }

}
