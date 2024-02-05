<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Section;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('BackEnd.slider.manage_slider',compact('sliders'));
    }

    public function create()
    {
        return view('BackEnd.slider.slider_create');
    }

    protected function Img($request)
    {
        if($request->hasFile('image')){

            $img_tmp = $request->file('image');

            if ($img_tmp->isValid()){
                $img_ext = $img_tmp->getClientOriginalExtension();
            $img_name = rand(11111, 99999).'.'.$img_ext;
                $img_path = public_path('Back/images/slider');
                $img_tmp->move($img_path,$img_name);
                return $img_name;
            }
        }
    }


    public function store(Request $request)
    {

        $request->validate([
//            'name' => 'required',
//            'title' => 'required',

            'image'        =>  'required|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required',
        ]);

        $photo = $this->Img($request);

        Slider::create([
            'name' => $request->name,
            'title' => $request->title,
            'category_id' => $request->category_id,
            'image' => $photo
        ]);

        return redirect()->route('slider.index')->with('sms', 'Slider Store Succefully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);

        return view('BackEnd.slider.slider_edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $slider = Slider::find($id);

        if($request->hasFile('image'))
        {
            $img_tmp = $request->file('image');
            $img_ext = $img_tmp->getClientOriginalExtension();
            $img_name = rand(11111, 99999).'.'.$img_ext;
            $img_path = public_path('Back/images/slider');
            $img_tmp->move($img_path,$img_name);

            $old_img = 'Back/images/slider/'.$slider->image;

            if(file_exists($old_img))
            {
                unlink($old_img);
            }
        }
        else
        {
            $img_name = $slider->image;
        }


        $slider->image = $img_name;
        $slider->category_id = $request->category_id;
        $slider->name = $request->name;
        $slider->title = $request->title;
        $slider->save();
        return redirect()->route('slider.index')->with('sms', 'Slider update succefully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);

        if(file_exists($slider->image))
        {
            $image_path = public_path('Back/images/slider/'.$slider->image);
            @unlink($image_path);
        }

        $slider->delete();
        return back()->with('sms', 'Slider Deleted');
    }

    public function status($id)
    {
        $slider = Slider::find($id);
        if($slider->status == '0')
        {
            $slider->status = '1';
            $slider->save();
            return back()->with('sms', 'Slider Activated');
        }
        else
        {
            $slider->status = '0';
            $slider->save();
            return back()->with('sms', 'Sider Deactivated');
        }
    }
}
