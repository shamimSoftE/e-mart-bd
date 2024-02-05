<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', null)->get();
        return view('BackEnd.category.sub-category-list', compact('categories'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('BackEnd.category.sub-category-add',compact('categories'));
    }

    public function show()
    {
        //
    }

    protected function Img($request)
    {
        if($request->hasFile('category_img')){

            $img_tmp = $request->file('category_img');

            if ($img_tmp->isValid()){
                $img_exten = $img_tmp->getClientOriginalExtension();
                $img_name = rand(11111,99999).'.'.$img_exten;
                $img_path = public_path('Back/images/category');
                $img_tmp->move($img_path,$img_name);
                return $img_name;
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        $image = $this->Img($request);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' =>$request->parent_id,
            'category_img' => $image,
        ]);

        return back()->with('sms','Sub Category Stored');
    }

    public function edit($id)
    {
        $cate = Category::findOrFail($id);
        return view('BackEnd.category.sub-category-edit',compact('cate'));
    }

    public function update(Request $request,$id)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' =>$request->parent_id,
            // 'category_img' => $image,
        ]);

        return back()->with('sms','Sub Category updated');
    }

    public function active(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = 1;
        $category->save();
        return back()->with('sms','Sub Category available');
    }

    public function inactive(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = 0;
        $category->save();
        return back()->with('sms','Sub Category Unavailable');
    }

    public function destroy($id)
    {
        $cate= Category::find($id);

        $cate->delete();
        return back()->with('sms','Sub Category destroyed');
    }


    // ================== parent category ============

    public function All_Parent()
    {
        $categories = Category::whereNull('parent_id')->latest()->get();
        return view('BackEnd.category.parent_cate_list', compact('categories'));
    }

    public function parent_create()
    {
        return view('BackEnd.category.parent_create');
    }

    public function parent_store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
            // 'name' => 'required|regex:/^[a-zA-Z]/|unique:categories'
        ]);

        $input = $request->all();
        $input['slug'] = Str::slug($request->name);

        if ($request->file('category_img')) {
            $imageName = date('YmdHis') . '.' . $request->category_img->extension();
            $request->category_img->move(public_path('Back/images/category'), $imageName);
            $input['category_img'] = $imageName;
        } else {
            unset($input['category_img']);
        }

        Category::create($input);

        return back()->with('sms', 'Category Created');
    }

    public function parent_update(Request $request)
    {
        try {
            $input = $request->all();
            $input['slug'] = Str::slug($request->name);

            if ($request->file('category_img')) {
                $imageName = date('YmdHis') . '.' . $request->category_img->extension();
                $request->category_img->move(public_path('Back/images/category'), $imageName);
                $input['category_img'] = $imageName;
            } else {
                unset($input['category_img']);
            }

            Category::find($request->id)->update($input);
            return back()->with('sms', 'Category Updated');
        } catch (\Throwable $th) {
            return back()->with('sms', $th->getMessage());
        }
    }

    public function status($id)
    {
        $parentCate = Category::find($id);
        if($parentCate->status == '1')
        {
            $parentCate->status = 0;
            $parentCate->save();
            return back()->with('sms', 'Category Hide');
        }
        else
        {
            $parentCate->status = 1;
            $parentCate->save();
            return back()->with('sms', 'Category Active');
        }
    }

    public function parent_cate_del($id)
    {
        $cate= Category::find($id);
        $categories = Category::where('parent_id',$cate->id)->get();
        if(!empty($categories))
        {
            foreach ($categories as $cat)
            {
                $cat->delete();
                $cate->delete();
            }
        }
        $cate->delete();
        return back()->with('sms',' Category Destroyed');
    }

    public function makeMenuCate(Request $request)
    {
        $cate = Category::find($request->id);
        if ($cate->menu_cate == 0) {
            $cate->update([
                'menu_cate' => 1,
                'created_at' => date("Y-m-d H:m:s")
            ]);
            return response()->json(['sms'=>'Category Added To Menu']);
        }else {
            $cate->update([
                'menu_cate' => 0,
                'created_at' => date("Y-m-d H:m:s")
             ]);
            return response()->json(['sms'=>'Category Remove From Menu']);
        }
    }
}
