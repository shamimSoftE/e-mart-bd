<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Contact;
use App\Models\Popular;
use App\Models\Product;
use App\Models\Review;
use App\Models\Section;
use App\Models\SiteInfo;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * index page
     */
    public function index()
    {
        $slider = Slider::where('status', 1)->get();
        $categories = Category::where('status', 1)->where('parent_id', null)->get();
        $popularCategory = Popular::latest()->select('category_id')->groupBy('category_id')->get();
        $popularProducts = Popular::latest()->select('product_id')->groupBy('product_id')->get();
        $section = Section::where('status', 1)->get();
        $products = Product::where('status',1)->whereNotNull('section_id')->latest()->get();
        return view('FrontEnd.home.home_content', compact('slider','categories','section','products','popularCategory','popularProducts'));
    }

    // latest product

    public function latest()
    {
        $products = Product::where('status',1)->latest()->limit(120)->get();
        return view('FrontEnd.pages.products_more',compact('products'));
    }

    /**
     * search
     */
    public function search(Request $request)
    {
        $searchItem = \request()->query('query');
        $data = $request->all();

        // if($request->has('category_id'))
        // {
        //     $products = Product::where('status',1)->where('name', 'LIKE', "%{$searchItem}%")->where('category_id',$request->category_id)->get();
        // }
        // else
        // {
            $products = Product::where('status',1)
                ->where('name', 'LIKE', "%{$searchItem}%")
                ->orWhere('slug', 'LIKE', "%{$searchItem}%")
                ->get();
        // }

        return view('FrontEnd.pages.products_more',compact('products','data'));
    }

    /**
     * single product
     */
    public function single(Product $product)
    {
        $relatedProduct = Product::where('category_id',$product->category_id)
            ->where('id','!=',$product->id)
            ->latest()
            ->get();

        $photos = json_decode($product->image);

        $colors = Color::where('status',1)->get();
        $reviews = Review::where('product_id',$product->id)->latest()->get();

        return view('FrontEnd.pages.product_single2', compact('product', 'photos','relatedProduct','colors','reviews'));
        // return view('FrontEnd.pages.product_single', compact('product', 'photos','relatedProduct','colors','reviews'));
    }

    /**
     * max price product
     */
    public function maxProduct()
    {
        $products = Product::orderBy('regular_price')->get();
        return view('FrontEnd.pages.products_more', compact('products'));
    }


    /*
    color wise product
    */

    // public function colorWise($id)
    // {
    //     $col_id = $id;
    //     $products = Product::whereNotNull('color_id')->get();
    //     return view('FrontEnd.shop.catePro',compact('products','col_id'));
    // }


    public function priceRange(Request $request)
    {
        $range = $request->all();
        // dd($range);
        // $section = Section::where('status', 1)->get()->toArray();
        $products = Product::where('special_price', ">=", $request->min)
                            ->where('special_price', "<=",$request->max)
                            ->where('status',1)
                            ->whereNotNull('section_id')
                            ->get();
        //  dd($products);
        return view('FrontEnd.pages.products_more',compact('products','range'));
    }

    public function viewMore(Section $section)
    {
        // dd($section->id);
        $section_id = $section->id;
        // $products = Product::where('status', 1)->whereNotNull('section_id')->whereJsonContains('section_id', [$section->id])->get();
        $products = Product::where('status', 1)->whereNotNull('section_id')->get();
        // dd($products);

        return view('FrontEnd.pages.products_more',compact('products','section_id','section'));
    }

      /*
    category wise product
    */

    public function cateWise($id)
    {
        $category = Category::findOrFail($id);

        $products = Product::where('status', 1)->where('category_id', $id)->get();
        return view('FrontEnd.pages.products_more',compact('products','category'));
    }

    public function mainCateWise($id)
    {
        $category = Category::findOrFail($id);
        // $categories = Category::where('parent_id',$id)->get()->toArray();

        $products = Product::where('status', 1)->where('category_id', $category->id)->get();
        // $products = Product::where('status', 1)->where('category_id', array_values($categories))->get();

        return view('FrontEnd.pages.products_more',compact('products','categories'));
    }

    public function brandWise($id)
    {
        $brand = Brand::findOrFail($id);

        $products = Product::where('status', 1)->where('brand_id', $brand->id)->get();

        return view('FrontEnd.pages.products_more',compact('products','brand'));
    }

    public function bannerWise($id)
    {
        $banner = Banner::findOrFail($id);
        $products = Product::where('status', 1)->whereNotNull('section_id')->get();

        return view('FrontEnd.pages.banner_pro',compact('products','banner'));
    }

    public function contact()
    {
        $contact = Contact::get()->first();
        $siteInfo = SiteInfo::get()->first();
        return view('FrontEnd.pages.contact_page', compact('contact','siteInfo'));
    }

    public function about()
    {
        $about =About::get()->first();
        return view('FrontEnd.pages.about_page',compact('about'));
    }


}
