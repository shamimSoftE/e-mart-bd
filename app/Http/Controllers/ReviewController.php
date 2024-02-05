<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected function Img($request)
    {
        if($request->hasFile('image')){

            $img_tmp = $request->file('image');

            if ($img_tmp->isValid()){
                $img_exten = $img_tmp->getClientOriginalExtension();
                $img_name = rand(111, 99999).'-'.time().'.'.$img_exten;
                $img_path = public_path('Back/images/review');
                $img_tmp->move($img_path,$img_name);
                return $img_name;
            }
        }
    }

    public function store(Request $request)
    {
        $img_name = $this->Img($request);


        Review::create([
            'title' => $request->title,
            'description' => $request->description,
            'rating' => $request->review,
            'image' => $img_name,
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
        ]);
        return back()->with('sms', 'Thanks for your feedback');
    }
}
