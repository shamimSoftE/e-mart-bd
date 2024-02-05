<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('BackEnd.section.section-list', compact('sections'));
    }

    public function create()
    {
        return view('BackEnd.section.section-add');
    }

    public function show()
    {
        //
    }

    public function store(Request $request)
    {
       $sec = Section::all();

        if ($sec->count() <20)
        {

            Section::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'commission' => $request->commission,
            ]);

            return back()->with('sms','Section Stored');
        }
        else
        {
            Session::flash('error', 'You can not create Section more then 20');
            return back();
        }

    }

    public function update(Request $request)
    {
        $section = Section::find($request->id);
        $section->title = $request->title;
        $section->slug = Str::slug($request->title);
        $section->commission = $request->commission;
        $section->save();

        return back()->with('sms','Section updated');
    }

    public function status($id)
    {
        $section = Section::find($id);
        if($section->status == '1')
        {
            $section->status = 0;
            $section->save();
            return back()->with('sms','Section Unavailable');
        }
        else
        {
            $section->status = 1;
            $section->save();
            return back()->with('sms','Section Available');
        }
    }



    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        return back()->with('sms','Section destroyed');
    }
}
