<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
// use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();
        return view('BackEnd.product.pro_list', compact('products'));
    }

    public function affliateProduct()
    {
        // $products = Product::latest()->where('affiliate_link', 1)->get();
        // return view('BackEnd.product.pro_affliate_list', compact('products'));
    }

    public function create()
    {
        return view('BackEnd.product.pro_add');
    }

    public function store(Request $request)
    {
        $multi_s = json_encode($request->section_id, true);
        if($multi_s == "null")
        {
            $multi_section = NULL;
        }
        else
        {
            $multi_section = json_encode($request->section_id, true);
        }

        /*=== multiple color ====*/
        $multi_co = json_encode($request->color_id, true);
        if($multi_co == "null")
        { $multi_color = NULL; }
        else
        { $multi_color = json_encode($request->color_id, true); }

        // multiple size
        $multi_si = json_encode($request->size_id, true);
        if($multi_si == "null")
        { $multi_size = NULL; }
        else
        { $multi_size = json_encode($request->size_id, true); }


        $request->validate([
            'name' => 'required|max:100',
            'short_description' => 'required',
            'long_description' => 'required',
            'regular_price' => 'required',
            'spacial_price' => 'required',
           'spacial_price' => 'required|lt:regular_price',
            'quantity' => 'required',
            'image'        =>  'required',
        ]);

        if ($request->hasFile('image')) {

            $count = count($request->image);
            $imag = $request->file('image');

            $images = [];
            for ($i = 0; $i < $count; $i++) {
        //                $img_tmp = Image::make($imag[$i]);
                $img_tmp =  $imag[$i];
                $img_name =time().'_'.rand().'.'.$img_tmp->getClientOriginalExtension();
                $img_path = 'Back/images/product/'.$img_name;
                $img_path_small = 'Back/images/product/small/'.$img_name;
                $img_path_large = 'Back/images/product/large/'.$img_name;
                $img_path_medium = 'Back/images/product/medium/'.$img_name;
                Image::make($img_tmp)->resize(218, 220)->save($img_path);
                Image::make($img_tmp)->resize(107, 107)->save($img_path_small);
                Image::make($img_tmp)->resize(458, 458)->save($img_path_medium);
                Image::make($img_tmp)->resize(1200, 1200)->save($img_path_large);

                array_push($images, $img_name);
            }

            $photos = json_encode($images);
        }

        Product::create([
            'name' => $request->name,
            // 'affiliate_link' => $request->affiliate_link,
            'slug' => Str::slug($request->name).'_'.rand(001,999),
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'regular_price' => $request->regular_price,
            'special_price' => $request->spacial_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'image' => $photos,
            'section_id' => $multi_section,
            'size' => $multi_size,
            // 'model_name' => $request->model_name,
            'color_id' => $multi_color,
            'warranty' => $request->warranty,
            'delivery' => $request->delivery,
            'return_policy' => $request->return_policy,
            'cod' => $request->cod,
            // 'review' => $request->review,
            'p_tag' => $request->p_tag,
            'omq' => $request->omq,
        ]);

        return back()->with('sms', 'product Store successfully');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('BackEnd.product.pro_edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|min:3|max:100',
            'short_description' => 'required',
            'long_description' => 'required',
            'regular_price' => 'required',
           'special_price' => 'required|lt:regular_price',
            'quantity' => 'required',
            // 'image'        =>  'required',
        ]);

        // dd($request->all());

        $multi_s = json_encode($request->section_id, true);
        if($multi_s == "null"){ $multi_section = NULL; }else{ $multi_section = json_encode($request->section_id, true); }

        /*=== multiple color ====*/
        $multi_co = json_encode($request->color_id, true);
        if($multi_co == "null")
        { $multi_color = NULL; }
        else
        { $multi_color = json_encode($request->color_id, true); }

        // multiple size
        $multi_si = json_encode($request->size_id, true);
        if($multi_si == "null") { $multi_size = NULL; }
        else { $multi_size = json_encode($request->size_id, true); }

        $images = [];
        if ($request->hasFile('image')) {

            $count = count($request->image);
            $imag = $request->file('image');

            for ($i = 0; $i < $count; $i++) {
                $img_tmp =  $imag[$i];
                $img_name =time().'_'.rand().'.'.$img_tmp->getClientOriginalExtension();
                // $img_path = public_path('Back/images/product');
                // $img_tmp->move($img_path, $img_name);
                $img_path = 'Back/images/product/'.$img_name;
                $img_path_small = 'Back/images/product/small/'.$img_name;
                $img_path_large = 'Back/images/product/large/'.$img_name;
                $img_path_medium = 'Back/images/product/medium/'.$img_name;
                Image::make($img_tmp)->resize(218, 220)->save($img_path);
                Image::make($img_tmp)->resize(107, 107)->save($img_path_small);
                Image::make($img_tmp)->resize(458, 458)->save($img_path_medium);
                Image::make($img_tmp)->resize(1200, 1200)->save($img_path_large);
                array_push($images, $img_name);
            }
        }

        if (isset($request->old_image)) {
            $old_image = $request->old_image;
            $count = count($old_image);
            for ($i = 0; $i < $count; $i++) {
                array_push($images, $old_image[$i]);
            }
        }

        $image = (json_encode($images));

        $data = Product::find($id);
        // $data->affiliate_link = $request->affiliate_link;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name).'_'.rand(001,999);
        $data->short_description = $request->short_description;
        $data->long_description = $request->long_description;
        $data->regular_price = $request->regular_price;
        $data->special_price = $request->special_price;
        $data->quantity = $request->quantity;
        $data->section_id = $multi_section;

        $data->category_id = $request->category_id;
        $data->brand_id = $request->brand_id;
        $data->color_id = $multi_color;
        $data->size = $multi_size;
        // $data->model_name = $request->model_name;
        $data->warranty = $request->warranty;
        $data->delivery = $request->delivery;
        $data->cod = $request->cod;
        $data->return_policy = $request->return_policy;
        $data->image = $image;
        $data->p_tag = $request->p_tag;
        $data->omq = $request->omq;
        $data->update();

        return redirect()->route('product.index')->with('sms', 'product update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $images = $product->image;
        foreach (json_decode($images) as $img) {
            // echo $img . '<br>';
            $image_path = public_path('Back/images/product/') . $img;
            // dd($image_path);
            @unlink($image_path);
        }
        $product->delete();
        return back()->with('sms', 'product Deleted');
    }

    public function status($id)
    {
        $product = Product::find($id);
        if($product->status == '0')
        {
            $product->status = '1';
            $product->save();
            return back()->with('sms', 'product Activated');
        }
        else
        {
            $product->status = '0';
            $product->save();
            return back()->with('sms', 'product Deactivated');
        }
    }

    public function allProducts()
    {
        $products = Product::with('brand','category')->latest()->get();

        return response()->json(['products',$products]);
        // return view('BackEnd.product.pro_list', compact('products'));
    }
}
